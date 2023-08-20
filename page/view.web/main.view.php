<header class="header-2">
    <div class="page-header section-height-75 relative" style="background-image: url('https://www.paluposo.id/wp-content/uploads/2023/01/WhatsApp-Image-2023-01-25-at-15.59.15.jpeg')">
      <div class="container">
        <div class="row">
          <div class="col-lg-7 text-center mx-auto" style="padding-top: 5rem !important;">
            <h1 class="text-white pt-3 mt-n5" style="font-size: 2.2rem !important;">Sistem Aplikasi Lapor Keluhan Masyrakat Kelurahan Tanamodindi Kota Palu</h1>
            <p class="lead text-white mt-3">Layanan Aspirasi dan Pengaduan Online Rakyat. <br /> Sampaikan laporan Anda langsung kepada instansi pemerintah berwenang. </p>
          </div>
        </div>
      </div>
      <div class="position-absolute w-100 z-index-1 bottom-0">
        <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 40" preserveAspectRatio="none" shape-rendering="auto">
          <defs>
            <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
          </defs>
          <g class="moving-waves">
            <use xlink:href="#gentle-wave" x="48" y="-1" fill="rgba(255,255,255,0.40" />
            <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.35)" />
            <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.25)" />
            <use xlink:href="#gentle-wave" x="48" y="8" fill="rgba(255,255,255,0.20)" />
            <use xlink:href="#gentle-wave" x="48" y="13" fill="rgba(255,255,255,0.15)" />
            <use xlink:href="#gentle-wave" x="48" y="16" fill="rgba(255,255,255,0.95" />
          </g>
        </svg>
      </div>
    </div>
  </header>

  <section class="my-1 py-0">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 w-100 ">
          <div class="row justify-content-center">
            <div class="col-md-6 w-100">
              <div >
                <div class="card-body" style="text-align: center;">
                  <button class="btn btn-icon btn-3 btn-primary" type="button" onclick="kirimgambar(this)" >
                    <span class="btn-inner--icon"><i class="ni ni-button-play"></i></span>
                    <span class="btn-inner--text">Buat Laporan !!</span>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <section class="my-1 py-0" id="isikirimgambar" style="display: none;">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 w-100 ">
          <div class="row justify-content-center">
            <div class="col-md-6 w-100">
              <div style="box-shadow: 0 20px 27px 0 rgb(0 0 0 / 71%);border-radius: 40px;">
                <div class="card-body">
                  <h3 class="card-title text-info text-gradient" style="text-align:center;">Sampaikan Laporan Anda</h3>
                  <button class="btn btn-icon-only btn-2 btn-primary" type="button">
                    <span class="btn-inner--icon"><i class="ni ni-bulb-61"></i></span>
                  </button>
                  <blockquote class="blockquote text-white mb-0">
                    <form id="laporankuuyy" onsubmit="return false">


                      <div class="form-group ms-3">
                        <div class="input-group">
                          <select class="form-control" name="Ikategori" id="Ikategori" style="background-color: white;"> 
                            <option>--Pilih Kategori--</option>
                            <?php while ($a = $data['kat']->fetch_assoc()) { ?>
                              <option><?=$a['kategori']?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>

                      <div class="form-group ms-3">
                        <div class="input-group">
                          <input class="form-control" placeholder="Masukan Nama Anda"  type="text" name="Inama" id="Inama">
                        </div>
                      </div>

                      <div class="form-group ms-3">
                        <div class="input-group">
                          <input class="form-control" placeholder="No hp" type="text" name="Inomor" id="Inomor">
                        </div>
                      </div>

                      <div class="form-group ms-3">
                        <div class="input-group">
                          <select class="form-control" name="Ikelurahan" id="Ikelurahan" style="background-color: white;"> 
                            <option selected>Tanamodindi</option>
                          </select>
                        </div>
                      </div>

                      <div class="form-group ms-3">
                        <div class="input-group">
                          <select class="form-control" style="background-color: white;" 
                          onchange="pilihrt(this)" name="Irw" id="Irw"> 
                          <option selected disabled>--Pilih Rw--</option>
                          <?php while ($b =$data['rw']->fetch_assoc()) { ?>
                            <option><?=$b['rw']?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>

                    <div class="form-group ms-3">
                      <div class="input-group">
                        <select class="form-control" name="Irt" id="Irt" style="background-color: white;"> 
                          <option selected disabled>--Pilih Rt--</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group ms-3">
                      <div class="input-group">
                        <textarea name="Idesk" id="Idesk" rows="6" class="form-control textarea-flex autosize" placeholder="Ketik Isi Laporan Anda *" required="" style="overflow: hidden; overflow-wrap: break-word; height: 157.333px;"></textarea>
                      </div>
                    </div>

                    <div class="form-group ms-3">
                      <div class="input-group">
                        <div class="fallback">
                          <input name="fotolaporankuy[]"  type="file" class="form-control dropzone"  multiple />
                        </div>
                      </div>
                    </div>


                    <footer class=" text-info text-sm ms-3">
                      <hr class="horizontal dark mb-5">
                      <div class="container">
                        <div class="row">
                          <div class="col-12">
                            <button type="button" class="btn bg-gradient-primary mb-0 w-100" onclick="kirimlaporanku(this)" >Kirim Pengaduan !! </button>
                          </div>
                        </div>
                      </div>
                    </footer>
                  </blockquote>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>  




  <!-- -------- START Features w/ title and 3 infos -------- -->
  <section class="py-6" id="dataku">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 mx-auto text-center pb-4">
          <h4 class="text-gradient text-primary mb-5">DataLaporan</h4>

          <!-- <h2>Apa Itu !?</h2> -->
          <!-- <p class="lead">Penyelenggara dapat mengelola pengaduan dari masyarakat secara sederhana, cepat, tepat, tuntas, dan terkoordinasi dengan baik;
            Penyelenggara memberikan akses untuk partisipasi masyarakat dalam menyampaikan pengaduan; dan
          Meningkatkan kualitas pelayanan publik.</p> -->
        </div>
      </div>
      <div class="row">
        <div class="col-lg-3 col-md-6">
          <div class="p-3 text-center">
            <div class="icon icon-shape bg-gradient-primary shadow mx-auto">
              <i class="ni ni-email-83"></i>
            </div>
            <h5 class="mt-4">Laporan Masuk</h5>

            <p><?=$data['pmsk']?></p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="p-3 text-center">
            <div class="icon icon-shape bg-gradient-warning shadow mx-auto">
              <i class="ni ni-email-83"></i>
            </div>
            <h5 class="mt-4">Laporan Pending</h5>
            <p><?=$data['pm']?></p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="p-3 text-center">
            <div class="icon icon-shape bg-gradient-danger shadow mx-auto">
              <i class="ni ni-email-83"></i>
            </div>
            <h5 class="mt-4">Laporan Diproses</h5>
            <p><?=$data['pp']?></p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 mx-md-auto">
          <div class="p-3 text-center">
            <div class="icon icon-shape bg-gradient-success shadow mx-auto">
             <i class="ni ni-email-83"></i>
           </div>
           <h5 class="mt-4">Laporan Selesai</h5>
           <p><?=$data['ps']?></p>
         </div>
       </div>
     </div>
   </div>
 </section>
 <!-- -------- END Features w/ title and 3 infos -------- -->

 <!-- END Section Content -->
 <!-- -------   START PRE-FOOTER 2 - simple social line w/ title & 3 buttons    -------- -->
 <!-- <div class="pt-5" id="documentku">
  <div class="container">
    <div class="row">
      <div class="col-lg-5 ms-auto">
        <h4 class="mb-1">Thank you for your support!</h4>
        <p class="lead mb-0">We deliver the best web products</p>
      </div>
      <div class="col-lg-5 me-lg-auto my-lg-auto text-lg-right mt-5">
        <a href="https://twitter.com/intent/tweet?text=Check%20Soft%20UI%20Design%20System%20made%20by%20%40CreativeTim%20%23webdesign%20%23designsystem%20%23bootstrap5&url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fsoft-ui-design-system" class="btn btn-info mb-0 me-2" target="_blank">
          <i class="fab fa-twitter me-1"></i> Tweet
        </a>
        <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/soft-ui-design-system" class="btn btn-primary mb-0 me-2" target="_blank">
          <i class="fab fa-facebook-square me-1"></i> Share
        </a>
        <a href="https://www.pinterest.com/pin/create/button/?url=https://www.creative-tim.com/product/soft-ui-design-system" class="btn btn-dark mb-0 me-2" target="_blank">
          <i class="fab fa-pinterest me-1"></i> Pin it
        </a>
      </div>
    </div>
  </div>
</div> -->
<!-- -------   END PRE-FOOTER 2 - simple social line w/ title & 3 buttons    -------- -->

<script type="text/javascript">
function formatPhoneNumber(phoneNumber) {
  const cleanedNumber = phoneNumber.replace(/[^\d]/g, '');
  const match = cleanedNumber.match(/^(0\d{3})(\d{4})(\d{4})$/);
  if (match) {
    return `${match[1]}-${match[2]}-${match[3]}`;
  }
  return phoneNumber;
}

const phoneInput = document.getElementById('Inomor');
phoneInput.addEventListener('input', function () {
  const rawValue = this.value;
  const formattedValue = formatPhoneNumber(rawValue);
  this.value = formattedValue;
});

phoneInput.addEventListener('keypress', function (event) {
  const keyCode = event.which ? event.which : event.keyCode;
  if (keyCode < 48 || keyCode > 57) {
    event.preventDefault();
  }
});

function showErrorAlert() {
  Swal.fire({
    icon: 'error',
    title: 'Format Nomor Salah',
    text: 'Mohon masukkan nomor telepon dengan format yang benar.',
    confirmButtonColor: '#d33',
    confirmButtonText: 'OK'
  });
}

phoneInput.addEventListener('blur', function () {
  const cleanedNumber = this.value.replace(/[^\d]/g, '');
  const match = cleanedNumber.match(/^(0\d{3})(\d{4})(\d{4})$/);
  if (!match) {
    showErrorAlert();
    this.focus();
  }
});

</script>