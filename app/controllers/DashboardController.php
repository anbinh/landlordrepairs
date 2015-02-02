<?php

class DashboardController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    public function __construct()
    {
    	$this->beforeFilter(function(){
			$user = Auth::user();
			$admin = false;
			$admin = (Auth::check() && $user->role == "1") ? true : false;

			if(!Auth::check()) {
				return Redirect::to('/');
			}

		});

    }
	public function getIndex()
	{
		$user = Auth::user();
		if($user->role == "1") {
			return Redirect::to('admin');
		}
		return View::make('dashboard.index');
	}

	public function getProfile() {
		$user = Auth::user();
		return View::make('dashboard.profile')->with('user', $user);
	}

	public function postProfile() {
		$user = Auth::user();
		$user_id = $user->id;
		
		$input = Input::all();
	
		$profile_picture_submit = $user->profile_picture;

		$rules = array('profile_picture' => 'image', 'username' => 'required|unique:users,username,'.$user_id);

		$v = Validator::make($input, $rules);
		$fail = $v->fails();

		if($fail)
		{
			return Redirect::back()->withInput()->withErrors($v);

		} else { 
			
			//handle upload profile
			if($input['profile_picture_url']=='file_up') {
				$profile_picture_submit = $input['profile_pic_fl_url'];
			}
			if($input['profile_picture_url']=='facebook') {
				$profile_picture_submit = $input['profile_pic_fb_url'];
			}
			if($input['profile_picture_url']=='twitter') {
				$profile_picture_submit = $input['profile_pic_tw_url'];
			}
			//save settings to database
			$user = User::where('id', '=', $user_id)->first();
			//var_dump($settings);exit;

			$user->profile_picture = $profile_picture_submit;

			$user->username = $input['username'];
			$user->first_name = $input['first_name'];
			$user->last_name = $input['last_name'];

			$user->save();
			return Redirect::back()->with("success", "1");
		}		
	}

	public function getAddAlbum() {
		return View::make('dashboard.addalbum');
	}

	public function postAddAlbum() {
		$user = Auth::user();

		$input = Input::all();

		$rules = array('name' => 'required', 'music_link' => 'required', 'permalink' => 'required');

		$v = Validator::make($input, $rules);

		if($v->passes()) {

			$album = new Album;

			$album->name = $input['name'];
			$album->description = $input['description'];
			$album->location = $input['location'];
			$album->music_link = $input['music_link'];
			$album->cover_photo = $input['cover_photo'];
			$album->permalink = $input['permalink'];
			$album->publish = (isset($input['publish']) && $input['publish'] == '1') ? 1 : 0;

			$album->save();

			$user_album = new UsersAlbums;
			$user_album->user_id = $user->id;
			$user_album->album_id = $album['id'];
			$user_album->save();

			return Redirect::to("/dashboard/editalbum/" . $album->id);
		}
		return Redirect::back()->withErrors($v);
	}

	public function getAlbums($page = 1) {
	    //$page = Input::get('page', 1);
		$user = Auth::user();

	    $limit = 15;
	    $album = new Album;  // correct
	    $data = ($user->role == '1') ? $album->getByPage($page, $limit) : $album->getByPageUser($user->id, $page, $limit);
	    $albums = Paginator::make($data->items, $data->totalItems, $limit);

	    $data = array(	"albums" => $albums->getCollection()->all(),
	    				"pagination" => array(
	    								"page"=>$page,
	    								"pageSize" =>$albums->count(),
	    								"pageCount"=>ceil($albums->getTotal()/$albums->getPerPage()),
	    								"total"=>$albums->getTotal()
	    								)
	    			);

	    return View::make('dashboard.albums')->with('data', $data);		
	}

	public function getDelAlbum($album_id) {

		$user = Auth::user();
		$users_albums = new UsersAlbums();

		if (!($user->role == "1" || $users_albums->isOwner($album_id, $user->id))) {
			return Redirect::to('/');
		}

		DB::table('albums')->where('id','=',$album_id)->delete();
		DB::table('users_albums')->where('user_id','=',$user->id)
								->where('album_id','=',$album_id)
								->delete();

		return Redirect::back();
	}

	public function getEditAlbum($album_id) {
		$user = Auth::user();
		$users_albums = new UsersAlbums();

		if (!($user->role == "1" || $users_albums->isOwner($album_id, $user->id))) {
			return Redirect::to('/');
		}

		$user_owner = ($users_albums->isOwner($album_id, $user->id)) ? "1" : "0"; 

		$album = DB::table('albums')->where('id', '=', $album_id)->first();

		//get list photos
		$photo = new Photo();
		$photos = $photo->getPhotos($album_id);

		return View::make('dashboard.editalbum')->with('album', $album)->with('photo', $photos->items)->with('user_owner', $user_owner);	
	}

	public function postEditAlbum($album_id) {
		$user = Auth::user();
		$users_albums = new UsersAlbums();

		if (!($user->role == "1" || $users_albums->isOwner($album_id, $user->id))) {
			return Redirect::to('/');
		}

		$input = Input::all();

		$rules = array('name' => 'required', 'music_link' => 'required', 'permalink' => 'required');

		$v = Validator::make($input, $rules);

		if($v->passes()) {

			$album = Album::where('id', '=', $album_id)->first();

			$album->name = $input['name'];
			$album->description = $input['description'];
			$album->location = $input['location'];
			$album->music_link = $input['music_link'];
			$album->cover_photo = $input['cover_photo'];
			$album->permalink = $input['permalink'];
			$album->publish = (isset($input['publish']) && $input['publish'] == '1') ? 1 : 0;
			$album->lyrics = $input['lyrics'];

			$album->save();

			return Redirect::back()->with("cpsuccess", "1");
		}
		return Redirect::back()->withErrors($v);
	}

	public function postAddPhoto() {
		$result = array("success" => 0);

		$user = Auth::user();

		$input = Input::all();

		$true_url = explode("?", $input['img_url']);

		if(!file_exists("uploads/photos/".$user->id."/")) {
			mkdir("uploads/photos/".$user->id, 0777);
		}
		$file_name = "pic" . time() . "." . pathinfo($true_url[0], PATHINFO_EXTENSION);
		$dir = "uploads/photos/".$user->id."/";

		file_put_contents($dir . $file_name, file_get_contents($input['img_url']));

		if(!file_exists($dir.$file_name)) {
			return json_encode($result);
		}

		$photo = new Photo;

		$photo->description = $input['description'];
		$photo->relative_link = $dir . $file_name;
		$photo->permalink = $input['img_url'];
		$photo->save();		

		$user_album = new AlbumsPhotos;
		$user_album->album_id = $input['album_id'];
		$user_album->photo_id = $photo->id;
		$user_album->save();

		return json_encode(array("success" => 1, "photo_id" => $photo->id));

	}

	public function postDelPhoto() {
		$user = Auth::user();

		$input = Input::all();

		DB::table('album_photos')->where('album_id','=',$input['album_id'])
								->where('photo_id','=',$input['photo_id'])
								->delete();

		return json_encode(array("success" => 1));
	}

	public function getFindLyrics($soundcloud_url) {
		$soundcloud_client = "2eb969114a1d81ebc083ac6adc98c4d8";
		$sound_cloud_info = file_get_contents("http://api.soundcloud.com/resolve.json?url=".$soundcloud_url."&client_id=" . $soundcloud_client);

		$sound_cloud_info = json_decode($sound_cloud_info, true);
		$sound_title = $sound_cloud_info['title'];

		$sound_url = str_replace(" - ", ":", $sound_title);
		$sound_url = str_replace(" ", "_", $sound_url);

		$lyric_raw = file_get_contents("http://lyrics.wikia.com/" . $sound_url);

		preg_match_all("/<div class='lyricbox'>(.+?)<!--/s", $lyric_raw, $lyrics);
		
		if(isset($lyrics[0][0])) {
			$lyrics = $lyrics[0][0];
		}

		$lyrics = preg_replace('/<script\b[^>]*>(.*?)<\/script>/i', "", $lyrics);
		//var_dump($lyrics);
		$lyrics = preg_replace('/\<br(\s*)?\/?\>/i', "\n", $lyrics);
		$lyrics = strip_tags($lyrics);
		$lyrics = preg_replace('/Send(.*?)to your Cell Ad/i', "", $lyrics);

		return json_encode(array("lyrics" => $lyrics));

	}

	public function postFindLyricsByTitle() {

		$input = Input::all();

		$sound_title = str_replace(" ", "_", $input['song_title']);
		$sound_artist = str_replace(" ", "_", $input['song_artist']);

		$sound_url = trim($sound_artist) . ":" . $sound_title;

		$lyric_raw = file_get_contents("http://lyrics.wikia.com/" . $sound_url);

		preg_match_all("/<div class='lyricbox'>(.+?)<!--/s", $lyric_raw, $lyrics);
		
		if(isset($lyrics[0][0])) {
			$lyrics = $lyrics[0][0];
		}

		$lyrics = preg_replace('/<script\b[^>]*>(.*?)<\/script>/i', "", $lyrics);
		//var_dump($lyrics);
		$lyrics = preg_replace('/\<br(\s*)?\/?\>/i', "\n", $lyrics);
		$lyrics = strip_tags($lyrics);
		$lyrics = preg_replace('/Send(.*?)to your Cell Ad/i', "", $lyrics);

		return json_encode(array("lyrics" => $lyrics));

	}
	

}