@extends("layout")
@section("content")
<style>
.form-control{
	width:50%;
}
#errors{
	margin-left:5%;
	margin-right:50%;
/* 	background-color:#FF4136; */
	color: #FF4136;
	border-radius:4px;
	text-align:center;
}
</style>
<div id="login_container">
	<section class="header section-padding">
		<div class="background">&nbsp;</div>
			<div class="container">
				<div class="header-text">
					<h1>Login</h1>
		
				</div>
			</div>
	</section>
	<div id="errors">
		
			{{ $errors->first('username') }}
			<br>
			{{ $errors->first('password') }}
		
			
		
	</div>

	<div class="container">
	
			{{ Form::open(array('url'=> 'doLogin', 'class'=>'form')) }}
			
		
		<div class="form-group">
			{{ Form::label('username', 'User name') }}
			{{ Form::text('username','',array('class'=>'form-control')) }}
		</div>
		<div class="form-group">
			{{ Form::label('password', 'Password') }}<br>
			<input type="password" name="password" id="password" value="" class="form-control">
		</div>

		
 	
		<div class="form-group">
			{{ Form::submit('Login', array('class'=>'btn btn-primary')) }}
	
		</div>
		<div class="form-group" style="margin-top:10px;">
			<a href="{{action('UsersController@register')}}">New user? Register here</a>
		</div>
		
		
			{{ Form::close() }}
		
		
	</div>
</div>
@stop