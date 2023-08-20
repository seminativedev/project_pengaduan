<?php 
if(isset($_PENGATURAN['SECURE_CROSS']) && $_PENGATURAN['SECURE_CROSS'] === true){
    $remote = (isset($_SERVER['REMOTE_ADDR']))? $_SERVER['REMOTE_ADDR']:null;
    if(!empty($remote)){
        $sb = filter_var($remote, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_IPV6);
        if($sb === false){
            $smsg = (isset($_PENGATURAN['SECURE_PESAN']) && !empty($_PENGATURAN['SECURE_PESAN']))? $_PENGATURAN['SECURE_PESAN']:null;
            die($smsg);
        }
    }
}

if(isset($_PENGATURAN['SECURE_SPESIFIK']) && $_PENGATURAN['SECURE_SPESIFIK'] === true){
    $req = (isset($_SERVER['REQUEST_URI']))? $_SERVER['REQUEST_URI']:null;
    $sfld= (isset($_PENGATURAN['SECURE_REQ']) && is_array($_PENGATURAN['SECURE_REQ']))? $_PENGATURAN['SECURE_REQ']:null;
    $smsg= (isset($_PENGATURAN['SECURE_PESAN']) && !empty($_PENGATURAN['SECURE_PESAN']))? $_PENGATURAN['SECURE_PESAN']:null;
    if(!empty($req) && !empty($sfld)){
        $ereq = explode('/', $req);
        foreach($ereq as $ida => $ika){
            if(in_array($ika, $sfld)){
                die($smsg);
            }
        }
    }
}
if(!defined('BASEDIR')){
    if($_SERVER['HTTP_HOST'] !== 'localhost'){
        define('BASEDIR', '/');
    }
}
function checkUrl(){
    try {
        $f = range(0, 100000);
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
                $d = explode('/', $c);
                if(sizeof($d) > sizeof($f)){
                    trigger_error('Link telah mencapai batas maksimal yang diizinkan', E_USER_ERROR);
                }
                else{
                    foreach ($d as $g => $h) {
                        if(!empty(trim($h))){
                            $_GET[$f[$g]] = $h;
                        }
                    }
                }
            }
        }
        
    } catch (Exception $e) {
        
    }
}
checkUrl();