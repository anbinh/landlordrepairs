


@extends('layouts.default')
@section('content')	
<div class="row" style = "margin-top: 10%; margin-bottom: 80px;">
<style>
.col-lg-8 {
	padding-left: 0px;
	padding-right: 0px;
}
#submit-div {
	text-align: center;
}
</style>
    <div class="col-md-4 col-md-offset-4">
   				 @if($errors->any())
					<div class="alert alert-danger alert-dismissable">
		                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		                 {{ implode('', $errors->all('<li class="error">:message</li>')) }}
		         	</div>
		
				@endif
				@if(Session::get("success") == "1")
                 <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    Post job success
                </div>
                @endif
        <div class="login-panel panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Post Job</h3>
            </div>
            <div class="panel-body">
				<form accept-charset="UTF-8" action="{{URL::to('postjob')}}" class="simple_form analytics-event" data-event-name="regular email log in attempt" id="new_user_session" method="post">
					<div class="login-block" >
							
							
							
							<div class="pad-top">
								<div class="form-control-wrapper" >
									<input name = "tittle" type="text" class="form-control" required placeholder = 'Tittle'>
									
								</div>			
							</div>
							
							<div class="pad-top">
								<div class="form-control-wrapper" >
								
								<div class = "col-lg-4">
								Property:
								</div>
								<div class = "col-lg-8">
									<select name = "property" class="form-control">
										<option name="property" value = "Flat">Flat</option>
										<option name="property" value = "Terrance House">Terrance House </option>
										<option name="property" value = "Semi detached ">Semi detached </option>
										<option name="property" value = "Shared House">Shared House</option>
										<option name="property" value = "Bungalow">Bungalow</option>
										<option name="property" value = "Maisonette">Maisonette</option>
										
									</select>
								</div>
								</div>			
							</div>
							
							<div class="pad-top">
								<div class="form-control-wrapper" >
								
								<div class = "col-lg-4">
								Category:
								</div>
								<div class = "col-lg-8">
									<select name = "category_id" class="form-control">
										@if ($categorys != null)
											@foreach ($categorys as $category)
												<option name="category_id" value = "{{$category->id}}">{{$category->content}}</option>
											@endforeach
										@endif
										
										
									</select>
								</div>
								</div>			
							</div>
							
							<div class="pad-top">
								<div class="form-control-wrapper" >
									
									<textarea rows="4" cols="50" name = "description" required placeholder = 'Description' class="form-control"> </textarea>
								</div>			
							</div>
							<div class="pad-top">
								<div class="form-control-wrapper" >
									<input name = "price" type="text" class="form-control" required placeholder = 'Price (£)'>
									
								</div>			
							</div>
							<div class="pad-top">
								<div class="form-control-wrapper" >
									<input name = "local" type="text" class="form-control" required placeholder = 'City or County'>
								</div>			
							</div>
							<div class="pad-top">
								<div class="form-control-wrapper" >
									<input name = "local_code" id  = "local_code" type="text" class="form-control" required placeholder = 'Post code' style = "z-index:2; margin-left: -42px;">
								</div>			
							</div>
							<!-- GOOGLE MAP -->
							
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
							  var haightAshbury = new google.maps.LatLng(55.7717596, -3.9047496);
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
							
							<div class="pad-top">
								<div class="form-control-wrapper" >
									<div class="radio">
										  <label>
										    <input class = "hide-date" type="radio" name="timeoption"  value="Flexible" checked>
										    Flexible
										  </label>
										   <label style = "text-decoration: underline; color: red;">
										    <input class = "hide-date" type="radio" name="timeoption"  value="Within_48_hours">
										    Emergency Job
										  </label>
										  <label>
										    <input class = "show-date" type="radio" name="timeoption"  value="Specific">
										    
										    Specific day
										  </label>
									</div>
									
									
												
								 <link rel="shortcut icon" href="http://jquerytools.github.io/media/img/favicon.ico">
								  
								
								  <!-- dateinput styling -->
								
								      <script src="http://cdn.jquerytools.org/1.2.6/full/jquery.tools.min.js"></script>
										<link href="{{{ asset('font-awesome/css/large.css') }}}" rel="stylesheet">
								<div id="calendar">
								  <input id = "date"type="date" name="date" value="0" />
								</div>
								
								<!-- large date display -->
								
																	
								<br clear="all"/>
								
								<!-- make it happen -->
								<script>
								$(function() {
								// initialize dateinput
								$(":date").dateinput( {
								
									// closing is not possible
									onHide: function()  {
									//$("#calendar").hide();
								      $("#calroot").hide();
								      $("#submit-div").css("margin-top", '0px');
										return false;
									},
								
									
									
								// set initial value and show dateinput when page loads
								}).data("dateinput").setValue(0).show();
								});
								function test(){
								alert($('#date').val());
								}
								</script>
								<script>
										$(document).ready(function(){
											$("#calendar").hide();
											$("#calroot").hide();
											$("#submit-div").css("margin-top", '0px');
										    $(".hide-date").click(function(){
										      $("#calendar").hide();
										      $("#calroot").hide();
										      $("#submit-div").css("margin-top", '0px');
										    });
										    $(".show-date").click(function(){
										        $("#calendar").show();
										        $("#calroot").show();
										        $("#submit-div").css("margin-top", '350px');
										    });
										    
										});
									</script>
									
								</div>			
							</div>
						
						</div>
						
						<div class="form-fields-wrapper" id = "submit-div">
							<div class="form-steps-bottom"></div>
							
							<input class="button btn-full push-top btn-primary" name="commit" type="submit" value="Post" id = "btn-submit" id = "btn-submit">
						</div>
				</form>
					</div>
				
			</div>
        </div>
    </div>


@stop