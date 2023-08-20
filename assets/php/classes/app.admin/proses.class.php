<?php 
defined('BASEURL') OR die("HAYOoo.. mau ngapain? (-_- ')");
class proses extends _Controller{
	function __construct(){
		parent::__construct();
		$db= $this->database->mysqli;
		$this->mysql->setCon($db);
	}
	private function generateShortMicrotimeID() {
		list($microseconds, $seconds) = explode(' ', microtime());
		$microtime = $seconds . str_replace('.', '', $microseconds);
		$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
		$base = strlen($characters);
		$shortID = '';

		while ($microtime > 0) {
			$remainder = $microtime % $base;
			$shortID = $characters[$remainder] . $shortID;
			$microtime = floor($microtime / $base);
		}

		return $shortID;
	}
	private function getUSER(){
		header("Content-Type: application/json");
		header("Access-Control-Allow-Methods:POST");
		header("Access-Control-Allow-Header: Content-Type,Access-Control-Allow-Headers, Authorrization, X-Requested-With");	
		$kirim = [];
		$kirim['hasil']='';
		$getUSER = $this->mysql->ambilSemua('pengurus_rw');
		if($getUSER->num_rows > 0){ 
			while ($isi = $getUSER->fetch_assoc()) { $kirim['hasil'].= '<td>'.$isi['nama'].'<td/>'; }
		}else{ $kirim['hasil'].= 'kosong'; }
		echo json_encode($kirim);
	}
	public function adduser($data=''){
		header("Content-Type: application/json");
		header("Access-Control-Allow-Methods:POST");
		header("Access-Control-Allow-Header: Content-Type,Access-Control-Allow-Headers, Authorrization, X-Requested-With");
		$kirim = [];
		$mysqli = $this->database->mysqli;
		$tgl = date('Y-m-d H:i:s', strtotime('now'));
		$idrandom = $this->generateShortMicrotimeID();
		$pas = $mysqli->real_escape_string(htmlspecialchars(stripslashes(strip_tags(trim('palu')))));
		$pass = hash_hmac('sha1', hash('sha256', 'snd'.$pas.'st'), 'snd');
		$namaku = $_POST['nama'];
		foreach ($_POST as $key => $value) {
			if (empty($value)) {
				$kirim['h'] = false;
				break;
			}else{
				$cekcuy = $this->mysql->ambilKondisi(['nama'=>'='],["s.$namaku"],null,'pengurus_rw');
				if ($cekcuy->num_rows > 0) {
					$kirim['h'] = false;
				}else{
					if (!empty($_POST['rtkucuy'])) {
						$datarw = ['id.s'=>$idrandom,'id_user.s'=>$idrandom,'nama.s'=>$_POST['nama'],'jabatan.s'=>$_POST['jabatan'],'tlg_create.s'=>$tgl,'createby.s'=>'Admin','dt_rw.s'=>$_POST['rw'],'dt_rt.s'=>$_POST['rtkucuy']];
						$isidata = $this->mysql->simpan($datarw,'pengurus_rw');
						if($isidata){
							$kirim['h'] = true;
							$datauser = ['id.s'=>$idrandom,'id_user.s'=>$idrandom,'username.s'=>$_POST['nama'],'password.s'=>$pass,'role.s'=>'pengurusRT'];
							$isiuser = $this->mysql->simpan($datauser,'users');
						}else{
							$kirim['h'] = false;
						}
					}else{
						$datarw = ['id.s'=>$idrandom,'id_user.s'=>$idrandom,'nama.s'=>$_POST['nama'],'jabatan.s'=>$_POST['jabatan'],'tlg_create.s'=>$tgl,'createby.s'=>'Admin','dt_rw.s'=>$_POST['rw']];
						$isidata = $this->mysql->simpan($datarw,'pengurus_rw');
						if($isidata){
							$kirim['h'] = true;
							$datauser = ['id.s'=>$idrandom,'id_user.s'=>$idrandom,'username.s'=>$_POST['nama'],'password.s'=>$pass,'role.s'=>'pengurusRW'];
							$isiuser = $this->mysql->simpan($datauser,'users');
						}else{
							$kirim['h'] = false;
						}
					}
				}
				break;
			}
		}
		echo json_encode($kirim);
	}
	public function hapusCuy($value=''){
		header("Content-Type: application/json");
		header("Access-Control-Allow-Methods:POST");
		header("Access-Control-Allow-Header: Content-Type,Access-Control-Allow-Headers, Authorrization, X-Requested-With");
		$kirim = [];
		$dataku = $_POST['idkucuy'];
		$gascuy = $this->mysql->hapus($dataku,'pengurus_rw');$kirim['h'] = $gascuy ? true : false;
		$gascuyuser = $this->mysql->hapus($dataku,'users');$kirim['h'] = $gascuyuser ? true : false;
		// $this->getUSER();

		echo json_encode($kirim);
	}
	public function getpesan($value=''){
		header("Content-Type: application/json");
		header("Access-Control-Allow-Methods:POST");
		header("Access-Control-Allow-Header: Content-Type,Access-Control-Allow-Headers, Authorrization, X-Requested-With");
		$kirim=[];
		$ambil = $this->mysql->ambilSemua('dt_chat');

		if ($ambil->num_rows > 0 ) {
			$idkucuy = $_SESSION['idadmin'];
			$kirim['h'] ='';
			while ($isi = $ambil->fetch_assoc()){
				if ($isi['id_user'] = $idkucuy){
					$kirim['h'].='
					';
				}else{
					$kirim['h'].='
					<div class="card-body overflow-auto overflow-x-hidden">
					<div class="row justify-content-start mb-4">
					<div class="col-auto">
					<div class="card ">
					<div class="card-body py-2 px-3">
					<p class="mb-1">
					'.$isi['isi_chat'].'
					</p>
					<div class="d-flex align-items-center text-sm opacity-6">
					<i class="ni ni-check-bold text-sm me-1"></i>
					<small>3:14am</small>
					</div>
					</div>
					</div>
					</div>
					</div>
					';
				}
			}
		}else{
			$kirim['h'] = 'KOSONG';
		}
		echo json_encode($kirim);
	}
	public function getROLE($data=''){
		header("Content-Type: application/json");
		header("Access-Control-Allow-Methods:POST");
		header("Access-Control-Allow-Header: Content-Type,Access-Control-Allow-Headers, Authorrization, X-Requested-With");
		$kirim=[];
		$ambilrw = $this->mysql->ambilSemua('dt_rw');
		if ($data === 'rw' ){
			echo '
			<div class="md-3">
			<label for="validationCustom04" class="form-label">Pilih Rw</label>
			<select name="rw" bersih="itu" class="form-select" id="validationCustom04" required>
			<option selected disabled>--Pilih Rw--</option>';
			while ($a = $ambilrw->fetch_assoc()){
				echo '<option>' . $a['rw'] . '</option>';
			}
			echo '
			</select>
			</div>

			<div class="md-3">
			<label for="validationCustom01" class="form-label">Nama</label>
			<input type="text" name="nama" class="form-control" placeholder="Masukan Nama Ketua Rw" id="validationCustom01"  required>
			</div>

			<div class="md-3">
			<label for="validationCustom04" class="form-label">Pilih Jabatan</label>
			<select bersih="itu" name="jabatan" class="form-select" id="validationCustom04" required>
			<option selected disabled>--Pilih Jabatan--</option>
			<option >Ketua Rw</option>
			</select>
			</div>
			';
		}else{
			echo '
			<div class="md-3">
			<label for="validationCustom04" class="form-label">Pilih Rw</label>
			<select name="rw" bersih="itu" class="form-select" onchange="getRT(this)" id="validationCustom04" required>
			<option selected disabled>--Pilih Rw--</option>';
			while ($a = $ambilrw->fetch_assoc()){
				echo '<option>' . $a['rw'] . '</option>';
			}
			echo '
			</select>
			</div>

			<div class="md-3">
			<label for="validationCustom04" class="form-label">Pilih Rt</label>
			<select bersih="itu" class="form-select" name="rtkucuy" id="rtkucuy" required></select>
			</div>

			<div class="md-3">
			<label for="validationCustom01" class="form-label">Nama</label>
			<input type="text" name="nama" class="form-control" placeholder="Masukan Nama" id="validationCustom01"  required>
			</div>

			<div class="md-3">
			<label for="validationCustom04" class="form-label">Pilih Jabatan</label>
			<select bersih="itu" name="jabatan" class="form-select" id="validationCustom04" required>
			<option selected disabled>--Pilih Jabatan--</option>
			<option value="Ketua-Rt">Ketua Rt</option>
			</select>
			</div>
			';
		}
	}
	public function getRW($data=''){
		header("Content-Type: application/json");
		header("Access-Control-Allow-Methods:POST");
		header("Access-Control-Allow-Header: Content-Type,Access-Control-Allow-Headers, Authorrization, X-Requested-With");
		$kirim=[];
		$isirw = $_POST['rw'];
		$kirim['html'] = '';
		$ambilrw = $this->mysql->ambilSemua('dt_rw');
		$ambilrw1 = $this->mysql->ambilSemua('dt_rw');
		if (!empty($_POST['rt'])) {
			$kirim['h'] = true;
			while ($a = $ambilrw1->fetch_assoc()) {
				$kirim['html'].= '<option '.(($a['rw']==$isirw)?'selected':'').' >'.$a['rw'].'</option>';
			}
		}else{
			$kirim['h'] = false;
			while ($a = $ambilrw->fetch_assoc()) {
				$kirim['html'].= '<option '.(($a['rw']==$isirw)?'selected':'').' >'.$a['rw'].'</option>';
			}
		}
		echo json_encode($kirim);
	}
	public function getRT($data=''){
		header("Content-Type: application/json");
		header("Access-Control-Allow-Methods:POST");
		header("Access-Control-Allow-Header: Content-Type,Access-Control-Allow-Headers, Authorrization, X-Requested-With");
		$kirim = array();
		$get = $_POST['rw'];
		$rw = $this->mysql->ambilKondisi(['rw'=>'='],["s.$get"],null,'dt_rw');
		if ($rw->num_rows > 0) {
			$kirim['h'] = true;
			$kirim['i'] = '';
			$isi = $rw->fetch_assoc();
			$rtList = $isi['rt'];
			$rtArray = explode(",", $rtList);
			$i = 0;
			while ($i < count($rtArray)) {
				$kirim['i'].='<option value="' . $rtArray[$i] . '">' . $rtArray[$i] . '</option>';
				$i++;
			}
		}else{
			$kirim['i'] = '<option selected disabled >Data Rt Pada Rw '.$get.' Tidak Ditemukan</option>';
			$kirim['h'] = false;
		}
		echo json_encode($kirim);
	}
	public function update($data=''){
		header("Content-Type: application/json");
		header("Access-Control-Allow-Methods:POST");
		header("Access-Control-Allow-Header: Content-Type,Access-Control-Allow-Headers, Authorrization, X-Requested-With");
		$kirim = [];
		$idkucuy =$_POST['idupdatecuy'];
		if (!empty($_POST['rtkucuy'])){
			$kirim['cek']='rt'; 
			$datakucuy = ['nama.s'=>$_POST['nama'],'jabatan.s'=>$_POST['jabatan'],'dt_rw.s'=>$_POST['rw'],'dt_rt.s'=>$_POST['rtkucuy']];
			$simpancuy = $this->mysql->ubah($idkucuy,$datakucuy,'pengurus_rw');
			if ($simpancuy){ 
				$kirim['h']=true; 
				$usercuy = ['username.s'=>$_POST['nama']];
				$usercuy = $this->mysql->ubah($idkucuy,$usercuy,'users');
				$getdulu = $this->mysql->ambilKondisi(['id'=>'='],["s.$idkucuy"],null,'pengurus_rw');
				$isi = $getdulu->fetch_assoc();
				$kirim['rw'] = '<option value="'.$isi['dt_rw'].'">' .$isi['dt_rw'] . '</option>';
				$kirim['rt'] = '<option value="'.$isi['dt_rt'].'">' .$isi['dt_rt'] . '</option>';
				$kirim['nama'] = $isi['nama'];
				$kirim['jabatan'] = '<option value="'.$isi['jabatan'].'">' .$isi['jabatan'] . '</option>';
				
			}else{ 
				$kirim['h']=false; 
				$kirim['i']='Data pengurus gagal terupdate';
			}
		}else{
			$kirim['cek']='rw'; 
			$datakucuy = ['nama.s'=>$_POST['nama'],'jabatan.s'=>$_POST['jabatan'],'dt_rw.s'=>$_POST['rw']];
			$simpancuy = $this->mysql->ubah($idkucuy,$datakucuy,'pengurus_rw');
			if ($simpancuy){ 
				$kirim['h']=true; 
				$usercuy = ['username.s'=>$_POST['nama']];
				$usercuy = $this->mysql->ubah($idkucuy,$usercuy,'users');
				$getdulu = $this->mysql->ambilKondisi(['id'=>'='],["s.$idkucuy"],null,'pengurus_rw');
				$isi = $getdulu->fetch_assoc();
				$kirim['rw'] = '<option value="'.$isi['dt_rw'].'">' .$isi['dt_rw'] . '</option>';
				$kirim['rws'] = '<i class="ni location_pin mr-2"></i>'.$isi['dt_rw'].'';
				$kirim['nama'] = $isi['nama'];
				$kirim['jabatan'] = '<option value="'.$isi['jabatan'].'">' .$isi['jabatan'] . '</option>';
			}else{ 
				$kirim['h']=false; 
				$kirim['i']='Data pengurus gagal terupdate';
			}
		}
		echo json_encode($kirim);
	}
	public function kirimrespon($data=''){
		header("Content-Type: application/json");
		header("Access-Control-Allow-Methods:POST");
		header("Access-Control-Allow-Header: Content-Type,Access-Control-Allow-Headers, Authorrization, X-Requested-With");	
		$kirim = [];
		$tgl = date('Y-m-d H:i:s' ,strtotime('now'));
		$wkkirim = date('h:i A' ,strtotime('now'));
		$waktu = time();
		$idrandom = $this->mysql->randomId();
		$idchat = $_POST['idkucuy'];
		$datakucuy = ['id.s'=>$idrandom,'id_chat.s'=>$idchat,'id_user.s'=>$_SESSION['idadmin'],'isi_chat.s'=>$_POST['isipesan'],'create_by.s'=>$_SESSION['nama'],'tgl_kirim.s'=>$tgl,'waktu.i'=>$waktu,'waktu_kirim.s'=>$wkkirim];
		$simpan = $this->mysql->simpan($datakucuy,'dt_chat');
		if ($simpan) {
			$kirim['idkucuy'] =$_POST['idkucuy'];
			$kirim['h'] = true;
		}else{
			$kirim['h'] = false;
		}

		echo json_encode($kirim);
	}
	public function addrwrt($data=''){
		header("Content-Type: application/json");
		header("Access-Control-Allow-Methods:POST");
		header("Access-Control-Allow-Header: Content-Type,Access-Control-Allow-Headers, Authorrization, X-Requested-With");
		$kirim=[];
		$idrandom = $this->generateShortMicrotimeID();
		$tgl = date('Y-m-d H:i:s', strtotime('now'));
		$datakucuy = ['id.s'=>$idrandom,'kategori.s'=>$_POST['kategori'],'tgl_create.s'=>$tgl,'createby.s'=>'admin'];
		$simpancuy = $this->mysql->simpan($datakucuy,'dt_kategori_pengaduan');
		if ($simpancuy) {
			$kirim['h'] = true;
		}else{
			$kirim['h'] = false;
		}
		echo json_encode($kirim);
	}
	public function Itambahrwrt($data = '') {
		header("Content-Type: application/json");
		header("Access-Control-Allow-Methods: POST");
		header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

		$kirim = [];
		$idrandom = $this->generateShortMicrotimeID();
		$tgl = date('Y-m-d H:i:s', strtotime('now'));

		$rtValues = explode(',', $_POST['rt']);
		$rtFormattedArray = [];

		foreach ($rtValues as $rtValue) {
			if (!empty($rtValue)) {
				$formattedRT = 'RT' . $rtValue;
				$rtFormattedArray[] = $formattedRT;
			}
		}

		$rtString = implode(',', $rtFormattedArray);

		$datakucuy = [
			'id.s' => $idrandom,
			'rw.s' => 'RW' . $_POST['rw'],
			'rt.s' => $rtString,
			'tgl_create.s' => $tgl,
			'create_by.s' => 'admin'
		];

		$simpancuy = $this->mysql->simpan($datakucuy, 'dt_rw');

		if ($simpancuy) {
			$kirim['h'] = true;
		} else {
			$kirim['h'] = false;
		}

		echo json_encode($kirim);
	}
	public function hapuscuykat($value=''){
		header("Content-Type: application/json");
		header("Access-Control-Allow-Methods:POST");
		header("Access-Control-Allow-Header: Content-Type,Access-Control-Allow-Headers, Authorrization, X-Requested-With");
		$kirim = [];
		$dataku = $_POST['idkucuy'];
		$gascuy = $this->mysql->hapus($dataku,'dt_kategori_pengaduan');$kirim['h'] = $gascuy ? true : false;
		// $this->getUSER();

		echo json_encode($kirim);
	}
	public function hapuscuyrw($value=''){
		header("Content-Type: application/json");
		header("Access-Control-Allow-Methods:POST");
		header("Access-Control-Allow-Header: Content-Type,Access-Control-Allow-Headers, Authorrization, X-Requested-With");
		$kirim = [];
		$dataku = $_POST['idkucuy'];
		$gascuy = $this->mysql->hapus($dataku,'dt_rw');$kirim['h'] = $gascuy ? true : false;
		// $this->getUSER();

		echo json_encode($kirim);
	}

	public function edtrwgetdata($data =''){
		header("Content-Type: application/json");
		header("Access-Control-Allow-Methods:POST");
		header("Access-Control-Allow-Header: Content-Type,Access-Control-Allow-Headers, Authorrization, X-Requested-With");
		$kirim = [];
		$idkucuy = $data;
		$ambil = $this->mysql->ambilKondisi(['id'=>'='],["s.$idkucuy"],null,'dt_rw');
		if ($ambil->num_rows > 0) {
			$kirim['h'] = true;
			$isi = $ambil->fetch_assoc();
			$kirim['id'] = $isi['id'];
			$kirim['rw'] = $isi['rw'];
			$kirim['rt'] = $isi['rt'];
		}else{
			$kirim['h'] = false;
		}
		echo json_encode($kirim);
	}	
}

