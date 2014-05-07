<?php
class UsersController extends BaseController 
{
	public function __construct() 
	{
//  		$this->beforeFilter('csrf', array('on'=>'post'));
		
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
			
			
			return Redirect::action('UsersController@login');
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
			$account_id = DB::table('users')->where('username', $user)->pluck('account_id');
				
 			Session::put("account_id",$account_id);
			
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
		$user = Session::get("user");
		
		$account_id = Session::get("account_id");
		$pages = DB::table('page_builds')->where('account_id', $account_id)->get();
		return View::make('Users.dashboard',array("user"=>$user,"pages"=>$pages));
	}
	public function new_user()
	{
		$input = Input::all();
		$rules = $rules = array(
				'username'=>'required|alpha|min:2|unique:users',
				'email'=>'required|email|unique:users',
				'password'=>'required|alpha_num|between:6,12');
		$validator = Validator::make($input,$rules);
		if($validator->passes())
		{
			$user = new User();
			$user->user_id = DB::table("users")->max("user_id")+1;
			$user->username = $input["username"];
			$user->email = $input["email"];
			$user->password = Hash::make($input["password"]);
			$user->account_id = Session::get("account_id");
			$user->save();
			echo 'New user added successfully';
		}
		else
		{
			echo 'Username and email should be unique';
		}
	}
	public function page_list()
	{
		
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