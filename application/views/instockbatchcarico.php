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
	<h1 class="h3 mb-2 text-gray-800">Magazzino - Operazioni interne</h1>
	<div id="registry-container" class="card shadow mb-4 table-container registry">


		<div id = "card-header-shadow" class="card shadow mb-4">
			<!-- titolotabella -->
			<div id = "card-header" class="card-header py-3">

			<!-- title + bottone add new -->
			<h4 class="m-0 font-weight-bold text-primary tabletitle"><?php echo $tabletitle; ?>
			<!-- bottone aggiungi nuovo -->
			<a href="<?php echo site_url('Instock/instock_suppliers'); ?>" class="btn btn-primary btn-icon-split addnew-btn">
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
				$class = 'instock_batch batchtable';
				$idtable = 'dataTable';
				$metatemplate = $this->tabletemplates->temparrow($class, $idtable); // aspetto tabella

				$formattributes = array(
					'id' => 'batchcarico',
					'class' => 'instock batchcarico is-form'
				);

				echo form_open(site_url($siteurl), $formattributes);

				$attr = array(
					'id' => 'instockwah',
					'name' => 'instockwah',
					'class' => 'form-control',
					'value' => $wah['id'],
					'type' => 'hidden',
				);
				echo form_input($attr);

				$this->Instock_model->instock_batchcarico($metatemplate, $tablearray, $supplier, $wah);

				if(isset($tablearray['submitbtn'])){
					$submitlabel = $tablearray['submitbtn']['label'];
				} else{
					$submitlabel = 'Salva';
				}

				?>
				<div style = 'clear:both'></div>

				<div class = "col-md-6 form-group"> <!-- form group-->
				<button type="submit" class="btn btn-primary batch" name = "submit"><?php echo $submitlabel; ?></button>
				</div> <!-- end form-group -->

				


			</div>	<!-- end # table-responsive  card shadow mb-4 -->
		</div>	<!-- end # card-body  card shadow mb-4 -->

	</div>	<!-- end # registry-container  card shadow mb-4 -->

</div> 	<!-- end container-fluid -->
</body>
</html>