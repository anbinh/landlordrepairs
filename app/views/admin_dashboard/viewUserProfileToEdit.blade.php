
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
					<a href="{{URL::route('admin-manage-builders')}}" class="list-group-item">Builders Profile</a>
					  <a href="{{URL::route('admin-manage-users')}}" class="list-group-item">Users Profile</a>
					  <a href="{{URL::route('admin-today-jobs')}}" class="list-group-item">Today jobs</a>
					  <a href="{{URL::route('admin-new-users')}}" class="list-group-item">New Users</a>
					  <a href="{{URL::route('admin-new-builders')}}" class="list-group-item">New Builders</a>
					  <a href="{{URL::route('admin-invites-sent-by-users')}}" class="list-group-item">Invites Sent</a>
					  <a href="{{URL::route('admin-manage-associations')}}" class="list-group-item">Manage Associaion</a>
					  <a href="{{URL::route('admin-non-reply-email')}}" class="list-group-item">Non Rely Email</a>
					  <a href="{{URL::route('admin-manage-faq')}}" class="list-group-item">FAQs</a>
					  <a href="{{URL::route('admin-manage-category')}}" class="list-group-item">Categorys</a>
					   <a href="{{URL::route('admin-manage-charges')}}" class="list-group-item">Charges</a>
				</div>

			</div>
			<div class="col-md-10">
				<div class="row">
				    <div class="col-lg-6">
				        <div class="panel panel-default">
				            <div class="panel-heading">
				                Builder Profile
				            </div>
			            <div class="panel-body">
			                <div class="row">
			                    <div class="col-lg-12">
			                       {{ Form::open(array('url' => 'admin-change_user_profile')) }}
			                       <input hidden value = "{{$user->id}}" name = "user_id">
		                            <div class="form-group">
		                                <label>User name: </label>
		                                {{ Form::text('username', $user->username, array('placeholder' => 'Choose username', 'class' => 'form-control')) }}
		                            </div>
		                           
		                            <div class="form-group">
		                                <label>Email</label>
		                                {{ Form::text('email', $user->email, array('placeholder' => 'Type email','class' => 'form-control')) }}
		                            </div>
		                      
		                            <div class="form-group">
		                                <label>Phone number</label>
		                                {{ Form::text('phone_number', $user->phone_number, array('placeholder' => 'Type phone number','class' => 'form-control')) }}
		                            </div>
		                            <div class="pad-top">
										<div class="form-control-wrapper" >
											
										</div>	
												
									</div>

		                            {{ Form::submit('Change', array('class' => 'btn btn-primary')) }}
		                            
		                        {{ Form::close() }}
		                    </div>	
		                </div>
		            </div>
        </div>
    </div>

    <!-- end change phone number -->
</div>
			</div>
		</div>
		
		

		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
@stop