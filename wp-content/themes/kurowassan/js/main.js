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

    // Recipe Gallery Upload
    jQuery(document).ready(function($) {
        // Upload Gallery Images
        $('.upload-gallery-images').on('click', function(e) {
            e.preventDefault();
            
            var frame = wp.media({
                title: 'Select Gallery Images',
                button: {
                    text: 'Add to Gallery'
                },
                multiple: true
            });

            frame.on('select', function() {
                var selection = frame.state().get('selection');
                selection.map(function(attachment) {
                    var imageUrl = attachment.get('sizes').thumbnail.url;
                    var imageId = attachment.get('id');
                    
                    var imageHtml = '<div class="gallery-image">' +
                        '<img src="' + imageUrl + '" alt="">' +
                        '<input type="hidden" name="recipe_gallery_images[]" value="' + imageId + '">' +
                        '<button type="button" class="remove-image">×</button>' +
                        '</div>';
                    
                    $('.recipe-gallery-images').append(imageHtml);
                });
            });

            frame.open();
        });

        // Remove Gallery Image
        $(document).on('click', '.remove-image', function() {
            $(this).parent('.gallery-image').remove();
        });
    });

    // Recipe Category Navigation
    jQuery(document).ready(function($) {
        // Smooth scroll to category sections
        $('.category-navigation .nav-link').on('click', function(e) {
            e.preventDefault();
            
            $('.category-navigation .nav-link').removeClass('active');
            $(this).addClass('active');
            
            var target = $(this).attr('href');
            $('html, body').animate({
                scrollTop: $(target).offset().top - 100
            }, 500);
        });
    });
})(jQuery);
