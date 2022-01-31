<?php
/*
Plugin Name: Themezinho Core
Plugin URI: https://themeforest.net/user/themezinho/portfolio
Description: Themezinho Core
Author: Themezinho
Version: 1.1.1
Author URI: http://themezinho.net/
*/

define( "THEMEZINHO_CORE_PATH", plugin_dir_path( __FILE__ ) );
define( "THEMEZINHO_CORE_URI", plugins_url( 'themezinho_core/'  ) );
define( "PAGE_BUILDER_GROUP", __( 'Brabus', 'themezinho' ) );

add_action( 'vc_before_init', 'themezinho_vc_addons' );
/**
* JS Composer Elements
*/

function themezinho_vc_addons() {
	require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/elements/contact-box.php';
	require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/elements/client-box.php';
	require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/elements/google-maps.php';
	require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/elements/header.php';
	require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/elements/image-box.php';
	require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/elements/portfolio.php';
	require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/elements/process-box.php';
	require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/elements/section-title.php';
	require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/elements/service-box.php';
	require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/elements/team-member.php';
	require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/elements/text-box.php';
}

require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/vc_extra_params.php';

/**
 * Include advanced custom field
 */
// 1. customize ACF path
add_filter('acf/settings/path', 'themezinho_acf_settings_path');

function themezinho_acf_settings_path( $path ) {
	$path = THEMEZINHO_CORE_PATH . '/inc/acf/';

	return $path;
}


// 2. customize ACF dir
add_filter('acf/settings/dir', 'themezinho_acf_settings_dir');

function themezinho_acf_settings_dir( $dir ) {
	$dir = THEMEZINHO_CORE_URI . '/inc/acf/';

	return $dir;
}

//Hide ACF field group menu item
 add_filter('acf/settings/show_admin', '__return_false');
require THEMEZINHO_CORE_PATH .  '/inc/acf/acf.php';

require_once THEMEZINHO_CORE_PATH . '/inc/theme-options.php';

require_once THEMEZINHO_CORE_PATH . '/inc/cpt-taxonomy.php';


function motts_animations(){

    return array(
	    'bounce' => 'bounce',
	    'flash' => 'flash',
	    'pulse' => 'pulse',
	    'rubberBand' => 'rubberBand',
	    'shake' => 'shake',
	    'headShake' => 'headShake',
	    'swing' => 'swing',
	    'tada' => 'tada',
	    'wobble' => 'wobble',
	    'jello' => 'jello',
	    'bounceIn' => 'bounceIn',
	    'bounceInDown' => 'bounceInDown',
	    'bounceInLeft' => 'bounceInLeft',
	    'bounceInRight' => 'bounceInRight',
	    'bounceInUp' => 'bounceInUp',
	    'bounceOut' => 'bounceOut',
	    'bounceOutDown' => 'bounceOutDown',
	    'bounceOutLeft' => 'bounceOutLeft',
	    'bounceOutRight' => 'bounceOutRight',
	    'bounceOutUp' => 'bounceOutUp',
	    'fadeIn' => 'fadeIn',
	    'fadeInDown' => 'fadeInDown',
	    'fadeInDownBig' => 'fadeInDownBig',
	    'fadeInLeft' => 'fadeInLeft',
	    'fadeInLeftBig' => 'fadeInLeftBig',
	    'fadeInRight' => 'fadeInRight',
	    'fadeInRightBig' => 'fadeInRightBig',
	    'fadeInUp' => 'fadeInUp',
	    'fadeInUpBig' => 'fadeInUpBig',
	    'fadeOut' => 'fadeOut',
	    'fadeOutDown' => 'fadeOutDown',
	    'fadeOutDownBig' => 'fadeOutDownBig',
	    'fadeOutLeft' => 'fadeOutLeft',
	    'fadeOutLeftBig' => 'fadeOutLeftBig',
	    'fadeOutRight' => 'fadeOutRight',
	    'fadeOutRightBig' => 'fadeOutRightBig',
	    'fadeOutUp' => 'fadeOutUp',
	    'fadeOutUpBig' => 'fadeOutUpBig',
	    'flipInX' => 'flipInX',
	    'flipInY' => 'flipInY',
	    'flipOutX' => 'flipOutX',
	    'flipOutY' => 'flipOutY',
	    'lightSpeedIn' => 'lightSpeedIn',
	    'lightSpeedOut' => 'lightSpeedOut',
	    'rotateIn' => 'rotateIn',
	    'rotateInDownLeft' => 'rotateInDownLeft',
	    'rotateInDownRight' => 'rotateInDownRight',
	    'rotateInUpLeft' => 'rotateInUpLeft',
	    'rotateInUpRight' => 'rotateInUpRight',
	    'rotateOut' => 'rotateOut',
	    'rotateOutDownLeft' => 'rotateOutDownLeft',
	    'rotateOutDownRight' => 'rotateOutDownRight',
	    'rotateOutUpLeft' => 'rotateOutUpLeft',
	    'rotateOutUpRight' => 'rotateOutUpRight',
	    'hinge' => 'hinge',
	    'jackInTheBox' => 'jackInTheBox',
	    'rollIn' => 'rollIn',
	    'rollOut' => 'rollOut',
	    'zoomIn' => 'zoomIn',
	    'zoomInDown' => 'zoomInDown',
        'zoomInLeft' => 'zoomInLeft',
        'zoomInRight' => 'zoomInRight',
        'zoomInUp' => 'zoomInUp',
        'zoomOut' => 'zoomOut',
        'zoomOutDown' => 'zoomOutDown',
        'zoomOutLeft' => 'zoomOutLeft',
        'zoomOutRight' => 'zoomOutRight',
        'zoomOutUp' => 'zoomOutUp',
        'slideInDown' => 'slideInDown',
        'slideInLeft' => 'slideInLeft',
        'slideInRight' => 'slideInRight',
        'slideInUp' => 'slideInUp',
        'slideOutDown' => 'slideOutDown',
        'slideOutLeft' => 'slideOutLeft',
        'slideOutRight' => 'slideOutRight',
        'slideOutUp' => 'slideOutUp',
        'heartBeat' => 'heartBeat'
    );
}


