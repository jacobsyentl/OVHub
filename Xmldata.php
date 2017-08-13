<?php

if (isset($_POST['city']))
{
        fetch(sanitize($_POST['city']));
}

function sanitize($input)
{
    $input = htmlentities($input);
    $input = str_replace(' ','-',$input); //Necessary for searchquery
    return $input;
}

function fetch($city)
{

    $url = "https://api.irail.be/liveboard/?station=".$city;
    $ch = curl_init();

    //curl options
    curl_setopt($ch,CURLOPT_URL, $url);
    curl_setopt($ch,CURLOPT_HEADER, "Content-Type:application/xml");
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTREDIR, 3);

    $data = curl_exec($ch);

    //Close curl object
    curl_close($ch);

    //Pass results to the SimpleXMLElement function
    $xml = new SimpleXMLElement($data);

    echo $xml->asXML();
};
?>
