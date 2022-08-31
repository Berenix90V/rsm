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
			<a href="<?php echo site_url('Requests/requests_view'); ?>" class="btn btn-primary btn-icon-split addnew-btn button-margin">
					<span class="icon text-white-50">
						<i class="fas fa-angle-left"></i>
					</span>
					<span class="text">Tabella</span>
				</a>
			<!-- bottone aggiungi nuovo -->
			</h4>

			<!-- fine bottone aggiungi nuovo -->

			</div> <!-- end # card-header py-3-->
		</div>	 <!-- end  # card-header-shadow -->

		<div id = "card-body" class="card-body">
			<div id = "table-responsive" class="table-responsive">
				<?php
                $formattributes = array(
                    'id' => 'wah_batchreq',
                    'class' => 'batchreq wahbatchreq-form',
                );
				echo form_open(site_url($siteurl), $formattributes);
				foreach($tablearray['formfields'] as $field=>$attr){
					echo "<div class='form-group col-md-6'>";
					if(isset($attr['label'])){
						echo form_label($attr['label'], $attr['id']);
					}

					if(!isset($attr['type'])){
						echo form_input($attr);
					} else{
						//echo form_dropdown('wahid', $wahlist, 'choose', $attr);
						if($attr['name'] == 'wahid'){
							echo form_dropdown($attr['name'], $wahlist, $attr['label'], $attr);
						} elseif($attr['name'] == 'reqwahid'){
							echo form_dropdown($attr['name'], $wahreplist, $attr['label'], $attr);
						}
					}
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