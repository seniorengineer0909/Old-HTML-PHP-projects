
$(document).ready(function() {
	$(".button-collapse").sideNav();
});

 $(document).ready(function(){
    $('.modal-trigger').leanModal();
 });

$(document).ready(function(){
	$('.slider').slider({full_width: true});
});

$(document).ready(function() {
	$(".footercopyright").html("&copy;  2013 - " + new Date().getFullYear());
});

$(document).ready(function() {
	$('select').material_select();
});

function thanksmsg() {
	Materialize.toast('Thank you for your recommendation!', 5000, 'rounded');
}
function thanksmsgfeedback() {
	Materialize.toast('Thank you for your feedback!', 5000, 'rounded');
}