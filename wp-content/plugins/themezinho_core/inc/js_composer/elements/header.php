<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class WPBakeryShortCode_ts_hero_slider extends WPBakeryShortCode {

	protected function content( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'hero_slider'		=> 0,
		), $atts ) );

//		 if( !is_int( $hero_slider ) ) {
//		 	return;
//		 }

        ob_start();
        $template = locate_template( 'vc_templates/brabus/hero_slider.php');

        if( $template ) {
            include( $template );
        }
        else {

            $args = array(
                'post_type' => 'hero',
                'post__in' => array($hero_slider)
            );

            $the_query = new WP_Query($args);
            if ($the_query->have_posts()) :
                while ($the_query->have_posts()) :
                    $the_query->the_post();

                    $hero_type = get_field('type');
                    $disable_social_icon = (get_field('disable_social_icon')) ? true : false;
                    $disable_scrolldown = (get_field('disable_scroll_down')) ? true : false;

                    if ($hero_type === 'swiper') :

                        if (have_rows('slider')):

                            $transition_speed = (get_field('transition_speed')) ? get_field('transition_speed') : 600;
                            $auto_play_delay = (get_field('auto_play_delay')) ? get_field('auto_play_delay') : 3500;
                            $loop = (get_field('disable_loop')) ? 'disable' : 'enable';

                            $enable_noise_effect = (get_field('enable_noise_effect')) ? get_field('enable_noise_effect') : false;
                            $enable_tilt_effect = (get_field('enable_tilt_effect')) ? get_field('enable_tilt_effect') : false;

                            $page_number = (get_field('disable_page_number')) ? false : true;
                            $navigation = (get_field('disable_navigation')) ? false : true;


                            $slides = count(get_field('slider'));

                            if ($slides < 2) {
                                $loop = 'disable';
                            }
                            ?>
                            <header class="header hero-header">
                                <?php
                                if (!$disable_social_icon) {
                                    $social_media = brabus_get_option('social_media');
                                    if ($social_media) {
                                        ?>
                                        <aside class="left-side">
                                            <ul>
                                                <?php foreach ($social_media as $social) { ?>
                                                    <li><a href="<?php echo esc_url($social['url']); ?>"
                                                           target="_blank"
                                                           title="<?php echo esc_attr($social['title']); ?>"><?php echo esc_html($social['title']); ?></a>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </aside>
                                        <?php
                                    }
                                }
                                ?>
                                <?php
                                if (!$disable_scrolldown && brabus_get_option('enable_scrolldown')) {
                                    $scrolldown_label = (brabus_get_option('scrolldown_label')) ? brabus_get_option('scrolldown_label') : 'SCROLL DOWN';
                                    ?>
                                    <div class="scroll-down">
                                        <small><?php echo esc_html__($scrolldown_label, 'brabus'); ?></small><span></span>
                                    </div>
                                <?php } ?>

                                <?php if (brabus_get_option('enable_soundbar')) {
                                    $soundbar_label = (brabus_get_option('soundbar_label')) ? brabus_get_option('soundbar_label') : 'SOUND';
                                    ?>
                                    <div class="sound">
                                        <span> <?php echo esc_html__($soundbar_label, 'brabus'); ?> </span>
                                        <div class="equalizer">
                                            <div class="holder"><span></span> <span></span> <span></span>
                                                <span></span><span></span><span></span></div>
                                            <!-- end holder -->
                                        </div>
                                        <!-- end equalizer -->
                                    </div>
                                <?php } ?>

                                <div class="swiper-slider"
                                     data-speed="<?php echo esc_attr($transition_speed); ?>"
                                     data-autoplay-delay="<?php echo esc_attr($auto_play_delay); ?>"
                                     data-loop="<?php echo esc_attr($loop); ?>"
                                >
                                    <div class="swiper-wrapper">
                                        <?php
                                        $i = 1;
                                        while (have_rows('slider')) : the_row();
                                            $background_image = get_sub_field('background_image');
			 								$background_video = get_sub_field('background_video');
                                            ?>
                                            <div class="swiper-slide"
                                                <?php if ($enable_tilt_effect) { ?>
                                                    data-tilt
                                                    data-tilt-max="<?php echo get_field('max_tilt') ? get_field('max_tilt') : 5; ?>"
                                                    data-tilt-speed="<?php echo get_field('tilt_speed') ? get_field('tilt_speed') : 500; ?>"
                                                    data-tilt-perspective="<?php echo get_field('tilt_perspective') ? get_field('tilt_perspective') : 1500; ?>"
                                                <?php } ?>
                                            >
                                                <div class="slide-inner bg-image"
                                                     data-background="<?php echo esc_url($background_image); ?>">
													 <?php if ($background_video) { ?>
													<video src="<?php echo esc_url($background_video); ?>" autoplay loop muted playsinline></video>
													 <?php } ?>
                                                    <div class="container">
                                                        <div class="tagline">
                                                            <?php if ($page_number) { ?>
                                                                <span><?php echo esc_html(sprintf("%02d", $i)); ?></span>
                                                            <?php } ?>
                                                            <?php if (get_sub_field('tagline')) { ?>
                                                                <h6><?php the_sub_field('tagline'); ?></h6>
                                                            <?php } ?>
                                                        </div>
                                                        <h1>
                                                            <?php the_sub_field('title'); ?>
                                                            <?php if (get_sub_field('title_with_effect')) { ?>
                                                                <br>
                                                                <span><?php the_sub_field('title_with_effect'); ?></span>
                                                            <?php } ?>
                                                        </h1>


                                                        <?php if (get_sub_field('button_link')) { ?>
                                                            <div class="slide-btn">
                                                                <a href="<?php echo esc_url(get_sub_field('button_link')); ?>"
                                                                   title="<?php echo esc_attr(get_sub_field('button_label')); ?>">
                                                                    <div class="lines"><span></span> <span></span></div>
                                                                    <!-- end lines -->
                                                                    <svg version="1.1"
                                                                         xmlns="http://www.w3.org/2000/svg"
                                                                         xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                         x="0px" y="0px"
                                                                         viewBox="0 0 104 104"
                                                                         enable-background="new 0 0 104 104"
                                                                         xml:space="preserve">
                    <circle class="video-play-circle" fill="none" stroke="#fff" stroke-width="2" stroke-miterlimit="1"
                            cx="52" cy="52" r="50"/>
                  </svg>
                                                                    <b><?php echo esc_html(get_sub_field('button_label')); ?></b>
                                                                </a>
                                                            </div>
                                                        <?php } ?>


                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        endwhile;
                                        ?>
                                    </div>

                                    <?php if ($page_number) { ?>
                                        <!-- end swiper-wrapper -->
                                        <div class="swiper-pagination"></div>
                                        <!-- end swiper-pagination -->
                                        <div class="swiper-fraction"></div>
                                    <?php } ?>
                                </div>

                            </header>

                        <?php
                        endif;

                    elseif ($hero_type === 'video') :
                        ?>
                        <header class="header hero-header">
                            <?php
                            if (!$disable_social_icon) {
                                $social_media = brabus_get_option('social_media');
                                if ($social_media) {
                                    ?>
                                    <aside class="left-side">
                                        <ul>
                                            <?php foreach ($social_media as $social) { ?>
                                                <li><a href="<?php echo esc_url($social['url']); ?>"
                                                       target="_blank"
                                                       title="<?php echo esc_attr($social['title']); ?>"><?php echo esc_html($social['title']); ?></a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </aside>
                                    <?php
                                }
                            }
                            ?>
                            <?php
                            if (!$disable_scrolldown && brabus_get_option('enable_scrolldown')) {
                                $scrolldown_label = (brabus_get_option('scrolldown_label')) ? brabus_get_option('scrolldown_label') : 'SCROLL DOWN';
                                ?>
                                <div class="scroll-down">
                                    <small><?php echo esc_html__($scrolldown_label, 'brabus'); ?></small><span></span>
                                </div>
                            <?php } ?>

                            <?php if (brabus_get_option('enable_soundbar')) {
                                $soundbar_label = (brabus_get_option('soundbar_label')) ? brabus_get_option('soundbar_label') : 'SOUND';
                                ?>
                                <div class="sound"><span> <?php echo esc_html__($soundbar_label, 'brabus'); ?> </span>
                                    <div class="equalizer">
                                        <div class="holder"><span></span> <span></span> <span></span>
                                            <span></span><span></span><span></span></div>
                                        <!-- end holder -->
                                    </div>
                                    <!-- end equalizer -->
                                </div>
                            <?php } ?>

                            <div class="video-bg">
                                <video src="<?php echo esc_url(get_field('background_video')); ?>" muted loop
                                       autoplay></video>
                                <div class="container">
                                    <?php if (get_field('video_bg_tagline')) { ?>
                                        <div class="tagline"><span></span>
                                            <h6><?php the_field('video_bg_tagline'); ?></h6>
                                        </div>
                                    <?php } ?>

                                    <h1>
                                        <?php the_field('video_bg_title'); ?>
                                        <?php if (get_field('video_bg_title_with_effect')) { ?>
                                            <br>
                                            <span><?php the_field('video_bg_title_with_effect'); ?></span>
                                        <?php } ?>
                                    </h1>

                                    <?php if (get_field('video_bg_button_link')) { ?>
                                        <div class="slide-btn">
                                            <a href="<?php echo esc_url(get_field('video_bg_button_link')); ?>"
                                               title="<?php echo esc_attr(get_field('video_bg_button_label')); ?>">
                                                <div class="lines"><span></span> <span></span></div>
                                                <!-- end lines -->
                                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                     xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                     viewBox="0 0 104 104" enable-background="new 0 0 104 104"
                                                     xml:space="preserve">
                    <circle class="video-play-circle" fill="none" stroke="#fff" stroke-width="2" stroke-miterlimit="1"
                            cx="52" cy="52" r="50"/>
                  </svg>
                                                <b><?php echo esc_html(get_field('video_bg_button_label')); ?></b>
                                            </a>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>

                        </header>
                    <?php

                    endif;

                endwhile;
            endif;

            wp_reset_postdata();
        }

		return ob_get_clean();
	}
}

vc_map( array(
	"base" 			    => "ts_hero_slider",
	"name" 			    => __( 'Hero Slider', 'ts' ),
	"icon"              => THEMEZINHO_CORE_URI . "assets/img/custom.png",
	"content_element"   => true,
	"category" 		    => PAGE_BUILDER_GROUP,
	'params' => array(
		array(
			"type" 			=> 	"dropdown",
			"heading" 		=> 	__( 'Hero Slider', 'ts' ),
			"param_name" 	=> 	"hero_slider",
			"group" 		=> "General",
			"description"	=> __( 'Select the slider that you created in Hero Slider section. Check documentation for further detail.', 'ts' ),
			"value"			=>	ts_get_hero_slider()
		)
	),
) );
