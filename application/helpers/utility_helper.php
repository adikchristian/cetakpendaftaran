<?php
function getAge($tgl)
{
    $birthDate = new DateTime($tgl);
    $today = new DateTime("today");

    if ($birthDate > $today) {
        exit("0 tahun 0 bulan 0 hari");
    }
    
    $y = $today->diff($birthDate)->y;
    return $y;
}
function tglIndo($tgl){
    $tanggal = explode("-",$tgl);
    $tglIndo = $tanggal[2].'-'.$tanggal[1].'-'.$tanggal[0];
    return $tglIndo;
}
function jenKel($jk){
    if($jk=="L"){
        $jenkel = "Laki Laki";
    }else if($jk=="P"){
        $jenkel="Perempuan";
    }else{
        $jenkel="No...";
    }
    return $jenkel;
}

function getPengembalianByIdTgl($id)
{
    $ci =& get_instance();
    //$m = $ci->load->model('Query');
    $row = $ci->db->query("SELECT * FROM t_pengembalian WHERE id_pengambilan='$id'");
    $sql = $row->row();
    $tgl = $sql->tgl_kembali;
    return $tgl;
}
?>