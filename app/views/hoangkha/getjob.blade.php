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
				 <div class="row">
                   
                    <ul class="nav nav-tabs">
                        <li><a href="#open" data-toggle="tab">OPEN JOB</a></li>
                        <li><a href="#ongoing" data-toggle="tab">ONGOING JOP</a></li>
                        <li><a href="#cancell" data-toggle="tab">CACELL JOB</a>
                        </li>
                        <li><a href="#review" data-toggle="tab">PENDING REVIEW</a></li>
                        <li><a href="#completed" data-toggle="tab">COMPLETED JOB</a></li>
                    </ul>
 
                    <div class="tab-content">
                        <div class="tab-pane" id="open">DATA JOB OPEN</div>
                        <div class="tab-pane" id="ongoing">DATA JOB ONGOING</div>
                        <div class="tab-pane" id="cancell">DATA JOB CANCELL</div>
                        <div class="tab-pane" id="review">PENDING REVIEW</div>
                        <div class="tab-pane" id="completed">COMPLETED JOB</div>
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