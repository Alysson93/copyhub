$(function() {


	function changeSlide() {

		setInterval(function(){
			$('.banner').eq(currentSlide).stop().fadeOut(2000);
			currentSlide ++;
			if (currentSlide > maxSlide) {
				currentSlide = 0;
			}
			$('.banner').eq(currentSlide).stop().fadeIn(2000);

			$('.bullets span').removeClass('ativa');
			$('.bullets span').eq(currentSlide).addClass('ativa');
		},delay*1000);

	}	

	function initSlide() {
		$('.banner').eq(1).hide();
		$('banner').eq(0).show();
		for (var i = 0; i < maxSlide+1; i++) {
			var content = $('.bullets').html();
			if (i == 0) {
				content += '<span class="ativa"></span>';
			} else {
				content += '<span></span>';
			}
			$('.bullets').html(content);
		}
	}

	$('body').on('click','.bullets span', function(){
		var currentBullet = $(this);
		$('.banner').eq(currentSlide).stop().fadeOut(1000);
		currentSlide = currentBullet.index();
		$('.banner').eq(currentSlide).stop().fadeIn(1000);
		$('.bullets span').removeClass('ativa');
		currentBullet.addClass('ativa');
	});


	var currentSlide = 0;

	var maxSlide = $('.banner').length - 1;

	var delay = 10;

	changeSlide();

	initSlide();

})