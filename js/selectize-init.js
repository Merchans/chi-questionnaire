jQuery(document).ready(function () {
	jQuery('select#doctor_id, select#question_id\n').selectize({
		sortField: 'text'
	});

	var elements = document.getElementsByClassName("copyIdButton");

	var myFunction = function(e) {
		e.preventDefault();
		var attribute = this.getAttribute("data-myattribute");
		alert(attribute);
	};

	for (var i = 0; i < elements.length; i++) {
		elements[i].addEventListener('click', copyToClipboard, false);
	}

	function copyToClipboard(elem) {
		elem.preventDefault();

		var id =  jQuery(this).prev();
		console.log(id);
		// create hidden text element, if it doesn't already exist
		var $temp = $("<input>");
		$("body").append($temp);
		$temp.val($(id).text()).select();
		document.execCommand("copy");
		$temp.remove();
	}
});

