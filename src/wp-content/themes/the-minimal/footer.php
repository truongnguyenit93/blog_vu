<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package The_Minimal
 */

?>

        </div><!-- .container -->
	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">
        <div class="container">
			<?php if( is_active_sidebar( 'footer-one' ) || is_active_sidebar( 'footer-two' ) || is_active_sidebar( 'footer-three' ) ){?>
                <div class="about_site">
    				<div class="row">
                        <?php if( is_active_sidebar( 'footer-one' ) ){ ?>
        					<div class="col-md-4">
        					   <?php dynamic_sidebar( 'footer-one' ); ?>
        					</div>
                        <?php } ?>

                            <div class="col-md-4">
                                <h2 class="widget-title">Map</h2>
                                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15338.67780463171!2d108.2234238!3d16.0307137!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x8e582dda072b5943!2sC%C3%94NG%20TY%20KIM%20PHONG%20LAND!5e0!3m2!1svi!2s!4v1577091535111!5m2!1svi!2s" width="600" height="155" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
        					</div>

                            <div class="col-md-4">
                                <h2 class="widget-title">Đăng kí nhận thông tin</h2>
        					   <?php echo do_shortcode( '[email-subscribers-form id="1"]' ); ?>
        					</div>
    				</div>
    			</div><!-- .about_site -->
			<?php }
            ?>
		</div><!-- .container -->
        <div class="container">
            <div class="col-md-6 company-details"><div class="zerif-footer-address"><p class="tuong-tac">CÔNG TY CỔ PHẦN BẤT ĐỘNG SẢN KIM PHONG</p>
                    <i class="fa fa-map-marker"></i>
                    &nbsp;  596 Đường 2/9, Q. Hải Châu, TP. Đà Nẵng  <br>
                    <i class="fa fa-phone"></i> &nbsp;0236 3774 488
                    <br><i class="fa fa-envelope"></i>&nbsp;kimphongland@gmail.com
                    <br>
                    <i class="fa fa-globe"></i> &nbsp;www.kimphongland.vn  </div></div><div class="col-md-6 copyright"></div>
        </div>
	</footer><!-- #colophon -->
    <div class="overlay"></div>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
