<?php

use modelo\AperturarCensoModelo as AperturarCenso;

use config\componentes\configSistema as configSistema;

$config = new configSistema;
$Censo = new AperturarCenso();
session_start();
if (!isset($_SESSION['usuario'])) {
	$redirectUrl = '?pagina=' . configSistema::_INICIO_();
    echo '<script>window.location="' . $redirectUrl . '"</script>';
    die();
}
if (!is_file($config->_Dir_Model_().$pagina.$config->_MODEL_())) {
    echo "Falta definir la clase " . $pagina;
    exit;
}

if (is_file("vista/" . $pagina . "Vista.php")) {

    if (isset($_POST['accion'])) {
        $accion = $_POST['accion'];
        if ($accion == 'verificar_perfil') {

        }else if ($accion == 'cambiar_pasword') {

        }
    }
    $listados_censo = $Censo->listar_censos();
    require_once "vista/" . $pagina . "Vista.php";
} else {
    echo "pagina en construccion";
}