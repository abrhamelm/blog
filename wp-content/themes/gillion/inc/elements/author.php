<?php
/*
Element: Button
*/

class vcAuthor extends WPBakeryShortCode {

    function __construct() {
        add_action( 'init', array( $this, '_mapping' ), 12 );
        add_shortcode( 'vcg_author', array( $this, '_html' ) );
    }


    public function _mapping() {
        if ( !defined( 'WPB_VC_VERSION' ) ) { return; }

        vc_map(
            array(
                'name' => __('Author', 'gillion'),
                'base' => 'vcg_author',
                'description' => __('Blog post author box', 'gillion'),
                'category' => __('Gillion Elements', 'gillion'),
                'icon' => get_template_directory_uri().'/img/builder-icon.png',
                'params' => array(

                    array(
            			'param_name' => 'author_username',
            			'type' => 'textfield',
            			'heading' => __( 'Author Username or ID', 'gillion' ),
            			'description' => __( 'Enter author username or ID', 'gillion' ) . ' <a href="'.esc_url( admin_url( '/users.php' ) ).'" target="_blank">(get here)</a>',
                        'admin_label' => true,
            		),

                    /* Styling */
                    array(
                        'param_name' => 'author_posts',
                        'heading' => __( 'Author Posts Count', 'gillion' ),
                        'description' => __( 'Choose slider information fields', 'gillion' ),
                        'value' => array(
                            __('Off') => 'off',
                            __('On', 'gillion') => 'on',
                        ),
                        'type' => 'dropdown',
                        'holder' => 'div',
                        'class' => '',
                        'std' => 'on',
                    ),

            		array(
            			'type' => 'css_editor',
            			'heading' => __( 'CSS box', 'gillion' ),
            			'param_name' => 'css',
            			'group' => __( 'Design Options', 'gillion' ),
            		),

                ),
            )
        );

    }


    public function _html( $atts, $content ) {
        // Params extraction
        extract( shortcode_atts( array(
            'author_username' => '',
            'author_posts' => 'on',
            'css' => 'none',
        ), $atts ) );

        // HTML
        $element_class = [];
        $element_class[] = 'vcg-author';
        $element_class[] = 'vcg-author-'.gillion_rand();
        $element_class[] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );


        // CSS
        //$css = [];
        //$css[] = ( $icon_color ) ? 'color: '.$icon_color : '';
        //$css[] = ( $icon_size ) ? 'font-size: '.$icon_size : '';


        if( $author_username ) :
            if( is_numeric( $author_username ) && $author_username > 0 ) :
                $userinfo = get_userdata( $author_username );
            else :
                $userinfo = get_user_by( 'slug', $author_username );
            endif;

            if( isset( $userinfo->user_url ) ) :
                $author_id = $userinfo->ID;


                // Count posts
                if( $author_posts == 'on' ) :
                    $author_posts = get_posts([
                        'author' => $author_id,
                        'fields' => 'ids',
                        'post_type' =>'post',
                        'post_status'=> 'public',
                        'posts_per_page' => -1,
                    ]);
                    $posts = ( is_array( $author_posts ) ) ? count( $author_posts ) : 0;
                endif;

        ob_start(); ?>


            <div class="<?php echo implode( ' ', $element_class ); ?>">


                <div class="sh-post-author">
                    <div class="sh-post-author-avatar">
                        <a href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>">
                            <?php echo get_avatar( $author_id, '120' ); ?>
                        </a>
                    </div>
                    <div class="sh-post-author-info">
                        <div>
                            <a href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>">
                                <h4><?php the_author(); ?></h4>
                            </a>

                            <?php if( isset( $posts ) ) : ?>
                                <div class="post-meta">
                                     <span>
                                         <?php echo intval( $posts ); ?>
                                         <?php esc_attr_e( 'posts', 'gillion' ); ?>
                                     </span>
                                </div>
                            <?php endif; ?>

                            <div class="sh-post-author-description"><?php the_author_meta( 'description' ); ?></div>
                            <div class="sh-post-author-icons">
                                <?php
                                    $userinfo = get_userdata( $author_id );
                                    if( isset( $userinfo->user_url ) && $userinfo->user_url ) :
                                        echo '<a href="'.esc_url( $userinfo->user_url ).'" target="_blank"><i class="fa fa-globe"></i></a>';
                                    endif;

                                    $usermeta = get_user_meta( $author_id );
                                    $meta_fields = array( 'public_email', 'facebook', 'twitter', 'instagram', 'linkedin', 'pinterest', 'tumblr', 'youtube' );
                                    foreach( $meta_fields as $meta) :

                                        $this_meta = ( isset( $usermeta[$meta][0] ) && $usermeta[$meta][0] ) ? $usermeta[$meta][0] : '';
                                        if( $meta == 'public_email' && $this_meta ) :
                                            $meta = 'envelope';
                                            $this_meta = 'mailto:'.$this_meta;
                                        endif;

                                        if( $this_meta ) :
                                            echo '<a href="'.esc_url( $this_meta ).'" target="_blank"><i class="fa fa-'.esc_attr( $meta ).'"></i></a>';
                                        endif;

                                    endforeach;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        <?php return ob_get_clean(); endif; endif;
    }

}
new vcAuthor();
