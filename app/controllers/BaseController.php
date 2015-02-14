<?php

class BaseController extends Controller {

	public function __construct()
	{
	
	}
	
	public function getIndex()
		
	{  	$private = "sk_test_gdKc5TYgUWYr7ey4rpeUbE9b";
		Stripe::setApiKey($private);
		var_dump (Stripe::getApiKey());die;
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
			$to_phone_number = $input['phone_number'];
			$regex = "/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i";
			
			if (!preg_match( $regex, $to_phone_number )) {
				return Redirect::to('register')->with("is_phone_number", "0");
			}
			
			// Create an authenticated client for the Twilio API
			/*$client = new Services_Twilio('AC3f7525a996d50d183bd224359c325c6f', '58ac53caa01777973e2931776a61a8f9');
			$to_phone_number = '+15005550006';
			// Use the Twilio REST API client to send a text message
			$m = $client->account->messages->sendMessage(
					'+15005550006', // the text will be sent from your Twilio number
					$to_phone_number, // the phone number the text will be sent to
					$message // the body of the text message
			); echo $m; die;*/
			$sid = 'AC461fe2ea8ef7e0a8a864bb3a982142f7';
			$token = "d94d47547950d199f065f365a51111a4"; 
			$client = new Services_Twilio($sid, $token);
			//$sms = $client->account->sms_messages->create("+15005550006", "+14108675309", $newcode_phone, array());
			$client->account->messages->sendMessage(
					'+441544430006', // the text will be sent from your Twilio number
					$to_phone_number, // the phone number the text will be sent to
					$message // the body of the text message
			);
			//----------------//
			
			// Get the PHP helper library from twilio.com/docs/php/install
	
			 
			// Your Account Sid and Auth Token from twilio.com/user/account
			
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
			$job->local_code = $input['local_code'];
			$job->lat = $input['lat'];
			$job->lng = $input['lng'];
			$job->user_id = $userpostjob->id;
			$job->status = 'openjob';
			$job->property = $input['property'];
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
		$rules = array('price'  => 'numeric');
	
		$v = Validator::make($input, $rules);
		if($v->passes())
		{
	
			$userpostjob = User::where('id', '=', Auth::user()->id)->first();
			$job = new Job();
			$job->tittle = $input['tittle'];
			$job->description = $input['description'];
			$job->price = $input['price'];
			$job->timeoption = $input['timeoption'];
			
			$job->date = $input['date'];
			$job->local = $input['local'];
			$job->local_code = $input['local_code'];
			$job->lat = $input['lat'];
			$job->lng = $input['lng'];
			
			$job->user_id = $userpostjob->id;
			$job->status = 'openjob';
			$job->property = $input['property'];
			$job->category = $input['category'];
			$job->save();
			//make return the list of builder
			//------select list builders from DB:: where matching the condition with Input::----//
			$builders = DB::table('builders')->having('category', '=',$input['category'] )->get();
			//calculate the radius:
			function get_distance_between_points($latitude1, $longitude1, $latitude2, $longitude2) {
			    $theta = $longitude1 - $longitude2;
			    $miles = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta)));
			    $miles = acos($miles);
			    $miles = rad2deg($miles);
			    $miles = $miles * 60 * 1.1515;
			    
