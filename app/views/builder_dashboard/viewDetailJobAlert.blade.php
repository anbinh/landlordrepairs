
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
					  <a href="{{URL::route('credit')}}" class="list-group-item">Credit</a>
					  <a href="{{URL::route('my-previews')}}" class="list-group-item">My Preview</a>
					  
				</div>

			</div>
			<div class="col-md-10">
				<div class="row">
				    <div class="col-lg-6">
				        <div class="panel panel-default">
				            <div class="panel-heading">
				                Job Detail
				            </div>
			            <div class="panel-body">
			                <div class="row">
			                    <div class="col-lg-12">

			                     
		                            <div class="form-group">
		                                <label>Tittle</label>
		                              	<p>{{$jobInfo->tittle}}</p>
		                            </div>
		                           
		                            <div class="form-group">
		                                <label>Description</label>
		                                <p>{{$jobInfo->description}}</p>
		                            </div>
		                            
		                            <div class="form-group">
		                                <label>Price</label>
		                                <p>{{$jobInfo->price}}£</p>
		                            </div>
		                            
		                            <div class="form-group">
		                                <label>Property</label>
		                                <p>{{$jobInfo->property}}</p>
		                            </div>
		                            
		                             <div class="form-group">
		                                <label>Category</label>
		                                <p>{{$jobInfo->content}}</p>
		                            	
		                            </div>
		                            <div class="form-group">
		                                <label>Time Option</label>
		                                <p>{{$jobInfo->timeoption}}</p>
		                            	
		                            </div>
		                           
		                           @if("{{$jobInfo->timeoption}}" == "Specific")
					                 <div class="form-group">
		                                <label>At date</label>
		                                <p>{{$jobInfo->date}}</p>
		                            	
		                            </div>
		         	               
		
				                     @endif
				                    @if ($jobProcess != "") 
		                            <div class="form-group">
		                                <label>Time Invited Sent</label>
		                                <p>{{$jobProcess->created_at}}</p>
		                            	
		                            </div>
		                            @endif
		                            <div class="form-group">
		                                <label>Local</label>
		                                <p>{{$jobInfo->local}}</p>
		                            	
		                            </div>
		                            
		                            <div class="form-group">
		                                <label>Local code</label>
		                                <p>{{$jobInfo->local_code}}</p>
		                            	
		                            </div>
		                            @if ($jobProcess != "") 
		                            <div class="form-group">
		                                <label>Radius</label>
		                                <p>{{$jobProcess->radius}} miles</p>
		                            	
		                            </div>
		                            @endif
		                            
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
							  var haightAshbury = new google.maps.LatLng({{$jobInfo->lat}},{{$jobInfo->lng}});
							  var mapOptions = {
							    zoom: 10,
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
                                <label>Time to contact</label>
                                @if ($jobInfo->contact_time != 1)
                                	<p>Any Time</p>
                                @else
                                	<p>From: {{$jobInfo->contact_from}} to {{$jobInfo->contact_to}}</p>
                                @endif
                                
                            </div>
		                    </div>
		                </div>
		            </div>
        </div>
    </div>
    <!-- end col-md-6-->
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Customer Info
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">

                     
                            <div class="form-group">
                                <label>Name</label>
                                <p>{{$userInfo->username}}</p>
                            </div>
                           
                            <div class="form-group">
                                <label>Email</label>
                                <p>{{$userInfo->email}}</p>
                            </div>
                            
                            <div class="form-group">
                                <label>Phone number</label>
                                <p>{{$userInfo->phone_number}}</p>
                            </div>
                            
                           <a class = "btn btn-primary" href = "{{URL::route('customer-invited')}}">Back</a>
 
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                Image about Job
            </div>
            <div class="panel-body">
            	@if ($jobInfo->attachment_src_1 != "")
                <a href = "{{$jobInfo->attachment_src_1}}" target ="_blank"><img src = "{{$jobInfo->attachment_src_1}}" style = "width: 200px; height: 200px"/></a>
                @endif
                @if ($jobInfo->attachment_src_2 != "")
                <a href = "{{$jobInfo->attachment_src_2}}" target ="_blank"><img src = "{{$jobInfo->attachment_src_2}}" style = "width: 200px; height: 200px"/></a>
                @endif
                @if ($jobInfo->attachment_src_3 != "")
                <a href = "{{$jobInfo->attachment_src_3}}" target ="_blank"><img src = "{{$jobInfo->attachment_src_3}}" style = "width: 200px; height: 200px"/></a>
                @endif
                @if ($jobInfo->attachment_src_4 != "")
                <a href = "{{$jobInfo->attachment_src_4}}" target ="_blank"><img src = "{{$jobInfo->attachment_src_4}}" style = "width: 200px; height: 200px"/></a>
                @endif
                @if ($jobInfo->attachment_src_5 != "")
                <a href = "{{$jobInfo->attachment_src_5}}" target ="_blank"><img src = "{{$jobInfo->attachment_src_5}}" style = "width: 200px; height: 200px"/></a>
                @endif
                
            </div>
        </div>
    </div>
</div>
			</div>
		</div>
		
		

		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
@stop