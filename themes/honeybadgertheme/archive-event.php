
<?php
    get_header();
?>
 <div class="headings">
            <h2 class = "page-header">
                <?php 
                    if(is_tax('event_type')) {
                        echo "&#35;";
                        single_term_title();
                        echo " Events"; 
                    }
                        else echo "All Events";?>
            </h2>
            <div class="page-subtitle">Don't miss our interesting events!</div>
        </div>
        
    </header>


<main class="page-main">
    <?php
        while(have_posts()){
        the_post();
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
                <?php 
                    /*$event_cats = get_the_category(); 
                   // echo get_the_tag_list('', ', ');
                   echo get_the_term_list(get_the_id(), 'event_type', '', ', ');
                    /*foreach ($event_cats as $cat_name) {
                        ?>
                            <a href="<?php echo site_url('/events-categories');?>"><?php echo $cat_name->name ?></a> 
                        <?php
                    }*/

                ?>
            </p>
        </div> 
    </div>    

    <?php   
    }
    echo paginate_links();
    ?>
        <hr>
        <p>Look through our 
            <a href="<?php echo site_url('/past-events'); ?>"> past events </a> .</p>
        </main>
    <?php
    
    get_footer();
?>