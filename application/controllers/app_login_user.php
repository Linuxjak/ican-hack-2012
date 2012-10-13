<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App_Login_User extends CI_Controller {

	/**
	 * @author : Gede Lumbung
	 * @web : http://gedelumbung.com
	 * @keterangan : Controller untuk manajemen data login
	 **/
	 
	public function index()
	{
		$sess_log['last_form_login'] = "login";
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
				'placeholder' => 'Enter username'
			);
			$frm['password'] = array('name' => 'password',
				'id' => 'password',
				'type' => 'password',
				'class' => 'input-style1',
				'autocomplete' => 'off',
				'style' => 'width:320px;',
				'placeholder' => 'Enter password'
			);
			$frm['captcha_login'] = array('name' => 'captcha',
				'id' => 'captcha',
				'type' => 'text',
				'class' => 'input-style1',
				'autocomplete' => 'off',
				'style' => 'width:150px; float:left;',
				'placeholder' => 'Enter code'
			);
			
			$frm['val_login'][""] = "- Sign In As -";
			$frm['val_login']["1"] = "Administrator";
			
			//buat atribut form report
			$frm['nama_lengkap'] = array('name' => 'nama_lengkap',
				'id' => 'nama_lengkap',
				'type' => 'text',
				'class' => 'input-style1',
				'autocomplete' => 'off',
				'style' => 'width:320px;',
				'placeholder' => 'Enter full name'
			);
			$frm['email_report'] = array('name' => 'email_report',
				'id' => 'email_report',
				'type' => 'text',
				'class' => 'input-style1',
				'autocomplete' => 'off',
				'style' => 'width:320px;',
				'placeholder' => 'Enter email'
			);
			$frm['no_telp'] = array('name' => 'no_telp',
				'id' => 'no_telp',
				'type' => 'text',
				'class' => 'input-style1',
				'autocomplete' => 'off',
				'style' => 'width:320px;',
				'placeholder' => 'Enter phone number'
			);
			$frm['isi_report'] = array('name' => 'isi_report',
				'id' => 'isi_report',
				'type' => 'text',
				'class' => 'textarea-style',
				'autocomplete' => 'off',
				'style' => 'width:320px; height:60px;',
				'placeholder' => 'Enter report'
			);
			$frm['captcha_report'] = array('name' => 'captcha',
				'id' => 'captcha',
				'type' => 'text',
				'class' => 'input-style1',
				'autocomplete' => 'off',
				'style' => 'width:150px; float:left;',
				'placeholder' => 'Enter code'
			);
			
			$frm['report'] = $this->db->get("tbl_report_admin",30,0);
			$frm['berita'] = $this->db->get("tbl_berita",3,0);
			$frm['info'] = $this->db->get("tbl_sekilas_info");
			$frm['online'] = $this->db->get("online_support");
			
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$this->form_validation->set_rules('stts', 'Sign In As', 'trim|required');
			$this->form_validation->set_rules('captcha', 'Captcha', 'trim|required');
			
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
					$this->session->set_flashdata('result_login','Wrong captcha code');
					header('location:'.base_url().'app_login_user');
				}
				else
				{
					$u = $this->input->post('username');
					$p = $this->input->post('password');
					$st = $this->input->post('stts');
					$this->app_login_user_model->getLoginDataUser($u,$p,$st);
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
			else if($st=='siswa')
			{
				header('location:'.base_url().'siswa');
			}
			else if($st=='superadmin')
			{
				header('location:'.base_url().'superadmin');
			}
			else if($st=="kepala_sekolah_sma" || 
			$st=="wakil_kepala_sekolah_sma" ||
			$st=="kepala_sekolah_smp" || 
			$st=="wakil_kepala_sekolah_smp" ||
			$st=="kepala_sekolah_sd" || 
			$st=="wakil_kepala_sekolah_sd" ||
			$st=="kepala_sekolah_tk" || 
			$st=="wakil_kepala_sekolah_tk" || 
			$st=="kepala_sekolah_snc" || 
			$st=="wakil_kepala_sekolah_snc")
			{
				header('location:'.base_url().'kepsek_wakasek');
			}
			else if($st=="sekretaris_dep_sma" || 
			$st=="sekretaris_dep_smp" ||
			$st=="sekretaris_dep_sd" || 
			$st=="sekretaris_dep_tk" ||
			$st=="sekretaris_dep_snc" ||
			$st=="sekretaris_umum")
			{
				header('location:'.base_url().'sekretaris');
			}
		}
	}
	 
	public function lupa_password()
	{
		$sess_log['last_form_login'] = "login";
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
			
			
			//buat atribut form lupa password
			$frm['email'] = array('name' => 'email',
				'id' => 'email',
				'type' => 'text',
				'class' => 'input-style1',
				'autocomplete' => 'off',
				'style' => 'width:450px;',
				'placeholder' => 'Masukkan Email'
			);
			
			$frm['val_forget'] = array('' => '- Pilih Hak Akses -',
				'siswa' => 'Orang Tua Siswa',
				'guru' => 'Guru',
				'pegawai' => 'Pegawai'
			);
			
			$frm['captcha'] = array('name' => 'captcha',
				'id' => 'captcha',
				'type' => 'text',
				'class' => 'input-style1',
				'autocomplete' => 'off',
				'style' => 'width:150px; float:left;',
				'placeholder' => 'Masukkan kode'
			);
			
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
			$this->form_validation->set_rules('stts', 'Pilih Hak Akses', 'trim|required');
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view("app_login_user/lupa_pass",$frm);
			}
			else
			{
				$cari['email'] = $this->input->post('email');
				$st = $this->input->post('stts');
				if($st=="siswa")
				{
					$cek = $this->db->get_where("akunsiswa",$cari);
					if($cek->num_rows()>0)
					{
						$enkripsi = md5($cari['email'].time());
						$this->email->from("no-reply@sekolahglobalmandiri.sc.id", "Sekolah Global Mandiri");
						$this->email->to($cari['email']);
						$this->email->set_mailtype('html');
						$this->email->subject('Recovery Password - Sekolah Global Mandiri');
						$this->email->message('Klik link berikut ini untuk melakukan recovery password. <br>'.base_url().'/app_login_user/reset_pass/siswa/'.$enkripsi.'');
						$ml = $this->email->send();
						if($ml==TRUE)
						{
							$up['kode_forget'] = $enkripsi;
							$this->db->update("akunsiswa",$up,$cari);
							$this->session->set_flashdata('result_login', 
							"Kami telah mengirimkan link recovery password ke email anda, silahkan melakukan aktivasi via email.");
							header('location:'.base_url().'app_login_user/lupa_password');
						}
						else
						{
							$this->session->set_flashdata('result_login', 
							"Gagal mengirim email.");
							header('location:'.base_url().'app_login_user/lupa_password');
						}
					}
					else
					{
						$this->session->set_flashdata('result_login', "Alamat email tidak ada di dalam database siswa.");
						header('location:'.base_url().'app_login_user/lupa_password');
					}
				}
				else if($st=="pegawai")
				{
					$cek = $this->db->get_where("akunpegawai",$cari);
					if($cek->num_rows()>0)
					{
						$enkripsi = md5($in['email'].time());
						$this->email->from("no-reply@sekolahglobalmandiri.sc.id", "Sekolah Global Mandiri");
						$this->email->to($in['email']);
						$this->email->set_mailtype('html');
						$this->email->subject('Recovery Password - Sekolah Global Mandiri');
						$this->email->message('Klik link berikut ini untuk melakukan recovery password. <br>'.base_url().'/app_login_user/reset_pass/pegawai/'.$enkripsi.'');
						$ml = $this->email->send();
						if($ml==TRUE)
						{
							$up['kode_forget'] = $enkripsi;
							$this->db->update("akunpegawai",$up,$cari);
							$this->session->set_flashdata('result_login', 
							"Kami telah mengirimkan link recovery password ke email anda, silahkan melakukan aktivasi via email.");
							header('location:'.base_url().'app_login_user/lupa_password');
						}
						else
						{
							$this->session->set_flashdata('result_login', 
							"Gagal mengirim email.");
							header('location:'.base_url().'app_login_user/lupa_password');
						}
					}
					else
					{
						$this->session->set_flashdata('result_login', "Alamat email tidak ada di dalam database pegawai.");
						header('location:'.base_url().'app_login_user/lupa_password');
					}
				}
				else if($st=="guru")
				{
					$cek = $this->db->get_where("akunguru",$cari);
					if($cek->num_rows()>0)
					{
						$enkripsi = md5($in['email'].time());
						$this->email->from("no-reply@sekolahglobalmandiri.sc.id", "Sekolah Global Mandiri");
						$this->email->to($in['email']);
						$this->email->set_mailtype('html');
						$this->email->subject('Recovery Password - Sekolah Global Mandiri');
						$this->email->message('Klik link berikut ini untuk melakukan recovery password. <br>'.base_url().'/app_login_user/reset_pass/guru/'.$enkripsi.'');
						$ml = $this->email->send();
						if($ml==TRUE)
						{
							$up['kode_forget'] = $enkripsi;
							$this->db->update("akunguru",$up,$cari);
							$this->session->set_flashdata('result_login', 
							"Kami telah mengirimkan link recovery password ke email anda, silahkan melakukan aktivasi via email.");
							header('location:'.base_url().'app_login_user/lupa_password');
						}
						else
						{
							$this->session->set_flashdata('result_login', 
							"Gagal mengirim email.");
							header('location:'.base_url().'app_login_user/lupa_password');
						}
					}
					else
					{
						$this->session->set_flashdata('result_login', "Alamat email tidak ada di dalam database guru.");
						header('location:'.base_url().'app_login_user/lupa_password');
					}
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
			else if($st=='siswa')
			{
				header('location:'.base_url().'siswa');
			}
			else if($st=="kepala_sekolah_sma" || 
			$st=="wakil_kepala_sekolah_sma" ||
			$st=="kepala_sekolah_smp" || 
			$st=="wakil_kepala_sekolah_smp" ||
			$st=="kepala_sekolah_sd" || 
			$st=="wakil_kepala_sekolah_sd" ||
			$st=="kepala_sekolah_tk" || 
			$st=="wakil_kepala_sekolah_tk" || 
			$st=="kepala_sekolah_snc" || 
			$st=="wakil_kepala_sekolah_snc")
			{
				header('location:'.base_url().'kepsek_wakasek');
			}
		}
	}
	 
	public function reset_pass()
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
				$id['kode_forget'] = $kode;
				if($st=="siswa")
				{
					$cek = $this->db->get_where("akunsiswa",$id);
					if($cek->num_rows()>0)
					{
						//buat atribut form reset password
						$frm['password'] = array('name' => 'password',
							'id' => 'password',
							'type' => 'text',
							'class' => 'input-style1',
							'autocomplete' => 'off',
							'style' => 'width:450px;',
							'placeholder' => 'Masukkan Password Baru'
						);
						
						foreach($cek->result() as $c)
						{
							$frm['email'] = $c->email;
						}
						$frm['st'] = $st;
						$frm['kode'] = $kode;
						
						$this->form_validation->set_rules('password', 'Password', 'trim|required');
						if ($this->form_validation->run() == FALSE)
						{
							$this->load->view("app_login_user/reset_pass",$frm);
						}
						else
						{
							$up['pass'] = md5(mysql_real_escape_string($this->input->post('password').'appSIMAkademikSekolah32'));
							$up['kode_forget'] = "";
							$id_up['email'] = $this->input->post('email');
							$this->db->update("akunsiswa",$up,$id_up);
							$this->session->set_flashdata('result_login', 'Berhasil mengubah password. Silahkan login.');
							header('location:'.base_url().'');
						}
					}
					else
					{
						$this->session->set_flashdata('result_login', 'Kode reset password tidak valid.');
						header('location:'.base_url().'');
					}
				}
				else if($st=="pegawai")
				{
					$cek = $this->db->get_where("akunpegawai",$id);
					if($cek->num_rows()>0)
					{
						//buat atribut form reset password
						$frm['password'] = array('name' => 'password',
							'id' => 'password',
							'type' => 'text',
							'class' => 'input-style1',
							'autocomplete' => 'off',
							'style' => 'width:450px;',
							'placeholder' => 'Masukkan Password Baru'
						);
						
						foreach($cek->result() as $c)
						{
							$frm['email'] = $c->email;
						}
						$frm['st'] = $st;
						$frm['kode'] = $kode;
						
						$this->form_validation->set_rules('password', 'Password', 'trim|required');
						if ($this->form_validation->run() == FALSE)
						{
							$this->load->view("app_login_user/reset_pass",$frm);
						}
						else
						{
							$up['passpegawai'] = md5(mysql_real_escape_string($this->input->post('password').'appSIMAkademikSekolah32'));
							$up['kode_forget'] = "";
							$id_up['email'] = $this->input->post('email');
							$this->db->update("akunpegawai",$up,$id_up);
							$this->session->set_flashdata('result_login', 'Berhasil mengubah password. Silahkan login.');
							header('location:'.base_url().'');
						}
					}
					else
					{
						$this->session->set_flashdata('result_login', 'Kode reset password tidak valid.');
						header('location:'.base_url().'');
					}
				}
				else if($st=="guru")
				{
					$cek = $this->db->get_where("akunguru",$id);
					if($cek->num_rows()>0)
					{
						//buat atribut form reset password
						$frm['password'] = array('name' => 'password',
							'id' => 'password',
							'type' => 'text',
							'class' => 'input-style1',
							'autocomplete' => 'off',
							'style' => 'width:450px;',
							'placeholder' => 'Masukkan Password Baru'
						);
						
						foreach($cek->result() as $c)
						{
							$frm['email'] = $c->email;
						}
						$frm['st'] = $st;
						$frm['kode'] = $kode;
						
						$this->form_validation->set_rules('password', 'Password', 'trim|required');
						if ($this->form_validation->run() == FALSE)
						{
							$this->load->view("app_login_user/reset_pass",$frm);
						}
						else
						{
							$up['passguru'] = md5(mysql_real_escape_string($this->input->post('password').'appSIMAkademikSekolah32'));
							$up['kode_forget'] = "";
							$id_up['email'] = $this->input->post('email');
							$this->db->update("akunguru",$up,$id_up);
							$this->session->set_flashdata('result_login', 'Berhasil mengubah password. Silahkan login.');
							header('location:'.base_url().'');
						}
					}
					else
					{
						$this->session->set_flashdata('result_login', 'Kode reset password tidak valid.');
						header('location:'.base_url().'');
					}
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
			else if($st=='siswa')
			{
				header('location:'.base_url().'siswa');
			}
			else if($st=="kepala_sekolah_sma" || 
			$st=="wakil_kepala_sekolah_sma" ||
			$st=="kepala_sekolah_smp" || 
			$st=="wakil_kepala_sekolah_smp" ||
			$st=="kepala_sekolah_sd" || 
			$st=="wakil_kepala_sekolah_sd" ||
			$st=="kepala_sekolah_tk" || 
			$st=="wakil_kepala_sekolah_tk" || 
			$st=="kepala_sekolah_snc" || 
			$st=="wakil_kepala_sekolah_snc")
			{
				header('location:'.base_url().'kepsek_wakasek');
			}
		}
	}
	
	function logout()
	{
		$this->session->sess_destroy();
		header('location:'.base_url().'');
	}
}

/* End of file app_login_user.php */
/* Location: ./application/controllers/app_login_user.php */