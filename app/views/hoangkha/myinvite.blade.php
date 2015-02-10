<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Title Page</title>

		<!-- Bootstrap CSS -->
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<div class="container">
			<div class="row">
				<h1 class="text-center">Dashboard</h1>
			</div>
			<div class="col-md-2">
				<div class="list-group">
					  <a href="#" class="list-group-item active">
					    Dashboard
					  </a>
					  <a href="/hoangkha/profile" class="list-group-item">My Profile</a>
					  <a href="/hoangkha/jobs" class="list-group-item">Jobs</a>
					  <a href="/hoangkha/myinvites" class="list-group-item">My Invites</a>
					  <a href="/hoangkha/myfavorites" class="list-group-item">My favorites</a>
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
	</body>
</html>