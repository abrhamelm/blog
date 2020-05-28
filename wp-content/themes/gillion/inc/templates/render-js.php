<?php ob_start("gillion_compress"); ?>
    jQuery(document).ready(function ($) {
        "use strict";

        <?php
        /*-----------------------------------------------------------------------------------*/
        /* Theme Options - JS Code
        /*-----------------------------------------------------------------------------------*/
        ?>

        <?php if( gillion_option('custom_js') ) : ?>
            <?php echo wp_kses_post( gillion_option('custom_js') ); ?>
        <?php endif; ?>

    });


    <?php
    /*-----------------------------------------------------------------------------------*/
    /* Theme Options - Google Analytics
    /*-----------------------------------------------------------------------------------*/
    ?>

    <?php if( gillion_option('google_analytics') ) : ?>
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', '<?php echo esc_js( gillion_option('google_analytics') ); ?>']);
        _gaq.push(['_trackPageview']);
        (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();
    <?php endif; ?>


<?php ob_end_flush(); ?>
