
@extends('layouts.default')
@section('content')
	<div class="container" style= "margin-bottom: 230px;">
			<div class="row">
				<h1 class="text-center">Dashboard</h1>
			</div>
			<div class="col-md-2">
				<div class="list-group">
					  <a href="{{URL::route('customer-invited')}}" class="list-group-item active">
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
				    <div class="col-lg-12">
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
                        	 var cityCircle;
                        	 
                             var markers = [];
                             var haightAshbury = new google.maps.LatLng({{$builder[0]->lat}},{{$builder[0]->lng}});
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
                            var populationOptions = {
                      		      strokeColor: '#FF0000',
                      		      strokeOpacity: 0.8,
                      		      strokeWeight: 2,
                      		      fillColor: '#FF0000',
                      		      fillOpacity: 0.35,
                      		      map: map,
                      		      center: haightAshbury,
                      		      radius: Math.sqrt({{$builder[0]->miles_covered}}) * 100
                      		    };
                            cityCircle = new google.maps.Circle(populationOptions);
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
                           
                           <label>Miles covered</label>
                           
                           {{$builder[0]->miles_covered}}
                        </div> 
							<div class="form-group">
                                <label>Radius</label>
                                {{$radius}} Miles
                                
                            </div>
                            
                            <div class="form-group">
                            <span class="fa-stack fa-lg"><i class="fa fa-dribbble fa-stack-1x"></i></span>
                            	
                                <label>Site Link</label>
                                {{$builder[0]->site_link}}
                                
                            </div>
                             <div class="form-group">
                             <span class="fa-stack fa-lg"><i class="fa fa-facebook fa-stack-1x"></i></span>
                                <label>Facebook</label>
                                {{$builder[0]->social_link}}
                                
                            </div>
                            <div class="form-group">
                            <span class="fa-stack fa-lg"><i class="fa fa-twitter fa-stack-1x"></i></span>
                                <label>Twitter</label>
                                {{$builder[0]->social_link_twitter}}
                                
                            </div>
                            
                             <div class="form-group">
                                <label>Started At</label>
                                {{$builder[0]->created_at}}
                                
                            </div>
		                 <div class="pad-top">
								<div class="form-control-wrapper" >
								
								<div class = "col-lg-12">
								Category:
								</div>
								
								
								
								
								<div class = "col-lg-12">
								@foreach($builder_categorys as $buildere)
									{{$buildere->content}}
								@endforeach 
								
									
								</div>
								</div>
	
							   
								
						</div>
						<div class="pad-top">
								<div class="form-control-wrapper" >
								
								<div class = "col-lg-12">
								Association:
								</div>
								
								
								
								
								<div class = "col-lg-12">
								@foreach($builder as $buildere)
									<img style = "width: 50px; height: 50px; margin-left: 15px;" src="{{$buildere->association_src}}"/>
									{{$buildere->association_name}}
									
								@endforeach 
								
									
								</div>
								</div>
	
							   
								
						</div>
							
							
							
							<div class="pad-top">
								<div class="form-control-wrapper" >
								
								<div class = "col-lg-12">
								On Holiday:
								@if ($builder[0]->on_holiday == 1)
	                           		Yes<br>
	                           		Reason: {{$builder[0]->on_holiday_reason}}</p>
	                           		
	                           @else
	                           		No
	                           @endif
								</div>
				
								
								</div>
	
							   
								
						</div>
	                        <div class="form-group">
	                           
	                           
						   Working from: <input type="number" name="working_from" value="{{$builder[0]->working_from}}"/></br>
						   Working to:&nbsp &nbsp&nbsp&nbsp&nbsp <input type="number" name="working_to" value="{{$builder[0]->working_to}}" />
	                       <br>
	                        Working day from: <input type="number" name="working_day_from" value="{{$builder[0]->working_day_from}}"/></br>
						   Working day to:&nbsp &nbsp&nbsp&nbsp&nbsp <input type="number" name="working_day_to" value="{{$builder[0]->working_day_to}}" />
	                        </div>
                           
                        </div>		
											
						

		                         
		                            
		                        
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