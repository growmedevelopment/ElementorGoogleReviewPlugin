<?php

declare(strict_types=1);

namespace GoogleReview\Controls;

use GoogleReview\Contracts\IControlsSection;

final class MainSection implements IControlsSection
{
    public function register(\Elementor\Widget_Base $widget): void
    {
        $widget->start_controls_section('content_section', [
            'label' => esc_html__('Main section', 'google-review'),
            'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
        ]);

        $widget->add_control('title', [
            'type'    => \Elementor\Controls_Manager::SELECT,
            'label'   => esc_html__('Title', 'google-review'),
            'options' => [
                'excellent' => esc_html__('Excellent', 'google-review'),
                'good'      => esc_html__('Good', 'google-review'),
                'average'   => esc_html__('Average', 'google-review'),
                'poor'      => esc_html__('Poor', 'google-review'),
            ],
            'default' => 'excellent',
        ]);

        $widget->add_control('extend_button_text', [
            'type'        => \Elementor\Controls_Manager::TEXT,
            'label'       => esc_html__('Title for extend button', 'google-review'),
            'placeholder' => esc_html__('Enter your title', 'google-review'),
            'default'     => esc_html__('Read more', 'google-review'),
        ]);

        $widget->add_control('reduce_button_text', [
            'type'        => \Elementor\Controls_Manager::TEXT,
            'label'       => esc_html__('Title for reduce button', 'google-review'),
            'placeholder' => esc_html__('Enter your title', 'google-review'),
            'default'     => esc_html__('Hide', 'google-review'),
        ]);

        $widget->add_control('stars', [
            'type'    => \Elementor\Controls_Manager::NUMBER,
            'label'   => esc_html__('Stars', 'google-review'),
            'min'     => 3,
            'max'     => 5,
            'step'    => 0.5,
            'default' => 5,
        ]);

        $widget->add_control('text_section_color', [
            'label'     => esc_html__('Text color', 'google-review'),
            'type'      => \Elementor\Controls_Manager::COLOR,
            'selectors' => ['{{WRAPPER}} .google-text--container' => 'color: {{VALUE}}'],
            'default'   => '#000',
        ]);

        $widget->add_control('background_color', [
            'label'     => esc_html__('Background color', 'google-review'),
            'type'      => \Elementor\Controls_Manager::COLOR,
            'selectors' => ['{{WRAPPER}} .review-widget' => 'background-color: {{VALUE}}'],
        ]);

        $widget->add_control('text', [
            'type'        => \Elementor\Controls_Manager::WYSIWYG,
            'label'       => esc_html__('Text under stars', 'google-review'),
            'placeholder' => esc_html__('Based on __ reviews', 'google-review'),
            'default'     => esc_html__('Based on __ reviews', 'google-review'),
        ]);

        $widget->end_controls_section();
    }
}
