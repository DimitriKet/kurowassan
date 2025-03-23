<?php 
    $title_web = get_bloginfo('name');
    $title = get_the_title();

    $title_content = get_field('title');
    $subtitle_content = get_field('subtitle');
    $image = get_field('image');
    $about_page_link = get_permalink(get_page_by_path('about'));
?>
<section id="about" class="py-5">
    <div class="container">
        <div class="section-title position-relative text-center mx-auto mb-5 pb-3" style="max-width: 600px;">
            <h2 class="font-secondary">About Us</h2>
            <h1 class="display-4 text-uppercase"><?php echo esc_html($title_web); ?></h1>
        </div>
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="position-relative overflow-hidden rounded shadow">
                    <?php if($image): ?>
                        <img class="img-fluid w-100" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($title_web); ?>" style="object-fit: cover; height: 450px;">
                    <?php else: ?>
                        <img class="img-fluid w-100" src="<?php echo get_template_directory_uri(); ?>/images/placeholder.jpg" alt="<?php echo esc_attr($title_web); ?>" style="object-fit: cover; height: 450px;">
                    <?php endif; ?>
                    <div class="position-absolute start-0 bottom-0 w-100 py-3 px-4" style="background: rgba(0, 0, 0, 0.5);">
                        <h4 class="text-white mb-0">Tradition Since 2010</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <h2 class="mb-4"><?php echo esc_html($title_content ? $title_content : 'Our Story'); ?></h2>
                <p class="lead mb-4"><?php echo esc_html($subtitle_content ? $subtitle_content : 'We are passionate about creating delicious and healthy food experiences for our customers.'); ?></p>
                
                <div class="row g-4 mb-4">
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 bg-light rounded-circle p-3 me-3 d-flex align-items-center justify-content-center" style="width: 64px; height: 64px;">
                                <i class="fa fa-leaf fa-2x text-success"></i>
                            </div>
                            <div>
                                <h5 class="mb-1">Fresh Ingredients</h5>
                                <p class="mb-0 small">We source only the freshest ingredients for our dishes</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 bg-light rounded-circle p-3 me-3 d-flex align-items-center justify-content-center" style="width: 64px; height: 64px;">
                                <i class="fa fa-award fa-2x text-warning"></i>
                            </div>
                            <div>
                                <h5 class="mb-1">Quality Service</h5>
                                <p class="mb-0 small">Our customer service is our top priority</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 bg-light rounded-circle p-3 me-3 d-flex align-items-center justify-content-center" style="width: 64px; height: 64px;">
                                <i class="fa fa-utensils fa-2x text-danger"></i>
                            </div>
                            <div>
                                <h5 class="mb-1">Expert Chefs</h5>
                                <p class="mb-0 small">Our team of professional chefs creates amazing dishes</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 bg-light rounded-circle p-3 me-3 d-flex align-items-center justify-content-center" style="width: 64px; height: 64px;">
                                <i class="fa fa-cheese fa-2x text-primary"></i>
                            </div>
                            <div>
                                <h5 class="mb-1">Authentic Recipes</h5>
                                <p class="mb-0 small">Our recipes are authentic and carefully crafted</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <?php if($about_page_link): ?>
                    <a href="<?php echo esc_url($about_page_link); ?>" class="btn btn-primary px-4 py-2">Read More</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>