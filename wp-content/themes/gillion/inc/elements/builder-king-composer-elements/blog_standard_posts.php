<?php
/**
 * KingComposer Builder - Blog Standard Posts Element Output
 */
if( ! defined( 'ABSPATH' ) ) { die( 'Forbidden' ); }

$id = 'kc-css-'.esc_attr( $atts['_id'] );
$class = array();
$class[] = 'sh-blog-standard-posts';
$class[] = $id;

$class2 = array();
$class2[] = 'sh-group';
$class2[] = 'blog-list';
$class2[] = 'blog-style-grid';

$categories_query = ( isset($atts['categories']) && $atts['categories'] ) ? str_replace("post:","", $atts['categories'] ) : array();

$post_per_page = ( get_option( 'posts_per_page' ) ) ? get_option( 'posts_per_page' ) : 10;
$posts = new WP_Query( array(
	'post_type' => 'post',
	'category_name' => $categories_query,
	'posts_per_page' => 6
));
?>
<?php if( isset($atts['title']) && $atts['title'] ) : ?>
    <h2 class="sh-blog-fancy-title">
        <?php echo esc_attr( $atts['title'] ); ?>
    </h2>
<?php endif; ?>
<div class="<?php echo esc_attr( implode( " ", $class ) ); ?>">
    <div class="<?php echo esc_attr( implode( " ", $class2 ) ); ?>">
        <?php
            if( count($posts) > 0 ) :
                set_query_var( 'style', 'grid' );
                while ( $posts->have_posts() ) : $posts->the_post();

                    if( get_post_format() ) :
                        get_template_part( 'content', 'format-'.get_post_format() );
                    else :
                        get_template_part( 'content' );
                    endif;

                endwhile;
            else :

                get_template_part( 'content', 'none' );

            endif;
        ?>
    </div>
</div>
