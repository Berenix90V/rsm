<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Instock_model extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    public function CIdb() {
        $var = new dbload;
        $CIdb = $var->CIdb;
        return $CIdb;
	}
	public function instock_suppliers($tablearray){
		$CIdb = $this->CIdb();
		$wherearray = array(
			$tablearray['where'] => $tablearray['wherevalue']
		);
		//QUERY AL DB
		//select a seconda che sia settata o meno l'opzione select
		if(isset($tablearray['select'])){
			$CIdb->select($tablearray['select']);
		} else{
			$CIdb->select('*');
		}
		$CIdb->from($tablearray['from']);
		
		$CIdb->where($wherearray);
		$CIdb->group_by($tablearray['groupby']);
		$result = $CIdb->get()->result();
		//iprint_r($result);
		$suplist= array();
		foreach($result as $key=>$listf){
			$sid = $listf->PRS_SUP_ID;
			$name = $listf->SUP_supname; 
			$suplist[$sid] = $name;	
		}
		return($suplist);

	}
	public function instock_wahcenlist(){
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
    public function instocktable_view($metatemplate, $regtab, $tablearray, $table, $wah, $userrole) { // parametri passati dalla view precedente la 1
		$CIdb = $this->CIdb();
		
		if($wah['id'] !=='choose'){
			$wherearray = array(
				'STO_WAH_ID' => $wah['id'],
			);
		}
		
		
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
		if(isset($wherearray)){
			$CIdb->where($wherearray);
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
				// formato integer se possibile
				//iprint_r($CIregistryquery);
				if(isset($tablearray['int']) && in_array($k, $tablearray['int'])){
					$v = substr($v, -2) == ".0" ? substr($v, 0, -2) : $v;
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
            
            
			$key1 = $value->$idfield;
			//iprint_r($value);
			
			
			//assegno le icone per edit e delete	
			$editicon = '<a href="'.site_url('Instock/instock_edit?ref='.$key1).'" class="btn btn-warning btn-circle"><i class="fas fa-edit"></i></a>';
			$deleteicon = '<a href="'.site_url('Instock/instock_confirmdisable?ref='.$key1).'" class="btn btn-danger btn-circle"><i class="fas fa-trash"></i></a>';	
            $scaricoicon = '<a href="'.site_url('Instock/instock_plusminus?mode=minus&ref='.$key1).'" class="btn btn-danger btn-circle"><i class="fas fa-minus"></i></a>';
			$caricoicon = '<a href="'.site_url('Instock/instock_plusminus?mode=plus&ref='.$key1).'" class="btn btn-success btn-circle"><i class="fas fa-plus"></i></a>';
			/*$questionicon = '<a href="'.site_url('Instock/instock_edit?ref='.$key1).'" class="btn btn-warning btn-circle"><i class="fas fa-question"></i></a>';*/
			
			//$result[$key]['icons'] = $caricoicon.$scaricoicon.$editicon; // vecchia edizione con scarico
			if($userrole == 'admin'){
				$result[$key]['icons'] = $caricoicon.$editicon;
			} else{
				$result[$key]['icons'] = $caricoicon;				
			}
			
		}
		
		//$header['caricoscarico'] = 'Carico/Scarico';
		$header['icons'] = '';

		if(!empty($result)){
			//assegno l'header
			$this->table->set_heading($header);
			//print_r($header);

			//assegno il template alla tabella
			$this->table->set_template($metatemplate);
			
			//genero la tabella
			echo $this->table->generate($result);
		} else{
			echo '<div class="no-data"> Nessun dato disponibile per il magazzino selezionato </div>';
		}
		
	}
	public function addnew_view($wah, $tablearray){ // metodo del controller in disuso
		foreach($tablearray['formfields'] as $key=>$value){
			if($key == 'STO_WAH_wahname' && $wah!=='choose'){
				$tablearray['formfields'][$key]['value'] = $wah['name'];
			}			
		}
		foreach($tablearray['hiddenfields'] as $key=>$value){
			if($key == 'STO_WAH_ID' && $wah !== 'choose'){
				$tablearray['hiddenfields'][$key] = $wah['id'];
			}
		}
		return($tablearray);
	}
	public function instock_batchcarico($metatemplate, $tablearray, $supplier, $wah){
		$CIdb = $this->CIdb();
		$wherefield = $tablearray['wherefield'];
		$wherearray = array(
			$wherefield => $supplier,
		);
		
		//query
		/*if(isset($tablearray['select'])){
			$CIdb->select($tablearray['select']);
		} else{
			$CIdb->select('*');
		}
		$CIdb->from($tablearray['from']);
		$CIdb->join($tablearray['join'].' is', 'is.STO_PRS_ID=PRS_ID', 'left');
		$CIdb->where($wherearray);
		$CIdb->having('STO_WAH_ID', 2);*/

		// poi inserire filtro a seconda dell'utente, al posto del 2 metterci la var mag
		
		$wahid = $wah['id'];
		$stringquery = "SELECT PRS_ID, isv.STO_ID, pf_view.PRO_proname, pf_view.SUP_supname, isv.STO_quantity, isv.STO_WAH_ID, pf_view.PRS_SUP_ID FROM pf_view  LEFT JOIN instock_view AS isv ON isv.STO_PRS_ID=PRS_ID WHERE NOT EXISTS(SELECT STO_ID FROM instock_view WHERE STO_WAH_ID = $wahid AND STO_PRS_ID=PRS_ID) OR STO_WAH_ID = $wahid HAVING pf_view.PRS_SUP_ID = $supplier";
		
		
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
	public function instock_batchsubmit($data, $wah, $formfields){
		iprint_r($data);
		$CIdb = $this->CIdb();
		$rowarray = array();
		foreach($data as $key=>$value){
			if(strpos($key, '_')){
				$keyexpl = explode('_', $key);
				$num = $keyexpl[1];
				$field = $keyexpl[0];
				$rowarray[$num][$field] = $value;
			}
		}
		foreach($rowarray as $num=>$row){
			if($row['qplus'] !== ''){
				if($row['stoquantity'] == ''){
					$row['stoquantity'] = 0;
				}
				$sum = $row['stoquantity'] + $row['qplus'];
			} else{
				$sum = $row['stoquantity'];
			}			
			$rowarray[$num]['sum'] = $sum;
			$rowarray[$num]['wahid'] = $wah['id'];
		}
		
		foreach($rowarray as $num => $row){
			foreach($row as $field => $value){
				if(array_key_exists($field, $formfields)){
					$fieldrname = $formfields[$field];
					$datatoinsert[$fieldrname] = $row[$field];
				} 
			}
			
			if($datatoinsert['STO_ID'] !== ''){
				$wherearray = array(
					'STO_ID' => $datatoinsert['STO_ID'],
				);
				          
				$CIdb->where($wherearray)->update('instock', $datatoinsert); 
			} elseif($datatoinsert['STO_quantity'] !== ''){
				$CIdb->insert('instock', $datatoinsert);	
			}	
			
			
		}
		
	}
	public function instock_submit($data, $formfields){  // formfields deriva da br_formfields
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
		$wherearray = array(
			'STO_PRS_ID' => $data['STO_PRS_ID'],
			'STO_WAH_ID' => $data['STO_WAH_ID'],
		);	
		$CIdb->select('*')->from('instock')->where($wherearray);
		$result = $CIdb->get()->result();
		if(empty($result)){
			$CIdb->insert($table, $datatoinsert);
		} else{
			foreach($result as $num => $pf){
				$datatoinsert['STO_quantity'] = $datatoinsert['STO_quantity'] + $pf->STO_quantity;		
			}
			unset($datatoinsert['STO_PRS_ID']);
			unset($datatoinsert['STO_WAH_ID']);		
			$CIdb->set($datatoinsert)->where($wherearray)->update('instock');
		}

		/*$wherearray = array(
			'STO_PRS_ID' => $data['STO_PRS_ID'],
			'STO_WAH_ID' => $data['STO_WAH_ID'],
		);*/
		$CIdb->select('*')->from($table)->where($wherearray);
		$result = $CIdb->get()->result();
		//iprint_r($result);

		foreach($result as $num=>$ispro){
			$stoid = $ispro->STO_ID;
		}
		//echo $stoid;

		$datatoconsumption = array();
		$datatoconsumption['CON_STO_ID'] = $stoid;
		//iprint_r($formfields);
		foreach($formfields['consumptions'] as $field => $par){
			if(isset($par['name']) && array_key_exists($par['name'], $datatoinsert)){
				$fieldname = $par['name'];
				$datatoconsumption[$field] = $datatoinsert[$fieldname];
			} elseif(isset($par['value'])){
				$datatoconsumption[$field] = $formfields['consumptions'][$field]['value'];
			}
		}
		//iprint_r($datatoconsumption);
		$CIdb->insert('consumption', $datatoconsumption);

		
	}
	public function instock_editview($tablearray, $regtab, $wherearray, $tableview){
		
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
	public function instock_update($data, $formfields){  // formfields deriva da br_formfields
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
		/*iprint_r($formfields['related_to_others']);
		iprint_r($data);*/
		if(isset($formfields['related_to_others'])){
			foreach($formfields['related_to_others'] as $field=>$value){
				$nomefield = $value['name'];
				if(array_key_exists($value['name'], $data) && substr($field, 0, 3) == $formfields['pre']){					
					$reftofield = $value['refto'];
					$q = $datatoupdate[$reftofield];
					if($value['mode'] == 'minus'){
						$datatoupdate[$reftofield] = $q - $data[$nomefield];
					}				
				}
			}
		}
		
		/*echo $formfields['pre'];
		iprint_r($formfields['hiddenfields']);
		iprint_r($data);
		iprint_r($datatoupdate);*/

		// query x inserimento
		
		$CIdb->set($datatoupdate)->where($wherearray)->update($table);
		
		//correzione consumption
		$id_value = $data[$id];
		$wherearray = array(
			'CON_STO_ID' => $id_value,
			'CON_plus >' => '0'
		);
		$CIdb->select('*')->from('consumption')->where($wherearray);
		$result = $CIdb->get()->result();
		//iprint_r(end($result));
		$lastcons = end($result);
		$constoupdate = array();
		foreach($lastcons as $field => $value){
			$constoupdate[$field] = $value;
			if($field == 'CON_plus'){
				$constoupdate[$field] = $datatoupdate['STO_quantity'];
			}
		}
		$wherearray = array(
			'CON_ID' => $constoupdate['CON_ID'],
		);
		$CIdb->set($constoupdate)->where($wherearray)->update('consumption');
		

		
	}
	public function instock_updateq($data, $formfields){  // formfields deriva da br_formfields
		$CIdb = $this->CIdb();
		$table = $data['table'];
		$id = $formfields['id'];
 		$wherearray = array(
			$id=> $data[$id], 
		);	
		
		// modifico quantità
		//iprint_r($data);
		if($data['mode'] == 'plus'){
			$data['STO_quantity'] = $data['STO_quantity'] + $data['stoplus'];
		} elseif($data['mode'] == 'minus'){
			$data['STO_quantity'] = $data['STO_quantity'] - $data['stominus'];
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

		//  inserimento in consumi
		foreach($formfields['consumption'] as $field=>$consname){
			if(array_key_exists($field, $data)){
				$consdata[$consname] = $data[$field];
			}
		}

		//iprint_r($consdata);
		$CIdb->insert('consumption', $consdata);
		
	}	
}