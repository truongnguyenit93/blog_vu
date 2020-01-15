<?php $pipit_admin_data = pipit_get_admin_data(); ?>

    </div>
	</div>

	<footer id="colophon" class="site-footer page-footer font-small blue pt-4">
        <div class="container-fluid text-center text-md-left">
            <div class="site-info">
                <div class="row">
                    <div class="col-md-4">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15338.67780463171!2d108.2234238!3d16.0307137!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x8e582dda072b5943!2sC%C3%94NG%20TY%20KIM%20PHONG%20LAND!5e0!3m2!1svi!2s!4v1577091535111!5m2!1svi!2s" width="600" height="155" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                    </div>
                    <div class="col-md-4">
                        <?php if ( isset( $pipit_admin_data['copyright_text'] ) ) : ?>
                            <?php echo wp_kses( $pipit_admin_data['copyright_text'], array(
                                'a'      => array( 'href' => array(), 'target' => array() ),
                                'span'   => array( 'style' => array() ),
                                'img'    => array( 'src' => array(), 'alt' => array() ),
                                'i'      => array( 'class' => array(), 'style' => array() ),
                                'em'     => array(),
                                'strong' => array(),
                                'p'      => array(),
                                'br'     => array()
                            ) ); ?>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-4">
                        <h2 class="widget-title">Đăng kí nhận thông tin</h2>
                        <?php echo do_shortcode( '[email-subscribers-form id="1"]' ); ?>
                    </div>
                </div>

            </div>
        </div>
	</footer>

  <?php if ( $pipit_admin_data['disable_search'] == '0' ) : ?>
    <div id="search-fill">
      <?php get_search_form(); ?>
      <i class="search-toggle fa fa-times"></i>
    </div>
  <?php endif; ?>
</div>

<?php wp_footer(); ?>

</body>
</html>
