<?php

class GantiPassword extends CI_Controller{

    public function __construct(){
        parent::__construct();

        if ($this->session->userdata('hak_akses') !='2') {
            $this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Anda belum login!</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
				redirect('welcome');
        }

        // die;
    }


    public function index()
    {
        $data['title'] = "Ganti Password";
        $this->load->view('templates_pegawai/header', $data);
        $this->load->view('templates_pegawai/sidebar');
        $this->load->view('pegawai/formGantiPassword', $data);
        $this->load->view('templates_pegawai/footer');
    }
    public function gantiPasswordAksi()
    {
        $passBaru = $this->input->post('passBaru');
        $ulangPass = $this->input->post('ulangPass');

        $this->form_validation->set_rules('passBaru','password baru','required|matches[ulangPass]');
        $this->form_validation->set_rules('ulangPass','ulangi password','required');

        if($this->form_validation->run() != FALSE) {
            $data = array('password' => md5($passBaru));
            $id = array('id_pegawai'=> $this->session->userdata('id_pegawai'));

            $this->penggajianModel->update_data('data_pegawai',$data,$id);
            $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Password berhasil diganti</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
            redirect('welcome');
        }else{
            $data['title'] = "Ganti Password";
            $this->load->view('templates_pegawai/header', $data);
            $this->load->view('templates_pegawai/sidebar');
            $this->load->view('pegawai/formGantiPassword', $data);
            $this->load->view('templates_pegawai/footer');
        }
    }
}

?>