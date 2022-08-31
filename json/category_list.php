<?php
$catlist = array(
    'products_cat' => array(
        'choose' => 'Scegli categoria',
        1 => array(
            'label' => 'Guanti',
            'abbr' => 'Gu',
        ),
        2 => array(
            'label' => 'Igiene ospiti',
            'abbr' => 'Ig',
        ),
        3 => array(
            'label' => 'Prodotti per incontinenza',
            'abbr' => 'Inc',
        ),
        4 => array(
            'label' => 'Prodotti monouso',
            'abbr' => 'Mono',
        ),
        5 => array(
            'label' => 'Materiale di pulizia',
            'abbr' => 'Pul',
        ),
        6 => array(
            'label' => 'Alimentare',
            'abbr' => 'Ali',
        )
    ),
    'months' => array(
        1 => 'gennaio',
        2 => 'febbraio',
        3 => 'marzo',
        4 => 'aprile',
        5 => 'maggio',
        6 => 'giugno',
        7 => 'luglio',
        8 => 'agosto',
        9 => 'settembre',
        10 => 'ottobre',
        11 => 'novembre',
        12 => 'dicembre',
    ),
);
echo json_encode($catlist);
