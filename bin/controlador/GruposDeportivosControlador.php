<?php
use modelo\GruposDeportivosModelo as Gruposrupos;
use config\componentes\configSistema as configSistema;

$config = new configSistema;
if (!is_file($config->_Dir_Model_().$pagina.$config->_MODEL_())) {
    echo "Falta definir la clase " . $pagina;
    exit;
    }
if (is_file("vista/" . $pagina . "Vista.php")) {
$grupos_deportivo = new Gruposrupos;
    if (isset($_POST['accion'])) {
        $modulo = 'Grupos Deportivos:';
        $accion = $_POST['accion'];
        if ($accion == 'registrar') {
            $array_integrantes = explode(",", $_POST['integrantes']);
            $response = $grupos_deportivo->registrar_grupos_deportivo($_POST['id_deporte'],$_POST['nombre_grupo'],$_POST['descripcion_grupo'],$array_integrantes);
            if ($response["resultado"]==1) {
                echo json_encode([
                    'estatus' => '1',
                    'icon' => 'success',
                    'title' => $modulo,
                    'message' => $response['mensaje']
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
            $response = $grupos_deportivo->eliminar_grupos_deportivo($_POST['id_grupo_derportivo']);
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
            $datos = $grupos_deportivo->cargar_grupos_deportivo($_POST['id_grupos_deportivo']);
            foreach ($datos as $valor) {
                echo json_encode([
                    'id_grupos_deportivo' => $valor['id_grupos_deportivo'],
                    'nombre_grupos_deportivo' => $valor['nombre_grupos_deportivo']
                ]);
            }
            return 0;
        }else if ($accion == 'modificar'){ 
            $response = $grupos_deportivo->modificar_grupos_deportivo($_POST['id'],$_POST['nombre_grupos_deportivo']);
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
    $deportes=$grupos_deportivo->Consulta_deportes();
    $cedulas=$grupos_deportivo->Consulta_personas();
    $grupos_deportivos = $grupos_deportivo->lista_grupos_deportivos();
    require_once "vista/" . $pagina . "Vista.php";
} else {
    echo "pagina en construccion";
}