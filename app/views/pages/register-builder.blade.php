@extends('layouts.default')
@section('content')	
<div class="row">
    <div class="col-md-4 col-md-offset-4">
    			@if($errors->any())
					<div class="alert alert-danger alert-dismissable">
		                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		                 {{ implode('', $errors->all('<li class="error">:message</li>')) }}
		         	</div>
		
				@endif
				@if(Session::get("is_phone_number") == "0")
                 <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    The phone number is invalid, please type agian
                </div>
                @endif
        <div class="login-panel panel panel-default" style = "margin-top: 50px;">
            <div class="panel-heading">
                <h3 class="panel-title" style = "text-align: center">Builder Register</h3>

            </div>
            <div class="panel-body">
				<form accept-charset="UTF-8" action="{{URL::to('register-builder')}}" class="simple_form analytics-event" data-event-name="regular email log in attempt" id="new_user_session" method="post">
					<div class="login-block" >
					
							
					
						<div class="login-block" >
					
						<div class="form-fields-wrapper">
							<div class="pad-top">
								<div class="form-control-wrapper" id = "form-control-wrapper-plusCss" >
									<input name = "username" type="text" class="form-control" required placeholder = ' Your full name'>
									
									
								</div>			
							</div>
							<div class="pad-top">
								<div class="form-control-wrapper" >
									<input name = "email" type="text" class="form-control" required placeholder = 'Email'>
									
								</div>			
							</div>
							
							<div class="pad-top">
								<div class="form-control-wrapper" >
									<input name = "password" type="password" class="form-control" required placeholder = 'Password'>
									
								</div>			
							</div>
							
							<div class="pad-top">
									<input name = "phone_number" type="text" class="form-control" required placeholder = 'Phone number- We will send a code to verify it'>		
							</div>

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
							
						
							
							
							<div class="pad-top">
								<div class="form-control-wrapper" >
									<input name = "local" type="text" class="form-control" required placeholder = 'City or County'>
								</div>			
							</div>
							<div class="pad-top">
								<div class="form-control-wrapper" >
									<input name = "local_code" id = "local_code" type="text" class="form-control" required placeholder = 'Post code'>
								</div>	
										
							</div>
							<!-- GOOGLE MAP -->
							<script>$("#pac-input").val()</script>
							<style>
						      #map-canvas {
						        height: 300px;
								width: 380px;
						        
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
							
							
					</div>	
					<div class="panel-heading">
		                <h3 class="panel-title" style = "text-align: center">About Service</h3>
		
		            </div>
						<div class="pad-top">
								<div class="form-control-wrapper" >
									<input name = "tittle" type="text" class="form-control" required placeholder = 'Tittle'>
									
								</div>			
							</div>
							
								<div class="pad-top">
								<div class="form-control-wrapper" >
								
								<div class = "col-lg-4">
								Category:
								</div>
								<div class = "col-lg-8">
									<select name = "category" class="form-control">
										<option name="category" value = "Bathroom Fitters">Bathroom Fitters</option>
										<option name="category" value = "Bricklayers">Bricklayers </option>
										<option name="category" value = "Carpenters & Joiners">Carpenters & Joiners </option>
										<option name="category" value = "Carpet fitters">Carpet fitters</option>
										<option name="category" value = "Chimney & Fireplace Specialists">Chimney & Fireplace Specialists</option>
										<option name="category" value = "Conservatory Installers">Conservatory Installers</option>
										<option name="category" value = "Conversion Specialists">Conversion Specialists</option>
										<option name="category" value = "Damp Proofing Specialists">Damp Proofing Specialists</option>
										<option name="category" value = "Driveway Pavers">Driveway Pavers</option>
										<option name="category" value = "Electricians">Electricians</option>
										<option name="category" value = "Extension Builders">Extension Builders</option>
										<option name="category" value = "Fencers">Fencers</option>
										<option name="category" value = "Flooring Fitters">Flooring Fitters</option>
										<option name="category" value = "Garage & Shed Builders">Garage & Shed Builders</option>
										<option name="category" value = "Gas Engineers">Gas Engineers</option>
										<option name="category" value = "Groundworkers">Groundworkers</option>
										<option name="category" value = "Handymen">Handymen</option>
										<option name="category" value = "Heating Engineers">Heating Engineers</option>
										<option name="category" value = "Insulation Installers">Insulation Installers</option>
										<option name="category" value = "Kitchen Fitters">Kitchen Fitters</option>
										<option name="category" value = "Landscape Gardeners">Landscape Gardeners</option>
										<option name="category" value = "Loft Conversion Specialists">Loft Conversion Specialists</option>
										<option name="category" value = "New Home Builders">New Home Builders</option>
										<option name="category" value = "Painters & Decorators">Painters & Decorators</option>
										<option name="category" value = "Plasterers">Plasterers</option>
										<option name="category" value = "Plumbers">Plumbers</option>
										<option name="category" value = "Restoration & Refurb Specialists">Restoration & Refurb Specialists</option>
										<option name="category" value = "Roofers">Roofers</option>
										<option name="category" value = "Security System Installers">Security System Installers</option>
										<option name="category" value = "CTilers">CTilers</option>
										<option name="category" value = "Tree Surgeons">Tree Surgeons</option>
										<option name="category" value = "Window Fitters">Window Fitters</option>
									</select>
								</div>
								</div>			
							</div>
							
							<div class="pad-top">
								<div class="form-control-wrapper" >
									
									<textarea rows="4" cols="50" name = "description" required placeholder = 'Description' class="form-control"> </textarea>
								</div>			
							</div>		
				</div>		
		</div>
						
						<div class="form-fields-wrapper" id = "submit-div">
							<div class="form-steps-bottom"></div>
							
							<input class="button btn-full push-top btn-primary" name="commit" type="submit" value="Register" id = "btn-submit" id = "btn-submit">
						</div>
					</div>
				</form>
			</div>
        </div>
    </div>
</div>


@stop