<script>
$(function(){
	$("a.hapus").click(function(){
	if(confirm("Are you sure?"))
	{
		id_array=new Array()
		i=0;
		$("input.chk:checked").each(function(){
			id_array[i]=$(this).val();
			i++;
		})

		$.ajax({
			url:'<?php echo base_url(); ?>admin_administrasi_system_hubungi/hapus',
			data:"kode="+id_array,
			type:"POST",
			success:function(respon)
			{
				if(respon==1)
				{
					$("input.chk:checked").each(function(){
						$(this).parent().parent().remove('.chk').animate({ opacity: "hide" }, "slow");
					})
				}
			}
		})
	}
		return false;
	})
})
</script>
<div id="content">
<div style="width:100%; float:left;">
	<ul id="crumbs">
		<li><a href="<?php echo base_url(); ?>">Dashboard</a></li>
		<li><a href="<?php echo base_url(); ?>admin_administrasi_system_hubungi/">Contact Management</a></li>
	</ul>
</div>
<div class="cleaner_h10"></div>
	<table border="1" cellpadding="3" cellspacing="0" style="border-collapse:collapse" width="100%">
		<tr style="background-color:#333; text-align:center; color:#FFFFFF;">
			<td width="10">No.</td>
			<td>Name of Sender</td>
			<td>Email of Sender</td>
			<td>Phone Number of Sender</td>
			<td width="120"></td>
		</tr>
<?php
	$no=1;
	foreach($dt_hubungi->result_array() as $dd)
	{
?>
		<tr>
			<td><?php echo $no; ?></td>
			<td><?php echo $dd['nama_lengkap']; ?></td>
			<td><?php echo $dd['email']; ?></td>
			<td><?php echo $dd['no_telp']; ?></td>
			<td>
			<a href="<?php echo base_url(); ?>admin_administrasi_system_hubungi/detail/<?php echo $dd['kode_report']; ?>" class="boxdepartemen" 
			onclick="$.prettyLoader.show(1000);"><div class="btn-view">Detail Data</div></a>
			<input type="checkbox" name="chk[]" id="chk-<?php echo $no; ?>" class="chk" value="<?php echo $dd['kode_report']; ?>" />
			</td>
		</tr>
<?php
	$no++;
	}
	echo $paginator; 
?>
	<tr><td colspan="6" align="right">
	<input type=radio id=pilih name="pilih" onClick='for (i=1;i<<?php echo $no; ?>;i++){document.getElementById("chk-"+i).checked=true;}'><label for="pilih">Check All</label>
	<input type=radio id=nopilih name="pilih" onClick='for (i=1;i<<?php echo $no; ?>;i++){document.getElementById("chk-"+i).checked=false;}'><label for="nopilih">Uncheck All</label>
	<a href="#" class="hapus">
	<div class="btn-delete">Delete Data</div></a></td></tr>
	</table>
</div>
<div class="cleaner_h60"></div>
<div class="cleaner_h60"></div>

