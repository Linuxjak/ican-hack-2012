<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Berita extends CI_Controller {

	/**
	 * @author : Gede Lumbung
	 * @web : http://gedelumbung.com
	 * @keterangan : Controller untuk manajemen berita
	 **/
	 
	public function detail()
	{
		$data['berita'] = $this->db->get_where("tbl_berita",array('id_berita' => $this->uri->segment(3)));
		$r = $data['berita']->row();
			$data['konten'] = substr($r->isi,0,200);
		$this->load->view('app_login_user/detail_berita',$data);
	}
}

/* End of file berita.php */
/* Location: ./application/controllers/berita.php */