
@foreach ($supplier as $value) 
    {{ $value->id }}
@endforeach

<!-- <div class = "row">
	<style>
	.stepNav {
	  margin: 30px 20px;
		height: 43px;
		padding-right: 20px;
		position: relative;
		z-index: 0;
		}
	
	/* z-index to make sure the buttons stack from left to right */
	
	.stepNav li {
		float: left;
		position: relative;
		z-index: 3;
		-webkit-box-shadow: 0 1px 1px rgba(0,0,0,0.12);
		   -moz-box-shadow: 0 1px 1px rgba(0,0,0,0.12);
				    box-shadow: 0 1px 1px rgba(0,0,0,0.12);
		}
		
	.stepNav li:first-child {
		-webkit-border-radius: 5px 0 0 5px;
		   -moz-border-radius: 5px 0 0 5px;
	   	      border-radius: 5px 0 0 5px;
		}
		
	.stepNav li:nth-child(2) { z-index: 1; }
	.stepNav li:nth-child(3) { z-index: 0; }
	
	/* different widths */
	
	.stepNav.twoWide li { width: 50%; }
	.stepNav.threeWide li { width: 33.33%; }
	
	   /* step links */
	
	.stepNav a, .stepNav a:visited {
		width: 100%;
		height: 43px;
		padding: 0 0 0 25px;
		color: #717171;
		text-align: center;
		text-shadow: 0 1px 0 #fff;
		line-height: 43px;
		white-space: nowrap;
		border: 1px solid #cbcbcb;
		text-decoration: none;
		border-top-color: #dddddd;
		border-right: 0;
		background-color: #fbfbfb;
		background-image: -webkit-gradient(linear, left top, left bottom, from(rgb(251, 251, 251)), to(rgb(233, 233, 233)));
		background-image: -webkit-linear-gradient(top, rgb(251, 251, 251), rgb(233, 233, 233));
		background-image: -moz-linear-gradient(top, rgb(251, 251, 251), rgb(233, 233, 233));
		background-image: -o-linear-gradient(top, rgb(251, 251, 251), rgb(233, 233, 233));
		background-image: -ms-linear-gradient(top, rgb(251, 251, 251), rgb(233, 233, 233));
		background-image: linear-gradient(top, rgb(251, 251, 251), rgb(233, 233, 233));
		float: left;
		position: relative;
		-webkit-box-sizing: border-box;
		   -moz-box-sizing: border-box;
			      box-sizing: border-box;
		}
		
	.stepNav li:first-child a {
		padding-left: 12px;
		-webkit-border-radius: 5px 0 0 5px;
		   -moz-border-radius: 5px 0 0 5px;
	   	      border-radius: 5px 0 0 5px;
		}
	
	.stepNav a:before {
		content: "";
		width: 29px;
		height: 29px;
		border-right: 1px solid #dddddd;
		border-bottom: 1px solid #cbcbcb;
		background-image: -webkit-gradient(linear, right top, left bottom, from(rgb(251, 251, 251)), to(rgb(233, 233, 233)));
		background-image: -webkit-linear-gradient(right top, rgb(251, 251, 251), rgb(233, 233, 233));
		background-image: -moz-linear-gradient(right top, rgb(251, 251, 251), rgb(233, 233, 233));
		background-image: -o-linear-gradient(right top, rgb(251, 251, 251), rgb(233, 233, 233));
		background-image: -ms-linear-gradient(right top, rgb(251, 251, 251), rgb(233, 233, 233));
		background-image: linear-gradient(right top, rgb(251, 251, 251), rgb(233, 233, 233));
		display: block;
		position: absolute;
		top: 6px;
		right: -16px;
		z-index: -1;
		-webkit-transform: rotate(-45deg);
		   -moz-transform: rotate(-45deg);
		     -o-transform: rotate(-45deg);
			 	    transform: rotate(-45deg);
		}
		
	.stepNav a:hover {
		color: #2e2e2e;
		background-color: #f5f5f5;
		background-image: -webkit-gradient(linear, left top, left bottom, from(rgb(242, 242, 242)), to(rgb(217, 217, 217)));
		background-image: -webkit-linear-gradient(top, rgb(242, 242, 242), rgb(217, 217, 217));
		background-image: -moz-linear-gradient(top, rgb(242, 242, 242), rgb(217, 217, 217));
		background-image: -o-linear-gradient(top, rgb(242, 242, 242), rgb(217, 217, 217));
		background-image: -ms-linear-gradient(top, rgb(242, 242, 242), rgb(217, 217, 217));
		background-image: linear-gradient(top, rgb(242, 242, 242), rgb(217, 217, 217));
		}
		
	.stepNav a:hover:before {
		background-image: -webkit-gradient(linear, right top, left bottom, from(rgb(242, 242, 242)), to(rgb(217, 217, 217)));
		background-image: -webkit-linear-gradient(right top, rgb(242, 242, 242), rgb(217, 217, 217));
		background-image: -moz-linear-gradient(right top, rgb(242, 242, 242), rgb(217, 217, 217));
		background-image: -o-linear-gradient(right top, rgb(242, 242, 242), rgb(217, 217, 217));
		background-image: -ms-linear-gradient(right top, rgb(242, 242, 242), rgb(217, 217, 217));
		background-image: linear-gradient(right top, rgb(242, 242, 242), rgb(217, 217, 217));
		}
	
	/* selected */
		
	.stepNav li.selected {
		-webkit-box-shadow: none;
		   -moz-box-shadow: none;
				    box-shadow: none;
		}
								
	.stepNav li.selected a, .stepNav li.selected a:before {
		background: #ebebeb;
		}
		
	.stepNav li.selected a {
		border-top-color: #bebebe;
		-webkit-box-shadow: inset 2px 1px 2px rgba(0,0,0,0.12);
		   -moz-box-shadow: inset 2px 1px 2px rgba(0,0,0,0.12);
				    box-shadow: inset 2px 1px 2px rgba(0,0,0,0.12);
		}
		
	.stepNav li.selected a:before {
		border-right: 1px solid #bebebe;
		border-bottom: 1px solid #cbcbcb;
		-webkit-box-shadow: inset -1px -1px 1px rgba(0,0,0,0.1);
		   -moz-box-shadow: inset -1px -1px 1px rgba(0,0,0,0.1);
				    box-shadow: inset -1px -1px 1px rgba(0,0,0,0.1);
		}
	.text-color-black {
		color: #000;	
	}
	.border {
		border: 1px solid black;
		
	}
	.margin-bold {
		margin-left: 1%;
		margin-right: 1%;
	}
	.star {
		color: yellow;
		float: left;
	}
	.checkbox-star {
		float: right;
	}
	</style>
	<ul class="stepNav threeWide">
	  <li><a href="" title="">Step 1</a></li>
		<li class="selected"><a href="" title="">Step 2</a></li>
		<li><a href="" title="">Step 3</a></li>
	</ul>
