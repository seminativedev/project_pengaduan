<?php 
if($_SERVER['HTTP_HOST'] === 'localhost'){

	// untuk offline / localhost
	$_PENGATURAN['HOST_DB'] = 'localhost';
	$_PENGATURAN['USER_DB'] = 'root';
	$_PENGATURAN['PASS_DB'] = '';
	$_PENGATURAN['DATA_DB'] = 'projetc_pengaduan';

	$dr = explode(DIRECTORY_SEPARATOR, __DIR__);

	$_PENGATURAN['ROOR_DIR'] = $dr[sizeof($dr) - 1];

	$_PENGATURAN['AUTO_UPDATE'] = false;
	
	$_PENGATURAN['404_ON_ERROR'] = true;
	$_PENGATURAN['404_FILE'] = 'er_404.php';
}
else{

		// untuk online
	$_PENGATURAN['HOST_DB'] = 'localhost';
	$_PENGATURAN['USER_DB'] = 'alik9567_Uproject_pengaduan';
	$_PENGATURAN['PASS_DB'] = 'sayasiapa12@';
	$_PENGATURAN['DATA_DB'] = 'alik9567_project_pengaduan';

	$_PENGATURAN['AUTO_UPDATE'] = false;
	
	$_PENGATURAN['404_ON_ERROR'] = true;

}


?>