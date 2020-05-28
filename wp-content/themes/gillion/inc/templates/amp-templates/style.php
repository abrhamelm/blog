<?php
$accent_color = gillion_option( 'accent_color', '#f63a4c' );
$text_color = gillion_option_value( 'styling_body','color' );
//$heading_color = gillion_option_value('styling_headings','color');
$link_color = gillion_option( 'link_color' );
$border_color = '#EDEDED';
$score = gillion_post_review_score( get_the_ID() );
$review_layout = gillion_post_option( get_the_ID(), 'review_layout' );

$amp_post_content_color = gillion_option( 'amp_post_content_color' );
$amp_post_accent_color = gillion_option( 'amp_post_accent_color' );
$amp_post_heading_color = gillion_option( 'amp_post_heading_color' );
$amp_post_content_size = gillion_option( 'amp_post_content_size', '16px' );
$amp_logo_size_desktop = gillion_option( 'amp_logo_size_desktop', 38 );
$amp_logo_size_mobile = gillion_option( 'amp_logo_size_mobile', 22 );

$accent_color = ( $amp_post_accent_color ) ? $amp_post_accent_color : $accent_color;
$content_color = ( $amp_post_content_color ) ? $amp_post_content_color : $text_color;
// $heading_color = ( $amp_post_heading_color ) ? $amp_post_heading_color : $heading_color;

ob_start();
?>
/* Generic WP styling */
.alignright {
	float: right;
}

.alignleft {
	float: left;
}

.aligncenter {
	display: block;
	text-align: center;
	margin-left: auto;
	margin-right: auto;
}

.amp-wp-enforced-sizes {
	/** Our sizes fallback is 100vw, and we have a padding on the container; the max-width here prevents the element from overflowing. **/
	max-width: 100%;
	margin: 0 auto;
}

<?php echo file_get_contents( AMP__DIR__ . '/assets/css/amp-default.css' ); // phpcs:ignore WordPress.WP.AlternativeFunctions ?>

/* Template Styles */
body {
	color: <?php echo sanitize_hex_color( $text_color ); ?>;
	font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", "Roboto", "Open Sans", "Arial", "Helvetica Neue", sans-serif;
	font-weight: 300;
	line-height: 1.75em;
}

p,
ol,
ul,
figure {
	margin: 0 0 1em;
	padding: 0;
}

a,
a:visited {
	color: <?php echo sanitize_hex_color( $link_color ); ?>;
}

a:hover,
a:active,
a:focus {
	color: <?php echo sanitize_hex_color( $text_color ); ?>;
}

/* Quotes */

