<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggan_model extends CI_model
{

    function __construct()
    {
        parent::__construct();
    }
    public function count_user()
    {
        $this->db->select('count(id) as count');
        $this->db->from('pelanggan');
        return $this->db->get();
    }
    public function check_phone_number($number)
    {
        $cek = $this->db->query("SELECT id FROM pelanggan where phone='$number'");
        if ($cek->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }
    public function dataforgot($forgotpass)
    {
        $forgot = $this->db->insert('forgot_password', $forgotpass);
        return $forgot;
    }
    //---------------------- Wallet ------------------------------------------
    public function getwallet($id)
    {
        $this->db->select('*');
        $this->db->from('wallet');
        $this->db->where('id_user', $id);
        $this->db->order_by('id', 'DESC');
        return $this->db->get();
    }

    public function getwalletnow($id)
    {
        $date = new DateTime("now");
        $curr_date = $date->format('Y-m-d ');
        $this->db->select('*');
        $this->db->from('wallet');
        $this->db->where('id_user', $id);
        $this->db->where('DATE(waktu)',$curr_date);
        $this->db->order_by('id', 'DESC');
        return $this->db->get();
    }
    public function getwalletbulanini($id)
    {
        $date = new DateTime("now");
        $curr_date = $date->format('Y-m-d ');
        $firstdate = $date->format('Y-m-01 ');
        $this->db->select('*');
        $this->db->from('wallet');
        $this->db->where('id_user', $id);
        $this->db->where('DATE(waktu) BETWEEN "'. $firstdate. '" AND "'. $curr_date. '" ');
        $this->db->order_by('id', 'DESC');
        return $this->db->get();
    }
    //----------------- Get Data App Setting ----------------------------------
    public function get_settings()
    {
        $this->db->select('*');
        $this->db->from('app_settings');
        $this->db->where('id', '1');
        return $this->db->get()->result_array();
    }
    function datasetting()
    {
        $this->db->select('*');
        $this->db->from('app_settings');
        $this->db->where('id', '1');
        return $this->db->get();
    }
    //------------------ List Banner -----------------------------------------
    function list_slider($fitur_promosi)
    {
        $this->db->select('*');
        $this->db->from('promosi');
        $this->db->where('promosi.fitur_promosi', $fitur_promosi);
        $this->db->where('is_show', '1');
        $this->db->where('tanggal_berakhir>', date("Y-m-d"));
        $trans = $this->db->get();
        return $trans;
    }
    //-------------------- Cek Akun -----------------------------------------
    public function check_banned($phone)
    {
        $stat =  $this->db->query("SELECT id FROM pelanggan WHERE status='3' AND no_telepon='$phone'");
        if ($stat->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }
    function check_banned_user($email)
    {
        $this->db->select('*');
        $this->db->from('pelanggan');
        $this->db->where('email', $email);
        $this->db->where("(status = '2' OR status = '3')", NULL, FALSE);
        $cek = $this->db->get();
        if ($cek->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    public function check_exist($email, $phone)
    {
        $cek = $this->db->query("SELECT id FROM pelanggan where email = '$email' AND no_telepon='$phone'");
        if ($cek->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }
    public function check_exist_email_edit($id, $email)
    {
        $cek = $this->db->query("SELECT id FROM pelanggan where email='$email' AND id!='$id'");
        if ($cek->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }
    public function check_exist_phone_edit($id, $phone)
    {
        $cek = $this->db->query("SELECT no_telepon FROM pelanggan where no_telepon='$phone' AND id!='$id'");
        if ($cek->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }
    public function check_exist_phone($phone)
    {
        $cek = $this->db->query("SELECT id FROM pelanggan where no_telepon='$phone'");
        if ($cek->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }
    public function check_exist_email($email)
    {
        $cek = $this->db->query("SELECT id FROM pelanggan where email='$email'");
        if ($cek->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }
    //-------------------- Signup ----------------------------------------------
    public function signup($data_signup)
    {
         $dataconfig = array(
            'id_user' => $data_signup['id'],
            'latitude' => '0',
            'longitude' => '0',
            'bearing' => '0'
        );
        $insconfig = $this->db->insert('config_user', $dataconfig);
        $signup = $this->db->insert('pelanggan', $data_signup);
        $dataIns = array(
            'id_user' => $data_signup['id'],
            'saldo' => 0
        );
        $insSaldo = $this->db->insert('saldo', $dataIns);
        return $signup;
    }
    //-------------------- Data Pelanggan --------------------------------------
    public function get_data_pelanggan($condition)
    {
        $this->db->select('pelanggan.*, saldo.saldo');
        $this->db->from('pelanggan');
        $this->db->join('saldo', 'pelanggan.id = saldo.id_user');
        $this->db->where($condition);
        return $this->db->get();
    }
    //-------------------- Edit Profile ----------------------------------------
    public function edit_profile($data, $email)
    {
        $this->db->where('no_telepon', $email);
        $this->db->update('pelanggan', $data);
        return true;
    }
    //---------------- Promo By Fitur -----------------------------------------
    function promofitur_code($fitur)
    {
        $this->db->select('*');
        $this->db->from('kodepromo');
        $this->db->where("status", 1);
        $this->db->where('expired >', date("Y-m-d"));
        $this->db->where('fitur', $fitur);
        $this->db->order_by('id_promo', 'DESC');
        return $this->db->get()->result();
    }
    //-------------------- Slider ---------------------------------------------
    public function sliderhome()
    {
        $this->db->select('*');
        $this->db->from('promosi');
        $this->db->join('fitur', 'promosi.fitur_promosi = fitur.id_fitur', 'left');
        $this->db->where('is_show', '1');
        $this->db->where('tanggal_berakhir>', date("Y-m-d"));
        return $this->db->get()->result_array();
    }
    //-------------------------- Home Fitur -----------------------------------------
    public function fiturhome($kota)
    {
        $this->db->select('*');
        $this->db->from('fitur');
        $this->db->where('kota', $kota);
        $this->db->where('active', '1');
        $this->db->order_by('id_fitur ASC');
        $this->db->limit('7');
        $datafitur = $this->db->get();
        if ($datafitur->num_rows() > 0) {
            $out = [
                'pesan' => 'kota terdaftar',
                'data' => $datafitur->result_array()
            ];
            return $out;
        } else {
            $this->db->select('*');
            $this->db->from('fitur');
            $this->db->where('kota', 'all');
            $this->db->where('active', '1');
            $this->db->limit('7');
            $this->db->order_by('id_fitur ASC');
            $dataallfitur = $this->db->get();
            $out = [
                'pesan' => 'kota tidak terdaftar',
                'data' => $dataallfitur->result_array()
            ];
            return $out;
        }
    }
    public function fiturhomeall()
    {
        $this->db->select('*');
        $this->db->from('fitur');
        $this->db->where('active', '1');
        $this->db->order_by('id_fitur ASC');
        return $this->db->get()->result_array();
    }
    public function beritahome()
    {
        $this->db->select('*');
        $this->db->from('berita');
        $this->db->join('kategori_news', 'berita.id_kategori = kategori_news.id_kategori_news', 'left');
        $this->db->order_by('id_berita DESC');
        $this->db->limit('4');
        $this->db->where('status_berita', 1);
        return $this->db->get()->result_array();
    }
    //------------------------------- rate Home -----------------------------------
    public function ratinghome()
    {
        $this->db->select('rating_driver.*, pelanggan.*');
        $this->db->from('rating_driver');
        $this->db->where('rating_driver.rating != 0');
        $this->db->where('rating_driver.rating != 1');
        $this->db->where('rating_driver.rating != 2');
        $this->db->where('rating_driver.rating != 3');
        $this->db->join('pelanggan', 'rating_driver.id_pelanggan = pelanggan.id', 'left');
        $this->db->order_by('rating_driver.nomor DESC');
        $this->db->limit('3');
        return $this->db->get()->result_array();
    }
    //------------------------ Get Saldo user ----------------------------------------
    public function saldouser($id)
    {
        $this->db->select('saldo');
        $this->db->from('saldo');
        $this->db->where('id_user', $id);
        $saldo = $this->db->get();
        return $saldo;
    }
    function listbank()
    {
        $this->db->select('*');
        $this->db->from('list_bank');
        $this->db->where('status_bank', "1");
        return $this->db->get();
    }
    //------------------- Kurir -------------------------------------------------------------
    public function insert_transaksi_send($data_req, $dataDetail)
    {

        $ha = 0;
        $kreditamuont = explode(".", $data_req['kredit_promo']);
        $ha  = $data_req['harga'] - $kreditamuont[0];
        if ($ha <= 0) {
            $ha = 0;
        }
        $data_req['kredit_promo'] = $kreditamuont[0];
        $data_req['biaya_akhir'] = $ha;

        $ins_trans = $this->db->insert('transaksi', $data_req);
        $reqid = $this->db->insert_id();
        if ($this->db->affected_rows() == 1) {
            $data_hist = array(
                'id_transaksi' => $reqid,
                'id_driver' => 'D0',
                'status' => '1'
            );
            $this->db->insert('history_transaksi', $data_hist);
            $dataDetail['id_transaksi'] = $reqid;
            $this->db->insert('transaksi_detail_send', $dataDetail);
            $get_data_msend = $this->get_data_transaksi_send($data_req);
            return array(
                'status' => true,
                'data' => $get_data_msend
            );
        } else {
            return array(
                'status' => false,
                'data' => []
            );
        }
    }

    function get_data_transaksi_send($data_cond)
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->join('transaksi_detail_send', 'transaksi.id = transaksi_detail_send.id_transaksi', 'left');
        $this->db->where($data_cond);
        $cek = $this->db->get();
        return $cek;
    }
    //------------------- merchant ----------------------------------------------------------
    public function allmerchantnearbypencarian($long,$lat,$fitur,$kategori)
    {
        $this->db->select("merchant.id_merchant , 
            merchant.nama_merchant , 
            merchant.alamat_merchant , 
            merchant.latitude_merchant , 
            merchant.longitude_merchant , 
            merchant.jam_buka , 
            merchant.jam_tutup ,
            merchant.deskripsi_merchant , 
            merchant.category_merchant , 
            merchant.foto_merchant , 
            merchant.telepon_merchant , 
            merchant.status_merchant , 
            merchant.open_merchant,saldo.saldo,

            (6371 * acos(cos(radians($lat)) * cos(radians(merchant.latitude_merchant)) * cos(radians(merchant.longitude_merchant) - radians( $long)) + sin(radians($lat)) * sin( radians(merchant.latitude_merchant)))) AS distance
            ,(SELECT item.status_promo FROM item where merchant.id_merchant = item.id_merchant AND status_item = 1 ORDER BY status_promo DESC LIMIT 1) AS status_promo, fitur.jarak_minimum, fitur.wallet_minimum");
            $this->db->select('category_merchant.nama_kategori');
            $this->db->where('mitra.partner = 1');
            $this->db->where('merchant.status_merchant = 1');
            $this->db->where('mitra.status_mitra = 1');
            $this->db->where("merchant.id_fitur = $fitur");
            $this->db->where('saldo.saldo >= fitur.wallet_minimum');
            $this->db->like('item.nama_item', $kategori);
            $this->db->like('merchant.nama_merchant', $kategori);
            $this->db->like('category_merchant.nama_kategori', $kategori);
            $this->db->having("status_promo is not null");
            $this->db->having("distance <= fitur.jarak_minimum");
            $this->db->order_by('distance ASC');
            $this->db->join('fitur', 'merchant.id_fitur = fitur.id_fitur', 'left');
            $this->db->join('mitra', 'mitra.id_merchant = merchant.id_merchant', 'left');
            $this->db->join('item', 'item.id_merchant = merchant.id_merchant', 'left');
            $this->db->join('saldo', 'mitra.id_mitra = saldo.id_user', 'left');
            $this->db->join('category_merchant', 'merchant.category_merchant = category_merchant.id_kategori_merchant', 'left');
         return $this->db->get('merchant');
    }
    public function kategorymerchant()
    {
        $this->db->select('category_merchant.*');
        $this->db->where('category_merchant.status_kategori = 1');
        $this->db->where('fitur.active = 1');
        $this->db->or_where('category_merchant.id_fitur = 0');
        $this->db->join('fitur', 'category_merchant.id_fitur = fitur.id_fitur', 'left');
        return $this->db->get('category_merchant');
    }
    public function allmerchantnearbybykategori($long, $lat, $fitur, $kategori)
    {
        $this->db->select("merchant.id_merchant , merchant.nama_merchant , merchant.alamat_merchant , merchant.latitude_merchant , merchant.longitude_merchant , merchant.jam_buka , merchant.jam_tutup ,
            merchant.deskripsi_merchant , merchant.category_merchant , merchant.foto_merchant , merchant.telepon_merchant , merchant.status_merchant , merchant.open_merchant,saldo.saldo,
            (6371 * acos(cos(radians($lat)) * cos(radians(merchant.latitude_merchant)) * cos(radians(merchant.longitude_merchant) - radians( $long)) + sin(radians($lat)) * sin( radians(merchant.latitude_merchant)))) AS distance
            ,(SELECT item.status_promo FROM item where merchant.id_merchant = item.id_merchant AND status_item = 1 ORDER BY status_promo DESC LIMIT 1) AS status_promo, fitur.jarak_minimum, fitur.wallet_minimum");
        $this->db->select('category_merchant.nama_kategori');


        $this->db->where('merchant.status_merchant = 1');
        $this->db->where('mitra.status_mitra = 1');
        $this->db->where("merchant.id_fitur = $fitur");
        $this->db->where('saldo.saldo >= fitur.wallet_minimum');
        if ($kategori != '1') {
            $this->db->where("merchant.category_merchant = $kategori");
        }

        $this->db->having("status_promo is not null");
        $this->db->having("distance <= fitur.jarak_minimum");
        $this->db->order_by('distance ASC');
        $this->db->join('fitur', 'merchant.id_fitur = fitur.id_fitur', 'left');
        $this->db->join('mitra', 'mitra.id_merchant = merchant.id_merchant', 'left');
        $this->db->join('saldo', 'mitra.id_mitra = saldo.id_user', 'left');
        $this->db->join('category_merchant', 'merchant.category_merchant = category_merchant.id_kategori_merchant', 'left');
        return $this->db->get('merchant');
    }
    public function merchantbyid($idmerchant, $long, $lat)
    {
        $this->db->select("
            merchant.id_merchant , 
            merchant.id_fitur ,
            merchant.nama_merchant , 
            merchant.alamat_merchant , merchant.latitude_merchant , 
            merchant.longitude_merchant , merchant.jam_buka , merchant.jam_tutup ,
            merchant.deskripsi_merchant , 
            merchant.category_merchant , 
            merchant.foto_merchant , 
            merchant.telepon_merchant , 
            merchant.status_merchant , 
            merchant.open_merchant,
            (6371 * acos(cos(radians($lat)) * 
            cos(radians(merchant.latitude_merchant)) * 
            cos(radians(merchant.longitude_merchant) - 
            radians( $long)) + 
            sin(radians($lat)) * 
            sin( radians(merchant.latitude_merchant)))) AS distance
        ");
        $this->db->select('
            item.status_promo,
            item.nama_item,
            item.harga_item,
            item.harga_promo,
            item.kategori_item,
            item.deskripsi_item');
        $this->db->select('mitra.partner');
        $this->db->select('category_merchant.nama_kategori');
        $this->db->select('fitur.fitur, fitur.jarak_minimum, fitur.wallet_minimum');
        $this->db->select('saldo.saldo');
        $this->db->where("merchant.id_merchant = $idmerchant");
        $this->db->where('merchant.status_merchant = 1');
        $this->db->where('saldo.saldo >= fitur.wallet_minimum');
        $this->db->join('fitur', 'merchant.id_fitur = fitur.id_fitur', 'left');
        $this->db->join('mitra', 'mitra.id_merchant = merchant.id_merchant', 'left');
        $this->db->join('saldo', 'mitra.id_mitra = saldo.id_user', 'left');
        $this->db->join('category_merchant', 'merchant.category_merchant = category_merchant.id_kategori_merchant', 'left');
        $this->db->join('item', 'merchant.id_merchant = item.id_merchant', 'left');

        $this->db->order_by('merchant.id_merchant');

        return $this->db->get('merchant');
    }
    public function merchantpromo($long, $lat)
    {
        $this->db->select("merchant.id_merchant , merchant.nama_merchant , merchant.alamat_merchant , merchant.latitude_merchant , merchant.longitude_merchant , merchant.jam_buka , merchant.jam_tutup ,
            merchant.deskripsi_merchant , merchant.category_merchant , merchant.foto_merchant , merchant.telepon_merchant , merchant.status_merchant , merchant.open_merchant,saldo.saldo,
            (6371 * acos(cos(radians($lat)) * cos(radians(merchant.latitude_merchant)) * cos(radians(merchant.longitude_merchant) - radians( $long)) + sin(radians($lat)) * sin( radians(merchant.latitude_merchant)))) AS distance
            ,(SELECT item.status_promo FROM item WHERE merchant.id_merchant = item.id_merchant AND item.status_promo = 1 AND status_item = 1 ORDER BY status_promo DESC LIMIT 1) AS status_promo, fitur.jarak_minimum, fitur.wallet_minimum");
        

        $this->db->select("merchant.id_fitur,fitur.id_fitur,fitur.biaya,fitur.biaya_minimum");    
        $this->db->where('merchant.status_merchant = 1');
        $this->db->where('mitra.status_mitra = 1');
        $this->db->where('saldo.saldo >= fitur.wallet_minimum');
        $this->db->having("status_promo is not null");
        $this->db->having("distance <= fitur.jarak_minimum");
        $this->db->order_by('distance ASC');

        $this->db->join('fitur', 'merchant.id_fitur = fitur.id_fitur');
        $this->db->join('mitra', 'merchant.id_merchant = mitra.id_merchant', 'left');
        $this->db->join('saldo', 'mitra.id_mitra = saldo.id_user', 'left');

        $this->db->limit('4');
        return $this->db->get('merchant');
    }
    public function merchant_terdekat($long, $lat)
    {
        $this->db->select("merchant.id_merchant , merchant.nama_merchant , merchant.alamat_merchant , merchant.latitude_merchant , merchant.longitude_merchant , merchant.jam_buka , merchant.jam_tutup ,
            merchant.deskripsi_merchant , merchant.category_merchant , merchant.foto_merchant , merchant.telepon_merchant , merchant.status_merchant , merchant.open_merchant, saldo.saldo,
            (6371 * acos(cos(radians($lat)) * cos(radians(merchant.latitude_merchant)) * cos(radians(merchant.longitude_merchant) - radians( $long)) + sin(radians($lat)) * sin( radians(merchant.latitude_merchant)))) AS distance
            ,(SELECT item.status_promo FROM item where merchant.id_merchant = item.id_merchant AND status_item = 1  ORDER BY status_promo DESC LIMIT 1) AS status_promo, fitur.jarak_minimum, fitur.wallet_minimum");

        $this->db->from('merchant');
        $this->db->where('merchant.status_merchant = 1');
        $this->db->where('mitra.status_mitra = 1');
        $this->db->where('saldo.saldo >= fitur.wallet_minimum');
        $this->db->having("status_promo is not null");
        $this->db->having("distance <= fitur.jarak_minimum");
        $this->db->order_by('distance ASC');

        $this->db->join('fitur', 'merchant.id_fitur = fitur.id_fitur');
        $this->db->join('mitra', 'merchant.id_merchant = mitra.id_merchant');
        $this->db->join('saldo', 'mitra.id_mitra = saldo.id_user');

        $this->db->limit('4');
        $query =  $this->db->get();

        $data = [];


        foreach ($query->result_array() as $q) {

            if ($q['status_promo'] == NULL) {
                $status = 0;
            } else {
                $status = $q['status_promo'];
            }
            $data[] = [
                'id_merchant'               => $q['id_merchant'],
                'nama_merchant'             => $q['nama_merchant'],
                'alamat_merchant'           => $q['alamat_merchant'],
                'latitude_merchant'         => $q['latitude_merchant'],
                'longitude_merchant'        => $q['longitude_merchant'],
                'jam_buka'                  => $q['jam_buka'],
                'jam_tutup'                 => $q['jam_tutup'],
                'deskripsi_merchant'        => $q['deskripsi_merchant'],
                'category_merchant'         => $q['category_merchant'],
                'foto_merchant'             => $q['foto_merchant'],
                'telepon_merchant'          => $q['telepon_merchant'],
                'status_merchant'           => $q['status_merchant'],
                'open_merchant'             => $q['open_merchant'],
                'saldo'                     => $q['saldo'],
                'distance'                  => $q['distance'],
                'status_promo'              => $status
            ];
        }

        return $data;
    }
    public function allkategori_item($id)
    {
        $this->db->select('*');
        $this->db->from('category_item');
        $this->db->where('id_merchant', $id);
        return $this->db->get();
    }
    public function itemstatus($idmerchant)
    {
        $this->db->select('item.status_promo');
        $this->db->where("item.status_item = 1");
        $this->db->where("item.status_promo = 1");
        $this->db->where("item.id_merchant = $idmerchant");
        return $this->db->get('item');
    }
    public function itembyid($idmerchant)
    {
        $this->db->select('item.*');
        $this->db->select('
            category_item.nama_kategori_item,
            category_item.foto_kategori_item');

        $this->db->where("item.status_item = 1");
        $this->db->where("item.id_merchant = $idmerchant");

        $this->db->join('category_item', 'item.kategori_item = category_item.id_kategori_item', 'left');
        $this->db->where("category_item.status_kategori = 1");

        return $this->db->get('item');
    }
    public function kategoriitem($idmerchant)
    {

        $this->db->select("nama_kategori_item,id_kategori_item,foto_kategori_item");
        $this->db->where("status_kategori = 1");
        $this->db->where("id_merchant = $idmerchant");
        $this->db->or_where('all_category = 1');
        return $this->db->get('category_item');
    }
    public function kategorymerchantbyfitur($fitur)
    {

        $this->db->where("id_fitur = $fitur OR id_fitur = 0");
        $this->db->where('status_kategori = 1');
        return $this->db->get('category_merchant');
    }
    public function allmerchantnearby($long, $lat, $fitur)
    {
        $this->db->select("merchant.id_merchant , merchant.nama_merchant , merchant.alamat_merchant , merchant.latitude_merchant , merchant.longitude_merchant , merchant.jam_buka , merchant.jam_tutup ,
            merchant.deskripsi_merchant , merchant.category_merchant , merchant.foto_merchant , merchant.telepon_merchant , merchant.status_merchant , merchant.open_merchant,saldo.saldo,
            (6371 * acos(cos(radians($lat)) * cos(radians(merchant.latitude_merchant)) * cos(radians(merchant.longitude_merchant) - radians( $long)) + sin(radians($lat)) * sin( radians(merchant.latitude_merchant)))) AS distance
            ,(SELECT item.status_promo FROM item where merchant.id_merchant = item.id_merchant AND status_item = 1 ORDER BY status_promo DESC LIMIT 1) AS status_promo, fitur.jarak_minimum, fitur.wallet_minimum");
        
        $this->db->select('category_merchant.nama_kategori');
        $this->db->where('merchant.status_merchant = 1');
        $this->db->where('mitra.status_mitra = 1');
        $this->db->where("merchant.id_fitur = $fitur");
        $this->db->where('saldo.saldo >= fitur.wallet_minimum');

        $this->db->having("status_promo is not null");
        $this->db->having("distance <= fitur.jarak_minimum");
        $this->db->order_by('distance ASC');

        $this->db->join('fitur', 'merchant.id_fitur = fitur.id_fitur', 'left');
        $this->db->join('mitra', 'mitra.id_merchant = merchant.id_merchant', 'left');
        $this->db->join('saldo', 'mitra.id_mitra = saldo.id_user', 'left');
        $this->db->join('category_merchant', 'merchant.category_merchant = category_merchant.id_kategori_merchant', 'left');


        return $this->db->get('merchant');
    }
    public function allmerchantnearbysearch($long, $lat, $fitur,$kategori)
    {
        $this->db->select("merchant.id_merchant , merchant.nama_merchant , merchant.alamat_merchant , merchant.latitude_merchant , merchant.longitude_merchant , merchant.jam_buka , merchant.jam_tutup ,
            merchant.deskripsi_merchant , merchant.category_merchant , merchant.foto_merchant , merchant.telepon_merchant , merchant.status_merchant , merchant.open_merchant,saldo.saldo,
            (6371 * acos(cos(radians($lat)) * cos(radians(merchant.latitude_merchant)) * cos(radians(merchant.longitude_merchant) - radians( $long)) + sin(radians($lat)) * sin( radians(merchant.latitude_merchant)))) AS distance
            ,(SELECT item.status_promo FROM item where merchant.id_merchant = item.id_merchant AND status_item = 1 ORDER BY status_promo DESC LIMIT 1) AS status_promo, fitur.jarak_minimum, fitur.wallet_minimum");
        
        $this->db->select('category_merchant.nama_kategori');
        $this->db->select('item.nama_item');
        $this->db->where('merchant.status_merchant = 1');
        $this->db->where('mitra.status_mitra = 1');
        $this->db->where("merchant.id_fitur = $fitur");
        $this->db->where('saldo.saldo >= fitur.wallet_minimum');

        $this->db->like('nama_kategori',$kategori);
        $this->db->or_like('nama_merchant',$kategori);
        $this->db->or_like('nama_item',$kategori);

        $this->db->having("status_promo is not null");
        $this->db->having("distance <= fitur.jarak_minimum");
        $this->db->order_by('distance ASC');

        $this->db->join('fitur', 'merchant.id_fitur = fitur.id_fitur', 'left');
        $this->db->join('mitra', 'mitra.id_merchant = merchant.id_merchant', 'left');
        $this->db->join('saldo', 'mitra.id_mitra = saldo.id_user', 'left');
        $this->db->join('category_merchant', 'merchant.category_merchant = category_merchant.id_kategori_merchant', 'left');
        $this->db->join('item', 'item.id_merchant = merchant.id_merchant', 'left');

        return $this->db->get('merchant');
    }
    public function itembykategori($idmerchant, $itemk)
    {
        $this->db->select("item.*");
        $this->db->select('
            category_item.nama_kategori_item,
            category_item.foto_kategori_item');

        $this->db->where("item.status_item = 1");
        $this->db->where("item.id_merchant = $idmerchant");

        if ($itemk != '1') {
            $this->db->where("id_kategori_item = $itemk");
        }
        $this->db->join('category_item', 'item.kategori_item = category_item.id_kategori_item', 'left');
        $this->db->where("category_item.status_kategori = 1");
        return $this->db->get('item');
    }
    public function insert_data_transaksi_merchant($data_transaksi, $dataDetail, $total_belanja)
    {

        $biaya_akhir = ($data_transaksi['harga'] + $total_belanja['total_belanja']) - $data_transaksi['kredit_promo'];

        $transaksi = [
            'id_pelanggan'      => $data_transaksi['id_pelanggan'],
            'order_fitur'       => $data_transaksi['order_fitur'],
            'start_latitude'    => $data_transaksi['start_latitude'],
            'start_longitude'   => $data_transaksi['start_longitude'],
            'end_latitude'      => $data_transaksi['end_latitude'],
            'end_longitude'     => $data_transaksi['end_longitude'],
            'jarak'             => $data_transaksi['jarak'],
            'harga'             => $data_transaksi['harga'],
            'jasaapp'             => $data_transaksi['jasaapp'],
            'waktu_order'       => $data_transaksi['waktu_order'],
            'estimasi_time'     => $data_transaksi['estimasi_time'],
            'alamat_asal'       => $data_transaksi['alamat_asal'],
            'alamat_tujuan'     => $data_transaksi['alamat_tujuan'],
            'kredit_promo'      => $data_transaksi['kredit_promo'],
            'pakai_wallet'      => $data_transaksi['pakai_wallet'],
            'biaya_akhir'      => $biaya_akhir,
        ];

        $this->db->insert('transaksi', $transaksi);
        $reqid = $this->db->insert_id();
        if ($this->db->affected_rows() == 1) {

            $data_hist = array(
                'id_transaksi' => $reqid,
                'id_driver' => 'D0',
                'status' => '1'
            );
            $this->db->insert('history_transaksi', $data_hist);

            $dataDetail['id_transaksi'] = $reqid;
            $this->db->insert('transaksi_detail_merchant', $dataDetail);

            $get_data = $this->get_data_transaksi_merchant($data_transaksi);
            return array(
                'status'        => true,
                'id_transaksi'  => $reqid,
                'data' => $get_data->result(),

            );
        } else {
            return array(
                'status' => false,
                'data' => []
            );
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
    public function delete_transaksi($id)
    {
        $data = [
            'status' => '0'
        ];

        $this->db->where('id_transaksi', $id);
        $this->db->update('history_transaksi', $data);
        return true;
    }
    //----------------------------- get Biaya -----------------------------------
    function get_biaya()
    {
        $tempBiaya = array();
        $this->db->select('fitur.*,driver_job.ismobil, driver_job.icon as icon_driver');
        $this->db->from('fitur');
        $this->db->join('driver_job', 'fitur.driver_job = driver_job.id', 'left');
        $biaya = $this->db->get()->result_array();
        foreach ($biaya as $row) {
            $Cekpersen = $row['promo'] / 100;
            $tempBiaya[] = array(
                'id_fitur' => $row['id_fitur'],
                'fitur' => $row['fitur'],
                'biaya' => $row['biaya'],
                'diskon' => $row['promo'] . "%",
                'promo' => $Cekpersen,
                'biaya_akhir' => $Cekpersen,
                'icon' => $row['icon'],
                'ismobil' => $row['ismobil'],
                'background' => $row['background'],
                'tint' => $row['tint'],
                'usedtint' => $row['usedtint'],
                'home' => $row['home'],
                'maks_distance' => $row['maks_distance'],
                'icon_driver' => $row['icon_driver'],
                'biaya_minimum' => $row['biaya_minimum'],
                'keterangan_biaya' => $row['keterangan_biaya'],
                'keterangan' => $row['keterangan']
            );
        }

        return $tempBiaya;
    }
    //---------------------- Histori Lokasi 3 list ------------------------
    function tigalist_lokasi_pelanggan($iduser,$limit)
    {
       $this->db->select('*');
        $this->db->from('lokasi_pelanggan');
        $this->db->where('lokasi_pelanggan.id_pelanggan', $iduser);
        $this->db->where('lokasi_pelanggan.utama','0');
        $this->db->limit($limit);
        $this->db->order_by('lokasi_pelanggan.nama', 'DESC');
        $trans = $this->db->get();
        return $trans;
    }
    //--------------------------- berita ---------------------------
    public function allberita()
    {
        $this->db->select('*');
        $this->db->from('berita');
        $this->db->join('kategori_news', 'berita.id_kategori = kategori_news.id_kategori_news', 'left');
        $this->db->order_by('id_berita DESC');
        $this->db->where('status_berita', 1);
        return $this->db->get()->result_array();
    }
    public function beritadetail($id)
    {
        $this->db->select('*');
        $this->db->from('berita');
        $this->db->join('kategori_news', 'berita.id_kategori = kategori_news.id_kategori_news', 'left');
        $this->db->where('id_berita', $id);
        $this->db->order_by('id_berita DESC');
        return $this->db->get();
    }
    //--------------------------------- Transaksi ---------------------------------------------
    function all_progress($iduser)
    {
       $this->db->select('*');
        $this->db->from('transaksi');
         $this->db->join('driver', 'transaksi.id_driver = driver.id', 'left');
        $this->db->join('history_transaksi', 'transaksi.id = history_transaksi.id_transaksi', 'left');
        $this->db->join('status_transaksi', 'history_transaksi.status = status_transaksi.id', 'left');
        $this->db->join('fitur', 'transaksi.order_fitur = fitur.id_fitur', 'left');
        $this->db->where('transaksi.id_pelanggan', $iduser);
        $this->db->where('history_transaksi.status != 1');
        $this->db->where('history_transaksi.status != 0');
        $this->db->where('history_transaksi.status != 5');
        $this->db->where("(history_transaksi.status = '2' OR history_transaksi.status = '3' OR history_transaksi.status = '4' AND transaksi.rate = '')", NULL, FALSE);
        $this->db->limit(5);
        $this->db->order_by('transaksi.id', 'DESC');
        $trans = $this->db->get();
        return $trans;
    }
    //----------------------------------------- rating --------------------------------
    function count_rate_driver($id)
    {
        $this->db->select('rating');
        $this->db->from('rating_driver');
        $this->db->where('id_driver', $id);
        $cek = $this->db->get();
        $rate = 0;
        $hasil = 0;
        if ($cek->num_rows() > 0) {
            foreach ($cek->result() as $row) {
                $rate += $row->rating;
            }
            $hasil = $rate / $cek->num_rows();
        }
        return $hasil;
    }

    function rate_driver($data)
    {
        $ins_rate = $this->db->insert('rating_driver', $data);
        if ($this->db->affected_rows() == 1) {
            $get_rating = $this->count_rate_driver($data['id_driver']);

            $this->db->where('id', $data['id_transaksi']);
            $upd_trans = $this->db->update('transaksi', array('rate' => $data['rating']));

            $this->db->where('id', $data['id_driver']);
            $upd_driver = $this->db->update('driver', array('rating' => $get_rating));
            return true;
        } else {
            return false;
        }
    }
    function data_poin($id)
    {
        $this->db->select('*');
        $this->db->where('driver.id', $id);
        $this->db->from('driver');
        $trans = $this->db->get();
        return $trans;
    }
    public function pointuser($id)
    {
        $this->db->select('point');
        $this->db->from('driver');
        $this->db->where('id', $id);
        $saldo = $this->db->get();
        return $saldo;
    }
    public function tambahpoin($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('driver', $data);
        return true;
    }
    //------------------------- Saldo ----------------------------------------------------
    function data_saldo($id)
    {
        $this->db->select('*');
        $this->db->where('saldo.id_user', $id);
        $this->db->from('saldo');
        $trans = $this->db->get();
        return $trans;
    }
    public function tambahsaldo($id, $data)
    {
        $this->db->where('id_user', $id);
        $this->db->update('saldo', $data);
        return true;
    }
    public function insertwallet($data_withdraw)
    {
        $verify = $this->db->insert('wallet', $data_withdraw);
        return true;
    }
    //---------------------------- Chat -------------------------------------
    public function datainbox($idpelanggan)
    {
        $this->db->select('*','driver.*','history_transaksi.status');
        $this->db->from('chat');
        $this->db->join('history_transaksi', 'chat.idtrans = history_transaksi.id_transaksi', 'left');
        $this->db->join('driver', 'chat.iddriver = driver.id', 'left');
        $this->db->where("(history_transaksi.status = '2' OR history_transaksi.status = '3')", NULL, FALSE);
        $this->db->where('idcust', $idpelanggan);
        $this->db->order_by('chat.id DESC');
        $this->db->limit('1');
        return $this->db->get()->result_array();
    }
    public function insertchat($data,$foto,$namafoto)
    {
        if($foto == "0"){
            //non foto
        }else{
            $path = "images/chat/" . $namafoto;
            file_put_contents($path, base64_decode($foto));
        }
        $verify = $this->db->insert('chat', $data);
        return true;
    }
    function datachat($idtrans)
    {
        $this->db->select('*','pelanggan.*','driver.*');
        $this->db->from('chat');
        $this->db->join('pelanggan', 'chat.idcust = pelanggan.id', 'left');
        $this->db->join('driver', 'chat.iddriver = driver.id', 'left');
        $this->db->where('idtrans', $idtrans);
        $this->db->order_by('jam', 'ASC');
        return $this->db->get()->result();
    }
    //------------------------- Booking Order --------------------------------
    public function get_driver_ride($lat, $lng, $fitur)
    {
        $url_foto = base_url() . 'images/fotodriver/';

        $result = $this->db->query("
            SELECT f.jarak_minimum, f.wallet_minimum, d.id as id, d.nama_driver,d.rating, ld.latitude, ld.longitude, ld.bearing, ld.update_at,
            k.merek, k.nomor_kendaraan, k.warna, k.tipe, s.saldo,
            d.no_telepon, CONCAT('$url_foto', d.foto, '') as foto, d.reg_id, dj.driver_job,
                (6371 * acos(cos(radians($lat)) * cos(radians( ld.latitude ))"
            . " * cos(radians(ld.longitude) - radians($lng))"
            . " + sin(radians($lat)) * sin( radians(ld.latitude)))) AS distance
            FROM config_driver ld, driver d, driver_job dj, kendaraan k, saldo s,fitur f
            WHERE ld.id_driver = d.id 
                AND f.id_fitur = $fitur
                AND ld.status = '1'
                AND dj.id = d.job
                AND d.job = f.driver_job
                AND d.status = '1'
                AND k.id_k = d.kendaraan
                AND s.id_user = d.id
                AND s.saldo > f.wallet_minimum
            HAVING distance <= f.jarak_minimum
            ORDER BY distance ASC");
        return $result;
    }
    //------------------------- Transaksi -----------------------------------
    function get_data_transaksi($cond)
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->join('transaksi_detail_send', 'transaksi.id = transaksi_detail_send.id_transaksi', 'left');
        $this->db->where($cond);
        $cek = $this->db->get();
        return $cek;
    }
    function get_data_transaksi_merchant($cond)
    {
        $this->db->select('transaksi.*,transaksi_detail_merchant.id_trans_merchant, merchant.token_merchant');
        $this->db->from('transaksi');
        $this->db->join('transaksi_detail_merchant', 'transaksi.id = transaksi_detail_merchant.id_transaksi', 'left');
        $this->db->join('merchant', 'transaksi_detail_merchant.id_merchant = merchant.id_merchant', 'left');
        $this->db->where($cond);
        $cek = $this->db->get();
        return $cek;
    }
    public function get_trans_merchant($idtransaksi)
    {
        $this->db->select('mitra.*,transaksi_detail_merchant.id_merchant,transaksi_detail_merchant.total_biaya');
        $this->db->from('transaksi_detail_merchant');
        $this->db->join('mitra', 'transaksi_detail_merchant.id_merchant = mitra.id_merchant');
        $this->db->where('id_transaksi', $idtransaksi);
        return $this->db->get();
    }
    public function insert_transaksi($data_req)
    {

        $ha = 0;
        $kreditamuont = explode(".", $data_req['kredit_promo']);
        $ha = $data_req['harga'] - $kreditamuont[0];
        if ($ha <= 0) {
            $ha = 0;
        }
        $data_req['kredit_promo'] = $kreditamuont[0];
        $data_req['biaya_akhir'] = $ha;

        $this->db->insert('transaksi', $data_req);
        $reqid = $this->db->insert_id();
        if ($this->db->affected_rows() == 1) {
            $get_data = $this->get_data_transaksi($data_req);
            $data_hist = array(
                'id_transaksi' => $reqid,
                'id_driver' => 'D0',
                'status' => '1'
            );
            $this->db->insert('history_transaksi', $data_hist);
            return array(
                'status' => true,
                'data' => $get_data->result()
            );
        } else {
            return array(
                'status' => false,
                'data' => []
            );
        }
    }
    function transaksi($idtran)
    {
        $this->db->select('*');
        $this->db->from('transaksi');

        $this->db->join('transaksi_detail_merchant', 'transaksi.id = transaksi_detail_merchant.id_transaksi', 'left');
        $this->db->join('fitur', 'transaksi.order_fitur = fitur.id_fitur', 'left');
        $this->db->join('merchant', 'transaksi_detail_merchant.id_merchant = merchant.id_merchant', 'left');
        $this->db->join('history_transaksi', 'transaksi.id = history_transaksi.id_transaksi', 'left');
        $this->db->join('transaksi_detail_send', 'transaksi.id = transaksi_detail_send.id_transaksi', 'left');
        $this->db->where('transaksi.id', $idtran);

        $trans = $this->db->get();
        return $trans;
    }
    function detail_driver($iddriver)
    {
        $this->db->select('*','kendaraan.*');
        $this->db->from('driver');
        $this->db->join('kendaraan', 'driver.kendaraan = kendaraan.id_k', 'left');
        $this->db->where('id', $iddriver);
        $loc = $this->db->get();
        return $loc;
    }
    public function detail_item($id)
    {
        $this->db->select('transaksi_item.jumlah_item,item.nama_item,item.id_item, transaksi_item.catatan_item,transaksi_item.id_item, transaksi_item.total_harga');
        $this->db->from('transaksi_item');
        $this->db->join('item', 'transaksi_item.id_item = item.id_item');
        $this->db->where('id_transaksi', $id);
        return $this->db->get();
    }
    //------------------------- Batalkan pesanan --------------------------------------------
    public function user_cancel_request($cond)
    {
        $this->db->select(''
            . 'id_driver,'
            . 'status');
        $this->db->from('history_transaksi');
        $this->db->where('id_transaksi', $cond['id_transaksi']);
        $id = $this->db->get();

        $this->db->select('transaksi.*, fitur.home');
        $this->db->from('transaksi');
        $this->db->join('fitur', 'transaksi.order_fitur = fitur.id_fitur', 'left');
        $this->db->where('id', $cond['id_transaksi']);
        $id2 = $this->db->get();


        if ($id->row('status') == 1 || $id->row('status') == 2) {
            $data = array(
                'status' => '5'
            );
            if ($id2->row('home') == 4) {
                $get_mitra = $this->get_trans_merchant($cond['id_transaksi']);
                $this->delete_chat($get_mitra->row('id_merchant'), $id2->row('id_pelanggan'));
                $this->delete_chat($get_mitra->row('id_merchant'), $id2->row('id_driver'));
            };
            $this->db->where($cond);
            $edit = $this->db->update('history_transaksi', $data);
            return array(
                'status' => true,
                'data' => [],
                'iddriver' => $id->row('id_driver'),
                'idpelanggan' => $id2->row('id_pelanggan')
            );
        } else {
            return array(
                'status' => false,
                'data' => []
            );
        }
    }
    function check_status($dataTrans)
    {
        $this->db->select(''
            . 'status_transaksi.id as status,'
            . 'status_transaksi.status_transaksi as keterangan');
        $this->db->from('history_transaksi');
        $this->db->join('status_transaksi', 'history_transaksi.status = status_transaksi.id');
        $this->db->where($dataTrans);
        $cek = $this->db->get();

        $stat = TRUE;
        if ($cek->row('status') == 1) {
            $this->delete_transaksi($dataTrans['id_transaksi']);
            $stat = FALSE;
        }
        $dataCheck = array(
            'message' => 'check status',
            'status' => $stat,
            'response' => $cek->row('status'),
            'data' => $cek->result(),
            'list_driver' => $this->get_data_driver_histroy($dataTrans['id_transaksi'])->result()
        );
        return $dataCheck;
    }
    function get_data_driver_histroy($id_transaksi)
    {
        $url_foto = base_url() . 'images/fotodriver/';

        $this->db->select(''
            . 'driver.id,'
            . 'nama_driver,'
            . 'no_telepon,'
            . 'cd.latitude,'
            . 'cd.longitude,'
            . 'cd.update_at,'
            . "CONCAT('$url_foto', driver.foto, '') as foto,"
            . 'reg_id,'
            . '"0" as distance,'
            . 'k.id_k as id_kendaraan,'
            . 'k.merek,'
            . 'k.tipe,'
            . 'k.jenis,'
            . 'k.nomor_kendaraan,'
            . 'k.warna');
        $this->db->from('driver');
        $this->db->join('history_transaksi', 'driver.id = history_transaksi.id_driver');
        $this->db->join('config_driver cd', 'driver.id = cd.id_driver');
        $this->db->join('kendaraan k', 'driver.kendaraan = k.id_k');
        $this->db->where('history_transaksi.id_transaksi', $id_transaksi);
        $getD = $this->db->get();
        return $getD;
    }
    function data_cektransaksi($idfitur)
    {
       $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->where('transaksi.id', $idfitur);
        $this->db->limit($limit);
        $this->db->order_by('transaksi.id', 'DESC');
        $trans = $this->db->get();
        return $trans;
    }
    public function updatetoken($data,$idpelanggan)
    {
        $this->db->where('id', $idpelanggan);
        $this->db->update('pelanggan', $data);
        return true;
    }
    //------------------------ Histori ------------------------
    function all_transaksi($iduser)
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->join('history_transaksi', 'transaksi.id = history_transaksi.id_transaksi', 'left');
        $this->db->join('status_transaksi', 'history_transaksi.status = status_transaksi.id', 'left');
        $this->db->join('fitur', 'transaksi.order_fitur = fitur.id_fitur', 'left');
        $this->db->where('transaksi.id_pelanggan', $iduser);
        $this->db->where('history_transaksi.status != 1');
        $this->db->where('history_transaksi.status != 0');
        $this->db->order_by('transaksi.id', 'DESC');
        $trans = $this->db->get();
        return $trans;
    }
    //--------------------------- Paket ---------------------------
    public function allpaket()
    {
        $this->db->select('*');
        $this->db->from('paket');
        $this->db->order_by('id DESC');
        $this->db->where('status', 1);
        return $this->db->get()->result_array();
    }
    function get_driver_location($idDriver)
    {
        $this->db->select(''
            . 'id_driver,'
            . 'bearing,'
            . 'status,'
            . 'latitude,'
            . 'longitude');
        $this->db->from('config_driver');
        $this->db->where('id_driver', $idDriver);
        $loc = $this->db->get();
        return $loc;
    }
}