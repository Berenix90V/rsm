<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inrequests extends CI_Controller {
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

	public function inrequests_view()
	{
		$userrole = $this->userrole;
		$maincen = $this->maincen;
		$cen = $this->cen;
		
		if($userrole == 'admin' || $userrole == 'wah' || $userrole == 'wahrep'){
			//load libraries helpers e models
			$this->load->library('table'); // gestione tabelle di codeigniter
			$this->load->library('tabletemplates');  //libreria per la gestione aspetto delle tabelle
			$this->load->helper('form');
			//$this->load->helper('utility');
			$this->load->model('Inrequests_model');

			/*if(isset($maincen)){
				$wah = $maincen;
			} else{
				$wah = 'choose';
			}*/
			$wah = $maincen;

			$regtab = 'requests_view';
			$table = 'requests';
			
			// pesco da file tablearray
			$path = 'json/inreq_tablearray.php';

			$alltablearray = url_get_contents($path);
			//iprint_r($alltablearray);
			
			$tablearray = $alltablearray[$regtab];

			// array fittizio x magazzino che vede richieste in entrata
			
			$datatoview = array(
				'regtab' => $regtab,
				'tablearray' => $tablearray,
				'table' => $table,
				'wah' => $wah,
				'userrole' => $userrole,
				'cen' => $cen
			);
			// end dati tabella

			// titolo della pagina
			$titolo = 'Richieste in entrata';
			$head_data = array(
				'titolo' => $titolo
			);

			/*//load delle view
			$this->load->view('header', $head_data);
			$this->load->view('inrequests', $datatoview);
			$this->load->view('footer');*/
			
			

			if(!isset($_POST['warehouse1'])){
				//load delle view
				$this->load->view('header', $head_data);
				$this->load->view('inrequests', $datatoview);
				$this->load->view('footer');
			} else{
				//iprint_r($_POST);
				$wahid = $_POST['warehouse1'];
				$class = 'inrequests-table';
				$idtable = 'inrequests';
				$wahcenlist = $this->Inrequests_model->inrequests_wahcenlist();
				$wahname = $wahcenlist[$wahid];
				
				$metatemplate = $this->tabletemplates->temparchive($class, $idtable); // aspetto tabella
				$wah = array(
					'id' => $wahid,
					'name' => $wahname,
				);
				$this->Inrequests_model->inrequeststable_view($metatemplate, $regtab, $tablearray, $table, $wah, $userrole);
			}
		} else{
			redirect('Myerrors/myerror_404');
		}
		
	}
	/*public function inrequests_filter(){	// booooh da togliere???
		//load libraries helpers e models
		$this->load->library('table'); // gestione tabelle di codeigniter
		$this->load->library('tabletemplates');  //libreria per la gestione aspetto delle tabelle
		$this->load->model('Inrequests_model');



		// titolo della pagina
		$titolo = 'Richieste in entrata';
		$head_data = array(
			'titolo' => $titolo
		);

		//load delle view
		$this->load->view('header', $head_data);
		$this->load->view('inrequests', $datatoview);
		$this->load->view('footer');
	}*/
	public function inrequests_pconfirm()
	{
		$this->load->helper('form');
		$this->load->model('Inrequests_model');

		// array fittizio x magazzino che vede richieste in entrata
		$wah = array(
			'id' => '2',
			'name' => 'Generale',
		);

		// dati relativi alla tabella di riferimento
        $table = 'requests';
        //$table = 'instock_view';


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
		$this->load->view('inreqpconfirm', $datatoview);
		$this->load->view('footer');
	}
	public function inrequests_psubmit()
	{	
		$this->load->model('Inrequests_model');
		$ref =  $_GET['ref'];

		// pesco da file formfields
		$path = 'json/inreq_formfields.php';
		$alltablearray = url_get_contents($path);
		$regtab = 'requests';
		$tablearray = $alltablearray[$regtab]['psubmit'];
		

		$datatoview = array(
			'regtab' => $regtab,
		);

		$this->Inrequests_model->inrequests_psubmit($tablearray, $ref);

		//iprint_r($data);
		// titolo della pagina
		$titolo = 'Conferma richiesta';
		$head_data = array(
			'titolo' => $titolo,
			'tablearray' => $tablearray,
		);
		$this->load->view('header', $head_data);
		//$this->load->view('404');
		$this->load->view('inreqpsubmit', $datatoview);
		$this->load->view('footer');
	}
	public function inrequests_pedit()
	{	
		$this->load->helper('Form');
		$this->load->model('Inrequests_model');
		$ref =  $_GET['ref'];

		// pesco da file formfields
		$path = 'json/inreq_formfields.php';
		$alltablearray = url_get_contents($path);
		$regtab = 'requests';
		$tablearray = $alltablearray[$regtab]['pedit'];
		$siteurl = 'Inrequests/inrequests_peditsubmit';

		$tablearray = $this->Inrequests_model->inrequests_pedit($tablearray, $ref);
		//iprint_r($tablearray);
		//iprint_r($data);

		$datatoview = array(
			'regtab' => $regtab,
			'siteurl' => $siteurl,
			'tablearray' => $tablearray,
		);
		
		// titolo della pagina
		$titolo = 'Modifica quantità';
		$head_data = array(
			'titolo' => $titolo
		);
		$this->load->view('header', $head_data);
		$this->load->view('inreqpedit', $datatoview);
		$this->load->view('footer');
	}
	public function inrequests_peditsubmit() {
		$this->load->model('Inrequests_model');

		// process data
		//post
		$data = $_POST;
		
		// pesco da file formfields
		$path = 'json/inreq_formfields.php';
		$alltablearray = url_get_contents($path);
		$regtab = $data['table'];
		$tablearray = $alltablearray[$regtab]['peditsubmit'];

		$datatoview = array(
			'regtab' => $regtab,
			'mode' => 'edit'
		);

		$this->Inrequests_model->inrequests_peditsubmit($data, $tablearray);

		//iprint_r($data);
		// titolo della pagina
		$titolo = 'Salvataggio';
		$head_data = array(
			'titolo' => $titolo
		);
		//echo $datatoview['mode'];
		$this->load->view('header', $head_data);
		$this->load->view('inreqpeditsubmit', $datatoview);
		$this->load->view('footer');

	}
	public function inrequests_choose_wah(){
		$userrole = $this->userrole;
		$maincen = $this->maincen;
		$cen = $this->cen;

		if($userrole == 'admin' || $userrole == 'wah' || $userrole == 'wahrep'){
			// carico helper, librerie e model
			$this->load->helper('form');
			$this->load->model('Inrequests_model');

			// pesco da file formfields
			$path = 'json/inreq_formfields.php';
			$alltablearray = url_get_contents($path);

			$tablearray = $alltablearray['requests']['choosewah'][$userrole];
			
			$formfields = $tablearray['query'];
			//iprint_r($alltablearray);
			$wahlist = $this->Inrequests_model->inrequests_choose_wah($formfields);
			$wahcenlist = $this->Inrequests_model->inrequests_choose_wahcen($formfields);
			$wahlist['choose'] = 'Scegli magazzino';
			$wahcenlist['choose'] = 'Scegli magazzino';
			$keytop = 'choose';
			move_to_top($wahlist, $keytop);
			move_to_top($wahcenlist, $keytop);

			//$formfields = $tablearray['formfields'];
			// data to view
			$datatoview = array(
				'siteurl' => 'Inrequests/inrequests_wah_table',
				'tablearray' => $tablearray,
				'wahlist' => $wahlist,
				'wahcenlist' => $wahcenlist,
				'userrole' => $userrole,
			);
			// head
			$titolo = 'Scegli magazzino';
			$head_data = array(
				'titolo' => $titolo
			);
			$this->load->view('header', $head_data);
			$this->load->view('inreqchoosewah', $datatoview);
			$this->load->view('footer');
		} else{
			redirect('Myerrors/myerror_404');
		}

	}
	public function inrequests_wah_table(){
		$userrole = $this->userrole;
		$maincen = $this->maincen;
		$cen = $this->cen;

		if($userrole == 'admin' || $userrole == 'wah' || $userrole == 'wahrep'){
			$this->load->library('table'); // gestione tabelle di codeigniter
			$this->load->library('tabletemplates');  //libreria per la gestione aspetto delle tabelle
			$this->load->helper('form');
			$this->load->model('Inrequests_model');

			// pesco da file formfields
			$path = 'json/inreq_formfields.php';
			$alltablearray = url_get_contents($path);
			$tablearray = $alltablearray['requests']['choosewah'][$userrole];
			$formfields = $tablearray['query'];
			$wahlist = $this->Inrequests_model->inrequests_choose_wah($formfields);
			$wahcenlist = $this->Inrequests_model->inrequests_choose_wahcen($formfields);

			//definisco array post
			$data = $_POST;

			if($maincen !== 'choose'){
				$wah = $maincen;
			} else{
				$wahcenid = $data['prowahname'];
				$nome = $wahcenlist[$wahcenid];
				$wah = array(
					'id' => $wahcenid,
					'name' => $nome,
				);
			}

			//pesco dati in POST e determino wah richiedente
			
			$wahid = $data['wahname'];

			$wahname = $wahlist[$wahid];
			$wahchoose = array(
				'id' => $wahid,
				'name' => $wahname,
			);
			//iprint_r($wahchoose);

			// pesco da file formfields
			$path = 'json/inreq_formfields.php';

			$alltablearray = url_get_contents($path);
			$tablearray = $alltablearray['requests']['wahtable'];
			//iprint_r($tablearray);
			//$tablearray = $this->Instock_model->addnew_view($wah, $tablearray);
			$datatoview = array(
				'tablearray' => $tablearray,
				'siteurl' => 'Inrequests/inrequests_batchsubmit',
				'wah' => $wah,
				'wahchoose' => $wahchoose,
			);
			// end dati tabella

			// titolo della pagina
			$titolo = 'Carico';
			$head_data = array(
				'titolo' => $titolo
			);
			$this->load->view('header', $head_data);
			$this->load->view('inreqwahtable', $datatoview);
			$this->load->view('footer');
		} else{
			redirect('Myerrors/myerror_404');
		}
	}
	public function inrequests_batchsubmit(){
		$this->load->model('Inrequests_model');
		// pesco da file tablearray
		$wah = array(
			'id' => 2,
			'name' => 'Generale'
		);

		$path = 'json/inreq_formfields.php';

		$alltablearray = url_get_contents($path);
		$formfields = $alltablearray['requests']['wahtable']['tablesubmit'];
		//iprint_r($_POST);
		$data = $_POST['alldataarray'];

		$this->Inrequests_model->inrequests_batchsubmit($data, $wah, $formfields);
	}
	public function inrequests_successsubmit(){
		$titolo = 'Salvataggio';
		$head_data = array(
			'titolo' => $titolo
		);
		$this->load->view('header', $head_data);
		//$this->load->view('404');
		$this->load->view('inrequestsbatchsubmit');
		$this->load->view('footer');
	}
}