<?php
/**
 * Template Name: Home Page
 *
 */

get_header();
?>

<style>
    #home-menu .menu-item:hover img {
        transform: scale(1.05);
    }
    #home-menu .menu-item:hover span {
        color: var(--primary);
    }
    #home-menu .menu-item {
        text-decoration: none;
        color: #212529;
        transition: all 0.3s ease;
    }
    .menu-product {
        gap: 20px;
    }
    .menu-item-wrapper {
        transition: all 0.3s ease;
        margin-bottom: 20px !important;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        border-radius: 10px;
        padding: 15px !important;
        background: #fff;
    }
    .menu-item-wrapper:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    .menu-img {
        border-radius: 8px;
        overflow: hidden;
    }
    @media (max-width: 768px) {
        .menu-item-wrapper {
            width: 100% !important;
            margin: 0 0 20px 0 !important;
        }
    }
</style>

<main id="home" class="site-main">
    <!-- Banner Section -->
    <?php get_template_part('template-parts/content','banner'); ?>
    
    <!-- About Section (Cockroach Brown) -->
    <section class="bg-cockroach">
        <?php get_template_part('template-parts/template','about'); ?>
    </section>
    
    <div class="section-divider"></div>
    
    <!-- Menu Section (Butter Yellow) -->
    <section id="home-menu" class="py-5 bg-butterscotch">
        <div class="container">
            <div class="section-title position-relative text-center mx-auto mb-5 pb-3" style="max-width: 600px;">
                <h2 class="text-dark font-secondary">Our Menu</h2>
                <h1 class="display-4 text-uppercase">Delicious Items</h1>
            </div>
            <?php
                $categories = get_terms(array(
                    'taxonomy' => 'product_cat',
                    'orderby' => 'id',
                    'order' => 'DESC',
                    'hide_empty' => 0,
                    'number' => 4 // Limit to 4 categories for home page
                ));
                
                if(!empty($categories)): ?>
                    <div class="menu-product">
                        <?php foreach($categories as $category):
                            $permalink = get_term_link($category->term_id);
                            $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                            $image_url = wp_get_attachment_url($thumbnail_id);
                            $image_alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
                        ?>
                            <div class="menu-item-wrapper" style="width: 280px; margin: 0 10px;">
                                <a href="<?php echo $permalink; ?>" class="menu-item d-block text-center">
                                    <div class="menu-img mb-3">
                                        <img src="<?php echo $image_url; ?>" alt="<?php echo $image_alt; ?>" class="img-fluid w-100" style="height: 220px; object-fit: cover; transition: transform 0.5s;">
                                    </div>
                                    <span class="h4 d-block font-weight-bold"><?php echo $category->name; ?></span>
                                    <div class="small text-muted mb-2">Explore our selection</div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="text-center mt-5">
                        <a href="<?php echo get_permalink(get_page_by_path('menu')); ?>" class="btn btn-primary btn-lg px-4 py-2">View Full Menu</a>
                    </div>
                <?php endif; ?>
        </div>
    </section>
    
    <div class="section-divider"></div>
    
    <!-- Recipe Section (Cockroach Brown) -->
    <section id="home-recipes" class="py-5 bg-cockroach">
        <div class="container">
            <div class="section-title position-relative text-center mx-auto mb-5 pb-3" style="max-width: 600px;">
                <h2 class="font-secondary">Our Recipes</h2>
                <h1 class="display-4 text-uppercase">Try It Yourself</h1>
            </div>
            
            <div class="row">
                <?php 
                $featured_recipes = new WP_Query(array(
                    'post_type' => 'recipe',
                    'posts_per_page' => 4,
                    'orderby' => 'date',
                    'order' => 'DESC'
                ));
                
                if ($featured_recipes->have_posts()) : 
                    while ($featured_recipes->have_posts()) : $featured_recipes->the_post();
                        $thumbnail = get_recipe_thumbnail(get_the_ID());
                        ?>
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="recipe-card h-100 border rounded overflow-hidden shadow-sm">
                                <div class="recipe-card-img">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php if ($thumbnail) : ?>
                                            <img src="<?php echo esc_url($thumbnail); ?>" alt="<?php the_title_attribute(); ?>" class="img-fluid w-100" style="height: 200px; object-fit: cover;">
                                        <?php else : ?>
                                            <div class="no-image-placeholder bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                                <span class="text-muted">No Image</span>
                                            </div>
                                        <?php endif; ?>
                                    </a>
                                </div>
                                <div class="p-3">
                                    <h3 class="h5 mb-2">
                                        <a href="<?php the_permalink(); ?>" class="text-dark text-decoration-none"><?php the_title(); ?></a>
                                    </h3>
                                    <div class="mb-3 small">
                                        <?php echo wp_trim_words(get_the_excerpt(), 10); ?>
                                    </div>
                                    <a href="<?php the_permalink(); ?>" class="btn btn-sm btn-primary">View Recipe</a>
                                </div>
                            </div>
                        </div>
                    <?php 
                    endwhile;
                    wp_reset_postdata();
                endif; 
                ?>
            </div>
            
            <div class="text-center mt-4">
                <a href="<?php echo get_permalink(get_page_by_path('recipe')); ?>" class="btn btn-primary">View All Recipes</a>
            </div>
        </div>
    </section>
    
    <div class="section-divider"></div>
</main>

<?php
get_footer();