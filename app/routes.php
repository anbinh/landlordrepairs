
<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/*Route::get('/', 'HomeController@getIndex');
Route::get('login', 'HomeController@getLogin');
Route::get('register', 'HomeController@getRegister');
Route::post('register', 'HomeController@postRegister');
Route::post('login', 'HomeController@postLogin');
Route::get('logout', 'HomeController@logout');
Route::get('forgetpass', 'HomeController@getForgetpass');
Route::post('forgetpass', 'HomeController@postForgetpass');
Route::get( 'confirm/{id_code}', array( 'uses' => 'HomeController@confirm' ));
Route::get( 'changepass/{id_code}', array( 'uses' => 'HomeController@changepass' ));

//route for profile pass change
Route::get( 'dashboard/profile/passrequest', array( 'uses' => 'HomeController@getPassrequest' ));
Route::get( 'dashboard/profile/passchange/{id_code}', array( 'uses' => 'HomeController@getPassChange' ));
Route::post( 'dashboard/profile/passchange/{id_code}', array( 'uses' => 'HomeController@postPassChange' ));


//route for admin
/*Route::get('admin', 'AdminController@getIndex');
Route::get('admin/setting', 'AdminController@getSetting');
Route::post('admin/setting', 'AdminController@postSetting');
Route::get('admin/profile', 'AdminController@getProfile');
Route::post('admin/profile', 'AdminController@postProfile');

Route::get('admin/users', 'AdminController@getUsers');
Route::get('admin/users/page/{page}', 'AdminController@getUsers');
Route::get('admin/deluser/{user_id}', 'AdminController@delUser');
Route::get('admin/edituser/{user_id}', 'AdminController@getEditUser');
Route::post('admin/edituser/{user_id}', array('uses' => 'AdminController@postEditUser'));
Route::post('admin/changeuserpass/{user_id}', array('as' => 'admin.changeuserpass', 'uses' => 'AdminController@postChangePass'));
Route::get('admin/adduser', 'AdminController@getAddUser');
Route::post('admin/adduser', 'AdminController@postAddUser');


Route::get('user/{user_id}', array('uses' => 'HomeController@getUser'));


Route::group(array('before' => 'auth'), function(){

	Route::get('dashboard', 'DashboardController@getIndex');
	Route::get('dashboard/profile', 'DashboardController@getProfile');
	Route::post('dashboard/profile', 'DashboardController@postProfile');

});

Route::post('upload/image/{user_id}', array('uses' => 'ImageController@postUpload'));
Route::post('upload/image', array('uses' => 'ImageController@postUpload'));

Route::get('filenotfound', 'HomeController@get404');


//-------------NEW----------------//
Route::filter('check-language', function(){
	if(!Session::has('locale')) {
		Session::set('locale','en');
	}
	Lang::setLocale(Session::get('locale'));
	
	if ( ! function_exists('cached_asset'))
	{
		function cached_asset($path, $bustQuery = false)
		{
			// Get the full path to the asset.
			$realPath = public_path($path);
	
			if ( ! file_exists($realPath)) {
				throw new LogicException("File not found at [{$realPath}]");
			}
	
			// Get the last updated timestamp of the file.
			$timestamp = filemtime($realPath);
	
			if ( ! $bustQuery) {
				// Get the extension of the file.
				$extension = pathinfo($realPath, PATHINFO_EXTENSION);
	
				// Strip the extension off of the path.
				$stripped = substr($path, 0, -(strlen($extension) + 1));
	
				// Put the timestamp between the filename and the extension.
				$path = implode('.', array($stripped, $timestamp, $extension));
			} else {
				// Append the timestamp to the path as a query string.
				$path  .= '?' . $timestamp;
			}
	
			return asset($path);
		}
	}

});
Route::group(array('before'=>'check-language'), function(){
	Route::get('/',array('as'=>'landing-page', function()
	{
		return View::make('pages.home');
	}));
	Route::post('/','HomeController@postTask');
	
	
	Route::get('login',array ('as'=>'login-page', function()
	{
		return View::make('pages.login');
	}));
	
	Route::get('login-supplier',array ('as'=>'login-supplier-page', function()
	{
		return View::make('pages.login-supplier');
	}));
	
	Route::get('login-admin',array ('as'=>'login-admin-page', function()
	{
		return View::make('pages.login-admin');
	}));
	
	Route::get('register',array ('as'=>'register-page', function()
	{
		return View::make('pages.register');
	}));
	
	Route::get('register-supplier',array ('as'=>'register-supplier-page', function()
	{
		return View::make('pages.register-supplier');
	}));
	
	Route::get('restore',array('as'=>'restore-page', function()
	{
		return View::make('pages.restore');
	}));
	
	Route::get('about',array('as'=>'about-page', function()
	{
		return View::make('pages.aboutUs');
	}));
	Route::get('terms',array ('as'=>'terms-page', function()
	{
		return View::make('pages.termsOfService');
	}));
	Route::get('list-service',array ('as'=>'list-service-page', function()
	{
		return View::make('pages.list-service');
	}));
	Route::get('privacy',array ('as'=>'privacy-page', function()
	{
		return View::make('pages.privacy');
	}));
	Route::get('why-book-with-us',array ('as'=>'why-book-page', function()
	{
		return View::make('pages.whybook');
	}));
	Route::get('contact',array ('as'=>'contact-page', function()
	{
		return View::make('pages.contact');
	}));
	Route::get('FAQ',array ('as'=>'FAQ-page', function()
	{
		return View::make('pages.FAQ');
	}));
	Route::get('logout', 'HomeController@logout');
	Route::get( 'confirm/{id_code}', array( 'uses' => 'HomeController@confirm' ));
	Route::get( 'changepass/{id_code}', array( 'uses' => 'HomeController@changepass' ));
	Route::get('admin-page',array('as'=>'admin-page', function()
	{
		return View::make('pages.admin-page');
	}));
	Route::get('supplier-page',array('as'=>'supplier-page', function()
	{
		return View::make('pages.supplier-page');
	}));
	
	
	
	
	
});

	Route::get('language/english',array('as'=>'english-language', function()
	{	Session::set('locale','en');
	return Redirect::back();
	}));
	
	Route::get('language/germany',array('as'=>'chinese-language', function()
	{	Session::set('locale','de');
	return Redirect::back();
	}));
	
	Route::post('login','HomeController@postLogin');
	Route::post('login-supplier','HomeController@postLoginSupplier');
	Route::post('login-admin','HomeController@postLoginAdmin');
	
	Route::post('register', 'HomeController@postRegister');
	Route::post('register-supplier', 'HomeController@postRegisterSupplier');
	
	Route::post('restore', 'HomeController@postForgetpass');
//-----------login---facebook --///
	Route::get('fbauth/{auth?}',array('as' => 'facebookAuth','uses'=>'AuthController@getFacebookLogin'));
	Route::get('twitterAuth/{auth?}',array('as' => 'twitterAuth','uses'=>'AuthController@getTwitterLogin'));
	Route::get('gauth/{auth?}',array('as' => 'googleAuth','uses'=>'AuthController@getGoogleLogin'));
//-----------select supplier ajax call-------------//]

	
		Route::post('/ajax', 'AjaxController@postSelectSupplier');
		
		Route::get('select-supplier',array('as'=>'select-supplier', function()
		{
			return View::make('ajax.select-supplier');
		}));
//-----TEST GOOGLE MAP-----//
		Route::get('googlemap', 'HomeController@getGooglemap');
		Route::post('googlemap', 'HomeController@postGooglemap');
//-------------------------//
 */
