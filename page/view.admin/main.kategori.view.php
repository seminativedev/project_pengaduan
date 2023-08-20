<div class="modal fade animate__animated animate__zoomInUp " id="exampleModal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Rw & Rt</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="row g-3 needs-validation" onsubmit="return false" id="Itambahrw">
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-text" id="basic-addon1">Kategori</span>
            <input type="text" class="form-control" placeholder="Masukan Nama Kategori" name="kategori" id="kategori" aria-label="kategori" aria-describedby="basic-addon1">
          </div>
        </div>
      </form>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
      <button type="button" class="btn bg-gradient-primary" onclick="adddatarw(this)">Save changes</button>
    </div>
  </div>
</div>
</div>


<div class="row ">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0 p-3">
        <div class="row">
          <div class="col-6 d-flex align-items-center">
            <h6 class="mb-0">Daftar Tabel Kategori</h6>
          </div>
          <div class="col-6 text-end">
            <a class="btn bg-gradient-dark mb-0 animate__animated animate__heartBeat" href="javascript:;" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Tambah Baru</a>
          </div>
        </div>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kategori</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tgl Create</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Create By</th>
                <th class="text-secondary opacity-7"></th>
              </tr>
            </thead>
            <tbody>
              <?php $no=1; while ($a =$data->fetch_assoc()) { ?>
                <tr>
                  <td class="align-middle text-center text-sm">
                    <p class="text-xs font-weight-bold mb-0"><?=$no++?></p></td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?=$a['kategori']?></p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?=$a['tgl_create']?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="badge badge-sm bg-gradient-success"><?=$a['createby']?></span>
                    </td>
                    <td class="align-middle">

                      <button class="btn btn-icon-only shadow-none text-dark mb-0" type="button" data-bs-toggle="dropdown">
                        <i class="ni ni-settings"></i>
                      </button>
                      <ul class="dropdown-menu dropdown-menu-end me-sm-n2 p-2" aria-labelledby="chatmsg">
                        <li>
                          <a class="dropdown-item border-radius-md" href="javascript:;">
                            Edit
                          </a>
                        </li>
                        <li>
                          <a idkucuy="<?=$a['id']?>" class="dropdown-item border-radius-md text-danger" onclick="hapuscuykat(this)">
                            Delete
                          </a>
                        </li>
                      </ul>
                    </td>
                  </tr>
                <?php }  ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>


  <script type="text/javascript">
    function pendoc(argument) {
      console.log('dwa');
    }
  </script>