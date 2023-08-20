<div class="row mb-3">
  <div class="col-xl-5 ms-auto mt-xl-0 mt-4">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8 my-auto">
                <div class="numbers">
                  <p class="text-sm mb-0 text-capitalize font-weight-bold opacity-7">Cuaca hari ini</p>
                  <h5 class="font-weight-bolder mb-0" id="weather-info">
                    Loading...
                  </h5>
                </div>
              </div>
              <div class="col-4 text-end">
                <img class="w-50" src="<?=BASEURL?>assets/img/app.admin/small-logos/icon-sun-cloud.png" alt="image sun" id="weather-icon">
                <h5 class="mb-0 text-end me-1" id="current-time">00:00:00</h5>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4 animate__animated animate__lightSpeedInRight animate__delay-1s">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-uppercase font-weight-bold">Laporan Masuk</p>
              <h5 class="font-weight-bolder">
                <?=$data['masuk']?>
              </h5>
              <p class="mb-0">
               <span class="text-success text-sm font-weight-bolder"><?=$data['tgl']?></span> than last update
             </p>
           </div>
         </div>
         <div class="col-4 text-end">
          <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
            <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4 animate__animated animate__lightSpeedInRight animate__delay-2s">
  <div class="card">
    <div class="card-body p-3">
      <div class="row">
        <div class="col-8">
          <div class="numbers">
            <p class="text-sm mb-0 text-uppercase font-weight-bold">Laporan Pending</p>
            <h5 class="font-weight-bolder">
             <?=$data['pending']?>
           </h5>
           <p class="mb-0">
            <span class="text-success text-sm font-weight-bolder"><?=$data['tgl']?></span> than last update
          </p>
        </div>
      </div>
      <div class="col-4 text-end">
        <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
          <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4 animate__animated animate__lightSpeedInRight animate__delay-3s">
  <div class="card">
    <div class="card-body p-3">
      <div class="row">
        <div class="col-8">
          <div class="numbers">
            <p class="text-sm mb-0 text-uppercase font-weight-bold">Laporan Gagal</p>
            <h5 class="font-weight-bolder">
              <?=$data['gagal']?>
            </h5>
            <p class="mb-0">
              <span class="text-success text-sm font-weight-bolder"><?=$data['tgl']?></span> than last update
            </p>
          </div>
        </div>
        <div class="col-4 text-end">
          <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
            <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="col-xl-3 col-sm-6 animate__animated animate__lightSpeedInRight animate__delay-4s">
  <div class="card">
    <div class="card-body p-3">
      <div class="row">
        <div class="col-8">
          <div class="numbers">
            <p class="text-sm mb-0 text-uppercase font-weight-bold">Laporan Selesai</p>
            <h5 class="font-weight-bolder">
              <?=$data['selesai']?>
            </h5>
            <p class="mb-0">
              <span class="text-success text-sm font-weight-bolder"><?=$data['tgl']?></span> than last update
            </p>
          </div>
        </div>
        <div class="col-4 text-end">
          <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
            <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<div class="row mt-4">
  <div class="col-lg-7 mb-lg-0 mb-4 animate__animated animate__zoomInUp animate__delay-5s">
    <div class="card">
      <div class="card-header pb-0 p-3">
        <div class="d-flex align-items-center">
          <h6 class="mb-0">Jumlah pengaduan by kategori</h6>
          <button type="button" class="btn btn-icon-only btn-rounded btn-outline-secondary mb-0 ms-2 btn-sm d-flex align-items-center justify-content-center ms-auto" data-bs-toggle="tooltip" data-bs-placement="bottom">
            <i class="fas fa-info" aria-hidden="true"></i>
          </button>
        </div>
      </div>
      <div class="card-body p-3">
        <div class="row">
          <div class="col-5 text-center">
            <div class="chart">
              <canvas id="chart-consumption" class="chart-canvas" height="197" style="display: block; box-sizing: border-box; height: 197px; width: 181.6px;" width="181"></canvas>
            </div>
            <h4 class="font-weight-bold mt-n8">
              <span>310.0</span>
              <span class="d-block text-body text-sm">WATTS</span>
            </h4>
          </div>
          <div class="col-7">
            <div class="table-responsive">
              <table class="table align-items-center mb-0">
                <tbody>
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-0">
                        <span class="badge bg-primary me-3"> </span>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">Saran</h6>
                        </div>
                      </div>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="text-xs font-weight-bold"> 15% </span>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-0">
                        <span class="badge bg-secondary me-3"> </span>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">Kdrt</h6>
                        </div>
                      </div>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="text-xs font-weight-bold"> 20% </span>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-0">
                        <span class="badge bg-info me-3"> </span>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">Pencurian</h6>
                        </div>
                      </div>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="text-xs font-weight-bold"> 13% </span>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-0">
                        <span class="badge bg-success me-3"> </span>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">Pungli</h6>
                        </div>
                      </div>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="text-xs font-weight-bold"> 32% </span>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-0">
                        <span class="badge bg-warning me-3"> </span>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">Narkoba</h6>
                        </div>
                      </div>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="text-xs font-weight-bold"> 20% </span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-5 animate__animated animate__zoomInUp animate__delay-5s">
    <div class="card card-carousel overflow-hidden h-100 p-0">
      <div id="carouselExampleCaptions" class="carousel slide h-100" data-bs-ride="carousel">
        <div class="carousel-inner border-radius-lg h-100">
          <?php
                $active = true; // Untuk mengatur class "active" pada carousel-item pertama
                while ($isi = $data['foto']->fetch_assoc()) {
                  $imageData = explode(',', $isi['foto']);
                  foreach ($imageData as $imageName) {
                    ?>
                    <div class="carousel-item h-100 <?= ($active ? 'active' : ''); ?>" style="background-image: url('<?= BASEURL ?>assets/img/fotopengaduan/<?= $imageName ?>');
                    background-size: cover;">
                    <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                      <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                        <i class="ni ni-camera-compact text-dark opacity-10"></i>
                      </div>
                      <h5 class="text-danger mb-1"><?=$isi['nama_pg']?></h5>
                      <p><?=$isi['kelurahan'],'/',$isi['rw'],'/',$isi['rt']?></p>
                      <p><?=$isi['isi']?></p>
                    </div>
                  </div>
                  <?php
                        $active = false; // Matikan class "active" setelah carousel-item pertama
                      }
                    }
                    ?>
                  </div>
                  <button class="carousel-control-prev w-5 me-3" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                  </button>
                  <button class="carousel-control-next w-5 me-3" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                  </button>
                </div>
              </div>
            </div>
          </div>