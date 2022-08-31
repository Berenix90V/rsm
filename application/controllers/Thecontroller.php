<?php
class Thecontroller extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }
    
    
    public function isunique() {
        $valore = $_POST['value'];
        $nomeCampo = $_POST['field'];
        $tabella = $_POST['table'];
        //print_r($_POST);
        xe_unico($valore, $nomeCampo, $tabella);
        
    }
    
    public function validator() {
        $firstLevel = strip_tags($_POST['param']);
        $secondLevel = strip_tags($_POST['value']);
        $file = file_get_contents(base_url().'json/validator.php');
        $file = json_decode($file, true);
        $file = $file[$firstLevel];
       
        if (in_array($secondLevel, $file)) {
           echo "true";
        } else {
            echo "false";
        }
    }
    
    public function validatorSubmit() {
        $firstLevel = strip_tags($_POST['param']);
        $file = file_get_contents(base_url().'json/validator.php');
        $file = json_decode($file, true);
        $file = $file[$firstLevel];
        echo json_encode($file);
    }
}