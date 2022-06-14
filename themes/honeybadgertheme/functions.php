<?php
    function hb_files(){
        wp_enqueue_style('hb_main_styles', get_stylesheet_uri()/*'/wp-content/themes/honeybadgertheme/style.css'*/);
        /*wp_enqueue_style('font-awsome',  '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');*/
        wp_enqueue_script('font-awsome', 'https://kit.fontawesome.com/89e8d497c2.js');
        //wp_enqueue_script('font-awsome', 'https://kit.fontawesome.com/89e8d497c2.js', NULL, 1.0, true );
    }
    add_action('wp_enqueue_scripts','hb_files');
    function hb_featers(){
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_image_size('teacher_landscape', 400, 260, true);
        add_image_size('teacher_portrait', 480, 660, true);
        //add_image_size('program_background');
    }

    add_action('after_setup_theme','hb_featers');

    function adjust_query($query){
       // echo "hello form adjust query function";
        //print_r($query);
        $today = date('Ymd');
        
      if(!is_admin() && is_post_type_archive('event') && $query->is_main_query()){
            $query -> set('meta_key', 'event_date');
            $query -> set('orderby', 'meta_value_num');
            $query -> set('order', 'ASC');
            $query -> set('meta_query', array(
                'key' => 'event_date',
                'compare' => '>=',
                'value' => $today,
                'type' => 'numeric'
            ));
        }

        if(!is_admin() && is_tag() && $query->is_main_query()){
            $query -> set('post_type', 'event');
        }//редагуємо запит для архіву по тегах
    }
    
    add_action('pre_get_posts', 'adjust_query');

    function print_teacher_card(){
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
    }
   /*
    function school_post_types(){
        register_post_type(
            'event', array(
                'public' => true,
                'menu_icon' => 'dashicons-calendar',
                'labels' => array(
                    'name' => 'Events'
                )
            )
        );
    }
    add_action('init', 'school_post_types');
    
   */
    
?>
