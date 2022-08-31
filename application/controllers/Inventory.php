<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory extends CI_Controller {
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

	public function inventory_r_choose_view()
	{
		$userrole = $this->userrole;
		$mainrep = $this->mainrep;
		$rep = $this->rep;

		if($userrole == 'admin' || $userrole == 'rep' || $userrole == 'wahrep'){
			$this->load->helper('form');
			$this->load->model('Inventory_model');

			// array fittizio x magazzino 
			/*if(isset($_GET['wah'])){
				$wah = array(
					'id' => $_GET['wah'],
				);
			} else{
				$wah = array(
					'id' => '1',
					'name' => 'Blu',
				);
			}*/
			$wah = $mainrep;			

			// variabili da passare alla view
			$datachoose = $this->Inventory_model->inventory_r_choose_view();
			$wahlist = $datachoose['wahlist'];
			$invlist = $datachoose['invlist'];
			$siteurl = 'Inventory/inventory_r_view';
			$datatoview = array(
				'invlist' => $invlist,
				'wahlist'=>$wahlist,
				'wah'=>$wah,
				'siteurl'=>$siteurl,
			);

			//header
			$titolo = 'Scegli magazzino';
			$head_data = array(
				'titolo' => $titolo
			);

			//load delle view
			$this->load->view('header', $head_data);
			$this->load->view('inventory_r_choose', $datatoview);
			$this->load->view('footer');
		} else{
			redirect('Myerrors/myerror_404');
		}
	}
	public function inventory_r_view()
	{
		$userrole = $this->userrole;
		$mainrep = $this->mainrep;
		$rep = $this->rep;

		if($userrole == 'admin' || $userrole == 'rep' || $userrole == 'wahrep'){
			//load libraries helpers e models
			$this->load->helper('form');
			$this->load->library('table'); // gestione tabelle di codeigniter
			$this->load->library('tabletemplates');  //libreria per la gestione aspetto delle tabelle
			$this->load->model('Inventory_model');

			// array fittizio x magazzino 
			$datachoose = $this->Inventory_model->inventory_r_choose_view();
			$wahlist = $datachoose['wahlist'];
			if(isset($_GET['wahid'])){
				$wahid = $_GET['wahid'];            
			} else{
				//recupero dati
				$data = $_POST;
				$wahid =  $_POST['warehouse'];	
			}
			//determino wah
			$wahname = $wahlist[$wahid];
			//iprint_r($wahlist);
			$wah = array(
				'id' => $wahid,
				'name' => $wahname,
			);
		
			
			$regtab = 'lastrequests_view';
			
			// pesco da file tablearray
			$path = 'json/inv_reparti.php';

			$alltablearray = url_get_contents($path);
			$tablearray = $alltablearray['inv_r_tableview'];
			$siteurl = 'Inventory/inventory_r_submit';

			$datatoview = array(
				'regtab' => $regtab,
				'tablearray' => $tablearray,
				'wah' => $wah,
				'siteurl'=>$siteurl,
			);
			// end dati tabella

			// titolo della pagina
			$titolo = 'Inventario Reparti';
			$head_data = array(
				'titolo' => $titolo,
			);

			//load delle view
			$this->load->view('header', $head_data);
			$this->load->view('inventory_r', $datatoview);
			$this->load->view('footer');
		} else{
			redirect('Myerrors/myerror_404');
		}
	}
	public function inventory_r_submit()
	{
		//load libraries helpers e models
		$this->load->model('Inventory_model');

		$data = $_POST;
		$dataprs = array();

		$path = 'json/inv_reparti.php';

		$alltablearray = url_get_contents($path);
		$tablearray = $alltablearray['inv_r_submit'];

		$gentablearray = $tablearray['inventory_list'];
		$invtablearray = $tablearray['inventory'];
		$cattablearray = $tablearray['categories'];

		//iprint_r($data);
		// divisione dati
		foreach($data as $input=>$value){
			if(strpos($input, '_')){
				$fexpl = explode('_', $input);
				$prsid = $fexpl[1];
				$field = $fexpl[0];
				$dataprs[$prsid][$field] = $value;
			}
		}
		//iprint_r($dataprs);

		foreach($data as $input=>$value){
			if(!strpos($input, '_') && $input!=='submit'){
				$gendata[$input] = $value;
			}
		}
		//iprint_r($gendata);
		// fine divisione dati

		$this->Inventory_model->inventory_r_submit($dataprs, $gendata, $gentablearray, $invtablearray, $cattablearray);

		// titolo della pagina
		$titolo = 'Inventario Reparti';
		$head_data = array(
			'titolo' => $titolo,
		);

		$datatoview = array(
			'wahid'=>$gendata['wahid'],
		);

		//load delle view
		$this->load->view('header', $head_data);
		$this->load->view('inventory_r_submit', $datatoview);
		$this->load->view('footer');
	}
	public function inventory_c_choose_view(){
		$this->load->helper('form');
		$this->load->model('Inventory_model');
		// array fittizio x magazzino 
        if(isset($_GET['wah'])){
            $wah = array(
                'id' => $_GET['wah'],
            );
        } else{
            $wah = array(
                'id' => '2',
                'name' => 'Generale',
            );
        }		

		// variabili da passare alla view
		$datachoose = $this->Inventory_model->inventory_c_choose_view();
		$wahlist = $datachoose['wahlist'];
		$invlist = $datachoose['invlist'];
		$siteurl = 'Inventory/inventory_c_view';
		$datatoview = array(
			'invlist' => $invlist,
			'wahlist'=>$wahlist,
			'wah'=>$wah,
			'siteurl'=>$siteurl,
		);

		//header
		$titolo = 'Scegli magazzino';
		$head_data = array(
			'titolo' => $titolo
		);

		//load delle view
		$this->load->view('header', $head_data);
		$this->load->view('inventory_c_choose', $datatoview);
		$this->load->view('footer');
	}
	public function inventory_c_view(){
		//load libraries helpers e models
		$this->load->helper('form');
		$this->load->library('table'); // gestione tabelle di codeigniter
		$this->load->library('tabletemplates');  //libreria per la gestione aspetto delle tabelle
		$this->load->model('Inventory_model');

		// array fittizio x magazzino 
		$datachoose = $this->Inventory_model->inventory_c_choose_view();
		$wahlist = $datachoose['wahlist'];
		if(isset($_GET['wahid'])){
			$wahid = $_GET['wahid'];            
        } else{
			//recupero dati
			$data = $_POST;
			$wahid =  $_POST['warehouse'];	
		}
		//determino wah
		$wahname = $wahlist[$wahid];
		//iprint_r($wahlist);
		$wah = array(
			'id' => $wahid,
			'name' => $wahname,
		);
       
		
		$regtab = 'consumption_year_view';
		
		// pesco da file tablearray
		$path = 'json/inv_centrali.php';

		$alltablearray = url_get_contents($path);
		$tablearray = $alltablearray['inv_c_tableview'];
		$siteurl = 'Inventory/inventory_c_submit';

		$datatoview = array(
			'regtab' => $regtab,
			'tablearray' => $tablearray,
			'wah' => $wah,
			'siteurl'=>$siteurl,
		);
		// end dati tabella

		// titolo della pagina
		$titolo = 'Inventario Reparti';
		$head_data = array(
			'titolo' => $titolo,
		);

		//load delle view
		$this->load->view('header', $head_data);
		$this->load->view('inventory_c', $datatoview);
		$this->load->view('footer');
	}
	
}