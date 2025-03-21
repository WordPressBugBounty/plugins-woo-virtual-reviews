<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 08/11/2018
 * Time: 10:15 SA
 */

namespace WooVR;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Add_Multi_Reviews {

	protected static $instance = null;
	protected $current_time;

	function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'woo_virtual_reviews_asset' ) );
		add_action( 'admin_head', array( $this, 'my_custom_fonts' ) );

		//Admin product page
		add_action( 'manage_posts_custom_column', array( $this, 'show_virtual_review_count' ), 10, 2 );
		add_filter( 'manage_edit-product_columns', array( $this, 'change_columns_filter' ), 20 );
		add_filter( 'manage_edit-product_sortable_columns', array( $this, 'my_sortable_cake_column' ) );
		add_action( 'pre_get_posts', array( $this, 'my_slice_orderby' ) );
	}

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function woo_virtual_reviews_asset() {
		$screen = get_current_screen()->id;
		if ( $screen !== 'edit-product' ) {
			return;
		}

		wp_enqueue_style( 'wvr-product-list-page', WVR_PLUGIN_URL . "assets/css/product-list-page.css", '', VI_WOO_VIRTUAL_REVIEWS_VERSION );
		wp_enqueue_script( 'wvr-product-list-page', WVR_PLUGIN_URL . "assets/js/product-list-page.js", [ 'jquery' ], VI_WOO_VIRTUAL_REVIEWS_VERSION, false );
	}

	public function random_time() {
		$now  = $this->current_time;
		$rand = wp_rand( $now - 172800, $now );

		return date_i18n( 'Y-m-d H:i:s', $rand );
	}

	public function change_columns_filter( $columns ) {
		$new_columns                   = array();
//		$new_columns['virtual_review'] = esc_html__( 'Virtual review', 'woo-virtual-reviews' );
		$new_columns['wvr_rating']     = esc_html__( 'Rating', 'woo-virtual-reviews' );

		return $columns = array_merge( $columns, $new_columns );
	}

	public function show_virtual_review_count( $column_name, $pid ) {
		if ( $column_name == 'virtual_review' ) {
//			$cmts = get_comments( array(
//				'post_id'    => $pid,
//				'type'       => 'review',
//				'meta_key'   => 'wvr_virtual_review',// phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
//				'meta_value' => 1,// phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_value
//				'count'      => true
//			) );
//			echo esc_html( $cmts );
		} elseif ( $column_name == 'wvr_rating' ) {
			echo esc_html( get_post_meta( $pid, '_wc_average_rating', true ) );
		}
	}

	public function my_sortable_cake_column( $columns ) {
		$columns['wvr_rating']     = 'wvr_rating';
//		$columns['virtual_review'] = 'virtual_review';

		return $columns;
	}

	public function my_slice_orderby( $query ) {
		if ( ! is_admin() ) {
			return;
		}
		$orderby = $query->get( 'orderby' );

		if ( 'wvr_rating' == $orderby ) {
			$query->set( 'meta_key', '_wc_average_rating' );
			$query->set( 'orderby', 'meta_value_num' );
		} elseif ( 'virtual_review' == $orderby ) {
			$query->set( 'orderby', 'meta_value_num' );
		}
	}

	public function my_custom_fonts() {
		$style_head = '<style> .column-virtual_review, .column-wvr_rating {width: 70px !important;text-align: center !important;} </style>';
		wp_add_inline_style( 'wvr-admin-head', $style_head );
	}
}
