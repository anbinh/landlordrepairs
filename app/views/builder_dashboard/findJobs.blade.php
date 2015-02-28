
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
					  <a href="builder-profile" class="list-group-item">Profile</a>
					  <a href="builder-invited" class="list-group-item">Job Alerts</a>
					  <a href="builder-find-jobs" class="list-group-item">Find Jobs</a>
					  <a href="#" class="list-group-item">On going Jobs</a>
					  <a href="#" class="list-group-item">Lost jobs</a>
					  <a href="#" class="list-group-item">Won jobs</a>
					  <a href="#" class="list-group-item">Cancelled jobs</a>
					  <a href="#" class="list-group-item">Pending reviews</a>
					  <a href="#" class="list-group-item">Completed jobs</a>
					  <a href="#" class="list-group-item">Invite jobs</a>
					  <a href="#" class="list-group-item">Credit</a>
					  
				</div>

			</div>
			<div class="col-md-10">
				<div class="row">
				    <div class="col-lg-12">
				        <div class="panel panel-default">
				            <div class="panel-heading">
				                Search Jobs
				            </div>
			           		<div class="panel-body">
				                <div class="row">
				                    <div class="col-lg-12">
				                      
				                        @if(Session::get("cpsuccess") == "1")
				                        <div class="alert alert-success alert-dismissable">
				                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				                            User password has been changed successfully.
				                        </div>
				                        @endif
				                        {{ Form::open(array('url' => 'builder-find-jobs')) }}
				                            <div class="form-group">
				                                <label>Category</label>
				                                <select name = "category" class="form-control">
				                                 @if($builders != null)
              										@foreach($builders as $builder)
				                                
													<option value = "{{$builder->category}}">{{$builder->category}}</option>
											
													@endforeach
              									@endif
              									</select>
				                            </div>
				                           
				
				                            {{ Form::submit('Search', array('class' => 'btn btn-primary')) }}
				                           
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