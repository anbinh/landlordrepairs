<?php

class Photo extends Eloquent {

	public $timestamps = false;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'photos';

	public function getPhotos($album_id){
	    $results = new StdClass;
	    $results->items = array();
	    $photos = Photo::join('album_photos', 'photos.id', '=', 'album_photos.photo_id')
	                           ->join('albums', 'albums.id', '=', 'album_photos.album_id')
	                           ->where('album_photos.album_id', '=', $album_id)
	                           ->get();  


	    $results->items = $photos->all(); 

	    //var_dump($results);exit;
	    return $results;
	}

}