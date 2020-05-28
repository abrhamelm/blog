<?php $format = get_post_format(); ?>

<?php if( $format == 'video' || $format == 'audio' ) : ?>
    <div id="post-slider-media">
        <div class="post-slider-media-content">

            <div class="post-meta-video">
                <div class="ratio-container">
                    <div class="ratio-content">
                        <?php echo wp_oembed_get( gillion_post_option( get_the_ID(), 'post-'.$format ) ); ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php endif; ?>

<div class="blog-slider blog-slider-style3 <?php echo esc_attr( $id ); ?>" style="position: relative;">
    <div class="blog-slider-list slick-initialized">

        <div class="blog-slider-item" style="background-image: url( <?php echo esc_url( the_post_thumbnail_url( 'full' ) ); ?> );">
            <div class="blog-slider-container">
                <div class="blog-slider-content">

                    <div class="blog-slider-content-icon">
                        <?php if( $format == 'video' || $format == 'audio' ) : ?>
                            <a href="#post-slider-media" data-rel="lightcase">
                        <?php endif; ?>

                            <i class="<?php
                                if( $format == 'gallery' ) :
                                    echo 'ti-image';
                                elseif( $format == 'video' ) :
                                    echo 'ti-control-play';
                                elseif( $format == 'audio' ) :
                                    echo 'ti-headphone';
                                elseif( $format == 'link' ) :
                                    echo 'ti-link';
                                elseif( $format == 'quote' ) :
                                    echo 'ti-quote-left';
                                else :
                                    echo 'icon icon-pencil';
                                endif;
                            ?>"></i>

                        <?php if( $format == 'video' || $format == 'audio' ) : ?>
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="blog-slider-content-details">
                        <?php gillion_post_categories(); ?>
                        <h1 class="post-title">
                            <?php the_title(); ?><?php gillion_post_readlater( get_the_ID() ); ?>
                        </h1>
                        <div class="post-meta">
                            <?php gillion_post_meta( 10 ); ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
    <div class="blog-slider-dots"></div>
</div>
