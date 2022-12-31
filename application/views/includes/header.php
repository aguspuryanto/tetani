<!DOCTYPE html>
<!-- 
Template Name: dashgrin - Responsive Bootstrap 4 Admin Dashboard Template
Author: Hencework

License: You must have a valid license purchased only from themeforest to legally use the template for your project.
-->
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title><?=$this->config->item("app_name");?>-Admin Panel</title>
    <meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
	<!-- vector map CSS -->
    <link href="<?= base_url(); ?>vendors/vectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet" type="text/css" />
   
    <!-- Toggles CSS -->
    <link href="<?= base_url(); ?>vendors/jquery-toggles/css/toggles.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>vendors/jquery-toggles/css/themes/toggles-light.css" rel="stylesheet" type="text/css">
	
	<!-- Morris Charts CSS -->
    <link href="<?= base_url(); ?>vendors/morris.js/morris.css" rel="stylesheet" type="text/css" />
	
	<!-- Toastr CSS -->
    <link href="<?= base_url(); ?>vendors/jquery-toast-plugin/dist/jquery.toast.min.css" rel="stylesheet" type="text/css">
	
    <!-- Data Table CSS -->
    <link href="<?= base_url(); ?>vendors/datatables.net-dt/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>vendors/datatables.net-responsive-dt/css/responsive.dataTables.min.css" rel="stylesheet" type="text/css" />

    <!-- Custom CSS -->
    <link href="<?= base_url(); ?>dist/css/style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.dataTables.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.0/css/responsive.dataTables.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.css">
	
	<!-------------------------------------- komponen --------------------------- -->
	  <!-- plugin css for this page -->
    <link rel="stylesheet" href="<?= base_url(); ?>asset/node_modules/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>asset/node_modules/jquery-bar-rating/dist/themes/fontawesome-stars.css">
    <script src="<?= base_url(); ?>asset/vendors/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
    <style>
        .loader {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: #F5F8FA;
            z-index: 9998;
            text-align: center;
        }

        .plane-container {
            position: absolute;
            top: 50%;
            left: 50%;
        }
		

    </style>
	<style>
    th, td { white-space: nowrap; }
    div.dataTables_wrapper {
        margin: 0 auto;
    }
 
    div.container {
        width: 80%;
    }
</style>
<style>
.box {
  height: 100px;
  width: 100%;
  background: lightblue;
  padding: 20px;
  color: white;
}
</style>
</head>

