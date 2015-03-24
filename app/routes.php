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
{      Session::set('hao','en');
        
	return View::make('pages.home');
}));

Route::get('register', 'BaseController@getRegister');
Route::post('register', 'BaseController@postRegister');
Route::get( 'confirm/{id_code}', array( 'uses' => 'BaseController@confirm' ));
Route::get('login', 'BaseController@getLogin');
Route::post('login','BaseController@postLogin');

Route::get('phoneconfirm', 'BaseController@getPhoneconfirm');
Route::post('phoneconfirm','BaseController@postPhoneconfirm');


Route::get('logout', array('as'=>'logout','uses' => 'BaseController@logout' ));
Route::get('forgetpass', 'BaseController@getForgetpass');
Route::post('forgetpass', 'BaseController@postForgetpass');

Route::get('restore',array('as'=>'restore-page', function()
{
	return View::make('pages.restore');
}));
Route::post('restore', 'BaseController@postForgetpass');

Route::get( 'changepass/{id_code}', array( 'uses' => 'BaseController@changepass' ));


Route::get('postjob', array('as'=>'postjob-page','uses'=>'BaseController@getPostjob'));
Route::post('postjob', 'BaseController@postPostjob');



Route::group(array('prefix' => 'api/v1'), function(){
	Route::resource('users', 'UserController');
});
//---------------------//
Route::get('admin',array('as'=>'admin-page','uses'=>'AdminController@getIndex'));
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


//------------------------------//
Route::get( 'redirectpconfirm/{id_code}', array( 'uses' => 'BaseController@redirectpconfirm' ));
Route::get('pconfirm', 'BaseController@getpconfirm');
Route::post('pconfirm', 'BaseController@postpconfirm');
Route::get( 'passchange', array( 'uses' => 'HomeController@getPassChange' ));
Route::post( 'passchange', array( 'uses' => 'HomeController@postPassChange' ));
Route::group(array('before' => 'auth'), function(){

	Route::get('dashboard', 'DashboardController@getIndex');
	Route::get('dashboard/profile', 'DashboardController@getProfile');
	Route::post('dashboard/profile', 'DashboardController@postProfile');

});

Route::get('profile',array('as'=>'profile','uses' => 'BaseController@getProfile' ));
Route::post('change_user_profile','BaseController@postChangeUserProfile');
Route::post('change_password','BaseController@postChangePassword');
Route::post('change_phonenumber','BaseController@postChangePhoneNumber');

Route::get('user/jobs','BaseController@getJob');
Route::get('user/myinvites','BaseController@getMyInvite');
Route::get('user/myfavorites','BaseController@getMyFavorite');



Route::get('delete_account', array('as'=>'delete_account','uses' => 'BaseController@getDelete_account' ));
Route::post('delete_account', array('as'=>'delete_account','uses' => 'BaseController@postDelete_account' ));

Route::post('dashboard_postjob', 'HoangkhaController@postDashboardPostjob');


Route::get('openjobs',array('as'=>'openjobs','uses' => 'BaseController@getOpenJobs' ));

Route::get('ongoingjobs',array('as'=>'ongoingjobs','uses' => 'BaseController@getOngoingJobs' ));

Route::get('cancelledjobs',array('as'=>'cancelledjobs','uses' => 'BaseController@getCancelledJobs' ));
Route::post('customer-action-cancelled', array( 'uses' => 'BaseController@postCustomerActionCancelled' ));

Route::get('pendingreview',array('as'=>'pendingreview','uses' => 'BaseController@getPendingReviewJobs' ));

Route::get('completedjobs',array('as'=>'completedjobs','uses' => 'BaseController@getCompletedJobs' ));

Route::get('myinvites',array('as'=>'myinvites','uses' => 'BaseController@getMyInvites' ));

Route::get('myfavorites',array('as'=>'myfavorites','uses' => 'BaseController@getMyFavorites' ));
Route::post('customer-find-favorite-builders', 'BaseController@postCustomerFindFavoriteBuilders');
Route::get('view-detail-info-builder/{builder_id}', array('uses' => 'BaseController@getViewDetailInfoBuilder' ));
Route::post('customer-action-delete-favorite-builder', 'BaseController@postCustomerActionDeleteFavoriteBuilder');
Route::post('customer-action-add-favorite-builder', 'BaseController@postCustomerActionAddFavoriteBuilder');


Route::get( 'accept-vote/{builder_id},{job_id}', array( 'uses' => 'BaseController@getAcceptVote' ));

Route::get( 'cancel-vote/{builder_id},{job_id}', array( 'uses' => 'BaseController@getCancelVote' ));

Route::get('view-detail-info-builder-with-job/{builder_id},{job_id}', array('uses' => 'BaseController@getViewDetailInfoBuilderWithJob' ));
//-----TEST DISTANCE GOOGLEMAP------//




Route::get('listbuilders', 'BaseController@getListbuilders');
Route::post('listbuilders', 'BaseController@postListbuilders');

