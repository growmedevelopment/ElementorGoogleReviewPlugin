<?php

declare(strict_types=1);

namespace GoogleReview\Contracts;

interface ILayoutRenderer
{
    public function render(array $settings): void;
}
