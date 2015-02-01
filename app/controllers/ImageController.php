<?php

class ImageController extends BaseController {


	public function postUpload($user_id='') {

		$user_id_1 = ($user_id == "") ? "_user_" . time() : $user_id;

		$file = Input::file('profile_picture');
		$input = array('image' => $file);
		$rules = array(
			'profile_picture' => 'image'
		);
		$validator = Validator::make($input, $rules);
		if ( $validator->fails() )
		{
			return Response::json(['success' => false, 'errors' => $validator->getMessageBag()->toArray()]);

		}
		else {
			$destinationPath = 'uploads/users/';
			$filename = $user_id_1 . "." . $file->getClientOriginalExtension();
			Input::file('profile_picture')->move($destinationPath, $filename);
			return Response::json(['success' => true, 'file' => asset($destinationPath.$filename)]);
		}

	}

}

?>