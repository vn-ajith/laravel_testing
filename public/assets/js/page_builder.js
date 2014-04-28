$(document).ready(function(){
	$('#save_page').hide();
	
	var page_settings={};
	page_settings["settings"] = {};
	page_settings["settings"]["form"]= {}
	page_settings["settings"]["form_data"] = {};
	page_settings["box_order"] = {}
 	$("input[id^='view_type']").click(function(){
		var str="";
		
		str = str + "<option value='main_content'>Main content</option>";
		if(this.value=="3_col_view"){
		
			str = str+"<option value='left_side_bar'>Left side bar</option>";
			str = str+"<option value='right_side_bar'>Right side bar</option>";
		}
		else if(this.value=="2_col_left_view"){
		
			str = str+"<option value='left_side_bar'>Left side bar</option>";
		}
		else{
		
			str = str+"<option value='right_side_bar'>Right side bar</option>";
		}
		
		$("select[id^='position_']").html(str);
		
			

	});
	
	$("body").on("click","#select_form_save",function(){
		var counter = 0;
		
		var value_radio = $( "input:radio[name='view_type']:checked" ).val();
		if(value_radio==undefined)
		{
			alert('First select template style');
			
		}
		
		page_settings["view_type"] = value_radio;
		
		
		$("input:checkbox[name='check']:checked").each(function()
		{
			var id = this.id;
			if(typeof page_settings["settings"]["form"][id] == "undefined")
			{
			page_settings["settings"]["form"][id] = {};
			}
    			page_settings["settings"]["form"][id]["form_id"] = id;
			page_settings["settings"]["form"][id]["form_name"] = $(this).val();
			page_settings["settings"]["form"][id]["position"] = $("#position_"+id).val(); 
			});
		
		
		
		
		
		$('#myModal').modal('toggle');
		
		
	});
		
	
	$("body").on("click","#select_form",function(){
		
		var id = $('#form_selector').children(":selected").attr("id");	
		var value_radio = $( "input:radio[name='view_type']:checked" ).val();

		
		$.ajax({
					url: "/laravel_testing/blog/public/generate_form_data_table",
					type:"POST",
					
					data:{"id":id,"radio":value_radio}
					})
					.done(function( d ){
						
						$('#form_data_display').html(d);
					});
		$('#select_form_data').show();
	});	
	$("body").on("click","#select_form_data",function(){
		var form_name = $('#form_selector').children(":selected").val();	
		var form_id = $('#form_selector').children(":selected").attr("id");
		if(typeof page_settings["settings"]["form_data"][form_id] == "undefined")
		{
		
		page_settings["settings"]["form_data"][form_id] = {}
		}
		page_settings["settings"]["form_data"][form_id]["form_id"] = form_id;
		page_settings["settings"]["form_data"][form_id]["form_name"] = form_name;
		if(typeof page_settings["settings"]["form_data"][form_id]["elements"] == "undefined")
		{
		
		page_settings["settings"]["form_data"][form_id]["elements"] = {};
		}
		$("input:checkbox[name='element']:checked").each(function()
		{
			var id = this.id;
			if(typeof page_settings["settings"]["form_data"][form_id]["elements"][id] == "undefined")
			{
				page_settings["settings"]["form_data"][form_id]["elements"][id] = {};
			}
			page_settings["settings"]["form_data"][form_id]["elements"][id]["id"] = id ;
			
			page_settings["settings"]["form_data"][form_id]["elements"][id]["position"] = $("#pos_data_"+form_id+"_"+id).val();
		});	
		alert("data added");
		$("#myModal_2").modal("toggle");
			
	});
	
	$("#generate_layout").click(function(e){
		console.log(page_settings);
		
     		generate_layout();
		alert("Now you can edit layout");
		$('#save_page').show();
	});
	$("#save_page").click(function(e){
		var i=1;
		if($("div[id^='left_']").html()!=undefined)
		{
			
			page_settings["box_order"]["left"] = {};
		
			$("div[id^='left_'] div[id^='box_']").each(function(){
				var box_id = this.id.substring(4,this.id.length);
				page_settings["box_order"]["left"]["item#"+i]  = box_id;
				i++;
 				
			});
			
		}
		if($("div[id^='main_']").html()!=undefined)
		{
			page_settings["box_order"]["main"] = {};

			$("div[id^='main_'] div[id^='box_']").each(function(){
				var box_id = this.id.substring(4,this.id.length);
				page_settings["box_order"]["main"]["item#"+i] = box_id;
				i++;
			});
		
		}
		if($("div[id^='right_']").html()!=undefined)
		{
			page_settings["box_order"]["right"] = {};
			$("div[id^='right_'] div[id^='box_']").each(function(){
				var box_id = this.id.substring(4,this.id.length);
				page_settings["box_order"]["right"]["item#"+i] = box_id;
				i++;
			});
			
		}		
		console.log(page_settings);
		$.ajax({
					url: "/laravel_testing/blog/public/save_page",
					type:"POST",
					
					data:page_settings
					})
					.done(function( d ){
						setTimeout(function(){alert("Page saved")},3000);
						
					});
		
		
	});


	function generate_layout()
	{
	
		var main_content = {};
		var left_side_bar = {};
		var right_side_bar = {};
		
		
		var i = 1;	
		if(typeof page_settings !='undefined')
		{
			var form = page_settings["settings"]["form"];
 			
			 
			 for(var val in form)
			{
    				
    				f = form[val];
				
				
				if(f["position"]=="main_content")		
				{
					main_content["item_"+i] = {};
					main_content["item_"+i]["form_id"] = f["form_id"];
					main_content["item_"+i]["form_name"] = f["form_name"];
					
	
				}
				else if(f["position"]=="left_side_bar")
				{
					left_side_bar["item_"+i] = {}; 
					left_side_bar["item_"+i]["form_id"] = f["form_id"];
					left_side_bar["item_"+i]["form_name"] = f["form_name"];
					
				}
				else if(f["position"]=="right_side_bar")
				{
					right_side_bar["item_"+i] = {};
					right_side_bar["item_"+i]["form_id"] = f["form_id"];
					right_side_bar["item_"+i]["form_name"] = f["form_name"];
					
				}
				i++;
			}

		}


		if(typeof page_settings["settings"]["form_data"] != 'undefined' )
		{
			var form_data = page_settings["settings"]["form_data"];
			
			 for(var val in form_data)
			{
    					
				var fd = form_data[val]	;
				var form_id = fd["form_id"];
				var form_name = fd["form_name"];
				var elements  = fd["elements"];
	
				for(var x in elements)
				{
					
					var e = elements[x];		
					if(e["position"]=="main_content")		
					{
						main_content["item_"+i] = {};
						main_content["item_"+i]["form_id"] = form_id;
						main_content["item_"+i]["form_name"] = form_name;
						main_content["item_"+i]["e_id"] = e["id"];
	
					}
					else if(e["position"]=="left_side_bar")		
					{
						left_side_bar["item_"+i] = {};
						left_side_bar["item_"+i]["form_id"] = form_id;
						left_side_bar["item_"+i]["form_name"] = form_name;
						left_side_bar["item_"+i]["e_id"] = e["id"];
	
					}
					else if(e["position"]=="right_side_bar")		
					{
						right_side_bar["item_"+i] = {};
						right_side_bar["item_"+i]["form_id"] = form_id;
						right_side_bar["item_"+i]["form_name"] = form_name;
						right_side_bar["item_"+i]["e_id"] = e["id"];
	
					}
	
					i++;
				}
			
			}
		}
		var str = '<div class="row">	<div class="col-md-12"></div> 	<div class="col-md-12"></div>		<div class="col-md-12"></div>	<div class="col-md-12"></div>	<div class="col-md-12"></div> <div class="col-md-12"><h1>To change order of elements in sidebars and main content please drag them</h1></div>	<div class="col-md-12"></div>	<div class="col-md-12"></div> <div class="col-md-12"></div>	<div class="col-md-12"></div> <div class="col-md-12">';
	
		var view_type = page_settings["view_type"];
		if(view_type=='3_col_view')
		{
			str = str +'<div class="col-md-3 " id="left_3_column">					<h3>Left side bar</h3>';
				for(var left in left_side_bar)
				{	
					var form = left_side_bar[left];
					var form_id = form["form_id"];
					var form_name = form["form_name"];
					var e_id;
					if(typeof form['e_id']!='undefined')	
					{
						e_id =  form['e_id'];
					}
					else
					{
						e_id = 0;
					}
					 str = str +'<div id="box_'+form_id+'#'+e_id+'" class="panel panel-default">		<p>Form ID: '+form_id+'</p>	<p>Form Name: '+form_name+'</p><p>Selected entry (ID) (0 if not a form data): '+e_id+'</p>';
	
					str = str + '</div>';
					
				}	
			str = str + '</div>';
			
			str = str + '<div class="col-md-6 " id="main_3_column">				<h3>Main content</h3>';
				
				for(var main in main_content)
				{
					var form = main_content[main];
					var form_id = form["form_id"];
					var form_name = form["form_name"];
					var e_id;
					if(typeof form['e_id']!='undefined')	
					{
						e_id =  form['e_id'];
					}
					else
					{
						e_id = 0;
					}
					 str = str +'<div id="box_'+form_id+'#'+e_id+'" class="panel panel-default">		<p>Form ID: '+form_id+'</p>	<p>Form Name: '+form_name+'</p><p>Selected entry (ID) (0 if not a form data): '+e_id+'</p>';
	
					str = str + '</div>';
				}
			str = str + '</div>';
		
			str = str + '<div class="col-md-3 " id="right_3_column">	<h3>Right side bar </h3>';

				for(var right in right_side_bar)
				{
					
					var form = right_side_bar[right];
					var form_id = form["form_id"];
					var form_name = form["form_name"];
					var e_id;
					if(typeof form['e_id']!='undefined')	
					{
						e_id =  form['e_id'];
					}
					else
					{
						e_id = 0;
					}
					 str = str +'<div id="box_'+form_id+'#'+e_id+'" class="panel panel-default">		<p>Form ID: '+form_id+'</p>	<p>Form Name: '+form_name+'</p><p>Selected entry (ID) (0 if not a form data): '+e_id+'</p>';
	
					str = str + '</div>';
				}	
			str = str +'</div>';
	
		}
		else if(view_type=='2_col_right_view')
		{
			str = str + '<div class="col-md-9 " id="main_2_column_right">				<h3>Main content</h3>';
				
				for(var main in main_content)
				{
					var form = main_content[main];
					var form_id = form["form_id"];
					var form_name = form["form_name"];
					var e_id;
					if(typeof form['e_id']!='undefined')	
					{
						e_id =  form['e_id'];
					}
					else
					{
						e_id = 0;
					}
					 str = str +'<div id="box_'+form_id+'#'+e_id+'" class="panel panel-default">		<p>Form ID: '+form_id+'</p>	<p>Form Name: '+form_name+'</p><p>Selected entry (ID) (0 if not a form data): '+e_id+'</p>';
	
					str = str + '</div>';
				}
			str = str + '</div>';
			
			str = str + '<div class="col-md-3 " id="right_2_column_right">	<h3>Right side bar </h3>';

				for(var right in right_side_bar)
				{
					
					var form = right_side_bar[right];
					var form_id = form["form_id"];
					var form_name = form["form_name"];
					var e_id;
					if(typeof form['e_id']!='undefined')	
					{
						e_id =  form['e_id'];
					}
					else
					{
						e_id = 0;
					}
					 str = str +'<div id="box_'+form_id+'#'+e_id+'" class="panel panel-default">		<p>Form ID: '+form_id+'</p>	<p>Form Name: '+form_name+'</p><p>Selected entry (ID) (0 if not a form data): '+e_id+'</p>';
	
					str = str + '</div>';
				}	
			str = str +'</div>';
			
		}
		else if(view_type == '2_col_left_view' )
		{
			str = str +'<div class="col-md-3 " id="left_2_column_left">					<h3>Left side bar</h3>';
				for(var left in left_side_bar)
				{	
					var form = left_side_bar[left];
					var form_id = form["form_id"];
					var form_name = form["form_name"];
					var e_id;
					if(typeof form['e_id']!='undefined')	
					{
						e_id =  form['e_id'];
					}
					else
					{
						e_id = 0;
					}
					 str = str +'<div id="box_'+form_id+'#'+e_id+'" class="panel panel-default">		<p>Form ID: '+form_id+'</p>	<p>Form Name: '+form_name+'</p><p>Selected entry (ID) (0 if not a form data): '+e_id+'</p>';
	
					str = str + '</div>';
					
				}	
			str = str + '</div>';

			str = str + '<div class="col-md-9 " id="main_2_column_left">				<h3>Main content</h3>';
				
				for(var main in main_content)
				{
					var form = main_content[main];
					var form_id = form["form_id"];
					var form_name = form["form_name"];
					var e_id;
					if(typeof form['e_id']!='undefined')	
					{
						e_id =  form['e_id'];
					}
					else
					{
						e_id = 0;
					}
					 str = str +'<div id="box_'+form_id+'#'+e_id+'" class="panel panel-default">		<p>Form ID: '+form_id+'</p>	<p>Form Name: '+form_name+'</p><p>Selected entry (ID) (0 if not a form data): '+e_id+'</p>';
	
					str = str + '</div>';
				}
			str = str + '</div>';
		}
		str = str + '</div></div>';


		
		
	
		$('#page_builder_layout_editor').html(str);

		$("div[id^='main_']").sortable({
		});

		$("div[id^='left_']").sortable({
		});
		$("div[id^='right_']").sortable({
		});
		
		$("div[id^='main_']").disableSelection();
		$("div[id^='left_']").disableSelection();
		$("div[id^='right_']").disableSelection();

		
	}// end of function generate layout()
	$("#li_layout_editor").click(function(){
		
		if($('#page_builder_layout_editor').html()=="")
			{
				alert("inside");
				str = "<h3>First select page layout , generate page layout and then edit it here </h3>";
				$('#page_builder_layout_editor').html(str);
				
			}
	});
	
	
	
});