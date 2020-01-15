<?php
  $pipit_admin_data = pipit_get_admin_data();
  $navbar_style = $pipit_admin_data['navbar_style'];
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
  <header id="masthead">
    <div id="navigation-bar" class="clearfix">
      <?php if ( $navbar_style != 'big_logo' && $navbar_style != 'big_logo_sticky' ) : ?>
        <?php if ( isset( $pipit_admin_data['logo'] ) && pipit_redux_image_set( $pipit_admin_data['logo'] ) ) : ?>
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img class="brand-logo dark" src="<?php echo esc_url( $pipit_admin_data['logo']['url'] ); ?>" width="<?php echo esc_attr( $pipit_admin_data['logo']['width'] ); ?>" height="<?php echo esc_attr( $pipit_admin_data['logo']['height'] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"></a>
        <?php else : ?>
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><span class="brand-logo text dark"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></span></a>
        <?php endif; ?>

        <?php if ( isset( $pipit_admin_data['logo_light'] ) && pipit_redux_image_set( $pipit_admin_data['logo_light'] ) ) : ?>
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img class="brand-logo light" src="<?php echo esc_url( $pipit_admin_data['logo_light']['url'] ); ?>" width="<?php echo esc_attr( $pipit_admin_data['logo_light']['width'] ); ?>" height="<?php echo esc_attr( $pipit_admin_data['logo_light']['height'] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"></a>
        <?php else : ?>
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><span class="brand-logo text light"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></span></a>
        <?php endif; ?>
      <?php endif; ?>

      <div id="nav-toggle" class="hidden-md hidden-lg">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
      </div>

      <?php pipit_social_links(); ?>

      <nav id="main-navigation">
        <?php wp_nav_menu( array(
          'theme_location' => 'primary',
          'container' => false,
          'menu_class' => 'nav-list clearfix',
          'walker' => new Pipit_Walker_Nav_Menu(),
          'fallback_cb' => 'Pipit_Walker_Nav_Menu::fallback'
        ) ); ?>
      </nav>
    </div>

    <?php if ( $navbar_style == 'big_logo' || $navbar_style == 'big_logo_sticky' ) : ?>
      <?php if ( isset( $pipit_admin_data['logo'] ) && pipit_redux_image_set( $pipit_admin_data['logo'] ) ) : ?>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img class="brand-logo dark" src="<?php echo esc_url( $pipit_admin_data['logo']['url'] ); ?>" width="<?php echo esc_attr( $pipit_admin_data['logo']['width'] ); ?>" height="<?php echo esc_attr( $pipit_admin_data['logo']['height'] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"></a>
      <?php else : ?>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><span class="brand-logo text dark"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></span></a>
      <?php endif; ?>
    <?php endif; ?>
  </header>

  <?php if ( pipit_show_hero() ) : ?>
    <?php pipit_hero(); ?>
  <?php endif; ?>

  <?php if ( $pipit_admin_data['disable_featured_posts'] != '1' && is_front_page() ) : ?>
    <?php pipit_featured_posts(); ?>
  <?php endif; ?>

	<div id="content" class="site-content container">
		<div class="row">
