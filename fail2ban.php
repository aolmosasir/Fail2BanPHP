<?php
require 'fail2banfunctions.php';
$bannedIps = getBannedIps();
$whiteIps = getWhitelist();
$jails = getJails();
$periodo = getPeriodo();
$intervalo = getIntervalo();
$maxretry = getMaxRetry();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Fail2Ban</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="m-4">
    <ul class="nav nav-tabs" id="myTab">
        <li class="nav-item">
            <a href="#prohibidas" class="nav-link active" data-bs-toggle="tab">Direcciones IP Prohibidas</a>
        </li>
        <li class="nav-item">
            <a href="#confianza" class="nav-link" data-bs-toggle="tab">Direcciones IP de confianza</a>
        </li>
        <li class="nav-item">
            <a href="#jails" class="nav-link" data-bs-toggle="tab">Jails</a>
        </li>
        <li class="nav-item">
            <a href="#config" class="nav-link" data-bs-toggle="tab">Configuración</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade show active" id="prohibidas">
            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th scope="col">Direccion IP</th>
                        <th scope="col">Jail</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($bannedIps as $ban): ?>
                        <?php  $split = explode("|", $ban); ?>
                        <tr>
                            <td><?php  echo $split[0]; ?></td>
                            <td><?php echo $split[1]; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="confianza">
            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th scope="col">Direccion IP</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  $split2 = explode(" ", $whiteIps[0]); ?>
                    <?php unset($split2[0]); ?>
                        <?php foreach($split2 as $ipWhite): ?>
                        <tr>
                            <td><?php  echo $ipWhite; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="jails">
        <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th scope="col">Jail</th>
                        <th scope="col">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($jails as $jail): ?>
                        <?php  $split3 = explode("|", $jail); ?>
                        <tr>
                            <td><?php  echo $split3[0]; ?></td>
                            <td><?php if($split3[1] == 1){echo "Activo";}else{echo "Inactivo";}; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="config">
        <?php  $split4 = explode(" ", $periodo[0]); ?>
        <?php unset($split4[0]); ?>
        <?php  $split5 = explode(" ", $intervalo[0]); ?>
        <?php unset($split5[0]); ?>
        <?php  $split6 = explode(" ", $maxretry[0]); ?>
        <?php unset($split6[0]); ?>
        <form class="mt-3" action="fail2bancontroller.php" method="post">
            <div class="form-group">
                <label for="periodo">Periodo de prohibicon de la direccion IP</label>
                <input type="text" class="form-control" id="periodo" name="periodo" value="<?php echo $split4[1]; ?>">
            </div>
            <div class="form-group">
                <label for="intervalo">Intervalo de tiempo para la deteccion de los siguientes subataques</label>
                <input type="text" class="form-control" id="intervalo" name="intervalo" value="<?php echo $split5[1]; ?>">
            </div>
            <div class="form-group">
                <label for="intentos">Numero maximo de intentos antes de bloquear la IP</label>
                <input type="text" class="form-control" id="intentos" name="intentos" value="<?php echo $split6[1]; ?>">
            </div>
            <button type="submit" class="btn btn-primary mt-3">Aplicar</button>
        </form>
        </div>
    </div>
</div>
</body>
</html>