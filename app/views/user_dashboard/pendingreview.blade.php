
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
	<div class="container" style= "margin-bottom: 300px;">
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
					  <a href="{{URL::route('waiting-accept-jobs')}}" class="list-group-item">Waiting accept jobs</a>
				</div>

			</div>
			<div class="col-md-10">
				<div class="row">
				<div class="col-lg-12" style="margin-top:30px">
        <script>
			$(document).ready(function(){
				  
				  $(".sortable-table th").click(function(){
				    sort_table($(this));
				  });
				  
				});
			
				function sort_table(clicked){
				    var current_table = clicked.parents(".sortable-table"),
				        sorted_column = clicked.index(),
				        column_count = current_table.find("th").length,
				        sort_it = [];
				  
				    current_table.find("tbody tr").each(function(){
				      var new_line = "",
				          sort_by = "";
				      $(this).find("td").each(function(){
				        if($(this).next().length){
				              new_line += $(this).html() + "+";
				        }else{
				              new_line += $(this).html();
				        }
				        if($(this).index() == sorted_column){
				           sort_by = $(this).text(); 
				        }
				      });
				      
				      new_line = sort_by + "*" + new_line;
				      sort_it.push(new_line);
				      //console.log(sort_it);
				      
				    });
				  
				    sort_it.sort();
				    $("th span").text("");
				    if(!clicked.hasClass("sort-down")){
				      clicked.addClass("sort-down");
				      clicked.find("span").text("▼");
				    }else{
				      sort_it.reverse();
				      clicked.removeClass("sort-down");
				      clicked.find("span").text("▲");
				    }
				    
				    $("#country-list tr:not('.country-table-head')").each(function(){
				      $(this).remove();
				    });
				    
				    $(sort_it).each(function(index, value) {
				        $('<tr class="current-tr"></tr>').appendTo(clicked.parents("table").find("tbody"));
				        var split_line = value.split("*"),
				            td_line = split_line[1].split("+"),
				            td_add = "";
				      
				        //console.log(td_line.length);
				        for (var i = 0; i < td_line.length; i++){
				            td_add += "<td>" + td_line[i] + "</td>";
				        }
				        $(td_add).appendTo(".current-tr");
				        $(".current-tr").removeClass("current-tr");
				      
				    });
				}
			</script>
			<style>
			#country-list {
			    font-family: arial;
			    font-size: 14px;
			    width: 100%;
			}
			#country-list .country-table-head {
				border: 1px solid #bfbfbf;
				width: 100%;
			    border-radius: 4px;
			    -o-border-radius: 4px;
			    -moz-border-radius: 4px;
			    -webkit-border-radius: 4px;
				background: linear-gradient(to bottom, #fcfcfc, #dddcdb 99%);
				background: -o-linear-gradient(top, #fcfcfc, #dddcdb 99%);
				background: -ms-linear-gradient(top, #fcfcfc 0%, #dddcdb 99%);
				background: -moz-linear-gradient(top, #fcfcfc 0%, #dddcdb 99%);
				background: -webkit-linear-gradient(top, #fcfcfc 0%, #dddcdb 99%);
				background: -webkit-gradient(linear, left top, left bottom, color-stop(0, #fcfcfc), color-stop(1, #dddcdb));
				filter: progid:DXImageTransform.Microsoft.Gradient(GradientType=0,StartColorStr=#fcfcfc,EndColorStr=#dddcdb);
				-ms-filter: "progid:DXImageTransform.Microsoft.Gradient(GradientType=0,StartColorStr=#fcfcfc,EndColorStr=#dddcdb)";
				box-shadow: 2px 2px 4px rgba(0,0,0,0.2);
				-o-box-shadow: 2px 2px 4px rgba(0,0,0,0.2);
				-moz-box-shadow: 2px 2px 4px rgba(0,0,0,0.2);
				-webkit-box-shadow: 2px 2px 4px rgba(0,0,0,0.2);
			}
			#country-list tbody tr:nth-child(2n+2) {
			    background: none repeat scroll 0 0 #F6F6F6;
			}
			
			#country-list td{
				padding: 15px 0 15px 15px;
				color: #686868;
			  text-shadow: 0px 1px 0 #ddd;
			  border-left: 1px solid #999;
			  box-shadow: inset 10px 0 10px -10px rgba(0,0,0,0.5), inset -10px 0 10px -10px rgba(0,0,0,0.5);
			}
			#country-list a{
				color: #a50101;
			  text-decoration: none;
			}
			
			.country-table-head th{
				font-weight: normal;
				padding: 15px 0 15px 15px;
				text-align: left;
				border-right: 1px solid #c1c1c1;
				border-left: 1px solid #fff;
			}
			
			.country-table-head th:first-child{
				border-left: none;
				width: 200px;
			}
			.country-table-head span{
			  font-size: 12px;
			}
			</style>
			
			<table id="country-list" class="sortable-table">
			  <thead>
			    <tr class="country-table-head">
			      <th><em>Job tittle</em> <span>&nbsp;</span></th>
			      <th><em>Job Detail</em> <span>&nbsp;</span></th>
			      <th class="date-sort" ><em>Builder Detail</em> <span>&nbsp;</span></th>
			      <th class="date-sort"><em>Pending Review</em> <span>&nbsp;</span></th>
			    </tr>
			  </thead>
			  <tbody>
			
			@if($jobs != null)
			  @foreach($jobs as $job)
			 	<tr>
			    	<td>{{$job->tittle}}</td>
			    	<td><a href = "view-detail-job-alert/{{$job->job_id}},{{Auth::user()->id}}">View</a></td>
			    	<td class="date-sort"><em><a href="view-detail-info-builder/{{$job->builder_id}}">View</></em> <span>&nbsp;</span></td>
			 		<td>
			 			@if($job->user_leave_feedback == '0')
			 			<form action = "leave-feedback" method = "POST">
			 				<input name = "job_id" value = "{{$job->job_id}}" hidden>
			 				<input name = "builder_id" value = "{{$job->builder_id}}" hidden>
				 				What would you rate this provider based on the following criteria?
								<div class = "rows">
								<section class='rating-widget'>
								  <!-- Rating Stars Box -->
								  
								  <div class='rating-stars text-center'>
								  Timeliness
								    <ul id='stars1' class = "stars">
								      <li class='star1 star' title='Poor' data-value='1'>
								        <i class='fa fa-star fa-fw'></i>
								      </li>
								      <li class='star1 star' title='Fair' data-value='2' >
								        <i class='fa fa-star fa-fw'></i>
								      </li>
								      <li class='star1 star' title='Good' data-value='3'>
								        <i class='fa fa-star fa-fw'></i>
								      </li>
								      <li class='star1 star' title='Excellent' data-value='4'>
								        <i class='fa fa-star fa-fw'></i>
								      </li>
								      <li class='star1 star' title='WOW!!!' data-value='5'>
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
								      <li class='star2 star' title='Poor' data-value='1'>
								        <i class='fa fa-star fa-fw'></i>
								      </li>
								      <li class='star2 star' title='Fair' data-value='2' >
								        <i class='fa fa-star fa-fw'></i>
								      </li>
								      <li class='star2 star' title='Good' data-value='3'>
								        <i class='fa fa-star fa-fw'></i>
								      </li>
								      <li class='star2 star' title='Excellent' data-value='4'>
								        <i class='fa fa-star fa-fw'></i>
								      </li>
								      <li class='star2 star' title='WOW!!!' data-value='5'>
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
								      <li class='star3 star' title='Poor' data-value='1'>
								        <i class='fa fa-star fa-fw'></i>
								      </li>
								      <li class='star3 star' title='Fair' data-value='2' >
								        <i class='fa fa-star fa-fw'></i>
								      </li>
								      <li class='star3 star' title='Good' data-value='3'>
								        <i class='fa fa-star fa-fw'></i>
								      </li>
								      <li class='star3 star' title='Excellent' data-value='4'>
								        <i class='fa fa-star fa-fw'></i>
								      </li>
								      <li class='star3 star' title='WOW!!!' data-value='5'>
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
								      <li class='star4 star' title='Poor' data-value='1'>
								        <i class='fa fa-star fa-fw'></i>
								      </li>
								      <li class='star4 star' title='Fair' data-value='2' >
								        <i class='fa fa-star fa-fw'></i>
								      </li>
								      <li class='star4 star' title='Good' data-value='3'>
								        <i class='fa fa-star fa-fw'></i>
								      </li>
								      <li class='star4 star' title='Excellent' data-value='4'>
								        <i class='fa fa-star fa-fw'></i>
								      </li>
								      <li class='star4 star' title='WOW!!!' data-value='5'>
								        <i class='fa fa-star fa-fw'></i>
								      </li>
								    </ul>
								  </div>
								  
								  <div class='success-box' hidden>
								    
								    
								    <input name = "rating_4" class='text-message4' value = "0"/>
								    
								  </div>
								</section>
								</div>
								<textarea name = "feedback_description" rows="4" cols = "50" placeholder = "Type your feedback about this Builder"></textarea>
								
			 				<button class = "btn btn-success" type = "submit">Leave Feedback</button>
			 			</form>
			 			@else
			 			Feeback has been leave
			 			@endif
			 		</td>
			 	</tr>	
				@endforeach
				</table>
			 @else
			 
			</table>
			No jobs completed 
			 @endif   
			   
			
			
			 
			
			
    </div>
    

    <!-- end change phone number -->
</div>
			</div>
		</div>
		<script>
								$(document).ready(function(){
									  /* 1. Visualizing things on Hover - See next part for action on click */
									  $('#stars1 li').on('mouseover', function(){
									    var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
									   
									    // Now highlight all the stars that's not after the current hovered star
									    $(this).parent().children('li.star1').each(function(e){
									      if (e < onStar) {
									        $(this).addClass('hover');
									      }
									      else {
									        $(this).removeClass('hover');
									      }
									    });
									    
									  }).on('mouseout', function(){
									    $(this).parent().children('li.star1').each(function(e){
									      $(this).removeClass('hover');
									    });
									  });
									  
									  
									  /* 2. Action to perform on click */
									  $('#stars1 li').on('click', function(){
									    var onStar = parseInt($(this).data('value'), 10); // The star currently selected
									    var stars = $(this).parent().children('li.star1');
									    
									    for (i = 0; i < stars.length; i++) {
									      $(stars[i]).removeClass('selected');
									    }
									    
									    for (i = 0; i < onStar; i++) {
									      $(stars[i]).addClass('selected');
									    }
									    
									    // JUST RESPONSE (Not needed)
									    var ratingValue = parseInt($('#stars1 li.selected').last().data('value'), 10);
									    var msg = "";
									    if (ratingValue >= 1) {
									        msg = ratingValue;
									    }
									    else {
									    	msg = '0';
									    }
									    responseMessage1(msg);
									    
									  });
									  
									  
									});
									function responseMessage1(msg) {
									    
									  $('.text-message1').val(msg);
									}

									/*Star2*/
									$(document).ready(function(){
									  /* 1. Visualizing things on Hover - See next part for action on click */
									  $('#stars2 li').on('mouseover', function(){
									    var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
									   
									    // Now highlight all the stars that's not after the current hovered star
									    $(this).parent().children('li.star2').each(function(e){
									      if (e < onStar) {
									        $(this).addClass('hover');
									      }
									      else {
									        $(this).removeClass('hover');
									      }
									    });
									    
									  }).on('mouseout', function(){
									    $(this).parent().children('li.star2').each(function(e){
									      $(this).removeClass('hover');
									    });
									  });
									  
									  
									  /* 2. Action to perform on click */
									  $('#stars2 li').on('click', function(){
									    var onStar = parseInt($(this).data('value'), 10); // The star currently selected
									    var stars = $(this).parent().children('li.star2');
									    
									    for (i = 0; i < stars.length; i++) {
									      $(stars[i]).removeClass('selected');
									    }
									    
									    for (i = 0; i < onStar; i++) {
									      $(stars[i]).addClass('selected');
									    }
									    
									    // JUST RESPONSE (Not needed)
									    var ratingValue = parseInt($('#stars2 li.selected').last().data('value'), 10);
									    var msg = "";
									    if (ratingValue >= 1) {
									        msg = ratingValue;
									    }
									    else {
									    	msg = '0';
									    }
									    responseMessage2(msg);
									    
									  });
									  
									  
									});
									function responseMessage2(msg) {
										$('.text-message2').val(msg);
									}
									/*Star3*/
									$(document).ready(function(){
									  /* 1. Visualizing things on Hover - See next part for action on click */
									  $('#stars3 li').on('mouseover', function(){
									    var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
									   
									    // Now highlight all the stars that's not after the current hovered star
									    $(this).parent().children('li.star3').each(function(e){
									      if (e < onStar) {
									        $(this).addClass('hover');
									      }
									      else {
									        $(this).removeClass('hover');
									      }
									    });
									    
									  }).on('mouseout', function(){
									    $(this).parent().children('li.star3').each(function(e){
									      $(this).removeClass('hover');
									    });
									  });
									  
									  
									  /* 2. Action to perform on click */
									  $('#stars3 li').on('click', function(){
									    var onStar = parseInt($(this).data('value'), 10); // The star currently selected
									    var stars = $(this).parent().children('li.star3');
									    
									    for (i = 0; i < stars.length; i++) {
									      $(stars[i]).removeClass('selected');
									    }
									    
									    for (i = 0; i < onStar; i++) {
									      $(stars[i]).addClass('selected');
									    }
									    
									    // JUST RESPONSE (Not needed)
									    var ratingValue = parseInt($('#stars3 li.selected').last().data('value'), 10);
									    var msg = "";
									    if (ratingValue >= 1) {
									        msg = ratingValue;
									    }
									    else {
									    	msg = '0';
									    }
									    responseMessage3(msg);
									    
									  });
									  
									  
									});
									function responseMessage3(msg) {
										$('.text-message3').val(msg);
									}
									/*Star4*/
									$(document).ready(function(){
									  /* 1. Visualizing things on Hover - See next part for action on click */
									  $('#stars4 li').on('mouseover', function(){
									    var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
									   
									    // Now highlight all the stars that's not after the current hovered star
									    $(this).parent().children('li.star4').each(function(e){
									      if (e < onStar) {
									        $(this).addClass('hover');
									      }
									      else {
									        $(this).removeClass('hover');
									      }
									    });
									    
									  }).on('mouseout', function(){
									    $(this).parent().children('li.star4').each(function(e){
									      $(this).removeClass('hover');
									    });
									  });
									  
									  
									  /* 2. Action to perform on click */
									  $('#stars4 li').on('click', function(){
									    var onStar = parseInt($(this).data('value'), 10); // The star currently selected
									    var stars = $(this).parent().children('li.star4');
									    
									    for (i = 0; i < stars.length; i++) {
									      $(stars[i]).removeClass('selected');
									    }
									    
									    for (i = 0; i < onStar; i++) {
									      $(stars[i]).addClass('selected');
									    }
									    
									    // JUST RESPONSE (Not needed)
									    var ratingValue = parseInt($('#stars4 li.selected').last().data('value'), 10);
									    var msg = "";
									    if (ratingValue >= 1) {
									        msg = ratingValue;
									    }
									    else {
									    	msg = '0';
									    }
									    responseMessage4(msg);
									    
									  });
									  
									  
									});
									function responseMessage4(msg) {
										$('.text-message4').val(msg);
									}
								</script>
		

		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
@stop
