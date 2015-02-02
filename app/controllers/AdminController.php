<?php

class AdminController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Admin Controller
	|--------------------------------------------------------------------------
	*/
    public function __construct()
    {

    	/*$this->beforeFilter(function(){
			$user = Auth::user();

			if($user->role == "0") {
				return Redirect::to('dashboard');
			}
		});*/

    }



	public function getIndex()
	{
		return View::make('admin.index');
	}


	public function getUsers($page = 1) {
	    //$page = Input::get('page', 1);

	    $limit = 15;
	    $user = new User;  // correct
	    $data = $user->getByPage($page, $limit);
	    $users = Paginator::make($data->items, $data->totalItems, $limit);

	    $data = array(	"users" => $users->getCollection()->all(),
	    				"pagination" => array(
	    								"page"=>$page,
	    								"pageSize" =>$users->count(),
	    								"pageCount"=>ceil($users->getTotal()/$users->getPerPage()),
	    								"total"=>$users->getTotal()
	    								)
	    			);

	    return View::make('admin.users')->with('data', $data);
	}

	public function delUser($user_id) {
		$user = Auth::user();
		if(!($user_id == $user->id)) {

			DB::table('users')->where('id','=',$user_id)->delete();
		}

		return Redirect::back();
	}

	public function getEditUser($user_id) {
		$user = DB::table('users')->where('id', '=', $user_id)->first();
		return View::make('admin.edituser')->with('user', $user);		
	}

	public function postEditUser($user_id) {

		$input = Input::all();
		//var_dump($input['role']); exit;
		$rules = array('profile_picture' => 'image', 'username' => 'required|unique:users,username,'.$user_id);

		$v = Validator::make($input, $rules);
		$fail = $v->fails();

		if($fail)
		{
			return Redirect::back()->withInput()->withErrors($v);

		} else { 

			//save settings to database
			$user = User::where('id', '=', $user_id)->first();

			$profile_picture_submit = $user->profile_picture;
			$input['profile_picture_url'] = (isset($input['profile_picture_url'])) ? $input['profile_picture_url'] : "";
			if($input['profile_picture_url']=='file_up') {
				$profile_picture_submit = $input['profile_pic_fl_url'];
			}
			//var_dump($settings);exit;

			$user->profile_picture = $profile_picture_submit;

			$user->username = $input['username'];
			$user->first_name = $input['first_name'];
			$user->last_name = $input['last_name'];
			$user->role = (isset($input['role']) && $input['role'] == '1') ? 1 : 0;

			$user->save();
			return Redirect::back()->with("success", "1");
		}		
	}

	public function postChangePass($user_id) {
		$input = Input::all();

		$rules = array('password' => 'required|confirmed');

		$v = Validator::make($input, $rules);

		if($v->passes()) {
			$user = User::where('id', '=', $user_id)->first();
			$user->password = Hash::make($input['password']);
			$user->save();

			return Redirect::back()->with("cpsuccess", "1");
		}
		return Redirect::back()->with("perror", $v->messages()->toArray());
	}

	public function getAddUser() {
		return View::make('admin.adduser');
	}

	public function postAddUser() {
		$input = Input::all();

		$rules = array('profile_picture' => 'image', 'username' => 'required|unique:users', 'email' => 'required|unique:users|email', 'password' => 'required|confirmed');

		$v = Validator::make($input, $rules);

		if($v->passes()) {

			$user = new User;

			$user->profile_picture = $input['profile_pic_fl_url'];
			$user->username = $input['username'];
			$user->first_name = $input['first_name'];
			$user->last_name = $input['last_name'];
			$user->email = $input['email'];
			$user->password = Hash::make($input['password']);
			$user->role = (isset($input['role']) && $input['role'] == '1') ? 1 : 0;
			$user->save();

			return Redirect::back()->with("cpsuccess", "1");
		}
		return Redirect::back()->withErrors($v);
	}

}