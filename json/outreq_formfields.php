<?php
$tablearray = array(
    'requests' => array(
        'rconfsubmit' =>  array(
            'pre' => 'REQ',
            'id' => 'REQ_ID',
            'wherefield' => 'REQ_ID',
            'from' => 'requests_view',
            'table' => 'requests',
            
            'formfields' => array(
                'REQ_rwahconfirm' => array(
                    'label' => 'ID prodotto - magazzino',
                    'name' => 'stoprsid',
                    'id' => 'stoprsid',
                    'class' => 'form-control',
                    'type' => 'input',
                    'value' => 1,
                ),  
            ),
            'hiddenfields' => array(
                'table' => 'requests',
                'STO_PRS_ID' => '',
                'STO_WAH_ID' => '',
            ),
            'submitbtn' => array(
                'label' => 'Salva',
            ),
        ),        
    ),
);
echo json_encode($tablearray);
