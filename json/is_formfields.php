<?php
$tablearray = array(
    'instock' => array(
        'suppliers' => array(
            'select' => 'PRS_SUP_ID, SUP_supname, PRS_active',
            'from' => 'pf_view',
            'where' => 'PRS_active',
            'wherevalue'=> 1,
            'groupby' => 'PRS_SUP_ID',
            'tabletitle' => 'Scegli un fornitore',
            'formfields' => array(
                'SUP_ID' => array(
                    'id' => 'supid',
                    'name' => 'supid',
                    'class' => 'form-control disablefirst',
                    'type' => 'select',
                ),
            ),
            'submitbtn' => array(
                'label' => 'Conferma',
            ),
        ),
        'addnew' =>  array(
            'tabletitle' => 'Prodotti in deposito',
            'orderfield' => 'PRO_proname',
            'pre' => 'STO',
            'cardtitle' => 'Aggiungi nuovo Prodotto in magazzino',
            
            'formfields' => array(
                'STO_PRO_proname' => array(
                    'label' => 'Prodotto',
                    'name' => 'stoproname',
                    'id' => 'stoproname',
                    'class' => 'form-control picker',
                    'type' => 'input',
                    'autocomplete' => 'off',
                ),
                'STO_WAH_wahname' => array(
                    'label' => 'Magazzino',
                    'name' => 'stowahname',
                    'id' => 'stowahname',
                    'class' => 'form-control picker',
                    'type' => 'input',
                    'autocomplete' => 'off',
                ),
                'STO_quantity' => array(
                    'label' => 'Quantità',
                    'name' => 'quantity',
                    'id' => 'quantity',
                    'class' => 'form-control',
                    'type' => 'input'
                ),
                'PRO_pack' => array(
                    'label' => 'Contenuto per confezione',
                    'name' => 'PRO_pack',
                    'id' => 'PRO_pack',
                    'disabled' => true,
                    'class' => 'form-control',
                    'type' => 'input'
                ),
                'PRO_measureunit' => array(
                    'label' => 'Unità di misura',
                    'name' => 'PRO_measureunit',
                    'id' => 'PRO_measureunit',
                    'disabled' => true,
                    'class' => 'form-control',
                    'type' => 'input'
                ), 
                'SUP_supname' => array(
                    'label' => 'Fornitore',
                    'name' => 'SUP_supname',
                    'id' => 'SUP_supname',
                    'disabled' => true,
                    'class' => 'form-control',
                    'type' => 'input'
                ), 
                'PRS_cost' => array(
                    'label' => 'Costo',
                    'name' => 'PRS_cost',
                    'id' => 'PRS_cost',
                    'disabled' => true,
                    'class' => 'form-control',
                    'type' => 'input'
                ),    
                'PRS_totalcost' => array(
                    'label' => 'Costo totale',
                    'name' => 'PRS_totalcost',
                    'id' => 'PRS_totalcost',
                    'disabled' => true,
                    'class' => 'form-control',
                    'type' => 'input'
                ),  
            ),
            
            'hiddenfields' => array(
                'table' => 'instock',
                'STO_PRS_ID' => '',
                'STO_WAH_ID' => '',
            ),
            'submitbtn' => array(
                'label' => 'Salva'
            )
        ),
        'batchcarico' =>  array(
            'tabletitle' => 'Prodotti in deposito',
            'select' => 'PRS_ID, is.STO_ID, pf_view.PRO_proname, pf_view.SUP_supname, is.STO_quantity, is.STO_WAH_ID',
            'from' => 'pf_view',
            'wherefield' => 'PRS_SUP_ID',
            'join' => 'instock_view',
            'orderfield' => 'PRO_proname',
            'pre' => 'STO',
            'cardtitle' => 'Aggiungi Prodotti in magazzino',

            'headers' => array(
                'PRO_proname' => 'Prodotto',
                'SUP_supname' => 'Fornitore',
                //'STO_quantity' => 'in deposito',
            ),
            
            'formfields' => array(  
                'PRS_ID' => array(
                    'label' => 'PRS_ID',
                    'name' => 'prsid',
                    'id' => 'prsid',
                    'class' => 'form-control',
                    'type' => 'input',
                ),
                'STO_ID' => array(
                    'label' => 'STO_ID',
                    'name' => 'stoid',
                    'id' => 'stoid',
                    'class' => 'form-control',
                    'type' => 'input',
                ),        
                'STO_quantity' => array(
                    'label' => 'In deposito',
                    'name' => 'stoquantity',
                    'id' => 'stoquantity',
                    'class' => 'form-control',
                    'type' => 'input',
                    'readonly' => true,
                ),    
                'CON_plus' => array(
                    'label' => 'Carico',
                    'name' => 'qplus',
                    'id' => 'qplus',
                    'class' => 'form-control',
                    'type' => 'input',
                ),    
            ),
            'int' => array('STO_quantity'),
            'hiddenfields' => array(
                'table' => 'instock',
                'STO_PRS_ID' => '',
                'STO_WAH_ID' => '',
            ),
            'submitbtn' => array(
                'label' => 'Salva'
            )
        ),
        'batchsubmit' => array(
            'formfields'=> array(
                'stoid' => 'STO_ID',
                'prsid' => 'STO_PRS_ID',
                'wahid' => 'STO_WAH_ID',
                'sum' => 'STO_quantity',
            ),
            
        ),
        'submit' =>  array(
            'pre' => 'STO',
            //'id' => 'STO_ID',
            
            'formfields' => array(
                'STO_PRS_ID' => array(
                    'label' => 'ID prodotto - magazzino',
                    'name' => 'stoprsid',
                    'id' => 'stoprsid',
                    'class' => 'form-control',
                    'type' => 'input'
                ),
                'STO_WAH_ID' => array(
                    'label' => 'ID magazzino',
                    'name' => 'stowahid',
                    'id' => 'ivastowahid',
                    'class' => 'form-control',
                    'type' => 'input'
                ),
                'STO_quantity' => array(
                    'label' => 'Quantità',
                    'name' => 'quantity',
                    'id' => 'quantity',
                    'class' => 'form-control',
                    'type' => 'input'
                ),      
            ),
            'consumptions' => array(
                
                'CON_PLUS' => array(
                    'name' => 'STO_quantity',
                ),
                'CON_STO_date' => array(
                    'value' => date('Y-m-d H:i:s'),
                ),
            ),
            'hiddenfields' => array(
                'table' => 'instock',
                'STO_PRS_ID' => '',
                'STO_WAH_ID' => '',
            ),
            'submitbtn' => array(
                'label' => 'Salva'
            )
        ),
        'edit' =>  array(
            //'tabletitle' => 'Prodotti in deposito',
            //'orderfield' => 'PRO_proname',
            //'pre' => 'STO',
            'cardtitle' => 'Modifica voce Prodotti in deposito',
            'id' => 'STO_ID',
            
            'formfields' => array(
                'PRO_proname' => array(
                    'label' => 'Prodotto',
                    'name' => 'stoproname',
                    'id' => 'stoproname',
                    'class' => 'form-control picker',
                    'type' => 'input',
                    'autocomplete' => 'off',
                ),
                'WAH_wahname' => array(
                    'label' => 'Magazzino',
                    'name' => 'stowahname',
                    'id' => 'stowahname',
                    'class' => 'form-control picker',
                    'type' => 'input',
                    'autocomplete' => 'off',
                ),
                'STO_quantity' => array(
                    'label' => 'Quantità',
                    'name' => 'quantity',
                    'id' => 'quantity',
                    'class' => 'form-control',
                    'type' => 'input'
                ),
                'PRO_pack' => array(
                    'label' => 'Contenuto per confezione',
                    'name' => 'PRO_pack',
                    'id' => 'PRO_pack',
                    'disabled' => true,
                    'class' => 'form-control',
                    'type' => 'input'
                ),
                'STO_quantity-ref' => array(
                    'label' => 'Correzione in difetto',
                    'name' => 'quantity_correction',
                    'id' => 'quantity_correction',
                    'class' => 'form-control',
                    'type' => 'input'
                ),   
            ),
            'hiddenfields' => array(
                'table' => 'instock',
                'STO_PRS_ID' => '',
                'STO_WAH_ID' => '',
            ),
            'submitbtn' => array(
                'label' => 'Salva'
            )
        ),
        'submitedit' =>  array(
            //'tabletitle' => 'Prodotti in deposito',
            'pre' => 'STO',
            'id' => 'STO_ID',
            
            'formfields' => array(

                'STO_PRS_ID' => array(
                    'label' => 'ID prodotto - magazzino',
                    'name' => 'stoprsid',
                    'id' => 'stoprsid',
                    'class' => 'form-control',
                    'type' => 'input'
                ),
                'STO_WAH_ID' => array(
                    'label' => 'ID magazzino',
                    'name' => 'stowahid',
                    'id' => 'ivastowahid',
                    'class' => 'form-control',
                    'type' => 'input'
                ),
                'STO_quantity' => array(
                    'label' => 'Quantità',
                    'name' => 'quantity',
                    'id' => 'quantity',
                    'class' => 'form-control',
                    'type' => 'input'
                ), 
                 
            ),
            'related_to_others' => array(
                'STO_quantity-ref' => array(
                    'label' => 'Correzione in difetto',
                    'name' => 'quantity_correction',
                    'id' => 'quantity_correction',
                    'class' => 'form-control',
                    'type' => 'input',
                    'refto' => 'STO_quantity',
                    'mode' => 'minus',
                ),   
            ),
            'hiddenfields' => array(
                'table' => 'instock',
                'STO_PRS_ID' => '',
                'STO_WAH_ID' => '',
            ),
            'submitbtn' => array(
                'label' => 'Salva'
            )
        ),
        'plusminus' => array(
            
            'plus' => array(
                'id' => 'STO_ID',
                'cardtitle' => 'Carico',
                'formfields' => array(
                    'STO_plus' => array(
                        'label' => 'Quantità di carico',
                        'name' => 'stoplus',
                        'id' => 'stoplus',
                        'class' => 'form-control plus',
                        'type' => 'input'
                    ),
                    
                ),
                'hiddenfields' => array(
                    'table' => 'instock',
                    'mode' => 'plus',
                    'STO_ID' => '',
                    'STO_quantity' => '',
                    'STO_date' => date("d-m-Y H:i:s"),
                    //'STO_month' => date('m'),
                ),
                'submitbtn' => array(
                    'label' => 'Salva'
                ),
                /*'consumption' => array(
                    'STO_ID' => 'CON_STO_ID',
                    'STO_plus' => 'CON_plus',
                ),*/
            ),
            'minus' => array(
                'id' => 'STO_ID',
                'cardtitle' => 'Scarico',
                'formfields' => array(
                    'STO_minus' => array(
                        'label' => 'Quantità di scarico',
                        'name' => 'stominus',
                        'id' => 'stominus',
                        'class' => 'form-control minus',
                        'type' => 'input'
                    ),
                    
                ),
                'hiddenfields' => array(
                    'table' => 'instock',
                    'mode' => 'minus',
                    'STO_ID' => '',
                    'STO_quantity' => '',
                    'STO_date' => date("d-m-Y H:i:s"),
                    //'STO_month' => date('m')
                ),
                'submitbtn' => array(
                    'label' => 'Salva'
                ),
                /*'consumption' => array(
                    'STO_ID' => 'CON_STO_ID',
                    'STO_minus' => 'CON_minus',
                ),*/
            ),
        ), 
        'submiteditq' =>  array(
            //'tabletitle' => 'Prodotti in deposito',
            'pre' => 'STO',
            'id' => 'STO_ID',
            
            'formfields' => array(
                'STO_quantity' => array(
                    'label' => 'Quantità',
                    'name' => 'quantity',
                    'id' => 'quantity',
                    'class' => 'form-control',
                    'type' => 'input'
                ),       
            ),
            'hiddenfields' => array(
                'table' => 'instock',
                'mode' => '',
                'STO_ID' => '',
                'STO_quantity' => '',
            ),
            'submitbtn' => array(
                'label' => 'Salva'
            ),
            'consumption' => array(
                'STO_ID' => 'CON_STO_ID',
                'stoplus' => 'CON_plus',
                'stominus' => 'CON_minus',
                'STO_date' => 'CON_STO_date',
                //'STO_month' => 'CON_STO_month',
            ),
        ),
    ),
);
echo json_encode($tablearray);
