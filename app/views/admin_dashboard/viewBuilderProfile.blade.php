
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
		                            <div class="form-group">
		                                <label>Name</label>
		                                {{$builder[0]->username}}
		                                
		                            </div>
		                           
		                            <div class="form-group">
		                                <label>Email</label>
		                                {{$builder[0]->email}}
		                                
		                            </div>
		                            
		                            <div class="form-group">
		                                <label>Company</label>
		                                {{$builder[0]->tittle}}
		                                
		                            </div>
		                            
		                            <div class="form-group">
		                                <label>Local</label>
		                                {{$builder[0]->local}}
		                                
		                            </div>
		                            
		                             <div class="form-group">
		                                <label>Local code</label>
		                                {{$builder[0]->local_code}}
		                                
		                            	
		                            </div>
		                            <div class="pad-top">
										<div class="form-control-wrapper" >
											
										</div>	
										
									</div>
		                    
                            
		                            <div class="form-group">
		                                <label>Site Link</label>
		                                {{$builder[0]->site_link}}
		                                
		                            </div>
		                             <div class="form-group">
		                                <label>Social Link</label>
		                                {{$builder[0]->social_link}}
		                                
		                            </div>
		                            
		                             <div class="form-group">
		                                <label>Started At</label>
		                                {{$builder[0]->created_at}}
		                                
		                            </div>
		                            <div class="form-group">
		                                <label>Association</label>
		                                <img style = "width: 50px; height: 50px; margin-left: 15px;" src="{{$builder[0]->association_src}}"/>
		                                {{$builder[0]->association_name}}
				                                
				                    </div>
			                    </div>	
			                </div>
			            </div>
			        </div>
			        
			        <!-- <a class = "btn btn-primary" href = "{{URL::route('myfavorites')}}" >Back</a> -->
			    </div>
			    
			    <div class="col-lg-6">
				        <div class="panel panel-default">
				            <div class="panel-heading">
				                History Jobs
				            </div>
			            <div class="panel-body">
			            @foreach ($builder as $buildere) 
			                <div class="row">
			                    <div class="col-lg-12">

		                            <div class="form-group">
		                                <label>Jobs tittle</label>
		                                {{$buildere->tittle}}
		                                
		                            </div>
		                            
		                             <div class="form-group">
		                                <label>Jobs property</label>
		                                {{$buildere->property}}
		                                
		                            </div>
		                            
		                            <div class="form-group">
		                                <label>Jobs category</label>
		                                {{$buildere->content}}
		                                
		                            </div>
		                            
		                            <div class="form-group">
		                                <label>Jobs decription</label>
		                                {{$buildere->description}}
		                                
		                            </div>
		                            <div class="form-group">
		                                <label>User price</label>
		                                {{$buildere->price}}
		                                
		                            </div>
		                            <div class="form-group">
		                                <label>Builder vote</label>
		                                {{$buildere->vote}}
		                                
		                            </div>
		                            <div class="form-group">
		                                <label>Created at</label>
		                                {{$buildere->created_at}}
		                                
		                            </div>
		                            <div class="form-group">
		                                <label>Job status</label>
		                                {{$buildere->status_process}}
		                                
		                            </div>

			                    </div>	
			                </div>
			                <hr>
			                @endforeach
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