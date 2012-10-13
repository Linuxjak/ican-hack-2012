<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Android_App extends CI_Controller {

	/**
	 * @author : Gede Lumbung
	 * @web : http://gedelumbung.com
	 * @keterangan : Controller untuk aplikasi android siswa
	 **/
	 
	public function index()
	{
		echo "Forbidden";
	}
	 
	public function act_login()
	{
		$response = array();
		if (isset($_POST["username"]) && isset($_POST["password"])) 
		{
			$data['nis'] = mysql_real_escape_string($this->input->post("username"));
			$data['pass'] = md5(mysql_real_escape_string($this->input->post("password").'appSIMAkademikSekolah32'));;
		 
			$cek_login = $this->db->get_where("akunsiswa",$data);
		 
			if ($cek_login->num_rows()>0) 
			{
				$response["success"] = 1;
				$response["message"] = "Berhasil Login...";
				
				$detail['nis'] = mysql_real_escape_string($this->input->post("username"));
				$data_login = $this->db->get_where("datasiswa",$detail);
				foreach($data_login->result() as $d)
				{
					$response["username"] = $d->nis;
					$response["nama"] = $d->nama;
				}
				
				echo json_encode($response);
			} 
			else 
			{
				$response["success"] = 0;
				$response["message"] = "Username atau Password salah...";
				echo json_encode($response);
			}
		} 
		else 
		{
			$response["success"] = 0;
			$response["message"] = "Forbidden";
			echo json_encode($response);
		}
	}
	 
	public function get_sekilas_info()
	{
		 $get_info = $this->db->get("tbl_sekilas_info",30,0);
		 $v = '{"info" : [';
		 foreach($get_info->result() as $gi)
		 {
			$ob = array("<br>","<b>","</b>","<p>","</p>");
			if(strlen($v)<12)
			{
				$v .= '{"id" : "'.$gi->kode_sekilas_info.'", "judul" : "'.$gi->judul.'", "tgl" : "'.$gi->waktu.'"}';
			}
			else
			{
				$v .= ',{"id" : "'.$gi->kode_sekilas_info.'", "judul" : "'.$gi->judul.'", "tgl" : "'.$gi->waktu.'"}';
			}
		
		}
		$v .= ']}';
		echo $v;
		 
	}
	 
	public function get_detail_sekilas_info()
	{
		$id['kode_sekilas_info'] = $this->uri->segment(3);
		$get_info = $this->db->get_where("tbl_sekilas_info",$id);
		$v = '{"detailinfo" : [';
		foreach($get_info->result() as $gi)
		{
			$ob = array("<br>","<b>","</b>","<p>","</p>","&nbsp;");
			$v .= '{"id" : "'.$gi->kode_sekilas_info.'", "judul" : "'.$gi->judul.'", "tgl" : "'.$gi->waktu.'", "isi" : "'.str_replace($ob,"",$gi->isi_info).'"}';
		}
		$v .= ']}';
		echo $v;
		 
	}
	 
	public function get_data_siswa()
	{
		$id['username'] = $this->uri->segment(3);
		$get_detail_siswa = $this->db->query("SELECT a.id,departemen,tingkat,d.tahunAjaran,kelas,nama,kelamin,tempatLahir,
		tanggalLahir,bulanLahir,tahunLahir,agama,kewarganegaraan,anakKe,dari,bahasa,kodePos,telepon,handphone,email,asalSekolah,tahunMasuk,
		ketasalsekolah,golonganDarah,berat,tinggi,riwayatPenyakit,namaAyah,namaIbu,pendidikanAyah,pendidikanIbu,pekerjaanIbu,pekerjaanAyah,penghasilanAyah,
		penghasilanIbu,emailAyah,emailIbu,ayahAlmarhum,ibuAlmarhum,nis,agamaAyah,agamaIbu,wargaAyah,wargaIbu,teleponAyah,teleponIbu,handphoneAyah,
		handphoneIbu,alamatAyah,alamatIbu,tempatLahirAyah,tempatLahirIbu,tanggalLahirAyah,tanggalLahirIbu,jabatanAyah,jabatanIbu,alamatkantorAyah,
		alamatkantorIbu,namaWali,alamatWali,teleponwali,handphonewali,emailwali,ketlulus,alamatSurat,a.keterangan FROM datasiswa a left join 
		departemen b on a.id_departemen=b.id left join tingkat c on a.id_tingkat=c.id left join 
		tahunajaran d on a.id_tahun_ajaran=d.id left join kelas e on a.id_kelas=e.id where a.nis='".$id['username']."'");
		$id_kesehatan['idSiswa'] = "";
		$v = '{"detailsiswa" : [';
		foreach($get_detail_siswa->result() as $gi)
		{
			$id_kesehatan['idSiswa'] = $gi->id;
			$kelamin = "";
			if($gi->kelamin=="l"){ $kelamin = "Laki-Laki"; } else { $kelamin = "Perempuan"; }
			$v .= '
			{
			"nama_departemen" : "'.$gi->departemen.'", 
			"tingkat" : "'.$gi->tingkat.'", 
			"tahun_ajaran" : "'.$gi->tahunAjaran.'",
			"kelas" : "'.$gi->kelas.'",
			"nama" : "'.$gi->nama.'",
			"kelamin" : "'.$kelamin.'",
			"tempat_lahir" : "'.$gi->tempatLahir.'",
			"tanggal_lahir" : "'.$gi->tanggalLahir.'-'.$gi->bulanLahir.'-'.$gi->tahunLahir.'",
			"agama" : "'.$gi->agama.'",
			"kewarganegaraan" : "'.$gi->kewarganegaraan.'",
			"anakKe" : "'.$gi->anakKe.' dari '.$gi->dari.' bersaudara",
			"bahasa" : "'.$gi->bahasa.'",
			"kodePos" : "'.$gi->kodePos.'",
			"telepon" : "'.$gi->telepon.'",
			"handphone" : "'.$gi->handphone.'",
			"email" : "'.$gi->email.'",
			"asalSekolah" : "'.$gi->asalSekolah.'",
			"tahunMasuk" : "'.$gi->tahunMasuk.'",
			"ketasalsekolah" : "'.$gi->ketasalsekolah.'",
			"golonganDarah" : "'.$gi->golonganDarah.'",
			"berat" : "'.$gi->berat.'",
			"tinggi" : "'.$gi->tinggi.'",
			"riwayatPenyakit" : "'.$gi->riwayatPenyakit.'",
			"namaAyah" : "'.$gi->namaAyah.'",
			"namaIbu" : "'.$gi->namaIbu.'",
			"pendidikanAyah" : "'.$gi->pendidikanAyah.'",
			"pendidikanIbu" : "'.$gi->pendidikanIbu.'",
			"pekerjaanAyah" : "'.$gi->pekerjaanAyah.'",
			"pekerjaanIbu" : "'.$gi->pekerjaanIbu.'",
			"penghasilanAyah" : "'.$gi->penghasilanAyah.'",
			"penghasilanIbu" : "'.$gi->penghasilanIbu.'",
			"emailAyah" : "'.$gi->emailAyah.'",
			"emailIbu" : "'.$gi->emailIbu.'",
			"ayahAlmarhum" : "'.$gi->ayahAlmarhum.'",
			"ibuAlmarhum" : "'.$gi->ibuAlmarhum.'",
			"nis" : "'.$gi->nis.'",
			"agamaAyah" : "'.$gi->agamaAyah.'",
			"agamaIbu" : "'.$gi->agamaIbu.'",
			"wargaAyah" : "'.$gi->wargaAyah.'",
			"wargaIbu" : "'.$gi->wargaIbu.'",
			"teleponAyah" : "'.$gi->teleponAyah.'",
			"teleponIbu" : "'.$gi->teleponIbu.'",
			"handphoneAyah" : "'.$gi->handphoneAyah.'",
			"handphoneIbu" : "'.$gi->handphoneIbu.'",
			"alamatAyah" : "'.$gi->alamatAyah.'",
			"alamatIbu" : "'.$gi->alamatIbu.'",
			"tempatLahirAyah" : "'.$gi->tempatLahirAyah.'",
			"tempatLahirIbu" : "'.$gi->tempatLahirIbu.'",
			"tanggalLahirAyah" : "'.$gi->tanggalLahirAyah.'",
			"tanggalLahirIbu" : "'.$gi->tanggalLahirIbu.'",
			"jabatanAyah" : "'.$gi->jabatanAyah.'",
			"jabatanIbu" : "'.$gi->jabatanIbu.'",
			"alamatkantorAyah" : "'.$gi->alamatkantorAyah.'",
			"alamatkantorIbu" : "'.$gi->alamatkantorIbu.'",
			"namaWali" : "'.$gi->namaWali.'",
			"alamatWali" : "'.$gi->alamatWali.'",
			"teleponwali" : "'.$gi->teleponwali.'",
			"handphonewali" : "'.$gi->handphonewali.'",
			"emailwali" : "'.$gi->emailwali.'",
			"ketlulus" : "'.$gi->ketlulus.'",
			"alamatSurat" : "'.$gi->alamatSurat.'",
			"keterangan" : "'.$gi->keterangan.'",';
		}
		
		$get_detail_kesehatan_siswa = $this->db->get_where("datakesehatansiswa",$id_kesehatan);
		foreach($get_detail_kesehatan_siswa->result() as $gdks)
		{
			$v .= '
			"no_darurat" : "'.$gdks->noDarurat.'", 
			"no_rs" : "'.$gdks->noRS.'", 
			"no_dokter" : "'.$gdks->noDokter.'", 
			"alergi_obat" : "'.$gdks->alergiObat.'", 
			"kacamata" : "'.$gdks->kacamata.'", 
			"alatbantudengar" : "'.$gdks->alatbantudengar.'", 
			"iyapengobatan" : "'.$gdks->iyapengobatan.'\n'.$gdks->pengobatan.'", 
			"iyaoperasi" : "'.$gdks->iyaoperasi.'\n'.$gdks->operasi.'", 
			"iyapsikologis" : "'.$gdks->iyapsikologis.'\n'.$gdks->masalahpsikologis.'", 
			"iyaadd" : "'.$gdks->iyaadd.'\n'.$gdks->masalahadd.'", 
			"iyahidung" : "'.$gdks->iyahidung.'\n'.$gdks->masalahhidung.'", 
			"iyaepilepsi" : "'.$gdks->iyaepilepsi.'\n'.$gdks->epilepsi.'", 
			"iyatulang" : "'.$gdks->iyatulang.'\n'.$gdks->sakittulang.'", 
			"iyakulit" : "'.$gdks->iyakulit.'\n'.$gdks->sakitkulit.'", 
			"migrain" : "'.$gdks->migrain.'", 
			"iyabenda" : "'.$gdks->iyabenda.'\n'.$gdks->alergiBenda.'",
			"iyaturunan" : "'.$gdks->iyaturunan.'\n'.$gdks->sakitturunan.'"
			}';
		}
		$v .= ']}';
		echo $v;
		 
	}
	 
	public function kirim_hubungi()
	{
		$response = array();
		if (isset($_POST["nama_lengkap"]) && isset($_POST["email"]) && isset($_POST["no_telp"]) && isset($_POST["isi_report"])) 
		{
			$data['nama_lengkap'] = mysql_real_escape_string($this->input->post("nama_lengkap"));
			$data['email'] = mysql_real_escape_string($this->input->post("email"));
			$data['no_telp'] = mysql_real_escape_string($this->input->post("no_telp"));
			$data['isi_report'] = mysql_real_escape_string($this->input->post("isi_report"));
		 
			$simpan = $this->db->insert("tbl_report_admin",$data);
		 
			if ($simpan) 
			{
				$response["success"] = 1;
				$response["message"] = "Berhasil Menyimpan Data...";
				
				echo json_encode($response);
			} 
			else 
			{
				$response["success"] = 0;
				$response["message"] = "Gagal Menyimpan Data...";
				echo json_encode($response);
			}
		} 
		else 
		{
			$response["success"] = 0;
			$response["message"] = "Forbidden";
			echo json_encode($response);
		}
		 
	}
}

/* End of file android_app.php */
/* Location: ./application/controllers/android_app.php */