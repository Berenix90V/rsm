<?php
$tablearray = array(
    'inv_c_tableview' => array(
        'tabletitle' => 'Inventario',
        'consumption_lastyear_view'=> array(
            
            'select' => array('CON_STO_ID', 'PRS_ID', 'proname', 'PRO_procategory', 'PRS_pzcostiva', 'anno'),
            'from'=>'consumption_lastyear_view',
            'headers' => array(
                'proname' => 'Prodotto', 
                'PRO_procategory' => 'Centri di costo',
                'measureunit' => 'Unità di misura', 
                'begininv' => 'Inventario iniziale',
                'totrequests' => 'Pezzi richiesti', 
                'consumption' => 'Consumi',                  
                'endinv' => 'Inventario finale', 
                'PRS_pzcostiva' => 'Costo pz (euro)',                  
                'totalcost' => 'Costo totale consumi',               
            ),
        ),
        // LISTA INVENTARI CENTRALI
        'inventory_c_list' => array(
            'fields' => array(
                'ILC_WAH_ID' => array(
                    'name'  => 'wahid',
                    'id'    => 'wahid',
					'class' => 'form-control wahid',
					'hidden' => true,
                ),
                'ILC_inventorydate' => array(
                    'name'  => 'inventorydate',
                    'id'    => 'inventorydate',
					'class' => 'form-control inventorydate',
					'hidden' => true,
					'value' => date('Y-m-d H:i:s'),
                ),
            ),
        ),

    ),
    

);
echo json_encode($tablearray);