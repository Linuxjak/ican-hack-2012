<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Corruption Reporting and Collaboration System - A Hack Again Corruption</title>
<link href="<?php echo base_url(); ?>asset/admin/css/siakad.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>asset/css/menu.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/menu.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>asset/colorbox/colorbox.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/prettyLoader.css" type="text/css" media="screen" charset="utf-8" />
<link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/breadcrumb.css" type="text/css" media="screen" charset="utf-8" />
<link href="<?php echo base_url(); ?>asset/css/chosen.css" rel="stylesheet" type="text/css">
<script>!window.jQuery && document.write('<script src="<?php echo base_url(); ?>asset/js/jquery.min.js"><\/script>');</script>
<script src="<?php echo base_url(); ?>asset/colorbox/jquery.colorbox.js"></script>
<script src="<?php echo base_url(); ?>asset/js/newsticker.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>asset/js/jquery.prettyLoader.js" type="text/javascript" charset="utf-8"></script>

<script type="application/javascript">
$(document).ready(function()
{	
	$(".boxdepartemen").colorbox({rel:'group', iframe:true, width:"900", height:"550"});
	$(".boxtingkat").colorbox({rel:'group', iframe:true, width:"700", height:"460"});
	$(".boxtahunajaran").colorbox({rel:'group', iframe:true, width:"700", height:"560"});
	$(".boxsemester").colorbox({rel:'group', iframe:true, width:"700", height:"460"});
	$(".boxsekilasinfo").colorbox({rel:'group', iframe:true, width:"700", height:"500"});
	$(".boxuser").colorbox({rel:'group', iframe:true, width:"700", height:"400"});
	
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
   
    $('a[href=#top]').click(function(){
        $('html, body').animate({scrollTop:0}, 'slow');
        return false;
    });
});

</script>

</head>

<body>
<div id="banner"><div id="head">
<div id="head-kiri"><img src="<?php echo base_url();?>asset/admin/images/bg-logo.png" /></div>
<div id="head-kanan">Welcome, <strong><?php echo $this->session->userdata('nama'); ?></strong> | 
<a href="<?php echo base_url(); ?>app_login_user/logout" onclick="$.prettyLoader.show();">Log Out</a> | 
<a href="<?php echo base_url(); ?>" onclick="$.prettyLoader.show();">Dashboard</a></div>
</div></div>
<div id="header">
<div id="head">
<img src="<?php echo base_url();?>asset/admin/images/header.jpg" />
</div>
</div>
<div id="menu">
<div id="nav">
<div id="MainMenu">
<div id="Menu">
<div class="suckertreemenu">
<ul id="treemenu1">

<li><a href="#">&raquo; Content Management</a>
	<ul>
		<li><a href="<?php echo base_url(); ?>admin_administrasi_system_sekilas_info" onclick="$.prettyLoader.show();">&raquo; News Splash Management</a></li>
		<li><a href="<?php echo base_url(); ?>admin_administrasi_system_berita" onclick="$.prettyLoader.show();">&raquo; News Management</a></li>
		<li><a href="<?php echo base_url(); ?>admin_administrasi_system_hubungi" onclick="$.prettyLoader.show();">&raquo; Contact  Management</a></li>
	</ul>
</li>
<li><a href="<?php echo base_url(); ?>admin_administrasi_system_user" onclick="$.prettyLoader.show();">&raquo; User Management</a></li>
<li><a href="<?php echo base_url(); ?>admin_administrasi_system_member" onclick="$.prettyLoader.show();">&raquo; Member Management</a></li>

</ul>
</div>
</div>
</div>
</div>
</div>
<div id="container">
