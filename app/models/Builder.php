<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Builder extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'builders';

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
	     
	      $builders = Builder::skip($limit*($page-1))->take($limit)->get();
	     
	      $results->totalItems = Builder::count();
	      $results->items = $builders->all();
	     
	      return $results;
	    }

}
