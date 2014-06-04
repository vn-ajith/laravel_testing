$(document).ready(function(){
	$('#save_page').hide();
	
	var page_settings={};
	page_settings["settings"] = {};
	page_settings["settings"]["form"]= {}
	page_settings["settings"]["form_data"] = {};
	page_settings["box_order"] = {}
	page_settings["settings"]["lists"] = {};
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
		str = str+"<option value='header'>Header</option>";
		str = str+"<option value='footer'>Footer</option>";
		
		$("select[id^='position_']").html(str);
		$("select[id^='lists_']").html(str);	
		
			

	});
	
	$("body").on("click","#select_form_save",function(){
		var counter = 0;
		
		var value_radio = $( "input:radio[name='view_type']:checked" ).val();
		if(value_radio==undefined)
		{
			alert('First select template style');
			
		}
		else
		{
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
		}
		
	});
		
	
	$("body").on("click","#select_form",function(){
		
		var id = $('#form_selector').children(":selected").attr("id");	
		var value_radio = $( "input:radio[name='view_type']:checked" ).val();
		if(value_radio==undefined)
		{
			alert('First select template style');
			
		}
		else
		{
		$.ajax({
					url: "../../../laravel_testing/blog/public/generate_form_data_table",
					type:"POST",
					
					data:{"id":id,"radio":value_radio}
					})
					.done(function( d ){
						
						$('#form_data_display').html(d);
					});
		$('#select_form_data').show();
		}
	});	
	$("body").on("click","#select_form_data",function(){
		var field_options  = ""; 
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
		if($("input:checkbox[name='field_options']:checked").length>1)
		{
			$("input:checkbox[name='field_options']:checked").each(function()
			{
				field_options =   this.value+ "," +field_options; 
			}
			);
		}
		else
		{
			field_options = "all";
		}
		page_settings["settings"]["form_data"][form_id]["field_options"] = field_options;
		page_settings["settings"]["form_data"][form_id]["css_class_name"] = $("#form_data_css_class").val();

		
		alert("data added");

		$("#myModal_2").modal("toggle");
			
	});
		
	$("body").on("click","#select_list",function(){
		var counter = 0;
		
		var value_radio = $( "input:radio[name='view_type']:checked" ).val();
		if(value_radio==undefined)
		{
			alert('First select template style');
			
		}
		else
		{
		
		
		
		$("input:checkbox[name='list_check']:checked").each(function()
		{
			var id = this.id;
			if(typeof page_settings["settings"]["lists"][id] == "undefined")
			{
			page_settings["settings"]["lists"][id] = {};
			}
    			page_settings["settings"]["lists"][id]["list_id"] = id;
			page_settings["settings"]["lists"][id]["list_name"] = $(this).val();
			page_settings["settings"]["lists"][id]["position"] = $("#lists_position_"+id).val(); 
			});
		
		
		
		
		
		$('#myModal_3').modal('toggle');
		}
		
	});
	
	$("#generate_layout").click(function(e){
		console.log(page_settings);
		var value_radio = $( "input:radio[name='view_type']:checked" ).val();
		page_settings["view_type"] = value_radio;
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
		if($("#header_disp").html()!=undefined)
		{
			
			page_settings["box_order"]["header"] = {};
		
			$("#header_disp div[id^='box_']").each(function(){
				var box_id = this.id.substring(4,this.id.length);
				page_settings["box_order"]["header"]["item#"+i]  = box_id;
				i++;
 				
			});
			
		}
		if($("#footer_disp").html()!=undefined)
		{
			
			page_settings["box_order"]["footer"] = {};
		
			$("#footer_disp div[id^='box_']").each(function(){
				var box_id = this.id.substring(4,this.id.length);
				page_settings["box_order"]["footer"]["item#"+i]  = box_id;
				i++;
 				
			});
			
		}		
		if($('#grid_list_view').is(':checked'))
		{
			page_settings["settings"]["grid_list_view"] = 1;
		}
		else
		{	
			page_settings["settings"]["grid_list_view"] = 0;
		}
		page_settings["page_name"] = $("#page_name").val();
		console.log(page_settings);
		$.ajax({
					url: "../../../laravel_testing/blog/public/save_page",
					type:"POST",
					
					data:page_settings
					})
					.done(function( d ){
						setTimeout(function(){alert(d)},2000);
						
					});
		
		
	});


	function generate_layout()
	{
	
		var main_content = {};
		var left_side_bar = {};
		var right_side_bar = {};
		var header = {};
		var footer = {};
		
		
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
				else if(f["position"]=="header")
				{
					header["item_"+i] = {};
					header["item_"+i]["form_id"] = f["form_id"];
					header["item_"+i]["form_name"] = f["form_name"];
					
				}
				else if(f["position"]=="footer")
				{
					footer["item_"+i] = {};
					footer["item_"+i]["form_id"] = f["form_id"];
					footer["item_"+i]["form_name"] = f["form_name"];
					
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
					else if(e["position"]=="header")		
					{
						header["item_"+i] = {};
						header["item_"+i]["form_id"] = form_id;
						header["item_"+i]["form_name"] = form_name;
						header["item_"+i]["e_id"] = e["id"];
	
					}
					else if(e["position"]=="footer")		
					{
						footer["item_"+i] = {};
						footer["item_"+i]["form_id"] = form_id;
						footer["item_"+i]["form_name"] = form_name;
						footer["item_"+i]["e_id"] = e["id"];
	
					}
					i++;
				}
			
			}
		}
		if(typeof page_settings !='undefined')
		{
			var lists = page_settings["settings"]["lists"];
 			
			 
			 for(var val in lists)
			{
    				
    				f = lists[val];
				
				
				if(f["position"]=="main_content")		
				{
					main_content["item_"+i] = {};
					main_content["item_"+i]["list_id"] = f["list_id"];
					main_content["item_"+i]["list_name"] = f["list_name"];
					
	
				}
				else if(f["position"]=="left_side_bar")
				{
					left_side_bar["item_"+i] = {}; 
					left_side_bar["item_"+i]["list_id"] = f["list_id"];
					left_side_bar["item_"+i]["list_name"] = f["list_name"];
					
				}
				else if(f["position"]=="right_side_bar")
				{
					right_side_bar["item_"+i] = {};
					right_side_bar["item_"+i]["list_id"] = f["list_id"];
					right_side_bar["item_"+i]["list_name"] = f["list_name"];
					
				}
				else if(f["position"]=="header")
				{
					header["item_"+i] = {};
					header["item_"+i]["list_id"] = f["list_id"];
					header["item_"+i]["list_name"] = f["list_name"];
					
				}
				else if(f["position"]=="footer")
				{
					footer["item_"+i] = {};
					footer["item_"+i]["list_id"] = f["list_id"];
					footer["item_"+i]["list_name"] = f["list_name"];
					
				}
				i++;
			}

		}
		
		
		var str = '<div class="row">	<div class="col-md-12"></div> 	<div class="col-md-12"></div>		<div class="col-md-12"></div>	<div class="col-md-12"></div>	<div class="col-md-12"><h3>Header</h3></div> <div class="col-md-12">';
		
		str = str +'<div class="col-md-3 " id="header_disp">';
				for(var head in header)
				{	
					var item = header[head];
					if(typeof item["form_id"]!='undefined')	
					{
						var form_id = item["form_id"];
						var form_name = item["form_name"];
						var e_id;
						if(typeof item['e_id']!='undefined')	
						{
							e_id =  item['e_id'];
						}
						else
						{
							e_id = 0;
						}
						str = str +'<div id="box_'+form_id+'#'+e_id+'" class="panel panel-default">		<p>Form ID: '+form_id+'</p>	<p>Form Name: '+form_name+'</p><p>Selected entry (ID) (0 if not a form data): '+e_id+'</p>';
					
					}
					else if(typeof item["list_id"]!='undefined')
					{
						var list_id = item["list_id"];
						var list_name = item["list_name"];
						str = str +'<div id="box_list#'+list_id+'" class="panel panel-default">		<p>List ID: '+list_id+'</p>	<p>List Name: '+list_name+'</p>';
						
					}
					
					 
	
					str = str + '</div>';
					
				}	
			str = str + '</div>';
		
		
		str = str+'</div><div class="col-md-12"></div>	<div class="col-md-12"></div> <div class="col-md-12"></div>';	
		
		var view_type = page_settings["view_type"];
		if(view_type=='3_col_view')
		{
			str = str + '<div class="col-md-3"><h3>Left side bar</h3></div><div class="col-md-6"><h3>Main content</h3></div><div class="col-md-3"><h3>Right side bar</h3></div><div class="col-md-12"></div> <div class="col-md-12">'
			str = str +'<div class="col-md-3 " id="left_3_column">';
				for(var left in left_side_bar)
				{	
					var item = left_side_bar[left];
					if(typeof item["form_id"]!='undefined')	
					{
						var form_id = item["form_id"];
						var form_name = item["form_name"];
						var e_id;
						if(typeof item['e_id']!='undefined')	
						{
							e_id =  item['e_id'];
						}
						else
						{
							e_id = 0;
						}
						str = str +'<div id="box_'+form_id+'#'+e_id+'" class="panel panel-default">		<p>Form ID: '+form_id+'</p>	<p>Form Name: '+form_name+'</p><p>Selected entry (ID) (0 if not a form data): '+e_id+'</p>';
					
					}
					else if(typeof item["list_id"]!='undefined')
					{
						var list_id = item["list_id"];
						var list_name = item["list_name"];
						str = str +'<div id="box_list#'+list_id+'" class="panel panel-default">		<p>List ID: '+list_id+'</p>	<p>List Name: '+list_name+'</p>';
						
					}
	
					str = str + '</div>';
					
				}	
			str = str + '</div>';
			
			str = str + '<div class="col-md-6 " id="main_3_column">';
				
				for(var main in main_content)
				{
					var item = main_content[main];
					if(typeof item["form_id"]!='undefined')	
					{
						
						var form_id = item["form_id"];
						var form_name = item["form_name"];
						var e_id;
						if(typeof item['e_id']!='undefined')	
						{
							e_id =  item['e_id'];
						}
						else
						{
							e_id = 0;
						}
						str = str +'<div id="box_'+form_id+'#'+e_id+'" class="panel panel-default">		<p>Form ID: '+form_id+'</p>	<p>Form Name: '+form_name+'</p><p>Selected entry (ID) (0 if not a form data): '+e_id+'</p>';
					
					}
					else if(typeof item["list_id"]!='undefined')
					{
						console.log("list");
						var list_id = item["list_id"];
						var list_name = item["list_name"];
						str = str +'<div id="box_list#'+list_id+'" class="panel panel-default">		<p>List ID: '+list_id+'</p>	<p>List Name: '+list_name+'</p>';
						
					}
	
					str = str + '</div>';
				}
			str = str + '</div>';
		
			str = str + '<div class="col-md-3 " id="right_3_column">';

				for(var right in right_side_bar)
				{
					
					var item = right_side_bar[right];
					if(typeof item["form_id"]!='undefined')	
					{
						var form_id = item["form_id"];
						var form_name = item["form_name"];
						var e_id;
						if(typeof item['e_id']!='undefined')	
						{
							e_id =  item['e_id'];
						}
						else
						{
							e_id = 0;
						}
						str = str +'<div id="box_'+form_id+'#'+e_id+'" class="panel panel-default">		<p>Form ID: '+form_id+'</p>	<p>Form Name: '+form_name+'</p><p>Selected entry (ID) (0 if not a form data): '+e_id+'</p>';
					
					}
					else if(typeof item["list_id"]!='undefined')
					{
						var list_id = item["list_id"];
						var list_name = item["list_name"];
						str = str +'<div id="box_list#'+list_id+'" class="panel panel-default">		<p>List ID: '+list_id+'</p>	<p>List Name: '+list_name+'</p>';
						
					}
	
					str = str + '</div>';
				}	
			str = str +'</div>';
	
		}
		else if(view_type=='2_col_right_view')
		{
			str = str + '<div class="col-md-9"><h3>Main content</h3></div><div class="col-md-3"><h3>Right side bar</h3></div><div class="col-md-12"></div> <div class="col-md-12">'
			str = str + '<div class="col-md-9 " id="main_2_column_right">';
				
				for(var main in main_content)
				{
					var item = main_content[main];
					if(typeof item["form_id"]!='undefined')	
					{
						var form_id = item["form_id"];
						var form_name = item["form_name"];
						var e_id;
						if(typeof item['e_id']!='undefined')	
						{
							e_id =  item['e_id'];
						}
						else
						{
							e_id = 0;
						}
						str = str +'<div id="box_'+form_id+'#'+e_id+'" class="panel panel-default">		<p>Form ID: '+form_id+'</p>	<p>Form Name: '+form_name+'</p><p>Selected entry (ID) (0 if not a form data): '+e_id+'</p>';
					
					}
					else if(typeof item["list_id"]!='undefined')
					{
						var list_id = item["list_id"];
						var list_name = item["list_name"];
						str = str +'<div id="box_list#'+list_id+'" class="panel panel-default">		<p>List ID: '+list_id+'</p>	<p>List Name: '+list_name+'</p>';
						
					}
	
					str = str + '</div>';
				}
			str = str + '</div>';
			
			str = str + '<div class="col-md-3 " id="right_2_column_right">';

				for(var right in right_side_bar)
				{
					
					var item = right_side_bar[right];
					if(typeof item["form_id"]!='undefined')	
					{
						var form_id = item["form_id"];
						var form_name = item["form_name"];
						var e_id;
						if(typeof item['e_id']!='undefined')	
						{
							e_id =  item['e_id'];
						}
						else
						{
							e_id = 0;
						}
						str = str +'<div id="box_'+form_id+'#'+e_id+'" class="panel panel-default">		<p>Form ID: '+form_id+'</p>	<p>Form Name: '+form_name+'</p><p>Selected entry (ID) (0 if not a form data): '+e_id+'</p>';
					
					}
					else if(typeof item["list_id"]!='undefined')
					{
						var list_id = item["list_id"];
						var list_name = item["list_name"];
						str = str +'<div id="box_list#'+list_id+'" class="panel panel-default">		<p>List ID: '+list_id+'</p>	<p>List Name: '+list_name+'</p>';
						
					}
	
					str = str + '</div>';
				}	
			str = str +'</div>';
			
		}
		else if(view_type == '2_col_left_view' )
		{
			str = str + '<div class="col-md-3"><h3>Left side bar</h3></div><div class="col-md-9"><h3>Main content</h3></div><div class="col-md-12"></div> <div class="col-md-12">'
			str = str +'<div class="col-md-3 " id="left_2_column_left">';
				for(var left in left_side_bar)
				{	
					var item = left_side_bar[left];
					if(typeof item["form_id"]!='undefined')	
					{
						var form_id = item["form_id"];
						var form_name = item["form_name"];
						var e_id;
						if(typeof item['e_id']!='undefined')	
						{
							e_id =  item['e_id'];
						}
						else
						{
							e_id = 0;
						}
						str = str +'<div id="box_'+form_id+'#'+e_id+'" class="panel panel-default">		<p>Form ID: '+form_id+'</p>	<p>Form Name: '+form_name+'</p><p>Selected entry (ID) (0 if not a form data): '+e_id+'</p>';
					
					}
					else if(typeof item["list_id"]!='undefined')
					{
						var list_id = item["list_id"];
						var list_name = item["list_name"];
						str = str +'<div id="box_list#'+list_id+'" class="panel panel-default">		<p>List ID: '+list_id+'</p>	<p>List Name: '+list_name+'</p>';
						
					}
	
					str = str + '</div>';
					
				}	
			str = str + '</div>';

			str = str + '<div class="col-md-9 " id="main_2_column_left">';
				
				for(var main in main_content)
				{
					var item = main_content[main];
					if(typeof item["form_id"]!='undefined')	
					{
						var form_id = item["form_id"];
						var form_name = item["form_name"];
						var e_id;
						if(typeof item['e_id']!='undefined')	
						{
							e_id =  item['e_id'];
						}
						else
						{
							e_id = 0;
						}
						str = str +'<div id="box_'+form_id+'#'+e_id+'" class="panel panel-default">		<p>Form ID: '+form_id+'</p>	<p>Form Name: '+form_name+'</p><p>Selected entry (ID) (0 if not a form data): '+e_id+'</p>';
					
					}
					else if(typeof item["list_id"]!='undefined')
					{
						var list_id = item["list_id"];
						var list_name = item["list_name"];
						str = str +'<div id="box_list#'+list_id+'" class="panel panel-default">		<p>List ID: '+list_id+'</p>	<p>List Name: '+list_name+'</p>';
						
					}
	
					str = str + '</div>';
				}
			str = str + '</div>';
		}
		str = str + '</div>';
		str = str + '<div class="col-md-12"><h3>Footer</h3></div>';
		str = str + '<div class="col-md-12">';

		str = str + '<div class="col-md-9 " id="footer_disp">';
				
				for(var foo in footer)
				{
					var item = footer[foo];
					if(typeof item["form_id"]!='undefined')	
					{
						var form_id = item["form_id"];
						var form_name = item["form_name"];
						var e_id;
						if(typeof item['e_id']!='undefined')	
						{
							e_id =  item['e_id'];
						}
						else
						{
							e_id = 0;
						}
						str = str +'<div id="box_'+form_id+'#'+e_id+'" class="panel panel-default">		<p>Form ID: '+form_id+'</p>	<p>Form Name: '+form_name+'</p><p>Selected entry (ID) (0 if not a form data): '+e_id+'</p>';
					
					}
					else if(typeof item["list_id"]!='undefined')
					{
						var list_id = item["list_id"];
						var list_name = item["list_name"];
						str = str +'<div id="box_list#'+list_id+'" class="panel panel-default">		<p>List ID: '+list_id+'</p>	<p>List Name: '+list_name+'</p>';
						
					}
	
					str = str + '</div>';
				}
			str = str + '</div>';

		str = str + '</div></div></div>';


		
		
	
		$('#page_builder_layout_editor').html(str);

		$("div[id^='main_']").sortable({});
		$("div[id^='left_']").sortable({});
		$("div[id^='right_']").sortable({});
		$("#header_disp").sortable({});
		$("#footer_disp").sortable({});
			
		$("div[id^='main_']").disableSelection();
		$("div[id^='left_']").disableSelection();
		$("div[id^='right_']").disableSelection();
		$("#header_disp").disableSelection();
		$("#footer_disp").disableSelection();
		
	}// end of function generate layout()
	$("#li_layout_editor").click(function(){
		
		if($('#page_builder_layout_editor').html()=="")
			{
				str = "<h3>First select page layout , generate page layout and then edit it here </h3>";
				$('#page_builder_layout_editor').html(str);
				
			}
	});
	
	
	
});