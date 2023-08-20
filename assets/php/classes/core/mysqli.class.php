<?php 
class Mysql{
    private static $table;
    private static $mysqli;
    private static $listTable = array();
    private static $listColumn = array();
    private static $simbolmysqli = array('*', '%', '>', '<', '=', '!', '-', '|', '/', '&', '!=', '>=', '<=', '+=', '-=', '^-=', '/=', '*=',
    '%=', '&=', '|*=', '<>', '==');
    private static $logicmysqli = array('ALL', 'AND', 'ANY', 'BETWEEN', 'EXISTS', 'IN', 'LIKE', 'NOT', 'OR', 'SOME');
    private static $simbol = array('~'=>'', '`'=>'', '!'=>'', '#'=>'', '$'=>'', '%'=>'', '^'=>'', '&'=>'', '*'=>'', ')'=>'', '-'=>'', '+'=>'', '='=>'', '{'=>'', '}'=>'', '['=>'', ']'=>'', ':'=>'', ';'=>'', '"'=>'', "'"=>'', '<'=>'', '>'=>'', ','=>'', '.'=>'', '?'=>'', '/'=>'', '|'=>'', '\\'=>'', '('=>'');
    function __construct(){
    }

    public function setCon($mysqli){
        try{
            if(!empty($mysqli)){
                self::$mysqli = $mysqli;
                $this->simpanTable(self::$mysqli);
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

    #$data = array('kolom.s'=>'ita', 'kolom1.s'=>'nipru');
    ## simpan data kedalam database
    public function simpan($data, $table = null, $mysqli = null){   
        try{
            if($mysqli == null && self::$mysqli != null){
                $mysqli = self::$mysqli;
            }
            elseif($mysqli == null && self::$mysqli == null){
                throw new Exception('Error : tidak ada koneksi ke database !');
            }
            
            if($table == null && self::$table != null){
                $table = self::$table;
            }
            
            $isidata = array($data, $table);
            
            if($this->cekKosong($isidata) === true){
                if(is_array($data)){
                    $jumdt = count($data);
                    $tanya = array_fill(0, $jumdt, '?');
                    $tanya = implode(', ', $tanya);
                    $rows = array();
                    $isidt = array();
                    $tipedt = '';
                    foreach($data as $i => $v){
                        $head = explode('.', $i);
                        if(sizeof($head) == 2){
                            switch(strtolower($head[1])){
                                # tipe data adalah integer
                                case'i':
                                    $d = $this->sqlEscape($v);
                                    array_push($rows, $head[0]);
                                    array_push($isidt, $d);
                                    $tipedt .= 'i';
                                    break;
                                # tipe data adalah string
                                case 's':
                                    $d = $this->sqlEscape($v);
                                    array_push($rows, $head[0]);
                                    array_push($isidt, $d);
                                    $tipedt .= 's';
                                    break;
                                # tipe data adalah blob
                                case 'b':
                                    array_push($rows, $head[0]);
                                    array_push($isidt, $this->encodeBlob($v));
                                    $tipedt .= 's';
                                    break;
                                # tipe data adalah float
                                case 'd':
                                    $d = $this->sqlEscape($v);
                                    array_push($rows, $head[0]);
                                    array_push($isidt, $d);
                                    $tipedt .= 'd';
                                    break;
                                case 'j':
                                    $d = json_encode($v);
                                    array_push($rows, $head[0]);
                                    array_push($isidt, $d);
                                    $tipedt .= 's';
                                    break;
                            }
                        }
                        else{
                            throw new Exception('Error: key data pada fungsi simpan harus berupa nama.tipe !');
                        }
                    }
                    if(is_string($table)){
                        if(in_array($table, self::$listTable)){
                            $this->cekKolom($table);
                            $jumrows = count($rows);
                            if(sizeof(self::$listColumn) > 0){
                                $banding = array_intersect(self::$listColumn, $rows);
                                if(sizeof($banding) != sizeof($rows)){
                                    throw new Exception("Error : kolom pada tabel $table tidak sesuai !");
                                }
                            }
                            else{
                                throw new Exception('Error : tabel tidak memiliki kolom !');
                            }
                            $header = implode(', ', $rows);
                            $simpan = $mysqli->prepare("INSERT INTO $table($header) VALUES($tanya)");
                            $simpan-> bind_param($tipedt, ...$isidt);
                            $simpan->execute();
                            if($simpan->affected_rows == 1){
                                return true;
                            }
                            else{
                                return $mysqli->error;
                            }
                        }
                        else{
                            throw new Exception('Error : tabel tidak diketahui !');
                        }
                    }
                    else{
                        throw new Exception('Error : parameter table pada simpan harus berupa string !');
                    }
                }
                else{
                    throw new Exception('Error: parameter data pada fungsi simpan harus array !<br>Tipe yang dimasukan adalah "'.gettype($data).'"');
                }
            }
            else{
                throw new Exception('Error: parameter simpan tidak lengkap !');
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
    
    ## hapus data dalam database
    public function hapus($id, $table = null, $mysqli = null){
        $berhasil = false;
        try{
            if($mysqli == null && self::$mysqli != null){
                $mysqli = self::$mysqli;
            }
            elseif($mysqli == null && self::$mysqli == null){
                throw new Exception('Error : tidak ada koneksi ke database !');
            }
            if($table == null && self::$table != null){
                $table = self::$table;
            }
            if(is_array($table)){
                throw new Exception('Error : tipe parameter table harus berupa string !');
            }
            $isi = array($id, $table);
            if($this->cekKosong($isi) === true){
                if(is_array($id) && is_string($table)){
                    $berhasil = array();
                    foreach($id as $i => $v){
                        if(is_int($i)){
                            if(in_array($table, self::$listTable)){
                                $d = $this->sqlEscape($v);
                                $cek = $this->cekId($d, $table);
                                if($cek === true){
                                    $hapus = $mysqli->prepare("DELETE FROM $table WHERE id = ?");
                                    $hapus->bind_param('s', $d);
                                    if($hapus->execute()){
                                        if($hapus->affected_rows == 1){
                                            array_push($berhasil, true);
                                        }
                                        else{
                                            array_push($berhasil, false);
                                        }
                                    }
                                    else{
                                        throw new Exception('Error : '.$mysqli->error);
                                    }
                                }
                                else{
                                    throw new Exception("Error : '$d' tidak ada pada tabel '$table' !");
                                }
                            }
                            else{
                                throw new Exception('Error : tabel tidak diketahui !');
                            }
                        }
                        else{
                            throw new Exception('Error : parameter id pada hapus harus berupa array tunggal !<br> tipe yang dimasukan adalah "'.gettype($i).'"');
                        }
                    }
                }
                elseif(is_string($id) && is_string($table)){
                    if(in_array($table, self::$listTable)){
                        $d = $this->sqlEscape($id);
                        if($this->cekId($d, $table) === true){
                            $hapus = $mysqli->prepare("DELETE FROM $table WHERE id = ?");
                            $hapus->bind_param('s', $d);
                            if($hapus->execute()){
                                if($hapus->affected_rows == 1){
                                    $berhasil = true;
                                }
                                else{
                                    $berhasil = false;
                                }
                            }
                            else{
                                throw new Exception('Error : '.$mysqli->error);
                            }
                        }
                        else{
                            throw new Exception("Error : '$id' tidak ditemukan pada tabel '$table' !");
                        }
                    }
                    else{
                        throw new Exception('Error : tabel tidak diketahui !');
                    }
                }
                else{
                    throw new Exception('Error : tipe '.gettype($id).' tidak didukung pada fungsi hapus !');
                }
            }
            else{
                throw new Exception('Error : parameter hapus tidak lengkap !');
            }
            return $berhasil;
        }
        catch(Exception $e){
            $bt = debug_backtrace();
            $caller = array_shift($bt);
            $files = $caller['file'];
            $lines = $caller['line'];
            echo $e->getMessage()."<br>pada : ". $files ." baris : ". $lines;
        }  
    }
    
    ## ubah data dalam database
    ## $set = array('kolom.tipe_data'=>'nilai_kolom');
    public function ubah($id, $set, $table = null, $mysqli = null){
        try{
            if($mysqli == null && self::$mysqli != null){
                $mysqli = self::$mysqli;
            }
            elseif($mysqli == null && self::$mysqli == null){
                throw new Exception('Error : tidak ada koneksi ke database !');
            }
            if($table == null && self::$table != null){
                $table = self::$table;
            }
            if(is_array($table)){
                throw new Exception('Error : tipe parameter table harus berupa string !');
            }
            if(is_array($id)){
                throw new Exception('Error : tipe parameter id harus berupa string !');
            }
            $isicek = array($id, $set, $table);
            if($this->cekKosong($isicek) === true){
                if(is_array($set) && is_string($table)){
                    $this->cekKolom($table);
                    $jumdt = count($set);
                    $isihead = array();
                    $isiparam = array();
                    $tipedt = '';
                    foreach($set as $i => $v){
                        $head = explode('.', $i);
                        if(sizeof($head) == 2){
                            switch(strtolower($head[1])){
                                # tipe data adalah integer
                                case'i':
                                    array_push($isihead, $head[0]);
                                    array_push($isiparam, $this->sqlEscape($v, $mysqli));
                                    $tipedt .= 'i';
                                    break;
                                # tipe data adalah string
                                case 's':
                                    array_push($isihead, $head[0]);
                                    array_push($isiparam, $this->sqlEscape($v, $mysqli));
                                    $tipedt .= 's';
                                    break;
                                # tipe data adalah blob
                                case 'b':
                                    array_push($isihead, $head[0]);
                                    array_push($isiparam, $this->encodeBlob($v));
                                    $tipedt .= 's';
                                    break;
                                #tipe data adalah float
                                case 'd':
                                    array_push($isihead, $head[0]);
                                    array_push($isiparam, $this->sqlEscape($v, $mysqli));
                                    $tipedt .= 'd';
                                    break;
                                case 'j':
                                    array_push($isihead, $head[0]);
                                    array_push($isiparam, json_encode($v));
                                    $tipedt .= 's';
                                    break;
                            }
                        }
                        else{
                            throw new Exception('Error: key pada parameter set pada fungsi ubah harus berupa nama.tipe !');
                        }
                    }
                    if(sizeof(self::$listColumn) > 0){
                        $l = array_intersect(self::$listColumn, $isihead);
                        if(sizeof($l) != sizeof($isihead)){
                            throw new Exception("Error : kolom pada $table tidak sesuai !");
                        }
                    }
                    else{
                        throw new Exception("Error : tabel $table tidak memiliki kolom !");
                    }
                    $sets = '';
                    $jumset = count($isihead) - 1;
                    for($i = 0; $i < count($isihead); $i++){
                        if($i == $jumset){
                            $sets .= $isihead[$i].'= ? ';
                        }
                        else{
                            $sets .= $isihead[$i].'= ?, ';
                        }
                    }
                    $tipedt .= 's';
                    $q = $this->sqlEscape($id);
                    array_push($isiparam, $q);
                    if(in_array($table, self::$listTable)){
                        $cek = $this->cekId($q, $table);
                        if($cek === true){
                            $ubah = $mysqli->prepare("UPDATE $table SET $sets WHERE id = ? ");
                            $ubah-> bind_param($tipedt, ...$isiparam);
                            $ubah->execute();
                            if($ubah->affected_rows == 1){
                                return true;
                            }
                            elseif($ubah->affected_rows > 1){
                                return 'lebih dari 1 data yang terubah';
                            }
                            else{
                                return false;
                            }
                        }
                        else{
                            throw new Exception("Error : data tidak ditemukan pada tabel $table !");
                        }
                    }
                    else{
                        throw new Exception('Error : tabel tidak diketahui !');
                    }
                }
                else{
                    throw new Exception('Error : parameter set pada ubah harus berupa array !');
                }
            }
            else{
                throw new Exception('Error : parameter ubah tidak lengkap !');
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
    
    ## mencek data pada database
    public function cekId($id, $table = null, $mysqli = null){
        try{
            $ketemu = false;
            if($mysqli == null && self::$mysqli != null){
                $mysqli = self::$mysqli;
            }
            elseif($mysqli == null && self::$mysqli == null){
                throw new Exception('Error : tidak ada koneksi ke database !');
            }
            
            if($table == null && self::$table != null){
                $table = self::$table;
            }
            if(is_array($table)){
                throw new Exception('Error : tipe parameter table harus berupa string !');
            }
            $isicek = array($id, $table);
            if($this->cekKosong($isicek) === true){
                if(is_array($id) && is_string($table)){
                    $ketemu = array();
                    foreach($id as $i => $v){
                        if(is_int($i)){
                            if(in_array($table, self::$listTable)){
                                $cek = $mysqli->prepare("SELECT id FROM $table WHERE id = ? ");
                                $ids = $this->sqlEscape($v);
                                $cek->bind_param('s', $ids);
                                if($cek->execute()){
                                    $hasil = $cek->get_result();
                                    if($hasil->num_rows > 0){
                                        array_push($ketemu, true);
                                    }
                                    else{
                                        array_push($ketemu, false);
                                    }
                                }
                                else{
                                    throw new Exception('Error : '.$mysqli->error);
                                }
                            }
                            else{
                                throw new Exception('Error : tabel tidak diketahui !');
                            }
                        }
                        else{
                            throw new Exception('Error : parameter id pada cekId harus berupa array tunggal !');
                        }
                    }
                }
                elseif(is_string($id) && is_string($table)){
                    if(in_array($table, self::$listTable)){
                        $id = $this->sqlEscape($id);
                        $cek = $mysqli->prepare("SELECT id FROM $table WHERE id = ? ");
                        $cek->bind_param('s', $id);
                        if($cek->execute()){
                            $hasil = $cek->get_result();
                            if($hasil->num_rows > 0){
                                $ketemu = true;
                            }
                            else{
                                $ketemu = false;
                            }
                        }
                        else{
                            throw new Exception('Error : '.$mysqli->error);
                        }
                    }
                    else{
                        throw new Exception('Error : tabel tidak diketahui !');
                    }
                }
                else{
                    throw new Exception('Error : tipe '.gettype($id).' tidak didukung pada fungsi cekId !');
                }
                return $ketemu;
            }
            else{
                throw new Exception('Error : parameter cekData tidak lengkap !');
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
    
    ## ambil semua data dalam database
    public function ambilSemua($table = null, $mysqli = null){
        if($mysqli == null && self::$mysqli != null){
                $mysqli = self::$mysqli;
            }
            elseif($mysqli == null && self::$mysqli == null){
                throw new Exception('Error : tidak ada koneksi ke database !');
            }
            
            if($table == null && self::$table != null){
                $table = self::$table;
            }
            $isicek = array($table);
            if($this->cekKosong($isicek) === true){
                $hasil = null;
                if(is_array($table)){
                    $hasil = array();
                    foreach($table as $i => $v){
                        $tb = $this->sqlEscape($v);
                        if(in_array($tb, self::$listTable)){
                            $ambil = $mysqli->prepare("SELECT * FROM $tb");
                            $ambil->execute();
                            $hasil[$v] = $ambil->get_result();
                        }
                        else{
                            throw new Exception('Error : tabel tidak diketahui !');
                        }
                    }
                }
                elseif(is_string($table)){
                    $tb = $this->sqlEscape($table);
                    if(in_array($tb, self::$listTable)){
                        $ambil = $mysqli->prepare("SELECT * FROM $tb");
                        $ambil->execute();
                        $hasil = $ambil->get_result();
                    }
                    else{
                        throw new Exception('Error : tabel tidak diketahui !');
                    }
                }
                else{
                    throw new Exeption('Error : tipe table pada fungsi ambilSemua tidak diizinkan !<br> tipe yang dimasukan adalah "'.gettype($table).'", yang dibutuhkan "string" atau "array"');
                }
                return $hasil;
            }
            else{
                throw new Exception('Error : parameter pada fungsi ambil tidak lengkap !');
            }
    }
    
    ## ambil semu data dalam database dan sortir berdasarkan kolom
    ## kolom yang akan digunakan sebagai sortir, jika tidak ada, kolom awal tabel akan digunakan
    public function ambilSemuaSort($table = null, $kolom = null, $ord = 'ASC', $mysqli = null){
        if($mysqli == null && self::$mysqli != null){
                $mysqli = self::$mysqli;
            }
            elseif($mysqli == null && self::$mysqli == null){
                throw new Exception('Error : tidak ada koneksi ke database !');
            }
            
            if($table == null && self::$table != null){
                $table = self::$table;
            }
            $isicek = array($table);
            if($this->cekKosong($isicek) === true){
                $hasil = null;
                $kl = null;
                $this->cekKolom($table);
                if(!empty($kolom)){
                    if(in_array($kolom, self::$listColumn)){
                        $kl = $kolom;
                    }
                }
                else{
                    $kl = self::$listColumn[0];
                }
                if(is_array($table)){
                    $hasil = array();
                    foreach($table as $i => $v){
                        $tb = $this->sqlEscape($v);
                        if(in_array($tb, self::$listTable)){
                            $ambil = $mysqli->prepare("SELECT * FROM $tb ORDER BY $kl $ord");
                            $ambil->execute();
                            $hasil[$v] = $ambil->get_result();
                        }
                        else{
                            throw new Exception('Error : tabel tidak diketahui !');
                        }
                    }
                }
                elseif(is_string($table)){
                    $tb = $this->sqlEscape($table);
                    if(in_array($tb, self::$listTable)){
                        $ambil = $mysqli->prepare("SELECT * FROM $tb ORDER BY $kl $ord");
                        $ambil->execute();
                        $hasil = $ambil->get_result();
                    }
                    else{
                        throw new Exception('Error : tabel tidak diketahui !');
                    }
                }
                else{
                    throw new Exeption('Error : tipe table pada fungsi ambilSemua tidak diizinkan !<br> tipe yang dimasukan adalah "'.gettype($table).'", yang dibutuhkan "string" atau "array"');
                }
                return $hasil;
            }
            else{
                throw new Exception('Error : parameter pada fungsi ambil tidak lengkap !');
            }
    }
    
    # ambil sebagian pada 1 tabel
    ## pilihan = array('kolom', 'kolom1');
    ## pilihan = 'kolom';
    ## table = 'table';
    public function ambil($pilihan, $table = null, $mysqli = null){
        try{
            if($mysqli == null && self::$mysqli != null){
                $mysqli = self::$mysqli;
            }
            elseif($mysqli == null && self::$mysqli == null){
                throw new Exception('Error : tidak ada koneksi ke database !');
            }
            if($table == null && self::$table != null){
                $table = self::$table;
            }
            elseif($table == null && self::$table == null){
                throw new Exception('Error : tidak ada tabel yang dipilih !');
            }
            elseif(!is_string($table)){
                throw new Exception('Error : tipe parameter tabel harus string !');
            }
            
            $isicek = array($pilihan, $table);
            if($this->cekKosong($isicek) === true){
                if(in_array($table, self::$listTable)){
                    $this->cekKolom($table);
                    if(is_array($pilihan)){
                        $pilih = '';
                        $x = 0;
                        $a = count($pilihan) - 1;
                        foreach($pilihan as $i => $v){
                            if(is_string($i)){
                                throw new Exception('Error : parameter pilihan harus berupa array tunggal tanpa key !');
                            }
                            else{
                                if(in_array($v, self::$listColumn)){
                                    if($x === $a){
                                        $pilih .= $this->sqlEscape($v);
                                    }
                                    else{
                                        $pilih .= $this->sqlEscape($v). ', ';
                                    }
                                    $x++;
                                }
                                else{
                                    throw new Exception("Error : kolom '$v' tidak ada pada tabel '$table' !");
                                }
                            }
                        }
                        if(!empty($pilih)){
                            $ambil = $mysqli->prepare("SELECT $pilih FROM $table");
                            $ambil->execute();
                            return $ambil->get_result();
                        }
                    }
                    elseif(is_string($pilihan)){
                        if(in_array($pilihan, self::$listColumn)){
                            $pilih = $this->sqlEscape($pilihan);
                            $ambil = $mysqli->prepare("SELECT $pilih FROM $table");
                            $ambil->execute();
                            return $ambil->get_result();
                        }
                        else{
                            throw new Exception("Error : parameter pilihan '$pilihan' tidak ada dalam tabel '$table' !");
                        }
                    }
                    else{
                        throw new Exception('Error : tipe "'.gettype($pilihan).'" pada parameter pilihan tidak diizinkan !<br>tipe yang diizinkan untuk parameter pilihan : array, string ');
                    }
                }
                else{
                    throw new Exception("Error : tabel '$table' tidak diketahui !");
                }
            }
            else{
                throw new Exception('Error : masih ada yang kosong pada fungsi ambil !');
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

    # ambil sebagian pada 1 tabel dan urutkan
    ## pilihan = array('kolom', 'kolom1');
    ## pilihan = 'kolom';
    ## table = 'table';
    ## rp = 'kolom'; kolom yang akan diurutkan
    ## order = true = ASC || false = DESC;
    public function ambilOrder($pilihan, $table, $kolom, $order = true, $mysqli = null){
        try{
            if($mysqli == null && self::$mysqli != null){
                $mysqli = self::$mysqli;
            }
            elseif($mysqli == null && self::$mysqli == null){
                throw new Exception('Error : tidak ada koneksi ke database !');
            }
            if($table == null && self::$table != null){
                $table = self::$table;
            }
            elseif($table == null && self::$table == null){
                throw new Exception('Error : tidak ada tabel yang dipilih !');
            }
            elseif(!is_string($table)){
                throw new Exception('Error : tipe parameter tabel harus string !');
            }
            
            $isicek = array($pilihan, $table, $pilihan);
            
            if($this->cekKosong($isicek) === true){
                if(in_array($table, self::$listTable)){
                    $this->cekKolom($table);
                    if(is_array($pilihan)){
                        $pilih = '';
                        $x = 0;
                        $a = count($pilihan) - 1;
                        foreach($pilihan as $i => $v){
                            if(is_string($i)){
                                throw new Exception('Error : parameter pilihan harus berupa array tunggal tanpa key !');
                            }
                            else{
                                if(in_array($v, self::$listColumn)){
                                    if($x === $a){
                                        $pilih .= $this->sqlEscape($v);
                                    }
                                    else{
                                        $pilih .= $this->sqlEscape($v). ', ';
                                    }
                                    $x++;
                                }
                                else{
                                    throw new Exception("Error : kolom '$v' tidak ada pada tabel '$table' !");
                                }
                            }
                        }
                        if(!empty($pilih)){
                            if($order){
                                $orde = 'ASC';
                            }
                            else{
                                $orde = 'DESC';
                            }
                            $ambil = $mysqli->prepare("SELECT $pilih FROM $table ORDER BY $kolom $orde");
                            if($ambil->execute()){
                                return $ambil->get_result();
                            }
                            else{
                                return $mysqli->error;
                            }
                        }
                    }
                    elseif(is_string($pilihan)){
                        if(in_array($pilihan, self::$listColumn)){
                            if($order){
                                $orde = 'ASC';
                            }
                            else{
                                $orde = 'DESC';
                            }
                            $pilih = $this->sqlEscape($pilihan);
                            $ambil = $mysqli->prepare("SELECT $pilih FROM $table ORDER BY $kolom $orde");
                            if($ambil->execute()){
                                return $ambil->get_result();
                            }
                            else{
                                return $mysqli->error;
                            }
                        }
                        else{
                            throw new Exception("Error : parameter pilihan '$pilihan' tidak ada dalam tabel '$table' !");
                        }
                    }
                    else{
                        throw new Exception('Error : tipe "'.gettype($pilihan).'" pada parameter pilihan tidak diizinkan !<br>tipe yang diizinkan untuk parameter pilihan : array, string ');
                    }
                }
                else{
                    throw new Exception("Error : tabel '$table' tidak diketahui !");
                }
            }
            else{
                throw new Exception('Error : masih ada yang kosong pada fungsi ambil !');
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
    
    ## ambil semua data dengan kondisi dalam database
    ## jumlah logic harus sama dengan jumlah where - 1
    ## atau logic berupa string
    ## $where = array('kolom'=>'operator', 'kolom1'=>'operator1');
    ## $whereval = array('tipe_data.value_kolom', 'tipe_data.value_kolom1');
    ## $logic = array('AND');
    ## $logic = 'AND';
    ## $logic = null;
    ## $table = 'table';
    public function ambilKondisi($where = null, $whereval = null, $logic = null, $table = null, $mysqli = null){
        try{
            if($mysqli == null && self::$mysqli != null){
                $mysqli = self::$mysqli;
            }
            elseif($mysqli == null && self::$mysqli == null){
                throw new Exception('Error : tidak ada koneksi ke database !');
            }
            if($table == null && self::$table != null){
                $table = self::$table;
            }
            elseif($table == null && self::$table == null){
                throw new Exception('Error : tidak ada table yang dipilih !');
            }
            
            if(is_array($table)){
                throw new Exception("Error : tipe tabel harus berupa string !");
            }
            $isicek = array($where, $whereval, $table);
            if($this->cekKosong($isicek) === true){
                if(is_array($where) && is_array($whereval)){ 
                    #  || (is_object($where) && is_object($whereval) && is_object($logic))
                    $jumwhere = sizeof($where);
                    if(is_string($logic) && $jumwhere > 0){
                        $islog = strtoupper($logic);
                        $logic = array_fill(0, ($jumwhere-1), $islog);
                    }
                    if(is_array($logic)){
                        $jumlogic = sizeof($logic);
                    }
                    else{
                        $jumlogic = 0;
                    }
                    $jumval   = sizeof($whereval);
                    $kurang = $jumwhere -1;
                    if($jumwhere == $jumval && $jumlogic == $kurang ){
                        $benar = false;
                        if($jumlogic > 0 && $jumwhere > 1){
                            $x = 0;
                            # pengecekan $logic
                            $logika = array();
                            foreach($logic as $i => $v){
                                if(is_string($i)){
                                    $benar = false;
                                    throw new Exception('Error : tipe key tidak boleh string pada parameter logic !');
                                }
                                else{
                                    $a = strtoupper($v);
                                    if(in_array($a, self::$logicmysqli)){
                                        array_push($logika, $this->sqlEscape($a));
                                    }
                                    else{
                                        $benar = false;
                                        throw new Exception('Error : value pada parameter logic tidak diizinkan !');
                                    }
                                }
                            }
                        }
                        
                        if(is_string($table)){
                            $a = $this->sqlEscape($table);
                            $this->cekKolom($a);
                            foreach($where as $iw => $vw){
                                if(!in_array($iw, self::$listColumn)){
                                    throw new Exception("Error : kolom '$iw' tidak ada pada tabel '$a' !");
                                }
                            }
                        }
                        $wherequery = '';
                        if($jumlogic > 0 && $jumwhere > 1){
                            $jumlogika = count($logika);
                            # pengecekan dan penggabungan $where menjadi string
                            foreach($where as $i => $v){
                                if((int)$i > 0){
                                    $benar = false;
                                    throw new Exception('Error : key pada parameter where tidak boleh ada angka !');
                                }
                                else{
                                    if(in_array($v, self::$simbolmysqli)){
                                        $benar = true;
                                        if($x == $jumlogika){    
                                            $wherequery .= $i.' '.$v.' ? ';
                                        }
                                        else{
                                            $wherequery .= $i.' '.$v.' ? '.$logika[$x].' ';
                                        }
                                        $x++;
                                    }
                                    else{
                                        $benar = false;
                                        throw new Exception('Error : value pada parameter where tidak diizinkan !');
                                    }
                                }
                            }
                        }
                        else{
                            foreach($where as $i => $v){
                                if((int)$i > 0){
                                    $benar = false;
                                    throw new Exception('Error : key pada parameter where tidak boleh ada angka !');
                                }
                                else{
                                    if(in_array($v, self::$simbolmysqli)){
                                        $benar = true;
                                        $wherequery .= $i.' '.$v.' ? ';
                                    }
                                    else{
                                        $benar = false;
                                        throw new Exception('Error : value pada parameter where tidak diizinkan !');
                                    }
                                }
                            }
                        }
                        $isiparam = array();
                        $tipedt = '';
                        # pengecekan isi dari $whereval
                        foreach($whereval as $i => $v){
                            if(is_string($i)){
                                $benar = false;
                                throw new Exception('Error : tipe key tidak boleh string !');
                            }
                            else{
                                $benar = true;
                                $tp = strpos($v, '.');
                                if($tp == 1){
                                    $dt = substr($v, 0, 1);
                                    switch(strtolower($dt)){
                                        case 'i':
                                            $tipedt .= 'i';
                                            $nl = substr($v, $tp+1);
                                            $l = $this->sqlEscape($nl);
                                            array_push($isiparam, $l);
                                            break;
                                        case 's':
                                            $tipedt .= 's';
                                            $nl = substr($v, $tp+1);
                                            $l = $this->sqlEscape($nl);
                                            array_push($isiparam, $l);
                                            break;
                                        case 'd':
                                            $tipedt = 'd';
                                            $nl = substr($v, $tp+1);
                                            $l = $this->sqlEscape($nl);
                                            array_push($isiparam, $l);
                                            break;
                                        default:
                                            $benar = false;
                                            throw new Exception('Error : key pada parameter whereval tidak diizinkan !<br>yang diizinkan hanya "i", "s", "d"');
                                    }
                                }
                                else{
                                    $benar = false;
                                    throw new Exception('Error : value pada parameter whereval harus tipeData.data !');
                                }
                            }
                        }
                        
                        # proses pengambilan data
                        if($benar === true){
                            if(is_string($table)){
                                $tb = $this->sqlEscape($table);
                                if(in_array($tb, self::$listTable)){
                                    $ambil = $mysqli->prepare("SELECT * FROM $tb WHERE $wherequery ");
                                    $ambil->bind_param($tipedt, ...$isiparam);
                                    $ambil->execute();
                                    $hasil = $ambil->get_result();
                                    $where = null;
                                    $whereval = null;
                                    $logic = null;
                                    $table = null;
                                    return $hasil;
                                }
                                else{
                                    throw new Exception('Error : tabel tidak diketahui !');
                                }
                            }
                            else{
                                throw new Exception('Error : tipe '.gettype($table).' tidak diizinkan untuk parameter table !');
                            }
                            
                        }
                        else{
                            throw new Exception('Error : masih ada yang salah pada fungsi ambilKondisi !');
                        }
                        
                    }
                    else{
                        throw new Exception('Error : jumlah parameter "where" & "whereval" & "logic" tidak sesuai !');
                    }
                }
                else{
                    throw new Exception('Error : tipe "'.gettype($where).'" & "'.gettype($whereval).'" & "'.gettype($logic).'" tidak didukung pada ambilKondisi !</br> tipe yang didukung adalah "array" & "array" & "array"');
                }
            }
            else{
                throw new Exception('Error : parameter ambilKondisi tidak lengkap !');
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

    public function ambilKondisiOrder($where = null, $whereval = null, $logic = null, $table = null, $kolom = null, $order=true, $mysqli = null){
        try{
            if($mysqli == null && self::$mysqli != null){
                $mysqli = self::$mysqli;
            }
            elseif($mysqli == null && self::$mysqli == null){
                throw new Exception('Error : tidak ada koneksi ke database !');
            }
            if($table == null && self::$table != null){
                $table = self::$table;
            }
            elseif($table == null && self::$table == null){
                throw new Exception('Error : tidak ada table yang dipilih !');
            }
            
            if(is_array($table)){
                throw new Exception("Error : tipe tabel harus berupa string !");
            }
            $isicek = array($where, $whereval, $table, $kolom);
            if($this->cekKosong($isicek) === true){
                if(is_array($where) && is_array($whereval)){ 
                    #  || (is_object($where) && is_object($whereval) && is_object($logic))
                    $jumwhere = sizeof($where);
                    if(is_string($logic) && $jumwhere > 0){
                        $islog = strtoupper($logic);
                        $logic = array_fill(0, ($jumwhere-1), $islog);
                    }
                    if(is_array($logic)){
                        $jumlogic = sizeof($logic);
                    }
                    else{
                        $jumlogic = 0;
                    }
                    $jumval   = sizeof($whereval);
                    $kurang = $jumwhere -1;
                    if($jumwhere == $jumval && $jumlogic == $kurang ){
                        $benar = false;
                        if($jumlogic > 0 && $jumwhere > 1){
                            $x = 0;
                            # pengecekan $logic
                            $logika = array();
                            foreach($logic as $i => $v){
                                if(is_string($i)){
                                    $benar = false;
                                    throw new Exception('Error : tipe key tidak boleh string pada parameter logic !');
                                }
                                else{
                                    $a = strtoupper($v);
                                    if(in_array($a, self::$logicmysqli)){
                                        array_push($logika, $this->sqlEscape($a));
                                    }
                                    else{
                                        $benar = false;
                                        throw new Exception('Error : value pada parameter logic tidak diizinkan !');
                                    }
                                }
                            }
                        }
                        
                        if(is_string($table)){
                            $a = $this->sqlEscape($table);
                            $this->cekKolom($a);
                            foreach($where as $iw => $vw){
                                if(!in_array($iw, self::$listColumn)){
                                    throw new Exception("Error : kolom '$iw' tidak ada pada tabel '$a' !");
                                }
                            }
                        }
                        $wherequery = '';
                        if($jumlogic > 0 && $jumwhere > 1){
                            $jumlogika = count($logika);
                            # pengecekan dan penggabungan $where menjadi string
                            foreach($where as $i => $v){
                                if((int)$i > 0){
                                    $benar = false;
                                    throw new Exception('Error : key pada parameter where tidak boleh ada angka !');
                                }
                                else{
                                    if(in_array($v, self::$simbolmysqli)){
                                        $benar = true;
                                        if($x == $jumlogika){    
                                            $wherequery .= $i.' '.$v.' ? ';
                                        }
                                        else{
                                            $wherequery .= $i.' '.$v.' ? '.$logika[$x].' ';
                                        }
                                        $x++;
                                    }
                                    else{
                                        $benar = false;
                                        throw new Exception('Error : value pada parameter where tidak diizinkan !');
                                    }
                                }
                            }
                        }
                        else{
                            foreach($where as $i => $v){
                                if((int)$i > 0){
                                    $benar = false;
                                    throw new Exception('Error : key pada parameter where tidak boleh ada angka !');
                                }
                                else{
                                    if(in_array($v, self::$simbolmysqli)){
                                        $benar = true;
                                        $wherequery .= $i.' '.$v.' ? ';
                                    }
                                    else{
                                        $benar = false;
                                        throw new Exception('Error : value pada parameter where tidak diizinkan !');
                                    }
                                }
                            }
                        }
                        $isiparam = array();
                        $tipedt = '';
                        # pengecekan isi dari $whereval
                        foreach($whereval as $i => $v){
                            if(is_string($i)){
                                $benar = false;
                                throw new Exception('Error : tipe key tidak boleh string !');
                            }
                            else{
                                $benar = true;
                                $tp = strpos($v, '.');
                                if($tp == 1){
                                    $dt = substr($v, 0, 1);
                                    switch(strtolower($dt)){
                                        case 'i':
                                            $tipedt .= 'i';
                                            $nl = substr($v, $tp+1);
                                            $l = $this->sqlEscape($nl);
                                            array_push($isiparam, $l);
                                            break;
                                        case 's':
                                            $tipedt .= 's';
                                            $nl = substr($v, $tp+1);
                                            $l = $this->sqlEscape($nl);
                                            array_push($isiparam, $l);
                                            break;
                                        case 'd':
                                            $tipedt = 'd';
                                            $nl = substr($v, $tp+1);
                                            $l = $this->sqlEscape($nl);
                                            array_push($isiparam, $l);
                                            break;
                                        default:
                                            $benar = false;
                                            throw new Exception('Error : key pada parameter whereval tidak diizinkan !<br>yang diizinkan hanya "i", "s", "d"');
                                    }
                                }
                                else{
                                    $benar = false;
                                    throw new Exception('Error : value pada parameter whereval harus tipeData.data !');
                                }
                            }
                        }
                        
                        # proses pengambilan data
                        if($benar === true){
                            if(is_string($table)){
                                $tb = $this->sqlEscape($table);
                                if(in_array($tb, self::$listTable)){
                                    if($order){
                                        $perintah = "SELECT * FROM $tb WHERE $wherequery ORDER BY $kolom ASC ";
                                    }
                                    else{
                                        $perintah = "SELECT * FROM $tb WHERE $wherequery ORDER BY $kolom DESC ";
                                    }
                                    $ambil = $mysqli->prepare($perintah);
                                    $ambil->bind_param($tipedt, ...$isiparam);
                                    $ambil->execute();
                                    $hasil = $ambil->get_result();
                                    $where = null;
                                    $whereval = null;
                                    $logic = null;
                                    $table = null;
                                    return $hasil;
                                }
                                else{
                                    throw new Exception('Error : tabel tidak diketahui !');
                                }
                            }
                            else{
                                throw new Exception('Error : tipe '.gettype($table).' tidak diizinkan untuk parameter table !');
                            }
                            
                        }
                        else{
                            throw new Exception('Error : masih ada yang salah pada fungsi ambilKondisiOrder !');
                        }
                        
                    }
                    else{
                        throw new Exception('Error : jumlah parameter "where" & "whereval" & "logic" tidak sesuai !');
                    }
                }
                else{
                    throw new Exception('Error : tipe "'.gettype($where).'" & "'.gettype($whereval).'" & "'.gettype($logic).'" tidak didukung pada ambilKondisiOrder !</br> tipe yang didukung adalah "array" & "array" & "array"');
                }
            }
            else{
                throw new Exception('Error : parameter ambilKondisiOrder tidak lengkap !');
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
    
    ## ambil beberapa dari database
    ## $pilihan = array('kolom', 'kolom1');
    ## $logic = null
    public function ambilBeberapa($pilihan, $where = null, $whereval = null, $logic = null, $table = null, $mysqli = null){
        try{
            if($mysqli == null && self::$mysqli != null){
                $mysqli = self::$mysqli;
            }
            elseif($mysqli == null && self::$mysqli == null){
                throw new Exception('Error : tidak ada koneksi ke database !');
            }
            if($table == null && self::$table != null){
                $table = self::$table;
            }
            if(is_string($table) && !empty($table) && !in_array($table, self::$listTable)){
                throw new Exception("Error : tabel '$table' tidak diketahui !");
            }
            if(count($where) == 1 && empty($logic)){
                $isicek = array($where, $whereval, $table);
            }
            else{
                $isicek = array($pilihan, $where, $whereval, $table);
            }
            if($this->cekKosong($isicek) === true){
                if(is_array($where) && is_array($whereval)){ #  || (is_object($where) && is_object($whereval) && is_object($logic))
                    $jumwhere = count($where);
                    if(is_string($logic) && !empty($logic)){
                        $logic = array_fill(0, ($jumwhere-1), $logic);
                        $jumlogic = count($logic);
                    }
                    else{
                        $jumlogic = 0;
                    }
                    $jumval   = count($whereval);
                    if($jumwhere == $jumval && ($jumwhere - 1) == $jumlogic){
                        $benar = false;
                        $x = 0;
                        # pengecekan $logic
                        if($jumlogic > 0 && $jumwhere > 1){
                            $logika = array();
                            foreach($logic as $i => $v){
                                if(is_string($i)){
                                    $benar = false;
                                    throw new Exception('Error : tipe key tidak boleh berupa string pada parameter logic !');
                                }
                                else{
                                    $a = strtoupper(trim($v));
                                    if(in_array($a, self::$logicmysqli)){
                                        $w = $this->sqlEscape($a);
                                        array_push($logika, $w);
                                    }
                                    else{
                                        $benar = false;
                                        throw new Exception('Error : value pada parameter logic tidak diizinkan !');
                                    }
                                }
                            }
                        }
                        
                        if(is_array($table)){
                            foreach($table as $i => $v){
                                if(is_string($i)){
                                    throw new Exception("Error : parameter tabel harus array tunggal !");
                                }
                                else{
                                    $a = $this->sqlEscape($v);
                                    $this->cekKolom($a);
                                    foreach($where as $iw => $vw){
                                        if(!in_array($iw, self::$listColumn)){
                                            throw new Exception("Error : kolom '$iw' tidak ada pada tabel '$a' !");
                                        }
                                    }
                                }
                            }
                        }
                        elseif(is_string($table)){
                            $a = $this->sqlEscape($table);
                            $this->cekKolom($a);
                            foreach($where as $iw => $vw){
                                if(!in_array($iw, self::$listColumn)){
                                    throw new Exception("Error : kolom '$iw' tidak ada pada tabel '$a' !");
                                }
                            }
                        }
                        $wherequery = '';
                        if($jumlogic > 0 && $jumwhere > 1){
                            $jumlogika = count($logika);
                            # pengecekan dan penggabungan $where menjadi string
                            foreach($where as $i => $v){
                                if((int)$i > 0){
                                    $benar = false;
                                    throw new Exception('Error : key pada parameter where tidak boleh ada angka !');
                                }
                                else{
                                    if(in_array($v, self::$simbolmysqli)){
                                        $benar = true;
                                        if($x == $jumlogika){    
                                            $wherequery .= $i.' '.$v.' ? ';
                                        }
                                        else{
                                            $wherequery .= $i.' '.$v.' ? '.$logika[$x].' ';
                                        }
                                        $x++;
                                    }
                                    else{
                                        $benar = false;
                                        throw new Exception('Error : value pada parameter where tidak diizinkan !');
                                    }
                                }
                            }
                        }
                        else{
                            # pengecekan dan penggabungan $where menjadi string
                            foreach($where as $i => $v){
                                if((int)$i > 0){
                                    $benar = false;
                                    throw new Exception('Error : key pada parameter where tidak boleh ada angka !');
                                }
                                else{
                                    if(in_array($v, self::$simbolmysqli)){
                                        $benar = true;
                                        $wherequery .= $i.' '.$v.' ? ';
                                    }
                                    else{
                                        $benar = false;
                                        throw new Exception('Error : value pada parameter where tidak diizinkan !');
                                    }
                                }
                            }
                        }
                        $isiparam = array();
                        $tipedt = '';
                        # pengecekan isi dari $whereval
                        foreach($whereval as $i => $v){
                            if(is_string($i)){
                                $benar = false;
                                throw new Exception('Error : tipe key tidak boleh string !');
                            }
                            else{
                                $benar = true;
                                $tp = strpos($v, '.');
                                if($tp == 1){
                                    $dt = substr($v, 0, 1);
                                    switch(strtolower($dt)){
                                        case 'i':
                                            $tipedt .= 'i';
                                            $nl = substr($v, $tp+1);
                                            $l = $this->sqlEscape($nl);
                                            array_push($isiparam, $l);
                                            break;
                                        case 's':
                                            $tipedt .= 's';
                                            $nl = substr($v, $tp+1);
                                            $l = $this->sqlEscape($nl);
                                            array_push($isiparam, $l);
                                            break;
                                        case 'd':
                                            $tipedt = 'd';
                                            $nl = substr($v, $tp+1);
                                            $l = $this->sqlEscape($nl);
                                            array_push($isiparam, $l);
                                            break;
                                        default:
                                            throw new Exception('Error : key pada parameter whereval tidak diizinkan !<br>yang diizinkan hanya "i", "s", "d"');
                                    }
                                }
                                else{
                                    throw new Exception('Error : value pada parameter whereval harus tipeData.data !');
                                }
                            }
                        }
                        $pilih = '';
                        $x = 0;
                        # pengecekan $pilihan
                        if(is_array($pilihan)){
                            $p = array_values($pilihan);
                            foreach($p as $i => $v){
                                if(!in_array($v, self::$listColumn)){
                                    throw new Exception("Kolom $v tidak ada pada tabel $table !");
                                }
                            }
                            $pilih = implode(', ', $p);
                        }
                        elseif(is_string($pilihan)){
                            if(!in_array($pilihan, self::$listColumn)){
                                throw new Exception("Kolom $v tidak ada pada tabel $table !");
                            }
                            $pilih = $this->sqlEscape($pilihan);
                        }
                        else{
                            throw new Exception('Error : tipe '.gettype($pilihan).' tidak diizinkan untuk parameter pilihan !');
                        }
                        
                        # proses pengambilan data
                        if($benar === true){
                            if(is_string($table)){
                                $tb = $this->sqlEscape($table);
                                if(in_array($tb, self::$listTable)){
                                    $ambil = $mysqli->prepare("SELECT $pilih FROM $tb WHERE $wherequery ");
                                    $ambil->bind_param($tipedt, ...$isiparam);
                                    $ambil->execute();
                                    $hasil = $ambil->get_result();
                                    return $hasil;
                                }
                                else{
                                    throw new Exception('Error : tabel tidak diketahui !');
                                }
                            }
                            else{
                                throw new Exception('Error : tipe '.gettype($pilihan).' tidak diizinkan untuk parameter table !');
                            }
                            
                        }
                        else{
                            throw new Exception('Error : masih ada yang salah pada fungsi ambilBeberapa !');
                        }
                    }
                    else{
                        throw new Exception('Error : jumlah parameter "where" & "whereval" & "logic" tidak sesuai !');
                    }
                }
                else{
                    throw new Exception('Error : tipe "'.gettype($pilihan).'" & "'.gettype($where).'" & "'.gettype($whereval).'" & "'.gettype($logic).'" tidak didukung pada ambilBeberapa !</br> tipe yang didukung adalah "array" & "array" & "array" & "array"');
                }
            }
            else{
                throw new Exception('Error : parameter ambilBeberapa tidak lengkap !');
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

    ## ambil satu data dari database
    ## $id = array('id', 'id1');
    ## $id = 'id';
    ## $table = array('table', 'table1');
    ## $table = 'table';
    public function ambilSatuId($id, $table = null, $mysqli = null){
        try{
            if($mysqli == null && self::$mysqli != null){
                $mysqli = self::$mysqli;
            }
            elseif($mysqli == null && self::$mysqli == null){
                throw new Exception('Error : tidak ada koneksi ke database !');
            }
            if($table == null && self::$table != null){
                $table = self::$table;
            }
            
            $isicek = array($id, $table);
            if($this->cekKosong($isicek) === true){
                $hasil = null;
                if(is_array($table) && is_array($id)){
                    if(count($table) === count($id)){
                        $hasil = array();
                        $t = array();
                        foreach($table as $i => $v){
                            $a = $this->sqlEscape($v);
                            if(in_array($a, self::$listTable)){
                                array_push($t, $a);
                            }
                            else{
                                throw new Exception('Error : tabel tidak diketahui ! ');
                            }
                        }
                        
                        $d = array();
                        foreach($id as $i => $v){
                            $b = $this->sqlEscape($v);
                            array_push($d, $b);
                        }
                        for($e = 0; $e < count($t); $e++){
                            $p = $this->sqlEscape($t[$e]);
                            if(in_array($p, self::$listTable)){
                                $x = $this->sqlEscape($d[$e]);
                                $ambil = $mysqli->prepare("SELECT * FROM $t[$e] WHERE id = ? ");
                                $ambil->bind_param('s', $x);
                                $ambil->execute();
                                $hasil[$t[$e]] = $ambil->get_result();
                            }
                            else{
                                throw new Exception('Error : tabel tidak diketahui ! ');
                            }
                        }
                        return $hasil;
                    }
                    else{
                        throw new Exception('Error : jumlah parameter table tidak sama dengan jumlah parameter id !');
                    }
                }
                elseif(is_string($table) && is_string($id)){
                    $table = $this->sqlEscape($table);
                    if(in_array($table, self::$listTable)){
                        $id = $this->sqlEscape($id);
                        $ambil = $mysqli->prepare("SELECT * FROM $table WHERE id = ? ");
                        $ambil->bind_param('s', $id);
                        $ambil->execute();
                        $hasil = $ambil->get_result();
                        return $hasil;
                    }
                    else{
                        throw new Exception('Error : tabel tidak diketahui !');
                    }
                }
                elseif(is_string($table) && is_array($id)){
                    $t = $this->sqlEscape($table);
                    if(in_array($t, self::$listTable)){
                        $hasil = array();
                        foreach($id as $i => $v){
                            if(is_string($i)){
                                throw new Exception("Error : parameter id hanya boleh berupa array tunggal tanpa key !");
                            }
                            else{
                                $a = $this->sqlEscape($v);
                                $ambil = $mysqli->prepare("SELECT * FROM $table WHERE id = ? ");
                                $ambil->bind_param('s', $a);
                                $ambil->execute();
                                $hasil[] = $ambil->get_result();
                            }
                        }
                        return $hasil;
                    }
                    else{
                        throw new Exception('Error : tabel tidak diketahui !');
                    }
                }
                else{
                    throw new Exception('Error : tipe parameter table tidak diizinkan array jika parameter id adalah string pada fungsi ambilSatuId !');
                }
            }
            else{
                throw new Exception('Error : parameter ambilSatuId tidak lengkap !');
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

    ## merubah blob menjadi string dengan tambahan base64_encode
    protected function encodeBlob($data){
        return base64_encode($data);
    }
    
    ## cek data yang kosong
    protected function cekKosong($data){
        $berisi = false;
        if(is_array($data) || is_object($data)){
            $isicek = array();
            foreach($data as $index => $isi){
                if(!empty($isi)){
                    array_push($isicek, true);
                }
                else{
                    array_push($isicek, false);
                }
            }
            if(in_array(false, $isicek)){
                $berisi = false;
            }
            else{
                $berisi = true;
            }
        }
        else{
            if(!empty(trim($data))){
                $berisi = true;
            }
            else{
                $berisi = false;
            }
        }
        return $berisi;
    }
    
    ## menghilangkan simbol menggunakan mysqli_real_escape_string
    protected function sqlEscape($text, $mysqli = null){
        if($mysqli == null && self::$mysqli != null){
            $mysqli = self::$mysqli;
        }
        elseif($mysqli == null && self::$mysqli == null){
            return false;
        }
        
        if($mysqli != null){
            if(is_array($text)){
                $isi = array();
                foreach($text as $i => $v){
                    $p = $mysqli->real_escape_string(stripslashes(htmlspecialchars(trim($v))));
                }
                return $isi;
            }
            else{
                return $mysqli->real_escape_string(stripslashes(htmlspecialchars(trim($text))));
            }
        }
        else{
            return false;
        }
    }
    
    ## mengambil tabel pada database
    protected function simpanTable($mysqli){
        if($mysqli != null){
            $ambil = $mysqli->query("SHOW TABLES");
            while($hasil = $ambil->fetch_array()){
                self::$listTable[] = $hasil[0];
            }
        }
    }
    
    ## mengambil kolom pada tabel
    protected function cekKolom($table){
        if(is_string($table) && !empty(self::$mysqli)){
            self::$listColumn = array();
            $ambil = self::$mysqli->query("SHOW COLUMNS FROM `$table`");
            while($hasil = $ambil->fetch_array()){
                self::$listColumn[] = $hasil[0];
            }
        }
    }
    
    ## menghitung jumlah data pada tabel yang dimasukan
    # $table = array('nama_table1', 'nama_table2');
    # $table = 'nama_table';
    public function jumlahData($table, $mysqli = null){
        try{
            if($mysqli == null && self::$mysqli != null){
                $mysqli = self::$mysqli;
            }
            elseif($mysqli == null && self::$mysqli == null){
                throw new Exception('Error : tidak ada koneksi ke database !');
            }
            if($table == null && self::$table != null){
                $table = self::$table;
            }

            $isicek = array($table);
            if($this->cekKosong($isicek) === true){
                $hasil = null;
                if(is_array($table)){
                    $hasil = array();
                    foreach($table AS $k => $v){
                        if(is_int($k)){
                            $a = $this->sqlEscape($v);
                            if(in_array($a, self::$listTable)){
                                $ambil = $mysqli->prepare("SELECT COUNT(*) AS jum FROM $a");
                                $ambil->execute();
                                $isi = $ambil->get_result();
                                $j = $isi->fetch_assoc();
                                $hasil[$k] = $j['jum'];
                            }
                            else{
                                throw new Exception('Error : tabel tidak diketahui ! ');
                            }
                        }
                        else{
                            throw new Exception('Error : array tabel harus berupa array(\'table\') ! ');
                        }
                    }
                    return $hasil;
                }
                elseif(is_string($table)){
                    $a = $this->sqlEscape($table);
                    $ambil = $mysqli->prepare("SELECT COUNT(*) AS jum FROM $a");
                    $ambil->execute();
                    $isi = $ambil->get_result();
                    $j = $isi->fetch_assoc();
                    return $j['jum'];
                }
                else{
                    throw new Exception('Error : tipe table tidak diizinkan pada fungsi jumlahData !');
                }
            }
            else{
                throw new Exception('Error : parameter jumlahData tidak lengkap !');
            }
        }
        catch(Exception $ex){

        }
    }

    public function semuaKolom($table){
        $this->cekKolom($table);
        return self::$listColumn;
    }

    public function semuaTable($mysqli){
        $table = array();
        if($mysqli != null){
            $ambil = $mysqli->query("SHOW TABLES");
            while($hasil = $ambil->fetch_array()){
                $table[] = $hasil[0];
            }
        }
        return $table;
    }
    
    ## hapus semua simbol yang ada pada text
    public function hapusSemuaSimbol($text){
        $text = strtr($text, self::$simbol);
        return $text;
    }

    ## perintah yang ingin di buat sendiri
    public function query($text = null, $mysqli = null){
        try{
            if($this->cekKosong($text) === true){
                if($mysqli == null && self::$mysqli != null){
                    $mysqli = self::$mysqli;
                }
                elseif($mysqli == null && self::$mysqli == null){
                    throw new Exception('Error : tidak ada koneksi ke database !');
                }
                $text = $this->sqlEscape($text);
                return $mysqli->query($text);
            }
            else{
                throw new Exception('Error : parameter query tidak lengkap !');
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
    
    public static function randomId(): string {
        $id = '';
        $a = range('a', 'z');
        $b = range('A', 'Z');
        $c = range(0, 9);
        $d = strlen(microtime(true));
        for($e = 0; $e < $d; $e++){
            $id .= $a[rand(0, sizeof($a)- 1)];
            $id .= $b[rand(0, sizeof($b)- 1)];
            $id .= $c[rand(0, sizeof($c)- 1)];
        }
        return $id;
    }
}