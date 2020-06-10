<?php $pipit_admin_data = pipit_get_admin_data(); ?>

    </div>
	</div>

	<footer id="colophon" class="site-footer page-footer font-small blue pt-4">
        <div class="container-fluid text-center text-md-left">
            <div class="site-info">
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
