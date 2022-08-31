<?php
defined('BASEPATH') OR exit('No direct script access allowed');


// parametri dipendenti dalla tabella di riferimento
$tabletitle = $tablearray['tabletitle'];
?>

<!DOCTYPE html>
<html lang="en">


<body>
<!-- Begin Page Content -->
<div class="container-fluid">
	<h1 class="h3 mb-2 text-gray-800">Reparto - Richieste</h1>
	<div id="registry-container" class="card shadow mb-4 table-container registry">


		<div id = "card-header-shadow" class="card shadow mb-4">
			<!-- titolotabella -->
			<div id = "card-header" class="card-header py-3">

			<!-- title + bottone add new -->
			<h4 class="m-0 font-weight-bold text-primary tabletitle"><?php echo $tabletitle; ?>
			</h4>

			<!-- fine bottone aggiungi nuovo -->

			</div> <!-- end # card-header py-3-->
		</div>	 <!-- end  # card-header-shadow -->

		<div id = "card-body" class="card-body">
			<div id = "table-responsive" class="table-responsive">
				<?php

				$attr = array(
					'id' => 'outreq_wahrep',
					'class' => 'form-control',
					'label' => 'Scegli magazzino reparto',
				);


				
				if($wah !== 'choose'){
					$wahreplist = $rep;
					$selected = $wah['id'];					
				}else{
					$wahreplist = $this->Outrequests_model->outrequests_wahreplist();
					$wahreplist['choose'] = 'Tutti i magazzini di reparto';
					$selected = $wah;
				}

				echo "<div class='form-group col-md-6'>";
				echo form_label($attr['label'], $attr['id']);
				echo form_dropdown('outreq_wahrep', $wahreplist, $selected, $attr);
				echo '</div>';
				echo '<div style = "clear:both"></div>';

				//$class =  'outrequests-table';
				$class = 'outrequests-table';
				$idtable = 'outrequests';
				$metatemplate = $this->tabletemplates->temparchive($class, $idtable); // aspetto tabella

				$this->Outrequests_model->outrequeststable_view($metatemplate, $regtab, $tablearray, $table, $wah, $userrole);

				?>

			</div>	<!-- end # table-responsive  card shadow mb-4 -->
		</div>	<!-- end # card-body  card shadow mb-4 -->

	</div>	<!-- end # registry-container  card shadow mb-4 -->

</div> 	<!-- end container-fluid -->
</body>
</html>