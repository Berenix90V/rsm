<?php
$array = array(
    'products' => array(
        'proname',
        'procategory',
        'pack',
        'measureunit'
    ),
    'suppliers' => array(
        'supname'
    ),
    'warehouses' => array(
        'wahname',
        'wahcategory'
    ),
    'users' => array(
        'usrname',
        'usrpassword',
        'usrmail',
        'role'
    ),
    'pfregistry_addnew' => array(
        'proname',
        'supname',
        'cost',
        'iva'
    ),
    'userpassword' => array(
        'oldPassword',
        'newPassword',
        'confirmPassword'
    ),
    'basicregistry_edit' => array(
        'usrname',
        'usrmail',
        'role'
    ),
    'user-edit' => array(
        'usrname',
        'usrmail',
        'role'
    )
);
$array = json_encode($array);
echo $array;