<?php
  if ( ! is_active_sidebar( 'sidebar-primary' ) ) {
  	return;
  }
?>

<aside id="secondary" class="widget-area">
  <?php
    if ( class_exists( 'WooCommerce' ) && ( is_woocommerce() || is_cart() || is_checkout() || is_account_page() ) ) {
      dynamic_sidebar( 'sidebar-shop' );
    } else {
      dynamic_sidebar( 'sidebar-primary' );
    }
  ?>
</aside>
