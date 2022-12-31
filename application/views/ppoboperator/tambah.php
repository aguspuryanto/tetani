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
                        Tambah Data</h4>
                    <?= form_open_multipart('ppoboperator/tambah'); ?>
                    <div class="form-group">
                        <input type="file" class="dropify" name="ikon" data-max-file-size="3mb" required />
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="brand">Brand (Perhatikan besar kecil Huruf)</label>
                        <input type="text" class="form-control" id="brand" name="brand" required>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan" required>
                    </div>
                    <div class="form-group">
                        <label for="type">Tipe</label>
                        <select class="form-control custom-select  mt-15" name="type" style="width:100%">
                            <option value="Data" >Data</option>
                            <option value="Pulsa" >Pulsa</option>
                            <option value="Pln" >Pln</option>
                            <option value="Games" >Game</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="fee">Fee</label>
                        <input type="number" class="form-control" id="fee" name="fee" required>
                    </div>
                    <div class="form-group">
                        <label for="iszone">Game Zoneid/ServerId <font color="red">(Abaikan Jika Bukan Tipe Game)</font></label>
                        <select class="form-control custom-select  mt-15" name="iszone" style="width:100%">
                            <option value="0" >Tidak</option>
                            <option value="1" >Ya</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control custom-select  mt-15" name="status" style="width:100%">
                            <option value="0" >Nonactive</option>
                            <option value="1" >Active</option>
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