<?php

class staff_model extends CI_model
{
    public function getAllcm()
    {
        return  $this->db->get('admin')->result_array();
    }
    public function getdatabyid($id)
    {
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where('id',$id);
        return $this->db->get(); 
    }
    public function tambahcm($data)
    {
        $this->db->insert('admin', $data);
    }

    public function hapuscm($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('admin');
    }

    public function ubahcm($data, $id)
    {
        $this->db->set('user_name', $data['user_name']);
        $this->db->set('password', $data['password']);
        $this->db->set('email', $data['email']);
        $this->db->set('image', $data['image']);
        $this->db->set('level', $data['level']);
        $this->db->where('id', $id);
        $this->db->update('admin');
    }
}
