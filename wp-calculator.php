<?php
/**
 * Plugin Name: WP Calculator
 * Plugin URI: http://wordpress.org/plugins/wp-calculator
 * Description: Embed calculators on your website.
 * Version: 1.0.0
 * Author: Godson Programmer
 * Author URI: https://krishna-suwal.com
 * Text Domain: wp-calculator
 * License: MIT
 */


if ( defined( 'WPC_ENV_DEV' ) && WPC_ENV_DEV ) {
	define( 'WPC_JS_DIR_URL', 'http://localhost:3000/static/js' );
	define( 'WPC_CSS_DIR_URL', 'http://localhost:3000/static/css' );

	define( 'WPC_MAIN_JS_ASSET_FILENAME', 'main.js' );
	define( 'WPC_MAIN_CSS_ASSET_FILENAME', 'main.css' );
} else {
	define( 'WPC_JS_DIR_URL', plugin_dir_url( __FILE__ ) . 'assets/js' );
	define( 'WPC_CSS_DIR_URL', plugin_dir_url( __FILE__ ) . 'assets/css' );

	define( 'WPC_MAIN_JS_ASSET_FILENAME', 'main.971988b4045260232936.js' );
	define( 'WPC_MAIN_CSS_ASSET_FILENAME', 'main.1152c84ad29460152ee3.css' );
}

function render_wp_calculator( $atts ) {
	// React Assets.
	$react_js     = includes_url( 'js/dist/vendor/react.min.js' );
	$react_dom_js = includes_url( 'js/dist/vendor/react-dom.min.js' );

	// Local Assets.
	$wpc_js_asset_url  = WPC_JS_DIR_URL . '/' . WPC_MAIN_JS_ASSET_FILENAME;
	$wpc_css_asset_url = WPC_CSS_DIR_URL . '/' . WPC_MAIN_CSS_ASSET_FILENAME;

	wp_enqueue_script( 'wpc-react-js', $react_js, array(), '16.9.0', true );
	wp_enqueue_script( 'wpc-react-dom-js', $react_dom_js, array(), '16.9.0', true );
	wp_enqueue_script( 'wpc-js', $wpc_js_asset_url, array( 'wpc-react-js', 'wpc-react-dom-js' ), false, true );
	wp_enqueue_style( 'wpc-css', $wpc_css_asset_url );

	return '<div id="wp-calculator-container"></div>';
}

add_shortcode( 'wp_calculator', 'render_wp_calculator' );
