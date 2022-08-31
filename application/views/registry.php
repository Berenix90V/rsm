<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//$tablepar = $tablearray[$regtab];

// parametri dipendenti dalla tabella di riferimento

$tabletitle = $tablearray['tabletitle'];
$orderfield = $tablearray['orderfield'];
$pre = $tablearray['pre'];

?>

<!DOCTYPE html>
<html lang="en">


<body>
<!-- Begin Page Content -->
<div class="container-fluid">
	<h1 class="h3 mb-2 text-gray-800">Anagrafica di base </h1>
	<div id="registry-container" class="card shadow mb-4 table-container registry">


		<div id = "card-header-shadow" class="card shadow mb-4">
			<!-- titolotabella -->
			<div id = "card-header" class="card-header py-3">

			<!-- title + bottone add new -->
			<h4 class="m-0 font-weight-bold text-primary tabletitle"><?php echo $tabletitle; ?>
			<!-- bottone aggiungi nuovo -->
			<a href="<?php echo site_url('Registry/basicregistry_addnew?regtab='.$regtab); ?>" class="btn btn-primary btn-icon-split addnew-btn">
				<span class="icon text-white-50">
					<i class="fas fa-plus"></i>
				</span>
				<span class="text">Aggiungi nuovo</span>
			</a>
			</h4>

			<!-- fine bottone aggiungi nuovo -->

			</div> <!-- end # card-header py-3-->
		</div>	 <!-- end  # card-header-shadow -->

		<div id = "card-body" class="card-body">
			<div id = "table-responsive" class="table-responsive">
				<?php
				$classe = 'basic_registry';
				$metatemplate = $this->tabletemplates->temp1($classe); // aspetto tabella


				$this->Registry_model->registrytable_view($metatemplate, $regtab, $tablearray);

				?>

			</div>	<!-- end # table-responsive  card shadow mb-4 -->
		</div>	<!-- end # card-body  card shadow mb-4 -->

	</div>	<!-- end # registry-container  card shadow mb-4 -->

</div> 	<!-- end container-fluid -->
</body>
</html>