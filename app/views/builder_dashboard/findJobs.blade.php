
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
					 <a href="{{URL::route('builder-profile')}}" class="list-group-item">Profile</a>
					  <a href="{{URL::route('customer-invited')}}" class="list-group-item">Job Alerts</a>
					  <a href="{{URL::route('builder-find-jobs')}}" class="list-group-item">Find Jobs</a>
					  <a href="{{URL::route('builder-ongoing-jobs')}}" class="list-group-item">Ongoing Jobs</a>
					  <a href="{{URL::route('builder-lost-jobs')}}" class="list-group-item">Lost jobs</a>					  
					  <a href="{{URL::route('builder-won-jobs')}}" class="list-group-item">Won jobs</a>
					  <a href="{{URL::route('builder-cancelled-jobs')}}" class="list-group-item">Cancelled jobs</a>
					 
					  <a href="{{URL::route('builder-completed-jobs')}}" class="list-group-item">Completed jobs</a>
					  <a href="{{URL::route('customer-invited')}}" class="list-group-item">Invite jobs</a>
					  <a href="{{URL::route('credit')}}" class="list-group-item">Credit</a>
					  <a href="{{URL::route('get-reviews')}}" class="list-group-item">Get review</a>
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
				                    <div class="col-lg-6">
				                      
				                        @if(Session::get("cpsuccess") == "1")
				                        <div class="alert alert-success alert-dismissable">
				                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				                            User password has been changed successfully.
				                        </div>
				                        @endif
				                        {{ Form::open(array('url' => 'builder-find-jobs/1')) }}
				                            <div class="form-group">
				                                <label>Category signed</label>
				                                <select name = "category_id" class="form-control">
				                                 @if($builder_categorys != null)
              										@foreach($builder_categorys as $builder_category)
				                                
													<option value = "{{$builder_category->category_id}}">{{$builder_category->content}}</option>
											
													@endforeach
              									@endif
              									</select>
				                            </div>
				                           
				
				                            {{ Form::submit('Search', array('class' => 'btn btn-primary')) }}
				                           
				                        {{ Form::close() }}
				                        
				                    </div>
				                    <div class="col-lg-6">
				                      
				                        @if(Session::get("cpsuccess") == "1")
				                        <div class="alert alert-success alert-dismissable">
				                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				                            User password has been changed successfully.
				                        </div>
				                        @endif
				                        {{ Form::open(array('url' => 'builder-find-jobs/0')) }}
				                            <div class="form-group">
				                                <label>Category not signed</label>
				                                <select name = "category_id" class="form-control">
				                                 @if($categorys != null)
              										@foreach($categorys as $category)
				                                	
													
													<script>var i = 0;</script>
														@foreach($builder_categorys as $builder_category)
														
							                                @if ($category->id == $builder_category->category_id)
							                        			<script>
							                        			 	i++; console.log('=',i); 
							                        			</script>        
							                                @endif
							                    
														@endforeach
														
														<script>
															console.log(i);
															if (i == 0) {
							                                	document.write('<option value = "{{$category->id}}">{{$category->content}}</option>');
															}
														</script>
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