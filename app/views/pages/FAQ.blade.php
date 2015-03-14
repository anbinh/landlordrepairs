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
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    
					  @if ($FAQs != null)
					  	
					  		@foreach($FAQs as $FAQ)
					  			<h3 class="box-FAQ">
								    {{$FAQ->question}}
								 </h3>
								  <p class="draw">
								    {{$FAQ->answer}}
								  </p>	
					  		@endforeach
					  	
					  @endif
	
                </div>
                <div class="col-lg-2"></div>
              
            </div>
        </div>
        

        
   </div>
   
   
@stop