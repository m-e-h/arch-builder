(function($) {

	// we create a copy of the WP inline edit post function
	var $wp_inline_edit = inlineEditPost.edit;

	// and then we overwrite the function with our own code
	inlineEditPost.edit = function(id) {

		// "call" the original WP edit function
		// we don't want to leave WordPress hanging
		$wp_inline_edit.apply(this, arguments);

		// now we take care of our business

		// get the post ID
		var $post_id = 0;
		if (typeof(id) == 'object')
			$post_id = parseInt(this.getId(id));

		if ($post_id > 0) {

			// define the edit row
			var $edit_row = $('#edit-' + $post_id);

			// get the meta
			var $arch_component = $('tr#post-' + $post_id + '>td.arch_component').text();
			var $arch_title = $('tr#post-' + $post_id + '>td.arch_title').text();
			var $arch_excerpt = $('tr#post-' + $post_id + '>td.arch_excerpt').text();
			var $arch_width = $('tr#post-' + $post_id + '>td.arch_width').text();
			var $arch_height = $('tr#post-' + $post_id + '>td.arch_height').text();

			// set the meta
			$edit_row.find('select[name="arch_component"]').val($arch_component);
			$edit_row.find('select[name="arch_title"]').val($arch_title);
			$edit_row.find('select[name="arch_excerpt"]').val($arch_excerpt);
			$edit_row.find('select[name="arch_width"]').val($arch_width);
			$edit_row.find('input[name="arch_height"][value="' + $arch_height + '"]' ).prop( 'checked', true );

				var selectedComponent = $edit_row.find('select[name="arch_component"]').val();
				var archExcerpt = $edit_row.find('.inline-edit-excerpt');

				archExcerpt.show();

				if( selectedComponent  === 'slides' ) {
					archExcerpt.hide();
				} else if ( selectedComponent  === 'tabs' ){
					archExcerpt.hide();
				} else if ( selectedComponent  === 'accordion' ){
					archExcerpt.hide();
				} else {
					archExcerpt.show();
				}

				$edit_row.find('select[name="arch_component"]').on('change', function() {
					var selectedComponent = $edit_row.find('select[name="arch_component"]').val();

					if( selectedComponent  === 'slides' ) {
						archExcerpt.hide();
					} else if ( selectedComponent  === 'tabs' ){
						archExcerpt.hide();
					} else if ( selectedComponent  === 'accordion' ){
						archExcerpt.hide();
					} else {
						archExcerpt.show();
					}

				});
		}

	};

	$('#bulk_edit').live('click', function() {

		// define the bulk edit row
		var $bulk_row = $('#bulk-edit');

		// get the selected post ids that are being edited
		var $post_ids = new Array();
		$bulk_row.find('#bulk-titles').children().each(function() {
			$post_ids.push($(this).attr('id').replace(/^(ttle)/i, ''));
		});

		// get the custom fields
		var $arch_component = $bulk_row.find('select[name="arch_component"]').val();
		var $arch_title = $bulk_row.find('select[name="arch_title"]').val();
		var $arch_excerpt = $bulk_row.find('select[name="arch_excerpt"]').val();
		var $arch_width = $bulk_row.find('select[name="arch_width"]').val();
		var $arch_height = $bulk_row.find('input[name="arch_height"]').val();

		// save the data
		$.ajax({
			url: ajaxurl, // this is a variable that WordPress has already defined for us
			type: 'POST',
			async: false,
			cache: false,
			data: {
				action: 'arch_save_bulk_edit',
				arch_component: $arch_component,
				arch_title: $arch_title,
				arch_excerpt: $arch_excerpt,
				arch_width: $arch_width,
				arch_height: $arch_height
			}
		});

	});

})(jQuery);
