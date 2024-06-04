<?php

class Dashboard extends CI_controller
{

    public function __construct(){
        parent::__construct();

        if ($this->session->userdata('hak_akses') !='3') {
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
        // echo "bismillah" ;
        $data['title'] = "Dashboard";
        $id=$this->session->userdata('id_pegawai');
        $data['pegawai'] = $this->db->query("SELECT * FROM data_pegawai WHERE id_pegawai='$id'")->result();
    
        $pegawai = $this->db->query("SELECT * FROM data_pegawai");
        $data['pegawai']=$pegawai->num_rows();

        $admin = $this->db->query("SELECT * FROM data_pegawai WHERE jabatan = 'Admin'");
        $data['admin']=$admin->num_rows();

        $jabatan = $this->db->query("SELECT * FROM data_jabatan");
        $data['jabatan']=$jabatan->num_rows();

        $kehadiran = $this->db->query("SELECT * FROM data_kehadiran");
        $data['kehadiran']=$kehadiran->num_rows();

        $this->load->view('templates_superadmin/header', $data);
        $this->load->view('templates_superadmin/sidebar');
        $this->load->view('superadmin/dashboard', $data);
        $this->load->view('templates_superadmin/footer');
        
    }
}

?>