<?php

class AuthController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function getFacebookLogin($auth = NULL)
	{
		if ($auth == "auth") {
			try {
				Hybrid_Endpoint::process();
			} catch (Exception $e) {
				return Redirect::to('fbauth');
			}
		
		}
		$oauth = new Hybrid_Auth(app_path().'/config/fb_auth.php');
		$provider = $oauth->authenticate('Facebook');//here go to the "base_url".
		$profile = $provider->getUserProfile();
		$name = $profile->displayName;
		$email = $profile->email;
		$uid = $profile->identifier;
		$email = $email == NULL?"email-is-null":$email; 
		
		Session::put('facebook-login-session', true);
		$v = Validator::make(
				array('uid' => $uid),
				array('uid' => 'required|unique:users')
		);
				
		if($v->passes()) {
	
			$user = new User();
			$user->username = $name;
			$user->email = $email;
			$user->uid = $uid;
			$user->uid = $uid;
			$user->save();
	
	
		}
		return Redirect::route('landing-page');
	}
	
	protected function getFacebookLoginSupplier($auth = NULL)
	{
		if ($auth == "auth") {
			try {
				Hybrid_Endpoint::process();
			} catch (Exception $e) {
				return Redirect::to('fbauth');
			}
	
		}
		$oauth = new Hybrid_Auth(app_path().'/config/fb_auth.php');
		$provider = $oauth->authenticate('Facebook');//here go to the "base_url".
		$profile = $provider->getUserProfile();
		$name = $profile->displayName;
		$email = $profile->email;
		$uid = $profile->identifier;
		$email = $email == NULL?"email-is-null":$email;
		$role = 2;
		Session::put('facebook-login-session', true);
		$v = Validator::make(
				array('uid' => $uid),
				array('uid' => 'required|unique:users')
		);
	
		if($v->passes()) {
	
			$user = new User();
			$user->username = $name;
			$user->email = $email;
			$user->uid = $uid;
			$user->uid = $uid;
			$user->role = $role;
			$user->save();
	
	
		}
		return Redirect::route('landing-page');
	}
	
	protected function getTwitterLogin($auth = NULL)
	{
		if ($auth == "auth") {
			
				Hybrid_Endpoint::process();
				return;
	
		}
		try {
			$oauth = new Hybrid_Auth(app_path().'/config/twitterAuth.php');
			$provider = $oauth->authenticate('Twitter');
			$profile = $provider->getUserProfile();
		}catch (Exception $e){
			return $e->getMessage();
		}
		
		
		$name = $profile->displayName;
		$email = $profile->email;
		$uid = $profile->identifier;
		//return var_dump($profile);
		$email = $email == NULL?"email-is-null":$email; 
		Session::put('facebook-login-session', true);
		$v = Validator::make(
				array('uid' => $uid),
				array('uid' => 'required|unique:users')
		);
	
		if($v->passes()) {
	
			$user = new User();
			$user->username = $name;
			$user->email = $email;
			$user->uid = $uid;
			$user->save();
	
	
		}
		return Redirect::route('landing-page');
	}
	
	protected function getTwitterLoginSupplier($auth = NULL)
	{
		if ($auth == "auth") {
				
			Hybrid_Endpoint::process();
			return;
	
		}
		try {
			$oauth = new Hybrid_Auth(app_path().'/config/twitterAuth.php');
			$provider = $oauth->authenticate('Twitter');
			$profile = $provider->getUserProfile();
		}catch (Exception $e){
			return $e->getMessage();
		}
	
	
		$name = $profile->displayName;
		$email = $profile->email;
		$uid = $profile->identifier;
		$role = 2;
		//return var_dump($profile);
		$email = $email == NULL?"email-is-null":$email;
		Session::put('facebook-login-session', true);
		$v = Validator::make(
				array('uid' => $uid),
				array('uid' => 'required|unique:users')
		);
	
		if($v->passes()) {
	
			$user = new User();
			$user->username = $name;
			$user->email = $email;
			$user->uid = $uid;
			$user->role = $role;
			$user->save();
	
	
		}
		return Redirect::route('landing-page');
	}
	
	protected function getGoogleLogin($auth = NULL)
	{
		if ($auth == "auth") {
			try {
				Hybrid_Endpoint::process();
			} catch (Exception $e) {
				return Redirect::to('gauth');
			}
	
		}
	
		$oauth = new Hybrid_Auth(app_path().'/config/google_auth.php');
		$provider = $oauth->authenticate('Google');
		$profile = $provider->getUserProfile();
		
		//return var_dump($profile);
		$name = $profile->displayName;
		$email = $profile->email;
		$uid = $profile->identifier;
		//return var_dump($profile);
	
		Session::put('facebook-login-session', true);
		$v = Validator::make(
				array('uid' => $uid),
				array('uid' => 'required|unique:users')
		);
	
		if($v->passes()) {
	
			$user = new User();
			$user->username = $name;
			$user->email = $email;
			$user->uid = $uid;
			$user->save();
	
	
		}
		return Redirect::route('landing-page');
	}
	
	protected function getGoogleLoginSupplier($auth = NULL)
	{
		if ($auth == "auth") {
			try {
				Hybrid_Endpoint::process();
			} catch (Exception $e) {
				return Redirect::to('gauth');
			}
	
		}
	
		$oauth = new Hybrid_Auth(app_path().'/config/google_auth.php');
		$provider = $oauth->authenticate('Google');
		$profile = $provider->getUserProfile();
	
		//return var_dump($profile);
		$name = $profile->displayName;
		$email = $profile->email;
		$uid = $profile->identifier;
		$role = 2;
		//return var_dump($profile);
	
		Session::put('facebook-login-session', true);
		$v = Validator::make(
				array('uid' => $uid),
				array('uid' => 'required|unique:users')
		);
	
		if($v->passes()) {
	
			$user = new User();
			$user->username = $name;
			$user->email = $email;
			$user->uid = $uid;
			$user->role = $role;
			$user->save();
	
	
		}
		return Redirect::route('landing-page');
	}
	
	protected function getLoggedOut()
	{
		$fauth = new Hybrid_Auth(app_path().'/config/fb_auth.php');
		$fauth->logoutAllProviders();
		return View::make('login');
	}

}
