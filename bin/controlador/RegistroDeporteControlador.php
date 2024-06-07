<?php
use modelo\RegistroDeporteModelo as Deporte;
use config\componentes\configSistema as configSistema;

$config = new configSistema;
if (!is_file($config->_Dir_Model_().$pagina.$config->_MODEL_())) {
    echo "Falta definir la clase " . $pagina;
    exit;
}
if (is_file("vista/" . $pagina . "Vista.php")) {
    $deporte = new Deporte();
    if (isset($_POST['accion'])) {
        $modulo = 'Deporte:';
        $accion = $_POST['accion'];
        if ($accion == 'registrar') {
            $response = $deporte->registrar_deporte($_POST['nombre_deporte']);
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
                    'icon' => 'error',
                    'title' => $modulo,
                    'message' => $response["mensaje"]
                ]);
                return 0;
            }
            exit;
        }else if ($accion == 'eliminar') {
            $response = $deporte->eliminar_deporte($_POST['id_deporte']);
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
        } else if ($accion == 'editar') {
            $datos = $deporte->cargar_deporte($_POST['id_deporte']);
            foreach ($datos as $valor) {
                echo json_encode([
                    'id_deporte' => $valor['id_deporte'],
                    'nombre_deporte' => $valor['nombre_deporte']
                ]);
            }
            return 0;
        }else if ($accion == 'modificar'){ 
            $response = $deporte->modificar_deporte($_POST['id'],$_POST['nombre_deporte']);
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
    $lista_deportes = $deporte->listar_deportes();
    require_once "vista/" . $pagina . "Vista.php";
} else {
    echo "pagina en construccion";
}