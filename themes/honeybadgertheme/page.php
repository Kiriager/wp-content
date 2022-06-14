
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
            <?php $parent_id = wp_get_post_parent_id( get_the_ID()); ?>
            <?php
                $children_array = get_pages(
                    array(
                        'child_of' => get_the_ID()
                    )
                );
                if($parent_id || $children_array) {
            ?>
            
            <nav class="page-links">
                <h2 class="parent-title">
                    <a href="
                        <?php echo get_permalink($parent_id);?>
                    ">
                        <!--About Us-->
                        <?php 
                            echo get_the_title($parent_id);
                        ?>
                    </a>
                </h2>
                <ul> 
                    <?php 
                        
                        if($parent_id){
                            $children_of = $parent_id;
                        }else{
                            $children_of = get_the_ID();
                        }

                        wp_list_pages(
                            array(
                                'title_li' => NULL,
                                'child_of' => $children_of,
                                'sort_column' => 'menu_order'
                            )
                        );
                        
                    ?>
                    <!--
                    <li class="current-page-item"><a href="#">Our History</a></li>
                    <li><a href="#">Our Goals</a></li> -->
                </ul>
            </nav>
            <?php } ?>

            <?php
                
                if($parent_id){
                    ?>
                    <div class="page-position">
                        <p>
                            <a class="parent-link" href="<?php echo get_permalink($parent_id);?>">
                                <i class="fa-solid fa-home" aria-hidden="true"></i>
                                Back to <?php echo get_the_title($parent_id);?>
                            </a> 
                            <span class="current-page-title"><?php the_title(); ?></span>
                        </p>
                    </div>
                    <?php
                }
            ?>
            <div class="generic-content">
                <?php 
                    the_content();
                }
                ?>
            </div>
            <?php 
                if(is_page('our-team')){
                    $teachers = new WP_Query(
                        array(
                            'posts_per_page' => -1,
                            'post_type' => 'teacher'
                        )
                    );
            ?>
                <section>
                    <h3 class="post-section-heading">Let Us Introduce Our Teachers</h3>
                    <div class="gallery-cards">
                        <?php 
                            while($teachers -> have_posts()){
                                $teachers -> the_post();
                                ?>
                                <div class="teacher-card">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php 
                                            //the_post_thumbnail('teacher_landscape');?>
                                        <img 
                                            src="<?php echo get_the_post_thumbnail_url(0, 'teacher_landscape');?>" 
                                            alt="<?php echo get_the_title(0); ?>">
                                        
                                        <span class="teacher-name">
                                            <?php the_title(); ?>    
                                        </span>
                                    </a>
                                </div>
                                <?php
                               // print_teacher_card();/*my function*/
                            }
                            wp_reset_postdata();
                        ?>
                                                   
                    </div>
                </section>
            <?php
                }
            ?>
            
        </main>


    <?php
    //}

    get_footer();
?>

