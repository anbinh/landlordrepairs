function showRequest(formData, jqForm, options) { 
	
} 
function showResponse(response, statusText, xhr, $form)  { 
	$('#profile_picture_container').html("");
	$('#profile_picture_container').append($('#profile_picture'));
	$('#profile_pic_preview').attr("src", response.file);
	$('#profile_pic_fl_url').val(response.file);
	
}

$(document).ready(function() {
	var options = { 
        beforeSubmit:  showRequest,
		success:       showResponse,
		dataType: 'json' 
        }; 

 	$('body').delegate('#profile_picture','change', function(){

 		$('#file_upload').attr("checked", "checked");
 		//move file
 		$('#upload').append($('#profile_picture'));
 		$('#profile_picture_container').append("<img src='/uploads/ajax-loader.gif'/>");
 		$('#upload').ajaxForm(options).submit();  		
 	});
 	
});	


$(document).ready(function() {
	/*
	$('#profile_picture').change(function() {
		$('#profile_pic_preview').attr("src", "/uploads/default.jpg");
		$('#file_upload').attr("checked", "checked");
	});
	*/
	hello.on('auth.login', function(r){
	    // Get Profile
	    hello( r.network ).api( '/me' ).success( function(p){
	    	//console.log(p);
	    	if($('#facebook').is(':checked')) {
	    		//alert("dsds");
	        	$('#profile_pic_preview').attr("src", p.thumbnail + "?type=large");
	        	$('#profile_pic_fb_url').val(p.thumbnail + "?type=large");
	    	}
	    	if($('#twitter').is(':checked')) {
	    		//alert(p.thumbnail);
	        	$('#profile_pic_preview').attr("src", p.thumbnail.replace("_normal",""));
	    		$('#profile_pic_tw_url').val(p.thumbnail.replace("_normal",""));
	    	}
	        //console.log(p);
	        //document.getElementById(r.network).innerHTML = "<img src='"+ p.thumbnail + "' width=24/>Connected to "+ r.network+" as " + p.name;
	    });
	});
	/*
	hello.init( CLIENT_IDS_ALL, {redirect_uri:'../redirect.html'});
	*/
	hello.init(
	CLIENT_IDS_ALL,
	{
		redirect_uri:'../redirect.html',
		oauth_proxy: OAUTH_PROXY_URL
	});
	/*
	hello.on('auth.login', function(r){
		// Get Profile
		hello.api(r.network+':/me', function(p){
			document.getElementById('login').innerHTML = "<img src='"+ p.thumbnail + "' width=24/>Connected to "+ r.network+" as " + p.name;
		});
	});

	hello.init({
		'twitter' : TWITTER_CLIENT_ID
	},
	{
		redirect_uri:'../redirect.html',
		oauth_proxy: OAUTH_PROXY_URL
	});
	*/

})
