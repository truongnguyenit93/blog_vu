<?php

function pipit_body_classes( $classes ) {

  $pipit_admin_data = pipit_get_admin_data();

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

  // Adds a class of hero to single posts or pages.
  if ( ( is_singular( 'post' ) || is_page() ) && pipit_compare_options( $pipit_admin_data['hero_single_enable'], rwmb_meta( 'pipit_hero_enable' ) ) == '1' ) {
    $classes[] = 'hero';
  }

  // Adds a class of navbar style.
  $navbar_style = $pipit_admin_data['navbar_style'];

  if ( is_singular( 'post' ) || is_page() ) {
    $navbar_style = pipit_compare_options( $pipit_admin_data['navbar_style'], rwmb_meta( 'pipit_single_navbar' ) );
  }

  if ( pipit_show_hero() ) {
    if ( $navbar_style == 'sticky_transparent' ) {
      $navbar_class = 'navbar-sticky-transparent navbar-transparent';
    } else {
      $navbar_class = 'navbar-' . $navbar_style;
    }
    $classes[] = 'with-hero';
  } else {
    if ( $navbar_style == 'sticky_transparent' ) {
      $navbar_class = 'navbar-sticky';  
    } elseif ( $navbar_style == 'transparent' ) {
      $navbar_class = 'navbar-default';
    } else {
      $navbar_class = 'navbar-' . $navbar_style;
    }
  }

  if ( $navbar_style == 'big_logo_sticky' ) {
    $navbar_class = 'navbar-big-logo navbar-sticky';
  }

  $classes[] = str_replace( '_', '-', $navbar_class );

  // Adds a class when the featured posts section is enabled.
  if ( $pipit_admin_data['disable_featured_posts'] != '1' && is_front_page() ) {
    $classes[] = 'with-featured-posts';
  }

  // Adds a class of no-sidebar layout.
  if ( pipit_compare_options( $pipit_admin_data['sidebar'], rwmb_meta( 'pipit_sidebar' ) ) == 'no_sidebar' && ( is_singular( 'post' ) || is_page() ) && ( ! class_exists( 'WooCommerce' ) || ( class_exists( 'WooCommerce' ) && ! is_woocommerce() ) ) ) {
    $classes[] = 'no-sidebar';
  }

	return $classes;
}
add_filter( 'body_class', 'pipit_body_classes' );

function pipit_custom_style() {

  $pipit_admin_data = pipit_get_admin_data();

  $return = '<style type="text/css" class="pipit-custom-css">';

  if ( isset( $pipit_admin_data['brand_color'] ) && $pipit_admin_data['brand_color'] != '' ) {
    $brand_color = esc_html( $pipit_admin_data['brand_color'] );

    $return .= '
      .button, input[type="submit"], button[type="submit"],
      .post.type-post .read-more:hover,
      .widget_mc4wp_form_widget input[type="submit"]:hover,
      .nav-links .nav-previous > a, .nav-links .nav-next > a,
      #review-score .bar-progress,
      .comparison .cd-handle,
      .label, #related-posts .categories-link > a, .widget_rss ul li .rss-date, .widget_pipit_categories_widget .category-item-count-badge,
      .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce .widget_product_search input[type="submit"], .woocommerce.widget_product_search input[type="submit"],
      .woocommerce .widget.widget_recent_reviews .reviewer, .woocommerce.widget.widget_recent_reviews .reviewer, .woocommerce .widget.widget_products .amount, .woocommerce.widget.widget_products .amount, .woocommerce .widget.widget_recently_viewed_products .amount, .woocommerce.widget.widget_recently_viewed_products .amount, .woocommerce .widget.widget_top_rated_products .amount, .woocommerce.widget.widget_top_rated_products .amount,
      .woocommerce .widget_price_filter .price_slider_amount .button:hover, .woocommerce.widget_price_filter .price_slider_amount .button:hover,
      .widget_shopping_cart .buttons .button:hover,
      .woocommerce span.onsale,
      .woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
      .woocommerce ul.products li.product .button:hover,
      #navigation-bar .menu-item-cart .item-count {
        background-color: ' . $brand_color . ';
      }
      @media (min-width: 992px) {
        #navigation-bar .sub-menu .menu-item > a:hover,
        #navigation-bar .nav-list .menu-item > a:hover {
          background-color: ' . $brand_color . ';
        }
      }
    ';

    $return .= '
      a,
      .post.type-post .entry-title > a:hover, .page.type-page .entry-title > a:hover,
      .box-item.type-post .entry-meta > span a:hover,
      .widget ul li > a:hover,
      .widget-posts-list .entry-title:hover,
      .widget_recent_comments .recentcomments > a,
      .woocommerce ul.products li.product .price,
      .woocommerce div.product p.price, .woocommerce div.product span.price,
      .widget_shopping_cart .total span.amount {
        color: ' . $brand_color . ';
      }
    ';

    $return .= '
      blockquote {
        border-left-color: ' . $brand_color . ';
      }
    ';

    $return .= '
      .accordion .accordion-item.open .accordion-title,
      .tab .tab-title.active {
        border-bottom-color: ' . $brand_color . ';
      }
    ';
  }

  if ( is_admin_bar_showing() ) {
    $return .= '
      .navbar-transparent #navigation-bar,
      .navbar-sticky #navigation-bar,
      .mobile #navigation-bar #main-navigation {
        top: 32px;
      }
    ';

    $return .= '
      @media screen and (max-width:782px) {
        .navbar-transparent #navigation-bar,
        .navbar-sticky #navigation-bar,
        .mobile #navigation-bar #main-navigation {
          top: 46px;
        }
      }
    ';
  }

  if ( isset( $pipit_admin_data['custom_css'] ) ) {
    $return .= $pipit_admin_data['custom_css'];
  }

  $return .= '</style>';

  echo $return;
}
add_action( 'wp_head', 'pipit_custom_style' );

