<?php
$tablearray = array(
    'requests' => array(
        'addnew' =>  array(
            //'tabletitle' => 'Prodotti in deposito',
            //'orderfield' => 'PRO_proname',
            //'pre' => 'REQ',
            'cardtitle' => 'Fai una nuova Richiesta',
            //'select' => 'STO_ID, STO_WAH_ID, WAH_wahname',
            'from' => 'instock_view',
            'wherefield' => 'STO_ID', 

            'conversion' => array(
                'STO_WAH_ID' => 'REQ_prowahid',
                'STO_ID' => 'REQ_STO_ID',
                'WAH_wahname' => 'REQ_prowahname'
            ),
            
            'formfields' => array(
                'REQ_reqquantity' => array(
                    'label' => 'Quantità richiesta',
                    'name' => 'reqquantity',
                    'id' => 'reqquantity',
                    'class' => 'form-control',
                    'type' => 'input',
                ),                
                'REQ_reqwahname' => array(
                    'label' => 'Magazzino richiedente ',
                    'name' => 'reqwahname',
                    'id' => 'reqwahname',
                    'class' => 'form-control picker',
                    'type' => 'input',
                ), 
                'STO_quantity' => array(
                    'label' => 'Quantità disponibile a magazzino',
                    'name' => 'quantity',
                    'id' => 'quantity',
                    'class' => 'form-control',
                    'type' => 'input',
                    'disabled' => true,
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
                'REQ_prowahname' => array(
                    'label' => 'Magazzino destinatario della richiesta',
                    'name' => 'prowahname',
                    'id' => 'prowahname',
                    'class' => 'form-control',
                    'type' => 'input',
                    'disabled' => true,
                ),   
            ),
            'hiddenfields' => array(
                'table' => 'requests',
                'REQ_STO_ID' => '',
                'REQ_reqwahid' => '',
                'REQ_reqdate' => date("Y-m-d H:i:s"),
            ),
            'submitbtn' => array(
                'label' => 'Salva'
            ),
            'int' => array('STO_quantity'),
        ),
        'submit' =>  array(
            'pre' => 'REQ',
            'id' => 'REQ_ID',
            
            'formfields' => array(
                'REQ_reqquantity' => array(
                    'label' => 'Quantità richiesta',
                    'name' => 'reqquantity',
                    'id' => 'reqquantity',
                    'class' => 'form-control',
                    'type' => 'input',
                ),      
            ),
            'hiddenfields' => array(
                'table' => 'requests',
                'REQ_STO_ID' => '',
                'REQ_reqwahid' => '',
                'REQ_reqdate' => '',
            ),
            'submitbtn' => array(
                'label' => 'Salva'
            )
        ),
        'batch' => array(
            'choosewah' => array(
                'admin' => array(
                    'tabletitle' => 'Scegli un magazzino',
                    'formfields' => array(
                        'WAH_ID' => array(
                            'name' => 'wahid',
                            'id' => 'wahid',
                            'label' => 'Magazzino fornitore',
                            'class' => 'form-control disablefirst',
                            'type' => 'select',
                        ),  
                        'reqwahid' => array(
                            'name' => 'reqwahid',
                            'id' => 'reqwahid',
                            'label' => 'Magazzino richiedente',
                            'class' => 'form-control disablefirst instockwah',
                            'type' => 'select'
                        ),   
                    ),
                    'query' => array(
                        'select' => 'WAH_ID, WAH_wahname',
                        'from' => 'warehouses',
                        'orderby' => 'WAH_wahname',
                    ),
                ),
                'rep' => array(
                    'tabletitle' => 'Scegli un magazzino',
                    'formfields' => array(
                        'WAH_ID' => array(
                            'name' => 'wahid',
                            'id' => 'wahid',
                            'label' => 'Magazzino fornitore',
                            'class' => 'form-control disablefirst',
                            'type' => 'select',
                        ),  
                        'reqwahid' => array(
                            'name' => 'reqwahid',
                            'id' => 'reqwahid',
                            'label' => 'Magazzino richiedente',
                            'class' => 'form-control disablefirst instockwah',
                            'type' => 'select'
                        ),        
                    ),
                    'query' => array(
                        'select' => 'WAH_ID, WAH_wahname',
                        'from' => 'warehouses',
                        'orderby' => 'WAH_wahname',
                    ),
                ),
                
                'wahrep' => array(
                    'tabletitle' => 'Scegli un magazzino',
                    'formfields' => array(
                        'WAH_ID' => array(
                            'name' => 'wahid',
                            'id' => 'wahid',
                            'label' => 'Magazzino fornitore',
                            'class' => 'form-control disablefirst',
                            'type' => 'select',
                        ),  
                        'reqwahid' => array(
                            'name' => 'reqwahid',
                            'id' => 'reqwahid',
                            'label' => 'Magazzino richiedente',
                            'class' => 'form-control disablefirst instockwah',
                            'type' => 'select'
                        ),       
                    ),
                    'query' => array(
                        'select' => 'WAH_ID, WAH_wahname',
                        'from' => 'warehouses',
                        'orderby' => 'WAH_wahname',
                    ),
                ),
                
            ),
            'requests_view' => array(
                'tabletitle' => 'Richieste',
                'headers' => array(
                    'PRO_proname' => 'Prodotto',
                    'PRO_pack' => 'Contenuto confezione', 
                    'PRO_measureunit' => 'um', 
                    'STO_quantity' => 'q in deposito',
                ),
                'formfields' => array(
                    'REQ_reqquantity' => array(
                        'name' => 'reqquantity',
                        'id' => 'reqquantity',
                        'label' => 'Quantità richiesta',
                        'class' => 'form-control'
                    ),
                    'STO_ID' => array(
                        'name' => 'stoid',
                        'id' => 'stoid',
                        'label' => 'STO_ID',
                        'class' => 'form-control',
                        'readonly' => 'true',
                    ),
                    'STO_WAH_ID' => array(
                        'name' => 'stowahid',
                        'id' => 'stowahid',
                        'label' => 'STO_WAH_ID',
                        'class' => 'form-control',
                        'readonly' => 'true',
                    ),
                ),
                'hiddenfields' => array(
                    'reqdate' => date("Y-m-d H:i:s"), 
                ),
                'int' => array('STO_quantity'),
            ),
            'batchsubmit' => array(
                'tabletitle' => 'Salvataggio',
                'formfields' => array(
                    'stoid' => 'REQ_STO_ID',
                    'reqquantity' => 'REQ_reqquantity', 
                    'reqwahid' => 'REQ_reqwahid',
                    'reqdate' => 'REQ_reqdate',
                ),
            ),
        ),
    ),
);
echo json_encode($tablearray);
