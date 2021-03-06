<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Brabus
 */

get_header();
?>
<?php
brabus_render_page_header( 'page' );

while ( have_posts() ):
  the_post();
?>
<main> 
  <section class="content page-content">
    <div class="container">
      <div class="row justify-content-center">
      <?php get_template_part( 'template-parts/content', 'page' ); ?>
        <?php if ( comments_open() || get_comments_number() ) : ?>
        <div class="col-12">
          <?php comments_template(); ?>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </section>
</main>
<?php
endwhile;
?>
<?php
get_footer();
