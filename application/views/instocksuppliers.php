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
	<h1 class="h3 mb-2 text-gray-800">Magazzino - Operazioni interne</h1>
	<div id="registry-container" class="card shadow mb-4 table-container registry">


		<div id = "card-header-shadow" class="card shadow mb-4">
			<!-- titolotabella -->
			<div id = "card-header" class="card-header py-3">

			<!-- title + bottone add new -->
			<h4 class="m-0 font-weight-bold text-primary tabletitle"><?php echo $tabletitle; ?>
			<!-- bottone aggiungi nuovo -->
			</h4>

			<!-- fine bottone aggiungi nuovo -->

			</div> <!-- end # card-header py-3-->
		</div>	 <!-- end  # card-header-shadow -->

		<div id = "card-body" class="card-body">
			<div id = "table-responsive" class="table-responsive">
				<?php
                $formattributes = array(
                    'id' => 'suppliers_instock',
                    'class' => 'issuppl issuppl-form',
                );
				echo form_open(site_url($siteurl), $formattributes);
				foreach($tablearray['formfields'] as $field=>$attr){
					if(!isset($attr['type'])){
						echo form_input($attr);
					} else{
						echo "<div class='form-group col-md-6'>";
						echo form_dropdown('suppliers', $suplist, 'choose', $attr);
						echo "</div>";
					}
					
				}
				
				if(isset($wahcenlist)){
					
					echo "<div class='form-group col-md-6'>";
					$attr = array(
						'id' => 'wahcenlist',
						'class' => 'form-control disablefirst',
					);
					echo form_dropdown('wahcenlist', $wahcenlist, 'choose', $attr);
					echo "</div>";
				}
				//submit
				if(isset($tablearray['submitbtn'])){
					$submitlabel = $tablearray['submitbtn']['label'];
				} else{
					$submitlabel = 'Salva';
				}
				

				?>
				<!-- submit button -->
				<div class = "col-md-6 form-group"> <!-- form group-->
				<button type="submit" class="btn btn-primary" name = "submit"><?php echo $submitlabel; ?></button>
				</div> <!-- end form-group -->

			</div>	<!-- end # table-responsive  card shadow mb-4 -->
		</div>	<!-- end # card-body  card shadow mb-4 -->

	</div>	<!-- end # registry-container  card shadow mb-4 -->

</div> 	<!-- end container-fluid -->
</body>
</html>