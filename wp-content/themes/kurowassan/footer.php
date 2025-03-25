<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package kurowassan
 */

?>
	<style>
        .footer-top {
            padding: 80px 0 40px;
        }
        .footer-bottom {
            padding: 20px 0;
            background-color: rgba(0,0,0,0.1);
        }
        .social-icons {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }
        .social-icons a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: var(--primary);
            color: var(--secondary) !important;
            transition: all 0.3s ease;
        }
        .social-icons a:hover {
            background-color: #fff;
            transform: translateY(-3px);
        }
        .footer-link {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 4px 0;
            transition: all 0.3s ease;
        }
        .footer-link:hover {
            color: var(--primary);
            transform: translateX(5px);
        }
        .footer-heading {
            position: relative;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .footer-heading:after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 50px;
            height: 3px;
            background-color: var(--primary);
        }
        .footer-logo img {
            max-width: 150px;
            margin-bottom: 15px;
        }
        .footer-contact p {
            margin-bottom: 5px;
            display: flex;
            align-items: center;
        }
        .footer-contact i {
            margin-right: 10px;
            color: var(--primary);
        }
        .copyright {
            text-align: center;
            margin: 0;
            font-size: 14px;
        }
	</style>

	<footer id="colophon" class="site-footer bg-secondary text-white">
		<div class="footer-top">
            <div class="container">
                <div class="row g-5">
                    <div class="col-lg-4 col-md-6">
                        <div class="footer-about">
                            <h4 class="text-white footer-heading">Croissant for u</h4>
                            <p>We provide the finest artisanal baked goods and pastries made with high-quality ingredients and traditional techniques. Taste the difference in every bite!</p>
                            <div class="social-icons">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                                <a href="#"><i class="fab fa-pinterest-p"></i></a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-6">
                        <h4 class="text-white footer-heading">Quick Links</h4>
                        <div class="d-flex flex-column">
                            <a class="footer-link" href="<?php echo home_url(); ?>">Home</a>
                            <a class="footer-link" href="<?php echo get_permalink(get_page_by_path('about')); ?>">About Us</a>
                            <a class="footer-link" href="<?php echo get_permalink(get_page_by_path('menu')); ?>">Our Menu</a>
                            <a class="footer-link" href="<?php echo get_permalink(get_page_by_path('recipe')); ?>">Recipes</a>
                            <a class="footer-link" href="<?php echo get_permalink(get_page_by_path('contact')); ?>">Contact Us</a>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-6">
                        <h4 class="text-white footer-heading">Contact Us</h4>
                        <div class="footer-contact">
                            <p><i class="fas fa-map-marker-alt"></i> Street 59 Ward 14 Go Vap District Ho Chi Minh City</p>
                            <p><i class="fas fa-phone-alt"></i> +1 234 567 8900</p>
                            <p><i class="fas fa-envelope"></i> info@croissantforu.com</p>
                            <p><i class="fas fa-clock"></i> Mon-Sat: 7AM - 7PM | Sunday: 8AM - 5PM</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <div class="container">
                <p class="copyright">
                    &copy; <?php echo date('Y'); ?> Croissant For U. All Rights Reserved. 
                    <span class="small">Designed with <i class="fas fa-heart text-primary"></i> by Kurowassan</span>
                </p>
            </div>
        </div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

<!-- Javascript -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<!-- Owl Carousel JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

</body>
</html>
