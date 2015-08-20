<?php

/**
 * Counter content element for the Visual Composer editor,
 * that can only be used in the Number Counter container
 */

if ( ! class_exists( 'PT_VC_Counter' ) ) {
	class PT_VC_Counter extends PT_VC_Shortcode {

		// Basic shortcode settings
		function shortcode_name() { return 'pt_vc_counter'; }

		// Initialize the shortcode by calling the parent constructor
		public function __construct() {
			parent::__construct();
		}

		// Overwrite the register_shortcode function from the parent class
		public function register_shortcode( $atts, $content = null ) {
			$atts = shortcode_atts( array(
				'title'  => __( 'Test Title', 'cargopress-pt' ),
				'number' => '299',
				'icon'   => 'fa fa-home',
				), $atts );

			$atts['number'] = absint( $atts['number'] );

			// The PHP_EOL is added so that it can be used as a separator between multiple counters
			return PHP_EOL . json_encode( $atts );
		}

		// Overwrite the vc_map_shortcode function from the parent class
		public function vc_map_shortcode() {
			vc_map( array(
				'name'     => __( 'Counter', 'cargopress-pt' ),
				'base'     => $this->shortcode_name(),
				'category' => __( 'Content', 'cargopress-pt' ),
				'icon'     => get_template_directory_uri() . '/vendor/proteusthemes/visual-composer-elements/assets/images/pt.svg',
				'as_child' => array( 'only' => 'pt_vc_container_number_counter' ),
				'params'   => array(
					array(
						'type'        => 'textfield',
						'heading'     => __( 'Title', 'cargopress-pt' ),
						'param_name'  => 'title',
					),
					array(
						'type'        => 'textfield',
						'heading'     => __( 'Number', 'cargopress-pt' ),
						'description' => __( 'Input a positive number.', 'cargopress-pt' ),
						'param_name'  => 'number',
						'min'         => '1',
					),
					array(
						'type'        => 'iconpicker',
						'heading'     => __( 'Icon', 'cargopress-pt' ),
						'param_name'  => 'icon',
						'value'       => 'fa fa-home',
						'description' => __( 'Select icon from library.', 'cargopress-pt' ),
						'settings'    => array(
							'emptyIcon'    => false, // default true, display an "EMPTY" icon?
							'iconsPerPage' => 100, // default 100, how many icons per/page to display
						),
					),
				)
			) );
		}
	}

	// Initialize the class
	new PT_VC_Counter;
}