<?php
//app/model/test.php
class Test extends Eloquent {
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
	public function test_db() {
		$result = DB:: select('select * from users');
		return $result;
	}


	
}