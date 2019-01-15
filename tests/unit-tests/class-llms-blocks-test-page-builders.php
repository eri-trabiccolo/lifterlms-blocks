<?php
/**
 * Test LLMS_Blocks_Page_Builders class & methods.
 *
 * @package LifterLMS_Blocks/Tests
 * @since   1.2.0
 * @version [version]
 */
class LLMS_Blocks_Test_Page_Builders extends LLMS_Blocks_Unit_Test_Case {

	/**
	 * Test whether or not filters are properly added based on the presence of the page builder.
	 *
	 * @runInSeparateProcess
	 * @return  void
	 * @since   1.2.0
	 * @version [version]
	 */
	public function test_add_filters() {

		// Check for Divi.
		LLMS_Blocks_Page_Builders::add_filters();
		$this->assertFalse( has_filter( 'llms_blocks_is_post_migrated', array( 'LLMS_Blocks_Page_Builders', 'check_for_divi' ) ) );

		define( 'ET_BUILDER_VERSION', 1 );
		LLMS_Blocks_Page_Builders::add_filters();
		$this->assertEquals( 15, has_filter( 'llms_blocks_is_post_migrated', array( 'LLMS_Blocks_Page_Builders', 'check_for_divi' ) ) );

		// Check for Elementor.
		LLMS_Blocks_Page_Builders::add_filters();
		$this->assertFalse( has_filter( 'llms_blocks_is_post_migrated', array( 'LLMS_Blocks_Page_Builders', 'check_for_elementor' ) ) );

		define( 'ELEMENTOR_VERSION', 1 );
		LLMS_Blocks_Page_Builders::add_filters();
		$this->assertEquals( 15, has_filter( 'llms_blocks_is_post_migrated', array( 'LLMS_Blocks_Page_Builders', 'check_for_elementor' ) ) );

		// Check for BB.
		LLMS_Blocks_Page_Builders::add_filters();
		$this->assertFalse( has_filter( 'llms_blocks_is_post_migrated', array( 'LLMS_Blocks_Page_Builders', 'check_for_beaver' ) ) );

		define( 'FL_BUILDER_VERSION', 1 );
		LLMS_Blocks_Page_Builders::add_filters();
		$this->assertEquals( 15, has_filter( 'llms_blocks_is_post_migrated', array( 'LLMS_Blocks_Page_Builders', 'check_for_beaver' ) ) );

	}

	/**
	 * Check the status of a the Divi page builder.
	 *
	 * @return  void
	 * @since   1.2.0
	 * @version 1.2.0
	 */
	public function test_check_for_divi() {

		$course_id = $this->factory->course->create();

		// No value set, pb off, add actions.
		$this->assertTrue( LLMS_Blocks_Page_Builders::check_for_divi( true, $course_id ) );

		// PB is explicitly off.
		update_post_meta( $course_id, '_et_pb_use_builder', 'off' );
		$this->assertTrue( LLMS_Blocks_Page_Builders::check_for_divi( true, $course_id ) );

		// PB has non-standard values (assume off).
		update_post_meta( $course_id, '_et_pb_use_builder', 'fake' );
		$this->assertTrue( LLMS_Blocks_Page_Builders::check_for_divi( true, $course_id ) );
		update_post_meta( $course_id, '_et_pb_use_builder', 'yes' );
		$this->assertTrue( LLMS_Blocks_Page_Builders::check_for_divi( true, $course_id ) );
		update_post_meta( $course_id, '_et_pb_use_builder', 'no' );
		$this->assertTrue( LLMS_Blocks_Page_Builders::check_for_divi( true, $course_id ) );

		// PB is explicitly on, remove the actions.
		update_post_meta( $course_id, '_et_pb_use_builder', 'on' );
		$this->assertFalse( LLMS_Blocks_Page_Builders::check_for_divi( true, $course_id ) );

	}

	/**
	 * Check the status of a the Elementor page builder.
	 *
	 * @return  void
	 * @since   [version]
	 * @version [version]
	 */
	public function test_check_for_elementor() {

		$course_id = $this->factory->course->create();

		// No value set, pb explicitly off, add actions.
		$this->assertTrue( LLMS_Blocks_Page_Builders::check_for_elementor( true, $course_id ) );

		// PB has non-standard values (assume off).
		update_post_meta( $course_id, '_elementor_edit_mode', 'fake' );
		$this->assertTrue( LLMS_Blocks_Page_Builders::check_for_elementor( true, $course_id ) );
		update_post_meta( $course_id, '_elementor_edit_mode', 'yes' );
		$this->assertTrue( LLMS_Blocks_Page_Builders::check_for_elementor( true, $course_id ) );
		update_post_meta( $course_id, '_elementor_edit_mode', 'no' );
		$this->assertTrue( LLMS_Blocks_Page_Builders::check_for_elementor( true, $course_id ) );

		// PB is explicitly on, remove the actions.
		update_post_meta( $course_id, '_elementor_edit_mode', 'builder' );
		$this->assertFalse( LLMS_Blocks_Page_Builders::check_for_elementor( true, $course_id ) );

	}

}
