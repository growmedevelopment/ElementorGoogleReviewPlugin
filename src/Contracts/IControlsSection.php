<?php

declare(strict_types=1);

namespace GoogleReview\Contracts;

interface IControlsSection
{
    public function register(\Elementor\Widget_Base $widget): void;
}
