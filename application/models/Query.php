<?php
class Query extends CI_Model{

    public function getDetailPedaftaran($id){
        $query = $this->db->query("SELECT t_pasien.no_rm,t_pasien.nama_pasien,t_pasien.tgl_lahir,t_pasien.no_jkn,t_pasien.jk,t_pasien.alamat,t_pasien.telp,t_pasien.umur,t_daftar.no_reg,t_daftar.tgl_kontrol,t_poli.name_poli,t_dokter.dokter_name,t_jadwal.hari,t_jadwal.jam,t_daftar.keluhan FROM t_daftar LEFT OUTER JOIN t_pasien ON(t_daftar.no_rm = t_pasien.no_rm) LEFT OUTER JOIN t_jadwal ON(t_daftar.id_jadwal = t_jadwal.id_jadwal) LEFT OUTER JOIN t_dokter ON(t_dokter.id_dokter = t_jadwal.id_dokter) LEFT OUTER JOIN t_poli ON(t_poli.id_poli = t_dokter.id_poli) WHERE t_daftar.no_reg='$id' AND t_daftar.visible='1'");

        return $query->row();
    }

    public function getAmbiAndKembali($id)
    {
        $query = $this->db->query("SELECT t_pengambilan.*,t_pasien.* FROM t_pengambilan LEFT OUTER JOIN t_pasien ON(t_pasien.no_rm=t_pengambilan.no_rm) WHERE t_pengambilan.id_pengambilan='$id'");
        return $query->row();
    }

    public function getPengembalian($id)
    {
        $query = $this->db->query("SELECT * FROM t_pengembalian WHERE id_pengambilan='$id'");
        return $query->row();
    }

    public function getLapPendaftaran($tgl1,$tgl2,$poli=null,$norm=null)
    {
        if($poli==null or $poli=="none"){
            $wherePoli = "";
        }else{
            $wherePoli = "AND t_poli.id_poli='$poli'";
        }

        if($norm==null or $poli=="none"){
            $wherePasien="";
        }else{
            $wherePasien="AND t_daftar.no_rm='$norm'";
        }

        return $this->db->query("SELECT `t_pasien`.`no_rm`, `t_pasien`.`nama_pasien`, `t_daftar`.`no_reg`, `t_daftar`.`tgl_kontrol`, `t_poli`.`name_poli`, `t_daftar`.`keluhan`, `t_dokter`.`dokter_name`, `t_jadwal`.`jam` 
        FROM `t_daftar` 
        LEFT OUTER JOIN t_pasien ON(t_pasien.no_rm=t_daftar.no_rm)
        LEFT OUTER JOIN t_jadwal ON(t_jadwal.id_jadwal=t_daftar.id_jadwal)
        LEFT OUTER JOIN t_dokter ON(t_dokter.id_dokter=t_jadwal.id_dokter)
        LEFT OUTER JOIN t_poli ON(t_poli.id_poli=t_dokter.id_poli)
        WHERE `t_daftar`.`tgl_kontrol` BETWEEN '$tgl1' AND '$tgl2' 
        AND `t_daftar`.`visible` = '1' 
        $wherePoli $wherePasien ORDER BY t_daftar.tgl_kontrol ASC")->Result();
    }

    public function getLapFeedback($tgl1,$tgl2,$poli=null,$norm=null)
    {
        if($poli==null or $poli=="none"){
            $wherePoli = "";
        }else{
            $wherePoli = "AND t_poli.id_poli='$poli'";
        }

        if($norm==null or $poli=="none"){
            $wherePasien="";
        }else{
            $wherePasien="AND t_daftar.no_rm='$norm'";
        }

        return $this->db->query("SELECT t_pasien.no_rm,t_pasien.nama_pasien,t_daftar.no_reg,t_nilai.tgl_nilai,t_poli.name_poli,t_dokter.dokter_name FROM t_nilai LEFT OUTER JOIN t_daftar ON(t_daftar.no_reg=t_nilai.no_reg) LEFT OUTER JOIN t_pasien ON(t_pasien.no_rm=t_daftar.no_rm) LEFT OUTER JOIN t_jadwal ON(t_jadwal.id_jadwal=t_daftar.id_jadwal) LEFT OUTER JOIN t_dokter ON(t_dokter.id_dokter=t_jadwal.id_dokter) LEFT OUTER JOIN t_poli ON(t_poli.id_poli=t_dokter.id_poli) WHERE t_nilai.visible='1' AND t_nilai.tgl_nilai BETWEEN '$tgl1' AND '$tgl2' $wherePoli $wherePasien ORDER BY t_nilai.tgl_nilai DESC")->Result();
    }
}
?>