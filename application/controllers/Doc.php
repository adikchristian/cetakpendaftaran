<?php
defined('BASEPATH') or exit('No direct script access allowed');

//require('./application/third_party/phpoffice/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Doc extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Query');
	}

	public function view($id)
	{
		$data = [
			'dt_daftar' => $this->Query->getDetailPedaftaran($id)
		];

		$this->load->view('laporan_pdf', $data);
	}

	public function cetak($id)
	{
		$data = [
			'dt_daftar' => $this->Query->getDetailPedaftaran($id)
		];

		$mpdf = new \Mpdf\Mpdf();
		$filname = 'pendaftaran-' . $id . '.pdf';
		$html = $this->load->view('laporan_pdf', $data, true);
		$mpdf->WriteHTML($html);
		$mpdf->Output($filname, 'D'); // opens in browser
	}

	public function print($id)
	{
		$data = [
			'dt_daftar' => $this->Query->getDetailPedaftaran($id)
		];

		$this->load->view('laporan_pdf_print', $data); // opens in browser
	}

	public function cetakbon($id)
	{
		$data = [
			'dt_bon' => $this->Query->getAmbiAndKembali($id)
		];
		$this->load->view('laporan_bon_print', $data);
	}

	public function expPendaftaran($tgl1,$tgl2,$poli,$norm)
	{
		$sql = $this->Query->getLapPendaftaran($tgl1,$tgl2,$poli,$norm);

		$spreadsheet = new Spreadsheet;

        $spreadsheet->setActiveSheetIndex(0)
                      ->setCellValue('A1', 'No')
					  ->setCellValue('B1', 'No RM')
					  ->setCellValue('C1', 'No REG')
                      ->setCellValue('D1', 'Nama Pasien')
                      ->setCellValue('E1', 'Tanggal Kontrol')
					  ->setCellValue('F1', 'Polilinik')
					  ->setCellValue('G1', 'Jam')
					  ->setCellValue('H1', 'Dokter')
					  ->setCellValue('I1', 'Keluhan');

        $kolom = 2;
        $nomor = 1;
        foreach($sql as $row) {

            $spreadsheet->setActiveSheetIndex(0)
                           ->setCellValue('A' . $kolom, $nomor)
                           ->setCellValue('B' . $kolom, $row->no_rm)
                           ->setCellValue('C' . $kolom, $row->no_reg)
                           ->setCellValue('D' . $kolom, $row->nama_pasien)
						   ->setCellValue('E' . $kolom, $row->tgl_kontrol)
						   ->setCellValue('F' . $kolom, $row->name_poli)
						   ->setCellValue('G' . $kolom, $row->jam)
						   ->setCellValue('H' . $kolom, $row->dokter_name)
						   ->setCellValue('I' . $kolom, $row->keluhan);

            $kolom++;
            $nomor++;

        }

        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.ms-excel');
	  	header('Content-Disposition: attachment;filename="Laporan-Pendaftaran.xlsx"');
	    header('Cache-Control: max-age=0');

	    $writer->save('php://output');
	}

	public function expFeedback($tgl1,$tgl2,$poli,$norm)
	{
		$sql = $this->Query->getLapFeedback($tgl1,$tgl2,$poli,$norm);

		$spreadsheet = new Spreadsheet;

        $spreadsheet->setActiveSheetIndex(0)
                      ->setCellValue('A1', 'No')
					  ->setCellValue('B1', 'No RM')
					  ->setCellValue('C1', 'No REG')
                      ->setCellValue('D1', 'Nama Pasien')
                      ->setCellValue('E1', 'Tanggal')
					  ->setCellValue('F1', 'Polilinik')
					  ->setCellValue('H1', 'Dokter');

        $kolom = 2;
        $nomor = 1;
        foreach($sql as $row) {

            $spreadsheet->setActiveSheetIndex(0)
                           ->setCellValue('A' . $kolom, $nomor)
                           ->setCellValue('B' . $kolom, $row->no_rm)
                           ->setCellValue('C' . $kolom, $row->no_reg)
                           ->setCellValue('D' . $kolom, $row->nama_pasien)
						   ->setCellValue('E' . $kolom, $row->tgl_nilai)
						   ->setCellValue('F' . $kolom, $row->name_poli)
						   ->setCellValue('H' . $kolom, $row->dokter_name);

            $kolom++;
            $nomor++;

        }

        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.ms-excel');
	  	header('Content-Disposition: attachment;filename="Laporan-Feedback.xlsx"');
	    header('Cache-Control: max-age=0');

	    $writer->save('php://output');
	}
}
