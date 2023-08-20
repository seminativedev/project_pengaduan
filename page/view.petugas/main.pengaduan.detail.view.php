<?php $a = $data->fetch_assoc(); ?>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header pb-0">
				<div class="d-flex align-items-center" id="isitombolKU">
					<!-- <p class="mb-0">Edit Profile</p> -->
					<?php if ($a['status'] === 'proses') { ?>
						<a class="btn btn-success btn-sm ms-auto" idkucuy="<?=$a['id']?>" href="/<?='project_pengaduan/',$_GET[0],'/',$_GET[1]?>/respon/<?=$a['id']?>">Forum Chat</a>
					<button class="btn btn-info btn-sm ms-1" href="javascript:void(0)">Sudah Respon</button>
					<?php }else{ ?>
					<button class="btn btn-primary btn-sm ms-auto" idkucuy="<?=$a['id']?>" onclick="pendo(this)">Berikan Respon</button>
					<?php } ?>
				</div>
			</div>
			<div class="card-body">
				<p class="text-uppercase text-sm">Information pengaduan</p>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="example-text-input" class="form-control-label">Nama Pengadu</label>
							<input class="form-control"  type="text" value="<?=$a['nama_pg']?>" readonly style="background-color: white;">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="example-text-input" class="form-control-label">No Pengaduan</label>
							<input class="form-control" type="email" value="<?=$a['id_pg']?>" readonly style="background-color: white;">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="example-text-input" class="form-control-label">Rw</label>
							<input class="form-control" type="text" value="<?=$a['rw']?>" readonly style="background-color: white;">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="example-text-input" class="form-control-label">Rt</label>
							<input class="form-control" type="text" value="<?=$a['rt']?>" readonly style="background-color: white;">
						</div>
					</div>
				</div>
				<hr class="horizontal dark">
				<!-- <p class="text-uppercase text-sm">Detail Isi Pengaduan</p> -->
				<div class="row">
					<div class="col-sm-7 mb-lg-0 mb-4">
						<div class="card z-index-2 h-100">
							<div class="card-header pb-0 pt-3 bg-transparent">
								<h6 class="text-capitalize">Detail Isi Pengaduan</h6>
								<p class="text-sm mb-0">
									<i class="fa fa-arrow-up text-success"></i>
									<span class="font-weight-bold"><?=$a['tgl_pg']?></span>
								</p>
							</div>
							<div class="card-body p-3">
								<div class="chart">
									<textarea class="form-control" readonly style="background-color:white;height: 253px;"><?=$a['isi']?></textarea>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-5">
						<div class="card card-carousel overflow-hidden h-100 p-0">
							<div id="carouselExampleCaptions" class="carousel slide h-100" data-bs-ride="carousel">
								<div class="carousel-inner border-radius-lg h-100">
									<div class="carousel-item h-100 active" style="background-image: url('<?=BASEURL?>assets/img/app.admin/carousel-1.jpg');
									background-size: cover;">
									<div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
										<div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
											<i class="ni ni-camera-compact text-dark opacity-10"></i>
										</div>
										<h5 class="text-white mb-1">Get started with Argon</h5>
										<p>There’s nothing I really wanted to do in life that I wasn’t able to get good at.</p>
									</div>
								</div>
								<div class="carousel-item h-100" style="background-image: url('<?=BASEURL?>assets/img/fotopengaduan/64cd4fb1f366a.jpeg');
								background-size: cover;">
								<div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
									<div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
										<i class="ni ni-bulb-61 text-dark opacity-10"></i>
									</div>
									<h5 class="text-white mb-1">Faster way to create web pages</h5>
									<p>That’s my skill. I’m not really specifically talented at anything except for the ability to learn.</p>
								</div>
							</div>
							<div class="carousel-item h-100" style="background-image: url('<?=BASEURL?>assets/img/app.admin/carousel-3.jpg');
							background-size: cover;">
							<div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
								<div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
									<i class="ni ni-trophy text-dark opacity-10"></i>
								</div>
								<h5 class="text-white mb-1">Share with us your design tips!</h5>
								<p>Don’t be afraid to be wrong because you can’t learn anything from a compliment.</p>
							</div>
						</div>
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
</div>
</div>
</div>
</div>