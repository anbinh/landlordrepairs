<?php
class HoangkhaController extends BaseController{
	public function getProfile()
	{

		$user = Auth::user();
		return View::make('hoangkha.dashboard')->with('user', $user);

	}
	public function getJob()
	{
		return View::make('hoangkha.getjob');
	}
	public function getMyInvite()
	{
		$jobs = DB::select('select id from jobs where user_id = ?',[Auth::id()]);
		$n= count($jobs);
		if ($n>=1){
				$a[]=$jobs[0]->id;
				for ($i=1;$i<$n;$i=$i+1)
					{
						//lay danh sach id cua favorite 
						$a[]=$jobs[$i]->id;
					}
					//return $a;

					$ketqua = Invite::where('postjob_id','=',26)->get();
					return $ketqua;

				//$ketqua = DB::select('select * from invites where user_id = ?',[Auth::id()]);
			}
		//return Job::all();
		//return View::make('hoangkha.myinvite');

	}
	public function getMyFavorite()
	{
		if (Auth::check())
		{
			$id_user=Auth::id();
			$users = Favorite::where('user_id','=',$id_user)->get();
			$n = $users->count();
			if ($n>=1){
				$a[]=$users[0]->favorite_id;
				for ($i=1;$i<$n;$i=$i+1)
					{
						//lay danh sach id cua favorite 
						$a[]=$users[$i]->favorite_id;
					}
					$data = User::find($a);
					return View::make('hoangkha.myfavorite')->with('data',$data);

			}
			
			return View::make('hoangkha.myfavorite')->with('data','');

		}

	}
}