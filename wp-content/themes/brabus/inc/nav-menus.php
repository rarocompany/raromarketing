<?php

if( ! function_exists( 'brabus_register_nav_menus' ) ) {
	/**
	 * Register required nav menus
	 */
	function brabus_register_nav_menus() {

		register_nav_menus( array(
			'main_menu' => __( 'Main menu', 'brabus' ),
		) );

		register_nav_menus( array(
			'left_menu' => __( 'Left menu', 'brabus' ),
		) );

	}
	add_action( 'after_setup_theme', 'brabus_register_nav_menus' );
}