</div>

<div class = "row">
	<h3 class = "text-color-black">We found these suppliers who meet your requiment</h3>
</div>

<div class = "row" style = "margin-left: 1%; margin-right: 1%; padding-bottom: 1%">
	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 thumb border">
		<div class = "row border">
			<h4 class = "text-color-black">Modify your search</h4>
			<p class = "text-color-black">Service: XXX</p>
			<p class = "text-color-black">Date: XXX</p>
			<p class = "text-color-black">Time: XXX</p>
			<p class = "text-color-black">Number of hours: XXX</p>
			<button> Modify your seach</button>
		</div>
		<div class = "row border">
			<h4 class = "text-color-black">Filter search results	</h4>
			<h4 class = "text-color-black">By ranking	</h4>

			<p class = "star">★</p><input class = "checkbox-star" type = "checkbox"><br>
			<p class = "star">★★</p><input class = "checkbox-star" type = "checkbox"><br>
			<p class = "star">★★★</p><input class = "checkbox-star" type = "checkbox"><br>
			<p class = "star">★★★★</p><input class = "checkbox-star" type = "checkbox"><br>
			<p class = "star">★★★★★</p><input class = "checkbox-star" type = "checkbox"><br>
			<p class = "text-color-black">By price per hour:</p>
			<div id="slider"></div>
			<style>
				.value {
				  position: absolute;
				  top: 30px;
				  left: 50%;
				  margin: 0 0 0 -20px;
				  width: 40px;
				  text-align: center;
				  display: block;
				  
				  /* optional */
				  
				  font-weight: normal;
				  font-family: Verdana,Arial,sans-serif;
				  font-size: 14px;
				  color: #333;
				}
				
				.price-range-both.value {
				  width: 100px;
				  margin: 0 0 0 -50px;
				  top: 26px;
				}
				
				.price-range-both {
				  display: none; 
				}
				
				.value i {
				  font-style: normal;
				}
			</style>
			<script>
			function collision($div1, $div2) {
			      var x1 = $div1.offset().left;
			      var w1 = 40;
			      var r1 = x1 + w1;
			      var x2 = $div2.offset().left;
			      var w2 = 40;
			      var r2 = x2 + w2;
			        
			      if (r1 < x2 || x1 > r2) return false;
			      return true;
			      
			    }
			    
			// // slider call

			$('#slider').slider({
				range: true,
				min: 0,
				max: 500,
				values: [ 75, 300 ],
				slide: function(event, ui) {
					
					$('.ui-slider-handle:eq(0) .price-range-min').html('$' + ui.values[ 0 ]);
					$('.ui-slider-handle:eq(1) .price-range-max').html('$' + ui.values[ 1 ]);
					$('.price-range-both').html('<i>$' + ui.values[ 0 ] + ' - </i>$' + ui.values[ 1 ] );
					
					//
					
			    if ( ui.values[0] == ui.values[1] ) {
			      $('.price-range-both i').css('display', 'none');
			    } else {
			      $('.price-range-both i').css('display', 'inline');
			    }
			        
			        //
					
					if (collision($('.price-range-min'), $('.price-range-max')) == true) {
						$('.price-range-min, .price-range-max').css('opacity', '0');	
						$('.price-range-both').css('display', 'block');		
					} else {
						$('.price-range-min, .price-range-max').css('opacity', '1');	
						$('.price-range-both').css('display', 'none');		
					}
					
				}
			});

			$('.ui-slider-range').append('<span class="price-range-both value"><i>$' + $('#slider').slider('values', 0 ) + ' - </i>' + $('#slider').slider('values', 1 ) + '</span>');

			$('.ui-slider-handle:eq(0)').append('<span class="price-range-min value">$' + $('#slider').slider('values', 0 ) + '</span>');

			$('.ui-slider-handle:eq(1)').append('<span class="price-range-max value">$' + $('#slider').slider('values', 1 ) + '</span>');
			</script>
		</div>
	</div>
	<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 thumb border">
	<style>
		/*wrapper element so column padding doesn't affect fixed header background*/
		.scroll-window-wrapper{
		  position:relative;
		}
		/* element containing the table */
		.scroll-window{
			height: 20rem;
			overflow-x: hidden;
			overflow-y: scroll;
		}
		.scroll-window table{
		  margin-bottom:0;
		}
			/*fixed header background*/
		.scroll-window:before{
			content:"";
			position: absolute;
			width:100%;
			height:2.5rem;
			display: table;
			z-index: 10;
			background:rgba(170,170,170,0.8);
		}
		
		
		/*the actual fixed header*/
		table.fixed-header th div{
		  position: absolute;
		  margin-top: -.5rem;
		  z-index: 11;
		  color:#333;
		}
		table.fixed-header  thead tr{
		  height:2.5rem;
		}
		
		.user-list{
			width:100%;
		}
		
		.user-list	td.text-right{
			width:16rem;
		}
		
		/*-----experimental scrollbar styles-----*/
		/* line 199, ../scss/main.scss */
		#bodywrap ::-webkit-scrollbar {
		  width: 1rem;
		}
		/* line 202, ../scss/main.scss */
		#bodywrap ::-webkit-scrollbar-button {
		  /* width:1rem;*/
		}
		/* line 205, ../scss/main.scss */
		#bodywrap ::-webkit-scrollbar-track {
		  background-color: #eaeaea;
		  border-left: 1px solid #ccc;
		}
		/* line 212, ../scss/main.scss */
		#bodywrap ::-webkit-scrollbar-thumb {
		  background-color: #ccc;
		}
		/* line 215, ../scss/main.scss */
		#bodywrap ::-webkit-scrollbar-thumb:hover {
		  background-color: #aaa;
		}
	
		

	</style>
	<div id="bodywrap">
	<div class="row">
	<div class=" columns">
	  <div class="scroll-window-wrapper">
	
		<div class="scroll-window">
		<table class="table table-striped table-hover user-list fixed-header">
			<tbody>
				<tr>
					<td>Michael Jones</td>
					<td>michael@gmail.com</td>
					<td>active</td>
					<td class="text-right">
						<button class="button tiny">View User</button>
						<button class="button alert tiny">Delete</button>			
					</td>
				</tr>
				<tr>
					<td>Michael Jones</td>
					<td>michael@gmail.com</td>
					<td>active</td>
					<td class="text-right">
						<button class="button tiny">View User</button>
						<button class="button alert tiny">Delete</button>			
					</td>
				</tr>
				<tr>
					<td>Michael Jones</td>
					<td>michael@gmail.com</td>
					<td>active</td>
					<td class="text-right">
						<button class="button tiny">View User</button>
						<button class="button alert tiny">Delete</button>			
					</td>
				</tr>
				<tr>
					<td>Michael Jones</td>
					<td>michael@gmail.com</td>
					<td>active</td>
					<td class="text-right">
						<button class="button tiny">View User</button>
						<button class="button alert tiny">Delete</button>			
					</td>
				</tr>
				<tr>
					<td>Michael Jones</td>
					<td>michael@gmail.com</td>
					<td>active</td>
					<td class="text-right">
						<button class="button tiny">View User</button>
						<button class="button alert tiny">Delete</button>			
					</td>
				</tr>
				<tr>
					<td>Michael Jones</td>
					<td>michael@gmail.com</td>
					<td>active</td>
					<td class="text-right">
						<button class="button tiny">View User</button>
						<button class="button alert tiny">Delete</button>			
					</td>
				</tr>
				<tr>
					<td>Michael Jones</td>
					<td>michael@gmail.com</td>
					<td>active</td>
					<td class="text-right">
						<button class="button tiny">View User</button>
						<button class="button alert tiny">Delete</button>			
					</td>
				</tr>
				<tr>
					<td>Michael Jones</td>
					<td>michael@gmail.com</td>
					<td>active</td>
					<td class="text-right">
						<button class="button tiny">View User</button>
						<button class="button alert tiny">Delete</button>			
					</td>
				</tr>
				<tr>
					<td>Michael Jones</td>
					<td>michael@gmail.com</td>
					<td>active</td>
					<td class="text-right">
						<button class="button tiny">View User</button>
						<button class="button alert tiny">Delete</button>			
					</td>
				</tr>
	 		</tbody>
		</table>
		</div>
	</div>
	</div>
	</div>
	</div>
	</div>
</div>


 -->
 