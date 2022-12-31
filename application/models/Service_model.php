<?php

class Service_model extends CI_model
{
    public function getAllservice()
    {
        $this->db->select('fitur.*');
        $this->db->order_by('id_fitur', 'ASC');
        return  $this->db->get('fitur')->result_array();
    }

    public function getAlldriverjob()
    {
        return  $this->db->get('driver_job')->result_array();
    }


    public function getcurrency()
    {
        $this->db->select('app_currency as duit');
        $this->db->where('id', '1');
        return $this->db->get('app_settings')->row_array();
    }

    public function getfiturbyid($id)
    {
        $this->db->select('fitur.*');
        $this->db->where('id_fitur', $id);
        return $this->db->get('fitur')->row_array();
    }

    public function getvoucherbyid($id)
    {       
        $this->db->select('*');
        $this->db->where('id', $id);
        return $this->db->get('voucher')->row_array();
    }

    public function ubahdatafitur($data)
    {
        $this->db->set('icon', $data['icon']);
        $this->db->set('fitur', $data['fitur']);
        $this->db->set('home', $data['home']);
        $this->db->set('biaya', $data['biaya']);
        $this->db->set('keterangan_biaya', $data['keterangan_biaya']);
        $this->db->set('komisi', $data['komisi']);
        $this->db->set('promo', $data['promo']);
        $this->db->set('driver_job', $data['driver_job']);
        $this->db->set('biaya_minimum', $data['biaya_minimum']);
        $this->db->set('jarak_minimum', $data['jarak_minimum']);
        $this->db->set('maks_distance', $data['maks_distance']);
        $this->db->set('wallet_minimum', $data['wallet_minimum']);
        $this->db->set('keterangan', $data['keterangan']);
        $this->db->set('background', $data['background']);
        $this->db->set('tint', $data['tint']);
        $this->db->set('usedtint', $data['usedtint']);
        $this->db->set('kota', $data['kota']);
        $this->db->set('active', $data['active']);

        $this->db->where('id_fitur', $data['id_fitur']);
        $this->db->update('fitur');
    }

    public function tambahdatafitur($data)
    {
        $this->db->insert('fitur', $data);
    }

    public function hapusservicebyId($id)
    {
        $this->db->where('id_fitur', $id);
        $this->db->delete('fitur');
    }
}
