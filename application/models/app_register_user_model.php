<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App_Register_User_Model extends CI_Model {

	/**
	 * @author : Gede Lumbung
	 * @web : http://gedelumbung.com
	 * @keterangan : Model untuk menangani semua query registrasi
	 **/
	 
	//query login
	public function getRegisterDataUser($dt)
	{
		$dt['first_name'] = $dt['first_name'];
		$dt['last_name'] = $dt['last_name'];
		$dt['gender'] = $dt['gender'];
		$dt['birth'] = $dt['birth'];
		$dt['address'] = $dt['address'];
		$dt['occupation'] = $dt['occupation'];
		$dt['organization'] = $dt['organization'];
		$dt['email'] = $dt['email'];
		$dt['phone_number'] = $dt['phone_number'];
		$dt['password'] = md5($dt['password'].'appSIMAkademikSekolah32');
		
		$q_cek_pendataan = $this->db->get_where('tbl_user', array('email' => $dt['email']));
		
		if($q_cek_pendataan->num_rows()>0)
		{
			$this->session->set_flashdata('result_login', "Email already exist.");
			header('location:'.base_url().'app_register_user');
		}
		else
		{
			$this->db->insert("tbl_user",$dt);
			$this->session->set_flashdata('result_login', "Success save your data.");
			header('location:'.base_url().'');
		}
	}
}

/* End of file app_register_user_model.php */
/* Location: ./application/models/app_register_user_model.php */