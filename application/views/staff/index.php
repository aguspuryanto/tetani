<!-- partial -->
<div class="container-fluid mt-xl-50 mt-sm-30 mt-15 px-xxl-65 px-xl-20">
    <div class="card">
        <div class="card-body">
            <?php if ($this->session->flashdata('demo') or $this->session->flashdata('hapus')) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $this->session->flashdata('demo'); ?>
                    <?php echo $this->session->flashdata('hapus'); ?>
                </div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('ubah') or $this->session->flashdata('tambah')) : ?>
                <div class="alert alert-primary" role="alert">
                    <?php echo $this->session->flashdata('ubah'); ?>
                    <?php echo $this->session->flashdata('tambah'); ?>
                </div>
            <?php endif; ?>
            <div>
                <button class="btn btn-info" id="tombolAdd"><i class="mdi mdi-plus-circle-outline"></i>Tambah Staff</button>
            </div>
            <br>
            <div id="tempatData"></div>

            <div id="elementform" style="display:none;">

                <h4 class="card-title">Ubah Staff</h4>
                <br>
                <?= form_open_multipart('staff/ubahcm'); ?>
                <input type="hidden" class="form-control" id="valid" name="id" style="width:60%" value="" required>
                <input type="file" accept="image/*" name="image" onchange="loadFile(event)">
                <img id="output" width="250" height="250"/>
                <div class="form-group">
                    <label for="valnam">Username</label>
                    <input type="text" class="form-control" id="valnam" name="user_name" style="width:60%" value="" required>
                </div>
                <div class="form-group">
                    <label for="valemail">Email</label>
                    <input type="email" class="form-control" id="valemail" name="email" style="width:60%" value="" required>
                </div>
                <div class="form-group">
                    <label for="valemail">Password</label>
                    <input type="password" class="form-control" id="valpass" name="password" hint="Masukan Password Kamu" style="width:60%" value="" required>
                </div>
                <label for="">Level</label>
                <div class="form-group">
                    <select class="form-control custom-select  mt-15" style="width:60%" name="vallevel">
                        <option selected="false" id="admin" value="admin">Admin</option>
                        <option selected="true" id="staff" value="staff">Staff</option>
                    </select>
                </div>
                <div class="row">
                    <div class="col-7 ">
                        <button type="submit" class="btn btn-success mr-2">Submit</button>
                        <?= form_close(); ?>
                        <span onclick="balikan()" class="btn btn-light">Cancel</span>
                    </div>
                </div>
                <br>
            </div>

           
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <h1 id="jumlah" style="display: none;"><?= count($catmer) ?></h1>
                      
                        <table id="tabwallet" class="table table-striped table-hover dt-responsive display nowrap" data-info="false" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Level</th>
                                    <th>Kelola</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($catmer as $cm) { ?>
                                    <tr>
                                        <h1 id="id<?= $i ?>" style="display:none;"><?= $cm['id']; ?></h1>
                                        <h1 id="statm<?= $i ?>" style="display:none;"><?= $cm['level']; ?></h1>
                                        <td><?= $i ?></td>
                                        <td id="nama<?= $i ?>"><?= $cm['user_name']; ?></td>
                                        <td id="email<?= $i ?>"><?= $cm['email']; ?></td>
                                        <td>
                                            <div>
                                                <?php if ($cm['level'] == "admin") { ?>
                                                    <label class="badge badge-success">Admin
                                                    </label>
                                                <?php } else { ?>
                                                    <label class="badge badge-danger">Staff
                                                    </label>
                                                <?php } ?>
                                            </div>
                                        </td>
                                        <td>
                                            <button onclick="update(<?= $i ?>);" class="btn btn-outline-success">Ubah</button>
                                            <a href="<?= base_url(); ?>staff/hapus/<?= $cm['id']; ?>" onclick="return confirm ('Apakah Anda Ingin Menghapus Akun Staff ?')">
                                            <button class="btn btn-outline-danger">Hapus</button></a>
                                        </td>
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

<script>
  var loadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('output');
      output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  };
</script>
<script>
    const tombol = document.getElementById('tombolAdd');
    tombol.addEventListener("click", function() {
        const isi = document.getElementById('tempatData');
        isi.innerHTML = formAdd();
        const kembali = document.getElementById('cancel');
        kembali.addEventListener("click", function() {
            isi.innerHTML = backlah();
        })
    });

    function backlah() {
        return ``
    }

    function formAdd() {
        return `<h4 class="card-title">Tambah Akun Staff</h4>
                <br>
                <?= form_open_multipart('staff/tambahcm'); ?>
                 <div class="form-group">
                        <input type="file" accept="image/*" onchange="loadFile(event)" class="dropify" name="image" data-max-file-size="3mb" required />
                        <img id="output" width="250" height="250"/>
                    </div>
                <div class="form-group">
                    <label for="newstitle">Username</label>
                    <input type="text" class="form-control" id="newstitle" name="user_name" style="width:60%" required>
                </div>
                <div class="form-group">
                    <label for="newstitle">Email</label>
                    <input type="email" class="form-control" id="newstitle" name="email" style="width:60%" required>
                </div>
                <div class="form-group">
                    <label for="newstitle">Password</label>
                    <input type="password" class="form-control" id="newstitle" name="password" style="width:60%" required>
                </div>
                <label for="">Level</label>
                <div class="form-group">
                        <select class="form-control custom-select  mt-15" name="level" style="width:100%">
                            <option value="statusadmin" >Admin</option>
                            <option value="statusstaff" >Staff</option>
                        </select>
                </div>
                <div class="row">
                    <div class="col-7">
                        <button type="submit" class="btn btn-success mr-2">Submit</button>
                        <?= form_close(); ?>
                        <button id="cancel" class="btn btn-light">Cancel</button>
                    </div>
                </div>
                <br>`
    }
    const jumlah = document.getElementById("jumlah").innerHTML

    for (let i = 0; i < jumlah; i++) {

        function update(i) {
            let id = document.getElementById(`id${i}`).innerHTML
            let nama = document.getElementById(`nama${i}`).innerHTML
            let email = document.getElementById(`email${i}`).innerHTML
            let statm = document.getElementById(`statm${i}`).innerHTML
            let editdoc = document.getElementById('elementform');
            editdoc.style = "display:block;";
            document.getElementById('valnam').value = nama;
            document.getElementById('valemail').value = email;
            document.getElementById(`status${statm}`).selected = true;
            document.getElementById(`valid`).value = id;
        }
    }

    function balikan() {
        document.getElementById('elementform').style = "display:none;";
    }
</script>