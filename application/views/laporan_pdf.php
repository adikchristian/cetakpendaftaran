<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Pendaftaran</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <style>
        body{
            margin: 0px;
            padding: 0px;
        }
        #contaniner {
            width: auto;
            margin: 0px;
            padding: 0px;
        }

        #header {
            width: auto;
            margin: 0px;
            padding: 0 0 20px 0;
            border-bottom: 1px solid #ebecec;
        }

        #header-kiri {
            width: 300px;
            margin: 0px;
            padding: 0px;
            float: left;
        }

        #header-kanan {
            width: 300px;
            margin: 0px;
            padding: 0px;
            float: right;
            text-align: right;
        }

        #header-kanan img{
            margin-bottom: 10px;
        }

        .content{
            width: auto;
            margin: 10px 0 20px 0;
            padding: 0 0 30px 0;
            border-bottom: 1px solid #ebecec;
        }

        .clear {
            clear: both;
        }

        .table{
            width: 100%;
            margin:0px;
            padding: 0px;
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <div id="container">
        <div id="header">
            <div id="header-kiri">
                <h3 class="invoice-title">
                    Bukti Pendaftaran
                </h3>
            </div>
            <div id="header-kanan" style="background:#cfd0d1; padding:5px;">
                <img src="<?php echo base_url(); ?>assets/img/logo-baru.png" alt="company logo" style="margin-bottom: 10px;" height="40px">
                <br />
                Jl Kecak No. 9A Gatot Subroto Timur, Denpasar, Bali<br />
                80239
            </div>
            <div class="clear"></div>
        </div>
        <div class="content">
            <table class="table" width="100%" border-collapse="collapse" cellpadding="5" style="margin-bottom: 20px;">
                <tr>
                    <td colspan="3"><b>Detail Pasien</b></td>
                </tr>
                <tr>
                    <td width="130px">No Rm</td>
                    <td width="30px">:</td>
                    <td><?php echo $dt_daftar->no_rm; ?></td>
                </tr>
                <tr>
                    <td>No JKN</td>
                    <td>:</td>
                    <td><?php echo $dt_daftar->no_jkn; ?></td>
                </tr>
                <tr>
                    <td>Nama Pasien</td>
                    <td>:</td>
                    <td><?php echo $dt_daftar->nama_pasien; ?></td>
                </tr>
                <tr>
                    <td>Tgl Lahir</td>
                    <td>:</td>
                    <td><?php echo tglIndo($dt_daftar->tgl_lahir); ?></td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>:</td>
                    <td><?php echo jenKel($dt_daftar->jk); ?></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td><?php echo $dt_daftar->alamat; ?></td>
                </tr>
                <tr>
                    <td>Telp / Hp</td>
                    <td>:</td>
                    <td><?php echo $dt_daftar->telp; ?></td>
                </tr>
                <tr>
                    <td>Umur</td>
                    <td>:</td>
                    <td><?php echo $dt_daftar->umur.' Tahun'; ?></td>
                </tr>
            </table>
            <table class="table" width="100%" border-collapse="collapse" cellpadding="5">
                <tr>
                    <td colspan="3"><b>Detail Kunjungan</b></td>
                </tr>
                <tr>
                    <td width="130px">No Registrasi</td>
                    <td width="30px">:</td>
                    <td><?php echo $dt_daftar->no_reg; ?></td>
                </tr>
                <tr>
                    <td>Poliklinik</td>
                    <td>:</td>
                    <td><?php echo $dt_daftar->name_poli; ?></td>
                </tr>
                <tr>
                    <td>Dokter</td>
                    <td>:</td>
                    <td><?php echo $dt_daftar->dokter_name; ?></td>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td><?php echo TglIndo($dt_daftar->tgl_kontrol); ?></td>
                </tr>
                <tr>
                    <td>Jadwal</td>
                    <td>:</td>
                    <td><?php echo $dt_daftar->hari; ?>, <?php echo $dt_daftar->jam; ?></td>
                </tr>
                <tr>
                    <td>Keluhan</td>
                    <td>:</td>
                    <td><?php echo $dt_daftar->keluhan; ?></td>
                </tr>
            </table>
        </div>
        <b>Notes</b><br /> Pastikan anda datang 30 menit sebelum jadwal yang telah ditetukan 
    </div>
</body>

</html>