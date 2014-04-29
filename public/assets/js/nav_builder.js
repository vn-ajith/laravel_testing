$(document).ready(function(){
	
	var navigation = {};
	var item_num = 0
	
	document.title = "Navigation builder";
	$("#add_menu").click(function(){
		$('#nav_title').val("");
		$('#nav_url').val("");
		$('#myModal_add_menu').modal('toggle');
			
	});
	$("#add_new_menu").click(function(){
		var nav_title = $('#nav_title').val();
		var nav_url = $('#nav_url').val();
		var str="<div class='box' id='"+nav_title+"' >"+nav_title;
		str = str +  "<div class='edit'><img src='assets/images/edit.png' id ='"+nav_title+"_settings' >";
		str = str + "<img src='assets/images/add_new.png' id= '"+nav_title+"_add_new'>";
		str = str + "<img src='assets/images/delete.png' id ='"+nav_title+"_delete'></div></div>";
		navigation[nav_title] = {};
		navigation[nav_title]["title"] = nav_title;
		navigation[nav_title]["url"] = nav_url;
		navigation[nav_title]["parent"] = "";
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
		$('#nav_sub_title').val(navigation[name]["title"]);
		$('#nav_sub_url').val(navigation[name]["url"]);
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
		
		var menu = $('#menu').val();
		
		
		var nav_title = $('#nav_sub_title').val();
		var nav_url = $('#nav_sub_url').val();
		
		var str =  "<div class='box' id='"+nav_title+"' ><div style='margin-left:10px;'></div>";
		str = str +nav_title+  "<div class='edit'><img src='assets/images/edit.png' id ='"+nav_title+"_settings' >";
		str = str + "<img src='assets/images/add_new.png' id= '"+nav_title+"_add_new'>";
		
		str = str + "<img src='assets/images/delete.png' id ='"+nav_title+"_delete'></div></div>";
		
		
		$("#"+menu).append(str);
		navigation[nav_title] = {};
		navigation[nav_title]["title"] = nav_title;
		navigation[nav_title]["url"] = nav_url;
		if(navigation[menu]["parent"] !="")
		{
			navigation[nav_title]["parent"] = navigation[menu]["parent"]+"_"+menu;		
		}
		else
		{
			navigation[nav_title]["parent"] = menu;
		}
		
		console.log(navigation);
		$('#myModal_add_sub_menu').modal('toggle');
		
	});
	
	
	
	
	
});