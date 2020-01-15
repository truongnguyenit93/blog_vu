<?php
  $pipit_admin_data = pipit_get_admin_data();
  $hero = pipit_compare_options( $pipit_admin_data['hero_single_enable'], rwmb_meta( 'pipit_hero_enable' ) );
  $images = rwmb_meta( 'pipit_pf_gallery_data' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <?php if ( ! get_post_format() && has_post_thumbnail() && $hero != '1' ) : ?>
    <div class="entry-media">
      <?php the_post_thumbnail( 'pipit_full_750' ); ?>
    </div>
  <?php elseif ( get_post_format() == 'audio' && rwmb_meta( 'pipit_pf_audio_data' ) != '' ) : ?>
    <div class="entry-media">
      <?php echo rwmb_meta( 'pipit_pf_audio_data' ); ?>
    </div>
  <?php elseif ( get_post_format() == 'video' && rwmb_meta( 'pipit_pf_video_data' ) != '' ) : ?>
    <div class="entry-media">
      <?php echo rwmb_meta( 'pipit_pf_video_data' ); ?>
    </div>
  <?php elseif ( get_post_format() == 'gallery' && ! empty( $images ) ) : ?>
    <div class="entry-media">
      <div class="entry-gallery">
        <?php foreach ( $images as $image ) : ?>
          <?php echo wp_get_attachment_image( $image['ID'], 'pipit_full_750', false, array( 'class' => 'gallery-image' ) ); ?>
        <?php endforeach; ?>
      </div>
    </div>
  <?php endif; ?>

  <header class="entry-header">
    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

    <div class="entry-meta">
      <?php pipit_entry_meta(); ?>
    </div>
  </header>

  <div class="entry-content">
    <?php
      the_content();

      wp_link_pages( array(
        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'pipit' ),
        'after'  => '</div>',
      ) );
    ?>
  </div>

  <footer class="entry-footer">
    <?php pipit_entry_footer(); ?>
  </footer>
</article>
