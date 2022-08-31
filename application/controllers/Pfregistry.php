<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pfregistry extends CI_Controller {
	public function __construct(){
        parent::__construct();
    }

	public function pfregistry_view()
	{
		//load libraries helpers e models
		$this->load->library('table'); // gestione tabelle di codeigniter
		$this->load->library('tabletemplates');  //libreria per la gestione aspetto delle tabelle
		//$this->load->helper('utility');
		$this->load->model('Pfregistry_model');

		
		$regtab = 'pf_view';
		$table = 'productssuppliers';
		
		// pesco da file tablearray
		$path = 'json/pfr_tablearray.php';

		$alltablearray = url_get_contents($path);
		//iprint_r($alltablearray);
		$tablearray = $alltablearray[$regtab];
		$datatoview = array(
			'regtab' => $regtab,
			'tablearray' => $tablearray,
			'table' => $table
		);
		// end dati tabella

		// titolo della pagina
		$titolo = 'Prodotti - Fornitori';
		$head_data = array(
			'titolo' => $titolo
		);

		//load delle view
		$this->load->view('header', $head_data);
		$this->load->view('pfregistry', $datatoview);
		$this->load->view('footer');
	}
	public function pfregistry_addnew()
	{
		$this->load->helper('form');
		$this->load->model('Pfregistry_model');

		// dati relativi alla tabella di riferimento
		$regtab = 'productssuppliers';

		// pesco da file formfields
		$path = 'json/pfr_formfields.php';

		$alltablearray = url_get_contents($path);
		$tablearray = $alltablearray[$regtab]['addnew'];
		$datatoview = array(
			'regtab' => $regtab,
			'tablearray' => $tablearray,
			'siteurl' => 'Pfregistry/pfregistry_submit'
		);
		// end dati tabella

		// titolo della pagina
		$titolo = 'Aggiungi nuovo';
		$head_data = array(
			'titolo' => $titolo
		);
		$this->load->view('header', $head_data);
		//$this->load->view('404');
		$this->load->view('pfregaddnew', $datatoview);
		$this->load->view('footer');
	}
	public function pfregistry_submit()
	{	
		$this->load->model('Pfregistry_model');

		// process data
		//post
		$data = $_POST;
		

		// pesco da file formfields
		$path = 'json/pfr_formfields.php';
		$alltablearray = url_get_contents($path);
		$regtab = $data['table'];
		$tablearray = $alltablearray[$regtab]['submit'];

		$datatoview = array(
			'regtab' => $regtab,
			'mode' => 'addnew'
		);

		$this->Pfregistry_model->registry_submit($data, $tablearray);

		//iprint_r($data);
		// titolo della pagina
		$titolo = 'Salvataggio';
		$head_data = array(
			'titolo' => $titolo
		);
		$this->load->view('header', $head_data);
		//$this->load->view('404');
		$this->load->view('pfregsubmit', $datatoview);
		$this->load->view('footer');
	}
	public function pfregistry_edit()
	{
		$this->load->helper('form');
		$this->load->model('Pfregistry_model');

		// dati relativi alla tabella di riferimento
		if(isset($_GET['regtab'])){
			$regtab = $_GET['regtab'];
		} else{
			$regtab = 'productssuppliers';
		}
		// dati relativi al singolo articolo
		if(isset($_GET['ref'])){
			$ref = $_GET['ref'];
		} 

		// pesco da file formfields
		$path = 'json/pfr_formfields.php';

		$alltablearray = url_get_contents($path);
		$tablearray = $alltablearray[$regtab]['edit'];
		$idfield = $tablearray['id'];
		//$formfields = $tablearray['formfields'];
		$wherearray = array(
			$idfield => $ref
		);
		
		// prendo i valori da db
		$tableview = 'pf_view';
		$tablearray = $this->Pfregistry_model->registry_editview($tablearray, $regtab, $wherearray, $tableview);
		//$tablearray['formfields'] = $formfields;

		//Aggiungo hiddenfield pro_id
		$tablearray['hiddenfields'][$idfield] = $ref;

		$datatoview = array(
			'regtab' => $regtab,
			'tablearray' => $tablearray,
			'siteurl' => 'Pfregistry/pfregistry_update'
		);
		// end dati tabella

		// titolo della pagina
		$titolo = 'Modifica';
		$head_data = array(
			'titolo' => $titolo
		);
		$this->load->view('header', $head_data);
		//$this->load->view('404');
		$this->load->view('pfregaddnew', $datatoview);
		$this->load->view('footer');
	}
	public function pfregistry_update(){
		$this->load->model('Pfregistry_model');

		// process data
		//post
		$data = $_POST;
		
		// pesco da file formfields
		$path = 'json/pfr_formfields.php';
		$alltablearray = url_get_contents($path);
		$regtab = $data['table'];
		$tablearray = $alltablearray[$regtab]['submitedit'];

		$datatoview = array(
			'regtab' => $regtab,
			'mode' => 'edit'
		);

		$this->Pfregistry_model->registry_update($data, $tablearray);

		//iprint_r($data);
		// titolo della pagina
		$titolo = 'Salvataggio';
		$head_data = array(
			'titolo' => $titolo
		);
		//echo $datatoview['mode'];
		$this->load->view('header', $head_data);
		//$this->load->view('404');
		$this->load->view('pfregsubmit', $datatoview);
		$this->load->view('footer');

	}
	public function pfregistry_confirmdisable(){
		$this->load->model('Pfregistry_model');

		// dati relativi alla tabella di riferimento
		if(isset($_GET['regtab'])){
			$regtab = $_GET['regtab'];
		} else{
			$regtab = 'products';
		}
		// dati relativi al singolo articolo
		if(isset($_GET['ref'])){
			$ref = $_GET['ref'];
		} 

		// titolo della pagina
		$titolo = 'Eliminazione';
		$head_data = array(
			'titolo' => $titolo
		);

		// dati alla view 
		$datatoview = array(
			'regtab' => $regtab,
			'ref' => $ref,
		);

		$this->load->view('header', $head_data);
		//$this->load->view('404');
		$this->load->view('pfregconfirmdisable', $datatoview);
		$this->load->view('footer');
	}
	public function pfregistry_disable(){
		$this->load->model('Pfregistry_model');

		// dati relativi alla tabella di riferimento
		if(isset($_GET['regtab'])){
			$regtab = $_GET['regtab'];
		} else{
			$regtab = 'productssuppliers';
		}
		// dati relativi al singolo articolo
		if(isset($_GET['ref'])){
			$ref = $_GET['ref'];
		} 

		

		$path = 'json/pfr_formfields.php';
		$alltablearray = url_get_contents($path);
		$disablefield = $alltablearray[$regtab]['disable']['disablefield'];
		$wherearray = array(
			$alltablearray[$regtab]['disable']['id'] => $ref
		);

		$this->Pfregistry_model->registry_disable($regtab, $wherearray, $disablefield);

		// titolo della pagina
		$titolo = 'Modifica';
		$head_data = array(
			'titolo' => $titolo
		);

		// dati alla view 
		$datatoview = array(
			'ref' => $ref,
		);

		$this->load->view('header', $head_data);
		//$this->load->view('404');
		$this->load->view('pfregdisable', $datatoview);
		$this->load->view('footer');
	}
}