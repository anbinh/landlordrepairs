@extends('layouts.default')
@section('content')
	<main>
		<section id="slide-5" class="homeSlide">
			<div class="bcg skrollable skrollable-between" data-center="background-position: 50% 0px;" data-top-bottom="background-position: 50% -100px;" data-anchor-target="#slide-5" id = "skrollable-plusCss">
				<div class="hsContainer">	
					<!-- /Grab the id for home_cleaning service -->
					<div class='overlay'></div>
					<div class='main-page-header'>
						<h1 class='hero-text'>
						<p>Contact with Us</p>
						</h1>
						<div class="analytics-event-post" data-event-name="zipcode_input_on_homepage" data-event-properties="{&quot;variant_type&quot;:&quot;control&quot;}"></div>	
					</div>	
				
					
					<div class="content-section-b" id = "content-section-b-plusCss" style = "background-color: rgba(49, 134, 128, 0);">
						<div class="container">
							<div class="row container-row-plusCss">
								<div class="col-lg-5 col-lg-offset-1 col-sm-push-6  col-sm-6">
									<hr class="section-heading-spacer">
									<div class="clearfix"></div>
									<h2 class="section-heading">Homeez Company </h2>
									<p class="lead">Location<br>1234 Address<br>City</p>
								</div>
								<div class="col-lg-5 col-sm-pull-6  col-sm-6">
									
			
			
						<div id="cd-google-map">
							<div id="google-container"></div>
							<div id="cd-zoom-in"></div>
							<div id="cd-zoom-out"></div>
							<address>1234 Address	 Street, Location, City</address> 
						</div>
						<script src="https://maps.googleapis.com/maps/api/js"></script>
								
								</div>
							</div>
						</div>
						<!-- /.container -->
					</div>	
				</div>
			</div>
		</section>
		
		<div class="content-section-a" id = "content-section-a-plusCss">
			<div class="container">
				<div class="row container-row-plusCss">
					<div class="col-lg-5 col-sm-6">
						<hr class="section-heading-spacer">
						<div class="clearfix"></div>
						<h2 class="section-heading color-53A524">Phone number: </h2>
						<p class="lead color-53A524">437-345-7313</p>
						<h2 class="section-heading color-53A524">Email address: </h2>
						<p class="lead color-53A524">Homeez@gmail.com</p>
					</div>
					<div class="col-lg-5 col-lg-offset-2 col-sm-6">
						<img class="img-responsive" src="{{ asset('home_page/img/Skype Phone Green.png') }}" alt="">
					</div>
				</div>
			</div>
			<!-- /.container -->
		</div>
		<!-- /.content-section-a -->
	
	</main>

	<script src="{{ cached_asset('home_page/js/jquery.min.js', true) }}"></script>
	<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
	<script src="{{ cached_asset('home_page/js/imagesloaded.js', true) }}"></script>
	<script src="{{ cached_asset('home_page/js/skrollr.js', true) }}"></script>
	<script src="{{ cached_asset('home_page/js/_main.js', true) }}"></script>
 
	<link rel="stylesheet" href="{{ cached_asset('home_page/css/include-about.css', true) }}">
	<script src="{{ cached_asset('home_page/js/include-about.js', true) }}"></script>
	<link rel="stylesheet" href="{{ cached_asset('home_page/css/include-contact.css', true) }}">
	<script src="{{ cached_asset('home_page/js/include-contact.js', true) }}"></script>
@stop