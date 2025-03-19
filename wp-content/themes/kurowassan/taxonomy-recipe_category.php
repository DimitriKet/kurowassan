<?php
/**
 * The template for displaying recipe category archives
 *
 * @package kurowassan
 */

get_header();

// Get current category
$current_category = get_queried_object();
?>

<div class="recipe-category-archive py-5">
    <div class="container">
        <div class="recipe-header text-center mb-5">
            <h1 class="category-title display-4"><?php echo esc_html($current_category->name); ?></h1>
            <?php if (!empty($current_category->description)) : ?>
                <div class="category-description mt-3">
                    <?php echo wpautop($current_category->description); ?>
                </div>
            <?php endif; ?>
            <div class="d-inline-block divider bg-primary mt-3"></div>
        </div>

        <div class="recipe-grid row">
            <?php
            if (have_posts()) :
                while (have_posts()) :
                    the_post();
                    
                    // Get recipe gallery images
                    $gallery_images = get_post_meta(get_the_ID(), '_recipe_gallery_images', true);
                    $gallery_images = $gallery_images ? explode(',', $gallery_images) : array();
                    $first_image_url = !empty($gallery_images) ? wp_get_attachment_image_url($gallery_images[0], 'medium') : '';
                    
                    // Use featured image if no gallery images
                    if (empty($first_image_url) && has_post_thumbnail()) {
                        $first_image_url = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                    }
                    ?>
                    <div class="col-md-6 col-lg-3 mb-4">
                        <div class="recipe-item position-relative">
                            <div class="recipe-img mb-3">
                                <a href="<?php the_permalink(); ?>">
                                    <?php if (!empty($first_image_url)) : ?>
                                        <img src="<?php echo esc_url($first_image_url); ?>" alt="<?php the_title_attribute(); ?>" class="img-fluid rounded">
                                    <?php else : ?>
                                        <div class="no-image-placeholder bg-light rounded" style="height: 200px; display: flex; align-items: center; justify-content: center;">
                                            <span>No Image</span>
                                        </div>
                                    <?php endif; ?>
                                </a>
                            </div>
                            <div class="recipe-content">
                                <h3 class="recipe-title h5">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                                <div class="recipe-excerpt">
                                    <?php the_excerpt(); ?>
                                </div>
                                <a href="<?php the_permalink(); ?>" class="btn btn-sm btn-outline-primary mt-2">View Recipe</a>
                            </div>
                        </div>
                    </div>
                    <?php
                endwhile;
                
                // Pagination
                echo '<div class="col-12 mt-4">';
                the_posts_pagination(array(
                    'mid_size' => 2,
                    'prev_text' => __('&laquo; Previous', 'kurowassan'),
                    'next_text' => __('Next &raquo;', 'kurowassan'),
                    'screen_reader_text' => ' ',
                    'class' => 'pagination justify-content-center',
                ));
                echo '</div>';
                
            else :
                echo '<div class="col-12"><div class="alert alert-info">No recipes found in this category.</div></div>';
            endif;
            ?>
        </div>
    </div>
</div>

<?php
get_footer();
?> 