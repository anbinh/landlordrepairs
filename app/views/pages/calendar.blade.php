
<!DOCTYPE html>
<html>
<!--
   This is a jQuery Tools standalone demo. Feel free to copy/paste.
   http://flowplayer.org/tools/demos/

   Do *not* reference CSS files and images from flowplayer.org when in
   production Enjoy!
-->
<head>
  <title>jQuery Tools standalone demo</title>

    <!-- include the Tools -->
 
  
  <!-- standalone page styling (can be removed) -->
 

</head>
<body><!-- wrapper element -->

 <script src="http://cdn.jquerytools.org/1.2.6/full/jquery.tools.min.js"></script>
 <link rel="shortcut icon" href="http://jquerytools.github.io/media/img/favicon.ico">
  <link rel="stylesheet" type="text/css"
        href="http://jquerytools.github.io/media/css/standalone.css"/>

  <!-- dateinput styling -->
<link rel="stylesheet" type="text/css"
      href="http://jquerytools.github.io/media/css/dateinput/large.css"/>

 <!-- Bootstrap Core CSS - Uses Bootswatch Flatly Theme: http://bootswatch.com/flatly/ -->
    <link href="http://ironsummitmedia.github.io/startbootstrap-freelancer/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="http://ironsummitmedia.github.io/startbootstrap-freelancer/css/freelancer.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="http://ironsummitmedia.github.io/startbootstrap-agency/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
   
 

    <!-- Custom Fonts -->
    <link href="http://ironsummitmedia.github.io/startbootstrap-agency/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

<link href="{{{ asset('font-awesome/css/font-awesome.min.css') }}}" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
<div id="calendar">
  <input id = "date"type="date" name="mydate" value="0" />
</div>

<!-- large date display -->


<br clear="all"/>

<!-- make it happen -->
<script>
$(function() {
// initialize dateinput
$(":date").dateinput( {

	// closing is not possible
	onHide: function()  {
		return false;
	},

	
	
// set initial value and show dateinput when page loads
}).data("dateinput").setValue(0).show();
});
function test(){
alert($('#date').val());
}
</script>
<button onclick = "test()">button</button>
</body>
</html>