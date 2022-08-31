<!DOCTYPE html>
<html lang="en">

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(!isset($mode)){
    $mode = '';
}

// parametri dipendenti dalla tabella di riferimento

$cardtitle = $tablearray['cardtitle'];
//iprint_r($tablearray);
?>


<body>
<!-- Begin Page Content -->
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Anagrafica di base 

        <a href="<?php echo site_url('Registry/basicregistry?regtab='.$regtab); ?>" class="btn btn-primary btn-icon-split addnew-btn button-margin">
            <span class="icon text-white-50">
                <i class="fas fa-angle-left"></i>
            </span>
            <span class="text">Tabella</span>
        </a>
        
    </h1>

    <div id="registry-container" class="card shadow mb-4 table-container registry <?php echo $mode; ?>">

        <!-- header -->
        <div id = "card-header-shadow" class="card shadow mb-4">
        <!-- titolo tabella/ form -->
            <div id = "card-header" class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary tabletitle"><?php echo $cardtitle; ?></h4>
            </div> <!-- end # card-header py-3-->
        </div>	 <!-- end  # card-header-shadow -->

        <!-- body card -->
        <div id = "card-body" class="card-body">
        <?php
        $formattributes = array(
            'id' => $regtab.'_addnew',
            'class' => $regtab.' basic-registry br-form'
        );


        // set hiddenfields
        if(isset($tablearray['hiddenfields'])){
            $hiddenfields = $tablearray['hiddenfields'];
        } else{
            $hiddenfields = array();
        }
        // end setting hiddenfields

        echo form_open(site_url($siteurl), $formattributes, $hiddenfields);

        //iprint_r($tablearray['formfields']);

        foreach($tablearray['formfields'] as $field=>$value){
            if($field !== 'othertable'){
                echo "<div class='form-group col-md-6'>";
                echo form_label($value['label']);
                switch($value['type']){
                    case 'input':
                        if(isset($value['specialtype'])){
                            $value['type'] = $value['specialtype'];
                        }
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
                            if(isset($value1['speciatype'])){
                                $value1['type'] = $value1['specialtype'];
                                unset($value1['specialtype']);
                            }
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
        if($regtab == 'users'){
            echo "<div style = 'clear:both'></div>";
            //iprint_r($tablearray);
            $this->load->view('permissions');

        }
        //iprint_r($tablearray['submitbtn']);
       
        

        // bottone salva
        if(isset($tablearray['submitbtn'])){
            $submitlabel = $tablearray['submitbtn']['label'];
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