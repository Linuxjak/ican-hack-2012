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
			<li data-role="list-divider">List of Corruption Feed</li>
	</ul>
	<div data-role="collapsible-set" data-theme="a" data-content-theme="c">
   	<?php
	foreach($korupsi->result_array() as $i)
	{

		echo '<div data-role="collapsible">
		<h3>'.substr($i['isi_report'],0,50).'</h3>
		<p>
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr><td><img src="'.base_url().'asset/corruption/medium/'.$i['gambar'].'" style="width:100%;"></td></tr>
			<tr><td>'.$i['isi_report'].'</td></tr>
		</table>
		</p>
		</div>';
	}
	?>
	</div>
	<br> 
	</div>
<footer data-role="footer" data-theme="a">
      <h1>Corruption Reporting and Collaboration System</h1>
   </footer>
</div>

</body>
</html>