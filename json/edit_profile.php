<?php
$editprofile = array(
    'profile' => array(
        'formfields' => array(
            'USR_usrname' => array(
                'id' => 'username',
                'name' => 'username',
                'label' => 'Modifica nome utente',
                'class' => 'form-control',
                'type' => 'input',
            ),
            'USR_usrmail' => array(
                'id' => 'useremail',
                'name' => 'useremail',
                'label' => 'Modifica e-mail utente',
                'class' => 'form-control',
                'type' => 'input',
            ),
        ),
        'hiddenfields' => array(
            'USR_ID' => '',
        ),
    ),
);
echo json_encode($editprofile);