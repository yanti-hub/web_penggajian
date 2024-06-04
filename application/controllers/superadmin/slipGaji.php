<?php

class slipGaji extends CI_Controller{

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

    public function index()
    {
        $data['title'] = "Filter Slip Gaji Pegawai";
        $data['pegawai'] = $this->penggajianModel->get_data('data_pegawai')->result();

        $this->load->view('templates_superadmin/header', $data);
        $this->load->view('templates_superadmin/sidebar');
        $this->load->view('superadmin/filterSlipGaji', $data);
        $this->load->view('templates_superadmin/footer');
    }

    public function cetakSlipGaji()
    {
        $data['title'] = "Cetak Slip Gaji";
        $data['potongan'] =$this->penggajianModel->get_data('potongan_gaji')->result();
        $nama = $this->input->post('nama_pegawai');
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        $bulantahun = $bulan.$tahun;

        $data['print_slip'] = $this->db->query("SELECT data_pegawai.nik,data_pegawai.nama_pegawai,
        data_jabatan.nama_jabatan,data_jabatan.gaji_pokok,data_jabatan.tj_transport,data_jabatan.
        uang_makan,data_kehadiran.alfa,data_kehadiran.bulan
        FROM data_pegawai
        INNER JOIN data_kehadiran ON data_kehadiran.nik=data_pegawai.nik
        INNER JOIN data_jabatan ON data_jabatan.nama_jabatan=data_pegawai.jabatan
        WHERE data_kehadiran.bulan='$bulantahun' AND data_kehadiran.nama_pegawai='$nama'")->result();
        $this->load->view('templates_superadmin/header', $data);
        $this->load->view('superadmin/cetakSlipGaji', $data);
    }
}

?>