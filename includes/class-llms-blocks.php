<?php
/**
 * Serverside block compononent registration
 *
 * @package  LifterLMS_Blocks/Classes
 * @since    [version]
 * @version  [version]
 */

defined( 'ABSPATH' ) || exit;

/**
 * LLMS_Blocks class
 */
class LLMS_Blocks {

	/**
	 * Constructor.
	 *
	 * @since    [version]
	 * @version  [version]
	 */
	public function __construct() {

		add_action( 'plugins_loaded', array( $this, 'init' ) );

		// Quick and dirty for webinar preview.
		add_action( 'wp', function() {

			if ( has_block( 'llms/course-continue-button' ) || has_block( 'llms/course-progress' ) ) {
				remove_action( 'lifterlms_single_course_after_summary', 'lifterlms_template_single_course_progress', 60 );
			}

		} );

		add_action( 'add_meta_boxes', array( $this, 'remove_metaboxes' ), 999 );

		add_filter( 'block_categories', array( $this, 'add_block_category' ) );

	}

	/**
	 * Add a custom LifterLMS block category
	 *
	 * @param   array    $categories existing block cats.
	 * @return  array
	 * @since   [version]
	 * @version [version]
	 */
	public function add_block_category( $categories ) {
		$categories[] = array(
			'slug'  => 'llms-blocks',
			'title' => sprintf(
				// Translators: %1$s = LifterLMS.
				__( '%1$s Blocks', 'lifterlms' ),
				'LifterLMS'
			),
		);
		return $categories;
	}

	/**
	 * Register all blocks & components.
	 *
	 * @return  void
	 * @since   [version]
	 * @version [version]
	 */
	public function init() {

		require_once LLMS_BLOCKS_PLUGIN_DIR . '/includes/class-llms-blocks-assets.php';
		require_once LLMS_BLOCKS_PLUGIN_DIR . '/includes/class-llms-blocks-abstract-block.php';
		require_once LLMS_BLOCKS_PLUGIN_DIR . '/includes/class-llms-blocks-migrate.php';
		require_once LLMS_BLOCKS_PLUGIN_DIR . '/includes/class-llms-blocks-post-instructors.php';
		require_once LLMS_BLOCKS_PLUGIN_DIR . '/includes/class-llms-blocks-post-types.php';

		// Visibility Component.
		require_once LLMS_BLOCKS_PLUGIN_DIR . '/includes/class-llms-blocks-visibility.php';

		// Dynamic Blocks.
		require_once LLMS_BLOCKS_PLUGIN_DIR . '/includes/blocks/class-llms-blocks-course-information-block.php';
		require_once LLMS_BLOCKS_PLUGIN_DIR . '/includes/blocks/class-llms-blocks-course-syllabus-block.php';
		require_once LLMS_BLOCKS_PLUGIN_DIR . '/includes/blocks/class-llms-blocks-instructors-block.php';
		require_once LLMS_BLOCKS_PLUGIN_DIR . '/includes/blocks/class-llms-blocks-pricing-table-block.php';

	}

	/**
	 * Remove deprecated core metaboxes.
	 *
	 * @return  void
	 * @since   [version]
	 * @version [version]
	 */
	public function remove_metaboxes() {

		remove_meta_box( 'llms-instructors', 'course', 'normal' );
		remove_meta_box( 'llms-instructors', 'llms_membership', 'normal' );

	}

}

return new LLMS_Blocks();