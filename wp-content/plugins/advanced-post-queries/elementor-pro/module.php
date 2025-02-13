<?php
namespace AQ\Module\Elementor;


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'AQ\Module\Elementor\Module' ) ) {
	

class Module {	

	
	public function __construct() {
		require_once __DIR__ . '/controls/controls.php';
		require_once __DIR__ . '/queries/queries.php';
		
	}
	
}

new Module();


}