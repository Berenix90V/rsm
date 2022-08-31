<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Requests_model extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    public function CIdb() {
        $var = new dbload;
        $CIdb = $var->CIdb;
        return $CIdb;
    }
    public function requeststable_view($metatemplate, $regtab, $tablearray, $table, $wah) { // parametri passati dalla view precedente la 1
		$CIdb = $this->CIdb();
		
        // ricavo i parametri della tabella
		
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
				
				//result
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
				} else{ // se nell'array non è settato tableheaders li dovrebbe prendere tutti
					$result[$key][$k] = $v;	// inserisco i nomi dei campi della tabella anche come key nel caso in seguito dovessi cambiare i titoli in frontend, in questo modo nonn perdo i riferimenti
				}						
			} 
			
			//aggiungo i pulsanti per l'editing sono fuori dal foreach dei campi
            $idfield = $tablearray['id'];
			$key1 = $value->$idfield;
			//iprint_r($value);
			
			
			//assegno le icone per edit e delete	
			if(!empty($wah) && $wah !=='choose'){
				$questionicon = '<a href="'.site_url('Requests/requests_addnew?ref='.$key1.'&wah='.$wah['id']).'" class="btn btn-warning btn-circle"><i class="fas fa-question"></i></a>';
			} else{
				$questionicon = '<a href="'.site_url('Requests/requests_addnew?ref='.$key1).'" class="btn btn-warning btn-circle"><i class="fas fa-question"></i></a>';
			}
			
			//$result[$key]['caricocarico'] = $caricoicon.$scaricoicon;
			$result[$key]['icons'] = $questionicon;
		}
		
		//$header['caricoscarico'] = 'Carico/Scarico';
		$header['icons'] = '';


		//assegno l'header
		$this->table->set_heading($header);
		//print_r($header);

		//assegno il template alla tabella
		$this->table->set_template($metatemplate);
		
		//genero la tabella
        echo $this->table->generate($result);
	}
	public function requests_addnew($tablearray, $ref, $wah){
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
				if(array_key_exists($field, $tablearray['conversion'])){
					$field = $tablearray['conversion'][$field];
				}
				if(array_key_exists($field, $tablearray['formfields'])){
					$tablearray['formfields'][$field]['value'] = $value;
				}
				if(array_key_exists($field, $tablearray['hiddenfields'])){
					$tablearray['hiddenfields'][$field] = $value;
				}				
			}
		}
		// aggiunta valore magazzino richiedente
		if($wah !== 'choose'){
			$tablearray['hiddenfields']['REQ_reqwahid'] = $wah['id'];
			$tablearray['formfields']['REQ_reqwahname']['value'] = $wah['name'];
		} else{
			$tablearray['hiddenfields']['REQ_reqwahid'] = $wah;
		}
		
		return($tablearray);
	}
	public function requests_submit($data, $formfields){  // formfields deriva da br_formfields
		$CIdb = $this->CIdb();
		$table = $data['table'];		

		//seleziono campi da inserire con ctrl incrociato tra formfields e data
		foreach($formfields['formfields'] as $field=>$par){
			if(array_key_exists($par['name'], $data)){
				$fieldname = $par['name'];
				$datatoinsert[$field] = $data[$fieldname];
			} 
		}

		//seleziono campi nascosti da inserire con ctrl incrociato tra formfields e data
		if(isset($formfields['hiddenfields'])){
			foreach($formfields['hiddenfields'] as $field=>$value){
				if(array_key_exists($field, $data) && substr($field, 0, 3) == $formfields['pre']){
					$datatoinsert[$field] = $data[$field];
				}
			}
		}
		
		//iprint_r($datatoinsert);
		// query x inserimento		
		$CIdb->insert($table, $datatoinsert);
	}
	public function batch_req_choose_wah($formfields){
		$CIdb = $this->CIdb();

		$wherearray = array(
			'WAH_active' => 1,
			'WAH_wahcategory' => 1
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
	public function requests_wah_rep($userrole, $rep){
		$CIdb = $this->CIdb();
		$wherearray = array(
			'WAH_wahcategory' => 2,
			'WAH_active' => 1,
		);
		$CIdb->select('*')->from('warehouses')->where($wherearray);
		$result = $CIdb->get()->result();
		
		$wahreplist = array();
		foreach($result as $num=>$wah){
			$wahname = $wah->WAH_wahname;
			$wahid = $wah->WAH_ID;
			if($userrole !== 'admin' && array_key_exists($wahid, $rep)){
				$wahreplist[$wahid] = $wahname;
			} else{
				$wahreplist[$wahid] = $wahname;
			}			
		}
		return($wahreplist);
	}
	public function requests_in_batch_view($metatemplate, $tablearray, $pwahid, $rwah){ //rwah si può togliere
		$CIdb = $this->CIdb();
		
		$stringquery = "SELECT STO_WAH_ID, STO_ID, PRO_proname, PRO_pack, PRO_measureunit, STO_quantity FROM instock_view WHERE STO_WAH_ID = $pwahid ORDER BY PRO_proname ";
		$query = $CIdb->query($stringquery);
		$resultq = $query->result();

		//iprint_r($resultq);
		$header = array();
		$result = array();

		// filtro per magazzino

		foreach($resultq as $rownumb=>$prod){
			//$prsid = $prod->PRS_ID;
			if($rownumb == 0){
				foreach($prod as $field=>$value){
					if(array_key_exists($field, $tablearray['headers'])){
						$header[$field] = $tablearray['headers'][$field];
					}					
				}
				foreach($tablearray['formfields'] as $input=>$attr){
					$header[$input]= $attr['label'];
				}
			}

			foreach($prod as $field=>$value){
				//integer
				if(isset($tablearray['int']) && in_array($field, $tablearray['int'])){
                    $value = substr($value, -2) == ".0" ? substr($value, 0, -2) : $value;
                    $prod->$field = $value;
                }

				if(array_key_exists($field, $tablearray['headers'])){
					$result[$rownumb][$field] = $value;
				}				
			}

			$product = get_object_vars($prod);

			foreach($tablearray['formfields'] as $input=>$attr){
				foreach($attr as $key=>$val){
					if($key == 'name' || $key == 'id'){
						$newval = $val.'_'.$rownumb;
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
		

		//assegno l'header
		$this->table->set_heading($header);
		//print_r($header);

		//assegno il template alla tabella
		$this->table->set_template($metatemplate);
		
		//genero la tabella
        echo $this->table->generate($result);
	}
	public function requests_batchsubmit($data, $wah, $formfields){
		$CIdb = $this->CIdb();
		$datenow = date("Y-m-d H:i:s");
		//iprint_r($data);
		
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
		// inserisco wah e date
		foreach($rowarray as $num=>$row){
			$rowarray[$num]['reqwahid'] = $wah['id'];
			$rowarray[$num]['reqdate'] = $datenow;
		}
		//iprint_r($rowarray);
		//iprint_r($formfields);
		// cfr con ff
		$datatoinsert = array();
		foreach($rowarray as $num => $row){
			foreach($row as $field => $value){
				if(array_key_exists($field, $formfields)){
					$fieldrname = $formfields[$field];
					$datatoinsert[$fieldrname] = $row[$field];
				} 
			}
			
			if($datatoinsert['REQ_reqquantity'] !== ''){          				 
				$CIdb->insert('requests', $datatoinsert);
			}
			//iprint_r($datatoinsert);			
		}
	}
}