<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Administrasi_System_User extends CI_Controller {

	/**
	 * @author : Gede Lumbung
	 * @web : http://gedelumbung.com
	 * @keterangan : Controller untuk manajemen Administrasi > System > User
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
				
				$tot_hal = $this->db->get("user");
				$config['base_url'] = base_url() . 'admin_administrasi_system_user/index/';
				$config['total_rows'] = $tot_hal->num_rows();
				$config['per_page'] = $limit;
				$config['uri_segment'] = 3;
				$config['first_link'] = 'Awal';
				$config['last_link'] = 'Akhir';
				$config['next_link'] = 'Selanjutnya';
				$config['prev_link'] = 'Sebelumnya';
				$this->pagination->initialize($config);
				$bc["paginator"] =$this->pagination->create_links();
				$bc['dt_user'] = $this->db->query("select a.id, a.user, a.nama, b.nama_jabatan, a.stts  from user a left join 
				jabatanakses b on a.id_akses=b.id limit ".$offset.",".$limit."");
				
				$this->load->view("admin/administrasi/header");
				$this->load->view("admin/administrasi/system/user/home",$bc);
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
				$id['id']=$this->uri->segment(3);
				$dt = $this->db->query("select a.id, a.user, a.nama, b.nama_jabatan, a.stts, a.id_akses from user a left join jabatanakses b on a.id_akses=b.id 
				where a.id='".$id['id']."'");
				
				$frm['id'] = "";
				$frm['id_akses'] = "";
				$frm['user'] = "";
				$frm['nama'] = "";
				$frm['stts'] = "";
				
				foreach($dt->result() as $d)
				{
					$frm['id'] = $d->id;
					$frm['id_akses'] = $d->id_akses;
					$frm['user'] = $d->user;
					$frm['nama'] = $d->nama;
					$frm['stts'] = $d->stts;
				}
				
				$frm['hak_akses'] = $this->db->get_where("jabatanakses",array("register" => "0", "id" => "1"));
				
				$this->load->view("admin/administrasi/system/user/bg_input",$frm);
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
				$frm['hak_akses'] = $this->db->get_where("jabatanakses",array("register" => "0", "id" => "1"));
				$frm['st'] = "tambah";
				
				$frm['id'] = "";
				$frm['id_akses'] = "";
				$frm['user'] = "";
				$frm['nama'] = "";
				$frm['stts'] = "";
				
				$this->load->view("admin/administrasi/system/user/bg_input",$frm);
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
				$query = $this->db->query("delete from user where id IN (".$id.")");
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
				$id['id'] = $this->input->post("id");
				
				$in['id_akses'] = $this->input->post("id_akses");
				$in['user'] = $this->input->post("user");
				$in['nama'] = $this->input->post("nama");
				$in['stts'] = $this->input->post("stts");
				
				if($st=="tambah")
				{
					$this->form_validation->set_rules('user', 'Username', 'trim|required');
					$this->form_validation->set_rules('nama', 'Nama User', 'trim|required');
					$this->form_validation->set_rules('stts', 'Status', 'trim|required');
					$this->form_validation->set_rules('password', 'Password', 'trim|required');
				
					if ($this->form_validation->run() == FALSE)
					{
						$frm['st'] = $st;
						$frm['hak_akses'] = $this->db->get("jabatanakses");
						
						$frm['id'] = "";
						$frm['id_akses'] = "";
						$frm['user'] = "";
						$frm['nama'] = "";
						$frm['stts'] = "";
						$this->load->view("admin/administrasi/system/user/bg_input",$frm);
					}
					else
					{
						$pass = $this->input->post("password");
						$in['pass'] = md5(mysql_real_escape_string($pass.'appSIMAkademikSekolah32'));
						$this->db->insert("user",$in);
						?><script>window.parent.location.reload(true);</script><?php
					}
				}
				else if($st=="edit")
				{
					$this->form_validation->set_rules('user', 'Username', 'trim|required');
					$this->form_validation->set_rules('nama', 'Nama User', 'trim|required');
					$this->form_validation->set_rules('stts', 'Status', 'trim|required');
				
					if ($this->form_validation->run() == FALSE)
					{
						$dt = $this->db->query("select a.id, a.user, a.nama, b.nama_jabatan, a.stts, a.id_akses from user a left join jabatanakses b on a.id_akses=b.id 
						where a.id='".$id['id']."'");
						
						$frm['id'] = "";
						$frm['id_akses'] = "";
						$frm['user'] = "";
						$frm['nama'] = "";
						$frm['stts'] = "";
						
						foreach($dt->result() as $d)
						{
							$frm['id'] = $d->id;
							$frm['id_akses'] = $d->id_akses;
							$frm['user'] = $d->user;
							$frm['nama'] = $d->nama;
							$frm['stts'] = $d->stts;
						}
						
						$frm['hak_akses'] = $this->db->get("jabatanakses");
						
						$this->load->view("admin/administrasi/system/user/bg_input",$frm);
					}
					else
					{
						$pass = $this->input->post("password");
						if($pass!="")
						{
							$in['pass'] = md5(mysql_real_escape_string($pass.'appSIMAkademikSekolah32'));
						}
						$this->db->update("user",$in,$id);
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

/* End of file admin_administrasi_system_user.php */
/* Location: ./application/controllers/admin_administrasi_system_user.php */