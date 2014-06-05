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
				'username'=>'required|alpha_num|min:2|unique:users',
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
			
			$temp = DB::table('users')->max('user_id');
			$user->user_id = $temp + 1;	
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
		
		$rules = array(
			'username'    => 'required|alphaNum', 
			'password' => 'required|alphaNum|min:6' 
		);

		
		$validator = Validator::make(Input::all(), $rules);

		
		if ($validator->fails()) 
		{
		
			return Redirect::to('login')
				->withErrors($validator) 
				->withInput(Input::except('password')); 
		}
		else
		{

			
			$userdata = array(
				'username' 	=> Input::get('username'),
				'password' 	=> Input::get('password')
			);

			
			if (Auth::attempt($userdata)) 
			{
				$user = Input::get('username');	
				Session::put('user',$user);
				$account_id = DB::table('users')->where('username', $user)->pluck('account_id');
					
				Session::put("account_id",$account_id);
				return Redirect::action('UsersController@dashboard');

			}
			else
			{	 	

				return Redirect::to('login');

			}

		}
	}
	
	public function dashboard()
	{
		if(Session::get('user')!=NULL)
		{
			$user = Session::get("user");
			$account_id = Session::get("account_id");
			$pages = DB::table('page_builds')->where('account_id', $account_id)->get();
			$recent_pages = DB::table('page_builds')
                     			->select('page_id','page_name')
                     			->orderBy('page_id','desc')
					->take(3)
                     			->get();
			
			$recent = '<ul class="nav nav-sidebar"><li><h3>Recent pages </h3></li>';
			foreach($recent_pages as $r)
			{
				$recent .= '<li><a href="'.action("PageBuilderController@page_render",$r->page_id).'">'.$r->page_name.'</a></li>';
			}
			$recent .='</ul>';
			
			return View::make('Users.dashboard',array("user"=>$user,"pages"=>$pages,"recent"=>$recent));
			
		}
		else
		{
			return Redirect::action("UsersController@login");
		}
	}
	public function new_user()
	{
		$input = Input::all();
		$rules = $rules = array(
				'username'=>'required|alpha_num|min:2|unique:users,username',
				'email'=>'required|email|unique:users,email',
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
		$account_id = Session::get("account_id");
		$pages = DB::select('select * from page_builds where account_id= ?',array($account_id));
		echo '<div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Page ID</th>
                  <th>Page name</th>
                  <th></th>		
                </tr>
              </thead>
              <tbody>';
		foreach($pages as $p)
		{
			echo '<tr>';
			
			echo '<td><a href="'.action('PageBuilderController@page_render', $p->page_id).'">'.$p->page_name.'</a></td>';
			echo '<td>';
			echo '<a href="'.action('PageBuilderController@deletePage', $p->page_id).'" ><img src="assets/images/delete.png"></a></td>';
							
			echo '</td>';
			echo '</tr>';
		}
		echo ' </tbody>
            </table>
          </div>';
	}
	public function user_list()
	{
		$account_id = Session::get("account_id");
		$user = DB::select('select * from users where account_id= ?',array($account_id));
// 		$user = User::all();
		echo '<div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Username</th>
                  <th>E-mail</th>	
		  <th></th>		
                </tr>
              </thead>
              <tbody>';
		foreach($user as $u)
		{
			echo '<tr>';
			echo '<td>'.$u->user_id.'</td>';
			echo '<td>'.$u->username.'</td>';
			echo '<td>'.$u->email.'</td>';
			echo '<td>';
			echo '<a href="'.action('UsersController@deleteUser', $u->user_id).'" ><img src="assets/images/delete.png"></a>';
			
			echo '</td>';
			echo '</tr>';
		}
		echo ' </tbody>
            </table>
          </div>';
	}
	public function deleteUser(User $user)
	{
		$user->delete();
		return Redirect::action("UsersController@dashboard");
	}
	public function search_user()
	{
		$input = Input::all();
		$search =  $input['search'].'%';
		$users = DB::table('users')->where('username', 'LIKE', $search)->get();
		if(!empty($users))
		{
			echo '<div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Username</th>
                  <th>E-mail</th>	
		  
                </tr>
              </thead>
              <tbody>';
		foreach($users as $u)
		{
			echo '<tr>';
			echo '<td><input type="checkbox" value="'.$u->user_id.'" id="user_'.$u->user_id.'"></td>';
			echo '<td>'.$u->username.'</td>';
			echo '<td>'.$u->email.'</td>';
			echo '</tr>';
		}
		echo ' </tbody>
            </table>
          </div>';
		}
		
	}
	public function search_user_add()
	{
		$input  = Input::all();
		$user_id = $input["user_id"];
		$account_id = Session::get("account_id");
		DB::table('users')->where('user_id', 1)->update(array('account_id' => $account_id));
	}
	public function logout()
	{	
		Session::forget('user');
		Session::forget("account_id")	;
		Session::flush();
		Auth::logout();
		
    		return Redirect::action('UsersController@login');
	}
	
}
?>