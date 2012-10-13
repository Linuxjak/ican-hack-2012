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
			<li data-role="list-divider">Welcome, guest.</li>
	</ul>
	<?php if($this->session->flashdata('result_report')!="") { ?>
	<ul data-role="listview" data-inset="true" data-theme="c" data-dividertheme="a"> 
			<li data-role="list-divider"><?php echo $this->session->flashdata('result_report'); ?></li>
	</ul>
	<?php } ?>
	
	<br> 
	<ul data-role="listview" data-theme="a"> 
		<li><a href="<?php echo base_url(); ?>mobile/news_splash"> 
		<img src="<?php echo base_url(); ?>asset/images/rangking.png" /> 
		<h5>Official Admission Fee</h5> 
		<p>Latest Information About Enforcement Corruption Cases</p> 
		</a>
		</li>
		<li><a href="<?php echo base_url(); ?>mobile/contact_us"> 
		<img src="<?php echo base_url(); ?>asset/images/krs.png" /> 
		<h6>Report Us</h6> 
		<p>Report Cases of Corruption That You Find</p> 
		</a>
		</li>
		<li><a href="<?php echo base_url(); ?>mobile/korupsi"> 
		<img src="<?php echo base_url(); ?>asset/images/trans-nilai.png" /> 
		<h6>Corruption Feed</h6> 
		<p>List of Corruption Feed Report from User</p> 
		</a>
		</li>
		<li><a href="<?php echo base_url(); ?>mobile/berita"> 
		<img src="<?php echo base_url(); ?>asset/images/khs.png" /> 
		<h6>News and Information</h6> 
		<p>Latest News About Enforcement Corruption Cases</p> 
		</a>
		</li>
	</ul>
	<br>
	</div>
<footer data-role="footer" data-theme="a">
      <h1>Corruption Reporting and Collaboration System</h1>
   </footer>
</div>

</body>
</html>