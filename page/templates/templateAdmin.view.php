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
	<script type="text/javascript" src="<?=BASEURL?>assets/js/jquery-3.7.0.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="<?=BASEURL?>assets/css/app.admin/nucleo-icons.css" rel="stylesheet" />
	<link href="<?=BASEURL?>assets/css/app.admin/nucleo-svg.css" rel="stylesheet" />
	<link href="<?=BASEURL?>assets/css/fontawesome.6.3.0.css" rel="stylesheet" />
	<link href="<?=BASEURL?>assets/css/app.admin/nucleo-svg.css" rel="stylesheet" />
	<link id="pagestyle" href="<?=BASEURL?>assets/css/app.admin/argon-dashboard.css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="<?=BASEURL?>assets/css/animate.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?=BASEURL?>assets/css/swal.css">
	<script src="<?=BASEURL?>assets/js/sweetalert2.all.min.js"></script>
	<style>
		/* Hide the scrollbar for the container */
		.scrollable-container::-webkit-scrollbar {
			width: 0;
			background: transparent; /* Optional: Set the scrollbar track background color */
		}

		.scrollable-container {
			scrollbar-width: none; /* For Firefox */
			-ms-overflow-style: none; /* For Internet Explorer and Edge */
		}

		/* Smooth scroll animation */
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
	<script>let intervalID;</script>
</head>


