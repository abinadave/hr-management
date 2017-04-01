jQuery(document).ready(function($) {
	$('.img-responsive').click(function(event) {
		$modal = $('#myModal');
		$modal.modal('show');
		let src = $(this).attr('src');
		$modal.find('img').attr('src', src);
		let str = src.split('/').pop();
		let filename = str.split('.')[0];
		$modal.find('#title-img').text(filename.toUpperCase());
	});
});