<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App_Login_Superadmin_Model extends CI_Model {

	/**
	 * @author : Gede Lumbung
	 * @web : http://gedelumbung.com
	 * @keterangan : Model untuk menangani semua query login superadmin
	 **/
	 
	//query login
	public function getLoginDataSuperadmin($usr,$psw)
	{
		$u = mysql_real_escape_string($usr);
		$p = md5(mysql_real_escape_string($psw.'appSIMAkademikSekolah32'));
		$q_cek_login = $this->db->get_where('tbl_super_admin', array('username' => $u, 'pass' => $p, 'stts' => "1", 'login_limit_time <' => time()));
		if(count($q_cek_login->result())>0)
		{
			foreach($q_cek_login->result() as $qad)
			{
				$sess_data['logged_in'] = 'yesGetMeLoginBaby';
				$sess_data['username'] = $qad->username;
				$sess_data['nama'] = $qad->nama;
				$sess_data['stts'] = "superadmin";
				$this->session->set_userdata($sess_data);
			}
			header('location:'.base_url().'superadmin/home');
		}
		else
		{
			$sess_limit['limit_login'] = $this->session->userdata("limit_login")+1;
			$this->session->set_userdata($sess_limit);
			if($this->session->userdata("limit_login")>=3)
			{
				$id["username"] = $u;
				$up['login_limit_time'] = time()+600;
				$this->db->update("tbl_super_admin",$up,$id);
				$this->session->set_flashdata('result_login', "Akun anda terblokir hingga 10 menit ke depan");
			}
			else
			{
				$this->session->set_flashdata('result_login', "Gagal login...");
			}
			header('location:'.base_url().'');
		}
	}
}

/* End of file app_login_superadmin_model.php */
/* Location: ./application/models/app_login_superadmin_model.php */