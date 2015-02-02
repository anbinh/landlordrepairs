<?php

class UsersAlbums extends Eloquent {

	public $timestamps = false;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users_albums';

	public function isOwner($album_id, $user_id) {
		$owner = UsersAlbums::where("user_id", "=", $user_id)
							->where("album_id", "=", $album_id)->first();

		if($owner) {
			return true;
		}

		return false;
	}
}