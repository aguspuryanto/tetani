 <div class="container-fluid mt-xl-50 mt-sm-30 mt-15 px-xxl-65 px-xl-20">
    <div class="row">
        <div class="col-md-8 offset-md-2 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">App Settings</h4>
                    <?php if ($this->session->flashdata('send') or $this->session->flashdata('ubah')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $this->session->flashdata('send'); ?>
                            <?php echo $this->session->flashdata('ubah'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($this->session->flashdata('demo')) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $this->session->flashdata('demo'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="tab-minimal tab-minimal-success">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="tab-2-1" data-toggle="tab" href="#app-2-1" role="tabpanel" aria-controls="app-2-1" aria-selected="true">
                                    <i class="mdi mdi-cellphone-android"></i>App</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-2-2" data-toggle="tab" href="#email-2-2" role="tabpanel" aria-controls="email-2-2" aria-selected="false">
                                    <i class="mdi mdi-cellphone-android"></i>Email</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-2-3" data-toggle="tab" href="#smtp-2-3" role="tabpanel" aria-controls="smtp-2-3" aria-selected="false">
                                    <i class="mdi mdi-cellphone-android"></i>SMTP</a>
                            </li>
                          
                            <li class="nav-item">
                                <a class="nav-link" id="tab-2-4" data-toggle="tab" href="#banktransfer-2-4" role="tabpanel" aria-controls="banktransfer-2-4" aria-selected="false">
                                    <i class="mdi mdi-cellphone-android"></i>Bank Transfer</a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" id="tab-2-5" data-toggle="tab" href="#midtrans-2-5" role="tabpanel" aria-controls="midtrans-2-5" aria-selected="false">
                                    <i class="mdi mdi-cellphone-android"></i>Duitku</a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" id="tab-2-6" data-toggle="tab" href="#whatsapp-2-7" role="tabpanel" aria-controls="whatsapp-2-7" aria-selected="false">
                                    <i class="mdi mdi-cellphone-android"></i>Whatsapp</a>
                            </li>

                        </ul>
                        <div class="tab-content col-12 justify-content-center">
                            <div class="tab-pane fade show active" id="app-2-1" role="tabpanel" aria-labelledby="tab-2-1">
                                <div class="col-12 grid-margin">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">App Settings</h4>
                                            <br>
                                            <?= form_open_multipart('appsettings/ubahapp'); ?>
                                            <div class="form-group">
                                                    <label for="app_logo">Logo App</label></br>
                                                    <input type="file" accept="image/*" name="app_logo" onchange="loadFile(event)">
                                                    <img id="output" src="<?= base_url('images/logo/') . $appsettings['app_logo']; ?>" width="250" height="250"/></div>
                                                    <div class="form-group">
                                                    <label for="appemail">App Email</label>
                                                    <input type="email" class="form-control" id="appemail" name="app_email" value="<?= $appsettings['app_email']; ?>" required></div>
                                                <div class="form-group">
                                                    <label for="appname">App Name</label>
                                                    <input type="text" class="form-control" id="appname" name="app_name" value="<?= $appsettings['app_name']; ?>" required></div>
                                                <div class="form-group">
                                                    <label for="appdescription">App Slogan</label>
                                                    <input type="text" class="form-control" id="appdescription" name="app_description" value="<?= $appsettings['app_description']; ?>" required></div>
                                                <div class="form-group">
                                                    <label for="appcontact">App Contact *Contoh : 628991585xxx</label>
                                                    <input type="text" class="form-control" id="appcontact" name="app_contact" value="<?= $appsettings['app_contact']; ?>" required></div>
                                                <div class="form-group">
                                                    <label for="appwebsite">App Website</label>
                                                    <input type="text" class="form-control" id="appwebsite" name="app_website" value="<?= $appsettings['app_website']; ?>" required></div>
                                                <div class="form-group">
                                                    <label for="privacypolicy">Privacy Policy</label>
                                                    <textarea type="text" class="form-control" id="summernoteExample1" name="app_privacy_policy" required><?= $appsettings['app_privacy_policy']; ?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="aboutus">About Us</label>
                                                    <textarea type="text" class="form-control" id="summernoteExample2" name="app_aboutus" required><?= $appsettings['app_aboutus']; ?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="appaddress">App Address</label>
                                                    <textarea type="text" class="form-control" id="summernoteExample3" name="app_address" required><?= $appsettings['app_address']; ?></textarea></div>
                                                <div class="form-group">
                                                    <label for="googlelink">Google Link</label>
                                                    <input type="text" class="form-control" id="googlelink" name="app_linkgoogle" value="<?= $appsettings['app_linkgoogle']; ?>" required></div>
                                                <div class="form-group">
                                                    <label for="appcurrency">Mata Uang</label>
                                                    <input type="text" class="form-control" id="appcurrency" name="app_currency" value="<?= $appsettings['app_currency']; ?>" required></div>
                                                <div class="form-group">
                                                    <label for="map_key">Google Api Key</label>
                                                    <input type="password" class="form-control" id="mapkey" name="map_key" value="<?= $appsettings['map_key']; ?>" onCopy="return false" required></div>
                                                <div class="form-group">
                                                    <label for="fcm_key">FCM Server Key</label>
                                                    <input type="password" class="form-control" id="fcm_key" name="fcm_key" value="<?= $appsettings['fcm_key']; ?>" onCopy="return false" required></div>
                                                    
                                                <div class="form-group">
                                                    <label for="isotp">Sistem OTP</label>
                                                    <select name="isotp" id="isotp" class="form-control custom-select  mt-15" style="width:100%">
                                                        <option value="1" <?php if ($appsettings['isotp'] == '1') { ?>selected<?php } ?>>Active</option>
                                                        <option value="0" <?php if ($appsettings['isotp'] == '0') { ?>selected<?php } ?>>NonActive</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="maintenance">App Maintenance</label>
                                                    <select name="maintenance" id="maintenance" class="form-control custom-select  mt-15" style="width:100%">
                                                        <option value="1" <?php if ($appsettings['maintenance'] == '1') { ?>selected<?php } ?>>Active</option>
                                                        <option value="0" <?php if ($appsettings['maintenance'] == '0') { ?>selected<?php } ?>>NonActive</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="newstitle">Background : </label><br>
                                                    <input type="color" id="head" name="background" value="<?= $appsettings['background'] ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="jasaapp">Biaya Jasa App Untuk Merchant</label>
                                                    <input type="number" class="form-control" id="jasaapp" name="jasaapp" value="<?= $appsettings['jasaapp']; ?>" required></div>
                                                    
                                                <button type="submit" class="btn btn-success mr-2">Submit</button>
                                            <?= form_close(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="email-2-2" role="tabpanel" aria-labelledby="tab-2-2">
                                <div class="col-12 grid-margin">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Email Template For Forgot Password</h4>
                                            <br>
                                            <?= form_open_multipart('appsettings/ubahemail'); ?>
                                            <div class="form-group">
                                                <label for="emailsubject">Email Subject</label>
                                                <textarea type="email" class="form-control" id="emailsubject" name="email_subject" required><?= $appsettings['email_subject']; ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="emailtext1">Email Text 1</label>
                                                <textarea type="email" class="form-control" id="summernoteExample4" name="email_text1" required><?= $appsettings['email_text1']; ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="emailtext2">Email Text 2</label>
                                                <textarea type="email" class="form-control" id="summernoteExample5" name="email_text2" required><?= $appsettings['email_text2']; ?></textarea>
                                            </div>

                                            <h4 class="card-title">Email Template For Confirm Driver</h4>

                                            <div class="form-group">
                                                <label for="emailsubject">Email Subject</label>
                                                <textarea type="email" class="form-control" id="emailsubject" name="email_subject_confirm" required><?= $appsettings['email_subject_confirm']; ?></textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for="emailtext1">Email Text 1</label>
                                                <textarea type="email" class="form-control" id="summernoteExample6" name="email_text3" required><?= $appsettings['email_text3']; ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="emailtext2">Email Text 2</label>
                                                <textarea type="email" class="form-control" id="summernoteExample7" name="email_text4" required><?= $appsettings['email_text4']; ?></textarea>
                                            </div>


                                            <button type="submit" class="btn btn-success mr-2">Submit</button>

                                            <?= form_close(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="smtp-2-3" role="tabpanel" aria-labelledby="tab-2-3">
                                <div class="col-12 grid-margin">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">SMTP Settings</h4>
                                            <br>

                                            <?php if (demo == TRUE) { ?>
                                                <?= form_open_multipart('appsettings/ubahsmtp'); ?>
                                                <div class="form-group">
                                                    <label for="smtphost">SMTP Host</label>
                                                    <input type="text" class="form-control" id="smtphost" name="smtp_host" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="smtpport">SMTP Port</label>
                                                    <input type="text" class="form-control" id="smtpport" name="smtp_port" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="smtpusername">SMTP User Name</label>
                                                    <input type="text" class="form-control" id="smtpusername" name="smtp_username" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="smtppassword">SMTP Password</label>
                                                    <input type="password" class="form-control" id="smtppassword" name="smtp_password" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="smtpform">SMTP Form</label>
                                                    <input type="text" class="form-control" id="smtpfrom" name="smtp_from" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="smtp_secure">SMTP Secure</label>
                                                    <select class="form-control border-primary" name="smtp_secure" id="smtp_secure">
                                                        <option value="tls" <?php if ($appsettings['smtp_secure'] == 'tls') { ?>selected<?php } ?>>TLS</option>
                                                        <option value="ssl" <?php if ($appsettings['smtp_secure'] == 'ssl') { ?>selected<?php } ?>>SSL</option>
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-success mr-2">Submit</button>

                                                <?= form_close(); ?>
                                            <?php } else { ?>

                                                <?= form_open_multipart('appsettings/ubahsmtp'); ?>
                                                <div class="form-group">
                                                    <label for="smtphost">SMTP Host</label>
                                                    <input type="text" value="<?= $appsettings['smtp_host']; ?>" class="form-control" id="smtphost" name="smtp_host" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="smtpport">SMTP Port</label>
                                                    <input type="text" class="form-control" id="smtpport" name="smtp_port" value="<?= $appsettings['smtp_port']; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="smtpusername">SMTP User Name</label>
                                                    <input type="text" class="form-control" id="smtpusername" name="smtp_username" value="<?= $appsettings['smtp_username']; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="smtppassword">SMTP Password</label>
                                                    <input type="password" class="form-control" id="smtppassword" name="smtp_password" value="<?= $appsettings['smtp_password']; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="smtpform">SMTP Form</label>
                                                    <input type="text" class="form-control" id="smtpfrom" name="smtp_from" value="<?= $appsettings['smtp_from']; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="smtp_secure">SMTP Secure</label>
                                                    <select class="form-control border-primary" name="smtp_secure" id="smtp_secure">
                                                        <option value="tls" <?php if ($appsettings['smtp_secure'] == 'tls') { ?>selected<?php } ?>>TLS</option>
                                                        <option value="ssl" <?php if ($appsettings['smtp_secure'] == 'ssl') { ?>selected<?php } ?>>SSL</option>
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-success mr-2">Submit</button>

                                                <?= form_close(); ?>

                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="banktransfer-2-4" role="tabpanel" aria-labelledby="tab-2-4">
                                <div class="col-12 grid-margin">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Bank Transfer Settings</h4>
                                            <div>
                                                <a class="btn btn-info" href="<?= base_url(); ?>appsettings/addbank"><i class="mdi mdi-plus-circle-outline"></i>Add Bank</a>
                                            </div>

                                            <br>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="table-responsive">
                                                        <table id="order-listing7" class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Image</th>
                                                                    <th>Bank Name</th>
                                                                    <th>Account Number</th>
                                                                    <th>Status</th>
                                                                    <th>Actions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php $i = 1;
                                                                foreach ($transfer as $trf) { ?>
                                                                    <tr>

                                                                        <td><?= $i ?></td>
                                                                        <td><img src="<?= base_url('images/bank/') . $trf['image_bank']; ?>"></td>
                                                                        <td><?= $trf['nama_bank'] ?></td>
                                                                        <td><?= $trf['rekening_bank'] ?></td>
                                                                        <td><?php if ($trf['status_bank'] == 1) { ?>
                                                                                <label class="badge badge-primary">Active</label>
                                                                            <?php } else if ($trf['status_bank'] == 0) { ?>
                                                                                <label class="badge badge-danger">Non Active</label>
                                                                            <?php } ?>
                                                                        </td>
                                                                        <td>
                                                                            <a href="<?= base_url(); ?>appsettings/editbank/<?= $trf['id_bank'] ?>">
                                                                                <button class="btn btn-outline-primary">Edit</button>
                                                                            </a>
                                                                            <a href="<?= base_url(); ?>appsettings/hapusbank/<?= $trf['id_bank'] ?>" onclick="return confirm ('are you sure?')">
                                                                                <button class="btn btn-outline-danger">Delete</button>
                                                                            </a>
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
                            </div>
                             <div class="tab-pane fade" id="midtrans-2-5" role="tabpanel" aria-labelledby="tab-2-5">
                                <div class="col-12 grid-margin">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Duitku Settings</h4>
                                            <br>
                                            <?= form_open_multipart('appsettings/ubahDuitku'); ?>
                                            <div class="form-group">
                                                <label for="duitku_merchant">Merchant Code</label>
                                                <input type="text" class="form-control" id="duitku_merchant" name="duitku_merchant" value="<?= $appsettings['duitku_merchant'] ?>" required>
                                            </div>
                                             <div class="form-group">
                                                <label for="duitku_key">Merchant Key</label>
                                                <input type="text" class="form-control" id="duitku_key" name="duitku_key" value="<?= $appsettings['duitku_key'] ?>" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="duitku_mode">Mode</label>
                                                <select name="duitku_mode" id="duitku_mode" class="form-control custom-select  mt-15" style="width:100%">
                                                    <option value="1" <?php if ($appsettings['duitku_mode'] == '1') { ?>selected<?php } ?>>Production</option>
                                                    <option value="0" <?php if ($appsettings['duitku_mode'] == '0') { ?>selected<?php } ?>>Sanbox</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="duitku_status">Duitku Status</label>
                                                <select name="duitku_status" id="duitku_status" class="form-control custom-select  mt-15" style="width:100%">
                                                    <option value="1" <?php if ($appsettings['duitku_status'] == '1') { ?>selected<?php } ?>>Active</option>
                                                    <option value="0" <?php if ($appsettings['duitku_status'] == '0') { ?>selected<?php } ?>>NonActive</option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-success mr-2">Submit</button>

                                            <?= form_close(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             
                            <div class="tab-pane fade" id="whatsapp-2-7" role="tabpanel" aria-labelledby="tab-2-6">
                                <div class="col-12 grid-margin">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Whatsapp Settings</h4>
                                            <br>
                                            <?= form_open_multipart('appsettings/ubahwhatsapp'); ?>
                                            <div class="form-group">
                                                <label for="whatsappserver">Whatsapp Url</label>
                                                <input type="text" class="form-control" id="whatsappserver" name="whatsappserver" value="<?= $appsettings['whatsappserver'] ?>" required>
                                            </div>
                                             <div class="form-group">
                                                <label for="whatsappapi">Whatsapp Apikey</label>
                                                <input type="text" class="form-control" id="whatsappapi" name="whatsappapi" value="<?= $appsettings['whatsappapi'] ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="whatsappnumber">Whatsapp Number</label>
                                                <input type="text" class="form-control" id="whatsappnumber" name="whatsappnumber" value="<?= $appsettings['whatsappnumber'] ?>" required>
                                            </div>
                                            <button type="submit" class="btn btn-success mr-2">Submit</button>

                                            <?= form_close(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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

    </div>
</div>