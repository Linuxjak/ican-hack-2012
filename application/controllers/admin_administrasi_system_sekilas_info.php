<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Administrasi_System_Sekilas_Info extends CI_Controller {

	/**
	 * @author : Gede Lumbung
	 * @web : http://gedelumbung.com
	 * @keterangan : Controller untuk manajemen Administrasi > System > Sekilas Info
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
				
				$tot_hal = $this->db->get("tbl_sekilas_info");
				$config['base_url'] = base_url() . 'admin_administrasi_system_sekilas_info/index/';
				$config['total_rows'] = $tot_hal->num_rows();
				$config['per_page'] = $limit;
				$config['uri_segment'] = 3;
				$config['first_link'] = 'First';
				$config['last_link'] = 'Last';
				$config['next_link'] = 'Next';
				$config['prev_link'] = 'Previous';
				$this->pagination->initialize($config);
				$bc["paginator"] =$this->pagination->create_links();
				$bc['dt_departemen'] = $this->db->get("tbl_sekilas_info",$limit,$offset);
				
				$this->load->view("admin/administrasi/header");
				$this->load->view("admin/administrasi/system/sekilas_info/home",$bc);
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
				$id['kode_sekilas_info'] = $this->uri->segment(3);
				$dt = $this->db->get_where("tbl_sekilas_info",$id);
				$frm['st'] = "edit";
				
				$frm['kode_sekilas_info'] = "";
				$frm['judul'] = "";
				$frm['isi_info'] = "";
				
				foreach($dt->result() as $d)
				{
					$frm['kode_sekilas_info'] = $d->kode_sekilas_info;
					$frm['judul'] = $d->judul;
					$frm['isi_info'] = $d->isi_info;
				}
				
				$this->load->view("admin/administrasi/system/sekilas_info/bg_input",$frm);
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
				$frm['st'] = "tambah";
				
				$frm['kode_sekilas_info'] = "";
				$frm['judul'] = "";
				$frm['isi_info'] = "";
				
				$this->load->view("admin/administrasi/system/sekilas_info/bg_input",$frm);
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
				$query = $this->db->query("delete from tbl_sekilas_info where kode_sekilas_info IN (".$id.")");
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
				$id['kode_sekilas_info'] = $this->input->post("id");
				
				$in['judul'] = $this->input->post("judul");
				$in['waktu'] = gmdate("d F Y H:i:s",time()+3600*7);
				$in['isi_info'] = $this->input->post("isi_sekilas_info");
		
				$this->form_validation->set_rules('judul', 'Judul', 'trim|required');
				$this->form_validation->set_rules('isi_sekilas_info', 'Isi Info', 'trim|required');
				
				if ($this->form_validation->run() == FALSE)
				{
					if($st=="tambah")
					{
						$frm['st'] = "tambah";
						
						$frm['kode_sekilas_info'] = "";
						$frm['judul'] = "";
						$frm['isi_info'] = "";
						
						$this->load->view("admin/administrasi/system/sekilas_info/bg_input",$frm);
					}
					else if($st=="edit")
					{
						$dt = $this->db->get_where("tbl_sekilas_info",$id);
						$frm['st'] = "edit";
						
						foreach($dt->result() as $d)
						{
							$frm['kode_sekilas_info'] = $d->kode_sekilas_info;
							$frm['judul'] = $d->judul;
							$frm['isi_info'] = $d->isi_info;
						}
						
						$this->load->view("admin/administrasi/system/sekilas_info/bg_input",$frm);
					}
				}
				else
				{
					if($st=="edit")
					{
						$this->db->update("tbl_sekilas_info",$in,$id);
						?><script>window.parent.location.reload(true);</script><?php
					}
					else if($st=="tambah")
					{
						$this->db->insert("tbl_sekilas_info",$in);
						?><script>window.parent.location.reload(true);</script><?php
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

/* End of file admin_administrasi_system_sekilas_info.php */
/* Location: ./application/controllers/admin_administrasi_system_sekilas_info.php */