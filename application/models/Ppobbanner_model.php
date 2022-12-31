<?php

class Ppobbanner_model extends CI_model
{
    public function getAllbanner()
    {
        $this->db->select('*');
        $this->db->order_by('id', 'ASC');
        return  $this->db->get('ppob_banner')->result_array();
    }
    public function getfiturbyid($id)
    {
        $this->db->select('*');
        $this->db->where('id', $id);
        return $this->db->get('ppob_banner')->row_array();
    }
    public function tambah($data)
    {
        $this->db->insert('ppob_banner', $data);
    }
    public function ubah($data)
    {
        $this->db->set('foto', $data['foto']);
        $this->db->set('status', $data['status']);
        $this->db->where('id', $data['id']);
        $this->db->update('ppob_banner');
    }
    public function hapusservicebyId($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('ppob_banner');
    }
}