<body class="g-sidenav-show   bg-gray-100">
	
	<!-- Tambahkan elemen loading di dalam konten -->
	<div id="loading" class="loading-overlay" >
		<div class="loading-content">
			<div class="spinner-border text-warning" role="status">
				<span class="visually-hidden">Loading...</span>
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
					<a class="nav-link" href="<?=BASEURL,$_GET[0],'/',$_GET[1]?>/datarw" >
						<div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
							<i class="ni ni-ungroup text-warning text-sm opacity-10"></i>
						</div>
						<span class="nav-link-text ms-1">Data rw</span>
					</a>
				</li>
				<hr class="horizontal dark mt-0">
				<li class="nav-item">
					<a class="nav-link" href="<?=BASEURL,$_GET[0],'/',$_GET[1],'/pengaduan'?>"> 
						<div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
							<i class="ni ni-single-copy-04 text-danger text-sm opacity-10"></i>
						</div>
						<span class="nav-link-text ms-1">Pengaduan</span>
					</a>
				</li>
				<hr class="horizontal dark mt-0">
				<li class="nav-item">
					<a class="nav-link" href="<?=BASEURL,$_GET[0],'/',$_GET[1],'/kategori'?>"> 
						<div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
							<i class="ni ni-ungroup text-warning text-sm opacity-10"></i>
						</div>
						<span class="nav-link-text ms-1">Kategori Pengaduan</span>
					</a>
				</li>
				<hr class="horizontal dark mt-0">
				<li class="nav-item">
					<a class="nav-link " href="<?=BASEURL,$_GET[0],'/',$_GET[1],'/user'?>">
						<div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
							<i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
						</div>
						<span class="nav-link-text ms-1">Petugas</span>
					</a>
				</li>
				<hr class="horizontal dark mt-0">
			</ul>
		</div>
		<div class="sidenav-footer mx-3 ">
			<div class="card card-plain shadow-none" id="sidenavCard">
				<div class="card-body text-center p-3 w-100 pt-0">
					<div class="docs-info">
					</div>
				</div>
			</div>
			<a href="javascript:void(0)" class="btn btn-dark btn-sm w-100 mb-3"><?=$_SESSION['nama']?></a>
		</div>
	</aside>
	<main class="main-content position-relative border-radius-lg " >
		<nav  class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="false">
			<div class="container-fluid py-1 px-3">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
						<li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
						<li class="breadcrumb-item text-sm text-white active" aria-current="page"><?=$_GET[1]?></li>
					</ol>
				</nav>
				<div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
					<div class="ms-md-auto pe-md-3 d-flex align-items-center">
						<div class="input-group">
						</div>
					</div>
					<ul class="navbar-nav  justify-content-end">
						<li class="nav-item d-flex align-items-center">
							<a href="<?=BASEURL,'app.main/main/logout'?>" class="nav-link text-white font-weight-bold px-0">
								<i class="fa fa-user me-sm-1"></i>
								<span class="d-sm-inline d-none">Logout</span>
							</a>
						</li>
						<!-- <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
							<a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
								<div class="sidenav-toggler-inner">
									<i class="sidenav-toggler-line bg-white"></i>
									<i class="sidenav-toggler-line bg-white"></i>
									<i class="sidenav-toggler-line bg-white"></i>
								</div>
							</a>
						</li> -->
						<!-- <li class="nav-item px-3 d-flex align-items-center">
							<a href="javascript:;" onclick="bukapengaturan(this)" class="nav-link text-white p-0">
								<i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
							</a>
						</li> -->
						<!-- <li class="nav-item dropdown pe-2 d-flex align-items-center">
							<a href="javascript:;" class="nav-link text-white p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
								<i class="fa fa-bell cursor-pointer"></i>
							</a>
							<ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
								<li class="mb-2">
									<a class="dropdown-item border-radius-md" href="javascript:;">
										<div class="d-flex py-1">
											<div class="my-auto">
												<img src="<?=BASEURL?>assets/img/app.admin/team-2.jpg" class="avatar avatar-sm  me-3 ">
											</div>
											<div class="d-flex flex-column justify-content-center">
												<h6 class="text-sm font-weight-normal mb-1">
													<span class="font-weight-bold">New message</span> from Laur
												</h6>
												<p class="text-xs text-secondary mb-0">
													<i class="fa fa-clock me-1"></i>
													13 minutes ago
												</p>
											</div>
										</div>
									</a>
								</li>
								<li class="mb-2">
									<a class="dropdown-item border-radius-md" href="javascript:;">
										<div class="d-flex py-1">
											<div class="my-auto">
												<img src="<?=BASEURL?>assets/img/app.admin/small-logos/logo-spotify.svg" class="avatar avatar-sm bg-gradient-dark  me-3 ">
											</div>
											<div class="d-flex flex-column justify-content-center">
												<h6 class="text-sm font-weight-normal mb-1">
													<span class="font-weight-bold">New album</span> by Travis Scott
												</h6>
												<p class="text-xs text-secondary mb-0">
													<i class="fa fa-clock me-1"></i>
													1 day
												</p>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a class="dropdown-item border-radius-md" href="javascript:;">
										<div class="d-flex py-1">
											<div class="avatar avatar-sm bg-gradient-secondary  me-3  my-auto">
												<svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
													<title>credit-card</title>
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														<g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF" fill-rule="nonzero">
															<g transform="translate(1716.000000, 291.000000)">
																<g transform="translate(453.000000, 454.000000)">
																	<path class="color-background" d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z" opacity="0.593633743"></path>
																	<path class="color-background" d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z"></path>
																</g>
															</g>
														</g>
													</g>
												</svg>
											</div>
											<div class="d-flex flex-column justify-content-center">
												<h6 class="text-sm font-weight-normal mb-1">
													Payment successfully completed
												</h6>
												<p class="text-xs text-secondary mb-0">
													<i class="fa fa-clock me-1"></i>
													2 days
												</p>
											</div>
										</div>
									</a>
								</li>
							</ul>
						</li> -->
					</ul>
				</div>
			</div>
		</nav>
		<!-- End Navbar -->
		<div class="container-fluid py-4">
			<div class="scrollable-container" id="main-contents" style="max-height: 500px; overflow-y: auto;">
				<?php include 'page/view.admin/main.php'; ?>
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
							</script>,made with by 
							<!-- made with <i class="fa fa-heart"></i> by -->
							<a href="#" class="font-weight-bold" target="_blank">Aliens Tim</a>
							Devops By Selfiola Gila.
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
					<h5 class="mt-3 mb-0">Argon Configurator</h5>
					<p>See our dashboard options.</p>
				</div>
				<div class="float-end mt-4">
					<button class="btn btn-link text-dark p-0 fixed-plugin-close-button" onclick="pengaturan(this)">
						<i class="fa fa-close"></i>
					</button>
				</div>
				<!-- End Toggle Button -->
			</div>
			<hr class="horizontal dark my-1">
			<div class="card-body pt-sm-3 pt-0 overflow-auto">
				<!-- Sidebar Backgrounds -->
				<div>
					<h6 class="mb-0">Sidebar Colors</h6>
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
					<h6 class="mb-0">Sidenav Type</h6>
					<p class="text-sm">Choose between 2 different sidenav types.</p>
				</div>
				<div class="d-flex">
					<button class="btn bg-gradient-primary w-100 px-3 mb-2 active me-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
					<button class="btn bg-gradient-primary w-100 px-3 mb-2" data-class="bg-default" onclick="sidebarType(this)">Dark</button>
				</div>
				<p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
				<!-- Navbar Fixed -->
				<div class="d-flex my-3">
					<h6 class="mb-0">Navbar Fixed</h6>
					<div class="form-check form-switch ps-0 ms-auto my-auto">
						<input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
					</div>
				</div>
				<hr class="horizontal dark my-sm-4">
				<div class="mt-2 mb-5 d-flex">
					<h6 class="mb-0">Light / Dark</h6>
					<div class="form-check form-switch ps-0 ms-auto my-auto">
						<input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
					</div>
				</div>
				<a class="btn bg-gradient-dark w-100" href="https://www.creative-tim.com/product/argon-dashboard">Free Download</a>
				<a class="btn btn-outline-dark w-100" href="https://www.creative-tim.com/learning-lab/bootstrap/license/argon-dashboard">View documentation</a>
				<div class="w-100 text-center">
					<a class="github-button" href="https://github.com/creativetimofficial/argon-dashboard" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star creativetimofficial/argon-dashboard on GitHub">Star</a>
					<h6 class="mt-3">Thank you for sharing!</h6>
					<a href="https://twitter.com/intent/tweet?text=Check%20Argon%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fargon-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
						<i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
					</a>
					<a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/argon-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
						<i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
					</a>
				</div>
			</div>
		</div>
	</div>
	<!--   Core JS Files   -->
	<script src="<?=BASEURL?>assets/js/app.admin/page.js"></script>
	<script src="<?=BASEURL?>assets/js/app.admin/core/bootstrap.bundle.min.js"></script>
	<script src="<?=BASEURL?>assets/js/app.admin/core/popper.min.js"></script>
	<script src="<?=BASEURL?>assets/js/app.admin/plugins/perfect-scrollbar.min.js"></script>
	<script src="<?=BASEURL?>assets/js/app.admin/plugins/smooth-scrollbar.min.js"></script>
	<script src="<?=BASEURL?>assets/js/app.admin/plugins/chartjs.min.js"></script>
	<script src="https://cdn.datatables.net/v/dt/dt-1.13.6/datatables.min.js"></script>



	<!-- Github buttons -->
	<script async defer src="<?=BASEURL?>assets/js/app.admin/buttons.js"></script>
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
			// var scriptSources = [
			// 	'assets/js/jquery-3.7.0.min.js',
			// 	];
			// scriptSources.forEach(function(src) {
			// 	var existingScripts = document.querySelectorAll('script[src="'+BASEURL + src + '"]');
			// 	existingScripts.forEach(function(script) {
			// 		script.parentNode.removeChild(script);
			// 	});
			// });
			// scriptSources.forEach(function(scriptSrc) {
			// 	var script = document.createElement('script');
			// 	script.src = BASEURL + scriptSrc;
			// 	document.head.appendChild(script);
			// });
			loadingSpinner.style.display = 'none';
			var xhr = new XMLHttpRequest();
			xhr.onreadystatechange = function () {
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
				document.querySelector('html').innerHTML = content;
			});
		}
		function datarw() {
			loadContent(BASEURL + pageParam1 + '/' + pageParam2 + '/datarw', function (content) {
				document.querySelector('html').innerHTML = content;
			});
		}
		function pegaduan() {
			loadContent(BASEURL + pageParam1 + '/' + pageParam2 + '/Pengaduan', function (content) {
				document.querySelector('html').innerHTML = content;
			});
		}
		function user() {
			loadContent(BASEURL + pageParam1 + '/' + pageParam2 + '/Userp', function (content) {
				document.querySelector('html').innerHTML = content;
			});
		}
		function kategori() {
			loadContent(BASEURL + pageParam1 + '/' + pageParam2 + '/kategori', function (content) {
				document.querySelector('html').innerHTML = content;
			});
		}
		function Detailuser() {
			var id = getIdFromLink(event.target);
			loadContent(BASEURL + pageParam1 + '/' + pageParam2 + '/detail/' + id, function (content) {
				document.querySelector('html').innerHTML = content;
			});
		}
		page('/:pageParam1/:pageParam2/main', home);
		page('/:pageParam1/:pageParam2/main/dasboard', home);
		page('/:pageParam1/:pageParam2/main/datarw', datarw);
		page('/:pageParam1/:pageParam2/main/pengaduan', pegaduan);
		page('/:pageParam1/:pageParam2/main/kategori', kategori);
		page('/:pageParam1/:pageParam2/main/user', user);
		page('/:pageParam1/:pageParam2/main/kategori', kategori);
		page('/:pageParam1/:pageParam2/main/detail/:id', Detailuser);
		var options = {
			click: true,
			popstate: true,
			dispatch: true,
			hashbang: true,
			decodeURLComponents: true
		};

		page(options);
		page();
	</script>


	<script>
		var fixedPluginButtonNav = document.querySelector('.fixed-plugin');
		function bukapengaturan(dari){
			fixedPluginButtonNav.classList.add('show');
		}
		function tutuppengaturan(argument) {
			fixedPluginButtonNav.classList.add('hide');
		}

		var win = navigator.platform.indexOf('Win') > -1;
		if (win && document.querySelector('#sidenav-scrollbar')) {
			var options = {
				damping: '0.5'
			}
			Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
		}
	</script>



</body>

</html>