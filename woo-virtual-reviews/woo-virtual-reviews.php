<?php
/**
 * Plugin Name: Faview - Virtual Reviews for WooCommerce
 * Plugin URI: https://villatheme.com/extensions/faview-virtual-reviews-for-woocommerce/
 * Description: Faview - Virtual Reviews for WooCommerce creates and display canned reviews to increase your conversion rate.
 * Author: VillaTheme
 * Version: 2.0.0
 * Author URI: http://villatheme.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: woo-virtual-reviews
 * Domain Path: /languages
 * Copyright 2018-2025 VillaTheme.com. All rights reserved.
 * Requires Plugins: woocommerce
 * Requires at least: 5.0
 * Tested up to: 6.7
 * WC requires at least: 5.0
 * WC tested up to: 9.7
 * Requires PHP: 7.0
 */

defined( 'ABSPATH' ) || exit();

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

define( 'VI_WOO_VIRTUAL_REVIEWS_VERSION', '2.0.0' );
define( 'WVR_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'WVR_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

class VirtualReviews_F {
	public function __construct() {
		register_activation_hook( __FILE__, [ $this, 'active' ] );

		add_action( 'plugins_loaded', [ $this, 'init' ] );
		add_action( 'before_woocommerce_init', [ $this, 'custom_order_tables_declare_compatibility' ] );
	}

	public function init() {
		if ( class_exists( 'VirtualReviews\VirtualReviews' ) ) {
			return;
		}

		$include_dir = plugin_dir_path( __FILE__ ) . 'includes/';

		if ( ! class_exists( 'VillaTheme_Require_Environment' ) ) {
			include_once $include_dir . 'support.php';
		}

		$environment = new \VillaTheme_Require_Environment( [
				'plugin_name'     => 'Faview - Virtual Reviews for WooCommerce',
				'php_version'     => '7.0',
				'wp_version'      => '5.0',
				'require_plugins' => [
					[
						'slug' => 'woocommerce',
						'name' => 'WooCommerce' ,
						'defined_version' => 'WC_VERSION',
						'version' => '7.0',
					]
				]
			]
		);

		if ( $environment->has_error() ) {
			return;
		}

		add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), [ $this, 'wvr_add_action_links' ] );

		require_once plugin_dir_path( __FILE__ ) . "define.php";
	}

	public function active() {
		if ( ! get_option( 'wvr_data' ) ) {
			$data = array( 'show_purchased_label' => 'yes', 'auto_rating' => 'yes', 'show_canned' => 'yes' );
			update_option( 'wvr_data', $data );
		}
	}

	public function wvr_add_action_links( $links ) {
		$my_link = '<a href="' . admin_url( 'admin.php?page=virtual-reviews' ) . '">' . esc_html__( 'Settings', 'woo-virtual-reviews' ) . '</a>';
		array_unshift( $links, $my_link );

		return $links;
	}

	public function custom_order_tables_declare_compatibility() {
		if ( class_exists( \Automattic\WooCommerce\Utilities\FeaturesUtil::class ) ) {
			\Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'custom_order_tables', __FILE__, true );
		}
	}
}

new VirtualReviews_F();
