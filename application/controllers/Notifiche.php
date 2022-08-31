<?php
//defined('BASEPATH') OR exit('No direct script access allowed');

class Notifiche extends CI_Controller {

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
    public function notifica_richieste(){
   
        $userrole = $this->userrole;
		$maincen = $this->maincen;
        $cen = $this->cen;
		
        // da pescare wah
        $this->load->model('Notifiche_model');
        $result = $this->Notifiche_model->notifica_richieste($userrole, $maincen);
        echo json_encode($result);
    }
    public function notifica_richieste_reparti(){

        $userrole = $this->userrole;
		$mainrep = $this->mainrep;
        $rep = $this->rep;

        $this->load->model('Notifiche_model');
        $result = $this->Notifiche_model->notifica_richieste_reparti($userrole, $mainrep);
        echo json_encode($result);
    }
}