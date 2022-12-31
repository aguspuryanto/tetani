<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Notification_model extends CI_model
{
  function __construct()
  {
      parent::__construct();
  }

  public function appsetting()
  {
    $this->db->select('*');
    $this->db->from('app_settings');
    $this->db->where('id', '1');
    return $this->db->get();
  }
  public function notif_cancel_user($serverkey,$id_driver, $id_transaksi, $token_user)
  {
      $datanotif = array(
      'id_driver' => $id_driver,
      'id_transaksi' => $id_transaksi,
      'response' => '5',
      'type' => 1
    );
    $senderdata = array(
      'data' => $datanotif,
      'to' => $token_user
    );
    $headers = array(
      "Content-Type: application/json",
      "Authorization: key=" . $serverkey
    );
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => json_encode($senderdata),
      CURLOPT_HTTPHEADER => $headers,
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);
    return $response;
  }

  public function notif_cancel_driver($serverkey,$id_transaksi, $token_driver)
  {
    $data = array(
      'id_transaksi' => $id_transaksi,
      'response' => '0',
      'type' => 1
    );
    $senderdata = array(
      'data' => $data,
      'to' => $token_driver
    );
    $datasetting = $this->appsetting()->row();
    $fcmkey = $datasetting->fcm_key;
    
    $headers = array(
      "Content-Type: application/json",
      'Authorization: key=' . $fcmkey
    );
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => json_encode($senderdata),
      CURLOPT_HTTPHEADER => $headers,
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    return $response;
  }
  public function send_notif($serverkey,$title, $message, $topic)
  {
    $datasetting = $this->appsetting()->row();
    $fcmkey = $datasetting->fcm_key;
      
    $url = 'https://fcm.googleapis.com/fcm/send';
    $headers = array (
      'Authorization:key=' . $fcmkey,
      'Content-Type:application/json'
    );
    $notifData = [
      'title' => $title,
      'body' => $message,
      'type' => 0
    ];
    $apiBody = [
      'notification' => $notifData,
      'data' => $notifData,
      "time_to_live" => 600,
      'to' => '/topics/'.$topic
    ];
    $ch = curl_init();
    curl_setopt ($ch, CURLOPT_URL, $url );
    curl_setopt ($ch, CURLOPT_POST, true );
    curl_setopt ($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt ($ch, CURLOPT_POSTFIELDS, json_encode($apiBody));

    $response = curl_exec($ch);
    $err = curl_error($ch);

    curl_close($ch);
  }
 
  public function send_notif_topup($serverkey,$title, $id, $message, $method, $token)
  {
   
    $data = array(
      'title' => $title,
      'id' => $id,
      'message' => $message,
      'method' => $method,
      'type' => 3
    );
    $senderdata = array(
      'data' => $data,
      'to' => $token

    );
    $datasetting = $this->appsetting()->row();
    $fcmkey = $datasetting->fcm_key;
    $headers = array(
      'Content-Type : application/json',
      'Authorization: key=' .  $fcmkey
    );
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => json_encode($senderdata),
      CURLOPT_HTTPHEADER => $headers,
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);
  }
}
