<?php

function getRatesOnNBRB($on_date,$dm) {
    $curl = curl_init();
    curl_setopt ($curl, CURLOPT_URL, 'https://www.nbrb.by/Services/XmlExRates.aspx?ondate='.$on_date);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec ($curl);
    curl_close ($curl);
    $fp = fopen('./q/'.$dm, 'w');
    fwrite($fp,$result);
    fclose($fp);
}

if (!isset($_GET['ondate']))
    $on_date = date('m/d/Y');
else
    if (preg_match('/^\d{2}\/\d{2}\/\d{4}$|^\d{1}\/\d{1}\/\d{4}$|^\d{1}\/\d{2}\/\d{4}$|^\d{4}-\d{2}-\d{2}$/m', $_GET['ondate']) == 1)
        $on_date = date('m/d/Y',strtotime($_GET['ondate']));
    else
        $on_date = date('m/d/Y');

$dm = hash("sha256",$on_date);
if (!file_exists('./q/'.$dm)) {
    getRatesOnNBRB($on_date,$dm);
}
else {
    if (filesize ( './q/'.$dm ) < 100 )
       getRatesOnNBRB($on_date,$dm);
}


header('Content-type: text/xml');
header('Content-Length: ' . filesize('./q/'.$dm));
ob_clean();
flush();
readfile('./q/'.$dm);
exit();
