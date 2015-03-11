@extends('layouts.default')
@section('content')	
<div class="row">
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
									<input name = "local_code" id = "local_code" type="text" class="form-control" required placeholder = 'Post code'style = "z-index:2; margin-left: -42px;">
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
									<input name = "site_link" type="text" class="form-control" required placeholder = 'Site link'>
								</div>			
							</div>
							
							<div class="pad-top">
								<div class="form-control-wrapper" >
									<input name = "social_link" type="text" class="form-control" required placeholder = 'Social link'>
								</div>			
							</div>
					</div>	
					<div class="panel-heading">
		                <h3 class="panel-title" style = "text-align: center">About Service</h3>
		
		            </div>
						<div class="pad-top">
								<div class="form-control-wrapper" >
									<input name = "tittle" type="text" class="form-control" required placeholder = ' Company name'>
									
								</div>			
							</div>
							
								<div class="pad-top">
								<div class="form-control-wrapper" >
								
								<div class = "col-lg-12">
								Category:
								</div>
								
								
								
								
								<div class = "col-lg-6">
								<div class="checkbox">
									  
								    <label>
								        <input type="checkbox" name = "check_builders[]" value = "Bathroom Fitters" checked> Bathroom Fitters
								    </label>
								    <label>
								        <input type="checkbox" name = "check_builders[]" value = "Bricklayers"> Bricklayers
								    </label>
								    
						
								</div>
									
								</div>
								</div>	
								<div class = "col-lg-6">
								<div class="checkbox">
								    <label>
								        <input type="checkbox" name = "check_builders[]" value = "Handymen"> Handymen
								    </label>
								     <label>
								        <input type="checkbox" name = "check_builders[]" value = "Heating Engineers"> Heating Engineers
								    </label>
								    
								</div>
									
								</div>
								
								<script>
								function showAllCategory() {
									if ($("#show_all_category").val() == "Show all"){
								 		$("#show_all_category").val("Hide");
								 		$(".listCategorys").show();
									} else {
										$("#show_all_category").val("Show all");
										$(".listCategorys").hide();
									}
								}
								</script>
								
								
								<div class = "col-lg-6 listCategorys" hidden>
								<div class="checkbox">
								    
								    <label>
								        <input type="checkbox" name = "check_builders[]" value = "Carpenters & Joiners"> Carpenters & Joiners
								    </label>
								    <label>
								        <input type="checkbox" name = "check_builders[]" value = "Carpet fitters"> Carpet fitters
								    </label>
								     <label>
								        <input type="checkbox" name = "check_builders[]" value = "Chimney & Fireplace Specialists"> Chimney & Fireplace Specialists
								    </label>
								    <label>
								        <input type="checkbox" name = "check_builders[]" value = "Conservatory Installers"> Conservatory Installers
								    </label>
								    <label>
								        <input type="checkbox" name = "check_builders[]" value = "Conversion Specialists"> Conversion Specialists
								    </label>
								    <label>
								        <input type="checkbox" name = "check_builders[]" value = "Damp Proofing Specialists"> Damp Proofing Specialists
								    </label>
								    <label>
								        <input type="checkbox" name = "check_builders[]" value = "Driveway Pavers"> Driveway Pavers
								    </label>
								    <label>
								        <input type="checkbox" name = "check_builders[]" value = "Electricians"> Electricians
								    </label>
								    <label>
								        <input type="checkbox" name = "check_builders[]" value = "Extension Builders"> Extension Builders
								    </label>
								     <label>
								        <input type="checkbox" name = "check_builders[]" value = "Fencers"> Fencers
								    </label>
								     <label>
								        <input type="checkbox" name = "check_builders[]" value = "Flooring Fitters"> Flooring Fitters
								    </label>
								     <label>
								        <input type="checkbox" name = "check_builders[]" value = "Garage & Shed Builders"> Garage & Shed Builders
								    </label>
								     <label>
								        <input type="checkbox" name = "check_builders[]" value = "Gas Engineers"> Gas Engineers
								    </label>
								     <label>
								        <input type="checkbox" name = "check_builders[]" value = "Groundworkers"> Groundworkers
								    </label>
						
								</div>
									
								</div>
								
								<div class = "col-lg-6 listCategorys" hidden>
								<div class="checkbox">
								    		    
								     <label>
								        <input type="checkbox" name = "check_builders[]" value = "Insulation Installers"> Insulation Installers
								    </label>
								    <label>
								        <input type="checkbox" name = "check_builders[]" value = "Kitchen Fitters"> Kitchen Fitters
								    </label>
								    <label>
								        <input type="checkbox" name = "check_builders[]" value = "Landscape Gardeners"> Landscape Gardeners
								    </label>
								    <label>
								        <input type="checkbox" name = "check_builders[]" value = "Loft Conversion Specialists"> Loft Conversion Specialists
								    </label>
								    <label>
								        <input type="checkbox" name = "check_builders[]" value = "New Home Builders"> New Home Builders
								    </label>
								    <label>
								        <input type="checkbox" name = "check_builders[]" value = "Painters & Decorators"> Painters & Decorators
								    </label>
								    <label>
								        <input type="checkbox" name = "check_builders[]" value = "Plasterers"> Plasterers
								    </label>
								    <label>
								        <input type="checkbox" name = "check_builders[]" value = "Plumbers"> Plumbers
								    </label>
								    <label>
								        <input type="checkbox" name = "check_builders[]" value = "Restoration & Refurb Specialists"> Restoration & Refurb Specialists
								    </label>
								    <label>
								        <input type="checkbox" name = "check_builders[]" value = "Roofers"> Roofers
								    </label>
								    <label>
								        <input type="checkbox" name = "check_builders[]" value = "Security System Installers"> Security System Installers
								    </label>
								    <label>
								        <input type="checkbox" name = "check_builders[]" value = "CTilers"> CTilers
								    </label>
								    <label>
								        <input type="checkbox" name = "check_builders[]" value = "Tree Surgeons"> Tree Surgeons
								    </label>
								    <label>
								        <input type="checkbox" name = "check_builders[]" value = "Window Fitters"> Window Fitters
								    </label>
								</div>
								
								</div>
								<div class = "col-lg-12">
								<input type = "button" onclick = "showAllCategory()" id = "show_all_category" value = "Show all"/>
								</div>
								</div>			
							</div>
							<div class="pad-top">
								<div class="form-control-wrapper" >
									
									<textarea rows="4" cols="50" name = "description" required placeholder = 'Description' class="form-control"> </textarea>
								</div>			
							</div>
							<div class="pad-top">
							<div class = "col-lg-12">
								Are you member of any association?
								</div>
								<div class="form-control-wrapper" >
									<div class="radio">
									@for  ($i = 0; $i < 4; $i++)
										<img style = "width: 50px; height: 50px; margin-left: 15px;" src="{{$associations[$i]->association_src}}"/>
										  <label>											  	
										    <input type="radio" name="association" value="{{$associations[$i]->association_name}}" id = "detail1">
										    {{$associations[$i]->association_name}}
										  </label>
									@endfor
											
										  
										   <div class = "list_associations" hidden>
										  @for  ($i = 4; $i < 16; $i++)
											<img style = "width: 50px; height: 50px; margin-left: 15px;" src="{{$associations[$i]->association_src}}"/>
												  <label>											  	
												    <input type="radio" name="association" value="{{$associations[$i]->association_name}}" id = "detail1">
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
							</div>
							<div class="pad-top">
								<div class="form-control-wrapper" >
									<div class="radio">
										  <label onclick = "DetailPak1()">
										    <input type="radio" name="package_builder" value="2000" id = "detail1" checked >
										    Package 1 (20£)
										  </label>
										   <label onclick = "DetailPak2()">
										    <input type="radio" name="package_builder" value="5000">
										    Package 2 (50£)
										  </label>
										  <label onclick = "DetailPak3()">
										    <input type="radio" name="package_builder" value="10000">
										    
										    Package 3 (100£)
										  </label>
									</div>
											
								</div>		
							</div>


							<div class="pad-top">
								<div class="form-control-wrapper" >
									<div id = "detail_pack_1" >
										<p>Details of Package 1</p>
									</div>
									<div id = "detail_pack_2" hidden>
										<p>Details of Package 2</p>
									</div>
									<div id = "detail_pack_3" hidden>
										<p>Details of Package 3</p>
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