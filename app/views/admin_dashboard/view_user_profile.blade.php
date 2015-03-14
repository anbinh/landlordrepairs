
@extends('layouts.default')
@section('content')
<style>
			#country-list {
			    font-family: arial;
			    font-size: 14px;
			    width: 100%;
			}
			#country-list .country-table-head {
				border: 1px solid #bfbfbf;
				width: 100%;
			    border-radius: 4px;
			    -o-border-radius: 4px;
			    -moz-border-radius: 4px;
			    -webkit-border-radius: 4px;
				background: linear-gradient(to bottom, #fcfcfc, #dddcdb 99%);
				background: -o-linear-gradient(top, #fcfcfc, #dddcdb 99%);
				background: -ms-linear-gradient(top, #fcfcfc 0%, #dddcdb 99%);
				background: -moz-linear-gradient(top, #fcfcfc 0%, #dddcdb 99%);
				background: -webkit-linear-gradient(top, #fcfcfc 0%, #dddcdb 99%);
				background: -webkit-gradient(linear, left top, left bottom, color-stop(0, #fcfcfc), color-stop(1, #dddcdb));
				filter: progid:DXImageTransform.Microsoft.Gradient(GradientType=0,StartColorStr=#fcfcfc,EndColorStr=#dddcdb);
				-ms-filter: "progid:DXImageTransform.Microsoft.Gradient(GradientType=0,StartColorStr=#fcfcfc,EndColorStr=#dddcdb)";
				box-shadow: 2px 2px 4px rgba(0,0,0,0.2);
				-o-box-shadow: 2px 2px 4px rgba(0,0,0,0.2);
				-moz-box-shadow: 2px 2px 4px rgba(0,0,0,0.2);
				-webkit-box-shadow: 2px 2px 4px rgba(0,0,0,0.2);
			}
			#country-list tbody tr:nth-child(2n+2) {
			    background: none repeat scroll 0 0 #F6F6F6;
			}
			
			#country-list td{
				padding: 15px 0 15px 15px;
				color: #686868;
			  text-shadow: 0px 1px 0 #ddd;
			  border-left: 1px solid #999;
			  box-shadow: inset 10px 0 10px -10px rgba(0,0,0,0.5), inset -10px 0 10px -10px rgba(0,0,0,0.5);
			}
			#country-list a{
				color: #a50101;
			  text-decoration: none;
			}
			
			.country-table-head th{
				font-weight: normal;
				padding: 15px 0 15px 15px;
				text-align: left;
				border-right: 1px solid #c1c1c1;
				border-left: 1px solid #fff;
			}
			
			.country-table-head th:first-child{
				border-left: none;
				width: 200px;
			}
			.country-table-head span{
			  font-size: 12px;
			}
			</style>
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
					 
					  
					  
				</div>

			</div>
			<div class="col-md-10">
				<div class="row">
				    <div class="col-lg-12">
				        <div class="panel panel-default">
				            <div class="panel-heading">
				                User Profile
				            </div>
			            <div class="panel-body">
			                <div class="row">
			                    <div class="col-lg-12">
		                            <div class="form-group">
		                                <label>Name: </label>
		                                {{$user[0]->username}}
		    
		                            </div>
		                           
		                            <div class="form-group">
		                                <label>Email: </label>
		                                {{$user[0]->email}}
		                                
		                            </div>
		                            
		                           
		                            
		                          
                            
		                            
		                            
		                             <div class="form-group">
		                                <label>Started At: </label>
		                                
		                                 {{ $user[0]->created_at}}
		                                
		                            </div>
		                           
			                    </div>	
			                </div>
			            </div>
			        </div>
			        
			        <!-- <a class = "btn btn-primary" href = "{{URL::route('myfavorites')}}" >Back</a> -->
			    </div>
			    <div class="panel panel-default">
			   <label>Jobs history</label>
			    <div class="col-lg-12">
			    <table id="country-list" class="sortable-table">
										  <thead>
										    <tr class="country-table-head">
										    	
										      	<th><em>Tittle</em> <span>&nbsp;</span></th>
										     	<th><em>Description</em> <span>&nbsp;</span></th>
										     	<th><em>Price</em> <span>&nbsp;</span></th>
										     	<th><em>Property</em> <span>&nbsp;</span></th>
										     	<th><em>Category</em> <span>&nbsp;</span></th>
										     	<th><em>Time Option</em> <span>&nbsp;</span></th>
										     	<th><em>Local</em> <span>&nbsp;</span></th>
										     	<th><em>Local code</em> <span>&nbsp;</span></th>
										     	<th><em>Status</em> <span>&nbsp;</span></th>
										    </tr>
										  </thead>
										  <tbody>
										
										  @if($jobs != null)
															  
									  		@foreach($jobs as $job)
									  			<tr>
									  	
											  		<td>{{$job->tittle}}</td>
											  		<td>{{$job->description}}</td>
											  		<td>{{$job->price}}</td>
											  		<td>{{$job->property}}</td>
											  		<td>{{$job->content}}</td>
											  		<td>{{$job->timeoption}}</td>
											  		<td>{{$job->local}}</td>
											  		<td>{{$job->local_code}}</td>
											  		<td>{{$job->status}}</td>
											  		
											  	</tr>
										
							      			@endforeach						              	
							              @endif
							
										</table>
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