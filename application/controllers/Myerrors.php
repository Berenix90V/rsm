<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Myerrors extends CI_Controller {

	public function myerror_404()
	{
		$this->load->model('Registry_model');
		$titolo = 'Errore 404';
		$head_data = array(
			'titolo' => $titolo
		);
		$this->load->view('header', $head_data);
		$this->load->view('myerror_404');
		$this->load->view('footer');
    }
}
