<?php

class Album extends Eloquent {

	public $timestamps = false;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'albums';

	public function getByPage($page = 1, $limit = 10){
	    $results = new StdClass;
	    $results->page = $page;
	    $results->limit = $limit;
	    $results->totalItems = 0;
	    $results->items = array();
	    $users = Album::skip($limit * ($page - 1))
	                           ->join('users_albums', 'albums.id', '=', 'users_albums.album_id')
	                           ->join('users', 'users.id', '=', 'users_albums.user_id')
	                           ->take($limit)
	                           ->get();  
	    $totalCont = Album::all()->count();
	    $results->totalItems = $totalCont;
	    $results->items = $users->all(); 

	    //var_dump($results);exit;
	    return $results;
	}

	public function getByPageUser($user_id, $page = 1, $limit = 10){
	    $results = new StdClass;
	    $results->page = $page;
	    $results->limit = $limit;
	    $results->totalItems = 0;
	    $results->items = array();
	    $users = Album::skip($limit * ($page - 1))
	                           ->join('users_albums', 'albums.id', '=', 'users_albums.album_id')
	                           ->join('users', 'users.id', '=', 'users_albums.user_id')
	                           ->where('users_albums.user_id', '=', $user_id)
	                           ->take($limit)
	                           ->get();  
	    $totalCont = Album::all()->count();
	    $results->totalItems = $totalCont;
	    $results->items = $users->all(); 

	    //var_dump($results);exit;
	    return $results;
	}

}