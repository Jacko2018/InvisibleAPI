<?php

$pingip = $_GET['ip'];
$string = $_GET['string'];
if ($string == "ping") {
    $get = $_GET['website'];
    function ping($host, $port, $timeout) { 
    $tB = microtime(true);
    $fP = fSockOpen($host, $port, $errno, $errstr, $timeout); 
    if (!$fP) { return "This domain is down. Please try again later or with a different domain."; } 
    $tA = microtime(true); 
    return round((($tA - $tB) * 1000), 0)." ms";
    }
    echo ping($get, 80, 10);
}
if($string == "portscan") {
//list of port numbers to scan
    $ports = array(21, 22, 23, 25, 53, 80, 110, 1433, 3306, 433, 80, 8080);
    
    $results = array();
    foreach($ports as $port) {
        if($pf = @fsockopen($_GET['website'], $port, $err, $err_string, 1)) {
            $results[$port] = true;
            fclose($pf);
        } else {
            $results[$port] = false;
        }
    }
    foreach($results as $port=>$val) {
        $prot = getservbyport($port,"tcp");
                echo "Port - $port ($prot): ";
        if($val) {
            echo "Accessable ";
        }
        else {
            echo "Inaccessible ";
        }
    }
}

if($string == "ping") {
$ip = $pingip;
exec("ping -n 3 $ip", $output, $status);
print_r($output);
}

if($string == "customports") {
//list of port numbers to scan
$customportscan = $_GET['ports'];
    $ports = array($customportscan);
    
    $results = array();
    foreach($ports as $port) {
        if($pf = @fsockopen($_GET['website'], $port, $err, $err_string, 1)) {
            $results[$port] = true;
            fclose($pf);
        } else {
            $results[$port] = false;
        }
    }
    foreach($results as $port=>$val) {
        $prot = getservbyport($port,"tcp");
                echo "Port - $port ($prot): ";
        if($val) {
            echo "Accessable ";
        }
        else {
            echo "Inaccessible ";
        }
    }
}
