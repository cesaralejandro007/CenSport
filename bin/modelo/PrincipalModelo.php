<?php
namespace modelo;
use config\connect\connectDB as connectDB;
class PrincipalModelo extends connectDB
{
    public function listado_func_deport()
    {
        try {
            $resultado = $this->conex->prepare("SELECT *, YEAR(CURDATE()) - YEAR(fecha_nacimiento) - (DATE_FORMAT(CURDATE(), '%m%d') < DATE_FORMAT(fecha_nacimiento, '%m%d')) AS edad, DATE_FORMAT(fecha_ingreso, '%d/%m/%Y') AS fecha_formateada,DATE_FORMAT(fecha_nacimiento, '%d/%m/%Y') AS fecha_nacimiento_formateada FROM personas;");
            $datos_grupos = [];
            $resultado->execute();
            $personas = $resultado->fetchAll();
            foreach ($personas as $persona) {
                $cedula = $persona['cedula'];
                $deportes = $this->conex->prepare("SELECT personas.cedula as cedula, deportes.id_deporte AS id_deporte, deportes.nombre_deporte as nombre_deporte FROM personas,personas_grupos,deportes WHERE personas.id_persona = personas_grupos.id_persona AND personas_grupos.id_deporte = deportes.id_deporte AND personas.cedula = ?");
                $deportes->execute([$cedula]);
                $deporte_persona = $deportes->fetchAll();
                if(count($deporte_persona)!=0){
                    $datos_grupo = [
                        'cedula' => $persona['cedula'],
                        'nombres' => $persona['nombres'],
                        'apellidos' => $persona['apellidos'],
                        'sexo' => $persona['sexo'],
                        'fecha_nacimiento' =>$persona['fecha_nacimiento_formateada'],
                        'edad' =>$persona['edad'],
                        'fecha_ingreso' =>$persona['fecha_formateada'],
                        'telefono' =>$persona['telefono'],
                        'deportes_persona' => $deporte_persona,
                    ];
                }
                if (!empty($datos_grupo)) {
                    $datos_grupos[] = $datos_grupo;
                }
            }   

        } catch (Exception $e) {
            return $e->getMessage();
        }
        return $datos_grupos;
    }

    public function reporte_deporte_masculino()
    {
        try {
            $resultado = $this->conex->prepare("SELECT COUNT(personas_grupos.id_persona) AS cantida_personas, deportes.nombre_deporte AS nombre_deporte FROM deportes,personas_grupos,personas WHERE deportes.id_deporte = personas_grupos.id_deporte AND personas_grupos.id_persona = personas.id_persona AND personas.sexo = 'Masculino' GROUP BY nombre_deporte");
            $resultado->execute();
            $info = $resultado->fetchAll();
            $reporte_deporte[] = $info;
            
        } catch (Exception $e) {
            return $e->getMessage();
        }
        return $reporte_deporte;
    }
    
    public function reporte_deporte_femenino()
    {
        try {
            $resultado = $this->conex->prepare("SELECT COUNT(personas_grupos.id_persona) AS cantida_personas, deportes.nombre_deporte AS nombre_deporte FROM deportes,personas_grupos,personas WHERE deportes.id_deporte = personas_grupos.id_deporte AND personas_grupos.id_persona = personas.id_persona AND personas.sexo = 'Femenino' GROUP BY nombre_deporte");
            $resultado->execute();
            $info = $resultado->fetchAll();
            $reporte_deporte[] = $info;
            
        } catch (Exception $e) {
            return $e->getMessage();
        }
        return $reporte_deporte;
    }
}