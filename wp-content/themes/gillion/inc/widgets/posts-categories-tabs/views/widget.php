<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
echo wp_kses_post( $before_widget );

$rand = gillion_rand(20);
$limit = ( isset( $atts['limit'] ) && $atts['limit'] > 0 ) ? intval( $atts['limit'] ) : 4;
$title_style = gillion_option( 'global_title', 'style1' );
$position = gillion_option( 'global_carousel_buttons_position', 'title' );

$categories = ( isset( $atts['categories'] ) && $atts['categories'] ) ? array_filter( explode( "\n", $atts['categories'] ) ) : '';
?>

<div class="sh-widget-poststab sh-widget-posts-categories">

    <!-- Nav tabs -->
    <?php if( $title_style == 'style2' ) : ?>
        <div class="sh-widget-title-styling">
            <div class="sh-table">
                <div class="sh-table-cell">
                    <h3 class="widget-title">
                        <?php if( $atts['title'] ) : ?>
                            <?php echo wp_kses_post( $atts['title'] ); ?>
                        <?php endif; ?>
                    </h3>
                </div>
                <div class="sh-table-cell">
    <?php endif; ?>

    <?php if( is_array( $categories ) ) : ?>
        <div class="sh-widget-poststab-title">
            <ul class="nav nav-tabs sh-tabs-stying" role="tablist">
                <?php $i = 0;
                foreach( $categories as $category ) :
                    $i++; $id = 'tab-'. esc_attr($rand) .'-'.$i;
                ?>

                    <li role="presentation" class="<?php echo ($i == 1) ? ' active' : ''; ?>">
                        <a href="#<?php echo esc_attr( $id ); ?>" role="tab" data-toggle="tab">
                            <?php echo esc_attr( $category ); ?>
                        </a>
                    </li>

                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if( $title_style == 'style2' ) : ?>
                </div>
            </div>
        </div>
    <?php endif; ?>


    <?php if( is_array( $categories ) ) : ?>
        <!-- Tab panes -->
    	<div class="tab-content">
            <?php $i = 0;
    		foreach( $categories as $category ) :
    			$i++; $id = 'tab-'. esc_attr($rand) .'-'.$i; ?>

            		<div role="tabpanel" class="tab-pane<?php echo ($i == 1) ? ' active' : ''; ?>" id="<?php echo esc_attr( $id ); ?>">
                        <div class="sh-widget-posts-slider-init">
            			<?php
                        $cat_details = term_exists( $category, 'category' );
                        if( isset( $cat_details['term_id'] ) && $cat_details['term_id'] > 0 ) :
                            $cat_query = 'cat';
                            $cat_id = $cat_details['term_id'];
                        else :
                            $cat_query = 'category_name';
                            $cat_id = $category;
                        endif;

                        $posts = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => $limit, $cat_query => $cat_id, 'ignore_sticky_posts' => 1 ) );
            			if( $posts->have_posts() ) : ?>

            					<?php while ( $posts->have_posts() ) : $posts->the_post(); ?>

                                    <div class="sh-widget-posts-slider-item sh-widget-posts-slider-item-large sh-widget-posts-slider-style1 sh-widget-posts-categories-item">
                                        <div href="<?php echo get_permalink( get_the_ID() ); ?>" class="post-thumbnail">
                                            <?php echo the_post_thumbnail( 'gillion-landscape-small' ); ?>
                                            <?php echo gillion_blog_overlay( gillion_get_thumb( get_the_ID() ) ); ?>
                                            <?php echo gillion_post_review( get_the_ID() ); ?>
                                        </div>
        								<a href="<?php echo get_permalink( get_the_ID() ); ?>">
        									<h5 class="post-title">
        										<?php the_title(); ?><?php gillion_post_readlater( get_the_ID() ); ?>
        									</h5>
        								</a>
        								<?php gillion_post_meta_excerpt( 6 ); ?>
            						</div>

            					<?php endwhile; wp_reset_postdata(); ?>

            			<?php endif; ?>
                        </div>
                        <?php if( $position == 'bottom' ) : ?>
                            <div class="widget-slide-arrows sh-carousel-buttons-styling"></div>
                        <?php endif; ?>
            		</div>

            <?php endforeach; ?>
    	</div>
    <?php endif; ?>

</div>
<?php echo wp_kses_post( $after_widget ); ?>
