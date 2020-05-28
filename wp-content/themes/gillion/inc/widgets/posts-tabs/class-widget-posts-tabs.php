<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

class Widget_Posts_Tabs extends WP_Widget {

    /**
     * Widget constructor.
     */
    private $options;
    private $prefix;
    function __construct() {

        $widget_ops = array( 'description' => esc_html__( 'Show your posts tabs', 'gillion' ) );
        parent::__construct( false, esc_html__( 'Shufflehound Posts Tabs', 'gillion' ), $widget_ops );
        $this->options = array(

            'id' => array( 'type' => 'unique' ),

            'tab_latest' => array(
                'type' => 'text',
                'label' => esc_html__('Latest tab name', 'gillion'),
                'value' => '',
                'desc'  => esc_html__('Leave blank for "Latest"', 'gillion'),
            ),

            'tab_popular' => array(
                'type' => 'text',
                'label' => esc_html__('Popular tab name', 'gillion'),
                'value' => '',
                'desc'  => esc_html__('Leave blank for "Popular"', 'gillion'),
            ),

            'style' => array(
                'type'  => 'select',
                'value' => 'style1',
                'label' => esc_html__('Style', 'gillion'),
                'desc'  => esc_html__('Select post slider style', 'gillion'),
                'choices' => array(
                    'style1' => esc_html__('Style 1 (list)', 'gillion'),
                    'style2' => esc_html__('Style 2 (slide, vertical)', 'gillion'),
                    'style2 style3' => esc_html__('Style 3 (slide, square)', 'gillion'),
                ),
            ),

        );
        $this->prefix = 'online_support';
    }

    function widget( $args, $instance ) {
        extract( $args );
        $params = array();

        foreach ( $instance as $key => $value ) {
            $atts[ $key ] = $value;
        }

        $filepath = get_template_directory().'/inc/widgets/posts-tabs/views/widget.php';

        $instance = $atts;
        $before_widget = str_replace( 'class="', 'class="widget_facebook ', $before_widget );

        if ( file_exists( $filepath ) ) {
            require $filepath;
        }
    }

    function update( $new_instance, $old_instance ) {
        return fw_get_options_values_from_input(
            $this->options,
            FW_Request::POST(fw_html_attr_name_to_array_multi_key($this->get_field_name($this->prefix)), array())
        );
    }

    function form( $values ) {

        $prefix = $this->get_field_id($this->prefix);
        $id = 'fw-widget-options-'. $prefix;

        echo '<div class="fw-force-xs fw-theme-admin-widget-wrap" id="'. esc_attr($id) .'">';
        echo fw()->backend->render_options($this->options, $values, array(
            'id_prefix' => $prefix .'-',
            'name_prefix' => $this->get_field_name($this->prefix),
        ));
        echo '</div>';
        $this->print_widget_javascript($id);

        return $values;
    }

    private function print_widget_javascript($id) {
        ?><script type="text/javascript">
            jQuery(function($) {
                var selector = '#<?php echo esc_js($id) ?>', timeoutId;

                $(selector).on('remove', function(){ // ReInit options on html replace (on widget Save)
                    clearTimeout(timeoutId);
                    timeoutId = setTimeout(function(){ // wait a few milliseconds for html replace to finish
                        fwEvents.trigger('fw:options:init', { $elements: $(selector) });
                    }, 100);
                });
            });
        </script><?php
    }

}
