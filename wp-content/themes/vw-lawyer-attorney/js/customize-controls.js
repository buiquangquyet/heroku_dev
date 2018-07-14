( function( api ) {

	// Extends our custom "vw-lawyer-attorney" section.
	api.sectionConstructor['vw-lawyer-attorney'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );