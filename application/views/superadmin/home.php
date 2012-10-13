<script>
$(function(){
	$("a.hapus").click(function(){
	if(confirm("Anda yakin akan menghapus?"))
	{
		id_array=new Array()
		i=0;
		$("input.chk:checked").each(function(){
			id_array[i]=$(this).val();
			i++;
		})

		$.ajax({
			url:'<?php echo base_url(); ?>superadmin/hapus',
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
		<li><a href="<?php echo base_url(); ?>">Superadmin</a></li>
		<li><a href="<?php echo base_url(); ?>/superadmin">Manajemen Online Support</a></li>
	</ul>
</div>
<div class="cleaner_h10"></div>
	<table border="1" cellpadding="3" cellspacing="0" style="border-collapse:collapse" width="100%">
		<tr style="background-color:#333; text-align:center; color:#FFFFFF;">
			<td width="10">No.</td>
			<td>ID Online Support</td>
			<td>Status</td>
			<td width="150">
			<a href="<?php echo base_url(); ?>superadmin/tambah" class="boxsuperadmin" onclick="$.prettyLoader.show(1000);"><div class="btn-add">Tambah
			</div></a>
			<a href="<?php echo base_url(); ?>superadmin/cetak" target="_blank" onclick="$.prettyLoader.show(1000);"><div class="btn-print">Cetak</div></a>
			</td>
		</tr>
<?php
	$no=1;
	foreach($online_support->result_array() as $dd)
	{
?>
		<tr>
			<td><?php echo $no; ?></td>
			<td><?php echo $dd['online_support']; ?></td>
			<td align="center">
			<a href = 'ymsgr:sendim?<?php echo $dd['online_support']; ?>'><img src="http://opi.yahoo.com/online?u=<?php echo $dd['online_support']; ?>&amp;m=g&amp;t=2" border="0" title="<?php echo $dd['online_support']; ?>"></a>
			</td>
			<td>
			<a href="<?php echo base_url(); ?>superadmin/edit/<?php echo $dd['id_online_support']; ?>" class="boxsuperadmin" onclick="$.prettyLoader.show(1000);"><div 
			class="btn-edit">Edit Data</div></a>
			<input type="checkbox" name="chk[]" id="chk-<?php echo $no; ?>" class="chk" value="<?php echo $dd['id_online_support']; ?>" />
			</td>
		</tr>
<?php
	$no++;
	}
?>
	<tr><td colspan="4" align="right">
	<input type=radio id=pilih name="pilih" onClick='for (i=1;i<<?php echo $no; ?>;i++){document.getElementById("chk-"+i).checked=true;}'><label for="pilih">Check All</label>
	<input type=radio id=nopilih name="pilih" onClick='for (i=1;i<<?php echo $no; ?>;i++){document.getElementById("chk-"+i).checked=false;}'><label for="nopilih">Uncheck All</label>
	<a href="#" class="hapus">
	<div class="btn-delete">Hapus Data</div></a></td></tr>
	</table>
</div>
<div class="cleaner_h60"></div>
<div class="cleaner_h60"></div>
