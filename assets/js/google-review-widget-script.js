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


    //extend( change height) to slide to show all text
    const extendButtons = jQuery('.extend-button');
    const reduceButtons = jQuery('.reduce-button')


    extendButtons.on('click', function () {

        const parentCard = jQuery(this).closest('.review-card')
        const reviewTextElement = parentCard.find('.review-text')
        const textElementHeight = reviewTextElement[0].scrollHeight + 10

        //set height for content
        reviewTextElement.css('height', `${textElementHeight}px`);
        // to hide extend button
        jQuery(this).addClass('--hidden')

        //to show reduce button
        parentCard.find('.reduce-button').removeClass('--hidden')
    })

    reduceButtons.on('click', function () {

        const parentCard = jQuery(this).closest('.review-card')
        const reviewTextElement = parentCard.find('.review-text')

        //set height for content
        reviewTextElement.css('height', '130px');

        // to hide reduce button
        jQuery(this).addClass('--hidden')

        //to show extend button
        parentCard.find('.extend-button').removeClass('--hidden')
    })

});