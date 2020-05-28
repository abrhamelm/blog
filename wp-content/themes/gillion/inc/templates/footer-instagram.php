<?php if( gillion_option( 'footer_instagram_widgets', 'on' ) == 'on' && gillion_post_option( gillion_page_id(), 'instagram_widgets', 'on' ) == 'on' ) : ?>
    <?php if( gillion_option( 'footer_instagram_title' ) && is_active_sidebar( 'footer-instagram' ) ) : ?>
        <div class="sh-footer-instagram-title sh-side-line">
            <div class="sh-side-line-holder"><span></span></div>
            <div class="sh-side-line-content">
                <h3>
                    <i class="icon icon-social-instagram"></i>
                    <?php echo esc_attr( gillion_option( 'footer_instagram_title' ) ); ?>
                </h3>
            </div>
            <div class="sh-side-line-holder"><span></span></div>
        </div>
    <?php endif; ?>

    <?php if ( is_active_sidebar( 'footer-instagram' ) ) : ?>
        <div class="sh-footer-instagram">
            <?php dynamic_sidebar( 'footer-instagram' ); ?>
        </div>
    <?php endif; ?>

    <?php if( gillion_option( 'footer_instagram_title' ) ) : ?>
        <div class="sh-footer-instagram-title-bottom"></div>
    <?php endif; ?>
<?php endif; ?>
