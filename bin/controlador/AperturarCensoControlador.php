<?php

use modelo\AperturarCensoModelo as AperturarCenso;
use config\componentes\configSistema as configSistema;

session_start();
$config = new configSistema;
$Censo = new AperturarCenso();

if (!isset($_SESSION['usuario'])) {
    header("Location: ?pagina=" . configSistema::_INICIO_());
    exit;
}

if (!is_file($config->_Dir_Model_() . $pagina . $config->_MODEL_())) {
    die("Falta definir la clase " . $pagina);
}

if (is_file("vista/" . $pagina . "Vista.php")) {
    
    $accion = $_POST['accion'] ?? null;
    $modulo = "Censo";

    function responder($estatus, $icon, $mensaje) {
        echo json_encode([
            'estatus' => $estatus,
            'icon' => $icon,
            'title' => "Censo",
            'message' => $mensaje
        ]);
        exit;
    }

    if ($accion) {
        switch ($accion) {
            case 'registrar':
                $response = $Censo->registrar_censo(
                    $_POST['nombre'],
                    $_POST['descripcion'],
                    $_POST['fecha_inicio'],
                    $_POST['fecha_fin'],
                    $_SESSION['usuario']['id']
                );
                responder($response["resultado"], $response["resultado"] == 1 ? 'success' : 'info', $response["mensaje"]);
                break;

            case 'eliminar':
                $response = $Censo->eliminar_censo($_POST['id_censo']);
                responder($response['resultado'], $response['resultado'] == 1 ? 'success' : 'error', $response["mensaje"]);
                break;

            case 'editar':
                $datos = $Censo->cargar_censo($_POST['id_censo']);
                if (!empty($datos)) {
                    echo json_encode($datos[0]);
                }
                exit;

            case 'modificar':
                $response = $Censo->modificar_censo(
                    $_POST['id_censo'],
                    $_POST['nombre'],
                    $_POST['descripcion'],
                    $_POST['fecha_inicio'],
                    $_POST['fecha_fin'],
                    $_SESSION['usuario']['id']
                );
                responder($response['resultado'], $response['resultado'] == 1 ? 'success' : 'info', $response['mensaje']);
                break;

            default:
                responder(2, 'error', 'Acción no válida.');
        }
    }

    $listados_censo = $Censo->listar_censos();
    require_once "vista/" . $pagina . "Vista.php";

} else {
    die("Página en construcción");
}
