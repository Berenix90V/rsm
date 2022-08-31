<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Application specific global variables
class Dbload
{
    public $CIdb = '';
    //public $Softdb = '';
    function __construct() {
        $CI =& get_instance();
        $this->CI =$CI;
        $this->CIdb = $CI->load->database('default', TRUE);
        //$this->Softdb = $CI->load->database('softdb', TRUE);
    }
    public function userinfo($dati) {
         
        /*foreach($dati as $value) {
        $chiave = $value->meta_key;
        $valore = $value->meta_value
        }*/
    }
}