<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Inventory_model extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    public function CIdb() {
        $var = new dbload;
        $CIdb = $var->CIdb;
        return $CIdb;
    }
    public function inventory_r_choose_view() { // parametri passati dalla view precedente la 1
        $CIdb = $this->CIdb();
        $datachoose = array();

        //choose wah
        $repwah = $CIdb->select('*')->from('warehouses')->where('WAH_wahcategory', 2)->get()->result();
        //iprint_r($repwah);
        $wahlist = array();
        foreach($repwah as $numb=>$wah){
            $wahid = $wah->WAH_ID;
            $wahname = $wah->WAH_wahname;
            $wahlist[$wahid] = $wahname;
        }
        //iprint_r($wahlist);
        $datachoose['wahlist'] = $wahlist;

        // choose date
        $inv= $CIdb->select('*')->from('inventory_list')->get()->result();
        $invlist = array();
        foreach($inv as $numb=>$inv){
            $id = $inv->IL_ID;
            $date = $inv->IL_inventorydate;
            $wah = $inv->IL_WAH_ID;
            $invlist[$id] = array(
                'wah' => $wah,
                'date' => $date,
            );
        }
        $datachoose['invlist'] = $invlist; 
        return($datachoose);
    }
    public function inventory_r_view($metatemplate, $regtab, $tablearray, $wah){
        $CIdb = $this->CIdb();
        $tablearraylastreq = $tablearray['lastrequests_view'];
        $tablearrayinvdone = $tablearray['inventorydone_view'];
        $wahid = $wah['id'];

        // query per ctrl se è già stato fatto l'inventario oppure no
        $query = "SELECT `IL_ID`, `IL_inventorydate` FROM `inventory_list` WHERE YEAR(`IL_inventorydate`) = YEAR(curdate()) AND MONTH(`IL_inventorydate`) = MONTH(curdate()) AND `IL_WAH_ID`= $wahid";
        $query = $CIdb->query($query);
        foreach($query->result() as $row){
            foreach($row as $field=>$value){
                if($field == 'IL_ID'){
                    $ilid = $value;
                }               
            }
        }
        // fine query x inventario


        //QUERY AL DB PER AVERE LISTA PRODOTTI INVENTARIO
        if(!isset($ilid)){ // se non ho già fatto l'inventario faccio la query a lastrequests
            //echo 'ciao';
            $tableheaders = $tablearraylastreq['headers'];
            // query a last request se non ho già fatto l'inventario
            if(isset($tablearraylastreq['select'])){
                $CIdb->select($tablearraylastreq['select']);
            } else{
                $CIdb->select('*');
            }
            $CIdb->from($tablearraylastreq['from']);
            $CIdb->where($tablearraylastreq['wherefield'], $wah['id']);
            $queryresult = $CIdb->get()->result();

            //SE RICHIESTE VUOTE
            // richiamo già qui gli array che poi passerò alla fine alla library perchè mi servono in caso di richieste nulle, compilo l'array per non avere errori e avere una tabella vuota
            $newresult = array();
            $newheader = array();
            if(empty($queryresult)){
                foreach($tablearraylastreq['headers'] as $field=>$attr){
                    $newheader[$field] = $tablearraylastreq['headers'][$field];
                    $newresult[0][$field] = '';
                }
                foreach($tablearray['formfields'] as $input=>$attr){
                    $newheader[$input]= $attr['label'];
                    $newresult[0][$input] = '';
                }
            }

            // qui x selezionare inventario da ultimo mese
            $select = 'INV_IL_ID, IL_inventorydate, INV_PRS_ID, INV_endinv';
            $month = date('m') - 1;
            $CIdb->select($select)->from('inventory_view')->where('MONTH(IL_inventorydate)', $month);
            $pastinv = $CIdb->get()->result();

            $pastinvmod = array();
            if(!empty($pastinv)){
                foreach($pastinv as $key=>$inv){
                    $prsid = $inv->INV_PRS_ID;
                    $endinv = $inv->INV_endinv;
                    $pastinvmod[$prsid] = $endinv;
                }
            }
            //iprint_r($pastinvmod);
            
        } else{ // se ho già fatto l'inventario faccio la query a inventory
            
            $tableheaders = $tablearrayinvdone['headers'];
            if(isset($tablearrayinvdone['select'])){
                $CIdb->select($tablearrayinvdone['select']);
            } else{
                $CIdb->select('*');
            }
            $CIdb->from($tablearrayinvdone['from']);
            $CIdb->where($tablearrayinvdone['wherefield'], $wah['id']);
            $queryresult = $CIdb->get()->result();
        }
        
        
        //iprint_r($queryresult);
        
        // da qui in poi per richieste non nulle
        $header = array();
        $result = array();
        $categories = array(); // array x categorie

        foreach($queryresult as $rownumb=>$prod){
            $prsid = $prod->STO_PRS_ID;
            foreach($prod as $field=>$value){
                if($rownumb == 0){
                    if(isset($tableheaders)){
                        if(array_key_exists($field, $tableheaders)){
                            $header[$field] = $tableheaders[$field];                        
                        }  
                    } else{
                        $header[$field] = $field; 
                    }

                   // pesco campi input
                    foreach($tablearray['formfields'] as $input=>$attr){
                        $header[$input]= $attr['label'];
                    }
    
                }
                // formato psw
                if(isset($tablearray['psw']) && in_array($field, $tablearray['psw'])){
                    $value = str_repeat("*", strlen($value));
                    $prod->$field = $value; 
                }

                // formato integer se possibile
                if(isset($tablearray['int']) && in_array($field, $tablearray['int'])){
                    $value = substr($value, -2) == ".0" ? substr($value, 0, -2) : $value;
                    $prod->$field = $value;
                }

                

                 // se ho campo select
                 if(isset($tablearraylastreq['selectform']) && array_key_exists($field, $tablearraylastreq['selectform'])){	
                    $options = $tablearraylastreq['selectform'][$field];
                    // mi pesco le categorie  
                    $categories[$value] =  $options[$value];                  
                    $value = $options[$value];
                }

                if(isset($tableheaders)){
                    if(array_key_exists($field, $tableheaders)){//vengono selezionati solo quelli che sono nell'array 'tableheaders'
                        //cond campi booleani attivo/non attivo
                        if(isset($tablearraylastreq['boolean']) && array_key_exists($field, $tablearraylastreq['boolean'])){	// se ho campo booleano
                            $options = $tablearraylastreq['boolean'][$field];
                            $value = $options[$value];
                        }
                        // fine campo booleano
                       
                       
                        if($field == 'totrequests'){
                            $inputdata = array(
                                'name'  => 'totrequests_'.$prsid,
                                'id'    => 'totrequests_'.$prsid,
                                'class' => 'form-control totrequests',
                                'readonly' => true,
                                'value' => $value,
                            );
                            $result[$rownumb]['totrequests'] = form_input($inputdata);
                        } else{
                            $result[$rownumb][$field] = $value;	
                        }                       				
                    } 
                                           
                } else{
                    $result[$rownumb][$field] = $value;	// inserisco i nomi dei campi della tabella anche come key nel caso in seguito dovessi cambiare i titoli in frontend, in questo modo nonn perdo i riferimenti
                }
               
                
                
            }
            // formfields
            $product = get_object_vars($prod);
            //iprint_r($product);
            foreach($tablearray['formfields'] as $input=>$attr){
                if(isset($pastinvmod) && !empty($pastinvmod)){
                    if($input == 'begininv'){
                        if(isset($pastinvmod[$prsid])){
                            $value = $pastinvmod[$prsid];
                            // formato integer
                            $value = substr($value, -2) == ".0" ? substr($value, 0, -2) : $value;
                            $attr['value'] = $value;
                        } 
                    }
                }
                foreach($attr as $key=>$val){
                    if($key == 'name' || $key == 'id'){
                        $newval = $val.$prsid;
                        $attr[$key] = $newval;
                    }
                    if($key == 'class'){
                        $cat = $prod->PRO_procategory;
                        // pesco le option della select x attribuire i nomi
                        $options = $tablearraylastreq['selectform']['PRO_procategory'];
                        $catname =  $options[$cat]; 
                        $lcatname = strtolower($catname);               
                        $newval = $val.' '.$lcatname;
                        $attr[$key] = $newval;
                    }
                    if(array_key_exists($input, $product)){
                        $value = $product[$input];
                        $attr['value'] = $value;
                    }
                }
                $result[$rownumb][$input] = form_input($attr);
            }          
        }      
        
        //iprint_r($result);
       
        foreach($result as $rownumb=>$value){
            foreach($tableheaders as $field=>$label){
                //echo $field;
                $newresult[$rownumb][$field] = $value[$field];
                $newheader[$field] = $header[$field];
            }
        }
        
        $result = $newresult;
        $header = $newheader;
        /*iprint_r($header);
        iprint_r($result);*/
       
        //assegno l'header
		$this->table->set_heading($header);
		//print_r($header);

		//assegno il template alla tabella
		$this->table->set_template($metatemplate);
		
		//genero la tabella
        echo $this->table->generate($result);

        $dataarray = array();
        $dataarray['categories'] = $categories;
        
        if(isset($ilid)){
            $dataarray['ilid'] = $ilid;  
        }
        
        return($dataarray);
        
    }
    public function inventory_r_view_totcat($ilid){
        $CIdb = $this->CIdb();
        $CIdb->select('*')->from('inventory_cat')->where('IC_IL_ID', $ilid);
        $result = $CIdb->get()->result();
        $totcat = array();
        foreach($result as $key=>$cat){
            $num = $cat->IC_CAT_ID;
            $value = $cat->IC_catinventory;
            $totcat[$num] = $value;
        }
        $CIdb = $this->CIdb();
        $CIdb->select('*')->from('inventory_list')->where('IL_ID', $ilid);
        $result = $CIdb->get()->result();
        //iprint_r($result);
        foreach($result as $key=>$cat){
            $tot = $cat->IL_inventorytot;           
            $totcat['tot'] = $tot;
        }
        return($totcat);
    }
    public function vecchio_inventory_r_view_tot($metatemplate, $regtab, $tablearray, $wah){
        /*$CIdb = $this->CIdb();
        $tablearraylastreq = $tablearray['lastrequests_view']['tot'];
        $tablearrayinvdone = $tablearray['inventorydone_view']['tot'];
        $wahid = $wah['id'];
        
        // query per ctrl se è già stato fatto l'inventario oppure no
        $query = "SELECT `IL_ID`, `IL_inventorydate` FROM `inventory_list` WHERE YEAR(`IL_inventorydate`) = YEAR(curdate()) AND MONTH(`IL_inventorydate`) = MONTH(curdate()) AND `IL_WAH_ID`= $wahid";
        $query = $CIdb->query($query);
        foreach($query->result() as $row){
            foreach($row as $field=>$value){
                if($field == 'IL_ID'){
                    $ilid = $value;
                }               
            }
        }
        if(!isset($ilid)){
            // query a last request se non ho già fatto l'inventario
            if(isset($tablearraylastreq['select'])){
                $CIdb->select($tablearraylastreq['select']);
            } else{
                $CIdb->select('*');
            }
            $CIdb->from($tablearraylastreq['from']);
            $CIdb->where($tablearraylastreq['wherefield'], $wah['id']);
            
            $queryresult = $CIdb->get()->result();

            //SE RICHIESTE VUOTE
            // richiamo già qui gli array che poi passerò alla fine alla library perchè mi servono in caso di richieste nulle, compilo l'array per non avere errori e avere una tabella vuota
            $newresult = array();
            $newheader = array();
            if(empty($queryresult)){
                foreach($tablearraylastreq['headers'] as $field=>$attr){
                    $newheader[$field] = $tablearraylastreq['headers'][$field];
                    $newresult[0][$field] = '';
                }
            }
        } else{
            if(isset($tablearrayinvdone['select'])){
                $CIdb->select($tablearrayinvdone['select']);
            } else{
                $CIdb->select('*');
            }
            
            $CIdb->from($tablearrayinvdone['from']);
            $CIdb->where($tablearrayinvdone['wherefield'], $wah['id']);
            $queryresult = $CIdb->get()->result();
        }

        iprint_r($queryresult);

        $result = $newresult;
        $header = $newheader;
        /*iprint_r($header);
        iprint_r($result);*/
       
        //assegno l'header
		/*$this->table->set_heading($header);
		//print_r($header);

		//assegno il template alla tabella
		$this->table->set_template($metatemplate);
		
		//genero la tabella
        echo $this->table->generate($result);*/
       
    }
    /*public function inventory_r_view_tot(){
        
    }*/
    

    public function inventory_r_submit($dataprs, $gendata, $gentablearray, $invtablearray, $cattablearray){
        //iprint_r($dataprs);
        //iprint_r($gendata);

        $CIdb = $this->CIdb();

        if(!isset($gendata['ilid'])){
           
            //insert in inventory_list
            $datatoinsert = array();
            foreach($gentablearray['fields'] as $field=>$attr){
                $nome = $attr['name'];
                if(array_key_exists($attr['name'], $gendata)){
                    $datatoinsert[$field] = $gendata[$nome];
                }
            }
            //iprint_r($datatoinsert);
            $CIdb->insert('inventory_list', $datatoinsert);
            //end insert in inventory_list

            

            // pesco IL_ID appena inserito
            $wahid = $gendata['wahid'];
            $searchinvid = "SELECT `IL_ID` FROM `inventory_list` WHERE `IL_WAH_ID` = $wahid AND YEAR(`IL_inventorydate`) = YEAR(curdate()) AND MONTH(`IL_inventorydate`) = MONTH(curdate())";
            $query = $CIdb->query($searchinvid);
            foreach($query->result() as $row){
                foreach($row as $ilid=>$value){
                    $ilid = $value;
                }
            }

            // categorie inventory_cat     
            foreach($cattablearray as $ckey=>$cname){
                $lname = strtolower($cname);
                $datatoinsert = array();
                if(array_key_exists($lname, $gendata)){
                    $datatoinsert['IC_IL_ID'] = $ilid;
                    $datatoinsert['IC_CAT_ID'] = $ckey;
                    $datatoinsert['IC_catinventory'] = $gendata[$lname];
                    $CIdb->insert('inventory_cat', $datatoinsert);
                }
            }
            // fine categorie

            // insert in inventory
            $datatoinsert = array();
            foreach($dataprs as $prsid=>$dati){
                if($prsid!=='length'){
                    foreach($invtablearray['fields'] as $field=>$attr){
                        if(array_key_exists($attr['name'], $dati)){
                            $datatoinsert['INV_PRS_ID'] = $prsid;
                            $datatoinsert[$field] = $dati[$attr['name']];
                        }
                    }
                    $datatoinsert['INV_IL_ID'] = $ilid;
                    $CIdb->insert('inventory', $datatoinsert);
                }          
            }
            // end insert in inventory
        } else{

            // categorie inventory_cat     
            foreach($cattablearray as $ckey=>$cname){
                $lname = strtolower($cname);
                $datatoinsert = array();
                if(array_key_exists($lname, $gendata)){
                    $wherearray = array(
                        'IC_IL_ID' => $gendata['ilid'],
                        'IC_CAT_ID' => $ckey,
                    );
                    $datatoinsert['IC_catinventory'] = $gendata[$lname];
                    $CIdb->where($wherearray)->update('inventory_cat', $datatoinsert); 
                }
            }
            // fine categorie

            //modifica totale
            $datatoinsert = array(
                'IL_inventorytot' => $gendata['totale'],
            );
            $wherearray = array(
                'IL_ID' => $gendata['ilid'],
            );
            $CIdb->where($wherearray)->update('inventory_list', $datatoinsert); 
            //fine modifica totale


            $datatoinsert = array();
            foreach($dataprs as $prsid=>$dati){
                if($prsid!=='length'){
                    foreach($invtablearray['fields'] as $field=>$attr){
                        if(array_key_exists($attr['name'], $dati)){
                            $datatoinsert['INV_PRS_ID'] = $prsid;
                            $datatoinsert[$field] = $dati[$attr['name']];
                        }
                    }
                    $wherearray = array(
                        'INV_IL_ID' => $gendata['ilid'],
                        'INV_PRS_ID' => $prsid,
                    );            
                    $CIdb->where($wherearray)->update('inventory', $datatoinsert);   
                }          
            }
            // DA SISTEMARE CAT ID
        }
        //iprint_r($datatoinsert);        
    }
    public function inventory_c_choose_view(){
        $CIdb = $this->CIdb();
        $datachoose = array();

        //choose wah
        $repwah = $CIdb->select('*')->from('warehouses')->where('WAH_wahcategory', 1)->get()->result();
        //iprint_r($repwah);
        $wahlist = array();
        foreach($repwah as $numb=>$wah){
            $wahid = $wah->WAH_ID;
            $wahname = $wah->WAH_wahname;
            $wahlist[$wahid] = $wahname;
        }
        //iprint_r($wahlist);
        $datachoose['wahlist'] = $wahlist;

        // choose date
        $inv= $CIdb->select('*')->from('inventory_c_list')->get()->result();
        $invlist = array();
        foreach($inv as $numb=>$inv){
            $id = $inv->IL_ID;
            $date = $inv->IL_inventorydate;
            $wah = $inv->IL_WAH_ID;
            $invlist[$id] = array(
                'wah' => $wah,
                'date' => $date,
            );
        }
        $datachoose['invlist'] = $invlist; 
        return($datachoose);
    }
    public function inventory_c_view($metatemplate, $regtab, $tablearray, $wah){
        $CIdb = $this->CIdb();
        $tablearraylastreq = $tablearray['consumption_lastyear_view']; // lasciato nome vecchio x reparti ma cambiato la chiave del json
        $tablearrayinvdone = $tablearray['inventorydone_c_view'];   // come sopra
        $wahid = $wah['id'];

        // query per ctrl se è già stato fatto l'inventario oppure no
        $query = "SELECT `ILC_ID`, `ILC_inventorydate` FROM `inventory_c_list` WHERE YEAR(`ILC_inventorydate`) = YEAR(curdate()) AND MONTH(`ILC_inventorydate`) = MONTH(curdate()) AND `ILC_WAH_ID`= $wahid";
        $query = $CIdb->query($query);
        foreach($query->result() as $row){
            foreach($row as $field=>$value){
                if($field == 'ILC_ID'){
                    $ilid = $value;
                }               
            }
        }
        // fine query x inventario


        //QUERY AL DB PER AVERE LISTA PRODOTTI INVENTARIO
        if(!isset($ilid)){ // se non ho già fatto l'inventario faccio la query a lastrequests
            //echo 'ciao';
            $tableheaders = $tablearraylastreq['headers'];
            // query a last request se non ho già fatto l'inventario
            if(isset($tablearraylastreq['select'])){
                $CIdb->select($tablearraylastreq['select']);
            } else{
                $CIdb->select('*');
            }
            $CIdb->from($tablearraylastreq['from']);
            $CIdb->where($tablearraylastreq['wherefield'], $wah['id']);
            $queryresult = $CIdb->get()->result();

            //SE RICHIESTE VUOTE
            // richiamo già qui gli array che poi passerò alla fine alla library perchè mi servono in caso di richieste nulle, compilo l'array per non avere errori e avere una tabella vuota
            $newresult = array();
            $newheader = array();
            if(empty($queryresult)){
                foreach($tablearraylastreq['headers'] as $field=>$attr){
                    $newheader[$field] = $tablearraylastreq['headers'][$field];
                    $newresult[0][$field] = '';
                }
                foreach($tablearray['formfields'] as $input=>$attr){
                    $newheader[$input]= $attr['label'];
                    $newresult[0][$input] = '';
                }
            }

            // qui x selezionare inventario da ultimo mese
            $select = 'INV_IL_ID, IL_inventorydate, INV_PRS_ID, INV_endinv';
            $month = date('m') - 1;
            $CIdb->select($select)->from('inventory_view')->where('MONTH(IL_inventorydate)', $month);
            $pastinv = $CIdb->get()->result();

            $pastinvmod = array();
            if(!empty($pastinv)){
                foreach($pastinv as $key=>$inv){
                    $prsid = $inv->INV_PRS_ID;
                    $endinv = $inv->INV_endinv;
                    $pastinvmod[$prsid] = $endinv;
                }
            }
            //iprint_r($pastinvmod);
            
        } else{ // se ho già fatto l'inventario faccio la query a inventory
            
            $tableheaders = $tablearrayinvdone['headers'];
            if(isset($tablearrayinvdone['select'])){
                $CIdb->select($tablearrayinvdone['select']);
            } else{
                $CIdb->select('*');
            }
            $CIdb->from($tablearrayinvdone['from']);
            $CIdb->where($tablearrayinvdone['wherefield'], $wah['id']);
            $queryresult = $CIdb->get()->result();
        }
        
        
        //iprint_r($queryresult);
        
        // da qui in poi per richieste non nulle
        $header = array();
        $result = array();
        $categories = array(); // array x categorie

        foreach($queryresult as $rownumb=>$prod){
            $prsid = $prod->STO_PRS_ID;
            foreach($prod as $field=>$value){
                if($rownumb == 0){
                    if(isset($tableheaders)){
                        if(array_key_exists($field, $tableheaders)){
                            $header[$field] = $tableheaders[$field];                        
                        }  
                    } else{
                        $header[$field] = $field; 
                    }

                   // pesco campi input
                    foreach($tablearray['formfields'] as $input=>$attr){
                        $header[$input]= $attr['label'];
                    }
    
                }
                // formato psw
                if(isset($tablearray['psw']) && in_array($field, $tablearray['psw'])){
                    $value = str_repeat("*", strlen($value));
                    $prod->$field = $value; 
                }

                // formato integer se possibile
                if(isset($tablearray['int']) && in_array($field, $tablearray['int'])){
                    $value = substr($value, -2) == ".0" ? substr($value, 0, -2) : $value;
                    $prod->$field = $value;
                }

                

                 // se ho campo select
                 if(isset($tablearraylastreq['selectform']) && array_key_exists($field, $tablearraylastreq['selectform'])){	
                    $options = $tablearraylastreq['selectform'][$field];
                    // mi pesco le categorie  
                    $categories[$value] =  $options[$value];                  
                    $value = $options[$value];
                }

                if(isset($tableheaders)){
                    if(array_key_exists($field, $tableheaders)){//vengono selezionati solo quelli che sono nell'array 'tableheaders'
                        //cond campi booleani attivo/non attivo
                        if(isset($tablearraylastreq['boolean']) && array_key_exists($field, $tablearraylastreq['boolean'])){	// se ho campo booleano
                            $options = $tablearraylastreq['boolean'][$field];
                            $value = $options[$value];
                        }
                        // fine campo booleano
                       
                       
                        if($field == 'totrequests'){
                            $inputdata = array(
                                'name'  => 'totrequests_'.$prsid,
                                'id'    => 'totrequests_'.$prsid,
                                'class' => 'form-control totrequests',
                                'readonly' => true,
                                'value' => $value,
                            );
                            $result[$rownumb]['totrequests'] = form_input($inputdata);
                        } else{
                            $result[$rownumb][$field] = $value;	
                        }                       				
                    } 
                                           
                } else{
                    $result[$rownumb][$field] = $value;	// inserisco i nomi dei campi della tabella anche come key nel caso in seguito dovessi cambiare i titoli in frontend, in questo modo nonn perdo i riferimenti
                }
               
                
                
            }
            // formfields
            $product = get_object_vars($prod);
            //iprint_r($product);
            foreach($tablearray['formfields'] as $input=>$attr){
                if(isset($pastinvmod) && !empty($pastinvmod)){
                    if($input == 'begininv'){
                        if(isset($pastinvmod[$prsid])){
                            $value = $pastinvmod[$prsid];
                            // formato integer
                            $value = substr($value, -2) == ".0" ? substr($value, 0, -2) : $value;
                            $attr['value'] = $value;
                        } 
                    }
                }
                foreach($attr as $key=>$val){
                    if($key == 'name' || $key == 'id'){
                        $newval = $val.$prsid;
                        $attr[$key] = $newval;
                    }
                    if($key == 'class'){
                        $cat = $prod->PRO_procategory;
                        // pesco le option della select x attribuire i nomi
                        $options = $tablearraylastreq['selectform']['PRO_procategory'];
                        $catname =  $options[$cat]; 
                        $lcatname = strtolower($catname);               
                        $newval = $val.' '.$lcatname;
                        $attr[$key] = $newval;
                    }
                    if(array_key_exists($input, $product)){
                        $value = $product[$input];
                        $attr['value'] = $value;
                    }
                }
                $result[$rownumb][$input] = form_input($attr);
            }          
        }      
        
        //iprint_r($result);
       
        foreach($result as $rownumb=>$value){
            foreach($tableheaders as $field=>$label){
                //echo $field;
                $newresult[$rownumb][$field] = $value[$field];
                $newheader[$field] = $header[$field];
            }
        }
        
        $result = $newresult;
        $header = $newheader;
        /*iprint_r($header);
        iprint_r($result);*/
       
        //assegno l'header
		$this->table->set_heading($header);
		//print_r($header);

		//assegno il template alla tabella
		$this->table->set_template($metatemplate);
		
		//genero la tabella
        echo $this->table->generate($result);

        $dataarray = array();
        $dataarray['categories'] = $categories;
        
        if(isset($ilid)){
            $dataarray['ilid'] = $ilid;  
        }
        
        return($dataarray);
    }
}