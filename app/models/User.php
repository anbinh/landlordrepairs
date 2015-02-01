<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	public function getByPage($page = 1, $limit = 10){
	    $results = new StdClass;
	    $results->page = $page;
	    $results->limit = $limit;
	    $results->totalItems = 0;
	    $results->items = array();
	    $users = User::skip($limit * ($page - 1))
	                           ->take($limit)
	                           ->get();  
	    $totalCont = User::all()->count();
	    $results->totalItems = $totalCont;
	    $results->items = $users->all();  
	    return $results;
	}

	public function getUserByAlbumId($album_id) {
		$owner = User::join('users_albums', 'users.id', '=', 'users_albums.user_id')
						->join('albums', 'albums.id', '=', 'users_albums.album_id')
						->where('albums.id', '=', $album_id)
						->first();

		if($owner) {
			return $owner;
		}

		return false;
	}
	
	public function getRememberToken()
{
    return $this->remember_token;
}

public function setRememberToken($value)
{
    $this->remember_token = $value;
}

public function getRememberTokenName()
{
    return 'remember_token';
}

}