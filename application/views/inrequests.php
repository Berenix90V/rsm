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
	<h1 class="h3 mb-2 text-gray-800">Magazzino - Richieste</h1>
	<div id="registry-container" class="card shadow mb-4 table-container registry">


		<div id = "card-header-shadow" class="card shadow mb-4">
			<!-- titolotabella -->
			<div id = "card-header" class="card-header py-3">

			<!-- title + bottone add new -->
			<h4 class="m-0 font-weight-bold text-primary tabletitle"><?php echo $tabletitle; ?>

			<a href="<?php echo site_url('Inrequests/inrequests_choose_wah'); ?>" class="btn btn-primary btn-icon-split addnew-btn button-margin">
            <span class="icon text-white-50">
                <i class="fas fa-filter"></i>
            </span>
            <span class="text">Filtro magazzino</span>
        	</a>

			</h4>
			<!-- fine bottone aggiungi nuovo -->

			</div> <!-- end # card-header py-3-->
		</div>	 <!-- end  # card-header-shadow -->

		<div id = "card-body" class="card-body">
			<div id = "table-responsive" class="table-responsive">
				<?php
				$attr = array(
					'id' => 'inreq_wahcen',
					'class' => 'form-control',
					'label' => 'Scegli magazzino centrale',
				);

				if($wah !== 'choose'){
					$wahcenlist = $cen;
					$selected = $wah['id'];					
				}else{
					$wahcenlist = $this->Inrequests_model->inrequests_wahcenlist();
					$wahcenlist['choose'] = 'Tutti i magazzini centrali';
					$selected = $wah;
				}

				echo "<div class='form-group col-md-6'>";
				echo form_label($attr['label'], $attr['id']);
				echo form_dropdown('inreq_wahcen', $wahcenlist, $selected, $attr);
				echo '</div>';
				echo '<div style = "clear:both"></div>';

				$class = 'inrequests-table';
				$idtable = 'inrequests';
				$metatemplate = $this->tabletemplates->temparchive($class, $idtable);

				$this->Inrequests_model->inrequeststable_view($metatemplate, $regtab, $tablearray, $table, $wah, $userrole);

				?>

			</div>	<!-- end # table-responsive  card shadow mb-4 -->
		</div>	<!-- end # card-body  card shadow mb-4 -->

	</div>	<!-- end # registry-container  card shadow mb-4 -->

</div> 	<!-- end container-fluid -->
</body>
</html>