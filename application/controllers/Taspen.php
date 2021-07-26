<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Taspen extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('RdsTaspen');
		$this->load->helper('security');
		$this->load->helper('number');
		$this->load->library('session');
		$this->load->helper('html');
		//$this->load->helper("Terbilang");

		$this->load->library('form_validation'); // Load library form_validation untuk proses validasinya
	}

	public function index()
	{
		$data['list'] = $this->RdsTaspen->taspenlist();
		$data['bulan'] = $this->RdsTaspen->listdropdown();
		$this->load->view('rds/v_select', $data);
	}
	
	/* for edit params */
	public function lsparams()
	{
	    $data['listparams'] = $this->RdsTaspen->listparams();
	    $this->load->view('rds/v_edparams', $data);
	}
	public function edparams($id)
	{
	    $data['edparams'] = $this->RdsTaspen->modedparams($id);
	    $this->load->view('rds/v_formparams', $data);
	}
	
	public function edit_simpan($id)
    {
        if($this->input->post('submit')){
			//if($this->PasienModel->validation("update")){
				$this->RdsTaspen->doupdate($id);
			
				echo '<script>alert ("Edit Sukses");</script>';
		 		//$this->load->view('taspen/v_formparams');
				redirect(base_url('taspen/lsparams'), 'refresh');
			   // $this->session->set_flashdata('edit', true);

			//}
		}
		
		$this->load->view('rds/v_formparams');

    }
    
    /* end edit paramss form */

	
	public function lookup()
	{

		if ($this->input->GET('cari') == 'all' and $this->input->GET('year') == 'all') {
			$data['cari'] = $this->RdsTaspen->mlookupfilterall();
			// $this->load->view('rds/hasil', $data);
		} else {
			$data['cari'] = $this->RdsTaspen->mlookup();
			//$data['datapeserta'] = $this->RdsTaspen->getJumlahPeserta($data['ca']);
		}
		$this->load->view('rds/hasil', $data);
	}

	public function readpdf($id)
	{
		$data['upnonaspdf'] = $this->RdsTaspen->updatenonasporcetakpdf($id);
		$data['cari'] = $this->RdsTaspen->querywhere($id);
		$data['jml'] = $this->RdsTaspen->sumjmlpremi($id);
		$data['listparams'] = $this->RdsTaspen->listparams(); // add for params values

		$mpdf = new \Mpdf\Mpdf();
		$mpdf = new \Mpdf\Mpdf(['format' => 'A4']);
		$mpdf->SetTitle('My Title');
		$html = $this->load->view('rds/v_mpdf', $data, true);
		$mpdf->WriteHTML($html);
		$mpdf->Output($id, 'I');
		//$mpdf->Output(); // opens in browser without save otomatic
		//$mpdf->Output(FCPATH.'uploads/invoice-umum.pdf'); // save to server run with curl http://localhost/fu/tiket/pasien/mpdf/20210512123222_A002 
	}

	public function multiupdated()
	{
		if ($this->input->post('checkbox_value')) {
			$id = $this->input->post('checkbox_value');
			for ($count = 0; $count < count($id); $count++) {
				$this->RdsTaspen->multiupdated($id[$count]);
			}
		}
	}

	// start aspurjab
	public function aspurjab()
	{
		$data['list'] = $this->RdsTaspen->listaspurjab();
		$this->load->view('rds/vaspurjab', $data);
	}

	public function lookupaspurjab()
	{
		if ($this->input->GET('cari') == 'all' and $this->input->GET('year') == 'all') {
			$data['cari'] = $this->RdsTaspen->mlookupfilterallaspur();
			// $this->load->view('rds/hasil', $data);
		} else {
			$data['cari'] = $this->RdsTaspen->mlookupaspur();
			//$data['datapeserta'] = $this->RdsTaspen->getJumlahPeserta($data['ca']);
		}
		$this->load->view('rds/vhasilaspur', $data);
	}

	public function readpdfaspurjab($id, $id_child, $policyno, $bulan, $tahun, $id_division=NULL, $id_sub=NULL) {
		#$data['upaspdf'] = $this->RdsTaspen->updateasporcetakpdf($id);
		$data['upaspdf2'] = $this->RdsTaspen->updateasporcetakpdf2($id);
		//$data['cari'] = $this->RdsTaspen->querywhereas($id, $bulan, $tahun);
		$data['jml'] = $this->RdsTaspen->sumpremias($id, $id_child, $id_division, $id_sub, $policyno, $bulan, $tahun);
		// $data['premi'] = $this->RdsTaspen->premias($id, $bulan, $tahun);
		// $data['whereloop'] = $this->RdsTaspen->querywhereasloop($id, $bulan,$tahun);
		//$data['terbias'] = $this->RdsTaspen->terbilongaspur($id, $bulan, $tahun);
		$data['invoice'] = $this->RdsTaspen->get_aspurjab_invoice($id, $id_child, $policyno, $bulan, $tahun);
		$data['listparams'] = $this->RdsTaspen->listparams();

		if( is_null($id_division) or is_null($id_sub))
		{
			$data['individu'] = $this->RdsTaspen->get_individu_premi_pusat($id_child, $policyno, $bulan, $tahun);
		} else {
			$data['individu'] = $this->RdsTaspen->get_individu_premi_standard($id_division, $id_sub, $id_child, $policyno, $bulan, $tahun);
		}

		$mpdf = new \Mpdf\Mpdf();
		$mpdf = new \Mpdf\Mpdf(['format' => 'A4']);
		$mpdf->SetTitle('My Title');
		$html = $this->load->view('rds/vpdfaspurjab', $data, true);
		$mpdf->WriteHTML($html);
		$mpdf->Output($id . '-' . $bulan . '-' . $tahun, 'I');
		//$mpdf->Output(); // opens in browser without save otomatic
		//$mpdf->Output(FCPATH.'uploads/invoice-aspurjab.pdf','F'); // save to server run with curl http://localhost/fu/tiket/pasien/mpdf/20210512123222_A002 
	}
	public function multiupdatedaspur()
	{
		if ($this->input->post('checkbox_value')) {
			$id = $this->input->post('checkbox_value');
			for ($count = 0; $count < count($id); $count++) {
				$this->RdsTaspen->multiupdatedaspur($id[$count]);
				$this->RdsTaspen->multiupdatedaspur2($id[$count]);
			}
		}
	}
	//end aspurjab


	// export excel invoice standard
	public function excelstandard($id_division = null, $id_sub = null, $id_child, $policyno, $bulan, $tahun)
	{
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'No');
		$sheet->setCellValue('B1', 'Year');
		$sheet->setCellValue('C1', 'Month');
		$sheet->setCellValue('D1', 'Product Name');
		$sheet->setCellValue('E1', 'Division Name');
		$sheet->setCellValue('F1', 'SAP No');
		$sheet->setCellValue('G1', 'Status');
		$sheet->setCellValue('H1', 'Invoice No');
		$sheet->setCellValue('I1', 'Notas');
		$sheet->setCellValue('J1', 'NIP');
		$sheet->setCellValue('K1', 'NIK');
		$sheet->setCellValue('L1', 'Member Name');
		$sheet->setCellValue('M1', 'Mulai Asuransi');
		$sheet->setCellValue('N1', 'Akhir Asuransi');
		$sheet->setCellValue('O1', 'Golongan');
		$sheet->setCellValue('P1', 'GAPOK');
		$sheet->setCellValue('Q1', 'JML Istri');
		$sheet->setCellvalue('R1', 'JML Anak');
		$sheet->setCellValue('S1', 'Premi');
		$sheet->setCellValue('T1', 'Sum Insured');
		$sheet->setCellValue('U1', 'Rate');
		$sheet->setCellValue('V1', 'UPM/UPT');
		$sheet->setCellValue('W1', 'Term (Month)');
		$sheet->setCellValue('X1', 'Term (Year)');

		if (is_null($id_division) && is_null($id_sub)) {
			$data = $this->RdsTaspen->get_individu_premi_pusat($id_child, $policyno, $bulan, $tahun);
		} else {
			$data = $this->RdsTaspen->get_individu_premi_standard($id_division, $id_sub, $id_child, $policyno, $bulan, $tahun);
		}

		$r = 2;

		try {
			foreach ($data as $idx => $row) {
				$sheet->setCellValue('A' . $r, ++$idx);
				$sheet->setCellValue('B' . $r, $row->TAHUN);
				$sheet->setCellValue('C' . $r, $row->BULAN);
				$sheet->setCellValue('D' . $r, $row->PRODUCTNAME);
				$sheet->setCellValue('E' . $r, $row->NMDIVISION);
				if($row->STATUS == 0)
					$sheet->setCellValue('G' . $r, 'UNPAID');
				else
					$sheet->setCellValue('G' . $r, 'PAID');
				$sheet->setCellValue('F' . $r, $row->SAP_NO);	
				$sheet->setCellValue('H' . $r, $row->NOINVOICE);	
				$sheet->setCellValue('I' . $r, $row->NOTAS);
				$sheet->setCellValueExplicit('I' . $r, $row->NOTAS, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				$sheet->setCellValueExplicit('J' . $r, $row->NIP, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				$sheet->setCellValueExplicit('K' . $r, $row->IDCARDNUMBER, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
				$sheet->setCellValue('L' . $r, $row->NAMA_PESERTA);
				$sheet->setCellValue('M' . $r, $row->TMT_MEMBER);
				$sheet->setCellValue('N' . $r, $row->POLICYENDDATE);
				$sheet->setCellValue('O' . $r, $row->GOLONGAN);
				$sheet->setCellValue('P' . $r, $row->BASICSALARY);
				$sheet->setCellValue('Q' . $r, $row->PASANGAN);
				$sheet->setCellValue('R' . $r, $row->ANAK);
				$sheet->setCellValue('S' . $r, $row->TOTALPREMIUM);
				$sheet->setCellValue('T' . $r, $row->SUMASSURED);
				$sheet->setCellValue('U' . $r, $row->PREMIUMRATE);
				$sheet->setCellValue('V' . $r, $row->UPM);
				$sheet->setCellValue('W' . $r, $row->TERM_MONTH);
				$sheet->setCellValue('X' . $r, $row->TERM_YEAR);
				$r++;
			}
		} catch (\Throwable $th) {
		}

		$writer = new Xlsx($spreadsheet);
		$filename = 'LampiranInvoice' . '-' . $id_child . '-' . $policyno . '-' . $bulan . '-' . $tahun;

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}
}
