


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
            {{ Form::open(array('url'=>'submit-edit-jobs','files'=>true)) }}
<!--				<form accept-charset="UTF-8" action="{{URL::to('postjob')}}" class="simple_form analytics-event" data-event-name="regular email log in attempt" id="new_user_session" method="post" >-->
					<div class="login-block" >
	
							<div class="pad-top">
								<div class="form-control-wrapper" >
									<input name = "tittle" type="text" class="form-control" required placeholder = 'Tittle' value = "{{$jobInfo->tittle}}">
									
								</div>			
							</div>
							
							<div class="pad-top">
								<div class="form-control-wrapper" >
								
								<div class = "col-lg-4">
								Property:
								</div>
								<div class = "col-lg-8">
									<select name = "property" class="form-control">
										<option name="property" value = "Flat" <?php if ($jobInfo->property == "Flat"){echo "selected";}?>>Flat</option>
										<option name="property" value = "Terrance House"<?php if ($jobInfo->property == "Terrance House"){echo "selected";}?>>Terrance House </option>
										<option name="property" value = "Semi detached" <?php if ($jobInfo->property == "Semi detached"){echo "selected";}?>>Semi detached </option>
										<option name="property" value = "Shared House" <?php if ($jobInfo->property == "Shared House"){echo "selected";}?>>Shared House</option>
										<option name="property" value = "Bungalow" <?php if ($jobInfo->property == "Bungalow"){echo "selected";}?>>Bungalow</option>
										<option name="property" value = "Maisonette" <?php if ($jobInfo->property == "Maisonette"){echo "selected";}?>>Maisonette</option>
										
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
												<option name="category_id" value = "{{$category->id}}" <?php if ($jobInfo->category_id == $category->id){echo "selected";}?>>{{$category->content}}</option>
											@endforeach
										@endif
										
										
									</select>
								</div>
								</div>			
							</div>
							
							<div class="pad-top">
								<div class="form-control-wrapper" >
									
									<textarea rows="4" cols="50" name = "description" required placeholder = 'Description' class="form-control" value = "{{$jobInfo->description}}"> </textarea>
								</div>			
							</div>
							<div class="pad-top">
								<div class="form-control-wrapper" >
									<input name = "price" type="text" class="form-control" required placeholder = 'Price (£)' value = "{{$jobInfo->price}}">
									
								</div>			
							</div>
							<div class="pad-top">
								<div class="form-control-wrapper" >
									<input name = "local" type="text" class="form-control" required placeholder = 'City or County' value = "{{$jobInfo->local}}">
								</div>			
							</div>
							<div class="pad-top">
								<div class="form-control-wrapper" >
									<input name = "local_code" id  = "local_code" type="text" class="form-control" required placeholder = 'Post code' style = "z-index:2; margin-left: -42px;" value = "{{$jobInfo->local_code}}">
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
							  var haightAshbury = new google.maps.LatLng("{{$jobInfo->lat}}", "{{$jobInfo->lng}}");
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
										    <input class = "hide-date" type="radio" name="timeoption"  value="Flexible" <?php if($jobInfo->timeoption == "Flexible") {echo "checked";}?>>
										    
										    Flexible
										  </label>
										   <label style = "text-decoration: underline; color: red;">
										    <input class = "hide-date" type="radio" name="timeoption"  value="Within_48_hours" <?php if($jobInfo->timeoption == "Within_48_hours") {echo "checked";}?>>
										    Emergency Job
										  </label>
										  <label>
										    <input class = "show-date" type="radio" name="timeoption"  value="Specific" <?php if($jobInfo->timeoption == "Specific") {echo "checked";}?>>
										    
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
								$('#date').val('04/23/15');
								function test(){
								//alert($('#date').val());
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
							<div class="pad-top">
								<div class="form-control-wrapper" >
									<div class="radio">
										  <label>
										    <input type="radio" name="contact-time"  value="0" id = "hide_contact-time" <?php if($jobInfo->contact_time == "0") {echo "checked";}?>>
										    Any time
										  </label>
										   <label style = "radio">
										    <input type="radio" name="contact-time"  value=" 1" id = "show_contact-time" <?php if($jobInfo->contact_time == "1") {echo "checked";}?>>
										     From too
										  </label>
									</div>
									<div id="contact-time-detail" <?php if($jobInfo->times_invite == "0"){echo "hidden";}?>>
									   
							
								
								
								<div class = "col-lg-4">
								From:
								</div>
								<div class = "col-lg-8">
									<select name = "contact-from" class="form-control">
										<option name="contact-from" value = "0am" <?php if($jobInfo->contact_from == "0am"){echo "selected";}?>>0 am</option>
										<option name="contact-from" value = "1am" <?php if($jobInfo->contact_from == "1am"){echo "selected";}?>>1 am </option>
										<option name="contact-from" value = "2am" <?php if($jobInfo->contact_from == "2am"){echo "selected";}?>>2 am </option>
										<option name="contact-from" value = "3am" <?php if($jobInfo->contact_from == "3am"){echo "selected";}?>>3 am</option>
										<option name="contact-from" value = "4am" <?php if($jobInfo->contact_from == "4am"){echo "selected";}?>>4 am</option>
										<option name="contact-from" value = "5am" <?php if($jobInfo->contact_from == "5am"){echo "selected";}?>>5 am</option>
										<option name="contact-from" value = "6am" <?php if($jobInfo->contact_from == "6am"){echo "selected";}?>>6 am</option>
										<option name="contact-from" value = "7am" <?php if($jobInfo->contact_from == "7am"){echo "selected";}?>>7 am</option>
										<option name="contact-from" value = "8am" <?php if($jobInfo->contact_from == "8am"){echo "selected";}?>>8 am</option>
										<option name="contact-from" value = "9am" <?php if($jobInfo->contact_from == "9am"){echo "selected";}?>>9 am</option>
										<option name="contact-from" value = "10am" <?php if($jobInfo->contact_from == "10am"){echo "selected";}?>>10 am</option>
										<option name="contact-from" value = "11am" <?php if($jobInfo->contact_from == "11am"){echo "selected";}?>>11 am</option>
										<option name="contact-from" value = "12am" <?php if($jobInfo->contact_from == "12am"){echo "selected";}?>>12 am</option>
										
										<option name="contact-from" value = "1pm" <?php if($jobInfo->contact_from == "1pm"){echo "selected";}?>>1 pm </option>
										<option name="contact-from" value = "2pm" <?php if($jobInfo->contact_from == "2pm"){echo "selected";}?>>2 pm </option>
										<option name="contact-from" value = "3pm" <?php if($jobInfo->contact_from == "3pm"){echo "selected";}?>>3 pm</option>
										<option name="contact-from" value = "4pm" <?php if($jobInfo->contact_from == "4pm"){echo "selected";}?>>4 pm</option>
										<option name="contact-from" value = "5pm" <?php if($jobInfo->contact_from == "5pm"){echo "selected";}?>>5 pm</option>
										<option name="contact-from" value = "6pm" <?php if($jobInfo->contact_from == "6pm"){echo "selected";}?>>6 pm</option>
										<option name="contact-from" value = "7pm" <?php if($jobInfo->contact_from == "7pm"){echo "selected";}?>>7 pm</option>
										<option name="contact-from" value = "8pm" <?php if($jobInfo->contact_from == "8pm"){echo "selected";}?>>8 pm</option>
										<option name="contact-from" value = "9pm" <?php if($jobInfo->contact_from == "9pm"){echo "selected";}?>>9 pm</option>
										<option name="contact-from" value = "10pm" <?php if($jobInfo->contact_from == "10pm"){echo "selected";}?>>10 pm</option>
										<option name="contact-from" value = "11pm" <?php if($jobInfo->contact_from == "11pm"){echo "selected";}?>>11 pm</option>
										
										
									</select>
								</div>
									<div class = "col-lg-4">
								To:
								</div>
								<div class = "col-lg-8">
									<select name = "contact-to" class="form-control">
										<option name="contact-to" value = "0am" <?php if($jobInfo->contact_to == "0am"){echo "selected";}?>>0 am</option>
										<option name="contact-to" value = "1am" <?php if($jobInfo->contact_to == "1am"){echo "selected";}?>>1 am </option>
										<option name="contact-to" value = "2am" <?php if($jobInfo->contact_to == "2am"){echo "selected";}?>>2 am </option>
										<option name="contact-to" value = "3am" <?php if($jobInfo->contact_to == "3am"){echo "selected";}?>>3 am</option>
										<option name="contact-to" value = "4am" <?php if($jobInfo->contact_to == "4am"){echo "selected";}?>>4 am</option>
										<option name="contact-to" value = "5am" <?php if($jobInfo->contact_to == "5am"){echo "selected";}?>>5 am</option>
										<option name="contact-to" value = "6am" <?php if($jobInfo->contact_to == "6am"){echo "selected";}?>>6 am</option>
										<option name="contact-to" value = "7am" <?php if($jobInfo->contact_to == "7am"){echo "selected";}?>>7 am</option>
										<option name="contact-to" value = "8am" <?php if($jobInfo->contact_to == "8am"){echo "selected";}?>>8 am</option>
										<option name="contact-to" value = "9am" <?php if($jobInfo->contact_to == "9am"){echo "selected";}?>>9 am</option>
										<option name="contact-to" value = "10am" <?php if($jobInfo->contact_to == "10am"){echo "selected";}?>>10 am</option>
										<option name="contact-to" value = "11am" <?php if($jobInfo->contact_to == "11am"){echo "selected";}?>>11 am</option>
										<option name="contact-to" value = "12am" <?php if($jobInfo->contact_to == "12am"){echo "selected";}?>>12 am</option>
										
										<option name="contact-to" value = "1pm" <?php if($jobInfo->contact_to == "1pm"){echo "selected";}?>>1 pm </option>
										<option name="contact-to" value = "2pm" <?php if($jobInfo->contact_to == "2pm"){echo "selected";}?>>2 pm </option>
										<option name="contact-to" value = "3pm" <?php if($jobInfo->contact_to == "3pm"){echo "selected";}?>>3 pm</option>
										<option name="contact-to" value = "4pm" <?php if($jobInfo->contact_to == "4pm"){echo "selected";}?>>4 pm</option>
										<option name="contact-to" value = "5pm" <?php if($jobInfo->contact_to == "5pm"){echo "selected";}?>>5 pm</option>
										<option name="contact-to" value = "6pm" <?php if($jobInfo->contact_to == "6pm"){echo "selected";}?>>6 pm</option>
										<option name="contact-to" value = "7pm" <?php if($jobInfo->contact_to == "7pm"){echo "selected";}?>>7 pm</option>
										<option name="contact-to" value = "8pm" <?php if($jobInfo->contact_to == "8pm"){echo "selected";}?>>8 pm</option>
										<option name="contact-to" value = "9pm" <?php if($jobInfo->contact_to == "9pm"){echo "selected";}?>>9 pm</option>
										<option name="contact-to" value = "10pm" <?php if($jobInfo->contact_to == "10pm"){echo "selected";}?>>10 pm</option>
										<option name="contact-to" value = "11pm" <?php if($jobInfo->contact_to == "11pm"){echo "selected";}?>>11 pm</option>
										
										
									</select>
								</div>		
							
									   
									</div>
									
								</div>			
							</div>
							
							<div class="pad-top">
							<!--<script>
								function shownextfile(next) {
									$("#"+next).show();	
									}
							</script>-->
							<script>
							function clearImg(numImg){
								   $('#img'+numImg).val("");
								}
							</script>
								<div class="form-control-wrapper" >
									Image about Job (Max 5 pictures)
									@if($jobInfo->attachment_src_1 != "")
									</br>Old Picture 1:<img src = "{{$jobInfo->attachment_src_1}}" style = "width:100px; height:100px;">				
							  		@endif
							  		<input type = "file" name = "photo_1" id="img1">
							  		<input type = "button" id="clear" value = "Reset" onclick = "clearImg(1)"/>
							  		<div id = "2">
							  		@if($jobInfo->attachment_src_2 != "")
									</br>Old Picture 2:<img src = "{{$jobInfo->attachment_src_2}}" style = "width:100px; height:100px;">				
							  		@endif				
							  			<input type = "file" name = "photo_2" id="img2">
							  			<input type = "button" id="clear" value = "Reset" onclick = "clearImg(2)"/>
							  		</div>
							  		<div id = "3">
							  		@if($jobInfo->attachment_src_3 != "")
									</br>Old Picture 3:<img src = "{{$jobInfo->attachment_src_3}}" style = "width:100px; height:100px;">				
							  		@endif				
							  		<input type = "file" name = "photo_3" id="img3">
							  		<input type = "button" id="clear" value = "Reset" onclick = "clearImg(3)"/>
							  		</div>
							  		<div id = "4">
							  		@if($jobInfo->attachment_src_4 != "")
									</br>Old Picture 4:<img src = "{{$jobInfo->attachment_src_4}}" style = "width:100px; height:100px;">				
							  		@endif				
							  		<input type = "file" name = "photo_4" id="img4">
							  		<input type = "button" id="clear" value = "Reset" onclick = "clearImg(4)"/>
							  		</div>				
							  		<div id = "5">
							  		@if($jobInfo->attachment_src_5 != "")
									</br>Old Picture 5:<img src = "{{$jobInfo->attachment_src_5}}" style = "width:100px; height:100px;">				
							  		@endif
							  		<input type = "file" name = "photo_5" id="img5">
							  		<input type = "button" id="clear" value = "Reset" onclick = "clearImg(5)"/>
							  		</div>	
								</div>			
							</div>
						 
						</div>
						
						<div class="form-fields-wrapper" id = "submit-div">
							<div class="form-steps-bottom"></div>
							
							<input class="button btn-full push-top btn-primary" name="commit" type="submit" value="Post" id = "btn-submit" id = "btn-submit">
						</div>
						<input name = "job_id" value = "{{$jobInfo->id}}" hidden>
				{{ Form::close() }}
					</div>
				
			</div>
        </div>
    </div>


@stop