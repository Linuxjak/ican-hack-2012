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

	<div data-role="content">	
   <ul data-role="listview" data-theme="a" data-divider-theme="a" data-filter="true" data-filter-theme="a" data-filter-placeholder="Search news splash...">
   	<?php
	foreach($info->result_array() as $i)
	{

		?>
		<li data-filtertext="<?php echo $i['judul']; ?>">
			<a href="<?php echo base_url(); ?>mobile/detail_news_splash/<?php echo $i['kode_sekilas_info']; ?>"><?php echo $i['judul']; ?></a>
		</li>
		<?php
	}
	?>
</ul>
   </div>
</div>

</body>
</html>