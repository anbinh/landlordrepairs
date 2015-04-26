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
         <a href="{{URL::route('builder-profile')}}" class="list-group-item">Profile</a>
         <a href="{{URL::route('customer-invited')}}" class="list-group-item">Job Alerts</a>
         <a href="{{URL::route('builder-find-jobs')}}" class="list-group-item">Find Jobs</a>
         <a href="{{URL::route('builder-ongoing-jobs')}}" class="list-group-item">Ongoing Jobs</a>
         <a href="{{URL::route('builder-lost-jobs')}}" class="list-group-item">Lost jobs</a>					  
         <a href="{{URL::route('builder-won-jobs')}}" class="list-group-item">Won jobs</a>
         <a href="{{URL::route('builder-cancelled-jobs')}}" class="list-group-item">Cancelled jobs</a>
        
         <a href="{{URL::route('builder-completed-jobs')}}" class="list-group-item">Completed jobs</a>
         <a href="{{URL::route('customer-invited')}}" class="list-group-item">Invite jobs</a>
         <a href="{{URL::route('credit')}}" class="list-group-item">Credit</a>
         <a href="{{URL::route('get-reviews')}}" class="list-group-item">Get review</a>
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
                           <label>City or County</label>
                           {{ Form::text('local', $builder[0]->local, array('placeholder' => 'Type your code','class' => 'form-control')) }}
                        </div>
                        <div class="form-group">
                           <label>Post code</label>
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
                           {{ Form::text('miles_covered', $builder[0]->miles_covered, array('placeholder' => 'Type your miles covered','class' => 'form-control')) }}
                        </div>
                        <div class="form-group">
                           <span class="fa-stack fa-lg"><i class="fa fa-dribbble fa-stack-1x"></i></span>
                           <label>Site Link</label>
                           {{ Form::text('site_link', $builder[0]->site_link, array('placeholder' => 'Type your site link','class' => 'form-control')) }}
                        </div>
                        <div class="form-group">
                           <span class="fa-stack fa-lg"><i class="fa fa-facebook fa-stack-1x"></i></span>
                           <label>Facebook Link</label>
                           {{ Form::text('social_link', $builder[0]->social_link, array('placeholder' => 'Type your Facebook link','class' => 'form-control fa fa-twitter')) }}
                        </div>
                        <div class="form-group">
                           <span class="fa-stack fa-lg"><i class="fa fa-twitter fa-stack-1x"></i></span>
                           <label>Twitter Link</label>
                           {{ Form::text('social_link_twitter', $builder[0]->social_link_twitter, array('placeholder' => 'Type your Twitter link','class' => 'form-control ')) }}
                        </div>
                        <div class="form-group">
                           <label>Qualification</label>
                           {{ Form::textarea('qualification', $builder[0]->qualification, array('placeholder' => 'Qualification','class' => 'form-control')) }}
                        </div>
                        <div class="form-group">
                           <label>How many team?</label>
                           {{ Form::text('howmanyteam', $builder[0]->howmanyteam, array('placeholder' => 'How many team?','class' => 'form-control')) }}
                        </div>
                        <div class="form-group">
                           <label>About</label>
                           {{ Form::textarea('about', $builder[0]->about, array('placeholder' => 'Type about you','class' => 'form-control')) }}
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
                        <div class="pad-top">
                           <div class="form-control-wrapper" >
                              Association
                              <div class = "col-lg-12">
                              </div>
                              @if ($associations != null)
	                              @if (count($associations) < 5)
	                              <div class = "col-lg-12">
	                                 <div class="checkbox">
	                                    @for ($i = 0; $i < count($associations); $i++)
	                                    <img style = "width: 50px; height: 50px; margin-left: 15px;" src="{{$associations[$i]->association_src}}"/>
	                                    <label>
	                                    
	                                    <input type="checkbox" name = "check_builders_ass[]" value = "{{$associations[$i]->id}}" @foreach ($builder as $buildere) @if( $buildere->association_id == $associations[$i]->id) checked @endif @endforeach > {{$associations[$i]->association_name}}
	                                    </label>
	                                    @endfor
	                                 </div>
	                              </div>
	                              @else
	                              <div class = "col-lg-12">
	                                 <div class="checkbox">
	                                    @for ($i = 0; $i < 2; $i++)
	                                    <img style = "width: 50px; height: 50px; margin-left: 15px;" src="{{$associations[$i]->association_src}}"/>
	                                    <label>
	                                    
	                                    <input type="checkbox" name = "check_builders_ass[]" value = "{{$associations[$i]->id}}" @foreach ($builder as $buildere) @if( $buildere->association_id == $associations[$i]->id) checked @endif @endforeach > {{$associations[$i]->association_name}}
	                                    </label>
	                                    @endfor
	                                 </div>
	                              </div>
	                              <div class = "col-lg-12 listAss" hidden>
	                                 <div class="checkbox">
	                                    @for ($i = 2; $i < count($associations); $i++)
	                                    <img style = "width: 50px; height: 50px; margin-left: 15px;" src="{{$associations[$i]->association_src}}"/>
	                                    <label>
	                                    
	                                    <input type="checkbox" name = "check_builders_ass[]" value = "{{$associations[$i]->id}}" @foreach ($builder as $buildere) @if( $buildere->association_id == $associations[$i]->id) checked @endif @endforeach > {{$associations[$i]->association_name}}
	                                    </label>
	                                    @endfor
	                                 </div>
	                              </div>
	                              @endif
                              @endif 
                           </div>
                           <script>
                              function showAllAss() { //alert();
                              	if ($("#show_all_ass").val() == "Show all"){
                               		$("#show_all_ass").val("Hide");
                               		$(".listAss").show();
                              	} else {
                              		$("#show_all_ass").val("Show all");
                              		$(".listAss").hide();
                              	}
                              }
                           </script>
                           <div class = "col-lg-12" style = "margin-bottom: 100px;">
                              <input type = "button" onclick = "showAllAss()" id = "show_all_ass" value = "Show all"/>
                           </div>
                        </div>
                        <div class="form-group">
	                           
	                           <label>On Holiday</label>
	                           @if ($builder[0]->on_holiday == 1)
	                           		&nbsp &nbsp&nbsp<input type="checkbox" class = "checkbox_ass" name="on_holiday" value="1" id = "detail1" checked>
	                           @else
	                           		&nbsp &nbsp&nbsp<input type="checkbox" class = "checkbox_ass" name="on_holiday" value="1" id = "detail1">
	                           @endif
	                           <div class = "on_holiday_reason"  <?php if ($builder[0]->on_holiday != '1'){echo 'hidden';}?>>
	                    
		                           <label>Reason</label>
		                           {{ Form::textarea('on_holiday_reason', $builder[0]->on_holiday_reason, array('placeholder' => 'Your reason','class' => 'form-control')) }}
                        
	                           </div>
	                           <script>
	                           
	                           $(".checkbox_ass").change(function() {
	                        	    if(this.checked) { 
	                        	        $(".on_holiday_reason").show();
	                        	    } else {
	                        	    	$(".on_holiday_reason").hide();
		                        	}
	                        	});
	                           </script>
	                        </div>
	                        <div class="form-group">
	                           
	                           
						   
						   <div class = "col-lg-4">
								Working from:
						   </div>
						   <div class = "col-lg-8">
									<select name = "working_from" class="form-control">
										<option name="working_from" value = "0am" <?php if($builder[0]->working_from == "0am"){echo "selected";}?>>0 am</option>
										<option name="working_from" value = "1am" <?php if($builder[0]->working_from == "1am"){echo "selected";}?>>1 am </option>
										<option name="working_from" value = "2am" <?php if($builder[0]->working_from == "2am"){echo "selected";}?>>2 am </option>
										<option name="working_from" value = "3am" <?php if($builder[0]->working_from == "3am"){echo "selected";}?>>3 am</option>
										<option name="working_from" value = "4am" <?php if($builder[0]->working_from == "4am"){echo "selected";}?>>4 am</option>
										<option name="working_from" value = "5am" <?php if($builder[0]->working_from == "5am"){echo "selected";}?>>5 am</option>
										<option name="working_from" value = "6am" <?php if($builder[0]->working_from == "6am"){echo "selected";}?>>6 am</option>
										<option name="working_from" value = "7am" <?php if($builder[0]->working_from == "7am"){echo "selected";}?>>7 am</option>
										<option name="working_from" value = "8am" <?php if($builder[0]->working_from == "8am"){echo "selected";}?>>8 am</option>
										<option name="working_from" value = "9am" <?php if($builder[0]->working_from == "9am"){echo "selected";}?>>9 am</option>
										<option name="working_from" value = "10am" <?php if($builder[0]->working_from == "10am"){echo "selected";}?>>10 am</option>
										<option name="working_from" value = "11am" <?php if($builder[0]->working_from == "11am"){echo "selected";}?>>11 am</option>
										<option name="working_from" value = "12am" <?php if($builder[0]->working_from == "12am"){echo "selected";}?>>12 am</option>
										
										<option name="working_from" value = "1pm" <?php if($builder[0]->working_from == "1pm"){echo "selected";}?>>1 pm </option>
										<option name="working_from" value = "2pm" <?php if($builder[0]->working_from == "2pm"){echo "selected";}?>>2 pm </option>
										<option name="working_from" value = "3pm" <?php if($builder[0]->working_from == "3pm"){echo "selected";}?>>3 pm</option>
										<option name="working_from" value = "4pm" <?php if($builder[0]->working_from == "4pm"){echo "selected";}?>>4 pm</option>
										<option name="working_from" value = "5pm" <?php if($builder[0]->working_from == "5pm"){echo "selected";}?>>5 pm</option>
										<option name="working_from" value = "6pm" <?php if($builder[0]->working_from == "6pm"){echo "selected";}?>>6 pm</option>
										<option name="working_from" value = "7pm" <?php if($builder[0]->working_from == "7pm"){echo "selected";}?>>7 pm</option>
										<option name="working_from" value = "8pm" <?php if($builder[0]->working_from == "8pm"){echo "selected";}?>>8 pm</option>
										<option name="working_from" value = "9pm" <?php if($builder[0]->working_from == "9pm"){echo "selected";}?>>9 pm</option>
										<option name="working_from" value = "10pm" <?php if($builder[0]->working_from == "10pm"){echo "selected";}?>>10 pm</option>
										<option name="working_from" value = "11pm" <?php if($builder[0]->working_from == "11pm"){echo "selected";}?>>11 pm</option>
										
										
									</select>
								</div>
								<div class = "col-lg-4">
								Working to:
						   </div>
						   <div class = "col-lg-8">
									<select name = "working_to" class="form-control">
										<option name="working_to" value = "0am" <?php if($builder[0]->working_to == "0am"){echo "selected";}?>>0 am</option>
										<option name="working_to" value = "1am" <?php if($builder[0]->working_to == "1am"){echo "selected";}?>>1 am </option>
										<option name="working_to" value = "2am" <?php if($builder[0]->working_to == "2am"){echo "selected";}?>>2 am </option>
										<option name="working_to" value = "3am" <?php if($builder[0]->working_to == "3am"){echo "selected";}?>>3 am</option>
										<option name="working_to" value = "4am" <?php if($builder[0]->working_to == "4am"){echo "selected";}?>>4 am</option>
										<option name="working_to" value = "5am" <?php if($builder[0]->working_to == "5am"){echo "selected";}?>>5 am</option>
										<option name="working_to" value = "6am" <?php if($builder[0]->working_to == "6am"){echo "selected";}?>>6 am</option>
										<option name="working_to" value = "7am" <?php if($builder[0]->working_to == "7am"){echo "selected";}?>>7 am</option>
										<option name="working_to" value = "8am" <?php if($builder[0]->working_to == "8am"){echo "selected";}?>>8 am</option>
										<option name="working_to" value = "9am" <?php if($builder[0]->working_to == "9am"){echo "selected";}?>>9 am</option>
										<option name="working_to" value = "10am" <?php if($builder[0]->working_to == "10am"){echo "selected";}?>>10 am</option>
										<option name="working_to" value = "11am" <?php if($builder[0]->working_to == "11am"){echo "selected";}?>>11 am</option>
										<option name="working_to" value = "12am" <?php if($builder[0]->working_to == "12am"){echo "selected";}?>>12 am</option>
										
										<option name="working_to" value = "1pm" <?php if($builder[0]->working_to == "1pm"){echo "selected";}?>>1 pm </option>
										<option name="working_to" value = "2pm" <?php if($builder[0]->working_to == "2pm"){echo "selected";}?>>2 pm </option>
										<option name="working_to" value = "3pm" <?php if($builder[0]->working_to == "3pm"){echo "selected";}?>>3 pm</option>
										<option name="working_to" value = "4pm" <?php if($builder[0]->working_to == "4pm"){echo "selected";}?>>4 pm</option>
										<option name="working_to" value = "5pm" <?php if($builder[0]->working_to == "5pm"){echo "selected";}?>>5 pm</option>
										<option name="working_to" value = "6pm" <?php if($builder[0]->working_to == "6pm"){echo "selected";}?>>6 pm</option>
										<option name="working_to" value = "7pm" <?php if($builder[0]->working_to == "7pm"){echo "selected";}?>>7 pm</option>
										<option name="working_to" value = "8pm" <?php if($builder[0]->working_to == "8pm"){echo "selected";}?>>8 pm</option>
										<option name="working_to" value = "9pm" <?php if($builder[0]->working_to == "9pm"){echo "selected";}?>>9 pm</option>
										<option name="working_to" value = "10pm" <?php if($builder[0]->working_to == "10pm"){echo "selected";}?>>10 pm</option>
										<option name="working_to" value = "11pm" <?php if($builder[0]->working_to == "11pm"){echo "selected";}?>>11 pm</option>
										
										
									</select>
								</div>
						  
	                        </div>
	                       <div class="form-group">
	                       
	                           
						   Working from day:
						   <select name="working_day_from" class="form-control">
								  <option value="monday" <?php if($builder[0]->working_day_from == 'monday'){echo 'selected';}?>>Monday</option>
								  <option value="tuesday" <?php if ($builder[0]->working_day_from == 'tuesday'){echo 'selected';}?>>Tuesday</option>
								  <option value="wednesday" <?php if($builder[0]->working_day_from == 'wednesday'){echo 'selected';}?>>Wednesday</option>
								  <option value="thursday" <?php if($builder[0]->working_day_from == 'thursday'){echo 'selected';}?>>Thursday</option>
								  <option value="friday" <?php if($builder[0]->working_day_from == 'friday'){echo 'selected';}?>>Friday</option>
								  <option value="saturday" <?php if($builder[0]->working_day_from == 'saturday'){echo 'selected';}?>>Saturday</option>
								  <option value="sunday" <?php if($builder[0]->working_day_from == 'sunday'){echo 'selected';}?>>Sunday</option>
								  
							</select>     
						   <br>		
						   Working to day:
						   <select name="working_day_to" class="form-control">
								  <option value="monday" <?php if($builder[0]->working_day_to == 'monday'){echo 'selected';}?>>Monday</option>
								  <option value="tuesday" <?php if ($builder[0]->working_day_to == 'tuesday'){echo 'selected';}?>>Tuesday</option>
								  <option value="wednesday" <?php if($builder[0]->working_day_to == 'wednesday'){echo 'selected';}?>>Wednesday</option>
								  <option value="thursday" <?php if($builder[0]->working_day_to == 'thursday'){echo 'selected';}?>>Thursday</option>
								  <option value="friday" <?php if($builder[0]->working_day_to == 'friday'){echo 'selected';}?>>Friday</option>
								  <option value="saturday" <?php if($builder[0]->working_day_to == 'saturday'){echo 'selected';}?>>Saturday</option>
								  <option value="sunday" <?php if($builder[0]->working_day_to == 'sunday'){echo 'selected';}?>>Sunday</option>
								  
							</select>
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
                           
                           <input name = "phonenumber" class = "form-control" placeholdet = "Type your new Phonenumber" value = "{{Auth::user()->phone_number}}"/>
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
                  Portfolio
               </div>
               <div class="panel-body">
                  @if ($builder_jobs != null)
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
                        <script>
	                        function shownextfile(next) {
	                        	$("#"+next).show();
							
							}
							function showinputfile(next) {
								
								var next_num = next+1;
								if (next < 5) {
									document.write('<input type = "file" name = "photo_'+next+'" onchange = "shownextfile('+next_num+')"/>');	
								} else {
									document.write('<input type = "file" name = "photo_5" />');
								}
							}
						</script>
                        <div class="form-group">
                        
                           <label>Jobs details</label>
 
                                {{ Form::open(array('url'=>'builder-submit-job-details','files'=>true)) }}
                                	
									<div class="form-control-wrapper" >
										<script>
											var next_now = 1;
										</script>
										<?php 
											$next_now =1;
										?>
										<p>Image about Job</p>
										@if ($buildere->picture_portfolio_1 != "")
						                <a href = "{{$buildere->picture_portfolio_1}}" target ="_blank"><img src = "{{$buildere->picture_portfolio_1}}" style = "width: 100px; height: 100px"/></a>
							                <script>
							                	next_now = 2;
							                </script>
							                <?php 
												$next_now =2;
											?>
						                @endif
						                @if ($buildere->picture_portfolio_2 != "")
						                <a href = "{{$buildere->picture_portfolio_2}}" target ="_blank"><img src = "{{$buildere->picture_portfolio_2}}" style = "width: 100px; height: 100px"/></a>
						                	<script>
						                		next_now = 3;
						                	</script>
						                	<?php 
												$next_now =3;
											?>
						                @endif
						                @if ($buildere->picture_portfolio_3 != "")
						                <a href = "{{$buildere->picture_portfolio_3}}" target ="_blank"><img src = "{{$buildere->picture_portfolio_3}}" style = "width: 100px; height: 100px"/></a>
						                	<script>
						                		next_now = 4;
						                	</script>
						                	<?php 
												$next_now =4;
											?>
						                @endif
						                @if ($buildere->picture_portfolio_4 != "")
						                <a href = "{{$buildere->picture_portfolio_4}}" target ="_blank"><img src = "{{$buildere->picture_portfolio_4}}" style = "width: 100px; height: 100px"/></a>
						                	<script>
						                		next_now = 5;
						                	</script>
						                	<?php 
												$next_now =5;
											?>
						                @endif
						                @if ($buildere->picture_portfolio_5 != "")
						                <a href = "{{$buildere->picture_portfolio_5}}" target ="_blank"><img src = "{{$buildere->picture_portfolio_5}}" style = "width: 100px; height: 100px"/></a>
						                @endif
						                <script>
						                	showinputfile(next_now);
						                </script>
						            	
						            
						            	@if($next_now < 2)
						            		<div id = "2" hidden>				
								  			<input type = "file" name = "photo_2" onchange = "shownextfile('3')" >
									  		</div>
									  		<div id = "3" hidden>				
									  		<input type = "file" name = "photo_3" onchange = "shownextfile('4')" >
									  		</div>
									  		<div id = "4" hidden>				
									  		<input type = "file" name = "photo_4" onchange = "shownextfile('5')" >
									  		</div>				
									  		<div id = "5" hidden>
									  		<input type = "file" name = "photo_5" >
									  		</div>	
						            	@else
						            		@if($next_now < 3)
							            		
										  		<div id = "3" hidden>				
										  		<input type = "file" name = "photo_3" onchange = "shownextfile('4')" >
										  		</div>
										  		<div id = "4" hidden>				
										  		<input type = "file" name = "photo_4" onchange = "shownextfile('5')" >
										  		</div>				
										  		<div id = "5" hidden>
										  		<input type = "file" name = "photo_5" >
										  		</div>	
						            		@else
						            			@if($next_now < 4)
							            		
											  		<div id = "4" hidden>				
											  		<input type = "file" name = "photo_4" onchange = "shownextfile('5')" >
											  		</div>				
											  		<div id = "5" hidden>
											  		<input type = "file" name = "photo_5" >
											  		</div>	
						            			@else
						            				@if($next_now < 5)
												  		<div id = "5" hidden>
												  		<input type = "file" name = "photo_5" >
												  		</div>	
						            				@endif
						            				
						            			@endif
						            			
						            		@endif
						            	@endif
						            	
								  		
									</div>	
	                              <input name = "builder_id" value = "{{Auth::user()->id}}" hidden>
	                              <input name = "job_id" value = "{{$buildere->job_id}}" hidden>
	                              <textarea name = "builder_note_job" rows="4" cols="50">{{$buildere->builder_note_job}}</textarea>
	                              <button class = "btn btn-primary" type = "submit">Submit</button>
	                           {{ Form::close() }}
                        </div>
         
                     </div>
                  </div>
                  <hr>
                  @endforeach
                  @else
                  	No have job
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