
<?php 
    function school_post_types(){
        /*register_post_type(
            'event', array(
                'show_in_rest' => true,
                'supports' => array('title', 'excerpt', 'editor'),
                'rewrite' => array('slug' => 'events'),
                'has_archive' => true, 
                'public' => true,
                'menu_icon' => 'dashicons-calendar',

                'labels' => array(
                    'name' => 'Events',
                    'add_new_item' => 'Add New Event',
                    'edit_item' => 'Edit Event',
                    'all_items' => 'All Events',
                    'singular_name' => 'Event'
                )
            )
        );*/
        register_post_type(
            'event', array(
                'show_in_rest' => true,
                'supports' => array('title', 'excerpt', 'editor'),
                'taxonomies' => array('event_type'),
                'rewrite' => array('slug' => 'events'),
                'has_archive' => true, 
                'public' => true,
                'menu_icon' => 'dashicons-calendar',

                'labels' => array(
                    'name' => 'Events',
                    'add_new_item' => 'Add New Event',
                    'edit_item' => 'Edit Event',
                    'all_items' => 'All Events',
                    'singular_name' => 'Event'
                )
            )
        );


        register_post_type(
            'teacher', array(
                'show_in_rest' => true,/**/ 
                'supports' => array('title', 'thumbnail', 'editor'),
                'rewrite' => array('slug' => 'teachers'),
                //'has_archive' => true, 
                'public' => true,
                'menu_icon' => 'dashicons-welcome-learn-more',

                'labels' => array(
                    'name' => 'Teachers',
                    'add_new_item' => 'Add New Teacher',
                    'edit_item' => 'Edit Teacher',
                    'all_items' => 'All Teachers',
                    'singular_name' => 'Teacher'
                )
            )
        );

        register_post_type(
            'program', array(
                'show_in_rest' => true,/**/ 
                'supports' => array('title', 'excerpt', 'editor', 'thumbnail', 'page-attributes'),
                'rewrite' => array('slug' => 'programs'),
                'has_archive' => true,
                'public' => true,
                'menu_icon' => 'dashicons-welcome-write-blog',

                'labels' => array(
                    'name' => 'Programs',
                    'add_new_item' => 'Add New Program',
                    'edit_item' => 'Edit Program',
                    'all_items' => 'All Programs',
                    'singular_name' => 'Program'
                )
            )
        );

        register_post_type(
            'contact_message', array(
                'show_in_rest' => true,/**/ 
                'supports' => array('title', 'editor'),
                
                //'has_archive' => true,
                'public' => true,
                'publicly_queryable' => false,
                'exclude_from_search' => true,
                'menu_icon' => 'dashicons-email',

                'labels' => array(
                    'name' => 'Contact messages',
                    'add_new_item' => 'Add New Contact message',
                    'edit_item' => 'Edit Contact message',
                    'all_items' => 'All Contact messages',
                    'singular_name' => 'Contact message'
                )
            )
        );

    }

    add_action('init', 'school_post_types');

   /* function edit_tags(){
        unregister_taxonomy_for_object_type('post_tag', 'post');
        register_taxonomy_for_object_type('post_tag', 'event');
    }
    add_action('init', 'edit_tags');*/

    function school_taxonomies(){
        $labels = array(
            'name'              => _x( 'Event Types', 'taxonomy general name', 'textdomain' ),
            'singular_name'     => _x( 'Event Type', 'taxonomy singular name', 'textdomain' ),
            'search_items'      => __( 'Search Event Types', 'textdomain' ),
            'all_items'         => __( 'All Event Types', 'textdomain' ),
            'parent_item'       => __( 'Parent Event Type', 'textdomain' ),
            'parent_item_colon' => __( 'Parent Event Type:', 'textdomain' ),
            'edit_item'         => __( 'Edit Event Type', 'textdomain' ),
            'update_item'       => __( 'Update Event Type', 'textdomain' ),
            'add_new_item'      => __( 'Add New Event Type', 'textdomain' ),
            'new_item_name'     => __( 'New Event Type Name', 'textdomain' ),
            'menu_name'         => __( 'Event Type', 'textdomain' ),
        );
     
        $args = array(
            'hierarchical'      => false,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'show_in_rest'      => true
        );
     
        register_taxonomy( 'event_type', array( 'event' ), $args );
    }
    add_action('init', 'school_taxonomies');
?>
    