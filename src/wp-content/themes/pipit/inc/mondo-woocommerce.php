<?php

/**
 * Changes number of products per row to 3.
 */

if ( ! function_exists( 'lark_woocommerce_loop_columns' ) ) {
	function lark_woocommerce_loop_columns() {

		return 3;
	}
}
add_filter( 'loop_shop_columns', 'lark_woocommerce_loop_columns' );

/**
 * Changes related products count.
 */

function lark_related_products_args( $args ) {

	$args['posts_per_page'] = 3;
	$args['columns'] = 3;

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'lark_related_products_args' );

/**
 * Hides the title on the home page.
 */

function lark_hide_shop_title() {
	
	return false;	
}
add_filter( 'woocommerce_show_page_title' , 'lark_hide_shop_title' );

/**
 * Overrides pagination args.
 */

function lark_override_pagination_args( $args ) {

	$args['prev_text'] = '<i class="fa fa-chevron-left"></i>';
	$args['next_text'] = '<i class="fa fa-chevron-right"></i>';
	return $args;
}
add_filter( 'woocommerce_pagination_args' , 'lark_override_pagination_args' );

// Removes tabs from their original location 
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );

// Inserts tabs under the main right product content 
add_action( 'woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 60 );

// Remove the product rating display on product loops
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
