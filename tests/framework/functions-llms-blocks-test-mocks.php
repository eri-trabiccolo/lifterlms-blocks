<?php
/**
 * LifterLMS Blocks Testing mock functions & classes
 *
 * @package LifterLMS_Blocks/Tests/Framework
 * @since   [version]
 * @version [version]
 */

/**
 * Toggle to a bool to determine if BB is enabled for a post.
 * @since   [version]
 */
global $llms_blocks_mock_fl_builder_enabled;
$llms_blocks_mock_fl_builder_enabled = null;
if ( ! class_exists( 'FLBuilderModel' ) ) {

	/**
	 * Mock the FLBuilderModel Class
	 * @since   [version]
	 * @version [version]
	 */
	class FLBuilderModel {

		/**
		 * Determine if BB is enabled for a given post.
		 * @param   int    $post_id WP_Post ID.
		 * @return  bool
		 * @since   [version]
		 * @version [version]
		 */
		public static function is_builder_enabled( $post_id ) {

			global $llms_blocks_mock_fl_builder_enabled;
			return ( $llms_blocks_mock_fl_builder_enabled );

		}

	}

}

/**
 * Add key=>val pairs to the global to manage options retrieved by et_get_option()
 * @since   [version]
 */
global $llms_blocks_mock_et_options;
$llms_blocks_mock_et_options = array();

if ( ! function_exists( 'et_get_option' ) ) {

	/**
	 * Mock the Divi et_get_option() method
	 * @param   string    $option_name option key.
	 * @param   string    $default     default value when option not set.
	 * @return  mixed
	 * @since   [version]
	 * @version [version]
	 */
	function et_get_option( $option_name, $default = '' ) {

		global $llms_blocks_mock_et_options;
		if ( $llms_blocks_mock_et_options && isset( $llms_blocks_mock_et_options[ $option_name ] ) ) {
			return $llms_blocks_mock_et_options[ $option_name ];
		}
		return $default;

	}

}
