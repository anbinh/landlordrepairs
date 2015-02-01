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
						<p>Privacy Policy</p>
						</h1>
						<div class="analytics-event-post" data-event-name="zipcode_input_on_homepage" data-event-properties="{&quot;variant_type&quot;:&quot;control&quot;}"></div>	
					</div>	
					<div class="content-section-a">
						<div class="container">
							<div class="col-lg-12 col-sm-12" style = "text-align: center;">            
						        <div class="intro">
							  	<article>
								<p>
									Something will update soon...
								</p>
								{{trans ('greetings.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat')}}
								{{trans ('greetings.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat')}}
								{{trans ('greetings.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat')}}
								{{trans ('greetings.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat')}}
								{{trans ('greetings.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat')}}
								
									Created by Miratik
								</small>
								</article>
								</div>
							</div>
						</div>
						<!-- /.container -->
					</div>	
				</div>
			</div>
		</section>
		
		
		
	</main>

	<script src="{{ asset('home_page/js/jquery.min.js') }}"></script>
	<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
	<script src="{{ asset('home_page/js/imagesloaded.js') }}"></script>
	<script src="{{ asset('home_page/js/skrollr.js') }}"></script>
	<script src="{{ asset('home_page/js/_main.js') }}"></script>
 
	<link rel="stylesheet" href="{{ asset('home_page/css/include-about.css') }}">
	<script src="{{ asset('home_page/js/include-about.js') }}"></script>
	
           
<link rel="stylesheet" href="{{ asset('home_page/css/include-login.css') }}">


@stop