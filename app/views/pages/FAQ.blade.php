@extends('layouts.default')
@section('content')	
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js">
</script>
	<div id = "contaner-list">
 		
	
        
   		<div class="row">
            <div class="box margin-top">
                <div class="col-lg-12">
                    <img src = "{{ asset('home_page/img/faq.png') }}"/>
                    <hr class = "hr-list-service">
                </div>
                <div class="col-lg-12">
                    <h1 class = "text-center text-color-2ecc71" >FREQUENTLY ASKED QUESTIONS</h1>
					  <h2 class = "text-center text-color-2ecc71">Boxes expand and contract when clicked</h2>
					
					  <h3 class="box-FAQ">
					    1. What about ...?
					  </h3>
					  <p class="draw">
					    Answer for question 1
					  </p>
					  
					  <h3 class="box-FAQ">
					   2. How much ...?
					  </h3>
					  <p class="draw">
					   Answer for question 2
					  </p>

					  <h3 class="box-FAQ">
					   3. How long ...?
					  </h3>
					  <p class="draw">
					   Answer for question 3
					  </p>
					  
					  <h3 class="box-FAQ">
					   4. Where are ...?
					  </h3>
					  <p class="draw">
					   Answer for question 4
					  </p>
	
                </div>
                
              
            </div>
        </div>
        

        
   </div>
   <link rel="stylesheet" href="{{ cached_asset('home_page/css/include-list-service.css', true) }}">
   <link rel="stylesheet" href="{{ cached_asset('home_page/css/include-FAQ.css', true) }}">
   <script src="{{ cached_asset('home_page/js/include-FAQ.js', true) }}"></script>
   
@stop