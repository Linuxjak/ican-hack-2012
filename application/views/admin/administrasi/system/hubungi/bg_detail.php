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
		<h1>Contact Management - Corruption Reporting and Collaboration System</h1>
		<div class="cleaner_h5"></div>
		<table width="100%" cellpadding="9" cellspacing="0">
			<tr>
				<td width="170">Name of Sender</td>
				<td width="10" align="center">:</td>
				<td><?php echo $nama_lengkap; ?></td>
			</tr>
			<tr>
				<td width="170">Email of Sender</td>
				<td width="10" align="center">:</td>
				<td><?php echo $email; ?></td>
			</tr>
			<tr>
				<td width="170">Phone Number of Sender</td>
				<td width="10" align="center">:</td>
				<td><?php echo $no_telp; ?></td>
			</tr>
			<tr>
				<td width="170" valign="top">Message</td>
				<td width="10" align="center">:</td>
				<td><?php echo $isi_report; ?></td>
			</tr>
		</table>
	</div>
</body>
</html>
