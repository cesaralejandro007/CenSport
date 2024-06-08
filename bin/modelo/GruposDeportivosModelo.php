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
        $validar_deporte = $this->validar_deporte($id_deporte);
        $validar_registro = $this->validar_registro($nombre_grupo);
        if ($validar_deporte==false) {
            $respuesta["resultado"]=2;
            $respuesta["mensaje"]="El deporte del grupo deportivo ya está registrado.";
        }else if ($validar_registro==false) {
            $respuesta["resultado"]=2;
            $respuesta["mensaje"]="El nombre del Grupo Deportivo ya está registrado.";
        }else {
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
            $respuesta['mensaje'] = "Eliminación exitosa";
            return $respuesta;
        } catch (Exception $e) {
            $respuesta['resultado'] = 0;
            $respuesta['mensaje'] = $e->getMessage();
        }
    }

    public function eliminar_pers_grup_deport($id_persona,$id_grupo_derportivo)
    {
        $validar_registro = $this->validar_elim_grup_pers($id_grupo_derportivo);
        $datos_grupos = [];
        if ($validar_registro==false) {
            $datos_grupos["resultado"]=2;
            $datos_grupos["mensaje"]="Debe dejar al menos un integrante en el grupo.";
        } else {
            try {
                $this->conex->query("DELETE FROM personas_grupos WHERE id_grupo_deportivo = '$id_grupo_derportivo' AND id_persona = '$id_persona'");
                
                $resultado = $this->conex->prepare("SELECT * FROM personas,personas_grupos,deportes,grupos_deportivos WHERE personas.id_persona = personas_grupos.id_persona AND personas_grupos.id_deporte = deportes.id_deporte AND grupos_deportivos.id_grupo_deportivo = personas_grupos.id_grupo_deportivo AND personas_grupos.id_grupo_deportivo = '$id_grupo_derportivo'  GROUP BY personas_grupos.id_grupo_deportivo");
                $info_grupo_deportivo = [];
                $resultado->execute();
                $info_grupo_deportivo = $resultado->fetchAll();
    
               
                
                foreach ($info_grupo_deportivo as $data) {
    
                    $resultado_integrantes = $this->conex->prepare("SELECT personas.id_persona, personas.cedula, personas.nombres, personas.apellidos, deportes.id_deporte FROM personas INNER JOIN personas_grupos ON personas_grupos.id_persona = personas.id_persona INNER JOIN deportes ON deportes.id_deporte = personas_grupos.id_deporte WHERE personas_grupos.id_grupo_deportivo = ?");
                    $resultado_integrantes->execute([$id_grupo_derportivo]);
                    $integrantes = $resultado_integrantes->fetchAll();
                
                    $datos_grupo = [
                        'id_grupo_deportivo' => $data['id_grupo_deportivo'],
                        'id_deporte' => $integrantes[0]['id_deporte'],
                        'nombre_grupo' => $data['nombre_grupo'],
                        'descripcion_grupo' => $data['descripcion_grupo'],
                        'integrantes' => $integrantes,
                    ];
                
                    $datos_grupos[] = $datos_grupo;
                }     


                } catch (Exception $e) {
                    $respuesta['resultado'] = 0;
                    $respuesta['mensaje'] = $e->getMessage();
                }
            }
        return $datos_grupos;
    }

    public function cargar_grupos_deportivo($id_grupos_deportivo)
    {
        try {
            $resultado = $this->conex->prepare("SELECT * FROM personas,personas_grupos,deportes,grupos_deportivos WHERE personas.id_persona = personas_grupos.id_persona AND personas_grupos.id_deporte = deportes.id_deporte AND grupos_deportivos.id_grupo_deportivo = personas_grupos.id_grupo_deportivo AND personas_grupos.id_grupo_deportivo = '$id_grupos_deportivo'  GROUP BY personas_grupos.id_grupo_deportivo");
            $info_grupo_deportivo = [];
            $resultado->execute();
            $info_grupo_deportivo = $resultado->fetchAll();

            $datos_grupos = [];
            
            foreach ($info_grupo_deportivo as $data) {

                $resultado_integrantes = $this->conex->prepare("SELECT personas.id_persona, personas.cedula, personas.nombres, personas.apellidos, deportes.id_deporte FROM personas INNER JOIN personas_grupos ON personas_grupos.id_persona = personas.id_persona INNER JOIN deportes ON deportes.id_deporte = personas_grupos.id_deporte WHERE personas_grupos.id_grupo_deportivo = ?");
                $resultado_integrantes->execute([$id_grupos_deportivo]);
                $integrantes = $resultado_integrantes->fetchAll();
            
                $datos_grupo = [
                    'id_grupo_deportivo' => $data['id_grupo_deportivo'],
                    'id_deporte' => $integrantes[0]['id_deporte'],
                    'nombre_grupo' => $data['nombre_grupo'],
                    'descripcion_grupo' => $data['descripcion_grupo'],
                    'integrantes' => $integrantes,
                ];
            
                $datos_grupos[] = $datos_grupo;
            }     

        } catch (Exception $e) {
            return $e->getMessage();
        }
        return $datos_grupos;
    }

    public function modificar_grupos_deportivo($id_grupo_deportivo,$id_deporte,$nombre_grupo,$descripcion_grupo)
    {
        $validar_modif_deporte = $this->validar_modif_deporte($id_deporte,$id_grupo_deportivo);
        $validar_modificar = $this->validar_modificar($id_grupo_deportivo, $nombre_grupo);
        if ($validar_modif_deporte) {
            $respuesta['resultado'] = 2;
            $respuesta['mensaje'] = "El Deporte del grupo deportivo ya está asignado a otro grupo.";
        }else if ($validar_modificar) {
            $respuesta['resultado'] = 2;
            $respuesta['mensaje'] = "El nombre del Grupo Deportivo ya está asignado a otro grupo.";
        }else {
            try {
                $this->conex->query("UPDATE grupos_deportivos SET nombre_grupo = '$nombre_grupo', descripcion_grupo = '$descripcion_grupo' WHERE id_grupo_deportivo = '$id_grupo_deportivo'");
                $respuesta["resultado"]=1;
                $respuesta["mensaje"]="Modificación exitosa.";
            } catch (Exception $e) {
                $respuesta['resultado'] = 0;
                $respuesta['mensaje'] = $e->getMessage();
            }
        }
        return $respuesta;
    }

    public function modificar_integ_grup_deport($id_grupo_deportivo,$id_deporte,$array_integrantes)
    {
    try {

        $this->conex->query("DELETE FROM personas_grupos WHERE id_grupo_deportivo = '$id_grupo_deportivo'");

        foreach ($array_integrantes as $valor) {
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
        $respuesta["resultado"]=1;
        $respuesta["mensaje"]="Modificación exitosa.";
    } catch (Exception $e) {
        $respuesta['resultado'] = 0;
        $respuesta['mensaje'] = $e->getMessage();
    }

    return $respuesta;
    }

    public function validar_modif_deporte($id_deporte, $id_grupo)
    {
        try {
            $resultado = $this->conex->prepare("SELECT * FROM personas,personas_grupos,deportes,grupos_deportivos WHERE personas.id_persona = personas_grupos.id_persona AND personas_grupos.id_grupo_deportivo = grupos_deportivos.id_grupo_deportivo AND personas_grupos.id_deporte = deportes.id_deporte AND deportes.id_deporte = '$id_deporte' AND grupos_deportivos.id_grupo_deportivo <> '$id_grupo' GROUP BY deportes.nombre_deporte");
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

    public function validar_modificar($id, $nombre_grupo)
    {
        try {
            $resultado = $this->conex->prepare("SELECT * FROM grupos_deportivos WHERE nombre_grupo = '$nombre_grupo' AND id_grupo_deportivo <>'$id'");
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

    public function comprobar_pers_deporte($cedula,$nombre)
    {
        try {
            $resultado = $this->conex->prepare("SELECT * FROM personas,personas_grupos,deportes WHERE personas_grupos.id_persona = personas.id_persona AND personas_grupos.id_deporte = deportes.id_deporte AND personas.cedula = '$cedula'");
            $resultado->execute();
            $filas = $resultado->rowCount();
            if ($filas >= 3) {
                $respuesta["resultado"]=2;
                $respuesta["mensaje"]="La persona ". $nombre ." ha excedido el límite de deportes permitidos.";
            } else {
                $respuesta["resultado"]=1;
            }
            return $respuesta;
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

    public function validar_deporte($id_deporte)
    {
        try {
            $resultado = $this->conex->prepare("SELECT * FROM personas,personas_grupos,deportes,grupos_deportivos WHERE personas.id_persona = personas_grupos.id_persona AND personas_grupos.id_grupo_deportivo = grupos_deportivos.id_grupo_deportivo AND personas_grupos.id_deporte = deportes.id_deporte AND deportes.id_deporte = '$id_deporte' GROUP BY deportes.nombre_deporte");
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

    public function validar_elim_grup_pers($grupos_deportivos)
    {
        try {
            $resultado = $this->conex->prepare("SELECT * FROM personas_grupos WHERE id_grupo_deportivo = '$grupos_deportivos'");
            $resultado->execute();
            $fila = $resultado->rowCount();
            if ($fila == 1) {
                return false;
            } else {
                return true;
            }
        } catch (Exception $e) {
            return false;
        }
    }
    
}