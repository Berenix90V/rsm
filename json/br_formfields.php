<?php
$tablearray = array(
    'products' => array(
        'addnew' =>  array(
            //'tabletitle' => 'Prodotti',
            //'orderfield' => 'PRO_proname',
            'pre' => 'PRO',
            'cardtitle' => 'Aggiungi nuovo prodotto',
            
            'formfields' => array(
                'PRO_proname' => array(
                    'label' => 'Nome',
                    'name' => 'proname',
                    'class' => 'form-control',
                    'type' => 'input'
                ),
                'PRO_code' => array(
                    'label' => 'Codice',
                    'name' => 'code',
                    'class' => 'form-control',
                    'type' => 'input'
                ),
                'PRO_procategory' => array(
                    'label' => 'Categoria',
                    'name' => 'procategory',
                    'class' => 'form-control disablefirst',
                    'type' => 'select',
                    'selected' => 'choose',
                    'options' => array( // ricordarsi di aggiornare anche i json inv_reparti e br tablearray
                        'choose' => 'Scegli categoria',
                        1 => 'Guanti',
                        2 => 'Igiene ospiti',
                        3 => 'Prodotti per incontinenza',
                        4 => 'Prodotti monouso',
                        5 => 'Materiale di pulizia',
                        6 => 'Alimentare',
                    ),
                ),
                'PRO_pack' => array(
                    'label' => 'Contenuto per confezione',
                    'name' => 'pack',
                    'class' => 'form-control',
                    'type' => 'input',
                    'specialtype' => 'number',
                    'step' => '1'
                ),
                'PRO_measureunit' => array(
                    'label' => 'Unità di misura',
                    'name' => 'measureunit',
                    'class' => 'form-control',
                    'type' => 'input'
                ),
                'PRO_description' =>  array(
                    'label' => 'Descrizione',
                    'name' => 'description', 
                    'class' => 'form-control',               
                    'type' => 'input'
                ),            
            ),
            'hiddenfields' => array(
                'table' => 'products',
                'PRO_active' => true
            ),
            'submitbtn' => array(
                'label' => 'Salva'
            )
        ),
        'edit' =>  array(
            //'tabletitle' => 'Prodotti',
            //'orderfield' => 'PRO_proname',
            'pre' => 'PRO',
            'cardtitle' => 'Modifica prodotto',
            'id' => 'PRO_ID',
            
            'formfields' => array(
                'PRO_proname' => array(
                    'label' => 'Nome',
                    'name' => 'proname',
                    'class' => 'form-control',
                    'type' => 'input'
                ),
                'PRO_code' => array(
                    'label' => 'Codice',
                    'name' => 'code',
                    'class' => 'form-control',
                    'type' => 'input'
                ),
                'PRO_procategory' => array(
                    'label' => 'Categoria',
                    'name' => 'procategory',
                    'class' => 'form-control disablefirst',
                    'type' => 'select',
                    'selected' => 'choose',
                    'options' => array(
                        'choose' => 'Scegli categoria',
                        1 => 'Guanti',
                        2 => 'Igiene ospiti',
                        3 => 'Prodotti per incontinenza',
                        4 => 'Prodotti monouso',
                        5 => 'Materiale di pulizia',
                        6 => 'Alimentare',
                    ),
                ),
                'PRO_pack' => array(
                    'label' => 'Contenuto per confezione',
                    'name' => 'pack',
                    'class' => 'form-control',
                    'type' => 'input',
                    'specialtype' => 'number',
                    'step' => '1',
                ),
                'PRO_measureunit' => array(
                    'label' => 'Unità di misura',
                    'name' => 'measureunit',
                    'class' => 'form-control',
                    'type' => 'input'
                ),
                'PRO_description' =>  array(
                    'label' => 'Descrizione',
                    'name' => 'description', 
                    'class' => 'form-control',               
                    'type' => 'input'
                ),
                'PRO_active'=>  array(
                    'label' => 'Attivo',
                    'name' => 'active', 
                    'class' => 'form-control',               
                    'type' => 'select',
                    'options' => array(
                        0 => 'Non attivo',
                        1 => 'Attivo',
                    ),
                ),      
            ),
            'hiddenfields' => array(
                'table' => 'products',
            ),
            'submitbtn' => array(
                'label' => 'Salva'
            )
        ),
    ),
    'suppliers' => array(
        'addnew' => array(
            //'tabletitle' => 'Fornitori',
            //'orderfield' => 'SUP_supname',
            'pre' => 'SUP',
            'cardtitle' => 'Aggiungi nuovo fornitore',
            
            'formfields' => array(
                'SUP_supname' => array(
                    'label' => 'Nome',
                    'name' => 'supname',
                    'class' => 'form-control',
                    'type' => 'input'
                ),
                'SUP_supaddress' => array(
                    'label' => 'Indirizzo',
                    'name' => 'supaddress',
                    'class' => 'form-control',
                    'type' => 'input'
                ),
                'SUP_supphone' => array(
                    'label' => 'Telefono',
                    'name' => 'supphone',
                    'class' => 'form-control',
                    'type' => 'input'
                ),
                'SUP_supmail' => array(
                    'label' => 'E-mail',
                    'name' => 'supmail',
                    'class' => 'form-control',
                    'type' => 'input',
                    'specialtype' => 'email',
                    'pattern' => '^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$',
                    'title' => 'Digitare e-mail valida',
                ),         
            ),
            'hiddenfields' => array(
                'table' => 'suppliers',
                'SUP_active' => true
            ),
            'submitbtn' => array(
                'label' => 'Salva'
            )
        ),
        'edit' => array(
            //'tabletitle' => 'Fornitori',
            //'orderfield' => 'SUP_supname',
            'pre' => 'SUP',
            'cardtitle' => 'Aggiungi nuovo fornitore',
            'id' => 'SUP_ID',
            
            'formfields' => array(
                'SUP_supname' => array(
                    'label' => 'Nome',
                    'name' => 'supname',
                    'class' => 'form-control',
                    'type' => 'input'
                ),
                'SUP_supaddress' => array(
                    'label' => 'Indirizzo',
                    'name' => 'supaddress',
                    'class' => 'form-control',
                    'type' => 'input'
                ),
                'SUP_supphone' => array(
                    'label' => 'Telefono',
                    'name' => 'supphone',
                    'class' => 'form-control',
                    'type' => 'input'
                ),
                'SUP_supmail' => array(
                    'label' => 'E-mail',
                    'name' => 'supmail',
                    'class' => 'form-control',
                    'type' => 'input'
                ),         
                'SUP_active'=>  array(
                    'label' => 'Attivo',
                    'name' => 'active', 
                    'class' => 'form-control',               
                    'type' => 'select',
                    'options' => array(
                        0 => 'Non attivo',
                        1 => 'Attivo',
                    ),
                ),
            ),
            'hiddenfields' => array(
                'table' => 'suppliers',
            ),
            'submitbtn' => array(
                'label' => 'Salva'
            )
        ),
    ),
    'warehouses' => array(
        'addnew' => array(
            //'tabletitle' => 'Magazzini',
            //'orderfield' => 'WAH_wahname',
            'pre' => 'WAH',
            'cardtitle' => 'Aggiungi nuovo magazzino',
            
            'formfields' => array(
                'WAH_wahname' => array(
                    'label' => 'Nome',
                    'name' => 'wahname',
                    'class' => 'form-control',
                    'type' => 'input'
                ),
                'WAH_wahcategory' => array(
                    'label' => 'Categoria',
                    'name' => 'wahcategory',
                    'class' => 'form-control disablefirst',
                    'type' => 'select',
                    'selected' => 0,
                    'options' => array(
                        0 => '-',
                        1 => 'Centrale',
                        2 => 'Reparto',
                    ),
                ),        
            ),
            'hiddenfields' => array(
                'table' => 'warehouses',
                'WAH_active' => true
            ),
            'submitbtn' => array(
                'label' => 'Salva'
            )
        ),
        'edit' => array(
            //'tabletitle' => 'Magazzini',
            //'orderfield' => 'WAH_wahname',
            'pre' => 'WAH',
            'cardtitle' => 'Aggiungi nuovo magazzino',
            'id' => 'WAH_ID',
            
            'formfields' => array(
                'WAH_wahname' => array(
                    'label' => 'Nome',
                    'name' => 'wahname',
                    'class' => 'form-control',
                    'type' => 'input'
                ),
                'WAH_wahcategory' => array(
                    'label' => 'Categoria',
                    'name' => 'wahcategory',
                    'class' => 'form-control disablefirst',
                    'type' => 'select',
                    'options' => array(
                        0 => '-',
                        1 => 'Centrale',
                        2 => 'Reparto',
                    ),
                ), 
                'WAH_active'=>  array(
                    'label' => 'Attivo',
                    'name' => 'active', 
                    'class' => 'form-control',               
                    'type' => 'select',
                    'options' => array(
                        0 => 'Non attivo',
                        1 => 'Attivo',
                    ),
                ),       
            ),
            'hiddenfields' => array(
                'table' => 'warehouses',
            ),
            'submitbtn' => array(
                'label' => 'Salva'
            )
        ),
    ),
    'users' => array(
        'addnew' => array(
            //'tabletitle' => 'Utenti',
            //'orderfield' => 'USR_usrname',
            'pre' => 'USR',
            'cardtitle' => 'Aggiungi nuovo utente',
    
            'formfields' => array(
                'USR_usrname' => array(
                    'label' => 'Nome',
                    'name' => 'usrname',
                    'id' => 'usrname',
                    'class' => 'form-control',
                    'type' => 'input'
                ),
                'USR_usrpsw' => array(
                    'label' => 'Password',
                    'name' => 'usrpassword',
                    'id' => 'usrpassword',
                    'class' => 'form-control',
                    'type' => 'input'
                ),
                'USR_usrmail' => array(
                    'label' => 'E-mail',
                    'name' => 'usrmail',
                    'id' => 'usrmail',
                    'class' => 'form-control',
                    'type' => 'input',
                ),
                'USR_role' => array(
                    
                    'label' => 'Ruolo',
                    'name' => 'role',
                    'id' => 'role',
                    'class' => 'form-control disablefirst',
                    'type' => 'select',
                    'selected' => 'choose',
                    'options' => array(
                        'choose' => 'Scegli ruolo',
                        'admin' => 'Admin',
                        'wah' => 'Magazziniere',
                        'rep' => 'Reparto',
                        'wahrep' => 'Magazziniere + reparto',
                    ),
                ),
            ),
            /*'permissions' => array(
                'centrali' => array(
                    'PE_USR_ID' => 'userid',
                    'PE_WAH_ID' => 'cwahlist',
                    'PE_maincen' => 1,
                ),
                'reparti' => array(
                    'PE_USR_ID' => 'userid',
                    'PE_WAH_ID' => 'rwahlist',
                    'PE_mainrep' => 1,
                ),
                
            ),*/
            'permissions' => array(
                'centrali' => array(
                    'name' => 'cwahlist',
                    'id' => 'cwahlist',
                    'label' => 'Assegna magazzino centrale più usato',
                    'class' => 'form-control disablefirst',
                    'selected' => 'choose',
                ),
                'reparti' => array(
                    'name' => 'rwahlist',
                    'id' => 'rwahlist',
                    'label' => 'Assegna magazzino reparto più usato',
                    'class' => 'form-control disablefirst',
                    'selected' => 'choose',
                ),
                'totali' => array(
                    'name'          => 'wah_',
                    'id'            => 'wah_',
                    'value'         => 1,
                    'class'         => 'checkie',
                    //'class'         => 'form-check-input',
                    'checked'       => FALSE,
                    'style'         => 'margin:10px',
                    'label'         => $wahname,
                ),
            ),
            'hiddenfields' => array(
                'table' => 'users',
                'USR_active' => true
            ),
            'password' => array('USR_usrpsw'),
            'submitbtn' => array(
                'label' => 'Salva'
            )
        ),
        'edit' => array(
            //'tabletitle' => 'Utenti',
            //'orderfield' => 'USR_usrname',
            'pre' => 'USR',
            'cardtitle' => 'Modifica utente',
            'id' => 'USR_ID',

            'exceptions' => array(
                'USR_usrpsw' => 'usrpassword',
            ),

            'password' => array(
                'USR_usrpsw' => 'usrpassword',
            ),
    
            'formfields' => array(
                'USR_usrname' => array(
                    'label' => 'Nome',
                    'name' => 'usrname',
                    'id' => 'usrname',
                    'class' => 'form-control',
                    'readonly' => true,
                    'type' => 'input'
                ),
                'USR_usrpsw' => array(
                    'label' => 'Reset Password',
                    'name' => 'usrpassword',
                    'class' => 'form-control compiled-only',
                    'type' => 'input'
                ),
                'USR_usrmail' => array(
                    'label' => 'E-mail',
                    'name' => 'usrmail',
                    'id' => 'usrmail',
                    'class' => 'form-control',
                    'readonly' => true,
                    'type' => 'input'
                ),
                'USR_active'=>  array(
                    'label' => 'Attivo',
                    'name' => 'active', 
                    'id' => 'active', 
                    'class' => 'form-control',               
                    'type' => 'select',
                    'options' => array(
                        0 => 'Non attivo',
                        1 => 'Attivo',
                    ),
                ),
                'USR_role' => array(
                    'label' => 'Ruolo',
                    'name' => 'role',
                    'id' => 'role',
                    'class' => 'form-control',
                    'type' => 'select',
                    'options' => array(
                        'admin' => 'Admin',
                        'wah' => 'Magazziniere',
                        'rep' => 'Reparto',
                        'wahrep' => 'Magazziniere + reparto',
                    ),
                ),
                /*'othertable' => array(
                    'WAH_mainrep' => array(
                        'label' => 'Reparto Principale',
                        'id' => 'mainrep',
                        'name' => 'mainrep',
                        'class' => 'form-control disablefirst',
                        'type' => 'select',
                        'selected' => 'choose',
                        'options' => array(
                            'choose' => 'Scegli magazzino',
                        ),
                    ),
                    'WAH_maincen' => array(
                        'label' => 'Magazzino centrale principale',
                        'id' => 'maincen',
                        'name' => 'maincen',
                        'class' => 'form-control disablefirst',
                        'type' => 'select',
                        'selected' => 'choose',
                        'options' => array(
                            'choose' => 'Scegli magazzino',
                        ),
                    ),
                    'WAH_other' => array(
                        'label' => 'Altri magazzini',
                        'id' => 'other',
                        'name' => 'other',
                        'class' => 'form-control',
                        'type' => 'multiselect',
                        'selected' => 'choose',
                        'options' => array(
                            'choose' => 'Scegli magazzino',
                            1 => 'prova',
                            2 => 'provabis',
                        ),
                    ),
                ),*/
                
            ),
            'permissions' => array(
                'centrali' => array(
                    'name' => 'cwahlist',
                    'id' => 'cwahlist',
                    'label' => 'Assegna magazzino centrale più usato',
                    'class' => 'form-control disablefirst',
                    'selected' => 'choose',
                ),
                'reparti' => array(
                    'name' => 'rwahlist',
                    'id' => 'rwahlist',
                    'label' => 'Assegna magazzino reparto più usato',
                    'class' => 'form-control disablefirst',
                    'selected' => 'choose',
                ),
                'totali' => array(
                    'name'          => 'wah_',
                    'id'            => 'wah_',
                    'value'         => 1,
                    //'class'         => 'form-check-input',
                    'class'         => 'checkie',
                    'checked'       => FALSE,
                    'style'         => 'margin:10px',
                    'label'         => $wahname,
                ),
            ),
            'hiddenfields' => array(
                'table' => 'users',
            ),
            'submitbtn' => array(
                'label' => 'Salva'
            )
        ),
    )
);
echo json_encode($tablearray);
