<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Brabus
 */

get_header(); ?>


<?php
brabus_render_page_header( 'archive' );

$show_sidebar = ( brabus_get_option( 'archive_show_sidebar' ) ) ? brabus_get_option( 'archive_show_sidebar' ) : 'yes';
$type = ( brabus_get_option( 'archive_type' ) ) ? brabus_get_option( 'archive_type' ) : 'normal';
$wrapper_cols = '10';
$section_class = 'blog';

$page_template = 'listing';

if( $type == 'layout1' ) {
	$wrapper_cols = '12';
	$section_class = 'news';
	$page_template = 'listing_layout_one';
}
if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	$show_sidebar = 'no';
}

if( $show_sidebar == 'yes' ) {
	$wrapper_cols = '8';
}
?>
    <main>
        <section class="<?php echo esc_attr( $section_class, 'brabus' ); ?>">
            <div class="container">
                <div class="row justify-content-center">

					<?php if ( have_posts() ) :
						?>
                        <div class="col-lg-<?php echo esc_attr( $wrapper_cols ); ?>">
							<?php
							while ( have_posts() ) :
								the_post();

								get_template_part( 'template-parts/' . $page_template );

							endwhile;
							// show pagination
							brabus_pagination();
							?>
                        </div>
                        <!-- end col-8 -->
						<?php
						if( $show_sidebar == 'yes' ){
							?>
                            <div class="col-lg-4">
								<?php get_sidebar(); ?>
                            </div>
                            <!-- end col-4 -->
							<?php
						}
						?>
					<?php
					else :
						get_template_part( 'template-parts/content', 'none' );

					endif;
					?>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </section>
    </main>
    <!-- end blog -->
<?php
get_footer();