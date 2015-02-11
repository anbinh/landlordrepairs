







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
				 		<!--<div class="panel-body">
				 			<p>Number of Builder</p>
				 		</div>
				 		-->
				 
				 		<!-- Table -->
				 		
				 		
				 		
				 		<table class="table">
				 			<thead>
				 				<tr>
				 					
				 					<th>Title</th>
				 				
				 					<th>Builder Invite</th>
				 					
				 				</tr>
				 			</thead>
				 			<tbody>
				 				<?php
							 		for($i=0;$i<$n_jobs;$i=$i+1)
							 		{   echo '<tr><td>';
							 			 echo $jobs[$i]->tittle;
							 			 echo '</td><td>';

							 			for($j=0;$j<$n_user[$i+1];$j=$j+1)
							 				{echo $user[$i+1][$j]->username;echo ' ';}
							 				echo '</td></tr>';

							 		}
				 				?>
				 				
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