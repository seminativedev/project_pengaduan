<?php 
defined('BASEURL') OR die("HAYOoo.. mau ngapain? (-_- ')");
class View{

	private static $viewPath;
	private static $tempPath;
	private static $path = null;
	private static $tempFile;
	private static $tmpDir = '';
	private static $cache = false;
	private static $cacheTime = 0;
	private static $cacheDir;
	function __construct(){
		self::$viewPath = __DIR__.'/../../../../page';
		self::$tempPath = __DIR__.'/../../../../page/templates';
		self::$tmpDir   = __DIR__.'/../../../tmp';
		self::$cacheDir = __DIR__.'/../../../cache';
		if(!is_dir(self::$cacheDir)){
			mkdir(self::$cacheDir);
		}
		static::setEnv();
	}
	/**
	 * $fileNdata = 'namafile';
	 * $fileNdata = arrray('namafile'=>$data, 'namafile'=>null);
	 * $data string | array dari data yang akan digunakan pada file yang di panggil
	 */
	public function show($fileNdata){
		try{
			$files = $this->_getFile(self::$path);
			if(!empty($files)){
				if(!empty($fileNdata)){
					if(!is_string($fileNdata)){
						$namafile = array_keys($fileNdata);
						$data = array_values($fileNdata);
						$ke = 0;
						foreach ($files as $nama => $path) {
							if(isset($namafile[$ke]) && strtolower($namafile[$ke]) === $nama){
								if(isset($data[$ke])){
									echo $this->renderWithData($path, $data[$ke]);
								}
								else{
									echo $this->render($path);
								}
							}
						}
					}
					elseif(is_string($fileNdata)){
						foreach ($files as $nama => $path) {
							if(strtolower($fileNdata) === $nama){
								echo $this->render($path);
							}
						}
					}
				}
			}
			else{
				throw new Exception('tidak dapat menampilkan halaman');
			}
		}
		catch(Exception $e){
			$bt = debug_backtrace();
            $caller = array_shift($bt);
            $files = $caller['file'];
            $lines = $caller['line'];
            echo $e->getMessage()."<br>pada : ". $files ." baris : ". $lines;
		}
	}
	
	/*
	 * $fileNdata = 'namafile';
	 * $fileNdata = arrray('namafile'=>$data, 'namafile'=>null);
	 * $data string | array dari data yang akan digunakan pada file yang di panggil
	 * return string
	 */
	public function text($fileNdata){
	    $files = $this->_getFile(self::$path);
		
		if(!empty($fileNdata)){
			if(!is_string($fileNdata)){
				$namafile = array_keys($fileNdata);
				$data = array_values($fileNdata);
				$ke = 0;
				foreach ($files as $nama => $path) {
					if(isset($namafile[$ke]) && strtolower($namafile[$ke]) === $nama){
						if(isset($data[$ke])){
							return $this->renderWithData($path, $data[$ke]);
						}
						else{
							return $this->render($path);
						}
					}
				}
			}
			elseif(is_string($fileNdata)){
				foreach ($files as $nama => $path) {
					if(strtolower($fileNdata) === $nama){
						return $this->render($path);
					}
				}
			}
		}
	}
	/*
	 * untuk mengambil template yang akan digunakan 
	 */
	public function template($fileNdata){
	    if(!is_dir(self::$tmpDir)){
	        mkdir(self::$tmpDir);
	    }
	    $tmpfiles = $this->_getFile(self::$tempPath);
    	if(!empty($fileNdata)){
    	    $namafl = self::$tmpDir.DIRECTORY_SEPARATOR.microtime(true).'.php';
    	    
    	    if(!is_string($fileNdata)){
    	        $namafile = array_keys($fileNdata);
				$data = array_values($fileNdata);
				$ke = 0;
				foreach($tmpfiles as $nama => $path){
				    if(strtolower($namafile[$ke]) == $nama){
				        $isi = $this->renderWithData($path, $data[$ke]);
        	            file_put_contents($namafl, $isi);
        	            self::$tempFile = $this->getLines($namafl);
				        break;
				    }
				}
    	    }
    	    elseif(is_string($fileNdata)){
        	    foreach($tmpfiles as $nama => $path){
        	        if(strtolower($fileNdata) == strtolower($nama)){
        	            $isi = $this->render($path);
        	            file_put_contents($namafl, $isi);
        	            self::$tempFile = $this->getLines($namafl);
        	            break;
        	        }
        	    }
    	    }
    	    if(is_file($namafl)){
    	        unlink($namafl);
    	    }
    	}
	}
	
