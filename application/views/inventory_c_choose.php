<!DOCTYPE html>
<html lang="en">

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>


<body>
<!-- Begin Page Content -->
<div class="container-fluid">
    
    <h1 class="h3 mb-2 text-gray-800"> Inventario reparti </h1>

    <div id="registry-container" class="card shadow mb-4 table-container registry">

    <!-- header -->
        <div id = "card-header-shadow" class="card shadow mb-4">
        <!-- titolo tabella/ form -->
            <div id = "card-header" class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary tabletitle"> Selezionare magazzino per inventario </h4>
            </div> <!-- end # card-header py-3-->
        </div>	 <!-- end  # card-header-shadow -->
    <?php

    
     $formattributes = array(
        'id' => 'wah_choose',
        'class' => 'rep_inventory inventory-form'
    );
    echo form_open(site_url($siteurl), $formattributes);
    // select
    
    echo "<div class='form-group col-md-6'>";
    echo form_label('Scegliere magazzino');
    
    if(isset($wah) && $wah!==''){
        
    
        $varie = array(
            'id' => 'warehouse',
            'class' => 'form-control',
        );
        echo form_dropdown('warehouse', $wahlist, $wah['id'], $varie);
    } else{
        $newwahlist = array();
        $newwahlist[''] = 'Scegli un magazzino';
        foreach($wahlist as $k=>$v){
            $newwahlist[$k] = $v;
        }
        $varie = array(
            'id' => 'warehouse',
            'class' => 'form-control disablefirst',
        );
        echo form_dropdown('warehouse', $newwahlist, '', $varie);   
    }
    echo "</div>"; // close form-group

    //iprint_r($invlist);
    
    ?>
    <div style = 'clear:both'></div>
    <div class = "col-md-6 form-group"> <!-- form group-->
        <button type="submit" class="btn btn-primary" name = "submit">Salva</button>
    </div> <!-- end form-group -->

    <div id = "card-body" class="card-body">
    </div>  <!-- end # card-body  card shadow mb-4 -->

    </div>	<!-- end # registry-container  card shadow mb-4 -->

</div> 	<!-- end container-fluid -->
</body>
</html>