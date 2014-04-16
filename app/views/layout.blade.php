<html lang="en">
<head>
<meta charset="UTF-8">
<title>Form builder</title>
<script src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>	

</head>
<body>
<ul class="nav nav-tabs">
  <li><a href="{{action('FormsController@render_form_creator')}}">Home</a></li>
  <li><a href="{{action('FormsController@select_form')}}">Select a form</a></li>
  
</ul>

@yield('content')


</body>
</html>
