<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Instock extends CI_Controller {
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

	
	public function instock_view()
	{
		$userrole = $this->userrole;
		$maincen = $this->maincen;
		$cen = $this->cen;
		
		if($userrole == 'admin' || $userrole == 'wah'){
			
			//load libraries helpers e models
			$this->load->helper('form');
			$this->load->library('table'); // gestione tabelle di codeigniter
			$this->load->library('tabletemplates');  //libreria per la gestione aspetto delle tabelle
			//$this->load->helper('utility');
			$this->load->model('Instock_model');
			if($maincen !=='choose'){
				$wah = $maincen;
			} else{
				$wah = array(
					'id' => $maincen,
				);
			}
			
			
			$regtab = 'instock_view';
			$table = 'productssuppliers';
			
			// pesco da file tablearray
			$path = 'json/is_tablearray.php';

			$alltablearray = url_get_contents($path);
			//iprint_r($alltablearray);
			$tablearray = $alltablearray[$regtab];
			//dati view
			$datatoview = array(
				'regtab' => $regtab,
				'tablearray' => $tablearray,
				'table' => $table,
				'wah' => $wah,
				'cen' => $cen,
				'userrole' => $userrole,
			);
			// end dati tabella

			// titolo della pagina
			$titolo = 'Operazioni interne';
			$head_data = array(
				'titolo' => $titolo
			);

			if(!isset($_POST['warehouse'])){
				//load delle view
				$this->load->view('header', $head_data);
				$this->load->view('instock', $datatoview);
				$this->load->view('footer');
			} else{
				$wahid = $_POST['warehouse'];
				$class = 'instock-table orderable';
				$idtable = 'instock';
				$wahcenlist = $this->Instock_model->instock_wahcenlist();
				$wahname = $wahcenlist[$wahid];
				
				$metatemplate = $this->tabletemplates->temparchive($class, $idtable); // aspetto tabella
				$wah = array(
					'id' => $wahid,
					'name' => $wahname,
				);
				$this->Instock_model->instocktable_view($metatemplate, $regtab, $tablearray, $table, $wah);
			}
			
		} else{
			redirect('Myerrors/myerror_404');
		}
	}
	public function instock_suppliers(){
		$userrole = $this->userrole;
		
		if($userrole == 'admin' || $userrole == 'wah'){
			
			$this->load->helper('form');
			$this->load->model('Instock_model');

			$path = 'json/is_formfields.php';

			$alltablearray = url_get_contents($path);
			$tablearray = $alltablearray['instock']['suppliers'];

			$suplist = $this->Instock_model->instock_suppliers($tablearray);
			
			$suplist['choose'] = 'Scegli fornitore';
			$keytop = 'choose';
			move_to_top($suplist, $keytop);

			if($userrole == 'admin'){
				//echo 'ciao';
				$wahcenlist = $this->Instock_model->instock_wahcenlist();
				//iprint_r($wahcenlist);
				
				$datatoview = array(
					'tablearray' => $tablearray,
					'suplist' => $suplist,
					'siteurl' => 'Instock/instock_batchcarico',
					'wahcenlist' => $wahcenlist,
				);
			} else{
				$datatoview = array(
					'tablearray' => $tablearray,
					'suplist' => $suplist,
					'siteurl' => 'Instock/instock_batchcarico',
				);
			}
			
			
			// titolo della pagina
			$titolo = 'Operazioni interne';
			$head_data = array(
				'titolo' => $titolo
			);

			//load delle view
			$this->load->view('header', $head_data);
			$this->load->view('instocksuppliers', $datatoview);
			$this->load->view('footer');
		} else{
			redirect('Myerrors/myerror_404');
		}

	}
	// momentaneamente disabilitato per mettere carico in batch
	public function instock_addnew() 
	{
		$userrole = $this->userrole;
		$maincen = $this->maincen;
		$cen = $this->cen;
		
		if($userrole == 'admin' || $userrole == 'wah'){
			$this->load->helper('form');
			$this->load->model('Instock_model');

			// dati relativi alla tabella di riferimento
			$regtab = 'instock';

			// pesco da file formfields
			$path = 'json/is_formfields.php';

			// array x magazzino che inserisce dati
			$wah = $maincen;

			$alltablearray = url_get_contents($path);
			$tablearray = $alltablearray[$regtab]['addnew'];
			$tablearray = $this->Instock_model->addnew_view($wah, $tablearray);
			//iprint_r($tablearray);
			$datatoview = array(
				'regtab' => $regtab,
				'tablearray' => $tablearray,
				'siteurl' => 'Instock/instock_submit',
				'wah' => $wah
			);
			// end dati tabella

			// titolo della pagina
			$titolo = 'Aggiungi nuovo';
			$head_data = array(
				'titolo' => $titolo
			);
			$this->load->view('header', $head_data);
			//$this->load->view('404');
			$this->load->view('instockaddnew', $datatoview);
			$this->load->view('footer');
		} else{
			redirect('Myerrors/myerror_404');
		}

	}
	
	public function instock_batchcarico()
	{
		$userrole = $this->userrole;
		$maincen = $this->maincen;
		$cen = $this->cen;
		
		if($userrole == 'admin' || $userrole == 'wah'){
			//load libraries helpers e models
			$this->load->library('table'); // gestione tabelle di codeigniter
			$this->load->library('tabletemplates');  //libreria per la gestione aspetto delle tabelle
			$this->load->helper('form');
			$this->load->model('Instock_model');

			//pesco dati in POST
			$data = $_POST;
			if($userrole == 'wah'){
				$wah = $maincen;
			} elseif($userrole == 'admin'){
				$wahcenlist = $wahcenlist = $this->Instock_model->instock_wahcenlist();
				$wahid = $_POST['wahcenlist'];
				$wah = array(
					'id' => $wahid,
					'name' => $wahcenlist[$wahid],
				);
			}
			
			
			
			//iprint_r($data);
			$supplier = $data['suppliers'];

			// dati relativi alla tabella di riferimento
			$regtab = 'instock_view';

			// pesco da file formfields
			$path = 'json/is_formfields.php';

			// array x magazzino che inserisce dati
			

			$alltablearray = url_get_contents($path);
			$tablearray = $alltablearray['instock']['batchcarico'];
			//iprint_r($tablearray);
			//$tablearray = $this->Instock_model->addnew_view($wah, $tablearray);
			$datatoview = array(
				'supplier' => $supplier,
				'tablearray' => $tablearray,
				'siteurl' => 'Instock/instock_batchsubmit',
				'wah' => $wah,
			);
			// end dati tabella

			// titolo della pagina
			$titolo = 'Carico';
			$head_data = array(
				'titolo' => $titolo
			);
			$this->load->view('header', $head_data);
			$this->load->view('instockbatchcarico', $datatoview);
			$this->load->view('footer');
		} else{
			redirect('Myerrors/myerror_404');
		}

	}
	public function instock_batchsubmit(){
		$userrole = $this->userrole;
		$maincen = $this->maincen;
		$cen = $this->cen;
		$this->load->model('Instock_model');
		// pesco da file tablearray
		//iprint_r($_POST);

		$path = 'json/is_formfields.php';

		$alltablearray = url_get_contents($path);
		$formfields = $alltablearray['instock']['batchsubmit']['formfields'];
		//iprint_r($_POST);
		$data = $_POST['alldataarray'];
		$wahid = $_POST['warehouseid'];
		if($maincen !=='choose'){
			$wah = $maincen;
		} else{
			$wah = array(
				'id' => $wahid
			);
		}
		$this->Instock_model->instock_batchsubmit($data, $wah, $formfields);		
	}
	public function instock_successsubmit(){
		$titolo = 'Salvataggio';
		$head_data = array(
			'titolo' => $titolo
		);
		$this->load->view('header', $head_data);
		//$this->load->view('404');
		$this->load->view('instockbatchsubmit');
		$this->load->view('footer');
	}
	public function instock_submit()
	{	
		$this->load->model('Instock_model');

		// process data
		//post
		$data = $_POST;		

		// pesco da file formfields
		$path = 'json/is_formfields.php';
		$alltablearray = url_get_contents($path);
		$regtab = $data['table'];
		$tablearray = $alltablearray[$regtab]['submit'];

		$datatoview = array(
			'regtab' => $regtab,
			'mode' => 'addnew'
		);

		$this->Instock_model->instock_submit($data, $tablearray);

		//iprint_r($data);
		// titolo della pagina
		$titolo = 'Salvataggio';
		$head_data = array(
			'titolo' => $titolo
		);
		$this->load->view('header', $head_data);
		//$this->load->view('404');
		$this->load->view('instocksubmit', $datatoview);
		$this->load->view('footer');
	}
	public function instock_edit()
	{
		$userrole = $this->userrole;
		
		if($userrole == 'admin' || $userrole == 'wah'){
			$this->load->helper('form');
			$this->load->model('Instock_model');

			// dati relativi alla tabella di riferimento
			if(isset($_GET['regtab'])){
				$regtab = $_GET['regtab'];
			} else{
				$regtab = 'instock';
			}
			// dati relativi al singolo articolo
			if(isset($_GET['ref'])){
				$ref = $_GET['ref'];
			} 

			// pesco da file formfields
			$path = 'json/is_formfields.php';

			$alltablearray = url_get_contents($path);
			$tablearray = $alltablearray[$regtab]['edit'];
			$idfield = $tablearray['id'];
			//$formfields = $tablearray['formfields'];
			$wherearray = array(
				$idfield => $ref
			);
			
			// prendo i valori da db
			$tableview = 'instock_view';
			$tablearray = $this->Instock_model->instock_editview($tablearray, $regtab, $wherearray, $tableview);
			//$tablearray['formfields'] = $formfields;

			//Aggiungo hiddenfield pro_id
			$tablearray['hiddenfields'][$idfield] = $ref;

			$datatoview = array(
				'regtab' => $regtab,
				'tablearray' => $tablearray,
				'siteurl' => 'Instock/instock_update'
			);
			// end dati tabella

			// titolo della pagina
			$titolo = 'Modifica';
			$head_data = array(
				'titolo' => $titolo
			);
			$this->load->view('header', $head_data);
			//$this->load->view('404');
			$this->load->view('instockaddnew', $datatoview);
			$this->load->view('footer');
		} else{
			redirect('Myerrors/myerror_404');
		}
	}
	public function instock_update(){
		$userrole = $this->userrole;
		
		if($userrole == 'admin' || $userrole == 'wah'){
			$this->load->model('Instock_model');

			// process data
			//post
			$data = $_POST;
			
			// pesco da file formfields
			$path = 'json/is_formfields.php';
			$alltablearray = url_get_contents($path);
			$regtab = $data['table'];
			$tablearray = $alltablearray[$regtab]['submitedit'];

			$datatoview = array(
				'regtab' => $regtab,
				'mode' => 'edit',
				
			);

			$this->Instock_model->instock_update($data, $tablearray);

			//iprint_r($data);
			// titolo della pagina
			$titolo = 'Salvataggio';
			$head_data = array(
				'titolo' => $titolo
			);
			
			$this->load->view('header', $head_data);
			//$this->load->view('404');
			$this->load->view('instocksubmit', $datatoview);
			$this->load->view('footer');
		} else{
			redirect('Myerrors/myerror_404');
		}

	}
	public function instock_plusminus(){
		$userrole = $this->userrole;
		
		if($userrole == 'admin' || $userrole == 'wah'){
			$this->load->helper('form');
			$this->load->model('Instock_model');

			$regtab = 'instock';
			$mode = $_GET['mode'];
			if($mode=='minus'){
				$titolo = 'Scarico';
			} else{
				$titolo = 'Carico';
			}

			// dati relativi al singolo articolo
			if(isset($_GET['ref'])){
				$ref = $_GET['ref'];
			} 

			// pesco da file formfields
			$path = 'json/is_formfields.php';

			$alltablearray = url_get_contents($path);
			$tablearray = $alltablearray[$regtab]['plusminus'][$mode];
			$idfield = $tablearray['id'];
			//$formfields = $tablearray['formfields'];
			$wherearray = array(
				$idfield => $ref
			);

			// titolo della pagina
			$head_data = array(
				'titolo' => $titolo
			);

			// prendo i valori da db
			$tableview = 'instock_view';
			$tablearray = $this->Instock_model->instock_editview($tablearray, $regtab, $wherearray, $tableview);

			// dati to view
			$datatoview = array(
				'regtab' => $regtab,
				'tablearray' => $tablearray,
				'mode' => $mode,
				'siteurl' => 'Instock/instock_updateq'
			);


			$this->load->view('header', $head_data);
			$this->load->view('instockplusminus', $datatoview);
			$this->load->view('footer');
		} else{
			redirect('Myerrors/myerror_404');
		}
	}
	public function instock_updateq(){
		$this->load->model('Instock_model');

		// process data
		//post
		$data = $_POST;
		
		// pesco da file formfields
		$path = 'json/is_formfields.php';
		$alltablearray = url_get_contents($path);
		$regtab = $data['table'];
		$tablearray = $alltablearray[$regtab]['submiteditq'];

		$datatoview = array(
			'regtab' => $regtab,
			'mode' => 'edit',
			
		);

		$this->Instock_model->instock_updateq($data, $tablearray);

		//iprint_r($data);
		// titolo della pagina
		$titolo = 'Salvataggio';
		$head_data = array(
			'titolo' => $titolo
		);
		
		$this->load->view('header', $head_data);
		//$this->load->view('404');
		$this->load->view('instocksubmit', $datatoview);
		$this->load->view('footer');

	}
}