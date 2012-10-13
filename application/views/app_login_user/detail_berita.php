<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="description" content="<?php echo $konten; ?>" />
<title>Sekolah Global Mandiri - Moving Forward With Global Mandiri School</title>
<link href="<?php echo base_url(); ?>asset/css/style-single-window.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<div id="content">
		<?php
			foreach($berita->result_array() as $i)
			{
		?>
				<h2><?php echo $i['judul']; ?></h2>
				<h4> | <?php echo tgl_indo($i['tgl_post']).' - '.$i['tgl_post']; ?>
				<!-- AddThis Button BEGIN -->
				<div class="addthis_toolbox addthis_default_style " style="float:left; width:150px;">
				<a class="addthis_button_preferred_1"></a>
				<a class="addthis_button_preferred_2"></a>
				<a class="addthis_button_preferred_3"></a>
				<a class="addthis_button_preferred_4"></a>
				<a class="addthis_button_compact"></a>
				<a class="addthis_counter addthis_bubble_style"></a>
				</div>
				<script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=xa-507104674c0150fa"></script>
				<!-- AddThis Button END -->
				</h4>
				<div class="cleaner_h5"></div>
				<img src="<?php echo base_url(); ?>asset/berita/<?php echo $i['gbr']; ?>" style="float:left; width:400px; margin:8px;" />
				<?php echo nl2br($i['isi']); ?>
		<?php } ?>
	</div>
</body>
</html>
