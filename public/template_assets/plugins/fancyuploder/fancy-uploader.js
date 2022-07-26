(function($) {
	//fancyfileuplod
	$('#demo').FancyFileUpload({
	params : {
		 action : 'fileuploader'
		},
		maxfilesize : 1000000
	});

	$('#fasilitas_gallery').FancyFileUpload({
	params : {
		 // action : 'fileuploader'
		},
		maxfilesize : 1000000
	});

})(jQuery);