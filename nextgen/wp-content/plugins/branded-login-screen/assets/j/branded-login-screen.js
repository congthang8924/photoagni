
$(window).resize(function(){
	var width = $(window).width();
	var height = $(window).height();
	if (width < 1050) { width = 1050;};
	$('#bg').height(height).width(width);
});

$(document).ready(function(){
	/* #footer div and html added to the Branded Login Screen */
	$('body.login').append('<div id="footer"><ul><li><a href="/" class="logo kw" title="Back to KerryWebster.com">kerrywebster.com</a></li><li><a href="http://wordpress.org" class="logo wp" title="Powered by WordPress">WordPress</a></li><li id="suggest"><a href="&#109;ail&#116;o&#58;&#107;&#101;&#114;&#114;y&#46;&#119;ebster&#64;&#103;&#109;&#97;&#105;&#108;&#46;&#99;&#111;&#109;" title="&#109;ail&#116;o&#58;&#107;&#101;&#114;&#114;y&#46;&#119;ebster&#64;&#103;&#109;&#97;&#105;&#108;&#46;&#99;&#111;&#109;">Contact Us</a></li></ul></div>');
	$('body.login').append('<div class="tooltip">&nbsp;</div>');

	/* #bg div and html added to the Branded Login Screen - this div contains the reference to your background image */
	/* Change the image src for hi-res or repeating image */
	/* REPEATING IMAGE REQUIRES CSS CHANGES */
	$('body.login').append('<div id="bg"><img src="/wp-content/plugins/branded-login-screen/assets/i/bg-1280.jpg" /></div>');

	$('h1').attr('id','brand');
	$('h1').attr('class','tooltip2');
	$('h1').attr('title','Powered by ' + siteNAME); 
	$('h1').prepend('<img src="/wp-content/plugins/branded-login-screen/assets/i/shim.png" width="358" height="80" />');
	$('#brand').mouseover(function() {$('#brand').css('cursor','pointer');});
	
	$('#brand').click(function() {window.location=siteURL;});
	
	$('p.message').html('Please enter your username or e-mail address').addClass('hideme');
	$('form#loginform').prepend('<h2>Enter your login credentials</h2>');
	$('form#lostpasswordform').prepend('<h2>Enter the required information.You will receive a new password via e-mail.</h2>');
	$('form#registerform').prepend('<h2>Create your own personalized account. A password will be e-mailed to you.</h2>');

	var width = $(window).width();
	var height = $(window).height();
	if (width < 1050) {width = 1050;};
	$('#bg').height(height).width(width);

	/* $("h1").tooltip('#dynatip');  */

	$("h1").simpletip({content: 'Kerry', fixed: false}); 

	$(demo).find('.simple-content a').simpletip({ persistent: true, content: '<img class="pngfix" src="/simpletip/images/logo_small.png" />' });

});

