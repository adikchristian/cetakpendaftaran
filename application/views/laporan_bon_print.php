<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Pendaftaran</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <style>
        body{
            margin: 0px;
            padding: 10px;
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
    <script>
        window.print();
    </script>
</head>

<body>
    <div id="container">
        <div id="header">
            <div id="header-kiri">
                <h3 class="invoice-title">
                    Bon Peminjaman<br>
                    Rekam Medis
                </h3>
            </div>
            <div id="header-kanan" style="background:#cfd0d1; padding:5px;">
                <img src="<?php echo base_url(); ?>assets/img/logo-baru.png" alt="company logo" style="margin-bottom: 10px;" height="40px">
                <br />
                Bandung, West Java, Indonesia<br />
                Fax 621113
            </div>
            <div class="clear"></div>
        </div>
        <div class="content">
            <table class="table" width="100%" border-collapse="collapse" cellpadding="5" style="margin-bottom: 20px;">
                <tr>
                    <td width="130px">No Rm</td>
                    <td width="30px">:</td>
                    <td><?php echo $dt_bon->no_rm; ?></td>
                </tr>
                <tr>
                    <td>Nama Pasien</td>
                    <td>:</td>
                    <td><?php echo $dt_bon->nama_pasien; ?></td>
                </tr>
                <tr>
                    <td>Tgl Peminjaman</td>
                    <td>:</td>
                    <td><?php echo tglIndo($dt_bon->tgl_proses); ?></td>
                </tr>
                <tr>
                    <td>Tgl Dikembalikan</td>
                    <td>:</td>
                    <td><?php echo getPengembalianByIdTgl($dt_bon->id_pengambilan); //echo tglIndo($dt_bon->tgl_kembali);; ?></td>
                </tr>
                <tr>
                    <td>Nama Peminjaman</td>
                    <td>:</td>
                    <td><?php echo $dt_bon->nama_peminjam; ?></td>
                </tr>
                <tr>
                    <td>Keterangan</td>
                    <td>:</td>
                    <td><?php echo $dt_bon->ket; ?></td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>