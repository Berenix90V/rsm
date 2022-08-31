<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Requests extends CI_Controller {
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

	public function requests_view()
	{
		$userrole = $this->userrole;
		$mainrep = $this->mainrep;
		$rep = $this->rep;
		if($userrole == 'admin' || $userrole == 'rep' || $userrole == 'wahrep'){
			//load libraries helpers e models
			$this->load->library('table'); // gestione tabelle di codeigniter
			$this->load->library('tabletemplates');  //libreria per la gestione aspetto delle tabelle
			//$this->load->helper('utility');
			$this->load->model('Requests_model');

			// array fittizio x magazzino richiedente
			$wah = $mainrep;

			$regtab = 'instock_view';
			$table = 'productssuppliers';
			
			// pesco da file tablearray
			$path = 'json/req_tablearray.php';

			$alltablearray = url_get_contents($path);
			//iprint_r($alltablearray);
			$tablearray = $alltablearray[$regtab];
			$datatoview = array(
				'regtab' => $regtab,
				'tablearray' => $tablearray,
				'table' => $table,
				'wah' => $wah
			);
			// end dati tabella

			// titolo della pagina
			$titolo = 'Lista prodotti per richieste';
			$head_data = array(
				'titolo' => $titolo
			);

			//load delle view
			$this->load->view('header', $head_data);
			$this->load->view('requests', $datatoview);
			$this->load->view('footer');
		} else{
			redirect('Myerrors/myerror_404');
		}
	}
	public function requests_addnew()
	{
		$userrole = $this->userrole;
		$mainrep = $this->mainrep;
		$rep = $this->rep;

		if($userrole == 'admin' || $userrole == 'rep' || $userrole == 'wahrep'){
			$this->load->helper('form');
			$this->load->model('Requests_model');

			// array fittizio x magazzino richiedente
			$wah = $mainrep;

			// dati relativi alla tabella di riferimento
			$regtab = 'requests';
			$table = 'instock_view';

			// pesco da file formfields
			$path = 'json/req_formfields.php';

			$alltablearray = url_get_contents($path);
			$tablearray = $alltablearray[$regtab]['addnew'];
			$datatoview = array(
				'regtab' => $regtab,
				'tablearray' => $tablearray,
				'siteurl' => 'Requests/requests_submit',
				'table' => $table,
				'ref' => $_GET['ref'],
				'wah' => $wah,
			);
			// end dati tabella

			// titolo della pagina
			$titolo = 'Nuova richiesta';
			$head_data = array(
				'titolo' => $titolo
			);
			$this->load->view('header', $head_data);
			$this->load->view('reqaddnew', $datatoview);
			$this->load->view('footer');
		} else{
			redirect('Myerrors/myerror_404');
		}
	}
	
	public function requests_submit()
	{	
		$this->load->model('Requests_model');

		// process data
		//post
		$data = $_POST;
		
		// pesco da file formfields
		$path = 'json/req_formfields.php';
		$alltablearray = url_get_contents($path);
		$regtab = $data['table'];
		$tablearray = $alltablearray[$regtab]['submit'];

		$datatoview = array(
			'regtab' => $regtab,
			'mode' => 'addnew'
		);

		$this->Requests_model->requests_submit($data, $tablearray);

		// titolo della pagina
		$titolo = 'Salvataggio';
		$head_data = array(
			'titolo' => $titolo
		);
		$this->load->view('header', $head_data);
		$this->load->view('reqsubmit', $datatoview);
		$this->load->view('footer');
	}
	public function batch_requests_choose_wah(){
		$userrole = $this->userrole;
		$mainrep = $this->mainrep;
		$rep = $this->rep;

		if($userrole == 'admin' || $userrole == 'rep' || $userrole == 'wahrep'){
		// carico helper, librerie e model
			$this->load->helper('form');
			$this->load->model('Requests_model');

			// pesco da file formfields
			$path = 'json/req_formfields.php';
			$alltablearray = url_get_contents($path);
			$tablearray = $alltablearray['requests']['batch']['choosewah'][$userrole];
			
			$formfields = $tablearray['query'];
			//iprint_r($alltablearray);
			$wahlist = $this->Requests_model->batch_req_choose_wah($formfields);
			$wahreplist = $this->Requests_model->requests_wah_rep($userrole, $rep);
			$wahlist['choose'] = 'Scegli magazzino centrale';
			$keytop = 'choose';
			move_to_top($wahlist, $keytop);

			$wahreplist['choose'] = 'Scegli magazzino reparto';
			$keytop = 'choose';
			move_to_top($wahreplist, $keytop);


			$formfields = $tablearray['formfields'];
			// data to view
			$datatoview = array(
				'siteurl' => 'Requests/requests_in_batch',
				'tablearray' => $tablearray,
				'wahlist' => $wahlist,
				'wahreplist' => $wahreplist,
			);
			// head
			$titolo = 'Scegli magazzino';
			$head_data = array(
				'titolo' => $titolo
			);
			$this->load->view('header', $head_data);
			$this->load->view('requestsbatchwah', $datatoview);
			$this->load->view('footer');
		} else{
			redirect('Myerrors/myerror_404');
		}
	}
	public function requests_in_batch(){
		$userrole = $this->userrole;
		$mainrep = $this->mainrep;
		$rep = $this->rep;
		
		if($userrole == 'admin' || $userrole == 'rep' || $userrole == 'wahrep'){
			$this->load->library('table'); // gestione tabelle di codeigniter
			$this->load->library('tabletemplates');  //libreria per la gestione aspetto delle tabelle
			$this->load->helper('form');
			$this->load->model('Requests_model');

			// array fittizio x magazzino che inserisce dati
			if(!isset($_POST['reqwahid'])){
				$wah = $mainrep;
			} else{
				$wah['id'] = $_POST['reqwahid'];
			}
			
			//$wah['id'] = $_POST['warehouseid'];

			//pesco dati in POST
			$data = $_POST;
			//iprint_r($_POST);
			$wahid = $data['wahid']; // prodotto

			// pesco da file formfields
			$path = 'json/req_formfields.php';

			$alltablearray = url_get_contents($path);
			$tablearray = $alltablearray['requests']['batch']['requests_view'];
			//iprint_r($tablearray);
			//$tablearray = $this->Instock_model->addnew_view($wah, $tablearray);

			$datatoview = array(
				'pwahid' => $wahid, // prodotto
				'tablearray' => $tablearray,
				'siteurl' => 'Requests/requests_batchsubmit',
				'rwah' => $wah,	// richiedente
			);
			// end dati tabella

			// head
			$titolo = 'Richieste';
			$head_data = array(
				'titolo' => $titolo
			);
			$this->load->view('header', $head_data);
			$this->load->view('requestsbatch', $datatoview);
			$this->load->view('footer');
		} else{
			redirect('Myerrors/myerror_404');
		}
	}
	public function requests_batchsubmit(){
		// NB: se ci sono campi nascosti non li pesca perchè fuori dalla table, pesco il post da js
		$this->load->model('Requests_model');
		// pesco da file tablearray
		/*$wah = array(
			'id' => 1,
			'name' => 'Blu'
		);*/
		iprint_r($_POST);
		$rwahid = $_POST['rwarehouseid'];
		$wah = array(
			'id' => $rwahid,
		);

		$path = 'json/req_formfields.php';

		$alltablearray = url_get_contents($path);
		$tablearray = $alltablearray['requests']['batch']['batchsubmit'];
		$formfields = $tablearray['formfields'];
		//iprint_r($_POST);
		$data = $_POST['alldataarray'];
		//iprint_r($formfields);
		$this->Requests_model->requests_batchsubmit($data, $wah, $formfields);		
	}
	public function requests_successsubmit(){
		$this->load->model('Requests_model');

		// head
		$titolo = 'Richieste';
		$head_data = array(
			'titolo' => $titolo
		);
		$this->load->view('header', $head_data);
		$this->load->view('reqbatchsubmit');
		$this->load->view('footer');
	}
}