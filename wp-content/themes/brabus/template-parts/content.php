<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Brabus
 */

?>
<div class="post-header">
    <?php
    if ( 'post' === get_post_type() ) :
        ?>
        <small class="post-date"><?php the_date('F d, Y'); ?></small>
	    <?php brabus_posted_by(); ?>
    <?php endif;
    ?>
</div>

<?php
the_content( sprintf(
    wp_kses(
        /* translators: %s: Name of current post. Only visible to screen readers */
        __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'brabus' ),
        array(
            'span' => array(
                'class' => array(),
            ),
        )
    ),
    get_the_title()
) );

wp_link_pages( array(
    'before'      => '<div class="page-links"><h6>' . esc_html__( 'Pages:', 'brabus' ) . '</h6>',
    'after'       => '</div>',
    'link_before' => '<span>',
    'link_after'  => '</span>',
) );
?>
<div class="post-entry-footer">
    <?php brabus_entry_footer(); ?>
</div>
