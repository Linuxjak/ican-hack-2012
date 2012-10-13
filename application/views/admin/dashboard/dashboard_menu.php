<div id="content" style="display:none;">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
	<td colspan="7"><h1>DASHBOARD MENU ADMINISTRATOR</h1></td>
</tr>
  <!--DWLayoutTable-->
  <tr>
    <td width="135" height="300" valign="top">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		  <!--DWLayoutTable-->
		  <tr>
			<td width="135" height="300" align="center" valign="middle">
			<a href="<?php echo base_url(); ?>admin_administrasi_system/" onclick="$.prettyLoader.show(1000);">
			<img src="<?php echo base_url(); ?>asset/images/icon/administration-icon.png" border="0"><div class="cleaner_h0"></div>
			ADMINISTRASI
			</a>
			</td>
		  </tr>
		</table>
	</td>
    <td width="135" height="300" valign="top">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		  <!--DWLayoutTable-->
		  <tr>
			<td width="135" height="300" align="center" valign="middle">
			<a href="<?php echo base_url(); ?>admin/pilih_menu/2" class="boxsubmenu" onclick="$.prettyLoader.show(1000);">
			<img src="<?php echo base_url(); ?>asset/images/icon/kepegawaian-icon.png" border="0"><div class="cleaner_h0"></div>
			KEPEGAWAIAN
			</a>
			</td>
		  </tr>
		</table>
	</td>
    <td width="135" height="300" valign="top">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		  <!--DWLayoutTable-->
		  <tr>
			<td width="135" height="300" align="center" valign="middle">
			<a href="<?php echo base_url(); ?>admin/pilih_menu/3" class="boxsubmenu" onclick="$.prettyLoader.show(1000);">
			<img src="<?php echo base_url(); ?>asset/images/icon/marketing-icon.png" border="0"><div class="cleaner_h0"></div>
			MARKETING
			</a>
			</td>
		  </tr>
		</table>
	</td>
    <td width="135" height="300" valign="top">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		  <!--DWLayoutTable-->
		  <tr>
			<td width="135" height="300" align="center" valign="middle">
			<a href="<?php echo base_url(); ?>admin/pilih_menu/4" class="boxsubmenu" onclick="$.prettyLoader.show(1000);">
			<img src="<?php echo base_url(); ?>asset/images/icon/guru-icon.png" border="0"><div class="cleaner_h0"></div>
			GURU DAN PELAJARAN
			</a>
			</td>
		  </tr>
		</table>
	</td>
    <td width="135" height="300" valign="top">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		  <!--DWLayoutTable-->
		  <tr>
			<td width="135" height="300" align="center" valign="middle">
			<a href="<?php echo base_url(); ?>admin/pilih_menu/5" class="boxsubmenu" onclick="$.prettyLoader.show(1000);">
			<img src="<?php echo base_url(); ?>asset/images/icon/kesiswaan-icon.png" border="0"><div class="cleaner_h0"></div>
			KESISWAAN
			</a>
			</td>
		  </tr>
		</table>
	</td>
    <td width="135" height="300" valign="top">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		  <!--DWLayoutTable-->
		  <tr>
			<td width="135" height="300" align="center" valign="middle">
			<a href="<?php echo base_url(); ?>admin/pilih_menu/6" class="boxsubmenu" onclick="$.prettyLoader.show(1000);">
			<img src="<?php echo base_url(); ?>asset/images/icon/learning-icon.png" border="0"><div class="cleaner_h0"></div>
			KEUANGAN
			</a>
			</td>
		  </tr>
		</table>
	</td>
    <td width="135" height="300" valign="top">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		  <!--DWLayoutTable-->
		  <tr>
			<td width="135" height="300" align="center" valign="middle">
			<a href="<?php echo base_url(); ?>admin/pilih_menu/7" class="boxsubmenu" onclick="$.prettyLoader.show(1000);">
			<img src="<?php echo base_url(); ?>asset/images/icon/jadwal-icon.png" border="0"><div class="cleaner_h0"></div>
			PENJADWALAN
			</a>
			</td>
		  </tr>
		</table>
	</td>
	</tr>
<tr>
	<td colspan="7" height="25" valign="middle" align="center"><h1>ONLINE SUPPORT</h1></td>
</tr>
<tr>
	<td colspan="7" height="75" valign="middle" align="center">
	<?php
		foreach($online->result_array() as $o)
		{
	?>
		<a href = 'ymsgr:sendim?<?php echo $o['online_support']; ?>'><img src="http://opi.yahoo.com/online?u=<?php echo $o['online_support']; ?>&amp;m=g&amp;t=2" border=0></a>
	<?php
		}
	?>
	</td>
</tr>
<tr>
	<td colspan="7"><h2><a href="<?php echo base_url(); ?>set_cabang/unset_data" onclick="$.prettyLoader.show();">Reset Data Cabang dan Departemen...???</a></h2></td>
</tr>
</table>
</div>