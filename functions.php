<?php
/**
* Alloy functions and definitions.
*
* @link https://developer.wordpress.org/themes/basics/theme-functions/
*
* @package Alloy
*/

if ( ! function_exists( 'alloy_setup' ) ) :
	/**
	* Sets up theme defaults and registers support for various WordPress features.
	*
	* Note that this function is hooked into the after_setup_theme hook, which
	* runs before the init hook. The init hook is too late for some features, such
	* as indicating support for post thumbnails.
	*/
	function alloy_setup() {
		/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Alloy, use a find and replace
		* to change 'alloy' to the name of your theme in all the template files.
		*/
		load_theme_textdomain( 'alloy', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
		add_theme_support( 'title-tag' );

		/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Menu', 'alloy' ),
			) );

			/*
			* Switch default core markup for search form, comment form, and comments
			* to output valid HTML5.
			*/
			add_theme_support( 'html5', array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			) );

			/*
			* Enable support for Post Formats.
			* See https://developer.wordpress.org/themes/functionality/post-formats/
			*/
			add_theme_support( 'post-formats', array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
			) );

			// Set up the WordPress core custom background feature.
			add_theme_support( 'custom-background', apply_filters( 'alloy_custom_background_args', array(
				'default-color' => 'ffffff',
				'default-image' => '',
			) ) );
		}
	endif; // alloy_setup
	add_action( 'after_setup_theme', 'alloy_setup' );

	/**
	* Set the content width in pixels, based on the theme's design and stylesheet.
	*
	* Priority 0 to make it available to lower priority callbacks.
	*
	* @global int $content_width
	*/
	function alloy_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'alloy_content_width', 640 );
	}
	add_action( 'after_setup_theme', 'alloy_content_width', 0 );

	/**
	* Register widget area.
	*
	* @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
	*/
	function alloy_widgets_init() {
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar', 'alloy' ),
			'id'            => 'sidebar-1',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
			) );
		}
		add_action( 'widgets_init', 'alloy_widgets_init' );

		/**
		* Enqueue scripts and styles.
		*/
		function alloy_scripts() {
			wp_enqueue_style( 'alloy-style', get_stylesheet_uri() );

			wp_enqueue_script( 'alloy-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

			wp_enqueue_script( 'alloy-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}
		}
		add_action( 'wp_enqueue_scripts', 'alloy_scripts' );

		/**
		* Implement the Custom Header feature.
		*/
		require get_template_directory() . '/inc/custom-header.php';

		/**
		* Custom template tags for this theme.
		*/
		require get_template_directory() . '/inc/template-tags.php';

		/**
		* Custom functions that act independently of the theme templates.
		*/
		require get_template_directory() . '/inc/extras.php';

		/**
		* Customizer additions.
		*/
		require get_template_directory() . '/inc/customizer.php';

		/**
		* Load Jetpack compatibility file.
		*/
		require get_template_directory() . '/inc/jetpack.php';


		//Theme logo customizer
		function themeslug_theme_customizer( $wp_customize ) {
			// Fun code will go here
			$wp_customize->add_section( 'themeslug_logo_section' , array(
				'title'       => __( 'Logo', 'themeslug' ),
				'priority'    => 30,
				'description' => 'Upload a logo to replace the default site name and description in the header',
				) );
				$wp_customize->add_setting( 'themeslug_logo' );
				$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themeslug_logo', array(
					'label'    => __( 'Logo', 'themeslug' ),
					'section'  => 'themeslug_logo_section',
					'settings' => 'themeslug_logo',
					) ) );

				}
				add_action( 'customize_register', 'themeslug_theme_customizer' );
				//END Theme logo customizer
				//Footer widgets customizer
				if ( function_exists('register_sidebar') )
				register_sidebar( array(
					'name' => __( 'Footer widgets'),
					'id' => 'mycustomwidgetarea',
					'description' => __( 'An optional widget area for your site footer', 'twentyeleven' ),
					'before_widget' => '<div class="footer-widget">',
					'after_widget' => '</div>',
					'before_title' => '<h5>',
					'after_title' => '</h5>',
					) );
					/*END Disable front end edit text*/

					/*Make CPT UI and VC play nice*/
					// remove_action( 'init', 'cptui_create_custom_post_types', 10 );
					// add_action( 'init', 'cptui_create_custom_post_types', 8 );
					add_action( 'after_setup_theme', 'easj_remove_parent_theme_stuff', 0 );

					function easj_remove_parent_theme_stuff() {
						remove_action( 'init', 'cptui_create_custom_post_types', 10 );
					}

					add_action( 'init', 'cptui_create_custom_post_types', 1 );
					/*END Make CPT UI and VC play nice*/
					//dequeue css from plugins
					function PREFIX_remove_scripts() {
						wp_dequeue_style( array ('contact-form-7'));
						wp_deregister_style( array ('contact-form-7'));

						// Now register your styles and scripts here
					}
					add_action( 'wp_enqueue_scripts', 'PREFIX_remove_scripts', 20 );
					//END dequeue css from plugins

					/**
					 * Load WooCommerce compatibility file.
					 */
					require get_template_directory() . '/inc/woocommerce.php';
					remove_action( 'admin_notices', 'woothemes_updater_notice' );
