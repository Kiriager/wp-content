
<?php
    get_header();
   
?>
 <div class="headings">
            <h2 class = "page-header">
                Past Events
            </h2>
            <p class="page-subtitle">A recap of our past events</parent>
        </div>
        
    </header>


<main class="page-main">
    <?php
        $today = date('Ymd');
        $past_events = new WP_Query(
            array(
                'paged' => get_query_var('paged', 1),
                'posts_per_page' => 2,
                'post_type' => 'event',
                'meta_key' => 'event_date', 
                'orderby' => 'meta_value_num',
                'order' => 'DSC',/**/
                'meta_query' => array(
                    array(
                        'key' => 'event_date',
                        'compare' => '<',
                        'value' => $today,
                        'type' => 'numeric'
                    )
                )
            )
        );
        while( $past_events -> have_posts()){
           
            $past_events -> the_post();
            
    ?> 
    <div class="event-summary">
        <a class="event-summary-date" href="<?php the_permalink(); ?>">
            <span class="event-summary-month">
                <?php 
                    $month = strtotime(get_field('event_date'));
                    $month = date('M', $month);
                    echo $month;
                ?>
            </span>
            <span class="event-summary-day">
                <?php 
                    $event_date = strtotime(get_field('event_date'));
                    $event_date = date('d',$event_date);
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
            <p><?php echo wp_trim_words(get_the_content(), 20); ?> 
                <a href="<?php the_permalink(); ?>" class="read-more-link">
                    Read more
                </a>
            </p>
        </div> 
    </div>    

    <?php   
    }
    echo paginate_links(array(
        'total' => $past_events->max_num_pages
    ));
    ?>
        </main>
    <?php
    
    get_footer();
?>