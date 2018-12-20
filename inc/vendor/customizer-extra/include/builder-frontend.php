<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    function header_panel_get_settings(){
     $value = get_theme_mod('header_panel_settings');
     return  $value;
    }
    function footer_panel_get_settings(){
     $value = get_theme_mod('footer_panel_settings');
     return  $value;
    }
	function header_footer_render( $row_ids = array( 'top', 'main', 'bottom' ) ) {
        $setting = $this->header_panel_get_settings();
        $items   = $this->render_items();
        foreach ( $row_ids as $row_id ) {
            $show = customify_is_builder_row_display( $this->id, $row_id );
            if ( $show && isset( $this->rows[ $row_id ] ) ) {
                $show_on_devices = $this->rows[ $row_id ];
                if ( ! empty( $show_on_devices ) ) {
                    $classes = array();
                    $_id     = sprintf( '%1$s-%2$s', $this->id, $row_id );

                    $classes[]     = $_id;
                    $classes[]     = $this->id . '--row';
                    $desktop_items = $this->get_row_settings( $row_id, 'desktop' );
                    $mobile_items  = $this->get_row_settings( $row_id, 'mobile' );
                    $atts          = array();
                    if ( ! empty( $desktop_items ) || ! empty( $mobile_items ) ) {

                        $align_classes = 'customify-grid-middle';
                        if ( $this->id != 'footer' ) {
                            if ( empty( $desktop_items ) ) {
                                $classes[] = 'hide-on-desktop';
                            }
                            if ( empty( $mobile_items ) ) {
                                $classes[] = 'hide-on-mobile hide-on-tablet';
                            }
                        } else {
                            $align_classes = 'customify-grid-top';
                        }

                        $row_layout = Customify()->get_setting( $this->id . '_' . $row_id . '_layout' );
                        $row_text_mode = Customify()->get_setting( $this->id . '_' . $row_id . '_text_mode' );
                        if ( $row_layout ) {
                            $classes[] = sanitize_text_field( $row_layout );
                        }

                        $classes = apply_filters( 'header_footer/builder/row-classes', $classes, $row_id, $this );

                        $atts['class']       = join( ' ', $classes );
                        $atts['id']          = 'cb-row--' . $_id;
                        $atts['data-row-id'] = $row_id;
                        $atts  = apply_filters( 'header_footer/builder/row-attrs', $atts, $row_id, $this );
                        $string_atts = '';
                        foreach ( $atts as $k => $s ) {
                            if ( is_array( $s ) ) {
                                $s = json_encode( $s );
                            }
                            $string_atts .= ' ' . sanitize_text_field( $k ) . '="' . esc_attr( $s ) . '" ';
                        }
                        if ($desktop_items) {
                            $html_desktop = $this->render_row($desktop_items, $row_id, 'desktop');
                        } else {
                            $html_desktop = false;
                        }
                        if ( $mobile_items ) {
                            $html_mobile = $this->render_row( $mobile_items, $row_id, 'mobile' );
                        } else {
                            $html_mobile = false;
                        }


                        // Row inner class
                        // Check if the row is header or footer.
                        $inner_class = array();
                        if ( $this->id == 'header' ) {
	                        $inner_class[] = 'header--row-inner';
                        } else {
	                        $inner_class[] = 'footer--row-inner';
                        }
                        $inner_class[] = $_id.'-inner';
                        if ( $row_text_mode ) {
                            $inner_class['row_text_mode'] = $row_text_mode;
                        }

                        $inner_class  = apply_filters( 'header_footer/builder/inner-row-classes', $inner_class, $row_id, $this );

                        if ( $html_mobile || $html_desktop ) {
                            ?>
                            <div <?php echo $string_atts; ?> data-show-on="<?php echo esc_attr(join(" ", $show_on_devices)); ?>">
                                <div class="<?php echo join( ' ', $inner_class ); ?>">
                                    <div class="customify-container">
                                        <?php
                                        if ($html_desktop) {

                                            if ( $html_desktop ) {
                                                $c = 'cb-row--desktop hide-on-mobile hide-on-tablet';
                                                if (empty($mobile_items)) {
                                                    $c = '';
                                                }
                                                echo '<div class="customify-grid ' . esc_attr($c . ' ' . $align_classes) . '">';
                                                echo $html_desktop;
                                                echo '</div>';
                                            }
                                        }

                                        if ($html_mobile) {
                                            echo '<div class="cb-row--mobile hide-on-desktop customify-grid ' . esc_attr($align_classes) . '">';
                                            echo $html_mobile;
                                            echo '</div>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                }
            }

        } // end for each row_ids
    }

    function render_row( $items, $id = '', $device = 'desktop' ) {
        $row_html    = '';
        $max_columns = 12;
        $items       = $this->_sort_items_by_position( array_values( $items ) );
        $last_item = false;
        $prev_item = false;
        $group_items = array();
        $gi          = 0;
        $n           = count( $items );
        $index       = 0;

        ob_start();

        while ( $index < $n ) {
            $item = $items[ $index ];

            if ( $gi < 0 ) {
                $gi = 0;
            }
            if ( $n > $index + 1 ) {
                $next_item = $items[ $index + 1 ];
            } else {
                $next_item = false;
            }

            $item_id    = $item['id'];
            $merge_key  = $this->id . '_' . $item_id . '_merge';
            $merge      = Customify()->get_setting( $merge_key, $device );
            $merge_next = false;
            $merge_prev = false;
            if ( $merge == 'no' || $merge == '0' ) {
                $merge = false;
            }

            if ( $next_item ) {
                $merge_key_next = $this->id . '_' . $next_item['id'] . '_merge';
                $merge_next     = Customify()->get_setting( $merge_key_next, $device );
            }

            if ( $merge_next == 'no' || $merge_next == '0' ) {
                $merge_next = false;
            }

            if ( $prev_item ) {
                $merge_prev = $prev_item['__merge'];
            }


            /*
            Increment group_index:
            a:
                n-1: = prev || no
                n = no || left
                n+1 = no || next
            b:
                n-1: = prev || no
                n = next
                n+1 = prev || no
            */
            if (
                ( ! $merge_prev || $merge_prev == 'prev' )
                && ( ! $merge || $merge == 'next' )
                && ( ! $merge_next || $merge_next == 'next' )
            ) {
                $gi ++;
            } elseif (
                ( ! $merge_prev || $merge_prev == 'prev' )
                && ( $merge == 'next' )
                && ( ! $merge_next || $merge_next == 'prev' )
            ) {
                $gi ++;
            }


            if ( ! isset( $group_items[ $gi ] ) ) {
                $group_items[ $gi ]            = $item;
                $group_items[ $gi ]['items']   = array();
                $group_items[ $gi ]['items'][] = $item;
            } else {
                $group_items[ $gi ]['width']   = ( $item['x'] + $item['width'] ) - $group_items[ $gi ]['x'];
                $group_items[ $gi ]['items'][] = $item;
            }

            $prev_item            = $item;
            $prev_item['__merge'] = $merge;

            if ( $index == 0 && ( ! $merge || $merge == 'prev' ) && ( ! $merge_next || $merge_next == 'next' ) ) {
                $gi ++;
            }


            $index ++;
        }

        $index = 0;
        $number_group_item = count( $group_items );
        foreach ( $group_items as $item ) {

            if ( isset( $items[ $index + 1 ] ) ) {
                $next_item = $items[ $index + 1 ];
            } else {
                $next_item = false;
            }

            $first_id = $item['id'];
            $x        = intval( $item['x'] );
            $width    = intval( $item['width'] );
            if ( ! $next_item ) {
                if ( $x + $width < $max_columns ) {
                    $width += $max_columns - ( $x + $width );
                }
            }

            $atts    = array();
            $classes = array();

            $number_item = count( $item['items'] );

            if ( $this->id != 'footer' ) {
                $classes[] = "customify-col-{$width}_md-{$width}_sm-{$width}";
            } else {
                if ( $number_group_item > 1 ) {
                    $classes[] = "customify-col-{$width}_md-{$width}_sm-6_xs-12";
                } else {
                    $classes[] = "customify-col-{$width}_md-{$width}_sm-12_xs-12";
                }

            }

            if ( $x > 0 ) {
                if ( ! $last_item ) {
                    $atts[] = 'off-' . $x;
                } else {
                    $o = intval( $last_item['width'] ) + intval( $last_item['x'] );
                    if ( $x - $o > 0 ) {
                        $atts[] = 'off-' . ( $x - $o );
                    }
                }
            }

            if ( $this->id == 'footer' ) {
                $atts[] = '_sm-0';
            }

            $classes[] = 'builder-item builder-first--' . $first_id;
            if ( count( $item['items'] ) > 1 ) {
                $classes[] = 'builder-item--group';
            }

            $classes = apply_filters( 'header_footer/builder/item-wrapper-classes', $classes, $item );
            $classes = join( ' ', $classes ); // customify-grid-middle

            $row_items_html = '';
            foreach ( $item['items'] as $_it ) {
                $item_id     = $_it['id'];
                $content     = $this->render_items[ $item_id ]['render_content'];
                if ( $content ) {
                    $item_config = isset($this->config_items[$item_id]) ? $this->config_items[$item_id] : array();
                    if (!isset($item_config['section'])) {
                        $item_config['section'] = '';
                    }
                    $item_classes = array();
                    $item_classes[] = 'item--inner';
                    $item_classes[] = 'builder-item--' . $item_id;
                    if ( strpos( $item_id, '-menu' ) ) {
                        $item_classes[] = 'has_menu';
                    }
                    if (is_customize_preview()) {
                        $item_classes[] = ' builder-item-focus';
                    }

                    $item_classes = join(' ', $item_classes); // customify-grid-middle
                    $row_items_html .= '<div class="' . esc_attr($item_classes) . '" data-section="' . $item_config['section'] . '" data-item-id="' . esc_attr($item_id) . '" >';
                    $row_items_html .= $this->setup_item_content($content, $id, $device);
                    if (is_customize_preview()) {
                        $row_items_html .= '<span class="item--preview-name">' . esc_html($item_config['name']) . '</span>';
                    }
                    $row_items_html .= '</div>';
                }
            }
            if ( $row_items_html ) {
                echo '<div class="' . esc_attr($classes) . '" data-push-left="' . join(' ', $atts) . '">';
                echo $row_items_html;
                echo '</div>';
            }

            $last_item = $item;
            $index ++;

        } // end loop items

        // Get item output
        $row_html = ob_get_clean();
        return $row_html;

    }

    /**
     * Render sidebar row
     */
    function render_mobile_sidebar() {
        $id           = 'sidebar';
        $mobile_items = $this->get_row_settings( $id, 'mobile' );
        $menu_sidebar_skin = Customify()->get_setting('header_sidebar_skin_mode');

        if ( ! is_array( $mobile_items ) ) {
            $mobile_items = array();
        }

        if ( ! empty( $mobile_items ) || is_customize_preview() ) {

            $classes = array( 'header-menu-sidebar menu-sidebar-panel' );
            if ( $menu_sidebar_skin != '' ) {
                $classes[] = $menu_sidebar_skin;
            }

            echo '<div id="header-menu-sidebar" class="' . esc_attr( join( ' ', $classes ) ) . '">';
            echo '<div id="header-menu-sidebar-bg" class="header-menu-sidebar-bg">';
            echo '<div id="header-menu-sidebar-inner" class="header-menu-sidebar-inner">';

            foreach ( $mobile_items as $item ) {
                $item_id     = $item['id'];
                $content     = $this->render_items[ $item['id'] ]['render_content'];
                $item_config = isset( $this->config_items[ $item_id ] ) ? $this->config_items[ $item_id ] : array();
                $item_config = wp_parse_args( $item_config, array(
                    'section' => '',
                    'name' => '',
                ) );

                $classes       = "builder-item-sidebar mobile-item--" . $item_id;
                if ( strpos( $item_id, 'menu' ) ) {
                    $classes  = $classes." mobile-item--menu " ;
                }
                $inner_classes = 'item--inner';
                if ( is_customize_preview() ) {
                    $inner_classes = $inner_classes . ' builder-item-focus ';
                }

	            $content = $this->setup_item_content( $content, $id, 'mobile' );
                //$content = str_replace( '__id__', $id, $content );
                //$content = str_replace( '__device__', 'mobile', $content );

                echo '<div class="' . esc_attr( $classes ) . '">';
                echo '<div class="' . esc_attr( $inner_classes ) . '" data-item-id="' . esc_attr( $item_id ) . '" data-section="' . $item_config['section'] . '">';
                echo $content;
                if ( is_customize_preview() ) {
                    echo '<span class="item--preview-name">' . esc_html( $item_config['name'] ) . '</span>';
                }
                echo '</div>';
                echo '</div>';
            }
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    }