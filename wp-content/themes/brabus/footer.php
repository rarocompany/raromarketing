<?php
$layout = ( brabus_get_option( 'layout' ) ) ? brabus_get_option( 'layout' ) : 'layout_one';

$show_social_icons = brabus_get_option( 'footer_show_social_links' );
$show_social_title = ( brabus_get_option( 'footer_social_link_title' ) ) ? brabus_get_option( 'footer_social_link_title' ) : 'Connect with us';

$copyright = brabus_get_option( 'footer_copyright_text' );

if ( !$copyright ) {
  $copyright = esc_html__( 'Brabus | Contemporary Portfolio Theme for Agencies', 'brabus' );
}
?>

<!-- end clients -->
<footer class="footer <?php echo esc_attr( $layout ); ?>">
  <?php if( brabus_get_option( 'footer_show_call_to_action' ) || !brabus_get_option( 'footer_hide_logo' ) ) { ?>
  <div class="footer-quote wow fadeIn">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <?php
          if ( !brabus_get_option( 'footer_hide_logo' ) ) {
            $logo = ( brabus_get_option( 'footer_logo' ) ) ? brabus_get_option( 'footer_logo' ) : get_template_directory_uri() . '/images/logo.png';
            ?>
          <img src="<?php echo esc_url( $logo ); ?>" alt="<?php bloginfo( 'name' ); ?>" />
          <?php } ?>
          <?php if( brabus_get_option( 'footer_show_call_to_action' ) ) { ?>
          <h2> <?php echo wp_kses_post( brabus_get_option( 'footer_cta_content' ) ); ?> </h2>
          <?php if( brabus_get_option( 'footer_cta_button_label' ) ) { ?>
          <a href="<?php echo esc_attr( brabus_get_option( 'footer_cta_button_link' ) ); ?>" title="<?php echo esc_attr( brabus_get_option( 'footer_cta_button_label' ) ); ?>" class="footer-cta"><?php echo esc_html( brabus_get_option( 'footer_cta_button_label' ) ); ?></a>
          <?php } ?>
          <?php } ?>
        </div>
      </div>
      <!-- end row --> 
    </div>
    <!-- end container --> 
  </div>
  <?php } ?>
  <?php if( $layout === 'layout_one' && ( is_active_sidebar( 'footer-widget-1' ) || is_active_sidebar( 'footer-widget-2' ) || is_active_sidebar( 'footer-widget-3' ) ) ) { ?>
  <div class="footer-contact wow fadeIn">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-6">
          <?php dynamic_sidebar( 'footer-widget-1' ); ?>
        </div>
        <!-- end col-4 -->
        <div class="col-lg-4 col-md-6">
          <?php dynamic_sidebar( 'footer-widget-2' ); ?>
        </div>
        <!-- end col-4 -->
        <div class="col-lg-4">
          <?php dynamic_sidebar( 'footer-widget-3' ); ?>
        </div>
        <!-- end col-2 --> 
      </div>
      <!-- end row --> 
    </div>
    <!-- end container --> 
  </div>
  <!-- end footer-contact -->
  <?php } ?>
  <?php if( ( $show_social_icons && $layout === 'layout_one') || $copyright || ( $layout === 'layout_two' && brabus_get_option( 'footer_site_credit' ) ) ) { ?>
  <div class="footer-bottom wow fadeIn">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <?php
          if ( $show_social_icons && $layout === 'layout_one' ) {
            ?>
          <h5><?php echo esc_html( $show_social_title ); ?></h5>
          <?php
          $social_media = brabus_get_option( 'social_media' );
          if ( $social_media ) {
            ?>
          <ul>
            <?php foreach ( $social_media as $social ) { ?>
            <li><a href="<?php echo esc_url( $social['url'] ); ?>" target="_blank"><?php echo esc_html( $social['title'] ); ?></a></li>
            <?php } ?>
          </ul>
          <?php
          }
          ?>
          <?php } ?>
        </div>
        <?php if( $copyright || ( $layout === 'layout_two' && brabus_get_option( 'footer_site_credit' ) ) ) { ?>
        <div class="col-12">
          <p class="copyright">&copy; <?php echo date("Y"); ?> <?php echo wp_kses_post( $copyright ); ?></p>
          <?php if( $layout === 'layout_two' && brabus_get_option( 'footer_site_credit' ) ) { ?>
          <p class="site-credit"><?php echo wp_kses_post( brabus_get_option( 'footer_site_credit' ) ); ?></p>
          <?php } ?>
        </div>
        <?php } ?>
      </div>
      <!-- end row --> 
    </div>
    <!-- end container --> 
  </div>
  <!-- end footer-bottom -->
  <?php } ?>
</footer>
<?php
if ( brabus_get_option( 'enable_hamburger_menu_click_sound' ) ) {
  $hamburger_menu_audio_file = brabus_get_option( 'hamburger_menu_audio_file' ) ? brabus_get_option( 'hamburger_menu_audio_file' ) : get_template_directory_uri() . '/audio/link.mp3';
  ?>
<audio id="hamburger-hover" src="<?php echo esc_url( $hamburger_menu_audio_file ); ?>" preload="auto"></audio>
<?php
}
?>
<!-- end footer -->
<?php wp_footer(); ?>
</body></html>