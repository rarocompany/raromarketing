<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class WPBakeryShortCode_ts_google_map extends WPBakeryShortCode {

	protected function content( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'iframe_url'		=> '',
			'animate_block'			=> 'no',
			'animation_type'		=> '',
			'animation_delay'		=> '',
		), $atts ) );



		ob_start();
        $template = locate_template( 'vc_templates/brabus/google_map.php');
        if( $template ) {
            include( $template );
        }
        else {
            $wrapper_class = '';
            if ($animate_block == 'yes') {
                $wrapper_class = 'wow ' . $animation_type;
            }
            if ($iframe_url) {
                ?>
                <div class="google-maps <?php echo esc_attr($wrapper_class); ?>" <?php if ($animate_block == 'yes' && $animation_delay != '') {
                    echo 'data-wow-delay="' . esc_attr($animation_delay) . '"';
                } ?>>

                    <iframe src="<?php echo esc_url($iframe_url); ?>" frameborder="0"
                            style="border:0" allowfullscreen></iframe>
                </div>

                <?php
            }
        }

		return ob_get_clean();
	}
}


vc_map( array(
	"base" 			    => "ts_google_map",
	"name" 			    => __( 'Google Map', 'themezinho' ),
	"content_element"   => true,
	"icon"              => THEMEZINHO_CORE_URI . "assets/img/custom.png",
	"category" 		    => PAGE_BUILDER_GROUP,
	'params' => array(
		array(
			"type" 			=> 	"textfield",
			"heading" 		=> 	__( 'iFrame Url', 'themezinho' ),
			"param_name" 	=> 	"iframe_url",
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
