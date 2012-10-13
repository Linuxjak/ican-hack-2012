<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sekolah Global Mandiri - Moving Forward With Global Mandiri School</title>
<link href="<?php echo base_url(); ?>asset/css/style-single-window.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>asset/css/chosen.css" rel="stylesheet" type="text/css">
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.6/themes/redmond/jquery-ui.css" type="text/css" rel="stylesheet"/>	
<script>!window.jQuery && document.write('<script src="<?php echo base_url(); ?>asset/js/jquery.min.js"><\/script>');</script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/jquery-ui-1.7.2.custom.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
 
 $(".hapus").click(function(){
 var element = $(this);
 var del_id = element.attr("id");
 
 var info = 'id=' + del_id;
 if(confirm("Anda yakin akan menghapus?"))
 {
 $.ajax({
 type: "POST",
 url : "<?php echo base_url(); ?>tool_pendidikan/hapus",
 data: info,
 success: function(){
 }
 });
 
 $(this).parents(".record").animate({ opacity: "hide" }, "slow");
 
 }
 
 return false;
 
 });
 
})
</script>
</script>
</head>

<body>
	<div id="content">
		<h1>Pendidikan - Sistem Manajemen Sekolah Global Mandiri</h1>
		<?php echo form_open("tool_pendidikan/tambah"); ?>
		<input type="text" class="input-style1" style="width:250px;" name="nama" placeholder="Ketikkan nama pendidikan..." />
		<input type="submit" class="input-button" value="Tambah" />
		<?php echo form_close(); ?>
		<table width="100%" cellpadding="8" cellspacing="0" border="1" style="border-collapse:collapse;">
		<tr>
			<td>Pendidikan</td>
			<td>Aksi</td>
		</tr>
		<?php
			foreach($pendidikan->result_array() as $a)
			{
		?>
			<tr class="record">
				<td><?php echo $a['nama']; ?></td>
				<td><a class="hapus" id="<?php echo $a['id']; ?>" style="cursor:pointer;">Hapus</a></td>
			</tr>
		<?php
			}
		?>
		</table>
	</div>
</body>
</html>
