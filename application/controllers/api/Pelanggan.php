<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Pelanggan extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper("url");
        $this->load->database();
        $this->load->model('Pelanggan_model');
        $this->load->model('Driver_model');
        date_default_timezone_set('Asia/Jakarta');
    }

    function index_get()
    {
        $this->response("Api for Gojasa!", 200);
    }
    //------------------------------------ Get Data Setting ----------------------------
    function appsetting_post(){
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            return false;
        }
        $data = file_get_contents("php://input");
        $dec_data = json_decode($data);
        $app_settings = $this->Pelanggan_model->get_settings();
        foreach ($app_settings as $item) {
            $message = array(
                'code' => '200',
                'message' => 'success',
                'appwebsite' => $item['app_website'],
                'background' => $item['background'],
                'duitku_status' => $item['duitku_status'],
                'apikey' => $item['map_key'],
                'isotp' => $item['isotp'],
                'appname' => $item['app_name'],
                'slogan' => $item['app_description'],
                'applogo' => $item['app_logo'],
                'jasaapp' => $item['jasaapp'],
                'maintenance' => $item['maintenance'],
                'data' => $app_settings
            );
            $this->response($message, 200);
        }
    }
    //---------------------------- Banner ------------------------------------
    function banner_app_post()
    {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            return false;
        }
        $data = file_get_contents("php://input");
        $decoded_data = json_decode($data);
        $getdata = $this->Pelanggan_model->list_slider($decoded_data->fitur_promosi);
        $message = array(
            'status' => true,
            'message' => 'found',
            'data' => $getdata->result()
        );
        $this->response($message, 200);
    }
    //---------------------------- FCM Notifikasi ----------------------------
    function device_notif_post()
    {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            return false;
        }

        $data = file_get_contents("php://input");
        $decoded_data = json_decode($data);
        $datasetting = $this->Pelanggan_model->datasetting()->row();
        $serverkey = $datasetting->fcm_key;
        
        $url = "https://fcm.googleapis.com/fcm/send";   
        $header = [
            'authorization: key='.$serverkey,
            'content-type: application/json'
        ];
        $id = $decoded_data->id;
        $notification = [
            'title' => $decoded_data->title,
            'body' => $decoded_data->body
        ];
        $extraNotificationData = ["message" => $notification,"id" =>$id,"type" =>$decoded_data->type];
    
        $fcmNotification = [
            'to'        => $decoded_data->token,
            'notification' => $notification,
            'priority'          => 'high', 
            'data' => $decoded_data->data
        ];
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        $result = curl_exec($ch); 
        $message = array(
                'message' => 'sukses'
        );
        $this->response($message, 200);
        curl_close($ch);
    }
    //---------------------------- Edit Profile ------------------------------
    function edit_profile_post()
    {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            return false;
        }

        $data = file_get_contents("php://input");
        $decoded_data = json_decode($data);
        $check_exist_phone = $this->Pelanggan_model->check_exist_phone_edit($decoded_data->id, $decoded_data->no_telepon);
        $check_exist_email = $this->Pelanggan_model->check_exist_email_edit($decoded_data->id, $decoded_data->email);
        if ($check_exist_phone) {
            $message = array(
                'code' => '201',
                'message' => 'phone already exist',
                'data' => []
            );
            $this->response($message, 201);
        } else if ($check_exist_email) {
            $message = array(
                'code' => '201',
                'message' => 'email already exist',
                'data' => []
            );
            $this->response($message, 201);
        } else {

            $condition = array(
                'no_telepon' => $decoded_data->no_telepon
            );
            $condition2 = array(
                'no_telepon' => $decoded_data->no_telepon_lama
            );

            if ($decoded_data->fotopelanggan == null && $decoded_data->fotopelanggan_lama == null) {
                $datauser = array(
                    'fullnama' => $decoded_data->fullnama,
                    'no_telepon' => $decoded_data->no_telepon,
                    'phone' => $decoded_data->phone,
                    'email' => $decoded_data->email,
                    'countrycode' => $decoded_data->countrycode,
                    'tgl_lahir' => $decoded_data->tgl_lahir
                );
            } else {
                $image = $decoded_data->fotopelanggan;
                $namafoto = time() . '-' . rand(0, 99999) . ".jpg";
                $path = "images/pelanggan/" . $namafoto;
                file_put_contents($path, base64_decode($image));

                $foto = $decoded_data->fotopelanggan_lama;
                $path = "./images/pelanggan/$foto";
                unlink("$path");


                $datauser = array(
                    'fullnama' => $decoded_data->fullnama,
                    'no_telepon' => $decoded_data->no_telepon,
                    'phone' => $decoded_data->phone,
                    'email' => $decoded_data->email,
                    'fotopelanggan' => $namafoto,
                    'countrycode' => $decoded_data->countrycode,
                    'tgl_lahir' => $decoded_data->tgl_lahir
                );
            }


            $cek_login = $this->Pelanggan_model->get_data_pelanggan($condition2);
            if ($cek_login->num_rows() > 0) {
                $upd_user = $this->Pelanggan_model->edit_profile($datauser, $decoded_data->no_telepon_lama);
                $getdata = $this->Pelanggan_model->get_data_pelanggan($condition);
                $message = array(
                    'code' => '200',
                    'message' => 'success',
                    'data' => $getdata->result()
                );
                $this->response($message, 200);
            } else {
                $message = array(
                    'code' => '404',
                    'message' => 'error data',
                    'data' => []
                );
                $this->response($message, 200);
            }
        }
    }
    //---------------------------- Login -------------------------------------
    function login_post()
    {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            return false;
        }

        $data = file_get_contents("php://input");
        $decoded_data = json_decode($data);
        $reg_id = array(
            'token' => $decoded_data->token
        );
        $condition = array(
            'password' => sha1($decoded_data->password),
            'no_telepon' => $decoded_data->no_telepon
        );
        $check_banned = $this->Pelanggan_model->check_banned($decoded_data->no_telepon);
        if ($check_banned) {
            $message = array(
                'message' => 'banned',
                'data' => []
            );
            $this->response($message, 200);
        } else {
            $cek_login = $this->Pelanggan_model->get_data_pelanggan($condition);
            $message = array();

            if ($cek_login->num_rows() > 0) {
                $upd_regid = $this->Pelanggan_model->edit_profile($reg_id, $decoded_data->no_telepon);
                $get_pelanggan = $this->Pelanggan_model->get_data_pelanggan($condition);

                $message = array(
                    'code' => '200',
                    'message' => 'found',
                    'data' => $get_pelanggan->result()
                );
                $this->response($message, 200);
            } else {
                $message = array(
                    'code' => '404',
                    'message' => 'wrong phone or password',
                    'data' => []
                );
                $this->response($message, 200);
            }
        }
    }
    //-------------------------------- Register -------------------------------------------
    function register_user_post()
    {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            return false;
        }

        $data = file_get_contents("php://input");
        $dec_data = json_decode($data);

        $email = $dec_data->email;
        $phone = $dec_data->no_telepon;
        $check_exist = $this->Pelanggan_model->check_exist($email, $phone);
        $check_exist_phone = $this->Pelanggan_model->check_exist_phone($phone);
        $check_exist_email = $this->Pelanggan_model->check_exist_email($email);
        if ($check_exist) {
            $message = array(
                'code' => '201',
                'message' => 'email and phone number already exist',
                'data' => []
            );
            $this->response($message, 201);
        } else if ($check_exist_phone) {
            $message = array(
                'code' => '201',
                'message' => 'phone already exist',
                'data' => []
            );
            $this->response($message, 201);
        } else if ($check_exist_email) {
            $message = array(
                'code' => '201',
                'message' => 'email already exist',
                'data' => []
            );
            $this->response($message, 201);
        } else {
            if ($dec_data->checked == "true") {
               $image = $dec_data->fotopelanggan;
                $namafoto = time() . '-' . rand(0, 99999) . ".jpg";
                $path = "images/pelanggan/" . $namafoto;
                file_put_contents($path, base64_decode($image));
                $data_signup = array(
                    'id' => 'P' . time(),
                    'fullnama' => $dec_data->fullnama,
                    'email' => $dec_data->email,
                    'no_telepon' => $dec_data->no_telepon,
                    'phone' => $dec_data->phone,
                    'password' => sha1($dec_data->password),
                    'tgl_lahir' => $dec_data->tgl_lahir,
                    'countrycode' => $dec_data->countrycode,
                    'fotopelanggan' => $namafoto,
                    'token' => $dec_data->token,
                
                );
                $signup = $this->Pelanggan_model->signup($data_signup);
                if ($signup) {
                    $condition = array(
                        'password' => sha1($dec_data->password),
                        'email' => $dec_data->email
                    );
                    $datauser1 = $this->Pelanggan_model->get_data_pelanggan($condition);
                    $message = array(
                        'code' => '200',
                        'message' => 'success',
                        'data' => $datauser1->result()
                    );
                    $this->response($message, 200);
                } else {
                    $message = array(
                        'code' => '201',
                        'message' => 'failed',
                        'data' => []
                    );
                    $this->response($message, 201);
                }
            }
        }
    }
    //--------------------------- Fitur Promo ------------------------------------------
    function listfiturpromo_post()
    {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            return false;
        }
        $data = file_get_contents("php://input");
        $dec_data = json_decode($data);

        $kodepromo = $this->Pelanggan_model->promofitur_code($dec_data->id);
        $message = array(
            'code' => '200',
            'message' => 'Sukses',
            'data' => $kodepromo
        );
        $this->response($message, 200);
    }
    //--------------------------- Privacy ----------------------------------------------
    function privacy_post()
    {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            return false;
        }

        $app_settings = $this->Pelanggan_model->get_settings();

        $message = array(
            'code' => '200',
            'message' => 'found',
            'data' => $app_settings
        );
        $this->response($message, 200);
    }
    //------------------------------------- Home --------------------------------
    function home_post()
    {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            return false;
        }
        $data = file_get_contents("php://input");
        $dec_data = json_decode($data);
        $slider = $this->Pelanggan_model->sliderhome();
        $fitur = $this->Pelanggan_model->fiturhome($dec_data->kota);
        $allfitur = $this->Pelanggan_model->fiturhomeall();
        $rating = $this->Pelanggan_model->ratinghome();
        $saldo = $this->Pelanggan_model->saldouser($dec_data->id);
        $app_settings = $this->Pelanggan_model->get_settings();
        $berita = $this->Pelanggan_model->beritahome();
        $kategorymerchant = $this->Pelanggan_model->kategorymerchant()->result();
        $long = $dec_data->longitude;
        $lat = $dec_data->latitude;
        $merchantpromo = $this->Pelanggan_model->merchantpromo($long, $lat)->result();
        $merchantnearby = $this->Pelanggan_model->merchant_terdekat($long, $lat);


        $condition = array(
            'no_telepon' => $dec_data->no_telepon,
            'status' => '1'
        );
        $cek_login = $this->Pelanggan_model->get_data_pelanggan($condition);

        foreach ($app_settings as $item) {
            if ($cek_login->num_rows() > 0) {
                $message = array(
                    'code' => '200',
                    'message' => 'success',
                    'saldo' => $saldo->row('saldo'),
                    'currency' => $item['app_currency'],
                    'currency_text' => $item['app_currency_text'],
                    'app_aboutus' => $item['app_aboutus'],
                    'app_contact' => $item['app_contact'],
                    'app_website' => $item['app_website'],
                    'app_email' => $item['app_email'],
                    'background' => $item['background'],
                    'duitku_status' => $item['duitku_status'],
                    'apikey' => $item['map_key'],
                    'slider' => $slider,
                    'fitur' => $fitur['data'],
                    'allfitur' => $allfitur,
                    'ratinghome' => $rating,
                    'beritahome' => $berita,
                    'kategorymerchanthome' => $kategorymerchant,
                    'merchantnearby' => $merchantnearby,
                    'merchantpromo' => $merchantpromo,
                    'data' => $cek_login->result(),
                    'isotp' => $item['isotp'],
                    'CekKota' => $fitur['pesan'],
                    'appname' => $item['app_name'],
                    'jasaapp' => $item['jasaapp']
                );
                $this->response($message, 200);
            } else {
                $message = array(
                    'code' => '201',
                    'message' => 'failed',
                    'data' => []
                );
                $this->response($message, 201);
            }
        }
    }
    //------------------------------- Daftar Fitur --------------------------
    function detail_fitur_get()
    {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            return false;
        }
        $app_settings = $this->Pelanggan_model->get_settings();
        $biaya = $this->Pelanggan_model->get_biaya();
        foreach ($app_settings as $item) {
            $message = array(
                'data' => $biaya,
                'currency' => $item['app_currency'],
            );
            $this->response($message, 200);
        }
    }
    //------------------------------- Lokasi Pelanggan -----------------------
    function onlokasi_pelanggan_post()
    {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            return false;
        }
        $data = file_get_contents("php://input");
        $decoded_data = json_decode($data);
        $getdata = $this->Pelanggan_model->tigalist_lokasi_pelanggan($decoded_data->id,$decoded_data->limit);
        $message = array(
            'status' => true,
            'message' => 'success',
            'data' => $getdata->result()
        );
        $this->response($message, 200);
    }
    //------------------------------- Berita ---------------------------------
    function all_berita_post()
    {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            return false;
        }

        $data = file_get_contents("php://input");
        $dec_data = json_decode($data);
        $getberita = $this->Pelanggan_model->allberita();
        $message = array(
            'status' => true,
            'data' => $getberita
        );
        $this->response($message, 200);
    }
    function detail_berita_post()
    {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            return false;
        }

        $data = file_get_contents("php://input");
        $dec_data = json_decode($data);
        $getberita = $this->Pelanggan_model->beritadetail($dec_data->id);
        $message = array(
            'status' => true,
            'data' => $getberita->result()
        );
        $this->response($message, 200);
    }
    //--------------------------- Mitra -------------------------------------
    public function allmerchantbypencarian_post()
    {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            return false;
        }
        $data = file_get_contents("php://input");
        $dec_data = json_decode($data);


        $fitur = $dec_data->fitur;
        $kategori = $dec_data->kategori;
        $kategorymerchant = $this->Pelanggan_model->kategorymerchantbyfitur($fitur)->result();
        $long = $dec_data->longitude;
        $lat = $dec_data->latitude;
        $allmerchantnearby = $this->Pelanggan_model->allmerchantnearbysearch($long,$lat,$fitur,$kategori)->result();
        $condition = array(
            'no_telepon' => $dec_data->no_telepon,
            'status' => '1'
        );
        $cek_login = $this->Pelanggan_model->get_data_pelanggan($condition);

        if ($cek_login->num_rows() > 0) {
            $message = array(
                'code' => '200',
                'message' => 'success',
                'kategorymerchant' => $kategorymerchant,
                'allmerchantnearby' => $allmerchantnearby
            );
            $this->response($message, 200);
        } else {
            $message = array(
                'code' => '201',
                'message' => 'failed',
                'data' => []
            );
            $this->response($message, 201);
        }
    }
    public function merchantbyid_post()
    {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            return false;
        }
        $data = file_get_contents("php://input");
        $dec_data = json_decode($data);
        $idmerchant = $dec_data->idmerchant;
        $long = $dec_data->longitude;
        $lat = $dec_data->latitude;

        $merchantbyid = $this->Pelanggan_model->merchantbyid($idmerchant, $long, $lat)->row();
        $itemstatus = $this->Pelanggan_model->itemstatus($idmerchant)->row();
        if (empty($itemstatus->status_promo)) {
            $itempromo = '0';
        } else {
            $itempromo = $itemstatus->status_promo;
        }


        $itembyid = $this->Pelanggan_model->itembyid($idmerchant)->Result();
        $kategoriitem = $this->Pelanggan_model->kategoriitem($idmerchant)->Result();

        $condition = array(
            'no_telepon' => $dec_data->no_telepon,
            'status' => '1'
        );
        $cek_login = $this->Pelanggan_model->get_data_pelanggan($condition);

        if ($cek_login->num_rows() > 0) {

            $message = array(
                'code'              => '200',
                'message'           => 'success',
                'idfitur'           => $merchantbyid->id_fitur,
                'idmerchant'        => $merchantbyid->id_merchant,
                'namamerchant'      => $merchantbyid->nama_merchant,
                'alamatmerchant'    => $merchantbyid->alamat_merchant,
                'latmerchant'       => $merchantbyid->latitude_merchant,
                'longmerchant'      => $merchantbyid->longitude_merchant,
                'bukamerchant'      => $merchantbyid->jam_buka,
                'tutupmerchant'     => $merchantbyid->jam_tutup,
                'descmerchant'      => $merchantbyid->deskripsi_merchant,
                'fotomerchant'      => $merchantbyid->foto_merchant,
                'telpcmerchant'     => $merchantbyid->telepon_merchant,
                'distance'          => $merchantbyid->distance,
                'partner'           => $merchantbyid->partner,
                'kategori'          => $merchantbyid->nama_kategori,
                'promo'             => $itempromo,
                'itembyid'          => $itembyid,
                'kategoriitem'      => $kategoriitem


            );
            $this->response($message, 200);
        } else {
            $message = array(
                'code' => '201',
                'message' => 'failed',
                'data' => []
            );
            $this->response($message, 201);
        }
    }
    public function allmerchant_post()
    {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            return false;
        }
        $data = file_get_contents("php://input");
        $dec_data = json_decode($data);


        $fitur = $dec_data->fitur;
        $kategorymerchant = $this->Pelanggan_model->kategorymerchantbyfitur($fitur)->result();
        $long = $dec_data->longitude;
        $lat = $dec_data->latitude;
        $allmerchantnearby = $this->Pelanggan_model->allmerchantnearby($long,$lat,$fitur)->result();
        $condition = array(
            'no_telepon' => $dec_data->no_telepon,
            'status' => '1'
        );
        $cek_login = $this->Pelanggan_model->get_data_pelanggan($condition);

        if ($cek_login->num_rows() > 0) {
            $message = array(
                'code' => '200',
                'message' => 'success',
                'kategorymerchant' => $kategorymerchant,
                'allmerchantnearby' => $allmerchantnearby
            );
            $this->response($message, 200);
        } else {
            $message = array(
                'code' => '201',
                'message' => 'failed',
                'data' => []
            );
            $this->response($message, 201);
        }
    }
    public function allmerchantbykategori_post()
    {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            return false;
        }
        $data = file_get_contents("php://input");
        $dec_data = json_decode($data);


        $fitur = $dec_data->fitur;

        $long = $dec_data->longitude;
        $lat = $dec_data->latitude;
        $kategori = $dec_data->kategori;
        $allmerchantnearbybykategori = $this->Pelanggan_model->allmerchantnearbybykategori($long, $lat, $fitur, $kategori)->result();
        $condition = array(
            'no_telepon' => $dec_data->no_telepon,
            'status' => '1'
        );
        $cek_login = $this->Pelanggan_model->get_data_pelanggan($condition);

        if ($cek_login->num_rows() > 0) {
            $message = array(
                'code' => '200',
                'message' => 'success',
                'allmerchantnearby' => $allmerchantnearbybykategori
            );
            $this->response($message, 200);
        } else {
            $message = array(
                'code' => '201',
                'message' => 'failed',
                'allmerchantnearby' => []
            );
            $this->response($message, 201);
        }
    }
    function getkategori_item_post(){
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            return false;
        }

        $data = file_get_contents("php://input");
        $dec_data = json_decode($data);
        $getitem = $this->Pelanggan_model->allkategori_item($dec_data->id);

        $message = array(
            'message' => 'sukses',
            'data' => $getitem->result()
        );
        $this->response($message, 200);
    }
    public function itembykategori_post()
    {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            return false;
        }

        $data = file_get_contents("php://input");
        $dec_data = json_decode($data);
        $idmerchant = $dec_data->id;

        $itemk = $dec_data->kategori;
        $itembykategori = $this->Pelanggan_model->itembykategori($idmerchant, $itemk)->result();

        $condition = array(
            'no_telepon' => $dec_data->no_telepon,
            'status' => '1'
        );
        $cek_login = $this->Pelanggan_model->get_data_pelanggan($condition);

        if ($cek_login->num_rows() > 0) {

            $message = array(
                'code'              => '200',
                'message'           => 'success',
                'itembyid'          => $itembykategori


            );
            $this->response($message, 200);
        } else {
            $message = array(
                'code' => '201',
                'message' => 'failed',
                'data' => []
            );
            $this->response($message, 201);
        }
    }
    function inserttransaksimerchant_post()
    {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            return false;
        } else {
            $cek = $this->Pelanggan_model->check_banned_user($_SERVER['PHP_AUTH_USER']);
            if ($cek) {
                $message = array(
                    'message' => 'fail',
                    'data' => 'Status User Banned'
                );
                $this->response($message, 200);
            }
        }

        $data = file_get_contents("php://input");
        $dec_data = json_decode($data);

        $data_transaksi = array(
            'id_pelanggan'      => $dec_data->id_pelanggan,
            'order_fitur'       => $dec_data->order_fitur,
            'start_latitude'    => $dec_data->start_latitude,
            'start_longitude'   => $dec_data->start_longitude,
            'end_latitude'      => $dec_data->end_latitude,
            'end_longitude'     => $dec_data->end_longitude,
            'jarak'             => $dec_data->jarak,
            'harga'             => $dec_data->harga,
            'jasaapp'             => $dec_data->jasaapp,
            'waktu_order'       => date('Y-m-d H:i:s'),
            'estimasi_time'     => $dec_data->estimasi,
            'alamat_asal'       => $dec_data->alamat_asal,
            'alamat_tujuan'     => $dec_data->alamat_tujuan,
            'kredit_promo'      => $dec_data->kredit_promo,

            'pakai_wallet'      => $dec_data->pakai_wallet,
        );
        $total_belanja = [
            'total_belanja'     => $dec_data->total_biaya_belanja,
        ];



        $dataDetail = [
            'id_merchant'   => $dec_data->id_resto,
            'total_biaya'   => $dec_data->total_biaya_belanja,
            'struk'   => rand(0, 9999),

        ];



        $result = $this->Pelanggan_model->insert_data_transaksi_merchant($data_transaksi, $dataDetail, $total_belanja);

        if ($result['status'] == true) {


            $pesanan = $dec_data->pesanan;

            foreach ($pesanan as $pes) {
                $item[] = [
                    'catatan_item' => $pes->catatan,
                    'id_item' => $pes->id_item,
                    'id_merchant' => $dec_data->id_resto,
                    'id_transaksi' => $result['id_transaksi'],
                    'jumlah_item' => $pes->qty,
                    'total_harga' => $pes->total_harga,
                ];
            }

            $request = $this->Pelanggan_model->insert_data_item($item);

            if ($request['status']) {
                $message = array(
                    'message' => 'success',
                    'data' => $result['data'],


                );
                $this->response($message, 200);
            } else {
                $message = array(
                    'message' => 'fail',
                    'data' => []

                );
                $this->response($message, 200);
            }
        } else {
            $message = array(
                'message' => 'fail',
                'data' => []

            );
            $this->response($message, 200);
        }
    }
    public function insert_data_item($item)
    {
        foreach ($item as $it) {
            $this->db->insert('transaksi_item', $it);
        }


        if ($this->db->affected_rows() == 1) {
            return array(
                'status'        => true,

            );
        } else {
            return array(
                'status' => false
            );
        }
    }
    //----------------------------- Order Kurir --------------------------------------------
    function request_transaksi_send_post()
    {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            return false;
        } else {
            $cek = $this->Pelanggan_model->check_banned_user($_SERVER['PHP_AUTH_USER']);
            if ($cek) {
                $message = array(
                    'message' => 'fail',
                    'data' => 'Status User Banned'
                );
                $this->response($message, 200);
            }
        }

        $data = file_get_contents("php://input");
        $dec_data = json_decode($data);

        $data_req = array(
            'id_pelanggan' => $dec_data->id_pelanggan,
            'order_fitur' => $dec_data->order_fitur,
            'start_latitude' => $dec_data->start_latitude,
            'start_longitude' => $dec_data->start_longitude,
            'end_latitude' => $dec_data->end_latitude,
            'end_longitude' => $dec_data->end_longitude,
            'jarak' => $dec_data->jarak,
            'harga' => $dec_data->harga,
            'estimasi_time' => $dec_data->estimasi,
            'waktu_order' => date('Y-m-d H:i:s'),
            'alamat_asal' => $dec_data->alamat_asal,
            'alamat_tujuan' => $dec_data->alamat_tujuan,
            'biaya_akhir' => $dec_data->harga,
            'kredit_promo' => $dec_data->kredit_promo,
            'pakai_wallet' => $dec_data->pakai_wallet,
            'tanggal' => date('d/M/Y')
        );


        $dataDetail = array(
            'nama_pengirim' => $dec_data->nama_pengirim,
            'telepon_pengirim' => $dec_data->telepon_pengirim,
            'nama_penerima' => $dec_data->nama_penerima,
            'telepon_penerima' => $dec_data->telepon_penerima,
            'nama_barang' => $dec_data->nama_barang
        );

        $request = $this->Pelanggan_model->insert_transaksi_send($data_req, $dataDetail);
        if ($request['status']) {
            $message = array(
                'message' => 'success',
                'data' => $request['data']->result()
            );
            $this->response($message, 200);
        } else {
            $message = array(
                'message' => 'fail',
                'data' => []
            );
            $this->response($message, 200);
        }
    }
    //----------------------------- Get Direction ------------------------------------------
    function getdirection_post(){
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
                   header("WWW-Authenticate: Basic realm=\"Private Area\"");
                   header("HTTP/1.0 401 Unauthorized");
                   return false;
               }
               $data = file_get_contents("php://input");
               $decoded_data = json_decode($data);
   
               $datasetting = $this->Pelanggan_model->datasetting()->row();
               $apikey = $datasetting->map_key;
               
               $origin = $decoded_data->asal;
               $dest = $decoded_data->tujuan;
               $urlapi = "https://maps.googleapis.com/maps/api/directions/json?origin=".$origin."&destination=".$dest."&sensor=true&mode=driving&language=id&region=ID&key=".$apikey;
               $header = [
                   'accept: application/json',
                   'content-type: application/json'
               ];   
              
               $ch = curl_init();
               curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
               curl_setopt($ch, CURLOPT_URL, $urlapi);
               curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
               curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
               curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
               curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
               $result = curl_exec($ch); 
               $message = array(
                       'message' => 'sukses',
                       'data' => $result
               );
               $this->response($message, 200);
               curl_close($ch);   
    }
    function getaddress_post(){
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
                   header("WWW-Authenticate: Basic realm=\"Private Area\"");
                   header("HTTP/1.0 401 Unauthorized");
                   return false;
               }
               $data = file_get_contents("php://input");
               $decoded_data = json_decode($data);
   
               $datasetting = $this->Pelanggan_model->datasetting()->row();
               $apikey = $datasetting->map_key;
               
               $latitude = $decoded_data->latitude;
               $longitude = $decoded_data->longitude;
               $urlapi = "https://maps.googleapis.com/maps/api/geocode/json?latlng=".$latitude.",".$longitude."&sensor=true&language=id&region=ID&key=".$apikey;
               $header = [
                   'accept: application/json',
                   'content-type: application/json'
               ];   
              
               $ch = curl_init();
               curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
               curl_setopt($ch, CURLOPT_URL, $urlapi);
               curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
               curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
               curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
               curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
               $result = curl_exec($ch); 
               $message = array(
                       'message' => 'sukses',
                       'data' => $result
               );
               $this->response($message, 200);
               curl_close($ch);   
    }
    //--------------------------- Home Transaksi ----------------------------------------
    function hometransaksi_post()
    {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            return false;
        }
        $data = file_get_contents("php://input");
        $decoded_data = json_decode($data);
        $getdata = $this->Pelanggan_model->all_progress($decoded_data->id);
        $message = array(
            'status' => true,
            'message' => 'found',
            'data' => $getdata->result()
        );
        $this->response($message, 200);
    }
    //------------------------- Transaksi ------------------------------
    function rate_driver_post()
    {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            return false;
        }

        $data = file_get_contents("php://input");
        $dec_data = json_decode($data);

        $data_rate = array();
        if ($dec_data->catatan == "") {
            $data_rate = array(
                'id_pelanggan' => $dec_data->id_pelanggan,
                'id_driver' => $dec_data->id_driver,
                'rating' => $dec_data->rating,
                'id_transaksi' => $dec_data->id_transaksi
            );
        } else {
            $data_rate = array(
                'id_pelanggan' => $dec_data->id_pelanggan,
                'id_driver' => $dec_data->id_driver,
                'rating' => $dec_data->rating,
                'id_transaksi' => $dec_data->id_transaksi,
                'catatan' => $dec_data->catatan
            );
        }

        $finish_transaksi = $this->Pelanggan_model->rate_driver($data_rate);
        if ($finish_transaksi) {
            $message = array(
                'message' => 'success',
                'data' => []
            );
            $this->response($message, 200);
        } else {
            $message = array(
                'message' => 'fail',
                'data' => []
            );
            $this->response($message, 200);
        }
    }
    function getpoin_driver_post()
    {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            return false;
        }
        $data = file_get_contents("php://input");
        $decoded_data = json_decode($data);
        $getPromo = $this->Pelanggan_model->data_poin($decoded_data->id);
        $message = array(
            'message' => 'success',
            'status' => true,
            'data' => $getPromo->result()
        );
        $this->response($message, 200);
    }
    function getsaldo_driver_post()
    {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            return false;
        }
        $data = file_get_contents("php://input");
        $decoded_data = json_decode($data);
        $getPromo = $this->Pelanggan_model->data_saldo($decoded_data->id);
        $message = array(
            'message' => 'success',
            'status' => true,
            'data' => $getPromo->result()
        );
        $this->response($message, 200);
    }
    public function sendpoin_driver_post()
    {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            return false;
        }

        $data = file_get_contents("php://input");
        $dec_data = json_decode($data);
        $id = $dec_data->id;
        $amount = $dec_data->amount;
            $pointlama = $this->Pelanggan_model->pointuser($id);
            $tambahpoint = $pointlama->row('point') + $amount;
            $saldo = array('point' => $tambahpoint);
            $this->Pelanggan_model->tambahpoin($id, $saldo);
            $message = array(
                'code' => '200',
                'message' => 'success',
                'data' => []
            );
        $this->response($message, 200);
    }
    public function kirimtips_driver_post()
    {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            return false;
        }

        $data = file_get_contents("php://input");
        $dec_data = json_decode($data);
        $iduser = $dec_data->id;
        $iddriver = $dec_data->iddriver;
        $nama = $dec_data->nama;
        $amount = $dec_data->amount;
        $email = $dec_data->email;
        $phone = $dec_data->no_telepon;
        $numberreff = rand ( 10000 , 99999 );
        $datatopup = array(
            'id_user' => $iduser,
            'rekening' => 'sistem',
            'bank' => 'sistem',
            'nama_pemilik' => $nama,
            'type' => 'tip',
            'jumlah' => $amount,
             'reff' => 'tip'.$numberreff,
            'status' => 1
        );
        $datawallet = array(
            'id_user' => $iddriver,
            'rekening' => 'sistem',
            'bank' => 'order',
            'nama_pemilik' => $nama,
            'type' => 'tip',
            'jumlah' => $amount,
            'reff' => 'drivertip'.$numberreff,
            'status' => 1
        );
       
        $check_exist = $this->Pelanggan_model->check_exist($email, $phone);
        $this->Pelanggan_model->insertwallet($datawallet);
        if ($check_exist) {
            $this->Pelanggan_model->insertwallet($datatopup);
            //kurangi saldo
            $saldolama = $this->Pelanggan_model->saldouser($iduser);
            $saldobaru = $saldolama->row('saldo') - $amount;
            $saldo = array('saldo' => $saldobaru);
            $this->Pelanggan_model->tambahsaldo($iduser, $saldo);
            //kasih tip
            $saldodriver = $this->Pelanggan_model->saldouser($iddriver);
            $saldodriverbaru = $saldodriver->row('saldo') + $amount;
            $dsaldo = array('saldo' => $saldodriverbaru);
            $this->Pelanggan_model->tambahsaldo($iddriver, $dsaldo);
            $message = array(
                'code' => '200',
                'message' => 'success',
                'data' => []
            );
           
            $this->response($message, 200);
        } else {
            $message = array(
                'code' => '201',
                'message' => 'You have insufficient balance',
                'data' => []
            );
            $this->response($message, 200);
        }
    }
    //------------------------------------------- Wallet -------------------------------------------
    function wallet_post()
    {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            return false;
        }
        $data = file_get_contents("php://input");
        $decoded_data = json_decode($data);
        $getWallet = $this->Pelanggan_model->getwallet($decoded_data->id);
        $message = array(
            'status' => true,
            'message' => 'sukses',
            'data' => $getWallet->result()
        );
        $this->response($message, 200);
    }
    function walletnow_post()
    {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            return false;
        }
        $data = file_get_contents("php://input");
        $decoded_data = json_decode($data);
        $getWallet = $this->Pelanggan_model->getwalletnow($decoded_data->id);
        $message = array(
            'status' => true,
            'message' => 'sukses',
            'data' => $getWallet->result()
        );
        $this->response($message, 200);
    }
    function walletbulanini_post()
    {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            return false;
        }
        $data = file_get_contents("php://input");
        $decoded_data = json_decode($data);
        $getWallet = $this->Pelanggan_model->getwalletbulanini($decoded_data->id);
        $message = array(
            'status' => true,
            'message' => 'sukses',
            'data' => $getWallet->result()
        );
        $this->response($message, 200);
    }
    //------------------------------------------- Chat ---------------------------------------------
    function inbox_post()
    {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            return false;
        }
        $data = file_get_contents("php://input");
        $decoded_data = json_decode($data);

        $listinbox = $this->Pelanggan_model->datainbox($decoded_data->id);

        $message = [
            'code' => '200',
            'message' => 'success',
            'data' => $listinbox
        ];
        $this->response($message, 200);
    }
    function chat_post()
   {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            return false;
        }

        $data = file_get_contents("php://input");
        $decoded_data = json_decode($data);

        $namafoto = time() . '-' . rand(0, 99999) . ".jpg";
        if($decoded_data->fotochat == "0"){
            $datachat = array(
                'idtrans' => $decoded_data->idtrans,
                'idcust' => $decoded_data->idpelanggan,
                'iddriver' => $decoded_data->iddriver,
                'pesan' => $decoded_data->pesan,
                'fotochat' => '0',
                'level' => '0',
                'tanggal' => date('d-m-Y'),
                'jam' => date('H:i:s')
            );
        }else{
            $datachat = array(
                'idtrans' => $decoded_data->idtrans,
                'idcust' => $decoded_data->idpelanggan,
                'iddriver' => $decoded_data->iddriver,
                'pesan' => $decoded_data->pesan,
                'fotochat' => $namafoto,
                'level' => '0',
                'tanggal' => date('d-m-Y'),
                'jam' => date('H:i:s')
            );
        }
        
        $this->Pelanggan_model->insertchat($datachat,$decoded_data->fotochat,$namafoto);
        $message = array(
            'message' => 'sukses'
        );
        $this->response($message, 200);
   }
   function getchat_post(){

        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            return false;
        }

        $data = file_get_contents("php://input");
        $decoded_data = json_decode($data);

        $datachat = $this->Pelanggan_model->datachat($decoded_data->idtrans);
        $message = array(
            'message' => 'sukses',
            'data' => $datachat
        );
        $this->response($message, 200);
   }
    function chat_notif_post(){
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            return false;
        }

        $data = file_get_contents("php://input");
        $decoded_data = json_decode($data);
        $datasetting = $this->Pelanggan_model->datasetting()->row();
        $serverkey = $datasetting->fcm_key;
        $weburl = $datasetting->app_website;
        
        $url = "https://fcm.googleapis.com/fcm/send";   
        $header = [
            'authorization: key='.$serverkey,
            'content-type: application/json'
        ];
        $idtrans = $decoded_data->idtrans;
        $id = $decoded_data->id;
        $username = $decoded_data->nama;
        $foto = $decoded_data->foto;
        $notification = [
            'title' => $decoded_data->title,
            'body' => $decoded_data->body
        ];
    
        $extraNotificationData = [
            "message" => $decoded_data->body,
            "idtrans" =>$idtrans,
            "id" =>$id,
            "nama" =>$username,
            "foto" =>$foto,
            "token" =>$decoded_data->token,
            "type" =>$decoded_data->type
        ];

        $fcmNotification = [
            'to'        => $decoded_data->token,
            'notification' => $notification,
            'priority'          => 'high', 
            'data' => $extraNotificationData
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        $result = curl_exec($ch); 
        $message = array(
                'message' => 'sukses'
        );
        $this->response($message, 200);
        curl_close($ch);
    }
    //--------------------------- Booking Order ----------------------------------
    function list_ride_post()
    {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            return false;
        }

        $data = file_get_contents("php://input");
        $dec_data = json_decode($data);

        $near = $this->Pelanggan_model->get_driver_ride($dec_data->latitude, $dec_data->longitude, $dec_data->fitur);
        $message = array(
            'data' => $near->result()
        );
        $this->response($message, 200);
    }
    function request_transaksi_post()
    {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            return false;
        } else {
            $cek = $this->Pelanggan_model->check_banned_user($_SERVER['PHP_AUTH_USER']);
            if ($cek) {
                $message = array(
                    'message' => 'fail',
                    'data' => 'Status User Banned'
                );
                $this->response($message, 200);
            }
        }

        $data = file_get_contents("php://input");
        $dec_data = json_decode($data);

        $data_req = array(
            'id_pelanggan' => $dec_data->id_pelanggan,
            'order_fitur' => $dec_data->order_fitur,
            'start_latitude' => $dec_data->start_latitude,
            'start_longitude' => $dec_data->start_longitude,
            'end_latitude' => $dec_data->end_latitude,
            'end_longitude' => $dec_data->end_longitude,
            'jarak' => $dec_data->jarak,
            'harga' => $dec_data->harga,
            'estimasi_time' => $dec_data->estimasi,
            'waktu_order' => date('Y-m-d H:i:s'),
            'alamat_asal' => $dec_data->alamat_asal,
            'alamat_tujuan' => $dec_data->alamat_tujuan,
            'biaya_akhir' => $dec_data->total,
            'kredit_promo' => $dec_data->kredit_promo,
            'jenis' => $dec_data->jenis,
            'pakai_wallet' => $dec_data->pakai_wallet,
            'tanggal' => date('d/M/Y')
        );

        $request = $this->Pelanggan_model->insert_transaksi($data_req);
        if ($request['status']) {
            $message = array(
                'message' => 'success',
                'data' => $request['data']
            );
            $this->response($message, 200);
        } else {
            $message = array(
                'message' => 'fail',
                'data' => $request['data']
            );
            $this->response($message, 200);
        }
    }
    function detail_transaksi_post()
    {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            return false;
        }

        $data = file_get_contents("php://input");
        $dec_data = json_decode($data);
        $gettrans = $this->Pelanggan_model->transaksi($dec_data->id);
        $getdriver = $this->Pelanggan_model->detail_driver($dec_data->id_driver);
        $getitem = $this->Pelanggan_model->detail_item($dec_data->id);

        $message = array(
            'status' => true,
            'data' => $gettrans->result(),
            'driver' => $getdriver->result(),
            'item' => $getitem->result(),

        );
        $this->response($message, 200);
    }
    //-------------------------- Batalkan Pesanan -------------------------------------
    function user_cancel_post()
    {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            return false;
        }

        $data = file_get_contents("php://input");
        $dec_data = json_decode($data);

        $data_req = array(
            'id_transaksi' => $dec_data->id_transaksi
        );
        $cancel_req = $this->Pelanggan_model->user_cancel_request($data_req);
        if ($cancel_req['status']) {
            $message = array(
                'message' => 'canceled',
                'data' => []
            );
            $this->response($message, 200);
        } else {
            $message = array(
                'message' => 'cancel fail',
                'data' => []
            );
            $this->response($message, 200);
        }
    }
    function check_status_transaksi_post()
    {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            return false;
        }

        $data = file_get_contents("php://input");
        $dec_data = json_decode($data);

        $dataTrans = array(
            'id_transaksi' => $dec_data->id_transaksi
        );

        $getStatus = $this->Pelanggan_model->check_status($dataTrans);
        $this->response($getStatus, 200);
    }
    
    //---------------------- Cek Status Transaksi ---------------------------------
    function update_token_post()
    {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            return false;
        }
        $data = file_get_contents("php://input");
        $decoded_data = json_decode($data);
       
        $reg_id = array(
            'token' => $decoded_data->token
        );
        $getdata = $this->Pelanggan_model->updatetoken($reg_id,$decoded_data->id);
        $message = array(
            'status' => true,
            'message' => 'success'
        );
        $this->response($message, 200);
    }
    //---------------- wallet -----------------------------------
    public function withdraw_post()
    {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            return false;
        }

        $data = file_get_contents("php://input");
        $dec_data = json_decode($data);

        $iduser = $dec_data->id;
        $bank = $dec_data->bank;
        $nama = $dec_data->nama;
        $amount = $dec_data->amount;
        $card = $dec_data->card;
        $email = $dec_data->email;
        $phone = $dec_data->no_telepon;
        $numberreff = rand ( 10000 , 99999 );
        $saldolama = $this->Pelanggan_model->saldouser($iduser);
        $datawithdraw = array(
            'id_user' => $iduser,
            'rekening' => $card,
            'bank' => $bank,
            'nama_pemilik' => $nama,
            'type' => $dec_data->type,
            'jumlah' => $amount,
            'status' => 0,
            'reff' => $numberreff
        );
        $check_exist = $this->Pelanggan_model->check_exist($email, $phone);

        if ($dec_data->type ==  "topup") {
            $withdrawdata = $this->Pelanggan_model->insertwallet($datawithdraw);

            $message = array(
                'code' => '200',
                'message' => 'success',
                'data' => []
            );
            $this->response($message, 200);
        } else {

            if ($saldolama->row('saldo') >= $amount && $check_exist) {
                $withdrawdata = $this->Pelanggan_model->insertwallet($datawithdraw);

                $message = array(
                    'code' => '200',
                    'message' => 'success',
                    'data' => []
                );
                $this->response($message, 200);
            } else {
                $message = array(
                    'code' => '201',
                    'message' => 'You have insufficient balance',
                    'data' => []
                );
                $this->response($message, 200);
            }
        }
    }
    function list_bank_post()
    {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            return false;
        }

        $near = $this->Pelanggan_model->listbank();
        $message = array(
            'data' => $near->result()
        );
        $this->response($message, 200);
    }
    //---------------- Histori ----------------------------------
    function history_progress_post()
    {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            return false;
        }
        $data = file_get_contents("php://input");
        $decoded_data = json_decode($data);
        $getWallet = $this->Pelanggan_model->all_transaksi($decoded_data->id);
        $message = array(
            'status' => true,
            'data' => $getWallet->result()
        );
        $this->response($message, 200);
    }
    //------------------------------- Paket ---------------------------------
    function allpaket_post()
    {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            return false;
        }

        $data = file_get_contents("php://input");
        $dec_data = json_decode($data);
        $getpaket = $this->Pelanggan_model->allpaket();
        $message = array(
            'message' => 'Sukses',
            'data' => $getpaket
        );
        $this->response($message, 200);
    }
    function liat_lokasi_driver_post()
    {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            return false;
        }

        $data = file_get_contents("php://input");
        $dec_data = json_decode($data);
        $getLoc = $this->Pelanggan_model->get_driver_location($dec_data->id);
        $message = array(
            'status' => true,
            'data' => $getLoc->result()
        );
        $this->response($message, 200);
    }
}