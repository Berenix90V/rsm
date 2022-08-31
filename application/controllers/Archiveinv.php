<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Archiveinv extends CI_Controller {
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
    public function archinv_tot_choose(){
		$userrole = $this->userrole;
		$mainrep = $this->mainrep;
		$rep = $this->rep;

		if($userrole == 'admin' || $userrole == 'rep' || $userrole == 'wahrep'){
			$this->load->helper('form');
			$this->load->model('Archiveinv_model');

			$siteurl = 'Archiveinv/archinv_tot_wah_view';

			$wahlist = $this->Archiveinv_model->archinv_tot_choose_wah();
			$wahlist['tot'] = 'Tutti i magazzini';
			$keytop = 'tot';
			move_to_top($wahlist, $keytop);

			//wah
			$wah = $mainrep;

			// dati da passare alla view
			$datatoview = array(
				'siteurl' => $siteurl,
				'wahlist' => $wahlist,
				'wah' => $wah,
			);
			//header
			$titolo = 'Scegli magazzino';
			$head_data = array(
				'titolo' => $titolo
			);

			//load delle view
			$this->load->view('header', $head_data);
			$this->load->view('archinv_tot_choose', $datatoview);
			$this->load->view('footer');
		} else{
			redirect('Myerrors/myerror_404');
		}
	}
	public function archinv_tot_wah_view($year = ''){	
		/*$userrole = $this->userrole;
		$mainrep = $this->mainrep;
		$rep = $this->rep;

		if($userrole == 'admin' || $userrole == 'rep' || $userrole == 'wahrep'){*/
			$this->load->helper('form');	
			$this->load->library('table'); // gestione tabelle di codeigniter
			$this->load->library('tabletemplates');  //libreria per la gestione aspetto delle tabelle
			$this->load->model('Archiveinv_model');

			//iprint_r($_POST);
			$wahid = $_POST['warehouse'];

			$path = 'json/archinv_tablearray.php';
			$tablearray = url_get_contents($path);

			$catpath = 'json/category_list.php';
			$catlisttot = url_get_contents($catpath);
			$catlist = $catlisttot['products_cat'];
			$monthslist = $catlisttot['months'];


			if($year==''){
				$year = date('Y');
			}
			$wahlist = $this->Archiveinv_model->archinv_wahlist();
			if($wahid !== 'tot'){
				$wahname = $wahlist[$wahid];
			} else{
				$wahname = 'totali';
			}

			$wah = array(
				'id' => $wahid,
				'name' => $wahname,
			);
			
			
			//dati view
			$datatoview = array(
				'tablearray' => $tablearray,
				'wah' => $wah,
				'year' => $year,
				'catlist' => $catlist,
				'monthslist' => $monthslist,
			);
			// end dati tabella
			//iprint_r($tablearray);

			// titolo della pagina
			$titolo = 'Operazioni interne';
			$head_data = array(
				'titolo' => $titolo
			);

			if(!isset($_POST['year'])){
				//load delle view
				$this->load->view('header', $head_data);
				$this->load->view('archinv_tot_wahview', $datatoview);
				$this->load->view('footer');
			} else{
				$year = $_POST['year'];
				
				$class = 'archive-table orderable';
				$idtable = 'archinv';
				$metatemplate = $this->tabletemplates->temparchive($class, $idtable); // aspetto tabella
				$this->Archiveinv_model->archinv_tot_wah_view($metatemplate, $tablearray, $wah, $year, $catlist, $monthslist);
			}
		/*} else{
			redirect('Myerrors/myerror_404');
		}*/
		
	}
	public function archinv_update_view(){	
		

		
		/*$year = $_POST['year'];
		echo $year;*/
	}
}
