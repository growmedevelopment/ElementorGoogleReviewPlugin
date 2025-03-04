jQuery(window).on('elementor/frontend/init', function () {
  elementorFrontend.hooks.addAction('frontend/element_ready/google-review-widget.default', function ($scope) {

    const slider = $scope.find('.review-cards');
    if (!slider.length) return; // Exit if no slider found

    let slidesToShow = parseInt(slider.attr('data-review-count'), 10) || 1; // Ensure it's a number

    // Remove existing Slick instance before re-initializing (to prevent duplicate init)
    if (slider.hasClass('slick-initialized')) {
      slider.slick('unslick');
    }

    slider.on('init', function () {
      removeButtonButtons();
      applyRandomColors('.initial', ['#ab47bc', '#00897b', '#8d6e63', '#ea4335', '#689f38']);
    });

    // Initialize Slick Slider
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

    // Attach event listeners efficiently using event delegation
    $scope.on('click', '.extend-button', function () {
      toggleReviewHeight(this, true);
    });

    $scope.on('click', '.reduce-button', function () {
      toggleReviewHeight(this, false);
    });

    /**
     * Apply random colors to elements
     * @param {string} selector - CSS selector
     * @param {string[]} colors - Array of hex color codes
     */
    function applyRandomColors(selector, colors) {
      jQuery(selector).each(function () {
        jQuery(this).css('background-color', colors[Math.floor(Math.random() * colors.length)]);
      });
    }

    /**
     * Toggle review height when clicking expand/reduce buttons
     * @param {HTMLElement} button - Clicked button
     * @param {boolean} expand - Whether to expand or collapse
     */
    function toggleReviewHeight(button, expand) {
      const DEFAULT_HEIGHT = '130px';
      const ANIMATION_DURATION = 300;

      const parentCard = jQuery(button).closest('.review-card');
      const reviewTextElement = parentCard.find('.review-text');

      if (!reviewTextElement.length) return;

      // Adjust height based on action
      const newHeight = expand ? `${reviewTextElement[0].scrollHeight + 10}px` : DEFAULT_HEIGHT;
      reviewTextElement.animate({ height: newHeight }, ANIMATION_DURATION);

      if (expand) {
        reviewTextElement.css({
          '-webkit-line-clamp': 'unset',
          '-webkit-box-orient': 'unset'
        });
      } else {
        reviewTextElement.css({
          '-webkit-line-clamp': '6',
          '-webkit-box-orient': 'vertical'
        });
      }

      // Toggle buttons visibility
      parentCard.find('.extend-button').toggleClass('--hidden', expand);
      parentCard.find('.reduce-button').toggleClass('--hidden', !expand);
    }

    /**
     * Remove unnecessary Extend/Reduce buttons if text fits
     */
    function removeButtonButtons() {
      jQuery('.review-card').each(function () {
        const textContainer = jQuery(this).find('.review-text');
        const extendButton = jQuery(this).find('.extend-button');
        const reduceButton = jQuery(this).find('.reduce-button');

        if (!textContainer.length || !extendButton.length || !reduceButton.length) return;

        if (textContainer[0].clientHeight >= textContainer[0].scrollHeight) {
          extendButton.remove();
          reduceButton.remove();
        }
      });
    }
  });
});