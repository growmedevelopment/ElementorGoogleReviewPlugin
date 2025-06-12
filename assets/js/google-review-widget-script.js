jQuery(window).on('elementor/frontend/init', function () {
  elementorFrontend.hooks.addAction('frontend/element_ready/google-review-widget.default', function ($scope) {
    const slider = $scope.find('.review-cards.--slider');

    // Initialize Slick Slider only if the slider exists
    if (slider.length) {
      let slidesToShow = parseInt(slider.attr('data-review-count'), 10) || 1;

      if (slider.hasClass('slick-initialized')) {
        slider.slick('unslick');
      }

      slider.on('init', function () {
        removeButtonButtons($scope);
        applyRandomColors($scope.find('.initial'), ['#ab47bc', '#00897b', '#8d6e63', '#ea4335', '#689f38']);
      });

      slider.slick({
        infinite: true,
        draggable: false,
        dots: true,
        arrows: false,
        autoplaySpeed: 2000,
        slidesToShow: 1,
        adaptiveHeight: true,
        prevArrow: `<button class="slick-arrow --prev"></button>`,
        nextArrow: `<button class="slick-arrow --next"></button>`,
        mobileFirst: true,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: slidesToShow,
              dots: false,
              arrows: true,
            },
          },
          {
            breakpoint: 900,
            settings: {
              slidesToShow: 2,
              dots: false,
              arrows: true,
            },
          },
          {
            breakpoint: 576,
            settings: {
              slidesToShow: 2,
            },
          },
        ],
      });
    }

    // ✅ These handlers now work for both sliders and static grid
    $scope.on('click', '.extend-button', function () {
      toggleReviewHeight(this, true);
    });

    $scope.on('click', '.reduce-button', function () {
      toggleReviewHeight(this, false);
    });

    // ✅ Re-check text overflow in all cards within this widget instance
    removeButtonButtons($scope);

    /**
     * Apply random colors to elements in the current scope
     */
    function applyRandomColors($elements, colors) {
      $elements.each(function () {
        jQuery(this).css('background-color', colors[Math.floor(Math.random() * colors.length)]);
      });
    }

    /**
     * Toggle review height on click
     */
    function toggleReviewHeight(button, expand) {
      const DEFAULT_HEIGHT = '130px';
      const ANIMATION_DURATION = 300;

      const parentCard = jQuery(button).closest('.review-card');
      const reviewTextElement = parentCard.find('.review-text');

      if (!reviewTextElement.length) return;

      const newHeight = expand ? `${reviewTextElement[0].scrollHeight + 10}px` : DEFAULT_HEIGHT;
      reviewTextElement.animate({ height: newHeight }, ANIMATION_DURATION);

      reviewTextElement.css({
        '-webkit-line-clamp': expand ? 'unset' : '6',
        '-webkit-box-orient': expand ? 'unset' : 'vertical',
      });

      parentCard.find('.extend-button').toggleClass('--hidden', expand);
      parentCard.find('.reduce-button').toggleClass('--hidden', !expand);
    }

    /**
     * Remove Extend/Reduce buttons if not needed
     */
    function removeButtonButtons($root) {
      $root.find('.review-card').each(function () {
        const $card = jQuery(this);
        const $text = $card.find('.review-text');
        const $extend = $card.find('.extend-button');
        const $reduce = $card.find('.reduce-button');

        if (!$text.length || !$extend.length || !$reduce.length) return;

        if ($text[0].clientHeight >= $text[0].scrollHeight) {
          $extend.remove();
          $reduce.remove();
        }
      });
    }
  });
});