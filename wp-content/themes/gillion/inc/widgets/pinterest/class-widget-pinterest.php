<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

class Widget_Pinterest extends WP_Widget {

    /**
     * Widget constructor.
     */
    private $options;
    private $prefix;
    function __construct() {

        $widget_ops = array( 'description' => esc_html__( 'Show your pinterest feed', 'gillion' ) );
        parent::__construct( false, esc_html__( 'Shufflehound Pinterest', 'gillion' ), $widget_ops );
        $this->options = array(

            'id' => array( 'type' => 'unique' ),

            'title' => array(
                'type' => 'text',
                'label' => esc_html__('Widget Title', 'gillion'),
                'value' => esc_html__('Pinterest', 'gillion'),
            ),

            'board_url' => array(
                'type' => 'text',
                'label' => esc_html__('Pinterest (board, user profile or pin) URL', 'gillion'),
                'help' => esc_html__('For example: https://www.pinterest.com/pinterest/official-news/', 'gillion'),
                'desc' => esc_html__( 'For more information about how this feature works and its preview, please visit' ) . ' <a href="https://developers.pinterest.com/tools/widget-builder/?type=profile" target="_blank">this link</a>',
            ),

            'height' => array(
                'type' => 'text',
                'label' => esc_html__('Pinterest Content Height', 'gillion'),
                'desc' => esc_html__( 'Enter content height (in px)' ),

            ),

        );
        $this->prefix = 'pinterest';
    }

    function widget( $args, $instance ) {
        extract( $args );
        $params = array();

        foreach ( $instance as $key => $value ) {
            $atts[ $key ] = $value;
        }

		$filepath = get_template_directory() . '/inc/widgets/pinterest/views/widget.php';

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
