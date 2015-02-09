<?php

class BaseController extends Controller {

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
			return Redirect::route('landing-page');
			
		}
		
		return View::make('pages.login');
	}
	
	public function postLogin()
	{
	
		$input = Input::all();
	
		$rules = array('email' => 'required', 'password' => 'required');
	
		$v = Validator::make($input, $rules);
	
		if($v->fails())
		{
	
			return Redirect::to('login')->withErrors($v);
	
		} else {
	
			$credentials = array('email' => $input['email'], 'password' => $input['password'], 'email_confirm' => '');
	
			$remember_me = (isset($input['remember_me'])) ? true : false;
	
			if(Auth::attempt($credentials, true))
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
	
				return Redirect::to('login')->with("success", "0");
			}
		}
	}
	
	
	
	public function getRegister()
	{  	if (Session::has('phone_code')){
			Session::forget('phone_code');
		}
		if(Auth::check()) {
			return Redirect::route('landing-page');
		}
		return View::make('pages.register');
	}
	
	public function postRegister()
	{   
		if(Auth::check()) {
			return Redirect::route('landing-page');
		}
	
		$input = Input::all();
	
			    
		//$rules = array('username' => 'required|unique:users', 'email' => 'required|unique:users|email');
		$rules = array('username' => 'required|unique:users', 'email' => 'required|unique:users|email','phone_number'  => 'numeric','price'  => 'numeric');
		$v = Validator::make($input, $rules);
			//----send sms----//
			for($code_length = 5, $newcode_phone = ''; strlen($newcode_phone) < $code_length; $newcode_phone .= chr(!rand(0, 2) ? rand(48, 57) : (!rand(0, 1) ? rand(65, 90) : rand(97, 122))));
			//$number = Input::get('phoneNumber');
			$newcode_phone = strtoupper($newcode_phone);
			$message = $newcode_phone ;//Input::get('message');
			//$to_phone_number = Input::get('phone_number');
			//$to_phone_number = '+84937163522';
			$country_phone_code = $input['country_code'];
			$to_phone_number = $input['phone_number'];
			$regex = "/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i";
			
			if (!preg_match( $regex, $to_phone_number )) {
				return Redirect::to('register')->with("is_phone_number", "0");
			}
			$to_phone_number = substr($to_phone_number, 1);
			$to_phone_number =  $country_phone_code.$to_phone_number;
			// Create an authenticated client for the Twilio API
			/*$client = new Services_Twilio('AC3f7525a996d50d183bd224359c325c6f', '58ac53caa01777973e2931776a61a8f9');
			$to_phone_number = '+15005550006';
			// Use the Twilio REST API client to send a text message
			$m = $client->account->messages->sendMessage(
					'+15005550006', // the text will be sent from your Twilio number
					$to_phone_number, // the phone number the text will be sent to
					$message // the body of the text message
			); echo $m; die;*/
			$sid = 'AC3f7525a996d50d183bd224359c325c6f';
			$token = "58ac53caa01777973e2931776a61a8f9"; 
			$client = new Services_Twilio($sid, $token);
			$sms = $client->account->sms_messages->create("+15005550006", "+14108675309", $newcode_phone, array());

			//----------------//
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
			$user->phone_number = $to_phone_number;
			$user->email_confirm = $newcode;
			$user->phone_confirm = $newcode_phone;
			$user->role = '0';
			$user->save();
				
			$userpostjob = User::where('id', '=', $user->id)->first();
			$job = new Job();
			$job->tittle = $input['tittle'];
			$job->description = $input['description'];
			$job->price = $input['price'];
			$job->timeoption = $input['timeoption'];
			
			$job->date = $input['date'];
			$job->local = $input['local'];
			$job->lat = $input['lat'];
			$job->lng = $input['lng'];
			$job->user_id = $userpostjob->id;
			$job->status = 'openjob';
			$job->category = $input['category'];
			$job->save();
			//Session::put('job_id', $job->id);Session::get('job_id');
			//Send confirmation email
			$data = array(
					'email'     => $input['email'],
					'clickUrl'  => URL::to('/') . '/redirectpconfirm/' . $newcode
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
				$headers = 'From: admin@landlordrepairs.uk' . "\r\n" .
						'Reply-To: admin@landlordrepairs.uk' . "\r\n" .
						'X-Mailer: PHP/' . phpversion() . "\r\n" .
						'MIME-Version: 1.0' . "\r\n" .
						'Content-Type: text/html; charset=ISO-8859-1\r\n';
	
				mail($to, $subject, $message, $headers);
	
			}
			//redirect to confirmation alert
			Session::put('phone_code', $newcode_phone);
			return Redirect::to('login')->with("emailfirst", "1");
	
		} else {
	
			return Redirect::to('register')->withInput()->withErrors($v);
	
		}
	}
	public function getPhoneconfirm()
	{
		if(Auth::check()) {
			return View::make('pages.phoneconfirm');
		}
		return Redirect::route('landing-page');
	}
	
	public function postPhoneconfirm()
	{
		
		$input = Input::all();
		$user = User::where('id', '=', Auth::user()->id)->first();
		
		
		if ($user->phone_confirm == strtoupper($input['phoneconfirm'])){
			//clear phone_confirm
			
			return Redirect::to('phoneconfirm')->with("phone_confirm", "0");
		} else { 
			return Redirect::to('phoneconfirm')->with("phone_confirm", "1");
		}
		
			//redirect to confirmation alert
			
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
	
			//Auth::login( User::find($uid) );
	
			return Redirect::to('phoneconfirm')->with("phone_confirm", "1");
	
		} else {
	
			return Redirect::to('login')->with("phone_confirm", "0");
	
		}
	
	}
	
	public function getForgetpass() {
		return View::make('pages.forgetpass');
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
				$headers = 'From: admin@landlordrepairs.uk' . "\r\n" .
						'Reply-To: admin@landlordrepairs.uk' . "\r\n" .
						'X-Mailer: PHP/' . phpversion() . "\r\n" .
						'MIME-Version: 1.0' . "\r\n" .
						'Content-Type: text/html; charset=ISO-8859-1\r\n';
	
				mail($to, $subject, $message, $headers);
					
			}
			//redirect to changepass alert
			return Redirect::to('forgetpass')->withErrors($v)->with("changepass", "0");
	
		} else {
	
			return Redirect::to('forgetpass')->withErrors($v);
	
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
				$headers = 'From: admin@landlordrepairs.uk' . "\r\n" .
						'Reply-To: admin@landlordrepairs.uk' . "\r\n" .
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
		return Redirect::to('login');
	}
	
	public function getPostjob()
	{
		if(Auth::check()) {
			return Redirect::to('register');
		}
		return View::make('home.postjob');
	}
	public function postPostjob()
	{
		$input = Input::all(); 
		$userpostjob = User::where('id', '=', Auth::user()->id)->first();
		$job = new Job();
		$job->tittle = $input['tittle'];
		$job->description = $input['description'];
		$job->price = $input['price'];
		$job->timeoption = $input['timeoption'];
		
		$job->date = $input['date'];
		$job->local = $input['local'];
		$job->lat = $input['lat'];
		$job->lng = $input['lng'];
		
		$job->user_id = $userpostjob->id;
		$job->status = 'openjob';
		$job->category = $input['category'];
		$job->save();
		return View::make('pages.postjob');
	}
	//------------------------test-------------------
	public function redirectpconfirm( $id_code )
	{
	if ( $user_info = User::where('email_confirm', '=', $id_code)->first() )
		{   Session::put('id_code', $id_code);//Session::get('job_id');
			return Redirect::to('pconfirm')->with("phone_confirm", "1");
	
		} else {
			return Redirect::to('pconfirm')->with("phone_confirm", "0");
	
		}
	
	}
	
	public function getpconfirm()
	{
	return View::make('pages.pconfirm');
	
	}
	
	public function postpconfirm()
	{ 
		$input = Input::all();
		$id_code = Session::get('id_code');
		$phoneconfirm = strtoupper($input['phoneconfirm']);
		if ($id_code != null) {
			if ( $user = User::where('email_confirm', '=', $id_code)->first() )
			{
				//var_dump ($user->phone_confirm);die;
				if ($user->phone_confirm == $phoneconfirm ) {
					Session::forget('id_code');
					$user->phone_confirm = '';
					$user->email_confirm = '';
					$user->save();
					return Redirect::to('login')->with("confirmed", "1");
				} else {
				 	return Redirect::to('pconfirm')->with("phone_confirm", "0");
				}
				
	
			} else {
				return Redirect::to('pconfirm')->with("phone_confirm", "0");
			}
		} else {
			return Redirect::to('pconfirm')->with("phone_confirm", "0");
		}
	}
	
	
	

}



