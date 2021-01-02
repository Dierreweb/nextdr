jQuery(document).ready(function() {

	/*	-----------------------------------------------------------------------------------------------
		Helper functions
	--------------------------------------------------------------------------------------------------- */

	/* Output AJAX errors -------------------------------- */

	function ajaxErrors(jqXHR, exception) {
		var message = '';
		if (jqXHR.status === 0) {
			message = 'Not connect.n Verify Network.';
		} else if(jqXHR.status == 404) {
			message = 'Requested page not found. [404]';
		} else if(jqXHR.status == 500) {
			message = 'Internal Server Error [500].';
		} else if(exception === 'parsererror') {
			message = 'Requested JSON parse failed.';
		} else if(exception === 'timeout') {
			message = 'Time out error.';
		} else if(exception === 'abort') {
			message = 'Ajax request aborted.';
		} else {
			message = 'Uncaught Error.n' + jqXHR.responseText;
		}
		console.log('AJAX ERROR:' + message);
	}

	/*	-----------------------------------------------------------------------------------------------
		Multiple Checkboxes
		Add the values of the checked checkboxes to the hidden input
	--------------------------------------------------------------------------------------------------- */

	jQuery('.customize-control-checkbox-multiple input[type="checkbox"]').on('change', function() {

		// Get the values of all of the checkboxes into a comma seperated variable
		checkbox_values = jQuery(this).parents('.customize-control').find('input[type="checkbox"]:checked').map(function() {
			return this.value;
		}).get().join(',');

		// If there are no values, make that explicit in the variable so we know whether the default output is needed
		if(!checkbox_values) {
			checkbox_values = 'empty';
		}

		// Update the hidden input with the variable
		jQuery(this).parents('.customize-control').find('input[type="hidden"]').val(checkbox_values).trigger('change');

	});

	jQuery(document).ready(function($){
		$('textarea[name="footer_content"]').attr('data-customize-setting-link', 'footer_content');

		setTimeout(function() {

			var editor2 = tinyMCE.get('footer_content');

			if(editor2) {
				editor2.onChange.add(function (ed, e) {
					// Update HTML view textarea (that is the one used to send the data to server).
					ed.save();
					$('textarea[name="footer_content"]').trigger('change');});
				}
			}, 1000);
	});

})(jQuery);
