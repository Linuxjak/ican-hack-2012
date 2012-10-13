<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Corruption Reporting and Collaboration System - A Hack Again Corruption</title>
<link href="<?php echo base_url(); ?>asset/css/style-login.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>asset/colorbox/colorbox.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/prettyLoader.css" type="text/css" media="screen" charset="utf-8" />
<link href="<?php echo base_url(); ?>asset/css/chosen.css" rel="stylesheet" type="text/css">
<script>!window.jQuery && document.write('<script src="<?php echo base_url(); ?>asset/js/jquery.min.js"><\/script>');</script>
<script src="<?php echo base_url(); ?>asset/colorbox/jquery.colorbox.js"></script>
<script src="<?php echo base_url(); ?>asset/js/newsticker.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>asset/js/jquery.prettyLoader.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>asset/js/chosen.jquery.js" type="text/javascript"></script>

<script type="application/javascript">
$(document).ready(function()
{	
	$(".lupa").colorbox({rel:'group', iframe:true, width:"600", height:"320"});
	$(".detail").colorbox({rel:'group', iframe:true, width:"90%", height:"90%"});
	
	$('#content').slideDown();
	
	$.prettyLoader({
			animation_speed: 'fast', /* fast/normal/slow/integer */
			bind_to_ajax: true, /* true/false */
			delay: false, /* false OR time in milliseconds (ms) */
			loader: '<?php echo base_url(); ?>asset/images/prettyLoader/ajax-loader.gif', /* Path to your loader gif */
			offset_top: 13, /* integer */
			offset_left: 10 /* integer */
		});
	
	var X = "<?php echo $this->session->userdata("last_form_login"); ?>";
	if(X=='signup')
	{
		$("#login").removeClass('select');
		$("#signup").addClass('select');
		$("#report").removeClass('select');
		$("#loginbox").slideUp();
		$("#signupbox").slideDown();
		$("#reportbox").slideUp();
	}
	else if(X=='report')
	{
		$("#login").removeClass('select');
		$("#signup").removeClass('select');
		$("#report").addClass('select');
		$("#loginbox").slideUp();
		$("#signupbox").slideUp();
		$("#reportbox").slideDown();
	}
	else if(X=='login')
	{
		$("#login").addClass('select');
		$("#signup").removeClass('select');
		$("#report").removeClass('select');
		$("#loginbox").slideDown();
		$("#signupbox").slideUp();
		$("#reportbox").slideUp();
	}
	$(".tab").click(function()
	{
		var X=$(this).attr('id');
		if(X=='signup')
		{
			$("#login").removeClass('select');
			$("#signup").addClass('select');
			$("#report").removeClass('select');
			$("#loginbox").slideUp();
			$("#signupbox").slideDown();
			$("#reportbox").slideUp();
		}
		else if(X=='report')
		{
			$("#login").removeClass('select');
			$("#signup").removeClass('select');
			$("#report").addClass('select');
			$("#loginbox").slideUp();
			$("#signupbox").slideUp();
			$("#reportbox").slideDown();
		}
		else if(X=='login')
		{
			$("#login").addClass('select');
			$("#signup").removeClass('select');
			$("#report").removeClass('select');
			$("#loginbox").slideDown();
			$("#signupbox").slideUp();
			$("#reportbox").slideUp();
		}
	});
});

</script>
</head>

<body onLoad="goforit()">
<div id="banner-top">
	<div id="inner-banner-top">
		<div id="left-inner-banner-top">
			<a href="<?php echo base_url(); ?>" onclick="$.prettyLoader.show();"><img src="<?php echo base_url(); ?>asset/images/bg-logo.png" border="0" /></a>
		</div>
		<div id="right-inner-banner-top">
		
		<div id="header-menu">
			<ul>
				<li class="li-home"><a href="<?php echo base_url(); ?>" onclick="$.prettyLoader.show();">Home</a></li>
				<li class="li-other"><script src="<?php echo base_url(); ?>asset/js/clock.js" type="text/javascript"></script><span id="clock"></span></li>
				<li class="li-close"></li>
			</ul>
		</div>
		</div>
	</div>
</div>

<div class="cleaner_h30"></div>

