<?php 
defined('BASEURL') OR die("HAYOoo.. mau ngapain? (-_- ')");
class proses extends _Controller{

	
	function __construct() {
		parent::__construct();
		$db = $this->database->mysqli;
		$this->mysql->setCon($db);
	}


	public function kirimrespon($data=''){
		header("Content-Type: application/json");
		header("Access-Control-Allow-Methods:POST");
		header("Access-Control-Allow-Header: Content-Type,Access-Control-Allow-Headers, Authorrization, X-Requested-With");	
		$kirim = [];
		$tgl = date('Y-m-d H:i:s' ,strtotime('now'));
		$waktu = time();
		$idrandom = $this->mysql->randomId();
		$datakucuy = ['id.s'=>$idrandom,'id_bls.s'=>$idrandom,'id_pg.s'=>$_POST['idkucuy'],'isi_bls.s'=>$_POST['isipesan'],'create_by.s'=>$_SESSION['nama'],'tgl_kirim.s'=>$tgl,'waktu.i'=>$waktu];
		$simpan = $this->mysql->simpan($datakucuy,'dt_balasan_pengaduan');
		if ($simpan) {
			$kirim['idkucuy'] =$_POST['idkucuy'];
			$kirim['h'] = true;
		}else{
			$kirim['h'] = false;
		}

		echo json_encode($kirim);
	}
	public function ambilrespon($data=''){
		header("Content-Type: application/json");
		header("Access-Control-Allow-Methods:POST");
		header("Access-Control-Allow-Header: Content-Type,Access-Control-Allow-Headers, Authorrization, X-Requested-With");	
		$kirim = [];
		$simpan = $this->mysql->ambilSemua('dt_balasan_pengaduan');
		$a = $simpan->fetch_assoc();
		if ($simpan) {
			if ($simpan->num_rows > 0) {
				$kirim['h'] = true;

			}else{
				$kirim['h'] = false;
			}
		}else{
		}

		echo json_encode($kirim);
	}
	public function postfeedback($value=''){
		header("Content-Type: application/json");
		header("Access-Control-Allow-Methods:POST");
		header("Access-Control-Allow-Header: Content-Type,Access-Control-Allow-Headers, Authorrization, X-Requested-With");	
		$kirim = [];
		$idkucuy = $_POST['idku'];
		$datakucuy = ['respon.s'=>'Pengaduan Sedang Di Proses','status.s'=>'proses'];
		$ubah = $this->mysql->ubah($idkucuy,$datakucuy,'pengaduan');
		if ($ubah) {
			$kirim['idkucuy'] = $idkucuy;
			$kirim['h'] = true;
		}else{
			$kirim['h'] = false;
		}
		echo json_encode($kirim);
	}
	public function getPESANUSER($data=''){
		header("Content-Type: application/json");
		header("Access-Control-Allow-Methods:POST");
		header("Access-Control-Allow-Header: Content-Type,Access-Control-Allow-Headers, Authorrization, X-Requested-With");	
		$kirim = [];
		$ambe = $this->mysql->ambilKondisi(['id_user'=>'='],["s.$data"],null,'pengurus_rw');
		if ($ambe->num_rows > 0){
			$kirim['h']=true;
			$isi = $ambe->fetch_assoc();
			$kirim['nama'] = $isi['nama'];
			$kirim['rw'] = $isi['dt_rw'];
			$kirim['rt'] = $isi['dt_rt'];
			$kirim['tulisjo'] = '<input type="text" class="form-control" id="ucisayang" placeholder="Type here" autocomplete="off" name="isipesan" onkeyup="scrollToBottom()" aria-label="Message example input">
			<button class="btn bg-gradient-primary mb-0 ms-2" id="idkirimpesankucuy" onclick="kirimpesankucuy(this)">
			<i class="ni ni-send"></i>
			</button>
			';
			$kirim['setinganku'] = '
			<div class="dropdown">
				<button class="btn btn-icon-only shadow-none text-dark mb-0" type="button" data-bs-toggle="dropdown">
					<i class="ni ni-settings"></i>
				</button>
				<ul class="dropdown-menu dropdown-menu-end me-sm-n2 p-2" aria-labelledby="chatmsg">
					<li><a class="dropdown-item border-radius-md text-danger" href="javascript:;" namakun="'.$isi['nama'].'" onclick="hapuschat(this)">Delete chat</a></li>
				</ul>
			</div>
			';
		}elseif ($kirim['h']=true){
			$kirim['h']=true;
			$ambel = $this->mysql->ambilKondisi(['id_user'=>'='],["s.$data"],null,'users');
			$isi1 = $ambel->fetch_assoc();
			$kirim['nama'] = $isi1['role'];
			$kirim['rw'] = $isi1['role'];
			$kirim['rt'] = $isi1['role'];
			$kirim['tulisjo'] = '<input type="text" class="form-control" id="ucisayang" placeholder="Type here" autocomplete="off" name="isipesan" onkeyup="scrollToBottom()" aria-label="Message example input">
			<button class="btn bg-gradient-primary mb-0 ms-2" id="idkirimpesankucuy" onclick="kirimpesankucuy(this)">
			<i class="ni ni-send"></i>
			</button>
			';
			$kirim['setinganku'] = '
			<div class="dropdown">
				<button class="btn btn-icon-only shadow-none text-dark mb-0" type="button" data-bs-toggle="dropdown">
					<i class="ni ni-settings"></i>
				</button>
				<ul class="dropdown-menu dropdown-menu-end me-sm-n2 p-2" aria-labelledby="chatmsg">
					<li><a class="dropdown-item border-radius-md text-danger" href="javascript:;">Delete chat</a></li>
				</ul>
			</div>
			';
		}else{
			$kirim['h']=false;
		}

		echo json_encode($kirim);
	}
	public function kirimPESANKUCUY($data=''){
		header("Content-Type: application/json");
		header("Access-Control-Allow-Methods:POST");
		header("Access-Control-Allow-Header: Content-Type,Access-Control-Allow-Headers, Authorrization, X-Requested-With");	
		$kirim = [];
		$tgl = date('Y-m-d H:i:s' ,strtotime('now'));
		$tgl1 = date('Y-m-d ' ,strtotime('now'));
		$wkkirim = date('h:i A' ,strtotime('now'));
		$waktu = time();
		$idrandom = $this->mysql->randomId();
		$idchat = $_POST['idkucuy'];
		$namapendo = $_SESSION['nama'];
		$df = strtr($namapendo, [' '=>'']);
		$datakucuy = ['id.s'=>$idrandom,'id_chat.s'=>$idchat,'id_user.s'=>$_SESSION['id'],'isi_chat.s'=>$_POST['isipesan'],'create_by.s'=>$df,'tgl_kirim.s'=>$tgl,'waktu.i'=>$waktu,'waktu_kirim.s'=>$wkkirim];
		$simpan = $this->mysql->simpan($datakucuy,'dt_chat');
		if ($simpan) {
			$kirim['h']=true;
		}else{
			$kirim['h']=false;
		}
		echo json_encode($kirim);
	}
	public function getisipesan($data=''){
		$mysqli = $this->database->mysqli;
		header("Content-Type: application/json");
		header("Access-Control-Allow-Methods:POST");
		header("Access-Control-Allow-Header: Content-Type,Access-Control-Allow-Headers, Authorrization, X-Requested-With");
		$kirim=[];
		$tgl = date('Y-m-d' ,strtotime('now'));
		$ambil = $this->mysql->ambilSemua('dt_chat');
		$cek = $data;
		$penfdoleh = strtr($_GET[4], [' '=>'']);
		$cek1 = $_SESSION['id'];
		$df = strtr($_SESSION['nama'], [' '=>'']);
		$ambil = $mysqli->query("SELECT * FROM dt_chat WHERE  id_user ='$cek1'  AND id_chat='$cek'  AND create_by ='$df' OR create_by ='$penfdoleh' AND id_chat='$cek1' ORDER BY waktu ");
		// $ambil = $this->mysql->ambilKondisiOrder(['id_chat'=>'=','id_user'=>'=','id_user'=>'='],["s.$cek1","s.$cek1","s.$cek1"],['OR','AND',],'dt_chat','waktu');
		if ($ambil->num_rows > 0 ) {
			$idkucuy = strtr($_SESSION['nama'], [' '=>'']);
			$kirim['h'] ='<div class="row mt-4">
			<div class="col-md-12 text-center">
			<span class="badge text-dark">'.$tgl.'</span>
			</div>
			</div>';
			while ($isi = $ambil->fetch_assoc()){
				if ($isi['create_by'] != $idkucuy){
					$kirim['h'].='
					<div class="row justify-content-start mb-4 ">
					<div class="col-auto">
					<div class="card ">
					<div class="card-body py-2 px-3">
					<p class="mb-1">
					'.$isi['isi_chat'].'
					</p>
					<div class="d-flex align-items-center text-sm opacity-6">
					<i class="ni ni-check-bold text-sm me-1"></i>
					<small>'.$isi['waktu_kirim'].'</small>
					</div>
					</div>
					</div>
					</div>
					</div>
					';
				}else{
					$kirim['h'].='
					<div class="row justify-content-end text-right mb-4">
					<div class="col-auto">
					<div class="card bg-gray-200">
					<div class="card-body py-2 px-3">
					<p class="mb-1" id="kautoh">
					'.$isi['isi_chat'].'
					<br>
					</p>
					<div class="d-flex align-items-center justify-content-end text-sm opacity-6">
					<i class="ni ni-check-bold text-sm me-1"></i>
					<small>'.$isi['waktu_kirim'].'</small>
					</div>
					</div>
					</div>
					</div>
					</div>
					';
				}
			}
		}else{
			$kirim['h'] = '<div class="row mt-4">
			<div class="col-md-12 text-center">
			<span class="badge text-dark">CHAT KOSONG</span>
			</div>
			</div>';
		}
		echo json_encode($kirim);
	}

}