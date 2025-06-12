<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
}

require_once plugin_dir_path(__FILE__) . 'includes/ControlsBuilder.php';
use GoogleReview\ControlsBuilder;

class Essential_Elementor_Google_Review_Widget extends \Elementor\Widget_Base {

  public function __construct($data = [], $args = null) {
    parent::__construct($data, $args);
    $this->enqueue_assets();
  }

  /**
   * Register and enqueue widget assets.
   */
  protected function enqueue_assets(): void {
    $files = [
      'slick-css' => '../assets/style/slick.css',
      'google-review-css' => '../assets/style/google-review-widget-style.css',
      'slick-js' => '../assets/js/library/slickSlider.js',
      'main-js' => '../assets/js/google-review-widget-script.min.js',
    ];

    foreach ($files as $handle => $relative_path) {
      $full_path = plugin_dir_path(__FILE__) . $relative_path;
      $version   = file_exists($full_path) ? filemtime($full_path) : null;
      $url       = plugin_dir_url(__FILE__) . $relative_path;

      if (str_contains($handle, '-css')) {
        wp_enqueue_style($handle, $url, [], $version);
      } else {
        wp_enqueue_script($handle, $url, ['jquery'], $version, true);
      }
    }
  }

  public function get_name(): string {
    return 'google-review-widget';
  }

  public function get_title(): string {
    return esc_html__('Google Review', 'google-review');
  }

  public function get_icon(): string {
    return 'eicon-review';
  }

  public function get_categories(): array {
    return ['general'];
  }

  public function get_keywords(): array {
    return ['google', 'review'];
  }

  public function get_style_depends(): array {
    return ['slick', 'google-review-css'];
  }

  public function get_script_depends(): array {
    return ['main', 'slick'];
  }

  protected function register_controls(): void {
    $builder = new ControlsBuilder();
    $builder->build($this);
  }

  protected function render(): void {
    include plugin_dir_path(__FILE__) . 'templates/admin_editor_render.php';
  }
}