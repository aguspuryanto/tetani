<div class="container-fluid mt-xl-50 mt-sm-30 mt-15 px-xxl-65 px-xl-20">
    <div class="row grid-margin">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <?php if ($this->session->flashdata('ubah')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $this->session->flashdata('ubah'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($this->session->flashdata('demo')) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $this->session->flashdata('demo'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($this->session->flashdata('hapus')) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $this->session->flashdata('hapus'); ?>
                        </div>
                    <?php endif; ?>
                    <div>
        <a class="btn btn-info" href="<?= base_url(); ?>ppobbanner/tambah"><i class="mdi mdi-plus-circle-outline"></i>Tambah Banner PPOB</a>
      </div>
      <br>
                    <div class="table-responsive">
                        <table id="mwtable" class="table table-striped table-hover dt-responsive display nowrap" data-info="false" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Foto</th>
                                    <th>File</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($ppobbanner as $s) { ?>
                                    <tr>
                                        <td><?= $s['id']; ?></td>
                                        <td>
                                            <div class="badge badge-primary">
                                                <img width="80" height="80" class="avatar-img rounded-circle" src="<?= base_url('images/ppob/banner/') . $s['foto']; ?>">
                                            </div>
                                        </td>
                                        <td><?= $s['foto']; ?></td>
                                        <td><?= $s['tanggal']; ?></td>
                                        <td>
                                            <?php if ($s['status'] == 1) { ?>
                                                <label class="badge badge-success">Active</label>
                                            <?php } else { ?>
                                                <label class="badge badge-danger">Non Active</label>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <a href="<?= base_url(); ?>ppobbanner/ubah/<?= $s['id']; ?>">
                                                <button class="btn btn-outline-primary">Edit</button>
                                            </a>
                                            <a href="<?= base_url(); ?>ppobbanner/hapusservice/<?= $s['id']; ?>" onclick="return confirm ('are you sure?')">
                        <button class="btn btn-outline-danger">Delete</button></a>
                                        </td>
                                    <?php $i++;
                                } ?>
                                    </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>