//------BUILDERS--------------------//


Route::get('register-builder', 'BaseController@getRegisterBuilder');
Route::post('register-builder', 'BaseController@postRegisterBuilder');

Route::post('paypackagebuilder', 'BaseController@postPayPackageBuilder');


Route::get('builder-profile', array('as'=>'builder-profile','uses' => 'BaseController@getBuilderProfile' ));
Route::post('builder-profile', 'BaseController@postBuilderProfile');
Route::post('change_builder_profile','BaseController@postChangeBuilderProfile');

Route::get('customer-invited', array('as'=>'customer-invited','uses' => 'BaseController@getBuilderInvited' ));
Route::post('customer-invited', 'BaseController@postBuilderInvited');

Route::get('builder-find-jobs', array('as'=>'builder-find-jobs','uses' => 'BaseController@getBuilderFindJobs' ));
Route::post('builder-find-jobs', 'BaseController@postBuilderFindJobs');

Route::get('builder-ongoing-jobs', array('as'=>'builder-ongoing-jobs','uses' => 'BaseController@getBuilderOngoingJobs' ));

Route::get('builder-lost-jobs', array('as'=>'builder-lost-jobs','uses' => 'BaseController@getBuilderLostJobs' ));

Route::get('builder-won-jobs', array('as'=>'builder-won-jobs','uses' => 'BaseController@getBuilderWonJobs' ));

Route::get('builder-cancelled-jobs', array('as'=>'builder-cancelled-jobs','uses' => 'BaseController@getBuilderCancelledJobs' ));

Route::get('builder-completed-jobs', array('as'=>'builder-completed-jobs','uses' => 'BaseController@getBuilderCompletedJobs' ));

Route::post( 'builder-action-completed', array( 'uses' => 'BaseController@getBuilderActionCompleted' ));

Route::post( 'builder-action-cancelled', array( 'uses' => 'BaseController@postBuilderActionCancelled' ));
Route::get( 'cancelledjobconfirm/{job_id},{confirm_code}', array( 'uses' => 'BaseController@getconfirmCancelledJob' ));

Route::post( 'builder-submit-job-details', array( 'uses' => 'BaseController@postBuilderSubmitJobDetails' ));


Route::get( 'view-detail-job-alert/{id_code},{user_id}', array( 'uses' => 'BaseController@getViewDetailJobAlert' ));

Route::post('vote-job', 'BaseController@postVoteJob');



/*
 * ADMIN
 */
Route::get('admin-manage-builders', array('as'=>'admin-manage-builders','uses' => 'BaseController@getAdminManageBuilders' ));
Route::get('admin-view-detail-info-builder/{builder_id}', array('uses' => 'BaseController@getAdminViewDetailInfoBuilder' ));
Route::post('admin-action-delete', 'BaseController@postAdminDeleteBuilder');
Route::post('admin-action-edit-builder', 'BaseController@postAdminEditBuilder');
Route::post('admin-change_builder_profile','BaseController@postAdminChangeBuilderProfile');

Route::get('admin-manage-users', array('as'=>'admin-manage-users','uses' => 'BaseController@getAdminManageUsers' ));
Route::get('view-detail-info-user/{user_id}', array('uses' => 'BaseController@getViewDetailInfoUser' ));
Route::post('admin-action-delete-user', 'BaseController@postAdminDeleteUser');
Route::post('admin-action-edit-user', 'BaseController@postAdminEditUser');
Route::post('admin-change_user_profile', 'BaseController@postAdminChanegUserProfile');

Route::get('admin-today-jobs', array('as'=>'admin-today-jobs','uses' => 'BaseController@getAdminTodayJobs' ));

Route::get('admin-new-users', array('as'=>'admin-new-users','uses' => 'BaseController@getAdminNewUsers' ));

Route::get('admin-new-builders', array('as'=>'admin-new-builders','uses' => 'BaseController@getAdminNewBuilders' ));

Route::get('admin-invites-sent-by-users', array('as'=>'admin-invites-sent-by-users','uses' => 'BaseController@getAdminInviteSentByUsers' ));

Route::post('admin-ban','BaseController@postAdminBan');
Route::post('admin-un-ban','BaseController@postAdminUnBan');

Route::get('admin-manage-associations', array('as'=>'admin-manage-associations','uses' => 'BaseController@getAdminManageAssociations' ));

Route::any('form-submit-save-association-logo','BaseController@postSubmitSaveAssociationLogo');
Route::any('form-submit-save-association-logo-url','BaseController@postSubmitSaveAssociationLogoURL');
Route::any('form-submit-change-association-name','BaseController@postSubmitChangeAssociationName');

Route::get('admin-non-reply-email', array('as'=>'admin-non-reply-email','uses' => 'BaseController@getAdminNonReplyEmail' ));

Route::post('admin-change-content-email','BaseController@postAdminChangeContentEmail');

