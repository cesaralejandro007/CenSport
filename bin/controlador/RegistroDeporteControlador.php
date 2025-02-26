<?php
use modelo\RegistroDeporteModelo as Deporte;
use config\componentes\configSistema as configSistema;

$config = new configSistema;
session_start();
if (!isset($_SESSION['usuario'])) {
    echo '<script>window.location="?pagina=' . configSistema::_INICIO_() . '"</script>';
    die();
}

if (!is_file($config->_Dir_Model_() . $pagina . $config->_MODEL_())) {
    exit("Falta definir la clase " . $pagina);
}

if (!is_file("vista/" . $pagina . "Vista.php")) {
    exit("Página en construcción");
}

$deporte = new Deporte();

if (!empty($_POST['accion'])) {
    $modulo = 'Deporte:';
    $accion = $_POST['accion'];
    $response = null;
    
    switch ($accion) {
        case 'registrar':
            $response = $deporte->registrar_deporte($_POST['nombre_deporte']);
            break;
        case 'eliminar':
            $response = $deporte->eliminar_deporte($_POST['id_deporte']);
            break;
        case 'editar':
            $datos = $deporte->cargar_deporte($_POST['id_deporte']);
            echo json_encode(reset($datos));
            return;
        case 'modificar':
            $response = $deporte->modificar_deporte($_POST['id'], $_POST['nombre_deporte']);
            break;
    }
    
    if ($response) {
        echo json_encode([
            'estatus' => $response['resultado'] == 1 ? '1' : '2',
            'icon' => $response['resultado'] == 1 ? 'success' : ($accion == 'modificar' ? 'info' : 'error'),
            'title' => $modulo,
            'message' => $response['mensaje']
        ]);
    }
    return;
}

$lista_deportes = $deporte->listar_deportes();
require_once "vista/" . $pagina . "Vista.php";
