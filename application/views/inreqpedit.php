<!DOCTYPE html>
<html lang="en">

<?php
defined('BASEPATH') OR exit('No direct script access allowed');


?>


<body>
<!-- Begin Page Content -->
<div class="container-fluid">
    
    <h4 class="h3 mb-2 text-gray-800 inlineblock">
    <a href="#" class="btn btn-warning btn-circle btn-lg">
        <i class="fas fa-edit"></i>
    </a>
    Modifica quantità richiesta
   

    <a href="<?php echo site_url('Inrequests/inrequests_view'); ?>" class="btn btn-primary btn-icon-split addnew-btn button-margin">
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
                Quanti pezzi sono disponibili?
                <?php 
                $formattributes = array(
                    'id' => 'pedit',
                    'class' => 'inreq inreqpedit pedit-form'
                );
        
        
                // set hiddenfields
                if(isset($tablearray['hiddenfields'])){
                    $hiddenfields = $tablearray['hiddenfields'];
                } else{
                    $hiddenfields = array();
                }
                // end setting hiddenfields
                echo form_open(site_url($siteurl), $formattributes, $hiddenfields);

                foreach($tablearray['formfields'] as $field=>$value){
                    echo "<div class='form-group col-md-6'>";
        
                    echo form_label($value['label']);
                    //echo form_input($value);
                    switch($value['type']){
                        case 'input':
                            echo form_input($value);
                        break;
                        case 'select':
                            // selected
                            if(isset($value['value'])){
                                $valore = $value['value'];
                                $selected = $valore;
                            } else{
                                $selected = $value['selected'];
                            }
        
                            //parametri vari tra cui class
                            foreach($value as $par => $val){
                                $notvalid = array('name', 'options', 'selected');
                                if(!in_array($par, $notvalid)){
                                    $varie[$par] = $val;
                                }
                            }
                            echo form_dropdown($value['name'], $value['options'], $selected, $varie);
                        break;
                    }
                    echo "</div>"; // close form-group
                    //iprint_r($value);
        
                }
                if(isset($tablearray['submitbtn'])){
                    $submitlabel = $tablearray['submitbtn']['label'];
                } else{
                    $submitlabel = 'Salva';
                }
                ?>

                <div style = 'clear:both'></div>
                
                <div class = "col-md-6 form-group"> <!-- form group-->
                <button type="submit" class="btn btn-primary" name = "submit"><?php echo $submitlabel; ?></button>
                </div> 
                
                
                
            </div> <!-- end # card-body py-3-->
        </div>	 <!-- end  # card-header-shadow -->

    </div>	<!-- end # registry-container  card shadow mb-4 -->

</div> 	<!-- end container-fluid -->
</body>
</html>