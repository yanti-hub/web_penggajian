<?php

class Dashboard extends CI_controller{
    
    public function __construct(){
        parent::__construct();

        if ($this->session->userdata('hak_akses') !='1') {
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

    public function Index()
    {
        check_login();
        // echo "hello world"; 
        $data['title'] = "Dashboard";
        $pegawai = $this->db->query("SELECT * FROM data_pegawai");
        $data['pegawai']=$pegawai->num_rows();

        $admin = $this->db->query("SELECT * FROM data_pegawai WHERE jabatan = 'Admin'");
        $data['admin']=$admin->num_rows();

        $jabatan = $this->db->query("SELECT * FROM data_jabatan");
        $data['jabatan']=$jabatan->num_rows();

        $kehadiran = $this->db->query("SELECT * FROM data_kehadiran");
        $data['kehadiran']=$kehadiran->num_rows();

        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/dashboard', $data);
        $this->load->view('templates_admin/footer');
    }


    // public function logout(){
    //     $this->session->sess_destroy();
    //     redirect(base_url());
    // }
}

?>