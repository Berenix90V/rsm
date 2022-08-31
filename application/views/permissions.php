


 <!-- header -->
 <!--div id = "card-header-shadow" class="card shadow mb-4">
        
            <div id = "card-header" class="card-header py-3">
                <h5 class="m-0 font-weight-bold text-primary tabletitle">Permessi</h5>
            </div> 
</div-->	 <!-- end  # card-header-shadow -->

<h4 class="m-0 font-weight-bold text-primary tabletitle" style = "padding-bottom:15px; padding-top:15px">Permessi</h4>
<?php
$result = $this->Registry_model->permissions();
$permissions = $tablearray['permissions'];
if(isset($ref)){
    $permissions = $this->Registry_model->permissions_edit($permissions, $ref);
    //iprint_r($permissions);
}



foreach($result as $cat=>$wahs){
    $options = array(
        'choose' => 'Scegli magazzino',
    );
    foreach($wahs as $wahid=>$wahname){
        $options[$wahid] = $wahname;    
    }

    if($cat == 'centrali'){
        // select magazzino principale
        echo "<div class='form-group col-md-6 centrali'>";
        $selattr = $permissions['centrali'];
        /*$selattr = array(
            'name' => 'cwahlist',
            'id' => 'cwahlist',
            'label' => 'Assegna magazzino centrale più usato',
            'class' => 'form-control disablefirst',
            'selected' => 'choose',
        );*/
        echo form_label($selattr['label'], $selattr['id']);
        echo form_dropdown($selattr['name'], $options, $selattr['selected'], $selattr);
        echo "</div>"; // centrali
    } elseif($cat == 'reparti'){
        // select magazzino principale
        echo "<div class='form-group col-md-6 reparti'>";
        $selattr = $permissions['reparti'];
        /*$selattr = array(
            'name' => 'rwahlist',
            'id' => 'rwahlist',
            'label' => 'Assegna magazzino reparto più usato',
            'class' => 'form-control disablefirst',
            'selected' => 'choose',
        );*/
        echo form_label($selattr['label'], $selattr['id']);
        echo form_dropdown($selattr['name'], $options, $selattr['selected'], $selattr);
        echo "</div>"; // reparti
    }
    
}

foreach($result as $cat=>$wahs){   
    // LISTE CHECKBOX
    if($cat == 'centrali'){ 
        echo "<div class='form-group col-md-6 centrali'>";
        $listlab = 'Lista Centrali';
        echo form_label($listlab);
        $classe = 'cen';
    }
    if($cat == 'reparti'){
        echo "<div class='form-group col-md-6 reparti'>";
        $listlab = 'Lista Reparti';
        echo form_label($listlab);  
        $classe = 'rep'; 
    }
    echo "<div style = 'clear:both'></div>";
    
    foreach($wahs as $wahid=>$wahname){
        $attr = $permissions['totali'];
        $attr['label'] = $wahname;
        /*$attr = array(
            'name'          => 'wah_'.$wahid,
            'id'            => 'wah_'.$wahid,
            'value'         => 1,
            //'class'         => 'form-check-input',
            'checked'       => FALSE,
            'style'         => 'margin:10px',
            'label'         => $wahname,
        );*/
        $attr['class'] = $attr['class'].' '.$classe;
        foreach($attr as $key => $value){
            
            if($key == 'name' || $key == 'id'){
                $attr[$key] = $value.$wahid;
            }
        }  
        if(isset($permissions['wahlist'])){
            if(isset($permissions['wahlist']['tot'])){
                $totale = $permissions['wahlist']['tot'];
            }
            
            if(isset($permissions['wahlist']['rep'])){
                $repartomain = $permissions['wahlist']['rep'];
            }
            if(isset($permissions['wahlist']['cen'])){
                $centralemain = $permissions['wahlist']['cen'];
            }
            
            if(isset($totale) && $totale !=='' && in_array($wahid, $totale)){
                $attr['checked'] = true;
            } elseif(isset($repartomain) && $wahid == $repartomain){
                $attr['checked'] = true;
                $attr['disabled'] = true;
            } elseif(isset($centralemain) && $wahid == $centralemain){
                $attr['checked'] = true;
                $attr['disabled'] = true;
            }
        }  
        echo form_checkbox($attr);
        $labattr = array(
            'class' => 'form-check-label '.$classe,
        );
        echo form_label($attr['label'], $attr['id'], $labattr);
        echo '</br>';
        
    }
    echo "</div>";
}




?>
