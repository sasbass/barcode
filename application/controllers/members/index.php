<?php
class Index extends MY_Controller {
	public function __construct(){
		parent::__construct();
	}

	public function index(){

		if($this->input->post('gen')){
			$from 				= $this->input->post('from');
			$to 				= $this->input->post('to');

			$len_from_numbers 	= strlen($from);
			$len_to_numbers 	= strlen($to);

			$from_zero 			= 0;
			$to_zero 			= 0;

			$add_zero_from 		= '';
			$add_zero_to 		= '';

			for($i=1;$i<=$len_from_numbers;$i++){
				$from_number = substr($from, -$len_from_numbers,$i);
				if($from_number == 0){
					$from_zero++;
					$add_zero_from .= 0;
				}
			}

			for($i=1;$i<=$len_to_numbers;$i++){
				$to_number = substr($to, -$len_to_numbers,$i);
				if($to_number == 0){
					$to_zero++;
					$add_zero_to .= 0;
				}
			}

			$start_number = substr($from, $from_zero-$len_from_numbers);
			$end_number = substr($to, $to_zero-$len_to_numbers);

			$array_barcodes = range($start_number, $end_number);

			foreach ($array_barcodes as $key => $value) {
				if($to == $value){
					$newArr[] = $add_zero_to . $value;
				} else {
					$newArr[] = $add_zero_from . $value;
				}

			}
			
			$this->data['barcodes'] = $this->barcode($newArr);
		}

		

		$this->data["interface"]["lang"];
		$this->load->view($this->data["view"],$this->data);
	}

	private function barcode($array_barcodes) {
		$files = array();
		foreach ($array_barcodes as $key => $value) {
			$path = 'public/img/barcode/';
			$file = $value . '_barcode.jpg';
			$files[] = $path . $file;
		    $this->load->library('zend');
		    $this->zend->load('Zend/Barcode');
		    $test = Zend_Barcode::draw('code128', 'image', array('text' => $value), array());
		    imagejpeg($test, $path . $file, 200);
		    unset($test);
		}
		return $files;
	}
}
