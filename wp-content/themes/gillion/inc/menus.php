<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * Register menus
 */
register_nav_menus( array(
	'header'   => esc_html__( 'Header Navigation', 'gillion' ),
	'topbar'   => esc_html__( 'Topbar Navigation', 'gillion' ),
	'footer'   => esc_html__( 'Footer Navigation', 'gillion' ),
) );


/**
 * Menu Walker
 */
if (class_exists('FW_Ext_Mega_Menu_Walker')) {

	class FW_Ext_Mega_Menu_Custom_Walker extends Walker_Nav_Menu
	{
		/**
		 * Start the element output.
		 *
		 * @see Walker::start_el()
		 *
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param object $item   Menu item data object.
		 * @param int    $depth  Depth of menu item. Used for padding.
		 * @param array  $args   An array of arguments. @see wp_nav_menu()
		 * @param int    $id     Current item ID.
		 */
		public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;
			/**
			 * Filter the CSS class(es) applied to a menu item's list item element.
			 *
			 * @since 3.0.0
			 * @since 4.1.0 The `$depth` parameter was added.
			 *
			 * @param array  $classes The CSS classes that are applied to the menu item's `<li>` element.
			 * @param object $item    The current menu item.
			 * @param array  $args    An array of {@see wp_nav_menu()} arguments.
			 * @param int    $depth   Depth of menu item. Used for padding.
			 */

			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
			if( fw_ext_mega_menu_get_meta( $item->ID, 'enabled' ) ) :
				$get_dynamic_elements = fw_ext_mega_menu_get_db_item_option( $item->ID, 'row/dynamic_elements' );
				if( isset( $get_dynamic_elements ) && $get_dynamic_elements && $get_dynamic_elements != 'none' ) :
					$class_names.= ' menu-item-has-children';
				endif;
			endif;

			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
			/**
			 * Filter the ID applied to a menu item's list item element.
			 *
			 * @since 3.0.1
			 * @since 4.1.0 The `$depth` parameter was added.
			 *
			 * @param string $menu_id The ID that is applied to the menu item's `<li>` element.
			 * @param object $item    The current menu item.
			 * @param array  $args    An array of {@see wp_nav_menu()} arguments.
			 * @param int    $depth   Depth of menu item. Used for padding.
			 */
			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
			$output .= $indent . '<li' . $id . $class_names .'>';
			$atts = array();
			$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
			$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
			$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
			$atts['href']   = ! empty( $item->url )        ? $item->url        : '';
			/**
			 * Filter the HTML attributes applied to a menu item's anchor element.
			 *
			 * @since 3.6.0
			 * @since 4.1.0 The `$depth` parameter was added.
			 *
			 * @param array $atts {
			 *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
			 *
			 *     @type string $title  Title attribute.
			 *     @type string $target Target attribute.
			 *     @type string $rel    The rel attribute.
			 *     @type string $href   The href attribute.
			 * }
			 * @param object $item  The current menu item.
			 * @param array  $args  An array of {@see wp_nav_menu()} arguments.
			 * @param int    $depth Depth of menu item. Used for padding.
			 */
			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );
			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}
	# BEGIN - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
			// $item_output = $args->before;
			// $item_output .= '<a'. $attributes .'>';
			// /** This filter is documented in wp-includes/post-template.php */
			// $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
			// $item_output .= '</a>';
			// $item_output .= $args->after;
			$title = apply_filters('the_title', $item->title, $item->ID);
			$attributes = array_filter($atts);
			$item_output = fw_ext('megamenu')->render_str('item-link', compact('item', 'attributes', 'title', 'args', 'depth'));
	# END - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
			/**
			 * Filter a menu item's starting output.
			 *
			 * The menu item's starting output only includes $args->before, the opening <a>,
			 * the menu item's title, the closing </a>, and $args->after. Currently, there is
			 * no filter for modifying the opening and closing <li> for a menu item.
			 *
			 * @since 3.0.0
			 *
			 * @see wp_nav_menu()
			 *
			 * @param string $item_output The menu item's starting HTML output.
			 * @param object $item        Menu item data object.
			 * @param int    $depth       Depth of menu item. Used for padding.
			 * @param array  $args        An array of wp_nav_menu() arguments.
			 */
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
		/**
		 * @see Walker::display_element
		 */
		function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
			if ( !$element )
				return;
			$args_menu_class = ( isset( $args[0]->menu_class ) ) ? $args[0]->menu_class : '';
			$id_field = $this->db_fields['id'];
			$id       = $element->$id_field;
			//display this element
			$this->has_children = ! empty( $children_elements[ $id ] );
			if ( isset( $args[0] ) && is_array( $args[0] ) ) {
				$args[0]['has_children'] = $this->has_children; // Backwards compatibility.
			}
			$cb_args = array_merge( array(&$output, $element, $depth), $args);
			call_user_func_array(array($this, 'start_el'), $cb_args);
			// descend only when the depth is right and there are childrens for this element
			if ( ($max_depth == 0 || $max_depth > $depth+1 ) && isset( $children_elements[$id]) ) {
				foreach( $children_elements[ $id ] as $child ){
					$dynamic_elements = false;
	# BEGIN - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
					if ($depth == 0 && fw_ext_mega_menu_get_meta($id, 'enabled') && fw_ext_mega_menu_get_meta($child, 'new-row')) {
						if (isset($newlevel) && $newlevel) {
							$cb_args = array_merge( array(&$output, $depth), $args);
							call_user_func_array(array($this, 'end_lvl'), $cb_args);
							unset($newlevel);
						}
					}
	# END - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
					if ( !isset($newlevel) ) {
						$newlevel = true;
	# BEGIN - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
						if (!isset($mega_menu_container) && $depth == 0 && fw_ext_mega_menu_get_meta($id, 'enabled')) {
							$mega_menu_container = apply_filters('fw_ext_mega_menu_container', array(
								'tag'  => 'div',
								'attr' => array( 'class' => 'mega-menu' )
							), array(
								'element' => $element,
								'children_elements' => $children_elements,
								'max_depth' => $max_depth,
								'depth' => $depth,
								'args' => $args,
							));
							$get_dynamic_elements = fw_ext_mega_menu_get_db_item_option( $element->ID, 'row/dynamic_elements' );
							if( $args_menu_class != 'sh-mobile-header-view' && isset( $get_dynamic_elements ) && $get_dynamic_elements && $get_dynamic_elements != 'none' ) :
								$output.= $this->dynamic_elements( $element->ID, $get_dynamic_elements );
							endif;
						}
						$classes = array('sub-menu' => true);
						if (isset($mega_menu_container)) {
							if ($this->row_contains_icons($element, $child, $children_elements)) {
								$classes['sub-menu-has-icons'] = true;
							}
							$classes['mega-menu-row'] = true;;
						}
						else {
							if ($this->sub_menu_contains_icons($element, $children_elements)) {
								$classes['sub-menu-has-icons'] = true;
							}
						}
						$classes = apply_filters('fw_ext_mega_menu_start_lvl_classes', $classes, array(
							'element' => $element,
							'children_elements' => $children_elements,
							'max_depth' => $max_depth,
							'depth' => $depth,
							'args' => $args,
							'mega_menu_container' => isset($mega_menu_container) ? $mega_menu_container : false
						));
						$classes = array_filter($classes);

	# END - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
						//start the child delimiter
	# BEGIN - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
						//$cb_args = array_merge( array(&$output, $depth), $args);
						$cb_args = array_merge( array(&$output, $depth), $args, array(
							implode(' ', array_keys($classes))
						));
	# END - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
						call_user_func_array(array($this, 'start_lvl'), $cb_args);
					}

					$this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
				}
				unset( $children_elements[ $id ] );


			} else if (!isset($mega_menu_container) && $depth == 0 && fw_ext_mega_menu_get_meta($id, 'enabled')) {
				$mega_menu_container = apply_filters('fw_ext_mega_menu_container', array(
					'tag'  => 'div',
					'attr' => array( 'class' => 'mega-menu' )
				), array(
					'element' => $element,
					'max_depth' => $max_depth,
					'depth' => $depth,
					'args' => $args,
				));
				$get_dynamic_elements = fw_ext_mega_menu_get_db_item_option( $element->ID, 'row/dynamic_elements' );
				if( $args_menu_class != 'sh-mobile-header-view' && isset( $get_dynamic_elements ) && $get_dynamic_elements && $get_dynamic_elements != 'none' ) :
					$output.= $this->dynamic_elements( $element->ID, $get_dynamic_elements );
				endif;
			}

			if ( isset($newlevel) && $newlevel ){
				//end the child delimiter
				$cb_args = array_merge( array(&$output, $depth), $args);
				call_user_func_array(array($this, 'end_lvl'), $cb_args);
			}
	# BEGIN - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

		if (isset($mega_menu_container)) :
			if( $args_menu_class != 'sh-mobile-header-view' && isset( $get_dynamic_elements ) && $get_dynamic_elements && $get_dynamic_elements != 'none' ) :
				$output .= '</div>';
			endif;
		endif;

	# END - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
			//end this element
			$cb_args = array_merge( array(&$output, $element, $depth), $args);
			call_user_func_array(array($this, 'end_el'), $cb_args);
		}
		function start_lvl( &$output, $depth = 0, $args = array(), $class = 'sub-menu' ) {
			$indent = str_repeat("\t", $depth);
			$output .= "\n$indent<ul class=\"$class\">\n";
		}
		protected function sub_menu_contains_icons($element, $children_elements) {
			$id_field = $this->db_fields['id'];
			$id = $element->$id_field;
			foreach ($children_elements[$id] as $child) {
				if (fw_ext_mega_menu_get_meta($child, 'icon')) {
					return true;
				}
			}
			return false;
		}
		protected function row_contains_icons($row, $first_column, $children_elements) {
			$id_field = $this->db_fields['id'];
			$row_id = $row->$id_field;
			reset($children_elements[$row_id]);
			// navigate to $first_column
			while ($child = next($children_elements[$row_id])) {
				if ($child->$id_field == $first_column->$id_field) {
					break;
				}
			}
			// scan row
			while (true) {
				if (fw_ext_mega_menu_get_meta($child, 'icon')) {
					return true;
				}
				$child = next($children_elements[$row_id]);
				if ($child === false || fw_ext_mega_menu_get_meta($child, 'new-row')) {
					break;
				}
			}
			return false;
		}





		protected function dynamic_elements( $id = '', $type = '' ) {
			if( $id > 0 && $type != 'none' ) :
				$get_dynamic_elements = fw_ext_mega_menu_get_db_item_option( $id, 'row/dynamic_elements' );
				if( isset( $get_dynamic_elements ) && $get_dynamic_elements && $get_dynamic_elements != 'none' ) :

					$per_page = ( fw_ext_mega_menu_get_db_item_option( $id, 'row/per_page' ) > 0 ) ? intval( fw_ext_mega_menu_get_db_item_option( $id, 'row/per_page' ) ) : 'default';
					$limit = ( fw_ext_mega_menu_get_db_item_option( $id, 'row/limit' ) > 0 ) ? intval( fw_ext_mega_menu_get_db_item_option( $id, 'row/limit' ) ) : 8;
					$categories = ( fw_ext_mega_menu_get_db_item_option( $id, 'row/categories' ) ) ? fw_ext_mega_menu_get_db_item_option( $id, 'row/categories' ) : '';
					$categories_order = ( fw_ext_mega_menu_get_db_item_option( $id, 'row/categories_order' ) ) ? fw_ext_mega_menu_get_db_item_option( $id, 'row/categories_order' ) : 'default';

					if( function_exists( 'gillion_showcase_categories' ) ) :
						$categories_tabs = gillion_showcase_categories( $categories);
					else :
						$order = ( $categories_order == 'default' ) ? 'name' : 'include';
						$categories_tabs = get_terms( array(
							'taxonomy' => 'category',
							'hide_empty' => false,
							'include' => $categories,
							'orderby' => $order
						));
					endif;

					$item_per_page = ( count( $categories_tabs ) == 1 ) ? 5 : 4;
					$item_per_page = ( $per_page != 'default' && $per_page > 0 ) ? $per_page : $item_per_page;
					$rand = gillion_rand(6);
					ob_start(); ?>

<ul class="sub-menu mega-menu-row mega-menu-dynamic-elements mega-menu-row-1">
	<li class="menu-item">

		<div class="row header-dynamic-categories" data-items-per-page="<?php echo esc_attr( $item_per_page ); ?>" <?php if( count( $categories_tabs ) == 1 && isset( $categories_tabs[0] ) ) : ?>
		data-cat="<?php echo esc_attr( $categories_tabs[0]->name ); ?>"
		data-cat-link="<?php echo esc_url( get_term_link( $categories_tabs[0]->term_id ) ); ?>"
		<?php endif; ?>>
			<?php if( count( $categories_tabs ) > 0) : ?>
				<?php if( count( $categories_tabs ) > 1) : ?>
					<div class="col-md-2 header-dynamic-categories-side">
						<ul class="nav nav-tabs nav-tabs-header-categories">
							<?php $n = 0; foreach( $categories_tabs as $catgory ) : $n++; ?>
								<li<?php echo ($n == 1) ? ' class="active"' : ''; ?>>
									<a href="<?php echo esc_url( get_term_link( $catgory->term_id ) ); ?>" data-target="#megatab-<?php echo esc_attr( $rand ); ?>-<?php echo esc_attr( $n ); ?>" data-toggle="tab" data-hover="tab">
										<?php echo esc_attr( $catgory->name ); ?>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endif; ?>
				<div class="col-md-<?php echo ( count( $categories_tabs ) > 1 ) ? '10' : '12'; ?>">
					<div class="tab-content header-dynamic-categories-content not-init">
						<div class="header-dynamic-categories-loader">
							<div class="loader-item">
						    	<div class="loader loader-8"></div>
						    </div>
						</div>

						<?php $n = 0; foreach( $categories_tabs as $catgory ) : $n++; $rand2 = gillion_rand(6); ?>
							<div class="tab-pane<?php echo ($n == 1) ? ' active' : ''; ?>" id="megatab-<?php echo esc_attr( $rand ); ?>-<?php echo esc_attr( $n ); ?>">

								<?php
								$args = array(
									'posts_per_page' => $limit,
									'ignore_sticky_posts' => 1,
									'tax_query' => array(
										array(
											'taxonomy' => 'category',
											'field'    => 'slug',
											'terms'    => $catgory->slug,
										),
									),
								);
								$query = new WP_Query( $args );
								if( $query->have_posts() ) :
									$totalpages = ceil( $query->post_count / $item_per_page ); ?>
									<ul class="nav nav-tabs sh-fully-hidden">
										<?php for( $j = 1; $j <= $totalpages; $j++ ) : ?>
											<li<?php echo ($j == 1) ? ' class="active"' : ''; ?>><a data-target="#megapage-<?php echo esc_attr( $rand2 ); ?>-<?php echo esc_attr( $j ); ?>" data-toggle="tab"></a></li>
										<?php endfor; ?>
									</ul>
									<div class="tab-content">
										<div class="tab-pane active" id="megapage-<?php echo esc_attr( $rand2 ); ?>-1">
											<div class="post-style-header">
											<?php $i = 0; $currentpage = 1;
											while( $query->have_posts()) : $query->the_post(); $i++;
												gillion_post_header_style();
												if( $i%$item_per_page == 0 ) : $currentpage++; ?>
													</div></div>
													<div class="tab-pane" id="megapage-<?php echo esc_attr( $rand2 ); ?>-<?php echo esc_attr( $currentpage ); ?>"><div class="post-style-header">
												<?php endif;
											endwhile; ?>
										</div></div>
									</div>
								<?php endif; wp_reset_postdata(); ?>

								<div class="sh-categories-switch<?php echo ' '.count( $categories_tabs ).'//'.$item_per_page; echo ( $totalpages > 1 ) ? '' : ' sh-categories-switch-hide'; ?>">
									<div class="tab-pagination sh-carousel-buttons-styling">
										<button type="button" class="tab-pagination-back slick-prev">
											<i class="icon icon-arrow-left-circle"></i>
										</button>
										<button type="button" class="tab-pagination-next slick-next">
											<i class="icon icon-arrow-right-circle"></i>
										</button>
									</div>
								</div>

							</div>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endif; ?>
		</div>

	</li>
</ul>
<div class="mega-menu-cleanup">
					<?php
					if( function_exists( 'gillion_showcase_categories' ) ) :
						switch_to_blog( 1 );
					endif;
					return ob_get_clean();
				endif;
			endif;
		}

	}


	// replace default walker
	{
	    remove_filter('wp_nav_menu_args', '_filter_fw_ext_mega_menu_wp_nav_menu_args');

	    /** @internal */
	    function gillion_filter_theme_ext_mega_menu_wp_nav_menu_args($args) {
	        $args['walker'] = new FW_Ext_Mega_Menu_Custom_Walker();

	        return $args;
	    }
	    add_filter('wp_nav_menu_args', 'gillion_filter_theme_ext_mega_menu_wp_nav_menu_args');
	}

}