function pipit_opengraph_tags() {

  global $post; ?>
  
  <?php if ( is_singular( 'post' ) ) : ?>
    <meta property="og:title" content="<?php echo esc_attr( get_the_title() ); ?>">
    <meta property="og:site_name" content="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
    <meta property="og:url" content="<?php echo esc_url( get_the_permalink() ); ?>">

    <?php
      $description = strip_tags( $post->post_content );

      if ( $description != '' ) {
        $description = substr( $description, 0, 200 );
      } else {
        $description = get_bloginfo( 'description' );
      }
    ?>
    <meta property="og:description" content="<?php echo esc_attr( $description ); ?>">

    <?php if ( has_post_thumbnail() ) : ?>
      <?php $thumbnail_url = wp_get_attachment_url( get_post_thumbnail_id() ); ?>
      <meta property="og:image" content="<?php echo esc_url( $thumbnail_url ); ?>">
    <?php endif; ?>
  <?php endif; ?>
  
  <?php
}
add_filter( 'wp_head', 'pipit_opengraph_tags' );

function pipit_excerpt_length( $length ) {

  $pipit_admin_data = pipit_get_admin_data();

  if ( isset( $pipit_admin_data['excerpt_length'] ) ) {
    return $pipit_admin_data['excerpt_length'];
  }

  return 55;
}
add_filter( 'excerpt_length', 'pipit_excerpt_length', 999 );

function pipit_excerpt_more( $more ) {

  return '...';
}
add_filter( 'excerpt_more', 'pipit_excerpt_more' );

function pipit_get_admin_data() {

  global $pipit_admin_data;
  return $pipit_admin_data;
}

