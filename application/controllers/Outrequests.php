<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Outrequests extends CI_Controller {
	private $userrole = "";
	private $mainrep = "choose";
	private $maincen = "choose";
	private $rep = "";
	private $cen = "";
	
	public function __construct(){
		parent::__construct();
		
		$userrole = $_SESSION['userrole'];
		$this->userrole = $userrole;
		if(isset($_SESSION['permissions']['mainrep'])){
			$mainreparr = $_SESSION['permissions']['mainrep'];
			foreach($mainreparr as $key=>$value){
				$mainrep['id'] = $key;
				$mainrep['name'] = $value;
			}
			$this->mainrep = $mainrep;
		}
		if(isset($_SESSION['permissions']['maincen'])){
			$maincenarr = $_SESSION['permissions']['maincen'];
			foreach($maincenarr as $key=>$value){
				$maincen['id'] = $key;
				$maincen['name'] = $value;
			}
			$this->maincen = $maincen;
		}
		if(isset($_SESSION['permissions']['rep'])){
			$rep = $_SESSION['permissions']['rep'];
			$this->rep = $rep;
		}
		if(isset($_SESSION['permissions']['cen'])){
			$cen = $_SESSION['permissions']['cen'];
			$this->cen = $cen;
		}
		
    }

	public function outrequests_view()
	{
		$userrole = $this->userrole;
		$mainrep = $this->mainrep;
		$rep = $this->rep;

		if($userrole == 'admin' || $userrole == 'rep' || $userrole == 'wahrep'){
			//load libraries helpers e models
			$this->load->library('table'); // gestione tabelle di codeigniter
			$this->load->library('tabletemplates');  //libreria per la gestione aspetto delle tabelle
			//$this->load->helper('utility');
			$this->load->helper('form');
			$this->load->model('Outrequests_model');

			// array fittizio x magazzino che vede richieste in entrata
			
			/*if(isset($mainrep) && $mainrep !=='choose'){
				$wah = $mainrep;
			} else{
				$wah = array(
					'id' =>'choose'
				);
			}*/
			$wah = $mainrep;
			

			$regtab = 'requests_view';
			$table = 'requests';
			
			// pesco da file tablearray
			$path = 'json/outreq_tablearray.php';

			$alltablearray = url_get_contents($path);
			//iprint_r($alltablearray);
			
			$tablearray = $alltablearray[$regtab];
			$datatoview = array(
				'regtab' => $regtab,
				'tablearray' => $tablearray,
				'table' => $table,
				'wah' => $wah,
				'userrole' => $userrole,
				'rep' => $rep,
				'mainrep' => $mainrep,
			);
			// end dati tabella

			// titolo della pagina
			$titolo = 'Richieste in uscita';
			$head_data = array(
				'titolo' => $titolo
			);

			if(!isset($_POST['warehouse2'])){
				//load delle view
				$this->load->view('header', $head_data);
				$this->load->view('outrequests', $datatoview);
				$this->load->view('footer');
			} else{
				//iprint_r($_POST);
				$wahid = $_POST['warehouse2'];
				$class = 'outrequests-table';
				$idtable = 'outrequests';
				$wahreplist = $this->Outrequests_model->outrequests_wahreplist();
				$wahname = $wahreplist[$wahid];
				
				$metatemplate = $this->tabletemplates->temparchive($class, $idtable); // aspetto tabella
				$wah = array(
					'id' => $wahid,
					'name' => $wahname,
				);
				$this->Outrequests_model->outrequeststable_view($metatemplate, $regtab, $tablearray, $table, $wah, $userrole);
			}
		} else{
			redirect('Myerrors/myerror_404');
		}
	}
	public function outrequests_rconfirm()
	{
		$userrole = $this->userrole;
		$mainrep = $this->mainrep;
		$rep = $this->rep;

		if($userrole == 'admin' || $userrole == 'rep' || $userrole == 'wahrep'){
			$this->load->helper('form');
			$this->load->model('Outrequests_model');

			// array fittizio x magazzino che vede richieste in entrata
			/*$wah = array(
				'id' => '1',
				'name' => 'Blu',
			);*/

			// dati relativi alla tabella di riferimento
			$table = 'requests';

			$datatoview = array(
				'table' => $table,
				'ref' => $_GET['ref'],
			);
			// end dati tabella

			// titolo della pagina
			$titolo = 'Nuova richiesta';
			$head_data = array(
				'titolo' => $titolo
			);

			$this->load->view('header', $head_data);
			$this->load->view('outreqrconfirm', $datatoview);
			$this->load->view('footer');
		} else{
			redirect('Myerrors/myerror_404');
		}
	}
	public function outrequests_rconfsubmit()
	{	
		$this->load->model('Outrequests_model');
		$ref =  $_GET['ref'];

		// pesco da file formfields
		$path = 'json/outreq_formfields.php';
		$alltablearray = url_get_contents($path);
		//iprint_r($alltablearray);
		$regtab = 'requests';
		$tablearray = $alltablearray[$regtab]['rconfsubmit'];

		$datatoview = array(
			'regtab' => $regtab,
		);

		$this->Outrequests_model->outrequests_rconfsubmit($tablearray, $ref);

		//iprint_r($data);
		// titolo della pagina
		$titolo = 'Conferma richiesta';
		$head_data = array(
			'titolo' => $titolo,
			'tablearray' => $tablearray,
		);
		$this->load->view('header', $head_data);
		$this->load->view('outrconfsubmit', $datatoview);
		$this->load->view('footer');
	}
}