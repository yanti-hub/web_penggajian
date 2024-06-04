<?php

 function check_login(){
    $t = get_instance();
    if(!$t->session->userdata('nama_pegawai') || !$t->session->userdata('hak_akses')){
        redirect(base_url());
    }


}


?>



