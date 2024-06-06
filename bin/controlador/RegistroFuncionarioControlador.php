<?php
use modelo\RegistroFuncionarioModelo as Funcionario;
use config\componentes\configSistema as configSistema;

$config = new configSistema;
if (!is_file($config->_Dir_Model_().$pagina.$config->_MODEL_())) {
    echo "Falta definir la clase " . $pagina;
    exit;
}
$funcionario = new Funcionario();
if (is_file("vista/" . $pagina . "Vista.php")) {
    if (isset($_POST['accion'])) {
        $modulo = 'Funcionarios:';
        $accion = $_POST['accion'];
        if ($accion == 'registrar') {
            $response = $funcionario->registrar_funcionario($_POST['cedula'],$_POST['nombres'],$_POST['apellidos'],$_POST['sexo'],$_POST['correo'],$_POST['fecha_nacimiento'],$_POST['fecha_ingreso'],$_POST['id_area']);
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
        } else if ($accion == 'editar') {
            $datos = $funcionario->cargar_funcionario($_POST['id_persona']);
            foreach ($datos as $valor) {
                echo json_encode([
                    'id_persona' => $valor['id_persona'],
                    'cedula' => $valor['cedula'],
                    'nombres' => $valor['nombres'],
                    'apellidos' => $valor['apellidos'],
                    'sexo' => $valor['sexo'],
                    'correo' => $valor['correo'],
                    'fecha_nacimiento' => $valor['fecha_nacimiento'],
                    'fecha_ingreso' => $valor['fecha_ingreso'],
                    'idDivision' => $valor['idDivision'],
                    'idArea' => $valor['idArea'],
                ]);
            }
            return 0;
        }else if ($accion == 'modificar'){ 
            $response = $funcionario->modificar_funcionario($_POST['id'],$_POST['cedula'],$_POST['nombres'],$_POST['apellidos'],$_POST['sexo'],$_POST['correo'],$_POST['fecha_nacimiento'],$_POST['fecha_ingreso'],$_POST['id_area']);
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
        }else if ($accion == 'buscar_area') {
            $datos = $funcionario->buscar_area($_POST['id_division']);
            echo $datos;
            return 0;
            exit;
        }
    }
$funcionarios = $funcionario->listar_funcionarios();
$divisiones = $funcionario->listar_division();
require_once "vista/" . $pagina . "Vista.php";
} else {
    echo "pagina en construccion";
}