<?php
class Query extends CI_Model{

    public function getDetailPedaftaran($id)
    {
        /*$this->db->select('t_pasien.no_rm,t_pasien.nama_pasien,t_pasien.tgl_lahir,t_pasien.no_jkn,t_pasien.jk,t_pasien.alamat,t_pasien.telp,t_pasien.umur,t_daftar.no_reg,t_daftar.tgl_kontrol,t_poli.name_poli,t_dokter.dokter_name,t_jadwal.hari,t_jadwal.jam');
        $this->db->from('tpendaftaran');
        $this->db->where('t_daftar.no_reg',$id);
        $this->db->where('t_daftar.visible', '1');
        $this->db->join('t_pasien', 't_daftar.no_rm = t_pasien.no_rm', 'left');
        $this->db->join('t_jadwal', 't_daftar.id_jadwal = t_jadwal.id_jadwal', 'left');
        $this->db->join('t_dokter', 't_dokter.id_dokter = t_jadwal.id_dokter', 'left');
        $this->db->join('t_poli', 't_poli.id_poli = t_dokter.id_poli', 'left');*/
        $query = $this->db->query("SELECT t_pasien.no_rm,t_pasien.nama_pasien,t_pasien.tgl_lahir,t_pasien.no_jkn,t_pasien.jk,t_pasien.alamat,t_pasien.telp,t_pasien.umur,t_daftar.no_reg,t_daftar.tgl_kontrol,t_poli.name_poli,t_dokter.dokter_name,t_jadwal.hari,t_jadwal.jam,t_daftar.keluhan FROM t_daftar LEFT OUTER JOIN t_pasien ON(t_daftar.no_rm = t_pasien.no_rm) LEFT OUTER JOIN t_jadwal ON(t_daftar.id_jadwal = t_jadwal.id_jadwal) LEFT OUTER JOIN t_dokter ON(t_dokter.id_dokter = t_jadwal.id_dokter) LEFT OUTER JOIN t_poli ON(t_poli.id_poli = t_dokter.id_poli) WHERE t_daftar.no_reg='$id' AND t_daftar.visible='1'");

        return $query->row();
    }
}
?>