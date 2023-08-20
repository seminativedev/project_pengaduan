<?php 
defined('BASEURL') OR die("HAYOoo.. mau ngapain? (-_- ')");
class main extends _Controller{

	
	function __construct() {
		parent::__construct();
		$db = $this->database->mysqli;
		$this->mysql->setCon($db);
	}

	public function index($value=''){
		if (isset($_SESSION['role']) && ($_SESSION['role'] === 'pengurusRW' || $_SESSION['role'] === 'pengurusRT')) {
			$kat = $this->mysql->ambilSemua('dt_kategori_pengaduan');
			$rw = $this->mysql->ambilSemua('dt_rw');
			if (!empty($_SESSION['rtku'])) {
				$rws = $_SESSION['rwku'];
				$rts = $_SESSION['rtku'];
				$pengaduan = $this->mysql->ambilKondisi(['rw'=>'=','rt'=>'=','status'=>'='],["s.$rws","s.$rts","s.menunggu"],'AND','pengaduan');
				$hitung=$pengaduan->num_rows;
			}else{
				$rws = $_SESSION['rwku'];
				$pengaduan = $this->mysql->ambilKondisi(['rw'=>'=','status'=>'='],["s.$rws","s.menunggu"],'AND','pengaduan');
				$hitung=$pengaduan->num_rows;
			}
			$isidepan = ['notif'=>$pengaduan,'jmpengaduan'=>$hitung];
			$isidata =['kat'=>$kat,'rw'=>$rw];
			$this->view->template(['template.petugas'=>$isidepan]);
			$this->view->setDir('view.petugas');
			$this->view->templateShow(['main'=>$isidata]);	
		}else{
			$this->view->pindah('/');
		}
	}

	public function dasboard($value=''){
	$mysqli = $this->database->mysqli;
	$tgl =date('Y-m-d', strtotime('now'));
	$rwku =$_SESSION['rwku'];
	$rtku =$_SESSION['rtku'];
		if (!empty($rtku)) {
			$laporan = $this->mysql->ambilKondisi(['rw'=>'=','rt'=>'='],["s.$rwku","s.$rtku"],'AND','pengaduan');$jm=$laporan->num_rows;
			$pending = $this->mysql->ambilKondisi(['rw'=>'=','rt'=>'=','status'=>'='],["s.$rwku","s.$rtku",'s.menunggu'],'AND','pengaduan');$jpending=$pending->num_rows;
			$gagal = $this->mysql->ambilKondisi(['rw'=>'=','rt'=>'=','status'=>'='],["s.$rwku","s.$rtku",'s.gagal'],'AND','pengaduan');$jgagal=$gagal->num_rows;
			$selesai = $this->mysql->ambilKondisi(['rw'=>'=','rt'=>'=','status'=>'='],["s.$rwku","s.$rtku",'s.selesai'],'AND','pengaduan');$jselesai=$selesai->num_rows;
		}else{
			$laporan = $this->mysql->ambilKondisi(['rw'=>'='],["s.$rwku"],null,'pengaduan');$jm=$laporan->num_rows;
			$pending = $this->mysql->ambilKondisi(['rw'=>'=','status'=>'='],["s.$rwku",'s.menunggu'],'AND','pengaduan');$jpending=$pending->num_rows;
			$gagal = $this->mysql->ambilKondisi(['rw'=>'=','status'=>'='],["s.$rwku",'s.gagal'],'AND','pengaduan');$jgagal=$gagal->num_rows;
			$selesai = $this->mysql->ambilKondisi(['rw'=>'=','status'=>'='],["s.$rwku",'s.selesai'],'AND','pengaduan');$jselesai=$selesai->num_rows;
		}
	$getfoto = $mysqli->query("SELECT * FROM pengaduan GROUP BY id");
	$isidata =['masuk'=>$jm,'pending'=>$jpending,'gagal'=>$jgagal,'selesai'=>$jselesai,'tgl'=>$tgl,'foto'=>$getfoto];
		$this->view->setDir('view.petugas');
		$this->view->show(['dasboard'=>$isidata]);
	}

	public function Pengaduan($value=''){
		$rwku = $_SESSION['rwku'];
		$rtku = $_SESSION['rtku'];
		if (!empty($rtku)) {
			$laporan = $this->mysql->ambilKondisi(['rw'=>'=','rt'=>'='],["s.$rwku","s.$rtku"],'AND','pengaduan');
		}else{
			$laporan = $this->mysql->ambilKondisi(['rw'=>'='],["s.$rwku"],null,'pengaduan');
		}
		$this->view->setDir('view.petugas');
		$this->view->show(['main.pengaduan'=>$laporan]);
	}
	public function detail($data=''){
		$mysqli = $this->database->mysqli;
		$getUSER = $this->mysql->ambilKondisi(['id_pg'=>'='],["s.$data"],null,'pengaduan');	
		$this->view->setDir('view.petugas');
		$this->view->show(['main.pengaduan.detail'=>$getUSER]);
	}
	public function respon($data=''){
		$mysqli = $this->database->mysqli;
		$getUSER = $this->mysql->ambilKondisi(['id_pg'=>'='],["s.$data"],null,'pengaduan');
		$getbls = $this->mysql->ambilKondisiOrder(['id_pg'=>'='],["s.$data"],null,'dt_balasan_pengaduan','waktu');
		// $getbls = $this->mysql->ambilSemua('dt_balasan_pengaduan');	
		$isidata = ['getUSER'=>$getUSER,'getbls'=>$getbls];	
		$this->view->setDir('view.petugas');
		$this->view->show(['main.respon'=>$isidata]);
	}
	public function pesan($data=''){
		header('Content-Type: application/json');
		$mysqli = $this->database->mysqli;
		$apajo = $this->mysql->ambilKondisi(['role'=>'='],["s.admin"],null,'users');
		$getRW1 = $mysqli->query("SELECT * FROM pengurus_rw WHERE id_user !='$_SESSION[id]' AND dt_rw ='$_SESSION[rwku]' ORDER BY dt_rt");
		$getRW2 = $mysqli->query("SELECT * FROM pengurus_rw WHERE id_user !='$_SESSION[id]' AND dt_rw ='$_SESSION[rwku]' ORDER BY dt_rt");
		$getUSER = $mysqli->query("SELECT * FROM pengurus_rw WHERE id_user !='$_SESSION[id]' AND dt_rw ='$_SESSION[rwku]' AND dt_rt ='$_SESSION[rtku]' ORDER BY jabatan");
		$isi= ['pesanUSER'=>$apajo,'infouser'=>$getUSER,'infouser1'=>$getRW1,'infouser2'=>$getRW2];
		$this->view->setDir('view.petugas');
		$this->view->show(['main.chat'=>$isi]);
	}
	public function hapuschat($data=''){

	}
}