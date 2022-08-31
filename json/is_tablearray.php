<?php
$tablearray = array(
   
    'instock_view' => array(
        'tabletitle' => 'Prodotti in deposito',
        'id' => 'STO_ID',
        //'orderfield' => 'PRO_proname',
        //'selectfields' => 'PRS_ID, PRO_proname, PRO_procode, PRO_pack, SUP_supname, PRS_cost, PRS_iva, PRS_active',
        'tableheaders' => array(
            //'PRS_PRO_ID' => 'ID prodotto',
            //'PRS_SUP_ID' => 'ID fornitore',
            //'STO_ID' => 'ID',
            //'STO_PRS_ID' => 'ID Prodotto',
            'PRO_proname' => 'Prodotto',
            'SUP_supname' => 'Fornitore',
            //'STO_WAH_ID' => 'ID magazzino',
            'WAH_wahname' => 'Magazzino',
            'STO_quantity' => 'N confezioni',
            'PRO_pack' => 'Contenuto per confezione',
            'PRS_active' => 'Attivo',
             
        ),
        
        'boolean' => array(
            'PRS_active' => array(
                0 => '<span class="not-active">Non attivo</span>',
                1 => '<span class="is-active">Attivo</span>'
            )
        ),
        'int' => array('STO_quantity'),
        //'id' => 'PRS_ID',
        //'disablefield' => 'STO_active',
        
    ),
);
echo json_encode($tablearray);
