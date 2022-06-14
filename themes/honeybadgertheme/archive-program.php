
<?php
    get_header();
?>

    <div class="headings">
        <h2 class = "page-header">All Programs</h2>
        <p class = "page-subtitle">Look through our programs and choose an approptiate one for you.</p>
    </div>
</header>

<div class="main-blogs">
    <section class="programs-gallery" >
        <div class="gallery-cards post">
    <?php
        while(have_posts()){
        the_post();
    ?> 

        <div class="program-card-post" style="background-image:url(<?php 
            if(get_the_post_thumbnail()){
                echo get_the_post_thumbnail_url(0, 'medium_large');
            } else {
                //echo wp_get_attachment_image_src(36, 'medium_large')[0];
                echo get_theme_file_uri('/images/programs_cover.jpg');
            }
        ?>);">
            
            <h3><?php the_title(); ?></h3>
            <?php //print_r(wp_get_attachment_image_src(83, 'medium_large')); ?>
            <p>
                <?php echo wp_trim_words(get_the_content(), 20); ?>
            </p>
            <div class="learn-more-btn">
                <a href="<?php the_permalink(); ?>">Learn more</a>
            </div>
             
        </div>
    
    <?php   
    }
    ?>      </div>
    </section>
    <?php
        echo paginate_links();
    
    ?>
</div>
    <?php
    
    get_footer();
?>
