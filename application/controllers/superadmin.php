<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Superadmin extends CI_Controller {

	/**
	 * @author : Gede Lumbung
	 * @web : http://gedelumbung.com
	 * @keterangan : Controller untuk manajemen superadmin
	 **/
	 
	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		if(empty($cek))
		{
			//---------------------Start Captcha----------------------\\
			$vals = array(
			'img_path' => './captcha/',
			'img_url' => base_url().'captcha/',
			'font_path' => './system/fonts/impact.ttf',
			'img_width' => '150',
			'img_height' => 40
			);
			$cap = create_captcha($vals);
			$datamasuk = array(
				'captcha_time' => $cap['time'],
				//'ip_address' => $this->input->ip_address(),
				'word' => $cap['word']
				);
			$expiration = time()-3600;
			$this->db->query("DELETE FROM captcha WHERE captcha_time < ".$expiration);
			$query = $this->db->insert_string('captcha', $datamasuk);
			$this->db->query($query);
			$frm['gbr_captcha'] = $cap['image'];
			
			//---------------------End Captcha----------------------\\
			
			
			//buat atribut form login
			$frm['username'] = array('name' => 'username',
				'id' => 'username',
				'type' => 'text',
				'autocomplete' => 'off',
				'style' => 'width:270px;',
				'placeholder' => 'Masukkan username',
			);
			$frm['password'] = array('name' => 'password',
				'id' => 'password',
				'type' => 'password',
				'autocomplete' => 'off',
				'style' => 'width:270px;',
				'placeholder' => 'Masukkan password'
			);
			$frm['captcha'] = array('name' => 'captcha',
				'id' => 'captcha',
				'type' => 'text',
				'autocomplete' => 'off',
				'style' => 'width:110px; float:left;',
				'placeholder' => 'Masukkan kode'
			);
			
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$this->form_validation->set_rules('captcha', 'Captcha', 'trim|required');
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view("superadmin/login",$frm);
			}
			else
			{
				$expiration = time()-3600;
				$this->db->query("DELETE FROM captcha WHERE captcha_time < ".$expiration);
				
				$sql = "SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND captcha_time > ?";
				$binds = array($_POST['captcha'], $expiration);
				$query = $this->db->query($sql, $binds);
				$row = $query->row();
				
				if ($row->count == 0)
				{
					$this->session->set_flashdata('result_login','Kode captcha salah');
					header('location:'.base_url().'superadmin');
				}
				else
				{
					$u = $this->input->post('username');
					$p = $this->input->post('password');
					$this->app_login_superadmin_model->getLoginDataSuperadmin($u,$p);
				}
			}
		}
		else
		{
			$st = $this->session->userdata('stts');
			if($st=='superadmin')
			{
				header('location:'.base_url().'superadmin/home');
			}
			else
			{
				header('location:'.base_url().'');
			}
		}
	}
	 
	public function home()
	{
		$sess_log['last_form_login'] = "signup";
		$this->session->set_userdata($sess_log);
		$cek = $this->session->userdata('logged_in');
		$st = $this->session->userdata('stts');
		$cabang = $this->session->userdata("id_cabang");
		$departemen = $this->session->userdata("id_departemen");
		if(!empty($cek))
		{
			if($st=="superadmin")
			{
				$bc['online_support'] = $this->db->get("online_support");
				$bc['online'] = $this->db->get("online_support");
				$this->load->view("superadmin/header");
				$this->load->view("superadmin/home",$bc);
				$this->load->view("superadmin/footer");
			}
			else
			{
				header('location:'.base_url().'');
			}
		}
		else
		{
			if($st=='superadmin')
			{
				header('location:'.base_url().'superadmin/home');
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
			if($st=="superadmin")
			{
				$id['id_online_support'] = $this->uri->segment(3);
				$os = $this->db->get_where("online_support",$id);
				$bc = array();
				foreach($os->result() as $o)
				{
					$bc['id'] = $o->id_online_support;
					$bc['online_support'] = $o->online_support;
					$bc['st'] = "edit";
					$this->load->view("superadmin/bg_input",$bc);
				}
			}
			else
			{
				header('location:'.base_url().'');
			}
		}
		else
		{
			if($st=='superadmin')
			{
				header('location:'.base_url().'superadmin/home');
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
			if($st=="superadmin")
			{
				$id = $this->input->post('kode');
				$query = $this->db->query("delete from online_support where id_online_support IN (".$id.")");
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
			if($st=='superadmin')
			{
				header('location:'.base_url().'superadmin/home');
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
			if($st=="superadmin")
			{
				$bc['id'] = "";
				$bc['online_support'] = "";
				$bc['st'] = "tambah";
				$this->load->view("superadmin/bg_input",$bc);
			}
			else
			{
				header('location:'.base_url().'');
			}
		}
		else
		{
			if($st=='superadmin')
			{
				header('location:'.base_url().'superadmin/home');
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
			if($st=="superadmin")
			{
				$st = $this->input->post("st-input");
				$id['id'] = $this->input->post("id");
				
				$in['online_support'] = $this->input->post("online_support");
				$st = $this->input->post("st-input");
		
				$this->form_validation->set_rules('online_support', 'ID Online Support', 'trim|required');
				
				if ($this->form_validation->run() == FALSE)
				{
					if($st=="tambah")
					{
						$frm['id'] = "";
						$frm['online_support'] = "";
						$frm['st'] = "tambah";
						$this->load->view("superadmin/bg_input",$frm);
					}
					else if($st=="edit")
					{
						$frm['st'] = $st;
						$os = $this->db->get_where("online_support",$id);
						foreach($os->result() as $o)
						{
							$frm['id'] = $o->id_online_support;
							$frm['online_support'] = $o->online_support;
						}
						$this->load->view("superadmin/bg_input",$frm);
					}
				}
				else
				{
					if($st=="edit")
					{
						$this->db->update("online_support",$in,$id);
						?><script>window.parent.location.reload(true);</script><?php
					}
					else if($st=="tambah")
					{
						$this->db->insert("online_support",$in);
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
			if($st=='superadmin')
			{
				header('location:'.base_url().'superadmin/home');
			}
			else
			{
				header('location:'.base_url().'');
			}
		}
	}
}

/* End of file superadmin.php */
/* Location: ./application/controllers/superadmin.php */