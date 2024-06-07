<?php
namespace modelo;
use config\connect\connectDB as connectDB;
class GruposDeportivosModelo extends connectDB
{
    public function Consulta_deportes(){
        $sql=$this->conex->prepare("SELECT * FROM deportes");
        $resultado_arreglo=[];
        try{
            $sql->execute();
            $sql->setFetchMode(); 
            $resultado_arreglo = $sql->fetchAll();
            return $resultado_arreglo;

        }catch(Exception $e){

            return $e->getMessage();
            
        }
    }

    public function Consulta_personas(){

        $sql=$this->conex->prepare("SELECT * FROM personas");
        $resultado_arreglo=[];
        try{

            $sql->execute();
            $sql->setFetchMode();
            $resultado_arreglo=$sql->fetchAll();
            return $resultado_arreglo;

        }catch(Exception $e){

            return $e->getMessage();

        }
    }

    public function registrar_grupos_deportivo($id_deporte,$nombre_grupo,$descripcion_grupo,$integrantes)
    {
        $validar_registro = $this->validar_registro($nombre_grupo);
        if ($validar_registro==false) {
            $respuesta["resultado"]=2;
            $respuesta["mensaje"]="El deporte ya se encuentra registrado.";
        } else {
            try {
                $this->conex->query("INSERT INTO grupos_deportivos (
                    nombre_grupo, descripcion_grupo, estado
                    )
                VALUES (
                    '$nombre_grupo', '$descripcion_grupo', '1'
                )");
                $resultado1 = $this->conex->query("SELECT id_grupo_deportivo FROM grupos_deportivos WHERE nombre_grupo = '$nombre_grupo'");
                $filas = $resultado1->fetchAll();
                $id_grupo_deportivo = $filas[0]['id_grupo_deportivo'];
                
                $id = '';

                foreach ($integrantes as $valor) {
                    // Ejecutar la consulta para obtener el ID de la persona
                    $resultado2 = $this->conex->query("SELECT id_persona FROM personas WHERE cedula = '$valor'");
                    
                    // Obtener todos los resultados en un array
                    $filas_personas = $resultado2->fetchAll();
                    
                    // Verificar si se encontraron personas
                    if ($filas_personas) {
                        // Iterar sobre cada fila para obtener el ID de la persona
                        foreach ($filas_personas as $fila) {
                            $id_persona = $fila['id_persona'];
                            // Insertar el ID de la persona en la tabla personas_grupos
                            $this->conex->query("INSERT INTO personas_grupos (id_persona, id_deporte, id_grupo_deportivo) VALUES ('$id_persona', '$id_deporte', '$id_grupo_deportivo')");
                        }
                    }
                }
                
                $respuesta["resultado"] = 1;
                $respuesta["mensaje"] = "Registro Exitoso";                    
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }
        return $respuesta;
    }

    public function eliminar_grupos_deportivo($id_grupo_derportivo)
    {
        try {
            $this->conex->query("DELETE FROM personas_grupos WHERE id_grupo_deportivo = '$id_grupo_derportivo'");
            $this->conex->query("DELETE FROM grupos_deportivos WHERE id_grupo_deportivo = '$id_grupo_derportivo'");
            $respuesta['resultado'] = 1;
            $respuesta['mensaje'] = "Eliminacion exitosa";
            return $respuesta;
        } catch (Exception $e) {
            $respuesta['resultado'] = 0;
            $respuesta['mensaje'] = $e->getMessage();
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
            $respuesta['mensaje'] = "La persona ya se encuetra registrado.";
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
        try {
            $resultado = $this->conex->prepare("SELECT * FROM personas WHERE nombre_deporte='$nombre_deporte' AND id_deportes <>'$id'");
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

    public function lista_grupos_deportivos()
    {
        try {

            $resultado_grupos = $this->conex->prepare("SELECT * FROM grupos_deportivos");
            $resultado_grupos->execute();
            $grupos = $resultado_grupos->fetchAll();
            
            $datos_grupos = [];
            
            foreach ($grupos as $grupo) {
                $id_grupo = $grupo['id_grupo_deportivo'];
                $resultado_integrantes = $this->conex->prepare("SELECT personas.id_persona, personas.cedula, personas.nombres, personas.apellidos, deportes.nombre_deporte FROM personas INNER JOIN personas_grupos ON personas_grupos.id_persona = personas.id_persona INNER JOIN deportes ON deportes.id_deporte = personas_grupos.id_deporte WHERE personas_grupos.id_grupo_deportivo = ?");
                $resultado_integrantes->execute([$id_grupo]);
                $integrantes = $resultado_integrantes->fetchAll();
            
                $datos_grupo = [
                    'id_grupo_deportivo' => $grupo['id_grupo_deportivo'],
                    'deporte' => $integrantes[0]['nombre_deporte'],
                    'nombre_grupo' => $grupo['nombre_grupo'],
                    'descripcion_grupo' => $grupo['descripcion_grupo'],
                    'integrantes' => $integrantes,
                    'cantidad_integrantes' =>count($integrantes),
                ];
            
                $datos_grupos[] = $datos_grupo;
            }       

        } catch (Exception $e) {
            return $e->getMessage();
        }
        return $datos_grupos;
    }
    
    public function validar_registro($grupos_deportivos)
    {
        try {
            $resultado = $this->conex->prepare("SELECT * FROM grupos_deportivos WHERE nombre_grupo='$grupos_deportivos'");
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