<?php
//Sync Designs

//Sync Constants
define( 'LEVELUP_SERVER_URL', 'http://levelup.magazine3.company' );
define( 'LEVELUP_API_url', LEVELUP_SERVER_URL.'/wp-json/' );
define( 'LEVELUP_SYNC_VERSION_URL', LEVELUP_API_url.'elementor_design_layout/v1/get-elementor-version' );
define( 'LEVELUP_SYNC_DESIGN_URL', LEVELUP_API_url.'elementor_design_layout/v1/get-elementor-designs' );
define( 'LEVELUP_API_VALIDATE', LEVELUP_API_url.'elementor_design_layout/v1/api_key' );


add_action('admin_enqueue_scripts', 'levelup_sync_script');

function levelup_sync_script($hook){
    if ('elementor_page_levelup_settings' != $hook) {
        return;
    }
    wp_register_script('levelup_sync_script', LEVELUP__FILE__URI . '/assets/js/levelup-sync.js', [ 'jquery' ], false, true );

    wp_localize_script( 'levelup_sync_script', 'levelup_sync_object',
                array( 'ajax_url' => admin_url( 'admin-ajax.php' ),
                ) );
    wp_enqueue_script('levelup_sync_script');
}


add_action( 'wp_ajax_levelup_update_design_library',  'levelup_update_design_library' );
function levelup_update_design_library($is_first_install=false){
    $settings = get_option('levelup_library_settings');
    $response = wp_remote_post( LEVELUP_SYNC_DESIGN_URL,array(
                                    'timeout'=> 120,
                                    'body'=>array(
                                        'api_key'   =>  $settings['api_key']
                                    )
                                )
                            );
    if ( !is_array( $response ) ) {
        if($is_first_install){ return true; }
        echo json_encode(array("status"=>400, "message"=>'cannot connect to server'));
        wp_die();
    }
  
    $status = $responseData = $metaData = '';
    $responseData = json_decode($response['body'],true);
    if($responseData['status']!='200'){
        if($is_first_install){ return true; }
        echo json_encode(array("status"=>400, "message"=>'Server response not accurate Try again'));
        wp_die();
    }

    //Check current loaded Version 
    $current_loaded_version = get_option( 'levelup-library-loaded-version',0);
    if($current_loaded_version != 0&& version_compare($current_loaded_version, $responseData['current_version']['version_detail'], '>=') ){
        if($is_first_install){ return true; }
        echo json_encode(array("status"=>200, "message"=>'design already up to date'));
        wp_die();
    }

            
        levelup_default_designs($responseData);
        
        $current_version = update_option( 'levelup-library-loaded-version',$responseData['current_version']['version_detail']);
        if($is_first_install){
            update_option( 'levelup-library-loaded-version', $responseData['current_version']['version_detail']);
            return true; //If first installation called 
        }else{
            echo json_encode(array("status"=>200, "message"=>'Design inserted Successfully'));
            wp_die();
        }
}

function levelup_default_designs($responseData){
    $post_type = levelup_basics_config('post_type');
    $taxonomy = levelup_basics_config('taxonomy');
    global $wpdb;
    $result = $wpdb->query( 
            $wpdb->prepare("
                DELETE posts,pt,pm
                FROM wp_posts posts
                LEFT JOIN wp_term_relationships pt ON pt.object_id = posts.ID
                LEFT JOIN wp_postmeta pm ON pm.post_id = posts.ID
                WHERE posts.post_type = %s
                ", 
                $post_type
            ) 
    );
    $wpdb->prepare( "DELETE FROM {$wpdb->term_taxonomy} WHERE taxonomy = %s", array($taxonomy) );
    foreach( $responseData['designs'] as $widgetType => $valCategory ){
            foreach( $valCategory['layouts'] as $key => $valDesigntype ){
                $designType = $key;
                $post_id = wp_insert_post(array('post_title'=> $valDesigntype['title'],
                                             'post_type'=>$post_type, 
                                            'post_status'  => 'publish',
                                             'post_content'=>'Design Layouts with markup and css')

                                        );
                wp_set_object_terms( $post_id, array(
                                                'name'=>$valCategory['name'],
                                                'slug'=>$valCategory['slug'],
                                                    ), $taxonomy );
                $metaData = array();
                // Check folder permission and define file location
                $amp_html_markup = array('amp_html'=>$valDesigntype['amp_template_html'],
                                        'amp_css'=>$valDesigntype['amp_template_css']
                                    );
                $non_amp_html_markup = array('non_amp_html'=>$valDesigntype[
                    'non_amp_template_html'],
                                        'non_amp_css'=>$valDesigntype['non_amp_template_css']
                                    );
                update_post_meta( $post_id, 'amp_html_markup', $amp_html_markup );
                update_post_meta( $post_id, 'non_amp_html_markup', $non_amp_html_markup );
                update_post_meta( $post_id, 'design_unique_name', $valDesigntype['design_unique_name'] );
                update_post_meta( $post_id, 'design_preview_url', (isset($valDesigntype['design_preview_url'])? $valDesigntype['design_preview_url']: '') );
                update_post_meta( $post_id, 'design_feature_image_url', (isset($valDesigntype['designImage'])? $valDesigntype['designImage']: '') );


                

            }
        }//Foreach closed
        return true;
}

