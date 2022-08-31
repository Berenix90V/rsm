<?php
$tablearray = array(
    'tabletitle' => 'Inventari',
    'headers' => array(
        'year' => 'Anno',
        'WAH_wahname' => 'Magazzino', 
        'gennaio' => 'Gennaio', 
        'febbraio' => 'Febbraio',
        'marzo' => 'Marzo', 
        'aprile' => 'Aprile',
        'maggio' => 'Maggio',
        'giugno' => 'Giugno',
        'luglio' => 'Luglio',
        'agosto' => 'Agosto',
        'settembre' => 'Settembre',
        'ottobre' => 'Ottobre',
        'novembre' => 'Novembre',
        'dicembre' => 'Dicembre',
    ),
    'query' => array(
        'select' => 'year, IL_WAH_ID, WAH_wahname, gennaio, febbraio, marzo, aprile, maggio, giugno, luglio, agosto, settembre, ottobre, novembre, dicembre',
    ),
    'cat' => array(
        'gennaio' => 'Gennaio', 
        'febbraio' => 'Febbraio',
        'marzo' => 'Marzo', 
        'aprile' => 'Aprile',
        'maggio' => 'Maggio',
        'giugno' => 'Giugno',
        'luglio' => 'Luglio',
        'agosto' => 'Agosto',
        'settembre' => 'Settembre',
        'ottobre' => 'Ottobre',
        'novembre' => 'Novembre',
        'dicembre' => 'Dicembre',
    ),
    'startyear' => 2017,
);
echo json_encode($tablearray);