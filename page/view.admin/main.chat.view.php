   <?php $a = $data['pesanUSER']->fetch_assoc()?>

   <div class="col-lg-12 col-md-12 col-12">
    <div class="card blur shadow-blur max-height-vh-70">
      <div class="card-header shadow-lg">
        <div class="row">
          <div class="col-lg-10 col-8">
            <div class="d-flex align-items-center">
              <img alt="Image" src="<?=BASEURL?>assets/img/app.admin/team-2.jpg" class="avatar">
              <div class="ms-3">
                <h6 class="mb-0 d-block"><?=$a['nama']?></h6>
                <span class="text-sm text-dark opacity-8"><?=$a['dt_rw']?></span>
              </div>
            </div>
          </div>
      </div>
    </div>
    <div id="tesisipesan" style="overflow: auto !important;"></div>
    <div class="card-body overflow-auto overflow-x-hidden" id="tesrealtime">
     <!-- 
      ?php while ($a = $data['getbls']->fetch_assoc()) { ?>
        ?php if ($a['create_by'] != $_SESSION['nama']) { ?>
          <div class="row justify-content-start mb-4">
           <div class="col-auto">
             <div class="card ">
               <div class="card-body py-2 px-3">
                 <p class="mb-1">
                   ?=$a['isi_bls']?>
                 </p>
                 <div class="d-flex align-items-center text-sm opacity-6">
                   <i class="ni ni-check-bold text-sm me-1"></i>
                   <small>3:14am</small>
                 </div>
               </div>
             </div>
           </div>
         </div>
       ?php }else{ ?>
         <div class="row justify-content-end text-right mb-4">
           <div class="col-auto">
             <div class="card bg-gray-200">
               <div class="card-body py-2 px-3">
                 <p class="mb-1" id="kautoh">
                  ?=$a['isi_bls']?>
                  <br>
                </p>
                <div class="d-flex align-items-center justify-content-end text-sm opacity-6">
                 <i class="ni ni-check-bold text-sm me-1"></i>
                 <small>4:42pm</small>
               </div>
             </div>
           </div>
         </div>
       </div>
     ?php } } ?> -->
   </div>
   <div class="card-footer d-block">
     <form class="align-items-center" id="isiresponku" onsubmit="return false">
       <div class="d-flex">
         <div class="input-group">
          <input type="text" class="form-control" id="ucisayang" placeholder="Type here" autocomplete="off" name="isipesan" aria-label="Message example input" >
        </div>
        <input type="text" hidden  name="idkucuy" id="idkucuy" value="<?=$a['id_user']?>">
        <!-- <button class="btn bg-gradient-primary mb-0 ms-2" id="huunabaya">
         <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
       </button> -->
        <button class="btn bg-gradient-primary mb-0 ms-2" id="huunabaya1" onclick="kirimrespon(this)">
         <i class="ni ni-send"></i>
       </button>
     </div>
   </form>
 </div>
</div>
</div>
</div>
