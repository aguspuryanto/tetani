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
                    <?= form_open_multipart('services/ubah/' . $id_fitur); ?>
                    <input type="hidden" name="id_fitur" value='<?= $id_fitur ?>'>
                    <div class="form-group">
                        <input type="file" class="dropify" name="icon" data-max-file-size="3mb" data-default-file="<?= base_url('images/fitur/') . $icon ?>" />
                    </div>
                    <div class="form-group">
                        <label for="newstitle">Nama Layanan</label>
                        <input type="text" class="form-control" id="newstitle" name="fitur" value="<?= $fitur ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="service_tipe">Tipe Layanan</label>
                        <select class="form-control custom-select  mt-15" name="home" style="width:100%">
                            <option value="1" <?php if ($home == '1') { ?>selected<?php } ?>>Transportasi</option>
                            <option value="2" <?php if ($home == '2') { ?>selected<?php } ?>>Kurir</option>
                            <option value="3" <?php if ($home == '3') { ?>selected<?php } ?>>Rental</option>
                            <option value="4" <?php if ($home == '4') { ?>selected<?php } ?>>Merchant</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="newstitle">Harga</label>
                        <input type="text"  class="form-control" id="newstitle" name="biaya" value="<?= rupiah($biaya) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="promo">Diskon (%)</label>
                        <input type="text" class="form-control" id="promo" name="promo" value="<?= $promo ?>" placeholder="ex 10%">
                    </div>
                    <div class="form-group">
                        <label for="newscategory">Jarak</label>
                        <select class="form-control custom-select  mt-15" name="keterangan_biaya" style="width:100%">
                            <option value="KM" <?php if ($keterangan_biaya == 'KM') { ?>selected<?php } ?>>Per Km</option>
                            <option value="Hr" <?php if ($keterangan_biaya == 'Hr') { ?>selected<?php } ?>>Per Jam</option>
                            <option value="Hr" <?php if ($keterangan_biaya == 'Dy') { ?>selected<?php } ?>>Per Hari</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="newstitle">Komisi (%)</label>
                        <input type="text" class="form-control" id="newstitle" name="komisi" value="<?= $komisi ?>" placeholder="ex 10%" required>
                    </div>
                    <div class="form-group">
                        <label for="newscategory">Kendaraan</label>
                        <select class="form-control custom-select  mt-15" name="driver_job" style="width:100%">
                            <?php foreach ($driverjob as $drj) { ?>
                                <option value="<?= $drj['id'] ?>" <?php if ($driver_job == $drj['id']) { ?>selected<?php } ?>><?= $drj['driver_job'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="newstitle">Min Harga</label>
                        <input type="text"  class="form-control" id="newstitle" name="biaya_minimum" value="<?= rupiah($biaya_minimum) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="newstitle">Driver Radius</label>
                        <input type="text" class="form-control" id="newstitle" name="jarak_minimum" value="<?= $jarak_minimum ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="newstitle">Maks Jarak Pesanan</label>
                        <input type="text" class="form-control" id="newstitle" name="maks_distance" value="<?= $maks_distance ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="newstitle">Min Saldo</label>
                        <input type="text"  class="form-control" id="newstitle" name="wallet_minimum" value="<?= rupiah($wallet_minimum) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="newstitle">Deskripsi</label>
                        <input type="text" class="form-control" id="newstitle" name="keterangan" value="<?= $keterangan ?>" required>
                    </div>
                    
                     <div class="form-group">
                        <label for="newstitle">Background : </label><br>
                        <input type="color" id="head" name="background" value="<?= $background ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="newstitle">Tint : </label><br>
                        <input type="color" id="head" name="tint" value="<?= $tint ?>" required></br>
                        <label for="newscategory">Gunakan Tint</label>
                        <select class="form-control custom-select  mt-15" name="usedtint" style="width:100%">
                            <option value="0" <?php if ($usedtint == 0) { ?>selected<?php } ?>>Tidak</option>
                            <option value="1" <?php if ($usedtint == 1) { ?>selected<?php } ?>>Ya</option>
                        </select>
                    </div>
                    <div class="form-group">
                         <label for="newstitle">Kota (Kosongkan / ketik 'all' Jika Fitur Tersebut Untuk Semua Wilayah)</label><br>
                        <input type="text" class="form-control" id="head" name="kota" value="<?= $kota ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="newscategory">Status</label>
                        <select class="form-control custom-select  mt-15" name="active" style="width:100%">
                            <option value="0" <?php if ($active == 0) { ?>selected<?php } ?>>Nonactive</option>
                            <option value="1" <?php if ($active == 1) { ?>selected<?php } ?>>Active</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                    <a href="<?= base_url() ?>services" class="btn btn-danger">Cancel</a>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end of content wrapper -->