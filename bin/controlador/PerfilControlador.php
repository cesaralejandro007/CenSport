<?php

use modelo\PerfilModelo as Perfil;
use config\componentes\configSistema as configSistema;

$config = new configSistema;
$perfil = new Perfil();
session_start();

if (!isset($_SESSION['usuario'])) {
    echo '<script>window.location="?pagina=' . configSistema::_INICIO_() . '"</script>';
    exit;
}

if (!is_file($config->_Dir_Model_() . $pagina . $config->_MODEL_())) {
    exit("Falta definir la clase " . $pagina);
}

if (is_file("vista/" . $pagina . "Vista.php")) {

    if (!empty($_POST['accion'])) {
        switch ($_POST['accion']) {
            case 'verificar_perfil':
                $response = $perfil->verificarcambio_password($_POST['cedula']);
                echo password_verify($_POST['clave_actual'], $response[0]['password']) ? 1 : 0;
                break;

            case 'cambiar_password':
                $response = $perfil->cambiar_password($_POST['nueva_clave'], $_POST['cedula']);
                echo json_encode([
                    'estatus' => $response == 1 ? '1' : '2',
                    'icon' => $response == 1 ? 'success' : 'error',
                    'title' => 'Perfil',
                    'message' => $response == 1 ? 'La clave se actualizó correctamente' : 'Error en la base de datos'
                ]);
                break;
        }
        exit;
    }

    require_once "vista/" . $pagina . "Vista.php";
} else {
    exit("Página en construcción");
}