Route::get('admin-manage-faq', array('as'=>'admin-manage-faq','uses' => 'BaseController@getAdminMangeFAQ' ));

Route::post('admin-change-content-faq','BaseController@postAdminChangeContentFAQ');

Route::get('admin-plus-faq/{type}','BaseController@getAdminPlusFAQ');

Route::post('admin-plus-faq', array('as'=>'admin-plus-faq','uses' => 'BaseController@postAdminPlusFAQ' ));

Route::post('admin-delete-faq','BaseController@postAdminDeleteFAQ');

Route::get('admin-manage-category', array('as'=>'admin-manage-category','uses' => 'BaseController@getAdminManageCategorys' ));

Route::post('admin-delete-category', array('as'=>'admin-delete-category','uses' => 'BaseController@postAdminDeleteCategory' ));

Route::post('admin-plus-category', array('as'=>'admin-plus-category','uses' => 'BaseController@postAdminPlusCategory' ));

Route::get('FAQ-User', array('as'=>'FAQ-User','uses' => 'BaseController@getFAQUser' ));

Route::get('FAQ-Builder', array('as'=>'FAQ-Builder','uses' => 'BaseController@getFAQBuilder' ));

Route::get('admin-manage-charges', array('as'=>'admin-manage-charges','uses' => 'BaseController@getAdminManageCharges' ));

Route::post('admin-manage-charges', array('as'=>'admin-manage-charges','uses' => 'BaseController@postAdminManageCharges' ));

//------
Route::get('chargePackage',function(){
//$input = Input::all(); 
//		$amount = Input::get('amount');
//		
//		Stripe::setApiKey("sk_test_gdKc5TYgUWYr7ey4rpeUbE9b");
//
//		// Get the credit card details submitted by the form
//		$token = $_POST['stripeToken'];
//		
//		// Create the charge on Stripe's servers - this will charge the user's card
//		try {
//		$charge = Stripe_Charge::create(array(
//		  "amount" => $amount, // amount in cents, again
//		  "currency" => "usd",
//		  "card" => $token,
//		  "description" => "payinguser@example.com")
//		);
//		//----do something after charge success---//
//		echo '<pre>'; 
//		var_dump($charge); die;
//		echo '</pre>'; 
//		return Redirect::to('login')->with("emailfirst", "1");
//		} catch(Stripe_CardError $e) {
//		  // The card has been declined
//		}

	Stripe::setApiKey("sk_test_gdKc5TYgUWYr7ey4rpeUbE9b");

	$plan = Stripe_Plan::create(array(
	  "amount" => 2000,
	  "interval" => "month",
	  "name" => "Amazing Gold Plan",
	  "currency" => "usd",
	  "id" => "gold")
	);
	var_dump($plan); die;
});

Route::get('testpay', function(){
	return View::make('pages.testpay');
});

Route::get('createCustomer',function(){

	Stripe::setApiKey("sk_test_gdKc5TYgUWYr7ey4rpeUbE9b");

	$charge = Stripe_Charge::create(array(
		  "amount" => 1000, // amount in cents, again
		  "currency" => "gbp",
		  "customer" => 'cus_5vl3OTFaHTTvP3',
		  "description" => "payinguser@example.com")
		);
	var_dump($charge); die;
});

Route::get('haonguyen',function(){

					DB::table('transactions')
					->insert(array(
						'builder_id' => '1000', 
						'charge_type' => '-1',
						'charge_value' => '1001', 
					)); echo "test"; die;
});

Route::post('add-to-schedule-waitingjobs', array('as'=>'add-to-schedule-waitingjobs','uses' => 'BaseController@postAddJobToScheduleWaiting' ));

Route::get('waiting-openjobs', array('as'=>'waiting-openjobs','uses' => 'BaseController@getWaitingOpenJobs' ));

Route::post('waitingjob-find-builders', array('as'=>'waitingjob-find-builders','uses' => 'BaseController@postWaitingJobFindBuilder'));

Route::post('user-delete-job', array('as'=>'user-delete-job','uses' => 'BaseController@postDeleteWaitingJob'));

Route::get('credit', array('as'=>'credit','uses' => 'BaseController@getCredit' ));

Route::post('upgrade-credit-custom', array('as'=>'upgrade-credit-custom','uses' => 'BaseController@postUpgradeCreditCustom'));
Route::post('upgrade-credit-auto', array('as'=>'upgrade-credit-auto','uses' => 'BaseController@postUpgradeCreditAuto'));

Route::get('testBuilderActive', array('as'=>'testBuilderActive','uses' => 'BaseController@getTestBuilderActive' ));

Route::post('change-package-pay-type', array('as'=>'change-package-pay-type','uses' => 'BaseController@postChangePackagePayType'));

Route::post('topup-credit-manual', array('as'=>'topup-credit-manual','uses' => 'BaseController@postTopupCreditManual'));

Route::post('change-credit-info', array('as'=>'change-credit-info','uses' => 'BaseController@postChangeCreditInfo'));