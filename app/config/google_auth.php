<?php 
return array(
	"base_url" => "http://homeez.miratik.com/gauth/auth",
	"providers" => array (
		"Google" => array (
			"enabled" => true,
			"keys" => array ("id" => "305978810274-k47vdg198m7r8v9jfs01b0449rkhblcu.apps.googleusercontent.com", "secret" => "24Oinm8Nin_m0o_qdBQmfJr9"),
			"scope"           => "https://www.googleapis.com/auth/userinfo.profile ". // optional
                               "https://www.googleapis.com/auth/userinfo.email"    // optional
		)
	)	
);