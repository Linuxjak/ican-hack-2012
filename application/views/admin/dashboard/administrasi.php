<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sekolah Global Mandiri - Moving Forward With Global Mandiri School</title>
<link href="<?php echo base_url(); ?>asset/css/style-single-window.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url(); ?>asset/js/jquery.min.js"></script>
<script type="application/javascript">
$(document).ready(function()
{	
	$("#content img").css({ opacity: 0.5 });
	$("#content img").hover(function() {
		$(this).stop().animate({opacity: "1"}, 'fast');
	},
	function() {
		$(this).stop().animate({opacity: "0.5"}, 'fast');
	});
});

</script>
</head>

<body>
	<div id="content">
	<h1>ADMINISTRASI</h1>
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table">
	  <!--DWLayoutTable-->
	  <tr>
		<td width="50%" height="100" align="center" valign="middle">
			<a href="<?php echo base_url(); ?>admin_administrasi_system/" class="boxsubmenu" target="_blank">
			<img src="<?php echo base_url(); ?>asset/images/icon/system-icon.png" border="0"><div class="cleaner_h0"></div>
			SYSTEM		  
			</a>		
		</td>
		<td width="50%" align="center" valign="middle">
			<a href="<?php echo base_url(); ?>admin_administrasi_kurikulum" class="boxsubmenu" target="_blank">
			<img src="<?php echo base_url(); ?>asset/images/icon/kurikulum-icon.png" border="0"><div class="cleaner_h0"></div>
			KURIKULUM		  
			</a>
		</td>
	  </tr>
	  <tr>
	    <td height="100" align="center" valign="middle">
			<a href="<?php echo base_url(); ?>admin_administrasi_akademik" class="boxsubmenu" target="_blank">
			<img src="<?php echo base_url(); ?>asset/images/icon/akademik-icon.png" border="0"><div class="cleaner_h0"></div>
			AKADEMIK		  
			</a>
		</td>
	    <td align="center" valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</td>
      </tr>
	  <tr>
	    <td height="100" align="center" valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</td>
	    <td align="center" valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</td>
      </tr>
	  <tr>
	    <td height="100" align="center" valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</td>
	    <td align="center" valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</td>
      </tr>
	</table>
	</div>
</body>
</html>
