<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Custompicker_model extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    public function CIdb() {
        $var = new dbload;
        $CIdb = $var->CIdb;
        return $CIdb;
    }
    public function custompicker_query($post, $queryarray){
        $CIdb = $this->CIdb();
       
        $CIdb-> select($queryarray['data-show']); 
        $CIdb-> from($queryarray['data-table']);
        //$CIdb-> like($queryarray['data-filter'], $post['valore'], 'both');
        //$CIdb->like('WAH_active', 1, 'both');

        if(isset($queryarray['data-active'])){
            foreach($queryarray['data-active'] as $key=>$afield){
                $CIdb->where($afield, 1, 'both');            
            }
        }
        


        foreach($queryarray['data-filter'] as $key=>$wfield){
            if($key == 0){
                $CIdb->like($wfield, $post['valore'], 'both');
            } else{
                $CIdb->or_like($wfield, $post['valore'], 'both');
            }
        }

        

        $CIdb-> group_by($queryarray['data-groupby'], 'ASC'); 
        if(isset($queryarray['data-having'])){
            $CIdb-> having($queryarray['data-having']);
        }
        if(isset($queryarray['data-orderby'])){
            $CIdb-> order_by($queryarray['data-orderby'], 'ASC'); 
        }else{
            $CIdb-> order_by($queryarray['data-groupby'], 'ASC'); 
        }

        
        
        /*if (isset($queryarray['data-having'])){
           $havingarray = $queryarray['data-having'];
            $CIdb-> having('PRS_active', 1);
        }*/
        
        $query = $CIdb->get();
        $result = $query->result();

        return($result);
        

    }	
}