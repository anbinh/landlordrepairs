var _gaq=[['_setAccount','UA-839919-3'],['_trackPageview']];
		(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
		g.src='//www.google-analytics.com/ga.js';
		s.parentNode.insertBefore(g,s)}(document,'script'));
		
/*search button*/

	$('.searchButton').on('click', function(e) {
		e.preventDefault();
		$('.searchTerm').animate({width: 'toggle'}).focus();
		
	});

/*end search button*/