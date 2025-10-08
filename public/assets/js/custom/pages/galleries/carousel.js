$(function () {
	var $lis = $('ul.list-gallery').find('li'),
		length = $lis.length;

	$lis.each(function (index, item) {
		$(item).attr('data-id', index);
	});


	function slider($lis, index, length) {
		$lis.each(function (index, item) {
			console.log(item);
			item.className = '';
			// item.removeClass('left1-gallery, left2-gallery');
		});
		index += length;
		$($lis[index % length]).addClass('active-gallery');
		$($lis[(index - 1) % length]).addClass('left1-gallery');
		$($lis[(index - 2) % length]).addClass('left2-gallery');
		$($lis[(index + 1) % length]).addClass('right1-gallery');
		$($lis[(index + 2) % length]).addClass('right2-gallery');
	}


	slider($lis, 2, length);

	$lis.on('click', function (e) {
		var id = parseInt($(e.target).parents('li').attr('data-id'));
		slider($lis, id, length);
	})

});