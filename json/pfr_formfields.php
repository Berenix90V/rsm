<?php
$tablearray = array(
    'productssuppliers' => array(
        'addnew' =>  array(
            //'tabletitle' => 'Prodotti - Fornitori',
            //'orderfield' => 'PRO_proname',
            //'pre' => 'PRS',
            'cardtitle' => 'Aggiungi nuova voce Prodotti - Fornitori',
            
            'formfields' => array(
                'PRO_name' => array(
                    'label' => 'Prodotto',
                    'name' => 'proname',
                    'id' => 'proname',
                    'class' => 'form-control picker',
                    'type' => 'input',
                    'autocomplete' => 'off',
                ),
                'SUP_name' => array(
                    'label' => 'Fornitore',
                    'name' => 'supname',
                    'id' => 'supname',
                    'class' => 'form-control picker',
                    'type' => 'input',
                    'autocomplete' => 'off',
                ),
                'PRS_cost' => array(
                    'label' => 'Prezzo (euro)',
                    'name' => 'cost',
                    'id' => 'cost',
                    'class' => 'form-control',
                    'type' => 'input',
                    /*'specialtype' => 'number',
                    'step' => '0.01',*/
                    'title' => 'Numero decimale a 2 cifre decimali es.: 1.23',
                    'pattern' => '([0-9]{1}).([0-9]{1,2})',
                ),
                'PRS_iva' => array(
                    'label' => 'IVA (%)',
                    'name' => 'iva',
                    'id' => 'iva',
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
            ),
            'hiddenfields' => array(
                'table' => 'productssuppliers',
                'PRS_start' => date("d-m-Y H:i:s"),
                'PRS_PRO_ID' => '',
                'PRS_SUP_ID' => '',
                'PRS_active' => true,
            ),
            'submitbtn' => array(
                'label' => 'Salva'
            )
        ),
        'submit' =>  array(
            //'tabletitle' => 'Prodotti',
            //'orderfield' => 'PRO_proname',
            'pre' => 'PRS',
            //'cardtitle' => 'Modifica prodotto',
            //'id' => 'PRS_ID',
            
            'formfields' => array(
                'PRS_cost' => array(
                    'label' => 'Prezzo',
                    'name' => 'cost',
                    'id' => 'cost',
                    'class' => 'form-control',
                    'type' => 'input'
                ),
                'PRS_iva' => array(
                    'label' => 'IVA',
                    'name' => 'iva',
                    'id' => 'iva',
                    'class' => 'form-control',
                    'type' => 'input'
                ),     
            ),
            'hiddenfields' => array(
                'table' => 'productssuppliers',
                'PRS_start' => '',
                'PRS_PRO_ID' => '',
                'PRS_SUP_ID' => '',
                'PRS_active' => true,
            ),
            'submitbtn' => array(
                'label' => 'Salva'
            )
        ),
        'edit' =>  array(
            //'tabletitle' => 'Prodotti - Fornitori',
            //'orderfield' => 'PRO_proname',
            //'pre' => 'PRS',
            'cardtitle' => 'Modifica voce Prodotti - Fornitori',
            'id' => 'PRS_ID',
            
            'formfields' => array(
                'PRO_proname' => array(
                    'label' => 'Prodotto',
                    'name' => 'proname',
                    'id' => 'proname',
                    'class' => 'form-control picker',
                    'type' => 'input',
                    'autocomplete' => 'off',
                ),
                'SUP_supname' => array(
                    'label' => 'Fornitore',
                    'name' => 'supname',
                    'id' => 'supname',
                    'class' => 'form-control picker',
                    'type' => 'input',
                    'autocomplete' => 'off',
                ),
                'PRS_cost' => array(
                    'label' => 'Prezzo (euro)',
                    'name' => 'cost',
                    'id' => 'cost',
                    'class' => 'form-control',
                    'type' => 'input'
                ),
                'PRS_iva' => array(
                    'label' => 'IVA (%)',
                    'name' => 'iva',
                    'id' => 'iva',
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
                'PRS_active'=>  array(
                    'label' => 'Attivo',
                    'name' => 'prsactive', 
                    'class' => 'form-control',               
                    'type' => 'select',
                    'options' => array(
                        0 => 'Non attivo',
                        1 => 'Attivo',
                    ),
                ),             
            ),
            'hiddenfields' => array(
                'table' => 'productssuppliers',
                //'PRS_start' => true
                'PRS_PRO_ID' => '',
                'PRS_SUP_ID' => '',
                'PRS_end' =>  date("d-m-Y H:i:s"),
            ),
            'submitbtn' => array(
                'label' => 'Salva'
            )
        ),
        'submitedit' =>  array(
            //'tabletitle' => 'Prodotti - Fornitori',
            //'orderfield' => 'PRO_proname',
            'pre' => 'PRS',
            //'cardtitle' => 'Modifica voce Prodotti - Fornitori',
            'id' => 'PRS_ID',
            
            'formfields' => array(
                'PRS_cost' => array(
                    'label' => 'Prezzo (euro)',
                    'name' => 'cost',
                    'id' => 'cost',
                    'class' => 'form-control',
                    'type' => 'input'
                ),
                'PRS_iva' => array(
                    'label' => 'IVA (%)',
                    'name' => 'iva',
                    'id' => 'iva',
                    'class' => 'form-control',
                    'type' => 'input'
                ),
                'PRS_active'=>  array(
                    'label' => 'Attivo',
                    'name' => 'prsactive', 
                    'class' => 'form-control',               
                    'type' => 'select',
                    'options' => array(
                        0 => 'Non attivo',
                        1 => 'Attivo',
                    ),
                ),             
            ),
            'hiddenfields' => array(
                'table' => 'productssuppliers',
                //'PRS_start' => true
                'PRS_PRO_ID' => '',
                'PRS_SUP_ID' => '',
                'PRS_end' =>  date("d-m-Y H:i:s"),
            ),
            'submitbtn' => array(
                'label' => 'Salva'
            )
        ),
        'disable' => array(
            'tabletitle' => 'Prodotti - Fornitori',
            //'orderfield' => 'PRO_proname',
            'pre' => 'PRS',
            'addnew' => 'Aggiungi nuova voce Prodotto-Fornitore',
            //'selectfields' => 'PRO_proname, PRO_code, PRO_pack, SUP_supname, PRS_cost, PRS_iva, PRS_start, PRS_end, PRS_active',
            'tableheaders' => array(
                'PRS_PRO_ID' => 'ID prodotto',
                'PRS_SUP_ID' => 'ID fornitore',
                //'PRO_proname' => 'Prodotto',
                //'PRO_code' => 'Codice',
                //'PRO_pack' => 'Contenuto per confezione',
                //'SUP_supname' => 'Fornitore',
                'PRS_cost' => 'Prezzo',
                'PRS_iva' => 'IVA',
                //'PRS_start' => 'Data creazione',
                //'PRS_end' => 'Data di decadimento',
                //'PRS_active' => 'Attivo',            
            ),
            'id' => 'PRS_ID',
            'boolean' => array(
                'PRS_active' => array(
                    0 => '<span style = "color: red;">Non attivo</span>',
                    1 => '<span style = "color: green;">Attivo</span>'
                )
            ),
            'disablefield' => 'PRS_active',
            
        ),
    ),
);
echo json_encode($tablearray);
