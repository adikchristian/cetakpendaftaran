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

    public function getFeedbackDetail($select="lap",$tgl1,$tgl2,$pertanyaan=null,$pasien=null,$penilaian=null,$idnilai=null,$kate="BETWEEN")
    {
        if($pertanyaan==null or $pertanyaan=="none"){
            $wherePetanyaan = "";
        }else{
            $wherePetanyaan = "AND t_nilai_detail.pertanyaan='$pertanyaan'";
        }

        if($pasien==Null or $pasien=="none"){
            $wherePasien = "";
        }else{
            $wherePasien = "AND t_pasien.no_rm='$pasien'";
        }

        if($penilaian==null or $penilaian=="none"){
            $wherePenilaian = "";
        }else{
            $wherePenilaian="AND t_nilai_detail.nilai='$penilaian'";
        }

        if($idnilai==null or $idnilai=="none"){
            $whereIdNilai = "";
        }else{
            $whereIdNilai = "AND t_nilai_detail.id_nilai='$idnilai'";
        }

        if($select=="lap"){
            $selectTable = "t_pasien.no_rm,t_pasien.nama_pasien,t_daftar.no_reg,t_nilai.tgl_nilai,t_nilai_detail.pertanyaan,t_nilai_detail.nilai";
        }else if($select=="distinct"){
            $selectTable = "DISTINCT t_nilai.tgl_nilai";
        }else{
            $selectTable = "t_nilai.tgl_nilai";
        }

        if($kate=="BETWEEN"){
            $wherePeriode = "AND t_nilai.tgl_nilai BETWEEN '$tgl1' AND '$tgl2'";
        }else{
            $wherePeriode = "AND t_nilai.tgl_nilai='$tgl1'";
        }

        return $this->db->query("SELECT $selectTable FROM t_nilai_detail LEFT OUTER JOIN t_nilai ON(t_nilai.id_nilai=t_nilai_detail.id_nilai) LEFT OUTER JOIN t_daftar ON(t_daftar.no_reg=t_nilai.no_reg)LEFT OUTER JOIN t_pasien ON(t_pasien.no_rm=t_daftar.no_rm) WHERE t_nilai_detail.visible='1' $wherePeriode $wherePetanyaan $wherePasien $wherePenilaian $whereIdNilai ORDER BY t_nilai.tgl_nilai ASC")->Result();
    }

    public function getPengambilan($select="lap",$tgl1,$tgl2,$status=null,$pasien=null,$kate="BETWEEN")
    {
        if($status==null or $status=="none"){
            $whereStatus="";
        }else{
            $whereStatus="AND t_pengambilan.kembali='$status'";    
        }

        if($pasien==null or $status=="none"){
            $wherePasien = "";
        }else{
            $wherePasien = "AND t_pengambilan.no_rm='$pasien'";
        }

        if($select=="lap"){
            $select="t_pasien.no_rm,t_pasien.nama_pasien,t_pengambilan.tgl_proses,t_pengambilan.nama_peminjam,t_pengambilan.ket,t_pengambilan.kembali";
        }else if($select=="distinct"){
            $select="DISTINCT t_pengambilan.tgl_proses";
        }else{
            $select="t_pengambilan.tgl_proses";
        }

        if($kate=="BETWEEN"){
            $filterPeriode="AND t_pengambilan.tgl_proses BETWEEN '$tgl1' AND '$tgl2'";
        }else{
            $filterPeriode="AND t_pengambilan.tgl_proses='$tgl1'";
        }

        return $this->db->query("SELECT $select FROM t_pengambilan LEFT OUTER JOIN t_pasien ON(t_pasien.no_rm=t_pengambilan.no_rm) WHERE t_pengambilan.visible='1' $filterPeriode $whereStatus $wherePasien ORDER By t_pengambilan.tgl_proses ASC")->Result();
    }

    public function getPengembalianLap($select="lap",$tgl1,$tgl2,$pasien=null,$kate="BETWEEN")
    {
        if($pasien==null or $pasien=="none"){
            $wherePasien = "";
        }else{
            $wherePasien = "AND t_pengambilan.no_rm='$pasien'";
        }

        if($select=="lap"){
            $select="t_pasien.no_rm,t_pasien.nama_pasien,t_pengembalian.tgl_kembali,t_pengembalian.catatan";
        }else if($select=="distinct"){
            $select="DISTINCT t_pengembalian.tgl_kembali";
        }else{
            $select="t_pengembalian.tgl_kembali";
        }

        if($kate=="BETWEEN"){
            $wherePeriode="AND t_pengembalian.tgl_kembali BETWEEN '$tgl1' AND '$tgl2'";
        }else{
            $wherePeriode="AND t_pengembalian.tgl_kembali='$tgl1'";
        }

        return $this->db->query("SELECT $select FROM `t_pengembalian` LEFT OUTER JOIN t_pengambilan ON(t_pengembalian.id_pengambilan=t_pengambilan.id_pengambilan) LEFT OUTER JOIN t_pasien ON(t_pasien.no_rm=t_pengambilan.no_rm) WHERE t_pengembalian.visible='1' $wherePeriode $wherePasien")->Result();
    }

    
}
?>