<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tool_Combo extends CI_Controller {

	/**
	 * @author : Gede Lumbung
	 * @web : http://gedelumbung.com
	 * @keterangan : Controller untuk manajemen data combobox ajax
	 **/
	 
	public function index()
	{
		$sess_log['last_form_login'] = "signup";
		$this->session->set_userdata($sess_log);
		$cek = $this->session->userdata('logged_in');
		$st = $this->session->userdata('stts');
		if(!empty($cek))
		{
			header('location:'.base_url().'');
		}
		else
		{
			if($st=='admin')
			{
				header('location:'.base_url().'admin');
			}
			else if($st=='pegawai akademis')
			{
				header('location:'.base_url().'pegawai_akademis');
			}
			else if($st=='pegawai non akademis')
			{
				header('location:'.base_url().'pegawai_non_akademis');
			}
			else if($st=='siswa')
			{
				header('location:'.base_url().'siswa');
			}
			else if($st=='hrd')
			{
				header('location:'.base_url().'hrd');
			}
			else
			{
				header('location:'.base_url().'');
			}
		}
	}
	 
	public function combo_pilih_cabang_with_select()
	{
		$sess_log['last_form_login'] = "signup";
		$this->session->set_userdata($sess_log);
		$cek = $this->session->userdata('logged_in');
		$st = $this->session->userdata('stts');
		if(!empty($cek))
		{
			$id['id_cabang'] = $_GET['kode_cabang'];
			$dt_departemen = $this->db->get_where("departemen",$id);
			?>
			<select data-placeholder="Cari departemen..." class="chzn-select2" style="width:400px;" tabindex="2" name="kode_departemen" id="kode_departemen">
			<option value=""></option> 
				<?php
					foreach($dt_departemen->result() as $dp)
					{
				?>
					<option value="<?php echo $dp->id; ?>"><?php echo $dp->departemen; ?></option>
				<?php
					}
				?>
			</select>
			<script type="text/javascript">$(".chzn-select2").chosen();</script>
			<div class="cleaner_h10"></div>
			<?php
		}
		else
		{
			if($st=='admin')
			{
				header('location:'.base_url().'admin');
			}
			else if($st=='pegawai akademis')
			{
				header('location:'.base_url().'pegawai_akademis');
			}
			else if($st=='pegawai non akademis')
			{
				header('location:'.base_url().'pegawai_non_akademis');
			}
			else if($st=='siswa')
			{
				header('location:'.base_url().'siswa');
			}
			else if($st=='hrd')
			{
				header('location:'.base_url().'hrd');
			}
			else
			{
				header('location:'.base_url().'');
			}
		}
	}
	 
	public function combo_data_siswa_set_wali_kelas()
	{
		$sess_log['last_form_login'] = "signup";
		$this->session->set_userdata($sess_log);
		$cek = $this->session->userdata('logged_in');
		$st = $this->session->userdata('stts');
		if(!empty($cek))
		{
			$sess_data['id_departemen2'] = $_GET['kode_departemen'];
			$this->session->set_userdata($sess_data);
			
			$id['id_departemen'] = $this->session->userdata("id_departemen2");
			$pegawai = $this->db->query("select * from pegawai a left join tbl_jabatan_pegawai b on a.id_jabatan=b.id_jabatan_pegawai where b.nama_jabatan_pegawai='Wali Kelas' 
			and a.bagian='akademik' and a.id_departemen='".$id['id_departemen']."'");
			?>
			
			<div style="width:190px; float:left;">Wali Kelas</div> :
			<select data-placeholder="Pilih Wali Kelas..." class="chzn-select-wali" style="width:300px;" tabindex="2" name="nik" id="nik">
				<option value=""></option> 
					<?php
						foreach($pegawai->result_array() as $p)
						{
							?>
								<option value="<?php echo $p['NIP']; ?>"><?php echo $p['Nama']; ?></option>
							<?php
						}
					?>
			</select>
			<script type="text/javascript">
				$(".chzn-select-wali").chosen().change(function(){ 
					var kode_departemen = $("#kode_departemen").val(); 
					$.ajax({ 
					url: "<?php echo base_url(); ?>tool_combo/combo_data_siswa_set_departemen", 
					data: "kode_departemen="+kode_departemen, 
					cache: false, 
					success: function(msg){ 
					$("#datatahunajaran").empty(); 
					$("#datatingkat").empty(); 
					$("#datatahunajaran").html(msg); 
				} 
				})
				});
			</script>
			<div class="cleaner_h10"></div>
			<?php
		}
		else
		{
			if($st=='admin')
			{
				header('location:'.base_url().'admin');
			}
			else if($st=='pegawai akademis')
			{
				header('location:'.base_url().'pegawai_akademis');
			}
			else if($st=='pegawai non akademis')
			{
				header('location:'.base_url().'pegawai_non_akademis');
			}
			else if($st=='siswa')
			{
				header('location:'.base_url().'siswa');
			}
			else if($st=='hrd')
			{
				header('location:'.base_url().'hrd');
			}
			else
			{
				header('location:'.base_url().'');
			}
		}
	}
	 
	public function combo_data_siswa_set_tahun_ajaran()
	{
		$sess_log['last_form_login'] = "signup";
		$this->session->set_userdata($sess_log);
		$cek = $this->session->userdata('logged_in');
		$st = $this->session->userdata('stts');
		if(!empty($cek))
		{
			$sess_data['id_tahun_ajaran'] = $_GET['kode_tahun_ajaran'];
			$this->session->set_userdata($sess_data);
			
			$id['id_departemen'] = $this->session->userdata("id_departemen");
			$tingkat = $this->db->get_where("tingkat",$id);
			?>
			
			<div style="width:190px; float:left;">Tingkat</div> :
			<select data-placeholder="- Pilih -" class="chzn-select2" style="width:200px;" tabindex="2" name="kode_tingkat" id="kode_tingkat">
				<option value=""></option> 
					<?php
						foreach($tingkat->result() as $t)
						{
							?>
								<option value="<?php echo $t->id; ?>"><?php echo $t->tingkat; ?></option>
							<?php
						}
					?>
			</select>
			<script type="text/javascript"> 
				
				$(".chzn-select2").chosen().change(function(){ 
					var kode_tingkat = $("#kode_tingkat").val(); 
					$.ajax({ 
					url: "<?php echo base_url(); ?>tool_combo/combo_data_siswa_set_tingkat", 
					data: "kode_tingkat="+kode_tingkat, 
					cache: false, 
					success: function(msg){ 
					$("#datakelas").empty(); 
					$("#datakelas").html(msg); 
				} 
				})
				});
			</script>
			<div class="cleaner_h10"></div>
			<?php
		}
		else
		{
			if($st=='admin')
			{
				header('location:'.base_url().'admin');
			}
			else if($st=='pegawai akademis')
			{
				header('location:'.base_url().'pegawai_akademis');
			}
			else if($st=='pegawai non akademis')
			{
				header('location:'.base_url().'pegawai_non_akademis');
			}
			else if($st=='siswa')
			{
				header('location:'.base_url().'siswa');
			}
			else if($st=='hrd')
			{
				header('location:'.base_url().'hrd');
			}
			else
			{
				header('location:'.base_url().'');
			}
		}
	}
	 
	public function combo_data_siswa_set_tahun_ajaran_sekretaris()
	{
		$sess_log['last_form_login'] = "signup";
		$this->session->set_userdata($sess_log);
		$cek = $this->session->userdata('logged_in');
		$st = $this->session->userdata('stts');
		if(!empty($cek))
		{
			$sess_data['id_tahun_ajaran'] = $_GET['kode_tahun_ajaran'];
			$this->session->set_userdata($sess_data);
			
			$id['id_departemen'] = $this->session->userdata("id_departemen_login");
			$tingkat = $this->db->get_where("tingkat",$id);
			?>
			
			<div style="width:190px; float:left;">Tingkat</div> :
			<select data-placeholder="- Pilih -" class="chzn-select2" style="width:200px;" tabindex="2" name="kode_tingkat" id="kode_tingkat">
				<option value=""></option> 
					<?php
						foreach($tingkat->result() as $t)
						{
							?>
								<option value="<?php echo $t->id; ?>"><?php echo $t->tingkat; ?></option>
							<?php
						}
					?>
			</select>
			<script type="text/javascript"> 
				
				$(".chzn-select2").chosen().change(function(){ 
					var kode_tingkat = $("#kode_tingkat").val(); 
					$.ajax({ 
					url: "<?php echo base_url(); ?>tool_combo/combo_data_siswa_set_tingkat_sekretaris", 
					data: "kode_tingkat="+kode_tingkat, 
					cache: false, 
					success: function(msg){ 
					$("#datakelas").empty(); 
					$("#datakelas").html(msg); 
				} 
				})
				});
			</script>
			<div class="cleaner_h10"></div>
			<?php
		}
		else
		{
			if($st=='admin')
			{
				header('location:'.base_url().'admin');
			}
			else if($st=='pegawai akademis')
			{
				header('location:'.base_url().'pegawai_akademis');
			}
			else if($st=='pegawai non akademis')
			{
				header('location:'.base_url().'pegawai_non_akademis');
			}
			else if($st=='siswa')
			{
				header('location:'.base_url().'siswa');
			}
			else if($st=='hrd')
			{
				header('location:'.base_url().'hrd');
			}
			else
			{
				header('location:'.base_url().'');
			}
		}
	}
	 
	public function combo_data_siswa_set_tahun_ajaran_no_title()
	{
		$sess_log['last_form_login'] = "signup";
		$this->session->set_userdata($sess_log);
		$cek = $this->session->userdata('logged_in');
		$st = $this->session->userdata('stts');
		if(!empty($cek))
		{
			$sess_data['id_tahun_ajaran2'] = $_GET['kode_tahun_ajaran'];
			$this->session->set_userdata($sess_data);
			
			$id['id_departemen'] = $this->session->userdata("id_departemen2");
			$tingkat = $this->db->get_where("tingkat",$id);
			?>
			
			<select data-placeholder="- Pilih -" class="chzn-select2" style="width:200px;" tabindex="2" name="kode_tingkat" id="kode_tingkat">
				<option value=""></option> 
					<?php
						foreach($tingkat->result() as $t)
						{
							?>
								<option value="<?php echo $t->id; ?>"><?php echo $t->tingkat; ?></option>
							<?php
						}
					?>
			</select>
			<script type="text/javascript"> 
				
				$(".chzn-select2").chosen().change(function(){ 
					var kode_tingkat = $("#kode_tingkat").val(); 
					$.ajax({ 
					url: "<?php echo base_url(); ?>tool_combo/combo_data_siswa_set_tingkat_no_title", 
					data: "kode_tingkat="+kode_tingkat, 
					cache: false, 
					success: function(msg){ 
					$(".datakelas").empty(); 
					$(".datakelas").html(msg); 
				} 
				})
				});
			</script>
			<div class="cleaner_h10"></div>
			<?php
		}
		else
		{
			if($st=='admin')
			{
				header('location:'.base_url().'admin');
			}
			else if($st=='pegawai akademis')
			{
				header('location:'.base_url().'pegawai_akademis');
			}
			else if($st=='pegawai non akademis')
			{
				header('location:'.base_url().'pegawai_non_akademis');
			}
			else if($st=='siswa')
			{
				header('location:'.base_url().'siswa');
			}
			else if($st=='hrd')
			{
				header('location:'.base_url().'hrd');
			}
			else
			{
				header('location:'.base_url().'');
			}
		}
	}
	 
	public function combo_data_siswa_set_tingkat()
	{
		$sess_log['last_form_login'] = "signup";
		$this->session->set_userdata($sess_log);
		$cek = $this->session->userdata('logged_in');
		$st = $this->session->userdata('stts');
		if(!empty($cek))
		{
			$sess_data['id_tingkat'] = $_GET['kode_tingkat'];
			$this->session->set_userdata($sess_data);
			
			$id['id_tingkat'] = $this->session->userdata("id_tingkat");
			$id['id_departemen'] = $this->session->userdata("id_departemen");
			$id['id_tahun_ajaran'] = $this->session->userdata("id_tahun_ajaran");
			$dt_kelas = $this->db->get_where("kelas",$id);
			?>
			
			<div style="width:190px; float:left;">Kelas</div> : 
			<select data-placeholder="Cari Kelas..." class="chzn-select3" style="width:200px;" tabindex="2" name="kode_kelas" id="kode_kelas">
			<option value=""></option> 
				<?php
					foreach($dt_kelas->result() as $dk)
					{
				?>
					<option value="<?php echo $dk->id; ?>"><?php echo $dk->kelas; ?></option>
				<?php
					}
				?>
			</select>
			<script type="text/javascript"> 
				$(".chzn-select3").chosen().change(function(){ 
					document.forms["frm_siswa"].submit();
				});
			</script>
			<div class="cleaner_h10"></div>
			<?php
		}
		else
		{
			if($st=='admin')
			{
				header('location:'.base_url().'admin');
			}
			else if($st=='pegawai akademis')
			{
				header('location:'.base_url().'pegawai_akademis');
			}
			else if($st=='pegawai non akademis')
			{
				header('location:'.base_url().'pegawai_non_akademis');
			}
			else if($st=='siswa')
			{
				header('location:'.base_url().'siswa');
			}
			else if($st=='hrd')
			{
				header('location:'.base_url().'hrd');
			}
			else
			{
				header('location:'.base_url().'');
			}
		}
	}
	 
	public function combo_data_siswa_set_tingkat_sekretaris()
	{
		$sess_log['last_form_login'] = "signup";
		$this->session->set_userdata($sess_log);
		$cek = $this->session->userdata('logged_in');
		$st = $this->session->userdata('stts');
		if(!empty($cek))
		{
			$sess_data['id_tingkat'] = $_GET['kode_tingkat'];
			$this->session->set_userdata($sess_data);
			
			$id['id_tingkat'] = $this->session->userdata("id_tingkat");
			$id['id_departemen'] = $this->session->userdata("id_departemen_login");
			$id['id_tahun_ajaran'] = $this->session->userdata("id_tahun_ajaran");
			$dt_kelas = $this->db->get_where("kelas",$id);
			?>
			
			<div style="width:190px; float:left;">Kelas</div> : 
			<select data-placeholder="Cari Kelas..." class="chzn-select3" style="width:200px;" tabindex="2" name="kode_kelas" id="kode_kelas">
			<option value=""></option> 
				<?php
					foreach($dt_kelas->result() as $dk)
					{
				?>
					<option value="<?php echo $dk->id; ?>"><?php echo $dk->kelas; ?></option>
				<?php
					}
				?>
			</select>
			<script type="text/javascript"> 
				$(".chzn-select3").chosen().change(function(){ 
					document.forms["frm_siswa"].submit();
				});
			</script>
			<div class="cleaner_h10"></div>
			<?php
		}
		else
		{
			if($st=='admin')
			{
				header('location:'.base_url().'admin');
			}
			else if($st=='pegawai akademis')
			{
				header('location:'.base_url().'pegawai_akademis');
			}
			else if($st=='pegawai non akademis')
			{
				header('location:'.base_url().'pegawai_non_akademis');
			}
			else if($st=='siswa')
			{
				header('location:'.base_url().'siswa');
			}
			else if($st=='hrd')
			{
				header('location:'.base_url().'hrd');
			}
			else
			{
				header('location:'.base_url().'');
			}
		}
	}
	 
	public function combo_data_siswa_set_tingkat_no_title()
	{
		$sess_log['last_form_login'] = "signup";
		$this->session->set_userdata($sess_log);
		$cek = $this->session->userdata('logged_in');
		$st = $this->session->userdata('stts');
		if(!empty($cek))
		{
			$sess_data['id_tingkat2'] = $_GET['kode_tingkat'];
			$this->session->set_userdata($sess_data);
			
			$id['id_tingkat'] = $this->session->userdata("id_tingkat2");
			$id['id_departemen'] = $this->session->userdata("id_departemen2");
			$id['id_tahun_ajaran'] = $this->session->userdata("id_tahun_ajaran2");
			$dt_kelas = $this->db->get_where("kelas",$id);
			?>
			
			<select data-placeholder="Cari Kelas..." class="chzn-select3" style="width:200px;" tabindex="2" name="kode_kelas" id="kode_kelas">
			<option value=""></option> 
				<?php
					foreach($dt_kelas->result() as $dk)
					{
				?>
					<option value="<?php echo $dk->id; ?>"><?php echo $dk->kelas; ?></option>
				<?php
					}
				?>
			</select>
			<script type="text/javascript"> 
				$(".chzn-select3").chosen().change(function(){ 
					document.forms["frm_siswa"].submit();
				});
			</script>
			<div class="cleaner_h10"></div>
			<?php
		}
		else
		{
			if($st=='admin')
			{
				header('location:'.base_url().'admin');
			}
			else if($st=='pegawai akademis')
			{
				header('location:'.base_url().'pegawai_akademis');
			}
			else if($st=='pegawai non akademis')
			{
				header('location:'.base_url().'pegawai_non_akademis');
			}
			else if($st=='siswa')
			{
				header('location:'.base_url().'siswa');
			}
			else if($st=='hrd')
			{
				header('location:'.base_url().'hrd');
			}
			else
			{
				header('location:'.base_url().'');
			}
		}
	}
	 
	public function combo_data_siswa_set_departemen()
	{
		$sess_log['last_form_login'] = "signup";
		$this->session->set_userdata($sess_log);
		$cek = $this->session->userdata('logged_in');
		$st = $this->session->userdata('stts');
		if(!empty($cek))
		{
			$sess_data['id_departemen'] = $_GET['kode_departemen'];
			$this->session->set_userdata($sess_data);
			
			$id['id_departemen'] = $this->session->userdata("id_departemen");
			$dt_kelas = $this->db->get_where("kelas",$id);
			$tahun_ajaran = $this->db->get_where("tahunajaran",array('id_departemen' => $id['id_departemen']));
			$tingkat = $this->db->get_where("tingkat",array('id_departemen' => $id['id_departemen']));
			$dt_kelas = $this->db->get_where("kelas",$id);
			?>
			
			<div style="width:190px; float:left;">Tahun Ajaran</div> : 
			<select data-placeholder="- Pilih -" class="chzn-select8" style="width:200px;" tabindex="2" name="kode_tahun_ajaran" id="kode_tahun_ajaran">
				<option value=""></option> 
					<?php
						foreach($tahun_ajaran->result() as $ta)
						{
							?>
								<option value="<?php echo $ta->id; ?>"><?php echo $ta->tahunAjaran; ?></option>
							<?php
						}
					?>
			</select>
			<script type="text/javascript"> 
			
				$(".chzn-select8").chosen().change(function(){ 
					var kode_tahun_ajaran = $("#kode_tahun_ajaran").val(); 
					$.ajax({ 
					url: "<?php echo base_url(); ?>tool_combo/combo_data_siswa_set_tahun_ajaran", 
					data: "kode_tahun_ajaran="+kode_tahun_ajaran, 
					cache: false, 
					success: function(msg){ 
					$("#datatingkat").empty(); 
					$("#datatingkat").html(msg); 
					$("#datakelas").empty(); 
				} 
				})
				});
			</script>
			<div class="cleaner_h10"></div>
			<?php
		}
		else
		{
			if($st=='admin')
			{
				header('location:'.base_url().'admin');
			}
			else if($st=='pegawai akademis')
			{
				header('location:'.base_url().'pegawai_akademis');
			}
			else if($st=='pegawai non akademis')
			{
				header('location:'.base_url().'pegawai_non_akademis');
			}
			else if($st=='siswa')
			{
				header('location:'.base_url().'siswa');
			}
			else if($st=='hrd')
			{
				header('location:'.base_url().'hrd');
			}
			else
			{
				header('location:'.base_url().'');
			}
		}
	}
	 
	public function combo_data_siswa_set_departemen_no_title()
	{
		$sess_log['last_form_login'] = "signup";
		$this->session->set_userdata($sess_log);
		$cek = $this->session->userdata('logged_in');
		$st = $this->session->userdata('stts');
		if(!empty($cek))
		{
			$sess_data['id_departemen2'] = $_GET['kode_departemen'];
			$this->session->set_userdata($sess_data);
			
			$id['id_departemen'] = $this->session->userdata("id_departemen2");
			$dt_kelas = $this->db->get_where("kelas",$id);
			$tahun_ajaran = $this->db->get_where("tahunajaran",$id);
			$tingkat = $this->db->get_where("tingkat",$id);
			?>
			
			<select data-placeholder="- Pilih -" class="chzn-select8" style="width:200px;" tabindex="2" name="kode_tahun_ajaran" id="kode_tahun_ajaran">
				<option value=""></option> 
					<?php
						foreach($tahun_ajaran->result() as $ta)
						{
							?>
								<option value="<?php echo $ta->id; ?>"><?php echo $ta->tahunAjaran; ?></option>
							<?php
						}
					?>
			</select>
			<script type="text/javascript"> 
			
				$(".chzn-select8").chosen().change(function(){ 
					var kode_tahun_ajaran = $("#kode_tahun_ajaran").val(); 
					$.ajax({ 
					url: "<?php echo base_url(); ?>tool_combo/combo_data_siswa_set_tahun_ajaran_no_title", 
					data: "kode_tahun_ajaran="+kode_tahun_ajaran, 
					cache: false, 
					success: function(msg){ 
					$(".datatingkat").empty(); 
					$(".datatingkat").html(msg); 
					$(".datakelas").empty(); 
				} 
				})
				});
			</script>
			<div class="cleaner_h10"></div>
			<?php
		}
		else
		{
			if($st=='admin')
			{
				header('location:'.base_url().'admin');
			}
			else if($st=='pegawai akademis')
			{
				header('location:'.base_url().'pegawai_akademis');
			}
			else if($st=='pegawai non akademis')
			{
				header('location:'.base_url().'pegawai_non_akademis');
			}
			else if($st=='siswa')
			{
				header('location:'.base_url().'siswa');
			}
			else if($st=='hrd')
			{
				header('location:'.base_url().'hrd');
			}
			else
			{
				header('location:'.base_url().'');
			}
		}
	}
	 
	public function combo_data_agama_siswa()
	{
		$sess_log['last_form_login'] = "signup";
		$this->session->set_userdata($sess_log);
		$cek = $this->session->userdata('logged_in');
		$st = $this->session->userdata('stts');
		if(!empty($cek))
		{
			$dt_agama = $this->db->get("agama");
			?>
			<select data-placeholder="Pilih Agama..." class="chzn-select3" style="width:250px;" tabindex="2" name="agama" id="agama">
			<option value=""></option> 
				<?php
					foreach($dt_agama->result() as $da)
					{
				?>
					<option value="<?php echo $da->agama; ?>"><?php echo $da->agama; ?></option>
				<?php
					}
				?>
			</select>
			<script type="text/javascript"> 
				$(".chzn-select3").chosen().change(function(){ 
					document.forms["frm_siswa"].submit();
				});
			</script>
			<div class="cleaner_h10"></div>
			<?php
		}
		else
		{
			if($st=='admin')
			{
				header('location:'.base_url().'admin');
			}
			else if($st=='pegawai akademis')
			{
				header('location:'.base_url().'pegawai_akademis');
			}
			else if($st=='pegawai non akademis')
			{
				header('location:'.base_url().'pegawai_non_akademis');
			}
			else if($st=='siswa')
			{
				header('location:'.base_url().'siswa');
			}
			else if($st=='hrd')
			{
				header('location:'.base_url().'hrd');
			}
			else
			{
				header('location:'.base_url().'');
			}
		}
	}
	 
	public function combo_data_agama_ayah()
	{
		$sess_log['last_form_login'] = "signup";
		$this->session->set_userdata($sess_log);
		$cek = $this->session->userdata('logged_in');
		$st = $this->session->userdata('stts');
		if(!empty($cek))
		{
			$dt_agama = $this->db->get("agama");
			?>
			<select data-placeholder="Pilih Agama..." class="chzn-select3" style="width:250px;" tabindex="2" name="agamaAyah" id="agamaAyah">
			<option value=""></option> 
				<?php
					foreach($dt_agama->result() as $da)
					{
				?>
					<option value="<?php echo $da->agama; ?>"><?php echo $da->agama; ?></option>
				<?php
					}
				?>
			</select>
			<script type="text/javascript"> 
				$(".chzn-select3").chosen().change(function(){ 
					document.forms["frm_siswa"].submit();
				});
			</script>
			<div class="cleaner_h10"></div>
			<?php
		}
		else
		{
			if($st=='admin')
			{
				header('location:'.base_url().'admin');
			}
			else if($st=='pegawai akademis')
			{
				header('location:'.base_url().'pegawai_akademis');
			}
			else if($st=='pegawai non akademis')
			{
				header('location:'.base_url().'pegawai_non_akademis');
			}
			else if($st=='siswa')
			{
				header('location:'.base_url().'siswa');
			}
			else if($st=='hrd')
			{
				header('location:'.base_url().'hrd');
			}
			else
			{
				header('location:'.base_url().'');
			}
		}
	}
	 
	public function combo_data_agama_ibu()
	{
		$sess_log['last_form_login'] = "signup";
		$this->session->set_userdata($sess_log);
		$cek = $this->session->userdata('logged_in');
		$st = $this->session->userdata('stts');
		if(!empty($cek))
		{
			$dt_agama = $this->db->get("agama");
			?>
			<select data-placeholder="Pilih Agama..." class="chzn-select3" style="width:250px;" tabindex="2" name="agamaIbu" id="agamaIbu">
			<option value=""></option> 
				<?php
					foreach($dt_agama->result() as $da)
					{
				?>
					<option value="<?php echo $da->agama; ?>"><?php echo $da->agama; ?></option>
				<?php
					}
				?>
			</select>
			<script type="text/javascript"> 
				$(".chzn-select3").chosen().change(function(){ 
					document.forms["frm_siswa"].submit();
				});
			</script>
			<div class="cleaner_h10"></div>
			<?php
		}
		else
		{
			if($st=='admin')
			{
				header('location:'.base_url().'admin');
			}
			else if($st=='pegawai akademis')
			{
				header('location:'.base_url().'pegawai_akademis');
			}
			else if($st=='pegawai non akademis')
			{
				header('location:'.base_url().'pegawai_non_akademis');
			}
			else if($st=='siswa')
			{
				header('location:'.base_url().'siswa');
			}
			else if($st=='hrd')
			{
				header('location:'.base_url().'hrd');
			}
			else
			{
				header('location:'.base_url().'');
			}
		}
	}
	 
	public function combo_data_pekerjaan_ayah()
	{
		$sess_log['last_form_login'] = "signup";
		$this->session->set_userdata($sess_log);
		$cek = $this->session->userdata('logged_in');
		$st = $this->session->userdata('stts');
		if(!empty($cek))
		{
			$dt_pekerjaan = $this->db->get("pekerjaan");
			?>
			<select data-placeholder="Pilih Pekerjaan..." class="chzn-select3" style="width:250px;" tabindex="2" name="pekerjaanAyah" id="pekerjaanAyah">
			<option value=""></option> 
				<?php
					foreach($dt_pekerjaan->result() as $da)
					{
				?>
					<option value="<?php echo $da->nama; ?>"><?php echo $da->nama; ?></option>
				<?php
					}
				?>
			</select>
			<script type="text/javascript"> 
				$(".chzn-select3").chosen().change(function(){ 
					document.forms["frm_siswa"].submit();
				});
			</script>
			<div class="cleaner_h10"></div>
			<?php
		}
		else
		{
			if($st=='admin')
			{
				header('location:'.base_url().'admin');
			}
			else if($st=='pegawai akademis')
			{
				header('location:'.base_url().'pegawai_akademis');
			}
			else if($st=='pegawai non akademis')
			{
				header('location:'.base_url().'pegawai_non_akademis');
			}
			else if($st=='siswa')
			{
				header('location:'.base_url().'siswa');
			}
			else if($st=='hrd')
			{
				header('location:'.base_url().'hrd');
			}
			else
			{
				header('location:'.base_url().'');
			}
		}
	}
	 
	public function combo_data_pekerjaan_ibu()
	{
		$sess_log['last_form_login'] = "signup";
		$this->session->set_userdata($sess_log);
		$cek = $this->session->userdata('logged_in');
		$st = $this->session->userdata('stts');
		if(!empty($cek))
		{
			$dt_pekerjaan = $this->db->get("pekerjaan");
			?>
			<select data-placeholder="Pilih Pekerjaan..." class="chzn-select3" style="width:250px;" tabindex="2" name="pekerjaanIbu" id="pekerjaanIbu">
			<option value=""></option> 
				<?php
					foreach($dt_pekerjaan->result() as $da)
					{
				?>
					<option value="<?php echo $da->nama; ?>"><?php echo $da->nama; ?></option>
				<?php
					}
				?>
			</select>
			<script type="text/javascript"> 
				$(".chzn-select3").chosen().change(function(){ 
					document.forms["frm_siswa"].submit();
				});
			</script>
			<div class="cleaner_h10"></div>
			<?php
		}
		else
		{
			if($st=='admin')
			{
				header('location:'.base_url().'admin');
			}
			else if($st=='pegawai akademis')
			{
				header('location:'.base_url().'pegawai_akademis');
			}
			else if($st=='pegawai non akademis')
			{
				header('location:'.base_url().'pegawai_non_akademis');
			}
			else if($st=='siswa')
			{
				header('location:'.base_url().'siswa');
			}
			else if($st=='hrd')
			{
				header('location:'.base_url().'hrd');
			}
			else
			{
				header('location:'.base_url().'');
			}
		}
	}
	 
	public function combo_data_pendidikan()
	{
		$sess_log['last_form_login'] = "signup";
		$this->session->set_userdata($sess_log);
		$cek = $this->session->userdata('logged_in');
		$st = $this->session->userdata('stts');
		if(!empty($cek))
		{
			$dt_pendidikan = $this->db->get("pendidikan");
			?>
			<select data-placeholder="Pilih Pendidikan..." class="chzn-select3" style="width:250px;" tabindex="2" name="pendidikan" id="pendidikan">
			<option value=""></option> 
				<?php
					foreach($dt_pendidikan->result() as $da)
					{
				?>
					<option value="<?php echo $da->nama; ?>"><?php echo $da->nama; ?></option>
				<?php
					}
				?>
			</select>
			<script type="text/javascript"> 
				$(".chzn-select3").chosen();
			</script>
			<div class="cleaner_h10"></div>
			<?php
		}
		else
		{
			if($st=='admin')
			{
				header('location:'.base_url().'admin');
			}
			else if($st=='pegawai akademis')
			{
				header('location:'.base_url().'pegawai_akademis');
			}
			else if($st=='pegawai non akademis')
			{
				header('location:'.base_url().'pegawai_non_akademis');
			}
			else if($st=='siswa')
			{
				header('location:'.base_url().'siswa');
			}
			else if($st=='hrd')
			{
				header('location:'.base_url().'hrd');
			}
			else
			{
				header('location:'.base_url().'');
			}
		}
	}
	 
	public function combo_data_pendidikan_ibu()
	{
		$sess_log['last_form_login'] = "signup";
		$this->session->set_userdata($sess_log);
		$cek = $this->session->userdata('logged_in');
		$st = $this->session->userdata('stts');
		if(!empty($cek))
		{
			$dt_pendidikan = $this->db->get("pendidikan");
			?>
			<select data-placeholder="Pilih Pendidikan..." class="chzn-select3" style="width:250px;" tabindex="2" name="pendidikanIbu" id="pendidikanIbu">
			<option value=""></option> 
				<?php
					foreach($dt_pendidikan->result() as $da)
					{
				?>
					<option value="<?php echo $da->nama; ?>"><?php echo $da->nama; ?></option>
				<?php
					}
				?>
			</select>
			<script type="text/javascript"> 
				$(".chzn-select3").chosen().change(function(){ 
					document.forms["frm_siswa"].submit();
				});
			</script>
			<div class="cleaner_h10"></div>
			<?php
		}
		else
		{
			if($st=='admin')
			{
				header('location:'.base_url().'admin');
			}
			else if($st=='pegawai akademis')
			{
				header('location:'.base_url().'pegawai_akademis');
			}
			else if($st=='pegawai non akademis')
			{
				header('location:'.base_url().'pegawai_non_akademis');
			}
			else if($st=='siswa')
			{
				header('location:'.base_url().'siswa');
			}
			else if($st=='hrd')
			{
				header('location:'.base_url().'hrd');
			}
			else
			{
				header('location:'.base_url().'');
			}
		}
	}
	 
	public function combo_data_pendidikan_ayah()
	{
		$sess_log['last_form_login'] = "signup";
		$this->session->set_userdata($sess_log);
		$cek = $this->session->userdata('logged_in');
		$st = $this->session->userdata('stts');
		if(!empty($cek))
		{
			$dt_pendidikan = $this->db->get("pendidikan");
			?>
			<select data-placeholder="Pilih Pendidikan..." class="chzn-select3" style="width:250px;" tabindex="2" name="pendidikanAyah" id="pendidikanAyah">
			<option value=""></option> 
				<?php
					foreach($dt_pendidikan->result() as $da)
					{
				?>
					<option value="<?php echo $da->nama; ?>"><?php echo $da->nama; ?></option>
				<?php
					}
				?>
			</select>
			<script type="text/javascript"> 
				$(".chzn-select3").chosen().change(function(){ 
					document.forms["frm_siswa"].submit();
				});
			</script>
			<div class="cleaner_h10"></div>
			<?php
		}
		else
		{
			if($st=='admin')
			{
				header('location:'.base_url().'admin');
			}
			else if($st=='pegawai akademis')
			{
				header('location:'.base_url().'pegawai_akademis');
			}
			else if($st=='pegawai non akademis')
			{
				header('location:'.base_url().'pegawai_non_akademis');
			}
			else if($st=='siswa')
			{
				header('location:'.base_url().'siswa');
			}
			else if($st=='hrd')
			{
				header('location:'.base_url().'hrd');
			}
			else
			{
				header('location:'.base_url().'');
			}
		}
	}
	 
	public function combo_data_bidang_studi()
	{
		$sess_log['last_form_login'] = "signup";
		$this->session->set_userdata($sess_log);
		$cek = $this->session->userdata('logged_in');
		$st = $this->session->userdata('stts');
		if(!empty($cek))
		{
			$dt_bidang_studi = $this->db->get("tbl_bidang_studi");
			?>
			<select data-placeholder="Pilih Bidang Studi..." class="chzn-select3" style="width:250px;" tabindex="2" name="bidang_studi" id="bidang_studi">
			<option value=""></option> 
				<?php
					foreach($dt_bidang_studi->result() as $da)
					{
				?>
					<option value="<?php echo $da->id_bidang_studi; ?>"><?php echo $da->nama_bidang_studi; ?></option>
				<?php
					}
				?>
			</select>
			<script type="text/javascript"> 
				$(".chzn-select3").chosen();
			</script>
			<div class="cleaner_h10"></div>
			<?php
		}
		else
		{
			if($st=='admin')
			{
				header('location:'.base_url().'admin');
			}
			else if($st=='pegawai akademis')
			{
				header('location:'.base_url().'pegawai_akademis');
			}
			else if($st=='pegawai non akademis')
			{
				header('location:'.base_url().'pegawai_non_akademis');
			}
			else if($st=='siswa')
			{
				header('location:'.base_url().'siswa');
			}
			else if($st=='hrd')
			{
				header('location:'.base_url().'hrd');
			}
			else
			{
				header('location:'.base_url().'');
			}
		}
	}
	 
	public function combo_data_jabatan()
	{
		$sess_log['last_form_login'] = "signup";
		$this->session->set_userdata($sess_log);
		$cek = $this->session->userdata('logged_in');
		$st = $this->session->userdata('stts');
		if(!empty($cek))
		{
			$dt_jabatan = $this->db->get("tbl_jabatan_pegawai");
			?>
			<select data-placeholder="Pilih Jabatan..." class="chzn-select3" style="width:250px;" tabindex="2" name="jabatan" id="jabatan">
			<option value=""></option> 
				<?php
					foreach($dt_jabatan->result() as $da)
					{
				?>
					<option value="<?php echo $da->id_jabatan_pegawai; ?>"><?php echo $da->nama_jabatan_pegawai; ?></option>
				<?php
					}
				?>
			</select>
			<script type="text/javascript"> 
				$(".chzn-select3").chosen();
			</script>
			<div class="cleaner_h10"></div>
			<?php
		}
		else
		{
			if($st=='admin')
			{
				header('location:'.base_url().'admin');
			}
			else if($st=='pegawai akademis')
			{
				header('location:'.base_url().'pegawai_akademis');
			}
			else if($st=='pegawai non akademis')
			{
				header('location:'.base_url().'pegawai_non_akademis');
			}
			else if($st=='siswa')
			{
				header('location:'.base_url().'siswa');
			}
			else if($st=='hrd')
			{
				header('location:'.base_url().'hrd');
			}
			else
			{
				header('location:'.base_url().'');
			}
		}
	}
}

/* End of file tool_combo.php */
/* Location: ./application/controllers/tool_combo.php */