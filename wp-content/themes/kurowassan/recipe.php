<?php
/**
 * Template Name: Recipe Page
 * 
 * @package kurowassan
 */

get_header();

// Không còn sử dụng recipe_category
?>

<div class="recipes-section py-5">
    <div class="container">
        <div id="all-recipes" class="mb-5">
            <h2 class="section-title position-relative mb-4">
                <span class="bg-white pe-3">All Recipes</span>
                <div class="section-title-line"></div>
            </h2>
            
            <div class="row">
                <?php 
                $all_recipes = new WP_Query(array(
                    'post_type' => 'recipe',
                    'posts_per_page' => 12,
                    'orderby' => 'date',
                    'order' => 'DESC'
                ));
                
                if ($all_recipes->have_posts()) : 
                    while ($all_recipes->have_posts()) : $all_recipes->the_post();
                        $thumbnail = get_recipe_thumbnail(get_the_ID());
                        ?>
                        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                            <div class="recipe-card h-100 border rounded overflow-hidden shadow-sm">
                                <div class="recipe-card-img position-relative">
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
                                <div class="recipe-card-body p-3">
                                    <h3 class="recipe-title h5 mb-3">
                                        <a href="<?php the_permalink(); ?>" class="text-dark text-decoration-none"><?php the_title(); ?></a>
                                    </h3>
                                    <div class="recipe-excerpt mb-3">
                                        <?php 
                                        if (has_excerpt()) {
                                            echo wp_trim_words(get_the_excerpt(), 15);
                                        } else {
                                            echo wp_trim_words(get_the_content(), 15);
                                        }
                                        ?>
                                    </div>
                                    <a href="<?php the_permalink(); ?>" class="btn btn-sm btn-outline-primary">View Recipe</a>
                                </div>
                            </div>
                        </div>
                    <?php 
                    endwhile;
                    wp_reset_postdata();
                else : 
                    echo '<div class="col-12 alert alert-info">No recipes found.</div>';
                endif; 
                ?>
            </div>
            
            <?php if ($all_recipes->max_num_pages > 1) : ?>
                <div class="text-center mt-4">
                    <a href="<?php echo esc_url(get_post_type_archive_link('recipe')); ?>" class="btn btn-primary">View All Recipes</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
get_footer();
?>