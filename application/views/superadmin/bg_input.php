<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sekolah Global Mandiri - Moving Forward With Global Mandiri School</title>
<link href="<?php echo base_url(); ?>asset/css/style-single-window.css" rel="stylesheet" type="text/css" />

</head>

<body>
	<div id="content">
		<h1>Online Support - Sistem Manajemen Sekolah Global Mandiri</h1>
		<?php echo validation_errors(); ?>
		<?php echo form_open("superadmin/simpan"); ?>
		<input type="text" class="input-style1" style="width:350px;" name="online_support" placeholder="Ketikkan id online support..." value="<?php echo $online_support; ?>" />
		<input type="submit" class="input-button" value="Tambah" />
		<input type="hidden" name="st-input" value="<?php echo $st; ?>" />
		<input type="hidden" name="id" value="<?php echo $id; ?>" />
		<?php echo form_close(); ?>
	</div>
</body>
</html>
