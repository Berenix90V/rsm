<!DOCTYPE html>
<html lang="en">

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// parametri dipendenti dalla tabella di riferimento
/*$tabletitle = $tablearray['tabletitle'];
$orderfield = $tablearray['orderfield'];
$pre = $tablearray['pre'];
$addnew = $tablearray['addnew'];*/
?>


<body>
<!-- Begin Page Content -->
<div class="container-fluid">
    
    <h4 class="h3 mb-2 text-gray-800 inlineblock">
    <a href="#" class="btn btn-success btn-circle btn-lg">
        <i class="fas fa-check"></i>
    </a>
    Conferma ricezione
   

    <a href="<?php echo site_url('Outrequests/outrequests_view'); ?>" class="btn btn-primary btn-icon-split addnew-btn button-margin">
		<span class="icon text-white-50">
			<i class="fas fa-angle-left"></i>
		</span>
		<span class="text">Tabella</span>
	</a>
    </h4>

    <div id="registry-container" class="card shadow mb-4 table-container registry">
    

    <div id = "card-header-shadow" class="card shadow mb-4">
        <!-- titolo tabella/ form -->
            <div id = "card-body" class="card-body py-3">
                La merce è stata ritirata con successo
                
            </div> <!-- end # card-body py-3-->
        </div>	 <!-- end  # card-header-shadow -->

    </div>	<!-- end # registry-container  card shadow mb-4 -->

</div> 	<!-- end container-fluid -->
</body>
</html>