<div id="content" style="display:none;">
<div class="cleaner_h10"></div>
	<div id="left-content">
	<h1>Welcome to Corruption Reporting and Collaboration System</h1>
	<div class="ribbon"></div>
	<h3>Corruption Feed</h3>
	<div id="ticker">
		<ul class="tick-ul">
		<?php
			foreach($report->result_array() as $i)
			{
		?>
			<div id="listticker">
				<li class="tick-li">
					<h5><img src="<?php echo base_url(); ?>asset/corruption/thumb/<?php echo $i['gambar']; ?>" style="float:left; margin:5px 5px 0px 0px;" />
					<?php echo substr($i['isi_report'],0,370); ?>
					[ <a href="<?php echo base_url(); ?>corruption/detail/<?php echo $i['kode_report']; ?>" class="detail">Read More</a> ]</h5>
					<div class="cleaner_h0"></div>
				</li> 
		<?php } ?>
		</ul>
	</div>
	
	<div id="bg-ticker"></div>

	</div>
	
	<div id="right-content">
		<div id="tabbox">
			<a href="#" id="report" class="tab select" onclick="$.prettyLoader.show(1000);">REPORTING</a>
			<a href="#" id="login" class="tab login" onclick="$.prettyLoader.show(1000);">SIGN IN</a>
			<a href="#" id="signup" class="tab signup" onclick="$.prettyLoader.show(1000);">SIGN UP</a>
		</div>
		<div id="panel">
			<div id="reportbox">
			<?php echo validation_errors(); ?>
			<h1>Reporting Form</h1>
			<div class="cleaner_h10"></div>
				<?php echo $this->session->flashdata('result_login'); ?>
				<?php echo form_open_multipart("app_report_user/index"); ?>
					<table border="0" style="border-collapse:collapse;" cellpadding="0" cellspacing="0">
						<tr><td><?php echo form_input($nama_lengkap,set_value('nama_lengkap')); ?></td></tr>
						<tr><td><?php echo form_input($email_report,set_value('email_report')); ?></td></tr>
						<tr><td><?php echo form_input($no_telp,set_value('no_telp')); ?></td></tr>
						<tr><td><?php echo form_textarea($isi_report,set_value('isi_report')); ?></td></tr>
						<tr><td><input type="file" name="userfile" class="input-style1"></td></tr>
						<tr><td><?php echo $gbr_captcha; ?><?php echo form_input($captcha_report); ?></td></tr>
						<tr><td><input type="submit" value="Send" class="input-button" onclick="$.prettyLoader.show();" />
						<input type="reset" value="Empty" class="input-button" /></td></tr>
					</table>
				<?php echo form_close(); ?>
			</div>
			<div id="loginbox">
				<?php echo validation_errors(); ?>
				<h1>Sign In Form</h1>
				<div class="cleaner_h10"></div>
				<?php echo $this->session->flashdata('result_login'); ?>
				<?php echo form_open("app_login_user/index"); ?>
					<table border="0" style="border-collapse:collapse;" cellpadding="0" cellspacing="0">
						<tr><td><?php echo form_input($username,set_value('username')); ?></td></tr>
						<tr><td><?php echo form_input($password); ?></td></tr>
						<tr><td><?php echo $gbr_captcha; ?><?php echo form_input($captcha_login); ?></td></tr>
						<tr><td>
						<div class="cleaner_h5"></div>
						<?php echo form_dropdown('stts', $val_login, set_value('stts'),' class="chzn-select" style="width:345px;"'); ?>
						<div class="cleaner_h5"></div>
						</td></tr>
						<tr><td><input type="submit" value="Sign In" class="input-button" onclick="$.prettyLoader.show();" />
						<input type="reset" value="Empty" class="input-button" /></td></tr>
						<script type="text/javascript"> 
							$(".chzn-select").chosen();
						</script>
					</table>
				<?php echo form_close(); ?>
				<div class="cleaner_h10"></div>
			</div>
			<div id="signupbox">
				<?php echo validation_errors(); ?>
				<h1>Sign Up Form</h1>
				<div class="cleaner_h10"></div>
				<?php echo $this->session->flashdata('result_login'); ?>
				<?php echo form_open("app_register_user/index"); ?>
					<table border="0" style="border-collapse:collapse;" cellpadding="0" cellspacing="0">
						<tr><td>
						<input type="text" name="first_name" value="<?php echo set_value("first_name"); ?>" id="first_name" class="input-style1" 
						autocomplete="off" style="width:320px;" placeholder="Enter First Name"  />
						</td></tr>
						<tr><td>
						<input type="text" name="last_name" value="<?php echo set_value("last_name"); ?>" id="last_name" class="input-style1" 
						autocomplete="off" style="width:320px;" placeholder="Enter Last Name"  />
						</td></tr>
						<tr><td>
						<select name="gender"  class="chzn-select" style="width:345px;">
							<option value="" selected="selected">- Select Gender -</option>
							<option value="male">Male</option>
							<option value="female">Female</option>
						</select>
						</td></tr>
						<tr><td>
						<input type="text" name="birth" value="<?php echo set_value("birth"); ?>" id="birth" class="input-style1" 
						autocomplete="off" style="width:320px;" placeholder="Enter Date of Birth"  />
						</td></tr>
						<tr><td>
						<textarea name="address" cols="40" rows="10" id="address" type="text" class="textarea-style" 
						autocomplete="off" style="width:320px; height:60px;" placeholder="Enter Current Address" ><?php echo set_value("address"); ?></textarea>
						</td></tr>
						<tr><td>
						<input type="text" name="occupation" value="<?php echo set_value("occupation"); ?>" id="occupation" class="input-style1" 
						autocomplete="off" style="width:320px;" placeholder="Enter Occupation"  />
						</td></tr>
						<tr><td>
						<input type="text" name="organization" value="<?php echo set_value("organization"); ?>" id="organization" class="input-style1" 
						autocomplete="off" style="width:320px;" placeholder="Enter Organization"  />
						</td></tr>
						<tr><td>
						<input type="text" name="email" value="<?php echo set_value("email"); ?>" id="email" class="input-style1" 
						autocomplete="off" style="width:320px;" placeholder="Enter Email"  />
						</td></tr>
						<tr><td>
						<input type="text" name="phone_number" value="<?php echo set_value("phone_number"); ?>" id="phone_number" class="input-style1" 
						autocomplete="off" style="width:320px;" placeholder="Enter Phone Number"  />
						</td></tr>
						<tr><td>
						<input type="password" name="password" value="" id="password" class="input-style1" 
						autocomplete="off" style="width:320px;" placeholder="Enter Password"  />
						</td></tr>

						
						<tr><td><?php echo $gbr_captcha; ?><?php echo form_input($captcha_login); ?></td></tr>
						<tr><td><input type="submit" value="Sign Up" class="input-button" onclick="$.prettyLoader.show();" />
						<input type="reset" value="Empty" class="input-button" /></td></tr>
						<script type="text/javascript"> 
							$(".chzn-select").chosen();
						</script>
					</table>
				<?php echo form_close(); ?>
				<div class="cleaner_h10"></div>
			</div>
			<div id="title-right-content">ONLINE SUPPORT</div>
			<div class="cleaner_h5"></div>
			<div id="content-right-content">
			<table width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td valign="middle" align="center">
				<?php
					foreach($online->result_array() as $o)
					{
				?>
					<a href = 'ymsgr:sendim?<?php echo $o['online_support']; ?>'><img src="http://opi.yahoo.com/online?u=<?php echo $o['online_support']; ?>&amp;m=g&amp;t=1" border=0></a>
				<?php
					}
				?>
				</td>
			</tr>
			</table>
			</div>
			<div class="cleaner_h5"></div>
		</div>
	</div>
	<div class="cleaner_h10"></div>
	
	<div id="left-content">
	<h3>News and Information</h3>
	<div id="ticker">
	<div id="berita">
	<ul class="tick-ul">
		<?php
			foreach($berita->result_array() as $b)
			{
		?>
				<li class="tick-li">
					<h4><?php echo tgl_indo($b['tgl_post']).' - '.$b['tgl_post']; ?></h4>
					<h2><?php echo $b['judul']; ?></h2>
					<h5><img src="<?php echo base_url(); ?>asset/berita/<?php echo $b['gbr']; ?>" style="float:left; margin:5px 5px 0px 0px; width:150px;" /><?php echo substr($b['isi'],0,300); ?>[ <a href="<?php echo base_url(); ?>berita/detail/<?php echo $b['id_berita']; ?>" class="detail">Read More</a> ]</h5>
				</li> 
		<?php } ?>
	</ul>
	</div>
	</div>
	
	<div id="bg-ticker2"></div>

	</div>
	
	<div id="right-content">
	<h3>Official Admission Fee</h3>
	<div id="ticker2">
		<ul class="tick-ul">
		<?php
			foreach($info->result_array() as $i)
			{
		?>
			<div id="listticker2">
				<li class="tick-li">
					<h4><?php echo $i['waktu']; ?></h4>
					<h2><?php echo $i['judul']; ?></h2>
					<h5><?php echo $i['isi_info']; ?></h5>
				</li> 
		<?php } ?>
		</ul>
	</div>
	
	<div id="bg-ticker2"></div>

	</div>
	<div class="cleaner_h10"></div>
	
</div>
	<div class="cleaner_h30"></div>

<div id="footer">
	<div id="inner-footer">
	<p>Copyright © 2012 Corruption Reporting and Collaboration System - A Hack Again Corruption</p>
	<p>Corruption Reporting and Collaboration System.</p>
	</div>
</div>
</body>
</html>
