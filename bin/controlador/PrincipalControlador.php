<?php
use modelo\PrincipalModelo as Principal;
use config\componentes\configSistema as configSistema;

$config = new configSistema;
$principal = new Principal();
if (!is_file($config->_Dir_Model_().$pagina.$config->_MODEL_())) {
    echo "Falta definir la clase " . $pagina;
    exit;
}
if (is_file("vista/" . $pagina . "Vista.php")) {
    $modulo = 'Reporte de Deporte:';
    if (isset($_POST['accion'])) {
        $accion = $_POST['accion'];
        if ($accion == 'reporte_deporte_masculino') {
            $repot_sport = $principal->reporte_deporte_masculino();
            echo json_encode($repot_sport);
            return 0;
        }else if ($accion == 'reporte_deporte_femenino') {
            $repot_sport = $principal->reporte_deporte_femenino();
            echo json_encode($repot_sport);
            return 0;
        }
    }
    $func_deport = $principal->listado_func_deport();
    require_once "vista/" . $pagina . "Vista.php";
} else {
    echo "pagina en construccion";
}