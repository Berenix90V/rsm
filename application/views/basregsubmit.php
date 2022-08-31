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
    Salvataggio avvenuto con successo

    <?php
    if($mode=='addnew'){
    ?>
    <a href="<?php echo site_url('Registry/basicregistry_addnew?regtab='.$regtab); ?>" class="btn btn-primary btn-icon-split addnew-btn">
		<span class="icon text-white-50">
			<i class="fas fa-plus"></i>
		</span>
		<span class="text">Aggiungi nuovo</span>
    </a>
    <?php
    }
    ?>

    <a href="<?php echo site_url('Registry/basicregistry?regtab='.$regtab); ?>" class="btn btn-primary btn-icon-split addnew-btn button-margin">
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