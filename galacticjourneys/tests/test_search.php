<?php

function search($departure, $destination, $date, $baseurl = 'http://localhost/galacticjourneys/galacticjourneys') {

    $departure = urlencode($departure);
	$destination = urlencode($destination);
	$date = urlencode($date);

    $ch = curl_init();

    $url = "$baseurl/html/searchJourneyHTML.php";

    $cookieFile = "cookies";
    if(!file_exists($cookieFile)) {
        $fh = fopen($cookieFile, "w");
        fwrite($fh, "");
        fclose($fh);
    }

    curl_setopt($ch, CURLOPT_URL, $url."?search=1&departure=$departure&destination=$destination&date=$date");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $headers = array();
    $headers[] = 'Content-Type: application/x-www-form-urlencoded';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile); // Cookie aware
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile); // Cookie aware
    $result = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);

    return $result;
} 

function check_search_found($departure, $destination, $date, $search_page) {
    return strpos($search_page, $departure) && strpos($search_page, $destination) && strpos($search_page, $date); 
}
