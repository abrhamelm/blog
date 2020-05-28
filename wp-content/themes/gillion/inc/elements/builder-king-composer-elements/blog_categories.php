<?php
/**
 * KingComposer Builder - Blog Categories Element Output
 */
if( ! defined( 'ABSPATH' ) ) { die( 'Forbidden' ); }

$id = 'kc-css-'.esc_attr( $atts['_id'] );
$css_class = array();
$css_class[] = 'categories-list';
$css_class[] = 'row';
$css_class[] = $id;

$categories = ( isset($atts['categories']) && $atts['categories'] ) ? str_replace("post:","", $atts['categories'] ) : array();
$categories = explode( ",", $categories );
?>

<?php if( count($categories) > 0 ) : ?>
<div class="<?php echo esc_attr( implode( " ", $css_class ) ); ?>">

    <?php foreach( $categories as $category ) :
        $category = get_term_by('name', $category, 'category');

        if( isset( $category->term_id ) && count( $category->term_id ) ) :
            $icon = gillion_term_option( $category->term_id, 'category', 'icon' );
        ?>

            <div class="col-md-4 col-sm-6 categories-list-item">
                <div class="sh-ratio">
                    <div class="sh-ratio-container">
                        <a href="<?php echo get_category_link( $category->term_id ); ?>" class="sh-ratio-content"
                            style="background-image: url( <?php echo esc_url( gillion_term_option_image( $category->term_id, 'category', 'image' ) ); ?> );">

                            <h4 class="categories-list-item-name"><?php echo esc_attr( $category->name ); ?></h4>
                            <?php if( $icon ) : ?>
                                <div class="categories-list-item-icon"><i class="<?php echo esc_attr( $icon ); ?>"></i></div>
                            <?php endif; ?>

                        </a>
                    </div>
                </div>
            </div>

        <?php endif; ?>
    <?php endforeach; ?>

</div>
<?php endif; ?>
