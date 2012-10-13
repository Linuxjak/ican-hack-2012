<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Administrasi_System_Hubungi extends CI_Controller {

	/**
	 * @author : Gede Lumbung
	 * @web : http://gedelumbung.com
	 * @keterangan : Controller untuk manajemen Administrasi > System > Hubungi Kami
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
				
				$tot_hal = $this->db->get("tbl_report_admin");
				$config['base_url'] = base_url() . 'admin_administrasi_system_hubungi/index/';
				$config['total_rows'] = $tot_hal->num_rows();
				$config['per_page'] = $limit;
				$config['uri_segment'] = 3;
				$config['first_link'] = 'Awal';
				$config['last_link'] = 'Akhir';
				$config['next_link'] = 'Selanjutnya';
				$config['prev_link'] = 'Sebelumnya';
				$this->pagination->initialize($config);
				$bc["paginator"] =$this->pagination->create_links();
				$bc['dt_hubungi'] = $this->db->get("tbl_report_admin",$limit,$offset);
				
				$this->load->view("admin/administrasi/header");
				$this->load->view("admin/administrasi/system/hubungi/home",$bc);
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
	 
	public function detail()
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
				$id['kode_report'] = $this->uri->segment(3);
				$dt = $this->db->get_where("tbl_report_admin",$id);
				
				$frm['kode_report'] = "";
				$frm['nama_lengkap'] = "";
				$frm['email'] = "";
				$frm['no_telp'] = "";
				$frm['isi_report'] = "";
				
				foreach($dt->result() as $d)
				{
					$frm['kode_report'] = $d->kode_report;
					$frm['nama_lengkap'] = $d->nama_lengkap;
					$frm['email'] = $d->email;
					$frm['no_telp'] = $d->no_telp;
					$frm['isi_report'] = $d->isi_report;
				}
				
				$this->load->view("admin/administrasi/system/hubungi/bg_detail",$frm);
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
				$query = $this->db->query("delete from tbl_report_admin where kode_report IN (".$id.")");
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
}

/* End of file admin_administrasi_system_hubungi.php */ 
/* Location: ./application/controllers/admin_administrasi_system_hubungi.php */