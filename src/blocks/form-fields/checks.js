
const { select } = wp.data;

import forEach from 'lodash/foreach';
import every from 'lodash/every';

function getFieldBlocks() {

	let ret = [];

	const checkBlock = ( block ) => {

		if ( block.innerBlocks.length ) {
			return checkBlocks( block.innerBlocks );
		}

		if ( -1 === block.name.indexOf( 'llms/form-field' ) ) {
			return false;
		}

		return block;

	};

	const checkBlocks = ( blocks ) => {
		forEach( blocks, ( block ) => {
			if ( checkBlock( block ) ) {
				ret.push( block );
			}
		} );
	};

	checkBlocks( select( 'core/block-editor' ).getBlocks() );

	return ret;

};

export const isUnique = ( field, str ) => {

	return every( getFieldBlocks(), ( block ) => {
		return block.attributes[ field ] !== str;
	} );

};
