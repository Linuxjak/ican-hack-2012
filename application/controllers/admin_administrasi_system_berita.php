<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Administrasi_System_Berita extends CI_Controller {

	/**
	 * @author : Gede Lumbung
	 * @web : http://gedelumbung.com
	 * @keterangan : Controller untuk manajemen Administrasi > System > Berita
	 **/
	 
	public function index()
	{
		$sess_log['last_form_login'] = "signup";
		$this->session->set_userdata($sess_log);
		$cek = $this->session->userdata('logged_in');
		$st = $this->session->userdata('stts');
		$cabang = $this->session->userdata("id_cabang");
		$departemen = $this->session->userdata("id_departemen");
		if(!empty($cek))
		{
			if($st=="admin")
			{
				$bc['online'] = $this->db->get("online_support");
				$id_cabang = $this->session->userdata("id_cabang");
				$page=$this->uri->segment(3);
				$limit=$this->config->item('limit_data');
				if(!$page):
				$offset = 0;
				else:
				$offset = $page;
				endif;
				
				$tot_hal = $this->db->get("tbl_berita");
				$config['base_url'] = base_url() . 'admin_administrasi_system_berita/index/';
				$config['total_rows'] = $tot_hal->num_rows();
				$config['per_page'] = $limit;
				$config['uri_segment'] = 3;
				$config['first_link'] = 'Awal';
				$config['last_link'] = 'Akhir';
				$config['next_link'] = 'Selanjutnya';
				$config['prev_link'] = 'Sebelumnya';
				$this->pagination->initialize($config);
				$bc["paginator"] =$this->pagination->create_links();
				$bc['dt_berita'] = $this->db->query("select * from tbl_berita limit ".$offset.",".$limit."");
				
				$this->load->view("admin/administrasi/header");
				$this->load->view("admin/administrasi/system/berita/home",$bc);
				$this->load->view("admin/administrasi/footer");
			}
			else
			{
				header('location:'.base_url().'');
			}
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
	 
	public function edit()
	{
		$sess_log['last_form_login'] = "signup";
		$this->session->set_userdata($sess_log);
		$cek = $this->session->userdata('logged_in');
		$st = $this->session->userdata('stts');
		$cabang = $this->session->userdata("id_cabang");
		$departemen = $this->session->userdata("id_departemen");
		if(!empty($cek))
		{
			if($st=="admin")
			{
				$frm['st'] = "edit";
				$id['id_berita']=$this->uri->segment(3);
				$dt = $this->db->get_where("tbl_berita",$id);
				foreach($dt->result() as $d)
				{
					$frm['id_berita'] = $d->id_berita;
					$frm['judul'] = $d->judul;
					$frm['isi'] = $d->isi;
					$frm['gbr'] = $d->gbr;
				}
				
				$this->load->view("admin/administrasi/system/berita/bg_input",$frm);
			}
			else
			{
				header('location:'.base_url().'');
			}
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
	 
	public function tambah()
	{
		$sess_log['last_form_login'] = "signup";
		$this->session->set_userdata($sess_log);
		$cek = $this->session->userdata('logged_in');
		$st = $this->session->userdata('stts');
		$cabang = $this->session->userdata("id_cabang");
		$departemen = $this->session->userdata("id_departemen");
		if(!empty($cek))
		{
			if($st=="admin")
			{
				$frm['id_berita'] = "";
				$frm['judul'] = "";
				$frm['isi'] = "";
				$frm['gbr'] = "";
				$frm['st'] = "tambah";
				
				$this->load->view("admin/administrasi/system/berita/bg_input",$frm);
			}
			else
			{
				header('location:'.base_url().'');
			}
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
	 
	 
	public function hapus()
	{
		$sess_log['last_form_login'] = "signup";
		$this->session->set_userdata($sess_log);
		$cek = $this->session->userdata('logged_in');
		$st = $this->session->userdata('stts');
		$cabang = $this->session->userdata("id_cabang");
		$departemen = $this->session->userdata("id_departemen");
		if(!empty($cek))
		{
			if($st=="admin")
			{
				$id = $this->input->post('kode');
				$query = $this->db->query("delete from tbl_berita where id_berita IN (".$id.")");
				if($query){
					echo 1;
				}
				else{
					echo 0;
				}
			}
			else
			{
				header('location:'.base_url().'');
			}
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
	 
	public function simpan()
	{
		$sess_log['last_form_login'] = "signup";
		$this->session->set_userdata($sess_log);
		$cek = $this->session->userdata('logged_in');
		$st = $this->session->userdata('stts');
		$cabang = $this->session->userdata("id_cabang");
		$departemen = $this->session->userdata("id_departemen");
		if(!empty($cek))
		{
			if($st=="admin")
			{
				$st = $this->input->post("st-input");
				$id['id_berita'] = $this->input->post("id");
				
				$in['judul'] = $this->input->post("judul");
				$in['isi'] = $this->input->post("isi");
				$gb = $this->input->post("gbr");
		
				$this->form_validation->set_rules('judul', 'Title', 'trim|required');
				$this->form_validation->set_rules('isi', 'News', 'trim|required');
				
				if ($this->form_validation->run() == FALSE)
				{
					if($st=="tambah")
					{
						$frm['st'] = $st;
						
						$frm['id_berita'] = "";
						$frm['judul'] = "";
						$frm['isi'] = "";
						$frm['gbr'] = "";
						$frm['st'] = "tambah";
						$this->load->view("admin/administrasi/system/berita/bg_input",$frm);
					}
					else if($st=="edit")
					{
						$frm['st'] = $st;
						
						$frm['st'] = "edit";
						$dt = $this->db->get_where("tbl_berita",$id);
						foreach($dt->result() as $d)
						{
							$frm['id_berita'] = $d->id;
							$frm['judul'] = $d->judul;
							$frm['isi'] = $d->isi;
							$frm['gbr'] = $d->gbr;
						}
						
						$this->load->view("admin/administrasi/system/berita/bg_input",$frm);
					}
				}
				else
				{
					if($st=="edit")
					{
						if(empty($_FILES['userfile']['name']))
						{
							$this->db->update("tbl_berita",$in,$id);
							?><script>window.parent.location.reload(true);</script><?php
						}
						else
						{
							$acak=rand(00000000000,99999999999);
							$bersih=$_FILES['userfile']['name'];
							$nm=str_replace(" ","_","$bersih");
							$pisah=explode(".",$nm);
							$nama_murni_lama = preg_replace("/^(.+?);.*$/", "\\1",$pisah[0]);
							$nama_murni=date('Ymd-His');
							$ekstensi_kotor = $pisah[1];
							
							$file_type = preg_replace("/^(.+?);.*$/", "\\1", $ekstensi_kotor);
							$file_type_baru = strtolower($file_type);
							
							$ubah=$acak.'-'.$nama_murni; //tanpa ekstensi
							$n_baru = $ubah.'.'.$file_type_baru;
							
							$config['upload_path']	= "./asset/berita/";
							$config['allowed_types']= 'gif|jpg|png|jpeg';
							$config['file_name'] = $n_baru;
							$config['max_size']     = '2500';
							$config['max_width']  	= '2000';
							$config['max_height']  	= '2000';
					 
							$this->load->library('upload', $config);
					 
							if ($this->upload->do_upload("userfile")) {
								$data	 	= $this->upload->data();
					 
								/* PATH */
								$source             = "./asset/berita/".$data['file_name'] ;
								$destination_thumb	= "./asset/berita/thumb/" ;
								$destination_medium	= "./asset/berita/medium/" ;
					 
								// Permission Configuration
								chmod($source, 0777) ;
					 
								/* Resizing Processing */
								// Configuration Of Image Manipulation :: Static
								$this->load->library('image_lib') ;
								$img['image_library'] = 'GD2';
								$img['create_thumb']  = TRUE;
								$img['maintain_ratio']= TRUE;
					 
								/// Limit Width Resize
								$limit_medium   = 900 ;
								$limit_thumb    = 120 ;
					 
								// Size Image Limit was using (LIMIT TOP)
								$limit_use  = $data['image_width'] > $data['image_height'] ? $data['image_width'] : $data['image_height'] ;
					 
								// Percentase Resize
								if ($limit_use > $limit_medium || $limit_use > $limit_thumb) {
									$percent_medium = $limit_medium/$limit_use ;
									$percent_thumb  = $limit_thumb/$limit_use ;
								}
					 
								//// Making THUMBNAIL ///////
								$img['width']  = $limit_use > $limit_thumb ?  $data['image_width'] * $percent_thumb : $data['image_width'] ;
								$img['height'] = $limit_use > $limit_thumb ?  $data['image_height'] * $percent_thumb : $data['image_height'] ;
					 
								// Configuration Of Image Manipulation :: Dynamic
								$img['thumb_marker'] = '';
								$img['quality']      = '100%' ;
								$img['source_image'] = $source ;
								$img['new_image']    = $destination_thumb ;
					 
								// Do Resizing
								$this->image_lib->initialize($img);
								$this->image_lib->resize();
								$this->image_lib->clear() ;
					 
								////// Making MEDIUM /////////////
								$img['width']   = $limit_use > $limit_medium ?  $data['image_width'] * $percent_medium : $data['image_width'] ;
								$img['height']  = $limit_use > $limit_medium ?  $data['image_height'] * $percent_medium : $data['image_height'] ;
					 
								// Configuration Of Image Manipulation :: Dynamic
								$img['thumb_marker'] = '';
								$img['quality']      = '100%' ;
								$img['source_image'] = $source ;
								$img['new_image']    = $destination_medium ;
					 
								// Do Resizing
								$this->image_lib->initialize($img);
								$this->image_lib->resize();
								$this->image_lib->clear() ;
								
								$in['gbr'] = $data['file_name'];
								$this->db->update("tbl_berita",$in,$id);
								unlink("./asset/berita/".$data['file_name']."");
								unlink("./asset/berita/thumb/".$gb."");
								unlink("./asset/berita/medium/".$gb."");
								?><script>window.parent.location.reload(true);</script><?php
								
							}
							else {
								$this->session->set_flashdata('result_login', 'Failed.');
							}
						}
					}
					else if($st=="tambah")
					{
						if(empty($_FILES['userfile']['name']))
						{
							$in['tgl_post'] = date('Y-m-d');
							$in['jam_post'] = date('H:i:s');
							$this->db->insert("tbl_berita",$in);
							?><script>window.parent.location.reload(true);</script><?php
						}
						else
						{
							$acak=rand(00000000000,99999999999);
							$bersih=$_FILES['userfile']['name'];
							$nm=str_replace(" ","_","$bersih");
							$pisah=explode(".",$nm);
							$nama_murni_lama = preg_replace("/^(.+?);.*$/", "\\1",$pisah[0]);
							$nama_murni=date('Ymd-His');
							$ekstensi_kotor = $pisah[1];
							
							$file_type = preg_replace("/^(.+?);.*$/", "\\1", $ekstensi_kotor);
							$file_type_baru = strtolower($file_type);
							
							$ubah=$acak.'-'.$nama_murni; //tanpa ekstensi
							$n_baru = $ubah.'.'.$file_type_baru;
							
							$config['upload_path']	= "./asset/berita/";
							$config['allowed_types']= 'gif|jpg|png|jpeg';
							$config['file_name'] = $n_baru;
							$config['max_size']     = '2500';
							$config['max_width']  	= '2000';
							$config['max_height']  	= '2000';
					 
							$this->load->library('upload', $config);
					 
							if ($this->upload->do_upload("userfile")) {
								$data	 	= $this->upload->data();
					 
								/* PATH */
								$source             = "./asset/berita/".$data['file_name'] ;
								$destination_thumb	= "./asset/berita/thumb/" ;
								$destination_medium	= "./asset/berita/medium/" ;
					 
								// Permission Configuration
								chmod($source, 0777) ;
					 
								/* Resizing Processing */
								// Configuration Of Image Manipulation :: Static
								$this->load->library('image_lib') ;
								$img['image_library'] = 'GD2';
								$img['create_thumb']  = TRUE;
								$img['maintain_ratio']= TRUE;
					 
								/// Limit Width Resize
								$limit_medium   = 900 ;
								$limit_thumb    = 120 ;
					 
								// Size Image Limit was using (LIMIT TOP)
								$limit_use  = $data['image_width'] > $data['image_height'] ? $data['image_width'] : $data['image_height'] ;
					 
								// Percentase Resize
								if ($limit_use > $limit_medium || $limit_use > $limit_thumb) {
									$percent_medium = $limit_medium/$limit_use ;
									$percent_thumb  = $limit_thumb/$limit_use ;
								}
					 
								//// Making THUMBNAIL ///////
								$img['width']  = $limit_use > $limit_thumb ?  $data['image_width'] * $percent_thumb : $data['image_width'] ;
								$img['height'] = $limit_use > $limit_thumb ?  $data['image_height'] * $percent_thumb : $data['image_height'] ;
					 
								// Configuration Of Image Manipulation :: Dynamic
								$img['thumb_marker'] = '';
								$img['quality']      = '100%' ;
								$img['source_image'] = $source ;
								$img['new_image']    = $destination_thumb ;
					 
								// Do Resizing
								$this->image_lib->initialize($img);
								$this->image_lib->resize();
								$this->image_lib->clear() ;
					 
								////// Making MEDIUM /////////////
								$img['width']   = $limit_use > $limit_medium ?  $data['image_width'] * $percent_medium : $data['image_width'] ;
								$img['height']  = $limit_use > $limit_medium ?  $data['image_height'] * $percent_medium : $data['image_height'] ;
					 
								// Configuration Of Image Manipulation :: Dynamic
								$img['thumb_marker'] = '';
								$img['quality']      = '100%' ;
								$img['source_image'] = $source ;
								$img['new_image']    = $destination_medium ;
					 
								// Do Resizing
								$this->image_lib->initialize($img);
								$this->image_lib->resize();
								$this->image_lib->clear() ;
								
								$in['tgl_post'] = date('Y-m-d');
								$in['jam_post'] = date('H:i:s');
								$this->db->insert("tbl_berita",$in);
								unlink("./asset/berita/".$data['file_name']."");
								?><script>window.parent.location.reload(true);</script><?php
								
							}
							else {
								$this->session->set_flashdata('result_login', 'Failed.');
							}
						}
					}
				}
			}
			else
			{
				header('location:'.base_url().'');
			}
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

/* End of file admin_administrasi_system_berita.php */
/* Location: ./application/controllers/admin_administrasi_system_berita.php */