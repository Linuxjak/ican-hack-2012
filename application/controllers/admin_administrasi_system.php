<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Administrasi_System extends CI_Controller {

	/**
	 * @author : Gede Lumbung
	 * @web : http://gedelumbung.com
	 * @keterangan : Controller untuk menampilkan sub menu  Administrasi > System
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
				$frm['online'] = $this->db->get("online_support");
				$this->load->view("admin/administrasi/header");
				$this->load->view("admin/administrasi/home");
				$this->load->view("admin/administrasi/footer",$frm);
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

/* End of file admin_administrasi_system.php */
/* Location: ./application/controllers/admin_administrasi_system.php */