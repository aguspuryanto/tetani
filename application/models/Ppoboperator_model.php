<?php

class Ppoboperator_model extends CI_model
{
    public function getallbrand()
    {
        $this->db->select('*');
        $this->db->order_by('brand', 'ASC');
        return  $this->db->get('digi_brand')->result_array();
    }
    public function getbrandbyid($id)
    {
        $this->db->select('*');
        $this->db->where('kode', $id);
        return $this->db->get('digi_brand')->row_array();
    }

 

    public function ubah($data)
    {
        $this->db->set('ikon', $data['ikon']);
        $this->db->set('nama', $data['nama']);
        $this->db->set('brand', $data['brand']);
        $this->db->set('fee', $data['fee']);
        $this->db->set('iszone', $data['iszone']);
        $this->db->set('keterangan', $data['keterangan']);
        $this->db->set('type', $data['type']);
        $this->db->set('status', $data['status']);
        $this->db->where('kode', $data['kode']);
        $this->db->update('digi_brand');
    }

    public function tambah($data)
    {
        $this->db->insert('digi_brand', $data);
    }

    public function hapusbyid($kode)
    {
        $this->db->where('kode', $kode);
        $this->db->delete('digi_brand');
    }
}
