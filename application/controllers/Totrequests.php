<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Totrequests extends CI_Controller {
	public function __construct(){
        parent::__construct();
    }

	public function totrequests_view()
	{
		//load libraries helpers e models
		$this->load->library('table'); // gestione tabelle di codeigniter
		$this->load->library('tabletemplates');  //libreria per la gestione aspetto delle tabelle
		//$this->load->helper('utility');
		$this->load->model('Totrequests_model');

        // array fittizio x magazzino che vede richieste in entrata
        

		$regtab = 'requests_view';
		
		// pesco da file tablearray
		$path = 'json/totreq_tablearray.php';

		$alltablearray = url_get_contents($path);
        //iprint_r($alltablearray);
        
		$tablearray = $alltablearray[$regtab];
		$datatoview = array(
			'regtab' => $regtab,
			'tablearray' => $tablearray,
		);
		// end dati tabella

		// titolo della pagina
		$titolo = 'Anagrafica richieste';
		$head_data = array(
			'titolo' => $titolo
		);

		//load delle view
		$this->load->view('header', $head_data);
		$this->load->view('totrequests', $datatoview);
		$this->load->view('footer');
	}
}