<?php $cd = $data['getUSER']->fetch_assoc() ?>
<div class="page-header min-vh-85">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-center flex-column">
                <div class="card d-flex blur justify-content-center p-4 shadow-lg my-sm-0 my-sm-6 mt-8 mb-5">
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
                                    <a class="btn btn-primary btn-sm ms-auto" id="tindispakita" idkucuy="<?=$cd['id']?>" href="/<?='project_pengaduan/',$_GET[0],'/',$_GET[1]?>/respon/<?=$cd['id']?>">Keluar Forum</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body overflow-auto overflow-x-hidden my-7" id="kautoh">
                            <?php while ($a = $data['getbls']->fetch_assoc()) { ?>
                                <?php if ($a['create_by'] != $cd['nama_pg']) { ?>
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
            <input type="text" hidden  name="nama_pg"  value="<?=$cd['nama_pg']?>">
            <button class="btn bg-gradient-primary mb-0 ms-2" onclick="kirimrespon(this)">
               <i class="ni ni-send"></i>
           </button>
       </div>
   </form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

