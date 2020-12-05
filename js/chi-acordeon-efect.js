(function($) {

	var list = $('.chi-dl-container');
	var btn = $('.btn-toogle-class');
	var ddLinst = $('.btn-toogle-class').next('dl').find('.chi-dd');
	var arrowSiblings = $(".chi-dt").find("i");

	// skryjeme elementy
	$i = $(".chi-dt").find("i");
	$i.first().removeClass("chi-down").addClass("chi-up");

	list.find('.chi-dd').slideUp();
	ddLinst.first('.chi-dd').slideDown();

	// zobrazime dd po kliknuti na term
	list.find('.chi-dt').on('click', function(event)
	{
		$(this).next().slideToggle()
			.siblings('.chi-dd').slideUp();

		btn.find('i').removeClass("chi-up");
		btn.find('i').addClass("chi-down");

		var arrow = $(this).find('i');


		if(arrow.hasClass("chi-up")) {

			arrowSiblings.removeClass("chi-up");
			arrowSiblings.addClass("chi-down");

			arrow.removeClass("chi-up");
			arrow.addClass("chi-down");
		}
		else{

			arrowSiblings.removeClass("chi-up");
			arrowSiblings.addClass("chi-down");

			arrow.removeClass("chi-down");
			arrow.addClass("chi-up");
		}

		event.preventDefault();
	});

	btn.on('click', function(event) {

		var up = 0;
		var down = 0;

		$(".chi-dd").each(function( index ) {
			if ($(this).css("display") == "block") {
				down++;
			}
			else {
				up++;
			}
		});

		if (up >= down) {
			ddLinst.slideDown();
			btn.find('i').removeClass("chi-down");
			btn.find('i').addClass("chi-up");

			arrowSiblings.removeClass("chi-down");
			arrowSiblings.addClass("chi-up");
		}
		else {
			ddLinst.slideUp();
			btn.find('i').removeClass("chi-up");
			btn.find('i').addClass("chi-down");

			arrowSiblings.removeClass("chi-up");
			arrowSiblings.addClass("chi-down");
		}

		event.preventDefault();
	});


})(jQuery);
