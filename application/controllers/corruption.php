<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Corruption extends CI_Controller {

	/**
	 * @author : Gede Lumbung
	 * @web : http://gedelumbung.com
	 * @keterangan : Controller untuk manajemen corruption
	 **/
	 
	public function detail()
	{
		$data['report'] = $this->db->get_where("tbl_report_admin",array('kode_report' => $this->uri->segment(3)));
		$this->load->view('app_login_user/detail_korupsi',$data);
	}
}

/* End of file corruption.php */
/* Location: ./application/controllers/corruption.php */