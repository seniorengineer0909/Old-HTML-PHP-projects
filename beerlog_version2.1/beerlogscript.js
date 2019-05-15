$(document).ready(function () {
	$("[data-toggle = 'tooltip']").tooltip();
});

$(document).ready(function() {
	$("input").on({
		focus: function() {
			$(this).css("background-color", "#cccccc");
		},
		blur: function() {
			$(this).css("background-color", "#ffffff");
		}
	});
});

function pleaseLogin() {
	document.getElementById("pleaselogin").style.display = "block";
}

