<?php
defined('BASEURL') OR die("HAYOoo.. mau ngapain? (-_- ')");
class DataBase{
	private static $hostdb;
	private static $userdb;
	private static $passdb;
	private static $datadb;
	public $pdo 	= '';
	public $mysqli  = '';

	function __construct(){
		include 'pengaturan.php';
		if(isset($_PENGATURAN['DB'])){
		    if(gettype($_PENGATURAN['DB']) === 'array' || gettype($_PENGATURAN['DB']) === 'object'){
		        $this->mysqli = array();
		        $this->pdo = array();
		        foreach($_PENGATURAN['DB'] as $idx => $vl){
		            if(gettype($vl) === 'array' || gettype($vl) === 'object'){
		                foreach($vl as $nama => $nilai){
		                    $$nama = $nilai;
		                }
		                $mysq = static::mysqli1($HOST_DB, $USER_DB, $DATA_DB, $PASS_DB);
		                $pdo = static::pdo1($HOST_DB, $USER_DB, $DATA_DB, $PASS_DB);
		                array_push($this->mysqli, $mysq);
		                array_push($this->pdo, $pdo);
		            }
		        }
		    }
		}
		else{
    		self::$hostdb = $_PENGATURAN['HOST_DB'];
    		self::$userdb = $_PENGATURAN['USER_DB'];
    		self::$passdb = $_PENGATURAN['PASS_DB'];
    		self::$datadb = $_PENGATURAN['DATA_DB'];
    		$this->pdo = static::pdo();
    		$this->mysqli = static::mysqli();
		}
	}

	private static function mysqli(){
	    if(!empty(self::$hostdb) && !empty(self::$userdb) && !empty(self::$passdb) && !empty(self::$datadb)){
		    return new mysqli(self::$hostdb, self::$userdb, self::$passdb, self::$datadb);
	    }
		elseif(!empty(self::$hostdb) && !empty(self::$userdb) && !empty(self::$datadb)){
			return new mysqli(self::$hostdb, self::$userdb, self::$passdb, self::$datadb);
		}
	}

	private static function pdo(){
	    if(!empty(self::$hostdb) && !empty(self::$userdb) && !empty(self::$passdb) && !empty(self::$datadb)){
		    return new PDO('mysql:host='.self::$hostdb.';dbname='.self::$datadb, self::$userdb, self::$passdb);
	    }
	    elseif(!empty(self::$hostdb) && !empty(self::$userdb) && !empty(self::$datadb)){
			return new PDO('mysql:host='.self::$hostdb.';dbname='.self::$datadb, self::$userdb, self::$passdb);
		}
	}
	
	private static function mysqli1($host, $user, $db, $pass = ''){
	    return new mysqli($host, $user, $pass, $db);
	}
    
    private static function pdo1($host, $user, $db, $pass = ''){
        return new PDO('mysql:host='.$host.';dbname='.$db, $user, $pass);
    }
}