<?php
/**
 * Plugin Name: Dynamic Calculator
 * Plugin URI: https://wordpress.org/plugins/dynamic-calculator/
 * Description: Embed calculators on your website.
 * Version: 1.0.0
 * Author: Krishna Suwal
 * Requires PHP: 5.6
 * Requires at least: 4.9
 * License: GPL-2.0+
 *
 * @package Dynamic Calculator
 */

if ( defined( 'DC_ENV_DEV' ) && DC_ENV_DEV ) {
	define( 'DC_JS_DIR_URL', 'http://localhost:3000/static/js' );
	define( 'DC_CSS_DIR_URL', 'http://localhost:3000/static/css' );

	define( 'DC_MAIN_JS_ASSET_FILENAME', 'main.js' );
	define( 'DC_MAIN_CSS_ASSET_FILENAME', 'main.css' );
} else {
	define( 'DC_JS_DIR_URL', plugin_dir_url( __FILE__ ) . 'assets/js' );
	define( 'DC_CSS_DIR_URL', plugin_dir_url( __FILE__ ) . 'assets/css' );

	define( 'DC_MAIN_JS_ASSET_FILENAME', 'main.9b934e47387ef658894e.js' );
	define( 'DC_MAIN_CSS_ASSET_FILENAME', 'main.b5abd60d1875487f6a67.css' );
}

function render_dc_calculator( $atts ) {
	// React Assets.
	$react_js     = includes_url( 'js/dist/vendor/react.min.js' );
	$react_dom_js = includes_url( 'js/dist/vendor/react-dom.min.js' );

	// Local Assets.
	$dc_js_asset_url  = DC_JS_DIR_URL . '/' . DC_MAIN_JS_ASSET_FILENAME;
	$dc_css_asset_url = DC_CSS_DIR_URL . '/' . DC_MAIN_CSS_ASSET_FILENAME;

	wp_enqueue_script( 'dc-react-js', $react_js, array(), '16.9.0', true );
	wp_enqueue_script( 'dc-react-dom-js', $react_dom_js, array(), '16.9.0', true );
	wp_enqueue_script( 'dc-js', $dc_js_asset_url, array( 'dc-react-js', 'dc-react-dom-js' ), false, true );
	wp_enqueue_style( 'dc-css', $dc_css_asset_url );

	return '<div id="dc-calculator-container"></div>';
}

add_shortcode( 'dc_calculator', 'render_dc_calculator' );
