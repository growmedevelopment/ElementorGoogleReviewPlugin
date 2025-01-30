jQuery(window).on('elementor/frontend/init', () => {

  const slider = jQuery('.review-cards')

  slider.on('init', function () {
    removeButtonButtons()
    applyRandomColors('.initial',
      ['#ab47bc', '#00897b', '#8d6e63', '#ea4335', '#689f38'])
  })

  slider.slick({
    infinite: true,
    draggable: false,
    // autoplay: true,
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
          slidesToShow: 3,
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

  })

  // Attach event listeners efficiently using event delegation
  document.addEventListener('click', function (event) {
    if (event.target.classList.contains('extend-button')) {
      toggleReviewHeight(event.target, true)
    }
    if (event.target.classList.contains('reduce-button')) {
      toggleReviewHeight(event.target, false) // Fixed incorrect true value here
    }
  })

  //helper function to make all author icon circles with different colors from color range
  function applyRandomColors (selector, colors) {
    document.querySelectorAll(selector).forEach(box => {
      box.style.backgroundColor = colors[Math.floor(
        Math.random() * colors.length)]
    })
  }

  //helper function to extend( change height) slide to show all text
  function toggleReviewHeight (button, expand) {
    const DEFAULT_HEIGHT = '130px'
    const ANIMATION_DURATION = 300 // Duration in milliseconds

    const parentCard = jQuery(button).closest('.review-card')
    const reviewTextElement = parentCard.find('.review-text')

    // Adjust height based on action
    const newHeight = expand
      ? `${reviewTextElement[0].scrollHeight + 10}px`
      : DEFAULT_HEIGHT
    reviewTextElement.animate({ height: newHeight }, ANIMATION_DURATION)

    // Toggle buttons visibility
    parentCard.find('.extend-button').toggleClass('--hidden', expand)
    parentCard.find('.reduce-button').toggleClass('--hidden', !expand)
  }

  // Remove all Extend/Reduce buttons if text fits within the container
  function removeButtonButtons () {
    document.querySelectorAll('.review-card').forEach((slide) => {
      const textContainer = slide.querySelector('.review-text')
      const extendButton = slide.querySelector('.extend-button')
      const reduceButton = slide.querySelector('.reduce-button')

      if (!textContainer || !extendButton || !reduceButton) {
        return
      } // Avoid errors if elements are missing

      if (textContainer.clientHeight >= textContainer.scrollHeight) {
        extendButton.remove()
        reduceButton.remove()
      }
    });
  }

});