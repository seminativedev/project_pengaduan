<!DOCTYPE html>
<html lang="en" itemscope itemtype="http://schema.org/WebPage">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="<?=BASEURL?>assets/img/logo.png">
  <link rel="icon" type="image/png" href="<?=BASEURL?>assets/img/logo.png" width="30" height="30">
  <title>
    Aplikasi Lapor Keluhan Masyrakat Kelurahan Tanamodindi Kota Palu
  </title>
  <script src="<?=BASEURL?>assets/js/jquery-3.7.0.min.js"></script>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="<?=BASEURL?>assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="<?=BASEURL?>assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="<?=BASEURL?>assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="<?=BASEURL?>assets/css/soft-design-system.css" rel="stylesheet" />
  <!-- Font Awesome link -->
  <script src="<?=BASEURL?>assets/js/sweetalert2.all.min.js"></script>
  <link  rel="stylesheet"  href="<?=BASEURL?>assets/css/animate.min.css"/>



  <style type="text/css">
    /* Place the button at the bottom right corner of the page */
    .back-to-top {
      position: fixed;
      bottom: 30px;
      right: 30px;
      width: auto;
    }

/* Style the icon inside the button */
.back-to-top i {
  font-size: 15px;
}

.navbar-hidden {
  transform: translateY(-100%);
  transition: transform 0.7s ease-in-out;
}
.loading-overlay {
 position: fixed;
 top: 0;
 left: 0;
 width: 100%;
 height: 100%;
 z-index: 99999;
 display: block;
 justify-content: center;
 align-items: center;
 background-color: rgba(0, 0, 0, 0.5);
 backdrop-filter: blur(5px); /* Efek blur pada latar belakang */
}

.loading-content {
 display: flex;
 justify-content: center;
 align-items: center;
 flex-direction: column;
 height: 100%;
}

.loading-content .spinner-border {
 color: #fff;
}
</style>
</head>

