<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	
	<title>Login Super Admin</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/style-login-superadmin.css" />
</head>

<body>

	<?php echo form_open("superadmin"); ?>
		<fieldset>
		
			<legend>Log in</legend>
			
			<label for="login">Username : </label>
			<?php echo form_input($username); ?>
			<div class="clear"></div>
			
			<label for="password">Password : </label>
			<?php echo form_input($password); ?>
			<div class="clear"></div>
			
			<label for="password">Captcha : </label>
			<?php echo form_input($captcha); ?>
			<?php echo $gbr_captcha; ?>
			<div class="clear"></div>
			
			<input type="submit" class="button" name="commit" value="Log in"/>	
			<input type="reset" class="button" name="commit" value="Hapus"/>	
		</fieldset>
	<?php echo form_close(); ?>
	<div style="width:400px; margin:0px auto; padding-top:20px; font-weight:bold;"><?php echo validation_errors(); ?></div>
	<div style="width:400px; margin:0px auto; padding-top:20px; font-weight:bold;"><?php echo $this->session->flashdata('result_login'); ?></div>
	
</body>

</html>