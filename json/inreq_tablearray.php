<?php
$tablearray = array(
    'requests_view' => array(
        'tabletitle' => 'Richieste al magazzino',
        //'orderfield' => 'PRO_proname',
        'id' => 'REQ_ID',
        //'selectfields' => 'PRO_proname, PRO_code, PRO_pack, SUP_supname, PRS_cost, PRS_iva, PRS_start, PRS_end, PRS_active',
        //'selectfields' => 'PRS_ID, PRO_proname, PRO_procode, PRO_pack, SUP_supname, PRS_cost, PRS_iva, PRS_active',
        'tableheaders' => array(
            'PRO_proname' => 'Prodotto',
            //'PRO_pack' => 'Contenuto per confezione',
            'PRO_measureunit' => 'Unità di misura',
            //'SUP_supname' => 'Fornitore',
            'prowahname' => 'Magazzino prodotto',
            'reqwahname' => 'Magazzino richiedente',
            'REQ_reqquantity' => 'Quantità richiesta',
            'REQ_pwahconfirm' => 'Quantità in trasferimento',
            'pconfirm' => 'Conferma magazzino',
            'REQ_rwahconfirm' => 'Conferma richiedente',
             
        ),       
        'int' => array('REQ_reqquantity', 'REQ_pwahconfirm', 'REQ_rwahconfirm'),
    ),
);
echo json_encode($tablearray);
