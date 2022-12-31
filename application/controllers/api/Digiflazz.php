<?php
//error_reporting(0);
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
class Digiflazz extends REST_Controller
{
     public function __construct()
    {
        parent::__construct();
        $this->load->helper("url");
        $this->load->database();
        $this->load->model('Digiflazz_model');
        date_default_timezone_set('Asia/Jakarta');
    }
    
    function index_get()
    {
        $this->response("Api for Gojasa!", 200);
    }
    //-------------------------- List Kategori ---------------------------
    function listkategori_post(){
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            return false;
        }
        $data = file_get_contents("php://input");
        $dec_data = json_decode($data);
        $tipe = $dec_data->id;
        $kategori = $this->Digiflazz_model->listkategori($tipe);
        $message = array(
            'code' => '201',
            'message' => 'Sukses',
            'data' => $kategori
        );
        $this->response($message, 201);
    }
     //------------------------- List Channel ----------------------------
     function listpayment_post(){
       
        $json = file_get_contents('php://input');
        date_default_timezone_set('Asia/Jakarta');
        $result = json_decode($json);

        $datetime = date('Y-m-d H:i:s');  
        $username = 'heyopaoQmnxo';
        $devkey = 'dev-4c4201f0-4116-11eb-bcc2-1bbbe3359fb0';
        $signature = hash('md5',$username . $devkey . 'pricelist');
        
        $itemsParam = array(
            'cmd' => 'prepaid',
            'username' =>  $username,
            'sign' => $signature
        );

        $params = array_merge((array)$result,$itemsParam);
        $params_string = json_encode($params);

        $url = 'https://api.digiflazz.com/v1/price-list'; 
       
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
            $message = array(
                'code' => $httpCode,
                'message' => 'Sukses',
                'data' => $request
                );
            $this->response($message, 200);
        }
        else{
            $message = array(
                'code' => $httpCode,
                'message' => 'Error',
                'data' => []
                );
            $this->response($message, 200);
        }
    }
}