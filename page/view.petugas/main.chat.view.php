   <?php $a = $data['pesanUSER']->fetch_assoc()?>
   <?php $ketuarw = $data['infouser2']->fetch_assoc()?>
   <div class="row ">
    <div class="col-lg-4 col-md-5 col-12">
      <div class="card blur shadow-blur max-height-vh-70 overflow-auto scrollable-container overflow-x-hidden mb-5 mb-lg-0">
        <div class="card-header p-3">
          <h6></h6>
          <input type="text" class="form-control" placeholder="Search Contact" aria-label="Email" onkeyup="carigue(this)" id="carikontaku">
        </div>
        <div class="card-body p-2 " id="isikontakchat">
          <a href="javascript:;" class="d-block p-2" idkucuy="<?=$a['id_user']?>" namakucuy="<?=$a['username']?>" onclick="getUSER(this)">
            <div class="d-flex p-2">
              <img alt="Image" src="<?=BASEURL?>assets/img/illustrations/chat.png" class="avatar shadow">
              <div class="ms-3">
                <div class="justify-content-between align-items-center">
                  <h6 class="mb-0"><?=$a['role']?></h6>
                  <p class="text-muted text-xs mb-2"><?=$a['status_login']?></p>
                </div>
              </div>
            </div>
          </a> 
          <?php if (empty($_SESSION['rtku'])) { ?>
            <?php while ($getUSER = $data['infouser1']->fetch_assoc()) { ?> 
              <a href="javascript:;" class="d-block p-2" idkucuy="<?=$getUSER['id_user']?>" namakucuy="<?=$getUSER['nama']?>" onclick="getUSER(this)">
                <div class="d-flex p-2">
                  <img alt="Image" src="<?=BASEURL?>assets/img/illustrations/chat.png" class="avatar shadow">
                  <div class="ms-3">
                    <div class="justify-content-between align-items-center">
                      <h6 class="mb-0"><?=$getUSER['nama']?></h6>
                      <p class="text-muted text-xs mb-2"><?=!empty($getUSER['dt_rt']) ? $getUSER['dt_rw'] .'-'.$getUSER['dt_rt'] : $getUSER['dt_rw']?></p>
                    </div>
                    <span class="text-muted text-sm col-11 p-0 text-truncate"><?=$getUSER['jabatan']?></span>
                  </div>
                </div>
              </a>            
            <?php } } else{ ?>
              <a href="javascript:;" class="d-block p-2" idkucuy="<?=$ketuarw['id_user']?>" namakucuy="<?=$ketuarw['nama']?>" onclick="getUSER(this)">
                <div class="d-flex p-2">
                  <img alt="Image" src="<?=BASEURL?>assets/img/illustrations/chat.png" class="avatar shadow">
                  <div class="ms-3">
                    <div class="justify-content-between align-items-center">
                      <h6 class="mb-0"><?=$ketuarw['nama']?></h6>
                      <p class="text-muted text-xs mb-2"><?=!empty($getUSER['dt_rt']) ? $ketuarw['dt_rw'] .'-'.$ketuarw['dt_rt'] : $ketuarw['dt_rw']?></p>
                    </div>
                    <span class="text-muted text-sm col-11 p-0 text-truncate"><?=$ketuarw['jabatan']?></span>
                  </div>
                </div>
              </a>
              <?php while ($getUSER = $data['infouser']->fetch_assoc()) { ?>         
                <a href="javascript:;" class="d-block p-2" idkucuy="<?=$getUSER['id_user']?>" namakucuy="<?=$getUSER['nama']?>" onclick="getUSER(this)">
                  <div class="d-flex p-2">
                    <img alt="Image" src="<?=BASEURL?>assets/img/illustrations/chat.png" class="avatar shadow">
                    <div class="ms-3">
                      <div class="justify-content-between align-items-center">
                        <h6 class="mb-0"><?=$getUSER['nama']?></h6>
                        <p class="text-muted text-xs mb-2"><?=!empty($getUSER['dt_rt']) ? $getUSER['dt_rw'] .'-'.$getUSER['dt_rt'] : $getUSER['dt_rw']?></p>
                      </div>
                      <span class="text-muted text-sm col-11 p-0 text-truncate"><?=$getUSER['jabatan']?></span>
                    </div>
                  </div>
                </a>
              <?php } } ?>
            </div>
          </div>
        </div>
        <div class="col-lg-8 col-md-7 col-12">
          <div class="card blur shadow-blur max-height-vh-60" >
            <div class="card-header shadow-lg">
              <div class="row">
                <div class="col-lg-10 col-8">
                  <div class="d-flex align-items-center">
                    <img alt="Image" src="<?=BASEURL?>assets/img/illustrations/chat.png" class="avatar">
                    <div class="ms-3">
                      <h6 class="mb-0 d-block " id="masoNAMA"></h6>
                      <span class="text-sm text-dark opacity-8" id="masoRW"></span>
                    </div>
                  </div>
                </div>
                <div class="col-lg-1 col-2 my-auto pe-0"></div>
                <div class="col-lg-1 col-2 my-auto ps-0" id="setinganku"></div>
              </div>
            </div>
            <div id="tesisipesan" style="overflow: auto !important;"></div>
            <div class="card-body overflow-auto scrollable-container overflow-x-hidden " id="tesrealtime"></div>
            <div class="card-footer d-block">
             <form class="align-items-center " id="isipesankucuy" onsubmit="return false">
               <div class="d-flex">
                 <div class="input-group" id="tempattulispesan" ></div>
                 <input type="text" name="idkucuy" hidden id="idkucuypesan"></div>
               </form>
             </div>
           </div>
         </div>
       </div>
