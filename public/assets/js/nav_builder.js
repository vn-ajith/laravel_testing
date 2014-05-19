$(document).ready(function(){
	$("#save_nav").hide();	
	var navigation = {};
	var item_num = 0;
	var menu_id = 1;
	
	navigation["nav_details"] = {};
	document.title = "Navigation builder";
	$("#add_menu").click(function(){
		
		$('#nav_title').val("");
		$('#nav_url').val("");
		$('#myModal_add_menu').modal('toggle');
		$("#save_nav").show();

	});
	$("#add_new_menu").click(function(){
		var nav_title = $('#nav_title').val();
		var nav_url = $('#nav_url').val();
		var str="<div class='box' id='"+menu_id+"' ><span class='box_test'>"+nav_title+"</span>";
		str = str + "<div class='edit'><img class='task' src='assets/images/edit.png' id ='"+nav_title+"_settings' >";
		str = str + "<img class='task' src='assets/images/add_new.png' id= '"+menu_id+"_add_new'>";
		str = str + "<img class='task' src='assets/images/delete.png' id ='"+menu_id+"_delete'></div><p></p></div>";
		navigation["nav_details"][menu_id] = {};
		navigation["nav_details"][menu_id]["id"] = menu_id;
		navigation["nav_details"][menu_id]["title"] = nav_title;
		navigation["nav_details"][menu_id]["url"] = nav_url;
		navigation["nav_details"][menu_id]["parent"] = 0;
		menu_id++;
		$("#menu_holder").append(str);
		$('#myModal_add_menu').modal('toggle');
		item_num ++;
		console.log(navigation);
	});


	$("body").on("click","img[id$='_delete']",function(){
		var id = this.id;
		var n = id.search("_delete");
		var name = id.substring(0,n);
		$('#'+name).remove();

	});
	$("body").on("click","img[id$='_settings']",function(){
		var id = this.id;
		var n = id.search("_settings");
		var name = id.substring(0,n);
		
		$("#myModalLabel_2").html("Edit menu");
		$('#nav_sub_title').val(navigation["nav_details"][name]["title"]);
		$('#nav_sub_url').val(navigation["nav_details"][name]["url"]);
		$('#myModal_add_sub_menu').modal('toggle');
		
		

	});
	$("body").on("click","img[id$='_add_new']",function(){
		var id = this.id;
		var n = id.search("_add_new");
		var name = id.substring(0,n);
		$("#myModalLabel_2").html("Add a sub menu");
		$('#menu').val(name);
		$('#nav_sub_title').val("");
		$('#nav_sub_url').val("");
		$('#myModal_add_sub_menu').modal('toggle');
		
		
	});
	$("#add_new_sub_menu").click(function(){

		var menu = parseInt($('#menu').val());
		
		
		var nav_title = $('#nav_sub_title').val();
		var nav_url = $('#nav_sub_url').val();
		
		var str = "<div class='box' id='"+menu_id+"' >";
		str = str +"<span class='box_test'>"+nav_title+ "</span><div class='edit'><img class='task' src='assets/images/edit.png' id ='"+menu_id+"_settings' >";
		str = str + "<img class='task' src='assets/images/add_new.png' id= '"+menu_id+"_add_new'>";
		
		str = str + "<img class='task' src='assets/images/delete.png' id ='"+menu_id+"_delete'></div><p></p></div>";
		
		
		$("#"+menu).append(str);
		navigation["nav_details"][menu_id] = {};
		navigation["nav_details"][menu_id]["id"] = menu_id;
		navigation["nav_details"][menu_id]["title"] = nav_title;
		navigation["nav_details"][menu_id]["url"] = nav_url;
		
		navigation["nav_details"][menu_id]["parent"] = menu;
		menu_id++;
		
		console.log(navigation);
		$('#myModal_add_sub_menu').modal('toggle');

	});
	$("#save_nav").click(function(){
		var list_name = $("#list_name").val();
		$.ajax({
				method: "POST",
				url: "/laravel_testing/blog/public/save_list",
				data:{"list_name":list_name,"list_details":navigation}
			}).done(function(d){
				alert(d);

			});

		});




});