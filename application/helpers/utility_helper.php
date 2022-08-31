<?php
function iprint_r($var){
    echo "<pre>";
    print_r($var);
    echo "</pre>";
}
function json_get_content($path){
    $prova = @file_get_contents(base_url().$path);
    $newarray = json_decode($prova, true);
    return ($newarray);
}
function url_get_contents ($Url) {
    $Url = base_url().$Url;
    if (!function_exists('curl_init')){ //se la funzione non dovesse esistere, allora si usa questa condizione
    die('CURL is not installed!');
    }
    $ch = curl_init(); //inizializza curl, non serve passare alcun parametro. Tutti i parametri verranno settati dopo con curl_setopt
    curl_setopt($ch, CURLOPT_URL, $Url); //questo parametro setta l'url da chiamare
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); //questo parametro dice che se trova una connessione criptata https, di saltare ogni tipo di verifica e di recuperare il file
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //il parametro dice di aspettarsi una ripsosta dalla funzione curl chiamata 
    $output = curl_exec($ch); //legge la risposta
    curl_close($ch); //chiude la connessione curl
    $newarray = json_decode($output, true);
    return ($newarray);
}
function move_to_top(&$array, $key) {
    $temp = array($key => $array[$key]);
    unset($array[$key]);
    $array = $temp + $array;
}
   
function move_to_bottom(&$array, $key) {
    $value = $array[$key];
    unset($array[$key]);
    $array[$key] = $value;
}

//controlla se un valore è unico oppure no
function xe_unico($valore, $nomeCampo, $tabella) {
    $CI =& get_instance();
    $CI->load->database();
    $query = $CI -> db -> get_where($tabella, array($nomeCampo => $valore));
    $result = $query -> result();
    $count = count($result);
    if ($count > 0) {
        echo true;
    } else {
        echo false;
    }
    
}