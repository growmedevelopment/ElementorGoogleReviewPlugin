<?php

declare(strict_types=1);

namespace GoogleReview\Controls;

use GoogleReview\Contracts\IControlsSection;

final class ReviewsSection implements IControlsSection
{
    public function register(\Elementor\Widget_Base $widget): void
    {
        $widget->start_controls_section('section_content', [
            'label' => esc_html__('Reviews', 'google-review'),
            'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
        ]);

        $widget->add_control('list', [
            'label'       => esc_html__('Reviews', 'google-review'),
            'type'        => \Elementor\Controls_Manager::REPEATER,
            'title_field' => '{{{ text }}}',
            'default'     => [[], [], [], []],
            'fields'      => [
                [
                    'name'        => 'text',
                    'label'       => esc_html__('Author Full name', 'google-review'),
                    'type'        => \Elementor\Controls_Manager::TEXT,
                    'placeholder' => esc_html__('Jon Smith', 'google-review'),
                    'default'     => esc_html__('Jon Smith', 'google-review'),
                    'label_block' => true,
                ],
                [
                    'name'        => 'subtitle',
                    'label'       => esc_html__('Subtitle', 'google-review'),
                    'type'        => \Elementor\Controls_Manager::TEXT,
                    'placeholder' => '',
                    'default'     => '',
                    'label_block' => true,
                ],
                [
                    'name'        => 'avatar_url',
                    'label'       => esc_html__('link to avatar', 'google-review'),
                    'type'        => \Elementor\Controls_Manager::TEXT,
                    'placeholder' => '',
                    'default'     => '',
                    'label_block' => true,
                ],
                [
                    'name'         => 'is_local_guide',
                    'label'        => esc_html__('Local Guide', 'google-review'),
                    'type'         => \Elementor\Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__('Yes', 'google-review'),
                    'label_off'    => esc_html__('No', 'google-review'),
                    'return_value' => 'yes',
                    'default'      => '',
                    'description'  => esc_html__('Mark this author as a Local Guide', 'google-review'),
                ],
                [
                    'name'        => 'link',
                    'label'       => esc_html__('Author Initial', 'google-review'),
                    'type'        => \Elementor\Controls_Manager::TEXT,
                    'placeholder' => esc_html__('J', 'google-review'),
                    'default'     => esc_html__('J', 'google-review'),
                    'label_block' => true,
                ],
                [
                    'name'           => 'date',
                    'label'          => esc_html__('Date of Published', 'google-review'),
                    'type'           => \Elementor\Controls_Manager::DATE_TIME,
                    'picker_options' => [
                        'enableTime' => false,
                        'minDate'    => gmdate('Y-m-d', strtotime('-2 years')),
                        'maxDate'    => gmdate('Y-m-d'),
                    ],
                    'default'        => gmdate('Y-m-d H:i:s'),
                    'label_block'    => true,
                    'description'    => esc_html__('Pick a date within the last 2 years. Future dates are not allowed.', 'google-review'),
                ],
                [
                    'name'    => 'stars',
                    'label'   => esc_html__('Stars', 'google-review'),
                    'type'    => \Elementor\Controls_Manager::NUMBER,
                    'min'     => 3,
                    'max'     => 5,
                    'step'    => 0.5,
                    'default' => 5,
                ],
                [
                    'name'        => 'review_description',
                    'label'       => esc_html__('Review', 'google-review'),
                    'type'        => \Elementor\Controls_Manager::WYSIWYG,
                    'default'     => "'We chose _____ for our extensive kitchen renovation...'",
                    'placeholder' => esc_html__('Type your review here', 'google-review'),
                ],
            ],
        ]);

        $widget->add_control('items_color', [
            'label'     => esc_html__('Color of review items', 'google-review'),
            'type'      => \Elementor\Controls_Manager::COLOR,
            'selectors' => ['{{WRAPPER}} .review-card' => 'background-color: {{VALUE}}'],
        ]);

        $widget->add_control('text_item_color', [
            'label'     => esc_html__('Text color of review item', 'google-review'),
            'type'      => \Elementor\Controls_Manager::COLOR,
            'selectors' => ['{{WRAPPER}} .review-card' => 'color: {{VALUE}}'],
            'default'   => '#000',
        ]);

        $widget->add_control('expand_button_color', [
            'label'     => esc_html__('Color of expand/collapse button', 'google-review'),
            'type'      => \Elementor\Controls_Manager::COLOR,
            'selectors' => ['{{WRAPPER}} .review-card .review-card-btn' => 'color: {{VALUE}}'],
        ]);

        $widget->add_control('hide_google_logo', [
            'label'        => esc_html__('Hide google logo', 'google-review'),
            'type'         => \Elementor\Controls_Manager::SWITCHER,
            'label_on'     => esc_html__('Yes', 'google-review'),
            'label_off'    => esc_html__('No', 'google-review'),
            'return_value' => 'yes',
            'default'      => 'no',
        ]);

        $widget->add_control('hide_review_date', [
            'label'        => esc_html__('Hide review date', 'google-review'),
            'type'         => \Elementor\Controls_Manager::SWITCHER,
            'label_on'     => esc_html__('Yes', 'google-review'),
            'label_off'    => esc_html__('No', 'google-review'),
            'return_value' => 'yes',
            'default'      => 'no',
        ]);

        $widget->end_controls_section();
    }
}
