<?php
/* Page: Read Later */
$style = gillion_option( 'categories-blog-style', 'masonry' );

if( is_user_logged_in() ) :
    $ids = get_user_meta( get_current_user_id(), 'gillion_read_it_later' );
    $posts = new WP_Query( array(
        'post_type' => 'post',
        'posts_per_page' => -1,
        'post__in' => $ids,
        'orderby' => 'post__in',
    ));
endif;

get_header(); ?>

    <?php if( is_user_logged_in() ) : ?>

        <?php if( isset( $posts ) ) : ?>
            <div class="blog-list blog-style-<?php echo esc_attr( $style ); ?>">
                <?php
                    set_query_var( 'style', $style );
                    if( $posts->have_posts() ) :
                        while ( $posts->have_posts() ) : $posts->the_post();

                            if( get_post_format() ) :
                                get_template_part( 'content', 'format-'.get_post_format() );
                            else :
                                get_template_part( 'content' );
                            endif;

                        endwhile;
                    endif;
                ?>
            </div>
            <?php /*echo gillion_pagination( $posts );*/ ?>
        <?php endif; ?>

    <?php else : ?>

        <div class="sh-nothing-found sh-table">
        	<div class="sh-table-cell-top">
        		<i class="ti-bookmark"></i>
        	</div>
        	<div class="sh-table-cell-top">
        		<h2><?php esc_html_e( 'Not available', 'gillion' ); ?></h2>
        		<p>
        			<?php esc_html_e( 'Please login in to your account to see your added bookmarks', 'gillion' ); ?>
        		</p>
        	</div>
        </div>

    <?php endif; ?>

<?php get_footer(); ?>
