<?php
if (!isset($_GET['ondate'])) 
    $on_date = date('m/d/Y');
else  
	if (preg_match('/^\d{2}\/\d{2}\/\d{4}$/m', $_GET['ondate']) == 0) 
		$on_date = date('m/d/Y');
	else 
		$on_date = $_GET['ondate'];

$dm = hash("sha256",$on_date);
if (!file_exists('./q/'.$dm)) {
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

header('Content-type: text/xml');
readfile('./q/'.$dm);