<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

if( !class_exists( 'Widget_Social_counter' ) ) {
    class Widget_Social_counter extends WP_Widget {

        /**
         * Widget constructor.
         */
        private $options;
        private $prefix;
        function __construct() {

            $widget_ops = array( 'description' => esc_html__( 'Show your social network like/follower count', 'gillion' ) );
            parent::__construct( false, esc_html__( 'Shufflehound Social Counter 2.0', 'gillion' ), $widget_ops );
            $this->options = array(

                'id' => array( 'type' => 'unique' ),

                'title' => array(
                    'type' => 'text',
                    'label' => esc_html__('Widget Title', 'gillion'),
                    'value' => esc_html__('Stay connected', 'gillion'),
                ),

                'demo_mode' => array(
                    'label' => esc_html__( 'Demo Mode', 'gillion' ),
                    'desc'  => esc_html__( 'Enable or disable demo mode, which will give some random numbers for each social network', 'gillion' ),
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

                'style' => array(
                    'type'  => 'select',
                    'value' => 'style1',
                    'label' => esc_html__('Style', 'gillion'),
                    'desc'  => esc_html__('Select widget style', 'gillion'),
                    'choices' => array(
                        'style1' => esc_html__('Standard', 'gillion'),
                        'style2' => esc_html__('Round Boxes', 'gillion'),
                    ),
                ),




                    'facebook_title' => array( 'type' => 'html-full', 'value' => '', 'label' => false, 'html'  => '
                        <h3 style=margin-bottom:0;>'.esc_html__( 'Facebook', 'gillion' ).'</h3>
                    ' ),

                'facebook_username' => array(
                    'type' => 'text',
                    'label' => esc_html__('Facebook Page ID', 'gillion'),
                    'help' => esc_html__('Enter your facebook username', 'gillion'),
                    'help' => esc_html__('ID Facebook page. Must be the numeric ID or your page slug. <br>
                         You can find this data clicking to edit your page on Facebook. <br>
                         The URL will be similar to this:https://www.facebook.com/pages/edit/?id=464751807014499 or https://www.facebook.com/Shufflehound', 'gillion'),
                ),

                'facebook_app_id' => array(
                    'type' => 'text',
                    'label' => esc_html__('Facebook App ID', 'gillion'),
                    'help' => esc_html__('Enter your facebook app ID', 'gillion'),
                ),

                'facebook_app_secret' => array(
                    'type' => 'text',
                    'label' => esc_html__('Facebook App Secret', 'gillion'),
                    'help' => esc_html__('Enter your facebook app secret', 'gillion'),
                    'desc'  => esc_html__('Please note To use "Page Public Content Access", your use of this endpoint must be reviewed and approved by Facebook. To submit this "Page Public Content Access" feature for review please read our documentation on reviewable features: ', 'gillion')
                        .'<a href="https://developers.facebook.com/docs/apps/review">https://developers.facebook.com/docs/apps/review</a>',
                ),




                    'twitter_title' => array( 'type' => 'html-full', 'value' => '', 'label' => false, 'html'  => '
                        <h3 style=margin-bottom:0;>'.esc_html__( 'Twitter', 'gillion' ).'</h3>
                    ' ),

                'twitter_username' => array(
                    'type' => 'text',
                    'label' => esc_html__( 'Twitter Username', 'gillion' ),
                    'help' => esc_html__( 'Enter the Twitter username. Example: theshufflehound', 'gillion' ),
                ),

                /*'twitter_consumer_key' => array(
                    'type' => 'text',
                    'label' => esc_html__( 'Twitter Consumer key', 'gillion'),
                    'help' => esc_html__('Create an app on Twitter in https://dev.twitter.com/apps and get this data.', 'gillion'),
                ),

                'twitter_consumer_secret' => array(
                    'type' => 'text',
                    'label' => esc_html__( 'Twitter Consumer secret', 'gillion'),
                    'help' => esc_html__( 'Create an app on Twitter in https://dev.twitter.com/apps and get this data.', 'gillion'),
                ),

                'twitter_access_token' => array(
                    'type' => 'text',
                    'label' => esc_html__( 'Twitter Access token', 'gillion'),
                    'help' => esc_html__( 'Create an app on Twitter in https://dev.twitter.com/apps and get this data.', 'gillion'),
                ),

                'twitter_access_token_secret' => array(
                    'type' => 'text',
                    'label' => esc_html__( 'Twitter Access token secret', 'gillion'),
                    'help' => esc_html__( 'Create an app on Twitter in https://dev.twitter.com/apps and get this data.', 'gillion'),
                ),*/




                    'instagram_title' => array( 'type' => 'html-full', 'value' => '', 'label' => false, 'html'  => '
                        <h3 style=margin-bottom:0;>'.esc_html__( 'Instaram', 'gillion' ).'</h3>
                    ' ),

                'instagram_username' => array(
                    'type' => 'text',
                    'label' => esc_html__('Instagram Username', 'gillion'),
                    'help' => esc_html__('Enter the Instagram username. Example: wordpress', 'gillion'),
                ),

                /*'instagram_client_id' => array(
                    'type' => 'text',
                    'label' => esc_html__('Instagram Client ID (optional)', 'gillion'),
                ),*/

                'instagram_access_token' => array(
                    'type' => 'text',
                    'label' => esc_html__('Instagram Access Token', 'gillion'),
                    'help' => esc_html__('Generate access token and enter it here. We have tested - https://instagram.pixelunion.net/ , but as allways use with caution', 'gillion'),
                ),




                    'youtube_title' => array( 'type' => 'html-full', 'value' => '', 'label' => false, 'html'  => '
                        <h3 style=margin-bottom:0;>'.esc_html__( 'Youtube', 'gillion' ).'</h3>
                    ' ),

                'youtube_channel_id' => array(
                    'type' => 'text',
                    'label' => esc_html__('Youtube Channel ID', 'gillion'),
                    'help' => esc_html__('Enter the YouTube Channel ID.', 'gillion'),
                ),

                'youtube_api_key' => array(
                    'type' => 'text',
                    'label' => esc_html__('Youtube API Key', 'gillion'),
                    'help' => esc_html__('Enter your Youtube API key', 'gillion'),
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

            $filepath = get_template_directory().'/inc/widgets/social-counter/views/widget.php';

            $instance = $atts;
            $before_widget = str_replace( 'class="', 'class="widget_advertise ', $before_widget );

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
}
