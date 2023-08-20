<?php $a = $data->fetch_assoc(); ?>
<div class="row" id="pesankucuy">
	<div class="col-md-8">
		<div class="card">
			<div class="card-header pb-0">
				<div class="d-flex align-items-center">
					<!-- <p class="mb-0">Edit Profile</p> -->
					<a class="btn btn-primary btn-sm ms-auto" href="/<?='project_pengaduan/',$_GET[0],'/',$_GET[1],'/user'?>">Kembali</a>
					<div id="buttonContainer">
						<button class="btn btn-warning btn-sm ms-1"  onclick="edit(this)">Settings</button>
					</div>
				</div>
			</div>
			<div class="card-body">
				<p class="text-uppercase text-sm">User Information</p>
				<form id="editkucy" onsubmit="return false">
					<div class="row">
						<div class="col-md-6">
							<input class="form-control" name="idupdatecuy" value="<?=$a['id']?>" hidden>
							<div class="form-group">
								<label for="example-text-input" class="form-control-label">Username</label>
								<input class="form-control" type="text" name="nama" id="nama" value="<?=$a['nama']?>" readonly style="background-color: white;cursor: no-drop;">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="example-text-input" class="form-control-label">Jabatan</label>
								<input class="form-control" type="text" name="jabatan" id="jabatan" value="<?=$a['jabatan']?>" readonly style="background-color: white;cursor: no-drop;">
							</div>
						</div>
						<?php if (empty($a['dt_rt'])) { ?>
							<div class="col-md-12">
								<div class="form-group">
									<label for="example-text-input" class="form-control-label">Rw</label>
									<select class="form-control" bersih="itu" type="text" name="rw" id="rw"  style="background-color: white;cursor: no-drop;">
										<option selected><?=$a['dt_rw']?></option>
									</select>
								</div>
							</div>
						<?php }else{ ?> 
							<div class="col-md-6">
								<div class="form-group">
									<label for="example-text-input" class="form-control-label">Rw</label>
									<select class="form-control" bersih="itu" onchange="getRT(this)"  name="rw" id="rw"  style="background-color: white;cursor: no-drop;">
										<option selected><?=$a['dt_rw']?></option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="example-text-input" class="form-control-label">Rt</label>
									<select class="form-control" bersih="itu" name="rtkucuy" id="rtkucuy" style="background-color: white;cursor: no-drop;">
										<option selected><?=$a['dt_rt']?></option>
									</select>
								</div>
							</div>
						<?php } ?>
					</div>
				</form>
				<hr class="horizontal dark">
				<!-- <p class="text-uppercase text-sm">Contact Information</p>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="example-text-input" class="form-control-label">Alamat</label>
							<input class="form-control" type="text" value="Jln Dewi Sarika 3, nr. 8 Bl 1, Sc 1, Ap 09" onfocus="focused(this)" onfocusout="defocused(this)">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="example-text-input" class="form-control-label">Kota</label>
							<input class="form-control" type="text" value="Palu" onfocus="focused(this)" onfocusout="defocused(this)">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="example-text-input" class="form-control-label">Negara</label>
							<input class="form-control" type="text" value="Indonesia" onfocus="focused(this)" onfocusout="defocused(this)">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="example-text-input" class="form-control-label">Code pos</label>
							<input class="form-control" type="text" value="437300" onfocus="focused(this)" onfocusout="defocused(this)">
						</div>
					</div>
				</div> -->
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card card-profile">
			<img src="<?=BASEURL?>assets/img/app.admin/bg-profile.jpg" alt="Image placeholder" class="card-img-top">
			<div class="row justify-content-center">
				<div class="col-4 col-lg-4 order-lg-2">
					<div class="mt-n4 mt-lg-n6 mb-4 mb-lg-0">
						<a href="javascript:;">
							<img src="<?=BASEURL?>assets/img/app.admin/team-2.jpg" class="rounded-circle img-fluid border border-2 border-white">
						</a>
					</div>
				</div>
			</div>
			<div class="card-header text-center border-0 pt-0 pt-lg-2 pb-4 pb-lg-3">
				<div class="d-flex justify-content-between">
					<!-- <a href="javascript:;" class="btn btn-sm btn-info mb-0 d-none d-lg-block">Edit</a> -->
					<!-- <a href="javascript:;" class="btn btn-sm btn-info mb-0 d-block d-lg-none"><i class="ni ni-collection"></i></a> -->
					<a href="javascript:;" idkucuy="<?=$a['id']?>" namakucuy="<?=$a['nama']?>" onclick="getpesan(this)" class="btn btn-sm btn-dark float-right mb-0 d-none d-lg-block w-100">
						Kirim Pesan
					</a>
				</div>
			</div>
			<div class="card-body pt-0">
				<div class="row">
					<div class="col">
						<div class="d-flex justify-content-center">
							<div class="d-grid text-center">
								<span class="text-lg font-weight-bolder"><?=$a['dt_rw']?></span>
								<span class="text-sm opacity-8"><?=$a['jabatan']?></span>
							</div>
						</div>
					</div>
				</div>
				<div class="text-center mt-4">
					<div>
						<i class="ni education_hat mr-2"></i>Kelurahan Tanamodindi
					</div>
				</div>
			</div>
		</div>
	</div>
</div>