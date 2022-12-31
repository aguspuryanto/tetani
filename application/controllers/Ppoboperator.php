<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ppoboperator extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        
        if ($this->session->userdata('user_name') == NULL && $this->session->userdata('password') == NULL) {
            redirect(base_url() . "login");
        }

        $this->load->model('Ppoboperator_model', 'ppoboperator');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['ppoboperator'] = $this->ppoboperator->getallbrand();
        $this->load->view('includes/header');
        $this->load->view('ppoboperator/index', $data);
        $this->load->view('includes/footer');
    }

    public function ubah($kode)
    {

        $this->form_validation->set_rules('kode', 'kode', 'trim|prep_for_form');
        $this->form_validation->set_rules('nama', 'nama', 'trim|prep_for_form');
        $this->form_validation->set_rules('brand', 'brand', 'trim|prep_for_form');
        $this->form_validation->set_rules('keterangan', 'keterangan', 'trim|prep_for_form');
        $this->form_validation->set_rules('fee', 'fee', 'trim|prep_for_form');
        $this->form_validation->set_rules('iszone', 'iszone', 'trim|prep_for_form');
        $this->form_validation->set_rules('type', 'type', 'trim|prep_for_form');
        $this->form_validation->set_rules('status', 'status', 'trim|prep_for_form');

        $data = $this->ppoboperator->getbrandbyid($kode);
        $id = html_escape($this->input->post('kode', TRUE));
        if ($this->form_validation->run() == TRUE) {
            $config['upload_path']     = './images/ppob/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']         = '10000';
            $config['file_name']     = 'name';
            $config['encrypt_name']     = true;
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('ikon')) {
                if ($data['ikon'] != 'noimage.png') {
                    $gambar = $data['ikon'];
                    unlink('images/ppob/' . $gambar);
                }

                $gambar = html_escape($this->upload->data('file_name'));
            } else {
                $gambar = $data['ikon'];
            }
            $remove = array(".", ",");
            $add = array("", "");

            $dataubah             = [
                'ikon'                          => $gambar,
                'kode'                          => html_escape($this->input->post('kode', TRUE)),
                'nama'                          => html_escape($this->input->post('nama', TRUE)),
                'brand'                         => html_escape($this->input->post('brand', TRUE)),
                'keterangan'                    => html_escape($this->input->post('keterangan', TRUE)),
                'fee'                     => html_escape($this->input->post('fee', TRUE)),
                'iszone'                     => html_escape($this->input->post('iszone', TRUE)),
                'type'                          => html_escape($this->input->post('type', TRUE)),
                'status'                        => html_escape($this->input->post('status', TRUE))
            ];

            if (demo == TRUE) {
                $this->session->set_flashdata('demo', 'NOT ALLOWED FOR DEMO');
                redirect('ppoboperator/index');
            } else {

                $this->ppoboperator->ubah($dataubah);
                $this->session->set_flashdata('ubah', 'Berhasil Diubah');
                redirect('ppoboperator');
            }
        } else {

            $this->load->view('includes/header');
            $this->load->view('ppoboperator/ubah' . $id, $data);
            $this->load->view('includes/footer');
        }
    }

    public function tambah()

    {
        $this->form_validation->set_rules('nama', 'nama', 'trim|prep_for_form');
        $this->form_validation->set_rules('brand', 'brand', 'trim|prep_for_form');
        $this->form_validation->set_rules('keterangan', 'keterangan', 'trim|prep_for_form');
        $this->form_validation->set_rules('iszone', 'iszone', 'trim|prep_for_form');
        $this->form_validation->set_rules('type', 'type', 'trim|prep_for_form');
        $this->form_validation->set_rules('fee', 'fee', 'trim|prep_for_form');
        $this->form_validation->set_rules('ikon', 'ikon', 'trim|prep_for_form');
        $this->form_validation->set_rules('status', 'status', 'trim|prep_for_form');
        $kode = mt_rand(100000, 999999);
        if ($this->form_validation->run() == TRUE) {
            $config['upload_path']     = './images/ppob/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']         = '10000';
            $config['file_name']     = 'name';
            $config['encrypt_name']     = true;
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('ikon')) {
                $gambar = html_escape($this->upload->data('file_name'));
            } else {
                $gambar = 'noimage.png';
            }
            $data             = [
                'ikon'                          => $gambar,
                'kode'                          => $kode,
                'nama'                          => html_escape($this->input->post('nama', TRUE)),
                'brand'                         => html_escape($this->input->post('brand', TRUE)),
                'keterangan'                    => html_escape($this->input->post('keterangan', TRUE)),
                'fee'                     => html_escape($this->input->post('fee', TRUE)),
                'iszone'                     => html_escape($this->input->post('iszone', TRUE)),
                'type'                          => html_escape($this->input->post('type', TRUE)),
                'status'                        => html_escape($this->input->post('status', TRUE))
            ];


            if (demo == TRUE) {
                $this->session->set_flashdata('demo', 'NOT ALLOWED FOR DEMO');
                redirect('ppoboperator/index');
            } else {

                $this->ppoboperator->tambah($data);
                $this->session->set_flashdata('ubah', 'Operator Berhasil Ditambahkan');
                redirect('ppoboperator');
            }

        
        } else {

        $this->load->view('includes/header');
        $this->load->view('ppoboperator/tambah');
        $this->load->view('includes/footer');
        }
    }

    public function hapus($kode)
    {
        if (demo == TRUE) {
            $this->session->set_flashdata('demo', 'NOT ALLOWED FOR DEMO');
            redirect('ppoboperator/index');
        } else {
            $data = $this->ppoboperator->getbrandbyid($kode);

            if ($data['ikon'] != 'noimage.jpg') {
                $gambar = $data['ikon'];
                unlink('images/ppob/' . $gambar);
            }

            $this->ppoboperator->hapusbyid($kode);
            $this->session->set_flashdata('hapus', 'Berhasil Dihapus');
            redirect('ppoboperator');
        }
    }
}
