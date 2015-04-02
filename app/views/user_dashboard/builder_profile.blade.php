
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
				                        @if ($builder[0]->association_name === "Gas")
				                        	Gas number: {{$builder[0]->gas_number}}
				                        @endif        
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
			            @if ($builder_jobs != "")
			            @foreach ($builder_jobs as $buildere) 
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
		                            @if ($buildere->status_process == "completed")
		                            	<div class="form-group">
		                                <label>Feedback:</label>
		                                </br>
		                          
		                                @for ($i = 0; $i < count($feedbacks_created_at[$buildere->job_id]); $i++)
		                                	---{{$feedbacks_created_at[$buildere->job_id][$i]}}---</br>
		                                	{{$feedbacks_content[$buildere->job_id][$i]}}</br>
		                                	Post by: <a>{{$feedbacks_by_user[$buildere->job_id][$i]->username}}</a>
		                                	
		                                	<hr>
		                                @endfor
		                                
		                            	</div>
		                            @endif
		                            

			                    </div>	
			                </div>
			                <hr>
			                @endforeach
			                @endif
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