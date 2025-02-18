
(function ($) {
    // Sticky Navbar
    $(window).scroll(function () {
        if ($(this).scrollTop() > 40) {
            $('#header').addClass('header-scrolled');
        } else {
            $('#header').removeClass('header-scrolled');
        }
    });
    
    // Dropdown on mouse hover
    $(document).ready(function () {
        function toggleNavbarMethod() {
            if ($(window).width() > 992) {
                $('.navbar .dropdown').on('mouseover', function () {
                    $('.dropdown-toggle', this).trigger('click');
                }).on('mouseout', function () {
                    $('.dropdown-toggle', this).trigger('click').blur();
                });
            } else {
                $('.navbar .dropdown').off('mouseover').off('mouseout');
            }
        }
        toggleNavbarMethod();
        $(window).resize(toggleNavbarMethod);
    });

    //Banner carousel
    $(document).ready(function(){
        $('.banner-carousel').owlCarousel({
            items: 1,
            margin: 45,
            loop: true,
            autoPlay: true,
        });
    });
    /*------------------
        Preloader
    --------------------*/
    $(window).on('load', function () {
        $(".loader").fadeOut();
        $("#preloader").delay(200).fadeOut("slow");

        /*------------------
            FIlter
        --------------------*/
        // $('.filter__controls li').on('click', function () {
        //     $('.filter__controls li').removeClass('active');
        //     $(this).addClass('active');
        // });
        // if ($('.filter__gallery').length > 0) {
        //     var containerEl = document.querySelector('.filter__gallery');
        //     var mixer = mixitup(containerEl);
        // }
    });
})(jQuery);
