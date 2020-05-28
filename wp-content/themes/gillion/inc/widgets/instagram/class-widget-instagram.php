<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

class Widget_Instagram extends WP_Widget {

    /**
     * Widget constructor.
     */
    private $options;
    private $prefix;
    function __construct() {

        $widget_ops = array( 'description' => esc_html__( 'Show your instagram feed', 'gillion' ) );
        parent::__construct( false, esc_html__( 'Shufflehound Instagram (outdated)', 'gillion' ), $widget_ops );
        $this->options = array(

            'id' => array( 'type' => 'unique' ),

            'outdated_method_notice' => array(
        		'type'  => 'html-full',
        		'value' => '',
        		'label' => false,
        		'html'  => '<a href="https://wordpress.org/plugins/wp-instagram-widget/"><h3 class="hndle sh-custom-group-divder"><span>'.esc_attr__('Outdated method! Please use this plugins widget instead', 'gillion').' </span></h3></a>',
        	),

            'title' => array(
                'type' => 'text',
                'label' => esc_html__('Widget Title', 'gillion'),
                'value' => esc_html__('Instagram', 'gillion'),
            ),

            'access_token' => array(
                'type' => 'text',
                'label' => esc_html__('Instagram Access Token', 'gillion'),
                'help' => esc_html__('Search in Google: How to get Instagram access token', 'gillion'),
            ),

            'client_id' => array(
                'type' => 'text',
                'label' => esc_html__('Instagram Client ID (optional)', 'gillion'),
            ),

            'count' => array(
                'type'  => 'slider',
                'value' => 2,
                'properties' => array(
                    'min' => 1,
                    'max' => 20,
                    'step' => 1,
                ),
                'label' => esc_html__('Count', 'gillion'),
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

		$filepath = get_template_directory() . '/inc/widgets/instagram/views/widget.php';

        $instance = $atts;
        $before_widget = str_replace( 'class="', 'class="widget_instagram ', $before_widget );

        if ( file_exists( $filepath ) ) {
            include ( $filepath );
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
