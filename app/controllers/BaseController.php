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
				if(Auth::user()->role == '2') {
					return Redirect::route('admin-page');
				}
				else {
					if (Auth::user()->role == '1') {
						return Redirect::to('customer-invited');
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
			
	

        $builders = DB::table('users')->join('extend_builders', 'users.id', '=', 'extend_builders.builder_id')
        ->join('extend_builders_category', 'users.id', '=', 'extend_builders_category.builder_id')
        ->where('extend_builders_category.category', '=', $input['category'])->get();
        
        
		//var_dump($builders); die;
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
			//echo $job->id; die;
			//------------------------------//
			return View::make('pages.listbuilders')->with(array('builders' =>$builders,'array_radius' => $array_radius, 'category' =>$input['category'],'job_id'=> $job->id)) ;
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
	
	public function getListbuilders() {
		return Redirect::to('postjob');
	} 
	
	public function postListbuilders() 
	{
		$input = Input::all();
		$check_builders = Input::get('check_builders');
		$radius = Input::get('radius');
		//var_dump($check_builders); die;
		//$builders = DategB::table('builders')->having('category', '=',$input['category'] )->get();
		$builders = DB::table('users')
			->join('extend_builders_category', 'users.id', '=', 'extend_builders_category.builder_id')
			->where('extend_builders_category.category', '=', $input['category'])
			->get();
		$num_of_checked_builders = count($check_builders);	
			//var_dump ($builders); die;
		//select builders matching condition from submit post_jobs.
		//check number of checked builder
		
	    
	     
	    if (count($builders) <= "3") { //sent invite to all Builders in list $array_builder_id
	    	$i = 0;
	    	foreach( $builders as $builder ) {
				
				
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

				//-----Save to DB::job_process--//
				$job_process = new JobProcess();
				$job_process->job_id = Input::get('job_id');
				$job_process->user_id = Auth::user()->id;
				$job_process->builder_id = $builder->builder_id;
				$job_process->num_invite_sent = count($builders);
				$job_process->status_process = 'inviting';
				$job_process->radius = $radius[$i];
				$job_process->save();
				$i++;
				
			}

			
			
	    } else {
    	$array_builder_id = array();
	    foreach( $builders as $builder ) {
	    	//forgot check survival BUILDERS_CHECKED
	    	if ($num_of_checked_builders == 0){
	    		array_push($array_builder_id, $builder->builder_id);
	    	} else {
	    		if ($num_of_checked_builders == 1) {
	    			if ($builder->builder_id != $check_builders[0]) {
	    				array_push($array_builder_id, $builder->builder_id);
	    			}
	    		} else {
	    			if ($num_of_checked_builders == 2){
		    			if (($builder->builder_id != $check_builders[0]) && ($builder->builder_id != $check_builders[1])) {
		    				array_push($array_builder_id, $builder->builder_id);
		    			}
	    			} else{ //$num_of_checked_builders == 3
	    				if (($builder->builder_id != $check_builders[0]) && ($builder->builder_id != $check_builders[1])&& ($builder->builder_id != $check_builders[2])) {
		    				array_push($array_builder_id, $builder->builder_id);
		    			}
	    			}
	    		}
	    	}
    		
	    }
	    	$array_id = array();
	    	
		    switch ($num_of_checked_builders) {
			    case '0':
				    //select random 3 elements from $array_builder_id;
				    //$array_id_sent_invite = array_rand($array_builder_id,3);
				  
					$array_id_sent_invite = array_rand($array_builder_id, 3);
				    //var_dump($array_builder_id[$array_id_sent_invite[2]]); die;
				    
				    for ($x = 0; $x <= 2; $x++) {
				    	//$builders = DB::table('builders')->having('id', '=',$array_builder_id[$array_id_sent_invite[$x]])->get();
				    	$builders = DB::table('users')->join('extend_builders', 'users.id', '=', 'extend_builders.builder_id')->where('extend_builders.builder_id', '=', $array_builder_id[$array_id_sent_invite[$x]])->get();
					//echo $builders[0]->email; die;
					//echo $builders[0]->email; die;
					$job_process = new JobProcess();
					$job_process->job_id = Input::get('job_id');
					$job_process->user_id = Auth::user()->id;
					$job_process->builder_id = $builders[0]->builder_id;
					$job_process->num_invite_sent = '3';
					$job_process->status_process = 'inviting';
					$job_process->radius = $radius[$x];
					$job_process->save();
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
			        
			        
			    case '1':
			    	//send mail to check
			    	$array_id_sent_invite = array();
			    	$array_id_sent_invite[0] = $check_builders[0];
			    	$array_id_sent_invite_random = array_rand($array_builder_id, 2);
			    	$array_id_sent_invite[1] = $array_builder_id[$array_id_sent_invite_random[0]];
			    	$array_id_sent_invite[2] = $array_builder_id[$array_id_sent_invite_random[1]];
			    	
			    	// send 2 email random
			    	
			    	for ($x = 0; $x <= 2; $x++) {
				    	//$builders = DB::table('builders')->having('id', '=',$array_id_sent_invite[$x])->get();
				    	$builders = DB::table('users')->join('extend_builders', 'users.id', '=', 'extend_builders.builder_id')->where('extend_builders.builder_id', '=', $array_id_sent_invite[$x])->get();
						//var_dump($builders); die;
						//echo $builders[0]->email; die;
					$job_process = new JobProcess();
					$job_process->job_id = Input::get('job_id');
					$job_process->user_id = Auth::user()->id;
					$job_process->builder_id = $builders[0]->builder_id;
					$job_process->status_process = 'inviting';
					$job_process->num_invite_sent = '3';
					$job_process->radius = $radius[$x];
					$job_process->save();
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
				    	//$builders = DB::table('builders')->having('id', '=',$array_id_sent_invite[$x])->get();
				    	$builders = DB::table('users')->join('extend_builders', 'users.id', '=', 'extend_builders.builder_id')->where('extend_builders.builder_id', '=', $array_id_sent_invite[$x])->get();
					
					$job_process = new JobProcess();
					$job_process->job_id = Input::get('job_id');
					$job_process->user_id = Auth::user()->id;
					$job_process->builder_id = $builders[0]->builder_id;
					$job_process->num_invite_sent = '3';
					$job_process->status_process = 'inviting';
					$job_process->radius = $radius[$x];
					$job_process->save();
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
				    	//$builders = DB::table('builders')->having('id', '=',$check_builders[$x])->get();
				    	$builders = DB::table('users')->join('extend_builders', 'users.id', '=', 'extend_builders.builder_id')->where('extend_builders.builder_id', '=', $check_builders[$x])->get();
						//echo $builders[0]->email; die;
						//echo $builders[0]->email; die;
						$job_process = new JobProcess();
						$job_process->job_id = Input::get('job_id');
						$job_process->user_id = Auth::user()->id;
						$job_process->builder_id = $builders[0]->builder_id;
						$job_process->num_invite_sent = '3';
						$job_process->status_process = 'inviting';
						$job_process->radius = $radius[$x];
						$job_process->save();
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
			    	
			        return Redirect::to('myinvites');
			}
			
			//---Save to DB::job_process-------//
			
			return Redirect::to('myinvites');
	    }
		return Redirect::to('myinvites');
	}
			
		
	

	
	//-----------USER DASHBOARD------------//
	public function getProfile()
	{
		if(Auth::check()) {
			$user = Auth::user();
			return View::make('user_dashboard.dashboard')->with('user', $user);
		}
		return Redirect::to('login');

	}
	
	
	public function postChangeUserProfile()
	{   
		$input = Input::all();
		$email_old = $input['email'];
		
		DB::table('users')
			->where('id', '=', Auth::user()->id)
			->update(array(
			'email' => "temp",
			));
			
		$rules = array('email' => 'required|unique:users|email');
		$v = Validator::make($input, $rules);
		if($v->passes()) {
			DB::table('users')
			->where('id', '=', Auth::user()->id)
			->update(array(
			'username' => $input['username'],
			'email' => $input['email'],
			));
			return Redirect::to('profile')->with('success', '1');
		}
		else {
			DB::table('users')
			->where('id', '=', Auth::user()->id)
			->update(array(
			'email' => $email_old,
			));
			return Redirect::to('profile')->withInput()->withErrors($v);	
		}
		
		
		
		
		$input = Input::all();
		$rules = array('email' => 'required|unique:users|email');
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
		if (Auth::user()->role == '0') {
			return Redirect::to('profile')->with('cpsuccess', '1');
		} else {// builder
			return Redirect::to('builder-profile')->with('cpsuccess', '1');
		}
	}
	
	public function postChangePhoneNumber()
	{
		$input = Input::all();
		$user = Auth::user();
		//echo Auth::user()->email; die;
		$phonenumber = $input['phonenumber']; 
		
		//----send sms----//
			for($code_length = 5, $newcode_phone = ''; strlen($newcode_phone) < $code_length; $newcode_phone .= chr(!rand(0, 2) ? rand(48, 57) : (!rand(0, 1) ? rand(65, 90) : rand(97, 122))));
			
			$newcode_phone = strtoupper($newcode_phone);
			$message = $newcode_phone ;//Input::get('message');
			
			$regex = "/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i";
			
			if (!preg_match( $regex, $phonenumber )) {
				return Redirect::to('register-builder')->with("is_phone_number", "0");
			}
			
			$sid = 'AC461fe2ea8ef7e0a8a864bb3a982142f7';
			$token = "d94d47547950d199f065f365a51111a4"; 
			$client = new Services_Twilio($sid, $token);
			
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
			if (Auth::user()->role == '0') {
					return Redirect::to('profile')->with('phonesuccess', '1');
				} else {// builder
					return Redirect::to('builder-profile')->with('phonesuccess', '1');
				}
			//return Redirect::to('profile')->with('phonesuccess', '1');

	}
	
	public function getOpenJobs()
	{
		if(Auth::check()) {
			
			$jobs = DB::table('jobs')->having('user_id', '=',Auth::user()->id)->having('status','=','openjob')->get();
			
			return View::make('user_dashboard.openjobs')->with('jobs', $jobs);
		}
		return Redirect::to('login');

	}
	
	public function getOngoingJobs()
	{
		if(Auth::check()) {
							
			$jobs = DB::table('jobs')
		    	 ->join('job_process', 'jobs.id', '=', 'job_process.job_id')
		    	 ->where('job_process.user_id', '=', Auth::user()->id)
		    	 ->where('job_process.status_process', '=', 'ongoing')
		    	 ->get();
		    	 //var_dump($jobs); die;
			return View::make('user_dashboard.ongoingjobs')->with('jobs', $jobs);
		}
		return Redirect::to('login');

	}
	
	public function getCancelledJobs()
	{
		if(Auth::check()) {
			
			$cancelledJobs = DB::table('jobs')
		    	 ->join('job_process', 'jobs.id', '=', 'job_process.job_id')
		    	 ->where('job_process.user_id', '=', Auth::user()->id)
		    	 ->where('job_process.status', '=', 'cancelled')
		    	 ->get();
		    	 
		 	
			//var_dump($cancelledJobs[0]->cancelled_confirm); die;
			return View::make('user_dashboard.cancelledjobs')->with(array('cancelledJobs'=> $cancelledJobs));
		}
		return Redirect::to('login');

	}
	
public function postCustomerActionCancelled()
	{  
		if(Auth::check()) {
		$input = Input::all();
		
		/*
		 * Update Database:
		 */
		for($code_length = 25, $newcode = ''; strlen($newcode) < $code_length; $newcode .= chr(!rand(0, 2) ? rand(48, 57) : (!rand(0, 1) ? rand(65, 90) : rand(97, 122))));
		//var_dump($newcode); die;
			
		DB::table('job_process')
			->where('job_id', '=', Input::get('job_id'))
			->where('builder_id', '=', Input::get('builder_id'))
        	->update(array(
			'status' => 'cancelled',
        	'cancelled_confirm' => $newcode,
			));
		/*
		 * Sent Alert by Email & Phone to Customer
		 */
		//--set email and phone to Customer----//
	
		$builder = DB::table('users')
			->where('id', '=', Input::get('builder_id'))
        	->first();
        //$job_id = Input::get('job_id')
        //var_dump($customer); die;
			$data = array(
					'email'     => $builder->email,
					'clickUrl'  => URL::to('/') . '/cancelledjobconfirm/'.Input::get("user_id").','. $newcode
			);
			 
			//---new send email----//
			try {
				Mail::send('emails.cancelledjob', $data, function($message)
				{
					$message->to(Input::get('email'))->subject('Cancelled Job');
				});
	
			}
			catch (Exception $e){
				$to      = $builder->email;
				$subject = 'Cancelled Job';
				$message = View::make('emails.cancelledjob', $data)->render();
				$headers = 'From: admin@landlordrepairs.uk' . "\r\n" .
						'Reply-To: admin@landlordrepairs.uk' . "\r\n" .
						'X-Mailer: PHP/' . phpversion() . "\r\n" .
						'MIME-Version: 1.0' . "\r\n" .
						'Content-Type: text/html; charset=ISO-8859-1\r\n';
	
				mail($to, $subject, $message, $headers);
	
			}
			
			
			//----send sms----//
			
			
			$sid = 'AC461fe2ea8ef7e0a8a864bb3a982142f7';
			$token = "d94d47547950d199f065f365a51111a4"; 
			$client = new Services_Twilio($sid, $token);
			$message = "Customer has been cancelled your job, please check email to approve it.";
			$client->account->messages->sendMessage(
					'+441544430006', // the text will be sent from your Twilio number
					$builder->phone_number, // the phone number the text will be sent to
					$message // the body of the text message
			);
			
		return Redirect::to('ongoingjobs');
		}
		return Redirect::to('login');
	}
	
	
	public function getPendingReviewJobs()
	{
		if(Auth::check()) {
			
			$jobs = DB::table('jobs')->having('user_id', '=',Auth::user()->id)->having('status','=','pending review')->get();
			
			return View::make('user_dashboard.pendingreview')->with('jobs', $jobs);
		}
		return Redirect::to('login');

	}
	
	public function getCompletedJobs()
	{
		if(Auth::check()) {
			
			$jobs = DB::table('jobs')
				->having('user_id', '=',Auth::user()->id)
				->having('status','=','completed')
				->get();
			
			return View::make('user_dashboard.completedjobs')->with('jobs', $jobs);
		}
		return Redirect::to('login');

	}

	public function getMyInvites()
	{
		if(Auth::check()) {
		$invites = "";
		$categorys = "";
		$jobtittles = "";
		    $invites = DB::table('job_process')
		    	->having('user_id', '=',Auth::user()->id )
		    	->having('status_process', '=','inviting' )
		    	->get(); 
		    $builders = array(); 
		    foreach($invites as $invite){
		    	 
		    	$builder = DB::table('users')
		    		->join('extend_builders', 'users.id', '=', 'extend_builders.builder_id')
		    	 	->where('users.id', '=', $invite->builder_id)
		    	 	->get();
		    	 
    			 $builders[$invite->builder_id] = $builder;
		    	 
    			 $category = DB::table('extend_builders_category')
    			 	->having('builder_id', '=',$invite->builder_id)
    			 	->get();
		    	 $categorys[$invite->builder_id] = $category;
		    	 
		    	 $jobtittle = DB::table('jobs')
		    	 	->where('id', '=',$invite->job_id)
		    	 	->first();  
		    	 	
		    	 $jobtittles[$invite->id] = $jobtittle;
		    	 
		    	   
		    } 
			return View::make('user_dashboard.myinvite')->with(array('invites'=>$invites,'builders'=>$builders,'categorys'=>$categorys,'jobtittles'=>$jobtittles));
		}
		return Redirect::to('register');

	}
	public function getMyFavorites()
	{
		if(Auth::check()) {
			if (Auth::user()->role == '0' ) {
				$favorite_builders = DB::table('favorite-builders')
        			->where('user_id', '=', Auth::user()->id)
        			->get();
        		//var_dump($favorite_builders[0]); die;
        		
        		$i = 0;
        		$builder = "";
				foreach ($favorite_builders as $favorite_builder) {
					
					$buildere = DB::table('users')
					->join('extend_builders', 'users.id', '=', 'extend_builders.builder_id')
					->join('extend_builders_category', 'users.id', '=', 'extend_builders_category.builder_id')
	        		->where('users.id', '=', $favorite_builder->builder_id)
	        		->get();
	      
	        		$builder[$i] = $buildere;
	        		$i++;
				}
			
				$count = count($builder);
				//var_dump($builder); die;
				
				return View::make('user_dashboard.myfavorites')->with(array('builder'=> $builder, 'count' => $count ));
				
			} else {
				return Redirect::to('login');
			}
			
		    
		}
		return Redirect::to('login');

	}


	public function getViewDetailInfoBuilder($builder_id)
	{  
		if(Auth::check()) {
			//echo($builder_id); die;
			$builder = "";//
			$builder = DB::table('users')
				->join('extend_builders', 'users.id', '=', 'extend_builders.builder_id')
				->join('job_process', 'job_process.builder_id', '=', 'extend_builders.builder_id')
				->join('jobs', 'jobs.id', '=', 'job_process.job_id')
				
        		->where('users.id', '=', $builder_id)
        		
        		->get();
        		//var_dump($builder); die; 
        	
        	return View::make('user_dashboard.builder_profile')->with(array('builder' => $builder));
		}
		return Redirect::to('login');

	}
	
	public function postCustomerActionDeleteFavoriteBuilder()
	{  
		if(Auth::check()) {
			DB::table('favorite-builders')
				->where('user_id', '=', Auth::user()->id)
				->where('builder_id', '=', Input::get('builder_id'))
				->delete();
			return Redirect::to('myfavorites');
		}
		return Redirect::to('login');

	}
	
	public function postCustomerActionAddFavoriteBuilder()
	{  
		if(Auth::check()) {
			DB::table('favorite-builders')
				->insert(array(
					'user_id' => Auth::user()->id, 
					'builder_id' => Input::get('builder_id')));
			return Redirect::to('myfavorites');
		}
		return Redirect::to('login');

	}
	
	
	public function postCustomerFindFavoriteBuilders()
	{  
		if(Auth::check()) {
        		$builders_ori = DB::table('extend_builders_category')
        			->join('users','users.id','=','extend_builders_category.builder_id')
        			->join('extend_builders','extend_builders.builder_id','=','extend_builders_category.builder_id')
        			->where('extend_builders_category.category', '=', Input::get('category'))
        			->get();
        			
        	    $builders_favorited = DB::table('favorite-builders')
        			->where('user_id', '=', Auth::user()->id)
        			->get();
        		$builders = "";
        		$i = 0;
        		
				foreach ($builders_ori as $builder_ori) {
					$enable = true;
        			foreach ($builders_favorited as $builder_favorited) {
        				if ($builder_ori->builder_id == $builder_favorited->builder_id) {
	        				$enable = false;				
        				}		
        			};
					if ($enable) {
        				$builders[$i] = $builder_ori;
        				$i++;
					}
        		}
        		
        		//var_dump($builders); die;
        		return View::make('user_dashboard.results_findmyfavorites')->with(array('builders' => $builders));
		}
		return Redirect::to('login');

	}
	
	
	
	
	public function getViewDetailInfoBuilderWithJob($builder_id, $job_id)
	{ 
		if(Auth::check()) {
			$builder = DB::table('users')
				->join('extend_builders', 'users.id', '=', 'extend_builders.builder_id')
				->join('extend_builders_category', 'users.id', '=', 'extend_builders_category.builder_id')
        		->where('users.id', '=', $builder_id)->get();
        		//var_dump($builder[0]); 
        	
        	$jobProcess = DB::table('job_process')->having('job_id', '=', $job_id )->first();
			$radius = $jobProcess->radius; 
        	return View::make('user_dashboard.builder_with_job__profile')->with(array('builder' => $builder, 'radius' => $radius));
		}
		return Redirect::to('login');

	}
	
	public function getAcceptVote($builder_id, $job_id)
	{
		if(Auth::check()) {
			
			/*When Customer Accept a Vote from Builder:
			 * + Status of job_process: "ongoing"
			 * + Disable to be a results of FindJobs form builders's request (conditions findjobs: ->having('jobs.status', '=', 'openjob'))
			 * +
			 */
			
			//--Process in DATABASE
						
			DB::table('job_process')
			->where('job_id', '=', $job_id)
			->where('builder_id', '=', $builder_id)
        	->update(array(
			'status_process' => 'ongoing',
			));
			
			DB::table('job_process')
			->where('job_id', '=', $job_id)
			->where('user_id', '=', Auth::user()->id)
			->where('builder_id', '<>', $builder_id)
        	->update(array(
			'status_process' => 'miss',
			));
			
			DB::table('jobs')
			->where('id', '=', $job_id)
        	->update(array(
			'status' => 'closejob',
			));
			//----Sent Alert to Email & Phone of Customer + Builders
			$builder = User::where('id', '=',$builder_id )->first();
			$data = array(
					'email'     => $builder->email,
					'phone_number' =>$builder->phone_number
					//'clickUrl'  => URL::to('/') . '/redirectpconfirm/' . $newcode
			);
			try {
				Mail::send('emails.signup', $data, function($message)
				{
					$message->to(Input::get('email'))->subject('Customer Accept your Vote');
				});
	
			}
			catch (Exception $e){
				$to      = $builder->email;
				$subject = 'Customer Accept your Vote';
				$message = View::make('emails.alertCustommerAcceptVoteJob', $data)->render();
				$headers = 'From: admin@landlordrepairs.uk' . "\r\n" .
						'Reply-To: admin@landlordrepairs.uk' . "\r\n" .
						'X-Mailer: PHP/' . phpversion() . "\r\n" .
						'MIME-Version: 1.0' . "\r\n" .
						'Content-Type: text/html; charset=ISO-8859-1\r\n';
	
				mail($to, $subject, $message, $headers);
	
			}
			
			
			//----send sms----//
			
			
			$sid = 'AC461fe2ea8ef7e0a8a864bb3a982142f7';
			$token = "d94d47547950d199f065f365a51111a4"; 
			$client = new Services_Twilio($sid, $token);
			$message = "Customer has been accept your vote, please check email to contact with them";
			$client->account->messages->sendMessage(
					'+441544430006', // the text will be sent from your Twilio number
					$builder->phone_number, // the phone number the text will be sent to
					$message // the body of the text message
			);
			//----------------//
			
			//--End send email and phone to Customer----//
			//----------END Alert-----------------------------------
			
			return Redirect::to('ongoingjobs');
		}
		return Redirect::to('login');

	}
	
	public function getCancelVote($builder_id, $job_id)
	{
		if(Auth::check()) {
						
			
			DB::table('job_process')
			->where('job_id', '=', $job_id)
			->where('builder_id', '=', $builder_id)
        	->update(array(
			'status_process' => 'miss',
			));
			return Redirect::to('ongoingjobs');
		}
		return Redirect::to('login');

	}

	/*-------------------------------
	 *          BUILDERS
	 * 
	 *-----------------------------*/
	
	public function getRegisterBuilder()
	{  	
		if(Auth::check()) {
			return Redirect::route('landing-page');
		}
		return View::make('pages.register-builder');
	}
	
	public function postRegisterBuilder()
	{   
		
	
		$input = Input::all();
		
		
		$rules = array('username' => 'required|unique:users', 'email' => 'required|unique:users|email','phone_number'  => 'numeric');
		$v = Validator::make($input, $rules);
			//----send sms----//
			for($code_length = 5, $newcode_phone = ''; strlen($newcode_phone) < $code_length; $newcode_phone .= chr(!rand(0, 2) ? rand(48, 57) : (!rand(0, 1) ? rand(65, 90) : rand(97, 122))));
	
			$newcode_phone = strtoupper($newcode_phone);
			$message = $newcode_phone ;//Input::get('message');

			$to_phone_number = $input['phone_number'];
			$regex = "/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i";
			
			if (!preg_match( $regex, $to_phone_number )) {
				return Redirect::to('register-builder')->with("is_phone_number", "0");
			}
	
			$sid = 'AC461fe2ea8ef7e0a8a864bb3a982142f7';
			$token = "d94d47547950d199f065f365a51111a4"; 
			$client = new Services_Twilio($sid, $token);
			
			$client->account->messages->sendMessage(
					'+441544430006', // the text will be sent from your Twilio number
					$to_phone_number, // the phone number the text will be sent to
					$message // the body of the text message
			);
			
			
		//GENERATE $newcode - RANDOM STRING TO VERIFY SIGNUP
		for($code_length = 25, $newcode = ''; strlen($newcode) < $code_length; $newcode .= chr(!rand(0, 2) ? rand(48, 57) : (!rand(0, 1) ? rand(65, 90) : rand(97, 122))));
		 
		
		if($v->passes())
		{	
			$categorys = Input::get('check_builders');
			$num_of_checked_builders = count($categorys);
			if ($num_of_checked_builders == 0) {
				return Redirect::to('register-builder')->with("num_of_checked_builders", "0");
			} else {
			$password = $input['password'];
			$password = Hash::make($password);
	
			$user = new User();
			$user->username = $input['username'];
			$user->email = $input['email'];
			$user->password = $password;
			$user->phone_number = $to_phone_number;
			$user->email_confirm = $newcode;
			$user->phone_confirm = $newcode_phone;
			$user->package_builder = $input['package_builder'];
			$user->package_builder_confirm = '0';
			$user->role = '1';
			$user->save();
			
			$extend_builder = new ExtendBuilder();
			$extend_builder->builder_id = $user->id;
			$extend_builder->tittle = $input['tittle'];
			$extend_builder->local = $input['local'];
			$extend_builder->local_code = $input['local_code'];
			$extend_builder->lat = $input['lat'];
			$extend_builder->site_link = $input['site_link'];
			$extend_builder->social_link = $input['social_link'];
			$extend_builder->association = $input['association'];
			
			$extend_builder->save();
			
			
			for ($i = 0; $i < $num_of_checked_builders; $i++){
				$extend_builder_category = new ExtendBuilderCategory();	
				$extend_builder_category->builder_id = $user->id;
				$extend_builder_category->category = $categorys[$i];
				$extend_builder_category->save();
			
			}
		}
			
			
			
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
			//return Redirect::to('login')->with("emailfirst", "1");
			
			return View::make('pages.pay_package_builder')->with(array("package_builder"=>$input['package_builder'],"email"=>$input['email'] ));
	
		} else {
	
			return Redirect::to('register-builder')->withInput()->withErrors($v);
	
		}
	}
	


	public function postPayPackageBuilder()
	{
		//print_r(Input::all());
		
	
		$input = Input::all(); 
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
		//----do something after charge success---//
		
		$user = User::where('email', '=',Input::get('email') )->first();
		//var_dump($user); die;
		$user->package_builder_confirm = '1';
		$user->save();
		return Redirect::to('login')->with("emailfirst", "1");
		} catch(Stripe_CardError $e) {
		  // The card has been declined
		}
		
	}
	
	
	public function getBuilderProfile()
	{
		if(Auth::check()) {
			//$builder = Auth::user();
			$builder = DB::table('users')
				->join('extend_builders', 'users.id', '=', 'extend_builders.builder_id')
				->join('extend_builders_category', 'users.id', '=', 'extend_builders_category.builder_id')
        		->where('users.id', '=', Auth::user()->id)->get();
        		//var_dump($builder[0]); die;
			return View::make('builder_dashboard.profile')->with('builder', $builder);
		}
		return Redirect::to('login');

	}
	
	public function postChangeBuilderProfile()
	{
		$input = Input::all();
		$email_old = $input['email'];
		
		DB::table('users')
			->where('id', '=', Auth::user()->id)
			->update(array(
			'email' => "temp",
			));
			
		$rules = array('email' => 'required|unique:users|email');
		$v = Validator::make($input, $rules);
		if($v->passes()) {
		
			DB::table('users')
			->where('id', '=', Auth::user()->id)
			->update(array(
			'username' => $input['username'],
			'email' => $input['email'],
			));

			
			DB::table('extend_builders')
			->where('extend_builders.builder_id', '=', Auth::user()->id)
			->update(array(
			'tittle' => $input['company'],
			'local' => $input['local'],
			'local_code' => $input['local_code'],
			'lat' => $input['lat'],
			'lng' => $input['lng'],
			'site_link' => $input['site_link'],
			'social_link' => $input['social_link'],
			'association' => $input['association'],
			'created_at' => $input['created_at'],
			));
			//---Change Category----//
			DB::table('extend_builders_category')->where('builder_id', '=', Auth::user()->id)->delete();
			//echo "dete";die;
			$categorys = Input::get('check_builders');
			$num_of_checked_builders = count($categorys);
			for ($i = 0; $i < $num_of_checked_builders; $i++){
				$extend_builder_category = new ExtendBuilderCategory();	
				$extend_builder_category->builder_id = Auth::user()->id;
				$extend_builder_category->category = $categorys[$i];
				$extend_builder_category->save();	
			}
			//----------------------//
			
				
		
		return Redirect::to('builder-profile')->with('success', '1');
		} else {
			DB::table('users')
			->where('id', '=', Auth::user()->id)
			->update(array(
			'email' => $email_old,
			));
			return Redirect::to('builder-profile')->with('success', '0');	
		}
	}
	
	
	
	
	
	public function getBuilderInvited()
	{
		if(Auth::check()) {
			if (Auth::user()->role == '1' ) {
				$invites = DB::table('job_process')
					->having('builder_id', '=',Auth::user()->id )
					->having('status_process', '=','inviting' )
					->get();
			   
				$customers = "";
			    $categorys = "";
				if ($invites != null) {
			    foreach($invites as $invite){
			    	
			    	 $customer = DB::table('users')->having('id', '=',$invite->user_id )->get();
			      
	    			 $customers[$invite->user_id] = $customer;
	    			 
	    			 
	    			 	
	    			 $category = DB::table('jobs')
	    			 	->having('id', '=',$invite->job_id)
	    			 	->get();	
			      
	    			 $categorys[$invite->user_id] = $category;
			    	
			    }
			    } 
			
			return View::make('builder_dashboard.invite')->with(array('invites'=>$invites,'customers'=>$customers,'categorys'=>$categorys));	
			} else {
				return Redirect::to('login');
			}
			
		    
		}
		return Redirect::to('login');

	}
	
	
	public function getBuilderFindJobs()
	{
		if(Auth::check()) {
			if (Auth::user()->role == '1' ) {
				$builders = DB::table('users')->join('extend_builders_category', 'users.id', '=', 'extend_builders_category.builder_id')
        		->where('users.id', '=', Auth::user()->id)->get();
        		//var_dump($builders); die;
				return View::make('builder_dashboard.findJobs')->with(array('builders'=>$builders));;			
			} else {
				return Redirect::to('login');
			}
			
		    
		}
		return Redirect::to('login');

	}
	
	public function postBuilderFindJobs()
	{
		$input = Input::all(); $hello = 1;
		
		$isHasNum = true;
		//var_dump ($test); die;
		$jobs = "";
		$category = Input::get('category');
		
		$jobs = DB::table('jobs')
				->join('job_process', 'jobs.id', '=', 'job_process.job_id')
        		->having('jobs.category', '=', $category)
        		->having('job_process.builder_id', '<>', Auth::user()->id)
        		->having('jobs.status', '=', 'openjob')
        		->having('job_process.num_invite_sent', '<', '3')
        		->get();
	
        $myjobs = "";		
        $myjobs = DB::table('job_process')
        		->having('builder_id', '=', Auth::user()->id)
        		->get();		
    
        $jobs_resuilt = "";
        $i = 0;
        $isPlusJob = true;
        foreach ($jobs as $job){
        	foreach ($myjobs as $myjob){
        		if ($myjob->job_id == $job->job_id){
        			$isPlusJob = false;
        		}
        	}
        	if ($isPlusJob){
        		$jobs_resuilt[$i] = $job;
        		$i++;
        		
        	}
        	$isPlusJob = true;
        }
        /*
         * When no Job no have any invited to Builders in Job_process
         * 
         */
        /*if ( $jobs_3 == null ) {
        	$jobs = DB::table('jobs')
        		->having('jobs.category', '=', $category)
        		->get();
        	$isHasNum = false;
        	$jobs_resuilt = $jobs;		
        }*/
        
        
		
		return View::make('builder_dashboard.findJobsrResuilt')->with(array('jobs_resuilt'=>$jobs_resuilt,'isHasNum'=>$isHasNum,'myjobs'=>$myjobs));;
	
	}	
	
	public function getViewDetailJobAlert($job_id,$user_id)
	{ 
		if(Auth::check()) {
			if (Auth::user()->role == '1' ) {
				//GET USER INFO
				$userInfo = DB::table('users')->having('id', '=', $user_id )->first();
				//var_dump($userInfo); die;
				//GET JOB INFO
				$jobInfo = DB::table('jobs')->having('id', '=', $job_id )->first();
				//var_dump($jobInfo); die;
				$jobProcess = DB::table('job_process')->having('job_id', '=', $job_id )->first();
				//var_dump($dateInvite); die;
			return View::make('builder_dashboard.viewDetailJobAlert')->with(array('userInfo'=>$userInfo,'jobInfo'=>$jobInfo,'jobProcess'=>$jobProcess));	
			} else {
				return Redirect::to('login');
			}
			
		    
		}
		return Redirect::to('login');

	}
	
	
	public function postVoteJob()
	{  
		$input = Input::all();
		
	    if (Input::get('isAddToJobProcess') == 'true') {
	    	/*
	    	 * Update database: Create a row of Table "Job_process"
	    	 */ 
	    	
	    	//calculate the radius:
			function get_distance_between_points($latitude1, $longitude1, $latitude2, $longitude2) {
			    $theta = $longitude1 - $longitude2;
			    $miles = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta)));
			    $miles = acos($miles);
			    $miles = rad2deg($miles);
			    $miles = $miles * 60 * 1.1515;
			    
			    return $miles;
			}
			$job_customer = DB::table('jobs')
				->where('id', '=', Input::get('job_id'))
        		->first();
        	
        	$extend_builder = DB::table('extend_builders')
				->where('builder_id', '=', Auth::user()->id)
        		->first();
        		
        	$num_invite_sent = DB:: table('job_process')
				->where('job_id', '=', Input::get('job_id'))
        		->get();
        	$num_invite_sent_count = count($num_invite_sent);		
        	$num_invite_sent_count++;
        	
        /*
         * update num_invite_sent in all row has $job_id
         */
        	DB::table('job_process')
				->where('job_id', '=', Input::get('job_id'))
	        	->update(array(
					'num_invite_sent' => $num_invite_sent_count,
				));
        			
        	
			$radius = get_distance_between_points($job_customer->lat, $job_customer->lng, $extend_builder->lat, $extend_builder->lng);
		    //var_dump($radius);	die;
	    
	    		$job_process = new JobProcess();
				
	    		$job_process->job_id = Input::get('job_id');
				$job_process->user_id = Input::get('user_id');
				$job_process->builder_id = Auth::user()->id;
				$job_process->num_invite_sent = $num_invite_sent_count;
				$job_process->vote = Input::get('votePrice');
				$job_process->status_process = 'inviting';
				$job_process->radius = $radius;
				
				$job_process->save();
				
	
			}
			
			
		DB::table('job_process')
			->where('job_id', '=', Input::get('job_id'))
			->where('builder_id', '=', Auth::user()->id)
        	->update(array(
			'vote' => Input::get('votePrice'),
			));

		$customer = DB::table('users')
			->where('id', '=', Input::get('user_id'))
        	->first();
			//--set email and phone to Customer----//
			$data = array(
					'email'     => $customer->email
					//'clickUrl'  => URL::to('/') . '/redirectpconfirm/' . $newcode
			);
			try {
				Mail::send('emails.signup', $data, function($message)
				{
					$message->to(Input::get('email'))->subject('Builder Vote your Job');
				});
	
			}
			catch (Exception $e){
				$to      = $customer->email;
				$subject = 'Builder Vote your Job';
				$message = View::make('emails.alertBuilderVoteJob', $data)->render();
				$headers = 'From: admin@landlordrepairs.uk' . "\r\n" .
						'Reply-To: admin@landlordrepairs.uk' . "\r\n" .
						'X-Mailer: PHP/' . phpversion() . "\r\n" .
						'MIME-Version: 1.0' . "\r\n" .
						'Content-Type: text/html; charset=ISO-8859-1\r\n';
	
				mail($to, $subject, $message, $headers);
	
			}
			
			
			//----send sms----//
			
			
			$sid = 'AC461fe2ea8ef7e0a8a864bb3a982142f7';
			$token = "d94d47547950d199f065f365a51111a4"; 
			$client = new Services_Twilio($sid, $token);
			$message = "Abuilder has been vote your job, please go to http://landlordrepairs.uk/test/landlord/public/myinvites to Accept or Cancel it.";
			$client->account->messages->sendMessage(
					'+441544430006', // the text will be sent from your Twilio number
					$customer->phone_number, // the phone number the text will be sent to
					$message // the body of the text message
			);
			//----------------//
			
			//--End send email and phone to Customer----//
			
			/*Lost more here
			 * 
			 * 
			 */
			
			
      return Redirect::to('customer-invited');

      
	}
	
	public function getBuilderOngoingJobs()
	{
		if(Auth::check()) {
		
			
			$OngoingJobs = DB::table('jobs')
		    	 ->join('job_process', 'jobs.id', '=', 'job_process.job_id')
		    	 ->where('job_process.builder_id', '=', Auth::user()->id)
		    	 ->where('job_process.status_process', '=', 'ongoing')
		    	 ->get();
		    	 
		    //var_dump($OngoingJobs); die; 
		    	 
			
			return View::make('builder_dashboard.ongoingjobs')->with(array('OngoingJobs'=> $OngoingJobs));
		}
		return Redirect::to('login');

	}
	
	public function getBuilderActionCompleted()
	{ 
		if(Auth::check()) {
		$input = Input::all();
		DB::table('jobs')
			->where('id', '=', Input::get('job_id'))
        	->update(array(
			'status' => 'completed',
        	'date_completed' => Input::get('date_completed'),
			));
		DB::table('job_process')
			->where('job_id', '=', Input::get('job_id'))
			->where('builder_id', '=', Input::get('builder_id'))
        	->update(array(
			'status_process' => 'completed',
        	
			));
		return Redirect::to('builder-ongoing-jobs');
		}
		return Redirect::to('login');
	}
	
	public function postBuilderActionCancelled()
	{  
		if(Auth::check()) {
		$input = Input::all();
		
		/*
		 * Update Database:
		 */
		for($code_length = 25, $newcode = ''; strlen($newcode) < $code_length; $newcode .= chr(!rand(0, 2) ? rand(48, 57) : (!rand(0, 1) ? rand(65, 90) : rand(97, 122))));
		//var_dump($newcode); die;
			
		DB::table('job_process')
			->where('job_id', '=', Input::get('job_id'))
			->where('builder_id', '=', Auth::user()->id)
        	->update(array(
			'status' => 'cancelled',
        	'cancelled_confirm' => $newcode,
			));
		/*
		 * Sent Alert by Email & Phone to Customer
		 */
		//--set email and phone to Customer----//
	
		$customer = DB::table('users')
			->where('id', '=', Input::get('user_id'))
        	->first();
        //$job_id = Input::get('job_id')
        //var_dump($customer); die;
			$data = array(
					'email'     => $customer->email,
					'clickUrl'  => URL::to('/') . '/cancelledjobconfirm/'.Input::get("user_id").','. $newcode
			);
			 
			//---new send email----//
			try {
				Mail::send('emails.cancelledjob', $data, function($message)
				{
					$message->to(Input::get('email'))->subject('Cancelled Job');
				});
	
			}
			catch (Exception $e){
				$to      = $customer->email;
				$subject = 'Cancelled Job';
				$message = View::make('emails.cancelledjob', $data)->render();
				$headers = 'From: admin@landlordrepairs.uk' . "\r\n" .
						'Reply-To: admin@landlordrepairs.uk' . "\r\n" .
						'X-Mailer: PHP/' . phpversion() . "\r\n" .
						'MIME-Version: 1.0' . "\r\n" .
						'Content-Type: text/html; charset=ISO-8859-1\r\n';
	
				mail($to, $subject, $message, $headers);
	
			}
			
			
			//----send sms----//
			
			
			$sid = 'AC461fe2ea8ef7e0a8a864bb3a982142f7';
			$token = "d94d47547950d199f065f365a51111a4"; 
			$client = new Services_Twilio($sid, $token);
			$message = "Abuilder has been cancelled your job, please check email to approve it.";
			$client->account->messages->sendMessage(
					'+441544430006', // the text will be sent from your Twilio number
					$customer->phone_number, // the phone number the text will be sent to
					$message // the body of the text message
			);
			
		return Redirect::to('builder-ongoing-jobs');
		}
		return Redirect::to('login');
	}
	
	
	public function getconfirmCancelledJob( $job_id, $confirm_code )
	{   
		if(Auth::check()) {
			$job_process = DB::table('job_process')
				->where('job_id', '=', $job_id)
				->where('builder_id', '=', Auth::user()->id)
				->where('cancelled_confirm','=', $confirm_code)
	        	->first();
	        	
	        if ($job_process) {
	        	DB::table('job_process')
					->where('job_id', '=', $job_id)
					->where('builder_id', '=', Auth::user()->id)
		        	->update(array(
		        	'cancelled_confirm' => '',
					));
	        }  
			
		
		return Redirect::to('builder-cancelled-jobs');	
		}
		return Redirect::to('login');
	
	}
	
	public function getBuilderLostJobs()
	{ 
		if(Auth::check()) {
			
			$LostJobs = DB::table('jobs')
		    	 ->join('job_process', 'jobs.id', '=', 'job_process.job_id')
		    	 ->where('job_process.builder_id', '=', Auth::user()->id)
		    	 ->where('job_process.status_process', '=', 'miss')
		    	 ->get();
		    	 
		 	
			
			return View::make('builder_dashboard.lostjobs')->with(array('LostJobs'=> $LostJobs));
		}
		return Redirect::to('login');
	}
	
	public function getBuilderWonJobs()
	{ 
		if(Auth::check()) {
			
			$WonJobs = DB::table('jobs')
		    	 ->join('job_process', 'jobs.id', '=', 'job_process.job_id')
		    	 ->where('job_process.builder_id', '=', Auth::user()->id)
		    	 ->where('job_process.status_process', '=', 'ongoing')
		    	 ->get();
		    	 
		 	
			
			return View::make('builder_dashboard.wonjobs')->with(array('WonJobs'=> $WonJobs));
		}
		return Redirect::to('login');
	}
	
	public function getBuilderCompletedJobs()
	{ 
		if(Auth::check()) {
			
			$conpletedJobs = DB::table('jobs')
		    	 ->join('job_process', 'jobs.id', '=', 'job_process.job_id')
		    	 ->where('job_process.builder_id', '=', Auth::user()->id)
		    	 ->where('job_process.status', '=', 'completed')
		    	 ->get();
		    	 
		 	
			
			return View::make('builder_dashboard.completedjobs')->with(array('conpletedJobs'=> $conpletedJobs));
		}
		return Redirect::to('login');
	}
	
	public function getBuilderCancelledJobs()
	{ 
		if(Auth::check()) {
			
			$cancelledJobs = DB::table('jobs')
		    	 ->join('job_process', 'jobs.id', '=', 'job_process.job_id')
		    	 ->where('job_process.builder_id', '=', Auth::user()->id)
		    	 ->where('job_process.status', '=', 'cancelled')
		    	 ->get();
		    	 
		 	
			//var_dump($cancelledJobs[0]->cancelled_confirm); die;
			return View::make('builder_dashboard.cancelledjobs')->with(array('cancelledJobs'=> $cancelledJobs));
		}
		return Redirect::to('login');
	}
	

	
	
	
	
}


