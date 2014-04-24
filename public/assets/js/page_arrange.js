$(document).ready(function(){
// 	$( "#sortable" ).sortable({
//       		revert: true
//     	});
	  $("input[id^='save_form_data']").attr("disabled", "disabled");
	$("div[id^='main_']").sortable({
	});
	$("div[id^='left_']").sortable({
	});
	$("div[id^='right_']").sortable({
	});
	$("#left").sortable({
	});
	$( "#left" ).disableSelection();
});