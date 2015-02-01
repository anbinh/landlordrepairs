//
// Client IDS
// Defines the CLIENT_ID (AppID's) of the OAuth2 providers
// relative to the domain host where this code is presented.

// Register your domain with Facebook at  and add here
var FACEBOOK_CLIENT_ID = {
	'local.guusebump.com' : '317951665048718',
	'guusebump.socialspr.com' : '317951665048718',
	'guusebump.com' : '317951665048718'
}[window.location.hostname];

// Register your domain with Windows Live at http://manage.dev.live.com and add here
var WINDOWS_CLIENT_ID = {
	'adodson.com' : '00000000400D8578',
	'mrswitch.github.com' : '0000000044088105',
	'local.knarly.com' : '000000004405FD31'
}[window.location.hostname];

//
var GOOGLE_CLIENT_ID = '656984324806-sr0q9vq78tlna4hvhlmcgp2bs2ut8uj8.apps.googleusercontent.com';

// To make it a little easier
var CLIENT_IDS = {
	windows : WINDOWS_CLIENT_ID,
	google : GOOGLE_CLIENT_ID,
	facebook : FACEBOOK_CLIENT_ID
};

// Dropbox full 't5s644xtv7n4oth'... requires production authentication
var DROPBOX_CLIENT_ID = '1lkagy1bz7h2uhl';

var LINKEDIN_CLIENT_ID = 'bixrjszkfk0j'; // 'exgsps7wo5o7'

var YAHOO_CLIENT_ID = {
	'local.knarly.com' : 'dj0yJmk9TTNoTWV6eE5ObW5NJmQ9WVdrOWVtSmhVbk5pTm1VbWNHbzlNVFUxT0RNeU16UTJNZy0tJnM9Y29uc3VtZXJzZWNyZXQmeD0yZQ--',
	'adodson.com' : 'dj0yJmk9dkVoREN1R3BLTThhJmQ9WVdrOVYyNUpORXRXTnpZbWNHbzlNQS0tJnM9Y29uc3VtZXJzZWNyZXQmeD1mNw--'
}[window.location.hostname];

var TWITTER_CLIENT_ID = {
	'guusebump.local' : 'Fp50OuLaklptl8rbsUcdFJQkR',
	'local.guusebump.com' : 'Fp50OuLaklptl8rbsUcdFJQkR',
	'guusebump.socialspr.com' : 'Fp50OuLaklptl8rbsUcdFJQkR',
	'guusebump.com' : 'Fp50OuLaklptl8rbsUcdFJQkR'
}[window.location.hostname];

var SOUNDCLOUD_CLIENT_ID = {
	'local.knarly.com' : '8a4a19f86cdab097fa71a15ab26a01d6',
	'adodson.com' : '47a386647dadf913e559c12ef6db4292'
}[window.location.hostname];

var FOURSQUARE_CLIENT_ID = {
	'local.knarly.com' : '3HEXMBQVH2SV0VXUKXOGQRPWH1PUTEIZN4KBDY5L54ZDXCDP',
	'adodson.com' : 'MFRXCJP1TKMUSYC2JBYU50L0IH0GJP1HTNS1BV0ML3NNXG5B'
}[window.location.hostname];

var GITHUB_CLIENT_ID = {
	'local.knarly.com' : 'ca7e06a718b2e8eef737',
	'adodson.com' : 'd934ef34e2e40cf9b00a'
}[window.location.hostname];

var INSTAGRAM_CLIENT_ID = {
	'local.knarly.com' : 'bfbbf362ac3148aeb1150e5b8256bbe9',
	'adodson.com' : '264d13a33ba845f396a152cc326e6f5d'
}[window.location.hostname];

var BOX_CLIENT_ID = {
	'local.knarly.com' : 'rdyb5se2fcuioryle3qdw2wcrps959x4',
	'adodson.com' : '264d13a33ba845f396a152cc326e6f5d'
}[window.location.hostname];

var FLICKR_CLIENT_ID = {
	'local.guusebump.com' : 'f06f8361fc2a63e19b80f2ea6feffc7e',
	'guusebump.socialspr.com' : 'f06f8361fc2a63e19b80f2ea6feffc7e',
	'guusebump.com' : 'f06f8361fc2a63e19b80f2ea6feffc7e'
}[window.location.hostname];


// To make it a little easier
var CLIENT_IDS_ALL = {
	windows : WINDOWS_CLIENT_ID,
	google : GOOGLE_CLIENT_ID,
	facebook : FACEBOOK_CLIENT_ID,
	dropbox : DROPBOX_CLIENT_ID,
	twitter : TWITTER_CLIENT_ID,
	yahoo : YAHOO_CLIENT_ID,
	instagram : INSTAGRAM_CLIENT_ID,
	linkedin : LINKEDIN_CLIENT_ID,
	soundcloud : SOUNDCLOUD_CLIENT_ID,
	foursquare : FOURSQUARE_CLIENT_ID,
	github : GITHUB_CLIENT_ID,
	flickr: FLICKR_CLIENT_ID
};


//
// OAUTH PROXY
//
var OAUTH_PROXY_URL = {
	'local.knarly.com' : 'http://local.knarly.com:5500/proxy'
}[window.location.hostname] || 'https://auth-server.herokuapp.com/proxy';