function pipit_get_media_feed( $options = array() ) {

  $pipit_admin_data = pipit_get_admin_data();
  $main_data = array();
  $n = 0;

  switch ( $options['feed'] ) {

    case 'instagram':
      if ( isset( $pipit_admin_data['instagram_access_token'] ) && $pipit_admin_data['instagram_access_token'] != '' ) {

        $token = $pipit_admin_data['instagram_access_token'];

        if ( ( $response = get_transient( $options['transient'] ) ) === false ) {
          $response = wp_remote_get( 'https://api.instagram.com/v1/users/self/media/recent/?access_token=' . $token . '&count=' . $options['count'] );
          set_transient( $options['transient'], $response, PIPIT_TRANSIENTS_MINUTE * MINUTE_IN_SECONDS );
        }

        if ( is_array( $response ) ) {
          $feed = json_decode( $response['body'] );

          if ( isset( $feed->meta->code ) && $feed->meta->code == 200 && isset( $feed->data ) ) {
            foreach ( $feed->data as $d ) {
              $main_data[ $n ]['thumbnail'] = $d->images->standard_resolution->url;
              $main_data[ $n ]['link'] = $d->link;
              $main_data[ $n ]['caption'] = isset( $d->caption->text ) ? $d->caption->text : '';
              $n++;
            }
          } else {
            delete_transient( $options['transient'] );
          }
        }
      }
      break;

    case '500px':
      if ( isset( $pipit_admin_data['500px_consumer_key'] ) && $pipit_admin_data['500px_consumer_key'] != '' && isset( $pipit_admin_data['500px_username'] ) && $pipit_admin_data['500px_username'] != '' ) {

        $token = $pipit_admin_data['500px_consumer_key'];
        $user = $pipit_admin_data['500px_username'];

        if ( ( $response = get_transient( $options['transient'] ) ) === false ) {
          $response = wp_remote_get( 'https://api.500px.com/v1/photos?consumer_key=' . $token . '&feature=user&username=' . $user . '&sort=created_at&image_size=600&rpp=' . $options['count'] );
          set_transient( $options['transient'], $response, PIPIT_TRANSIENTS_MINUTE * MINUTE_IN_SECONDS );
        }

        if ( is_array( $response ) ) {
          $feed = json_decode( $response['body'] );

          if ( isset( $feed->photos ) ) {
            foreach ( $feed->photos as $d ) {
              $main_data[ $n ]['thumbnail'] = $d->images[0]->url;
              $main_data[ $n ]['link'] = $d->url;
              $main_data[ $n ]['caption'] = isset( $d->name ) ? $d->name : '';
              $n++;
            }
          } else {
            delete_transient( $options['transient'] );
          }
        }
      }
      break;

    case 'dribbble':
      if ( isset( $pipit_admin_data['dribbble_access_token'] ) && $pipit_admin_data['dribbble_access_token'] != '' && isset( $pipit_admin_data['dribbble_username'] ) && $pipit_admin_data['dribbble_username'] != '' ) {

        $token = $pipit_admin_data['dribbble_access_token'];
        $user = $pipit_admin_data['dribbble_username'];

        if ( ( $response = get_transient( $options['transient'] ) ) === false ) {
          $response = wp_remote_get( 'https://api.dribbble.com/v1/users/' . $user . '/shots?access_token=' . $token . '&per_page=' . $options['count'] );
          set_transient( $options['transient'], $response, PIPIT_TRANSIENTS_MINUTE * MINUTE_IN_SECONDS );
        }

        if ( is_array( $response ) ) {
          $feed = json_decode( $response['body'] );

          if ( $feed ) {
            foreach ( $feed as $d ) {
              $main_data[ $n ]['thumbnail'] = $d->images->normal;
              $main_data[ $n ]['link'] = $d->html_url;
              $main_data[ $n ]['caption'] = isset( $d->title ) ? $d->title : '';
              $n++;
            }
          } else {
            delete_transient( $options['transient'] );
          }
        }
      }
      break;
      
  }

  return $main_data;
}

function pipit_like_it() {

  $nonce = $_POST['nonce'];

  if ( ! wp_verify_nonce( $nonce, 'pipit_like_nonce' ) ) {
    die( 'BUSTED!' );
  }

  $post_id = $_POST['post_id'];
  $current_count = get_post_meta( $post_id, 'pipit_like', true );
  if ( $current_count == '' ) {
    $current_count = 0;
  }

  $updated_count = $current_count + 1;
  update_post_meta( $post_id, 'pipit_like', $updated_count );

  die( (string) $updated_count );
}
add_action( 'wp_ajax_pipit_like', 'pipit_like_it' );
add_action( 'wp_ajax_nopriv_pipit_like', 'pipit_like_it' );

function pipit_unlike_it() {

  $nonce = $_POST['nonce'];

  if ( ! wp_verify_nonce( $nonce, 'pipit_like_nonce' ) ) {
    die( 'BUSTED!' );
  }

  $post_id = $_POST['post_id'];
  $current_count = get_post_meta( $post_id, 'pipit_like', true );

  // Makes sure like count is equal to 0 or more than 0
  if ( $current_count == '' || $current_count == '0' ) {
    $current_count = 1;
  }

  $updated_count = $current_count - 1;

  if ( $updated_count >= 0 ) {
    update_post_meta( $post_id, 'pipit_like', $updated_count );
  }

  die( (string) $updated_count );
}
add_action( 'wp_ajax_pipit_unlike', 'pipit_unlike_it' );
add_action( 'wp_ajax_nopriv_pipit_unlike', 'pipit_unlike_it' );

function pipit_compare_options( $global, $override ) {

  if ( $global == $override || $override == '' ) {
    return $global;
  } else {
    return $override;
  }
}