<body>
   
	<!-- HK Wrapper -->
	<div class="hk-wrapper hk-vertical-nav">

        <!-- Top Navbar -->
        <nav class="navbar navbar-expand-xl navbar-dark fixed-top hk-navbar">
            <a class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" href="javascript:void(0);"><span class="feather-icon"><i data-feather="more-vertical"></i></span></a>
			<a id="navbar_toggle_btn" class="navbar-toggle-btn nav-link-hover" href="javascript:void(0);"><span class="feather-icon"><i data-feather="menu"></i></span></a>
            <a class="navbar-brand" href="<?= base_url(); ?>">
                <img class="brand-img d-inline-block" src="<?= base_url(); ?>dist/img/logo.png" width="130" height="30" alt="brand" />
            </a>
			<ul class="navbar-nav hk-navbar-content order-xl-2">
				<li class="nav-item">
                    <a id="navbar_search_btn" class="nav-link nav-link-hover" href="javascript:void(0);"><span class="feather-icon"><i data-feather="search"></i></span></a>
                </li>
                <li class="nav-item">
                    <a id="settings_toggle_btn" class="nav-link nav-link-hover" href="javascript:void(0);"><span class="feather-icon"><i data-feather="settings"></i></span></a>
                </li>
                <li class="nav-item dropdown dropdown-notifications">
                    <a class="nav-link dropdown-toggle no-caret" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="feather-icon bell"><i data-feather="bell"></i></span></a>
                    <div class="dropdown-menu dropdown-menu-right" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                        <h6 class="dropdown-header">Notifications <a href="javascript:void(0);" class="">View all</a></h6>
                        <div class="notifications-nicescroll-bar">
                            <a href="javascript:void(0);" class="dropdown-item">
                                <div class="media">
                                    <div class="media-img-wrap">
                                        <div class="avatar avatar-sm">
                                            <img src="<?= base_url(); ?>images/admin/<?= $this->session->userdata('image') ?>" onerror="this.onerror=null;this.src='<?= base_url(); ?>asset/images/logo.png';" alt="<?= $this->session->userdata('user_name') ?>" class="avatar-img rounded-circle">
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <div>
                                            <div class="notifications-text"><span class="text-dark text-capitalize">Evie Ono</span> accepted your invitation to join the team</div>
                                            <div class="notifications-time">12m</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="javascript:void(0);" class="dropdown-item">
                                <div class="media">
                                    <div class="media-img-wrap">
                                        <div class="avatar avatar-sm">
                                            <img src="src="<?= base_url(); ?>images/admin/<?= $this->session->userdata('image') ?>" onerror="this.onerror=null;this.src='<?= base_url(); ?>asset/images/logo.png';" alt="<?= $this->session->userdata('user_name') ?>" class="avatar-img rounded-circle">
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <div>
                                            <div class="notifications-text">New message received from <span class="text-dark text-capitalize">Misuko Heid</span></div>
                                            <div class="notifications-time">1h</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="javascript:void(0);" class="dropdown-item">
                                <div class="media">
                                    <div class="media-img-wrap">
                                        <div class="avatar avatar-sm">
                                            <span class="avatar-text avatar-text-primary rounded-circle">
													<span class="initial-wrap"><span><i class="zmdi zmdi-account font-18"></i></span></span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <div>
                                            <div class="notifications-text">You have a follow up with<span class="text-dark text-capitalize"> dashgrin head</span> on <span class="text-dark text-capitalize">friday, dec 19</span> at <span class="text-dark">10.00 am</span></div>
                                            <div class="notifications-time">2d</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="javascript:void(0);" class="dropdown-item">
                                <div class="media">
                                    <div class="media-img-wrap">
                                        <div class="avatar avatar-sm">
                                            <span class="avatar-text avatar-text-success rounded-circle">
													<span class="initial-wrap"><span>A</span></span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <div>
                                            <div class="notifications-text">Application of <span class="text-dark text-capitalize">Sarah Williams</span> is waiting for your approval</div>
                                            <div class="notifications-time">1w</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="javascript:void(0);" class="dropdown-item">
                                <div class="media">
                                    <div class="media-img-wrap">
                                        <div class="avatar avatar-sm">
                                            <span class="avatar-text avatar-text-warning rounded-circle">
													<span class="initial-wrap"><span><i class="zmdi zmdi-notifications font-18"></i></span></span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <div>
                                            <div class="notifications-text">Last 2 days left for the project</div>
                                            <div class="notifications-time">15d</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown dropdown-authentication">
                    <a class="nav-link dropdown-toggle no-caret" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="media">
                            <div class="media-img-wrap">
                                <div class="avatar">
                                    <img src="<?= base_url(); ?>images/admin/<?= $this->session->userdata('image') ?>" onerror="this.onerror=null;this.src='<?= base_url(); ?>asset/images/logo.png';" alt="<?= $this->session->userdata('user_name') ?>" class="avatar-img rounded-circle">
                                </div>
                                <span class="badge badge-success badge-indicator"></span>
                            </div>
                            <div class="media-body">
                                <span><?= $this->session->userdata('user_name') ?><i class="zmdi zmdi-chevron-down"></i></span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
                        <a class="dropdown-item" href="<?= base_url(); ?>profile"><i class="dropdown-icon zmdi zmdi-account"></i><span>Profil</span></a>
                        <a class="dropdown-item" href="#"><i class="dropdown-icon zmdi zmdi-card"></i><span>My balance</span></a>
                        <a class="dropdown-item" href="inbox.html"><i class="dropdown-icon zmdi zmdi-email"></i><span>Inbox</span></a>
                        <a class="dropdown-item" href="#"><i class="dropdown-icon zmdi zmdi-settings"></i><span>Settings</span></a>
                        <div class="dropdown-divider"></div>
                        
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= base_url(); ?>login/logout"><i class="dropdown-icon zmdi zmdi-power"></i><span>Log out</span></a>
                    </div>
                </li>
            </ul>

		</nav>
        <form role="search" class="navbar-search">
            <div class="position-relative">
                <a href="javascript:void(0);" class="navbar-search-icon"><span class="feather-icon"><i data-feather="search"></i></span></a>
                <input type="text" name="example-input1-group2" class="form-control" placeholder="Ketik ID Pesanan Mu Disini ...">
                <a id="navbar_search_close" class="navbar-search-close" href="#"><span class="feather-icon"><i data-feather="x"></i></span></a>
            </div>
        </form>
        <!-- /Top Navbar -->

        <!-- Vertical Nav -->
        <nav class="hk-nav hk-nav-light">
            
            <a href="javascript:void(0);" id="hk_nav_close" class="hk-nav-close"><span class="feather-icon"><i data-feather="x"></i></span></a>
            <div class="nicescroll-bar">
                <div class="navbar-nav-wrap">
                    <ul class="navbar-nav flex-column">
                        <li class="nav-item active">
                            <a class="nav-link" href="<?= base_url(); ?>">
                                <i class="fa fa-home"></i>
                                <span class="nav-link-text">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="<?= base_url(); ?>transaction">
                                <i class="fa fa-area-chart"></i>
                                <span class="nav-link-text">Transaksi</span>
                            </a>
                        </li>
                    </ul>
                    <hr class="nav-separator">
                    <div class="nav-header">
                        <span>Aplikasi</span>
                        <span>UI</span>
                    </div>
                    
                    <ul class="navbar-nav flex-column">
                   
                        <li class="nav-item active">
                            <a class="nav-link" href="<?= base_url(); ?>promocode">
                                <i class="fa fa-cut"></i>
                                <span class="nav-link-text">Promo</span>
                            </a>
                        </li>
						<li class="nav-item active">
                            <a class="nav-link" href="<?= base_url(); ?>promoslider">
                                <i class="fa fa-photo"></i>
                                <span class="nav-link-text">Banner</span>
                            </a>
                        </li>
						<li class="nav-item active">
                            <a class="nav-link" href="<?= base_url(); ?>news">
                                <i class="fa fa-newspaper-o"></i>
                                <span class="nav-link-text">Berita</span>
                            </a>
                        </li>
                        	
						<li class="nav-item active">
                            <a class="nav-link" href="<?= base_url(); ?>appnotification">
                                <i class="fa fa-send"></i>
                                <span class="nav-link-text">Kirim Notifikasi</span>
                            </a>
                        </li>
                        	<li class="nav-item active">
                            <a class="nav-link" href="<?= base_url(); ?>poin">
                                <i class="fa fa-trophy"></i>
                                <span class="nav-link-text">Poin</span>
                            </a>
                        </li>
                    </ul>
                    <!-- Finansial -->
                  
                    <hr class="nav-separator">
                    <div class="nav-header">
                        <span>Saldo</span>
                        <span>Balance</span>
                    </div>
                    <ul class="navbar-nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url(); ?>wallet">
                                <i class="fa fa-credit-card-alt"></i>
                                <span class="nav-link-text">Saldo</span>
                            </a>
                        </li>
                        <?php if ($this->session->userdata('level') == "admin") : ?>
						<li class="nav-item">
                            <a class="nav-link" href="<?= base_url(); ?>wallet/tambahtopup">
                                <i class="fa fa-credit-card-alt"></i>
                                <span class="nav-link-text">Tambah Saldo</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url(); ?>wallet/tambahwithdraw">
                                <i class="fa fa-credit-card-alt"></i>
                                <span class="nav-link-text">Tarik Saldo</span>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                   
                    <!-- Akun -->
                    
                    <hr class="nav-separator">
                    <div class="nav-header">
                        <span>Akun</span>
                        <span>Account</span>
                    </div>
                    <ul class="navbar-nav flex-column">
                        <?php if ($this->session->userdata('level') == "admin") : ?>
                        <li class="nav-item active">
                            <a class="nav-link" href="<?= base_url(); ?>staff">
                                <i class="ion ion-md-person"></i>
                                <span class="nav-link-text">Staff</span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url(); ?>users">
                                <i class="icon ion-md-person"></i>
                                <span class="nav-link-text">Pelanggan</span>
                            </a>
                        </li>
                        <!-- driver -->
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#pages_drp">
                                <i class="ion ion-md-person"></i>
                                <span class="nav-link-text">Driver</span>
                            </a>
                            <ul id="pages_drp" class="nav flex-column collapse collapse-level-1">
                                <li class="nav-item">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                        <a class="nav-link" href="<?= base_url(); ?>driver">
                                            <i class="ion ion-md-person"></i>
                                            <span class="nav-link-text">Driver</span>
                                        </a>
                                        </li>
                                        
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?= base_url(); ?>newregistration">
                                                <i class="ion ion-md-person-add"></i>
                                                <span class="nav-link-text">Tambah</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <!-- Merchant -->
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#pages_drp2">
                                <i class="fa fa-coffee"></i>
                                <span class="nav-link-text">Mitra</span>
                            </a>
                            <ul id="pages_drp2" class="nav flex-column collapse collapse-level-1">
                                <li class="nav-item">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?= base_url(); ?>categorymerchant">
                                                <i class="fa fa-th-list"></i>
                                                <span class="nav-link-text">Kategori</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?= base_url(); ?>mitra">
                                                <i class="fa fa-coffee"></i>
                                                <span class="nav-link-text">Mitra</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?= base_url(); ?>mitra/newregmitra">
                                                <i class="fa fa-plus-circle"></i>
                                                <span class="nav-link-text">Tambah</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                 
                    <?php if ($this->session->userdata('level') == "admin") : ?>
                    <hr class="nav-separator">
                    <div class="nav-header">
                        <span>Fitur</span>
                        <span>Feature</span>
                    </div>
                    <ul class="navbar-nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url(); ?>services">
                                <i class="fa fa-gears"></i>
                                <span class="nav-link-text">Fitur</span>
                            </a>
                        </li>
						<li class="nav-item">
                            <a class="nav-link" href="<?= base_url(); ?>partnerjob">
                                <i class="fa fa-car"></i>
                                <span class="nav-link-text">Kendaraan</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url(); ?>paket">
                                <i class="fa fa-cubes"></i>
                                <span class="nav-link-text">Paket</span>
                            </a>
                        </li>
                    </ul>
                    <?php endif; ?>
                    
                    <?php if ($this->session->userdata('level') == "admin") : ?>
                    <hr class="nav-separator">
                    <div class="nav-header">
                        <span>Aplikasi</span>
                        <span>Application</span>
                    </div>
                    <ul class="navbar-nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url(); ?>appsettings">
                                <i class="fa fa-mobile-phone"></i>
                                <span class="nav-link-text">Pengaturan</span>
                            </a>
                        </li>
						<li class="nav-item">
                            <a class="nav-link" href="<?= base_url(); ?>login/logout">
                                <i class="fa fa-close"></i>
                                <span class="nav-link-text">Logout</span>
                            </a>
                        </li>
                    </ul>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
        <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
        <!-- /Vertical Nav -->

        <!-- Setting Panel -->
        <div class="hk-settings-panel">
            <div class="nicescroll-bar position-relative">
                <div class="settings-panel-wrap">
                    <div class="settings-panel-head">
                        <img class="brand-img d-inline-block align-top" src="<?= base_url(); ?>dist/img/logo-light.png" alt="brand" />
                        <a href="javascript:void(0);" id="settings_panel_close" class="settings-panel-close"><span class="feather-icon"><i data-feather="x"></i></span></a>
                    </div>
                    
                    <hr>
                    <h6 class="mb-5">Navigasi</h6>
                    <p class="font-14">Pilih Tema: dark & light</p>
                    <div class="button-list hk-nav-select mb-10">
                        <button type="button" id="nav_light_select" class="btn btn-outline-success btn-sm btn-wth-icon icon-wthot-bg"><span class="icon-label"><i class="fa fa-sun-o"></i> </span><span class="btn-text">Light Mode</span></button>
                        <button type="button" id="nav_dark_select" class="btn btn-outline-light btn-sm btn-wth-icon icon-wthot-bg"><span class="icon-label"><i class="fa fa-moon-o"></i> </span><span class="btn-text">Dark Mode</span></button>
                    </div>
                    <hr>
                    <h6 class="mb-5">Navigasi Atas</h6>
                    <p class="font-14">Pilih Warna Tema</p>
                    <div class="button-list hk-navbar-select mb-10">
                        <button type="button" id="navtop_light_select" class="btn btn-outline-light btn-sm btn-wth-icon icon-wthot-bg"><span class="icon-label"><i class="fa fa-sun-o"></i> </span><span class="btn-text">Light Mode</span></button>
                        <button type="button" id="navtop_dark_select" class="btn btn-outline-success btn-sm btn-wth-icon icon-wthot-bg"><span class="icon-label"><i class="fa fa-moon-o"></i> </span><span class="btn-text">Dark Mode</span></button>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>Scrollable Header</h6>
                        <div class="toggle toggle-sm toggle-simple toggle-light toggle-bg-success scroll-nav-switch"></div>
                    </div>
                    <button id="reset_settings" class="btn btn-success btn-block btn-reset mt-30">Reset</button>
                </div>
            </div>
            <img class="d-none" src="<?= base_url(); ?>dist/img/logo-light.png" alt="brand" />
            <img class="d-none" src="<?= base_url(); ?>dist/img/logo-dark.png" alt="brand" />
        </div>
        <!-- /Setting Panel -->
		 <!-- Main Content -->
        <div class="hk-pg-wrapper">

		