<?php 
/**
 * Plugin Name: Elementor Bootstrap Components and Blog Posts Widgets
 * Description: Elementor extension with 20+ Free widgets using Bootstrap components. 7 blog posts, Modal, Card, Tooltip, Spinner, Breadcrumb, Pagination, Slider, Carousel, etc.
 * Plugin URI:  https://elementor.com/
 * Version:     1.0.0
 * Author:      motahar1
 * Text Domain: ebc-by-motahar
 */

namespace EBC;

defined( 'ABSPATH' ) || die();

// Define Plugin DIR
if( ! defined( 'EBC_DIR' ) ) {
  define( 'EBC_DIR', plugin_dir_path( __FILE__ ) );
}

// Include functions.php file.
require_once( __DIR__ . '/inc/functions.php' );

class ebc_base_class {

    /**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 * @var string The plugin version.
	 */
    const VERSION = '1.0.0';

    /**
     * Plugin Development
     *
     * @since 1.0.0
     * @var string The plugin development mode.
     */
    const DEVELOPMENT = false;
    
    /**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';
    
    /**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '5.6';
    
    /**
	 * Instance
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 * @static
	 *
	 * @var EBC_For_Elementor The single instance of the class.
	 */
	private static $_instance = null;

    /**
	 * Constructor
	 *
	 * @since 1.0.0
	 * @access public
	 */
    public function __construct() {
        
        if( self::DEVELOPMENT ) {
            $this->version = esc_attr( uniqid() );
        } else {
            $this->version = self::VERSION;
        }
        
        add_action( 'init', [ $this, 'i18n' ] );
        add_action( 'plugins_loaded', [ $this, 'init' ] );

    }


    /**
	 * Load Textdomain
	 *
	 * Load plugin localization files.
	 * Fired by `init` action hook.
	 *
	 * @since 1.0.0
	 * @access public
	 */
    public function i18n() {
		load_plugin_textdomain( 'ebc-by-motahar' );
	}


    /**
    * When class is instantiated
    */
    public function init() {

        // Define Plugin DIR
        if( ! defined( 'ebc_dir' ) ) {
            define( 'ebc_dir', plugin_dir_path( __FILE__ ) );
        }

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

        // Register Widget Styles
        add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'ebc_enqueue_styles' ] );
        
        // Register Widget Scripts
        add_action( 'elementor/frontend/after_register_scripts', [ $this, 'ebc_enqueue_scripts' ] );

        // Register category
        add_action( 'elementor/elements/categories_registered', array($this,'ebc_widget_categories')  );

        // Register Widgets
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
      
    }

    /**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 * @access public
	 */
    public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" plugin requires "%2$s" to be installed and activated.', 'ebc-by-motahar' ),
			'<strong>' . esc_html__( 'Elementor Bootstrap Widgets', 'ebc-by-motahar' ) . '</strong>',
			'<a href="'. admin_url() .'plugin-install.php?tab=plugin-information&plugin=elementor&TB_iframe=true&width=772&height=624" class="thickbox open-plugin-details-modal"><strong>' . esc_html__( 'Elementor Plugin', 'ebc-by-motahar' ) . '</strong></a>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}
    
    /**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
    public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" plugin requires "%2$s" version %3$s or greater.', 'ebc-by-motahar' ),
			'<strong>' . esc_html__( 'Elementor Bootstrap Widgets', 'ebc-by-motahar' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'ebc-by-motahar' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

    /**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" plugin requires "%2$s" version %3$s or greater.', 'ebc-by-motahar' ),
			'<strong>' . esc_html__( 'Elementor Bootstrap Widgets', 'ebc-by-motahar' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'ebc-by-motahar' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

    public function ebc_enqueue_styles(){
        wp_enqueue_style( 'ebc-all-styles', plugins_url( 'assets/css/ebc-styles.css', __FILE__ ), [], $this->version );
    }


    public function ebc_enqueue_scripts(){
        wp_enqueue_script("jquery");
        wp_enqueue_script( 'ebc-popper-scripts', plugins_url( 'assets/js/popper.min.js', __FILE__ ), [ 'jquery' ], $this->version, true );
        wp_enqueue_script( 'ebc-bootstrap-scripts', plugins_url( 'assets/js/bootstrap-v4.4.1.min.js', __FILE__ ), [ 'jquery' ], $this->version, true );
        wp_enqueue_script( 'ebc-slick', plugins_url( 'assets/slick/js/slick.min.js', __FILE__ ), [ 'jquery' ], $this->version, true );
        wp_enqueue_script( 'ebc-mousewheel', plugins_url( 'assets/js/jquery.mousewheel.js', __FILE__ ), [ 'jquery' ], $this->version, true );
        wp_enqueue_script( 'ebc-scripts', plugins_url( 'assets/js/ebc-scripts.js', __FILE__ ), [ 'jquery' ], $this->version, true );
    
    }


    /**
    * @param $elements_manager
    * elementor Category Name
    */
    public function ebc_widget_categories( $elements_manager ) {

        $elements_manager->add_category(
            'ebc_category',
            array(
                'title' => __( 'Bootstrap Widgets', 'ebc-by-motahar' ),
                'icon' => 'fa fa-plug',
            )
        );

    }


    /**
	 * Init Widgets
	 *
	 * Include widgets files and register them.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function init_widgets() {
        $widgets = wp_normalize_path( ebc_dir . '/widgets/*.php' );
        foreach( glob( $widgets ) as $widget ) {
            $class_name = basename( $widget, '.php' );
            $class_name = str_replace( '-', ' ', $class_name );
            $class_name = ucwords( $class_name );
            $class_name = str_replace( ' ', '_', $class_name );
            $class_name = '\EBC\Widgets\\' . $class_name;
            
            require_once( $widget );
            
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new $class_name );
            
        }
	}

}

/**
 * Instantiate class
 */
$ebc_base_class_instantiated = new ebc_base_class();