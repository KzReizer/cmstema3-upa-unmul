<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Aksesapi
{

	
	public function Getkaryawan($nip)
	{

		$url = 'https://sidak.unmul.ac.id/api/pegawai/dtpegawai';
		// $apiKey = '}0isKLX3*M3_|J5';
		$auth_name = 'team_rnd';
		$auth_pass = 'RNDUnmul2020'; 
		$data = implode('&',array(
			'nip='.$nip,
			'RND-API-KEY=feb'
		));
		$curl_handle = curl_init();
		curl_setopt($curl_handle, CURLOPT_URL, $url);
		curl_setopt($curl_handle, CURLOPT_POST, 1);
		curl_setopt($curl_handle, CURLOPT_POSTFIELDS,  $data);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl_handle, CURLOPT_USERPWD, $auth_name.':'.$auth_pass); 
		$buffer = curl_exec($curl_handle);
		curl_close($curl_handle);

		$result = json_decode($buffer);

		return  $result;
	}

	public function Getkaryawanunit()
	{

		$url = 'https://sidak.unmul.ac.id/api/pegawai/dtpegawaiunit';
		// $apiKey = '}0isKLX3*M3_|J5';
		$auth_name = 'team_rnd';
		$auth_pass = 'RNDUnmul2020'; 
		$data = implode('&',array(
			'unit=03',
			'RND-API-KEY=feb'
		));
		$curl_handle = curl_init();
		curl_setopt($curl_handle, CURLOPT_URL, $url);
		curl_setopt($curl_handle, CURLOPT_POST, 1);
		curl_setopt($curl_handle, CURLOPT_POSTFIELDS,  $data);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl_handle, CURLOPT_USERPWD, $auth_name.':'.$auth_pass); 
		$buffer = curl_exec($curl_handle);
		curl_close($curl_handle);

		$result = json_decode($buffer);

		return  $result;
	}

	public function publikasi($tahun,$jenis,$grup,$perpage,$offset,$unit)
	{

		$url = 'https://bkd.unmul.ac.id/api/publikasi/data';
		// $apiKey = '}0isKLX3*M3_|J5';
		$auth_name = 'team_rnd';
		$auth_pass = 'RNDUnmul2020'; 
		$data = implode('&',array(

			'unit='.$unit,
			'RND-API-KEY=feb',
			'tahun='.$tahun,
			'jenis='.$jenis,
			'grup='.$grup,
			'limit='.$perpage,
			'offset='.$offset
		));
		$curl_handle = curl_init();
		curl_setopt($curl_handle, CURLOPT_URL, $url);
		curl_setopt($curl_handle, CURLOPT_POST, 1);
		curl_setopt($curl_handle, CURLOPT_POSTFIELDS,  $data);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl_handle, CURLOPT_USERPWD, $auth_name.':'.$auth_pass); 
		$buffer = curl_exec($curl_handle);
		curl_close($curl_handle);

		$result = json_decode($buffer);

		return  $result;
	}

	public function JenisPublikasi($jenis)
	{

		$url = 'https://bkd.unmul.ac.id/api/publikasi/jenis_'.$jenis;
		// $apiKey = '}0isKLX3*M3_|J5';
		$auth_name = 'team_rnd';
		$auth_pass = 'RNDUnmul2020'; 
		$data = implode('&',array(
		
			'RND-API-KEY=feb'
		));
		$curl_handle = curl_init();
		curl_setopt($curl_handle, CURLOPT_URL, $url);
		curl_setopt($curl_handle, CURLOPT_POST, 1);
		curl_setopt($curl_handle, CURLOPT_POSTFIELDS,  $data);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl_handle, CURLOPT_USERPWD, $auth_name.':'.$auth_pass); 
		$buffer = curl_exec($curl_handle);
		curl_close($curl_handle);

		$result = json_decode($buffer);

		return  $result;
	}



	public function fotoPegawai($nip)
	{

		$url = 'https://sidak.unmul.ac.id/api/pegawai/fotopegawai';
		
			// header('Content-Description: File Transfer');
			// header('Content-Type: image/jpg');
			// header('Content-Disposition: attachment; filename="'.basename($url).'"');
			// header('Expires: 0');
			// header('Cache-Control: must-revalidate');
			// header('Pragma: public');
			// header('Content-Length: ' . filesize($url));
			// readfile($url);

		$filename = basename($url);
		header('Content-Type:image/jpg');
		header('Content-Disposition: attachment; filename="' . $filename . '"');
		header('Content-Transfer-Encoding: binary');
		header('Connection: Keep-Alive');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Content-Length: ' . sprintf("%u", filesize($url)));
		readfile($url);
  


		$auth_name = 'team_rnd';
		$auth_pass = 'RNDUnmul2020'; 
		$data = implode('&',array(
			'nip='.$nip,
			'RND-API-KEY=feb'
		));
		$curl_handle = curl_init();
		curl_setopt($curl_handle, CURLOPT_URL, $url);
		curl_setopt($curl_handle, CURLOPT_POST, 1);
		curl_setopt($curl_handle, CURLOPT_POSTFIELDS,  $data);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl_handle, CURLOPT_USERPWD, $auth_name.':'.$auth_pass); 
		$buffer = curl_exec($curl_handle);
		curl_close($curl_handle);

		$result = json_decode($buffer);

		return  $result;
	}




