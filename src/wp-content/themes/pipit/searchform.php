<form method="get" class="search-form compact-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="search" class="search-field" placeholder="<?php echo esc_attr( apply_filters( 'pipit_search_field_placeholder', esc_html__( 'Tìm kiếm bài viết', 'pipit' ) ) ); ?>" autocomplete="off" value="<?php echo esc_attr( get_search_query() ) ?>" name="s">
	<button type="submit" class="search-submit compact-submit"><i class="fa fa-search"></i></button>
</form>