	public function templateShow($fileNdata){
	    try{
    	    if(!empty(self::$tempFile)){
    	        if(!is_dir(self::$tmpDir)){
    	            mkdir(self::$tmpDir);
    	            $cname = self::$cacheDir.DIRECTORY_SEPARATOR.'cache.snd';
    	            file_put_contents($cname, json_encode([]));
    	        }
    	        $cekcache = self::cekCache();
    	        if($cekcache !== false){
    	        	$nm = static::namaFile($cekcache);
					static::showCache($cekcache, $nm);
    	        }
    	        else{
	    	        $judul = '';
	    	        $namafl = hash_hmac('sha1', hash('sha256', microtime(true)), 'snd');
	    	        $flContent = self::$tmpDir.DIRECTORY_SEPARATOR.$namafl;
	        	    $doc = '';
	        	    $conts = '';
	    	        if(!empty(self::$path)){
	        	        $content = $this->text($fileNdata);
	        	        file_put_contents($flContent, $content);
	        	        $isi = $this->getLines($flContent);
	        	        foreach($isi as $ln){
	        	            $spos = strpos($ln, "#judul('");
	        	            if($spos > -1){
	        	                $epos = strpos($ln, ")", $spos+8);
	        	                $judul = substr($ln, $spos+8, $epos-($spos+8)-1);
	        	                $conts .= substr_replace($ln, '', $spos, $epos-$spos+1);
	        	            }
	        	            elseif(empty($ln) || trim($ln) == ""){
	        	                continue;
	        	            }
	        	            else{
	        	            	// Remove comments
								// $ln = preg_replace('/\/\*[^\/]*\*\//', '', $ln);
								// $ln = preg_replace('/\/\*\*((\r\n|\n) \*[^\n]*)+(\r\n|\n) \*\//', '', $ln);
								// $ln = preg_replace('/\n(\s+)?\/\/[^\n]*/', '', $ln);
								// $ln = preg_replace('/ (\t| )+/', '', $ln);
								// $ln = preg_replace('/([\n])+/', "$1", $ln);
								$pattern = '/(?:(?:\/\*(?:[^*]|(?:\*+[^*\/]))*\*+\/)|(?:(?<!\:|\\\|\')\/\/.*))/';
								$conts .= $ln."\n";
	        	            }
	        	        }
	        	        unlink($flContent);

	        	        foreach(self::$tempFile as $line){
	        	            $titPos = strpos($line, "#template('judul')");
	        	            $contPos = strpos($line, "#template('content')");
	        	            if($titPos > -1){
	        	                $doc .= substr_replace($line, $judul, $titPos, 18);
	        	            }
	        	            elseif(empty(trim($line))){
	        	                continue;
	        	            }
	        	            elseif($contPos > -1){
	        	                $doc .= $conts;
	        	            }
	        	            else{
	        	                $doc .= $line;
	        	            }
	        	        }
	        	        if(self::$cache){
	        	        	if(!is_dir(self::$cacheDir)){
								mkdir(self::$cacheDir);
							}
							$flnm = self::$cacheDir.DIRECTORY_SEPARATOR."$namafl.snd";
							file_put_contents($flnm, $doc);
	        	        	static::buatCache($flnm);
	        	        }
	        	        else{
	        	        	echo $doc;
	        	        }
	    	        }
	    	        else{
	    	            trigger_error('folder tidak diketahui! gunakan fungsi $this->view->setDir("nama_folder") untuk menentukan folder yang ingin digunakan', E_USER_ERROR);
	    	        }
    	        }
    	    }
    	    else{
    	        trigger_error('template tidak ada! gunakan fungsi $this->view->template("nama_template") untuk menentukan template yang ingin digunakan', E_USER_ERROR);
    	    }
	    }
	    catch(Exception $ex){
	        var_dump($ex);
	    }
	}

