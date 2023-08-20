<?php 
defined('BASEURL') OR die("HAYOoo.. mau ngapain? (-_- ')");
class Awal extends _Controller{
	/**
	 *  JANGAN DIPINDAHKAN LOKASI DARI FILE INI
	 *  
	 *  DEFINED PADA BARIS 2 HARUS ADA
	 *  untuk keamanan file, tulisan pada baris ke 2 harus ada. karena mencegah pengguna
	 *  mengakses file ini secara langsung
	 *  
	 *  file ini adalah proses awal ketika domain dikunjungi
	 *  contoh : https://www.domain.com/
	 * 
	 */
	function __construct(){
		parent::__construct();
	}

	public function index(){
		if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
			$this->view->pindah('app.admin/main');
		}elseif (isset($_SESSION['role']) && ($_SESSION['role'] === 'pengurusRW' || $_SESSION['role'] === 'pengurusRT')) {
			$this->view->pindah('app.petugas/main');
		}else{
			$this->view->pindah('app.main/main');
		}		
	}
}


