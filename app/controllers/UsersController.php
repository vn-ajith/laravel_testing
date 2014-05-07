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
		
			$account->account_name = $input['username'];
			$account->email = $input['email'];
			$account->save();
			
			$user->user_id = DB::table('accounts')->max('account_id');
			$user->username = $input['username'];
			$user->email = $input['email'];
			$user->password = Hash::make($input['password']);
			$user->account_id = DB::table('accounts')->max('account_id');
			$user->save();
			
			
			return Redirect::action('FormsController@render_form_creator');
		}
		return Redirect::action('UsersController@register')->withErrors($validator)->withInput();
	}
	
	public function login()
	{
		return View::make('Users.login');
	}
	public function doLogin()
	{
		if (Auth::attempt(array('username'=>Input::get('username'), 'password'=>Input::get('password')))) 
		{
			$user = Input::get('username');	
			Session::put('user',$user);
			
 			echo "<h1>login successful</h1><br>";
			echo "<h3>Hello ".Session::get('user')." </h3>";
			return Redirect::action('UsersController@dashboard');
		}
		else
		{
// 			echo "<h1>login Failed</h1>";
    			return Redirect::action('UsersController@login')
        		->with('message', 'Your username/password combination was incorrect')->withInput();
// 			return Redirect::action('UsersController@login')->withErrors($validator)->withInput();
		}
	}
	
	public function dashboard()
	{
		return View::make('Users.dashboard');
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