if ( ! function_exists( 'pipit_show_hero' ) ) {
  function pipit_show_hero() {

    $pipit_admin_data = pipit_get_admin_data();

    if (
      ( is_front_page() && $pipit_admin_data['hero_home_disable'] == '0' ) ||
      ( ( is_singular( 'post' ) || is_page() ) && pipit_compare_options( $pipit_admin_data['hero_single_enable'], rwmb_meta( 'pipit_hero_enable' ) ) == '1' ) ||
      ( class_exists( 'WooCommerce' ) && is_shop() && $pipit_admin_data['hero_shop_disable'] == '0' )
    ) {
      return true;
    }

    return false;
  }
}

function pipit_redux_image_set( $field ) {

  return ( is_array( $field ) && $field['url'] != '' );
}

function pipit_is_first_post() {

  global $wp_query;
  return $wp_query->current_post == 0 && ! is_paged();
}

function pipit_archive_title( $title ) {

  if ( is_category() ) {
    $title = single_cat_title( '<i class="fa fa-folder-open"></i>', false );
  } elseif ( is_tag() ) {
    $title = single_tag_title( '<i class="fa fa-tags"></i>', false );
  }

  return $title;
}
add_filter( 'get_the_archive_title', 'pipit_archive_title' );

function pipit_add_custom_items_to_wp_menu ( $items, $args ) {

  $pipit_admin_data = pipit_get_admin_data();
  
  if ( $pipit_admin_data['disable_search'] == '0' && $args->theme_location === 'primary' ) {

    if ( class_exists( 'WooCommerce' ) ) {
      ob_start();
      the_widget( 'WC_Widget_Cart' );
      $cart_widget = ob_get_clean();

      $items .= '<li class="menu-item menu-item-cart desktop hidden-xs hidden-sm">';
      $items .= '
        <a class="cart-icon" href="#">
          <i class="fa fa-shopping-bag"></i>
          <span class="item-count">
            ' . WC()->cart->cart_contents_count . '
          </span>
        </a>
        <ul class="sub-menu">
          <li class="menu-item">' . $cart_widget . '</li>
        </ul>
        ';
      $items .= '</li>';

      $items .= '<li class="menu-item menu-item-search mobile hidden-md hidden-lg">';
      $items .= '<a href="' . esc_url( WC()->cart->get_cart_url() ) . '">' . esc_html( apply_filters( 'pipit_menu_item_cart', esc_html__( 'Cart', 'pipit' ) ) ) . '</a>';
      $items .= '</li>';
    }

    $items .= '<li class="menu-item menu-item-search desktop hidden-xs hidden-sm">';
    $items .= '
      <a class="search-icon" href="#">
        <i class="fa fa-search"></i>
      </a>';
    $items .= '</li>';

    $items .= '<li class="menu-item menu-item-search mobile hidden-md hidden-lg">';
    $items .= get_search_form( false );
    $items .= '</li>';

  }

  return $items;
}
add_filter( 'wp_nav_menu_items', 'pipit_add_custom_items_to_wp_menu', 10, 2 );

function pipit_ajaxify_cart_count( $fragments ) {

  ob_start(); ?>

  <span class="item-count"><?php echo WC()->cart->cart_contents_count; ?></span>

  <?php

  $fragments['span.item-count'] = ob_get_clean();

  return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'pipit_ajaxify_cart_count' );

function pipit_add_links_to_author_profile( $contactmethods ) {
  
  $contactmethods['facebook'] = esc_html__( 'Facebook', 'pipit' );  
  $contactmethods['twitter'] = esc_html__( 'Twitter', 'pipit' );
  $contactmethods['instagram'] = esc_html__( 'Instagram', 'pipit' );
  $contactmethods['google'] = esc_html__( 'Google+', 'pipit' );
  $contactmethods['linkedin'] = esc_html__( 'LinkedIn', 'pipit' );
  
  return $contactmethods;
}
add_filter( 'user_contactmethods', 'pipit_add_links_to_author_profile', 10, 1 );

function pipit_password_protected_form() {

  global $post;

  $label = 'pwbox-' . ( empty( $post->ID ) ? rand() : $post->ID );
  $output = '<form class="password-form compact-form" action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
  ' . esc_html__( 'To view this protected post, enter the password below:', 'pipit' ) . '
  <input name="post_password" id="' . esc_attr( $label ) . '" type="password" placeholder="' . esc_html__( 'Password:', 'pipit' ) . '" size="20" maxlength="20">
  <button type="submit" class="password-submit compact-submit" name="Submit" value=""><i class="fa fa-unlock"></i></button>
  </form>
  ';

  return $output;
}
add_filter( 'the_password_form', 'pipit_password_protected_form' );
