<?php get_header(); ?>

<?php brabus_render_page_header( 'portfolio' ); ?>

<main>
    <section class="content-section">
        <?php
        while ( have_posts() ) :
            the_post();
            ?>
            <?php the_content(); ?>
        <?php endwhile; ?>
    </section>
</main>

<?php get_footer(); ?>
