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
        $modulo = "Censo";
        if ($accion == 'registrar') {
            $response = $Censo->registrar_censo($_POST['nombre'],$_POST['descripcion'],$_POST['fecha_inicio'],$_POST['fecha_fin'],$_SESSION['usuario']['id']);
            if ($response["resultado"]==1) {
                echo json_encode([
                    'estatus' => '1',
                    'icon' => 'success',
                    'title' => $modulo,
                    'message' => $response["mensaje"]
                ]);
                return 0;
            }else{
                echo json_encode([
                    'estatus' => '2',
                    'icon' => 'info',
                    'title' => $modulo,
                    'message' => $response["mensaje"]
                ]);
                return 0;
            }
            exit;
        }else if ($accion == 'eliminar') {
            $response = $Censo->eliminar_censo($_POST['id_censo']);
            if ($response['resultado'] == 1) {
                echo json_encode([
                    'estatus' => '1',
                    'icon' => 'success',
                    'title' => $modulo,
                    'message' => $response['mensaje']
                ]);
            }else{
                echo json_encode([
                    'estatus' => '2',
                    'icon' => 'error',
                    'title' => $modulo,
                    'message' => $response["mensaje"]
                ]);
            }
            return 0;
            exit;
        }else if ($accion == 'editar') {
            $datos = $Censo->cargar_censo($_POST['id_censo']);
            foreach ($datos as $valor) {
                echo json_encode([
                    'id_censo' => $valor['id_censo'],
                    'nombre' => $valor['nombre'],
                    'descripcion' => $valor['descripcion'],
                    'fecha_inicio' => $valor['fecha_inicio'],
                    'fecha_final' => $valor['fecha_final']
                ]);
            }
            return 0;
        }else if ($accion == 'modificar'){ 
            $response = $Censo->modificar_censo($_POST['id_censo'],$_POST['nombre'],$_POST['descripcion'],$_POST['fecha_inicio'],$_POST['fecha_fin'],$_SESSION['usuario']['id']);
            if ($response['resultado']== 1) {
                echo json_encode([
                    'estatus' => '1',
                    'icon' => 'success',
                    'title' => $modulo,
                    'message' => $response['mensaje']
                ]);
            }else {
                echo json_encode([
                    'estatus' => '2',
                    'icon' => 'info',
                    'title' => $modulo,
                    'message' => $response['mensaje']
                ]);
            }
            return 0;
            exit;
        }
    }
    $listados_censo = $Censo->listar_censos();
    require_once "vista/" . $pagina . "Vista.php";
} else {
    echo "pagina en construccion";
}