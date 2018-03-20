<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WPED_Admin_App_Loader {

  /**
  * @var Jetpack_Admin
  **/
  private static $instance = null;

  static function init() {
    if ( is_null( self::$instance ) ) {
      self::$instance = new WPED_Admin_App_Loader;
    }
    return self::$instance;
  }

  private function __construct() {

    /*
     * ADMIN PAGE: Register and Create the Admin Page
     */
    add_action( 'admin_menu', array( $this, 'register_menu' ) );

    /*
     * ADMIN APP: Enqueue JavaScript for application
     */
    add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
  }

   function load_scripts() {
        wp_enqueue_script( 'admin-appinline', WPED__PLUGIN_URL . 'dev/inline.bundle.js', array( 'jquery' ), WPED__PLUGIN_VERSION, true );
        wp_enqueue_script( 'admin-apppolyfills', WPED__PLUGIN_URL . 'dev/polyfills.bundle.js', array( 'jquery' ), WPED__PLUGIN_VERSION, true );
       // wp_enqueue_script( 'admin-appstyles', WPED__PLUGIN_URL . 'dev/styles.bundle.js', array( 'jquery' ), WPED__PLUGIN_VERSION, true );
        wp_enqueue_script( 'admin-appvendor', WPED__PLUGIN_URL . 'dev/vendor.bundle.js', array( 'jquery' ), WPED__PLUGIN_VERSION, true );
        wp_register_script( 'admin-appmain', WPED__PLUGIN_URL . 'dev/main.bundle.js', array( 'jquery' ), WPED__PLUGIN_VERSION, true );
        wp_enqueue_style( 'admin-app-styles', WPED__PLUGIN_URL . 'dev/styles.bundle.css', array(), WPED__PLUGIN_VERSION, 'all' );

        wp_localize_script( 'admin-appmain', 'admin_app_local',
            array(
                'api_url' => get_rest_url(),
                'template_directory' => WPED__PLUGIN_URL . 'templates',
                'nonce' => wp_create_nonce( 'wp_rest' ),
            )
        );

        $router  = array(
          array(  'path' => 'dashboard', 'component' => 'DashboardComponent' ),
          array(  'path' => 'dashboard', 'component' => 'DashboardComponent' ),
          array(  'path' => 'dashboard', 'redirectTo' => '/dashboard','pathMatch' => 'full' )

         );

        wp_add_inline_script( 'admin-appmain' ,'window.adminapp = { isSetup:true };', 'before');

        // Enqueued script with localized data.
        wp_enqueue_script( 'admin-appmain' );
    }

    function register_menu() {
        add_menu_page( 'WPED V2', 'WPED V2', 'manage_options', 'wped-app', array( $this, 'admin_page' ) );    
    }

    function admin_scripts( $hook ) {
      wp_enqueue_editor();
        if( $hook !== 'toplevel_page_wped-app' )
            return;
        $this->load_scripts();
    }

    function admin_page() {

        echo
            '
  <base href="'.menu_page_url('wped-app', false).'">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
<style type="text/css">
    body, html {
      height: 100%;
    }
    .app-loading {
      position: relative;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100%;
    }
    .app-loading .apploader {
      height: 200px;
      width: 200px;
      animation: rotate 2s linear infinite;
      transform-origin: center center;
      position: absolute;
      top: 0;
      bottom: 0;
      left: 0;
      right: 0;
      margin: auto;
    }
    .app-loading .apploader .path {
      stroke-dasharray: 1, 200;
      stroke-dashoffset: 0;
      animation: dash 1.5s ease-in-out infinite;
      stroke-linecap: round;
      stroke: #405267;
    }
    @keyframes rotate {
      100% {
        transform: rotate(360deg);
      }
    }
    @keyframes dash {
      0% {
        stroke-dasharray: 1, 200;
        stroke-dashoffset: 0;
      }
      50% {
        stroke-dasharray: 89, 200;
        stroke-dashoffset: -35px;
      }
      100% {
        stroke-dasharray: 89, 200;
        stroke-dashoffset: -124px;
      }
    }
  </style>
  <app-root><br><br><br><br><div class="app-loading">
      <div class="logo"></div>
      <svg class="apploader" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
      </svg>
    </div></app-root>
';

    }

}

WPED_Admin_App_Loader::init();