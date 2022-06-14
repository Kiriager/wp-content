<?php
/*
Plugin Name: Honey Badger Enroll Form
Plugin URI: _
Description: Education goals only
Version: 1.0
Author: Honey Badger
Author URI: _
*/
function enroll_form_settings_page(){//creating plugin settings page
    add_options_page('Enroll Form Plugin Settings','Enroll Form',//page heading, menu title
        'manage_options', 'enroll-form-settings', 'enroll_form_settings_html');//capability, slug, function
}

function enroll_form_settings_html(){//creating plugin settings page html
    
    ?><div id="enroll-form-settings-container">
        <h1> Enroll Form Plugin Settings</h1>
       
        <form action="options.php" method="POST">
            <?php
            settings_fields('enroll_form_settings_group');//hidden fields
            
            do_settings_sections('enroll-form-settings');//show fields par:page slug
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

add_action('admin_menu', 'enroll_form_settings_page');//creating plugin settings page

function enroll_form_settings(){
    add_settings_section('general_section', 'Enroll Form General Settings', 
    //id, title,callback function, page slug
        NULL, 'enroll-form-settings');//adding section of settings

    register_setting ('enroll_form_settings_group', 'enroll_form_title', //register setting
        array('sanitize_callback' => 'sanitize_text_field',
            'default' => 'Complete following form to enroll in classes'));

    add_settings_field('enroll_form_title', 'Form Title','enroll_form_title_html',
        'enroll-form-settings', 'general_section' );//creating a field for a title setting
    
    register_setting ('enroll_form_settings_group', 'enroll_form_program', //register setting
        array('sanitize_callback' => 'sanitize_text_field', /*CHECK IT*/
            'default' => '0'));
    add_settings_field('enroll_form_program', 'Program Select','enroll_form_program_html',
        'enroll-form-settings', 'general_section' );//creating a field for a title setting
    
    register_setting ('enroll_form_settings_group', 'enroll_form_test', //register setting
        array('sanitize_callback' => 'sanitize_text_field', /*CHECK IT*/
            'default' => '0'));
}
add_action('admin_init','enroll_form_settings');

function enroll_form_title_html(){//create html for title input
    ?>
        <input type="text" name="enroll_form_title" 
            value="<?php echo esc_attr(get_option('enroll_form_title')); ?>">
    <?php
}
function enroll_form_program_html(){//create html for location option list
    ?>
        <input type="checkbox" name="enroll_form_program" value = "1" 
            <?php checked(get_option('enroll_form_program'),'1'); ?>>
    <?php
}



add_action('admin_post_enroll', 'enroll_form_capture');//handling form
add_action('admin_post_nopriv_enroll', 'enroll_form_capture');//handling form for unauthorized users

add_action('get_footer', 'print_enroll_form');//printing form before footer

function print_enroll_form(){//creating form html
    if(get_post_type() === 'program' or is_front_page()){
    ?> 
    <section id="enroll-form">
        <h3 class="post-section-heading"><?php echo esc_html(get_option('enroll_form_title')); ?></h3>
        <form method="post" action="<?php 
            echo admin_url('admin-post.php');
        ?>">
            <input type="hidden" name="action" value="enroll">
            <label for="name">Name</label>
            <input type="text" name = "name" placeholder="Enter your full name"><br>

            <label for="email">Email<abbr title="required field">*</abbr></label>
            <input type="email" required name="email" placeholder="Enter your email"><br>

            <?php 
                if(get_option('enroll_form_program', '0') == 1){
                    $all_programs = new WP_Query(
                        array(
                            'posts_per_page' => -1,
                            'post_type' => 'program'
                        )
                    );
                    ?> 
                    <label for="program">Course you are interested in:</label><br>
                    <select name="program" id="program">
                        <option value="English"> I don't know, just want to learn English.</option>
                    <?php
                    while($all_programs -> have_posts()){
                        $all_programs -> the_post();
                        ?>
                            <option value="<?php echo esc_attr(get_the_title());?>">
                            <?php echo esc_attr(get_the_title());?>
                            </option>        
                        <?php
                    } wp_reset_postdata();
                    ?> </select><br> <?php
                }
            ?>
            <label for="comment">Comment</label><br>
            <textarea name="comment" id="comment" cols="50" maxlength="250"
                rows="5" placeholder="Enter your message here."></textarea><br>
            <input type="submit" name="enroll-submit" value="Send">
        </form>
    </section>
    <?php
    }
}

function enroll_form_capture(){

    $valid_data = true;
    if(isset($_POST['enroll-submit'] )){

        if(!empty($_POST['name'])) $name = sanitize_text_field($_POST['name']); 
        else $name = 'No Name - ' . rand(0, 1000);

        if(!isset($_POST['email'])){
            $valid_data = false;
        } else {
            $email = sanitize_email($_POST['email']);
            if(!$email) $valid_data = false;
        }

        if(isset($_POST['comment'])){
            $comment = sanitize_textarea_field($_POST['comment']);
            if(strlen($comment) > 250){
                $comment = substr($comment, 0, 250);
            }
        } else {
            $comment = "No comments";
        }

        if(isset($_POST['program'])){
            $program = sanitize_text_field($_POST['program']);
            $all_programs = new WP_Query(
                array(
                    'posts_per_page' => -1,
                    'post_type' => 'program'
                )
            );
            $flag = false;
            while($all_programs->have_posts()){
                $all_programs -> the_post();
                if($program === get_the_title()) $flag = true;
            }
            wp_reset_postdata();
            if($flag == false) $program = "English";
        } else {
            $program = "Not specified";
        }

        if($valid_data){
            $post_content = "Name: ".$name."<br>";
            $post_content .= "Email: ".$email."<br>";
            $post_content .= "Enroll in : ".$program."<br>";
            $post_content .= "Comment: ". $comment."<br>";
            
            $post_id = wp_insert_post(array (
                'post_content' => $post_content,
                'post_title' => $name . ' - ' . wp_date('d.m.y H:i'),
                'post_type' => 'contact_message',
                'post_status' => 'publish',
                'meta_input' => array(
                    'email' => $email
                )
            ));
            var_dump($post_content);
            echo wp_safe_redirect(site_url('/thank-you-page'));
            exit;
                
        } else {
            echo wp_safe_redirect(site_url('/invalid-data'));
            exit;
        }
     
    }
}


/*function cuIfNeeded($content){
    if(get_option('cu_location', '2') != 2 AND is_main_query() AND is_single()){
        return cuCreateHTML($content);
    }
    return $content;
}*/





/*function cuSettings(){
    add_settings_section('cu_first_section', 'General settings', null, 'cu-plugins-settings-page');//creating section of settings fields

    add_settings_field('cu_title', 'Form Title', 'cuTitleHTML', 'cu-plugins-settings-page', 'cu_first_section' );//creating a field for a setting
    register_setting ('cu_settings_group', 'cu_title', array('sanitize_callback' => 'sanitize_text_field', 'default' => 'Contact Us'));

    add_settings_field('cu_location', 'Display Location', 'cuLocationHTML', 'cu-plugins-settings-page', 'cu_first_section' );//creating a field for a setting
    register_setting ('cu_settings_group', 'cu_location', array('sanitize_callback' => 'cuSanitizeLocation', 'default' => '0'));
    
    add_settings_section('cu_second_section', 'Countact us form fields', null, 'cu-plugins-settings-page');//creating section of settings fields

    add_settings_field('cu_email_field', 'Email field:', 'cuEmailFieldHTML', 'cu-plugins-settings-page', 'cu_second_section' );//creating a field for a setting
    register_setting ('cu_settings_group', 'cu_email_field', array('sanitize_callback' => 'sanitize_text_field', 'default' => '0'));
    
    add_settings_field('cu_phone_field', 'Phone field:', 'cuPhoneFieldHTML', 'cu-plugins-settings-page', 'cu_second_section' );//creating a field for a setting
    register_setting ('cu_settings_group', 'cu_phone_field', array('sanitize_callback' => 'sanitize_text_field', 'default' => '0'));

    add_settings_section('cu_third_section', 'Countact us statistics', null, 'cu-plugins-settings-page');//creating section of settings fields

    add_settings_field('cu_emails_got', 'Number of got emails:', 'cuGotEmailsHTML', 'cu-plugins-settings-page', 'cu_third_section' );//creating a field for a setting
    add_option('cu_emails_got', 0);

}*/

/*function cuTitleHTML(){//create html for location option list
    ?>
        <input type="text" name = "cu_title" value = "<?php echo esc_attr(get_option('cu_title'))  ?>">
    <?php
}*/

/*function cuLocationHTML(){//create html for location option list
    ?>
    <select name = "cu_location">
        <option value = "0" <?php selected(get_option('cu_location'),'0') ?>>Beginning of posts</option>
        <option value = "1" <?php selected(get_option('cu_location'),'1') ?>>Ending of posts</option>
        <option value = "2" <?php selected(get_option('cu_location'),'2') ?>>Nowhere</option>
    </select>
    <?php
}*/

/*function cuGotEmailsHTML(){//create html for location option list
    ?>
        <?php 
            echo get_option('cu_emails_got');
        ?>
    <?php
}*/


/*function cuEmailFieldHTML(){//create html for location option list
    ?>
        <input type="checkbox" name="cu_email_field" value = "1" <?php checked(get_option('cu_email_field'),'1') ?>>
    <?php
}*/

/*function cuPhoneFieldHTML(){//create html for location option list
    ?>
        <input type="checkbox" name="cu_phone_field" value = "1" <?php checked(get_option('cu_phone_field'),'1') ?>>
    <?php
}*/


/*function cuSanitizeLocation($input){//processing new value of the location option before saving to database
    if($input < 0 OR $input > 2){
        add_settings_error('cu_location', 'cu_location_error', 'Display location must be one of list values.');
        return(get_option('cu_location'));
    }
    return $input;
}*/



/*function cuPluginAdminPage(){//creating plugin settings page
    add_options_page('Contuct Us Plugin Settings','Contact Us',
     'manage_options', 'cu-plugin-settings-page', 'cuSettingsPageHTML');
}*/

/*function cuSettingsPageHTML(){
    ?>
    <div class = "wrap">
        <h1> Contact Us Plugin Settings</h1>
        <form action="options.php" method="POST">
            <?php
            settings_fields('cu_settings_group');
            do_settings_sections('cu-plugins-settings-page');
            submit_button();
            ?>
        </form>
    </div> 
    <?php
}*/


