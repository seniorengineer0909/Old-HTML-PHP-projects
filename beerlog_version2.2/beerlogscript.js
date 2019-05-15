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

$(document).ready(function() {
	$(".footercopyright").html("<p>&copy;  " + new Date().getFullYear() + " OurBeerLog.com Some rights reserved.</p>");
});

function pleaseLogin() {
	document.getElementById("pleaselogin").style.display = "block";
}

