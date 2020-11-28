<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('query');
	}

	public function cetak($id)
	{
		$data = [
			'dt_daftar' => $this->allModel->getDetailPedaftaran($id)
		];
	
		$this->load->library('pdf');
	
		$this->pdf->setPaper('A4', 'potrait');
		$this->pdf->filename = "no-rekam-medis.pdf";
		$this->pdf->load_view('laporan_pdf', $data);
	}
}
