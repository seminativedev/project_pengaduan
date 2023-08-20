

<header class="header-2">
	<div class="page-header section-height-75 relative"
	style="background-image: url('<?=BASEURL?>assets/img/office-dark.jpg');">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-6 col-sm-9 text-center mx-auto mb-4">
				<!-- <h2 class="text-white mb-3">Masukan nomor pengaduan</h2> -->
				<div class="row">
					<div class="col-md-8 col-7">
						<div class="input-group">
							<span class="input-group-text"><i class="fas fa-search" aria-hidden="true"></i></span>
							<input type="text" class="form-control" name="idcuy" id="idcuy" placeholder="Masukan Nomor Pengaduan" >
						</div>
					</div>
					<div class="col-md-4 col-5 text-start ps-0">
						<button type="button" class="btn bg-gradient-info w-100 mb-0 h-100" onclick="caridata(this)">Search</button>
					</div>
				</div>
			</div>
		</div>
	</div><!-- 
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
	</div> -->
</div>
</header>
<header id="isilaporan">
</header>


<script type="text/javascript">
	var loadingSpinner = document.getElementById('loading');
	function caridata(argument) {
		const idkucuy = document.getElementById('idcuy');
		const formdata = new FormData();
		formdata.append('idkucuy', idkucuy.value);
		$.ajax({
			type: "POST",
			url: "<?=BASEURL,$_GET[0],'/proses/getDatalaporan/'?>",
			data:formdata,
			enctype: "multipart/form-data",
			processData: false,
			contentType: false,
			beforeSend: function() {
				loadingSpinner.style.display = 'block';
			},
			success: function(hasil) {
				if (hasil.h === true) {
					$('#isilaporan').html(hasil.html);
					$(idkucuy).val('');
					pesan('success','No Pengaduan '+hasil.i+' Ditemukan');
				}else{
					$('#isilaporan').html('');
					pesan('error','No Pengaduan '+hasil.i+' Tidak Ditemukan');
				}
				loadingSpinner.style.display = 'none';
			},
			error: function() {
				loadingSpinner.style.display = 'none';
				pesan('error','Data Tidak Ditemukan');
			},complete: function(){
				loadingSpinner.style.display = 'none';				
			} 
		});
		console.log(formdata);
	}
	function forumchat(fungsi) {
		const idkucuyValue = fungsi.getAttribute("idkucuy");
		const isiquntul = document.getElementById('isilaporan');
		$.ajax({
			type: "POST",
			url: "<?=BASEURL,$_GET[0],'/main/respon/'?>"+idkucuyValue,
			beforeSend: function() {
				loadingSpinner.style.display = 'block';
			},
			success: function(hasil) {
				isiquntul.innerHTML = hasil;
				pesan('success','Berhasil Masuk Ke Forum Chat');
				loadingSpinner.style.display = 'none';
			},
			error: function() {
				loadingSpinner.style.display = 'none';
				pesan('error','Data Tidak Ditemukan');
			},complete: function(){
				loadingSpinner.style.display = 'none';				
			} 
		});
	}
	function getPesan(argument) {
		$.ajax({
			type: "POST",
			url: "<?=BASEURL,$_GET[0],'/proses/pesankuambejo/'?>"+idkucuyValue,
			beforeSend: function() {
				// loadingSpinner.style.display = 'block';
			},
			success: function(hasil) {
				isiquntul.innerHTML = hasil;
				// pesan('success','Berhasil Masuk Ke Forum Chat');
				// loadingSpinner.style.display = 'none';
			},
			error: function() {
				// loadingSpinner.style.display = 'none';
				// pesan('error','Data Tidak Ditemukan');
			},complete: function(){
				// loadingSpinner.style.display = 'none';				
			} 
		});
	}

	function lihatlaporan(fungsi) {
		Swal.fire({
			icon: 'info',
			title: 'Data Sedang Di Proses!',
			showClass: {
				popup: 'animate__animated animate__fadeInDown'
			},
			hideClass: {
				popup: 'animate__animated animate__fadeOutUp'
			}
		})
	}

	function pesan(pesan,status) {
		const Toast = Swal.mixin({
			toast: true,
			position: 'top-start',
			showConfirmButton: false,
			timer: 2000,
			timerProgressBar: true,
			didOpen: (toast) => {
				toast.addEventListener('mouseenter', Swal.stopTimer)
				toast.addEventListener('mouseleave', Swal.resumeTimer)
			}
		})

		Toast.fire({
			icon: pesan,
			title: status
		})
	}

	function kirimrespon(dari){
		var BASEURL = "<?=BASEURL?>";
		var pageParam1 = "<?= $_GET[0] ?>";
		var pageParam2 = "<?= $_GET[1] ?>";
		const formData = new FormData($('#isiresponku')[0]);
		$.ajax({
			type: "POST",
			url: "<?=BASEURL,$_GET[0],'/proses/kirimrespon/'?>",
			data: formData,
			enctype: "multipart/form-data",
			processData: false,
			contentType: false,
			beforeSend: function() {
				loadingSpinner.style.display = 'block';
			},
			success: function(hasil){
				if (hasil.h === true) {
					refresh(BASEURL + pageParam1 + '/' + pageParam2 + '/respon/' + hasil.idkucuy, function (content) {
						document.getElementById('isilaporan').innerHTML = content;
					});
				}else{
					console.error('gagal');
				}
				loadingSpinner.style.display = 'none';
			},
			error: function() {
				loadingSpinner.style.display = 'none';
			}, 
		});
	}


	function refresh(url, callback) {
		var xhr = new XMLHttpRequest();
		xhr.onreadystatechange = function () {
			// loadingSpinner.style.display = 'none';
			if (xhr.readyState === 4 && xhr.status === 200) {
				callback(xhr.responseText);
			}else if (xhr.status === 404) {
				console.log(url);
			}
		};
		xhr.open('GET', url, true);
		// loadingSpinner.style.display = 'block';
		xhr.send();
	}

	setInterval(refresh, 2000);

</script>