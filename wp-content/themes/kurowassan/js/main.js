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

    // Re-initialize Product Slider with custom dots navigation
    $(document).ready(function(){
        // Remove any previous carousel initialization
        if ($('.product-slider').hasClass('owl-loaded')) {
            $('.product-slider').owlCarousel('destroy');
        }
        
        var productSlider = $('.product-slider');
        
        // Initialize with proper settings
        productSlider.owlCarousel({
            loop: true,
            margin: 30,
            nav: true,
            dots: false, // Disable default dots
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 2
                },
                768: {
                    items: 3
                },
                992: {
                    items: 4
                }
            },
            onInitialized: createCustomDots,
            onChanged: updateCustomDots
        });
        
        // Function to create custom dots
        function createCustomDots(event) {
            var itemCount = event.item.count;
            var customDotContainer = $('.custom-nav-dots');
            
            // Clear existing dots
            customDotContainer.empty();
            
            // Create custom dots
            for (var i = 0; i < itemCount; i++) {
                var activeDot = (i === 0) ? 'active' : '';
                customDotContainer.append('<span class="custom-dot ' + activeDot + '" data-position="' + i + '"></span>');
            }
            
            // Add click event to dots
            $('.custom-dot').on('click', function() {
                var position = $(this).data('position');
                productSlider.trigger('to.owl.carousel', [position, 300]);
            });
            
            // Add custom styles to dots container
            customDotContainer.css({
                'display': 'flex',
                'justify-content': 'center',
                'gap': '8px',
                'margin-top': '30px'
            });
            
            // Add custom styles to dots
            $('.custom-dot').css({
                'width': '12px',
                'height': '12px',
                'background-color': '#ddd',
                'border-radius': '50%',
                'display': 'inline-block',
                'cursor': 'pointer',
                'transition': 'all 0.3s ease'
            });
            
            // Active dot style
            $('.custom-dot.active').css({
                'background-color': '#f0e68c',
                'transform': 'scale(1.2)'
            });
        }
        
        // Function to update custom dots
        function updateCustomDots(event) {
            var currentIndex = event.item.index - event.relatedTarget._clones.length / 2;
            
            // Adjust index for loop
            var itemCount = event.item.count;
            currentIndex = (currentIndex % itemCount + itemCount) % itemCount;
            
            // Update active dot
            $('.custom-dot').removeClass('active').css({
                'background-color': '#ddd',
                'transform': 'scale(1)'
            });
            
            $('.custom-dot[data-position="' + currentIndex + '"]').addClass('active').css({
                'background-color': '#f0e68c',
                'transform': 'scale(1.2)'
            });
        }
    });

    // AJAX pagination functionality moved to ajax-pagination.js

})(jQuery);
