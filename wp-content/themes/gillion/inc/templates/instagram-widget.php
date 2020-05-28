<?php $thumb_size = ( did_action( 'get_footer' ) ) ? 'small' : $size; ?>
<li class="<?php echo esc_attr( $liclass ); ?>">
    <a href="<?php echo esc_url( $item['link'] ); ?>" target="<?php echo esc_attr( $target ); ?>" class="<?php echo esc_attr( $aclass ); ?>">
        <div class="sh-ratio">
            <div class="sh-ratio-container sh-ratio-container-1_1">
                <div class="sh-ratio-content" style="background-image: url( <?php echo esc_url( $item[$thumb_size] ); ?> );"></div>
            </div>
        </div>
        <div class="sh-instagram-meta">
            <div class="sh-instagram-meta-content">
                <span class="sh-instagram-likes">
                    <i class="icon icon-heart"></i> <?php echo esc_attr( $item['likes'] ); ?>
                </span>
                <span class="sh-instagram-comments">
                    <i class="icon icon-bubbles"></i> <?php echo esc_attr( $item['comments'] ); ?>
                </span>
            </div>
        </div>
    </a>
</li>
