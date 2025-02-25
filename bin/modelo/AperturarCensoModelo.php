<?php
namespace modelo;
use config\connect\connectDB as connectDB;
class AperturarCensoModelo extends connectDB
{
    
    public function registrar_censo($nombre, $descripcion, $fecha_inicio, $fecha_fin, $id_usuario)
    {
        $validar_registro = $this->validar_registro($nombre, $fecha_inicio, $fecha_fin);
    
        if ($validar_registro == 2) {
            return ["resultado" => 2, "mensaje" => "El nombre del censo ya existe."];
        } else if ($validar_registro == 3) {
            return ["resultado" => 3, "mensaje" => "El censo actual aún no ha finalizado."];
        } else if ($validar_registro != 1) {
            return ["resultado" => 0, "mensaje" => "Error en la validación: " . $validar_registro];
        }
    
        try {
            $consulta = $this->conex->prepare("INSERT INTO censo (nombre, descripcion, fecha_inicio, fecha_final, id_usuario) 
                                               VALUES (:nombre, :descripcion, :fecha_inicio, :fecha_final, :id_usuario)");
            $consulta->bindValue(":nombre", trim($nombre));
            $consulta->bindValue(":descripcion", $descripcion);
            $consulta->bindValue(":fecha_inicio", $fecha_inicio);
            $consulta->bindValue(":fecha_final", $fecha_fin);
            $consulta->bindValue(":id_usuario", $id_usuario);
            $consulta->execute();
    
            return ["resultado" => 1, "mensaje" => "Registro exitoso."];
    
        } catch (Exception $e) {
            return ["resultado" => 0, "mensaje" => "Error en la base de datos: " . $e->getMessage()];
        }
    }
    
    public function validar_registro($nombre, $fecha_inicio, $fecha_final)
    {
        $nombre_censo_sin_espacio = trim($nombre);
    
        try {
            // Verificar si el nombre ya existe
            $consulta = $this->conex->prepare("SELECT COUNT(*) FROM censo WHERE nombre = :nombre");
            $consulta->bindValue(":nombre", $nombre_censo_sin_espacio);
            $consulta->execute();
            if ($consulta->fetchColumn() > 0) {
                return 2; // Nombre ya existe
            }
    
            // Verificar si hay un censo activo (donde la fecha final aún no ha pasado)
            $consulta = $this->conex->prepare("SELECT COUNT(*) FROM censo WHERE fecha_final >= NOW()");
            $consulta->execute();
            if ($consulta->fetchColumn() > 0) {
                return 3; // Aún hay un censo activo
            }
    
            return 1; // Todo correcto
    
        } catch (Exception $e) {
            return "Error al validar: " . $e->getMessage();
        }
    }

    public function eliminar_censo($id_censo)
    {
        try {
            $this->conex->query("DELETE FROM censo WHERE id_censo = '$id_censo'");
            $respuesta['resultado'] = 1;
            $respuesta['mensaje'] = "Eliminacion exitosa";
            return $respuesta;
        } catch (Exception $e) {
            $respuesta['resultado'] = 0;
            $respuesta['mensaje'] = $e->getMessage();
        }
    }

    public function listar_censos()
    {
        $resultado = $this->conex->prepare("
            SELECT usuarios.*, censo.*,
                CONCAT(usuarios.cedula, ', ', usuarios.nombres, ' ', usuarios.apellidos) AS usuario,
                censo.nombre AS nombre_censo, 
                censo.descripcion AS descripcion_censo, 
                CONCAT('Fecha: ', DATE_FORMAT(censo.fecha_inicio, '%d/%m/%Y'), ' - Hora: ', DATE_FORMAT(censo.fecha_inicio, '%h:%i %p')) AS fecha_inicio_censo, 
                CONCAT('Fecha: ', DATE_FORMAT(censo.fecha_final, '%d/%m/%Y'), ' - Hora: ', DATE_FORMAT(censo.fecha_final, '%h:%i %p')) AS fecha_final_censo
            FROM censo
            JOIN usuarios ON censo.id_usuario = usuarios.id_usuario;
        ");
    
        $respuestaArreglo = [];
        try {
            $resultado->execute();
            $respuestaArreglo = $resultado->fetchAll();
        } catch (Exception $e) {
            return $e->getMessage();
        }
        return $respuestaArreglo;
    }
   

    public function cargar_censo($id_censo)
    {
        $resultado = $this->conex->prepare("SELECT * FROM censo WHERE id_censo = '$id_censo';");
        $respuestaArreglo = [];
        try {
            $resultado->execute();
            $respuestaArreglo = $resultado->fetchAll();
        } catch (Exception $e) {
            return $e->getMessage();
        }
        return $respuestaArreglo;
    }


    public function modificar_censo($id, $nombre, $descripcion, $fecha_inicio, $fecha_fin, $id_usuario)
    {
        $validar_modificar = $this->validar_modificar($id, $nombre);
        if ($validar_modificar) {
            $respuesta['resultado'] = 2;
            $respuesta['mensaje'] = "El nombre del censo ya existe.";
        }else {
            try {
                $this->conex->query("UPDATE censo SET nombre = '$nombre',descripcion = '$descripcion',fecha_inicio = '$fecha_inicio',fecha_final = '$fecha_fin',id_usuario = '$id_usuario' WHERE id_censo = '$id'");
                $respuesta["resultado"]=1;
                $respuesta["mensaje"]="Modificación exitosa.";
            } catch (Exception $e) {
                $respuesta['resultado'] = 0;
                $respuesta['mensaje'] = $e->getMessage();
            }
        }
        return $respuesta;
    }

    public function validar_modificar($id, $nombre)
    {
        $nombre_censo_sin_espacio = trim($nombre);
        try {
            $resultado = $this->conex->prepare("SELECT * FROM censo WHERE nombre='$nombre_censo_sin_espacio' AND id_censo <>'$id'");
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

    public function consultar_censo_activo() {
        $consulta = $this->conex->prepare("SELECT COUNT(*) FROM censo WHERE fecha_final >= NOW() AND fecha_inicio <= NOW()");
        $consulta->execute();
        return ($consulta->fetchColumn() > 0) ? true : false;
    }
    
    
}