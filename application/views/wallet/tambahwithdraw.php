<!-- partial -->
<div class="container-fluid mt-xl-50 mt-sm-30 mt-15 px-xxl-65 px-xl-20">
    <div class="row justify-content-md-center">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <?php if ($this->session->flashdata('salah')) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $this->session->flashdata('salah'); ?>
                        </div>
                    <?php endif; ?>
                    <h4 class="card-title">Manual Penarikan</h4>
                    <?= form_open_multipart('wallet/tambahwithdraw'); ?>



                    <div class="form-group">
                        <label for="type">Tipe</label>
                        <select id="getFname" onchange="admSelectCheck(this);" class="form-control custom-select  mt-15" style="width:100%" name="type_user">
                            <option id="pelanggan" value="pelanggan">USER</option>
                            <option id="driver" value="driver">DRIVER</option>
                            <option id="mitra" value="mitra">MITRA</option>
                        </select>
                    </div>

                    <div id="pelanggancheck" style="display:block;" class="form-group">
                        <label for="id_Pelanggan">Customer</label>
                        <select class="form-control custom-select  mt-15" style="width:100%" name="id_pelanggan">
                            <?php foreach ($saldo as $sl) {
                                if (substr($sl['id_user'], 0, 1) == 'P') { ?>
                                    <option value="<?= $sl['id_user'] ?>"><?= $sl['fullnama'] ?> (<?= $currency['duit'] ?><?= rupiah($sl['saldo']) ?>)</option>
                            <?php }
                            } ?>
                        </select>
                    </div>

                    <div id="drivercheck" style="display:none;" class="form-group">
                        <label for="id_driver">Driver</label>
                        <select class="form-control custom-select  mt-15" style="width:100%" name="id_driver">
                            <?php foreach ($saldo as $sl) {
                                if (substr($sl['id_user'], 0, 1) == 'D') { ?>
                                    <option value="<?= $sl['id_user'] ?>"><?= $sl['nama_driver'] ?> (<?= $currency['duit'] ?><?= rupiah($sl['saldo']) ?>)
                                    </option>
                            <?php }
                            } ?>
                        </select>
                    </div>

                    <div id="mitracheck" style="display:none;" class="form-group">
                        <label for="id_mitra">Mitra</label>
                        <select class="form-control custom-select  mt-15" style="width:100%" name="id_mitra">
                            <?php foreach ($saldo as $sl) {
                                if (substr($sl['id_user'], 0, 1) == 'M') { ?>
                                    <option value="<?= $sl['id_user'] ?>"><?= $sl['nama_mitra'] ?> (<?= $currency['duit'] ?><?= rupiah($sl['saldo']) ?>)
                                    </option>
                            <?php }
                            } ?>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="saldo">Jumlah</label>
                        <input type="text" pattern="^\d+(\,|\.)\d{2}$" data-type="currency" class="form-control" id="saldo" name="saldo" placeholder="enter Amount">
                    </div>

                    <div class="form-group">
                        <label for="bank">Nama Bank</label>
                        <input type="text" class="form-control" id="bank" name="bank" placeholder="enter Bank Name">
                    </div>

                    <div class="form-group">
                        <label for="rekening">No Rekening</label>
                        <input type="text" class="form-control" id="rekening" name="rekening" placeholder="enter Bank Account">
                    </div>

                    <div class="form-group">
                        <label for="nama_pemilik">Atas Nama</label>
                        <input type="text" class="form-control" id="nama_pemilik" name="nama_pemilik" placeholder="enter Account Username">
                    </div>

                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                    <a class="btn btn-danger text-white" href="<?= base_url(); ?>promoslider">Cancel</a>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function admSelectCheck(nameSelect) {
        console.log(nameSelect);
        if (nameSelect) {
            pelangganValue = document.getElementById("pelanggan").value;
            driverValue = document.getElementById("driver").value;
            mitraValue = document.getElementById("mitra").value;
            if (pelangganValue == nameSelect.value) {
                document.getElementById("pelanggancheck").style.display = "block";
                document.getElementById("drivercheck").style.display = "none";
                document.getElementById("mitracheck").style.display = "none";
            } else if (driverValue == nameSelect.value) {
                document.getElementById("drivercheck").style.display = "block";
                document.getElementById("pelanggancheck").style.display = "none";
                document.getElementById("mitracheck").style.display = "none";
            } else if (mitraValue == nameSelect.value) {
                document.getElementById("mitracheck").style.display = "block";
                document.getElementById("drivercheck").style.display = "none";
                document.getElementById("pelanggancheck").style.display = "none";
            }
        } else {
            document.getElementById("pelanggancheck").style.display = "block";
        }
    }
</script>