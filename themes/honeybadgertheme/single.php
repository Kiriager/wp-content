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
                <a class="parent-link" href="<?php echo site_url('/blog');?>">
                    <i class="fa fa-home" ></i>
                    Blog Home
                </a> 
                <span class="current-page-title">
                    Posted by <?php the_author_posts_link(); ?> on 
                    <time datetime="<?php the_time('Y-n-j'); ?>">
                        <?php the_time('j.n.y');  ?>    
                    </time> in
                    <?php echo get_the_category_list(', '); ?>
                </span>
            </p>
        </div>

        <article class="post-item">
            <div class="post-content">
                <?php the_content(); ?>
            </div>
        </article>    
            
        </main>


    <?php
    }
    get_footer();
?>