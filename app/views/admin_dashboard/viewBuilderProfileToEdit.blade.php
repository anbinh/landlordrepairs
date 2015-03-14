
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
			                        
			                       {{ Form::open(array('url' => 'admin-change_builder_profile')) }}
			                       <input hidden value = "{{$builder[0]->builder_id}}" name = "builder_id">
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
		                                <label>Local</label>
		                                {{ Form::text('local', $builder[0]->local, array('placeholder' => 'Type your code','class' => 'form-control')) }}
		                            </div>
		                            
		                             <div class="form-group">
		                                <label>Local code</label>
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
							
							  var markers = [];
							  var haightAshbury = new google.maps.LatLng({{$builder[0]->lat}},{{$builder[0]->lng}});
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
		                            <div class="form-group">
		                                <label>Site Link</label>
		                                {{ Form::text('site_link', $builder[0]->site_link, array('placeholder' => 'Type your site link','class' => 'form-control')) }}
		                            </div>
		                             <div class="form-group">
		                                <label>Social Link</label>
		                                {{ Form::text('social_link', $builder[0]->social_link, array('placeholder' => 'Type your site link','class' => 'form-control')) }}
		                            </div>
		                            
		                             <div class="form-group">
		                                <label>Started At</label>
		                                {{ Form::text('created_at', $builder[0]->created_at, array('placeholder' => 'Type your date','class' => 'form-control')) }}
		                            </div>
		                 <div class="pad-top">
								<div class="form-control-wrapper" >
								
								<div class = "col-lg-12">
								Category:
								</div>
								
								
								
								
								<div class = "col-lg-6">
								<div class="checkbox">
								 
								    <label>
								        <input type="checkbox" name = "check_builders[]" value = "Bathroom Fitters" 
								      @foreach($builder as $buildere)
										@if ($buildere->category == 'Bathroom Fitters') checked @endif
										@endforeach 
										> Bathroom Fitters
								    </label>
								    <label>
								        <input type="checkbox" name = "check_builders[]" value = "Bricklayers"
								        @foreach($builder as $buildere)
										@if ($buildere->category == 'Bricklayers') checked @endif
										@endforeach 
										> Bricklayers
								    </label>
								    
						
								</div>
									
								</div>
								</div>
								<div class = "col-lg-6">
								
								<div class="checkbox">
								    <label>
								        <input type="checkbox" name = "check_builders[]" value = "Handymen" 
								      @foreach($builder as $buildere)
										@if ($buildere->category == 'Handymen') checked @endif
										@endforeach 
										> Handymen
								    </label>
								     <label>
								        <input type="checkbox" name = "check_builders[]" value = "Heating Engineers"
								        @foreach($builder as $buildere)
										@if ($buildere->category == 'Heating Engineers') checked @endif
										@endforeach 
										> Heating Engineers
								    </label>
								    
								</div>
									
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
								
								
								<div class = "col-lg-6 listCategorys" hidden>
								<div class="checkbox">
								   
								    <label>
								        <input type="checkbox" name = "check_builders[]" value = "Carpenters & Joiners"
								        @foreach($builder as $buildere)
										@if ($buildere->category == 'Carpenters & Joiners') checked @endif
										@endforeach 
										> Carpenters & Joiners
								    </label>
								    <label>
								        <input type="checkbox" name = "check_builders[]" value = "Carpet fitters"
								        @foreach($builder as $buildere)
										@if ($buildere->category == 'Carpet fitters') checked @endif
										@endforeach 
										> Carpet fitters
								    </label>
								     <label>
								        <input type="checkbox" name = "check_builders[]" value = "Chimney & Fireplace Specialists"
										@foreach($builder as $buildere)
										@if ($buildere->category == 'Chimney & Fireplace Specialists') checked @endif
										@endforeach 
										> Chimney & Fireplace Specialists
								    </label>
								    <label>
								        <input type="checkbox" name = "check_builders[]" value = "Conservatory Installers"
								        @foreach($builder as $buildere)
										@if ($buildere->category == 'Conservatory Installers') checked @endif
										@endforeach 
										> Conservatory Installers
								    </label>
								    <label>
								        <input type="checkbox" name = "check_builders[]" value = "Conversion Specialists"
								        @foreach($builder as $buildere)
										@if ($buildere->category == 'Conversion Specialists') checked @endif
										@endforeach 
										> Conversion Specialists
								    </label>
								    <label>
								        <input type="checkbox" name = "check_builders[]" value = "Damp Proofing Specialists"
								        @foreach($builder as $buildere)
										@if ($buildere->category == 'Damp Proofing Specialists') checked @endif
										@endforeach 
										> Damp Proofing Specialists
								    </label>
								    <label>
								        <input type="checkbox" name = "check_builders[]" value = "Driveway Pavers"
								        @foreach($builder as $buildere)
										@if ($buildere->category == 'Driveway Pavers') checked @endif
										@endforeach 
										> Driveway Pavers
								    </label>
								    <label>
								        <input type="checkbox" name = "check_builders[]" value = "Electricians"
								        @foreach($builder as $buildere)
										@if ($buildere->category == 'Electricians') checked @endif
										@endforeach 
										> Electricians
								    </label>
								    <label>
								        <input type="checkbox" name = "check_builders[]" value = "Extension Builders"
								        @foreach($builder as $buildere)
										@if ($buildere->category == 'Extension Builders') checked @endif
										@endforeach 
										> Extension Builders
								    </label>
								     <label>
								        <input type="checkbox" name = "check_builders[]" value = "Fencers"
								        @foreach($builder as $buildere)
										@if ($buildere->category == 'Fencers') checked @endif
										@endforeach 
										> Fencers
								    </label>
								     <label>
								        <input type="checkbox" name = "check_builders[]" value = "Flooring Fitters"
								        @foreach($builder as $buildere)
										@if ($buildere->category == 'Flooring Fitters') checked @endif
										@endforeach 
										> Flooring Fitters
								    </label>
								     <label>
								        <input type="checkbox" name = "check_builders[]" value = "Garage & Shed Builders"
										@foreach($builder as $buildere)
										@if ($buildere->category == 'Garage & Shed Builders') checked @endif
										@endforeach 
										> Garage & Shed Builders
								    </label>
								     <label>
								        <input type="checkbox" name = "check_builders[]" value = "Gas Engineers"
										@foreach($builder as $buildere)
										@if ($buildere->category == 'Gas Engineers') checked @endif
										@endforeach 
										> Gas Engineers
								    </label>
								     <label>
								        <input type="checkbox" name = "check_builders[]" value = "Groundworkers"
								        @foreach($builder as $buildere)
										@if ($buildere->category == 'Groundworkers') checked @endif
										@endforeach 
										> Groundworkers
								    </label>
						
								</div>
									
								</div>
								
								<div class = "col-lg-6 listCategorys" hidden>
								<div class="checkbox">
								    		    
								     <label>
								        <input type="checkbox" name = "check_builders[]" value = "Insulation Installers"
								        @foreach($builder as $buildere)
										@if ($buildere->category == 'Insulation Installers') checked @endif
										@endforeach 
										> Insulation Installers
								    </label>
								    <label>
								        <input type="checkbox" name = "check_builders[]" value = "Kitchen Fitters"
										@foreach($builder as $buildere)
										@if ($buildere->category == 'Kitchen Fitters') checked @endif
										@endforeach 
										> Kitchen Fitters
								    </label>
								    <label>
								        <input type="checkbox" name = "check_builders[]" value = "Landscape Gardeners"
								        @foreach($builder as $buildere)
										@if ($buildere->category == 'HandymLandscape Gardenersen') checked @endif
										@endforeach 
										> Landscape Gardeners
								    </label>
								    <label>
								        <input type="checkbox" name = "check_builders[]" value = "Loft Conversion Specialists"
								        @foreach($builder as $buildere)
										@if ($buildere->category == 'Loft Conversion Specialists') checked @endif
										@endforeach 
										> Loft Conversion Specialists
								    </label>
								    <label>
								        <input type="checkbox" name = "check_builders[]" value = "New Home Builders"
								        @foreach($builder as $buildere)
										@if ($buildere->category == 'New Home Builders') checked @endif
										@endforeach 
										> New Home Builders
								    </label>
								    <label>
								        <input type="checkbox" name = "check_builders[]" value = "Painters & Decorators"
								        @foreach($builder as $buildere)
										@if ($buildere->category == 'Painters & Decorators') checked @endif
										@endforeach 
										> Painters & Decorators
								    </label>
								    <label>
								        <input type="checkbox" name = "check_builders[]" value = "Plasterers"
										@foreach($builder as $buildere)
										@if ($buildere->category == 'Plasterers') checked @endif
										@endforeach 
										> Plasterers
								    </label>
								    <label>
								        <input type="checkbox" name = "check_builders[]" value = "Plumbers"
										@foreach($builder as $buildere)
										@if ($buildere->category == 'Plumbers') checked @endif
										@endforeach 
										> Plumbers
								    </label>
								    <label>
								        <input type="checkbox" name = "check_builders[]" value = "Restoration & Refurb Specialists"
										@foreach($builder as $buildere)
										@if ($buildere->category == 'Restoration & Refurb Specialists') checked @endif
										@endforeach 
										> Restoration & Refurb Specialists
								    </label>
								    <label>
								        <input type="checkbox" name = "check_builders[]" value = "Roofers"
										@foreach($builder as $buildere)
										@if ($buildere->category == 'Roofers') checked @endif
										@endforeach 
										> Roofers
								    </label>
								    <label>
								        <input type="checkbox" name = "check_builders[]" value = "Security System Installers"
										@foreach($builder as $buildere)
										@if ($buildere->category == 'Security System Installers') checked @endif
										@endforeach 
										> Security System Installers
								    </label>
								    <label>
								        <input type="checkbox" name = "check_builders[]" value = "CTilers"
										@foreach($builder as $buildere)
										@if ($buildere->category == 'CTilers') checked @endif
										@endforeach 
										> CTilers
								    </label>
								    <label>
								        <input type="checkbox" name = "check_builders[]" value = "Tree Surgeons"
								        @foreach($builder as $buildere)
										@if ($buildere->category == 'Tree Surgeons') checked @endif
										@endforeach 
										> Tree Surgeons
								    </label>
								    <label>
								        <input type="checkbox" name = "check_builders[]" value = "Window Fitters"
										@foreach($builder as $buildere)
										@if ($buildere->category == 'Window Fitters') checked @endif
										@endforeach 
										> Window Fitters
								    </label>
								</div>
								
								</div>
							   
								<div class = "col-lg-12" style = "margin-bottom: 100px;">
								<input type = "button" onclick = "showAllCategory()" id = "show_all_category" value = "Show all"/>
								</div>
								</div>
								







						<div class="" >
							<div class = "col-lg-12">
								Association 
								</div>
								
									<div>
									@for  ($i = 0; $i < 4; $i++)
										<img style = "width: 50px; height: 50px; margin-left: 15px;" src="{{$associations[$i]->association_src}}"/>
										  <label>											  	
										    <input type="radio" name="association" value="{{$associations[$i]->association_name}}" id = "detail1"
										    @if ( $associations[$i]->association_name == $builder[0]->association_name)
										    	checked
										    @endif>
										    {{$associations[$i]->association_name}}
										  </label>
									@endfor
					
								   <div class = "list_associations" hidden>
								  @for  ($i = 4; $i < 16; $i++)
										<img style = "width: 50px; height: 50px; margin-left: 15px;" src="{{$associations[$i]->association_src}}"/>
										  <label>											  	
										    <input type="radio" name="association" value="{{$associations[$i]->association_name}}" id = "detail1"
										    @if ( $associations[$i]->association_name == $builder[0]->association_name)
										    	checked
										    @endif>
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
                                {{ Form::text('phonenumber','', array('placeholder' => 'Type your new Phonenumber', 'class' => 'form-control')) }}
                            </div>
                           
                            {{ Form::submit('Change Phonenumber', array('class' => 'btn btn-primary')) }}
                           
                        {{ Form::close() }}
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