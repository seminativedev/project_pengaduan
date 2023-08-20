<?php 
defined('BASEURL') OR die("HAYOoo.. mau ngapain? (-_- ')");
class main extends _Controller{
	
	function __construct(){
		parent::__construct();
		$db= $this->database->mysqli;
		$this->mysql->setCon($db);
	}

		public function index($value=''){
		if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
			$this->dasboard();
		}else{
			$this->view->pindah('app.main/main');
		}	
	}
	public function dasboard($value=''){
		$tgl =date('Y-m-d', strtotime('now'));
		$laporan = $this->mysql->ambilSemua('pengaduan');$jm=$laporan->num_rows;
		$isidata =['masuk'=>$jm,'tgl'=>$tgl];
		$this->view->template('templateAdmin');
		$this->view->setDir('view.admin');
		$this->view->templateShow(['main.dasboard'=>$isidata]);
	}
	public function Pengaduan($value=''){
		$laporan = $this->mysql->ambilSemua('pengaduan');
		$this->view->template('templateAdmin');	
		$this->view->setDir('view.admin');
		$this->view->templateShow(['main.pengaduan'=>$laporan]);
	}
	public function Kategori($value=''){
		$laporan = $this->mysql->ambilSemua('dt_kategori_pengaduan');
		$this->view->template('templateAdmin');	
		$this->view->setDir('view.admin');
		$this->view->templateShow(['main.kategori'=>$laporan]);
	}
	public function Userp($value=''){
		$mysqli = $this->database->mysqli;
		$getRW = $this->mysql->ambilSemua('dt_rw');
		$getUSER = $mysqli->query("SELECT pengurus_rw.*,users.* FROM pengurus_rw,users WHERE pengurus_rw.id_user = users.id_user");
		$getPSN = $mysqli->query("SELECT pengurus_rw.*,users.* FROM pengurus_rw,users WHERE pengurus_rw.id_user = users.id_user");
		$isi= ['dtrw'=>$getRW,'dtuser'=>$getUSER,'pesanUSER'=>$getPSN];
		$this->view->template('templateAdmin');
		$this->view->setDir('view.admin');
		$this->view->templateShow(['main.user'=>$isi]);
	}
	public function detail($data=''){
		$this->view->template('templateAdmin');
		$mysqli = $this->database->mysqli;
		$getUSER = $mysqli->query("SELECT pengurus_rw.*,users.* FROM pengurus_rw,users WHERE pengurus_rw.id_user='$data' AND pengurus_rw.id_user = users.id_user");		
		$this->view->setDir('view.admin');
		$this->view->templateShow(['main.user_detail'=>$getUSER]);
	}
	public function pesan($data=''){
		header('Content-Type: application/json');
		$mysqli = $this->database->mysqli;
		$getPSN = $this->mysql->ambilKondisi(['id_user'=>'='],["s.$data"],null,'pengurus_rw');
		// $getPSN = $mysqli->query("SELECT pengurus_rw.*,users.* FROM pengurus_rw,users WHERE pengurus_rw.id_user = users.id_user");
		$getbls = $this->mysql->ambilKondisiOrder(['id_pg'=>'='],["s.$data"],null,'dt_balasan_pengaduan','waktu');
		$isi= ['pesanUSER'=>$getPSN,'getbls'=>$getbls];
		$this->view->setDir('view.admin');
		$this->view->show(['main.chat'=>$isi]);
	}
	public function realtimepesan($data=''){
		header('Content-Type: application/json');
		$mysqli = $this->database->mysqli;
		$kirim =[];
		$cek = $data;
		$penfdoleh = urldecode($_GET[4]);
		$df = strtr($penfdoleh, [' '=>'']);
		$cek1 = $_SESSION['idadmin'];
		// $getbls = $this->mysql->ambilKondisiOrder(['id_chat'=>'='],["s.$cek"],null,'dt_chat','waktu');
		$getbls = $mysqli->query("SELECT * FROM dt_chat WHERE  id_user ='$cek1'  AND id_chat='$cek'  AND create_by ='$_SESSION[nama]' OR create_by ='$df' AND id_chat='$cek1' ORDER BY waktu ");
		if ($getbls->num_rows > 0){
			$kirim ['h'] = true;
			$kirim ['cot'] = $df;
			$kirim['ambil'] = '';
			while ($a = $getbls->fetch_assoc()) {
				if ($a['create_by'] !=$_SESSION['nama']) {
					$kirim['ambil'].= 
					'
					<div class="row justify-content-start mb-4">
					<div class="col-auto">
					<div class="card ">
					<div class="card-body py-2 px-3">
					<p class="mb-1">
					'.$a['isi_chat'].'
					</p>

					<div class="d-flex align-items-center text-sm opacity-6">
					<i class="ni ni-check-bold text-sm me-1"></i>
					<small>'.$a['waktu_kirim'].'</small>
					</div>
					</div>
					</div>
					</div>
					</div>
					';
				}else{
					$kirim['ambil'].=
					'
					<div class="row justify-content-end text-right mb-4">
					<div class="col-auto">
					<div class="card bg-gray-200">
					<div class="card-body py-2 px-3">
					<p class="mb-1" id="kautoh">
					'.$a['isi_chat'].'
					<br>
					</p>
					<div class="d-flex align-items-center justify-content-end text-sm opacity-6">
					<i class="ni ni-check-bold text-sm me-1"></i>
					<small>'.$a['waktu_kirim'].'</small>
					</div>
					</div>
					</div>
					</div>
					</div>
					';
				}
			}
		}else{
			$kirim['ambil'].='';
			$kirim ['h'] = false;
		}
		echo json_encode($kirim);
	}
	public function datarw($value=''){
		$this->view->template('templateAdmin');
		$tgl =date('Y-m-d', strtotime('now'));
		$laporan = $this->mysql->ambilSemua('dt_rw');
		$this->view->setDir('view.admin');
		$this->view->templateShow(['main.datarw'=>$laporan]);
	}

	
}