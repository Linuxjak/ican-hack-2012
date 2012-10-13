<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sekolah Global Mandiri - Moving Forward With Global Mandiri School</title>
<link href="<?php echo base_url(); ?>asset/css/style-single-window.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<div id="content">
		<h1>Lupa Password - Sistem Informasi Sekolah Global Mandiri</h1>
		<div class="cleaner_h5"></div>
		<?php echo validation_errors(); ?>
		<?php echo $this->session->flashdata('result_login'); ?>
		<div class="cleaner_h5"></div>
		<?php echo form_open("app_login_user/reset_pass/".$st."/".$kode.""); ?>
			<?php echo form_input($password,set_value('password')); ?>
			<input type="hidden" name="st" value="<?php echo $st; ?>" />
			<input type="hidden" name="email" value="<?php echo $email; ?>" />
			<input type="submit" value="Reset Password" class="input-button" /><input type="reset" value="Kosongkan" class="input-button" />
		<?php echo form_close(); ?>
	</div>
</body>
</html>
