<?php
/**
 * Template part for displaying single recipe content
 *
 * @package kurowassan
 */

// Sử dụng function mới để lấy ảnh
$recipe_images = get_recipe_images(get_the_ID(), 'large');
?>

<div class="recipe-header mb-4">
    <h1 class="recipe-title display-4"><?php the_title(); ?></h1>
    <div class="recipe-meta d-flex flex-wrap align-items-center text-muted mb-3">
        <span class="me-3"><i class="far fa-calendar me-1"></i> <?php echo get_the_date(); ?></span>
    </div>
</div>

<?php if (!empty($recipe_images)) : ?>
<div class="recipe-gallery mb-5">
    <div class="row">
        <?php foreach ($recipe_images as $index => $image) : 
            if (!$image['url']) continue;
            
            // Featured image is larger
            if ($index === 0) : ?>
                <div class="col-12 mb-4">
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="img-fluid rounded">
                </div>
            <?php else : ?>
                <div class="col-md-4 mb-4">
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="img-fluid rounded">
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>
<?php endif; ?>

<div class="recipe-content">
    <?php the_content(); ?>
</div>

<div class="recipe-footer mt-5 pt-4 border-top">
    <div class="row">
        <div class="col-md-6">
            <?php
            // Previous recipe link
            $prev_post = get_previous_post();
            if (!empty($prev_post)) :
                ?>
                <div class="prev-recipe">
                    <span class="text-muted d-block mb-2"><?php _e('Previous Recipe', 'kurowassan'); ?></span>
                    <a href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>" class="h5">
                        <?php echo esc_html($prev_post->post_title); ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-md-6 text-md-end mt-3 mt-md-0">
            <?php
            // Next recipe link
            $next_post = get_next_post();
            if (!empty($next_post)) :
                ?>
                <div class="next-recipe">
                    <span class="text-muted d-block mb-2"><?php _e('Next Recipe', 'kurowassan'); ?></span>
                    <a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>" class="h5">
                        <?php echo esc_html($next_post->post_title); ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
// If comments are open or we have at least one comment, load up the comment template.
if (comments_open() || get_comments_number()) :
    comments_template();
endif;
?>
