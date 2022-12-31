<?php

class Paket_model extends CI_model
{
    public function getAllpaket()
    {
        return  $this->db->get('paket')->result_array();
    }
    public function getpaketbyid($id)
    {
        return $this->db->get_where('paket', ['id' => $id])->row_array();
    }
    public function addpaket($data)
    {
        $this->db->insert('paket', $data);
    }
    public function editpaket($data)
    {

        $this->db->set('nama', $data['nama']);
        $this->db->set('harga', $data['harga']);
        $this->db->set('keterangan', $data['keterangan']);
        $this->db->set('ikon', $data['ikon']);
        $this->db->set('status', $data['status']);
        $this->db->where('id', $data['id']);
        return $this->db->update('paket', $data);
    }
    public function hapuspaketbyid($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('paket');
    }
}