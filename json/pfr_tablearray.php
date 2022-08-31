<?php
$tablearray = array(
    
    'pf_view' => array(
        'tabletitle' => 'Prodotti - Fornitori',
        'id' => 'PRS_ID',
        //'orderfield' => 'PRO_proname',
        //'addnew' => 'Aggiungi nuova voce Prodotto-Fornitore',
        'selectfields' => 'PRS_ID, PRO_proname, PRO_procode, PRO_pack, SUP_supname, PRS_cost, PRS_iva, PRS_active',
        'tableheaders' => array(
            //'PRS_PRO_ID' => 'ID prodotto',
            //'PRS_SUP_ID' => 'ID fornitore',
            'PRO_proname' => 'Prodotto',
            'PRO_procode' => 'Codice',
            'PRO_pack' => 'Contenuto per confezione',
            'SUP_supname' => 'Fornitore',
            'PRS_cost' => 'Prezzo (euro)',
            'PRS_iva' => 'IVA (%)',
            //'PRS_start' => 'Data creazione',
            //'PRS_end' => 'Data di decadimento',
            'PRS_active' => 'Attivo',            
        ),
        
        'boolean' => array(
            'PRS_active' => array(
                0 => '<span class="not-active">Non attivo</span>',
                1 => '<span class="is-active">Attivo</span>'
            ),
        ),
        'orderfield' => 'PRS_active',
        'disablefield' => 'PRO_active',
        
    ),
);
echo json_encode($tablearray);
