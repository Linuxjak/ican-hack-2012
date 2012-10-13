<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App_Register_User extends CI_Controller {

	/**
	 * @author : Gede Lumbung
	 * @web : http://gedelumbung.com
	 * @keterangan : Controller untuk manajemen data registrasi
	 **/
	 
	public function index()
	{
		$sess_log['last_form_login'] = "signup";
		$this->session->set_userdata($sess_log);
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
			
			
			$q_sign_in = $this->db->get("jabatanakses");
			//buat atribut form login
			$frm['username'] = array('name' => 'username',
				'id' => 'username',
				'type' => 'text',
				'class' => 'input-style1',
				'autocomplete' => 'off',
				'style' => 'width:320px;',
				'placeholder' => 'Enter Username'
			);
			$frm['password'] = array('name' => 'password',
				'id' => 'password',
				'type' => 'password',
				'class' => 'input-style1',
				'autocomplete' => 'off',
				'style' => 'width:320px;',
				'placeholder' => 'Enter Password'
			);
			$frm['captcha_login'] = array('name' => 'captcha',
				'id' => 'captcha',
				'type' => 'text',
				'class' => 'input-style1',
				'autocomplete' => 'off',
				'style' => 'width:150px; float:left;',
				'placeholder' => 'Enter Code'
			);
			
			$frm['val_login'][""] = "- Sign In As -";
			foreach($q_sign_in->result() as $qsi)
			{
				$frm['val_login'][$qsi->id] = $qsi->nama_jabatan;
			}
			
			
			$q_sign_up = $this->db->get_where("jabatanakses",array("register" => 1));
			//buat atribut form registrasi
			$frm['username_register'] = array('name' => 'username_register',
				'id' => 'username_register',
				'type' => 'text',
				'class' => 'input-style1',
				'autocomplete' => 'off',
				'style' => 'width:320px;',
				'placeholder' => 'Masukkan NIS atau NIP'
			);
			$frm['email_register'] = array('name' => 'email_register',
				'id' => 'email_register',
				'type' => 'text',
				'class' => 'input-style1',
				'autocomplete' => 'off',
				'style' => 'width:320px;',
				'placeholder' => 'Enter Email Email'
			);
			$frm['password_register'] = array('name' => 'password_register',
				'id' => 'password_register',
				'type' => 'password',
				'class' => 'input-style1',
				'autocomplete' => 'off',
				'style' => 'width:320px;',
				'placeholder' => 'Enter Password'
			);
			$frm['captcha_register'] = array('name' => 'captcha',
				'id' => 'captcha',
				'type' => 'text',
				'class' => 'input-style1',
				'autocomplete' => 'off',
				'style' => 'width:150px; float:left;',
				'placeholder' => 'Enter Code'
			);
			$frm['val_register'][""] = "- Sign Up As -";
			foreach($q_sign_up->result() as $qsu)
			{
				$frm['val_register'][$qsu->jabatan] = $qsu->nama_jabatan;
			}
			
			//buat atribut form report
			$frm['nama_lengkap'] = array('name' => 'nama_lengkap',
				'id' => 'nama_lengkap',
				'type' => 'text',
				'class' => 'input-style1',
				'autocomplete' => 'off',
				'style' => 'width:320px;',
				'placeholder' => 'Enter Full Name'
			);
			$frm['email_report'] = array('name' => 'email_report',
				'id' => 'email_report',
				'type' => 'text',
				'class' => 'input-style1',
				'autocomplete' => 'off',
				'style' => 'width:320px;',
				'placeholder' => 'Enter Email'
			);
			$frm['no_telp'] = array('name' => 'no_telp',
				'id' => 'no_telp',
				'type' => 'text',
				'class' => 'input-style1',
				'autocomplete' => 'off',
				'style' => 'width:320px;',
				'placeholder' => 'Enter Phone Number'
			);
			$frm['isi_report'] = array('name' => 'isi_report',
				'id' => 'isi_report',
				'type' => 'text',
				'class' => 'textarea-style',
				'autocomplete' => 'off',
				'style' => 'width:320px; height:100px;',
				'placeholder' => 'Enter Report'
			);
			$frm['captcha_report'] = array('name' => 'captcha',
				'id' => 'captcha',
				'type' => 'text',
				'class' => 'input-style1',
				'autocomplete' => 'off',
				'style' => 'width:150px; float:left;',
				'placeholder' => 'Enter Code'
			);
			
			$frm['report'] = $this->db->get("tbl_report_admin",30,0);
			$frm['berita'] = $this->db->get("tbl_berita",3,0);
			$frm['info'] = $this->db->get("tbl_sekilas_info");
			$frm['online'] = $this->db->get("online_support");
			
			$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
			$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
			$this->form_validation->set_rules('gender', 'Gender', 'trim|required');
			$this->form_validation->set_rules('birth', 'Date of Birth', 'trim|required');
			$this->form_validation->set_rules('address', 'Address', 'trim|required');
			$this->form_validation->set_rules('occupation', 'Occupation', 'trim|required');
			$this->form_validation->set_rules('organization', 'Organization', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
			$this->form_validation->set_rules('phone_number', 'Phone Number', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view("app_login_user/login",$frm);
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
					$this->session->set_flashdata('result_login','Wrong Captcha Code');
					header('location:'.base_url().'app_register_user');
				}
				else
				{
			
					$dt['first_name'] = $this->input->post('first_name');
					$dt['last_name'] = $this->input->post('last_name');
					$dt['gender'] = $this->input->post('gender');
					$dt['birth'] = $this->input->post('birth');
					$dt['address'] = $this->input->post('address');
					$dt['occupation'] = $this->input->post('occupation');
					$dt['organization'] = $this->input->post('organization');
					$dt['email'] = $this->input->post('email');
					$dt['phone_number'] = $this->input->post('phone_number');
					$dt['password'] = $this->input->post('password');
					$this->app_register_user_model->getRegisterDataUser($dt);
				}
			}
		}
		else
		{
			$st = $this->session->userdata('stts');
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
		}
	}
	 
	public function aktivasi()
	{
		$sess_log['last_form_login'] = "login";
		$this->session->set_userdata($sess_log);
		$cek = $this->session->userdata('logged_in');
		if(empty($cek))
		{
			$st = $this->uri->segment(3);
			$kode = $this->uri->segment(4);
			if($st=="" || $kode=="")
			{
				$this->session->set_flashdata('result_login', 'Ilegal akses.');
				header('location:'.base_url().'');
			}
			else
			{
				$this->app_register_user_model->getAktivasi($st,$kode);
			}
		}
		else
		{
			$st = $this->session->userdata('stts');
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
		}
	}
}

/* End of file app_register_user.php */
/* Location: ./application/controllers/app_register_user.php */