Route::get('/',array('as'=>'landing-page', function()
{
	return View::make('pages.home');
}));

Route::get('register', 'BaseController@getRegister');
Route::post('register', 'BaseController@postRegister');
Route::get( 'confirm/{id_code}', array( 'uses' => 'BaseController@confirm' ));
Route::get('login', 'BaseController@getLogin');
Route::post('login','BaseController@postLogin');

Route::get('phoneconfirm', 'BaseController@getPhoneconfirm');
Route::post('phoneconfirm','BaseController@postPhoneconfirm');

Route::get('logout', 'BaseController@logout');
Route::get('forgetpass', 'BaseController@getForgetpass');
Route::post('forgetpass', 'BaseController@postForgetpass');

Route::get('restore',array('as'=>'restore-page', function()
{
	return View::make('pages.restore');
}));
Route::post('restore', 'BaseController@postForgetpass');

Route::get( 'changepass/{id_code}', array( 'uses' => 'BaseController@changepass' ));

Route::get('postjob',array ('as'=>'postjob-page', function()
{
	return View::make('pages.postjob');
}));
Route::post('postjob', 'BaseController@postPostjob');
//-----TEST PHONE------//
Route::post('text', function()
{
	// Get form inputs
	$number = Input::get('phoneNumber');
	$message = Input::get('message');

	// Create an authenticated client for the Twilio API
	$client = new Services_Twilio('AC381cdea9a54fd69ae1254fff289c08a7', 'f4bdb2f2a0e9acbc7649eee3a2f42fb3');

	// Use the Twilio REST API client to send a text message
	$m = $client->account->messages->sendMessage(
			'+12242053337', // the text will be sent from your Twilio number
			$number, // the phone number the text will be sent to
			$message // the body of the text message
	);

	// Return the message object to the browser as JSON
	return $m;
});

Route::get('test', function()
{
	return View::make('pages.test');
});

//---------------------//