<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Ppobbanner extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        if ($this->session->userdata('user_name') == NULL && $this->session->userdata('password') == NULL) {
            redirect(base_url() . "login");
        }

        $this->load->model('Ppobbanner_model', 'ppobbanner');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['ppobbanner'] = $this->ppobbanner->getAllbanner();
        $this->load->view('includes/header');
        $this->load->view('ppobbanner/index', $data);
        $this->load->view('includes/footer');
    }
    public function tambah()

    {
        $this->form_validation->set_rules('foto', 'foto', 'trim|prep_for_form');
        $this->form_validation->set_rules('status', 'status', 'trim|prep_for_form');
        if ($this->form_validation->run() == TRUE) {
            $config['upload_path']     = './images/ppob/banner/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']         = '10000';
            $config['file_name']     = 'name';
            $config['encrypt_name']     = true;
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto')) {
                $gambar = html_escape($this->upload->data('file_name'));
            } else {
                $gambar = 'noimage.png';
            }
            $data             = [
                'foto'                          => $gambar,
                'status'                        => html_escape($this->input->post('status', TRUE))
            ];


            if (demo == TRUE) {
                $this->session->set_flashdata('demo', 'NOT ALLOWED FOR DEMO');
                redirect('ppobbanner/index');
            } else {

                $this->ppobbanner->tambah($data);
                $this->session->set_flashdata('ubah', 'Banner Has Been Added');
                redirect('ppobbanner');
            }

        
        } else {

        $this->load->view('includes/header');
        $this->load->view('ppobbanner/tambah');
        $this->load->view('includes/footer');
        }
    }
    public function ubah($id)
    {

        $this->form_validation->set_rules('foto', 'foto', 'trim|prep_for_form');
        $this->form_validation->set_rules('status', 'status', 'trim|prep_for_form');
        $data = $this->ppobbanner->getfiturbyid($id);
        $id = html_escape($this->input->post('kode', TRUE));
        if ($this->form_validation->run() == TRUE) {
            $config['upload_path']     = './images/ppob/banner/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']         = '10000';
            $config['file_name']     = 'name';
            $config['encrypt_name']     = true;
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('ikon')) {
                if ($data['ikon'] != 'noimage.png') {
                    $gambar = $data['foto'];
                    unlink('images/ppob/banner/' . $gambar);
                }

                $gambar = html_escape($this->upload->data('file_name'));
            } else {
                $gambar = $data['ikon'];
            }
            $remove = array(".", ",");
            $add = array("", "");

            $data             = [
                'foto'                          => $gambar,
                'status'                        => html_escape($this->input->post('status', TRUE))
            ];

            if (demo == TRUE) {
                $this->session->set_flashdata('demo', 'NOT ALLOWED FOR DEMO');
                redirect('ppobbanner/index');
            } else {

                $this->ppobbanner->ubah($data);
                $this->session->set_flashdata('ubah', 'Ppob Has Been Changed');
                redirect('ppobbanner');
            }
        } else {

            $this->load->view('includes/header');
            $this->load->view('ppobbanner/ubah' . $id, $data);
            $this->load->view('includes/footer');
        }
    }
    public function hapusservice($id)
    {
        if (demo == TRUE) {
            $this->session->set_flashdata('demo', 'NOT ALLOWED FOR DEMO');
            redirect('ppobbanner/index');
        } else {
            $data = $this->ppobbanner->getfiturbyid($id);

            if ($data['foto'] != 'noimage.jpg') {
                $gambar = $data['foto'];
                unlink('images/ppob/banner/' . $gambar);
            }

            $this->ppobbanner->hapusserviceById($id);
            $this->session->set_flashdata('hapus', 'Data Has Been deleted');
            redirect('ppobbanner');
        }
    }
}