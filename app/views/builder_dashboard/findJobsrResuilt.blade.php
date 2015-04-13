
@extends('layouts.default')
@section('content')
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
					  <a href="#" class="list-group-item">Pending reviews</a>
					  <a href="{{URL::route('builder-completed-jobs')}}" class="list-group-item">Completed jobs</a>
					  <a href="{{URL::route('customer-invited')}}" class="list-group-item">Invite jobs</a>
					  <a href="{{URL::route('credit')}}" class="list-group-item">Credit</a>
					  
					  
				</div>

			</div>
				@if($alertLowCredit == true )
					<div class="alert alert-danger alert-dismissable">
		                 Your Credit account is low, please upgrade to enable Find jobs feature.
		                 
		         	</div>
		
				@endif
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
			      <th><em>Title</em> <span>&nbsp;</span></th>
			      <th class="date-sort" ><em>Description</em> <span>&nbsp;</span></th>
			      <th class="date-sort" ><em>Price</em> <span>&nbsp;</span></th>
			      <th class="date-sort"><em>Property</em> <span>&nbsp;</span></th>
			      <th class="date-sort"><em>Category</em> <span>&nbsp;</span></th>
			      <th class="date-sort"><em>Time Option</em> <span>&nbsp;</span></th>
			      <th class="date-sort"><em>Date</em> <span>&nbsp;</span></th>
			      <th class="date-sort"><em>Local</em> <span>&nbsp;</span></th>
			      <th class="date-sort"><em>Local Code</em> <span>&nbsp;</span></th>
			      <th class="date-sort"><em>Num of Builder invited</em> <span>&nbsp;</span></th>
			      <th class="date-sort"><em>View Details</em> <span>&nbsp;</span></th>
			      <th class="date-sort"><em>Action</em> <span>&nbsp;</span></th>
			      
			      
			    </tr>
			  </thead>
			  <tbody>
			
			  @if($jobs_resuilt != null)
              @foreach($jobs_resuilt as $job_resuilt)
			 	<tr>
			    	
			    	<td>{{$job_resuilt->tittle}}</td>
			    	<td>{{$job_resuilt->description}}</td>
			    	<td>{{$job_resuilt->price}}</td>
			    	<td>{{$job_resuilt->property}}</td>
			    	<td>{{$job_resuilt->content}}</td>
			    	<td>{{$job_resuilt->timeoption}}</td>
			    	<td>{{$job_resuilt->date}}</td>
			    	<td>{{$job_resuilt->local}}</td>
			    	<td>{{$job_resuilt->local_code}}</td>
			    	<td>@if($isHasNum) {{$job_resuilt->num_invite_sent}} @else 0 @endif</td>
			    	<td class="date-sort"><em><a href="view-detail-job-alert/{{$job_resuilt->job_id}},{{$job_resuilt->user_id}}">View</></em> <span>&nbsp;</span></td>
			    	<td>
			    	<form action="vote-job" method="post">
	  					<input type = "number" name = "quotePrice" value = ""/>
	  					<input hidden name = "job_id" value = "{{$job_resuilt->job_id}}"/>
	  					<input hidden name = "user_id" value = "{{$job_resuilt->user_id}}"/>
	  					<input hidden name = "isAddToJobProcess" value = "true" />
	  					<input type="submit" value="Vote">
					</form>
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
