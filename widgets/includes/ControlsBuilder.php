<?php

namespace GoogleReview;

defined('ABSPATH') || exit;

class ControlsBuilder {

  public function build(\Elementor\Widget_Base $widget): void
  {
    // General settings section
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
      'label'          => esc_html__('Reviews per slide', 'google-review'),
      'type'           => \Elementor\Controls_Manager::SELECT,
      'options'        => [
        '1' => '1',
        '2' => '2',
        '3' => '3',
      ],
      'default'        => '3',
      'condition' => [
        'is_slider' => 'yes',
      ],
    ]);

    $widget->add_responsive_control('static_columns', [
      'label'          => esc_html__('Columns to Display', 'google-review'),
      'type'           => \Elementor\Controls_Manager::SELECT,
      'options'        => [
        '1' => '1',
        '2' => '2',
        '3' => '3',
      ],
      'condition' => [
        'is_slider' => '',
      ],
    ]);

    $widget->end_controls_section();


    //  Text Section
    $widget->start_controls_section(
      'content_section',
      [
        'label' => esc_html__( 'Main section', 'google-review' ),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );

    $widget->add_control(
      'title',
      [
        'type'    => \Elementor\Controls_Manager::SELECT,
        'label'   => esc_html__( 'Title', 'google-review' ),
        'options' => [
          'excellent' => esc_html__( 'Excellent', 'google-review' ),
          'good'      => esc_html__( 'Good', 'google-review' ),
          'average'   => esc_html__( 'Average', 'google-review' ),
          'poor'      => esc_html__( 'Poor', 'google-review' ),
        ],
        'default' => 'excellent',
      ]
    );

    $widget->add_control(
      'extend_button_text',
      [
        'type' => \Elementor\Controls_Manager::TEXT,
        'label' => esc_html__( 'Title for extend button', 'google-review' ),
        'placeholder' => esc_html__( 'Enter your title', 'google-review' ),
        'default'=> esc_html__( 'Read more', 'google-review' ),
      ]
    );

    $widget->add_control(
      'reduce_button_text',
      [
        'type' => \Elementor\Controls_Manager::TEXT,
        'label' => esc_html__( 'Title for reduce button', 'google-review' ),
        'placeholder' => esc_html__( 'Enter your title', 'google-review' ),
        'default'=> esc_html__( 'Hide', 'google-review' ),
      ]
    );

    $widget->add_control(
      'stars',
      [
        'type' => \Elementor\Controls_Manager::NUMBER,
        'label' => esc_html__( 'Stars', 'google-review' ),
        'min' => 3,
        'max' => 5,
        'step' => 0.5,
        'default' => 5,
      ]
    );

    $widget->add_control(
      'text_section_color',
      [
        'label' => esc_html__( 'Text color', 'google-review' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .google-text--container ' => 'color: {{VALUE}}',
        ],
        'default' => '#000',
      ]
    );

    $widget->add_control(
      'background_color',
      [
        'label' => esc_html__( 'Background color', 'google-review' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .review-widget' => 'background-color: {{VALUE}}',
        ],
      ]
    );

    $widget->add_control(
      'text',
      [
        'type' => \Elementor\Controls_Manager::WYSIWYG,
        'label' => esc_html__( 'Text under stars', 'google-review' ),
        'placeholder' => esc_html__( 'Based on __ reviews', 'google-review' ),
        'default'=>esc_html__( 'Based on __ reviews', 'google-review' ),
      ]
    );



    $widget->end_controls_section();

    /* start repeater */
    $widget->start_controls_section(
      'section_content',
      [
        'label' => esc_html__( 'Reviews', 'google-review' ),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );

    $widget->add_control(
      'list',
      [
        'label' => esc_html__( 'Reviews', 'google-review' ),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => [
          [
            'name' => 'text',
            'label' => esc_html__( 'Author Full name', 'google-review' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'placeholder' => esc_html__( 'Jon Smith', 'google-review' ),
            'default' => esc_html__( 'Jon Smith', 'google-review' ),
            'label_block' => true,
          ],
          [
            'name' => 'subtitle',
            'label' => esc_html__( 'Subtitle', 'google-review' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'placeholder' => esc_html__( '', 'google-review' ),
            'default' => esc_html__( '', 'google-review' ),
            'label_block' => true,
          ],
          [
            'name' => 'avatar_url',
            'label' => esc_html__( 'link to avatar', 'google-review' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'placeholder' => esc_html__( '', 'google-review' ),
            'default' => esc_html__( '', 'google-review' ),
            'label_block' => true,
          ],
          [
            'name' => 'link',
            'label' => esc_html__( 'Author Initial', 'google-review' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'placeholder' => esc_html__( 'J', 'google-review' ),
            'default' => esc_html__( 'J', 'google-review' ),
            'label_block' => true,
          ],
          [
            'name' => 'date',
            'label' => esc_html__( 'Date of published', 'google-review' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'placeholder' => '2024-03-05',
            'default' => '2024-03-05',
            'label_block' => true,

          ],
          [
            'name' => 'stars',
            'label' => esc_html__( 'Stars', 'google-review' ),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'min' => 3,
            'max' => 5,
            'step' => 0.5,
            'default' => 4,
          ],
          [
            'name' => 'review_description',
            'label' => esc_html__( 'Review', 'google-review' ),
            'type' => \Elementor\Controls_Manager::WYSIWYG,
            'default' => esc_html__( "'We chose _____ for our extensive kitchen renovation and floor refinishing project. James and team did an incredible job and we are thrilled with the result! During the planning stage, it was evident that James really listened to what we wanted from the project and what our priorities were. We lived in another area of the home while the reno was ongoing and we saw the level of detail and care that they took. The site was clean too. The work schedule and timeline were adhered to, good communication, and transparency with the budget. We highly recommend ____!'", 'google-review' ),
            'placeholder' => esc_html__( 'Type your review here', 'google-review' ),
          ],
        ],
        'title_field' => '{{{ text }}}',
        'default' => [
          [],[],[],[],
        ]
      ]
    );

    $widget->add_control(
      'items_color',
      [
        'label' => esc_html__( 'Color of review items', 'google-review' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .review-card' => 'background-color: {{VALUE}}',
        ],
      ]
    );

    $widget->add_control(
      'text_item_color',
      [
        'label' => esc_html__( 'Text color of review item', 'google-review' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .review-card' => 'color: {{VALUE}}',
        ],
        'default' => '#000',
      ]
    );

    $widget->add_control(
      'expand_button_color',
      [
        'label' => esc_html__( 'Color of expand/collapse button', 'google-review' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .review-card .review-card-btn' => 'color: {{VALUE}}',
        ],
      ]
    );



    $widget->add_control('hide_google_logo',
      [
        'label' => esc_html__('Hide google logo', 'google-review'),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => esc_html__('Yes', 'google-review'),
        'label_off' => esc_html__('No', 'google-review'),
        'return_value' => 'yes',
        'default' => 'no',
      ]
    );

    $widget->add_control('hide_review_date',
      [
        'label' => esc_html__('Hide review date', 'google-review'),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => esc_html__('Yes', 'google-review'),
        'label_off' => esc_html__('No', 'google-review'),
        'return_value' => 'yes',
        'default' => 'no',
      ]
    );

    $widget->end_controls_section();
    /* End repeater */
  }
}