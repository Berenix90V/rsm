<?php
$tablearray = array(
    'inv_r_tableview'=> array(
        'tabletitle' => 'Inventario',
        'lastrequests_view'=> array(
            
            'select' => ('STO_PRS_ID, PRO_proname, PRO_procategory, PRO_measureunit, totrequests, PRS_pzcostiva' ),
            'from'=>'lastrequests_view',
            'wherefield' => 'REQ_reqwahid',
            'headers' => array(
                'PRO_proname' => 'Prodotto' , 
                'PRO_procategory' => 'Centri di costo',
                'PRO_measureunit' => 'Unità di misura', 
                'begininv' => 'Inventario iniziale',
                'totrequests' => 'Pezzi richiesti',                   
                'endinv' => 'Inventario finale',
                'consumption' => 'Consumi',
                'totalcost' => 'Costo totale consumi',
                'PRS_pzcostiva' => 'Costo pz (euro)',   
            ),
            'tot' => array(
                'select' => ('STO_PRS_ID, PRO_proname, PRO_procategory, PRO_measureunit, totrequests, PRS_pzcostiva' ),
                'from'=>'lastrequests_view',
                'wherefield' => 'REQ_reqwahid',
                'headers' => array(
                    'Category' => 'Centri di costo' , 
                    'Totalcolumn' => 'Totale',  
                ),
            ),
            'selectform' => array( // ricordarsi di aggiornare anche il json br_tablearray e br_formfields
                'PRO_procategory' => array(
                    'choose' => '',
                    1 => 'Idratazione',
                    2 => 'Alimentare',
                    3 => 'Farmaci',
                    4 => 'Biancheria',
                    5 => 'Igiene',
                ),
            ),
        ),

        'inventorydone_view'=> array(
            
            'select' => ('STO_PRS_ID, PRO_proname, PRO_procategory, PRO_measureunit, begininv, totrequests, endinv, consumption, totalcost, PRS_pzcostiva'),
            'from'=>'inventorydone_view',
            'wherefield' => 'WAH_ID',
            'headers' => array(
                'PRO_proname' => 'Prodotto' , 
                'PRO_procategory' => 'Centri di costo',
                'PRO_measureunit' => 'Unità di misura', 
                'begininv' => 'Inventario iniziale',
                'totrequests' => 'Pezzi richiesti',                   
                'endinv' => 'Inventario finale',
                'consumption' => 'Consumi',
                'totalcost' => 'Costo totale consumi',
                'PRS_pzcostiva' => 'Costo pz (euro)',  
            ),
            'tot' => array(
                'select' => ('STO_PRS_ID, PRO_proname, PRO_procategory, PRO_measureunit, totrequests, PRS_pzcostiva' ),
                'from'=>'lastrequests_view',
                'wherefield' => 'REQ_reqwahid',
                'headers' => array(
                    'Category' => 'Centri di costo' , 
                    'Totalcolumn' => 'Totale',  
                ),
            ),
            'selectform' => array( // ricordarsi di aggiornare anche il json br_tablearray e br_formfields
                'PRO_procategory' => array(
                    'choose' => '',
                    1 => 'Idratazione',
                    2 => 'Alimentare',
                    3 => 'Farmaci',
                    4 => 'Biancheria',
                    5 => 'Igiene',
                ),
            ),
        ),
        
        'formfields' => array(
            'begininv' => array(
                'label' => 'Inventario iniziale',
                'name'  => 'begininv_',
                'id'    => 'begininv_',
                'class' => 'form-control begininv',
                'value' =>  '',
            ),
            'endinv' => array(
                'label' => 'Inventario finale',
                'name'  => 'endinv_',
                'id'    => 'endinv_',
                'class' => 'form-control endinv',
                'value' =>  '',
            ),
            'consumption' => array(
                'label' => 'Consumi',
                'name'  => 'consumption_',
                'id'    => 'consumption_',
                'class' => 'form-control consumption',
                'value' =>  '',
                'readonly' => true,
            ),
            'totalcost' => array(
                'label' => 'Costo totale',
                'name'  => 'totalcost_',
                'id'    => 'totalcost_',
                'class' => 'form-control totalcost',
                'value' =>  '',
                'readonly' => true,
            ),
        ),
        'int' => array('totrequests', 'begininv', 'endinv', 'consumption'),
        'inventory_list' => array(
            'fields' => array(
                'IL_WAH_ID' => array(
                    'name'  => 'wahid',
                    'id'    => 'wahid',
					'class' => 'form-control wahid',
					'hidden' => true,
                ),
                'IL_inventorydate' => array(
                    'name'  => 'inventorydate',
                    'id'    => 'inventorydate',
					'class' => 'form-control inventorydate',
					'hidden' => true,
					'value' => date('Y-m-d H:i:s'),
                ),
            ),
        ),
        'submitbtn' => array(
            'label' => 'Salva'
        )
    ),
    'inv_r_submit'=>array(
        'inventory_list' => array(
            'fields' => array(
                'IL_WAH_ID' => array(
                    'name'  => 'wahid',
                    'id'    => 'wahid',
					'class' => 'form-control wahid',
                    'hidden' => true,
                ),
                'IL_inventorydate' => array(
                    'name'  => 'inventorydate',
                    'id'    => 'inventorydate',
					'class' => 'form-control inventorydate',
					'hidden' => true,
					//'value' => date('Y-m-d H:i:s'),
                ),
                'IL_inventorytot' => array(
                    'id' => 'totale',
                    'name' => 'totale',
                    'label' => 'Totale',
                    'class' => 'form-control',
                ),
            ),
        ),
        'inventory' => array(
            'fields' => array(
                'INV_PRS_ID' => array(
                    'name'  => 'prsid',
                    'id'    => 'prsid',
					'class' => 'form-control prsid',
					'hidden' => true,
                ),
                'INV_begininv' => array(
                    'name'  => 'begininv',
                    'id'    => 'begininv',
					'class' => 'form-control begininv',
					'hidden' => true,
					
                ),
                'INV_totrequests' => array(
                    'name'  => 'totrequests',
                    'id'    => 'totrequests',
					'class' => 'form-control totrequests',
					'hidden' => true,
					
                ),
                'INV_endinv' => array(
                    'name'  => 'endinv',
                    'id'    => 'endinv',
					'class' => 'form-control endinv',
					'hidden' => true,
					
                ),
                'INV_consumption' => array(
                    'name'  => 'consumption',
                    'id'    => 'consumption',
					'class' => 'form-control consumi',
					'hidden' => true,
					
                ),
                'INV_totalcost' => array(
                    'name'  => 'totalcost',
                    'id'    => 'totalcost',
					'class' => 'form-control totalcost',
					'hidden' => true,
					
                ),
            ),
        ),
        'categories' => array(
            1 => 'Idratazione',
            2 => 'Alimentare',
            3 => 'Farmaci',
            4 => 'Biancheria',
            5 => 'Igiene',
        ),
    ),  
);
echo json_encode($tablearray);
