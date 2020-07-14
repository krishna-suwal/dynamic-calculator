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

function foobar_func( $atts ) {
}
add_shortcode( 'wp_calculator', 'foobar_func' );

// if ( isset( $_GET['page'] ) && 'wp-calculator' === $_GET['page'] ) {
// 	add_action( 'in_admin_header', 'hide_unrelated_notices' );
// }

// add to settings menu
add_action(
	'admin_menu',
	function () {
		add_menu_page(
			'WP Calculator',
			'WP Calculator',
			'manage_options',
			'wp-calculator',
			'render_wp_calculator_home',
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
