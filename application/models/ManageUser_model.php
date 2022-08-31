<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ManageUser_model extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    public function CIdb() {
        $var = new dbload;
        $CIdb = $var->CIdb;
        return $CIdb;
    }
    public function edit_profile($usrid, $formarray){
        $CIdb = $this->CIdb();
        $CIdb->select('*')->from('users')->where('USR_ID', $usrid);
        $result = $CIdb->get()->result();

        $formfields = $formarray['formfields'];
        foreach($result as $num => $usr){
            foreach($usr as $field => $value){
                if(array_key_exists($field, $formfields)){
                    $formfields[$field]['value'] = $value;
                }
                if(isset($formarray['hiddenfields']) && array_key_exists($field, $formarray['hiddenfields'])){
                    $formarray['hiddenfields'][$field] = $value;  
                }
            }
        }
        $formarray['formfields'] = $formfields;

        return($formarray);
    }
    public function update_profile($data, $formfields){
        $CIdb = $this->CIdb();
        $usrid = $data['USR_ID'];
        $datatoupdate = array();
        foreach($formfields as $field=>$par){
            $nome = $par['name'];
            if(array_key_exists($nome, $data)){
                $datatoupdate[$field] = $data[$nome];
            }
        }
        $CIdb->where('USR_ID', $usrid)->update('users', $datatoupdate);
    }
}