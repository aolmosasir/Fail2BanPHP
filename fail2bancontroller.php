<?php
require_once 'fail2banfunctions.php';

$periodo = $_POST['periodo'];
$intervalo = $_POST['intervalo'];
$intentos = $_POST['intentos'];

setPeriodo($periodo);
setIntervalo($intervalo);
setRetrys($intentos);

$command = 'sudo fail2ban-client restart';
exec($command, $salida, $return);

if ($return != 0) {
    echo'<script type="text/javascript">
    alert("La configuracion no ha podido ser aplicada");
    window.location="fail2ban.php";
    </script>';
}else {
    echo'<script type="text/javascript">
    alert("La configuracion ha sido aplicada correctamente");
    window.location="fail2ban.php";
    </script>';
}
?>