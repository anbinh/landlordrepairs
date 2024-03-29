
@extends('layouts.default')
@section('content')
<style>
							

*:before, *:after {
-webkit-box-sizing: border-box;
-moz-box-sizing: border-box;
box-sizing: border-box;
}

.clearfix {
  clear:both;
}

.text-center {text-align:center;}

pre {
display: block;
padding: 9.5px;
margin: 0 0 10px;
font-size: 13px;
line-height: 1.42857143;
color: #333;
word-break: break-all;
word-wrap: break-word;
background-color: #F5F5F5;
border: 1px solid #CCC;
border-radius: 4px;
}


.success-box {
  margin:50px 0;
  padding:10px 10px;
  border:1px solid #eee;
  background:#f9f9f9;
}

.success-box img {
  margin-right:10px;
  display:inline-block;
  vertical-align:top;
}

.success-box > div {
  vertical-align:top;
  display:inline-block;
  color:#888;
}



/* Rating Star Widgets Style */
.rating-stars ul {
  list-style-type:none;
  padding:0;
  
  -moz-user-select:none;
  -webkit-user-select:none;
}
.rating-stars ul > li.star {
  display:inline-block;
  
}

/* Idle State of the stars */
.rating-stars ul > li.star > i.fa {
  font-size:1em; /* Change the size of the stars */
  color:#ccc; /* Color on idle state */
}

/* Hover state of the stars */
.rating-stars ul > li.star.hover > i.fa {
  color:#FFCC36;
}

