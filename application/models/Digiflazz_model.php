<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Digiflazz_model extends CI_model
{
    function __construct()
    {
        parent::__construct();
    }
    function datasetting(){
        $this->db->select('*');
        $this->db->from('app_settings');
        $this->db->where('id', '1');
        return $this->db->get();
    }
    public function listkategori($tipe)
    {
        $this->db->select('*');
        $this->db->from('digi_brand');
        $this->db->order_by('nama DESC');
        $this->db->where('type', $tipe);
        $this->db->where('status', 1);
        return $this->db->get()->result_array();
    }
}