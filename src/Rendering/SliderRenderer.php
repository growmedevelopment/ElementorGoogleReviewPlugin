<?php

declare(strict_types=1);

namespace GoogleReview\Rendering;

use GoogleReview\Contracts\ILayoutRenderer;

final class SliderRenderer implements ILayoutRenderer
{
    public function __construct(
        private readonly StarRenderer $starRenderer,
        private readonly RelativeDateFormatter $dateFormatter,
    ) {}

    public function render(array $settings): void
    {
        $reviews = $this->enrichReviews($settings['list'] ?? []);

        include GOOGLE_REVIEWS_PLUGIN_DIR . 'widgets/templates/slider-layout.php';
    }

    /** @param array<int, array<string, mixed>> $list */
    private function enrichReviews(array $list): array
    {
        return array_map(function (array $item): array {
            $item['stars_html']    = $this->starRenderer->renderStars((float) ($item['stars'] ?? 5))
                                   . $this->starRenderer->renderVerifiedTick();
            $item['relative_date'] = $this->dateFormatter->format($item['date'] ?? '');

            return $item;
        }, $list);
    }
}