function ts_get_hero_slider() {
	$args = array (
		'post_type'			=> 'hero',
		'posts_per_page'	=> -1,
	);
	$sliders = get_posts( $args );

	$_slider = array();

	if( count( $sliders ) ) {
		foreach( $sliders as $slider ) {
			$_slider[ $slider->ID . ' ' . $slider->post_title ] = $slider->ID;
		}
	}

	return $_slider;
}


// default options
function brabus_after_import(){

	update_field('enable_preloader', 1, 'option');

	// preloader text
	$preloader_text = array(
		array( 'title'		=> esc_html__( 'Please wait', 'brabus' ) ),
		array( 'title'		=> esc_html__( 'Still loading', 'brabus' ) ),
		array( 'title'		=> esc_html__( 'Almost done', 'brabus' ) ),
	);
	update_field( 'pre_loader_text_rotater', $preloader_text, 'option' );

	// social media
	$social_media = array(
		array(
			'title'		=> esc_html__( 'FACEBOOK', 'brabus' ),
			'url'		=> '#',
		),
		array(
			'title'		=> esc_html__( 'BEHANCE', 'brabus' ),
			'url'		=> '#',
		),
		array(
			'title'		=> esc_html__( 'DRIBBBLE', 'brabus' ),
			'url'		=> '#',
		),
	);
	update_field( 'social_media', $social_media, 'option' );
	update_field( 'enable_soundbar', 1, 'option');

	update_field( 'soundbar_label', wp_kses_post( "SOUND" ), 'option' );
	update_field( 'enable_scrolldown', 1, 'option');
	update_field( 'scrolldown_label', wp_kses_post( "SCROLL DOWN" ), 'option' );

	update_field( 'nav_menu_type', 'nav-menu-hamburger', 'option' );
	update_field( 'header_call_to_action', 1, 'option' );
	update_field( 'header_cta_content', wp_kses_post( "Let's create useful website for you ?" ), 'option' );

	update_field( 'archive_show_sidebar', 'no', 'option' );
	update_field( 'archive_strip_content', 'yes', 'option' );

	update_field( 'footer_show_social_links', 1, 'option' );
	update_field( 'footer_social_link_title', wp_kses_post( "CONNECT WITH US" ), 'option' );
	update_field( 'footer_show_call_to_action', 1, 'option' );
	update_field( 'footer_cta_content', wp_kses_post( "Let's create the flexible website for your business ?" ), 'option' );
}