<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

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
	protected $hidden = array('password', 'remember_token');
	public function getByPage($page = 1, $limit = 3)
	    {
	      $results = new StdClass;
	      $results->page = $page;
	      $results->limit = $limit;
	      $results->totalItems = 0;
	      $results->items = array();
	     
	      $users = User::skip($limit*($page-1))->take($limit)->get();
	     
	      $results->totalItems = User::count();
	      $results->items = $users->all();
	     
	      return $results;
	    }

}
