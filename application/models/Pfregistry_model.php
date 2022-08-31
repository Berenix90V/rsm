<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pfregistry_model extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    public function CIdb() {
        $var = new dbload;
        $CIdb = $var->CIdb;
        return $CIdb;
    }
    public function registrytable_view($metatemplate, $regtab, $tablearray, $table) { // parametri passati dalla view precedente la 1
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

				// formato psw
				if(isset($tablearray['psw']) && in_array($k, $tablearray['psw'])){
					$v = str_repeat("*", strlen($v)); 
				}
				
				
				if(isset($tablearray['tableheaders'])){
					if(array_key_exists($k, $tableheaders)){	//vengono selezionati solo quelli che sono nell'array 'tableheaders'
						
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
			
			//aggiungo i pulsanti per l'editing
			$idfield = $tablearray['id'];
            //iprint_r($tablearray);
			$key1 = $value->$idfield;
			//iprint_r($value);
			
			
			//assegno le icone per edit e delete	
			$editicon = '<a href="'.site_url('Pfregistry/pfregistry_edit?regtab='.$table.'&ref='.$key1).'" class="btn btn-warning btn-circle"><i class="fas fa-edit"></i></a>';	
			$deleteicon = '<a href="'.site_url('Pfregistry/pfregistry_confirmdisable?ref='.$key1).'" class="btn btn-danger btn-circle"><i class="fas fa-trash"></i></a>';
			$result[$key]['icon'] = $deleteicon.$editicon;
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
	public function registry_submit($data, $formfields){  // formfields deriva da br_formfields
		$CIdb = $this->CIdb();
		$table = $data['table'];
		//iprint_r($formfields);

		//seleziono campi da inserire con ctrl incrociato tra formfields e data
		foreach($formfields['formfields'] as $field=>$par){
			if(array_key_exists($par['name'], $data)){
				$fieldname = $par['name'];
				$datatoinsert[$field] = $data[$fieldname];
			} 
		}

		//seleziono campi nascosti da inserire con ctrl incrociato tra formfields e data
		foreach($formfields['hiddenfields'] as $field=>$value){
			if(array_key_exists($field, $data) && substr($field, 0, 3) == $formfields['pre']){
				$datatoinsert[$field] = $data[$field];
			}
		}

		
		// query x inserimento		
		$CIdb->insert($table, $datatoinsert);
	}
	public function registry_editview($tablearray, $regtab, $wherearray, $tableview){
		
		$CIdb = $this->CIdb();
		$formfields = $tablearray['formfields'];
		$hiddenfields = $tablearray['hiddenfields'];
		$query = $CIdb->select('*')->from($tableview)->where($wherearray)->get()->result();
		//iprint_r($query);
		foreach($query as $k=>$row){
			foreach($row as $field=>$value){
				$datasingle[$field] = $value;
			}
		}
		//iprint_r($datasingle);
		foreach($formfields as $field=>$allpar){
			if(array_key_exists($field, $datasingle)){
				$formfields[$field]['value'] = $datasingle[$field];
			}
		}
		//iprint_r($formfields);
		$tablearray['formfields'] = $formfields;

		// hiddenfields di pro_id e sup_id
		//iprint_r($datasingle);
		foreach($hiddenfields as $field=>$value){
			if(array_key_exists($field, $datasingle)){
				$hiddenfields[$field] = $datasingle[$field];
			}
		}
		$tablearray['hiddenfields'] = $hiddenfields;

		return($tablearray);
	}
	public function registry_update($data, $formfields){  // formfields deriva da br_formfields
		$CIdb = $this->CIdb();
		$table = $data['table'];
		$id = $formfields['id'];
 		$wherearray = array(
			$id=> $data[$id], 
		);
		// correzione per stato attivo, elimino data di decadenza
		if(!isset($data['PRS_end'])){
			$data['PRS_end'] = '';
		} else{
			$result = $CIdb->select('PRS_end')->where($wherearray)->get($table)->result();
			foreach($result as $k=>$res){
				foreach($res as $field=>$value){
					if($field == 'PRS_end' && $value !==''){
						unset($data['PRS_end']);
					}
				}
			}
		}

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
		//iprint_r($datatoupdate);

		// query x inserimento
		
		$CIdb->set($datatoupdate)->where($wherearray)->update($table);
		
	}
	public function registry_disable($table, $wherearray, $disablefield){
		$CIdb = $this->CIdb();
		$datatoupdate = array(
			$disablefield => 0,
			'PRS_end' => date("d-m-Y h:i:sa"),
		);
		$result = $CIdb->select($disablefield)->where($wherearray)->get($table)->result();
		foreach($result as $k=>$res){
			foreach($res as $field=>$value){
				if($field == $disablefield && $value == 1){
					$CIdb->set($datatoupdate)->where($wherearray)->update($table);
				}
			}
		}	
	}
}