<?php 
/*
* Actions
*/
add_action( 'widgets_init','wp_call_register_sidebars');

function header_footer_santizer($input, $setting){
	$input = wp_unslash( $input );
	if ( ! is_array( $input ) ) {
        $input = json_decode( urldecode_deep( $input ), true );
    }
    $input = sanitize_text_field_deep( $input );
    return ($input);
}

function sanitize_text_field_deep($value, $html = false)
{
    if (!is_array($value)) {
        $value = wp_kses_post($value);
    } else {
        if (is_array($value)) {
            foreach ($value as $k => $v) {
                $value[$k] = sanitize_text_field_deep($v);
            }
        }
    }
    return $value;
}

function headerfooter_get_setting($name){
    global $levelupDefaultOptions;
    $default = '';
    if(isset($levelupDefaultOptions[$name])){
        $default = $levelupDefaultOptions[$name];
    }
    $value = get_theme_mod($name, $default);
    return $value;
}



function headerfooter_get_media($value, $size = null)
{

    if (empty($value)) {
        return false;
    }

    if (!$size) {
        $size = 'full';
    }
    // attachment_url_to_postid
    if (is_numeric($value)) {
        $image_attributes = wp_get_attachment_image_src($value, $size);
        if ($image_attributes) {
            return $image_attributes[0];
        } else {
            return false;
        }
    } elseif (is_string($value)) {
        $img_id = attachment_url_to_postid($value);
        if ($img_id) {
            $image_attributes = wp_get_attachment_image_src($img_id, $size);
            if ($image_attributes) {
                return $image_attributes[0];
            } else {
                return false;
            }
        }
        return $value;
    } elseif (is_array($value)) {
        $value = wp_parse_args($value, array(
            'id'   => '',
            'url'  => '',
            'mime' => ''
        ));

        if (empty($value['id']) && empty($value['url'])) {
            return false;
        }

        $url = '';

        if (strpos($value['mime'], 'image/') !== false) {
            $image_attributes = wp_get_attachment_image_src($value['id'], $size);
            if ($image_attributes) {
                $url = $image_attributes[0];
            }
        } else {
            $url = wp_get_attachment_url($value['id']);
        }

        if (!$url) {
            $url = $value['url'];
            if ($url) {
                $img_id = attachment_url_to_postid($url);
                if ($img_id) {
                    return wp_get_attachment_url($img_id);
                }
            }
        }

        return $url;
    }

    return false;
}



function wp_call_register_sidebars(){

     for( $i = 1; $i <= 5; $i++ ) {
            register_sidebar( array(
                /* translators: 1: Widget number. */
                'name'          => sprintf( __( 'Footer Sidebar %d', 'customify' ), $i ),
                'id'            => 'footer-widget-'.$i,
                'description'       => __( 'Add widgets here.', 'customify' ),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h4 class="widget-title">',
                'after_title'   => '</h4>',
            ) );
        }
}