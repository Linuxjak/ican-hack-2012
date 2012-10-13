<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App_Login_User_Model extends CI_Model {

	/**
	 * @author : Gede Lumbung
	 * @web : http://gedelumbung.com
	 * @keterangan : Model untuk menangani semua query login
	 **/
	 
	//query login
	public function getLoginDataUser($usr,$psw,$st)
	{
		//orang tua siswa
		if($st=="13")
		{
			$u = mysql_real_escape_string($usr);
			$p = md5(mysql_real_escape_string($psw.'appSIMAkademikSekolah32'));
			$q_cek_pendataan = $this->db->get_where('datasiswa', array('nis' => $u));
			if($q_cek_pendataan->num_rows()>0)
			{
				$q_cek_login = $this->db->get_where('akunsiswa', array('nis' => $u, 'pass' => $p, 'stts' => "1", 'login_limit_time <' => time()));
				if(count($q_cek_login->result())>0)
				{
					$dt = $this->db->query("select * from datasiswa a left join akunsiswa b on a.nis=b.nis where a.nis='".$u."'");
					foreach($dt->result() as $qad)
					{
						$sess_data['logged_in'] = 'yesGetMeLoginBaby';
						$sess_data['nis'] = $qad->nis;
						$sess_data['nama'] = $qad->nama;
						$sess_data['stts'] = "siswa";
						$this->session->set_userdata($sess_data);
					}
					header('location:'.base_url().'siswa');
				}
				else
				{
					$sess_limit['limit_login'] = $this->session->userdata("limit_login")+1;
					$this->session->set_userdata($sess_limit);
					if($this->session->userdata("limit_login")>=3)
					{
						$id["nis"] = $u;
						$up['login_limit_time'] = time()+600;
						$this->db->update("akunsiswa",$up,$id);
						$this->session->set_flashdata('result_login', "NIS anda sementara terblokir hingga 10 menit ke depan");
					}
					else
					{
						$this->session->set_flashdata('result_login', "Gagal login...");
					}
					header('location:'.base_url().'');
				}
			}
			else
			{
				$this->session->set_flashdata('result_login', 
				"NIS tidak terdapat di dalam data siswa. Silahkan hubungi admin melalui <b>form report admin</b> untuk klarifikasi data.");
				header('location:'.base_url().'');
			}
		}
		//guru
		else if($st=="12")
		{
			$u = mysql_real_escape_string($usr);
			$p = md5(mysql_real_escape_string($psw.'appSIMAkademikSekolah32'));
			$q_cek_pendataan = $this->db->get_where('pegawai', array('NIP' => $u));
			if($q_cek_pendataan->num_rows()>0)
			{
				$q_cek_login = $this->db->get_where('akunguru', array('userguru' => $u, 'passguru' => $p, 'stts' => "1", 'login_limit_time <' => time()));
				if(count($q_cek_login->result())>0)
				{
					$dt = $this->db->query("select * from pegawai a left join akunguru b on a.NIP=b.userguru where a.NIP='".$u."' and a.Bagian='akademik'");
					foreach($dt->result() as $qad)
					{
						$sess_data['logged_in'] = 'yesGetMeLoginBaby';
						$sess_data['nis'] = $qad->nis;
						$sess_data['nama'] = $qad->nama;
						$sess_data['stts'] = "pegawai akademis";
						$this->session->set_userdata($sess_data);
					}
					header('location:'.base_url().'pegawai_akademis');
				}
				else
				{
					$sess_limit['limit_login'] = $this->session->userdata("limit_login")+1;
					$this->session->set_userdata($sess_limit);
					if($this->session->userdata("limit_login")>=3)
					{
						$id["userguru"] = $u;
						$up['login_limit_time'] = time()+600;
						$this->db->update("akunguru",$up,$id);
						$this->session->set_flashdata('result_login', "NIP anda sementara terblokir hingga 10 menit ke depan");
					}
					else
					{
						$this->session->set_flashdata('result_login', "Gagal login...");
					}
					header('location:'.base_url().'');
				}
			}
			else
			{
				$this->session->set_flashdata('result_login', 
				"NIP tidak terdapat di dalam data pegawai. Silahkan hubungi admin melalui <b>form report admin</b> untuk klarifikasi data.");
				header('location:'.base_url().'');
			}
		}
		//administrator
		else if($st=="1")
		{
			$u = mysql_real_escape_string($usr);
			$p = md5(mysql_real_escape_string($psw.'appSIMAkademikSekolah32'));
			$q_cek_login = $this->db->get_where('user', array('user' => $u, 'pass' => $p, 'stts' => "1", 'id_akses' => '1', 'login_limit_time <' => time()));
			if(count($q_cek_login->result())>0)
			{
				foreach($q_cek_login->result() as $qad)
				{
					$sess_data['logged_in'] = 'yesGetMeLoginBaby';
					$sess_data['username'] = $qad->user;
					$sess_data['nama'] = $qad->nama;
					$sess_data['stts'] = 'admin';
					$this->session->set_userdata($sess_data);
				}
				header('location:'.base_url().'admin');
			}
			else
			{
				$this->session->set_flashdata('result_login', "Gagal login...");
				header('location:'.base_url().'');
			}
		}
		//staf default
		else
		{
			$u = mysql_real_escape_string($usr);
			$p = md5(mysql_real_escape_string($psw.'appSIMAkademikSekolah32'));
			$q_cek_login = $this->db->get_where('user', array('user' => $u, 'pass' => $p, 'stts' => "1", 'id_akses' => $st, 'login_limit_time <' => time()));
			if(count($q_cek_login->result())>0)
			{
				$get_data = $this->db->query("select * from user a left join jabatanakses b on a.id_akses=b.id where a.user='".$u."' and a.pass='".$p."' and a.stts='1' and
				a.login_limit_time<=".time()."");
				foreach($get_data->result() as $qad)
				{
					$sess_data['logged_in'] = 'yesGetMeLoginBaby';
					$sess_data['nama'] = $qad->nama;
					$sess_data['stts'] = $qad->jabatan;
					$sess_data['id_departemen_login'] = $qad->id_departemen;
					$this->session->set_userdata($sess_data);
				}
				header('location:'.base_url().'');
			}
			else
			{
				$sess_limit['limit_login'] = $this->session->userdata("limit_login")+1;
				$this->session->set_userdata($sess_limit);
				if($this->session->userdata("limit_login")>=3)
				{
					$id["userpegawai"] = $u;
					$up['login_limit_time'] = time()+600;
					$this->db->update("akunpegawai",$up,$id);
					$this->session->set_flashdata('result_login', "NIP anda sementara terblokir hingga 10 menit ke depan");
				}
				else
				{
					$this->session->set_flashdata('result_login', "Gagal login...");
				}
				header('location:'.base_url().'');
			}
		}
	}
}

/* End of file app_login_user_model.php */
/* Location: ./application/models/app_login_user_model.php */