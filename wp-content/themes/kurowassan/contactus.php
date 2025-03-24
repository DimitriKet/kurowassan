<?php
/**
 * Template Name: Contact Us Page
 * 
 * @package kurowassan
 */

get_header();
?>

<div id="contact">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="contact-form">
                    <form id="contact-form" method="post">
                        <div class="form-group mb-4">
                            <label for="name">Full Name</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        <div class="form-group mb-4">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group mb-4">
                            <label for="message">Message</label>
                            <textarea id="message" name="message" class="form-control" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn-contact">Send Message</button>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="contact-info">
                    <h2>KUROWASSAN</h2>
                    <div class="info-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <p>Street 59, Ward 14, District Go Vap, HCM</p>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-envelope"></i>
                        <p>info@kurowassan.com</p>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-phone-alt"></i>
                        <p>0909 123 456 (08:00 AM – 05:00 PM)</p>
                        <p>0909 123 456 (07:00 AM – 10:00 PM)</p>
                    </div>
                    <div class="social-links">
                        <h3>Follow Us</h3>
                        <div class="social-icons">
                            <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="social-icon"><i class="fab fa-youtube"></i></a>
                            <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="map-section mt-5">
    <div class="map-container">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.7862835786414!2d106.68573807460377!3d10.830066489321426!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317528f4a62c4d1d%3A0xc99902aa1e26ef02!2zNTkgxJDGsOG7nW5nIHPhu5EgMTQsIFBoxrDhu51uZyAxNCwgR8OyIFbhuqVwLCBUaMOgbmggcGjhu5EgSOG7kyBDaMOtIE1pbmgsIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1710400411943!5m2!1svi!2s" 
            width="100%" 
            height="450" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
</div>

<?php get_footer(); ?>