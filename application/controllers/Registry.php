<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registry extends CI_Controller {
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

	public function index()
	{
		$this->load->library('table'); // gestione tabelle di codeigniter
		$this->load->library('tabletemplates');  //libreria per la gestione aspetto delle tabelle
		$this->load->model('Registry_model');

		// titolo della pagina
		$titolo = 'Anagrafica di base';
		$head_data = array(
			'titolo' => $titolo
		);
		$this->load->view('header', $head_data);
		$this->load->view('welcome');
		$this->load->view('footer');
	}

	public function basicregistry()
	{
		$userrole = $this->userrole;
		$maincen = $this->maincen;
		$cen = $this->cen;
		
		if($userrole == 'admin' || $userrole == 'wah' || $userrole == 'wahrep'){
			//load libraries helpers e models
			$this->load->library('table'); // gestione tabelle di codeigniter
			$this->load->library('tabletemplates');  //libreria per la gestione aspetto delle tabelle
			//$this->load->helper('utility');
			$this->load->model('Registry_model');

			// dati tabella di riferimento
			if(isset($_GET['regtab'])){
				$regtab = $_GET['regtab'];
			} else{
				$regtab = 'products';
			}
			
			// pesco da file tablearray
			$path = 'json/br_tablearray.php';

			$alltablearray = url_get_contents($path);
			$tablearray = $alltablearray[$regtab];
			$datatoview = array(
				'regtab' => $regtab,
				'tablearray' => $tablearray
			);
			// end dati tabella

			// titolo della pagina
			$titolo = 'Anagrafica di base';
			$head_data = array(
				'titolo' => $titolo
			);

			
			//load delle view
			$this->load->view('header', $head_data);
			$this->load->view('registry', $datatoview);
			$this->load->view('footer');
		} else{
			redirect('Myerrors/myerror_404');
		}
	}
	public function basicregistry_addnew()
	{
		$userrole = $this->userrole;
		$maincen = $this->maincen;
		$cen = $this->cen;

		if($userrole == 'admin' || $userrole == 'wah' || $userrole == 'wahrep'){
			$this->load->helper('form');
			$this->load->model('Registry_model');

			// dati relativi alla tabella di riferimento
			if(isset($_GET['regtab'])){
				$regtab = $_GET['regtab'];
			} else{
				$regtab = 'products';
			}

			// pesco da file formfields
			$path = 'json/br_formfields.php';

			$alltablearray = url_get_contents($path);
			$tablearray = $alltablearray[$regtab]['addnew'];
			$datatoview = array(
				'regtab' => $regtab,
				'tablearray' => $tablearray,
				'siteurl' => 'Registry/basicregistry_submit'
			);
			// end dati tabella

			
			// titolo della pagina
			$titolo = 'Aggiungi nuovo';
			$head_data = array(
				'titolo' => $titolo
			);
			$this->load->view('header', $head_data);
			//$this->load->view('404');
			$this->load->view('basregaddnew', $datatoview);
			$this->load->view('footer');
		} else{
			redirect('Myerrors/myerror_404');
		}
	}
	public function basicregistry_submit()
	{	
		$this->load->model('Registry_model');

		// process data
		//post
		$data = $_POST;
		//iprint_r($data);
		

		// pesco da file formfields
		$path = 'json/br_formfields.php';
		$alltablearray = url_get_contents($path);
		$regtab = $data['table'];
		$tablearray = $alltablearray[$regtab]['addnew'];

		$datatoview = array(
			'regtab' => $regtab,
			'mode' => 'addnew'
		);

		$this->Registry_model->registry_submit($data, $tablearray, $regtab);

		//iprint_r($data);
		// titolo della pagina
		$titolo = 'Salvataggio';
		$head_data = array(
			'titolo' => $titolo
		);
		$this->load->view('header', $head_data);
		//$this->load->view('404');
		$this->load->view('basregsubmit', $datatoview);
		$this->load->view('footer');
	}
	public function basicregistry_edit()
	{
		$userrole = $this->userrole;
		$maincen = $this->maincen;
		$cen = $this->cen;

		if($userrole == 'admin' || $userrole == 'wah' || $userrole == 'wahrep'){
			$this->load->helper('form');
			$this->load->model('Registry_model');

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

			// pesco da file formfields
			$path = 'json/br_formfields.php';

			$alltablearray = url_get_contents($path);
			$tablearray = $alltablearray[$regtab]['edit'];
			$idfield = $tablearray['id'];
			$formfields = $tablearray['formfields'];
			

			$wherearray = array(
				$idfield => $ref
			);
			// prendo i valori da db
			$formfields = $this->Registry_model->registry_editview($formfields, $regtab, $wherearray, $tablearray);
			$tablearray['formfields'] = $formfields;

			//Aggiungo hiddenfield pro_id
			$tablearray['hiddenfields'][$idfield] = $ref;

			// dati x view
			$datatoview = array(
				'regtab' => $regtab,
				'tablearray' => $tablearray,
				'siteurl' => 'Registry/basicregistry_update',
				'ref' => $ref,
				'mode' => 'user-edit',
			);
			// end dati 

			// titolo della pagina
			$titolo = 'Modifica';
			$head_data = array(
				'titolo' => $titolo
			);

			$this->load->view('header', $head_data);
			$this->load->view('basregaddnew', $datatoview);
			$this->load->view('footer');
		} else{
			redirect('Myerrors/myerror_404');
		}
	}
	public function basicregistry_update(){
		$this->load->model('Registry_model');

		// process data
		//post
		$data = $_POST;
		
		// pesco da file formfields
		$path = 'json/br_formfields.php';
		$alltablearray = url_get_contents($path);
		$regtab = $data['table'];
		$tablearray = $alltablearray[$regtab]['edit'];

		$datatoview = array(
			'regtab' => $regtab,
			'mode' => 'edit'
		);

		$this->Registry_model->registry_update($data, $tablearray, $regtab);

		//iprint_r($data);
		// titolo della pagina
		$titolo = 'Salvataggio';
		$head_data = array(
			'titolo' => $titolo
		);
		//echo $datatoview['mode'];
		$this->load->view('header', $head_data);
		//$this->load->view('404');
		$this->load->view('basregsubmit', $datatoview);
		$this->load->view('footer');

	}
	public function basicregistry_confirmdisable(){
		$userrole = $this->userrole;
		$maincen = $this->maincen;
		$cen = $this->cen;

		if($userrole == 'admin' || $userrole == 'wah' || $userrole == 'wahrep'){
			$this->load->model('Registry_model');

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
			$this->load->view('basregconfirmdisable', $datatoview);
			$this->load->view('footer');
		} else{
			redirect('Myerrors/myerror_404');
		}

	}
	public function basicregistry_disable(){
		$userrole = $this->userrole;
		$maincen = $this->maincen;
		$cen = $this->cen;

		if($userrole == 'admin' || $userrole == 'wah' || $userrole == 'wahrep'){
			$this->load->model('Registry_model');

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

			

			$path = 'json/br_tablearray.php';
			$alltablearray = url_get_contents($path);
			$disablefield = $alltablearray[$regtab]['disablefield'];
			$wherearray = array(
				$alltablearray[$regtab]['id'] => $ref
			);

			$this->Registry_model->registry_disable($regtab, $wherearray, $disablefield);

			// titolo della pagina
			$titolo = 'Modifica';
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
			$this->load->view('basregdisable', $datatoview);
			$this->load->view('footer');
		} else{
			redirect('Myerrors/myerror_404');
		}
	}
}