<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Outrequests_model extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    public function CIdb() {
        $var = new dbload;
        $CIdb = $var->CIdb;
        return $CIdb;
    }
    public function outrequeststable_view($metatemplate, $regtab, $tablearray, $table, $wah, $userrole) { // parametri passati dalla view precedente la 1
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
		/*if($wah['id'] !== 'choose'){
			$wherearray = array(
				'REQ_reqwahid' => $wah['id'],
			);
			$CIdb->where($wherearray);
		}*/

		if($wah !== 'choose'){
			if($wah['id'] !== 'choose'){
				$wherearray = array(
					'REQ_reqwahid' => $wah['id'],
				);	
				$CIdb->where($wherearray);
			}		
		}

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
            // aggiusto se disponibilità minore della richiesta giallo, se combacia verde
            $v = $result[$key]['REQ_pwahconfirm'];
            if($value->REQ_pwahconfirm == $value->REQ_reqquantity ){
                $v = '<span class="btn btn-success btn-circle"><i><strong>'.$v.'</strong></i></span>';
                $result[$key]['REQ_pwahconfirm'] = $v;
            } else if(is_null($value->REQ_pwahconfirm)){
				$result[$key]['REQ_pwahconfirm'] = $v;
			}else{
                $v = '<span class="btn btn-warning btn-circle"><i><strong>'.$v.'</strong></i></span>';
                $result[$key]['REQ_pwahconfirm'] = $v;
			}
			

			
			//aggiungo i pulsanti per l'editing
            $idfield = $tablearray['id'];           
			$key1 = $value->$idfield;
            //iprint_r($value);
            
			//assegno le icone per edit e delete
			$v = $value->REQ_rwahconfirm;	
			
			if($userrole == 'admin' || $value->REQ_reqwahid == $wah['id'] && !is_null($value->REQ_pwahconfirm) ){
				$reqwahid = $value->REQ_reqwahid;
                $confirmicon = '<span class="toconfirm"><a href="'.site_url('Outrequests/outrequests_rconfirm?ref='.$key1.'&wah='.$reqwahid).'" class="btn btn-success btn-circle"><i class="fas fa-check"></i></a></span>';
				//$editicon = '<a href="'.site_url('Outrequests/outrequests_pedit?ref='.$key1.'&wah='.$wah['id']).'" class="btn btn-warning btn-circle"><i class="fas fa-edit"></i></a>';
				
				if(is_null($value->REQ_rwahconfirm)){
					$result[$key]['REQ_rwahconfirm'] = $confirmicon;
				} else{
					
					$result[$key]['REQ_rwahconfirm'] = '<span class="confirmed" style="color: #1cc88a"><i class="fas fa-check"></i> Confermato</span>';
				}
				
				
			} else{
               /* $confirmicon = '<a href="'.site_url('Inrequests/inrequests_pconfirm?ref='.$key1).'" class="btn btn-success btn-circle"><i class="fas fa-check"></i></a>';
				$editicon = '<a href="'.site_url('Inrequests/inrequests_pedit?ref='.$key1).'" class="btn btn-warning btn-circle"><i class="fas fa-edit"></i></a>';*/
				$result[$key]['REQ_rwahconfirm'] = '<span class="confirmed" style="color: #36b9cc"><i class="fas fa-pause"></i> In Coda </span>';
			}			
		}
		
		if(!empty($result)){
			//assegno l'header
			$this->table->set_heading($header);

			//assegno il template alla tabella
			$this->table->set_template($metatemplate);
			
			//genero la tabella
			echo $this->table->generate($result);
		} else{
			echo '<div class="no-data"> Nessun dato disponibile per il magazzino selezionato </div>';
		}
		
	}
	public function outrequests_rconfsubmit($tablearray, $ref){
		$CIdb = $this->CIdb();
		$table = $tablearray['from'];
		$wherearray = array(
			$tablearray['wherefield'] => $ref
		);
		//iprint_r($wherearray);
		if(isset($tablearray['select'])){
			$CIdb->select($tablearray['select']);
		} else{
			$CIdb->select('*');
		}
		$CIdb->from($tablearray['from']);
		$CIdb->where($wherearray);
		$result = $CIdb->get()->result();
		
		foreach($result as $key=>$row){
			foreach($row as $field=>$value){
				if(array_key_exists($field, $tablearray['formfields'])){
					if(isset($tablearray['formfields'][$field]['samevalue'])){
						$valore = $tablearray['formfields'][$field]['samevalue'];
						$datatoinsert[$field] = $row->$valore;
					}
					if(isset($tablearray['formfields'][$field]['value'])){
						$valore = $tablearray['formfields'][$field]['value'];
						$datatoinsert[$field] = $valore;
					}	
				}

				// SALVATAGGIO DATI PER SOTTRAZIONE
				//salvo sto id 
				if($field == 'REQ_STO_ID'){
					$reqstoid = $value;
				}
				// quantità ceduta
				if($field == 'REQ_pwahconfirm'){
					$pwahconfirm = $value;
				}
				//in magazzino
				if($field == 'STO_quantity'){
					$stoquantity = $value;
				}
			}
		}
		// query x inserimento
		$table = $tablearray['table'];
		$CIdb->set($datatoinsert)->where($wherearray)->update($table);

		// sottrazione alla quantità in magazzino
		//iprint_r($datatoinsert);
		$table = 'instock';
		$wherearray = array(
			'STO_ID' => $reqstoid,
		);
		$remain = $stoquantity - $pwahconfirm;
		$datatoinsert = array(
			'STO_quantity' => $remain,
		);
		$CIdb->set($datatoinsert)->where($wherearray)->update($table);

		//aggiorno consumption
		$table = 'consumption';
		$datatoinsert = array(
			'CON_STO_ID' => $reqstoid,
			'CON_minus' => $pwahconfirm,
			'CON_STO_date' => date("d-m-Y H:i:s"),
		);
		$CIdb->insert($table, $datatoinsert);


	}	
	public function outrequests_wahreplist(){
		
		$CIdb = $this->CIdb();	
		$CIdb->select('WAH_ID, WAH_wahname, WAH_wahcategory')->from('warehouses')->where('WAH_wahcategory', 2);
		$result = $CIdb->get()->result();
		$wahreplist = array(
			'choose' => 'Scegli magazzino'
		);
		foreach($result as $num=>$wah){
			$wahid = $wah->WAH_ID;
			$wahname = $wah->WAH_wahname;
			$wahreplist[$wahid] = $wahname;
		}
		return($wahreplist);
	}
}