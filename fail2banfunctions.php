<?php

function getBannedIps(){
    $getBansCommand = 'sudo sqlite3 /var/lib/fail2ban/fail2ban.sqlite3 "select distinct ip,jail from bans"';
    $getBans = exec($getBansCommand, $salida, $return);
    
    return $salida;
}

function getWhitelist(){
    $getIgnoredCommand = 'grep "^ignoreip = " /etc/fail2ban/jail.d/defaults-debian.conf | cut -d "=" -f2';
    $getIgnored = exec($getIgnoredCommand, $salida, $return);
    
    return $salida;
}

function getJails(){
    $getJailsCommand = 'sudo sqlite3 /var/lib/fail2ban/fail2ban.sqlite3 "select name,enabled from jails"';
    $getJailsVar = exec($getJailsCommand, $salida, $return);

    return $salida;
}

function getPeriodo(){
    $getPeriodoCommand = 'grep "^bantime" /etc/fail2ban/jail.d/defaults-debian.conf | cut -d "=" -f2';
    $getPeriodoVar = exec($getPeriodoCommand, $salida, $return);

    return $salida;
}

function getIntervalo(){
    $getIntervaloCommand = 'grep "^findtime" /etc/fail2ban/jail.d/defaults-debian.conf | cut -d "=" -f2';
    $getIntervaloVar = exec($getIntervaloCommand, $salida, $return);

    return $salida;
}

function getMaxRetry(){
    $getMaxRetryCommand = 'grep "^maxretry" /etc/fail2ban/jail.d/defaults-debian.conf | cut -d "=" -f2';
    $getMaxRetry = exec($getMaxRetryCommand, $salida, $return);

    return $salida;
}

function setPeriodo($number){
    $antiguoPer = getPeriodo();
    $split4 = explode(" ", $antiguoPer[0]);
    unset($split4[0]);
    $setPeriodoCommand = 'sudo sed -i -e "s/bantime = '.$split4[1].'/bantime = '.$number.'/g" /etc/fail2ban/jail.d/defaults-debian.conf';
    $setPeriodo = exec($setPeriodoCommand, $salida, $return);
}

function setIntervalo($number){
    $antiguoIntervalo = getIntervalo();
    $split5= explode(" ", $antiguoIntervalo[0]);
    unset($split5[0]);
    $setIntervaloCommand = 'sudo sed -i -e "s/findtime = '.$split5[1].'/findtime = '.$number.'/g" /etc/fail2ban/jail.d/defaults-debian.conf';
    $setIntervalo = exec($setIntervaloCommand, $salida, $return);
}

function setRetrys($number){
    $antiguoRetry = getMaxRetry();
    $split6= explode(" ", $antiguoRetry[0]);
    unset($split6[0]);
    $setRetryCommand = 'sudo sed -i -e "s/maxretry = '.$split6[1].'/maxretry = '.$number.'/g" /etc/fail2ban/jail.d/defaults-debian.conf';
    $setRetry = exec($setRetryCommand, $salida, $return);
}



?>
