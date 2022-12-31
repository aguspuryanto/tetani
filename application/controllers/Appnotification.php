<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class appnotification extends CI_Controller
{

    public function  __construct()
    {
        parent::__construct();
        if ($this->session->userdata('user_name') == NULL && $this->session->userdata('password') == NULL) {
            redirect(base_url() . "login");
        }
        $this->load->database();
        $this->load->model('Notification_model', 'notif');
        $this->load->model('Notification_model');
        $this->load->library('form_validation');
    }

    public function index()
    {

        $this->load->view('includes/header');
        $this->load->view('appnotification/index');
        $this->load->view('includes/footer');
    }

    public function send()
    {
        $datasetting = $this->Notification_model->appsetting()->row();
        $serverkey = $datasetting->fcm_key;
        
      
        $topic = $this->input->post('topic');
        $title = $this->input->post('title');
        $message = $this->input->post('message');
        
        $url = 'https://fcm.googleapis.com/fcm/send';
        $headers = array (
          'Authorization:key=' . $serverkey,
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
        
        //$this->notif->send_notif($serverkey,$title, $message, $topic);
        $this->session->set_flashdata('send', $response);
        redirect('appnotification/index');
    }
}
