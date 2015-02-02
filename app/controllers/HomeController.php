<?php



class HomeController extends BaseController {

    public function __construct()
    {

    }

	public function getIndex()
	{
		return View::make('home.index');
	}
	

	public function getLogin()
	{
		if(Auth::check()) {
			return Redirect::to('dashboard');	
		}

		return View::make('home.login');
	}

	public function postLogin()
	{	
		
		$input = Input::all();

		$rules = array('email' => 'required', 'password' => 'required');

		$v = Validator::make($input, $rules);

		if($v->fails())
		{

			return Redirect::route('login-page')->withErrors($v);

		} else { 

			$credentials = array('email' => $input['email'], 'password' => $input['password'], 'email_confirm' => '');

			$remember_me = (isset($input['remember_me'])) ? true : false;

			if(Auth::attempt($credentials, $remember_me))
			{ 
				if(Auth::user()->role == '1') {
					return Redirect::route('admin-page');
				}
				else {
					if (Auth::user()->role == '2') {
						return Redirect::route('supplier-page');
					} else {
						return Redirect::route('landing-page');
					}
				}

			} else {

				return Redirect::route('login-page')->with("success", "0");
			}
		}
	}
	
	

	public function getRegister()
	{
		if(Auth::check()) {
			return Redirect::to('dashboard');
		}	
		return View::make('home.register');
	}

	public function postRegister()
	{
		if(Auth::check()) {
			return Redirect::route('landing-page');
		}	
		
		$input = Input::all();

		$rules = array('username' => 'required|unique:users', 'email' => 'required|unique:users|email', 'password' => 'required|confirmed');

		$v = Validator::make($input, $rules);

		//GENERATE $newcode - RANDOM STRING TO VERIFY SIGNUP
		for($code_length = 25, $newcode = ''; strlen($newcode) < $code_length; $newcode .= chr(!rand(0, 2) ? rand(48, 57) : (!rand(0, 1) ? rand(65, 90) : rand(97, 122))));

		if($v->passes())
		{
			$password = $input['password'];
			$password = Hash::make($password);

			$user = new User();
			$user->username = $input['username'];
			$user->email = $input['email'];
			$user->password = $password;
			$user->phone_number = $input['phone_number'];
			$user->email_confirm = $newcode;
			$user->save();
			
			$userpostjob = User::where('id', '=', $user->id)->first();
			$job = new Job();
			$job->tittle = $input['tittle'];
			$job->description = $input['description'];
			$job->price = $input['price'];
			$job->time = $input['time'];
			$job->user_id = $userpostjob->id;
			$job->status = 'openjob';
			$job->save();
			//Send confirmation email
		    $data = array(
		        'email'     => $input['email'],
		        'clickUrl'  => URL::to('/') . '/confirm/' . $newcode
		    );
		   
		    //---new send email----//
		    try {
		    	Mail::send('emails.signup', $data, function($message)
		    	{
		    		$message->to(Input::get('email'))->subject('Welcome');
		    	});
		    
		    }
		    catch (Exception $e){
		    	$to      = Input::get('email');
		    	$subject = 'Welcome';
		    	$message = View::make('emails.signup', $data)->render();
		    	$headers = 'From: admin@homeez.com' . "\r\n" .
		    			'Reply-To: admin@homeez.com' . "\r\n" .
		    			'X-Mailer: PHP/' . phpversion() . "\r\n" .
		    			'MIME-Version: 1.0' . "\r\n" .
		    			'Content-Type: text/html; charset=ISO-8859-1\r\n';
		    
		    	mail($to, $subject, $message, $headers);
		    		
		    }
		    //redirect to confirmation alert
			return Redirect::route('login-page')->with("emailfirst", "1");

		} else {

			return Redirect::route('register-page')->withInput()->withErrors($v);

		}
	}
	
