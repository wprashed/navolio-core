<?php

/**
 *
 * @wordpress-plugin
 * Plugin Name:       Navolio Core
 * Description:       Support plugin for Navolio theme.
 * Version:           1.0.0
 * Author:            Toroiz Themes
 * Author URI:        https://tortoizthemes.com
 * Text Domain:       navolio-core
 * Domain Path:       /languages
 */

final class navolio {

	// Widget Version

	const VERSION = '1.0.0';

	// Minimum Elementor Version

	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

	// Minimum PHP Version

	const MINIMUM_PHP_VERSION = '7.0';

	private static $_instance = null;

	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	public function __construct() {

		add_action( 'init', [ $this, 'i18n' ] );
		add_action( 'plugins_loaded', [ $this, 'init' ] );

	}

	public function i18n() {

		load_plugin_textdomain( 'navolio-core', false, dirname( __FILE__ ) . "/languages" );

	}

	public function init() {

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}

		// Add Plugin actions
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
		add_action( 'elementor/elements/categories_registered', [ $this, 'register_new_category'] );
	}

	public function register_new_category($manager){
		$manager->add_category('navolio_addons', [
			'title'=>__('Navolio Addons', 'navolio-core'),
			'icon'=>'fa fa-image'
		]);
	}

	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
		/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'navolio-core' ),
			'<strong>' . esc_html__( 'Navolio Elementor Extension', 'navolio-core' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'navolio-core' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
		/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'navolio-core' ),
			'<strong>' . esc_html__( 'Navolio Elementor Extension', 'navolio-core' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'navolio-core' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
		/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'navolio-core' ),
			'<strong>' . esc_html__( 'Navolio Elementor Extension', 'navolio-core' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'navolio-core' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	public function init_widgets() {

		// Include Widget files
		require_once( __DIR__ . '/addons/about-author.php' );
		require_once( __DIR__ . '/addons/instagram-feed.php' );
		require_once( __DIR__ . '/addons/blog-one.php' );
		require_once( __DIR__ . '/addons/blog-two.php' );
		require_once( __DIR__ . '/addons/blog-three.php' );
		require_once( __DIR__ . '/addons/sidebar.php' );

		// Register widget
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Navolio_About_Author() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Navolio_Instagram_Feed() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Navolio_Blog_one() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Navolio_Blog_Two() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Navolio_Blog_Three() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Navolio_Sidebar() );
	}

}

navolio::instance();

?>