			    return $miles;
			}
			$array_radius = array();
		    foreach( $builders as $builder ) {
		  			
			$array_radius[$builder->id] = get_distance_between_points($input['lat'], $input['lng'], $builder->lat, $builder->lng);
		    } 
	
			//------------------------------//
			return View::make('pages.listbuilders')->with(array('builders' =>$builders,'array_radius' => $array_radius, 'category' =>$input['category'])) ;
			//--------------------------------//
			return Redirect::to('postjob')->with("success", "1");
		} else {
			return Redirect::to('postjob')->withErrors($v);
		}
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
	
	public function getDelete_account()
	{
		
			return View::make('pages.delete_account');
	
	
	}
	
	public function postDelete_account()
	{
		
		$input = Input::all();
		$email = $input['email'];
		$user = User::where('email', '=',$email)->first();
		if ($user != null){
			DB::table('users')->where('email', '=', $email)->delete();
			return Redirect::to('delete_account')->with("delete_account", "1");
		} else {
			return Redirect::to('delete_account')->with("delete_account", "0");
		}
		
	}
	

	
	public function postTest()
	{
		print_r(Input::all());
		
	
		
		$amount = Input::get('amount');
		
		Stripe::setApiKey("sk_test_gdKc5TYgUWYr7ey4rpeUbE9b");

		// Get the credit card details submitted by the form
		$token = $_POST['stripeToken'];
		
		// Create the charge on Stripe's servers - this will charge the user's card
		try {
		$charge = Stripe_Charge::create(array(
		  "amount" => $amount, // amount in cents, again
		  "currency" => "usd",
		  "card" => $token,
		  "description" => "payinguser@example.com")
		);
		} catch(Stripe_CardError $e) {
		  // The card has been declined
		}
		
	}
	
	
	public function getRegisterBuilder()
	{  	
		/*if(Auth::check()) {
			return Redirect::route('landing-page');
		}*/
		return View::make('pages.register-builder');
	}
	
	public function postRegisterBuilder()
	{   
		/*if(Auth::check()) {
			return Redirect::route('landing-page');
		}*/
	
		$input = Input::all();
	
			    
		//$rules = array('username' => 'required|unique:users', 'email' => 'required|unique:users|email');
		$rules = array('username' => 'required|unique:builders', 'email' => 'required|unique:builders|email','phone_number'  => 'numeric');
		$v = Validator::make($input, $rules);
			//----send sms----//
			for($code_length = 5, $newcode_phone = ''; strlen($newcode_phone) < $code_length; $newcode_phone .= chr(!rand(0, 2) ? rand(48, 57) : (!rand(0, 1) ? rand(65, 90) : rand(97, 122))));
			//$number = Input::get('phoneNumber');
			$newcode_phone = strtoupper($newcode_phone);
			$message = $newcode_phone ;//Input::get('message');
			//$to_phone_number = Input::get('phone_number');
			//$to_phone_number = '+84937163522';
			$to_phone_number = $input['phone_number'];
			$regex = "/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i";
			
			if (!preg_match( $regex, $to_phone_number )) {
				return Redirect::to('register-builder')->with("is_phone_number", "0");
			}
			//$to_phone_number = substr($to_phone_number, 1);
			//$to_phone_number =  "+44".$to_phone_number;
			// Create an authenticated client for the Twilio API
			/*$client = new Services_Twilio('AC3f7525a996d50d183bd224359c325c6f', '58ac53caa01777973e2931776a61a8f9');
			$to_phone_number = '+15005550006';
			// Use the Twilio REST API client to send a text message
			$m = $client->account->messages->sendMessage(
					'+15005550006', // the text will be sent from your Twilio number
					$to_phone_number, // the phone number the text will be sent to
					$message // the body of the text message
			); echo $m; die;*/
			$sid = 'AC461fe2ea8ef7e0a8a864bb3a982142f7';
			$token = "d94d47547950d199f065f365a51111a4"; 
			$client = new Services_Twilio($sid, $token);
			//$sms = $client->account->sms_messages->create("+15005550006", "+14108675309", $newcode_phone, array());
			$client->account->messages->sendMessage(
					'+441544430006', // the text will be sent from your Twilio number
					$to_phone_number, // the phone number the text will be sent to
					$message // the body of the text message
			);
			//----------------//
			
			// Get the PHP helper library from twilio.com/docs/php/install
	
			 
			// Your Account Sid and Auth Token from twilio.com/user/account
			
		//GENERATE $newcode - RANDOM STRING TO VERIFY SIGNUP
		for($code_length = 25, $newcode = ''; strlen($newcode) < $code_length; $newcode .= chr(!rand(0, 2) ? rand(48, 57) : (!rand(0, 1) ? rand(65, 90) : rand(97, 122))));
		 
		
		if($v->passes())
		{	
			$password = $input['password'];
			$password = Hash::make($password);
	
			$builder = new Builder();
			$builder->username = $input['username'];
			$builder->email = $input['email'];
			$builder->password = $password;
			$builder->phone_number = $to_phone_number;
			$builder->email_confirm = $newcode;
			$builder->phone_confirm = $newcode_phone;
			$builder->role = '0';
			$builder->tittle = $input['tittle'];
			$builder->local = $input['local'];
			$builder->local_code = $input['local_code'];
			$builder->lat = $input['lat'];
			$builder->lng = $input['lng'];
			$builder->category = $input['category'];
			$builder->save();

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
	
			return Redirect::to('register-builder')->withInput()->withErrors($v);
	
		}
	}
	
	public function getListbuilders() {
		return Redirect::to('postjob');
	} 
	
	public function postListbuilders() 
	{
		$input = Input::all();
		$check_builders = Input::get('check_builders');
		//var_dump($check_builders); die;
		$builders = DB::table('builders')->having('category', '=',$input['category'] )->get();
		$num_of_checked_builders = count($check_builders);	
			
		//select builders matching condition from submit post_jobs.
		//check number of checked builder
		$array_builder_id = array();
	    foreach( $builders as $builder ) {
	    	array_push($array_builder_id, $builder->id);
    		/*if (isset($check_builders[0])) {
    			if ($check_builders[0] == $builder->id) {
    				array_push($array_builder_id, $builder->id);
    			}
    		}
	    	if (isset($check_builders[1])) {
    			if ($check_builders[1] == $builder->id) {
    				array_push($array_builder_id, $builder->id);
    			}
    		}
	    	if (isset($check_builders[2])) {
    			if ($check_builders[2] == $builder->id) {
    				array_push($array_builder_id, $builder->id);
    			}
    		}*/
	    }
	     
	    if (count($builders) <= "3") { //sent invite to all Builders in list $array_builder_id
	    	
	    	foreach( $builders as $builder ) {
				//echo $array_builder_id[$key];
				//var_dump ($builders[$array_builder_id[$key]]->email); die;
				//sent email to invite
				//add to my invite
				//$array_id = array_rand($array_builder_id,3); ;
				//$builders_invite = DB::table('builders')->having('id', '=',$key )->get();
				
			    try {
					Mail::send('emails.newpass', $data, function($message) use ($data)
					{
						$message->to($builder->email)->subject('Invite from Users');
					});
		
				}
				catch (Exception $e){
					$to      = $builder->email;
					$subject = 'Invite from Users';
					$message = "update soon";
					$headers = 'From: admin@landlordrepairs.uk' . "\r\n" .
							'Reply-To: admin@landlordrepairs.uk' . "\r\n" .
							'X-Mailer: PHP/' . phpversion() . "\r\n" .
							'MIME-Version: 1.0' . "\r\n" .
							'Content-Type: text/html; charset=ISO-8859-1\r\n';
		
					mail($to, $subject, $message, $headers);
		
				} 
				
			}

			
			
	    } else {
	    	$array_id = array();
	    	
		    switch ($num_of_checked_builders) {
			    case '0':
				    //select random 3 elements from $array_builder_id;
				    //$array_id_sent_invite = array_rand($array_builder_id,3);
				  
					$array_id_sent_invite = array_rand($array_builder_id, 3);
				    //var_dump($array_builder_id[$array_id_sent_invite[2]]); die;
				    
				    for ($x = 0; $x <= 2; $x++) {
				    	$builders = DB::table('builders')->having('id', '=',$array_builder_id[$array_id_sent_invite[$x]])->get();
					//echo $builders[0]->email; die;
				    	try {
							Mail::send('emails.newpass', $data, function($message) use ($data)
							{
								$message->to($builders[$x]->email)->subject('Invite from Users');
							});
				
						}
						catch (Exception $e){
							$to      = $builders[0]->email;
							$subject = 'Invite from Users';
							$message = "update soon";
							$headers = 'From: admin@landlordrepairs.uk' . "\r\n" .
									'Reply-To: admin@landlordrepairs.uk' . "\r\n" .
									'X-Mailer: PHP/' . phpversion() . "\r\n" .
									'MIME-Version: 1.0' . "\r\n" .
									'Content-Type: text/html; charset=ISO-8859-1\r\n';
				
							mail($to, $subject, $message, $headers);
				
						} 
					} 
			        break;
			        
			        
			    case '1':
			    	//send mail to check
			    	$array_id_sent_invite = array();
			    	$array_id_sent_invite[0] = $check_builders[0];
			    	$array_id_sent_invite_random = array_rand($array_builder_id, 2);
			    	$array_id_sent_invite[1] = $array_builder_id[$array_id_sent_invite_random[0]];
			    	$array_id_sent_invite[2] = $array_builder_id[$array_id_sent_invite_random[1]];
			    	//var_dump($array_id_sent_invite); die;
			    	// send 2 email random
			    	
			    	for ($x = 0; $x <= 2; $x++) {
				    	$builders = DB::table('builders')->having('id', '=',$array_id_sent_invite[$x])->get();
					//echo $builders[0]->email; die;
				    	try {
							Mail::send('emails.newpass', $data, function($message) use ($data)
							{
								$message->to($builders[0]->email)->subject('Invite from Users');
							});
				
						}
						catch (Exception $e){
							$to      = $builders[0]->email;
							$subject = 'Invite from Users';
							$message = "update soon";
							$headers = 'From: admin@landlordrepairs.uk' . "\r\n" .
									'Reply-To: admin@landlordrepairs.uk' . "\r\n" .
									'X-Mailer: PHP/' . phpversion() . "\r\n" .
									'MIME-Version: 1.0' . "\r\n" .
									'Content-Type: text/html; charset=ISO-8859-1\r\n';
				
							mail($to, $subject, $message, $headers);
				
						} 
					} 
						
					
			        break;
			    case '2':
			    	//send mail to check
			    	//send mail to check
			    	$array_id_sent_invite = array();
			    	$array_id_sent_invite[0] = $check_builders[0];
			    	$array_id_sent_invite[1] = $check_builders[1];
			    	$array_id_sent_invite_random = array_rand($array_builder_id, 2);
			    	$array_id_sent_invite[2] = $array_builder_id[$array_id_sent_invite_random[0]];
			    	
			    	//var_dump($array_id_sent_invite); die;
			    	// send 2 email random
			    	
			    	for ($x = 0; $x <= 2; $x++) {
				    	$builders = DB::table('builders')->having('id', '=',$array_id_sent_invite[$x])->get();
					//echo $builders[0]->email; die;
				    	try {
							Mail::send('emails.newpass', $data, function($message) use ($data)
							{
								$message->to($builders[0]->email)->subject('Invite from Users');
							});
				
						}
						catch (Exception $e){
							$to      = $builders[0]->email;
							$subject = 'Invite from Users';
							$message = "update soon";
							$headers = 'From: admin@landlordrepairs.uk' . "\r\n" .
									'Reply-To: admin@landlordrepairs.uk' . "\r\n" .
									'X-Mailer: PHP/' . phpversion() . "\r\n" .
									'MIME-Version: 1.0' . "\r\n" .
									'Content-Type: text/html; charset=ISO-8859-1\r\n';
				
							mail($to, $subject, $message, $headers);
				
						} 
					} 
						
			        break;
			        
			        
		        case '3':
			    	for ($x = 0; $x <= 2; $x++) {
				    	$builders = DB::table('builders')->having('id', '=',$check_builders[$x])->get();
					//echo $builders[0]->email; die;
				    	try {
							Mail::send('emails.newpass', $data, function($message) use ($data)
							{
								$message->to($builders[0]->email)->subject('Invite from Users');
							});
				
						}
						catch (Exception $e){
							$to      = $builders[0]->email;
							$subject = 'Invite from Users';
							$message = "update soon";
							$headers = 'From: admin@landlordrepairs.uk' . "\r\n" .
									'Reply-To: admin@landlordrepairs.uk' . "\r\n" .
									'X-Mailer: PHP/' . phpversion() . "\r\n" .
									'MIME-Version: 1.0' . "\r\n" .
									'Content-Type: text/html; charset=ISO-8859-1\r\n';
				
							mail($to, $subject, $message, $headers);
				
						} 
					} 
		        	 break;
			    default:
			    	
			        return View::make('pages.register');
			}
			return View::make('pages.register');
	    }
		return View::make('pages.register');
	}
			
		
	