	private static function showCache($path, $nama){
		ob_start('ob_gzhandler');
		// header($_SERVER["SERVER_PROTOCOL"] . " 200 OK");
		header("Cache-Control: public"); // needed for internet explorer
		header("Content-Type: text/html");
		header("Content-Transfer-Encoding: gzip");
		header('Expires: '.gmdate('D, d M Y H:i:s \G\M\T', time()+ self::$cacheTime));
		header("Pragma: public");
		header("Content-Disposition: inline; filename=$nama");
		readfile($path);
		die();
	}

	private static function buatCache($path){
		$req = '';
		$waktu = time() + self::$cacheTime;
		if(self::checkBase()){
			$req = '!@#$%^&';
		}
		else{
			foreach ($_GET as $idx => $nl) {
				if($nl !== '' && $nl !== null){
					if($idx == sizeof($_GET)){
						$req .= $nl;
					}
					else{
						$req .= "$nl|";
					}
				}
			}
		}
		if(!empty($req)){
			$cachefile = self::$cacheDir.DIRECTORY_SEPARATOR.'cache.snd';
			if(is_file($cachefile)){
				$isi = file_get_contents($cachefile);
				$js = json_decode($isi);
				if(sizeof($js) > 0){
					$a['req'] = $req;
					$a['path'] = $path;
					$a['time'] = $waktu;
					array_push($js, $a);
				}
				else{
					$js[0]['req'] = $req;
					$js[0]['path'] = $path;
					$js[0]['time'] = $waktu;
				}
				file_put_contents($cachefile, json_encode($js));
			}
			else{
				$js[0]['req'] = $req;
				$js[0]['path'] = $path;
				$js[0]['time'] = $waktu;
				file_put_contents($cachefile, json_encode($js));
			}
			
			$nm = static::namaFile($path);
			static::showCache($path, $nm);
		}
	}

	private static function checkBase(){
		$a = strlen(BASEDIR);
		$b = strpos($_SERVER['REQUEST_URI'], BASEDIR);
		if($b > -1){
			if($_SERVER['HTTP_HOST'] !== 'localhost'){
				$e = $b+$a;
			}
			else{
				$e = $b+$a+1;
			}
			$c = substr($_SERVER['REQUEST_URI'], $e, strlen($_SERVER['REQUEST_URI']));
			if(strlen($c) > 0 && explode('/', $c) > 0){
				return false;
			}
			else{
				return true;
			}
		}
	}


	// return lokasi file jika cache ada dan waktu belum expire
	// return false jika cache tidak ada atau waktu cache file habis
	private static function cekCache(){
		$cachefile = self::$cacheDir.DIRECTORY_SEPARATOR.'cache.snd';
		if(file_exists($cachefile)){
			$req = '';
			if(static::checkBase()){
				$req = '!@#$%^&';
			}
			else{
				foreach ($_GET as $idx => $nl) {
					if($nl !== '' && $nl !== null){
						if($idx == sizeof($_GET)){
							$req .= $nl;
						}
						else{
							$req .= "$nl|";
						}
					}
				}
			}
			$file = '';
			$cfile = [];
			$isi = file_get_contents($cachefile);
			$jfile = json_decode($isi);
			if(sizeof($jfile) > 0){
				foreach($jfile AS $ke => $i){
					if($i->req == $req && $i->time < time()){
						$cfile[] = $i;
						$file = $i->path;
					}
					elseif($i->time < time()){
						$cfile[] = $i;
					}
					elseif($i->time >= time()){
						unlink($i->path);
					}
				}
				file_put_contents($cachefile, json_encode($cfile));
			}

			if(!empty($file)){
				return $file;
			}
			else{
				return false;
			}
		}
		else{
			file_put_contents($cachefile, json_encode([]));
			return false;
		}
	}

	private static function namaFile($path){
		$ex = explode(DIRECTORY_SEPARATOR, $path);
		return $ex[sizeof($ex)-1];
	}

	public static function cache($waktu = 30){
		self::$cache = true;
		self::$cacheTime = $waktu;
	}

