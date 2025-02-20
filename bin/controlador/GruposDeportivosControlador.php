<?php
use modelo\GruposDeportivosModelo as Gruposrupos;
use config\componentes\configSistema as configSistema;

$config = new configSistema;
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
            }else if ($response["resultado"]==2) {
                echo json_encode([
                    'estatus' => '2',
                    'icon' => 'info',
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
        }else if ($accion == 'comprobar_pers_deporte') {
            $datos = $grupos_deportivo->comprobar_pers_deporte($_POST['cedula'],$_POST['nombre']);
            if ($datos['resultado'] == 1) {
            }else{
                echo json_encode([
                    'estatus' => '2',
                    'icon' => 'info',
                    'title' => $modulo,
                    'message' => $datos["mensaje"]
                ]);
            }
            return 0;
        }else if ($accion == 'eliminar_persona_grupo') {
            $datos = $grupos_deportivo->eliminar_pers_grup_deport($_POST['id_persona'],$_POST['id_grupos_deportivo']);
            echo json_encode($datos);
            return 0;
            exit;
        }else if ($accion == 'editar') {
            $datos = $grupos_deportivo->cargar_grupos_deportivo($_POST['id_grupos_deportivo']);
            echo json_encode($datos);
            return 0;
        }else if ($accion == 'modificar'){ 
            $array_integrantes = explode(",", $_POST['integrantes']);
            $response1 = $grupos_deportivo->modificar_integ_grup_deport($_POST['id_grupo_deportivo'],$_POST['id_deporte'],$array_integrantes);
            $response2 = $grupos_deportivo->modificar_grupos_deportivo($_POST['id_grupo_deportivo'],$_POST['id_deporte'],$_POST['nombre_grupo'],$_POST['descripcion_grupo']);
            if ($response1['resultado']== 1 && $response2['resultado']== 1) {
                echo json_encode([
                    'estatus' => '1',
                    'icon' => 'success',
                    'title' => $modulo,
                    'message' => $response2['mensaje']
                ]);
            }else {
                echo json_encode([
                    'estatus' => '2',
                    'icon' => 'info',
                    'title' => $modulo,
                    'message' => $response2['mensaje']
                ]);
            }
            return 0;
            exit;
        }
    }
    $deportes=$grupos_deportivo->Consulta_deportes();
    $cedulas=$grupos_deportivo->Consulta_personas_con_deportes();
    $grupos_deportivos = $grupos_deportivo->lista_grupos_deportivos();
    require_once "vista/" . $pagina . "Vista.php";
} else {
    echo "pagina en construccion";
}