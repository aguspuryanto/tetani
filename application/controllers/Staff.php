<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Staff extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
     

        if ($this->session->userdata('user_name') == NULL && $this->session->userdata('password') == NULL) {
            redirect(base_url() . "login");
        }
        $this->load->model('staff_model', 'cm');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['catmer'] = $this->cm->getallcm();
        $this->load->view('includes/header');
        $this->load->view('staff/index', $data);
        $this->load->view('includes/footer');
    }

    public function tambahcm()
    {


        $this->form_validation->set_rules('user_name', 'user_name', 'trim|prep_for_form');

        if ($this->form_validation->run() == TRUE) {
            $config['upload_path']     = './images/admin/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']         = '10000';
            $config['file_name']     = 'name';
            $config['encrypt_name']     = true;
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $gambar = html_escape($this->upload->data('file_name'));
            } else {
                $gambar = 'noimage.jpg';
            }
            $password = html_escape($this->input->post('password', TRUE));
            $data = [
                'image'                       => $gambar,
                'user_name'     => html_escape($this->input->post('user_name', TRUE)),
                'password'          => sha1($password),
                'email'   => html_escape($this->input->post('email', TRUE)),
                'level'   => html_escape($this->input->post('level', TRUE)),
            ];
            $this->cm->tambahcm($data);
            $this->session->set_flashdata('tambah', 'Staff berhasil ditambahkan');
            redirect('staff');
        }
    }

    public function hapus($id)
    {
        if(($this->session->userdata('id') == id))
        {
            $this->session->set_flashdata('hapus', 'Tidak Bisa Menghapus Akun Yang Sedang Aktif');
        }else{
            $this->cm->hapuscm($id);
            $this->session->set_flashdata('hapus', 'Staff berhasil dihapus');
        }    
        redirect('staff');
    }


    public function ubahcm()
    {
        $this->form_validation->set_rules('user_name', 'user_name', 'trim|prep_for_form');
        if ($this->form_validation->run() == TRUE) {
            $config['upload_path']     = './images/admin/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']         = '10000';
            $config['file_name']     = time();
            $config['encrypt_name']     = true;
            $this->load->library('upload', $config);
             if ($this->upload->do_upload('image')) {
                if ($data['image'] != 'noimage.png') {
                    $gambar = $data['image'];
                    unlink('images/admin/' . $gambar);
                }

                $gambar = html_escape($this->upload->data('file_name'));
            } else {
                $gambar = $data['image'];
            }
            $password = html_escape($this->input->post('password', TRUE));
            $id = $this->input->post('id');
              $data = [
                'image'                       => $gambar,
                'user_name'     => html_escape($this->input->post('user_name', TRUE)),
                'password'          => sha1($password),
                'email'   => html_escape($this->input->post('email', TRUE)),
                'level'   => html_escape($this->input->post('level', TRUE)),
                ];
           

            $this->cm->ubahcm($data, $id);
            $this->session->set_flashdata('ubah', 'Staff Berhasil Diperbarui');
            redirect('staff');
        }
    }
}
