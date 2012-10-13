<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App_Report_User extends CI_Controller {

	/**
	 * @author : Gede Lumbung 
	 * @web : http://gedelumbung.com
	 * @keterangan : Controller untuk manajemen data report to admin
	 **/
	 
	public function index()
	{
		$sess_log['last_form_login'] = "report";
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
			$frm['val_login']["1"] = "Administrator";
			
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
				'style' => 'width:320px; height:60px;',
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
			
			$this->form_validation->set_rules('nama_lengkap', 'Full Name', 'trim|required');
			$this->form_validation->set_rules('email_report', 'Email', 'trim|required|valid_email');
			$this->form_validation->set_rules('no_telp', 'Phone Number', 'trim|required|is_natural');
			$this->form_validation->set_rules('isi_report', 'Message', 'trim|required');
			$this->form_validation->set_rules('captcha', 'Captcha Code', 'trim|required');
			
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
						$in['email'] = $this->input->post('email_report');
						$in['no_telp'] = $this->input->post('no_telp');
						$in['isi_report'] = $this->input->post('isi_report');
						$in['gambar'] = $data['file_name'];
						
						$this->db->insert("tbl_report_admin",$in);
						unlink("./asset/corruption/".$data['file_name']."");
						$this->session->set_flashdata('result_login', 'Data report successfully sent, we will immediately report you. Thank you.');
						header('location:'.base_url().'');
					}
					else {
						$this->session->set_flashdata('result_login', 'Failed to upload your report.');
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

/* End of file app_report_user.php */
/* Location: ./application/controllers/app_report_user.php */