<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Dashboard extends CI_Controller {

	public function excelToDate($value){
		if ($value != null) {
			if (@date('Y', strtotime($value)) == 1970) {
				$date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($value);
				return date('Y-m-d', $date);
			}else{
				return date('Y-m-d', strtotime($value));
			}
		}else{
			return null;
		}
	}

	public function generateID($length)
    {
	    $randomSalt = md5(uniqid(random_int(PHP_INT_MIN, PHP_INT_MAX), true));
	    $salt = substr($randomSalt, 0, $length);

	    return $salt;
        
    }

	public function index(){
		$data['data_main'] = $this->db->query('SELECT * FROM broker_sum ORDER BY BS_DATE ASC');
		$this->load->view('template/header');
		$this->load->view('cms/main', $data);
		$this->load->view('template/footer');
	}

	public function importData(){

		$config['upload_path']		  = './assets/uploads_temp/';
		$config['allowed_types']		= 'xlsx';
		$config['overwrite']			= true;
		$config['encrypt_name']		 = true;
		$config['remove_spaces']		= true;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('fileImport')) {
			echo "PASTIKAN BISA TULIS FILE !";
			return;
		}else{
			$data = $this->upload->data();
			$data_file_name = $data['file_name'];
		}

		$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		$reader->setReadDataOnly(true);
		$loadExcel = $reader->load('./assets/uploads_temp/' . $data_file_name);

		//delete_excel_temp
		unlink('./assets/uploads_temp/' . $data_file_name);

		$sheet = $loadExcel->getActiveSheet()->toArray(null, true, true, true);
		//Hapus data array yang buat header
		unset($sheet[1]);

		$this->db->trans_start();
		$this->db->query('TRUNCATE TABLE broker_sum');

		foreach ($sheet as $sheetData) {

			$data = array(
				'BS_DATE' => $this->excelToDate($sheetData['A']),
				'BROKER' => $sheetData['B'],
				'SAHAM' => $sheetData['C'],
				'B_VAL' => $sheetData['D'],
				'B_LOT' => $sheetData['E'],
				'B_FREQ' => $sheetData['F'],
				'B_AVG' => $sheetData['G'],
				'S_VAL' => $sheetData['H'],
				'S_LOT' => $sheetData['I'],
				'S_FREQ' => $sheetData['J'],
				'S_AVG' => $sheetData['K']
			);

			$this->db->insert('broker_sum', $data);
		}

		//var_dump($this->db->trans_status());
		//$this->output->enable_profiler(true);
		// return;

		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$this->session->set_userdata('custom_error', 'Import data gagal');
			redirect($_SERVER['HTTP_REFERER']);
		}
		else{
			$this->db->trans_commit();
			$this->session->set_userdata('custom_success', 'Import data berhasil');
			redirect($_SERVER['HTTP_REFERER']);
		}

	}

	public function downloadData(){
		$data['data_main'] = $this->db->query('SELECT * FROM broker_sum ORDER BY BS_DATE ASC');

		$phpExcel = new Spreadsheet();
		$sheet = $phpExcel->getActiveSheet();

		$sheet->setCellValue('A1', 'BS_DATE');
		$sheet->setCellValue('B1', 'BROKER');
		$sheet->setCellValue('C1', 'SAHAM');
		$sheet->setCellValue('D1', 'B_VAL');
		$sheet->setCellValue('E1', 'B_LOT');
		$sheet->setCellValue('F1', 'B_FREQ');
		$sheet->setCellValue('G1', 'B_AVG');
		$sheet->setCellValue('H1', 'S_VAL');
		$sheet->setCellValue('I1', 'S_LOT');
		$sheet->setCellValue('J1', 'S_FREQ');
		$sheet->setCellValue('K1', 'S_AVG');

		foreach ($variable as $key => $value) {
			// code...
		}

		$random_name = $this->generateID(10);
		$date = date('Y-m-d H:i:s');
		$data_excel['file_name'] = "file_saham_$date.xlsx";

		try {
			$writer = new Xlsx($phpExcel);
			$file_address = './assets/uploads_temp/'.$random_name; 
			$writer->save($file_address);
			$data_excel['content'] = file_get_contents($file_address);
			$data_excel['success'] = true;

		} catch(Exception $e) {
			echo $e->getMessage();
			$data_excel['success'] = false;
		}
		unlink($file_address);

		if ($data_excel['success'] == true) {
			$this->load->helper('download');
			force_download($data_excel['file_name'], $data_excel['content']);
		}else{
			echo "Tidak bisa simpan file, silahkan cek perijinan";
		}

	}
}
