<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/*
WP_REST_Server::READABLE = ‘GET’
WP_REST_Server::EDITABLE = ‘POST, PUT, PATCH’
WP_REST_Server::DELETABLE = ‘DELETE’
WP_REST_Server::ALLMETHODS = ‘GET, POST, PUT, PATCH, DELETE’
*/

class WPED_Admin_REST_Translate_V1_Controller extends WPED_Admin_REST_Base_v1 {
	
	protected $controller = "/translate/"; 

	function register_routes(){
		/*
		register_rest_route( parent::get_api_base(), '/hello/(?P<id>[\d]+)/(?P<test>[\d]+)', array(
    		'methods' => 'GET',
    		'callback' => array($this,'hello_world'),

    		//'permission_callback' => array( $this, 'get_item_permissions_check' ),
    	));
    	*/
    	register_rest_route( parent::get_api_base(), $this->controller . 'get' , array(
    		'methods' => WP_REST_Server::READABLE,
    		'callback' => array($this,'run_cron'),

    		//'permission_callback' => array( $this, 'get_item_permissions_check' ),
    	));
	}

	function get_item_permissions_check($request){
		return true;
	}

	function run_cron($request){
		return array(
			'Dashboard' => __('Dashboard','admin'),
			'Settings' => __('Settings','admin')
		);
	}

}