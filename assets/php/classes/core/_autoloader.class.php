<?php
defined('BASEURL') OR die("HAYOoo.. mau ngapain? (-_- ')");
class _AutoLoader{
	/**
	 *	method/fungsi yang akan dilakukan ketika public class digunakan
	 */
	private $defaultMethod = 'index';

	function __construct(){
		$this->resolve_url();
	}

	private function resolve_url(){
		include 'pengaturan.php';
		try{
			$simulasi = false;
			if(class_exists('Simulasi')){
				$simulasi = Simulasi::$jalan;
			}
			if($simulasi === true){
				Simulasi::jalankan();
				die();
			}
			else{
				if(isset($_GET[0])){
					$dirini = realpath(__DIR__.'/../');
					if(is_dir($dirini.DIRECTORY_SEPARATOR.$_GET[0])){
						if(isset($_GET[1])){
							$loads = $this->loadClasses($dirini.DIRECTORY_SEPARATOR.$_GET[0]);

							$minta = takeClass(htmlspecialchars(stripslashes(strip_tags($_GET[1]))));
							$method = $this->defaultMethod;

							if(isset($_GET[3])){
								$param = htmlspecialchars(stripslashes(strip_tags($_GET[3])));
								$method = htmlspecialchars(stripslashes(strip_tags($_GET[2])));
								$class = htmlspecialchars(stripslashes(strip_tags($_GET[1])));
								if(is_object($minta)){
									if(is_callable(array($minta, $method))){
										$minta->$method($param);
									}
									else{
										if($_PENGATURAN['404_ON_ERROR'] === true){
											if(isset($_PENGATURAN['404_FILE']) && !empty($_PENGATURAN['404_FILE'])){
												if(file_exists('error/'.$_PENGATURAN['404_FILE'])){
													require_once 'error/'.$_PENGATURAN['404_FILE'];
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
										else{
											echo '$'.$_GET[0].'::'.$_GET[2].', Tidak ada';
											die();
										}
									}
								}
								else{
									if(is_callable(array($minta, $method))){
										$minta[strtolower($class)]->$method($param);
									}
									else{
										if($_PENGATURAN['404_ON_ERROR'] === true){
											if(isset($_PENGATURAN['404_FILE']) && !empty($_PENGATURAN['404_FILE'])){
												require_once 'error/'.$_PENGATURAN['404_FILE'];
											}
											else{
												header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
												die();
											}
										}
										else{
											echo '$'.$_GET[0].'[\''.$_GET[1].'\']::'.$_GET[2].', Tidak ada';
											die();
										}
									}
								}
							}
							elseif(isset($_GET[2])){
								$method = htmlspecialchars(stripslashes(strip_tags($_GET[2])));
								$class = htmlspecialchars(stripslashes(strip_tags($_GET[1])));
								if(is_object($minta)){
									if(is_callable(array($minta, $method))){
										$minta->$method();
									}
									else{
										if($_PENGATURAN['404_ON_ERROR'] === true){
											if(isset($_PENGATURAN['404_FILE']) && !empty($_PENGATURAN['404_FILE'])){
												if(file_exists('error/'.$_PENGATURAN['404_FILE'])){
													require_once 'error/'.$_PENGATURAN['404_FILE'];
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
										else{
											echo '$'.$_GET[0].'::'.$_GET[2].', Tidak ada';
											die();
										}
									}
								}
								else{
									if(is_callable(array($minta, $method))){
										$minta[strtolower($class)]->$method();
									}
									else{
										if($_PENGATURAN['404_ON_ERROR'] === true){
											if(isset($_PENGATURAN['404_FILE']) && !empty($_PENGATURAN['404_FILE'])){
												if(file_exists('error/'.$_PENGATURAN['404_FILE'])){
													require_once 'error/'.$_PENGATURAN['404_FILE'];
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
										else{
											echo '$'.$_GET[0].'[\''.$_GET[1].'\']::'.$_GET[2].', Tidak ada';
											die();
										}
									}
								}
							}
							else{
								$class = htmlspecialchars(stripslashes(strip_tags($_GET[1])));
								if(is_object($minta)){
									if(is_callable(array($minta, $method))){
										$minta->$method();
									}
									else{
										if($_PENGATURAN['404_ON_ERROR'] === true){
											if(isset($_PENGATURAN['404_FILE']) && !empty($_PENGATURAN['404_FILE'])){
												if(file_exists('error/'.$_PENGATURAN['404_FILE'])){
													require_once 'error/'.$_PENGATURAN['404_FILE'];
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
										else{
											echo '$'.$_GET[0].'::'.$_GET[2].', Tidak ada';
											die();
										}
									}
								}
								else{
									if(is_callable(array($minta, $method))){
										$minta[strtolower($class)]->$method();
									}
									else{
										if($_PENGATURAN['404_ON_ERROR'] === true){
											if(isset($_PENGATURAN['404_FILE']) && !empty($_PENGATURAN['404_FILE'])){
												if(file_exists('error/'.$_PENGATURAN['404_FILE'])){
													require_once 'error/'.$_PENGATURAN['404_FILE'];
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
										else{
											echo '$'.$_GET[0].'[\''.$_GET[1].'\']::'.$_GET[2].', Tidak ada';
											die();
										}
									}
								}
							}
						}
						else{
							if(isset($_PENGATURAN['404_FILE']) && !empty($_PENGATURAN['404_FILE'])){
								if(file_exists('error/'.$_PENGATURAN['404_FILE'])){
									require_once 'error/'.$_PENGATURAN['404_FILE'];
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
					}
					elseif($_GET[0] === 'assets'){
						$dirAsset = realpath('assets');
						$minta = takeClass(htmlspecialchars(stripslashes(strip_tags($_GET[0]))));
						$method = htmlspecialchars(stripslashes(strip_tags($_GET[1])));
						if(!isset($_PENGATURAN['ALLOWED_ASSETS'])){
							$_PENGATURAN['ALLOWED_ASSETS'] = ['css', 'js', 'img', 'font', 'doc', 'QrData'];
						}
						if(in_array($method, $_PENGATURAN['ALLOWED_ASSETS'])){
							$fldr = array_search($method, $_PENGATURAN['ALLOWED_ASSETS']);
							if($fldr > -1){
								$mtd = $_PENGATURAN['ALLOWED_ASSETS'][$fldr];
								array_shift($_GET);
								array_shift($_GET);
								$fls = implode('/', $_GET);
								$minta->ambilAsset($mtd, $fls);
							}
							elseif($_PENGATURAN['404_ON_ERROR'] === true){
								if(isset($_PENGATURAN['404_FILE']) && !empty($_PENGATURAN['404_FILE'])){
									if(file_exists('error/'.$_PENGATURAN['404_FILE'])){
										require_once 'error/'.$_PENGATURAN['404_FILE'];
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
							else{
								die("Nyasar ya? (>.<)");
							}
						}
						else{
							if($_PENGATURAN['404_ON_ERROR'] === true){
								if(isset($_PENGATURAN['404_FILE']) && !empty($_PENGATURAN['404_FILE'])){
									if(file_exists('error/'.$_PENGATURAN['404_FILE'])){
										require_once 'error/'.$_PENGATURAN['404_FILE'];
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
							else{
								echo '$'.$_GET[0].'::'.$_GET[1].', Tidak ada';
								die();
							}
						}
					}
					elseif($_GET[0] === 'online_download'){
						if(class_exists('Updating')){
							if(is_callable(array('Updating', 'downloads'))){
								Updating::downloads();
							}
							else{
								if($_PENGATURAN['404_ON_ERROR'] === true && isset($_PENGATURAN['404_FILE']) && !empty($_PENGATURAN['404_FILE']) && file_exists('error/'.$_PENGATURAN['404_FILE'])){
										require_once 'error/'.$_PENGATURAN['404_FILE'];
								}
								else{
									header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
									die();
								}
							}
						}
					}
					elseif($_GET[0] === 'online_update'){
						if(class_exists('Updating')){
							if(is_callable(array('Updating', 'updates'))){
								Updating::updates();
							}
							else{
								if($_PENGATURAN['404_ON_ERROR'] === true && isset($_PENGATURAN['404_FILE']) && !empty($_PENGATURAN['404_FILE']) && file_exists('error/'.$_PENGATURAN['404_FILE'])){
										require_once 'error/'.$_PENGATURAN['404_FILE'];
								}
								else{
									header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
									die();
								}
							}
						}
					}
					else{
						if(isset($_PENGATURAN['DIR_UMUM'])){
							if(is_dir($dirini.DIRECTORY_SEPARATOR.$_PENGATURAN['DIR_UMUM'])){
								$loads = $this->loadClasses($dirini.DIRECTORY_SEPARATOR.$_PENGATURAN['DIR_UMUM']);
								$minta = takeClass(htmlspecialchars(stripslashes(strip_tags($_GET[0]))));

								if(isset($_GET[3])){
									$class = htmlspecialchars(stripslashes(strip_tags($_GET[0])));
									$method = htmlspecialchars(stripslashes(strip_tags($_GET[1])));
									$param = htmlspecialchars(stripslashes(strip_tags($_GET[3])));
									if(is_object($minta)){
										if(is_callable(array($minta, $method))){
											$minta->$method($param);
										}
										else{
											if($_PENGATURAN['404_ON_ERROR'] === true){
												if(isset($_PENGATURAN['404_FILE']) && !empty($_PENGATURAN['404_FILE'])){
													if(file_exists('error/'.$_PENGATURAN['404_FILE'])){
														require_once 'error/'.$_PENGATURAN['404_FILE'];
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
											else{
												echo '$'.$_GET[0].'::'.$_GET[1].', Tidak ada';
												die();
											}
										}
									}
									else{
										if(is_callable(array($minta, $method))){
											$minta[strtolower($class)]->$method($param);
										}
										else{
											if($_PENGATURAN['404_ON_ERROR'] === true){
												if(isset($_PENGATURAN['404_FILE']) && !empty($_PENGATURAN['404_FILE'])){
													if(file_exists('error/'.$_PENGATURAN['404_FILE'])){
														require_once 'error/'.$_PENGATURAN['404_FILE'];
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
											else{
												echo '$'.$_GET[0].'[\''.$_GET[1].'\']::'.$_GET[2].', Tidak ada';
												die();
											}
										}
									}
								}
								elseif(isset($_GET[1])){
									$class = htmlspecialchars(stripslashes(strip_tags($_GET[0])));
									$method = htmlspecialchars(stripslashes(strip_tags($_GET[1])));
									if(is_object($minta)){
										if(is_callable(array($minta, $method))){
											$minta->$method();
										}
										else{
											if($_PENGATURAN['404_ON_ERROR'] === true){
												if(isset($_PENGATURAN['404_FILE']) && !empty($_PENGATURAN['404_FILE'])){
													if(file_exists('error/'.$_PENGATURAN['404_FILE'])){
														require_once 'error/'.$_PENGATURAN['404_FILE'];
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
											else{
												echo '$'.$_GET[0].'::'.$_GET[1].', Tidak ada';
												die();
											}
										}
									}
									else{
										if(is_callable(array($minta, $method))){
											$minta[strtolower($class)]->$method();
										}
										else{
											if($_PENGATURAN['404_ON_ERROR'] === true){
												if(isset($_PENGATURAN['404_FILE']) && !empty($_PENGATURAN['404_FILE'])){
													if(file_exists('error/'.$_PENGATURAN['404_FILE'])){
														require_once 'error/'.$_PENGATURAN['404_FILE'];
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
											else{
												echo '$'.$_GET[0].'[\''.$_GET[1].'\'], Tidak ada';
												die();
											}
										}
									}
								}
								else{
									$method = $this->defaultMethod;
									if(is_object($minta)){
										if(is_callable(array($minta, $method))){
											$minta->$method();
										}
										else{
											if($_PENGATURAN['404_ON_ERROR'] === true){
												if(isset($_PENGATURAN['404_FILE']) && !empty($_PENGATURAN['404_FILE'])){
													if(file_exists('error/'.$_PENGATURAN['404_FILE'])){
														require_once 'error/'.$_PENGATURAN['404_FILE'];
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
											else{
												echo '$'.$_GET[0].'::'.$method.', Tidak ada';
												die();
											}
										}
									}
									else{
										if(is_callable(array($minta, $method))){
											$minta[strtolower($class)]->$method();
										}
										else{
											if($_PENGATURAN['404_ON_ERROR'] === true){
												if(isset($_PENGATURAN['404_FILE']) && !empty($_PENGATURAN['404_FILE'])){
													if(file_exists('error/'.$_PENGATURAN['404_FILE'])){
														require_once 'error/'.$_PENGATURAN['404_FILE'];
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
											else{
												echo '$'.$_GET[0].'[\''.$method.'\'], Tidak ada';
												die();
											}
										}
									}
								}
							}
							else{
								if(isset($_PENGATURAN['404_FILE']) && !empty($_PENGATURAN['404_FILE'])){
									if(file_exists('error/'.$_PENGATURAN['404_FILE'])){
										require_once 'error/'.$_PENGATURAN['404_FILE'];
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
						}
						else{
							if(isset($_PENGATURAN['404_FILE']) && !empty($_PENGATURAN['404_FILE'])){
								if(file_exists('error/'.$_PENGATURAN['404_FILE'])){
									require_once 'error/'.$_PENGATURAN['404_FILE'];
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
					}
				}
				elseif(!isset($_GET[0])){
					$this->halaman_awal();
				}
				else{
					die("Nyasar ya? (>.<)");
				}
			}
		}
		catch(Exception $e){
		}
	}

	private function halaman_awal(){
		try {
			$method = $this->defaultMethod;

			$pubList  = getClass([realpath(__DIR__.'/../awal.class.php')]);
			$pubclass =& cekClass($pubList);
			$minta = takeClass('awal');
			$minta->$method();
		} 
		catch (Exception $e) {
		}
	}

	private function loadClasses($path){
		$pubFiles = getFileName($path);
		$pubList  = getClass($pubFiles);
		$pubclass =& cekClass($pubList);
		return $pubclass;
	}

}