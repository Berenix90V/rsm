<!DOCTYPE html>
<html lang="en">

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>


<body>
<!-- Begin Page Content -->
<div class="container-fluid">
    
    <h4 class="h3 mb-2 text-gray-800 tabletitle">
    <a href="#" class="btn btn-success btn-circle btn-lg">
        <i class="fas fa-check"></i>
    </a>
    Modifica avvenuta con successo

    <a href="<?php echo site_url('Inrequests/inrequests_view'); ?>" class="btn btn-primary btn-icon-split addnew-btn button-margin">
		<span class="icon text-white-50">
			<i class="fas fa-angle-left"></i>
		</span>
		<span class="text">Tabella</span>
	</a>

    

    </h4>

    <div id="registry-container" class="card shadow mb-4 table-container registry">


    </div>	<!-- end # registry-container  card shadow mb-4 -->

</div> 	<!-- end container-fluid -->
</body>
</html>