<?php 
defined('BASEURL') OR die("HAYOoo.. mau ngapain? (-_- ')");
#[AllowDynamicProperties]
class Assets{
	
	function __construct(){
	}

	public function ambilAsset($dir, $file = ''){
		$drs = 'assets/'.$dir;
		if(is_dir($drs)){
			$path = "assets/$dir/$file";
			if($path !== '' && file_exists($path)){
				$nama = $this->filename($path);
				$this->ambil($path, $nama, '');
			}
			else{
				header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
				die();
			}
		}
		else{
			header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
			die();
		}
	}

	private static function minic($path){
		try{
			$isi = file_get_contents($path);
			$isi1 = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $isi);
			$isi2 = str_replace(': ', ':', $isi1);
			$isi3 = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $isi2);
			$isi4 = preg_replace('/(?:(?:\/\*(?:[^*]|(?:\*+[^*\/]))*\*+\/)|(?:(?<!\:|\\\|\'|\")\/\/.*))/', '', $isi3);
			file_put_contents($path, $isi4);
		}
		catch(Exception $e){
			header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
			die();
		}
	}
	
	private function filename($path = ''){
		$ex = explode('/', $path);
		return $ex[sizeof($ex)-1];
	}

	private function ctype($filename) {
	    $result = new finfo();

	    if (is_resource($result) === true) {
	        return $result->file($filename, FILEINFO_MIME_TYPE);
	    }

	    return false;
	}

	private function ambil($path, $file, $tipe){
		ob_start('ob_gzhandler');
		$fltype = $this->ctype($path);
        header("Content-Type: ".$fltype);
        header("Cache-Control: public, max-age=604800"); // needed for internet explorer
        header("Content-Transfer-Encoding: gzip");
        header("Content-Length:".filesize($path));
        header("Content-Disposition: inline; filename=$file");
        readfile($path);
        die();
    }
}