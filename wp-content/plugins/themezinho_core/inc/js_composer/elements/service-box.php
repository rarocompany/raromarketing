<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class WPBakeryShortCode_ts_service extends WPBakeryShortCode {

	protected function content( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'color'   			=> 'dark',
			'index'		            => '',
			'animate_block'			=> 'false',
			'animation_type'		=> 'fadeIn',
			'animation_delay'		=> '',
		), $atts ) );

		ob_start();
        $template = locate_template( 'vc_templates/brabus/service.php');
        if( $template ) {
            include( $template );
        }
        else {
            $wrapper_class = '';
            if ($animate_block == 'yes') {
                $wrapper_class = 'wow ' . $animation_type;
            }
            $style = [];

            ?>
            <div class="service-box <?php if ($color == 'light') { ?> light <?php } ?> <?php echo esc_attr($wrapper_class); ?>" <?php if ($animate_block == 'yes' && $animation_delay != '') {
                echo 'data-wow-delay="' . esc_attr($animation_delay) . '"';
            } ?>>
                <div class="left">
                    <small><?php echo esc_html($index); ?></small><span></span>
                </div>
                <!-- end left -->
                <div class="right">
                    <?php echo wpb_js_remove_wpautop($content, true); ?>
                </div>
                <!-- end right -->
            </div>
            <?php
        }

		return ob_get_clean();
	}
}


vc_map( array(
	"base" 			    => "ts_service",
	"name" 			    => __( 'Service Box', 'themezinho' ),
	"icon"              => THEMEZINHO_CORE_URI . "assets/img/custom.png",
	"content_element"   => true,
	"category" 		    => PAGE_BUILDER_GROUP,
	'params' => array(
		array(
			"type" 			=> 	"dropdown",
			"heading" 		=> 	__( 'Color', 'themezinho' ),
			"param_name" 	=> 	"color",
			"group" 		=> 'General',
			"value"			=>	array(
				"Dark"		=> 'dark',
				"Light"		=> 'light',
			)
		),
		array(
			"type" 			=> 	"textfield",
			"heading" 		=> 	__( 'Index', 'themezinho' ),
			"param_name" 	=> 	"index",
			"group" 		=> 'General',
		),
		array(
			"type" 			=> 	"textarea_html",
			"heading" 		=> 	__( 'Content', 'themezinho' ),
			"param_name" 	=> 	"content",
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
