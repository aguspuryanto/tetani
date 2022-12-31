<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Paket extends CI_Controller
{
    public function  __construct()
    {
        parent::__construct();
        if ($this->session->userdata('user_name') == NULL && $this->session->userdata('password') == NULL) {
            redirect(base_url() . "login");
        }
        $this->load->database();
        $this->load->model('Paket_model', 'paket');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['paket'] = $this->paket->getAllpaket();
        $this->load->view('includes/header');
        $this->load->view('paket/index', $data);
        $this->load->view('includes/footer');
    }
    public function addpaket()
    {
        $this->form_validation->set_rules('nama', 'nama', 'trim|prep_for_form');
        $this->form_validation->set_rules('keterangan', 'keterangan', 'trim|prep_for_form');
        $this->form_validation->set_rules('harga', 'harga', 'trim|prep_for_form');
        $this->form_validation->set_rules('ikon', 'ikon', 'trim|prep_for_form');
        $this->form_validation->set_rules('status', 'status', 'trim|prep_for_form');

        if ($this->form_validation->run() == TRUE) {
            $config['upload_path']     = './images/package/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']         = '10000';
            $config['file_name']     = 'name';
            $config['encrypt_name']     = true;
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('ikon')) {
                $gambar = html_escape($this->upload->data('file_name'));
                unlink('./images/package/' . $gambar);
            } else {
                $gambar = 'noimage.jpg';
            }
            $data             = [
                'ikon'                  => $gambar,
                'nama'                  => html_escape($this->input->post('nama', TRUE)),
                'harga'                 => html_escape($this->input->post('harga', TRUE)),
                'keterangan'                 => html_escape($this->input->post('keterangan', TRUE)),
                'status'                => html_escape($this->input->post('status', TRUE))
            ];

            if (demo == TRUE) {
                $this->session->set_flashdata('demo', 'NOT ALLOWED FOR DEMO');
                redirect('paket/addpaket');
            } else {
                $this->paket->addpaket($data);
                $this->session->set_flashdata('tambah', 'Paket berhasil ditambahkan');
                redirect('paket');
            }
        } else {

            $this->load->view('includes/header');
            $this->load->view('paket/addpaket');
            $this->load->view('includes/footer');
        }
    }
    public function editpaket($id)
    {
        $this->form_validation->set_rules('nama', 'nama', 'trim|prep_for_form');
        $this->form_validation->set_rules('keterangan', 'keterangan', 'trim|prep_for_form');
        $this->form_validation->set_rules('harga', 'harga', 'trim|prep_for_form');
        $this->form_validation->set_rules('ikon', 'ikon', 'trim|prep_for_form');
        $this->form_validation->set_rules('status', 'status', 'trim|prep_for_form');

        $data['paket'] = $this->paket->getpaketbyid($id);
        $id  = html_escape($this->input->post('id', TRUE));

        if ($this->form_validation->run() == TRUE) {
            $data                   = [
                'id'                            => html_escape($this->input->post('id', TRUE)),
                'nama'                          => html_escape($this->input->post('nama', TRUE)),
                'harga'                         => html_escape($this->input->post('harga', TRUE)),
                'keterangan'                         => html_escape($this->input->post('keterangan', TRUE)),
                'ikon'                          => html_escape($this->input->post('ikon', TRUE)),
                'status'                        => html_escape($this->input->post('status', TRUE))
            ];

            if (demo == TRUE) {
                $this->session->set_flashdata('demo', 'NOT ALLOWED FOR DEMO');
                redirect('paket/index');
            } else {
                $this->paket->editpaket($data);
                $this->session->set_flashdata('tambah', 'Paket berhasil Diubah');
                redirect('paket');
            }
        } else {

            $this->load->view('includes/header');
            $this->load->view('paket/editpaket', $data);
            $this->load->view('includes/footer');
        }
    }

    public function hapuspaket($id)
    {
        if (demo == TRUE) {
            $this->session->set_flashdata('demo', 'NOT ALLOWED FOR DEMO');
            redirect('paket/index');
        } else {
            $data = $this->paket->getpaketbyid($id);

            $this->paket->hapuspaketbyid($id);
            $this->session->set_flashdata('hapus', 'Paket Berhasil Dihapus');
            redirect('paket');
        }
    }
}