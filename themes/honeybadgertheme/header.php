<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset='<?php bloginfo('charset');  ?>'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php 
            wp_head();
        ?>
    </head>
    <body>
        <header id="main-header" 
            style="background-image:url( 
                <?php 
                    if(is_front_page()){
                        echo get_theme_file_uri('/images/banner.jpg');
                    } else {
                        echo get_theme_file_uri('/images/page_banner.jpg');
                    }

                ?>)" >
            <div id="main-header-top">
                <h1>
                    <a href="<?php echo site_url()?>"> <strong>Key</strong> Language School</a>
                </h1>
                <i class="fas fa-bars"></i>
                <nav id="main-navigation">
                    
                    <a href="<?php echo site_url('/about-us')?>"
                        <?php 
                            if(is_page('about-us') or wp_get_post_parent_id(0)==5 ) 
                                echo 'class="current-menu-item"';
                        ?>>
                            About Us
                    </a>
                    <a href="<?php echo site_url('/programs')?>"
                        <?php if(get_post_type() == 'program') echo 'class="current-menu-item"';?>
                        >Programs</a>
                    <a href="<?php echo get_post_type_archive_link('event'); ?>"
                        <?php if(get_post_type() == 'event' || is_page('past-events')) echo 'class="current-menu-item"';?> 
                    >Events</a></li>
                    <a href="<?php echo site_url('/blog')?>"
                        <?php if(get_post_type() == 'post') echo 'class="current-menu-item"';?>
                    >Blog</a></li>
                                    
                </nav>
            
            </div>
           


                   <!-- <div class="site-header__util">
                        <a href="#" class="btn btn--small btn--orange float-left push-right">Login</a>
                        <a href="#" class="btn btn--small btn--dark-orange float-left">Sign Up</a>
                        <span class="search-trigger js-search-trigger"><i class="fa fa-search" aria-hidden="true"></i></span>
                    </div> -->
          
        <!-- </header> -->
