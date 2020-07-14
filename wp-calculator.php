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
} else {
	define( 'WPC_JS_DIR_URL', plugin_dir_url( __FILE__ ) . 'assets/js' );
	define( 'WPC_CSS_DIR_URL', plugin_dir_url( __FILE__ ) . 'assets/css' );
}

function foobar_func( $atts ) {
	$react_js     = includes_url( 'js/dist/vendor/react.min.js?ver=16.9.0' );
	$react_dom_js = includes_url( 'js/dist/vendor/react-dom.min.js?ver=16.9.0' );
	$js_to_load   = WPC_JS_DIR_URL . '/main.js';
	$css_to_load  = WPC_CSS_DIR_URL . '/main.css';

	wp_enqueue_script( 'wpc-react-js', $react_js, array(), false, true );
	wp_enqueue_script( 'wpc-react-dom-js', $react_dom_js, array(), false, true );
	wp_enqueue_script( 'wpc-js', $js_to_load, array( 'wpc-react-js', 'wpc-react-dom-js' ), false, true );
	wp_enqueue_style( 'wpc-css', $css_to_load );

	ob_start();
	echo '<div id="wp-calculator"></div>';
	return ob_get_clean();
}
add_shortcode( 'wp_calculator', 'foobar_func' );

// if ( isset( $_GET['page'] ) && 'wp-calculator' === $_GET['page'] ) {
// add_action( 'in_admin_header', 'hide_unrelated_notices' );
// }

function render_wp_calculator_settings() {
	echo 'hello';
}

// add to settings menu
add_action(
	'admin_menu',
	function () {
		add_menu_page(
			'WP Calculator',
			'WP Calculator',
			'manage_options',
			'wp-calculator',
			'render_wp_calculator_settings',
			'dashicons-welcome-widgets-menus',
			30
		);
	}
);

function hide_unrelated_notices() {
	global $wp_filter;

	// Bail if we're not on a EverestForms screen or page.
	if ( empty( $_REQUEST['page'] ) || false === strpos( sanitize_text_field( wp_unslash( $_REQUEST['page'] ) ), 'dynamic-general' ) ) {
		return;
	}

	foreach ( array( 'user_admin_notices', 'admin_notices', 'all_admin_notices' ) as $wp_notice ) {
		if ( ! empty( $wp_filter[ $wp_notice ]->callbacks ) && is_array( $wp_filter[ $wp_notice ]->callbacks ) ) {
			foreach ( $wp_filter[ $wp_notice ]->callbacks as $priority => $hooks ) {
				foreach ( $hooks as $name => $arr ) {
					if ( is_object( $arr['function'] ) && $arr['function'] instanceof Closure ) {
						unset( $wp_filter[ $wp_notice ]->callbacks[ $priority ][ $name ] );
						continue;
					}
					if ( ( isset( $_GET['tab'], $_GET['form_id'] ) || isset( $_GET['create-form'] ) ) && 'evf-builder' === $_REQUEST['page'] ) {
						unset( $wp_filter[ $wp_notice ]->callbacks[ $priority ][ $name ] );
						continue;
					}
					if ( ! empty( $arr['function'][0] ) && is_object( $arr['function'][0] ) && false !== strpos( strtolower( get_class( $arr['function'][0] ) ), 'evf_' ) ) {
						continue;
					}
					if ( ! empty( $name ) && false === strpos( strtolower( $name ), 'evf_' ) ) {
						unset( $wp_filter[ $wp_notice ]->callbacks[ $priority ][ $name ] );
					}
				}
			}
		}
	}
}
