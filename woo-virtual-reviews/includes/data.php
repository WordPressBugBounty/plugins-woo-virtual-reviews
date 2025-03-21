<?php
/**
 * Created by PhpStorm.
 * User: Villatheme-Thanh
 * Date: 04-05-19
 * Time: 2:55 PM
 */

namespace WooVR;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Data {

	protected static $instance = null;
	protected $options;

	private function __construct() {
		$this->get_params();
	}

	public static function instance() {
		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	protected $default_data = array(
		'names' => array(
			"Aadarsh",
			"Aiden",
			"Alan",
			"Angel",
			"Anthony",
			"Avery",
			"Bryan",
			"Camden",
			"Charles",
			"Daniel",
			"David",
			"Dominic",
			"Dylan",
			"Edward",
			"Hayden",
			"Henry",
			"Isaac",
			"Jackson",
			"John",
			"Julian",
			"Kaden Arabic",
			"Kai",
			"Kayden",
			"Kevin",
			"Leo",
			"Liam",
			"Lucas",
			"Mason",
			"Mateo",
			"Matthew",
			"Max",
			"Michael",
			"Nathaniel",
			"Nicholas",
			"Nolan",
			"Owen",
			"Patrick",
			"Paul",
			"Richard",
			"Riley",
			"Robert",
			"Ryan",
			"Ryder",
			"Ryker",
			"Samuel",
			"Phoenix",
			"Tyler",
			"William",
			"Zane",
			"Zohar",
		),

		'cmt' => array(
			"Good quality.",
			"The product is firmly packed.",
			"Good service.",
			"Very well worth the money.",
			"Very fast delivery.",
		),

		'reply_content' => [
			'default' => [
				1 => [
					"We're definitely sorry about the problem you had to experience! Could you clarify so we can assist further?",
					"Our apology for your negative experience you had with our service. We'd like to learn more about your situation and make things right. If you wouldn't mind us contacting you, it would be greatly appreciated. We look forward to speaking with you and working towards earning back your business.",
					"I wanted to reach out and apologize for the experience you had with our team. This is not typical of us and I can assure you it would not happen again. I wanted you to know that I've used your experience within our customer satisfaction process to make sure we don't make this mistake again. If there's any ways to earn your business in the future please let me know.",
					"Thank you for your feedback. I'm sorry you weren't pleased with the options and the function of the item. However, it's helpful to know how our guests experience individual item, as we take into consideration every piece of feedback that we come across. Thank you for coming in to see us. All the best to you.",
					"Thank you for for your review. We're sorry to hear that you did not have a great experience with us. If you could contact us via any channels so we could further resolve the issue at hand.",
				],
				2 => [
					"We would like the opportunity to investigate your feedback further. Please could you contact us? We’ll work with you to resolve any issues as quickly as possible.",
					"We are sorry to know that you've had a not nice experience. We would love to know why, so that we can deliver a better experience next time. You may reach us anytime. Again, thank you for your feedback!",
					"I’m very sorry we failed to meet your expectations. I would appreciate another chance to earn your business. Please call me or ask for me next time you’re with us.",
					"Thank you for your review. I’m sorry to hear you had a frustrating experience, but I really appreciate you bringing this issue to my attention.",
					"Thank you for bringing this to our attention. We’re sorry you had a bad experience. We’ll strive to do better.",
					"Thank you for letting us know about this. Your feedback helps us do better. We are looking into this issue and hope to resolve it promptly and accurately",
					"We apologize that our service did not satisfy your expectations.",
					"We’re so sorry that your experience did not match your expectations.",
					"We set a high standard for ourselves, and we’re so sorry to hear this was not met in your interaction with our business.",
					"We always aim to deliver a great experience, and we are gutted when we don’t meet expectations. Thanks for taking the time to bring this to our attention. We will use the feedback to make us better and to ensure this doesn’t happen again",
					"Thank you for posting a review and we’re sorry to hear that your experience was not up to standards. We would like the opportunity to talk and investigate your feedback further",
				],
				3 => [
					"Glad you enjoyed our service and had a nice experience with us! Yes our prices are slightly higher than other ordinary shops, but it would definitely be worth it! Don't worry about the quality, you can contact us anytime if you feel unsatisfied with it, our Customer Success team will be responding instantly!",
					"Thanks for your review. We would love to hear more about your experience, so that we can use your valuable feedback to deliver an even better experience next time.",
					"Your business means a lot to us, so if you ever have additional feedback, please don’t hesitate to reach out to us via any channels.",
					"Thank you so much for the honesty! I am sorry that we were just average, I would love to know more about how we can change that in your eyes. I will send you a direct message so we can talk more about what happened.",
					"Thank you for taking the time to leave us your feedback. We are delighted to hear that you value the efforts we have put toward creating an environment where everyone can thrive.",
					"Thank you for writing a review. We appreciate the feedback. And yes, we wholeheartedly agree.",
				],
				4 => [
					"We are grateful that you took the time out to leave us a review. Your feedback helps us to improve service for everyone.",
					"We appreciate your review, we'll do our best to get better in the future!",
					"Thank you for your honest and instructive feedback.",
					"We appreciate your suggestion.",
					"Can you share with us what part of our plugin you're not satisfied with? We'll fix it shortly!",
					"We value your decision to shop with us and leave an instructive review!",
				],
				5 => [
					"Thank you so much for your 5-star review! We will share this with the store team to let them know to keep up the amazing work.",
					"Thank you so much for taking the time to leave us a 5-star rating - it's much appreciated!",
					"We appreciate you taking the time to share your satisfaction and highest rating with us.",
					"Thank you for your kind review! It's a big encouragement to us!",
					"We're glad you are satisfied with our item! Will do our best to keep improving it in the future.",
					"Thank you for your kind recognition, customer's satisfaction is always our goal.",
					"We love your feedback! Thank you for choosing our product!",
					"Your kind words just made our days! Thank you so much!",
				],
			]
		],

		'cmt_frontend' => array(
			"Good quality.",
			"The product is firmly packed.",
			"Good service.",
			"Very well worth the money.",
			"Very fast delivery.",
		),

		'rating'                  => '5-5',
		'auto_rating'             => 0,
		'auto_fill_review'        => 'Good quality.',
		'first_comment'           => 'Good quality.',
		'canned_style_desktop'    => 'select',
		'canned_style_mobile'     => 'slide',
		'canned_text_color'       => '#000000',
		'canned_bg_color'         => '#dddddd',
		'canned_text_hover_color' => '#ffffff',
		'canned_hover_color'      => '#ff0000',
		'purchased_label_icon'    => 'e900',
		'purchased_icon_color'    => '#000000',
		'purchased_text_color'    => '#000000',
		'purchased_bg_color'      => '#eeeeee',
		'custom_css'              => array(),
	);

	public function get_star_option() {
		return array(
			'5-5' => '5 star',
			'4-4' => '4 star',
			'3-3' => '3 star',
			'2-2' => '2 star',
			'1-1' => '1 star',
			'1-5' => 'Random 1-5 star',
			'2-5' => 'Random 2-5 star',
			'3-5' => 'Random 3-5 star',
			'4-5' => 'Random 4-5 star',
		);
	}

	public static function get_icons() {
		return array(
			''     => 'wvr-icon-no-icon',
			'e900' => 'wvr-icon-shopping-bag',
			'e902' => 'wvr-icon-cart-arrow-down',
			'e93f' => 'wvr-icon-credit-card',
			'e903' => 'wvr-icon-currency-dollar',
			'e904' => 'wvr-icon-location-shopping',
		);
	}

	public function get_params() {
		$option        = get_option( WVR_OPTION, true );
		$data          = apply_filters( 'wvr_default_data', $this->default_data );
		$this->options = wp_parse_args( $option, $data );

		return $this->options;
	}

	public function get_param( $option ) {
		return $this->options[ $option ] ?? '';
	}
}