public function getLoginBuilder()
	{
		if(Auth::check()) {
			return Redirect::route('landing-page');
			
		}
		
		return View::make('pages.login-builder');
	}
	
	public function postLoginBuilder()
	{
	
		
	}
	
	//-----------USER DASHBOARD------------//
	public function getProfile()
	{
		if(Auth::check()) {
			$user = Auth::user();
			return View::make('user_dashboard.dashboard')->with('user', $user);
		}
		return Redirect::to('register');

	}
	
	
	public function postChangeUserProfile()
	{
		$input = Input::all();
		$rules = array('email' => 'required|email|exists:users,email');
		//var_dump($input['email'] ); die	;	
		$v = Validator::make($input, $rules);
		if($v->passes())
		{
			$user = Auth::user();
			if ($user->username != $input['username'] ) {
				$user->username = $input['username'];
 			}
			if ($user->email != $input['email']) {
				$user->email = $input['email'];
				/*for($code_length = 25, $newcode_phone = ''; strlen($newcode_phone) < $code_length; $newcode_phone .= chr(!rand(0, 2) ? rand(48, 57) : (!rand(0, 1) ? rand(65, 90) : rand(97, 122))));
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
				$headers = 'From: admin@landlordrepairs.uk' . "\r\n" .
						'Reply-To: admin@landlordrepairs.uk' . "\r\n" .
						'X-Mailer: PHP/' . phpversion() . "\r\n" .
						'MIME-Version: 1.0' . "\r\n" .
						'Content-Type: text/html; charset=ISO-8859-1\r\n';
	
				mail($to, $subject, $message, $headers);
	
			}*/
	
				
			}
			$user->save();
			return Redirect::to('profile')->with('success', '1');	
		} else {
			return Redirect::to('profile')->withInput()->withErrors($v);	
		}
	}
	
	public function postChangePassword()
	{
		$input = Input::all();
		$user = Auth::user();
		$password = $input['password'];
		$password = Hash::make($password);
		$user->password = $password; 
		$user->save();
		return Redirect::to('profile')->with('cpsuccess', '1');
	}
	
	public function postChangePhoneNumber()
	{
		$input = Input::all();
		$user = Auth::user();
		//echo Auth::user()->email; die;
		$phonenumber = $input['phonenumber']; 
		
		//----send sms----//
			for($code_length = 5, $newcode_phone = ''; strlen($newcode_phone) < $code_length; $newcode_phone .= chr(!rand(0, 2) ? rand(48, 57) : (!rand(0, 1) ? rand(65, 90) : rand(97, 122))));
			//$number = Input::get('phoneNumber');
			$newcode_phone = strtoupper($newcode_phone);
			$message = $newcode_phone ;//Input::get('message');
			//$to_phone_number = Input::get('phone_number');
			//$to_phone_number = '+84937163522';
			//$to_phone_number = $input['phone_number'];
			$regex = "/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i";
			
			if (!preg_match( $regex, $phonenumber )) {
				return Redirect::to('register-builder')->with("is_phone_number", "0");
			}
			//$to_phone_number = substr($to_phone_number, 1);
			//$to_phone_number =  "+44".$to_phone_number;
			// Create an authenticated client for the Twilio API
			/*$client = new Services_Twilio('AC3f7525a996d50d183bd224359c325c6f', '58ac53caa01777973e2931776a61a8f9');
			$to_phone_number = '+15005550006';
			// Use the Twilio REST API client to send a text message
			$m = $client->account->messages->sendMessage(
					'+15005550006', // the text will be sent from your Twilio number
					$to_phone_number, // the phone number the text will be sent to
					$message // the body of the text message
			); echo $m; die;*/
			$sid = 'AC461fe2ea8ef7e0a8a864bb3a982142f7';
			$token = "d94d47547950d199f065f365a51111a4"; 
			$client = new Services_Twilio($sid, $token);
			//$sms = $client->account->sms_messages->create("+15005550006", "+14108675309", $newcode_phone, array());
			$client->account->messages->sendMessage(
					'+441544430006', // the text will be sent from your Twilio number
					$phonenumber, // the phone number the text will be sent to
					$message // the body of the text message
			);
			//----------------//
			for($code_length = 25, $newcode = ''; strlen($newcode) < $code_length; $newcode .= chr(!rand(0, 2) ? rand(48, 57) : (!rand(0, 1) ? rand(65, 90) : rand(97, 122))));
			//Send confirmation email
			$data = array(
					'email'     => Auth::user()->email,
					'clickUrl'  => URL::to('/') . '/redirectpconfirm/' . $newcode
			);
			 
			//---new send email----//
			try {
				Mail::send('emails.signup', $data, function($message)
				{
					$message->to(Input::get('email'))->subject('Change Phonenumber');
				});
	
			}
			catch (Exception $e){
				$to      = Auth::user()->email;
				$subject = 'Change Phonenumber';
				$message = View::make('emails.signup', $data)->render();
				$headers = 'From: admin@landlordrepairs.uk' . "\r\n" .
						'Reply-To: admin@landlordrepairs.uk' . "\r\n" .
						'X-Mailer: PHP/' . phpversion() . "\r\n" .
						'MIME-Version: 1.0' . "\r\n" .
						'Content-Type: text/html; charset=ISO-8859-1\r\n';
	
				mail($to, $subject, $message, $headers);
	
			}
			$user->phone_number =$phonenumber;
			$user->email_confirm = $newcode;
			$user->phone_confirm = $newcode_phone; 
			$user->save();
			return Redirect::to('profile')->with('phonesuccess', '1');

	}

}


