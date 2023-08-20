<?php $cd = $data['getUSER']->fetch_assoc() ?>
<div class="row">
 <div class="col-lg-12 col-md-7 col-12">
     <div class="card blur shadow-blur max-height-vh-70">
         <div class="card-header shadow-lg">
             <div class="row">
                 <div class="col-lg-10 col-8">
                     <div class="d-flex align-items-center">
                         <img alt="Image" src="http://localhost/project_pengaduan/assets/img/app.admin/team-2.jpg" class="avatar">
                         <div class="ms-3">
                             <h6 class="mb-0 d-block">Nama Pengadu : <?=$cd['nama_pg']?></h6>
                             <span class="text-sm text-dark opacity-8">No Pengaduan : <?=$cd['id_pg']?></span>
                         </div>
                     </div>
                 </div>
                 <div class="col-lg-1 col-2 my-auto pe-0">
                    <a class="btn btn-primary btn-sm ms-auto" id="tindispakita" idkucuy="<?=$cd['id']?>" href="/<?='project_pengaduan/',$_GET[0],'/',$_GET[1]?>/respon/<?=$cd['id']?>">Respon</a>
                       <!-- <button class="btn btn-icon-only shadow-none text-dark mb-0 me-3 me-sm-0" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Video call">
                           <i class="ni ni-camera-compact"></i>
                       </button> -->
                   </div>
                   <div class="col-lg-1 col-2 my-auto ps-0">
                       <!-- <div class="dropdown">
                           <button class="btn btn-icon-only shadow-none text-dark mb-0" type="button" data-bs-toggle="dropdown">
                               <i class="ni ni-settings"></i>
                           </button>
                           <ul class="dropdown-menu dropdown-menu-end me-sm-n2 p-2" aria-labelledby="chatmsg">
                               <li>
                                   <a class="dropdown-item border-radius-md" href="javascript:;">
                                       Profile
                                   </a>
                               </li>
                               <li>
                                   <a class="dropdown-item border-radius-md" href="javascript:;">
                                       Mute conversation
                                   </a>
                               </li>
                               <li>
                                   <a class="dropdown-item border-radius-md" href="javascript:;">
                                       Block
                                   </a>
                               </li>
                               <li>
                                   <a class="dropdown-item border-radius-md" href="javascript:;">
                                       Clear chat
                                   </a>
                               </li>
                               <li>
                                   <a class="dropdown-item border-radius-md text-danger" href="javascript:;">
                                       Delete chat
                                   </a>
                               </li>
                           </ul>
                       </div> -->
                   </div>
               </div>
           </div>
           <div id="tesisipesan" style="overflow: auto !important;"></div>
           <div class="card-body overflow-auto overflow-x-hidden " id="kautoh">
            <?php while ($a = $data['getbls']->fetch_assoc()) { ?>
                <?php if ($a['create_by'] != $_SESSION['nama']) { ?>
                    <div class="row justify-content-start mb-4">
                       <div class="col-auto">
                           <div class="card ">
                               <div class="card-body py-2 px-3">
                                   <p class="mb-1">
                                       <?=$a['isi_bls']?>
                                   </p>
                                   <div class="d-flex align-items-center text-sm opacity-6">
                                       <i class="ni ni-check-bold text-sm me-1"></i>
                                       <small>3:14am</small>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               <?php }else{ ?>
                   <div class="row justify-content-end text-right mb-4">
                     <div class="col-auto">
                         <div class="card bg-gray-200">
                             <div class="card-body py-2 px-3">
                                 <p class="mb-1" id="kautoh">
                                    <?=$a['isi_bls']?>
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
         <?php } } ?>

       <!-- <div class="row justify-content-end text-right mb-4">
           <div class="col-auto">
               <div class="card bg-gray-200">
                   <div class="card-body py-2 px-3">
                       <p class="mb-1" id="kautoh">
                           Apa Quntul<br>
                       </p>
                       <div class="d-flex align-items-center justify-content-end text-sm opacity-6">
                           <i class="ni ni-check-bold text-sm me-1"></i>
                           <small>4:42pm</small>
                       </div>
                   </div>
               </div>
           </div>
       </div> -->
   </div>
   <div class="card-footer d-block">
     <form class="align-items-center" id="isiresponku" onsubmit="return false">
         <div class="d-flex">
             <div class="input-group">
                <input type="text" class="form-control" id="ucisayang" placeholder="Type here" name="isipesan" aria-label="Message example input" >
            </div>
            <input type="text" hidden  name="idkucuy"  value="<?=$cd['id_pg']?>">
            <button class="btn bg-gradient-primary mb-0 ms-2" onclick="kirimrespon(this)">
             <i class="ni ni-send"></i>
         </button>
     </div>
 </form>
</div>
</div>
</div>
</div>