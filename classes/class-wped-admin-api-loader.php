<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

require_once WPED__PLUGIN_DIR . 'classes/api/v1/class-wped-admin-rest-base-v1.php';
require_once WPED__PLUGIN_DIR . 'classes/api/v1/class-wped-admin-rest-translate-v1-controller.php';


class WPED_Admin_Api_Loader {

    /**
    * @var Admin_Api_Loader
    **/
    private static $instance = null;

    static function init() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new WPED_Admin_Api_Loader;
        }
        return self::$instance;
    }

    public function __construct() {
        // WP REST API.
        $this->rest_api_init();
    }

    private function rest_api_init() {
    // REST API was included starting WordPress 4.4.
        if ( ! class_exists( 'WP_REST_Server' ) ) {
          return;
        }

       
        // Init REST API routes.
        add_action( 'rest_api_init', array( $this, 'register_rest_routes' ), 10 );
      }


      public function register_rest_routes() {
        // Register settings to the REST API.
        //$this->register_wp_admin_settings();

        $controllers = array(
            // v1 controllers.
            'WPED_Admin_REST_Translate_V1_Controller'
          
        );

        foreach ( $controllers as $controller ) {
            $this->$controller = new $controller();
            $this->$controller->register_routes();
        }
    }
    
}

WPED_Admin_Api_Loader::init();