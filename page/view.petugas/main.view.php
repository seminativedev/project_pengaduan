<script type="text/javascript">
	var loadingSpinner = document.getElementById('loading');
	function ambilrespon(argument) {
		$.ajax({
			type: "POST",
			url: "<?=BASEURL,$_GET[0],'/proses/ambilrespon/'?>",
			beforeSend: function() {
				loadingSpinner.style.display = 'block';
			},
			success: function(hasil){
				$('#kautoh').html(hasil.html);
				loadingSpinner.style.display = 'none';
			},
			error: function() {
				loadingSpinner.style.display = 'none';
			}, 
		});
	}

	function kirimrespon(dari){
		const formData = new FormData($('#isiresponku')[0]);
		var id = getIdFromLink(event.target);
		const uciku = document.getElementById('ucisayang');
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
						document.getElementById('main-content').innerHTML = content;
					});
					uciku.value = '';
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

	function pendo(dari){
		const idkucuy = dari.getAttribute('idkucuy');
		Swal.fire({
			title: "Status Pengaduan Akan Berubah Menjadi 'PROSES'!",
			text: "Pastikan pengaduan telah mencapai tahap proses",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, proses data'
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					type: "POST",
					url: "<?=BASEURL,$_GET[0],'/proses/postfeedback/'?>",
					data: {
						idku: idkucuy
					},
					enctype: "multipart/form-data",
					beforeSend: function() {
						loadingSpinner.style.display = 'block';
					},
					success: function(hasil){
						if (hasil.h === true){
							Swal.fire(
								'success!',
								'Laporan Berhasil Di Respon',
								'success'
								)
						}else{
							Swal.fire(
								'Gagal!',
								'Laporan Gagal Di Respon',
								'error'
								)
						}
						loadingSpinner.style.display = 'none';
					},
					error: function() {
						loadingSpinner.style.display = 'none';
					}, 
				});
			}else{
				Swal.fire(
					'Gagal!',
					'Gagal Respon laporan',
					'warning'
					)
			}
		})
		
		console.log(idkucuy);
	}
	function refresh(url, callback) {
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
				console.log(url);
			}
		};
		xhr.open('GET', url, true);
		loadingSpinner.style.display = 'block';
		xhr.send();
	}
	function getUSER(dari) {
		if (intervalID) {
			clearInterval(intervalID);
		}
		const idkucuy = dari.getAttribute('idkucuy');
		const namakucuy = dari.getAttribute('namakucuy');
		const inputIDKUCUY = document.getElementById('idkucuypesan');
		const masoNAMA = document.getElementById('masoNAMA'),masoRW = document.getElementById('masoRW'),tempattulispesan=document.getElementById('tempattulispesan'),setinganku=document.getElementById('setinganku');
		$.ajax({
			type: "POST",
			url: "<?=BASEURL,$_GET[0],'/proses/getPESANUSER/'?>"+idkucuy,
			beforeSend: function() {
				loadingSpinner.style.display = 'block';
			},success: function(hasil){
				if(hasil.h === true){
					scrollToBottom();
					intervalID = setInterval(function () {
						getISIPESAN(idkucuy,namakucuy);
					}, 1000);
					masoNAMA.innerHTML = hasil.nama;
					masoRW.innerHTML = hasil.rw+'-'+hasil.rw;
					tempattulispesan.innerHTML = hasil.tulisjo;
					inputIDKUCUY.value = idkucuy;
					setinganku.innerHTML = hasil.setinganku;
				}else{
					masoRW.innerHTML = 'GAGAL MEMUAT USER';
				}
				loadingSpinner.style.display = 'none';
			},error: function(){
				console.log('ERROR');
				loadingSpinner.style.display = 'none';
			}
		});
	}
	function kirimpesankucuy(argument) {
		const uciku = document.getElementById('ucisayang');
		const formData = new FormData($('#isipesankucuy')[0]);
		$.ajax({
			type: "POST",
			url: "<?=BASEURL,$_GET[0],'/proses/kirimPESANKUCUY/'?>",
			data: formData,
			enctype: "multipart/form-data",
			processData: false,
			contentType: false,
			beforeSend:function(){

			},success:function(hasil){
				uciku.value='';
			},error:function(){

			}
		});
		console.log(formData);
	}
	function getISIPESAN(dari,dari1) {
		const tempatpesan = document.getElementById('tesrealtime');
		$.ajax({
			type: "POST",
			url: "<?=BASEURL,$_GET[0],'/proses/getisipesan/'?>"+dari+'/'+dari1,
			beforeSend:function(){
				
			},success:function(hasil){
				tempatpesan.innerHTML = hasil.h;
			},error:function(){

			}
		});	
	}
	function carigue(argument) {
		const isikontakchat = document.getElementById('isikontakchat');
		const isi = isikontakchat.getElementsByClassName('kontakuh');
		console.log(isi);
	}
	function scrollToBottom(argument) {
		const tempatpesan = document.getElementById("tesrealtime");
		tempatpesan.scrollTop = tempatpesan.scrollHeight;
		console.log(argument);
	}
	function hapuschat(chat) {
		const nama = chat.getAttribute('namakun');
		const namaUpperCase = nama.toUpperCase();
		Swal.fire({
			title: 'Yakin ingin menghapus chat ini?',
			html: "Pesan yang terkirim ke <strong style='color: red;''>" + namaUpperCase + "</strong> akan ikut terhapus!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, hapus pesan ini!',
			showClass: {
				popup: 'animate__animated animate__zoomInLeft'
			},
			hideClass: {
				popup: 'animate__animated animate__flipOutX'
			}
		}).then((result) => {
			if (result.isConfirmed) {
				Swal.fire(
					'Deleted!',
					'Your file has been deleted.',
					'success'
					)
			}
		})
	}

</script>

<script>
  // Fungsi untuk mendapatkan data cuaca dari API
  async function getWeather() {
    const apiKey = '7d16831f195b004e3ad5ee50fb66f8b6'; // Ganti dengan API key Anda
    const city = 'Palu'; // Nama kota
    
    try {
      const response = await fetch(`https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${apiKey}&units=metric`);
      const data = await response.json();
      
      // Ambil suhu dan ikon cuaca dari data cuaca
      const temperature = data.main.temp;
      const weatherIcon = data.weather[0].icon;

      // // Update tampilan informasi cuaca
      // document.getElementById('weather-info').textContent = `Kota ${city} - ${temperature}°C`;
      // document.getElementById('weather-icon').src = `http://openweathermap.org/img/w/${weatherIcon}.png`;
    } catch (error) {
      console.error('Error fetching weather data:', error);
    }
  }

  // Fungsi untuk mengupdate jam setiap detik
  function updateClock() {
    const currentTimeElement = document.getElementById('current-time');
    const now = new Date();
    const currentTime = now.toLocaleTimeString();
    currentTimeElement.textContent = currentTime;
  }

  // Panggil fungsi getWeather untuk mendapatkan dan menampilkan data cuaca
  getWeather();

 	 jamdinding = setInterval(updateClock, 1000);
</script>