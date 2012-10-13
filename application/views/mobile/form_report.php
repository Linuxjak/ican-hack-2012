<!DOCTYPE html> 
<html> 
<head> 
	<title>Corruption Reporting and Collaboration System</title> 
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
	<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
</head> 
<body> 

<div data-role="page">

	<div data-role="header">
		<h1>Corruption Reporting and Collaboration System</h1>
		
		<a href="<?php echo base_url(); ?>mobile" data-icon="home" data-iconpos="notext" data-direction="reverse">Home</a>
		<a href="<?php echo base_url(); ?>mobile/search_news_splash" data-icon="search" data-iconpos="notext" data-rel="dialog" data-transition="fade">Search News Splash</a>
	</div>

	<div data-role="content">	
   <ul data-role="listview" data-inset="true" data-theme="c" data-dividertheme="a"> 
			<li data-role="list-divider">Report and Contact Us</li>
	</ul>
	<?php echo validation_errors(); ?>
	<?php echo $this->session->flashdata('result_report'); ?>
	
	<?php echo form_open_multipart("mobile/contact_us",' data-ajax="false"'); ?>
	<label for="full_name">Enter Full Name :</label>
	<input type="text" name="nama_lengkap" id="full_name" value="<?php echo set_value('nama_lengkap'); ?>" data-mini="true" />
	<label for="email">Enter Email :</label>
	<input type="text" name="email" id="email" value="<?php echo set_value('email'); ?>" data-mini="true" />
	<label for="phone_number">Enter Phone Number :</label>
	<input type="text" name="no_telp" id="phone_number" value="<?php echo set_value('no_telp'); ?>" data-mini="true" />
	<label for="userfile">Enter Phone Number :</label>
	<input type="file" name="userfile" id="userfile" data-mini="true" />
	<label for="isi_report">Enter Message :</label>
	<textarea name="isi_report" id="isi_report"><?php echo set_value('isi_report'); ?></textarea>
	<?php echo $gbr_captcha; ?>
	<label for="code">Enter Code :</label>
	<input type="text" name="captcha" id="code" value="" data-mini="true" />
	<button type="submit" data-theme="b" name="submit" value="submit-value">Send Report</button>
	<?php form_close(); ?>
	<script>

    var input = $("input:file").css({background:"silver", border:"2px black solid"});
	</script>
		<br>
	</div>
<footer data-role="footer" data-theme="a">
      <h1>Corruption Reporting and Collaboration System</h1>
   </footer>
</div>

</body>
</html>