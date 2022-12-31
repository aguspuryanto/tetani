<?php

class Ppobtipe_model extends CI_model
{
    public function getAllservice()
    {
        $this->db->select('*');
        $this->db->order_by('tipe', 'ASC');
        return  $this->db->get('ppob_tipe')->result_array();
    }
    public function getfiturbyid($id)
    {
        $this->db->select('*');
        $this->db->where('kode', $id);
        return $this->db->get('ppob_tipe')->row_array();
    }

    public function ubah($data)
    {
        $this->db->set('ikon', $data['ikon']);
        $this->db->set('tipe', $data['tipe']);
        $this->db->set('status', $data['status']);
        $this->db->set('background', $data['background']);
        $this->db->set('jenis', $data['jenis']);
        $this->db->where('kode', $data['kode']);
        $this->db->update('ppob_tipe');
    }

    public function tambah($data)
    {
        $this->db->insert('ppob_tipe', $data);
    }

    public function hapusservicebyId($id)
    {
        $this->db->where('kode', $id);
        $this->db->delete('ppob_tipe');
    }
}
