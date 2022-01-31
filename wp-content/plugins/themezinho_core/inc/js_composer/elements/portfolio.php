<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class WPBakeryShortCode_ts_portfolio extends WPBakeryShortCode {

	protected function content( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'total_count'		    => 8,
			'animate_block'			=> 'false',
			'animation_type'		=> 'fadeIn',
            'animation_delay'       => ''
		), $atts ) );

		$total_count = (int) $total_count;
		if( $total_count < 1 ) {
			$total_count = 8;
		}
		ob_start();

        $template = locate_template( 'vc_templates/brabus/portfolio.php');
        if( $template ) {
            include( $template );
        }
        else {

            $args = array(
                'post_type' => 'portfolio',
                'posts_per_page' => $total_count,
                'meta_query' => array(
                    array(
                        'key' => '_thumbnail_id',
                        'compare' => 'EXISTS'
                    )
                )
            );
            $portfolio = new WP_Query($args);

            $wrapper_class = array();
            if ($animate_block == 'yes') {
                $wrapper_class[] = 'wow';
                $wrapper_class[] = $animation_type;
            }

            $wrapper_class = implode(' ', $wrapper_class);

            if ($portfolio->have_posts()) :
                while ($portfolio->have_posts()) :
                    $portfolio->the_post();

                    $thumbnail_image = get_the_post_thumbnail_url(get_the_ID());

                    $title = '';

                    if (get_field('listing_title_1')) {
                        $title = '<span>' . get_field('listing_title_1') . '</span>';
                    }

                    if (get_field('listing_title_2')) {
                        $title .= get_field('listing_title_2');
                    }
                    ?>

                    <div class="portfolio-box <?php echo esc_attr($wrapper_class); ?>" <?php if ($animate_block == 'yes' && $animation_delay != '') {
                        echo 'data-wow-delay="' . esc_attr($animation_delay) . '"';
                    } ?>>
                        <figure>
                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                <img src="<?php echo esc_url($thumbnail_image); ?>" alt="<?php the_title(); ?>">
                            </a>
                        </figure>
                        <div class="content-box">
                            <div class="inner">
                                <?php if (get_field('listing_tagline')) { ?>
                                    <small><?php the_field('listing_tagline'); ?></small>
                                <?php } ?>
                                <h3><?php echo wp_kses_post($title); ?></h3>
                                <div class="custom-link">
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                        <div class="lines"><span></span> <span></span></div>
                                        <b><?php echo esc_html__('LEARN MORE', 'brabus'); ?></b>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                endwhile;
            endif;

            wp_reset_query();
        }
		return ob_get_clean();
	}
}


vc_map( array(
	"base" 			    => "ts_portfolio",
	"name" 			    => __( "Portfolio", "themezinho" ),
	"icon"              => THEMEZINHO_CORE_URI . "assets/img/custom.png",
	"content_element"   => true,
	"category" 		    => PAGE_BUILDER_GROUP,
	'params' => array(
		array(
			"type" 			=> "textfield",
			"heading" 		=> __( 'Total Count', 'themezinho' ),
			"param_name" 	=> "total_count",
			"value"         => 6,
			"description"	=> "Total number of portfolio items that will be shown.",
			"group" 		=> 'General',
		),
		array(
			"type" 			=> 	"dropdown",
			"heading" 		=> 	__( 'Animate', 'themezinho' ),
			"param_name" 	=> 	"animate_block",
			"group" 		=> 'Animation',
			"value"			=>	array(
				"No"			=>		'no',
				"Yes"			=>		'yes',
			)
		),
		array(
			"type" 			=> 	"dropdown",
			"heading" 		=> 	__( 'Animation Type', 'themezinho' ),
			"param_name" 	=> 	"animation_type",
			"dependency" => array('element' => "animate_block", 'value' => 'yes'),
			"group" 		=> 'Animation',
			"value"			=>	motts_animations()
		),
		array(
			"type" 			=> 	"textfield",
			"heading" 		=> 	__( 'Animation Delay', 'themezinho' ),
			"param_name" 	=> 	"animation_delay",
			"dependency" => array('element' => "animate_block", 'value' => 'yes'),
			"description"	=>	__( 'Animation delay set in second e.g. 0.6s', 'themezinho' ),
			"group" 		=> 'Animation',
		)
	),
) );
