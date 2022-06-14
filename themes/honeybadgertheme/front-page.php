<?php 
    get_header(); ?>
        <div class="headings front">
            <p class = "page-header">Welcome!</p>
            <p class = "page-subtitle">Learning with patient is always awarded.<p>
        </div>
    
    </header>
    <div class="main-container">
        <section class="main-events">
            <div class="content-area">
                <h2 class>Upcoming Events</h2>
                <?php 
                    $today = date('Ymd');
                    $two_events = new WP_Query(
                        array(
                            'posts_per_page' => 2,
                            'post_type' => 'event',
                            'meta_key' => 'event_date',
                            'orderby' => 'meta_value_num',
                            'order' => 'ASC',
                            'meta_query' => array(
                                array(
                                    'key' => 'event_date',
                                    'compare' => '>=',
                                    'value' => $today,
                                    'type' => 'numeric'
                                )
                            )
                        )
                    );

                    while($two_events->have_posts()){
                        $two_events->the_post();
                        ?>
                        <div class="event-summary">
                            <a class="event-summary-date" href="<?php the_permalink(); ?>">
                                <span class="event-summary-month">
                                    <?php 
                                        $month = strtotime(get_field('event_date'));
                                        //var_dump($month);
                                        $month = date('M', $month);
                                        echo $month;
                                    ?>
                                </span>
                                <span class="event-summary-day">
                                    <?php 
                                        $event_date = strtotime(get_field('event_date'));
                                        $event_date = date('d',$event_date);
                                       // var_dump($event_date);
                                        echo $event_date;
                                    ?>
                                </span>
                            </a>
                            <div class="event-summary-content">
                                <h5 class="event-summary-title">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h5>
                                <p><?php 
                                    if(has_excerpt())
                                        the_excerpt(); 
                                    else
                                        echo wp_trim_words(get_the_content(), 16);
                                    ?> 
                                    <a href="<?php the_permalink(); ?>" class="read-more-link">
                                        Read more
                                    </a>
                                </p>
                            </div> 
                        </div>
                        <?php
                    } wp_reset_postdata();
                ?>
                <div class="learn-more-btn events-btn">
                    <a href="
                        <?php echo site_url('/events'); ?>
                        " >View All Events
                    </a>
                </div>
            </div>
        </section>
        <!-- -->
        <section class="front-blogs">
            <div class="content-area">
                <h2>From Our Blogs</h2>
                <?php 
                    /*class*/
                    $two_posts = new WP_Query(
                        array(
                            'posts_per_page' => 2
                        )
                    );

                    while($two_posts->have_posts()){
                        $two_posts->the_post(); ?>
                        <div class="event-summary">
                            <a class="event-summary-date" href="<?php the_permalink(); ?>">
                                <span class="event-summary-month"><?php the_time('M'); ?></span>
                                <span class="event-summary-day"><?php the_time('d'); ?></span>
                            </a>
                            <div class="event-summary-content">
                                <h5 class="event-summary-title">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h5>
                                <p>
                                    <?php 
                                        if(has_excerpt())
                                            the_excerpt(); 
                                        else
                                            echo wp_trim_words(get_the_content(), 16);
                                    ?> 
                                    <a href="<?php the_permalink(); ?>" class="read-more-link">
                                        Read more
                                    </a>
                                </p>
                            </div>
                        </div>
                        <?php
                    } wp_reset_postdata();
                ?>           
                <div class="learn-more-btn">
                    <a href="
                        <?php echo site_url('/blog'); ?>
                    ">View All Blog Posts</a>
                </div>
            </div>   
        </section>
        
    <?php
    /*
    while(have_posts()){
        the_post(); ?> 
        <h2> <a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a></h2>
        <?php
        the_content();
    }*/

    ?> 
    </div>
            <section class="programs-gallery"
                style="background-image:url( <?php 
                    echo get_theme_file_uri('/images/programs_gallery_background.jpg') 
                ?>)" >
                <h2>Look Through Our Programs</h2>
                <div class="gallery-cards">
                <?php 
                    $three_programs = new WP_Query(array(
                        'post_type' => 'program',
                        'posts_per_page' => 3,
                        'orderby'=>'menu_order',
                        'order' => 'ASC'
                    ));
                    while($three_programs -> have_posts()){
                        $three_programs -> the_post();
                        ?> 
                            <div class="program-card">
                                <h3><?php the_title(); ?></h3>
                                <p><?php
                                echo wp_trim_words(get_the_content(), 20);
                                ?>
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
   
    get_footer();
?>