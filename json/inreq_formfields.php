<?php
$tablearray = array(
    'requests' => array(
        'psubmit' =>  array(  
            //'pre' => 'REQ',
            //'select' => 'STO_ID, STO_WAH_ID, WAH_wahname',
            'from' => 'requests',
            'wherefield' => 'REQ_ID', 
            
            'formfields' => array(
                'REQ_reqquantity' => array(
                    'label' => 'Quantità richiesta',
                    'name' => 'reqquantity',
                    'id' => 'reqquantity',
                    'class' => 'form-control',
                    'type' => 'input',
                ),               
                'REQ_pwahconfirm' => array(
                    'label' => 'Magazzino richiedente ',
                    'name' => 'reqwahname',
                    'id' => 'reqwahname',
                    'class' => 'form-control picker',
                    'type' => 'input',
                    'samevalue' => 'REQ_reqquantity',
                ),  
            ),
        ),
        'pedit' =>  array(
            'pre' => 'REQ',
            //'select' => 'STO_ID, STO_WAH_ID, WAH_wahname',
            'from' => 'requests_view',
            'wherefield' => 'REQ_ID', 
            
            'formfields' => array(
                'REQ_reqquantity' => array(
                    'label' => 'Quantità richiesta',
                    'name' => 'reqquantity',
                    'id' => 'reqquantity',
                    'class' => 'form-control',
                    'disabled' => true,
                    'type' => 'input',
                ),
                'reqwahname' => array(
                    'label' => 'Magazzino richiedente ',
                    'name' => 'reqwahname',
                    'id' => 'reqwahname',
                    'class' => 'form-control',
                    'disabled' => true,
                    'type' => 'input',
                ),  
                'REQ_pwahconfirm' => array(
                    'label' => 'Quantità disponibile',
                    'name' => 'pwahconfirm',
                    'id' => 'pwahconfirm',
                    'class' => 'form-control',
                    'type' => 'input',
                    'samevalue' => 'REQ_reqquantity',
                ),  
                'PRO_proname' => array(
                    'label' => 'Prodotto richiesto',
                    'name' => 'reqproname',
                    'id' => 'reqproname',
                    'class' => 'form-control',
                    'type' => 'input',
                    'disabled' => true,
                ), 
                
                'PRO_measureunit' => array(
                    'label' => 'Unità di misura',
                    'name' => 'reqpromeasureunit',
                    'id' => 'reqpromeasureunit',
                    'class' => 'form-control',
                    'type' => 'input',
                    'disabled' => true,
                ), 
                'PRO_pack' => array(
                    'label' => 'Contenuto per confezione',
                    'name' => 'reqpropack',
                    'id' => 'reqpropack',
                    'class' => 'form-control',
                    'type' => 'input',
                    'disabled' => true,
                ), 
                'SUP_supname' => array(
                    'label' => 'Fornitore',
                    'name' => 'supname',
                    'id' => 'supname',
                    'class' => 'form-control',
                    'type' => 'input',
                    'disabled' => true,
                ), 
            ),
            'hiddenfields' => array(
                'table' => 'requests',
                'REQ_ID' => '',
            ),
            'int' => array('REQ_reqquantity', 'REQ_pwahconfirm', 'REQ_rwahconfirm'),
        ),
        'peditsubmit' =>  array(
            'pre' => 'REQ',
            //'select' => 'STO_ID, STO_WAH_ID, WAH_wahname',
            'from' => 'requests_view',
            'wherefield' => 'REQ_ID', 
            'id' => 'REQ_ID',
            
            'formfields' => array( 
                'REQ_pwahconfirm' => array(
                    'label' => 'Quantità disponibile',
                    'name' => 'pwahconfirm',
                    'id' => 'pwahconfirm',
                    'class' => 'form-control',
                    'type' => 'input',
                    'samevalue' => 'REQ_reqquantity',
                ),   
            ),
            'hiddenfields' => array(
                'table' => 'requests',
                'REQ_ID' => '',
            ),
            'int' => array('REQ_reqquantity', 'REQ_pwahconfirm', 'REQ_rwahconfirm'),
        ),
        'choosewah' =>  array(             
            'admin' => array(
                'tabletitle' => 'Scegli magazzino',
                'query' => array(
                    //'pre' => 'REQ',
                    'select' => 'WAH_ID, WAH_wahname, WAH_wahcategory, WAH_active',
                    'from' => 'warehouses', 
                    'orderby' => 'WAH_wahname',
                ), 
                'formfields' => array(
                    'WAH_wahname' => array(
                        'name' => 'wahname',
                        'id' => 'wahname',
                        'label' => 'Magazzino richiedente',
                        'class' => 'form-control disablefirst',
                        'selected' => 'choose',
                        'type' => 'select',
                    ),  
                    'prowahname' => array(
                        'name' => 'prowahname',
                        'id' => 'prowahname',
                        'label' => 'Magazzino destinatario',
                        'class' => 'form-control disablefirst',
                        'selected' => 'choose',
                        'type' => 'select',
                    ),  
                ),
            ), 
            'wah' => array(
                'tabletitle' => 'Scegli magazzino',
                'query' => array(
                    //'pre' => 'REQ',
                    'select' => 'WAH_ID, WAH_wahname, WAH_wahcategory, WAH_active',
                    'from' => 'warehouses', 
                    'orderby' => 'WAH_wahname',
                ), 
                'formfields' => array(
                    'WAH_wahname' => array(
                        'label' => 'Magazzino richiedente',
                        'name' => 'wahname',
                        'id' => 'wahname',
                        'class' => 'form-control disablefirst',
                        'selected' => 'choose',
                        'type' => 'select',
                    ),   
                ),
            ), 
            'wahrep' => array(
                'tabletitle' => 'Scegli magazzino',
                'query' => array(
                    //'pre' => 'REQ',
                    'select' => 'WAH_ID, WAH_wahname, WAH_wahcategory, WAH_active',
                    'from' => 'warehouses', 
                    'orderby' => 'WAH_wahname',
                ), 
                'formfields' => array(
                    'WAH_wahname' => array(
                        //'label' => '',
                        'name' => 'wahname',
                        'id' => 'wahname',
                        'class' => 'form-control disablefirst',
                        'selected' => 'choose',
                        'type' => 'select',
                    ),   
                ),
            ),             
        ),
        'wahtable' => array(
            'tabletitle' => 'Richieste da magazzino',
            'query' => array(
                'select' => 'REQ_ID, REQ_prowahid, REQ_reqwahid, PRO_proname, STO_quantity, REQ_reqquantity, REQ_pwahconfirm',
                'from' => 'requests_view',
                'orderfield' => 'PRO_proname',
            ),
            'headers' => array(
                'PRO_proname' => 'Prodotto',

            ),
            'formfields' => array(
                'STO_quantity' => array(
                    'name' => 'stoquantity',
                    'id' => 'stoquantity',
                    'label' => 'Q in deposito',
                    'class' => 'form-control',
                    'readonly' => true,
                ),
                'REQ_reqquantity' => array(
                    'name' => 'reqquantity',
                    'id' => 'reqquantity',
                    'label' => 'Q richiesta',
                    'class' => 'form-control',
                    'readonly' => true,
                ),
                'REQ_ID' => array(
                    'name' => 'reqid',
                    'id' => 'reqid',
                    'label' => 'REQ_ID',
                    'class' => 'form-control',
                    'readonly' => true,
                ),
                'REQ_prowahid' => array(
                    'name' => 'prowahid',
                    'id' => 'prowahid',
                    'label' => 'ID mag prodotto',
                    'class' => 'form-control',
                    'readonly' => true,
                ),
                'REQ_reqwahid' => array(
                    'name' => 'reqwahid',
                    'id' => 'reqwahid',
                    'label' => 'ID mag richiedente',
                    'class' => 'form-control',
                    'readonly' => true,
                ),
                'REQ_pwahconfirm' => array(
                    'name' => 'pwahconfirm',
                    'id' => 'pwahconfirm',
                    'label' => 'Q in trasferimento',
                    'class' => 'form-control',
                ),                
            ),   
            'int' => array('STO_quantity', 'REQ_reqquantity', 'REQ_pwahconfirm'),  
            'tablesubmit' => array(
                'reqid' => 'REQ_ID',
                'pwahconfirm' => 'REQ_pwahconfirm',
            ),   
        ),
    ),
);
echo json_encode($tablearray);
