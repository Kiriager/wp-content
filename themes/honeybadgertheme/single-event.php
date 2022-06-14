<?php
    get_header();
    while(have_posts()){
        the_post();
    ?>
        <div class="headings">
            <h2 class = "page-header"><?php the_title(); ?></h2>
            <p class = "page-subtitle"><?php the_field('page_banner_subtitle');?></p>
        </div>
    </header>
        
        <main class="page-main">
            <article>
                <header>
                    <div class="page-position">
                        <p>
                            <a class="parent-link" href="<?php echo get_post_type_archive_link('event');?>">
                                <i class="fa fa-home" aria-hidden="true"></i>
                                Events Home
                            </a> 
                            <span class="current-page-title">
                                <?php the_title(); ?>
                            </span>
                        </p>
                    </div>
                </header>
                <div class="generic-content">
                    <?php the_content(); ?>
                </div>
            </article>
            
        </main>


    <?php
    }
    get_footer();
?> 

