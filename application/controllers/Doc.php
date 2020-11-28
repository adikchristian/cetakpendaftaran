<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
		$filname = 'pendaftaran-' . $id.'.pdf';
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
}
