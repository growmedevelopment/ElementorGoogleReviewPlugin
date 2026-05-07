<?php

/**
 * Plugin Name: Elementor Google reviews
 * Description: Elementor widget Google reviews.
 * Version:     2.2.7
 * Author:      Dmytro Kovalenko
 * Author URI:  https://dmytro-kovalenko.com/
 * Text Domain: google-reviews
 * Update URI:  http://wpplugins-googletestimonials.growmeconsulting.ca/
 *
 * Elementor tested up to: 3.26.4
 * Elementor Pro tested up to: 3.26.3
 * Requires PHP: 8.1
 */

declare(strict_types=1);

use Elementor\Widgets_Manager;
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

if (! defined('ABSPATH')) {
    exit;
}

define('GOOGLE_REVIEWS_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('GOOGLE_REVIEWS_PLUGIN_URL', plugin_dir_url(__FILE__));

spl_autoload_register(static function (string $class): void {
    $prefix  = 'GoogleReview\\';
    $baseDir = __DIR__ . '/src/';

    if (! str_starts_with($class, $prefix)) {
        return;
    }

    $relative = str_replace('\\', '/', substr($class, strlen($prefix)));
    $file     = $baseDir . $relative . '.php';

    if (file_exists($file)) {
        require $file;
    }
});

require_once __DIR__ . '/plugin-update-checker-master/plugin-update-checker.php';

register_deactivation_hook(__FILE__, 'google_reviews_deactivate');
add_action('init', 'google_reviews_schedule_nightly_update');
add_action('google_reviews_nightly_update', 'google_reviews_run_nightly_update');
add_action('elementor/widgets/register', 'google_reviews_register_widgets');

google_reviews_update_checker();

function google_reviews_update_checker(): \YahnisElsts\PluginUpdateChecker\v5p5\Plugin\UpdateChecker
{
    static $checker = null;

    if ($checker === null) {
        $checker = PucFactory::buildUpdateChecker(
            google_reviews_get_update_metadata_url(),
            __FILE__,
            'google-reviews',
            0
        );
    }

    return $checker;
}

function google_reviews_deactivate(): void
{
    wp_clear_scheduled_hook('google_reviews_nightly_update');
}

function google_reviews_schedule_nightly_update(): void
{
    if (wp_next_scheduled('google_reviews_nightly_update') !== false) {
        return;
    }

    $timezone = wp_timezone();
    $next_run = new \DateTimeImmutable('now', $timezone);
    $next_run = $next_run->setTime(2, 0);

    if ($next_run->getTimestamp() <= time()) {
        $next_run = $next_run->modify('+1 day');
    }

    wp_schedule_event($next_run->getTimestamp(), 'daily', 'google_reviews_nightly_update');
}

function google_reviews_run_nightly_update(): void
{
    if (wp_installing()) {
        return;
    }

    $checker = google_reviews_update_checker();
    $update  = $checker->checkForUpdates();

    if ($update === null) {
        return;
    }

    $transient = get_site_transient('update_plugins');
    $transient = $checker->injectUpdate($transient);
    set_site_transient('update_plugins', $transient);

    if (! isset($transient->response[plugin_basename(__FILE__)])) {
        return;
    }

    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/misc.php';
    require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';

    $upgrader = new \Plugin_Upgrader(new \Automatic_Upgrader_Skin());
    $upgrader->upgrade(plugin_basename(__FILE__));
}

function google_reviews_get_update_metadata_url(): string
{
    return (string) apply_filters(
        'google_reviews_update_metadata_url',
        'http://wpplugins-googletestimonials.growmeconsulting.ca/google-reviews/google-reviews-plugin.json'
    );
}

function google_reviews_register_widgets(Widgets_Manager $widgets_manager): void
{
    require_once __DIR__ . '/widgets/googleRewie-widget.php';
    $widgets_manager->register(new \Essential_Elementor_Google_Review_Widget());
}
