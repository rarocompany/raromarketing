<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class WPBakeryShortCode_ts_process extends WPBakeryShortCode {

	protected function content( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'title'		            => '',
			'logo'			        => '',
			'index' 			    => '',
			'animate_block'			=> 'false',
			'animation_type'		=> 'fadeIn',
			'animation_delay'		=> '',
		), $atts ) );
		$logo_url = '';
		if ( $logo != '') {
			$logo_url = wp_get_attachment_url( $logo );
		}
		ob_start();
        $template = locate_template( 'vc_templates/brabus/process.php');
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
            <div class="process-box <?php echo esc_attr($wrapper_class); ?>" <?php if ($animate_block == 'yes' && $animation_delay != '') {
                echo 'data-wow-delay="' . esc_attr($animation_delay) . '"';
            } ?>>
                <?php if ($index != '') { ?>
                    <span><?php echo esc_html($index); ?></span>
                <?php } ?>
                <?php if ($logo_url != '') { ?>
                    <figure>
                        <img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr($title); ?>">

                        <?php if ($title) { ?>
                            <figcaption>
                                <h5><?php echo esc_html($title); ?></h5>
                            </figcaption>
                        <?php } ?>
                    </figure>
                <?php } ?>
            </div>
            <?php
        }
		return ob_get_clean();
	}
}


vc_map( array(
	"base" 			    => "ts_process",
	"name" 			    => __( 'Process Box', 'themezinho' ),
	"icon"              => THEMEZINHO_CORE_URI . "assets/img/custom.png",
	"content_element"   => true,
	"category" 		    => PAGE_BUILDER_GROUP,
	'params' => array(
		array(
			"type" 			=> 	"textfield",
			"heading" 		=> 	__( 'Index', 'themezinho' ),
			"param_name" 	=> 	"index",
			"group" 		=> 'General',
		),
		array(
			"type" 			=> 	"textfield",
			"heading" 		=> 	__( 'Title', 'themezinho' ),
			"param_name" 	=> 	"title",
			"group" 		=> 'General',
		),
		array(
			"type" 			=> 	"attach_image",
			"heading" 		=> 	__( 'Icon', 'themezinho' ),
			"param_name" 	=> 	"logo",
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