<body class="presentation-page">
	<!-- Tambahkan elemen loading di dalam konten -->
	<div id="loading" class="loading-overlay">
		<div class="loading-content">
			<div class="spinner-border text-warning" role="status">
				<span class="visually-hidden">Loading...</span>
			</div>
		</div>
	</div>
  <!-- Login -->
  <div class="modal fade" id="exampleModalSignUp" tabindex="-1" role="dialog" aria-labelledby="exampleModalSignTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-body p-0">
          <div class="card card-plain">
            <div class="card-header pb-0 text-left">
              <h3 class="font-weight-bolder text-primary text-gradient" style="text-align: center;">SMART REPORT</h3>
              <p class="mb-0" style="text-align: center;">Enter your email and password to login</p>
            </div>
            <div class="card-body pb-3">
              <form role="form text-left" id="login" onsubmit="return false">
                <input type="text" class="form-control" hidden name="masuk" value="gue">
                
                <label>UserName</label>
                <div class="input-group mb-3">
                  <input type="text" class="form-control" name="username" placeholder="Name" aria-label="Name" aria-describedby="name-addon">
                </div>
                <label>Password</label>
                <div class="input-group mb-3">
                  <input type="password" class="form-control" name="password" id="passwordInput" placeholder="Password" aria-label="Password" aria-describedby="password-addon">
                </div>
                <div class="form-check form-check-info text-left">
                  <input class="form-check-input" type="checkbox"  id="togglePasswordBtn" value="" id="flexCheckDefault" checked="">
                  <label class="form-check-label" for="flexCheckDefault">
                    Show<a href="#" class="text-dark font-weight-bolder">Password</a>
                  </label>
                </div>
                <div class="text-center">
                  <button type="button" onclick="login(this)" class="btn bg-gradient-primary btn-lg btn-rounded w-100 mt-4 mb-0">Sign up</button>
                </div>
              </form>
            </div>
            <!-- <div class="card-footer text-center pt-0 px-sm-4 px-1">
              <p class="mb-4 mx-auto">
                Already have an account?
                <a href="javascrpt:;" class="text-primary text-gradient font-weight-bold" >Sign in</a>
              </p>
            </div> -->
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Navbar -->
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        <nav class="navbar navbar-expand-lg  blur blur-rounded top-0  shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
          <div class="container-fluid">
            <a class="navbar-brand font-weight-bolder ms-sm-3" href="<?=BASEURL,$_GET[0],'/',$_GET[1]?>" rel="tooltip" title="SISTEM APLIKASI SMART REPORT" data-placement="bottom" >
              SMART REPORT
            </a>
            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon mt-2">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </span>
            </button>
            <div class="collapse navbar-collapse pt-3 pb-2 py-lg-0 w-100" id="navigation">
              <ul class="navbar-nav navbar-nav-hover ms-lg-12 ps-lg-5 w-100">
                <li class="nav-item dropdown dropdown-hover mx-2">
                  <a href="<?=BASEURL,$_GET[0],'/',$_GET[1]?>" class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center">
                    HOME
                  </a>
                </li>
                <li class="nav-item dropdown dropdown-hover mx-2">
                  <a href="<?=BASEURL,$_GET[0],'/',$_GET[1]?>/bot" class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center">
                    BOT
                  </a>
                </li>
                <li class="nav-item dropdown dropdown-hover mx-2">
                  <a class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center" href="#dataku" aria-expanded="false">
                    Data Laporan
                  </a>
                </li>
                <li class="nav-item dropdown dropdown-hover mx-2">
                  <a href="<?=BASEURL,$_GET[0],'/',$_GET[1],'/search_data'?>" aria-expanded="false" class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center">
                    Cari Pengaduan
                  </a>
                </li>
                <li class="nav-item ms-lg-auto">
                  <a class="nav-link nav-link-icon me-2" href="javascript:void(0)" >
                    <!-- <i class="fa fa-github me-1"></i> -->
                    <p class="d-inline text-sm z-index-1 font-weight-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Star us on Github"></p>
                  </a>
                </li>
                <li class="nav-item my-auto ms-3 ms-lg-0">
                  <a href="" data-bs-toggle="modal" data-bs-target="#exampleModalSignUp" class="btn btn-sm  bg-gradient-primary  btn-round mb-0 me-1 mt-2 mt-md-0">Login</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
        <!-- End Navbar -->
      </div>
    </div>
  </div>

  #template('content')

 

  <footer class="footer pt-5 mt-5">
    <hr class="horizontal dark mb-1">
    <div class="container">
      <div class=" row">
        <div class="col-md-3 mb-4 ms-auto">
          <div>
            <h6 class="text-gradient text-primary font-weight-bolder">SMART REPORT</h6>
          </div>
          <div>
            <h6 class="text-sm mb-2 opacity-8">Jl. Balai Kota Timur No. 1</h6>
            <h6 class="text-sm mb-2 opacity-8">Tanamodindi, Mantikulore</h6>
            <h6 class="text-sm mb-2 opacity-8">Kota Palu – Sulawesi Tengah 94111</h6>
            <ul class="d-flex flex-row ms-n3 nav">
              <!-- <li class="nav-item">
                <a class="nav-link pe-1" href="https://www.facebook.com/CreativeTim/" target="_blank">
                  <i class="fab fa-facebook text-lg opacity-8"></i>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link pe-1" href="https://twitter.com/creativetim" target="_blank">
                  <i class="fab fa-twitter text-lg opacity-8"></i>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link pe-1" href="https://dribbble.com/creativetim" target="_blank">
                  <i class="fab fa-dribbble text-lg opacity-8"></i>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link pe-1" href="https://github.com/creativetimofficial" target="_blank">
                  <i class="fab fa-github text-lg opacity-8"></i>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link pe-1" href="https://www.youtube.com/channel/UCVyTG4sCw-rOvB9oHkzZD1w" target="_blank">
                  <i class="fab fa-youtube text-lg opacity-8"></i>
                </a>
              </li> -->
            </ul>
          </div>
        </div>
        <div class="col-md-2 col-sm-6 col-6 mb-4">
          <div>
            <h6 class="text-gradient text-primary text-sm">Tautan Penting</h6>
            <ul class="flex-column ms-n3 nav">
              <li class="nav-item">
                <a class="nav-link" href="https://indonesia.go.id/" target="_blank">
                  Republik Indonesia
                </a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-md-2 col-sm-6 col-6 mb-4">
          <div>
            <h6 class="text-gradient text-primary text-sm">Tautan Penting</h6>
            <ul class="flex-column ms-n3 nav">
              <li class="nav-item">
                <a class="nav-link" href="https://jdih.setneg.go.id/" target="_blank">
                  Sekretariat Negara
                </a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-md-2 col-sm-6 col-6 mb-4">
          <div>
            <h6 class="text-gradient text-primary text-sm">Tautan Penting</h6>
            <ul class="flex-column ms-n3 nav">
             <li class="nav-item">
              <a class="nav-link" href="https://setkab.go.id/" target="_blank">
                Sekretariat Kabinet
              </a>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-md-2 col-sm-6 col-6 mb-4 me-auto">
        <div>
          <h6 class="text-gradient text-primary text-sm">Tautan Penting</h6>
          <ul class="flex-column ms-n3 nav">
            <li class="nav-item">
              <a class="nav-link" href="https://sultengprov.go.id/" target="_blank">
                Pemerintah Sulawesi Tengah
              </a>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-12">
        <div class="text-center">
          <p class="my-4 text-sm">
            Copyright © <script>
              document.write(new Date().getFullYear())
            </script> SISTEM APLIKASI SMART REPORT. <a href="https://www.creative-tim.com" target="_blank"></a>
          </p>
        </div>
      </div>
    </div>
  </div>
