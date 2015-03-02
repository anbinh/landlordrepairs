
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
					  <a href="{{URL::route('builder-invited')}}" class="list-group-item">Job Alerts</a>
					  <a href="{{URL::route('builder-find-jobs')}}" class="list-group-item">Find Jobs</a>
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
				    <div class="col-lg-4">
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
		                                <label>Started At</label>
		                                {{ Form::text('created_at', $builder[0]->created_at, array('placeholder' => 'Type your date','class' => 'form-control')) }}
		                            </div>
		                           

		                            {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
		                            
		                        {{ Form::close() }}
		                    </div>
		                </div>
		            </div>
        </div>
    </div>
    <!-- end col-md-6-->
      <div class="col-lg-4">
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

    <!-- end change phone number -->
</div>
			</div>
		</div>
		
		

		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
@stop