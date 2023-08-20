<?php
defined('BASEURL') OR die("HAYOoo.. mau ngapain? (-_- ')");
class Dashboard extends _Controller{
	private static $dbanggota, $dbdpc, $dbdprt, $dbdpd, $dbdpw, $dbcaleg, $docpath = 'assets/doc/', $cons;
// ^ hasil gabungan
	private static $dbcaleg;
	function __construct(){
		self::$dbanggota = $this->database->mysqli[0];
// ^ hasil gabungan
		self::$dbdpc = $this->database->mysqli[1];
// ^ hasil gabungan
		self::$dbdpd = $this->database->mysqli[2];
// ^ hasil gabungan
		self::$dbdprt = $this->database->mysqli[3];
// ^ hasil gabungan
		self::$dbdpw = $this->database->mysqli[4];
// ^ hasil gabungan
		parent::__construct();
		$this->mysql->setCon(self::$dbcaleg);
// ^ hasil gabungan
		self::$dbcaleg = $this->database->mysqli[5];
	}
}
