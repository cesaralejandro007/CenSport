<?php
namespace modelo;
use config\connect\connectDB as connectDB;
class AperturarCensoModelo extends connectDB
{
    
    public function listar($cedula)
    {

    }

    public function listar_censos()
    {
        $resultado = $this->conex->prepare("SELECT usuarios.*, censo.*,
                                                CONCAT(usuarios.cedula, ' - ', usuarios.nombres, ' ', usuarios.apellidos) AS usuario,
                                                censo.nombre AS nombre_censo, 
                                                censo.descripcion AS descripcion_censo, 
                                                CONCAT('Fecha: ', DATE_FORMAT(censo.fecha_inicio, '%d-%m-%Y'), ' | Hora: ', DATE_FORMAT(censo.fecha_inicio, '%H:%i:%s')) AS fecha_inicio_censo, 
                                                CONCAT('Fecha: ', DATE_FORMAT(censo.fecha_final, '%d-%m-%Y'), ' | Hora: ', DATE_FORMAT(censo.fecha_final, '%H:%i:%s')) AS fecha_final_censo
                                            FROM censo
                                            JOIN usuarios ON censo.id_usuario = usuarios.id_usuario;");
        $respuestaArreglo = [];
        try {
            $resultado->execute();
            $respuestaArreglo = $resultado->fetchAll();
        } catch (Exception $e) {
            return $e->getMessage();
        }
        return $respuestaArreglo;
    }
    
}