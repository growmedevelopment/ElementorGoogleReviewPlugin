<?php

declare(strict_types=1);

namespace GoogleReview;

use GoogleReview\Assets\AssetLoader;
use GoogleReview\Contracts\IControlsSection;
use GoogleReview\Contracts\ILayoutRenderer;
use GoogleReview\Rendering\StarRenderer;

if (! defined('ABSPATH')) {
    exit;
}

final class GoogleReviewWidget extends \Elementor\Widget_Base
{
    private static AssetLoader $assetLoader;
    private static StarRenderer $starRenderer;

    /** @var IControlsSection[] */
    private static array $sections;

    /** @var array<string, ILayoutRenderer> */
    private static array $renderers;

    /**
     * @param IControlsSection[]             $sections
     * @param array<string, ILayoutRenderer> $renderers
     */
    public static function configure(
        AssetLoader $assetLoader,
        StarRenderer $starRenderer,
        array $sections,
        array $renderers,
    ): void {
        self::$assetLoader  = $assetLoader;
        self::$starRenderer = $starRenderer;
        self::$sections     = $sections;
        self::$renderers    = $renderers;
    }

    public function __construct(array $data = [], ?array $args = null)
    {
        parent::__construct($data, $args);
        self::$assetLoader->enqueue();
    }

    public function get_name(): string      { return 'google-review-widget'; }
    public function get_title(): string     { return esc_html__('Google Review', 'google-review'); }
    public function get_icon(): string      { return 'eicon-review'; }
    public function get_categories(): array { return ['general']; }
    public function get_keywords(): array   { return ['google', 'review']; }

    protected function register_controls(): void
    {
        foreach (self::$sections as $section) {
            $section->register($this);
        }
    }

    protected function render(): void
    {
        $settings = $this->get_settings_for_display();
        $key      = ($settings['is_slider'] ?? '') === 'yes' ? 'slider' : 'thumbnails';

        ob_start();
        self::$renderers[$key]->render($settings);
        $reviewsHtml = (string) ob_get_clean();

        $starsHtml = self::$starRenderer->renderStars((float) ($settings['stars'] ?? 5));

        include __DIR__ . '/templates/widget-wrapper.php';
    }
}
