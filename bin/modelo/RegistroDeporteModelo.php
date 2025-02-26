<?php
namespace modelo;
use config\connect\connectDB as connectDB;
class RegistroDeporteModelo extends connectDB
{
    public function registrar_deporte($nombre_deporte)
    {
        $validar_registro = $this->validar_registro($nombre_deporte);
        if ($validar_registro==false) {
            $respuesta["resultado"]=2;
            $respuesta["mensaje"]="El deporte ya está registrado.";
        } else {
            try {
            $this->conex->query("INSERT INTO deportes(
                nombre_deporte
                )
            VALUES(
                '$nombre_deporte'
            )");

            $respuesta["resultado"]=1;
            $respuesta["mensaje"]="Registro Exitoso.";
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }
        return $respuesta;
    }

    public function eliminar_deporte($id_deporte)
    {
        $validar_registro = $this->validar_personas_deportes($id_deporte);
        if ($validar_registro==false) {
            $respuesta["resultado"]=2;
            $respuesta["mensaje"]="Existen personas que estan asociado a ese deporte.";
        } else {
            try {
                $this->conex->query("DELETE personas_grupos, grupos_deportivos FROM personas_grupos INNER JOIN grupos_deportivos ON grupos_deportivos.id_grupo_deportivo = personas_grupos.id_grupo_deportivo WHERE personas_grupos.id_deporte = '$id_deporte';");
                $this->conex->query("DELETE FROM deportes WHERE id_deporte = '$id_deporte'");
                $respuesta['resultado'] = 1;
                $respuesta['mensaje'] = "Eliminacion exitosa";
                return $respuesta;
            } catch (Exception $e) {
                $respuesta['resultado'] = 0;
                $respuesta['mensaje'] = $e->getMessage();
            }
        }
        return $respuesta;
    }  

    public function validar_personas_deportes($id_deporte)
    {
        try {
            $resultado = $this->conex->prepare("SELECT * FROM deportes,diciplina_persona WHERE deportes.id_deporte = diciplina_persona.id_deporte AND diciplina_persona.id_deporte ='$id_deporte';");
            $resultado->execute();
            $fila = $resultado->fetchAll();
            if ($fila) {
                return false;
            } else {
                return true;
            }
        } catch (Exception $e) {
            return false;
        }
    }

    public function cargar_deporte($id_deporte)
    {
        $resultado = $this->conex->prepare("SELECT * FROM deportes WHERE id_deporte = '$id_deporte';");
        $respuestaArreglo = [];
        try {
            $resultado->execute();
            $respuestaArreglo = $resultado->fetchAll();
        } catch (Exception $e) {
            return $e->getMessage();
        }
        return $respuestaArreglo;
    }

    public function modificar_deporte($id ,$nombre_deporte)
    {
        $validar_modificar = $this->validar_modificar($id, $nombre_deporte);
        if ($validar_modificar) {
            $respuesta['resultado'] = 3;
            $respuesta['mensaje'] = "La persona ya se está registrada.";
        }else {
            try {
                $this->conex->query("UPDATE deportes SET nombre_deporte = '$nombre_deporte' WHERE id_deporte = '$id'");
                $respuesta["resultado"]=1;
                $respuesta["mensaje"]="Modificación exitosa.";
            } catch (Exception $e) {
                $respuesta['resultado'] = 0;
                $respuesta['mensaje'] = $e->getMessage();
            }
        }
        return $respuesta;
    }

    public function validar_modificar($id, $nombre_deporte)
    {
        $nombre_deporte_sin_espacio = trim($nombre_deporte);
        try {
            $resultado = $this->conex->prepare("SELECT * FROM deportes WHERE nombre_deporte='$nombre_deporte_sin_espacio' AND id_deporte <>'$id'");
            $resultado->execute();
            $fila = $resultado->fetchAll();
            if ($fila) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
    }

    public function listar_deportes()
    {
        $resultado = $this->conex->prepare("SELECT * FROM deportes");
        $respuestaArreglo = [];
        try {
            $resultado->execute();
            $respuestaArreglo = $resultado->fetchAll();
        } catch (Exception $e) {
            return $e->getMessage();
        }
        return $respuestaArreglo;
    }
    
    public function validar_registro($nombre_deporte)
    {
        $nombre_deporte_sin_espacio = trim($nombre_deporte);
        try {
            $resultado = $this->conex->prepare("SELECT * FROM deportes WHERE nombre_deporte='$nombre_deporte_sin_espacio'");
            $resultado->execute();
            $fila = $resultado->fetchAll();
            if ($fila) {
                return false;
            } else {
                return true;
            }
        } catch (Exception $e) {
            return false;
        }
    }
}