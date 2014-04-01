<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

	<script src="https://code.jquery.com/jquery.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/main.css">
 
    <title>Authentication App With Laravel 4</title>
  </head>
 
  <body>
 
	<div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <ul class="nav"> 
                    <li>{{ HTML::link('users/register', 'Register') }}</li>  
                    <li>{{ HTML::link('users/login', 'Login') }}</li>  
                </ul> 
            </div>
        </div>
    </div> 

	<div class="container">
        @if(Session::has('message'))
            <p class="alert">{{ Session::get('message') }}</p>
        @endif
	{{ $content }}
    </div>

  </body>

</html>