	public function postRegisterSupplier()
	{
		if(Auth::check()) {
			return Redirect::route('admin-page');
		}
	
		$input = Input::all();
	
		$rules = array('username' => 'required|unique:users', 'email' => 'required|unique:users|email', 'password' => 'required|confirmed');
	
		$v = Validator::make($input, $rules);
	
		//GENERATE $newcode - RANDOM STRING TO VERIFY SIGNUP
		for($code_length = 25, $newcode = ''; strlen($newcode) < $code_length; $newcode .= chr(!rand(0, 2) ? rand(48, 57) : (!rand(0, 1) ? rand(65, 90) : rand(97, 122))));
	
		if($v->passes())
		{
			$password = $input['password'];
			$password = Hash::make($password);
			$role = 2; 
			
			$user = new User();
			$user->username = $input['username'];
			$user->email = $input['email'];
			$user->password = $password;
			$user->phone_number = $input['phone_number'];
			$user->area = $input['area'];
			$user->city = $input['city'];
			$user->confirmation = $newcode;
			$user->role = $role;
			$user->save();
	
			//Send confirmation email
			$data = array (
					'email'     => $input['email'],
					'clickUrl'  => URL::to('/') . '/confirm/' . $newcode
			);
			 
			//---new send email----//
			try {
				Mail::send('emails.signup', $data, function($message)
				{
					$message->to(Input::get('email'))->subject('Welcome');
				});
	
			}
			catch (Exception $e){
				$to      = Input::get('email');
				$subject = 'Welcome';
				$message = View::make('emails.signup', $data)->render();
				$headers = 'From: admin@homeez.com' . "\r\n" .
						'Reply-To: admin@homeez.com' . "\r\n" .
						'X-Mailer: PHP/' . phpversion() . "\r\n" .
						'MIME-Version: 1.0' . "\r\n" .
						'Content-Type: text/html; charset=ISO-8859-1\r\n';
	
				mail($to, $subject, $message, $headers);
	
			}
			//redirect to confirmation alert
			return Redirect::route('login-supplier-page')->with("emailfirst", "1");
	
		} else {
	
			return Redirect::route('register-supplier-page')->withInput()->withErrors($v);
	
		}
	}

	public function confirm( $id_code )
	{

	    if ( $user_info = User::where('email_confirm', '=', $id_code)->first() )
	    {

	        $uid    = $user_info->id;
	        $email  = $user_info->email;

	        $data = array(
	            'email_confirm'   => $id_code,
	            'user_id'   => $uid,
	            'email'     => $email
	        );

	        $user   = User::find($uid);
	        $user->email_confirm = '';
	        $user->save();

	        Auth::login( User::find($uid) );

	        return Redirect::route('login-page')->with("confirmed", "1");

	    } else {

	        return Redirect::route('login-page')->with("confirmed", "0");

	    }

	}

	public function getForgetpass() {
		return View::make('home.forgetpass');
	}

	
	public function postForgetpass() {
		$input = Input::all();

		$rules = array('email' => 'required|email|exists:users,email');

		$v = Validator::make($input, $rules);

		//GENERATE $newcode - RANDOM STRING TO VERIFY SIGNUP
		for($code_length = 25, $newcode = ''; strlen($newcode) < $code_length; $newcode .= chr(!rand(0, 2) ? rand(48, 57) : (!rand(0, 1) ? rand(65, 90) : rand(97, 122))));

		if($v->passes())
		{

	        $user   = User::where('email', '=', $input['email'])->first();
			$user->pass_reset = $newcode;
			$user->save();

			//Send confirmation email
		    $data = array(
		        'email'     => $input['email'],
		        'clickUrl'  => URL::to('/') . '/changepass/' . $newcode
		    );
		    
		  
			//---new send email----//
		    try {
		    	Mail::send('emails.changepass', $data, function($message)
		    	{
		    		$message->to(Input::get('email'))->subject('Change password');
		    	});
		    
		    }
		    catch (Exception $e){
		    	$to      = Input::get('email');
				$subject = 'Change password';
				$message = View::make('emails.changepass', $data)->render();
		    	$headers = 'From: admin@homeez.com' . "\r\n" .
		    			'Reply-To: admin@homeez.com' . "\r\n" .
		    			'X-Mailer: PHP/' . phpversion() . "\r\n" .
		    			'MIME-Version: 1.0' . "\r\n" .
		    			'Content-Type: text/html; charset=ISO-8859-1\r\n';
				
				mail($to, $subject, $message, $headers);
			
		    }
		    //redirect to changepass alert
			return Redirect::route('restore-page')->withErrors($v)->with("changepass", "0");

		} else {

			return Redirect::route('restore-page')->withErrors($v);

		}
	}

