/**
 * BLOCK: llms/form-field-user-last-name
 *
 * @since 1.6.0
 * @version 1.6.0
 */

// WP Deps.
const { __ } = wp.i18n;

// External Deps.
import cloneDeep from 'lodash/clonedeep';

// Internal Deps.
import { settings as firstNameSettings } from './user-first-name';

/**
 * Block Name
 *
 * @type {String}
 */
const name = 'llms/form-field-user-last-name';

/**
 * Array of supported post types.
 *
 * @type {Array}
 */
const post_types = [ 'llms_form' ];

/**
 * Is this a default or composed field?
 *
 * Composed fields serve specific functions (like the User Email Address field)
 * and are automatically added to the form builder UI.
 *
 * Default (non-composed) fields can be added by developers to perform custom functions
 * and are not registered as a block by default
 *
 * @type {String}
 */
const composed = true;

// Setup the field settings.
let settings = cloneDeep( firstNameSettings );

settings.title       = __( 'User Last Name', 'lifterlms' );
settings.description = __( 'A special field used to collect a user\'s last name.', 'lifterlms' );

settings.attributes.id.__default       = 'last_name';
settings.attributes.label.__default    = __( 'Last Name', 'lifterlms' );
settings.attributes.name.__default     = 'last_name';
settings.attributes.required.__default = true;


export {
	name,
	post_types,
	composed,
	settings,
};
