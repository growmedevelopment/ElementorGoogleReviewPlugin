<?php

declare(strict_types=1);

namespace GoogleReview\Rendering;

final class RelativeDateFormatter
{
    public function format(string $dateRaw): string
    {
        if ($dateRaw === '') {
            return '';
        }

        $timestamp = strtotime($dateRaw);

        if ($timestamp === false) {
            return '';
        }

        $diffDays = (int) floor((current_time('timestamp') - $timestamp) / DAY_IN_SECONDS);

        return match (true) {
            $diffDays < 1    => __('today', 'google-review'),
            $diffDays <= 7   => sprintf(_n('%s day ago', '%s days ago', $diffDays, 'google-review'), $diffDays),
            $diffDays <= 28  => sprintf(_n('%s week ago', '%s weeks ago', (int) floor($diffDays / 7), 'google-review'), (int) floor($diffDays / 7)),
            $diffDays <= 365 => sprintf(_n('%s month ago', '%s months ago', (int) floor($diffDays / 30), 'google-review'), (int) floor($diffDays / 30)),
            default          => sprintf(_n('%s year ago', '%s years ago', (int) floor($diffDays / 365), 'google-review'), (int) floor($diffDays / 365)),
        };
    }
}