</footer>




<script>
  function kirimgambar(argument) {
    $("#isikirimgambar").slideToggle("slow");
  }
</script>
<script>
  window.addEventListener("scroll", function() {
    const navbar = document.querySelector(".navbar");
    if (window.scrollY > 50) {
      navbar.classList.add("navbar-hidden");
    } else {
      navbar.classList.remove("navbar-hidden");
    }
  });
</script>



<!-- Add this script after including jQuery -->
<!-- <script>
  $(document).ready(function() {
    // Back to top button click event
    $('#backToTopBtn').click(function() {
      $('html, body').animate({ scrollTop: 0 }, 'fast');
    });

    // Show/hide the button based on scroll position
    $(window).scroll(function() {
      if ($(this).scrollTop() > 200) {
        $('#backToTopBtn').fadeIn();
      } else {
        $('#backToTopBtn').fadeOut();
      }
    });
  });
</script>
-->


<!--   Core JS Files   -->
<!-- <script type="text/javascript" src="https://demos.creative-tim.com/test/argon-dashboard-pro/assets/js/plugins/dropzone.min.js"></script> -->
<script src="<?=BASEURL?>assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="<?=BASEURL?>assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<script src="<?=BASEURL?>assets/js/plugins/perfect-scrollbar.min.js"></script>
<!--  Plugin for TypedJS, full documentation here: https://github.com/inorganik/CountUp.js -->
<!-- <script src="<?=BASEURL?>assets/js/plugins/countup.min.js"></script> -->
<!--  Plugin for Parallax, full documentation here: https://github.com/dixonandmoe/rellax -->
<script src="<?=BASEURL?>assets/js/plugins/rellax.min.js"></script>
<!--  Plugin for TiltJS, full documentation here: https://gijsroge.github.io/tilt.js/ -->
<script src="<?=BASEURL?>assets/js/plugins/tilt.min.js"></script>
<!--  Plugin for Selectpicker - ChoicesJS, full documentation here: https://github.com/jshjohnson/Choices -->
<script src="<?=BASEURL?>assets/js/plugins/choices.min.js"></script>
<!--  Plugin for Parallax, full documentation here: https://github.com/wagerfield/parallax  -->
<script src="<?=BASEURL?>assets/js/plugins/parallax.min.js"></script>
<!-- Control Center for Soft UI Kit: parallax effects, scripts for the example pages etc -->
<!--  Google Maps Plugin    -->
<script src="<?=BASEURL?>assets/js/soft-design-system.min.js" type="text/javascript"></script>


<script>
  // Get the password input and the eye icon
  const passwordInput = document.getElementById('passwordInput');
  const eyeIcon = document.getElementById('eyeIcon');

  // Get the toggle password button
  const togglePasswordBtn = document.getElementById('togglePasswordBtn');

  // Function to toggle password visibility
  function togglePasswordVisibility() {
    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
      eyeIcon.classList.remove('fa-eye');
      eyeIcon.classList.add('fa-eye-slash');
    } else {
      passwordInput.type = 'password';
      eyeIcon.classList.remove('fa-eye-slash');
      eyeIcon.classList.add('fa-eye');
    }
  }

  // Add event listener to the toggle password button
  togglePasswordBtn.addEventListener('click', togglePasswordVisibility);
</script>

