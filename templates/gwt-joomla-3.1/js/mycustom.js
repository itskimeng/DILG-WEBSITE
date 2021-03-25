jQuery(function($) {
	$(document).ready(function(){
		$(document).on('change', '#lgu', function(){
			let link = $(this).val();
			let iframe = $('#blockrandom-143');

			if ($(this).hasClass('lgu_cavite')) {
				iframe = $('#blockrandom-146');
			}

			if ($(this).hasClass('lgu_laguna')) {
				iframe = $('#blockrandom-147');
			}

			if ($(this).hasClass('lgu_quezon')) {
				iframe = $('#blockrandom-149');
			}

			if ($(this).hasClass('lgu_rizal')) {
				iframe = $('#blockrandom-151');
			}

			if ($(this).hasClass('lgu_lucena')) {
				iframe = $('#blockrandom-153');
			}

          	if (link != "") {
				iframe.attr('src', '');
				iframe.attr('src', link);
          	}
		});
	});
});