	private static function setEnv(){
		session_name('spider');
		if(isset($_COOKIE['PHPSESSID'])){
		    setcookie ("PHPSESSID", "", time() - 3600);
		}
		if(!isset($_COOKIE['spider'])){
    		$cookies = ['expires' => time()+(60*60*24*1),'path' => '/','domain' => $_SERVER['HTTP_HOST'],'secure' => true,'httponly' => true,'samesite' => 'Lax'];
    		$iva = hash_hmac('sha1', hash('sha256', microtime(true)), 'snd');
    		setcookie('spider', $iva, $cookies);
		}
		if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    	if(isset($_COOKIE['PHPSESSID'])){
    	    unset($_COOKIE['PHPSESSID']);
    	}
	}
	
	/**
	 *  digunakan untuk mengarahkan folder yang akan digunakan
	 *  $dir  string nama folder yang akan digunakan
	 * 
	 */
	public function setDir($dir = ''){
		if($dir !== ''){
			self::$path = self::$viewPath.DIRECTORY_SEPARATOR.$dir;
		}
		else{
			self::$path = self::$viewPath;
		}
	}
	/**
	 *  digunakan untuk pindah halaman 
	 *  $url  string dari class yang akan ditampilkan
	 * 
	 */
	public function pindah($url, $slash = true){
	    if($url != '/' AND $slash === true){
    		header('Refresh:0;url='.BASEURL.'./'.$url.'/');
    		exit;
	    }
	    elseif($url != '/' AND $slash === false){
	        header('Refresh:0;url='.BASEURL.'./'.$url);
    		exit;
	    }
	    elseif($url == '/' AND $slash === true){
	        header('Refresh:0;url='.BASEURL.'./');
    		exit;
	    }
	    elseif($url == '/' AND $slash === false){
	        header('Refresh:0;url='.BASEURL);
    		exit;
	    }
	}
	
	public function nonSlashPindah($url){
	    $this->pindah($url, false);
	}
	
	
	/*
	 *  digunakan untuk mengambil isi file 
	 *  mengabaikan baris tersebut kosong atau hanya spasi
	 *  hasil : array dari setiap baris dalam file
	 */
	private function getLines($path){
	    return file($path, FILE_SKIP_EMPTY_LINES);
	}

	/**
	 *  digunakan untuk mengambil file yang akan digunakan
	 *  $path  string lokasi dari file yang akan diambil
	 *  $result  array dari hasil ambil dari lokasi file
	 */
	private function _getFile($path, &$result = array()){

		if(is_dir($path)){
			$dir = opendir($path);
			while (($content = readdir($dir)) !== false) {
			    if ($content === '.' || $content === '..') {
			        continue;
			    }
			    if (is_dir("$path/$content") === false) {
			    	if(substr($content, -9) === '.view.php'){
			    		$name = strtolower(strtr($content, array('.view.php'=>'')));
			    		if(!in_array($name, $result)){
			        	    $result[$name] = realpath($path . DIRECTORY_SEPARATOR . $content);
			    		}
			    	}
			    }
			    else{
			        $this->_getFile("$path/$content", $result);
			    }
			}
			closedir($dir);
			return $result;
		}
		else{
			throw new Exception("folder $path tidak ditemukan !");
		}
	}

	/**
	 *  digunakan untuk menampilkan isi file dari hasil _getFile()
	 *  $namafile  string isi text dari file yang diambil
	 * 
	 */
	private function render($namafile){
	    $ke = 1;
		ob_start();
	    require_once($namafile);
	    $isi = ob_get_clean();
	    $isi1 = strtr($isi, array("\t"=>''));
	    $isi2 = preg_replace("/<!--(.*)?-->/", '', $isi1);
	    $isi3 = preg_replace('/ {2,}/', ' ', $isi2);
	    return $isi3;
	}

	/**
	 *  digunakan untuk menampilkan isi file dari hasil _getFile() dan mengikutkan data
	 *  $namafile  string isi text dari file yang diambil
	 * 	$isidata  resource isi data yang akan digunakan
	 *  varilable $data yang digunakan dalam file untuk mengambil isi data dari variable $isidata
	 */

	private function renderWithData($namafile, $isidata){
	    $ke = 1;
		ob_start();
	    $data = $isidata;
	    require_once($namafile);
	    $isi = ob_get_clean();
	    $isi1 = strtr($isi, array("\t"=>''));
	    $isi2 = preg_replace("/<!--(.*)?-->/", '', $isi1);
	    $isi3 = preg_replace('/ {2,}/', ' ', $isi2);
	    return $isi3;
	}

}