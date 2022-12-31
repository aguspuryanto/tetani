<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ppobtipe extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        
        if ($this->session->userdata('user_name') == NULL && $this->session->userdata('password') == NULL) {
            redirect(base_url() . "login");
        }

        $this->load->model('Ppobtipe_model', 'ppobtipe');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['ppobtipe'] = $this->ppobtipe->getallservice();
        $this->load->view('includes/header');
        $this->load->view('ppobtipe/index', $data);
        $this->load->view('includes/footer');
    }

    public function ubah($id)
    {

        $this->form_validation->set_rules('tipe', 'tipe', 'trim|prep_for_form');
        $this->form_validation->set_rules('kode', 'kode', 'trim|prep_for_form');
        $this->form_validation->set_rules('status', 'status', 'trim|prep_for_form');
        $this->form_validation->set_rules('background', 'background', 'trim|prep_for_form');
        $this->form_validation->set_rules('jenis', 'jenis', 'trim|prep_for_form');
        $data = $this->ppobtipe->getfiturbyid($id);
        $id = html_escape($this->input->post('kode', TRUE));
        if ($this->form_validation->run() == TRUE) {
            $config['upload_path']     = './images/ppob/tipe/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']         = '10000';
            $config['file_name']     = 'name';
            $config['encrypt_name']     = true;
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('ikon')) {
                if ($data['ikon'] != 'noimage.png') {
                    $gambar = $data['ikon'];
                    unlink('images/ppob/tipe/' . $gambar);
                }

                $gambar = html_escape($this->upload->data('file_name'));
            } else {
                $gambar = $data['ikon'];
            }
            $remove = array(".", ",");
            $add = array("", "");

            $data             = [
                'ikon'                          => $gambar,
                'kode'                         => html_escape($this->input->post('kode', TRUE)),
                'tipe'                         => html_escape($this->input->post('tipe', TRUE)),
                'background'                         => html_escape($this->input->post('background', TRUE)),
                'jenis'                         => html_escape($this->input->post('jenis', TRUE)),
                'status'                        => html_escape($this->input->post('status', TRUE))
            ];

            if (demo == TRUE) {
                $this->session->set_flashdata('demo', 'NOT ALLOWED FOR DEMO');
                redirect('ppobtipe/index');
            } else {

                $this->ppobtipe->ubah($data);
                $this->session->set_flashdata('ubah', 'Ppob Has Been Changed');
                redirect('ppobtipe');
            }
        } else {

            $this->load->view('includes/header');
            $this->load->view('ppobtipe/ubah' . $id, $data);
            $this->load->view('includes/footer');
        }
    }

    public function tambah()

    {
        $this->form_validation->set_rules('kode', 'kode', 'trim|prep_for_form');
        $this->form_validation->set_rules('tipe', 'tipe', 'trim|prep_for_form');
        $this->form_validation->set_rules('ikon', 'ikon', 'trim|prep_for_form');
        $this->form_validation->set_rules('status', 'status', 'trim|prep_for_form');
        $this->form_validation->set_rules('background', 'background', 'trim|prep_for_form');
        $this->form_validation->set_rules('jenis', 'jenis', 'trim|prep_for_form');
        if ($this->form_validation->run() == TRUE) {
            $config['upload_path']     = './images/ppob/tipe/';
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
                'kode'                         => html_escape($this->input->post('kode', TRUE)),
                'tipe'                         => html_escape($this->input->post('tipe', TRUE)),
                'background'                         => html_escape($this->input->post('background', TRUE)),
                'jenis'                         => html_escape($this->input->post('jenis', TRUE)),
                'status'                        => html_escape($this->input->post('status', TRUE))
            ];


            if (demo == TRUE) {
                $this->session->set_flashdata('demo', 'NOT ALLOWED FOR DEMO');
                redirect('ppobtipe/index');
            } else {

                $this->ppobtipe->tambah($data);
                $this->session->set_flashdata('ubah', 'PPOB Has Been Added');
                redirect('ppobtipe');
            }

        
        } else {

        $this->load->view('includes/header');
        $this->load->view('ppobtipe/tambah');
        $this->load->view('includes/footer');
        }
    }

    public function hapusservice($id)
    {
        if (demo == TRUE) {
            $this->session->set_flashdata('demo', 'NOT ALLOWED FOR DEMO');
            redirect('ppobtipe/index');
        } else {
            $data = $this->ppobtipe->getfiturbyid($id);

            if ($data['ikon'] != 'noimage.jpg') {
                $gambar = $data['ikon'];
                unlink('images/ppob/tipe/' . $gambar);
            }

            $this->ppobtipe->hapusserviceById($id);
            $this->session->set_flashdata('hapus', 'Data Has Been deleted');
            redirect('ppobtipe');
        }
    }
}