blockquote {
	color: <?php echo sanitize_hex_color( $text_color ); ?>;
	background: rgba(127,127,127,.125);
	border-<?php echo is_rtl() ? 'right' : 'left'; ?>: 2px solid <?php echo sanitize_hex_color( $link_color ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>;
	margin: 8px 0 24px 0;
	padding: 16px;
}

blockquote p:last-child {
	margin-bottom: 0;
}

/* UI Fonts */

.amp-wp-meta,
.amp-wp-header div,
.amp-wp-title,
.wp-caption-text,
.amp-wp-tax-category,
.amp-wp-tax-tag,
.amp-wp-comments-link,
.amp-wp-footer p,
.back-to-top {
	font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", "Roboto", "Oxygen-Sans", "Ubuntu", "Cantarell", "Helvetica Neue", sans-serif;
}

/* Header */
.amp-wp-header div {
	font-size: 1em;
	font-weight: 400;
	margin: 0 auto;
	max-width: calc(840px - 32px);
	padding: .875em 16px;
	position: relative;
}

.amp-wp-header a {
	text-decoration: none;
}

<?php if ( $this->get( 'post_canonical_link_url' ) || is_customize_preview() ) : ?>
	.amp-wp-header .amp-wp-canonical-link {
		font-size: 0.8em;
		text-decoration: underline;
		position: absolute;
	}
<?php endif; ?>

/* Article */

.amp-wp-article {
	color: <?php echo sanitize_hex_color( $content_color ); ?>;
	font-weight: 400;
	margin: 1.5em auto;
	max-width: 840px;
	overflow-wrap: break-word;
	word-wrap: break-word;
}

/* Article Header */

.amp-wp-article-header {
	align-items: center;
	align-content: stretch;
	display: flex;
	flex-wrap: wrap;
	justify-content: space-between;
	margin: 1.5em 16px 0;
}

.amp-wp-title {
	color: <?php echo sanitize_hex_color( $text_color ); ?>;
	display: block;
	flex: 1 0 100%;
	font-weight: 900;
	margin: 0 0 .625em;
	width: 100%;
}

/* Article Meta */

.amp-wp-meta {
	display: inline-block;
	flex: 2 1 50%;
	font-size: .875em;
	line-height: 1.5em;
	margin: 0 0 1.5em;
	padding: 0;
}

.amp-wp-article-header .amp-wp-meta:last-of-type {
	text-align: <?php echo is_rtl() ? 'left' : 'right'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>;
}

.amp-wp-article-header .amp-wp-meta:first-of-type {
	text-align: <?php echo is_rtl() ? 'right' : 'left'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>;
}

.amp-wp-byline amp-img,
.amp-wp-byline .amp-wp-author {
	display: inline-block;
	vertical-align: middle;
}

.amp-wp-byline amp-img {
	border: 1px solid <?php echo sanitize_hex_color( $link_color ); ?>;
	border-radius: 50%;
	position: relative;
	margin-<?php echo is_rtl() ? 'left' : 'right'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>: 6px;
}

.amp-wp-posted-on {
	text-align: <?php echo is_rtl() ? 'left' : 'right'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>;
}

/* Featured image */

.amp-wp-article-featured-image {
	margin: 0 0 1em;
}
.amp-wp-article-featured-image amp-img {
	margin: 0 auto;
}
.amp-wp-article-featured-image.wp-caption .wp-caption-text {
	margin: 0 18px;
}

/* Article Content */

.amp-wp-article-content {
	margin: 0 16px;
}

.amp-wp-article-content ul,
.amp-wp-article-content ol {
	margin-<?php echo is_rtl() ? 'right' : 'left'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>: 1em;
}

.amp-wp-article-content .wp-caption {
	max-width: 100%;
}

.amp-wp-article-content amp-img {
	margin: 0 auto;
}

.amp-wp-article-content amp-img.alignright {
	margin: 0 0 1em 16px;
}

.amp-wp-article-content amp-img.alignleft {
	margin: 0 16px 1em 0;
}

/* Captions */

.wp-caption {
	padding: 0;
}

.wp-caption.alignleft {
	margin-right: 16px;
}

.wp-caption.alignright {
	margin-left: 16px;
}

.wp-caption .wp-caption-text {
	border-bottom: 1px solid <?php echo sanitize_hex_color( $border_color ); ?>;
	font-size: .875em;
	line-height: 1.5em;
	margin: 0;
	padding: .66em 10px .75em;
}

/* AMP Media */

.alignwide,
.alignfull {
	clear: both;
}

amp-carousel {
	background: <?php echo sanitize_hex_color( $border_color ); ?>;
	margin: 0 -16px 1.5em;
}
amp-iframe,
amp-youtube,
amp-instagram,
amp-vine {
	background: <?php echo sanitize_hex_color( $border_color ); ?>;
	margin: 0 -16px 1.5em;
}

.amp-wp-article-content amp-carousel amp-img {
	border: none;
}

amp-carousel > amp-img > img {
	object-fit: contain;
}

.amp-wp-iframe-placeholder {
	background: <?php echo sanitize_hex_color( $border_color ); ?> url( <?php echo esc_url( $this->get( 'placeholder_image_url' ) ); ?> ) no-repeat center 40%;
	background-size: 48px 48px;
	min-height: 48px;
}

/* Article Footer Meta */

.amp-wp-article-footer .amp-wp-meta {
	display: block;
}

.amp-wp-tax-category,
.amp-wp-tax-tag {
	font-size: .875em;
	line-height: 1.5em;
	margin: 1.5em 16px;
}

.amp-wp-comments-link {
	font-size: .875em;
	line-height: 1.5em;
	text-align: center;
	margin: 2.25em 0 1.5em;
}

.amp-wp-comments-link a {
	border-style: solid;
	border-color: <?php echo sanitize_hex_color( $border_color ); ?>;
	border-width: 1px 1px 2px;
	border-radius: 4px;
	background-color: transparent;
	color: <?php echo sanitize_hex_color( $link_color ); ?>;
	cursor: pointer;
	display: block;
	font-size: 14px;
	font-weight: 600;
	line-height: 18px;
	margin: 0 auto;
	max-width: 200px;
	padding: 11px 16px;
	text-decoration: none;
	width: 50%;
}

/* AMP Footer */

.amp-wp-footer {
	border-top: 1px solid <?php echo sanitize_hex_color( $border_color ); ?>;
	margin: calc(1.5em - 1px) 0 0;
}

.amp-wp-footer .amp-wp-footer-container {
	margin: 0 auto;
	max-width: calc(840px - 32px);
	padding: 1.25em 16px 1.25em;
	position: relative;
}

.amp-wp-footer h2 {
	font-size: 1em;
	line-height: 1.375em;
	margin: 0 0 .5em;
}

.amp-wp-footer p {
	font-size: .8em;
	line-height: 1.5em;
	margin: 0 85px 0 0;
}

.amp-wp-footer a {
	text-decoration: none;
}








/*
** Custom - Basic
*/
body {
	font-size: 14px;
	color: #393939;
}

img,
.amp-wp-article-related-posts-item .sh-ratio-content {
	border-radius: 8px;
}

a, h3 {
	text-decoration: none;
	transition: opacity 0.3s ease-in-out;
}

<?php if( $amp_post_heading_color ) : ?>
	.amp-wp-title,
	.amp-wp-article-related-posts h2,
	h1,
	h2,
	h3,
	h4,
	h5,
	h6 {
		color: <?php echo esc_attr( $amp_post_heading_color ); ?>;
	}
<?php endif; ?>

.amp-wp-meta.amp-wp-comments-link a:hover,
.amp-wp-article-related-posts-item h3:hover,
.amp-wp-tax-category a:hover,
.amp-wp-article-content a:hover {
	opacity: 0.8;
}

hr {
    margin-top: 20px;
    margin-bottom: 20px;
    border: 0;
    border-top: 1px solid #eee;
}

figcaption.wp-caption-text,
.wp-caption figcaption.wp-caption-text {
    font-size: 12px;
    text-align: left;
	border-width: 0px;
	padding: 5px 0;
}

.sh-dropcaps {
    font-weight: bold;
    margin-right: 15px;
    line-height: 1;
    float: left;
    margin: 25px 35px;
}

body .sh-dropcaps {
    font-size: 48px;
}

blockquote {
	display: block;
    padding: 0 0 0 60px;
    font-style: italic;
    border-left-width: 0;
    font-weight: 600;
    position: relative;
    text-align: left;
	background-color: transparent;
}

blockquote cite {
    display: block;
    color: <?php echo esc_attr( $accent_color ); ?>;
    font-style: normal;
    font-size: 14px;
    font-weight: 600;
    margin-top: 5px;
}

blockquote:before {
    content: "”";
    display: block;
    position: absolute;
    top: 50%;
    left: 0;
    font-size: 50px;
    line-height: 0;
    margin-top: 6px;
    margin-left: 0;
    color: inherit;
}

blockquote:after {
    content: "";
    display: block;
    position: absolute;
    top: 5px;
    left: 40px;
    bottom: 5px;
    width: 2px;
    background-color: <?php echo esc_attr( $accent_color ); ?>;
}

blockquote p {
    font-size: 18px;
}


/* Uppercase */
.amp-wp-tax-category a,
.amp-wp-tax-category span,
.amp-wp-tax-tag a,
.amp-wp-tax-tag span,
.amp-wp-article-related-posts h2,
.amp-wp-article-footer .amp-wp-comments-link,
.amp-wp-footer-nav li a,
.amp-wp-footer .amp-wp-back-to-top {
	text-transform: uppercase;
}




/*
** Dynamic Images
*/
.sh-ratio {
	position: relative;
}

.sh-ratio-container {
	padding-bottom: 56.25%;
}

.sh-ratio-content {
	position: absolute;
	top: 0; right: 0; left: 0; bottom: 0;
	background-size: cover;
	background-position: 50% 50%;
}

.sh-ratio-content iframe {
	width: 100%;
	height: 100%;
}




/*
** Post Content
*/
.amp-wp-article-media,
.amp-wp-article-featured-image {
	margin-bottom: 30px;
}

.amp-wp-article-categories a {
	font-style: italic;
    font-weight: 600;
    font-size: 13px;
	color: #7e7e7e;
}

.amp-wp-meta {
	width: auto;
}

.amp-wp-article {
	margin-top: 40px;
}

.amp-wp-article-header {
	margin: 0;
}

h1.amp-wp-title {
	font-size: 36px;
	line-height: 110%;
	font-weight: 600;
}

.amp-wp-meta {
    display: inline-block;
    position: relative;
	color: #8d8d8d;
	line-height: 25px;
	font-size: 12px;
}

.amp-wp-meta:not(:last-child) {
	padding-right: 10px;
    margin-right: 10px;
}

.amp-wp-meta:not(:last-child):not(.amp-wp-tax-category):after {
	content: "";
	display: block;
	position: absolute;
	background-color: #d6d6d6;
	width: 1px;
	top: 7px;
	bottom: 7px;
	right: -1px;
}

.amp-wp-meta img {
	border-radius: 5px;
	filter: grayscale(100%);
	transition: 0.3s all ease-in-out;
}

.amp-wp-meta img:hover {
    filter: grayscale(0%);
}

.amp-wp-byline amp-img {
	border-radius: 0px;
	border-width: 0px;
}

.amp-wp-article-content {
	margin: 0;
}

.amp-wp-article-content,
.amp-wp-article-content p {
	line-height: 1.8;
	font-size: <?php echo esc_attr( $amp_post_content_size ); ?>;
	color: <?php echo esc_attr( $content_color ); ?>;
}

.amp-wp-article-content p {
	margin-bottom: 15px;
}




/* Content Footer */
.amp-wp-article-footer {
	margin-top: 40px;
}

.amp-wp-article-footer .amp-wp-meta {
	margin-left: 0px;
	margin-right: 0px;
}

.amp-wp-article-footer .amp-wp-comments-link {
	margin: 60px 0;
}

.amp-wp-article-footer .amp-wp-comments-link a {
	border-width: 0;
	background-color: <?php echo esc_attr( $accent_color ); ?>;
	color: #fff;
	border-radius: 100px;
	line-height: 50px;
	height: 50px;
	padding-top: 0px;
	padding-bottom: 0px;
	font-size: 13px;
}




/*
** Header
*/
header.amp-wp-header {
	text-align: center;
	font-size: 0px;
	line-height: 0px;
	padding: 15px 0;
	border-bottom: 1px solid #EDEDED;
}

.amp-wp-header-logo-img,
.amp-wp-footer-logo-img {
	display: block;
	height: <?php echo intval( $amp_logo_size_desktop ); ?>px;
	width: 100%;
	background-size: contain;
	background-position: 50% 50%;
	background-repeat: no-repeat;
	-webkit-backface-visibility: hidden;
}

.amp-site-title {
	display: none;
}




/*
** Footer
*/
.amp-wp-footer {
	background-color: #f5f5f5;
	color: #8d8d8d;
	padding: 40px 10px;
	margin: 0;
	border-width: 0px;
	margin-top: 40px;
	text-align: center;
}

.amp-wp-footer .amp-wp-footer-container {
	padding: 0;
}

.amp-wp-footer-logo {
	margin-bottom: 15px;
}

.amp-wp-footer .amp-wp-back-to-top {
	display: block;
	margin-top: 30px;
	color: #393939;
	font-size: 12px;
	font-weight: 600;
}

.amp-wp-footer-copyrights
.amp-wp-footer-copyrights a {
	font-size: 12px;
	color: #8d8d8d;
}

/* Footer - Navigation */
.amp-wp-footer-nav ul {
	list-style: none;
	margin-bottom: 15px;
}

.amp-wp-footer-nav li {
	display: inline-block;
}

.amp-wp-footer-nav li a {
	padding: 3px 6px;
	color: #8d8d8d;
	font-weight: 600;
}




/*
** Related Posts
*/
.amp-wp-article-related-posts {
	margin-top: 60px;
}

.amp-wp-article-related-posts h2 {
	margin-bottom: 30px;
}

.amp-wp-article-related-posts-list {
	position: relative;
	margin: 0 -10px;
}

.amp-wp-article-related-posts-item {
	display: inline-block;
	vertical-align: top;
	width: 33.3%;
	margin-right: -4px;
}

.amp-wp-article-related-posts-item a {
	display: block;
	padding: 0 10px;
}

.amp-wp-article-related-posts-item h3 {
	font-size: 18px;
	font-weight: 600px;
	line-height: 130%;
	color: #393939;
	margin-bottom: 6px;
}

.amp-wp-article-related-posts-item .amp-wp-meta {
	margin-bottom: 0;
}




/*
** Categories, Tags
*/
.amp-wp-tax-category a,
.amp-wp-tax-category span,
.amp-wp-tax-tag a,
.amp-wp-tax-tag span {
	display: inline-block;
    position: relative;
    padding: 0 15px;
    line-height: 18px;
    margin-right: 10px;
    font-size: 11px;
    border-radius: 100px;
    border: 1px solid #e0e0e0;
    color: #8d8d8d;
    transition: 0.3s all ease-in-out;
	margin-top: 10px;
}

.amp-wp-tax-category .amp-wp-tax-title,
.amp-wp-tax-tag .amp-wp-tax-title {
	font-weight: bold;
    background-color: #393939;
    color: #fff;
    border-color: #393939;
}




/*
** Responsive
*/
@media ( max-width: 850px ) {
	.amp-wp-header,
	.amp-wp-article,
	.amp-wp-footer {
		padding-left: 15px;
		padding-right: 15px;
	}

	.amp-wp-article {
		margin-top: 15px;
	}

	.amp-wp-article-related-posts-item {
		width: 100%;
		margin-bottom: 30px;
	}

	.amp-wp-article-footer .amp-wp-comments-link {
		margin-top: 0px;
	}

	.amp-wp-header-logo-img,
	.amp-wp-footer-logo-img {
		height: <?php echo intval( $amp_logo_size_mobile ); ?>px;
	}
}




/*
** Review styling
*/
<?php if( $score && $review_layout != 'hidden' ) : ?>

	/* Review */
	.post-content-review {
		float: left;
		width: 420px;
		margin-right: 40px;
		margin-bottom: 25px;
	}

	.post-content-review-right {
		float: right;
		margin-left: 40px;
		margin-right: 0px;
		margin-bottom: 30px;
	}

	.post-content-review-full {
		float: none;
		width: 100%;
		margin-right: 0px;
		margin-bottom: 30px;
	}

	.post-content-review-full.bottom {
		margin-top: 40px;
	}

	@media (max-width: 1200px) {
		.post-content-review:not(.post-content-review-full) {
			max-width: 350px;
		}
	}

	@media (max-width: 700px) {
		.post-content-review {
			float: none;
			width: 100%;
			margin-right: 0px;
			margin-bottom: 30px;
			margin-left: 0px;
		}

		body .post-content-review {
			max-width: 100%;
		}
	}

	.post-content-review-details {
		background-color: #f8f8f8;
		padding: 33px;
	}

	.post-content-review-details > div:not(:last-child) {
		padding-bottom: 40px;
		margin-bottom: 40px;
		border-bottom: 1px solid #e7e7e7;
	}

	.post-content-review-score {
		padding: 15px;
		border-radius: 100px;
		background-color: #505050;
		margin-bottom: 25px;
		text-align: center;
		position: relative;
		overflow: hidden;
		box-shadow: 1px 4px 8px 1px rgba(0,0,0,0.12);
		background-size: cover;
		background-position: 50% 50%;
	}

	.post-content-review-score h4 {
		color: #fff;
		font-size: 50px;
		margin-bottom: 0px;
		position: relative;
		display: block;
		z-index: 100;
	}

	@media (max-width: 1025px) {
		.post-content-review-score {
			margin-top: 10px;
		}

		.post-content-review-score h4 {
			font-size: 30px;
		}

		.post-content-review-details {
			padding: 25px;
		}
	}

	.post-content-review-score span {
		font-size: 30px;
		font-weight: normal;
	}

	.post-content-review-score-pattern {
		position: absolute;
		top: 0; left: 0; right: 0; bottom: 0;
		border-radius: 100px;
		opacity: 0.8;
	}

	.post-content-review-score div {
		font-size: 18px;
		text-transform: uppercase;
		display: inline-block;
	}

	.post-content-review-pros-cons h4 {
		margin-bottom: 15px;
	}

	.post-content-review-pros-cons li:hover {
		font-weight: bold;
		cursor: default;
	}

	.post-content-review-pros-cons ul {
		margin-left: 0px;
		padding-left: 0px;
		font-size: 13px;
	}

	body .post-content-review-pros-cons ul {
		list-style: none;
	}

	.post-content-review-pros-cons li {
		position: relative;
		padding-left: 22px;
	}

	.post-content-review-pros-cons li:not(:last-child) {
		padding-bottom: 8px;
	}

	.post-content-review-pros-cons li:before {
		display: inline-block;
		font-family: 'simple-line-icons';
		speak: none;
		font-style: normal;
		font-weight: normal;
		font-variant: normal;
		text-transform: none;
		line-height: 1;
		-webkit-font-smoothing: antialiased;
		-moz-osx-font-smoothing: grayscale;
		position: absolute;
		top: 5px; left: 0px;
		padding-left: 1px;
	}

	.post-content-review-pros li:before {
		content: "\e080";
	}

	.post-content-review-cons li:before {
		content: "\e082";
	}

	.post-content-review-verdict h4 {
		margin-bottom: 15px;
	}

	.post-content-review-progressbar-item {
		font-weight: bold;
	}

	.post-content-review-progressbar-item:not(:last-child) {
		margin-bottom: 9px;
	}

	.post-content-review-progressbar-graph {
		background-color: #e2e2e2;
		height: 6px;
		position: relative;
		overflow: hidden;
		margin-top: 5px;
	}

	.post-content-review-progressbar-graph-fill {
		background-color: #65af55;
		height: 6px;
	}




	body .post-content-review-item {
		padding-left: 0;
	}

	body .post-content-review-item:before {
		display: none;
	}

	.post-content-review-progressbar-item .row,
	.post-content-review-pros-cons .row {
		display: flex;
	}

	.post-content-review-progressbar-item .col-sm-10 {
		flex: 1;
	}

	.post-content-review-pros-cons .row > div {
		width: 50%;
	}

	.post-content-review-score h4 {
		margin-top: 0;
	}



	.post-content-review-progressbar-graph,
	.post-content-review-progressbar-graph-fill {
		border-radius: 8px;
	}
<?php endif; ?>




<?php
$styles = ob_get_contents();
ob_end_clean();
echo gillion_compress( $styles );
?>