public function pengabdian($tahun,$perpage, $offset,$unit)
	{

		$url = 'https://bkd.unmul.ac.id/api/publikasi/pengabdian';
		// $apiKey = '}0isKLX3*M3_|J5';
		$auth_name = 'team_rnd';
		$auth_pass = 'RNDUnmul2020'; 
		$data = implode('&',array(
			'unit='.$unit,
			'tahun='.$tahun,
			'limit='.$perpage,
			'offset='.$offset,
			'RND-API-KEY=feb'
		));
		$curl_handle = curl_init();
		curl_setopt($curl_handle, CURLOPT_URL, $url);
		curl_setopt($curl_handle, CURLOPT_POST, 1);
		curl_setopt($curl_handle, CURLOPT_POSTFIELDS,  $data);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl_handle, CURLOPT_USERPWD, $auth_name.':'.$auth_pass); 
		$buffer = curl_exec($curl_handle);
		curl_close($curl_handle);

		$result = json_decode($buffer);

		return  $result;
	}
	

	public function penelitian($tahun,$perpage, $offset,$unit)
	{

		$url = 'https://bkd.unmul.ac.id/api/publikasi/penelitian';
		// $apiKey = '}0isKLX3*M3_|J5';
		$auth_name = 'team_rnd';
		$auth_pass = 'RNDUnmul2020'; 
		$data = implode('&',array(
			'unit='.$unit,
			'tahun='.$tahun,
			'limit='.$perpage,
			'offset='.$offset,
			'RND-API-KEY=feb'
		));
		$curl_handle = curl_init();
		curl_setopt($curl_handle, CURLOPT_URL, $url);
		curl_setopt($curl_handle, CURLOPT_POST, 1);
		curl_setopt($curl_handle, CURLOPT_POSTFIELDS,  $data);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl_handle, CURLOPT_USERPWD, $auth_name.':'.$auth_pass); 
		$buffer = curl_exec($curl_handle);
		curl_close($curl_handle);

		$result = json_decode($buffer);

		return  $result;
	}


	public function penelitian_by_id($nip)
	{

		$url = 'https://bkd.unmul.ac.id/api/publikasi/penelitian_by_id';
		// $apiKey = '}0isKLX3*M3_|J5';
		$auth_name = 'team_rnd';
		$auth_pass = 'RNDUnmul2020'; 
		$data = implode('&',array(
			'id='.$nip,
			'RND-API-KEY=feb'
		));
		$curl_handle = curl_init();
		curl_setopt($curl_handle, CURLOPT_URL, $url);
		curl_setopt($curl_handle, CURLOPT_POST, 1);
		curl_setopt($curl_handle, CURLOPT_POSTFIELDS,  $data);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl_handle, CURLOPT_USERPWD, $auth_name.':'.$auth_pass); 
		$buffer = curl_exec($curl_handle);
		curl_close($curl_handle);

		$result = json_decode($buffer);

		return  $result;
	}

	public function pengabdian_by_id($nip)
	{

		$url = 'https://bkd.unmul.ac.id/api/publikasi/pengabdian_by_id';
		// $apiKey = '}0isKLX3*M3_|J5';
		$auth_name = 'team_rnd';
		$auth_pass = 'RNDUnmul2020'; 
		$data = implode('&',array(
			'id='.$nip,
			'RND-API-KEY=feb'
		));
		$curl_handle = curl_init();
		curl_setopt($curl_handle, CURLOPT_URL, $url);
		curl_setopt($curl_handle, CURLOPT_POST, 1);
		curl_setopt($curl_handle, CURLOPT_POSTFIELDS,  $data);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl_handle, CURLOPT_USERPWD, $auth_name.':'.$auth_pass); 
		$buffer = curl_exec($curl_handle);
		curl_close($curl_handle);

		$result = json_decode($buffer);

		return  $result;
	}


}
