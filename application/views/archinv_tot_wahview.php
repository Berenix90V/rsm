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
	<h1 class="h3 mb-2 text-gray-800">Archivio inventari</h1>
	<div id="registry-container" class="card shadow mb-4 table-container registry">


		<div id = "card-header-shadow" class="card shadow mb-4">
			<!-- titolotabella -->
			<div id = "card-header" class="card-header py-3">

			<!-- title + bottone add new -->
			<h4 class="m-0 font-weight-bold text-primary tabletitle"><?php echo $tabletitle.' '.$wah['name']; ?>
			<!-- bottone aggiungi nuovo -->
			<a href="<?php echo site_url('Archiveinv/archinv_tot_choose'); ?>" class="btn btn-primary btn-icon-split addnew-btn">
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
				$startyear = $tablearray['startyear'];
				$curyear = date('Y');
				$options = array();
				/*for ($i = $startyear; $i <= $curyear; $i++) {
					$options[$i] = $i;
				}*/
				for ($i = $curyear; $i >= $startyear; $i--) {
					$options[$i] = $i;
				}
				$attr = array(
					'id' => 'chooseyear',
					'class' => 'form-control',
					'label' => 'Scegli anno'
				);
				echo '<div class="form-group col-md-6">';
				echo form_label($attr['label']);
				echo form_dropdown('chooseyear', $options, $curyear, $attr);
				echo '</div>';


				$attr = array(
					'id' => 'warehouse',
					'name' => 'warehouse',
					'class' => 'form-control',
					'label' => 'magazzino',
					'readonly' => true,
					'hidden' => true,
					'value' => $wah['id'],
				);
				echo '<div class="form-group col-md-6">';
				//echo form_label($attr['label']);
				echo form_input($attr);
				echo '</div>';

				echo '<div style = "clear:both"></div>';
				
				$class = 'archive-table orderable';
				$idtable = 'archinv';
				$metatemplate = $this->tabletemplates->temparchive($class, $idtable); // aspetto tabella

				$formattributes = array(
					'id' => 'batchrequests',
					'class' => 'instock batchrequests req-form'
				);
				//$hiddenfields = $tablearray['hiddenfields'];
				//$wahid = $wah['id'];

				//$this->Archiveinv_model->archinv_tot_wah_view($metatemplate, $tablearray, $wahid, $catlist, $year);
				$this->Archiveinv_model->archinv_tot_wah_view($metatemplate, $tablearray, $wah, $year, $catlist, $monthslist);

				?>
				<div style = 'clear:both'></div>	

			</div>	<!-- end # table-responsive  card shadow mb-4 -->
		</div>	<!-- end # card-body  card shadow mb-4 -->

	</div>	<!-- end # registry-container  card shadow mb-4 -->

</div> 	<!-- end container-fluid -->
</body>
</html>