<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

class Widget_Facebook extends WP_Widget {

    /**
     * Widget constructor.
     */
    private $options;
    private $prefix;
    function __construct() {

        $widget_ops = array( 'description' => esc_html__( 'Show your facebook page', 'gillion' ) );
        parent::__construct( false, esc_html__( 'Shufflehound Facebook', 'gillion' ), $widget_ops );
        $this->options = array(

            'id' => array( 'type' => 'unique' ),

            'title' => array(
                'type' => 'text',
                'label' => esc_html__('Widget Title', 'gillion'),
                'value' => esc_html__('Facebook', 'gillion'),
            ),

            'name' => array(
                'type' => 'text',
                'label' => esc_html__('Facebook Name', 'gillion'),
                'desc' => esc_html__('https://facebook.com/ * Type this into the field *', 'gillion'),
            ),

            'tabs' => array(
                'type'  => 'checkboxes',
                'label' => esc_html__('Tabs', 'gillion'),
                'choices' => array(
                    'timeline' => esc_html__('Timeline', 'gillion'),
                    'events' => esc_html__('Events', 'gillion'),
                    'messages' => esc_html__('Messages', 'gillion'),
                ),
                'inline' => true,
            ),

            'hide_cover' => array(
                'label' => esc_html__( 'Hide Cover', 'gillion' ),
                'desc' => esc_html__( 'Hide cover photo in the header', 'gillion' ),
                'type'  => 'switch',
                'value' => false,
                'left-choice' => array(
                    'value' => false,
                    'label' => esc_html__('Off', 'gillion'),
                ),
                'right-choice' => array(
                    'value' => true,
                    'label' => esc_html__('On', 'gillion'),
                ),
            ),

            'show_facepile' => array(
                'label' => esc_html__( 'Show_facepile', 'gillion' ),
                'desc' => esc_html__( 'Show profile photos when friends like this', 'gillion' ),
                'type'  => 'switch',
                'value' => true,
                'left-choice' => array(
                    'value' => false,
                    'label' => esc_html__('Off', 'gillion'),
                ),
                'right-choice' => array(
                    'value' => true,
                    'label' => esc_html__('On', 'gillion'),
                ),
            ),

            'small_header' => array(
                'label' => esc_html__( 'Small Header', 'gillion' ),
                'desc' => esc_html__( 'Use the small header instead', 'gillion' ),
                'type'  => 'switch',
                'value' => false,
                'left-choice' => array(
                    'value' => false,
                    'label' => esc_html__('Off', 'gillion'),
                ),
                'right-choice' => array(
                    'value' => true,
                    'label' => esc_html__('On', 'gillion'),
                ),
            ),

            'image' => array(
                'label'   => esc_html__( 'Cover Image', 'gillion' ),
                'desc'    => esc_html__( 'Upload cover image', 'gillion' ),
                'type'    => 'upload',
                'images_only' => true,
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

		$filepath = get_template_directory() . '/inc/widgets/facebook/views/widget.php';

        $instance = $atts;
        $before_widget = str_replace( 'class="', 'class="widget_facebook ', $before_widget );

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
