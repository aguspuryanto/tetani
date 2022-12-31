<!-- partial -->
<div class="container-fluid mt-xl-50 mt-sm-30 mt-15 px-xxl-65 px-xl-20">
  <div class="card">
    <div class="card-body">
      <div>
        <a class="btn btn-info" href="<?= base_url(); ?>paket/addpaket"><i class="mdi mdi-plus-circle-outline"></i>Tambah</a>
      </div>
      <br>
      <?php if ($this->session->flashdata('demo') or $this->session->flashdata('hapus')) : ?>
        <div class="alert alert-danger" role="alert">
          <?php echo $this->session->flashdata('demo'); ?>
          <?php echo $this->session->flashdata('hapus'); ?>
        </div>
      <?php endif; ?>
      <?php if ($this->session->flashdata('ubah') or $this->session->flashdata('tambah')) : ?>
        <div class="alert alert-success" role="alert">
          <?php echo $this->session->flashdata('ubah'); ?>
          <?php echo $this->session->flashdata('tambah'); ?>
        </div>
      <?php endif; ?>
      <div class="row">
        <div class="col-12">
          <div class="table-responsive">
            <table id="mwtable" class="table table-striped table-hover dt-responsive display nowrap" data-info="false" cellspacing="0" width="100%">
              <thead>
              
                <tr>
                  <th>No</th>
                  <th>Ikon</th>
                  <th>Nama</th>
                  <th>Biaya</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                
              </thead>
              <tbody>
              <?php $i = 1;
                foreach ($paket as $pkt) { ?>
              <tr>
                <td><?= $i ?></td>
                <td> <img width="80" height="80" class="avatar-img rounded-circle" src="<?= base_url('images/package/') . $pkt['ikon']; ?>"></td>
                <td><?= $pkt['nama']; ?></td>
                <td><?= $pkt['harga']; ?></td>
                <td>
                    <?php if ($pkt['status'] == 1) { ?>
                    <label class="badge badge-success">Active</label>
                    <?php } else { ?>
                    <label class="badge badge-danger">Non Active</label>
                    <?php } ?>
                </td>
                <td>
                  <a href="<?= base_url(); ?>paket/editpaket/<?= $pkt['id']; ?>">
                        <button class="btn btn-outline-primary">Edit</button></a>
                      <a href="<?= base_url(); ?>paket/hapuspaket/<?= $pkt['id']; ?>" onclick="return confirm ('are you sure?')">
                        <button class="btn btn-outline-danger">Delete</button></a></td>
                </tr>
                <?php $i++;
                } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- content-wrapper ends -->