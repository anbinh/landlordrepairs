
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
					  <a href="#" class="list-group-item">Pending reviews</a>
					  <a href="{{URL::route('builder-completed-jobs')}}" class="list-group-item">Completed jobs</a>
					  <a href="{{URL::route('customer-invited')}}" class="list-group-item">Invite jobs</a>
					  <a href="{{URL::route('credit')}}" class="list-group-item">Credit</a>
					  
					  
				</div>

			</div>
			<div class="col-md-10">
				<div class="row">
				    <div class="col-lg-6">
				        <div class="panel panel-default">
				            <div class="panel-heading">
				                Remain Money in Account
				            </div>
					            <div class="panel-body">
					                <div class="row">
					                    <div class="col-lg-12">
					                       Active until: {{$builder->active_until}}
				                    </div>	
				                </div>
				            </div>
				        </div>
				    </div>
   
    <div class="col-lg-6">
				        <div class="panel panel-default">
				            <div class="panel-heading">
				                Option Renewals
				            </div>
			            <div class="panel-body">
			            	@if(Session::get("error") == '1')
		                        <div class="alert alert-danger alert-dismissable">
		                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		                            Error, please check your credit card and type again
		                        </div>
	                        @endif
	                        @if(Session::get("error") == '0')
		                        <div class="alert alert-success alert-dismissable">
		                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		                            Success
		                        </div>
	                        @endif
			                <div class="row">
			                    <div class="col-lg-12">
			                
			                <form action = "change-package-pay-type" method = "POST">
								<div class="pad-top">
									<div class="form-control-wrapper" >
										<div class="radio">
											  <label>
											    <input type="radio" name="package_pay_type" value="1" id = "detail1" @if( $builder->package_pay_type == "1") checked @endif >
											    Auto
											  </label>
											   <label>
											    <input type="radio" name="package_pay_type" value="0" @if( $builder->package_pay_type == "0") checked @endif>
											    Manual
											  </label>
											 
										</div>
									<button class = "btn btn-sucesss">Change</button>			
									</div>		
								</div>
							</form>

		                            
			                    </div>	
			                </div>
			                <hr>
			             
			            </div>
			        </div>
			    </div>
			    <div class="col-lg-6">
			        <div class="panel panel-default">
			            <div class="panel-heading">
			                Topup Credit
			            </div>
				        <div class="panel-body">
				          	<form action="topup-credit-manual" method="POST">
				          		  
								  <button class = "btn btn-success"> Pay </button>
							</form> 
			            </div>
			        </div>
			    </div>
			    <div class="col-lg-6">
			        <div class="panel panel-default">
			            <div class="panel-heading">
			                Change Credit Info
			            </div>
				        <div class="panel-body">
				          	<form action="change-credit-info" method="POST">
								  <script							
								    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
								    data-key="pk_test_4ujZrZIZnpNkS2vh2isDqLQ7"
								    data-amount= ""
								    data-name="Demo Site"
								    data-description=""
								    data-image="https://stripe.com/img/documentation/checkout/marketplace.png">
								  </script>
								 
							</form> 
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