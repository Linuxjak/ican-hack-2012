<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sekolah Global Mandiri - Moving Forward With Global Mandiri School</title>
<link href="<?php echo base_url(); ?>asset/css/style-single-window.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>asset/css/chosen.css" rel="stylesheet" type="text/css">
<script>!window.jQuery && document.write('<script src="<?php echo base_url(); ?>asset/js/jquery.min.js"><\/script>');</script>
<link href="<?php echo base_url(); ?>asset/js/redactor/redactor.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url(); ?>asset/js/redactor/jquery-1.7.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>asset/js/redactor/redactor.min.js" type="text/javascript"></script>
<script type="text/javascript"> 
	$(document).ready(
		function()
		{
			$('#isi').redactor();
		}
	);
	</script>
</head>

<body>
	<div id="content">
		<h1>News - Corruption Reporting and Collaboration System</h1>
		<div class="cleaner_h5"></div>
		<?php echo validation_errors(); ?>
		<div class="cleaner_h5"></div>
		<?php echo $this->session->flashdata("hasil_departemen"); ?>
		<?php echo form_open_multipart("admin_administrasi_system_berita/simpan"); ?>
		<table>
			<tr>
				<td width="170">Title</td>
				<td width="10" align="center">:</td>
				<td><input type="text" name="judul" class="input-style1" style="width:500px;" value="<?php echo $judul; ?>" /></td>
			</tr>
			<tr valign="top">
				<td width="170">News</td>
				<td width="10" align="center">:</td>
				<td><textarea name="isi" class="textarea-style" style="width:700px; height:100px;" id="isi"><?php echo $isi; ?></textarea></td>
			</tr>
			<tr>
				<td width="170">Image</td>
				<td width="10" align="center">:</td>
				<td><input type="file" name="userfile" class="input-style1" /></td>
			</tr>
		</table>
			<input type="hidden" name="st-input" value="<?php echo $st; ?>" />
			<input type="hidden" name="gbr" value="<?php echo $gbr; ?>" />
			<input type="hidden" name="id" value="<?php echo $id_berita; ?>" />
			<input type="submit" value="Save" class="input-button" /><input type="reset" value="Empty" class="input-button" />
		<?php echo form_close(); ?>
	</div>
</body>
</html>
