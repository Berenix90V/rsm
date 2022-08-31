<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Totrequests_model extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    public function CIdb() {
        $var = new dbload;
        $CIdb = $var->CIdb;
        return $CIdb;
    }
    public function totrequeststable_view($metatemplate, $regtab, $tablearray) { // parametri passati dalla view precedente la 1
		$CIdb = $this->CIdb();
		
        // ricavo i parametri della tabella
        if(isset($tablearray['pre'])){
			$tableheaders = $tablearray['pre'];
		}
		
		if(isset($tablearray['tableheaders'])){
			$tableheaders = $tablearray['tableheaders'];
		}
		
		//QUERY AL DB

		//select a seconda che sia settata o meno l'opzione select
		if(isset($tablearray['selectfields'])){
			$CIdb->select($tablearray['selectfields']);
		} else{
			$CIdb->select('*');
		}
        
		$CIdb->from($regtab);

		//order a seconda che sia settata o meno l'opzione orderfield
		if(isset($tablearray['orderfield'])){
			$CIdb->order_by($tablearray['orderfield']);
		}

		$CIregistryquery = $CIdb->get()->result();
		/// FINE QUERY
		
        
        //costruisco la tabella definendo gli array di base come il corpo "result" e l'header "header"
		$result = array();
		$header = array();
		//genero l'array della tabella
		foreach ($CIregistryquery as $key => $value) {

			foreach ($value as $k => $v) {
				if ($key == 0) { // generazione header da prima riga

					// assegnazione titoli headers
					if(isset($tablearray['tableheaders'])){		// vengono selezionati solo quelli che sono nell'array 'tableheaders'
						if(array_key_exists($k, $tableheaders)){
							$header[$k] = $tableheaders[$k];
						} 
					} else{
						$header[$k] = $k; // inserisco i nomi dei campi della tabella anche come key nel caso in seguito dovessi cambiare i titoli in frontend, in questo modo nonn perdo i riferimenti
					}
					
				} 
				
				if(isset($tablearray['tableheaders'])){
					if(array_key_exists($k, $tableheaders)){	//vengono selezionati solo quelli che sono nell'array 'tableheaders'
						
						// formato psw
						if(isset($tablearray['psw']) && in_array($k, $tablearray['psw'])){
							$v = str_repeat("*", strlen($v)); 
						}

						// formato integer se possibile
						//iprint_r($tablearray);
						if(isset($tablearray['int']) && in_array($k, $tablearray['int'])){
							$v = substr($v, -2) == ".0" ? substr($v, 0, -2) : $v;
						}

						//cond campi booleani attivo/non attivo
						if(isset($tablearray['boolean']) && array_key_exists($k, $tablearray['boolean'])){	// se ho campo booleano
							$options = $tablearray['boolean'][$k];
							$v = $options[$v];
						}
						// fine campo booleano

						$result[$key][$k] = $v;					
					} 
				} else{
					$result[$key][$k] = $v;	// inserisco i nomi dei campi della tabella anche come key nel caso in seguito dovessi cambiare i titoli in frontend, in questo modo nonn perdo i riferimenti
				}						
            } 
			
			// sistemato pwahconfirm a seconda delle quantità
            $v = $result[$key]['REQ_pwahconfirm'];
            if($value->REQ_pwahconfirm == $value->REQ_reqquantity ){
                $v = '<span " class="btn btn-success btn-circle"><i><strong>'.$v.'</strong></i></span>';
                $result[$key]['REQ_pwahconfirm'] = $v;
            } elseif(is_null($value->REQ_pwahconfirm)){
				$result[$key]['REQ_pwahconfirm'] = '<span class="confirmed" style="color: #36b9cc"><i class="fas fa-pause"></i> In Coda </span>';
            } else{
				$v = '<span " class="btn btn-warning btn-circle"><i><strong>'.$v.'</strong></i></span>';
                $result[$key]['REQ_pwahconfirm'] = $v;
			}

			// sistemato rwahconfirm a seconda dello status
           $v = $result[$key]['REQ_rwahconfirm'];
            if($v== 1 ){
				$result[$key]['REQ_rwahconfirm'] = '<span class="confirmed" style="color: #1cc88a"><i class="fas fa-check"></i> Confermato</span>';
			} elseif(is_null($v) && !is_null($value->REQ_pwahconfirm)){
                $result[$key]['REQ_rwahconfirm'] = '<span class="confirmed" style="color: #36b9cc"><i class="fas fa-pause"></i> In Coda </span>';
			} else{
                $result[$key]['REQ_rwahconfirm'] = $v;
			}
			
		
            //iprint_r($value);
            
					
		}
		

		//assegno l'header
		$this->table->set_heading($header);

		//assegno il template alla tabella
		$this->table->set_template($metatemplate);
		
		//genero la tabella
        echo $this->table->generate($result);
	}
}