<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="apple-touch-icon" sizes="76x76" href="<?=BASEURL?>assets/img/app.admin/apple-icon.png">
	<link rel="icon" type="image/png" href="<?=BASEURL?>assets/img/logo.png" width="30" height="30">
	<title>
		Aplikasi Lapor Keluhan Masyrakat Kelurahan Tanamodindi Kota Palu
	</title>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="<?=BASEURL?>assets/css/app.admin/nucleo-icons.css" rel="stylesheet" />
	<link href="<?=BASEURL?>assets/css/app.admin/nucleo-svg.css" rel="stylesheet" />
	<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
	<link href="<?=BASEURL?>assets/css/app.admin/nucleo-svg.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
	<link id="pagestyle" href="<?=BASEURL?>assets/css/app.admin/argon-dashboard.css" rel="stylesheet" />
	<script type="text/javascript" src="<?=BASEURL?>assets/js/jquery-3.7.0.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>	
	<style>
		.bell-animation {
			animation: bell-ring 0.5s linear infinite alternate;
		}

		@keyframes bell-ring {
			from {
				transform: translateY(0);
			}
			to {
				transform: translateY(-5px);
			}
		}
		.scrollable-container::-webkit-scrollbar {
			width: 0;
			background: transparent;
		}
		.scrollable-container {
			scrollbar-width: none;
			-ms-overflow-style: none;
		}
		.scrollable-container {
			scroll-behavior: smooth;
		}
		.loading-overlay {
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			z-index: 99999;
			display: none;
			justify-content: center;
			align-items: center;
			background-color: rgba(0, 0, 0, 0.5);
			backdrop-filter: blur(5px);
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
		.custom-spinner-image {
			width: 25px;
			height: 25px;
		}
	</style>
	<script>let intervalID; let jamdinding;</script>
</head>
<body class="g-sidenav-show   bg-gray-100">
	
	<div id="loading" class="loading-overlay">
		<div class="loading-content">
			<div class="spinner-border text-warning"  role="status">
				<img src="<?=BASEURL?>assets/img/app.admin/illustrations/rocket-white.png" alt="Loading..." class="custom-spinner-image">
				<!-- <img src="<?=BASEURL?>assets/img/logo.png" alt="Loading..." class="custom-spinner-image"> -->
				<!-- <span class="visually-hidden">Loading...</span> -->
			</div>
		</div>
	</div>
	<div class="min-height-300 bg-primary position-absolute w-100"></div>
	<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
		<div class="sidenav-header">
			<i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
			<a class="navbar-brand m-0" href="<?=BASEURL,$_GET[0],'/',$_GET[1]?>">
				<img src="<?=BASEURL?>assets/img/logo.png" class="navbar-brand-img h-100" alt="main_logo">
				<span class="ms-1 font-weight-bold">SISTEM SMART REPORT</span>
			</a>
		</div>
		<hr class="horizontal dark mt-0">
		<div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" href="<?=BASEURL,$_GET[0],'/',$_GET[1]?>/dasboard" >
						<div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
							<i class="ni ni-shop text-primary text-sm opacity-10"></i>
						</div>
						<span class="nav-link-text ms-1">Dashboard</span>
					</a>
				</li>
				<hr class="horizontal dark mt-0">
				<li class="nav-item">
					<a class="nav-link " href="<?=BASEURL,$_GET[0],'/',$_GET[1],'/pengaduan'?>"> 
						<div class="position-relative icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
							<i class="ni ni-single-copy-04 text-danger text-sm opacity-10"></i>
							<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
								<?=$data['jmpengaduan']?>
						</div>
						<span class="nav-link-text ms-1">Pengaduan</span>
					</a>
				</li>
				<hr class="horizontal dark mt-0">
				<li class="nav-item">
					<a class="nav-link" href="<?=BASEURL,$_GET[0],'/',$_GET[1],'/pesan'?>"> 
						<div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
							<i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
						</div>
						<span class="nav-link-text ms-1">Pesan</span>
					</a>
				</li>
				<hr class="horizontal dark mt-0">
			</ul>
		</div>
		<div class="sidenav-footer mx-3 ">
			<div class="card card-plain shadow-none" id="sidenavCard">
				<!-- <img class="w-50 mx-auto" src="<?=BASEURL?>assets/img/logo.png" alt="sidebar_illustration"> -->
				<div class="card-body text-center p-3 w-100 pt-0">
					<div class="docs-info">
						<!-- <h6 class="mb-0">Need help?</h6> -->
						<!-- <p class="text-xs font-weight-bold mb-0">Kelurahan Tanamodindi</p> -->
					</div>
				</div>
			</div>
			<a href="<?=BASEURL?>app.main/main/logout" class="btn btn-dark btn-sm w-100 mb-3">Logout</a>
		</div>
	</aside>
	<main class="main-content position-relative border-radius-lg " >
		<!-- Navbar -->
		<nav  class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="false">
			<div class="container-fluid py-1 px-3">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
						<li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
						<li class="breadcrumb-item text-sm text-white active" aria-current="page"><?=$_GET[1],'-',$_SESSION['rwku'],'-',$_SESSION['rtku']?></li>
					</ol>
				</nav>
				<div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
					<div class="ms-md-auto pe-md-3 d-flex align-items-center">
						<div class="input-group">
							<!-- <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
								<input type="text" class="form-control" placeholder="Type here..."> -->
							</div>
						</div>
						<ul class="navbar-nav  justify-content-end">
							<li class="nav-item d-flex align-items-center">
								<a href="javascript:void(0)" class="nav-link text-white font-weight-bold px-0">
									<i class=" fa fa-user me-sm-1"></i>
									<span class="d-sm-inline d-none"><?=$_SESSION['nama'] ?></span>
								</a>
							</li>
							<li class="nav-item d-xl-none ps-3 d-flex align-items-center">
								<a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
									<div class="sidenav-toggler-inner">
										<i class="sidenav-toggler-line bg-white"></i>
										<i class="sidenav-toggler-line bg-white"></i>
										<i class="sidenav-toggler-line bg-white"></i>
									</div>
								</a>
							</li>

							

							<li class="nav-item px-3 d-flex align-items-center">
								<a href="javascript:;" class="nav-link text-white p-0">
									<i class=" fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
								</a>
							</li>
							<li class="nav-item dropdown  d-flex align-items-center" style="padding-right: 0.9rem !important;">
								<a href="javascript:void(0)" id="fullscreenButton" class="nav-link text-white p-0">
									<i class=" fa fa-expand fixed-plugin-button-nav cursor-pointer"></i>
								</a>
							</li>
							<li id="notification-dropdown" class="nav-item dropdown pe-2 d-flex align-items-center ">
								<a href="javascript:;" class="nav-link text-white p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
									<i id="bell-icon" class="fa fa-bell cursor-pointer"></i>
								</a>
								<ul class=" scrollable-container dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton" style="max-height: 200px; overflow-y: auto;">
									<p class="text-xs text-secondary mb-0" style="text-align:center;">NOTIFIKASI</p>
									<hr class="horizontal dark mt-0">
									<?php while ($ku = $data['notif']->fetch_assoc()){ ?>								
										<li class="mb-2" id="berentijo">
											<a class="dropdown-item border-radius-md"  href="/<?=$_GET[0],'/',$_GET[1],'/pengaduan'?>">
												<div class="d-flex py-1">
													<div class="my-auto">
														<img src="<?=BASEURL?>assets/img/app.admin/team-2.jpg" class="avatar avatar-sm  me-3 ">
													</div>
													<div class="d-flex flex-column justify-content-center">
														<h6 class="text-sm font-weight-normal mb-1">
															<span class="font-weight-bold">pengaduan</span> dari <?=$ku['nama_pg']?>
														</h6>
														<p class="text-xs text-secondary mb-0">
															<i class="fa fa-clock me-1"></i>
															<?=$ku['tgl_pg']?>
														</p>
													</div>
												</div>
											</a>
										</li>
									<?php } ?>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</nav>
			<!-- End Navbar -->
			<div class="container-fluid py-4">
				<div class="scrollable-container" id="main-content" style="max-height: 500px; overflow-y: auto;">
					#template('content')


				</div>
			</div>
			<footer class="footer pt-3  ">
				<div class="container-fluid">
					<div class="row align-items-center justify-content-lg-between">
						<div class="col-lg-6 mb-lg-0 mb-4">
							<div class="copyright text-center text-sm text-muted text-lg-start">
								© <script>
									document.write(new Date().getFullYear())
								</script>
								<!-- made with <i class="fa fa-heart"></i> by -->
								<a href="#" class="font-weight-bold" target="_blank"></a>
								Sistem Aplikasi Smart Report.
							</div>
						</div>
						<div class="col-lg-6">
							<ul class="nav nav-footer justify-content-center justify-content-lg-end">
								<li class="nav-item">
									<a href="#" class="nav-link text-muted" target="_blank">Aliens Tim</a>
								</li>
								<li class="nav-item">
									<a href="#" class="nav-link text-muted" target="_blank">About Us</a>
								</li>
							<!-- <li class="nav-item">
								<a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a>
							</li> -->
							<li class="nav-item">
								<a href="#" class="nav-link pe-0 text-muted" target="_blank">License</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</footer>
	</main>
	<div class="fixed-plugin">
		<a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
			<i class="fa fa-cog py-2"> </i>
		</a>
		<div class="card shadow-lg">
			<div class="card-header pb-0 pt-3 ">
				<div class="float-start">
					<h5 class="mt-3 mb-0">AliensGroup</h5>
					<p>dashboard options.</p>
				</div>
				<div class="float-end mt-4">
					<button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
						<i class="fa fa-close"></i>
					</button>
				</div>
				<!-- End Toggle Button -->
			</div>
			<hr class="horizontal dark my-1">
			<div class="card-body pt-sm-3 pt-0 overflow-auto">
				<!-- Sidebar Backgrounds -->
				<div>
					<h6 class="mb-0">Warna Menu Link Aktif</h6>
				</div>
				<a href="javascript:void(0)" class="switch-trigger background-color">
					<div class="badge-colors my-2 text-start">
						<span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
						<span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
						<span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
						<span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
						<span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
						<span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
					</div>
				</a>
				<!-- Sidenav Type -->
				<div class="mt-3">
					<h6 class="mb-1">Warna Menu</h6>
				</div>
				<div class="d-flex">
					<button class="btn bg-gradient-primary w-100 px-3 mb-2 active me-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
					<button class="btn bg-gradient-primary w-100 px-3 mb-2" data-class="bg-default" onclick="sidebarType(this)">Dark</button>
				</div>
				<hr class="horizontal dark my-sm-4">
				<!-- <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p> -->
				<!-- Navbar Fixed -->
				<!-- <div class="d-flex my-3">
					<h6 class="mb-0">Navbar Fixed</h6>
					<div class="form-check form-switch ps-0 ms-auto my-auto">
						<input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
					</div>
				</div> -->
				<div class="mt-3">
					<h6 class="mb-1">Warna Web</h6>
				</div>
				<div class="mt-2 mb-5 d-flex">
					<h6 class="mb-0">Light / Dark</h6>
					<div class="form-check form-switch ps-0 ms-auto my-auto">
						<input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
					</div>
				</div>
				<hr class="horizontal dark my-sm-4">
			</div>
		</div>
	</div>
	<!--   Core JS Files   -->
	<script src="https://cdn.jsdelivr.net/npm/page/page.js"></script>
	<script src="<?=BASEURL?>assets/js/app.admin/core/bootstrap.bundle.min.js"></script>
	<script src="<?=BASEURL?>assets/js/app.admin/core/popper.min.js"></script>
	<script src="<?=BASEURL?>assets/js/app.admin/plugins/perfect-scrollbar.min.js"></script>
	<script src="<?=BASEURL?>assets/js/app.admin/plugins/smooth-scrollbar.min.js"></script>
	<script src="<?=BASEURL?>assets/js/app.admin/plugins/chartjs.min.js"></script>

	

	<!-- Github buttons -->
	<script async defer src="https://buttons.github.io/buttons.js"></script>
	<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
	<script src="<?=BASEURL?>assets/js/app.admin/argon-dashboard.min.js"></script>

	<script type="text/javascript">
		var navLinks = document.querySelectorAll(".nav-link");
		var BASEURL = "<?=BASEURL?>";
		var pageParam1 = "<?= $_GET[0] ?>";
		var pageParam2 = "<?= $_GET[1] ?>";
		var loadingSpinner = document.getElementById('loading');
		function getIdFromUrl() {
			const urlParts = window.location.pathname.split('/');
			const idIndex = urlParts.indexOf('detail') + 1;
			if (idIndex > 0 && idIndex < urlParts.length) {
				return urlParts[idIndex];
			}
			return null;
		}
		var id = getIdFromUrl();
		function loadContent(url, callback) {
			if (intervalID) {
				clearInterval(intervalID);
			}
			if (jamdinding) {
				clearInterval(jamdinding);
			}
			var xhr = new XMLHttpRequest();
			xhr.onreadystatechange = function () {
				loadingSpinner.style.display = 'none';
				if (xhr.readyState === 4 && xhr.status === 200) {
					callback(xhr.responseText);
					navLinks.forEach(function (link) {
						var href = link.getAttribute("href");
						if (window.location.pathname === href) {
							link.classList.add("active");
						} else {
							link.classList.remove("active");
						}
					});
				}else if (xhr.status === 404) {
					loadContent(BASEURL + pageParam1 + '/' + pageParam2 + '/dasboard', function (content) {
						document.getElementById('main-content').innerHTML = content;
					});
				}
			};
			xhr.open('GET', url, true);
			loadingSpinner.style.display = 'block';
			xhr.send();
		}



		function getIdFromLink(link) {
			var id = link.getAttribute("idkucuy");
			return id;
		}



		function home() {
			loadContent(BASEURL + pageParam1 + '/' + pageParam2 + '/dasboard', function (content) {
				document.getElementById('main-content').innerHTML = content;
			});
		}

		function pegaduan() {
			loadContent(BASEURL + pageParam1 + '/' + pageParam2 + '/Pengaduan', function (content) {
				document.getElementById('main-content').innerHTML = content;
			});
		}

		function user() {
			loadContent(BASEURL + pageParam1 + '/' + pageParam2 + '/Userp', function (content) {
				document.getElementById('main-content').innerHTML = content;
			});
		}

		function pesan() {
			loadContent(BASEURL + pageParam1 + '/' + pageParam2 + '/pesan', function (content) {
				document.getElementById('main-content').innerHTML = content;
			});
		}


		function Detailuser() {
			var id = getIdFromLink(event.target);
			loadContent(BASEURL + pageParam1 + '/' + pageParam2 + '/detail/' + id, function (content) {
				document.getElementById('main-content').innerHTML = content;
			});
		}
		function repson() {
			var id = getIdFromLink(event.target);
			loadContent(BASEURL + pageParam1 + '/' + pageParam2 + '/respon/' + id, function (content) {
				document.getElementById('main-content').innerHTML = content;

			});
		}

		page('/:pageParam1/:pageParam2/main', home);
		page('/:pageParam1/:pageParam2/main/dasboard', home);
		page('/:pageParam1/:pageParam2/main/pengaduan', pegaduan);
		page('/:pageParam1/:pageParam2/main/pesan', pesan);
		page('/:pageParam1/:pageParam2/main/user', user);
		page('/:pageParam1/:pageParam2/main/detail/:id', Detailuser);
		page('/:pageParam1/:pageParam2/main/respon/:id', repson);
		page();

		

	</script>


	<script>
		var win = navigator.platform.indexOf('Win') > -1;
		if (win && document.querySelector('#sidenav-scrollbar')) {
			var options = {
				damping: '0.5'
			}
			Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
		}
	</script>

	<script>
		document.addEventListener('DOMContentLoaded', function() {
			const bellIcon = document.getElementById('bell-icon');
			const berentijo = document.getElementById('berentijo');
			const notificationDropdown = document.getElementById('notification-dropdown');

			function activateBellAnimation() {
				bellIcon.classList.add('bell-animation');
			}

			function deactivateBellAnimation() {
				bellIcon.classList.remove('bell-animation');
			}

			notificationDropdown.addEventListener('mouseenter', activateBellAnimation);

			bellIcon.addEventListener('click', () => {
				deactivateBellAnimation();
			});

			berentijo.addEventListener('click', () => {
				deactivateBellAnimation();
			});

			function stopAnimationAfterDelay(delay) {
				setTimeout(() => {
					deactivateBellAnimation();
				}, delay);
			}
      		stopAnimationAfterDelay(5000); // Menghentikan animasi setelah 5 detik
      	});


      </script>
      <script>
      	const fullscreenButton = document.getElementById('fullscreenButton');

      	fullscreenButton.addEventListener('click', () => {
      		toggleFullscreen();
      	});

      	function toggleFullscreen() {
      		if (document.fullscreenElement) {
      			exitFullscreen();
      		} else {
      			enterFullscreen();
      		}
      	}

      	function enterFullscreen() {
      		const element = document.documentElement;

      		if (element.requestFullscreen) {
      			element.requestFullscreen();
      		} else if (element.mozRequestFullScreen) {
      			element.mozRequestFullScreen();
      		} else if (element.webkitRequestFullscreen) {
      			element.webkitRequestFullscreen();
      		} else if (element.msRequestFullscreen) {
      			element.msRequestFullscreen();
      		}
      	}

      	function exitFullscreen() {
      		if (document.exitFullscreen) {
      			document.exitFullscreen();
      		} else if (document.mozCancelFullScreen) {
      			document.mozCancelFullScreen();
      		} else if (document.webkitExitFullscreen) {
      			document.webkitExitFullscreen();
      		} else if (document.msExitFullscreen) {
      			document.msExitFullscreen();
      		}
      	}
      </script>

  </body>
  </html>