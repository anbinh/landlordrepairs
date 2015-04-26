
@extends('layouts.default')
@section('content')
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
			      <th><em>Tittle</em> <span>&nbsp;</span></th>
			      <th class="date-sort" ><em>Property</em> <span>&nbsp;</span></th>
			      <th class="date-sort" ><em>Category</em> <span>&nbsp;</span></th>
			      <th class="date-sort" ><em>Price</em> <span>&nbsp;</span></th>
			      <th class="date-sort" ><em>Cancel job</em> <span>&nbsp;</span></th>
			      <th class="date-sort" ><em>Invite Builders</em> <span>&nbsp;</span></th>
			      <th class="date-sort" ><em>View Job Details</em> <span>&nbsp;</span></th>
			      <th class="date-sort" ><em>View Message</em> <span>&nbsp;</span></th>
			      <th class="date-sort" ><em>View Quote</em> <span>&nbsp;</span></th>
			      <th class="date-sort" ><em>Edit job</em> <span>&nbsp;</span></th>
			      
			      
			     
			      
			    </tr>
			  </thead>
			  <tbody>
			
			@if ($jobs != null)
			  @foreach($jobs as $job)
			 	<tr>
			    	<td>{{$job->tittle}}</td>
			    	<td>{{$job->property}}</td>
			    	<td>{{$job->content}}</td>
			    	<td>{{$job->price}}</td>
			    	
			 		<td>
						<form method = "post" action = "customer-action-cancelled" >
					 		<input name = "job_id" value = "{{$job->id}}" hidden>
					 		
					 		<input type="date" name = "date_cancelled" value="<?php echo date('Y-m-d'); ?>" hidden/>
					 		<button class="btn btn-danger">Cancel</button>
				 		</form>
					</td>
					<td>
						<form action = "waitingjob-find-builders" method = "post">
			 				<input name = "category_id" value = "{{$job->category_id}}" hidden>
			 				<input name = "job_id" value = "{{$job->id}}" hidden>
			 				<input name = "lat" value = "{{$job->lat}}" hidden>
			 				<input name = "lng" value = "{{$job->lng}}" hidden>
			 				<input name = "job_id" value = "{{$job->id}}" hidden>
			 				
							<button type = "submit" class = "btn btn-success"> Find Builders </button>
			 			</form>
					</td>
					<td>
					<a href = "view-detail-job-alert/{{$job->id}},{{Auth::user()->id}}">View</a>
					</td>
					<td>
					
					<script>
					 	var num_message = 0;
					</script>
					 @foreach ($messages as $message)
					 	@if (($message->job_id == $job->id) && ($message->readed == "0"))
					 		<script>num_message++</script>
					 	@endif					 	
					 @endforeach
					 <a href = "read-message/{{$job->id}}">Message(<script>document.write(num_message);</script>)</a>
					</td>
					<td>
					<script>
					 	var num_quote = 0;
					</script>
						@foreach ($quotes as $quote)
						 	@if (($quote->job_id == $job->id) && ($quote->status_process != 'miss'))
						 		<script>num_quote++</script>
						 	@endif					 	
						 @endforeach
						 <a href = "read-quote/{{$job->id}}">Quotes(<script>document.write(num_quote);</script>)</a>
					</td>
					<td>
					
					<form action = "edit-jobs" method = "post">
						<input name = "job_id" value = "{{$job->id}}" hidden>
						<input type = "submit" value = "Edit">
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
