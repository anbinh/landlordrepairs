
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
					  <a href="{{URL::route('builder-lost-jobs')}}" class="list-group-item">Lost jobs</a>					  <a href="#" class="list-group-item">Lost jobs</a>
					  <a href="{{URL::route('builder-won-jobs')}}" class="list-group-item">Won jobs</a>
					  <a href="{{URL::route('builder-cancelled-jobs')}}" class="list-group-item">Cancelled jobs</a>
					  <a href="#" class="list-group-item">Pending reviews</a>
					  <a href="{{URL::route('builder-completed-jobs')}}" class="list-group-item">Completed jobs</a>
					  <a href="{{URL::route('customer-invited')}}" class="list-group-item">Invite jobs</a>
					  <a href="#" class="list-group-item">Credit</a>
					  
					  
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
			                       
			                        @if(Session::get("success") == '1')
			                        <div class="alert alert-success alert-dismissable">
			                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			                            Profile has been updated successfully.
			                        </div>
			                        @endif
			                        @if(Session::get("success") == '0')
			                        <div class="alert alert-danger alert-dismissable">
			                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			                            Wrong, The info you change is invalid, please try again.
			                        </div>
			                        @endif
			                        
			                       {{ Form::open(array('url' => 'change_builder_profile')) }}
		                            <div class="form-group">
		                                <label>Name</label>
		                                {{ Form::text('username', $builder[0]->username, array('placeholder' => 'Choose your username', 'class' => 'form-control')) }}
		                            </div>
		                           
		                            <div class="form-group">
		                                <label>Email</label>
		                                {{ Form::text('email', $builder[0]->email, array('placeholder' => 'Type your email','class' => 'form-control')) }}
		                            </div>
		                            
		                            <div class="form-group">
		                                <label>Company</label>
		                                {{ Form::text('company', $builder[0]->tittle, array('placeholder' => 'Type your company','class' => 'form-control')) }}
		                            </div>
		                            
		                            <div class="form-group">
		                                <label>Local</label>
		                                {{ Form::text('local', $builder[0]->local, array('placeholder' => 'Type your code','class' => 'form-control')) }}
		                            </div>
		                            
		                             <div class="form-group">
		                                <label>Local code</label>
		                                <input name = "local_code" id = "local_code" type="text" class="form-control" required placeholder = 'Post code'style = "z-index:2; margin-left: -42px;" value = "{{$builder[0]->local_code}}">
		                            	
		                            </div>
		                            <div class="pad-top">
								<div class="form-control-wrapper" >
									
								</div>	
										
							</div>
		                            <!-- GOOGLE MAP -->
							<script>$("#pac-input").val()</script>
							<style>
						      #map-canvas {
						        height: 300px;
								width: 100%;
						        
						      }
						      .controls {
						        margin-top: 16px;
						        border: 1px solid transparent;
						        border-radius: 2px 0 0 2px;
						        box-sizing: border-box;
						        -moz-box-sizing: border-box;
						        height: 32px;
						        outline: none;
						        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
						      }
						
						      #pac-input {
						        background-color: #fff;
						        padding: 0 11px 0 13px;
						        width: 400px;
						        font-family: Roboto;
						        font-size: 15px;
						        font-weight: 300;
						        text-overflow: ellipsis;
						      }
						
						      #pac-input:focus {
						        border-color: #4d90fe;
						        margin-left: -1px;
						        padding-left: 14px;  /* Regular padding-left + 1. */
						        width: 401px;
						      }
						
						      .pac-container {
						        font-family: Roboto;
						      }
						
						      #type-selector {
						        color: #fff;
						        background-color: #4d90fe;
						        padding: 5px 11px 0px 11px;
						      }
						
						      #type-selector label {
						        font-family: Roboto;
						        font-size: 13px;
						        font-weight: 300;
						      }
							}
						
						    </style>
						    <input type="hidden" id = "lat" name = "lat">
							<input type="hidden" id = "lng" name = "lng">
							<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=false&libraries=places"></script>
							
						    <script>
							// This example adds a search box to a map, using the Google Place Autocomplete
							// feature. People can enter geographical searches. The search box will return a
							// pick list containing a mix of places and predicted search terms.
							
							function initialize() {
							
							  var markers = [];
							  var haightAshbury = new google.maps.LatLng({{$builder[0]->lat}},{{$builder[0]->lng}});
							  var mapOptions = {
							    zoom: 6,
							    center: haightAshbury,
							    //mapTypeId: google.maps.MapTypeId.TERRAIN
							  };
							  map = new google.maps.Map(document.getElementById('map-canvas'),
							      mapOptions);
								
							 var marker=new google.maps.Marker({
									position:haightAshbury,
							  });
								marker.setMap(map);
								markers.push(marker); 	
								$("#lat").val(haightAshbury.lat());
								$("#lng").val(haightAshbury.lng()); 
							  // Create the search box and link it to the UI element.
							  var input = /** @type {HTMLInputElement} */(
							      document.getElementById('local_code'));
							  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
							
							  var searchBox = new google.maps.places.SearchBox(
							    /** @type {HTMLInputElement} */(input));
							
							  // [START region_getplaces]
							  // Listen for the event fired when the user selects an item from the
							  // pick list. Retrieve the matching places for that item.
							  google.maps.event.addListener(searchBox, 'places_changed', function() {
							    var places = searchBox.getPlaces();
							
							    if (places.length == 0) {
							      return;
							    }
							    for (var i = 0, marker; marker = markers[i]; i++) {
							      marker.setMap(null);
							    }
							
							    // For each place, get the icon, place name, and location.
							    markers = [];
							    var bounds = new google.maps.LatLngBounds();
							    for (var i = 0, place; place = places[i]; i++) {
							      
							
							      // Create a marker for each place.
							      var marker = new google.maps.Marker({
							        map: map,
							        title: place.name,
							        position: place.geometry.location
							      });
									$("#lat").val(place.geometry.location.lat());
									$("#lng").val(place.geometry.location.lng());
									markers.push(marker);
									bounds.extend(place.geometry.location);
							    }
							
							    map.fitBounds(bounds);
							  });
							  // [END region_getplaces]
							
							  // Bias the SearchBox results towards places that are within the bounds of the
							  // current map's viewport.
							  google.maps.event.addListener(map, 'bounds_changed', function() {
							    var bounds = map.getBounds();
							    searchBox.setBounds(bounds);
							  });
							  
							   google.maps.event.addListener(map, 'click', function(event) {
									for (var i = 0; i < markers.length; i++) {
										markers[i].setMap(null);
									}
									
									var marker = new google.maps.Marker({
										position: event.latLng,
										map: map
									}); 
									$("#lat").val(event.latLng.lat());
									$("#lng").val(event.latLng.lng());
									markers.push(marker); 
								});
									
							}
							
							google.maps.event.addDomListener(window, 'load', initialize);
							
							    </script>
							
    						<div id="map-canvas"></div>
							<!-- END GOOGLE MAP -->
		                            <div class="form-group">
		                                <label>Site Link</label>
		                                {{ Form::text('site_link', $builder[0]->site_link, array('placeholder' => 'Type your site link','class' => 'form-control')) }}
		                            </div>
		                             <div class="form-group">
		                                <label>Facebook Link</label>
		                                {{ Form::text('social_link', $builder[0]->social_link, array('placeholder' => 'Type your Facebook link','class' => 'form-control')) }}
		                            </div>
		                             <div class="form-group">
		                                <label>Twitter Link</label>
		                                {{ Form::text('social_link_twitter', $builder[0]->social_link_twitter, array('placeholder' => 'Type your Twitter link','class' => 'form-control')) }}
		                            </div>
		                             <div class="form-group">
		                                <label>Qualification</label>
		                                {{ Form::text('qualification', $builder[0]->qualification, array('placeholder' => 'Qualification','class' => 'form-control')) }}
		                            </div>
		                             <div class="form-group">
		                                <label>How many team?</label>
		                                {{ Form::text('howmanyteam', $builder[0]->howmanyteam, array('placeholder' => 'How many team?','class' => 'form-control')) }}
		                            </div>
		                             <div class="form-group">
		                                <label>About</label>
		                                {{ Form::text('about', $builder[0]->about, array('placeholder' => 'Type about you','class' => 'form-control')) }}
		                            </div>
									
		                             <div class="form-group">
		                                <label>Started At</label>
		                                {{ Form::text('created_at', $builder[0]->created_at, array('placeholder' => 'Type your date','class' => 'form-control')) }}
		                            </div>
		                 <div class="pad-top">
								<div class="form-control-wrapper" >
								Category
								<div class = "col-lg-12">
								</div>
								@if ($categorys != null)
									@if (count($categorys) < 5)
									<div class = "col-lg-12">
									<div class="checkbox">
						
										@for ($i = 0; $i < count($categorys); $i++)
											<label>
											<input type="checkbox" name = "check_builders[]" value = "{{$categorys[$i]->id}}" @foreach ($builder as $buildere) @if( $buildere->category_id == $categorys[$i]->id) checked @endif @endforeach > {{$categorys[$i]->content}}
										    </label>
										@endfor
										
									</div>
										
									</div>
									@else
									
										<div class = "col-lg-12">
										<div class="checkbox">
											@for ($i = 0; $i < 2; $i++)
												<label>
										        <input type="checkbox" name = "check_builders[]" value = "{{$categorys[$i]->id}}" @foreach ($builder as $buildere) @if( $buildere->category_id == $categorys[$i]->id) checked @endif @endforeach> {{$categorys[$i]->content}}
											    </label>
											@endfor
										</div>
											
										</div>

										<div class = "col-lg-12 listCategorys" hidden>
											<div class="checkbox">
											    
											    @for ($i = 2; $i < count($categorys); $i++)
													<label>
													<input type="checkbox" name = "check_builders[]" value = "{{$categorys[$i]->id}}" @foreach ($builder as $buildere) @if( $buildere->category_id == $categorys[$i]->id) checked @endif @endforeach> {{$categorys[$i]->content}}
												    </label>
												@endfor
											    				
											</div>			
										</div>

									@endif
								@endif 
								
								
								
								</div>
								
								<script>
								function showAllCategory() { //alert();
									if ($("#show_all_category").val() == "Show all"){
								 		$("#show_all_category").val("Hide");
								 		$(".listCategorys").show();
									} else {
										$("#show_all_category").val("Show all");
										$(".listCategorys").hide();
									}
								}
								</script>
								
						
								
								
							   
								<div class = "col-lg-12" style = "margin-bottom: 100px;">
								<input type = "button" onclick = "showAllCategory()" id = "show_all_category" value = "Show all"/>
								</div>
								</div>
								







						<div class="" >
							<div class = "col-lg-12">
								Association 
								</div>
								
									<div class="">
									@for  ($i = 0; $i < 4; $i++)
										<img style = "width: 50px; height: 50px; margin-left: 15px;" src="{{$associations[$i]->association_src}}"/>
										  <label>											  	
										    <input type="radio" name="association" value="{{$associations[$i]->association_name}}" id = "detail1"
										    @if ( $associations[$i]->association_name == $builder[0]->association_name)
										    	checked
										    @endif>
										    {{$associations[$i]->association_name}}
										  </label>
									@endfor
					
								   <div class = "list_associations" hidden>
								  @for  ($i = 4; $i < 16; $i++)
										<img style = "width: 50px; height: 50px; margin-left: 15px;" src="{{$associations[$i]->association_src}}"/>
										  <label>											  	
										    <input type="radio" name="association" value="{{$associations[$i]->association_name}}" id = "detail1"
										    @if ( $associations[$i]->association_name == $builder[0]->association_name)
										    	checked
										    @endif>
										    {{$associations[$i]->association_name}}
										  </label>
									@endfor
								  </div>
										  <input type = "button" onclick = "showAllAssociations()" id = "show_all_associations" value = "Show all"/>
								<script>
								function showAllAssociations() {
									if ($("#show_all_associations").val() == "Show all"){
								 		$("#show_all_associations").val("Hide");
								 		$(".list_associations").show();
									} else {
										$("#show_all_associations").val("Show all");
										$(".list_associations").hide();
									}
								}
								</script>
									</div>
											
								
							</div>

		                            {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
		                            
		                        {{ Form::close() }}
		                    </div>	
		                </div>
		            </div>
        </div>
    </div>
    <!-- end col-md-6-->
      <div class="col-lg-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                Change password
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
                        {{ Form::open(array('url' => 'change_password')) }}
                            <div class="form-group">
                                <label>New Password</label>
                                {{ Form::text('password','', array('placeholder' => 'Type your new Password', 'class' => 'form-control')) }}
                            </div>
                           

                            {{ Form::submit('Change password', array('class' => 'btn btn-primary')) }}
                           
                        {{ Form::close() }}
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end change password-->
      <div class="col-lg-3" >
        <div class="panel panel-default">
            <div class="panel-heading">
                Change Phone Number
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        
                        @if(Session::get("phonesuccess") == "1")
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            Phonenumber has been changed successfully, please check email to confirm new phonenumber
                        </div>
                        @endif
                        {{ Form::open(array('url' => 'change_phonenumber')) }}
                            <div class="form-group">
                                <label>New Phonenumber</label>
                                {{ Form::text('phonenumber','', array('placeholder' => 'Type your new Phonenumber', 'class' => 'form-control')) }}
                            </div>
                           
                            {{ Form::submit('Change Phonenumber', array('class' => 'btn btn-primary')) }}
                           
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
				        <div class="panel panel-default">
				            <div class="panel-heading">
				                Upgrade Credit
				            </div>
			            <div class="panel-body">
			            
			                <div class="row">
			                    <div class="col-lg-12">
							<div class="pad-top">
								<div class="form-control-wrapper" >
									<div class="radio">
										  <label onclick = "DetailPak1()">
										    <input type="radio" name="package_builder" value="1" id = "detail1" checked >
										    Package 1 (20£)
										  </label>
										   <label onclick = "DetailPak2()">
										    <input type="radio" name="package_builder" value="2">
										    Package 2 (50£)
										  </label>
										  <label onclick = "DetailPak3()">
										    <input type="radio" name="package_builder" value="3">
										    
										    Package 3 (100£)
										  </label>
									</div>
											
								</div>		
							</div>


							<div class="pad-top">
								<div class="form-control-wrapper" >
									<div id = "detail_pack_1" >
									
										<div id = "content_pay">
										    <form action="upgrade-credit" method="POST">
										  <script
										    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
										    data-key="pk_test_4ujZrZIZnpNkS2vh2isDqLQ7"
										    data-amount="{{$package[0]->charge_value_newest*100}}"
										    data-name="Demo Site"
										    data-description=""
										    data-image="https://stripe.com/img/documentation/checkout/marketplace.png">
										  </script>
										  <input type = "hidden" name = "amount" value = "{{$package[0]->charge_value_newest}}"/>
										  
										</form>
										</div>
									</div>
									<div id = "detail_pack_2" hidden>
									
										<div id = "content_pay">
										    <form action="upgrade-credit" method="POST">
										  <script
										    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
										    data-key="pk_test_4ujZrZIZnpNkS2vh2isDqLQ7"
										    data-amount="{{$package[1]->charge_value_newest*100}}"
										    data-name="Demo Site"
										    data-description=""
										    data-image="https://stripe.com/img/documentation/checkout/marketplace.png">
										  </script>
										 <input type = "hidden" name = "amount" value = "{{$package[1]->charge_value_newest}}"/>
										 
										  
										</form>
										</div>
									</div>
									<div id = "detail_pack_3" hidden>
										
										<div id = "content_pay">
										    <form action="upgrade-credit" method="POST">
										  <script
										    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
										    data-key="pk_test_4ujZrZIZnpNkS2vh2isDqLQ7"
										    data-amount="{{$package[2]->charge_value_newest*100}}"
										    data-name="Demo Site"
										    data-description=""
										    data-image="https://stripe.com/img/documentation/checkout/marketplace.png">
										  </script>
										  <input type = "hidden" name = "amount" value = "{{$package[2]->charge_value_newest}}"/>
										  
										  
										</form>
										</div>
									</div>
											
								</div>		
							</div>
							<script>
							function DetailPak1() {
								$("#detail_pack_1").show();
								$("#detail_pack_2").hide();
								$("#detail_pack_3").hide();
							}
							function DetailPak2() {
								$("#detail_pack_1").hide();
								$("#detail_pack_2").show();
								$("#detail_pack_3").hide();
							}
							function DetailPak3() {
								$("#detail_pack_1").hide();
								$("#detail_pack_2").hide();
								$("#detail_pack_3").show();
							}
							</script>

		                          
		                            
			                    </div>	
			                </div>
			                <hr>
			             
			            </div>
			        </div>
			    </div>
				<div class="col-lg-6">
				        <div class="panel panel-default">
				            <div class="panel-heading">
				                Portfolio
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
		                             <div class="form-group">
		                                <label>Jobs details</label>
		                                <form action = "builder-submit-job-details" method = "post">
		                                <input name = "builder_id" value = "{{Auth::user()->id}}" hidden>
		                                <input name = "job_id" value = "{{$buildere->job_id}}" hidden>
		                                <textarea name = "builder_note_job" rows="4" cols="50">{{$buildere->builder_note_job}}</textarea>
		                               	<button class = "btn btn-primary" type = "submit">Submit</button>
		                               </form>
		                            </div>

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