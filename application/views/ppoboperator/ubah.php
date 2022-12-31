<!-- partial -->
<div class="container-fluid mt-xl-50 mt-sm-30 mt-15 px-xxl-65 px-xl-20">
    <div class="row ">
        <div class="col-md-8 offset-md-2 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        <?php if ($this->session->flashdata()) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $this->session->flashdata('demo'); ?>
                            </div>
                        <?php endif; ?>
                        Layanan</h4>
                    <?= form_open_multipart('ppoboperator/ubah/' . $kode); ?>
                    <input type="hidden" name="kode" value='<?= $kode ?>'>
                    <div class="form-group">
                        <input type="file" class="dropify" name="ikon" data-max-file-size="3mb" data-default-file="<?= base_url('images/ppob/') . $ikon ?>" />
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $nama ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="brand">Brand</label>
                        <input type="text" class="form-control" id="brand" name="brand" value="<?= $brand ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= $keterangan ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="type">Tipe</label>
                        <select class="form-control custom-select  mt-15" name="type" style="width:100%">
                            <option value="Pulsa" <?php if ($type == 'Pulsa') { ?>selected<?php } ?>>Pulsa</option>
                            <option value="Data" <?php if ($type == 'Data') { ?>selected<?php } ?>>Data</option>
                            <option value="Pln" <?php if ($type == 'Pln') { ?>selected<?php } ?>>Pln</option>
                            <option value="Games" <?php if ($type == 'Games') { ?>selected<?php } ?>>Game</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="fee">Fee</label>
                        <input type="text" class="form-control" id="fee" name="fee" value="<?= $fee ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="iszone">Game Zoneid/ServerId <font color="red">(Abaikan Jika Bukan Tipe Game)</font></label>
                        <select class="form-control custom-select  mt-15" name="iszone" style="width:100%">
                        <option value="1" <?php if ($iszone == '1') { ?>selected<?php } ?>>Ya</option>
                        <option value="0" <?php if ($iszone == '0') { ?>selected<?php } ?>>Tidak</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control custom-select  mt-15" name="status" style="width:100%">
                            <option value="0" <?php if ($status == 0) { ?>selected<?php } ?>>Nonactive</option>
                            <option value="1" <?php if ($status == 1) { ?>selected<?php } ?>>Active</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                    <a href="<?= base_url() ?>ppoboperator" class="btn btn-danger">Cancel</a>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end of content wrapper -->