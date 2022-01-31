<?php
/**
 * Template Name: Portfolio
 *
 */

get_header();

brabus_render_page_header( 'page' );

$animate = get_field( 'animate' );
$wrapper_class = array();
if( $animate == 'yes' ) {
	$animation_type = get_field( 'animation_type' );

	$wrapper_class[] = 'wow';
	$wrapper_class[] = $animation_type;
}
$filter_term = false;
if( get_field( 'tags' ) && get_field( 'tags' ) > 0 ) {
	$filter_term = true;
}

$wrapper_class = implode( ' ', $wrapper_class );
?>
<main>
    <section class="content-section">
        <?php
        while ( have_posts() ) :
            the_post();
            ?>
	        <?php the_content(); ?>
        <?php
        endwhile;
        wp_reset_query();
        ?>
        <div class="container">
            <div class="row">
                <div class="col-12">
	                <?php
	                $args = array (
		                'post_type'              => 'portfolio',
		                'posts_per_page'            => -1,
		                'meta_query' => array(
			                array(
				                'key'       => '_thumbnail_id',
				                'compare'   => 'EXISTS'
			                )
		                )
	                );

	                if( $filter_term ) {
		                $args[ 'tax_query' ] = array(
			                array(
				                'taxonomy' => 'portfolio_tag',
				                'field' => 'id',
				                'terms' => array ( get_field( 'tags' ) )
			                )
		                );
	                }

	                $portfolio = new WP_Query( $args );

	                if ( $portfolio->have_posts() ) :

                        while ( $portfolio->have_posts() ) :
                            $portfolio->the_post();

                            $thumbnail_image = get_the_post_thumbnail_url( get_the_ID() );

                            $title = '';

                            if( get_field( 'listing_title_1' ) ) {
                                $title = '<span>' . get_field( 'listing_title_1' ) . '</span>';
                            }

                            if( get_field( 'listing_title_2' ) ) {
                                $title .= get_field( 'listing_title_2' );
                            }
                            ?>

                            <div class="portfolio-box <?php echo esc_attr( $wrapper_class ); ?>">
                                <figure>
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                        <img src="<?php echo esc_url( $thumbnail_image ); ?>" alt="<?php the_title_attribute(); ?>">
                                    </a>
                                </figure>
                                <div class="content-box">
                                    <div class="inner">
                                        <?php if( get_field( 'listing_tagline' ) ) { ?>
                                            <small><?php the_field( 'listing_tagline' ); ?></small>
                                        <?php } ?>
                                        <h3><?php echo wp_kses_post( $title ); ?></h3>
                                        <div class="custom-link">
                                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                                <div class="lines"> <span></span> <span></span> </div>
                                                <b><?php echo esc_html__( 'LEARN MORE', 'brabus' ); ?></b>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        endwhile;
	                endif;
	                wp_reset_query();
	                ?>
                </div>
            </div>
        </div>

    </section>
</main>

<?php
get_footer();