<?php
//error_reporting(0);
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
class Duitku extends REST_Controller
{
     public function __construct()
    {
        parent::__construct();
        $this->load->helper("url");
        $this->load->database();
        $this->load->model('Duitku_model');
        $this->load->model('Pelanggan_model');
        date_default_timezone_set('Asia/Jakarta');
    }
    
    function index_get()
    {
        
        $this->response("Api for Gojasa!", 200);
    }
    //------------------------- List Channel ----------------------------
    function listpayment_post(){
        $datasetting = $this->Duitku_model->datamerchant()->row();
        $merchantCode = $datasetting->duitku_merchant;
        $merchantKey = $datasetting->duitku_key;

        $json = file_get_contents('php://input');
        date_default_timezone_set('Asia/Jakarta');
        $result = json_decode($json);

        $datetime = date('Y-m-d H:i:s');  
        $paymentAmount = $result->{'paymentAmount'};
        $signature = hash('sha256',$merchantCode . $paymentAmount . $datetime . $merchantKey);
        
        $itemsParam = array(
            'merchantcode' => $merchantCode,
            'amount' => $paymentAmount,
            'datetime' => $datetime,
            'signature' => $signature
        );

    
        $params = array_merge((array)$result,$itemsParam);

        $params_string = json_encode($params);
        if($datasetting->duitku_mode == 1){
            $url = 'https://passport.duitku.com/webapi/api/merchant/paymentmethod/getpaymentmethod'; 
        }else{
            $url = 'https://sandbox.duitku.com/webapi/api/merchant/paymentmethod/getpaymentmethod'; 
        }
       
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params_string);                                                                  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
            'Content-Type: application/json',                                                                                
            'Content-Length: ' . strlen($params_string))                                                                       
        );   
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        //execute post
        $request = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if($httpCode == 200)
        {
                echo $request ;
        }
        else{
                echo $httpCode ;

        }
    }
    //------------------------- Check Payment ----------------------------
    function Checkpayment_post(){
        $datasetting = $this->Duitku_model->datamerchant()->row();
        $merchantCode = $datasetting->duitku_merchant;
        $merchantKey = $datasetting->duitku_key;

        $json = file_get_contents('php://input');
        $result = json_decode($json);

        $reference = $result->{'reference'}; 
        $signature = md5($merchantCode . $reference . $merchantKey);

        $itemsParam = array(
            'merchantCode' => $merchantCode,
            'signature' => $signature
        );
        
        
        $params = array_merge((array)$result,$itemsParam);
        $params_string = json_encode($params);
        
        //if sandbox 0
        if($datasetting->duitku_mode == 1){
            $url = 'https://passport.duitku.com/webapi/api/merchant/transactionStatus';
        }else{
            $url = 'https://sandbox.duitku.com/webapi/api/merchant/transactionStatus';
        }

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params_string);                                                                  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
            'Content-Type: application/json',                                                                                
            'Content-Length: ' . strlen($params_string))                                                                       
        );   
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        //execute post
        $request = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if($httpCode == 200)
        {
            echo $request ;
        }
        else
            echo $httpCode ;
    }
    //------------------------- Request Payment ----------------------------
    function RequestTrx_post(){
        $datasetting = $this->Duitku_model->datamerchant()->row();
        $merchantCode = $datasetting->duitku_merchant;
        $merchantKey = $datasetting->duitku_key;

        $json = file_get_contents('php://input');
        $result = json_decode($json);

        $paymentAmount = $result->{'paymentAmount'}; 
        $merchantOrderId = time();
        
        $signature = md5($merchantCode . $merchantOrderId . $paymentAmount . $merchantKey);
    
        $itemsParam = array(
            'merchantCode' => $merchantCode,
            'merchantKey' => $merchantKey,
            'merchantOrderId' => $merchantOrderId,
            'signature' => $signature
        );

    
        $params = array_merge((array)$result,$itemsParam);

        $params_string = json_encode($params);
        
        if($datasetting->duitku_mode == 1){
            $url = 'https://passport.duitku.com/webapi/api/merchant/v2/inquiry'; // Production
        }else{
            $url = 'https://sandbox.duitku.com/webapi/api/merchant/v2/inquiry'; // Sandbox
        }
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params_string);                                                                  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
            'Content-Type: application/json',                                                                                
            'Content-Length: ' . strlen($params_string))                                                                       
        );   
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        //execute post
        $request = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if($httpCode == 200)
        {
             echo $request ;
        }
        else{
            echo "Server Error" . $httpCode;
        }
    }
    public function topuppending_post()
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
        $noreff = $dec_data->reff;
        $saldolama = $this->Pelanggan_model->saldouser($iduser);
        $datawithdraw = array(
            'id_user' => $iduser,
            'rekening' => $card,
            'bank' => $bank,
            'nama_pemilik' => $nama,
            'type' => $dec_data->type,
            'jumlah' => $amount,
            'status' => 0,
            'reff' => $noreff
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
    public function topupbackpending_post()
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
        $noreff = $dec_data->reff;
        $saldolama = $this->Pelanggan_model->saldouser($iduser);
        $datawithdraw = array(
            'id_user' => $iduser,
            'rekening' => $card,
            'bank' => $bank,
            'nama_pemilik' => $nama,
            'type' => $dec_data->type,
            'jumlah' => $amount,
            'status' => 0,
            'reff' => 'PD'.$numberreff
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
    public function topupsukses_post()
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
        $noreff = $dec_data->reff;
        $saldolama = $this->Pelanggan_model->saldouser($iduser);
        $datawithdraw = array(
            'id_user' => $iduser,
            'rekening' => $card,
            'bank' => $bank,
            'nama_pemilik' => $nama,
            'type' => $dec_data->type,
            'jumlah' => $amount,
            'reff' => $noreff,
            'status' => 1
        );
        $check_exist = $this->Pelanggan_model->check_exist($email, $phone);

        if ($dec_data->type ==  "topup") {
            $this->Pelanggan_model->insertwallet($datawithdraw);
            $saldolama = $this->Pelanggan_model->saldouser($iduser);
            $saldobaru = $saldolama->row('saldo') + $amount;
            $saldo = array('saldo' => $saldobaru);
            $this->Pelanggan_model->tambahsaldo($iduser, $saldo);
            $message = array(
                'code' => '200',
                'message' => 'success',
                'data' => []
            );
            $this->response($message, 200);
        } else {

            if ($saldolama->row('saldo') >= $amount && $check_exist) {
                 $this->Pelanggan_model->insertwallet($datawithdraw);
                $saldolama = $this->Pelanggan_model->saldouser($iduser);
                $saldobaru = $saldolama->row('saldo') + $amount;
                $saldo = array('saldo' => $saldobaru);
                $this->Pelanggan_model->tambahsaldo($iduser, $saldo);
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
    //-------------------------------- Check Transaksi ------------------------------------------
    function Checktransaksi_post(){
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            return false;
        }

        $data = file_get_contents("php://input");
        $dec_data = json_decode($data);

        $datasetting = $this->Duitku_model->datamerchant()->row();
        $merchantCode = $datasetting->duitku_merchant;
        $merchantKey = $datasetting->duitku_key;

        $json = file_get_contents('php://input');
        $result = json_decode($json);

    
        $merchantOrderId = $dec_data->idtransaksi;
        
        $signature = md5($merchantCode . $merchantOrderId . $merchantKey);
    
        $itemsParam = array(
            'merchantCode' => $merchantCode,
            'merchantOrderId' => $merchantOrderId,
            'signature' => $signature
        );

    
        $params = array_merge((array)$result,$itemsParam);

        $params_string = json_encode($params);
        
        if($datasetting->duitku_mode == 1){
            $url = 'https://passport.duitku.com/webapi/api/merchant/transactionStatus'; // Production
        }else{
            $url = 'https://sandbox.duitku.com/webapi/api/merchant/transactionStatus'; //sandbox
        }
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params_string);                                                                  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
            'Content-Type: application/json',                                                                                
            'Content-Length: ' . strlen($params_string))                                                                       
        );   
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        //execute post
        $request = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        $message = array(
            'message' => 'success',
            'data' => $request
        );
        $this->response($message, 200);
    }
    //-------------------- Cek Referense --------------------------------------
    public function ceknoreff_post()
    {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            return false;
        }
        $data = file_get_contents("php://input");
        $dec_data = json_decode($data);

        $cek_wallet = $this->Duitku_model->get_data_wallet($dec_data->idtransaksi);

        if ($cek_wallet->num_rows() > 0) {
            $message = array(
                'code' => '200',
                'message' => 'Ditemukan'
            );
            $this->response($message, 200);
        } else {
            $message = array(
                'code' => '201',
                'message' => 'Lanjutkan'
            );
            $this->response($message, 201);
        }
    }
}
?>