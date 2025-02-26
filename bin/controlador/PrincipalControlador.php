<?php
use modelo\PrincipalModelo as Principal;
use config\componentes\configSistema as configSistema;

$config = new configSistema;
$principal = new Principal();
session_start();

if (!isset($_SESSION['usuario'])) {
    echo '<script>window.location="?pagina=' . configSistema::_INICIO_() . '"</script>';
    exit;
}

if (!is_file($config->_Dir_Model_() . $pagina . $config->_MODEL_())) {
    exit("Falta definir la clase " . $pagina);
}

if (is_file("vista/" . $pagina . "Vista.php")) {
    if (!empty($_POST['accion'])) {
        switch ($_POST['accion']) {
            case 'reporte_deporte_masculino':
                echo json_encode($principal->reporte_deporte_masculino());
                break;
            case 'reporte_deporte_femenino':
                echo json_encode($principal->reporte_deporte_femenino());
                break;
        }
        exit;
    }

    $func_deport = $principal->listado_func_deport();
    require_once "vista/" . $pagina . "Vista.php";
} else {
    exit("Página en construcción");
}
