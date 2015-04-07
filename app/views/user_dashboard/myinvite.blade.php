
@extends('layouts.default')
@section('content')
	<div class="container" style= "margin-bottom: 230px;">
			<div class="row">
				<h1 class="text-center">Dashboard</h1>
			</div>
			<div class="col-md-2">
				<div class="list-group">
					  <a href="#" class="list-group-item active">
					    Dashboard
					  </a>
					  <a href="{{URL::route('profile')}}" class="list-group-item">My Profile</a>
					  <a href="{{URL::route('openjobs')}}" class="list-group-item">Open Jobs</a>
					  <a href="{{URL::route('ongoingjobs')}}" class="list-group-item">Ongoing Jobs</a>
					  <a href="{{URL::route('cancelledjobs')}}" class="list-group-item">Cancelled Jobs</a>
					  <a href="{{URL::route('completedjobs')}}" class="list-group-item">Completed Jobs</a>
					  <a href="{{URL::route('myinvites')}}" class="list-group-item">My Invites</a>
					  <a href="{{URL::route('myfavorites')}}" class="list-group-item">My favorites Builders</a>
					  <a href="{{URL::route('postjob-page')}}" class="list-group-item">Post a Job</a>
					  <a href="{{URL::route('pending-reviews')}}" class="list-group-item">Pending reviews</a>
				</div>

			</div>
			<div class="col-md-10">
				<div class="row">
				    <div class="col-lg-12">
				        <div class="panel panel-default">
				            <div class="panel-heading">
				                Invite
				            </div>
			            <div class="panel-body">
			                <div class="row">
			                    <div class="col-lg-6">
			                      
			                        @if(Session::get("success") == '1')
			                        <div class="alert alert-success alert-dismissable">
			                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			                            Profile has been updated successfully.
			                        </div>
			                        @endif
			                        
			                       {{ Form::open(array('url' => 'sent-invite')) }}
			                       <h5>Do you know any Builder that you trust invite them to be part of the community!</h5>
		                            <div class="form-group">
		                                <label>Email</label>
		                                <input name = "email" class = "form-control" placeholder = "Type Email" required>
		                            </div>
		                            
		                           
		                            <div class="form-group">
		                                <label>Content</label>
		                                <textarea name = "content" class = "form-control" placeholder = "Your invite" required></textarea>
		                                
		                            </div>

		                            {{ Form::submit('Send', array('class' => 'btn btn-primary')) }}
		                            
		                        {{ Form::close() }}
		                    </div>
		                    <div class="col-lg-6">
			                     
			                        @if(Session::get("success") == '1')
			                        <div class="alert alert-success alert-dismissable">
			                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			                            Profile has been updated successfully.
			                        </div>
			
			                        @endif
			                        
			                       {{ Form::open(array('url' => 'sent-invite')) }}
		                            <h5>Do you know any landlords invite them to be part of the community!</h5>
		                            <div class="form-group">
		                            
		                                <label>Email</label>
		                                <input name = "email" class = "form-control" placeholder = "Type Email" required>
		                            </div>
		                            
		                           
		                            <div class="form-group">
		                                <label>Content</label>
		                                <textarea name = "content" class = "form-control" placeholder = "Your invite" required></textarea>
		                                
		                            </div>

		                            {{ Form::submit('Send', array('class' => 'btn btn-primary')) }}
		                            
		                        {{ Form::close() }}
		                    </div>
		                </div>
		            </div>
        </div>
    </div>
    <!-- end col-md-6-->
      
    <!-- end change password-->
     
    <!-- end change phone number -->
</div>
			</div>
		</div>
		
		

		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
@stop