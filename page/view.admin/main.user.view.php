
<div class="offcanvas offcanvas-end"  data-bs-backdrop="static" tabindex="-1" id="offcanvasCreate" aria-labelledby="offcanvasCreate">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasCreate">Pengurus Rw</h5>
    <button type="button" style="background-color: black;" id="closeOffcanvasBtn" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <form class="row g-3 needs-validation" onsubmit="return false" id="Itambah">
      <div class="md-3">
        <label for="validationCustom04" class="form-label">Pilih User</label>
        <select name="role" onchange="pilih_role(this)" class="form-select" id="validationCustom04" required>
          <option selected disabled>--Pilih User--</option>
          <option value="rw">Rw</option>
          <option value="rt">Rt</option>
        </select>
      </div>
      <div id="pilihanku"></div>      
       <!--  <div class="md-3">
          <label for="validationCustom04" class="form-label">Pilih Rw</label>
          <select name="rw" class="form-select" id="validationCustom04" required>
            <option selected disabled>--Pilih Rw--</option>
            <?php while ($a = $data['dtrw']->fetch_assoc()) { ?>
              <option><?=$a['rw']?></option>
            <?php } ?>
          </select>
        </div>

        <div class="md-3">
          <label for="validationCustom01" class="form-label">Nama</label>
          <input type="text" name="nama" class="form-control" placeholder="Masukan Nama Ketua Rw" id="validationCustom01"  required>
        </div>

        <div class="md-3">
          <label for="validationCustom04" class="form-label">Pilih Jabatan</label>
          <select name="jabatan" class="form-select" id="validationCustom04" required>
            <option selected disabled>--Pilih Jabatan--</option>
            <option >Ketua</option>
            <option >Sekertaris</option>
          </select>
        </div> -->

        <div class="col-12">
          <button class="btn btn-primary" onclick="adduserku(this)" type="button">Submit form</button>
        </div>
      </form>
    </div>
  </div>

  <div class="card-body p-3 animate__animated animate__zoomInUp ">
    <div class="row gx-4">
      <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
        <div class="nav-wrapper position-relative end-0">
          <!-- <a class="btn bg-gradient-dark mb-0 animate__animated animate__heartBeat"  data-bs-toggle="offcanvas" href="#offcanvasCreate" role="tab"><i class="fas fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Tambah Baru</a> -->
        </div>
      </div>
    </div>
  </div>

  <div class="tab-content animate__animated animate__zoomInUp" id="pesankucuy">
    <div class="tab-pane fade show active" id="app">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">

            <div class="card-header pb-0 p-3">
              <div class="row">
                <div class="col-6 d-flex align-items-center">
                  <h6 class="mb-0">Daftar Tabel User</h6>
                </div>
                <div class="col-6 text-end">
                   <a class="btn bg-gradient-dark mb-0 animate__animated animate__heartBeat"  data-bs-toggle="offcanvas" href="#offcanvasCreate" role="tab"><i class="fas fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Tambah Baru</a>
                </div>
              </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Author</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Fungsional</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Create Date</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while ($a = $data['dtuser']->fetch_assoc()) { ?>
                      <tr>
                        <td>
                          <div class="d-flex px-2 py-1">
                            <div>
                              <img src="<?=BASEURL?>assets/img/app.admin/team-2.jpg" class="avatar avatar-sm me-3" alt="user1">
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm"><?=$a['nama']?></h6>
                              <p class="text-xs text-secondary mb-0"><?=$a['role']?></p>
                            </div>
                          </div>
                        </td>
                        <td center>
                          <h6 class="mb-0 text-sm"><?=$a['jabatan']?></h6>
                          <!-- <p class="text-xs font-weight-bold mb-0"></p> -->
                          <p class="text-xs text-secondary mb-0"><?php echo empty($a['dt_rt']) ? $a['dt_rw'] : $a['dt_rw'] . '/' . $a['dt_rt'];?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                          <span class="badge badge-sm bg-gradient-success"><?=$a['status_login']?></span>
                        </td>

                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold"><?=$a['tlg_create']?></span>
                        </td>
                        <td class="align-middle ">
                          <button class="btn btn-icon-only shadow-none text-dark mb-0" type="button" data-bs-toggle="dropdown">
                            <i class="ni ni-settings"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end me-sm-n2 p-2" aria-labelledby="chatmsg">
                            <li>
                             <a idkucuy="<?=$a['id']?>" class="dropdown-item border-radius-md" href="/<?='project_pengaduan/',$_GET[0],'/',$_GET[1]?>/detail/<?=$a['id']?>">
                              Profile
                            </a>
                          </li>
                          <li>
                            <a class="dropdown-item border-radius-md" idkucuy="<?=$a['id']?>" namakucuy="<?=$a['nama']?>" href="javascript:;" onclick="getpesan(this)">
                              chat
                            </a>
                          </li>
                          <li>
                            <a idkucuy="<?=$a['id']?>" class="dropdown-item border-radius-md text-danger" onclick="hapuscuy(this)">
                              Delete user
                            </a>
                          </li>
                        </ul>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>


