<?php

use modelo\PerfilModelo as Perfil;

use config\componentes\configSistema as configSistema;

$config = new configSistema;
$Perfil = new Perfil();

if (!is_file($config->_Dir_Model_().$pagina.$config->_MODEL_())) {
    echo "Falta definir la clase " . $pagina;
    exit;
}

if (is_file("vista/" . $pagina . "Vista.php")) {

    if (isset($_POST['accion'])) {
        $accion = $_POST['accion'];
        if ($accion == 'verificar_perfil') {
            $response = $Perfil->verificarcambio_password($_POST['cedula']);
            //VERIFICAR CLAVE (password_hash)
            if($_POST['clave_actual'] == $response[0]['password']){
                echo 1;
            }else{
                echo 0;
            }
            return 0;
        }else if ($accion == 'cambiar_pasword') {
            //CLAVE ENCRIPTADA (password_hash)
            $response = $Perfil->cambiar_password($_POST['nueva_clave'],$_POST['cedula']);
            if($response == 1){
                echo json_encode([
                    'estatus' => '1',
                    'icon' => 'success',
                    'title' => 'Perfil',
                    'message' => 'La clave se actualizo correctamente'
                ]);
            }else{
                echo json_encode([
                    'estatus' => '2',
                    'icon' => 'error',
                    'title' => 'Perfil',
                    'message' => 'error BD'
                ]);
            }
            return 0;
        }
    }
    require_once "vista/" . $pagina . "Vista.php";
} else {
    echo "pagina en construccion";
}