<?php
class UsersController extends BaseController 
{
	public function __construct() 
	{
 		$this->beforeFilter('csrf', array('on'=>'post'));
		
	}
	public function register()
	{
		return View::make('Users.register');
		
	}
	public function doRegister()
	{
		$input = Input::all();
		
		$rules = array(
				'username'=>'required|alpha|min:2|unique:users',
				'email'=>'required|email|unique:users',
				'password'=>'required|alpha_num|between:6,12',
				'c_password'=>'required|alpha_num|between:6,12|same:password'

				);
		$validator = Validator::make($input,$rules);
		if(!$validator->fails())
		{
			$user =  new User();
			$account = new Account();
			$user->username = $input['username'];
			$user->email = $input['email'];
			$user->password = Hash::make($input['password']);
			$user->save();
			
			$account->account_name = $input['username'];
			$account->email = $input['email'];
			return Redirect::action('FormsController@render_form_creator');
		}
		return Redirect::action('UsersController@register')->withErrors($validator)->withInput();
	}
	public function login()
	{
		return View::make('login');
	}
	public function doLogin()
	{
		if (Auth::attempt(array('email'=>Input::get('email'), 'password'=>Input::get('password')))) 
		{
			$user = Input::get('email');	
			Session::put('user',$user);
			
 			return Redirect::action('TasksController@user_home')->with('message', 'You are now logged in!');
		}
		else
		{
    			return Redirect::to('users/login')
        		->with('message', 'Your username/password combination was incorrect')->withInput();
		}
	}
	
	public function logout()
	{	
		Session::forget('user');
		Session::flush();
		Auth::logout();
		
    		return Redirect::action('TasksController@home')->with('message', 'Your are now logged out!');
	}
	
}
?>