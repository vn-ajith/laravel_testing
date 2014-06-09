@extends('../layout')
@section('content')
<link rel="stylesheet" href="assets/css/superhero_bootstrap_theme.css" >
<style>
.form-control{
	width:50%;
}
#errors{
	margin-left:5%;
	margin-right:50%;
}
</style>
<section class="header section-padding">
	<div class="background">&nbsp;</div>
		<div class="container">
			<div class="header-text">
				<h1>Register</h1>
				
			</div>
		</div>
</section>
	<div id="errors">
	{{ HTML::ul($errors->all(), array('class'=>'alert alert-danger')) }}
	</div>

	<div class="container">
	<section class="section-padding">
	
	

		{{ Form::open(array('url'=> 'doRegister', 'method'=>'post', 'class'=>'form')) }}
		
	<div class="form-group">
		{{ Form::label('username', 'User name') }}
		{{ Form::text('username','',array('class'=>'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('email', 'Email address') }}
		{{ Form::email('email','',array('class'=>'form-control')) }}
	</div>
	<div class="form-group">
		{{ Form::label('password', 'Password') }}<br>
		<input type="password" class="form-control" id="password" name="password" value="">
	</div>
	
	<div class="form-group">
		{{ Form::label('c_password', 'Confirm password') }}<br>
		<input type="password" class="form-control" id="c_password" name="c_password" value="">
	</div>
	<div class="form-group">
		{{ Form::submit('Register user', array('class'=>'btn btn-primary')) }}

	</div>
	<div class="form-group" style="margin-top:10px;">
			<a href="{{action('UsersController@login')}}">Already a user? Login here</a>
		</div>
	
		{{ Form::close() }}
	
	</section>
	</div>
@stop