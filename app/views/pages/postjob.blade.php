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
         {{ implode('', $errors->all('
         <li class="error">:message</li>
         ')) }}
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
            {{ Form::open(array('url'=>'postjob','files'=>true)) }}
            <!--				<form accept-charset="UTF-8" action="{{URL::to('postjob')}}" class="simple_form analytics-event" data-event-name="regular email log in attempt" id="new_user_session" method="post" >-->
            <div class="login-block" >
               <div class="pad-top">
                  <div class="form-control-wrapper" >
                     <input name = "tittle" type="text" class="form-control" required placeholder = 'Job tittle'>
                  </div>
               </div>
               <div class="pad-top">
                  Who do you need?
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
                  Set your Budget
               </div>
               <div class="pad-top">
                  <div class="row" >
                  	 <div class="col-lg-10">
                     	<input name = "price" type="text" class="form-control price-input" required placeholder = 'Price'>
                     </div>
                     <div class="col-lg-2" style="top:10px;">
                     	£
                     </div>
                  </div>
               </div>
                
               <div class="pad-top">
                  Your address
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
                  When should they start?
               </div>
               <div class="pad-top">
                  <div class="form-control-wrapper" >
                     <div class="radio">
                        <label>
                        <input class = "hide-date" type="radio" name="timeoption"  value="Flexible" checked>
                        Flexible
                        </label>
                        <label style = "text-decoration: underline; color: red;">
                        <input class = "hide-date" type="radio" name="timeoption"  value="Emergency">
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
               <div class="pad-top">
                  Tell us more about the job
               </div>
               <div class="pad-top">
                  <div class="form-control-wrapper" >
                     <textarea rows="4" cols="50" name = "description" required placeholder = 'Description' class="form-control"> </textarea>
                  </div>
               </div>
               <div class="pad-top">
                  <script>
                     function shownextfile(next) {
                         if (next != "6"){
                        	 $("#"+next).show();
                         }else{
                        	 $(".danger-text").show();	
                         }
                         $numImg = next-1;
                         if ($('#img'+$numImg).val() != null){
                        	 $("#clear"+$numImg).show();
                         }

                         /*Test is Show Limit Alert Text*/
                         if (($('#img1').val() != "") && ($('#img2').val() != "") && ($('#img3').val() != "") && ($('#img4').val() != "")&& ($('#img5').val() != "")){
                        	 $(".danger-text").show();	
                         }
                         
                     		
                     }
                     function clearImg(numImg){
                    	 
                         if(numImg != "5"){
                        	 $('#img'+numImg).val("");
                        	 $("#clear"+numImg).hide();
                         }else{
                        	 $('#img'+numImg).val("");
                        	 $("#clear"+numImg).hide();
                        	 
                         }
                         $(".danger-text").hide();	
                    
                     	}
                     								
                  </script>
                  <div class="form-control-wrapper" >
                     Image about Job (Max 5 pictures)
                     <div class="row" >
	                  	 <div class="col-lg-10">
	                     	<input type = "file" name = "photo_1" onchange = "shownextfile('2')" id="img1">
	                     </div>
	                     <div class="col-lg-2">
	                     	<input hidden type = "button" id="clear1" value = "X" onclick = "clearImg(1)"/>
	                     </div>
                  	 </div>
                  				
                     <div class="row" id = "2" hidden>
	                  	 <div class="col-lg-10">
	                     	<input type = "file" name = "photo_2" onchange = "shownextfile('3')" hidden id="img2">
	                     </div>
	                     <div class="col-lg-2">
	                     	<input hidden type = "button" id="clear2" value = "X" onclick = "clearImg(2)"/>
	                     </div>
                  	 </div>
                  	 
                  	 <div class="row" id = "3" hidden>
	                  	 <div class="col-lg-10">
	                     	<input type = "file" name = "photo_3" onchange = "shownextfile('4')" hidden id="img3">
	                     </div>
	                     <div class="col-lg-2">
	                     	<input hidden type = "button" id="clear3" value = "X" onclick = "clearImg(3)"/>
	                     </div>
                  	 </div>
                     
                     <div class="row" id = "4" hidden>
	                  	 <div class="col-lg-10">
	                     	<input type = "file" name = "photo_4" onchange = "shownextfile('5')" hidden id="img4">
	                     </div>
	                     <div class="col-lg-2">
	                     	<input hidden type = "button" id="clear4" value = "X" onclick = "clearImg(4)"/>
	                     </div>
                  	 </div>
                  	 
                  	 <div class="row" id = "5" hidden>
	                  	 <div class="col-lg-10">
	                     	<input type = "file" name = "photo_5" onchange = "shownextfile('6')" hidden id="img5">
	                     </div>
	                     <div class="col-lg-2">
	                     	<input hidden type = "button" id="clear5" value = "X" onclick = "clearImg(5)"/>
	                     </div>
                  	 </div>
                  	 
                  	 
                     
                     
                     
                     <p class="danger danger-text" hidden style="color:red">You have hit the limit</p>
                  </div>
               </div>
               <div class="pad-top">
                  What time is good to be contacted?
               </div>
               <div class="pad-top">
                  <div class="form-control-wrapper" >
                     <div class="radio">
                        <label>
                        <input type="radio" name="contact-time"  value="0" checked id = "hide_contact-time">
                        Any time
                        </label>
                        <label style = "radio">
                        <input type="radio" name="contact-time"  value=" 1" id = "show_contact-time">
                        From too
                        </label>
                     </div>
                     <div id="contact-time-detail" hidden>
                        <div class = "col-lg-4">
                           From:
                        </div>
                        <div class = "col-lg-8">
                           <select name = "contact-from" class="form-control">
                              <option name="contact-from" value = "0am">0 am</option>
                              <option name="contact-from" value = "1am">1 am </option>
                              <option name="contact-from" value = "2am ">2 am </option>
                              <option name="contact-from" value = "3am">3 am</option>
                              <option name="contact-from" value = "4am">4 am</option>
                              <option name="contact-from" value = "5am">5 am</option>
                              <option name="contact-from" value = "6am">6 am</option>
                              <option name="contact-from" value = "7am">7 am</option>
                              <option name="contact-from" value = "8am">8 am</option>
                              <option name="contact-from" value = "9am">9 am</option>
                              <option name="contact-from" value = "10am">10 am</option>
                              <option name="contact-from" value = "11am">11 am</option>
                              <option name="contact-from" value = "12am">12 am</option>
                              <option name="contact-from" value = "1pm">1 pm </option>
                              <option name="contact-from" value = "2pm ">2 pm </option>
                              <option name="contact-from" value = "3pm">3 pm</option>
                              <option name="contact-from" value = "4pm">4 pm</option>
                              <option name="contact-from" value = "5pm">5 pm</option>
                              <option name="contact-from" value = "6pm">6 pm</option>
                              <option name="contact-from" value = "7pm">7 pm</option>
                              <option name="contact-from" value = "8pm">8 pm</option>
                              <option name="contact-from" value = "9pm">9 pm</option>
                              <option name="contact-from" value = "10pm">10 pm</option>
                              <option name="contact-from" value = "11pm">11 pm</option>
                           </select>
                        </div>
                        <div class = "col-lg-4">
                           To:
                        </div>
                        <div class = "col-lg-8">
                           <select name = "contact-to" class="form-control">
                              <option name="contact-to" value = "0am">0 am</option>
                              <option name="contact-to" value = "1am">1 am </option>
                              <option name="contact-to" value = "2am">2 am </option>
                              <option name="contact-to" value = "3am">3 am</option>
                              <option name="contact-to" value = "4am">4 am</option>
                              <option name="contact-to" value = "5am">5 am</option>
                              <option name="contact-to" value = "6am">6 am</option>
                              <option name="contact-to" value = "7am">7 am</option>
                              <option name="contact-to" value = "8am">8 am</option>
                              <option name="contact-to" value = "9am">9 am</option>
                              <option name="contact-to" value = "10am">10 am</option>
                              <option name="contact-to" value = "11am">11 am</option>
                              <option name="contact-to" value = "1pm">1 pm </option>
                              <option name="contact-to" value = "2pm">2 pm </option>
                              <option name="contact-to" value = "3pm">3 pm</option>
                              <option name="contact-to" value = "4pm">4 pm</option>
                              <option name="contact-to" value = "5pm">5 pm</option>
                              <option name="contact-to" value = "6pm">6 pm</option>
                              <option name="contact-to" value = "7pm">7 pm</option>
                              <option name="contact-to" value = "8pm">8 pm</option>
                              <option name="contact-to" value = "9pm">9 pm</option>
                              <option name="contact-to" value = "10pm">10 pm</option>
                              <option name="contact-to" value = "11pm">11 pm</option>
                           </select>
                        </div>
                     </div>
                     <script>
                        $(document).ready(function(){
                        	$("#contact-time-detail").hide();
                        	
                            $("#show_contact-time").click(function(){
                            	$("#contact-time-detail").show();
                              
                            });
                            $("#hide_contact-time").click(function(){
                            	$("#contact-time-detail").hide();
                              
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
            {{ Form::close() }}
         </div>
      </div>
   </div>
</div>
@stop