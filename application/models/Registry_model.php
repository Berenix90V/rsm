<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Registry_model extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    public function CIdb() {
        $var = new dbload;
        $CIdb = $var->CIdb;
        return $CIdb;
    }
    public function registrytable_view($metatemplate, $regtab, $tablearray, $tableview = '') { // parametri passati dalla view precedente la 1
		$CIdb = $this->CIdb();
		if($regtab == 'users'){
			$tableview = 'permessi_view';
		}
		//echo $tableview;
		
		// ricavo i parametri della tabella
		$pre = $tablearray['pre'];
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
		
		if($tableview !== ''){
			$CIdb->from($tableview);
		} else{
			$CIdb->from($regtab);
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

				// formato psw
				if(isset($tablearray['psw']) && in_array($k, $tablearray['psw'])){
					$v = str_repeat("*", strlen($v)); 
				}
				
				
				
				if(isset($tablearray['tableheaders'])){
					if(array_key_exists($k, $tableheaders)){	//vengono selezionati solo quelli che sono nell'array 'tableheaders'
						//cond campi booleani attivo/non attivo
						if(isset($tablearray['boolean']) && array_key_exists($k, $tablearray['boolean'])){	// se ho campo booleano
							//echo 'boolean'.$k;
							$options = $tablearray['boolean'][$k];
							$v = $options[$v];
						}
						if(isset($tablearray['select']) && array_key_exists($k, $tablearray['select'])){	// se ho campo select
							$options = $tablearray['select'][$k];
							$v = $options[$v];
						}
						// fine campo booleano

						$result[$key][$k] = $v;					
					} 
				} else{
					$result[$key][$k] = $v;	// inserisco i nomi dei campi della tabella anche come key nel caso in seguito dovessi cambiare i titoli in frontend, in questo modo nonn perdo i riferimenti
				}						
			}
			
			
			
			//aggiungo i pulsanti per l'editing
			$idfield = $tablearray['id'];
			/*iprint_r($value);
			echo $idfield;*/
			$key1 = $value->$idfield;
			
			//assegno le icone per edit e delete	
			$editicon = '<a href="'.site_url('Registry/basicregistry_edit?regtab='.$regtab.'&ref='.$key1).'" class="btn btn-warning btn-circle"><i class="fas fa-edit"></i></a>';	
			$deleteicon = '<a href="'.site_url('Registry/basicregistry_confirmdisable?regtab='.$regtab.'&ref='.$key1).'" class="btn btn-danger btn-circle"><i class="fas fa-trash"></i></a>';
			$result[$key]['icon'] = $editicon.$deleteicon;
		}

		
		
		
		$header['icons'] = '';


		//assegno l'header
		$this->table->set_heading($header);
		//print_r($header);

		//assegno il template alla tabella
		$this->table->set_template($metatemplate);
		
		//genero la tabella
        echo $this->table->generate($result);
	}
	public function registry_submit($data, $formfields, $regtab){  // formfields deriva da br_formfields
		$CIdb = $this->CIdb();
		$table = $data['table'];
		//iprint_r($formfields);

		//seleziono campi da inserire con ctrl incrociato tra formfields e data
		foreach($formfields['formfields'] as $field=>$par){
			if(array_key_exists($par['name'], $data)){
				$fieldname = $par['name'];
				if(isset($formfields['password']) && in_array($field, $formfields['password'])){
					$valore = $data[$fieldname];
					$pswcifrata = password_hash($valore, PASSWORD_DEFAULT);
					$datatoinsert[$field] = $pswcifrata;
				} else{
					$datatoinsert[$field] = $data[$fieldname];
				}
				
			}
		}

		//seleziono campi nascosti da inserire con ctrl incrociato tra formfields e data
		foreach($formfields['hiddenfields'] as $field=>$value){
			if(array_key_exists($field, $data) && substr($field, 0, 3) == $formfields['pre']){
				$datatoinsert[$field] = $data[$field];
			}
		}
		
		
		
		//iprint_r($datatoinsert);
		// query x inserimento		
		$CIdb->insert($table, $datatoinsert);

		if($regtab == 'users'){
			//pesco id usr
			$name = $formfields['formfields']['USR_usrname']['name'];
			$psw = $formfields['formfields']['USR_usrpsw']['name'];
			$wherearray = array(
				'USR_usrname' => $data[$name],
				'USR_usrpsw' => $pswcifrata, 
			);
		
			$CIdb->select('USR_ID')->from('users')->where($wherearray);
			$usridarray = $CIdb->get()->result();
			foreach($usridarray as $numb=>$id){
				$usrid = $id->USR_ID;
			}
			//echo $usrid;
			
			$this->permission_insert($data, $usrid);
			
		}
		

		
	}
	public function permission_insert($data, $usrid){
		$CIdb = $this->CIdb();
		//iprint_r($data);
		if(!isset($data['cwahlist'])){
			$data['cwahlist'] = '';
		}
		if(!isset($data['rwahlist'])){
			$data['rwahlist'] = '';
		}
		// permissions
		foreach($data as $name=>$value){
			$datatoinsert2 = array();
			if(strpos($name, '_') && substr($name, 0, 3) == 'wah'){
				
				$namexpl = explode('_', $name);
				$wahid = $namexpl[1];
				if($wahid !== $data['cwahlist'] && $wahid !== $data['rwahlist']){
					$datatoinsert2 = array(
						'PE_USR_ID' => $usrid,
						'PE_WAH_ID' => $wahid,
					);
				}
				
				/*if($wahid == $data['cwahlist']){
					$datatoinsert = array(
						'PE_USR_ID' => $usrid,
						'PE_WAH_ID' => $wahid,
						'PE_maincen' => 1,
					);
				} elseif($wahid == $data['rwahlist']){
					$datatoinsert = array(
						'PE_USR_ID' => $usrid,
						'PE_WAH_ID' => $wahid,
						'PE_mainrep' => 1,
					);
				} else{
					$datatoinsert = array(
						'PE_USR_ID' => $usrid,
						'PE_WAH_ID' => $wahid,
					);
				}*/
				//iprint_r($datatoinsert);
				
			} elseif($name == 'cwahlist'){
				
				$datatoinsert2 = array(
					'PE_USR_ID' => $usrid,
					'PE_WAH_ID' => $value,
					'PE_maincen' => 1,
				);
			} elseif($name == 'rwahlist'){
				
				$datatoinsert2 = array(
					'PE_USR_ID' => $usrid,
					'PE_WAH_ID' => $value,
					'PE_mainrep' => 1,
				);
			}
			if(!empty($datatoinsert2)){
				$CIdb->insert('permissions', $datatoinsert2);	
			}
						
		}
	}
	public function permissions(){
		$CIdb = $this->CIdb();
		$result = $CIdb->select('*')->from('warehouses')->order_by('WAH_wahcategory ASC, WAH_wahname ASC')->get()->result();
		$wahlist = array();
		foreach($result as $numb=>$wah){
			if($wah->WAH_active == 1){
				$wahid = $wah->WAH_ID;
				$wahname = $wah->WAH_wahname;
				// centrali e reparti
				if($wah->WAH_wahcategory == 1){	
					$wahlist['centrali'][$wahid] = $wahname;
				} elseif($wah->WAH_wahcategory == 2){
					$wahlist['reparti'][$wahid] = $wahname;
				}
			}
		}
		
		return($wahlist);
	}
	public function registry_editview($formfields, $regtab, $wherearray, $tablearray){
		
		$CIdb = $this->CIdb();

		$exceptions = array();
		if(isset($tablearray['exceptions'])){
			$exceptions = $tablearray['exceptions'];
		}
		$query = $CIdb->select('*')->from($regtab)->where($wherearray)->get()->result();
		//iprint_r($query);
		foreach($query as $k=>$row){
			foreach($row as $field=>$value){
				$datasingle[$field] = $value;
			}
		}
		
		foreach($formfields as $field=>$allpar){
			if(array_key_exists($field, $datasingle) && !array_key_exists($field, $exceptions)){
				$formfields[$field]['value'] = $datasingle[$field];
			}
		}
		//iprint_r($formfields);
		return($formfields);
	}
	public function permissions_edit($permissions, $ref){
		$CIdb = $this->CIdb();
		$wherearray = array(
			'PE_USR_ID' => $ref,
		);
		$CIdb->select('*')->from('permissions')->where($wherearray);
		$permarray = $CIdb->get()->result();
		foreach($permarray as $numb => $per){
			$wahid = $per->PE_WAH_ID;
			$rmain = $per->PE_mainrep;
			$cmain = $per->PE_maincen;
			
			if($rmain == 1){
				$permissions['reparti']['selected'] = $wahid;
				$permissions['wahlist']['rep'] = $wahid;
			} elseif($cmain == 1){
				$permissions['centrali']['selected'] = $wahid;
				$permissions['wahlist']['cen'] = $wahid;
			} else{
				$permissions['wahlist']['tot'][] = $wahid;
			}
		}
		return($permissions);
	}
	public function registry_update($data, $formfields, $regtab){  // formfields deriva da br_formfields
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

				if(isset($formfields['password']) && in_array($fieldname, $formfields['password'])){
					
					if($data[$fieldname] !== ''){
						
						$valore = $data[$fieldname];
						$pswcifrata = password_hash($valore, PASSWORD_DEFAULT);
						$datatoupdate[$field] = $pswcifrata;
					}
				} else{
					$datatoupdate[$field] = $data[$fieldname];
				}
				
			}
		}
		

		//seleziono campi nascosti da inserire con ctrl incrociato tra formfields e data
		foreach($formfields['hiddenfields'] as $field=>$value){
			if(array_key_exists($field, $data) && substr($field, 0, 3) == $formfields['pre']){
				$datatoupdate[$field] = $data[$field];
			}
		}
		//iprint_r($datatoupdate);

		// query x inserimento
		
		$CIdb->set($datatoupdate)->where($wherearray)->update($table);

		//elimino permessi precedenti
		if($regtab == 'users'){
			$CIdb->where('PE_USR_ID', $data[$id])->delete('permissions');
			$usrid = $data[$id];
			$this->permission_insert($data, $usrid);
		}
		

		
	}
	public function registry_disable($table, $wherearray, $disablefield){
		$CIdb = $this->CIdb();
		$datatoupdate = array(
			$disablefield => 0
		);
		
		$CIdb->set($datatoupdate)->where($wherearray)->update($table);
	}
}