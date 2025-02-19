<?php
use modelo\RegistroFuncionarioModelo as Funcionario;
use modelo\RegistroDeporteModelo as Deporte;
use config\componentes\configSistema as configSistema;

$config = new configSistema;
if (!is_file($config->_Dir_Model_().$pagina.$config->_MODEL_())) {
    echo "Falta definir la clase " . $pagina;
    exit;
}
session_start();
if (!isset($_SESSION['usuario'])) {
	$redirectUrl = '?pagina=' . configSistema::_INICIO_();
    echo '<script>window.location="' . $redirectUrl . '"</script>';
    die();
}
$funcionario = new Funcionario();
$deporte = new Deporte();
if (is_file("vista/" . $pagina . "Vista.php")) {
    if (isset($_POST['accion'])) {
        $modulo = 'Funcionarios:';
        $accion = $_POST['accion'];
        if ($accion == 'registrar') {
            $array_disciplinas = explode(",", $_POST['disciplinas']);
            $response = $funcionario->registrar_funcionario($_POST['cedula'],$_POST['nombres'],$_POST['apellidos'],$_POST['sexo'],$_POST['telefono'],$_POST['fecha_nacimiento'],$_POST['fecha_ingreso'],$_POST['id_area'],$array_disciplinas);
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
            $response = $funcionario->eliminar_funcionario($_POST['id_persona']);
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
        }else if ($accion == 'comprobar_pers_disciplinas') {
            $datos = $funcionario->comprobar_pers_disciplinas($_POST['id_diciplina'],$_POST['nombre_deporte'],$_POST['id_persona']);
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
        } else if ($accion == 'editar') {
            $datos = $funcionario->cargar_funcionario($_POST['id_persona']);
                echo json_encode($datos);
            return 0;
        }else if ($accion == 'modificar'){ 
            $array_disciplinas = explode(",", $_POST['disciplinas']);
            $response = $funcionario->modificar_funcionario($_POST['id'],$_POST['cedula'],$_POST['nombres'],$_POST['apellidos'],$_POST['sexo'],$_POST['telefono'],$_POST['fecha_nacimiento'],$_POST['fecha_ingreso'],$_POST['id_area'],$array_disciplinas);
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
        }else if ($accion == 'eliminar_deporte_funcionario') {
            $datos = $funcionario->eliminar_deporte_funcionario($_POST['id_deporte'],$_POST['id_persona']);
            echo json_encode($datos);
            return 0;
            exit;
        }else if ($accion == 'buscar_area') {
            $datos = $funcionario->buscar_area($_POST['id_division']);
            echo $datos;
            return 0;
            exit;
        }
    }
$funcionarios = $funcionario->listar_funcionarios();
$divisiones = $funcionario->listar_division();
$lista_deportes = $deporte->listar_deportes();
require_once "vista/" . $pagina . "Vista.php";
} else {
    echo "pagina en construccion";
}