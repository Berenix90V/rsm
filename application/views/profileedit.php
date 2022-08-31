<!DOCTYPE html>
<html lang="en">

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// parametri dipendenti dalla tabella di riferimento


//iprint_r($tablearray);
?>


<body>
<!-- Begin Page Content -->
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Area riservata        
    </h1>

    <div id="registry-container" class="card shadow mb-4 table-container registry">

        <!-- header -->
        <div id = "card-header-shadow" class="card shadow mb-4">
        <!-- titolo tabella/ form -->
            <div id = "card-header" class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary tabletitle">Modifica profilo</h4>
            </div> <!-- end # card-header py-3-->
        </div>	 <!-- end  # card-header-shadow -->

        <!-- body card -->
        <div id = "card-body" class="card-body">
        <?php
        $formattributes = array(
            'id' => 'editprofile',
            'class' => 'editprofile profile'
        );


        // set hiddenfields
        if(isset($formarray['hiddenfields'])){
            $hiddenfields = $formarray['hiddenfields'];
        } else{
            $hiddenfields = array();
        }
        // end setting hiddenfields

        echo form_open(site_url($siteurl), $formattributes, $hiddenfields);

        //iprint_r($tablearray['formfields']);

        foreach($formarray['formfields'] as $field=>$value){
            if($field !== 'othertable'){
                echo "<div class='form-group col-md-6'>";
                echo form_label($value['label']);
                switch($value['type']){
                    case 'input':
                        echo form_input($value);
                    break;
                    case 'select':
                        // selected
                        if(isset($value['value'])){
                            if($value['value'] == ''){
                            $selected = 0; 
                            }
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
            } else{
                foreach($value as $field1=>$value1){
                    echo "<div class='form-group col-md-6'>";
                    echo form_label($value1['label']);
                    switch($value1['type']){
                        case 'input':
                            echo form_input($value1);
                        break;
                        case 'select':
                            // selected
                            if(isset($value1['value'])){
                                if($value1['value'] == ''){
                                    $selected = 0; 
                                }
                                $valore = $value1['value'];
                                $selected = $valore;
                            } else{
                                $selected = $value1['selected'];
                            }

                            //parametri vari tra cui class
                            foreach($value1 as $par => $val){
                                $notvalid = array('name', 'options', 'selected');
                                if(!in_array($par, $notvalid)){
                                    $varie[$par] = $val;
                                }
                            }
                            echo form_dropdown($value1['name'], $value1['options'], $selected, $varie);
                        break;
                        case 'multiselect':
                            if(isset($value1['value'])){
                                if($value1['value'] == ''){
                                    $selected = 0; 
                                }
                                $valore = $value1['value'];
                                $selected = $valore;
                            } else{
                                $selected = $value1['selected'];
                            }
                            //parametri vari tra cui class
                            foreach($value1 as $par => $val){
                                $notvalid = array('name', 'options', 'selected');
                                if(!in_array($par, $notvalid)){
                                    $varie[$par] = $val;
                                }
                            }
                            echo form_multiselect($value1['name'], $value1['options'], false, $varie);
                        break;
                    }
                    echo "</div>"; // close form-group
                    //iprint_r($value);                    
                }
            }
        }
        
        //iprint_r($tablearray['submitbtn']);
       
        

        // bottone salva
        if(isset($formarray['submitbtn'])){
            $submitlabel = $formarray['submitbtn']['label'];
        } else{
            $submitlabel = 'Salva';
        }
        ?>
        <div style = 'clear:both'></div>

        <!-- bottone clonazione -->
        <!--span class="btn btn-success btn-circle btn-lg" onclick = "NewDoc(this)">
            <i class="fas fa-plus"></i>
        </span-->
        
        <div class = "col-md-6 form-group"> <!-- form group-->
        <button type="submit" class="btn btn-primary" name = "submit"><?php echo $submitlabel; ?></button>
        </div> <!-- end form-group -->

        <!-- fine bottone salva-->

        </div>	<!-- end # card-body  card shadow mb-4 -->

    </div>	<!-- end # registry-container  card shadow mb-4 -->

</div> 	<!-- end container-fluid -->

</body>
</html>