<?php
# Version 1.3.0
error_reporting(E_ALL);
date_default_timezone_set('Asia/Makassar');

$httphost   = $_SERVER['HTTP_HOST'];
$baseurl    = null;
$protocol = isset($_SERVER["HTTPS"]) ? 'https' : 'http';
define('PROTOCOLS', $protocol);
if(is_file('pengaturan.php')){
    include_once 'pengaturan.php';
}

if(is_file('keamanan.php')){
    include_once 'keamanan.php';
}

if($httphost === 'localhost'){
    $rootfolder = $_PENGATURAN['ROOR_DIR'];
    define('BASEDIR', $rootfolder);
    $baseurl = $protocol.'://localhost/'.$rootfolder.'/';
}
else{
    $baseurl = $protocol.'://'.$httphost.'/';
}

include_once 'assets/php/functions/checking.php';

define('BASEURL', $baseurl);
define('FRAME_VERSION', '130');
define('FRAME_NEXT_VERSION', '131');


// untuk olereader
define('NUM_BIG_BLOCK_DEPOT_BLOCKS_POS', 0x2c);
define('SMALL_BLOCK_DEPOT_BLOCK_POS', 0x3c);
define('ROOT_START_BLOCK_POS', 0x30);
define('BIG_BLOCK_SIZE', 0x200);
define('SMALL_BLOCK_SIZE', 0x40);
define('EXTENSION_BLOCK_POS', 0x44);
define('NUM_EXTENSION_BLOCK_POS', 0x48);
define('PROPERTY_STORAGE_BLOCK_SIZE', 0x80);
define('BIG_BLOCK_DEPOT_BLOCKS_POS', 0x4c);
define('SMALL_BLOCK_THRESHOLD', 0x1000);

// property storage offsets
define('SIZE_OF_NAME_POS', 0x40);
define('TYPE_POS', 0x42);
define('START_BLOCK_POS', 0x74);
define('SIZE_POS', 0x78);
define('IDENTIFIER_OLE', pack("CCCCCCCC",0xd0,0xcf,0x11,0xe0,0xa1,0xb1,0x1a,0xe1));

// untuk excelreader
define('SPREADSHEET_EXCEL_READER_BIFF8',             0x600);
define('SPREADSHEET_EXCEL_READER_BIFF7',             0x500);
define('SPREADSHEET_EXCEL_READER_WORKBOOKGLOBALS',   0x5);
define('SPREADSHEET_EXCEL_READER_WORKSHEET',         0x10);
define('SPREADSHEET_EXCEL_READER_TYPE_BOF',          0x809);
define('SPREADSHEET_EXCEL_READER_TYPE_EOF',          0x0a);
define('SPREADSHEET_EXCEL_READER_TYPE_BOUNDSHEET',   0x85);
define('SPREADSHEET_EXCEL_READER_TYPE_DIMENSION',    0x200);
define('SPREADSHEET_EXCEL_READER_TYPE_ROW',          0x208);
define('SPREADSHEET_EXCEL_READER_TYPE_DBCELL',       0xd7);
define('SPREADSHEET_EXCEL_READER_TYPE_FILEPASS',     0x2f);
define('SPREADSHEET_EXCEL_READER_TYPE_NOTE',         0x1c);
define('SPREADSHEET_EXCEL_READER_TYPE_TXO',          0x1b6);
define('SPREADSHEET_EXCEL_READER_TYPE_RK',           0x7e);
define('SPREADSHEET_EXCEL_READER_TYPE_RK2',          0x27e);
define('SPREADSHEET_EXCEL_READER_TYPE_MULRK',        0xbd);
define('SPREADSHEET_EXCEL_READER_TYPE_MULBLANK',     0xbe);
define('SPREADSHEET_EXCEL_READER_TYPE_INDEX',        0x20b);
define('SPREADSHEET_EXCEL_READER_TYPE_SST',          0xfc);
define('SPREADSHEET_EXCEL_READER_TYPE_EXTSST',       0xff);
define('SPREADSHEET_EXCEL_READER_TYPE_CONTINUE',     0x3c);
define('SPREADSHEET_EXCEL_READER_TYPE_LABEL',        0x204);
define('SPREADSHEET_EXCEL_READER_TYPE_LABELSST',     0xfd);
define('SPREADSHEET_EXCEL_READER_TYPE_NUMBER',       0x203);
define('SPREADSHEET_EXCEL_READER_TYPE_NAME',         0x18);
define('SPREADSHEET_EXCEL_READER_TYPE_ARRAY',        0x221);
define('SPREADSHEET_EXCEL_READER_TYPE_STRING',       0x207);
define('SPREADSHEET_EXCEL_READER_TYPE_FORMULA',      0x406);
define('SPREADSHEET_EXCEL_READER_TYPE_FORMULA2',     0x6);
define('SPREADSHEET_EXCEL_READER_TYPE_FORMAT',       0x41e);
define('SPREADSHEET_EXCEL_READER_TYPE_XF',           0xe0);
define('SPREADSHEET_EXCEL_READER_TYPE_BOOLERR',      0x205);
define('SPREADSHEET_EXCEL_READER_TYPE_UNKNOWN',      0xffff);
define('SPREADSHEET_EXCEL_READER_TYPE_NINETEENFOUR', 0x22);
define('SPREADSHEET_EXCEL_READER_TYPE_MERGEDCELLS',  0xE5);
define('SPREADSHEET_EXCEL_READER_UTCOFFSETDAYS' ,    25569);
define('SPREADSHEET_EXCEL_READER_UTCOFFSETDAYS1904', 24107);
define('SPREADSHEET_EXCEL_READER_MSINADAY',          86400);
define('SPREADSHEET_EXCEL_READER_DEF_NUM_FORMAT',    "%s");

// untuk FPDF
define('FPDF_VERSION', '1.81');
define('FPDF_FONTPATH', './assets/font');

require_once 'assets/php/functions/autoload.php';
function &get_instance(){
    return _Controller::get_instance();
}

if(isset($_PENGATURAN['AUTO_UPDATE']) && $_PENGATURAN['AUTO_UPDATE'] == true){
    cekUpdate();
}
