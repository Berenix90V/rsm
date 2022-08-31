<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//$tablepar = $tablearray[$regtab];

// parametri dipendenti dalla tabella di riferimento
$tabletitle = $tablearray['tabletitle'];

?>

<!DOCTYPE html>
<html lang="en">


<body>
<!-- Begin Page Content -->
<div class="container-fluid">
	<h1 class="h3 mb-2 text-gray-800">Inventario centrali</h1>
	<div id="registry-container" class="card shadow mb-4 table-container registry">


		<div id = "card-header-shadow" class="card shadow mb-4">
			<!-- titolotabella -->
			<div id = "card-header" class="card-header py-3">

			<!-- title + bottone add new -->
			<h4 class="m-0 font-weight-bold text-primary tabletitle"><?php echo $tabletitle.' '.$wah['name']; ?>
			<!-- bottone aggiungi nuovo -->
			<a href="<?php echo site_url('Inventory/inventory_r_choose_view'); ?>" class="btn btn-primary btn-icon-split addnew-btn">
				<span class="icon text-white-50">
					<i class="fas fa-angle-left"></i>
				</span>
				<span class="text">Indietro</span>
			</a>
			</h4>

			<!-- fine bottone aggiungi nuovo -->

			</div> <!-- end # card-header py-3-->
		</div>	 <!-- end  # card-header-shadow -->

		<div id = "card-body" class="card-body">
			<div id = "table-responsive" class="table-responsive">
				<?php
				 $formattributes = array(
					'id' => 'inventory_r_addnew',
					'class' => 'r-inventory inventory-form'
				);

				echo form_open(site_url($siteurl), $formattributes);
				$class = 'c_inventory';
				$idtable = 'dataTable';
				$metatemplate = $this->tabletemplates->temparrow($class, $idtable); // aspetto tabella
				//iprint_r($tablearray);
				$dataarray = $this->Inventory_model->inventory_c_view($metatemplate, $regtab, $tablearray, $wah);

				//$metatemplate = $this->tabletemplates->temparrow2(); // aspetto tabella
				//$this->Inventory_model->inventory_r_view_tot($metatemplate, $regtab, $tablearray, $wah);

				$genfields = $tablearray['inventory_c_list']['fields'];
				
				//echo $dataarray['ilcid'];
				if(isset($dataarray['ilid'])){
					//echo $ilid;
					$attr = array(
						'name'  => 'ilcid',
						'id'    => 'ilcid',
						'class' => 'form-control ilcid',
						'hidden' => true,
						'value' => $dataarray['ilcid'],
					);
					echo form_input($attr);
				}
				
				foreach($genfields as $field=>$attr){	
					if($attr['name']== 'wahid'){
						$attr['value'] = $wah['id'];
						$genfields[$field]['value']= $wah['id'];
					}
					echo form_input($attr);
				}
				if(isset($dataarray['ilcid'])){
					$ilid = $dataarray['ilcid'];
					$totcat = $this->Inventory_model->inventory_r_view_totcat($ilid);
				}
				
				
				
				$categories = $dataarray['categories'];
				if(!empty($categories)){
					echo '<div class = "form-group col-md-6">';
					foreach($categories as $id=>$name){
						$lname = strtolower($name);
						$attributes = array(
							'id' => $lname,
							'name' => $lname,
							'label' => $name,
							'readonly' => true,
							'class' => 'form-control cats',
						);
						//pesco valori categorie
						if(!empty($totcat)){
							$attributes['value'] = $totcat[$id];
						}
						echo '<div class = "form-group col-md-6">';
						echo form_label($attributes['label'], $attributes['id']);
						echo '</div>';
						echo '<div class = "form-group col-md-6">';
						echo form_input($attributes);
						echo '</div>';
					}
					$attributes = array(
						'id' => 'totale',
						'name' => 'totale',
						'label' => 'Totale',
						'readonly' => true,
						'class' => 'form-control',
					);
					if(!empty($totcat)){
						$attributes['value'] = $totcat['tot'];
					}
						echo '<div class = "form-group col-md-6">';
						echo form_label($attributes['label'], $attributes['id']);
						echo '</div>';
						echo '<div class = "form-group col-md-6">';
						echo form_input($attributes);
						echo '</div>';
						
					echo '</div>'; // chiudi primo form-group
				}
				
				?>
			<div style = 'clear:both'></div>
			<div class = "col-md-6 form-group"> <!-- form group-->
        	<button type="submit" class="btn btn-primary" name = "submit">Salva</button>
				

				<?php
				/*$now = date('Y-m-d H:i:s');
				$date = new DateTime($now);
				$interval = new DateInterval('P1M');
				$date->sub($interval);
				echo $date->format('Y-m-d') . "\n";*/
				?>

        	</div> <!-- end form-group -->

			</div>	<!-- end # table-responsive  card shadow mb-4 -->
		</div>	<!-- end # card-body  card shadow mb-4 -->

	</div>	<!-- end # registry-container  card shadow mb-4 -->

</div> 	<!-- end container-fluid -->
</body>
</html>