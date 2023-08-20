<?php 
defined('BASEURL') OR die("HAYOoo.. mau ngapain? (-_- ')");
class proses extends _Controller{
	
	function __construct(){
		parent::__construct();
		$db= $this->database->mysqli;
		$this->mysql->setCon($db);
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
	public function generateShortID($harisekarang, $nama, $rw, $rt) {
		$dataToHash = $harisekarang . $nama . $rw . $rt;
		$shortID = substr(hash('sha1', $dataToHash), 0, 10);
		return $shortID;
	}


	public function kirimlaporan($data = ''){
		header("Content-Type: application/json");
		header("Access-Control-Allow-Methods: POST");
		header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
		$kirim = [];
		if (isset($_POST) && empty($_POST)) {
			$kirim['h'] = false;
		}else{			
			$tgl =date('Y-m-d H:i:s', strtotime('now'));
			$mysqli = $this->database->mysqli;			
			$harisekarang = date('Y-m-d', strtotime('now'));$tu=$_POST['Inama'];$tp =$_POST['Irw'];$rt = $_POST['Irt'];
			$idrandom = $this->generateShortID($harisekarang,$tu,$tp,$rt);
			$uploadDir = '';
			if ($_SERVER['HTTP_HOST'] === 'localhost') {
				$uploadDir.= $_SERVER['DOCUMENT_ROOT'] . "/project_pengaduan/assets/img/fotopengaduan/";
			}else{
				$uploadDir.= $_SERVER['DOCUMENT_ROOT'] . "/assets/img/fotopengaduan/";
			}
			$gambar = $_FILES['fotolaporankuy'];
			$totalFiles = count($gambar['name']);
			$fileNames = [];
			for ($i = 0; $i < $totalFiles; $i++) {
				$fileExt = strtolower(pathinfo($gambar['name'][$i], PATHINFO_EXTENSION));
				$uniqueFileName = uniqid() . '.' . $fileExt;
				$uploadPath = $uploadDir . $uniqueFileName;
				if ($gambar['type'][$i] !== 'image/jpeg' && $gambar['type'][$i] !== 'image/png') {
					$kirim['h'] = false;
					$kirim['i'][] = array('file' => $gambar['name'][$i], 'status' => 'Invalid file type.');
				} else {
					if (move_uploaded_file($gambar['tmp_name'][$i], $uploadPath)) {
						$kirim['h'] = true;
						$fileNames[] = $uniqueFileName;
					} else {
						$kirim['i'][] = array('file' => $gambar['name'][$i], 'status' => 'Failed to upload the file.');
					}
				}
			}
			if (!empty($fileNames)) {
				$fotoString = implode(",", $fileNames);
				$query = "INSERT INTO pengaduan (id,id_pg,nama_pg,kelurahan,rw,rt,isi,kategori,nomor,foto,tgl_pg,status) 
				VALUES('$idrandom','$idrandom','$_POST[Inama]','$_POST[Ikelurahan]','$_POST[Irw]','$_POST[Irt]','$_POST[Idesk]','$_POST[Ikategori]','$_POST[Inomor]','$fotoString','$tgl','menunggu')";
				$isipadia = $mysqli->query($query);	
				if ($isipadia) {
					$kirim['h'] = true;
					$kirim['i'] = $idrandom;
				} else {
					$kirim['h'] = false;
				}
			}
		}
		echo json_encode($kirim);
	}

	public function getDatalaporan($data=''){
		header("Content-Type: application/json");
		header("Access-Control-Allow-Methods: POST");
		header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
		$kirim = [];
		$idkuuh = $_POST['idkucuy'];
		$getData = $this->mysql->ambilKondisi(['id_pg'=>'='],["s.$idkuuh"],null,'pengaduan');
		if ($getData->num_rows > 0){
			$isi = $getData->fetch_assoc();
			$kirim['h'] = true;
			$kirim['i'] = $idkuuh;
			$kirim['html'] = '
			<div class="page-header min-vh-85">
			<div>
			<img style="border-radius: 2.2rem !important;" class="position-absolute fixed-top ms-auto w-50 h-100 z-index-0 d-none d-sm-none d-md-block border-radius-section border-top-end-radius-0 border-top-start-radius-0 border-bottom-end-radius-0" src="'.BASEURL.'assets/img/curved-images/curved8.jpg" alt="image">
			</div>
			<div class="container">
			<div class="row">
			<div class="col-lg-7 d-flex justify-content-center flex-column">
			<div class="card d-flex blur justify-content-center p-4 shadow-lg my-sm-0 my-sm-6 mt-8 mb-5">
			<div class="text-center">
			<h3 class="text-gradient text-primary">Data Laporan</h3>
			<div class="row">
			<div class="col-md-12 text-center">
			<h6 class="text-gradient text-danger" id="statusku">Status Pengaduan</h6>
			'.(($isi['status'] === 'proses')? '
				<button type="button" onclick="forumchat(this)" idkucuy="'.$isi['id_pg'].'" class="btn bg-gradient-success btn-tooltip " data-bs-toggle="tooltip" data-bs-placement="top" title="DETAIL" data-container="body" data-animation="true" mb-0">Forum
				</button>' : '').'
			'.(($isi['status'] === 'proses')? '
				<button type="button" onclick="lihatlaporan(this)" idkucuy="'.$isi['id_pg'].'" class="btn bg-gradient-info btn-tooltip " data-bs-toggle="tooltip" data-bs-placement="top" title="DETAIL" data-container="body" data-animation="true" mb-0">Lihat Respon
				</button>' : '
				<button type="button"  idkucuy="'.$isi['id_pg'].'" class="btn bg-gradient-primary btn-tooltip " data-bs-toggle="tooltip" data-bs-placement="top" title="DETAIL" data-container="body" data-animation="true" mb-0">'.$isi['status'].'
				</button>
				').'
			</div>
			</div>
			</div>
			<div class="card-body pb-2">
			<div class="form-group mb-0 mt-md-0 mt-4">
			<label>Nomor Pengaduan</label>
			<input type="email" class="form-control" readonly value="'.$isi['id_pg'].'" onfocus="focused(this)" onfocusout="defocused(this)">
			</div>
			<div class="form-group mb-0 mt-md-0 mt-4">
			<label>Nama</label>
			<input type="email" class="form-control" readonly value="'.$isi['nama_pg'].'" onfocus="focused(this)" onfocusout="defocused(this)">
			</div>
			<div class="row">
			<div class="col-md-6">
			<label>Kategori</label>
			<div class="input-group mb-4">
			<input class="form-control" readonly value="'.$isi['kategori'].'" aria-label="Full Name" type="text" onfocus="focused(this)" onfocusout="defocused(this)">
			</div>
			</div>
			<div class="col-md-6 ps-md-2">
			<label>Tanggal Pengaduan</label>
			<div class="input-group">
			<input type="email" class="form-control" readonly value="'.$isi['tgl_pg'].'" onfocus="focused(this)" onfocusout="defocused(this)">
			</div>
			</div>
			</div>
			<div class="form-group mb-0 mt-md-0 mt-4">
			<label>Kelurahan</label>
			<input type="email" class="form-control" readonly value="'.$isi['kelurahan'].'" onfocus="focused(this)" onfocusout="defocused(this)">
			</div>
			<div class="row">
			<div class="col-md-6">
			<label>Rw</label>
			<div class="input-group mb-4">
			<input class="form-control" readonly value="'.$isi['rw'].'" aria-label="Full Name" type="text" onfocus="focused(this)" onfocusout="defocused(this)">
			</div>
			</div>
			<div class="col-md-6 ps-md-2">
			<label>Rt</label>
			<div class="input-group">
			<input type="email" class="form-control" readonly value="'.$isi['rt'].'" onfocus="focused(this)" onfocusout="defocused(this)">
			</div>
			</div>
			</div>
			<div class="form-group mb-0 mt-md-0 mt-4">
			<label>Isi Laporan</label>
			<textarea  name="message" class="form-control" readonly  rows="6" >'.$isi['isi'].'</textarea>
			</div>
			</div>
			</div>
			</div>
			</div>
			</div>
			</div>

			';
		}else{
			$kirim['h'] = false;
			$kirim['i'] = $idkuuh;
		}
		echo json_encode($kirim);
	}

	public function forumchat($data){
		header("Content-Type: application/json");
		header("Access-Control-Allow-Methods: POST");
		header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
		$kirim = [];
		$idkuuh = $_POST['idkucuy'];
		$ambil = $this->mysql->ambilKondisi();
	}

	public function pesankuambejo($data=''){
		header("Content-Type: application/json");
		header("Access-Control-Allow-Methods: POST");
		header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
		$kirim = [];
		$getbls = $this->mysql->ambilKondisiOrder(['id_pg'=>'='],["s.$data"],null,'dt_balasan_pengaduan','waktu');
		

		echo json_encode($kirim);

	}

	public function kirimrespon($data=''){
		header("Content-Type: application/json");
		header("Access-Control-Allow-Methods:POST");
		header("Access-Control-Allow-Header: Content-Type,Access-Control-Allow-Headers, Authorrization, X-Requested-With");	
		$kirim = [];
		$tgl = date('Y-m-d H:i:s' ,strtotime('now'));
		$waktu = time();
		$idrandom = $this->mysql->randomId();
		$datakucuy = ['id.s'=>$idrandom,'id_bls.s'=>$idrandom,'id_pg.s'=>$_POST['idkucuy'],'isi_bls.s'=>$_POST['isipesan'],'create_by.s'=>$_POST['nama_pg'],'tgl_kirim.s'=>$tgl,'waktu.i'=>$waktu];
		$simpan = $this->mysql->simpan($datakucuy,'dt_balasan_pengaduan');
		if ($simpan) {
			$kirim['idkucuy'] =$_POST['idkucuy'];
			$kirim['h'] = true;
		}else{
			$kirim['h'] = false;
		}
		echo json_encode($kirim);
	}

}