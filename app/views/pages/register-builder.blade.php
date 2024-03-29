@extends('layouts.default')
@section('content')	
<div class="row" style = "BACKGROUND: rgb(173, 179, 158);">
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
                     <div class="form-control-wrapper" >
                        <input name = "tittle" type="text" class="form-control" required placeholder = ' Company name'>
                     </div>
                  </div>
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
                          
                           
                           <input name = "miles_covered" type="text" class="form-control"  placeholder = 'Miles covered'>
                        </div>
                     <div class="pad-top">
                        <div class="form-control-wrapper" >
                           <input name = "site_link" type="text" class="form-control"  placeholder = 'Site link'>
                        </div>
                     </div>
                     <div class="pad-top">
                        <div class="form-control-wrapper" >
                           <input name = "social_link" type="text" class="form-control"  placeholder = 'Facebook link'>
                        </div>
                     </div>
                     <div class="pad-top">
                        <div class="form-control-wrapper" >
                           <input name = "social_link_twitter" type="text" class="form-control"  placeholder = 'Twitter link'>
                        </div>
                     </div>
                     <div class="pad-top">
                        <div class="form-control-wrapper" >
                           <textarea name = "qualification" rows="5" class="form-control"  placeholder = 'Qualification'></textarea>
                        </div>
                     </div>
                     <div class="pad-top">
                        <div class="form-control-wrapper" >
                           <input name = "howmanyteam" type="text" class="form-control"  placeholder = 'How many team?'>
                        </div>
                     </div>
                     
                     <div class="pad-top">
                        <div class="form-control-wrapper" >
                           <textarea name = "about" rows="4"  class="form-control" placeholder = 'About'></textarea>
                        </div>
                     </div>
                  </div>
                  <div class="pad-top">
                	On Holiday: &nbsp &nbsp&nbsp<input type="checkbox" name="on_holiday" value="1" id = "detail1">
                	
				</div>
               <div class="pad-top">
					<div class="form-control-wrapper" >
						<div class = "col-lg-4">
								Working from:
						   </div>
						   <div class = "col-lg-8">
									<select name = "working_from" class="form-control">
										<option name="working_from" value = "0am">0 am</option>
										<option name="working_from" value = "1am">1 am </option>
										<option name="working_from" value = "2am">2 am </option>
										<option name="working_from" value = "3am">3 am</option>
										<option name="working_from" value = "4am" >4 am</option>
										<option name="working_from" value = "5am">5 am</option>
										<option name="working_from" value = "6am">6 am</option>
										<option name="working_from" value = "7am" >7 am</option>
										<option name="working_from" value = "8am">8 am</option>
										<option name="working_from" value = "9am">9 am</option>
										<option name="working_from" value = "10am">10 am</option>
										<option name="working_from" value = "11am">11 am</option>
										<option name="working_from" value = "12am">12 am</option>
										
										<option name="working_from" value = "1pm">1 pm </option>
										<option name="working_from" value = "2pm">2 pm </option>
										<option name="working_from" value = "3pm">3 pm</option>
										<option name="working_from" value = "4pm">4 pm</option>
										<option name="working_from" value = "5pm">5 pm</option>
										<option name="working_from" value = "6pm">6 pm</option>
										<option name="working_from" value = "7pm">7 pm</option>
										<option name="working_from" value = "8pm">8 pm</option>
										<option name="working_from" value = "9pm">9 pm</option>
										<option name="working_from" value = "10pm">10 pm</option>
										<option name="working_from" value = "11pm">11 pm</option>
										
										
									</select>
								</div>
						   <div class = "col-lg-4">
								Working to:
						   </div>
						   <div class = "col-lg-8">
									<select name = "working_to" class="form-control">
										<option name="working_to" value = "0am">0 am</option>
										<option name="working_to" value = "1am">1 am </option>
										<option name="working_to" value = "2am">2 am </option>
										<option name="working_to" value = "3am">3 am</option>
										<option name="working_to" value = "4am">4 am</option>
										<option name="working_to" value = "5am">5 am</option>
										<option name="working_to" value = "6am">6 am</option>
										<option name="working_to" value = "7am">7 am</option>
										<option name="working_to" value = "8am">8 am</option>
										<option name="working_to" value = "9am">9 am</option>
										<option name="working_to" value = "10am">10 am</option>
										<option name="working_to" value = "11am">11 am</option>
										<option name="working_to" value = "12am">12 am</option>
										
										<option name="working_to" value = "1pm">1 pm </option>
										<option name="working_to" value = "2pm">2 pm </option>
										<option name="working_to" value = "3pm">3 pm</option>
										<option name="working_to" value = "4pm">4 pm</option>
										<option name="working_to" value = "5pm">5 pm</option>
										<option name="working_to" value = "6pm">6 pm</option>
										<option name="working_to" value = "7pm">7 pm</option>
										<option name="working_to" value = "8pm">8 pm</option>
										<option name="working_to" value = "9pm">9 pm</option>
										<option name="working_to" value = "10pm">10 pm</option>
										<option name="working_to" value = "11pm">11 pm</option>
										
										
									</select>
								</div>
						   
						
					</div>
					<div class="form-control-wrapper" >
					Working from day:
						   <select name="working_day_from" class="form-control">
								  <option value="monday" selected>Monday</option>
								  <option value="tuesday">Tuesday</option>
								  <option value="wednesday">Wednesday</option>
								  <option value="thursday">Thursday</option>
								  <option value="friday">Friday</option>
								  <option value="saturday">Saturday</option>
								  <option value="sunday">Sunday</option>
								  
							</select>     
						   <br>		
						   Working to day:
						   <select name="working_day_to" class="form-control">
								  <option value="monday">Monday</option>
								  <option value="tuesday">Tuesday</option>
								  <option value="wednesday">Wednesday</option>
								  <option value="thursday">Thursday</option>
								  <option value="friday">Friday</option>
								  <option value="saturday">Saturday</option>
								  <option value="sunday" selected>Sunday</option>
								  
							</select>
					</div>			
				</div>
				   
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
                  <div class="pad-top">
                     <div class="form-control-wrapper" >
                        <div class="radio">
                           <label>
                           <input type="radio" name="package_pay_type" value="1" checked >
                           Auto pay
                           </label>
                           <label>
                           <input type="radio" name="package_pay_type" value="0">
                           Manual
                           </label>
                        </div>
                     </div>
                  </div>
                  </div>
                  <div class="panel-heading">
                     <h3 class="panel-title" style = "text-align: center">About Service</h3>
                  </div>
                  
                  <div class="pad-top">
                     <div class="form-control-wrapper" >
                        <div class = "col-lg-12">
                           Category:
                        </div>
                        @if ($categorys != null)
                        @if (count($categorys) < 5)
                        <div class = "col-lg-12">
                           <div class="checkbox">
                              @foreach ($categorys as $category)
                              <label>
                              <input type="checkbox" name = "check_builders[]" value = "{{$category->id}}"> {{$category->content}}
                              </label>
                              @endforeach
                           </div>
                        </div>
                        @else
                        <div class = "col-lg-12">
                           <div class="checkbox">
                              @for ($i = 0; $i < 2; $i++)
                              <label>
                              <input type="checkbox" name = "check_builders[]" value = "{{$categorys[$i]->id}}"> {{$categorys[$i]->content}}
                              </label>
                              @endfor
                           </div>
                        </div>
                        <div class = "col-lg-12 listCategorys" hidden>
                           <div class="checkbox">
                              @for ($i = 2; $i < count($categorys); $i++)
                              <label>
                              <input type="checkbox" name = "check_builders[]" value = "{{$categorys[$i]->id}}"> {{$categorys[$i]->content}}
                              </label>
                              @endfor
                           </div>
                        </div>
                        @endif
                        @endif 
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
                     <div class = "col-lg-12">
                        <input type = "button" onclick = "showAllCategory()" id = "show_all_category" value = "Show all"/>
                     </div>
                  </div>
               
               
               <div class="pad-top">
                  <div class="form-control-wrapper" >
                     
                     <textarea name = "description" rows="4"  class="form-control" placeholder = 'Description'></textarea>
                  </div>
               </div>
               <!--<div class="pad-top">
                  <div class = "col-lg-12">
                     Are you member of any association?
                  </div>
                  <script>
                     function addGasNumber(){
                     	$("#gasNum").show();		
                     }
                     function hideGasNumber(){
                     	$("#gasNum").hide();		
                     }
                  </script>
                   <img style = "width: 50px; height: 50px; margin-left: 15px;" src="{{$associations[0]->association_src}}"/>
                  <label>											  	
                  <input type="radio" onclick = "addGasNumber()" name="association" value="{{$associations[0]->association_name}}" id = "detail1">
                  {{$associations[0]->association_name}}
                  </label>
                  <input name = "gasNumber" id = "gasNum" placeholder = "Type Gas number" hidden/>
                  <div class="form-control-wrapper" >
                     <div class="radio">
                        @for  ($i = 1; $i < 4; $i++)
                        <img style = "width: 50px; height: 50px; margin-left: 15px;" src="{{$associations[$i]->association_src}}"/>
                        <label>											  	
                        <input type="radio" onclick = "hideGasNumber()" name="association" value="{{$associations[$i]->association_name}}" id = "detail1">
                        {{$associations[$i]->association_name}}
                        </label>
                        @endfor
                        <div class = "list_associations" hidden>
                           @for  ($i = 4; $i < 16; $i++)
                           <img style = "width: 50px; height: 50px; margin-left: 15px;" src="{{$associations[$i]->association_src}}"/>
                           <label>											  	
                           <input type="radio" onclick = "hideGasNumber()" name="association" value="{{$associations[$i]->association_name}}" id = "detail1">
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
                -->
               <div class="pad-top">
                     <div class="form-control-wrapper" >
                        <div class = "col-lg-12">
                           Are you member of any association?
                        </div>
                        @if ($associations != null)
                        @if (count($associations) < 5)
                        <div class = "col-lg-12">
                           <div class="checkbox">
                              @foreach ($associations as $association)
                              <img style = "width: 50px; height: 50px; margin-left: 15px;" src="{{$association->association_src}}"/>
                              <label>
                              
                              <input type="checkbox" name = "check_builders_ass[]" value = "{{$association->id}}"> {{$association->association_name}}
                              </label>
                              @endforeach
                           </div>
                        </div>
                        @else
                        <div class = "col-lg-12">
                           <div class="checkbox">
                              @for ($i = 0; $i < 2; $i++)
                             <img style = "width: 50px; height: 50px; margin-left: 15px;" src="{{$associations[$i]->association_src}}"/>
                              <label>
                              
                              <input type="checkbox" name = "check_builders_ass[]" value = "{{$associations[$i]->id}}"> {{$associations[$i]->association_name}}
                              </label>
                              @endfor
                           </div>
                        </div>
                        <div class = "col-lg-12 listAss" hidden>
                           <div class="checkbox">
                              @for ($i = 2; $i < count($associations); $i++)
                              <img style = "width: 50px; height: 50px; margin-left: 15px;" src="{{$associations[$i]->association_src}}"/>
                              <label>
                              
                              <input type="checkbox" name = "check_builders_ass[]" value = "{{$associations[$i]->id}}"> {{$associations[$i]->association_name}}
                              </label>
                              @endfor
                           </div>
                        </div>
                        @endif
                        @endif 
                     </div>
                     <script>
                        function showAllAss() {
                        	if ($("#show_all_ass").val() == "Show all"){
                         		$("#show_all_ass").val("Hide");
                         		$(".listAss").show();
                        	} else {
                        		$("#show_all_ass").val("Show all");
                        		$(".listAss").hide();
                        	}
                        }
                     </script>
                     <div class = "col-lg-12">
                        <input type = "button" onclick = "showAllAss()" id = "show_all_ass" value = "Show all"/>
                     </div>
                  </div>
                  
             
                  <input class="button btn-full push-top btn-primary" name="commit" type="submit" value="Register" id = "btn-submit" id = "btn-submit">
               </div>
         </div>
         </form>
      </div>
   </div>
</div>
</div>
@stop