<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mobile extends CI_Controller {

	/**
	 * @author : Gede Lumbung
	 * @web : http://gedelumbung.com
	 * @keterangan : Controller untuk aplikasi mobile
	 **/
	 
	public function index()
	{
		$this->load->view("mobile/dashboard");
	}
	 
	public function news_splash()
	{
		$data['info'] = $this->db->get("tbl_sekilas_info",10,0);
		$this->load->view("mobile/news_splash",$data);
	}
	 
	public function contact_us()
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
		
		$this->form_validation->set_rules('nama_lengkap', 'Full Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('no_telp', 'Phone Number', 'trim|required|is_natural');
		$this->form_validation->set_rules('isi_report', 'Message', 'trim|required');
		$this->form_validation->set_rules('captcha', 'Code', 'trim|required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view("mobile/form_report",$frm);
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
				$this->session->set_flashdata('result_report','Wrong captcha code');
				header('location:'.base_url().'mobile/contact_us');
			}
			else
			{
				$acak=rand(00000000000,99999999999);
				$bersih=$_FILES['userfile']['name'];
				$nm=str_replace(" ","_","$bersih");
				$pisah=explode(".",$nm);
				$nama_murni_lama = preg_replace("/^(.+?);.*$/", "\\1",$pisah[0]);
				$nama_murni=date('Ymd-His');
				$ekstensi_kotor = $pisah[1];
				
				$file_type = preg_replace("/^(.+?);.*$/", "\\1", $ekstensi_kotor);
				$file_type_baru = strtolower($file_type);
				
				$ubah=$acak.'-'.$nama_murni; //tanpa ekstensi
				$n_baru = $ubah.'.'.$file_type_baru;
				
				$config['upload_path']	= "./asset/corruption/";
				$config['allowed_types']= 'gif|jpg|png|jpeg';
				$config['file_name'] = $n_baru;
				$config['max_size']     = '2500';
				$config['max_width']  	= '2000';
				$config['max_height']  	= '2000';
		 
				$this->load->library('upload', $config);
		 
				if ($this->upload->do_upload("userfile")) {
					$data	 	= $this->upload->data();
		 
					/* PATH */
					$source             = "./asset/corruption/".$data['file_name'] ;
					$destination_thumb	= "./asset/corruption/thumb/" ;
					$destination_medium	= "./asset/corruption/medium/" ;
		 
					// Permission Configuration
					chmod($source, 0777) ;
		 
					/* Resizing Processing */
					// Configuration Of Image Manipulation :: Static
					$this->load->library('image_lib') ;
					$img['image_library'] = 'GD2';
					$img['create_thumb']  = TRUE;
					$img['maintain_ratio']= TRUE;
		 
					/// Limit Width Resize
					$limit_medium   = 900 ;
					$limit_thumb    = 120 ;
		 
					// Size Image Limit was using (LIMIT TOP)
					$limit_use  = $data['image_width'] > $data['image_height'] ? $data['image_width'] : $data['image_height'] ;
		 
					// Percentase Resize
					if ($limit_use > $limit_medium || $limit_use > $limit_thumb) {
						$percent_medium = $limit_medium/$limit_use ;
						$percent_thumb  = $limit_thumb/$limit_use ;
					}
		 
					//// Making THUMBNAIL ///////
					$img['width']  = $limit_use > $limit_thumb ?  $data['image_width'] * $percent_thumb : $data['image_width'] ;
					$img['height'] = $limit_use > $limit_thumb ?  $data['image_height'] * $percent_thumb : $data['image_height'] ;
		 
					// Configuration Of Image Manipulation :: Dynamic
					$img['thumb_marker'] = '';
					$img['quality']      = '100%' ;
					$img['source_image'] = $source ;
					$img['new_image']    = $destination_thumb ;
		 
					// Do Resizing
					$this->image_lib->initialize($img);
					$this->image_lib->resize();
					$this->image_lib->clear() ;
		 
					////// Making MEDIUM /////////////
					$img['width']   = $limit_use > $limit_medium ?  $data['image_width'] * $percent_medium : $data['image_width'] ;
					$img['height']  = $limit_use > $limit_medium ?  $data['image_height'] * $percent_medium : $data['image_height'] ;
		 
					// Configuration Of Image Manipulation :: Dynamic
					$img['thumb_marker'] = '';
					$img['quality']      = '100%' ;
					$img['source_image'] = $source ;
					$img['new_image']    = $destination_medium ;
		 
					// Do Resizing
					$this->image_lib->initialize($img);
					$this->image_lib->resize();
					$this->image_lib->clear() ;
					
					$in['nama_lengkap'] = $this->input->post('nama_lengkap');
					$in['email'] = $this->input->post('email');
					$in['no_telp'] = $this->input->post('no_telp');
					$in['isi_report'] = $this->input->post('isi_report');
					$in['gambar'] = $data['file_name'];
					
					$this->db->insert("tbl_report_admin",$in);
					unlink("./asset/corruption/".$data['file_name']."");
					header('location:'.base_url().'mobile');
					$this->session->set_flashdata('result_report', 'Data report successfully sent, we will immediately report you. Thank you.');
				}
				else {
					$this->session->set_flashdata('result_login', 'Failed to upload your report.');
				}
			}
		}
	}
	 
	public function search_news_splash()
	{
		$data['info'] = $this->db->get("tbl_sekilas_info");
		$this->load->view("mobile/search_news_splash",$data);
	}
	 
	public function detail_news_splash()
	{
		$data['info'] = $this->db->get_where("tbl_sekilas_info",array("kode_sekilas_info" => $this->uri->segment(3)));
		$this->load->view("mobile/news_splash",$data);
	}
	 
	public function korupsi()
	{
		$data['korupsi'] = $this->db->get("tbl_report_admin",20,0);
		$this->load->view("mobile/korupsi",$data);
	}
	 
	public function berita()
	{
		$data['berita'] = $this->db->get("tbl_berita",30,0);
		$this->load->view("mobile/berita",$data);
	}
}

/* End of file mobile.php */
/* Location: ./application/controllers/mobile.php */