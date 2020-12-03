jQuery(document).ready(function() {
	// code from: https://www.sitepoint.com/community/t/collapsible-bootstrap-panels-not-collapsing-after-another-panel-is-selected/225826/2
	jQuery(".panel-heading").click(function() {
		jQuery('.panel-heading').not(this).removeClass('isOpen');
		jQuery(this).toggleClass('isOpen');
		jQuery(this).next(".panel-collapse").addClass('thePanel');
		jQuery('.panel-collapse').not('.thePanel').slideUp(800);
		jQuery(".thePanel").slideToggle(800).removeClass('thePanel');
	});
	var $i = 0;
	jQuery(".btnImgClick").click(function(e) {
		e.preventDefault();
		$i++;
		jQuery('.panel-collapse').toggleClass('thePanel');
		/*if ($i % 2 != 0)
		{
			jQuery('.panel-collapse').addClass('thePanel');
		}
		else
		{
			jQuery('.panel-collapse').removeClass('thePanel');
		}*/
		jQuery('.panel-heading').removeClass('isOpen');
		jQuery('.panel-collapse').slideUp(800);
		jQuery(".thePanel").slideToggle(800);
	});
});

jQuery(document).ready(function($) {
	$( ".accordion" ).accordion({
		collapsible: true
	});
});