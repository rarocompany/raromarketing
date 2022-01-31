<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class WPBakeryShortCode_ts_section_title extends WPBakeryShortCode {

	protected function content( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'title_color'   			=> 'dark',
			'tagline'		        => '',
			'title'   			    => '',
			'background_title'      => '',
			'animate_block'			=> 'false',
			'animation_type'		=> 'fadeIn',
			'animation_delay'		=> '',
		), $atts ) );

		ob_start();
        $template = locate_template( 'vc_templates/brabus/section_title.php');
        if( $template ) {
            include( $template );
        }
        else {
            $wrapper_class = array();

            if ($animate_block == 'yes') {
                $wrapper_class[] = 'wow';
                $wrapper_class[] = $animation_type;
            }

            $wrapper_class = implode(' ', $wrapper_class);
            ?>

            <div class="section-title <?php if ($title_color == 'light') { ?> light <?php } ?> <?php echo esc_attr($wrapper_class); ?>" <?php if ($animate_block == 'yes' && $animation_delay != '') {
                echo 'data-wow-delay="' . esc_attr($animation_delay) . '"';
            } ?>>
            <?php if ($tagline) { ?>
                <h6><?php echo wp_kses_post($tagline); ?></h6>
            <?php } ?>

            <?php if ($title) {
                $bg_title = '';
                if ($background_title) {
                    $bg_title = 'data-text="' . esc_attr($background_title) . '"';
                }
                ?>
                <h2 <?php echo $bg_title; ?>><?php echo wp_kses_post($title); ?></h2>
            <?php } ?>
            </div>
            <?php
        }

		return ob_get_clean();
	}
}


vc_map( array(
	"base" 			    => "ts_section_title",
	"name" 			    => __( 'Section Title', 'themezinho' ),
	"icon"              => THEMEZINHO_CORE_URI . "assets/img/custom.png",
	"content_element"   => true,
	"category" 		    => PAGE_BUILDER_GROUP,
	'params' => array(
		array(
			"type" 			=> 	"dropdown",
			"heading" 		=> 	__( 'Title Color', 'themezinho' ),
			"param_name" 	=> 	"title_color",
			"group" 		=> 'General',
			"value"			=>	array(
				"Dark"		=> 'dark',
				"Light"		=> 'light',
			)
		),
		array(
			"type" 			=> 	"textfield",
			"heading" 		=> 	__( 'Tagline', 'themezinho' ),
			"param_name" 	=> 	"tagline",
			"group" 		=> 'General',
		),
		array(
			"type" 			=> 	"textfield",
			"heading" 		=> 	__( 'Title', 'themezinho' ),
			"param_name" 	=> 	"title",
			"group" 		=> 'General',
		),
		array(
			"type" 			=> 	"textfield",
			"heading" 		=> 	__( 'Background Title', 'themezinho' ),
			"param_name" 	=> 	"background_title",
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
