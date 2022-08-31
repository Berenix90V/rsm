<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Inrequests_model extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    public function CIdb() {
        $var = new dbload;
        $CIdb = $var->CIdb;
        return $CIdb;
    }
    public function inrequeststable_view($metatemplate, $regtab, $tablearray, $table, $wah, $userrole) { // parametri passati dalla view precedente la 1
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
		if($wah !== 'choose'){
			if($wah['id'] !== 'choose'){
				$wherearray = array(
					'REQ_prowahid' => $wah['id'],
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
							if($k == 'REQ_pwahconfirm'){
								$header['pconfirm'] = $tableheaders['pconfirm'];
							}
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
						if($k == 'REQ_pwahconfirm'){
							//aggiungo i pulsanti per l'editing
							$idfield = $tablearray['id'];           
							$key1 = $value->$idfield;
							//iprint_r($value);
							
							//assegno le icone per edit e delete
							$v = $value->REQ_pwahconfirm;	
							$v = substr($v, -2) == ".0" ? substr($v, 0, -2) : $v;
							//da vedere se crea problemi l'aver tolto wahid
							//$editicon = '<a href="'.site_url('Inrequests/inrequests_pedit?ref='.$key1.'&wah='.$wah['id']).'" class="btn btn-warning btn-circle"><i class="fas fa-edit"></i></a>';
							$editicon = '<a href="'.site_url('Inrequests/inrequests_pedit?ref='.$key1).'" class="btn btn-warning btn-circle"><i class="fas fa-edit"></i></a>';
					
							if(($wah !=='choose' && $value->REQ_prowahid == $wah['id']) || ($userrole == 'admin')){
								//$confirmicon = '<a href="'.site_url('Inrequests/inrequests_pconfirm?ref='.$key1.'&wah='.$wah['id']).'" class="btn btn-success btn-circle"><i class="fas fa-check"></i></a>';
								$confirmicon = '<a href="'.site_url('Inrequests/inrequests_pconfirm?ref='.$key1).'" class="btn btn-success btn-circle"><i class="fas fa-check"></i></a>';
								if(is_null($value->REQ_rwahconfirm)){
									if(is_null($value->REQ_pwahconfirm)){
										$result[$key]['pconfirm'] = $editicon.$confirmicon;
										//$result[$key]['REQ_pwahconfirm'] = $confirmicon.$editicon;
									} else{
										//$result[$key]['REQ_pwahconfirm'] = $editicon. ' '.$v;
										$result[$key]['pconfirm'] = $editicon;
									}
								} else{
									$result[$key]['pconfirm'] = '';
								}	
								
							} else{
							/* $confirmicon = '<a href="'.site_url('Inrequests/inrequests_pconfirm?ref='.$key1).'" class="btn btn-success btn-circle"><i class="fas fa-check"></i></a>';
								$editicon = '<a href="'.site_url('Inrequests/inrequests_pedit?ref='.$key1).'" class="btn btn-warning btn-circle"><i class="fas fa-edit"></i></a>';*/
								$result[$key]['pconfirm'] = '';
							}	

						}	
						
						// sistemato rwahconfirm a seconda dello status
						if($k == 'REQ_rwahconfirm'){
							if($v== 1 ){
								$result[$key]['REQ_rwahconfirm'] = '<span class="confirmed" style="color: #1cc88a"><i class="fas fa-check"></i> Confermato</span>';
							} elseif(is_null($v) && !is_null($value->REQ_pwahconfirm)){
								$result[$key]['REQ_rwahconfirm'] = '<span class="confirmed" style="color: #36b9cc"><i class="fas fa-pause"></i> In Coda </span>';
							} else{
								$result[$key]['REQ_rwahconfirm'] = $v;
							}				
						}	
							
					} 
				} else{
					$result[$key][$k] = $v;	// inserisco i nomi dei campi della tabella anche come key nel caso in seguito dovessi cambiare i titoli in frontend, in questo modo nonn perdo i riferimenti
				}						
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
	public function inrequests_psubmit($tablearray, $ref){
		$CIdb = $this->CIdb();
		$table = $tablearray['from'];
		$wherearray = array(
			$tablearray['wherefield'] => $ref
		);
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
				}
			}
		}
		//iprint_r($datatoinsert);
		
		// query x inserimento
		$CIdb->set($datatoinsert)->where($wherearray)->update($table);
	}
	public function inrequests_pedit($tablearray, $ref){
		$CIdb = $this->CIdb();
		$wherearray = array(
			$tablearray['wherefield'] => $ref
		);
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
				if(isset($tablearray['int']) && in_array($field, $tablearray['int'])){
					$value = substr($value, -2) == ".0" ? substr($value, 0, -2) : $value;
				}
				
				if(array_key_exists($field, $tablearray['formfields'])){
					$tablearray['formfields'][$field]['value'] = $value;
				}
				if(array_key_exists($field, $tablearray['hiddenfields'])){
					$tablearray['hiddenfields'][$field] = $value;
				}
			}
		}
		return($tablearray);
	}
	public function inrequests_peditsubmit($data, $formfields){
		$CIdb = $this->CIdb();
		$table = $data['table'];
		$id = $formfields['id'];
 		$wherearray = array(
			$id=> $data[$id], 
		);		

		//seleziono campi da inserire con ctrl incrociato tra formfields e data
		foreach($formfields['formfields'] as $field=>$par){
			if(array_key_exists($par['name'], $data)){
				$fieldname = $par['name'];
				$datatoupdate[$field] = $data[$fieldname];
			}
		}
		

		//seleziono campi nascosti da inserire con ctrl incrociato tra formfields e data
		foreach($formfields['hiddenfields'] as $field=>$value){
			if(array_key_exists($field, $data) && substr($field, 0, 3) == $formfields['pre']){
				$datatoupdate[$field] = $data[$field];
			}
		}

		// query x inserimento		
		$CIdb->set($datatoupdate)->where($wherearray)->update($table);
		
	}
	public function inrequests_choose_wahcen($formfields){ // scegli magazzino reparto
		$CIdb = $this->CIdb();

		$wherearray = array(
			'WAH_active' => 1,
			'WAH_wahcategory' => 1,
		);
		//QUERY AL DB
		//select a seconda che sia settata o meno l'opzione select
		if(isset($formfields['select'])){
			$CIdb->select($formfields['select']);
		} else{
			$CIdb->select('*');
		}
		$CIdb->from($formfields['from']);
		
		$CIdb->where($wherearray);
		$CIdb->order_by($formfields['orderby']);
		$result = $CIdb->get()->result();
		//iprint_r($result);
		$wahlist= array();
		foreach($result as $key=>$listf){
			$sid = $listf->WAH_ID;
			$name = $listf->WAH_wahname; 
			$wahlist[$sid] = $name;	
		}
		return($wahlist);
	}
	public function inrequests_choose_wah($formfields){ // scegli magazzino reparto
		$CIdb = $this->CIdb();

		$wherearray = array(
			'WAH_active' => 1,
			'WAH_wahcategory' => 2,
		);
		//QUERY AL DB
		//select a seconda che sia settata o meno l'opzione select
		if(isset($formfields['select'])){
			$CIdb->select($formfields['select']);
		} else{
			$CIdb->select('*');
		}
		$CIdb->from($formfields['from']);
		
		$CIdb->where($wherearray);
		$CIdb->order_by($formfields['orderby']);
		$result = $CIdb->get()->result();
		//iprint_r($result);
		$wahlist= array();
		foreach($result as $key=>$listf){
			$sid = $listf->WAH_ID;
			$name = $listf->WAH_wahname; 
			$wahlist[$sid] = $name;	
		}
		return($wahlist);
	}
	public function inrequests_wah_table($metatemplate, $tablearray, $wahid, $wah){
		$CIdb = $this->CIdb();

		$wherearray = array(
			'REQ_reqwahid' => $wahid,
		);
		
		if(isset($tablearray['select'])){
			$CIdb->select($tablearray['select']);
		} else{
			$CIdb->select('*');
		}
		$CIdb->from('requests_view');
		$CIdb->where($wherearray);
		$CIdb->where('REQ_rwahconfirm', NULL, FALSE);
		$resultq = $CIdb->get()->result();

		//iprint_r($resultq);
		$header = array();
		$result = array();

		// filtro per magazzino

		foreach($resultq as $rownumb=>$req){
			//$prsid = $req->PRS_ID;
			if($rownumb == 0){
				foreach($req as $field=>$value){
					//echo $field;
					if(array_key_exists($field, $tablearray['headers'])){
						$header[$field] = $tablearray['headers'][$field];
					}					
				}
				foreach($tablearray['formfields'] as $input=>$attr){
					$header[$input]= $attr['label'];
				}
			}

			foreach($req as $field=>$value){
				//integer
				if(isset($tablearray['int']) && in_array($field, $tablearray['int'])){
                    $value = substr($value, -2) == ".0" ? substr($value, 0, -2) : $value;
                    $req->$field = $value;
                }

				if(array_key_exists($field, $tablearray['headers'])){
					$result[$rownumb][$field] = $value;
				}				
			}

			$requests = get_object_vars($req);

			foreach($tablearray['formfields'] as $input=>$attr){
				foreach($attr as $key=>$val){
					if($key == 'name' || $key == 'id'){
						$newval = $val.'_'.$rownumb;
						$attr[$key] = $newval;
					}
					if(array_key_exists($input, $requests)){
						$value = $requests[$input];
						$attr['value'] = $value;
					}
				}
				$result[$rownumb][$input] = form_input($attr);
			} 
		}
		

		//assegno l'header
		$this->table->set_heading($header);
		//print_r($header);

		//assegno il template alla tabella
		$this->table->set_template($metatemplate);
		
		//genero la tabella
        echo $this->table->generate($result);
	}
	public function inrequests_batchsubmit($data, $wah, $formfields){
		//iprint_r($data);
		$CIdb = $this->CIdb();		
		
		$rowarray = array();
		// divido in righe
		foreach($data as $key=>$value){
			if(strpos($key, '_')){
				$keyexpl = explode('_', $key);
				$num = $keyexpl[1];
				$field = $keyexpl[0];
				$rowarray[$num][$field] = $value;
			}
		}
		
		//iprint_r($rowarray);
		// cfr con ff
		$datatoinsert = array();
		foreach($rowarray as $num => $row){
			foreach($row as $field => $value){
				if(array_key_exists($field, $formfields)){
					$fieldrname = $formfields[$field];
					$datatoinsert[$fieldrname] = $row[$field];
				} 
			}
			
			if($datatoinsert['REQ_pwahconfirm'] !== ''){ 
				$datatoupdate = array(
					'REQ_pwahconfirm' => $datatoinsert['REQ_pwahconfirm'],
				);
				$wherearray = array(
					'REQ_ID' => $datatoinsert['REQ_ID'],
				);				
				$CIdb->set($datatoinsert)->where($wherearray)->update('requests');      				 
			}
			//iprint_r($datatoinsert);			
		}
	}
	public function inrequests_wahcenlist(){
		$CIdb = $this->CIdb();	
		$CIdb->select('WAH_ID, WAH_wahname, WAH_wahcategory')->from('warehouses')->where('WAH_wahcategory', 1);
		$result = $CIdb->get()->result();
		$wahcenlist = array(
			'choose' => 'Scegli magazzino'
		);
		foreach($result as $num=>$wah){
			$wahid = $wah->WAH_ID;
			$wahname = $wah->WAH_wahname;
			$wahcenlist[$wahid] = $wahname;
		}
		return($wahcenlist);
	}
}