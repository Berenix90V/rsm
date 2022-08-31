<?php
$tablearray = array(
    'proname' => array(
        'data-table' => 'products',
        'data-filter' => array('PRO_proname'), 
        'data-show'=> 'PRO_ID, PRO_proname, PRO_code, PRO_pack',
        'data-input' => array('PRO_ID', 'PRO_pack'),
        'data-inputshow' => 'PRO_proname',
        'data-groupby' => 'PRO_ID',
        'data-orderby' => 'PRO_proname',
        'data-hidden' => array(
            'PRO_ID' => 'PRS_PRO_ID',
        ),
        'data-active' => array('PRO_active'),
    ),
    'supname' => array(
        'data-table' => 'suppliers',
        'data-filter' => array('SUP_supname'), 
        'data-show'=> 'SUP_ID, SUP_supname',
        'data-input' => array('SUP_ID'),
        'data-inputshow' => 'SUP_supname',
        'data-groupby' => 'SUP_ID',
        'data-orderby' => 'SUP_supname',
        'data-hidden' => array(
            'SUP_ID' => 'PRS_SUP_ID'
        ),
        'data-active' => array('SUP_active'),
    ),
    'stoproname' => array(
        'data-table' => 'pf_view',
        'data-filter' => array(
            0 => 'PRO_proname',
            1 => 'SUP_supname'
        ),
        
        'data-show'=> 'PRS_ID, PRO_proname, SUP_supname, PRO_pack, PRS_active, PRO_measureunit, PRS_cost, PRS_totalcost',
        'data-input' => array('PRS_ID', 'PRO_pack', 'PRO_measureunit', 'SUP_supname', 'PRS_cost', 'PRS_totalcost'),
        'data-inputshow' => 'PRO_proname',
        'data-groupby' => 'PRS_ID',
        'data-orderby' => 'PRO_proname',
        'data-having' => array(
            'PRS_active =' => '1', 
        ),
        'data-havinghidden' => array('PRS_active'),
        'data-hidden' => array(
            'PRS_ID' => 'STO_PRS_ID',
            'PRO_measureunit' => 'PRO_measureunit',   
            'PRS_cost' => 'PRS_cost',
            'PRS_totalcost' => 'PRS_totalcost'
        ),
    ),
    'stowahname' => array(
        'data-table' => 'warehouses',
        'data-filter' => array('WAH_wahname'), 
        'data-show'=> 'WAH_ID, WAH_wahname, WAH_wahcategory',
        'data-input' => array('WAH_ID'),
        'data-inputshow' => 'WAH_wahname',
        'data-groupby' => 'WAH_ID',
        'data-orderby' => 'WAH_wahname',
        'data-having' => array(
            'WAH_wahcategory =' => '1', 
        ),
        'data-havinghidden' => array('WAH_wahcategory'),
        'data-hidden' => array(
            'WAH_ID' => 'STO_WAH_ID'
        ),
    ),
    'reqwahname' => array(
        'data-table' => 'warehouses',
        'data-filter' => array('WAH_wahname'), 
        'data-show'=> 'WAH_ID, WAH_wahname',
        'data-input' => array('WAH_ID'),
        'data-inputshow' => 'WAH_wahname',
        'data-groupby' => 'WAH_ID',
        'data-orderby' => 'WAH_wahname',
        'data-hidden' => array(
            'WAH_ID' => 'REQ_reqwahid'
        ),
    ),
);
echo json_encode($tablearray);
