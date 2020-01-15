<?php

class Pipit_Walker_Nav_Menu extends Walker_Nav_Menu {
	
	public $tree_type = array( 'post_type', 'taxonomy', 'custom' );
	public $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );

	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"sub-menu\">\n";
	}

	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";
	}

	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $class_names .'>';

		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';

		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		/** This filter is documented in wp-includes/post-template.php */
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;
		
		if ( $args->has_children ) {
			$item_output .= '<div class="dropdown-toggle hidden-md hidden-lg"><i class="fa fa-chevron-down"></i></div>';
		}

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	public function end_el( &$output, $item, $depth = 0, $args = array() ) {
		$output .= "</li>\n";
	}

	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
    $id_field = $this->db_fields['id'];
    if ( is_object( $args[0] ) ) {
      $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );
    }
    return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
  }

	public static function fallback( $args ) {

		extract( $args );

		$fb_output = null;

		if ( $container ) {
			$fb_output = '<' . $container;

			if ( $container_id )
				$fb_output .= ' id="' . $container_id . '"';

			if ( $container_class )
				$fb_output .= ' class="' . $container_class . '"';

			$fb_output .= '>';
		}

		$fb_output .= '<ul';

		if ( $menu_id )
			$fb_output .= ' id="' . $menu_id . '"';

		if ( $menu_class )
			$fb_output .= ' class="' . $menu_class . '"';

		$fb_output .= '>';
		$fb_output .= '<li class="menu-item"><a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '">' . esc_html__( 'Add a menu', 'pipit' ) . '</a></li>';
		$fb_output .= '</ul>';

		if ( $container )
			$fb_output .= '</' . $container . '>';

		echo wp_kses( $fb_output, array(
			'ul'   => array( 'id' => array(), 'class' => array() ),
			'li'   => array( 'class' => array() ),
			'a'    => array( 'href' => array() ),
			'span' => array()
		) );
	}

}
