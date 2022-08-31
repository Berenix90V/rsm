<?php
//defined('BASEPATH') OR exit('No direct script access allowed');
class Notifiche_model extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    public function CIdb() {
        $var = new dbload;
        $CIdb = $var->CIdb;
        return $CIdb;
    }
    public function notifica_richieste($userrole, $maincen){
        
        $CIdb = $this->CIdb();

        /*$stringquery = "SELECT REQ_ID, REQ_pwahconfirm FROM requests_view WHERE REQ_pwahconfirm IS NULL";
        $wahcenid = $maincen['id'];
        $stringquery = "SELECT REQ_ID, REQ_pwahconfirm FROM requests_view WHERE REQ_pwahconfirm IS NULL AND REQ_prowahid = $wahcenid ";
        $query = $CIdb -> query($stringquery);
        $result = $query->result();*/

        $CIdb->select('REQ_ID, REQ_pwahconfirm')->from('requests_view');
        if($userrole == 'wah' || $userrole == 'wahrep'){
            $wherearray = array(
                'REQ_prowahid' => $maincen['id'],
                'REQ_pwahconfirm'=> null,               
            );
        } else{
            $wherearray = array(
                'REQ_pwahconfirm'=> null,
            );
        }

        $CIdb->where($wherearray);
        $result = $CIdb->get()->result();

        $requests = array();
        if(empty($result)){
            $requests['bool'] = 'false';
        } else{
            $requests['bool'] = 'true';
            $requests['num'] = count($result); 
            //$requests['num'] = ;                   
        }

        return($requests);
    }
    public function notifica_richieste_reparti($userrole, $mainrep){
        $CIdb = $this->CIdb();
        if($userrole == 'rep' || $userrole == 'wahrep'){
            $wahrepid = $mainrep['id'];
            $stringquery = "SELECT REQ_ID, REQ_pwahconfirm FROM requests_view WHERE REQ_pwahconfirm IS NOT NULL AND REQ_rwahconfirm IS NULL AND REQ_reqwahid = $wahrepid";
        } else{
            $stringquery = "SELECT REQ_ID, REQ_pwahconfirm FROM requests_view WHERE REQ_pwahconfirm IS NOT NULL AND REQ_rwahconfirm IS NULL";
        }
        $query = $CIdb -> query($stringquery);
        $result = $query->result();

        $requests = array();
        if(empty($result)){
            $requests['bool'] = 'false';
        } else{
            $requests['bool'] = 'true';
            $requests['num'] = count($result);          
        }
        return($requests);
    }
}