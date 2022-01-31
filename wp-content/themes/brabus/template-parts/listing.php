<?php
ob_start();
if( has_excerpt() ) {
	$post_content = the_excerpt();
} else {
	$post_content = the_content();
}
$post_content = ob_get_clean();

$strip_content = ( brabus_get_option( 'archive_strip_content' ) ) ? brabus_get_option( 'archive_strip_content' ) : 'yes';

if( $strip_content !== 'no' ){
	$post_content = preg_replace( '~\[[^\]]+\]~', '', $post_content );
	$post_content = strip_tags( $post_content );
	$post_content = brabus_get_the_post_excerpt( $post_content, 300 );
}

?>
<div id="post-<?php the_ID(); ?>" <?php post_class( array( 'blog-post', 'wow', 'fadeIn' ) ); ?>>
	<?php if( brabus_get_post_thumbnail_url() ) { ?>
        <figure class="post-image">
            <img src="<?php echo esc_url( brabus_get_post_thumbnail_url() ); ?>" alt="<?php the_title_attribute(); ?>">
        </figure>
	<?php } ?>
    <div class="post-content">
        <div class="inner">
            <small class="post-date"><?php echo get_the_date(); ?></small>
            <h3 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
            <?php brabus_posted_by(); ?>
            <div class="post-intro">
                <?php echo wp_kses_post( $post_content ); ?>
            </div>

            <?php if( $strip_content !== 'no' ) { ?>
                <div class="post-link">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo esc_html__( 'READ MORE', 'brabus' ); ?></a>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
