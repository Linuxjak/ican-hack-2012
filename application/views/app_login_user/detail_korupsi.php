<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sekolah Global Mandiri - Moving Forward With Global Mandiri School</title>
<link href="<?php echo base_url(); ?>asset/css/style-single-window.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<div id="content">
		<?php
			foreach($report->result_array() as $i)
			{
		?>
				<p align="center"><img src="<?php echo base_url(); ?>asset/corruption/medium/<?php echo $i['gambar']; ?>" style="float:none; margin:5px;" /></p>
				<div class="cleaner_h10"></div>
				<?php echo $i['isi_report']; ?>
		<?php } ?>
	</div>
</body>
</html>
