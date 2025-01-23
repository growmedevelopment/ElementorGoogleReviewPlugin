jQuery(window).on('elementor/frontend/init', () => {

    const slider = jQuery('.review-cards')

    slider.slick({
        infinite: true,
        draggable: false,
        autoplay: true,
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
                }
            },
            {
                breakpoint: 900,
                settings: {
                    slidesToShow: 2,
                    dots: false,
                    arrows: true,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 2,
                }
            },
        ]

    });

    // Predefined array of colors
    const colors = ['#ab47bc', '#00897b', '#8d6e63', '#ea4335', '#689f38'];

    // Function to get a random color from the array
    function getRandomColor() {
        return colors[Math.floor(Math.random() * colors.length)];
    }

    // Get all elements with the class 'initial'
    const boxes = document.querySelectorAll('.initial');

    // Loop through each box and set a random background color
    boxes.forEach(box => {
        box.style.backgroundColor = getRandomColor();
    });


    //helper function to extend( change height) slide to show all text
    const toggleReviewHeight = (button, expand) => {
        const DEFAULT_HEIGHT = '130px';
        const ANIMATION_DURATION = 300; // Duration in milliseconds

        const parentCard = jQuery(button).closest('.review-card');
        const reviewTextElement = parentCard.find('.review-text');

        // Adjust height based on action
        const newHeight = expand ? `${reviewTextElement[0].scrollHeight + 10}px` : DEFAULT_HEIGHT;
        reviewTextElement.animate({ height: newHeight }, ANIMATION_DURATION);

        // Toggle buttons visibility
        parentCard.find('.extend-button').toggleClass('--hidden', expand);
        parentCard.find('.reduce-button').toggleClass('--hidden', !expand);
    };

    // Handle extend button click
    jQuery('.extend-button').on('click', function () {
        toggleReviewHeight(this, true);
    });

    // Handle reduce button click
    jQuery('.reduce-button').on('click', function () {
        toggleReviewHeight(this, false);
    });


});