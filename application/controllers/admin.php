<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	/**
	 * @author : Gede Lumbung
	 * @web : http://gedelumbung.com
	 * @keterangan : Controller untuk manajemen data dashboard dari panel admin
	 **/
	 
	public function index()
	{
		$sess_log['last_form_login'] = "signup";
		$this->session->set_userdata($sess_log);
		$cek = $this->session->userdata('logged_in');
		$st = $this->session->userdata('stts');
		$departemen = $this->session->userdata("id_departemen");
		if(!empty($cek))
		{
			if($st=="admin")
			{
				header('location:'.base_url().'admin_administrasi_system');
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
	 
	public function pilih_menu()
	{
		$sess_log['last_form_login'] = "signup";
		$this->session->set_userdata($sess_log);
		$cek = $this->session->userdata('logged_in');
		$st = $this->session->userdata('stts');
		$departemen = $this->session->userdata("id_departemen");
		if(!empty($cek))
		{
			if($st=="admin")
			{
				$id = $this->uri->segment(3);
				if($id=="1")
				{
					$this->load->view("admin/dashboard/administrasi");
				}
				else if($id=="2")
				{
					$this->load->view("admin/dashboard/kepegawaian");
				}
				else if($id=="3")
				{
					$this->load->view("admin/dashboard/marketing");
				}
				else if($id=="4")
				{
					$this->load->view("admin/dashboard/guru_pelajaran");
				}
				else if($id=="5")
				{
					$this->load->view("admin/dashboard/kesiswaan");
				}
				else if($id=="6")
				{
					$this->load->view("admin/dashboard/elearning");
				}
				else if($id=="7")
				{
					$this->load->view("admin/dashboard/penjadwalan");
				}
				else
				{
					header('location:'.base_url().'');
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

/* End of file app_register_user.php */
/* Location: ./application/controllers/app_register_user.php */