<script type="text/javascript">
  var loadingSpinner = document.getElementById('loading');
  $(document).ready(function() {
    loadingSpinner.style.display = 'none';
    window.onload = function(){
      loadingSpinner.style.cursor = 'default';
    };
  });
  function login(event) {
    const formData = new FormData($('#login')[0]);
    // Send AJAX request to your login endpoint
    $.ajax({
      type: "POST",
      url: "<?=BASEURL,$_GET[0],'/',$_GET[1],'/masuk'?>",
      data: formData,
      enctype: "multipart/form-data",
      processData: false,
      contentType: false,
      beforeSend:function(){
        loadingSpinner.style.display = 'block';
      },
      success: function(response) {
        if (response.h == true){
          Swal.fire({
            icon: 'success',
            title: 'Login Successful!',
            text: 'Welcome, ' + response.username + '!',
            showConfirmButton: false,
            timer: 1500
          }).then(() => {
              // Redirect to the dashboard or another page
            window.location.href = '<?=BASEURL?>' + response.i 
          });
        } else {
            // Login failed
          Swal.fire({
            icon: 'error',
            title: 'Login Failed',
            text: 'Invalid username or password.',
            showConfirmButton: false,
            timer: 1500
          });
        }
        loadingSpinner.style.display = 'none';
      },
      error: function() {
          // Error handling in case of AJAX failure
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'An error occurred. Please try again later.',
          showConfirmButton: false,
          timer: 1500
        });
        loadingSpinner.style.display = 'none';
      }
    });
  }
  function pilihrt(dari) {
    var selectedRw = dari.value;
    const formData = new FormData();
    formData.append('rw', selectedRw);    
    $.ajax({
      type: "POST",
      url: "<?=BASEURL,$_GET[0],'/proses/getRT'?>",
      data: formData,
      processData: false,
      contentType: false,
      beforeSend:function(){
        loadingSpinner.style.display = 'block';
      },
      success: function(response) {
        if (response.h === true) {
          $('#Irt').html(response.i);
        }else{
          $('#Irt').html(response.i);
          console.error('Gagal mendapatkan data RT.');
        }
        loadingSpinner.style.display = 'none';
      }, 
      error: function(xhr, status, error) {
        loadingSpinner.style.display = 'none';
        console.error('Terjadi kesalahan dalam permintaan AJAX:', error);
      }
    });
  }
  function kirimlaporanku(dari) {
    const formData = new FormData($('#laporankuuyy')[0]);
    if (formData.keys().next().done) {
      Swal.fire({
        icon: 'error',
        title: 'Form Kosong',
        text: 'Harap isi formulir sebelum mengirim.',
        showConfirmButton: true,
        timer: false
      });
    }else{
     $.ajax({
      type: "POST",
      url: "<?=BASEURL,$_GET[0],'/proses/kirimlaporan/'?>",
      data: formData,
      enctype: "multipart/form-data",
      processData: false,
      contentType: false,
      beforeSend:function(){
        loadingSpinner.style.display = 'block';
      },
      success: function(response) {
        if (response.h == true){
         Swal.fire({
          icon: 'success',
          title: 'No Pengaduan!',
          text: 'No,' + response.i + '!',
          showConfirmButton: true,
          timer: false
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = '<?=BASEURL,$_GET[0],'/',$_GET[1]?>';
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Harap untuk ambil No Pengaduan terlebih dahulu!',
              text: 'No,' + response.i + '!',
              showConfirmButton: true,
              timer: false
            }).then((innerResult) => {
              if (innerResult.isConfirmed) {
               window.location.href = '<?=BASEURL,$_GET[0],'/',$_GET[1]?>';
             }else{
              Swal.fire({
                icon: 'error',
                title: 'Harap untuk ambil No Pengaduan terlebih dahulu!',
                text: 'No,' + response.i + '!',
                showConfirmButton: false,
                timer: false
              })
            }
          });
          }
        });

      }else{
        Swal.fire({
          icon: 'error',
          title: 'Input Failed',
          text: 'error.',
          showConfirmButton: false,
          timer: 1500
        });
      }
      loadingSpinner.style.display = 'none';
    },
    error: function() {
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'An error occurred. Please try again later.',
        showConfirmButton: false,
        timer: 1500
      });
      loadingSpinner.style.display = 'none';
    }
  });
   }

 }
</script>




<!-- Mandatory init script -->
<!-- <script>
  if (document.getElementById("typed")) {
    var typed = new Typed("#typed", {
      stringsElement: "#typed-strings",
      typeSpeed: 70,
      backSpeed: 50,
      backDelay: 200,
      startDelay: 500,
      loop: true
    });
  }
</script> -->
</body>
</html>