<?php

class Profile_model extends CI_model
{
    public function getadmin($id)
    {
        $this->db->where('id', $id);
        return  $this->db->get('admin')->row_array();
    }

    public function ubahdataadmin($data)
    {
        $this->db->set('user_name', $data['user_name']);
        $this->db->set('email', $data['email']);
        $this->db->set('image', $data['image']);
        $this->db->set('password', $data['password']);
        $this->db->where('id', $data['id']);
        $this->db->update('admin', $data);
    }
}
