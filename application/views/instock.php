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
					<i class="fas fa-upload"></i>
				</span>
				<span class="text">Carico batch</span>
			</a>
			<a href="<?php echo site_url('Instock/instock_addnew'); ?>" class="btn btn-primary btn-icon-split addnew-btn" style = "margin-right:10px;">
				<span class="icon text-white-50">
					<i class="fas fa-plus"></i>
				</span>
				<span class="text">Aggiungi singolo</span>
			</a>
			</h4>

			<!-- fine bottone aggiungi nuovo -->

			</div> <!-- end # card-header py-3-->
		</div>	 <!-- end  # card-header-shadow -->

		<div id = "card-body" class="card-body">
			<div id = "table-responsive" class="table-responsive">
				<?php
			
				$attr = array(
					'id' => 'isv_wahcen',
					'class' => 'form-control',
					'label' => 'Scegli magazzino centrale',
				);
				if($wah['id'] !== 'choose'){
					$wahcenlist = $cen;
										
				}else{
					$wahcenlist = $wahcenlist = $this->Instock_model->instock_wahcenlist();
					$wahcenlist['choose'] = 'Tutti i magazzini centrali';
					
				}
				$selected = $wah['id'];
				echo "<div class='form-group col-md-6'>";
				echo form_label($attr['label'], $attr['id']);
				echo form_dropdown('isv_wahcen', $wahcenlist, $selected, $attr);
				echo '</div>';
				echo '<div style = "clear:both"></div>';
									
				//$metatemplate = $this->tabletemplates->temp1(); // aspetto tabella

				$class = 'instock-table orderable';
				$idtable = 'instock';
				$metatemplate = $this->tabletemplates->temparchive($class, $idtable);

				$this->Instock_model->instocktable_view($metatemplate, $regtab, $tablearray, $table, $wah, $userrole);

				?>

			</div>	<!-- end # table-responsive  card shadow mb-4 -->
		</div>	<!-- end # card-body  card shadow mb-4 -->

	</div>	<!-- end # registry-container  card shadow mb-4 -->

</div> 	<!-- end container-fluid -->
</body>
</html>