<?php

declare(strict_types=1);

namespace GoogleReview\Controls;

use GoogleReview\Contracts\IControlsSection;

final class GeneralSettingsSection implements IControlsSection
{
    public function register(\Elementor\Widget_Base $widget): void
    {
        $widget->start_controls_section('general_settings_section', [
            'label' => esc_html__('General settings', 'google-review'),
            'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
        ]);

        $widget->add_control('class_name', [
            'type'        => \Elementor\Controls_Manager::TEXT,
            'label'       => esc_html__('Custom class name', 'google-review'),
            'placeholder' => esc_html__('Enter your css class', 'google-review'),
            'default'     => '',
        ]);

        $widget->add_control('is_slider', [
            'label'        => esc_html__('Use Slider', 'google-review'),
            'type'         => \Elementor\Controls_Manager::SWITCHER,
            'label_on'     => esc_html__('Yes', 'google-review'),
            'label_off'    => esc_html__('No', 'google-review'),
            'return_value' => 'yes',
            'default'      => 'yes',
        ]);

        $widget->add_control('show_only_reviews', [
            'label'        => esc_html__('Show only reviews section', 'google-review'),
            'type'         => \Elementor\Controls_Manager::SWITCHER,
            'label_on'     => esc_html__('Yes', 'google-review'),
            'label_off'    => esc_html__('No', 'google-review'),
            'return_value' => 'yes',
            'default'      => '',
        ]);

        $widget->add_responsive_control('reviews_per_slide', [
            'label'     => esc_html__('Reviews per slide', 'google-review'),
            'type'      => \Elementor\Controls_Manager::SELECT,
            'options'   => ['1' => '1', '2' => '2', '3' => '3'],
            'default'   => '3',
            'condition' => ['is_slider' => 'yes'],
        ]);

        $widget->add_responsive_control('static_columns', [
            'label'     => esc_html__('Columns to Display', 'google-review'),
            'type'      => \Elementor\Controls_Manager::SELECT,
            'options'   => ['1' => '1', '2' => '2', '3' => '3'],
            'condition' => ['is_slider' => ''],
        ]);

        $widget->end_controls_section();
    }
}
