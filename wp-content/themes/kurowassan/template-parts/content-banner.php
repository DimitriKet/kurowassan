<?php
    $banner_title = get_field('banner_title');
    $banner_subtitle = get_field('banner_subtitle');
    $banner_description = get_field('banner_description');
    $read_more = get_field('read_more');
    $banner_image = get_field('banner_image');
    $banner_image_2 = get_field('banner_image_2');
?>
<section id="banner" >
    <div class="container-fluid">
        <div class="owl-carousel banner-carousel">
            <div class=""><img src="<?php echo $banner_image_2['url']; ?>" alt="" style="height: 720px;"></div>
            <div class=""><img src="<?php echo $banner_image['url']; ?>" alt="" style="height: 720px;"></div>
        </div>
    </div>
    <div class="container banner-content">
        <div class="row justify-content-start">
            <div class="col-lg-8 text-center text-lg-start">
                <div class="title font-secondary display-3 font-weight-bold mb-4"><?php echo $banner_title ;?></div>
                <div class="subtitle display-1 mb-4"><?php echo $banner_subtitle ;?></div>
                <p class="desc display-3"><?php echo $banner_description ;?></p>
                <a href="#" class="readmore">
                    
                </a>
            </div>
        </div>
    </div>
</section>