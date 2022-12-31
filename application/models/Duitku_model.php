<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Duitku_model extends CI_model
{
    function __construct()
    {
        parent::__construct();
    }
    function datasetting()
    {
        $this->db->select('*');
        $this->db->from('app_settings');
        $this->db->where('id', '1');
        return $this->db->get();
    }
    function dataakun($id)
    {
        $this->db->select('*');
        $this->db->from('pelanggan');
        $this->db->where('id', $id);
        return $this->db->get();
    }
    function dataakundriver($id)
    {
        $this->db->select('*');
        $this->db->from('driver');
        $this->db->where('id', $id);
        return $this->db->get();
    }
    function dataakunmitra($id)
    {
        $this->db->select('*');
        $this->db->from('driver');
        $this->db->where('id_merchant', $id);
        return $this->db->get();
    }
    public function get_data_wallet($reff)
    {
        $this->db->select('*');
        $this->db->from('wallet');
        $this->db->where('reff', $reff);
        return $this->db->get();
    }
    public function sendnotif($serverkey,$token,$amount)
    {
        $url = "https://fcm.googleapis.com/fcm/send";   
        $header = [
            'authorization: key='.$serverkey,
            'content-type: application/json'
        ];
        $id = '1';
        $notification = [
            'title' => 'GoPayment',
            'body' => 'Topup '.$amount.' Berhasil.',
            'type' => 0
        ];
        $extraNotificationData = ["message" => $notification,"id" =>$id,"type" =>0];
        $fcmNotification = [
            'to'        => $token,
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
        $result = json_decode(curl_exec($ch)); 
        curl_close($ch);
        return $result;
    }
}
?>