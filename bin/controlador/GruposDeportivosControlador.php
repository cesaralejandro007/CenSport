<?php
use modelo\GruposDeportivosModelo as Gruposrupos;
use config\componentes\configSistema as configSistema;

$config = new configSistema;
$objetoGrupo = new Gruposrupos;
if (!is_file($config->_Dir_Model_().$pagina.$config->_MODEL_())) {
    echo "Falta definir la clase " . $pagina;
    exit;
}
if (is_file("vista/" . $pagina . "Vista.php")) {

    if (isset($_POST['accion'])) {
        $accion = $_POST['accion'];
    }

    $deporte=$objetoGrupo->Consulta_deportes();
    $cedula=$objetoGrupo->Consulta_personas();
    require_once "vista/" . $pagina . "Vista.php";

    

} else {
    echo "pagina en construccion";
}