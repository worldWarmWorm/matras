$(function(){

	$('.main-slider__init').slick({
		autoplay: true,
		dots: true,
		useTransform: false,
		appendArrows: $('.main-slider__arrows'),
		appendDots: $('.main-slider__dots'),
	});

	$('.catalog-list li:not(.active)').children('ul').slideUp(0);
	$('.catalog-list li.active').addClass('spin-arrow');
	$('.catalog-list a').click(function () {
		var li = $(this).parent('li');
		var allLi = li.siblings();
		var ul = $(this).siblings('ul');
		var allUl = allLi.children('ul');
		if (ul.length) {
			allUl.not(ul).slideUp(400);
			allLi.removeClass('spin-arrow');
			li.toggleClass('spin-arrow');
			ul.slideToggle(400);
			return false;
		}
		return true;
	});

	$('.input-num_js .input-num__btn-minus').click(function(){
		var count = $(this).siblings('.input-num_js .input-num__input').val();
		if (count > 1) {
			count--;
			$(this).siblings('.input-num_js .input-num__input').val(count--);
		}
	});

	$('.input-num_js .input-num__btn-plus').click(function(){
		var count = $(this).siblings('.input-num_js .input-num__input').val();
		count++;
		$(this).siblings('.input-num_js .input-num__input').val(count);
	});


    var phone1Href = $('.header__phone').attr('href'); //-Тут телефон
    var phone1Cont = $('.header__phone').html();

    var email1Href = $('.header__top-right-info a').attr('href'); //- Тут email
    var email1Cont = $('.header__top-right-info a').html();

	if ($("#mmenu").length) {
		$("#mmenu").mmenu({
			extensions: ["position-front"],
             "navbars": [ {
		       "position": "bottom",
		       "content": [
                        "<a href=" + phone1Href + " class='phone-left'>" + phone1Cont + "</a>",
                        "<a href=" + email1Href + " class='email-left'>" + email1Cont + "</a>"
                           ]
                      }
             ]
	
		},{
			"language":"ru",
		});
	}
})