<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sekolah Global Mandiri - Moving Forward With Global Mandiri School</title>
<link href="<?php echo base_url(); ?>asset/css/style-single-window.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>asset/css/chosen.css" rel="stylesheet" type="text/css">
<script>!window.jQuery && document.write('<script src="<?php echo base_url(); ?>asset/js/jquery.min.js"><\/script>');</script>
</head>

<body>
	<div id="content">
		<h1>User Management - Corruption Reporting and Collaboration System</h1>
		<div class="cleaner_h5"></div>
		<?php echo validation_errors(); ?>
		<div class="cleaner_h5"></div>
		<?php echo form_open("admin_administrasi_system_user/simpan"); ?>
		<table>
			<tr>
				<td>Privillage Access</td>
				<td width="10" align="center">:</td>
				<td>
					<select name="id_akses" class="chzn-select" style="width:300px;">
						<option value="">- Select -</option>
					<?php foreach($hak_akses->result_array() as $ha)
					{
						if($ha['id']==$id_akses)
						{
					?>
						<option value="<?php echo $ha['id']; ?>" selected="selected"><?php echo $ha['nama_jabatan']; ?></option>
					<?php
						}
						else
						{
					?>
						<option value="<?php echo $ha['id']; ?>"><?php echo $ha['nama_jabatan']; ?></option>
						<?php
						}
					}
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td width="170">User Full Name</td>
				<td width="10" align="center">:</td>
				<td><input type="text" name="nama" class="input-style1" style="width:300px;" value="<?php echo $nama; ?>" /></td>
			</tr>
			<tr>
				<td width="170">Username</td>
				<td width="10" align="center">:</td>
				<td><input type="text" name="user" class="input-style1" style="width:300px;" value="<?php echo $user; ?>" /></td>
			</tr>
			<tr>
				<td width="170">Password</td>
				<td width="10" align="center">:</td>
				<td><input type="text" name="password" class="input-style1" style="width:300px;" /> *</td>
			</tr>
			<tr>
				<td>Status</td>
				<td width="10" align="center">:</td>
				<td>
					<select name="stts" class="chzn-select" style="width:300px;">
						<?php
							$aktif = ''; $nonaktif = ''; $pilih='';
							if($stts=="1"){ $aktif = 'selected="selected"'; $nonaktif = ''; $pilih=''; }
							else if($stts=="0"){ $aktif = ''; $nonaktif = 'selected="selected"'; $pilih=''; }
							else{ $aktif = ''; $nonaktif = ''; $pilih='selected="selected"'; }
						?>
						<option value="" <?php echo $pilih; ?>>- Pilih -</option>
						<option value="1" <?php echo $aktif; ?>>Aktif</option>
						<option value="0" <?php echo $nonaktif; ?>>Tidak Aktif</option>
					</select>
				</td>
			</tr>
		</table>
			
			<script src="<?php echo base_url(); ?>asset/js/chosen.jquery.js" type="text/javascript"></script>
			<script type="text/javascript"> 
				$(".chzn-select").chosen();
			</script>
			<div class="cleaner_h5"></div>
			<?php
				if($st=="edit")
				{
					echo "*Empty the password if not change";
				}
			?>
			<div class="cleaner_h5"></div>
			<input type="hidden" name="st-input" value="<?php echo $st; ?>" />
			<input type="hidden" name="id" value="<?php echo $id; ?>" />
			<input type="submit" value="Send" class="input-button" /><input type="reset" value="Empty" class="input-button" />
		<?php echo form_close(); ?>
	</div>
</body>
</html>
