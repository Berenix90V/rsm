<?php
$tablearray = array(
    'products' => array(
        'tabletitle' => 'Prodotti',
        'orderfield' => 'PRO_proname',
        'pre' => 'PRO',
        'selectfields' => 'PRO_ID, PRO_proname, PRO_code, PRO_procategory, PRO_pack, PRO_measureunit, PRO_description, PRO_active',
        'tableheaders' => array(
            'PRO_proname' => 'Nome',
            'PRO_code' => 'Codice',
            'PRO_procategory' => 'Categoria',
            'PRO_pack' => 'Contenuto per confezione',
            'PRO_measureunit' => 'Unità di misura',
            'PRO_description' => 'Descrizione',
            'PRO_active' => 'Attivo'            
        ),
        'id' => 'PRO_ID',
        'boolean' => array(
            'PRO_active' => array(
                0 => '<span class="not-active">Non attivo</span>',
                1 => '<span class="is-active">Attivo</span>'
            )
        ),
        'select' => array( // ricordarsi di aggiornare anche i json inv_reparti e br formfields
            'PRO_procategory' => array(
                'choose' => '',
                1 => 'Guanti',
                2 => 'Igiene ospiti',
                3 => 'Prodotti per incontinenza',
                4 => 'Prodotti monouso',
                5 => 'Materiale di pulizia',
                6 => 'Alimentare',
            ),
        ),
        'disablefield' => 'PRO_active',
        
    ),
    'suppliers' => array(
        'tabletitle' => 'Fornitori',
        'orderfield' => 'SUP_supname',
        'pre' => 'SUP',
        'selectfields' => '*',
        'tableheaders' => array(
            'SUP_supname' => 'Nome',
            'SUP_supaddress' => 'Indirizzo',
            'SUP_supphone' => 'Telefono',            
            'SUP_supmail' => 'E-mail',
            'SUP_active' => 'Attivo'
        ),
        'id' => 'SUP_ID',
        'boolean' => array(
            'SUP_active' => array(
                0 => '<span class="not-active">Non attivo</span>',
                1 => '<span class="is-active">Attivo</span>'
            )
        ),
        'disablefield' => 'SUP_active',
    ),
    'warehouses' => array(
        'tabletitle' => 'Magazzini',
        'orderfield' => 'WAH_wahname',
        'pre' => 'WAH',
        'selectfields' => '*',
        'tableheaders' => array(
            'WAH_wahname' => 'Nome',
            'WAH_wahcategory' => 'Categoria',
            'WAH_active' => 'Attivo'      
            ),
        'id' => 'WAH_ID',
        'boolean' => array(
            'WAH_active' => array(
                0 => '<span class="not-active">Non attivo</span>',
                1 => '<span class="is-active">Attivo</span>',
            ),
            'WAH_wahcategory' => array(
                //'' => '-',
                0 => '-',
                1 => 'Centrale',
                2 => 'Reparto',
            ),
        ),
        'disablefield' => 'WAH_active',
    ),
    'users' => array(
        'tabletitle' => 'Utenti',
        'orderfield' => 'USR_usrname',
        'pre' => 'USR',
        'selectfields' => '*',
        'tableheaders' => array(
            'USR_usrname' => 'Nome',
            'USR_usrmail' => 'E-mail',
            //'USR_usrpsw' => 'Password', 
            'USR_role' => 'Ruolo',
            'permessi_nomi' => 'Permessi',
            'USR_active' => 'Attivo',        
        ),
        'id' => 'USR_ID',
        'boolean' => array(
            'USR_active' => array(
                0 => '<span class="not-active">Non attivo</span>',
                1 => '<span class="is-active">Attivo</span>'
            ),
        ),
        'select' => array(
            'USR_role' => array(
                'admin' => 'Admin',
                'rep' => 'Reparto',
                'wah' => 'Magazziniere',
                'wahrep' => 'Magazziniere + reparto',
            ),
        ),
        'disablefield' => 'USR_active',
        //'psw' => array('USR_psw')     // formato psw
    ),
);
echo json_encode($tablearray);
