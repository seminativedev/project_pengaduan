<?php 
defined('BASEURL') OR die("HAYOoo.. mau ngapain? (-_- ')");
class main extends _Controller{
	
	function __construct(){
		parent::__construct();
		$db= $this->database->mysqli;
		$this->mysql->setCon($db);
	}

	private function cekuserse(){
		if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
			$this->view->pindah('app.admin/main');
		}elseif (isset($_SESSION['role']) && ($_SESSION['role'] === 'pengurusRW' || $_SESSION['role'] === 'pengurusRT')) {
			$this->view->pindah('app.petugas/main');
		}	
	}

	public function index($value=''){
		$this->cekuserse();
		$kat = $this->mysql->ambilSemua('dt_kategori_pengaduan');
		$rw = $this->mysql->ambilSemua('dt_rw');
		$datapengaduan = $this->mysql->ambilSemua('pengaduan');
		$pMasuk = 0;
		$pProses = 0;
		$pMenunggu = 0;
		$pSelesai = 0;

		while ($isipengaduan = $datapengaduan->fetch_assoc()) {
			$pMasuk++;
			switch ($isipengaduan['status']) {
				case 'menunggu':
				$pMenunggu++;
				break;

				case 'proses':
				$pProses++;
				break;

				case 'selesai':
				$pSelesai++;
				break;
			}
		}


		$isidata =['kat'=>$kat,'rw'=>$rw ,'pmsk'=>$pMasuk,'pm'=>$pMenunggu,'pp'=>$pProses,'ps'=>$pSelesai];
		$this->view->template('template.web');
		// $this->view->cache(1172800);		
		$this->view->setDir('view.web');
		$this->view->templateShow(['main'=>$isidata]);
	}

	public function search_data($value=''){
		$this->cekuserse();
		$this->view->template('template.web');
		// $this->view->cache(1172800);		
		$this->view->setDir('view.web');
		$this->view->templateShow(['main.find'=>$value]);
	} 

	public function respon($data=''){
		$this->cekuserse();
		$mysqli = $this->database->mysqli;
		$getUSER = $this->mysql->ambilKondisi(['id_pg'=>'='],["s.$data"],null,'pengaduan');
		$getbls = $this->mysql->ambilKondisiOrder(['id_pg'=>'='],["s.$data"],null,'dt_balasan_pengaduan','waktu');
		$isidata = ['getUSER'=>$getUSER,'getbls'=>$getbls];	
		$this->view->setDir('view.web');
		$this->view->show(['main.respon'=>$isidata]);
	}

	public function bot($data=''){
		$this->cekuserse();
		$mysqli = $this->database->mysqli;
		$getUSER = $this->mysql->ambilKondisi(['id_pg'=>'='],["s.$data"],null,'pengaduan');
		$getbls = $this->mysql->ambilKondisiOrder(['id_pg'=>'='],["s.$data"],null,'dt_balasan_pengaduan','waktu');
		$isidata = ['getUSER'=>$getUSER,'getbls'=>$getbls];	
		$this->view->setDir('view.web');
		$this->view->show(['tes.bot'=>$isidata]);
	}

	public function masuk(){
		header("Content-Type: application/json");
		header("Access-Control-Allow-Methods:POST");
		header("Access-Control-Allow-Header: Content-Type,Access-Control-Allow-Headers, Authorrization, X-Requested-With");
		$kirim = array();

		if(isset($_POST['masuk']) && $_POST['masuk'] === 'gue'){
			$mysqli = $this->database->mysqli;
			$akun = $mysqli->real_escape_string(htmlspecialchars(stripslashes(strip_tags(trim($_POST['username'])))));
			$pas = $mysqli->real_escape_string(htmlspecialchars(stripslashes(strip_tags(trim($_POST['password'])))));
			$pass = hash_hmac('sha1', hash('sha256', 'snd'.$pas.'st'), 'snd');
			$cek = $mysqli->prepare("SELECT * FROM users WHERE username=? AND password=?");
			$cek->bind_param('ss', $akun, $pass);
			$cek->execute();
			$hasil = $cek->get_result();

			if($hasil->num_rows === 1){
				$isi = $hasil->fetch_assoc();
				$id = $isi['id_user'];
				$role = $isi['role'];
				$skrng = date('Y-m-d H:i:s', strtotime('now'));
				$ubah = $mysqli->prepare("UPDATE users SET tgl_login=? WHERE id_user=?");
				$ubah->bind_param('ss', $skrng,$id);
				$ubah->execute();
				if($role === 'admin'){
					$_SESSION['nama'] ='admin'; 
					$_SESSION['idadmin'] = $isi['id_user'];
					$_SESSION['username'] = $isi['username'];
					$_SESSION['pesan'] = 'ROLE ADMIN';
					$_SESSION['role'] = $isi['role'];
					$opt = ['expires' => time()+(60*60*24*30),'path' => '/','domain' => $_SERVER['HTTP_HOST'], 'secure' => true, 'httponly' => true, 'samesite' => 'Strict'];
					setcookie('cariapa?', $id, $opt);
					$kirim['h'] = true;
					$kirim['i'] ='app.admin/main';

				}elseif ($role === 'pengurusRW' || $role === 'pengurusRT') {
					$dataguru= $this->mysql->ambilKondisi(array('id_user'=>'='),array('s.'.$id), null, 'pengurus_rw');
					if($dataguru->num_rows === 1){
						$isiguru = $dataguru->fetch_assoc();
						$_SESSION['nama'] =$isiguru['nama'];
						$_SESSION['id'] = $isi['id_user'];
						$_SESSION['rwku'] = $isiguru['dt_rw'];
						$_SESSION['rtku'] = $isiguru['dt_rt'];
						$_SESSION['username'] = $isi['username'];
						$_SESSION['role'] = $isi['role'];
						$opt = ['expires' => time()+(60*60*24*30),'path' => '/','domain' => $_SERVER['HTTP_HOST'], 'secure' => true, 'httponly' => true, 'samesite' => 'Strict'];
						setcookie('cariapa?', $id, $opt);
						$kirim['h'] = true;
						$kirim['i'] ='app.petugas/main';
					}else{
						$kirim['h'] = false;
						$kirim['i'] = 'User Tidak Ditemukan';
					}
				}elseif($role === 'siswa'){
					$datasiswa= $this->mysql->ambilKondisi(array('iduser'=>'='),array('s.'.$id), null, 'siswa');
					if($datasiswa->num_rows === 1){
						$isisiswa = $datasiswa->fetch_assoc();
						$_SESSION['nama'] =$isisiswa['nama'];
						$_SESSION['username'] = $isi['username'];
						$_SESSION['role'] = $isi['role'];
						$_SESSION['idsiswa'] = $isi['iduser'];
						$opt = ['expires' => time()+(60*60*24*30),'path' => '/','domain' => $_SERVER['HTTP_HOST'], 'secure' => true, 'httponly' => true, 'samesite' => 'Strict'];
						setcookie('cariapa?', $id, $opt);
						$kirim['h'] = true;
						$kirim['i'] ='siswa/mainsiswa';

					}else{
						$kirim['h'] = false;
						$kirim['i'] = 'User Tidak Ditemukan';
					}
				}
				else{
					$kirim['h'] = false;
					$kirim['i'] = 'Role User Tidak Ditemukan'; 
				}
			}
			else{
				$kirim['h'] = false;
				$kirim['i'] = $pass;
				// $this->view->pindah('validasi/login');
			}
		}
		echo json_encode($kirim);
	}

	public function logout(){
		if(isset($_COOKIE['cariapa?']) || isset($_SESSION['saya'])){
			$id = (isset($_COOKIE['cariapa?']))? $_COOKIE['cariapa?']:$_SESSION['saya'];
			$mysqli = $this->database->mysqli;
			$skrng = date('Y-m-d H:i:s', strtotime('now'));
			$keluar = $mysqli->prepare("UPDATE users SET tgl_logout =?,status_login='Logout' WHERE id_user = ?");
			$keluar->bind_param('ss', $skrng, $id);
			$keluar->execute();
			// if(isset($_COOKIE['cariapa?'])){
			// } 
			$opt = ['expires' => time()-(60*60*24*30),'path' => '/','domain' => $_SERVER['HTTP_HOST'], 'secure' => true, 'httponly' => true, 'samesite' => 'Strict'];
			setcookie('cariapa?', '', $opt);
			session_destroy();
			session_unset();
			$mysqli->close();
			$this->view->pindah("/");
		}
	}

}