<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Archiveinv_model extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    public function CIdb() {
        $var = new dbload;
        $CIdb = $var->CIdb;
        return $CIdb;
    }
    public function archinv_tot_choose_wah(){
        $CIdb = $this->CIdb();
        $CIdb->select('*')->from('warehouses')->where('WAH_wahcategory', 2);
        $result = $CIdb->get()->result();
        $wahlist = array();
        foreach($result as $numb => $wah){
            $wahid = $wah->WAH_ID;
            $nome = $wah->WAH_wahname;
            $wahlist[$wahid] = $nome;
        }
        return($wahlist);
    }
    public function archinv_tot_wah_view($metatemplate, $tablearray, $wah, $year, $catlist, $monthslist){
        $CIdb = $this->CIdb();
        //iprint_r($catlist);
        $wahid = $wah['id'];

        //query
        $queryarray = $tablearray['query'];
        $CIdb->select($queryarray['select']);
        $CIdb->from('inventory_tot_view');
        
        
        if($wah['id'] == 'tot'){
            $wherearray = array(
                'year' => $year,
            );    
        } else{
            $wherearray = array(
                'IL_WAH_ID' => $wahid,
                'year' => $year,
            );
        }
        
        $CIdb->where($wherearray);
        $qresult = $CIdb->get()->result();
        
        //end query
        
        // query cat
        $stringselect = 'IC_CAT_ID, year, IL_WAH_ID, gennaio, febbraio, marzo, aprile, maggio, giugno, luglio, agosto, settembre, ottobre, novembre, dicembre';
        $CIdb->select($stringselect)->from('inventory_cat_view');
        $catquery = $CIdb->get()->result();
        
        $totcatinv = array();
        foreach($catquery as $num=>$cinv){
            $year = $cinv->year;
            $idwah = $cinv->IL_WAH_ID;
            $idcat = $cinv->IC_CAT_ID;
            foreach($cinv as $field=>$value){
                if(in_array($field, $monthslist)){
                    $totcatinv[$year][$idwah][$field][$idcat] = $value;
                }
            }
            
        }
        //end query cat
        //iprint_r($totcatinv);
        
        $totresult = array();
        foreach($qresult as $num=>$inv){
            $year = $inv->year;
            $idwah = $inv->IL_WAH_ID;
            $catarray = $totcatinv[$year][$idwah];
            foreach($inv as $field=>$value){
                if(in_array($field, $monthslist)){
                    $mese = $totcatinv[$year][$idwah][$field];
                    $valmens = $mese;
                    $valmens['totale'] = $value;
                    move_to_top($valmens, 'totale');
                    $inv->$field = $valmens;
                }
            }
        }
        
        //iprint_r($qresult);
        

        //iprint_r($tablearray['headers']);

        //costruisco la tabella definendo gli array di base come il corpo "result" e l'header "header"
		$result = array();
        $header = array();

        foreach($qresult as $key=>$inv){
            
            foreach($inv as $field=>$value){
                
                // HEADERS
                if($key == 0){ // generazione header da prima riga
                    if(isset($tablearray['headers'])){		// vengono selezionati solo quelli che sono nell'array 'tableheaders'
                        $tableheaders = $tablearray['headers'];
                        if(array_key_exists($field, $tableheaders)){
                            
                            $header[$field] = $tableheaders[$field];
                        } 
                    } else{
                        $header[$field] = $field; // inserisco i nomi dei campi della tabella anche come key nel caso in seguito dovessi cambiare i titoli in frontend, in questo modo nonn perdo i riferimenti
                    }
                }

                if(isset($tablearray['headers'])){
					if(array_key_exists($field, $tableheaders)){	//vengono selezionati solo quelli che sono nell'array 'tableheaders'
						
						//cond campi booleani attivo/non attivo
						if(isset($tablearray['boolean']) && array_key_exists($field, $tablearray['boolean'])){	// se ho campo booleano
							$options = $tablearray['boolean'][$field];
							$value = $options[$value];
						}
                        // fine campo booleano
                        
                        if(in_array($field, $monthslist)){
                            //iprint_r($value);
                            $finale = '';
                            foreach($value as $cat=>$valcat){
                                
                                if($cat == 'totale'){
                                    $valore = '<div class = "archinv totale"><strong>Tot: '.$valcat.'</strong></div>';
                                } else{
                                    $valore = '<div class = "archinv cats cat_'.$cat.'">'.$catlist[$cat]['abbr'].': '.$valcat.'</div>'; 
                                }
                                $finale = $finale.$valore;
                                $result[$key][$field] = $finale;	
                            }
                            
                        } else{
                            $result[$key][$field] = $value;	
                        }
										
					} 
				} else{
					$result[$key][$field] = $value;	// inserisco i nomi dei campi della tabella anche come key nel caso in seguito dovessi cambiare i titoli in frontend, in questo modo nonn perdo i riferimenti
				}	

            }
            
        }


        /*$chiave = 'details';
        $header[$chiave] = '';
        move_to_top($header, $chiave);

        foreach($result as $key=>$row){
            $row[$chiave] = '<div class = "btn btn-success btn-sm btn-circle"><i class = "fas fa-info"></i></div>';
            move_to_top($row, $chiave);
            $result[$key] = $row;

        }*/

        /*if($mode == ""){
            //assegno l'header
            $this->table->set_heading($header);
            
            //assegno il template alla tabella
            $this->table->set_template($metatemplate);
            
            //genero la tabella
            echo $this->table->generate($result);
        } else{
            return($result);
        } */

        //assegno l'header
        $this->table->set_heading($header);
            
        //assegno il template alla tabella
        $this->table->set_template($metatemplate);
        
        //genero la tabella
        echo $this->table->generate($result);
            
        
    }
    public function archinv_wahlist(){
        $CIdb = $this->CIdb();

        $CIdb->select('*')->from('warehouses');
        $result = $CIdb->get()->result();

        $wahlist = array();
        foreach($result as $numb => $wah){
            $wahid = $wah->WAH_ID;
            $wahname = $wah->WAH_wahname;
            $wahlist[$wahid] = $wahname;
        }
        return($wahlist);
    }
}