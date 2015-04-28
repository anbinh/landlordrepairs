@extends('layouts.default')
@section('content')
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
 {{ Form::open(array('url' => 'listbuilders')) }}
<table id="country-list" class="sortable-table">
  <thead>
    <tr class="country-table-head">
      <th><em>Name of Builder</em> <span>&nbsp;</span></th>
      
      <th class="date-sort" ><em>Radius (miles)</em> <span>&nbsp;</span></th>
      <th class="date-sort" ><em>City or County</em> <span>&nbsp;</span></th>
      <th class="date-sort" ><em>Post Code</em> <span>&nbsp;</span></th>
      <th class="date-sort"><em>Email</em> <span>&nbsp;</span></th>
      <th class="date-sort"><em>Phone number</em> <span>&nbsp;</span></th>
      <th class="date-sort"><em>View details</em> <span>&nbsp;</span></th>
      <th class="">Choose</th>
    </tr>
  </thead>
  <tbody>
  <?php 

  ?>
  @if ($builders != "")
	  @foreach($builders as $builder)
	 	<tr>
	    	<td>{{$builder->username}}</td>
	    	
	    	<td><input hidden name = "radius[]" value = "{{$array_radius[$builder->id]}}"/> {{$array_radius[$builder->id]}}</td>
	    	<td>{{$builder->local}}</td>
	 		<td>{{$builder->local_code}}</td>
	 		<td>{{$builder->email}}</td>
	 		<td>{{$builder->phone_number}}</td>
	 		<td class="date-sort"><em><a href="view-detail-info-builder/{{$builder->builder_id}}" tag target="_blank">View</></em> <span>&nbsp;</span></td>
	 		<td><input type="checkbox" name="check_builders[]" value="{{$builder->builder_id}}" /> Choose <br/></td>
	 	</tr>	
		@endforeach
    @endif
   
</table>
 <input hidden name = "category_id" value = "{{$category_id}}"/> 
 <input hidden name = "job_id" value = "{{$job_id}}"/>
 <input name = "num_builder_sent_invite" value = "{{$num_builder_sent_invite}}" >
 @if($num_builder_sent_invite <	 3)
 	{{ Form::submit('Submit', array('class' => 'btn btn-success')) }}
 @endif
  
{{ Form::close() }}
<form action = "add-to-schedule-waitingjobs" method = "post">
	<input name = "job_id" value = "{{$job_id}}" hidden>
	<button type = "submit" class = "btn btn-warning">Not now</button>
</form>
<script>
$(document).ready(function () {

   $("input[name='check_builders[]']").change(function () {

      var maxAllowed = 3 - <?php echo $num_builder_sent_invite; ?>;

      var cnt = $("input[name='check_builders[]']:checked").length;

      if (cnt > maxAllowed)
      {
         $(this).prop("checked", "");

         alert('Select maximum ' + maxAllowed + ' technologies!');

     }

  });


});

</script>

@stop