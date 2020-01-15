<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }


    // This is your option name where all the Redux data is stored.
    $opt_name = "pipit_admin_options";

    // This line is only for altering the demo. Can be easily removed.
    $opt_name = apply_filters( 'redux_demo/opt_name', $opt_name );

    /*
     *
     * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
     *
     */

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => esc_html__( 'Pipit Options', 'pipit' ),
        'page_title'           => esc_html__( 'Pipit Options', 'pipit' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => true,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => 'pipit_admin_data',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => true,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

    // ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
    $args['admin_bar_links'][] = array(
        'id'    => 'mondo-support',
        'href'   => 'http://mondotheme.ticksy.com/',
        'title' => esc_html__( 'Support', 'pipit' ),
    );

    $args['admin_bar_links'][] = array(
        'id'    => 'mondo-website',
        'href'   => 'http://mondotheme.com/',
        'title' => esc_html__( 'Website', 'pipit' ),
    );

    $args['admin_bar_links'][] = array(
        'id'    => 'mondo-profile',
        'href'   => 'http://themeforest.net/user/mondotheme',
        'title' => esc_html__( 'ThemeForest Profile', 'pipit' ),
    );

    $args['admin_bar_links'][] = array(
        'id'    => 'mondo-facebook',
        'href'   => 'https://www.facebook.com/mondotheme',
        'title' => esc_html__( 'Facebook', 'pipit' ),
    );

    $args['admin_bar_links'][] = array(
        'id'    => 'mondo-twitter',
        'href'   => 'https://twitter.com/mondotheme',
        'title' => esc_html__( 'Twitter', 'pipit' ),
    );

    $args['admin_bar_links'][] = array(
        'id'    => 'mondo-instagram',
        'href'   => 'https://instagram.com/mondotheme/',
        'title' => esc_html__( 'Instagram', 'pipit' ),
    );

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */

    /*
     *
     * ---> START SECTIONS
     *
     */

    /*

        As of Redux 3.5+, there is an extensive API. This API can be used in a mix/match mode allowing for


     */

    /* General settings */

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'General Settings', 'pipit' ),
        'id'               => 'general_settings',
        'icon'             => 'el el-home',
        'fields'           => array(
            array(
                'id'       => 'main_layout',
                'type'     => 'select',
                'title'    => esc_html__( 'Main Layout', 'pipit' ),
                'options'  => array(
                    'classic' => 'Classic',
                    'box' => 'Box',
                    'list' => 'List',
                    'masonry' => 'Masonry',
                    'list_big' => '1st Big Then List',
                    'masonry_big' => '1st Big Then Masonry'
                ),
                'default'  => 'classic'
            ),
            array(
                'id'       => 'navbar_style',
                'type'     => 'select',
                'title'    => esc_html__( 'Navbar Style', 'pipit' ),
                'options'  => array(
                    'standard' => 'Standard',
                    'transparent' => 'Transparent',
                    'sticky' => 'Sticky',
                    'sticky_transparent' => 'Sticky + Transparent',
                    'big_logo' => 'Standard Big Logo',
                    'big_logo_sticky' => 'Sticky Big Logo'
                ),
                'default'  => 'standard'
            ),
            array(
                'id'       => 'sidebar',
                'type'     => 'select',
                'title'    => esc_html__( 'Sidebar', 'pipit' ),
                'options'  => array(
                    'right_sidebar' => 'Right Sidebar',
                    'left_sidebar' => 'Left Sidebar',
                    'no_sidebar' => 'No Sidebar',
                ),
                'default'  => 'right_sidebar'
            ),
            array(
                'id'          => 'brand_color',
                'type'        => 'color',
                'title'       => esc_html__( 'Brand Color', 'pipit' ), 
                'validate'    => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'logo',
                'type'     => 'media', 
                'url'      => true,
                'title'    => esc_html__( 'Logo', 'pipit' ),
                'subtitle' => esc_html__( 'This is the default logo.', 'pipit' ),
            ),
            array(
                'id'       => 'logo_light',
                'type'     => 'media', 
                'url'      => true,
                'title'    => esc_html__( 'Light Logo', 'pipit' ),
                'subtitle' => esc_html__( 'This logo will be used on Transparent and Sticky+Transparent navbar.', 'pipit' ),
            ),
            array(
                'id'       => 'retina_logo',
                'type'     => 'media', 
                'url'      => true,
                'title'    => esc_html__( 'Retina Logo', 'pipit' ),
                'subtitle' => esc_html__( 'If your logo is 150x80, the retina version should be 300x160.', 'pipit' ),
            ),
            array(
                'id'       => 'retina_logo_light',
                'type'     => 'media', 
                'url'      => true,
                'title'    => esc_html__( 'Retina Light Logo', 'pipit' ),
                'subtitle' => esc_html__( 'If your logo is 150x80, the retina version should be 300x160.', 'pipit' ),
            ),
            array(
                'id'       => 'excerpt_length',
                'type'     => 'slider',
                'title'    => esc_html__( 'Excerpt Length', 'pipit' ),
                'default'  => 55,
                'min'      => 1,
                'max'      => 200,
            ),
            array(
                'id'       => 'media_feed_type',
                'type'     => 'select',
                'title'    => esc_html__( 'Media Feed Type', 'pipit' ),
                'options'  => array(
                    'instagram' => 'Instagram',
                    'dribbble' => 'Dribbble',
                    '500px' => '500px',
                ),
                'default'  => 'instagram'
            ),
            array(
                'id'      => 'copyright_text',
                'type'    => 'editor',
                'title'   => esc_html__( 'Copyright', 'pipit' ), 
                'default' => 'Proudly powered by WordPress.',
                'args'    => array(
                    'media_buttons' => false
                )
            ),
            array(
                'id'    => 'custom_css',
                'type'  => 'ace_editor',
                'title' => esc_html__( 'Custom CSS', 'pipit' ),
                'mode'  => 'css',
                'theme' => 'monokai',
            ),
        )
    ) );

    /* Toggles */

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Toggles', 'pipit' ),
        'id'               => 'toggles',
        'icon'             => 'el el-off',
        'fields'           => array(
            array(
                'id'       => 'disable_search',
                'type'     => 'checkbox',
                'title'    => esc_html__( 'Disable Search', 'pipit' ), 
                'subtitle' => esc_html__( 'Hide search icon on the navigation bar.', 'pipit' ),
                'default'  => '0'
            ),
            array(
                'id'       => 'disable_featured_posts',
                'type'     => 'checkbox',
                'title'    => esc_html__( 'Disable Featured Posts', 'pipit' ), 
                'subtitle' => esc_html__( 'Disable featured posts slider.', 'pipit' ),
                'default'  => '0'
            ),
            array(
                'id'       => 'disable_author_section',
                'type'     => 'checkbox',
                'title'    => esc_html__( 'Disable Author Section', 'pipit' ), 
                'subtitle' => esc_html__( 'Disable author section on posts.', 'pipit' ),
                'default'  => '0'
            ),
            array(
                'id'       => 'disable_related_posts',
                'type'     => 'checkbox',
                'title'    => esc_html__( 'Disable Related Posts', 'pipit' ), 
                'subtitle' => esc_html__( 'Disable related posts section on posts.', 'pipit' ),
                'default'  => '0'
            ),
            array(
                'id'       => 'disable_sticky_sidebar',
                'type'     => 'checkbox',
                'title'    => esc_html__( 'Disable Sticky Sidebar', 'pipit' ), 
                'subtitle' => esc_html__( 'Disable sticky sidebar on scrolling.', 'pipit' ),
                'default'  => '0'
            ),
            array(
                'id'       => 'enable_media_feed',
                'type'     => 'checkbox',
                'title'    => esc_html__( 'Enable Media Feed', 'pipit' ), 
                'subtitle' => esc_html__( 'Show media feed above the footer.', 'pipit' ),
                'default'  => '0'
            ),
        )
    ) );

    /* Hero */

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Hero', 'pipit' ),
        'id'               => 'hero',
        'icon'             => 'el el-photo'
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Home Page', 'pipit' ),
        'id'               => 'hero_home',
        'subsection'       => true,
        'fields'           => array(
            array(
                'id'       => 'hero_home_disable',
                'type'     => 'checkbox',
                'title'    => esc_html__( 'Disable', 'pipit' ), 
                'default'  => '0'
            ),
            array(
                'id'       => 'hero_home_style',
                'type'     => 'select',
                'title'    => esc_html__( 'Hero Style', 'pipit' ),
                'options'  => array(
                    'half' => 'Half Screen',
                    'full' => 'Full Screen',
                ),
                'default'  => 'half'
            ),
            array(
                'id'       => 'hero_home_type',
                'type'     => 'select',
                'title'    => esc_html__( 'Hero Type', 'pipit' ),
                'options'  => array(
                    'image' => 'Image',
                    'video' => 'Video',
                    'slider' => 'Slider',
                ),
                'default'  => 'image'
            ),
            array(
                'id'       => 'hero_home_bg_image',
                'type'     => 'media', 
                'url'      => true,
                'title'    => esc_html__( 'Background Image', 'pipit' ),
            ),
            array(
                'id'       => 'hero_home_bg_video',
                'type'     => 'text',
                'title'    => esc_html__( 'Background Video', 'pipit' ),
            ),
            array(
                'id'       => 'hero_home_bg_slider',
                'type'     => 'gallery',
                'title'    => esc_html__( 'Background Slider', 'pipit' ),
            ),
            array(
                'id'       => 'hero_home_title',
                'type'     => 'text',
                'title'    => esc_html__( 'Title', 'pipit' ),
            ),
            array(
                'id'       => 'hero_home_description',
                'type'     => 'text',
                'title'    => esc_html__( 'Description', 'pipit' ),
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Single Post/Page', 'pipit' ),
        'id'               => 'hero_single',
        'subsection'       => true,
        'fields'           => array(
            array(
                'id'       => 'hero_single_enable',
                'type'     => 'checkbox',
                'title'    => esc_html__( 'Enable', 'pipit' ), 
                'default'  => '0'
            ),
            array(
                'id'       => 'hero_single_style',
                'type'     => 'select',
                'title'    => esc_html__( 'Hero Style', 'pipit' ),
                'options'  => array(
                    'half' => 'Half Screen',
                    'full' => 'Full Screen',
                ),
                'default'  => 'half'
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Shop', 'pipit' ),
        'id'               => 'hero_shop',
        'subsection'       => true,
        'fields'           => array(
            array(
                'id'       => 'hero_shop_disable',
                'type'     => 'checkbox',
                'title'    => esc_html__( 'Disable', 'pipit' ), 
                'default'  => '0'
            ),
            array(
                'id'       => 'hero_shop_style',
                'type'     => 'select',
                'title'    => esc_html__( 'Hero Style', 'pipit' ),
                'options'  => array(
                    'half' => 'Half Screen',
                    'full' => 'Full Screen',
                ),
                'default'  => 'half'
            ),
            array(
                'id'       => 'hero_shop_type',
                'type'     => 'select',
                'title'    => esc_html__( 'Hero Type', 'pipit' ),
                'options'  => array(
                    'image' => 'Image',
                    'video' => 'Video',
                    'slider' => 'Slider',
                ),
                'default'  => 'image'
            ),
            array(
                'id'       => 'hero_shop_bg_image',
                'type'     => 'media', 
                'url'      => true,
                'title'    => esc_html__( 'Background Image', 'pipit' ),
            ),
            array(
                'id'       => 'hero_shop_bg_video',
                'type'     => 'text',
                'title'    => esc_html__( 'Background Video', 'pipit' ),
            ),
            array(
                'id'       => 'hero_shop_bg_slider',
                'type'     => 'gallery',
                'title'    => esc_html__( 'Background Slider', 'pipit' ),
            ),
            array(
                'id'       => 'hero_shop_title',
                'type'     => 'text',
                'title'    => esc_html__( 'Title', 'pipit' ),
            ),
            array(
                'id'       => 'hero_shop_description',
                'type'     => 'text',
                'title'    => esc_html__( 'Description', 'pipit' ),
            ),
        )
    ) );

    /* Social media */

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Social Media', 'pipit' ),
        'id'               => 'social_media',
        'icon'             => 'el el-group'
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Instagram', 'pipit' ),
        'id'               => 'social_media_instagram',
        'subsection'       => true,
        'fields'           => array(
            array(
                'id'       => 'instagram_access_token',
                'type'     => 'text',
                'title'    => esc_html__( 'Instagram Access Token', 'pipit' ) ,
                'subtitle' => sprintf( esc_html__( 'Click %shere%s to get an access token.', 'pipit' ), '<a href="' . esc_url( 'http://' . 'instagram.mondotheme.com' ) . '" target="_blank">', '</a>' ),
                'compiler' => true,
            ),
        )
    ) );
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Flickr', 'pipit' ),
        'id'               => 'social_media_flickr',
        'subsection'       => true,
        'fields'           => array(
            array(
                'id'       => 'flickr_api_key',
                'type'     => 'text',
                'title'    => esc_html__( 'Flickr API Key', 'pipit' ),
            ),
            array(
                'id'       => 'flickr_user_id',
                'type'     => 'text',
                'title'    => esc_html__( 'Flickr User ID', 'pipit' ),
                'subtitle' => sprintf( esc_html__( 'Click %shere%s to get Flickr User ID.', 'pipit' ), '<a href="' . esc_url( 'http://' . 'idgettr.com/' ) . '" target="_blank">', '</a>' ),
            ),
        )
    ) );
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( '500px', 'pipit' ),
        'id'               => 'social_media_500px',
        'subsection'       => true,
        'fields'           => array(
            array(
                'id'       => '500px_consumer_key',
                'type'     => 'text',
                'title'    => esc_html__( '500px Consumer Key', 'pipit' ),
            ),
            array(
                'id'       => '500px_username',
                'type'     => 'text',
                'title'    => esc_html__( '500px Username', 'pipit' ),
                'compiler' => true,
            ),
        )
    ) );
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Dribbble', 'pipit' ),
        'id'               => 'social_media_dribbble',
        'subsection'       => true,
        'fields'           => array(
            array(
                'id'       => 'dribbble_access_token',
                'type'     => 'text',
                'title'    => esc_html__( 'Dribbble Access Token', 'pipit' ),
            ),
            array(
                'id'       => 'dribbble_username',
                'type'     => 'text',
                'title'    => esc_html__( 'Dribbble Username', 'pipit' ),
                'compiler' => true,
            ),
        )
    ) );
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Facebook', 'pipit' ),
        'id'               => 'social_media_facebook',
        'subsection'       => true,
        'fields'           => array(
            array(
                'id'       => 'facebook_app_id',
                'type'     => 'text',
                'title'    => esc_html__( 'Facebook App ID', 'pipit' ),
            ),
        )
    ) );
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Social Links', 'pipit' ),
        'id'               => 'social_media_social_links',
        'subsection'       => true,
        'fields'           => array(
            array(
                'id'       => 'twitter_url',
                'type'     => 'text',
                'title'    => esc_html__( 'Twitter URL', 'pipit' ),
                'default'  => 'http://twitter.com',
            ),
            array(
                'id'       => 'facebook_url',
                'type'     => 'text',
                'title'    => esc_html__( 'Facebook URL', 'pipit' ),
                'default'  => 'http://facebook.com',
            ),
            array(
                'id'       => 'youtube_url',
                'type'     => 'text',
                'title'    => esc_html__( 'YouTube URL', 'pipit' ),
                'default'  => 'http://youtube.com',
            ),
            array(
                'id'       => 'pinterest_url',
                'type'     => 'text',
                'title'    => esc_html__( 'Pinterest URL', 'pipit' ),
                'default'  => 'http://pinterest.com',
            ),
            array(
                'id'       => 'dribbble_url',
                'type'     => 'text',
                'title'    => esc_html__( 'Dribbble URL', 'pipit' ),
            ),
            array(
                'id'       => 'instagram_url',
                'type'     => 'text',
                'title'    => esc_html__( 'Instagram URL', 'pipit' ),
            ),
            array(
                'id'       => 'github_url',
                'type'     => 'text',
                'title'    => esc_html__( 'GitHub URL', 'pipit' ),
            ),
            array(
                'id'       => 'linkedin_url',
                'type'     => 'text',
                'title'    => esc_html__( 'LinkedIn URL', 'pipit' ),
            ),
            array(
                'id'       => 'tumblr_url',
                'type'     => 'text',
                'title'    => esc_html__( 'Tumblr URL', 'pipit' ),
            ),
            array(
                'id'       => 'google_plus_url',
                'type'     => 'text',
                'title'    => esc_html__( 'Google+ URL', 'pipit' ),
            ),
            array(
                'id'       => 'behance_url',
                'type'     => 'text',
                'title'    => esc_html__( 'Behance URL', 'pipit' ),
            ),
            array(
                'id'       => 'flickr_url',
                'type'     => 'text',
                'title'    => esc_html__( 'Flickr URL', 'pipit' ),
            ),
            array(
                'id'       => 'github_url',
                'type'     => 'text',
                'title'    => esc_html__( 'GitHub URL', 'pipit' ),
            ),
            array(
                'id'       => 'slideshare_url',
                'type'     => 'text',
                'title'    => esc_html__( 'SlideShare URL', 'pipit' ),
            ),
            array(
                'id'       => 'codepen_url',
                'type'     => 'text',
                'title'    => esc_html__( 'CodePen URL', 'pipit' ),
            ),
            array(
                'id'       => 'reddit_url',
                'type'     => 'text',
                'title'    => esc_html__( 'Reddit URL', 'pipit' ),
            ),
            array(
                'id'       => 'soundcloud_url',
                'type'     => 'text',
                'title'    => esc_html__( 'SoundCloud URL', 'pipit' ),
            ),
            array(
                'id'       => 'steam_url',
                'type'     => 'text',
                'title'    => esc_html__( 'Steam URL', 'pipit' ),
            ),
            array(
                'id'       => 'twitch_url',
                'type'     => 'text',
                'title'    => esc_html__( 'Twitch URL', 'pipit' ),
            ),
            array(
                'id'       => 'vine_url',
                'type'     => 'text',
                'title'    => esc_html__( 'Vine URL', 'pipit' ),
            ),
            array(
                'id'       => 'vk_url',
                'type'     => 'text',
                'title'    => esc_html__( 'VK URL', 'pipit' ),
            ),
            array(
                'id'       => 'rss_url',
                'type'     => 'text',
                'title'    => esc_html__( 'RSS URL', 'pipit' ),
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Shop Settings', 'pipit' ),
        'id'               => 'shop_settings',
        'icon'             => 'el el-shopping-cart',
        'fields'           => array(
            array(
                'id'       => 'shop_layout',
                'type'     => 'select',
                'title'    => esc_html__( 'Shop Layout', 'pipit' ),
                'options'  => array(
                    'right_sidebar' => 'Right Sidebar',
                    'left_sidebar' => 'Left Sidebar',
                    'full_width' => 'Full Width',
                ),
                'default'  => 'left_sidebar'
            ),
        )
    ) );

    /*
     * <--- END SECTIONS
     */


    /*
     *
     * YOU MUST PREFIX THE FUNCTIONS BELOW AND ACTION FUNCTION CALLS OR ANY OTHER CONFIG MAY OVERRIDE YOUR CODE.
     *
     */

    /*
    *
    * --> Action hook examples
    *
    */

    // If Redux is running as a plugin, this will remove the demo notice and links
    add_action( 'redux/loaded', 'remove_demo' );

    // Function to test the compiler hook and demo CSS output.
    // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
    //add_filter('redux/options/' . $opt_name . '/compiler', 'compiler_action', 10, 3);

    // Change the arguments after they've been declared, but before the panel is created
    //add_filter('redux/options/' . $opt_name . '/args', 'change_arguments' );

    // Change the default value of a field after it's been set, but before it's been useds
    //add_filter('redux/options/' . $opt_name . '/defaults', 'change_defaults' );

    // Dynamically add a section. Can be also used to modify sections/fields
    //add_filter('redux/options/' . $opt_name . '/sections', 'dynamic_section');

    /**
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field    set with compiler=>true is changed.
     * */
    if ( ! function_exists( 'compiler_action' ) ) {
        function compiler_action( $options, $css, $changed_values ) {
            if ( array_key_exists( 'instagram_access_token', $changed_values ) ) {
                delete_transient( 'pipit_media_feed_instagram' );
            } elseif ( array_key_exists( '500px_username', $changed_values ) ) {
                delete_transient( 'pipit_media_feed_500px' );
            } elseif ( array_key_exists( 'dribbble_username', $changed_values ) ) {
                delete_transient( 'pipit_media_feed_dribbble' );
            }
        }
    }

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error   = false;
            $warning = false;

            //do your validation
            if ( $value == 1 ) {
                $error = true;
                $value = $existing_value;
            } elseif ( $value == 2 ) {
                $warning = true;
                $value   = $existing_value;
            }

            $return['value'] = $value;

            if ( $error == true ) {
                $return['error'] = $field;
                $field['msg']    = 'your custom error message';
            }

            if ( $warning == true ) {
                $return['warning'] = $field;
                $field['msg']      = 'your custom warning message';
            }

            return $return;
        }
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ) {
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    }

    /**
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
     * Simply include this function in the child themes functions.php file.
     * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
     * so you must use get_template_directory_uri() if you want to use any of the built in icons
     * */
    if ( ! function_exists( 'dynamic_section' ) ) {
        function dynamic_section( $sections ) {
            //$sections = array();
            $sections[] = array(
                'title'  => esc_html__( 'Section via hook', 'pipit' ),
                'desc'   => esc_html__( 'This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.', 'pipit' ),
                'icon'   => 'el el-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }
    }

    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    if ( ! function_exists( 'change_arguments' ) ) {
        function change_arguments( $args ) {
            //$args['dev_mode'] = true;

            return $args;
        }
    }

    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    if ( ! function_exists( 'change_defaults' ) ) {
        function change_defaults( $defaults ) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }
    }

    /**
     * Removes the demo link and the notice of integrated demo from the redux-framework plugin
     */
    if ( ! function_exists( 'remove_demo' ) ) {
        function remove_demo() {
            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                remove_filter( 'plugin_row_meta', array(
                    ReduxFrameworkPlugin::instance(),
                    'plugin_metalinks'
                ), null, 2 );

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
            }
        }
    }

