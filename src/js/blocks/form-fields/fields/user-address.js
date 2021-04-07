/**
 * BLOCK: llms/form-field-passwords
 *
 * @since 1.6.0
 * @since 1.12.0 Add transform support.
 * @since [version] Add reusable block support.
 */

// WP Deps.
import { createBlock, getBlockType } from '@wordpress/blocks';
import { select } from '@wordpress/data';
import { useBlockProps, InnerBlocks, InspectorControls } from '@wordpress/block-editor';
import { PanelBody } from '@wordpress/components';
import { Fragment } from '@wordpress/element';
import { __ } from '@wordpress/i18n';

// Internal Deps.
import {
	default as getDefaultSettings,
	getSettingsFromBase,
	getDefaultPostTypes,
} from '../settings';

import GroupLayoutControl from '../group-layout-control';

/**
 * Block Name
 *
 * @type {string}
 */
const name = 'llms/form-field-user-address';

/**
 * Array of supported post types.
 *
 * @type {Array}
 */
const postTypes = getDefaultPostTypes();

/**
 * Is this a default or composed field?
 *
 * Composed fields serve specific functions (like the User Email Address field)
 * and are automatically added to the form builder UI.
 *
 * Default (non-composed) fields can be added by developers to perform custom functions
 * and are not registered as a block by default.
 *
 * @type {string}
 */
const composed = false;

// Setup the field settings.
const settings = getSettingsFromBase( getDefaultSettings(), {
	title: __( 'User Address', 'lifterlms' ),
	description: __( "A group of fields used to collect a user's full address.", 'lifterlms' ),
	icon: {
		src: 'id-alt',
	},
	supports: {
		multiple: false,
	},
	edit: function( props ) {

		const blockProps = useBlockProps(),
			{ attributes, clientId, setAttributes } = props,
			block = select( 'core/block-editor' ).getBlock( clientId ),
			{ fieldLayout } = attributes,
			INNER_ORIENTATION = 'columns' === fieldLayout ? 'horizontal' : 'vertical',
			INNER_ALLOWED = [
				'llms/form-field-user-address-street',
				'llms/form-field-user-address-city',
				'llms/form-field-user-address-country',
				'llms/form-field-user-address-region',
			],
			INNER_TEMPLATE = [
				[ 'llms/form-field-user-address-street' ],
				[ 'llms/form-field-user-address-city' ],
				[ 'llms/form-field-user-address-country' ],
				[ 'llms/form-field-user-address-region' ],
			];


		return (
			<div { ...blockProps }>
				<InspectorControls>
					<PanelBody>
						<GroupLayoutControl { ...{ ...props, block } } />
					</PanelBody>
				</InspectorControls>

				<div className="llms-field-group llms-field--user-address" data-field-layout={ fieldLayout }>
					<InnerBlocks
						allowedBlocks={ INNER_ALLOWED }
						template={ INNER_TEMPLATE }
						templateLock="insert"
						orientation={ INNER_ORIENTATION }
					/>
				</div>
			</div>
		);
	},
	save: function() {

		const blockProps = useBlockProps.save();

		return (
			<div { ...blockProps }>
				<InnerBlocks.Content />
			</div>
		);

	}
} );

export { name, postTypes, composed, settings };
