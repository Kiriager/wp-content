
<?php
    get_header();
?>
        <div class="headings">
            <h2 class = "page-header">
                <?php
                    the_archive_title(); 
                    /* if(is_category()){
                        single_cat_title();            }  
                    if(is_author()){
                        echo 'Posts by ';
                        the_author();
                    }*/
                ?>
            </h2>
            <div class="page-subtitle"> <?php the_archive_description();?></div>
        </div>  
    </header>


<main class="page-main">
    <div class="page-position">
        <p>
            <a class="parent-link" href="<?php echo site_url('/blog');?>">
                <i class="fa fa-home" aria-hidden="true"></i>
                Back to Blog Home
            </a> 
           <!--  <span class="current-page-title">
                Posted by <?php the_author_posts_link(); ?> on 
                <time datetime="<?php the_time('Y-n-j'); ?>">
                    <?php the_time('j.n.y');  ?>    
                </time> in
                <?php echo get_the_category_list(', '); ?>
            </span> -->
        </p>
    </div>

    <?php
        while(have_posts()){
        the_post();
    ?> 
   <article class="post-item">
        <header>
            <h2 class='post-title'><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <div class='post-meta'>
                Posted by <?php the_author_posts_link(); ?> on 
                    <time datetime="<?php the_time('Y-n-j'); ?>">
                        <?php the_time('j.n.y');  ?>    
                    </time> in
                    <?php echo get_the_category_list(', '); ?>
            </div>
        </header>
        <div class="post-content">
            <?php 
               // the_excerpt();
                
               echo "<p>". wp_trim_words(get_the_content(), 60). "</p>"; 
            ?>
        </div>
        <footer class="post-footer">
            <a href="<?php the_permalink(); ?>">Continue reading</a>
        </footer>
    </article>
    

    <?php   
    }
    echo paginate_links();
    ?>
        </main>
    <?php
    
    get_footer();
?>