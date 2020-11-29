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
            <div id="header-kanan">
                <img src="<?php echo base_url(); ?>/assets/img/logo.png" alt="company logo" style="margin-bottom: 10px; width:80px; height:80px;">
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
                    <td><?php echo tglIndo($dt_bon->tgl_kembali);; ?></td>
                </tr>
                <tr>
                    <td>Nama Peminjaman</td>
                    <td>:</td>
                    <td><?php echo $dt_bon->nama_peminjam; ?></td>
                </tr>
                <tr>
                    <td>Keterangan</td>
                    <td>:</td>
                    <td><?php //echo $dt_bon->alamat; ?></td>
                </tr>
            </table>
        </div>
        <b>Notes</b><br /> We really appreciate your business and if there's anything else we can do, please let us know! Also, should you need us to add VAT or anything else to this order, it's super easy since this is a template, so just ask!
    </div>
    <!--<h3 class="invoice-title">
                Bukti Pendaftaran Online
            </h3>
            <div class="invoice-logo">
                <img src="<?php echo base_url(); ?>/assets/img/examples/logoinvoice.svg" alt="company logo">
            </div>
        </div>
        <div class="invoice-desc">
            Bandung, West Java, Indonesia<br />
            Fax 621113
        </div>
    </div>
    <div class="card-body">
        <div class="separator-solid"></div>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-sm-12 col-md-7 mb-3 mb-md-0 transfer-to">
                <h5 class="sub">Detail Pasien</h5>
                <div class="account-transfer text-left">
                    <div><span>No Rm:</span><span class=""><?php echo $dt_bon->no_rm; ?></span></div>
                    <div><span>Nama Pasien:</span><span class="text-left"><?php echo $dt_bon->nama_pasien; ?></span></div>
                    <div><span>Tgl Lahir:</span><span><?php echo tglIndo($dt_bon->tgl_lahir); ?></span></div>
                    <div><span>No Jkn:</span><span><?php echo $dt_bon->no_jkn; ?></span></div>
                    <div><span>Jenis Kelamin:</span><span><?php echo jenKel($dt_bon->jk); ?></span></div>
                    <div><span>Alamat:</span><span><?php echo $dt_bon->alamat; ?></span></div>
                    <div><span>Telp / HP:</span><span><?php echo $dt_bon->telp; ?></span></div>
                    <div><span>Umur:</span><span><?php echo $dt_bon->umur . ' Tahun'; ?></span></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-7 mt-5 mb-md-0 transfer-to">
                <h5 class="sub">Detail Kunjungan</h5>
                <div class="account-transfer text-left">
                    <div><span>No Registrasi:</span><span class=""><?php echo $dt_bon->no_reg; ?></span></div>

                    <div><span>Poli/Pelayanan:</span><span class=""><?php echo $dt_bon->name_poli; ?></span></div>
                    <div><span>Dokter:</span><span class="text-left"><?php echo $dt_bon->dokter_name; ?></span></div>
                    <div><span>Tanggal:</span><span><?php echo tglIndo($dt_bon->tgl_kontrol); ?></span></div>
                    <div><span>Jadwal:</span><span><?php echo $dt_bon->hari; ?>, <?php echo $dt_bon->jam; ?></span></div>
                </div>
            </div>
        </div>
        <div class="separator-solid"></div>
        <h6 class="text-uppercase mt-4 mb-3 fw-bold">
            Notes
        </h6>
        <p class="text-muted mb-0">
            We really appreciate your business and if there's anything else we can do, please let us know! Also, should you need us to add VAT or anything else to this order, it's super easy since this is a template, so just ask!
        </p>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>-->
</body>

</html>