	public function changepass( $id_code )
	{

	    if ( $user = User::where('pass_reset', '=', $id_code)->first() )
	    {
	    	for($code_length = 11, $newcode = ''; strlen($newcode) < $code_length; $newcode .= chr(!rand(0, 2) ? rand(48, 57) : (!rand(0, 1) ? rand(65, 90) : rand(97, 122))));
	        
	        $data = array(
	        	'email'		=> $user->email,
	            'username'  => $user->username,
	            'password'	=> $newcode
	        );

	        $user->pass_reset = '';
	        $user->password = Hash::make($newcode);
	        $user->save();

		    
		    //---new send email----//
		    try {
		    	Mail::send('emails.newpass', $data, function($message) use ($data)
			    {
			        $message->to($data['email'])->subject('Your new password');
			    });
		    
		    }
		    catch (Exception $e){
		    	$to      = $data['email'];
		    	$subject = 'Your new password';
		    	$message = View::make('emails.newpass', $data)->render();
		    	$headers = 'From: admin@homeez.com' . "\r\n" .
		    			'Reply-To: admin@homeez.com' . "\r\n" .
		    			'X-Mailer: PHP/' . phpversion() . "\r\n" .
		    			'MIME-Version: 1.0' . "\r\n" .
		    			'Content-Type: text/html; charset=ISO-8859-1\r\n';
		    
		    	mail($to, $subject, $message, $headers);
		    
		    }
		    
	        return Redirect::to('login')->with("changepass", "1");

	    } else {

	        return Redirect::to('/');

	    }

	}

	public function logout()
	{
		Auth::logout();
		Session::put('facebook-login-session', false);
		$fauth = new Hybrid_Auth(app_path().'/config/fb_auth.php');
		$fauth->logoutAllProviders();
		$fauth = new Hybrid_Auth(app_path().'/config/google_auth.php');
		$fauth->logoutAllProviders();
		$fauth = new Hybrid_Auth(app_path().'/config/twitterAuth.php');
		$fauth->logoutAllProviders();
		return Redirect::route('login-page');
	}

	public function getPassrequest() {
		$user = Auth::user();

		if($user) {
	    	for($code_length = 11, $newcode = ''; strlen($newcode) < $code_length; $newcode .= chr(!rand(0, 2) ? rand(48, 57) : (!rand(0, 1) ? rand(65, 90) : rand(97, 122))));
	        
	        $user   = User::where('email', '=', $user->email)->first();
			$user->pass_reset = $newcode;
			$user->save();

			//Send confirmation email
		    $data = array(
		        'email'     => $user->email,
		        'clickUrl'  => URL::to('/') . '/dashboard/profile/passchange/' . $newcode
		    );
		    
		  
		    
		    try {
		    	  Mail::send('emails.changepassrequest', $data, function($message) use ($user){
			         $message->to($user->email)->subject('Change password');
				  });
		    } catch (Exception $e){
		    	$to      = $data['email'];
		    	$subject = 'Change password';
		    	$message = View::make('emails.changepassrequest', $data)->render();
		    	$headers = 'From: admin@homeez.com' . "\r\n" .
		    			'Reply-To: admin@homeez.com' . "\r\n" .
		    			'X-Mailer: PHP/' . phpversion() . "\r\n" .
		    			'MIME-Version: 1.0' . "\r\n" .
		    			'Content-Type: text/html; charset=ISO-8859-1\r\n';
		    
		    	mail($to, $subject, $message, $headers);
		    
		    }

	        return Redirect::back()->with("changepassrequest", "1");
		}	
		else {
			return Redirect::to('/');
		}
	}

	public function getPassChange() {
		return View::make('home.changepass');
	}

	public function postPassChange($id_code) {
		$input = Input::all();

		$rules = array('password' => 'required|confirmed');

		$v = Validator::make($input, $rules);

		if($v->passes()) {
			$user = User::where('pass_reset', '=', $id_code)->first();
			$user->password = Hash::make($input['password']);
			$user->pass_reset = "";
			$user->save();
			return Redirect::to('dashboard');
		}
		return Redirect::back()->withErrors($v);

	}	

	public function get404() {
		return View::make('home.filenotfound');
	}

	public function getUser($user_id)
	{
		if(!is_numeric($user_id) || $user_id == "") {
			return Redirect::to('/filenotfound');
		}

		$user = User::where('id', '=', $user_id)->first();
		
		if(!$user) {
			return Redirect::to('/filenotfound');
		}

		return View::make('home.user')->with("user", $user);
	}
	
	public function postTask()
	{	
		
		
		return View::make('pages.home');
	
	}
	
	
	
	public function getGooglemap()
	{
		return View::make('pages.googlemap');
	}
	
	public function postGooglemap()
	{
	
		
				return Redirect::route('login-page')->with("success", "0");
			
		
	}
	
	
	

}