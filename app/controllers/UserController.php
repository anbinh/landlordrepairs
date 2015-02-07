<?php
class UserController extends BaseController{
	/**
	*Display a listing of the resource
	*
	*@return Response
	*/

	public function index()
	{
		$users = User::get();
		return Response::json(array(
			'error' => false,
			'users' => $users->toArray()),
			200
			);
			
	//return "Test API successful";
	}

	/**
	*Store a newly created resource in storage.
	*
	*@return Response
	*/
	public function store()
	{
		$user = new User;
		$user->username = Request::get('username');
		$user->password = Request::get('password');
		$user->save();
		return Response::json(array(
			'error' => false,
			'message' => 'created user successful'),
		200
		);
	}

	/**
	*Display the specified resource
	*
	*@param int $id
	@Return Response
	*/
	public function show($id){
		$user = User::where('id',$id)
				->take(1)
				->get();
		return Response::json(array(
			'error' => false,
			'users' => $user->toArray()),
			200
			);
	}

	/**
	*update the specified resource in storage
	*
	*@param int $id
	*@return Response
	*/
	public function update($id)
	{
		$user = User::find($id);
		if (Request::get('username'))
		{
			$user->username = Request::get('username');

		}
		if (Request::get('password'))
		{
			$user->password = Request::get('password');
		}
		$user->save();
		return Response::json(array(
			'error' => false,
			'message' => 'Updated successfull'),
			200
		);
	}
	/**
	*
	*@param int $id
	*@return Response 
	*/
	public function destroy($id)
	{
		$user = User::find($id);
		$user->delete();
		return Response::json(array(
			'error' => false,
			'message' => 'Deleted Successfull'),
			200
			);
	}

}	