add_action( 'admin_init',  'levelup_on_activation_call' );
function levelup_on_activation_call(){
    if(get_option('levelup_default_designs_load')!== 'true'){
        //Default designs
        $responseData = '';
        if ($fh = fopen(LEVELUP__DIR__PATH.'/inc/designlib/layout.json', 'r')) {
            while (!feof($fh)) {
               $responseData .= fgets($fh);
            }
            fclose($fh);
        }
        $responseData = json_decode($responseData,true);
        levelup_default_designs($responseData);
        update_option('levelup-library-version', '0.1');
        update_option('levelup-library-loaded-version', '0.1');
        //Set flag for first time
        update_option('levelup_default_designs_load','true'); 
    }
}

add_action( 'wp_ajax_levelup_update_design_version',  'levelup_update_design_version' );

//update Version
function levelup_activation() {
    //Check layout 
    if (! wp_next_scheduled ( 'levelup_daily_event' )) {
    wp_schedule_event(time(), 'daily', 'levelup_daily_event');
    }
}
 add_action('levelup_daily_event', 'levelup_update_design_version');
function levelup_update_design_version(){
    $settings = get_option('levelup_library_settings');
    $message = "cannot connect to server";
    if(empty($settings['api_key'])){
        $message = "API key cannot be blank";
    }else{
        $response = wp_remote_post( LEVELUP_SYNC_VERSION_URL, array(
                                        'timeout'=> 120,
                                        'body'=>array(
                                                    'api_key'   =>  $settings['api_key']
                                                )
                                        )
                                    );
        if ( is_array( $response ) ) {
            $header = $response['headers']; // array of http header lines
            $body = $response['body']; // use the content
            $actualResponse = json_decode($body,true);
            if($actualResponse['status']==200){
                $current_version = get_option( 'levelup-library-version',0);
                if( version_compare($current_version, $actualResponse['version'], '>=') ){
                    $message = "current version is same";
                }else{
                    update_option( 'levelup-library-version',$actualResponse['version']);
                    $message = "Version Updated Successfully";
                }
            }
        }

    }
    if('development'==LEVELUP_ENVIRONEMT){
        echo json_encode(array("status"=>200,"message"=>$message));
        wp_die();
    }
}


//API KEY CHECK Before post
function levelup_call_api_registerd(){
    $settings = get_option('levelup_library_settings');
    if(isset( $settings['api_status']) &&  $settings['api_status']= 'valid'){ return '';  }
    $url    = LEVELUP_API_VALIDATE;
    $data   = array(
                   'body'=>array(
                                'site_url'  => site_url(),
                                'api_key'   =>  $settings['api_key']
                        )
                );
    $response = wp_remote_post( $url,$data);
    if(is_array($response)){
        $header = $response['headers']; // array of http header lines
        $body = $response['body']; // use the content
        $actualResponse = json_decode($body,true);
        if($actualResponse['status']==200){
            $settings['api_status'] = 'valid';
            update_option('levelup_library_settings',$settings);
            //On First Installation Sync all Designs
            levelup_update_design_library(true);
            if('development'!=LEVELUP_ENVIRONEMT){ //on production 
                levelup_activation();
            }
            return $actualResponse['message'];
        }else{
            return false;
        }
    }else{
        return false;
    }
}


add_action( 'wp_ajax_levelup_remove_key',  'levelup_remove_key' );
function levelup_remove_key(){
    delete_option('levelup_library_settings');
    delete_option('levelup-library-loaded-version');
    delete_option('levelup-library-version');
    //Remove schedule hook
    wp_clear_scheduled_hook( 'levelup_daily_event' ); 
    echo json_encode(array("status"=>200, "message" => "Successfully removed."));
    wp_die();
}