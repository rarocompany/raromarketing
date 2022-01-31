<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class WPBakeryShortCode_ts_team_member extends WPBakeryShortCode {

	protected function content( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'total_count'		=> '6',
			'animate'			=> 'no',
			'animation_type'	=> '',
		), $atts ) );

		if( $total_count < 1 ) {
			$total_count = 6;
		}
		ob_start();

        $template = locate_template( 'vc_templates/brabus/team_member.php');
        if( $template ) {
            include( $template );
        }
        else {
            $wrapper_class = '';
            if ($animate == 'yes') {
                $wrapper_class = 'wow ' . $animation_type;
            }

            $args = array(
                'post_type' => 'team',
                'posts_per_page' => $total_count,
                'meta_query' => array(
                    array(
                        'key' => '_thumbnail_id',
                        'compare' => 'EXISTS'
                    ),
                )
            );
            $teams = new WP_Query($args);

            if ($teams->have_posts()) {
                ?>
                <div class="row">
                    <?php
                    $i = 0;
                    while ($teams->have_posts()) {
                        $teams->the_post();

                        $attr = '';

                        if ($animate == 'yes') {
                            $attr = 'data-wow-delay="' . 0 . '.' . $i . 's"';
                        }
                        $team_image = wp_get_attachment_url(get_post_thumbnail_id($teams->post->ID));
                        ?>
                        <div class="team-member col-lg-2 col-md-3 <?php echo esc_attr($wrapper_class); ?>" <?php echo esc_attr($attr); ?>>
                            <figure>
                                <img src="<?php echo esc_url($team_image); ?>"
                                     alt="<?php echo esc_attr(get_the_title()); ?>">

                                <figcaption>
                                    <?php if (get_field('designation') !== '') { ?>
                                        <small><?php the_field('designation'); ?></small>
                                    <?php } ?>
                                    <h4><?php the_title(); ?></h4>
                                </figcaption>
                            </figure>

                        </div>
                        <?php
                    }
                    wp_reset_postdata();
                    ?>
                </div>
                <?php
            }
        }
		return ob_get_clean();
	}
}


vc_map( array(
	"base" 			    => "ts_team_member",
	"name" 			    => __( 'Team Members', 'themezinho' ),
	"icon"              => THEMEZINHO_CORE_URI . "assets/img/custom.png",
	"content_element"   => true,
	"category" 		    => PAGE_BUILDER_GROUP,
	'params' => array(
		array(
			"type" 			=> 	"textfield",
			"heading" 		=> 	__( 'Total no of Post', 'themezinho' ),
			"param_name" 	=> 	"total_count",
			"value" 	=> 	"5",
			"group" 		=> 'General',
		),
		array(
			"type" 			=> 	"dropdown",
			"heading" 		=> 	__( 'Animate', 'themezinho' ),
			"param_name" 	=> 	"animate",
			"group" 		=> 'General',
			"value"			=>	array(
				"No"			=>		'no',
				"Yes"			=>		'yes',
			)
		),
		array(
			"type" 			=> 	"dropdown",
			"heading" 		=> 	__( 'Animation Type', 'themezinho' ),
			"param_name" 	=> 	"animation_type",
			"dependency" => array('element' => "animate", 'value' => 'yes'),
			"group" 		=> 'General',
			"value"			=>	motts_animations()
		)
	),
) );
