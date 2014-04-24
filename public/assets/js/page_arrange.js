$(document).ready(function(){
// 	$( "#sortable" ).sortable({
//       		revert: true
//     	});
	$("div[id^='main_']").sortable({
	});
	$("div[id^='left_']").sortable({
	});
	$("div[id^='right_']").sortable({
	});
	$("#click").click(function(){
			$("li").each(function(){
				alert($(this).html());
			});
		});
// 	$( "ul, li" ).disableSelection();
});