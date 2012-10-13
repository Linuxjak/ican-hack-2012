<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sekolah Global Mandiri - Moving Forward With Global Mandiri School</title>
<link href="<?php echo base_url(); ?>asset/css/style-dashboard.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>asset/colorbox/colorbox.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/prettyLoader.css" type="text/css" media="screen" charset="utf-8" />
<link href="<?php echo base_url(); ?>asset/css/chosen.css" rel="stylesheet" type="text/css">
<script>!window.jQuery && document.write('<script src="<?php echo base_url(); ?>asset/js/jquery.min.js"><\/script>');</script>
<script src="<?php echo base_url(); ?>asset/colorbox/jquery.colorbox.js"></script>
<script src="<?php echo base_url(); ?>asset/js/newsticker.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>asset/js/jquery.prettyLoader.js" type="text/javascript" charset="utf-8"></script>

<script type="application/javascript">
$(document).ready(function()
{	
	$(".boxsubmenu").colorbox({rel:'group', iframe:true, width:"450", height:"510"});
	
	$('#content').slideDown();
	
	$("#content img").css({ opacity: 0.5 });
	$("#content img").hover(function() {
		$(this).stop().animate({opacity: "1"}, 'fast');
	},
	function() {
		$(this).stop().animate({opacity: "0.5"}, 'fast');
	});
  
	
	$.prettyLoader({
			animation_speed: 'fast', /* fast/normal/slow/integer */
			bind_to_ajax: true, /* true/false */
			delay: false, /* false OR time in milliseconds (ms) */
			loader: '<?php echo base_url(); ?>asset/images/prettyLoader/ajax-loader.gif', /* Path to your loader gif */
			offset_top: 13, /* integer */
			offset_left: 10 /* integer */
		});
});

</script>
</head>

<body onload="goforit();">
<div id="banner-top">
	<div id="inner-banner-top">
		<div id="left-inner-banner-top">
			<a href="<?php echo base_url(); ?>" onclick="$.prettyLoader.show();"><img src="<?php echo base_url(); ?>asset/images/bg-logo.png" border="0" /></a>
		</div>
		<div id="right-inner-banner-top">
		<div class="cleaner_h10"><script src="<?php echo base_url(); ?>asset/js/clock.js" type="text/javascript"></script><span id="clock"></span></div>
		<div class="cleaner_h10"></div>
		<div id="header-menu">
			<ul>
				<li class="li-home"><a href="<?php echo base_url(); ?>" onclick="$.prettyLoader.show();">Home</a></li>
				<li class="li-other">Selamat datang, <strong><?php echo $this->session->userdata("nama"); ?></strong></li>
				<li class="li-other"><a href="<?php echo base_url(); ?>app_login_user/logout" onclick="$.prettyLoader.show();">Log Out</a></li>
				<li class="li-close"></li>
			</ul>
		</div>
		</div>
	</div>
</div>

<div class="cleaner_h30"></div>