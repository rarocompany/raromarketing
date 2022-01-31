<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="https://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php
$nav_menu_type = ( brabus_get_option( 'nav_menu_type' ) ) ? brabus_get_option( 'nav_menu_type' ) : 'nav-menu-horizontal';



$social_media = brabus_get_option( 'social_media' );
	
	$logo_retina = ( brabus_get_option( 'logo_retina' ) ) ? brabus_get_option( 'logo_retina' ) : '';
$logo = ( brabus_get_option( 'logo' ) ) ? brabus_get_option( 'logo' ) : get_template_directory_uri() . '/images/logo@2x.png';

	
	
$nav_menu_label = ( brabus_get_option( 'nav_menu_label' ) ) ? brabus_get_option( 'nav_menu_label' ) : esc_html__( 'MENU', 'brabus' );
?>
<?php
if ( brabus_get_option( 'enable_preloader' ) ):
  $pre_loader_icon = ( brabus_get_option( 'pre_loader_icon' ) ) ? brabus_get_option( 'pre_loader_icon' ) : get_template_directory_uri() . '/images/preloader.gif';
$pre_loader_bg = ( brabus_get_option( 'pre_loader_wrapper_bg_color' ) !== '' ) ? brabus_get_option( 'pre_loader_wrapper_bg_color' ) : '#01f7b6';
$style = 'background: ' . esc_attr( $pre_loader_bg ) . ' !important;';

?>
<div class="preloader" style="<?php echo esc_attr( $style ); ?>">
  <div class="layer"></div>
  <div class="layer"></div>
  <div class="layer"></div>
  <div class="layer"></div>
  <div class="inner">
    <figure class="fadeInUp animated"> <img src="<?php echo esc_url( $pre_loader_icon ); ?>" alt="<?php bloginfo( 'name' ); ?>"> </figure>
    <span class="typewriter" id="typewriter"></span> </div>
  <!-- end inner --> 
</div>
<div class="transition-overlay">
  <div class="layer"></div>
  <div class="layer"></div>
  <div class="layer"></div>
  <div class="layer"></div>
</div>
<?php endif; ?>
<div class="navigation-menu">
  <div class="bg-layers"> <span></span> <span></span> <span></span> <span></span> </div>
  <!-- end bg-layers -->
  <div class="inner">
    <div class="menu brabus-nav">
      <?php
      wp_nav_menu( array(
        'theme_location' => 'main_menu',
        'walker' => new Hamburger_Menu_Walker(),
        'container' => ''
      ) );
      ?>
    </div>
    <?php if( brabus_get_option( 'header_call_to_action' ) && $nav_menu_type !== 'nav-menu-horizontal' ) { ?>
    <blockquote> <?php echo wp_kses_post( brabus_get_option( 'header_cta_content' ) ); ?>
      <?php if( brabus_get_option( 'header_cta_button_label' ) ) { ?>
      <a href="<?php echo esc_attr( brabus_get_option( 'header_cta_button_link' ) ); ?>" title="<?php echo esc_attr( brabus_get_option( 'header_cta_button_label' ) ); ?>" class="footer-cta"><?php echo esc_html( brabus_get_option( 'header_cta_button_label' ) ); ?></a>
      <?php } ?>
    </blockquote>
    <?php } ?>
  </div>
  <!-- end inner --> 
</div>
<?php

if ( $nav_menu_type === 'nav-menu-hamburger' ):
  ?>
<nav class="navbar">
  <div class="left">
    <?php
    wp_nav_menu( array(
      'theme_location' => 'left_menu',
      'container' => ''
    ) );
    ?>
  </div>
  <div class="logo"> <a href="<?php echo esc_url( home_url( '/' ) ); ?>"> <img src="<?php echo esc_url( $logo ); ?>" <?php if( $logo_retina != '' ) : ?> srcset="<?php echo esc_url( $logo_retina ); ?>" <?php endif; ?> alt="<?php bloginfo( 'name' ); ?>"> </a> </div>
  <div class="right">
    <?php brabus_get_wpml_langs(); ?>
    <div class="hamburger-menu"><b><?php echo esc_html( $nav_menu_label ); ?></b>
      <div class="hamburger" id="hamburger-menu"> <span></span> <span></span> <span></span> </div>
    </div>
  </div>
</nav>
<?php endif; ?>
	
<?php

if ( $nav_menu_type === 'nav-menu-horizontal' ):
  ?>	
<nav class="navbar">
  <div class="logo"> <a href="<?php echo esc_url( home_url( '/' ) ); ?>"> <img src="<?php echo esc_url( $logo ); ?>" <?php if( $logo_retina != '' ) : ?> srcset="<?php echo esc_url( $logo_retina ); ?>" <?php endif; ?> alt="<?php bloginfo( 'name' ); ?>"></a> </div>
	  <?php  if ( has_nav_menu( 'main_menu' ) ) { ?>
  <div class="right">
    <?php brabus_get_wpml_langs(); ?>
   
  
    <div class="site-menu">
      <?php
      wp_nav_menu( array(
        'theme_location' => 'main_menu',
        'container' => ''
      ) );
      ?>
    </div>
    <div class="hamburger-menu"><b><?php echo esc_html( $nav_menu_label ); ?></b>
      <div class="hamburger" id="hamburger-menu"> <span></span> <span></span> <span></span> </div>
    </div>
   
  </div>
	 <?php } ?>
</nav>

<?php endif; ?>