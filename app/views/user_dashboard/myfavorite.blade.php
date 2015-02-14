





@extends('layouts.default')
@section('content')
			<div class="container">
			<div class="row">
				<h1 class="text-center">Dashboard</h1>
			</div>
			<div class="col-md-2">
				<div class="list-group">
					  <a href="#" class="list-group-item active">
					    Dashboard
					  </a>
					  <a href="profile" class="list-group-item">My Profile</a>
					  <a href="jobs" class="list-group-item">Jobs</a>
					  <a href="myinvites" class="list-group-item">My Invites</a>
					  <a href="myfavorites" class="list-group-item">My favorites</a>
				</div>

			</div>
			<div class="col-md-10">
				
				 <div class="panel panel-default">
				 	<!-- Default panel contents -->
				 	<div class="panel-heading">My Favorite Builder</div>
				 		<table class="table">
				 			<thead>
				 				<tr>
				 					<th>Username</th>
				 					<th>Email</th>
				 					<th>Phone_number</th>
				 					<th>  Like</th>
				 				</tr>
				 			</thead>
				 			<tbody>
				 				@foreach($data as $datas)
					 				<tr>
					 					<td>{{$datas->username}}</td>
					 				
					 					<td>{{$datas->email}}</td>
					 					<td>{{$datas->phone_number}}</td>
					 					<td><button type="button" class="btn btn-large btn-block btn-danger"><span class="glyphicon glyphicon-download"></span> Dislike</button></td>
					 				</tr>	
								@endforeach
				 				
				 			</tbody>
				 		</table>
				 </div>
                </div>
     
			</div>
		</div>
		
		
		

		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
@stop