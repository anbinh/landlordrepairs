
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
					  <a href="#" class="list-group-item active">
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
			      <th class="date-sort" ><em>Preview content</em> <span>&nbsp;</span></th>
			      <th class="date-sort"><em>User post</em> <span>&nbsp;</span></th>
			      <th class="date-sort" ><em>Job Detailt</em> <span>&nbsp;</span></th>
			      
			    </tr>
			  </thead>
			  <tbody>
			
			@if($previews != null)
			  @foreach($previews as $preview)
			 	<tr>
			    	<td>{{$preview->tittle}}</td>
			    	<td>
			    	Date leave: {{$preview->feedback_created_at}}</br>
		                                	
		                                	Ratings:</br>
		                                	<div class = "rows">
											<section class='rating-widget'>
											  <!-- Rating Stars Box -->
											  
											  <div class='rating-stars text-center'>
											  Timeliness
											    <ul id='stars1' class = "stars">
											      <li class='star1 star <?php if($preview->timeliness >= 1){echo "selected";}?>' title='Poor' data-value='1'>
											        <i class='fa fa-star fa-fw'></i>
											      </li>
											      <li class='star1 star <?php if($preview->timeliness >= 2){echo "selected";}?>' title='Fair' data-value='2' >
											        <i class='fa fa-star fa-fw'></i>
											      </li>
											      <li class='star1 star <?php if($preview->timeliness >= 3){echo "selected";}?>' title='Good' data-value='3'>
											        <i class='fa fa-star fa-fw'></i>
											      </li>
											      <li class='star1 star <?php if($preview->timeliness >= 4){echo "selected";}?>' title='Excellent' data-value='4'>
											        <i class='fa fa-star fa-fw'></i>
											      </li>
											      <li class='star1 star <?php if($preview->timeliness >= 5){echo "selected";}?>' title='WOW!!!' data-value='5'>
											        <i class='fa fa-star fa-fw'></i>
											      </li>
											    </ul>
											  </div>
											  
											</section>
											<section class='rating-widget'>
											  <!-- Rating Stars Box -->
											  
											  <div class='rating-stars text-center'>
											  Services Quality
											    <ul id='stars2' class = "stars">
											      <li class='star2 star <?php if($preview->services_quality >= 1){echo "selected";}?>' title='Poor' data-value='1'>
											        <i class='fa fa-star fa-fw'></i>
											      </li>
											      <li class='star2 star <?php if($preview->services_quality >= 2){echo "selected";}?>' title='Fair' data-value='2' >
											        <i class='fa fa-star fa-fw'></i>
											      </li>
											      <li class='star2 star <?php if($preview->services_quality >= 3){echo "selected";}?>' title='Good' data-value='3'>
											        <i class='fa fa-star fa-fw'></i>
											      </li>
											      <li class='star2 star <?php if($preview->services_quality >= 4){echo "selected";}?>' title='Excellent' data-value='4'>
											        <i class='fa fa-star fa-fw'></i>
											      </li>
											      <li class='star2 star <?php if($preview->services_quality >= 5){echo "selected";}?>' title='WOW!!!' data-value='5'>
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
											      <li class='star3 star <?php if($preview->comunication >= 1){echo "selected";}?>' title='Poor' data-value='1'>
											        <i class='fa fa-star fa-fw'></i>
											      </li>
											      <li class='star3 star <?php if($preview->comunication >= 2){echo "selected";}?>' title='Fair' data-value='2' >
											        <i class='fa fa-star fa-fw'></i>
											      </li>
											      <li class='star3 star <?php if($preview->comunication >= 3){echo "selected";}?>' title='Good' data-value='3'>
											        <i class='fa fa-star fa-fw'></i>
											      </li>
											      <li class='star3 star <?php if($preview->comunication >= 4){echo "selected";}?>' title='Excellent' data-value='4'>
											        <i class='fa fa-star fa-fw'></i>
											      </li>
											      <li class='star3 star <?php if($preview->comunication >= 5){echo "selected";}?>' title='WOW!!!' data-value='5'>
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
											      <li class='star4 star <?php if($preview->value >= 1){echo "selected";}?>' title='Poor' data-value='1'>
											        <i class='fa fa-star fa-fw'></i>
											      </li>
											      <li class='star4 star <?php if($preview->value >= 2){echo "selected";}?>' title='Fair' data-value='2' >
											        <i class='fa fa-star fa-fw'></i>
											      </li>
											      <li class='star4 star <?php if($preview->value >= 3){echo "selected";}?>' title='Good' data-value='3'>
											        <i class='fa fa-star fa-fw'></i>
											      </li>
											      <li class='star4 star <?php if($preview->value >= 4){echo "selected";}?>' title='Excellent' data-value='4'>
											        <i class='fa fa-star fa-fw'></i>
											      </li>
											      <li class='star4 star <?php if($preview->value >= 5){echo "selected";}?>' title='WOW!!!' data-value='5'>
											        <i class='fa fa-star fa-fw'></i>
											      </li>
											    </ul>
											  </div>
											  
											  <div class='success-box' hidden>
											    
											    
											    <input name = "rating_4" class='text-message4' value = "0"/>
											    
											  </div>
											</section>
											</div>
		                                	Feedback content: {{$preview->feedback_description}}
			    	</td>
			   		<td>
			   		{{$preview->username}}
			   		</td>
			    	
			 		<td class="date-sort"><em><a href="view-detail-job-alert/{{$preview->job_id}},{{$preview->user_id}}">View</></em> <span>&nbsp;</span>
			 		</td>
			 		
			 		
			 		
			 		
			 		
			 		
			 	</tr>	
				@endforeach
			   
			   
			</table>
			@else
			 	</table>
			 	<p>Have zero jobs posted</p>
			 @endif
			 
			
			
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
