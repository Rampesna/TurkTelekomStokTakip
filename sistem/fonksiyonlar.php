<?php
/**
 * Created by PhpStorm.
 * User: Rampesna
 * Date: 07.06.2018
 * Time: 09:03
 */

function ip_bula(){
    if(getenv("HTTP_CLIENT_IP")) {
        $ip = getenv("HTTP_CLIENT_IP");
    } elseif(getenv("HTTP_X_FORWARDED_FOR")) {
        $ip = getenv("HTTP_X_FORWARDED_FOR");
        if (strstr($ip, ',')) {
            $tmp = explode (',', $ip);
            $ip = trim($tmp[0]);
        }
    } else {
        $ip = getenv("REMOTE_ADDR");
    }
    return $ip;
}


function ip_bul(){
    ob_start();
    system('ipconfig/all');
    $mycom = ob_get_contents();
    ob_clean();

    $finder = "Fiziksel Adres";
    $pmac=strpos($mycom,$finder);
    $mac=substr($mycom,($pmac+36),17);
    $ip = $mac;
    return $ip;
}


?>