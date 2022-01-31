<?php

function brabus_add_google_fonts() {

  wp_enqueue_style( 'poppins-google-fonts', 'https://fonts.googleapis.com/css?family=Poppins:400,600,800', false );
  wp_enqueue_style( 'fjalla-google-fonts', 'https://fonts.googleapis.com/css?family=Fjalla+One', false );

}

add_action( 'wp_enqueue_scripts', 'brabus_add_google_fonts' );
if ( !function_exists( 'brabus_enqueue_styles_and_scripts' ) ) {
  /**
   * This function enqueues the required css and js files.
   *
   * @return void
   */
  function brabus_enqueue_styles_and_scripts() {
    /**
     * Enqueue css files.
     */
    wp_enqueue_style( 'animate', get_template_directory_uri() . '/css/animate.min.css' );
    wp_enqueue_style( 'odometer', get_template_directory_uri() . '/css/odometer.min.css' );
    wp_enqueue_style( 'swiper', get_template_directory_uri() . '/css/swiper.min.css' );
    wp_enqueue_style( 'fancybox', get_template_directory_uri() . '/css/fancybox.min.css' );
    wp_enqueue_style( 'bootsrap', get_template_directory_uri() . '/css/bootstrap.min.css' );
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css' );
    wp_enqueue_style( 'brabus-main-style', get_template_directory_uri() . '/css/style.css' );
    wp_enqueue_style( 'brabus-stylesheet', get_stylesheet_uri() );
    wp_add_inline_style( 'brabus-stylesheet', brabus_dynamic_css() );

    /**
     * Enqueue javascript files.
     */

    wp_enqueue_script( 'comments', get_template_directory_uri() . '/js/comments.js', array(), false, false );
    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'swiper', get_template_directory_uri() . '/js/swiper.min.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'tilt', get_template_directory_uri() . '/js/tilt.jquery.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'typewriter', get_template_directory_uri() . '/js/jquery.typewriter.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'odometer', get_template_directory_uri() . '/js/odometer.min.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'wow', get_template_directory_uri() . '/js/wow.min.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'fancybox', get_template_directory_uri() . '/js/fancybox.min.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'brabus-scripts', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ), false, true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
      wp_enqueue_script( 'comment-reply' );
    }

    $data = array(
      'pre_loader_typewriter' => [],
      'audio_source' => '',
      'enable_sound_bar' => false
    );

    if ( brabus_get_option( 'enable_preloader' ) ) {
      $typewriter_text = [];
      $text_rotater = brabus_get_option( 'pre_loader_text_rotater' );
      if ( $text_rotater ) {
        foreach ( $text_rotater as $rotater ) {
          $typewriter_text[] = esc_html( $rotater[ 'title' ] );
        }
      }
      $data[ 'pre_loader_typewriter' ] = $typewriter_text;
    }
    if ( brabus_get_option( 'enable_soundbar' ) ) {
      $data[ 'audio_source' ] = brabus_get_option( 'sound_bar_audio' ) ? esc_url( brabus_get_option( 'sound_bar_audio' ) ) : get_template_directory_uri() . '/audio/audio.mp3';
      $data[ 'enable_sound_bar' ] = true;
    }

    $comment_data = array(
      'name' => esc_html__( 'Name is required', 'brabus' ),
      'email' => esc_html__( 'Email is required', 'brabus' ),
      'comment' => esc_html__( 'Comment is required', 'brabus' ),

    );

    wp_localize_script( 'brabus-scripts', 'data', $data );
    wp_localize_script( 'comments', 'comment_data', $comment_data );
  }

  add_action( 'wp_enqueue_scripts', 'brabus_enqueue_styles_and_scripts', 10 );
}

if ( !function_exists( 'brabus_dynamic_css' ) ) {
  function brabus_dynamic_css() {

    $styles = '';
    if ( brabus_get_option( 'logo_height' ) ) {
      $logo_height = str_replace( ' ', '', brabus_get_option( 'logo_height' ) );
      $logo_height = str_replace( 'px', '', $logo_height );
      $styles .= "
				body .navbar > .logo img{
					height: {$logo_height}px;
				}
			";
    }
    if ( brabus_get_option( 'enable_dynamic_color' ) ) {

      $site_color = ( brabus_get_option( 'theme_color' ) ) ? brabus_get_option( 'theme_color' ) : '#01f7b6';
      $site_color2 = ( brabus_get_option( 'theme_color2' ) ) ? brabus_get_option( 'theme_color2' ) : '#e8293b';
      $body_color = ( brabus_get_option( 'body_color' ) ) ? brabus_get_option( 'body_color' ) : '#0e0e0e';

      $styles .= "
			
			
			:root {
  --color-main: $site_color; 
  --color-red: $site_color2; 
  --color-dark: $body_color; 
}


			
				
			";
    }

    return $styles;
  }
}

add_action( 'init', 'brabus_dynamic_css' );