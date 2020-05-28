<?php
/**
 * KingComposer Builder - Blog Posts Categories Element Output
 */
if( ! defined( 'ABSPATH' ) ) { die( 'Forbidden' ); }

$id = 'kc-css-'.esc_attr( $atts['_id'] );
$css_class = array();
$css_class[] = 'sh-categories';
$css_class[] = $id;

$categories = ( isset($atts['categories']) && $atts['categories'] ) ? str_replace("post:","", $atts['categories'] ) : '';
$categories = explode( ",", $categories );
if( isset( $atts['order'] ) && $atts['order'] == 'desc' ) :
	$categories = array_reverse( $categories );
endif;
?>

<?php if( $atts['style'] == 'style2' ) : ?>

	<div class="<?php echo esc_attr( implode( " ", $css_class ) ); ?> sh-categories-style2">
		<?php if( count($categories) > 0 ) : ?>

			<div class="sh-categories-tabs">
				<div class="sh-categories-title">
					<h2>
						<?php echo esc_attr( $atts['title'] ); ?>
					</h2>
				</div>
				<div class="sh-categories-line" style="width: 99%;">
					<div class="sh-categories-line-container"></div>
				</div>
				<div class="sh-categories-names">
					<!-- Tabs -->
					<ul class="nav nav-tab" role="tablist">
						<?php $i = 0;
						foreach( $categories as $category ) :
							$i++; $id = 'tab-'. $atts['_id'] .'-'.$i;
						?>
							<li role="presentation" class="<?php echo ($i == 1) ? ' active' : ''; ?>">
								<a href="#<?php echo esc_attr( $id ); ?>" role="tab" data-toggle="tab">
									<?php echo esc_attr( $category ); ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>

			<!-- Content -->
			<div class="tab-content">
				<?php $i = 0;
				foreach( $categories as $category ) :
					$i++; $id = 'tab-'.esc_attr( $atts['_id'] ).'-'.$i;
				?>
					<div role="tabpanel" class="tab-pane fade<?php echo ($i == 1) ? ' in active' : ''; ?>" id="<?php echo esc_attr( $id ); ?>">
						<div class="row">
							<div class="col-md-7">
								<?php
									$limit = ( is_numeric($atts['limit']) ) ? intval( $atts['limit'] )+1 : 6;
									$posts = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => $limit, 'category_name' => $category ) );
									if( count($posts) > 0 ) : $j = 0;
										while ( $posts->have_posts() ) : $posts->the_post(); $j++;
									?>

										<?php if ( $j == 1 ) :
											set_query_var( 'style', 'cover-large' );
											if( get_post_format() ) :
												get_template_part( 'content', 'format-'.get_post_format() );
											else :
												get_template_part( 'content' );
											endif;
											?>

											</div>
											<div class="col-md-5 sh-categories-list">
										<?php else :

											gillion_post_mini_layout( 'large' );

										endif; ?>
									<?php endwhile; ?>
								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>

		<?php endif; ?>
	</div>

<?php else : ?>

	<div class="<?php echo esc_attr( implode( " ", $css_class ) ); ?> sh-categories-style1 row">
		<?php
		if( count($categories) > 0 ) :
			set_query_var( 'style', 'cover-large' );
			foreach( $categories as $category ) :

				echo '<div class="col-md-4 blog-style-cover">';
				$limit = ( is_numeric($atts['limit']) ) ? intval( $atts['limit'] )+1 : 6;
				$posts = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => $limit, 'category_name' => $category ) );
				if( count($posts) > 0 ) : $i = 0;
					while ( $posts->have_posts() ) : $posts->the_post(); $i++;
						if( $i == 1 ) :

							if( get_post_format() ) :
								get_template_part( 'content', 'format-'.get_post_format() );
							else :
								get_template_part( 'content' );
							endif;

						else :

							gillion_post_mini_layout();

						endif;
					endwhile;
					wp_reset_postdata();
				endif;
				echo '</div>';

			endforeach;
			set_query_var( 'style', '' );
		endif;
		?>
	</div>

<?php endif; ?>
<?php wp_reset_postdata(); ?>
