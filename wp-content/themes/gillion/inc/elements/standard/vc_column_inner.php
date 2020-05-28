<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $el_id
 * @var $width
 * @var $css
 * @var $offset
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Column_Inner
 */
$el_class = $width = $el_id = $css = $offset = '';
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$width = wpb_translateColumnWidthToSpan( $width );
$width = vc_column_offset_class_merge( $offset, $width );

$css_classes = array(
	$this->getExtraClass( $el_class ),
	'wpb_column',
	'vc_column_container',
	$width,
);

if ( vc_shortcode_custom_css_has_property( $css, array(
	'border',
	'background',
) ) ) {
	$css_classes[] = 'vc_col-has-fill';
}


/* Jevelin Custom Changes - Starts */
$shadow = ( isset( $shadow ) ) ? $shadow : 'disabled';
$shadow_hover = ( isset( $shadow_hover ) ) ? $shadow_hover : 'disabled';
$zindex = ( isset( $zindex ) ) ? $zindex : '';
$padding = ( isset( $padding_tablet ) ) ? $padding_tablet : '';
$max_width = ( isset( $max_width ) ) ? $max_width : '';
$background_image_hover = ( isset( $background_image_hover ) ) ? $background_image_hover : '';
$max_width = ( isset( $max_width ) && is_numeric( $max_width ) ) ? $max_width.'px' : $max_width;
$max_width_alignment = ( isset( $max_width_alignment ) && $max_width_alignment && in_array( $max_width_alignment, array( 'left', 'center', 'right' ) ) ) ? $max_width_alignment : 'center';
$max_width_alignment_mobile = ( isset( $max_width_alignment_mobile ) && $max_width_alignment_mobile && in_array( $max_width_alignment, array( 'left', 'center', 'right' ) ) ) ? $max_width_alignment_mobile : '';
$responsive_border = ( isset( $responsive_border ) ) ? $responsive_border : '';
$mobile_element_alignment = ( isset( $mobile_element_alignment ) ) ? $mobile_element_alignment : '';
$element_id = 'vc_column_'.rand();
$style_element = '';
$element_css = '';

if( $mobile_element_alignment && $mobile_element_alignment != 'disabled' ) :
	$css_classes[] = 'vc_column_mobile_element_alignment_'.esc_attr( $mobile_element_alignment );
endif;

if( $shadow && $shadow != 'disabled' ) :
	$css_classes[] = 'vc_column_'.esc_attr( $shadow );
endif;

if( $shadow_hover && $shadow_hover != 'disabled' ) :
	$css_classes[] = 'vc_column_'.esc_attr( $shadow_hover ).'_hover';
endif;

if( $responsive_border == 'disabled' ) :
	$css_classes[] = 'vc_column_reponsive_border_disabled';
endif;

if( $max_width ) :
	$style_element.= 'width: 100%; max-width: '.$max_width.';';

	// Desktop alignment
	if( $max_width_alignment == 'center' ) :
		$style_element.= 'margin-left: auto; margin-right: auto;';
	elseif( $max_width_alignment == 'left' ) :
		$style_element.= 'margin-left: 0; margin-right: auto;';
	else :
		$style_element.= 'margin-left: auto; margin-right: 0;';
	endif;

	// Mobile alignment
	if( $max_width_alignment_mobile == 'center' ) :
		$element_css.= '@media (max-width: 800px) {.'.$element_id.' > .vc_column-inner > .wpb_wrapper { margin-left: auto!important; margin-right: auto!important; }}';
	elseif( $max_width_alignment_mobile == 'left' ) :
		$element_css.= '@media (max-width: 800px) {.'.$element_id.' > .vc_column-inner > .wpb_wrapper { margin-left: 0!important; margin-right: auto!important; }}';
	elseif( $max_width_alignment_mobile == 'right' ) :
		$element_css.= '@media (max-width: 800px) {.'.$element_id.' > .vc_column-inner > .wpb_wrapper { margin-left: auto!important; margin-right: 0!important; }}';
	endif;
endif;

if( $zindex ) :
	$wrapper_attributes[] = 'style="z-index: '.$zindex.';"';
endif;

if( $style_element ) :
	$style_element = ' style="'.$style_element.'"';
endif;

if( $padding ) :
	$element_css.= '@media (max-width: 800px) {.'.$element_id.' > .vc_column-inner { padding: '.$padding.'!important;}}';
endif;

if( $background_image_hover ) :
	$element_css.= '.'.$element_id.':hover > .vc_column-inner { background-image: url( '.jevelin_get_small_thumb( $background_image_hover, 'large' ).' )!important; } ';
	$element_css.= '.'.$element_id.' > .vc_column-inner { transition: 0.3s all ease-in-out; }.';
endif;

if( $element_css ) :
	$element_css = '<style type="text/css">'.$element_css.'</style>';
	$css_classes[] = $element_id;
endif;
/* Jevelin Custom Changes - Ends */


$wrapper_attributes = array();

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}
$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
$output .= '<div class="vc_column-inner ' . esc_attr( trim( vc_shortcode_custom_css_class( $css ) ) ) . '">';
$output .= '<div class="wpb_wrapper"'. $style_element .'>'; /* Jevelin Custom Changes - $style_element */
$output .= wpb_js_remove_wpautop( $content ).$element_css; /* Jevelin Custom Changes - .$element_css */
$output .= '</div>';
$output .= '</div>';
$output .= '</div>';

echo $output;
