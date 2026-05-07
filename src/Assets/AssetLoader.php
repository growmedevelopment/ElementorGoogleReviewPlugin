<?php

declare(strict_types=1);

namespace GoogleReview\Assets;

final class AssetLoader
{
    public function __construct(
        private readonly string $pluginDir,
        private readonly string $pluginUrl,
    ) {}

    public function enqueue(): void
    {
        $assets = [
            'slick-css'         => ['assets/style/slick.css', 'style'],
            'google-review-css' => ['assets/style/google-review-widget-style.css', 'style'],
            'slick-js'          => ['assets/js/library/slickSlider.js', 'script'],
            'main-js'           => ['assets/js/google-review-widget-script.js', 'script'],
        ];

        foreach ($assets as $handle => [$relativePath, $type]) {
            $fullPath = $this->pluginDir . $relativePath;
            $url      = $this->pluginUrl . $relativePath;
            $version  = file_exists($fullPath) ? (string) filemtime($fullPath) : null;

            if ($type === 'style') {
                wp_enqueue_style($handle, $url, [], $version);
            } else {
                wp_enqueue_script($handle, $url, ['jquery'], $version, true);
            }
        }
    }
}
