<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sekolah Global Mandiri - Moving Forward With Global Mandiri School</title>
<link href="<?php echo base_url(); ?>asset/css/style-single-window.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>asset/css/chosen.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>asset/js/redactor/redactor.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url(); ?>asset/js/redactor/jquery-1.7.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>asset/js/redactor/redactor.min.js" type="text/javascript"></script>
<script type="text/javascript"> 
	$(document).ready(
		function()
		{
			$('#isi_sekilas_info').redactor();
		}
	);
	</script>
</head>

<body>

<div id="content">
	<h1>News Splash - Corruption Reporting and Collaboration System</h1>
	<div class="cleaner_h5"></div>
	<?php echo validation_errors(); ?>
	<div class="cleaner_h5"></div>
	<?php echo form_open("admin_administrasi_system_sekilas_info/simpan"); ?>
	<table>
		<tr>
			<td width="80">Title</td>
			<td width="10" align="center">:</td>
			<td><input type="text" name="judul" class="input-style1" style="width:400px;" value="<?php echo $judul; ?>" /></td>
		</tr>
		<tr valign="top">
			<td width="80">Content</td>
			<td width="10" align="center">:</td>
			<td><textarea name="isi_sekilas_info" id="isi_sekilas_info"><?php echo $isi_info; ?></textarea></td>
		</tr>
		<tr valign="top">
			<td width="80"></td>
			<td width="10" align="center"></td>
			<td><input type="submit" value="Save" class="input-button" /><input type="reset" value="Reset" class="input-button" /></td>
		</tr>
	</table>
		
		<script src="<?php echo base_url(); ?>asset/js/chosen.jquery.js" type="text/javascript"></script>
		<script type="text/javascript"> 
			$(".chzn-select").chosen();
		</script>
		<input type="hidden" name="st-input" value="<?php echo $st; ?>" />
		<input type="hidden" name="id" value="<?php echo $kode_sekilas_info; ?>" />
	<?php echo form_close(); ?>
</div>
</body>
</html>