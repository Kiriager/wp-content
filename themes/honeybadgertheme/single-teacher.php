<?php
    get_header();
    while(have_posts()){
        the_post();
    ?>
        
        <div class="headings">
            <h2 class = "page-header"><?php the_title(); ?></h2>
            <p class = "page-subtitle">PLACEHOLDER FOR DESCRIPTION OF A PAGE</p>
        </div>
    </header>
        
    <main class="page-main">
        <div class="page-position">
            <p>
                <a class="parent-link" href="<?php echo site_url('/our-team');?>">
                    <i class="fa fa-home"></i>
                    Our Team
                </a> 
                <span class="current-page-title">
                    <?php the_title(); ?>
                </span>
            </p>
        </div>

        <article class="post-item">
            <div class="post-content teacher-profile">
                <picture>
                    <source media="(max-width: 550px)"
                        srcset="<?php echo get_the_post_thumbnail_url(0, 'teacher_landscape'); ?>">
                    <img src="<?php echo get_the_post_thumbnail_url(0,'teacher_portrait');?>" 
                        alt="<?php the_title();?>">
                </picture>
                <?php
                    //the_post_thumbnail('teacher_portrait');
                    the_content(); 
                ?>
            </div>
        </article>
        <?php
        } 
        $related_programs = new WP_Query(
            array(
                'posts_per_page' => -1,
                'post_type' => 'program',
                /*'meta_key' => 'event_date', */
                //'orderby' => 'meta_value_num',
                //'order' => 'ASC',
                'meta_query' => array(
                    array(
                        'key' => 'related_teachers',
                        'compare' => 'LIKE',
                        'value' => '"'.get_the_ID().'"'
                    )
                )
            )
        );
        if($related_programs->have_posts()){
        ?>
            <section>
                <h3 class="post-section-heading">Teacher's programs</h3>
                <div class="gallery-cards">
                <?php
                    while($related_programs -> have_posts()){
                    $related_programs -> the_post();
                ?>   
                    <div class="program-card-post" style="background-image:url(<?php 
                        if(get_the_post_thumbnail()){
                            echo get_the_post_thumbnail_url(0, 'medium_large');
                        } else {
                            echo wp_get_attachment_image_src(88, 'medium_large')[0];
                        }
                    ?>);" >
                        <h3><?php the_title(); ?></h3>
                        <p>
                            <?php echo wp_trim_words(get_the_content(), 20); ?>
                        </p>
                        <div class="learn-more-btn">
                            <a href="<?php the_permalink(); ?>">Learn more</a>
                        </div>
                    </div>
                <?php   
                } wp_reset_postdata();
                ?>      
                </div>
            </section>
        <?php
        }
                ?>           
        </main>
    <?php    
    get_footer();
?>

