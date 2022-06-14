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
        <div class="page-position">
            <p>
                <a class="parent-link" href="<?php echo site_url('/programs');?>">
                    <i class="fa fa-home"></i>
                    Programs Home
                </a> 
                <span class="current-page-title">
                   
                    <?php the_title(); ?>
                </span>
            </p>
        </div>

        <article class="post-item">
            <div class="post-content">
                <?php 
                    the_content(); 
                    $relatedTeachers = get_field('related_teachers');
                    //print_r($relatedTeachers);
                ?> 
                <section>
                    <h3 class="post-section-heading">Teachers on this program</h3>
                    <div class="gallery-cards">
                <?php
                    foreach ($relatedTeachers as $teacher) {
                        ?> 
                            <div class="teacher-card">
                                <a href="<?php echo get_the_permalink($teacher); ?>">
                                    <img 
                                        src="<?php echo get_the_post_thumbnail_url($teacher, 'teacher_landscape');?>" 
                                        alt="<?php echo get_the_title($teacher); ?>">
                                    <span class="teacher-name">
                                        <?php echo get_the_title($teacher); ?>    
                                    </span>
                                </a>
                            </div>                           
                        <?php
                    }  
                ?>
                </div>
                </section>
            </div>
        </article>    
            
        </main>


    <?php
    }
    get_footer();
?>