/* Selected state of the stars */
.rating-stars ul > li.star.selected > i.fa {
  color:#FF912C;
}
.rating-widget{
	padding: 0 0;
	width: 50%;
	float:left;
}							
</style>
	<div class="container" style= "margin-bottom: 230px;">
			<div class="row">
				<h1 class="text-center">Dashboard</h1>
			</div>
			<div class="col-md-2">
				<div class="list-group">
					  <a href="#" class="list-group-item active">
					    Dashboard
					  </a>
					  <a href="{{URL::route('admin-manage-builders')}}" class="list-group-item">Builders Profile</a>
					  <a href="{{URL::route('admin-manage-users')}}" class="list-group-item">Users Profile</a>
					  <a href="{{URL::route('admin-today-jobs')}}" class="list-group-item">Today jobs</a>
					  <a href="{{URL::route('admin-new-users')}}" class="list-group-item">New Users</a>
					  <a href="{{URL::route('admin-new-builders')}}" class="list-group-item">New Builders</a>
					  <a href="{{URL::route('admin-invites-sent-by-users')}}" class="list-group-item">Invites Sent</a>
					  <a href="{{URL::route('admin-manage-associations')}}" class="list-group-item">Manage Associaion</a>
					  <a href="{{URL::route('admin-non-reply-email')}}" class="list-group-item">Non Rely Email</a>
					  <a href="{{URL::route('admin-manage-faq')}}" class="list-group-item">FAQs</a>
					  <a href="{{URL::route('admin-manage-category')}}" class="list-group-item">Categorys</a>
					   <a href="{{URL::route('admin-manage-charges')}}" class="list-group-item">Charges</a>
					   <a href="{{URL::route('request-cancelledjobs')}}" class="list-group-item">Request cancel job</a>
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
		                            <div class="form-group">
		                                <label>Name: </label>
		                                {{$builder[0]->username}}
		                                
		                            </div>
		                           
		                            <div class="form-group">
		                                <label>Email: </label>
		                                {{$builder[0]->email}}
		                                
		                            </div>
		                            
		                            <div class="form-group">
		                                <label>Company: </label>
		                                {{$builder[0]->tittle}}
		                                
		                            </div>
		                            
		                            <div class="form-group">
		                                <label>Local: </label>
		                                {{$builder[0]->local}}
		                                
		                            </div>
		                            <div class="form-group">
                           <label>Post code: </label>
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
                           
                           <label>Miles covered: </label>
                           {{ Form::text('miles_covered', $builder[0]->miles_covered, array('placeholder' => 'Type your miles covered','class' => 'form-control')) }}
                        </div>      
		                            
		                          
		                    
                            
		                            <div class="form-group">
		                            <span class="fa-stack fa-lg"><i class="fa fa-dribbble fa-stack-1x"></i></span>
		                                <label>Site Link: </label>
		                                {{$builder[0]->site_link}}
		                                
		                            </div>
		                             <div class="form-group">
		                             <span class="fa-stack fa-lg"><i class="fa fa-facebook fa-stack-1x"></i></span>
		                                <label>Facebook: </label>
		                                {{$builder[0]->social_link}}
		                                
		                            </div>
		                            <div class="form-group">
		                            <span class="fa-stack fa-lg"><i class="fa fa-twitter fa-stack-1x"></i></span>
		                                <label>Twitter: </label>
		                                {{$builder[0]->social_link_twitter}}
		                                
		                            </div>
		                            
		                             <div class="col-lg-12">
		                                <label>Started At: </label>
		                                {{$builder[0]->created_at}}
		                                
		                            </div>
		                            
				                    <div class="pad-top">
								<div class="form-control-wrapper" >
								
								<div class = "col-lg-12">
								<label>Category: </label>
								
								</div>
								
								
								
								
								<div class = "col-lg-12">
								<ul>
								@foreach($builder_categorys as $builder_category)
									
									<li>{{$builder_category->content}}</li>
									
								@endforeach
								</ul>  
								</hr>
									
								</div>
								</div>
	
							   
								
						</div>
						<div class="pad-top">
								<div class="form-control-wrapper" >
								
								<div class = "col-lg-12">
								
								<label>Association: </label>
								</div>
				
								<div class = "col-lg-12">
								<ul>
								@foreach($builder as $buildere)
									<li><img style = "width: 50px; height: 50px; margin-left: 15px;" src="{{$buildere->association_src}}"/>
									{{$buildere->association_name}}
									</li>
								@endforeach 
								</ul>
									
								</div>
								</div>
	
							   
								
						</div>
						<div class="pad-top">
								<div class="form-control-wrapper" >
								
								<div class = "col-lg-12">
								
								<label>On Holiday:</label>
								@if ($builder[0]->on_holiday == 1)
	                           		Yes<br>
	                           		Reason: {{$builder[0]->on_holiday_reason}}</p>
	                           		
	                           @else
	                           		No
	                           @endif
								</div>
				
								
								</div>
	
							   
								
						</div>
						
						<div class = "col-lg-12">
	                       <label>Day working: </label>
	                       </div>
	                       <div class="col-lg-12">    
	                       From: <input name="working_day_from" value="{{$builder[0]->working_day_from}}"/></br>
						   To:&nbsp &nbsp&nbsp&nbsp&nbsp <input name="working_day_to" value="{{$builder[0]->working_day_to}}" />
						   </div>
						   <div class="col-lg-12">
						   <label>Time working:</label>
						   </div>
						   <div class = "col-lg-12">    
						   From: <input name="working_from" value="{{$builder[0]->working_from}}"/></br>
						   To:&nbsp &nbsp&nbsp&nbsp&nbsp <input name="working_to" value="{{$builder[0]->working_to}}" />
						   </br>
						   
	                        </div>
						
			                    </div>	
			                </div>
			            </div>
			        </div>
			        
			        <!-- <a class = "btn btn-primary" href = "{{URL::route('myfavorites')}}" >Back</a> -->
			    </div>
			    
			    <div class="col-lg-6">
				        <div class="panel panel-default">
				            <div class="panel-heading">
				                History Jobs
				            </div>
			            <div class="panel-body">
			            @if ($builder_jobs != "")
			            @foreach ($builder_jobs as $buildere) 
			                <div class="row">
			                    <div class="col-lg-12">

		                            <div class="form-group">
		                                <label>Jobs tittle:</label>
		                                {{$buildere->tittle}}
		                                
		                            </div>
		                            
		                             <div class="form-group">
		                                <label>Jobs property:</label>
		                                {{$buildere->property}}
		                                
		                            </div>
		                            
		                            <div class="form-group">
		                                <label>Jobs category:</label>
		                                {{$buildere->content}}
		                                
		                            </div>
		                            
		                            <div class="form-group">
		                                <label>Jobs decription:</label>
		                                {{$buildere->description}}
		                                
		                            </div>
		                            <div class="form-group">
		                                <label>User price:</label>
		                                {{$buildere->price}}
		                                
		                            </div>
		                            <div class="form-group">
		                                <label>Builder quote:</label>
		                                {{$buildere->vote}}
		                                
		                            </div>
		                            <div class="form-group">
		                                <label>Created at:</label>
		                                {{$buildere->created_at}}
		                                
		                            </div>
		                            <div class="form-group">
		                                <label>Job status:</label>
		                                {{$buildere->status_process}}
		                                
		                            </div>
		                            @if ($buildere->status_process == "completed")
		                            	<div class="form-group">
		                                <label>Feedback:</label>
		                                </br>
		                          		@if($feedbacks_created_at != "")
		                          		
		                                @for ($i = 0; $i < count($feedbacks_created_at[$buildere->job_id]); $i++)
		                                	Date leave: {{$feedbacks_created_at[$buildere->job_id][$i]}}</br>
		                                	Post by: <a>{{$feedbacks_by_user[$buildere->job_id][$i]->username}}</a></br>
		                                	Ratings:</br>
		                                	<div class = "rows">
											<section class='rating-widget'>
											  <!-- Rating Stars Box -->
											  
											  <div class='rating-stars text-center'>
											  Timeliness
											    <ul id='stars1' class = "stars">
											      <li class='star1 star <?php if($feedbacks_rating_1[$buildere->job_id][$i] >= 1){echo "selected";}?>' title='Poor' data-value='1'>
											        <i class='fa fa-star fa-fw'></i>
											      </li>
											      <li class='star1 star <?php if($feedbacks_rating_1[$buildere->job_id][$i] >= 2){echo "selected";}?>' title='Fair' data-value='2' >
											        <i class='fa fa-star fa-fw'></i>
											      </li>
											      <li class='star1 star <?php if($feedbacks_rating_1[$buildere->job_id][$i] >= 3){echo "selected";}?>' title='Good' data-value='3'>
											        <i class='fa fa-star fa-fw'></i>
											      </li>
											      <li class='star1 star <?php if($feedbacks_rating_1[$buildere->job_id][$i] >= 4){echo "selected";}?>' title='Excellent' data-value='4'>
											        <i class='fa fa-star fa-fw'></i>
											      </li>
											      <li class='star1 star <?php if($feedbacks_rating_1[$buildere->job_id][$i] >= 5){echo "selected";}?>' title='WOW!!!' data-value='5'>
											        <i class='fa fa-star fa-fw'></i>
											      </li>
											    </ul>
											  </div>
											  
											  <div class='success-box' hidden>
											    
											    <input name = "rating_1" class='text-message1' value = "0"/>
											    
											  </div>
											</section>
											<section class='rating-widget'>
											  <!-- Rating Stars Box -->
											  
											  <div class='rating-stars text-center'>
											  Services Quality
											    <ul id='stars2' class = "stars">
											      <li class='star2 star <?php if($feedbacks_rating_2[$buildere->job_id][$i] >= 1){echo "selected";}?>' title='Poor' data-value='1'>
											        <i class='fa fa-star fa-fw'></i>
											      </li>
											      <li class='star2 star <?php if($feedbacks_rating_2[$buildere->job_id][$i] >= 2){echo "selected";}?>' title='Fair' data-value='2' >
											        <i class='fa fa-star fa-fw'></i>
											      </li>
											      <li class='star2 star <?php if($feedbacks_rating_2[$buildere->job_id][$i] >= 3){echo "selected";}?>' title='Good' data-value='3'>
											        <i class='fa fa-star fa-fw'></i>
											      </li>
											      <li class='star2 star <?php if($feedbacks_rating_2[$buildere->job_id][$i] >= 4){echo "selected";}?>' title='Excellent' data-value='4'>
											        <i class='fa fa-star fa-fw'></i>
											      </li>
											      <li class='star2 star <?php if($feedbacks_rating_2[$buildere->job_id][$i] >= 5){echo "selected";}?>' title='WOW!!!' data-value='5'>
											        <i class='fa fa-star fa-fw'></i>
											      </li>
											    </ul>
											  </div>
											  
											  <div class='success-box' hidden>
											    
											    <input name = "rating_2" class='text-message2' value = "0"/>
											    
											  </div>
											</section>
											</div>
											<div class="rows">
											<section class='rating-widget'>
											  <!-- Rating Stars Box -->
											  <div class='rating-stars text-center'>
											  Comunication
											    <ul id='stars3' class = "stars">
											      <li class='star3 star <?php if($feedbacks_rating_3[$buildere->job_id][$i] >= 1){echo "selected";}?>' title='Poor' data-value='1'>
											        <i class='fa fa-star fa-fw'></i>
											      </li>
											      <li class='star3 star <?php if($feedbacks_rating_3[$buildere->job_id][$i] >= 2){echo "selected";}?>' title='Fair' data-value='2' >
											        <i class='fa fa-star fa-fw'></i>
											      </li>
											      <li class='star3 star <?php if($feedbacks_rating_3[$buildere->job_id][$i] >= 3){echo "selected";}?>' title='Good' data-value='3'>
											        <i class='fa fa-star fa-fw'></i>
											      </li>
											      <li class='star3 star <?php if($feedbacks_rating_3[$buildere->job_id][$i] >= 4){echo "selected";}?>' title='Excellent' data-value='4'>
											        <i class='fa fa-star fa-fw'></i>
											      </li>
											      <li class='star3 star <?php if($feedbacks_rating_3[$buildere->job_id][$i] >= 5){echo "selected";}?>' title='WOW!!!' data-value='5'>
											        <i class='fa fa-star fa-fw'></i>
											      </li>
											    </ul>
											  </div>
											  
											  <div class='success-box' hidden>
											    
											    <input name = "rating_3" class='text-message3' value = "0"/>
											    
											  </div>
											</section>
											<section class='rating-widget'>
											  <!-- Rating Stars Box -->
											  <div class='rating-stars text-center'>
											  Value
											    <ul id='stars4' class = "stars">
											      <li class='star4 star <?php if($feedbacks_rating_4[$buildere->job_id][$i] >= 1){echo "selected";}?>' title='Poor' data-value='1'>
											        <i class='fa fa-star fa-fw'></i>
											      </li>
											      <li class='star4 star <?php if($feedbacks_rating_3[$buildere->job_id][$i] >= 2){echo "selected";}?>' title='Fair' data-value='2' >
											        <i class='fa fa-star fa-fw'></i>
											      </li>
											      <li class='star4 star <?php if($feedbacks_rating_3[$buildere->job_id][$i] >= 3){echo "selected";}?>' title='Good' data-value='3'>
											        <i class='fa fa-star fa-fw'></i>
											      </li>
											      <li class='star4 star <?php if($feedbacks_rating_3[$buildere->job_id][$i] >= 4){echo "selected";}?>' title='Excellent' data-value='4'>
											        <i class='fa fa-star fa-fw'></i>
											      </li>
											      <li class='star4 star <?php if($feedbacks_rating_3[$buildere->job_id][$i] >= 5){echo "selected";}?>' title='WOW!!!' data-value='5'>
											        <i class='fa fa-star fa-fw'></i>
											      </li>
											    </ul>
											  </div>
											  
											  <div class='success-box' hidden>
											    
											    
											    <input name = "rating_4" class='text-message4' value = "0"/>
											    
											  </div>
											</section>
											</div>
		                                	Feedback content: {{$feedbacks_content[$buildere->job_id][$i]}}</br>
		                                	
		                                	<hr>
		                                @endfor
		                                @else
		                                	No have feedback
		                                @endif
		                            	</div>
		                            @endif
		                            

			                    </div>	
			                </div>
			                <hr>
			                @endforeach
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