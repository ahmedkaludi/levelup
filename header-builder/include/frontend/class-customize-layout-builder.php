<?php

/**
 * Add Panel Builder to WP Customize
 *
 * Class Customify_Customize_Layout_Builder
 */
class HeaderFooter_Customize_Layout_Builder {
    static $_instance;
    private $registered_items = array();
    private $registered_builders = array();

    /**
     * Initial
     */
    function init() {

        do_action( 'header_footer/customize-builder/init' );

        if ( is_admin() ) {
            add_action( 'customize_controls_enqueue_scripts', array( $this, 'scripts' ) );
            add_action( 'customize_controls_print_footer_scripts', array( $this, 'template' ) );
            add_action( 'wp_ajax_customify_builder_save_template', array( $this, 'ajax_save_template' ) );
            add_action( 'wp_ajax_customify_builder_export_template', array( $this, 'ajax_export_template' ) );
        }

    }

    /**
     * Register builder panel
     *
     * @see Customify_Customize_Builder_Panel
     *
     * @param $id string                                ID of panel
     * @param $class Customify_Customize_Builder_Panel  Panel class name
     * @return bool
     */
    function register_builder( $id, $class ) {
        if ( ! isset( $id ) ) {
            return false;
        }

        if ( ! is_object( $class ) ) {
            if ( ! class_exists( $class ) ) {
                return false;
            }

            $class = new $class();
        }

        if ( ! $class instanceof Customify_Customize_Builder_Panel ) {
            $name = get_class( $class );
            _doing_it_wrong( $name, sprintf( __( 'Class <strong>%s</strong> do not extends class <strong>Customify_Customize_Builder_Panel</strong>.', 'customify' ), $name ), '1.0.0' );
            return false;
        }

        add_filter( 'header_footer/customizer/config', array( $class, '_customize' ), 35, 2 );
        $this->registered_builders[ $id ] = $class;
    }


    /**
     * Add an item builder to panel
     *
     * @see Customify_Customize_Layout_Builder::register_builder();
     *
     * @param $builder_id string        Id of panel
     * @param $class      object        Class to handle this item
     * @return bool
     */
    function register_item( $builder_id, $class ) {
        if ( ! $builder_id ) {
            return false;
        }

        if ( is_object( $class ) ) {

        } else {
            if ( ! class_exists( $class ) ) {
                return false;
            }
            $class = new $class();
        }

        if ( ! isset( $this->registered_items[ $builder_id ] ) ) {
            $this->registered_items[ $builder_id ] = array();
        }
        $this->registered_items[ $builder_id ][ $class->id ] = $class;

        return true;

    }

    /**
     * Get all items for builder panel
     *
     * @param $builder_id string        Id of panel
     * @return array|mixed|void
     */
    function get_builder_items( $builder_id ) {
        if ( ! $builder_id ) {
            return apply_filters( 'header_footer/builder/' . $builder_id . '/items', array() );
        }
        if ( ! isset( $this->registered_items[ $builder_id ] ) ) {
            return apply_filters( 'header_footer/builder/' . $builder_id . '/items', array() );
        }
        $items = array();
        foreach ( $this->registered_items[ $builder_id ] as $name => $obj ) {
            if ( method_exists( $obj, 'item' ) ) {
                $item                 = $obj->getFields();
                $items[ $item['id'] ] = $item;
            }
        }
        $items = apply_filters( 'header_footer/builder/' . $builder_id . '/items', $items );

        return $items;
    }

    /**
     * Get all customize settings of all items for builder panel
     *
     * @param $builder_id string        Id of panel
     * @param null $wp_customize        WP Customize
     * @return array|bool
     */
    function get_items_customize( $builder_id, $wp_customize = null ) {
        if ( ! $builder_id ) {
            return false;
        }
        if ( ! isset( $this->registered_items[ $builder_id ] ) ) {
            return false;
        }
        $items = array();
        foreach ( $this->registered_items[ $builder_id ] as $name => $obj ) {
            if ( method_exists( $obj, 'customize' ) ) {
                $item = $obj->customize( $wp_customize );
                if ( is_array( $item ) ) {
                    //$items = array_merge( $items, $item );
                    foreach( $item as $it ) {
                        $items[] = $it;
                    }

                }

            }
        }

        return $items;
    }

    /**
     * Get a builder item for builder panel
     *
     * @param $builder_id   string        Id of panel
     * @param $item_id      string        Builder item id
     * @return bool
     */
    function get_builder_item( $builder_id, $item_id ) {
        if ( ! $builder_id ) {
            return false;
        }
        
        if ( ! isset( $this->registered_items[ $builder_id ] ) ) {
            return false;
        }

        if ( ! isset( $this->registered_items[ $builder_id ][ $item_id ] ) ) {
            return false;
        }

        return $this->registered_items[ $builder_id ][ $item_id ];
    }

   

    
    static function get_instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    

}