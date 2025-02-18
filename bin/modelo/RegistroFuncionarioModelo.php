<?php
namespace modelo;
use config\connect\connectDB as connectDB;
class RegistroFuncionarioModelo extends connectDB
{

    public function registrar_funcionario($cedula, $nombres, $apellidos, $sexo, $telefono, $fecha_nacimiento, $fecha_ingreso, $id_area, $disciplinas)
    {
        // Validar si la persona ya está registrada
        if (!$this->validar_registro($cedula)) {
            return ["resultado" => 2, "mensaje" => "La persona ya está registrada."];
        }
    
        try {
            // Insertar en la tabla personas
            $this->conex->query("INSERT INTO personas (
                id_area, cedula, nombres, apellidos, sexo, telefono, fecha_nacimiento, fecha_ingreso
            ) VALUES (
                '$id_area', '$cedula', '$nombres', '$apellidos', '$sexo', '$telefono', '$fecha_nacimiento', '$fecha_ingreso'
            )");
    
            // Obtener el ID generado para la persona recién insertada
            $id_persona = $this->conex->lastInsertId();
        
            // Insertar las disciplinas asociadas
            foreach ($disciplinas as $id_deporte) {
                // Insertar en la tabla diciplina_persona
                $this->conex->query("INSERT INTO diciplina_persona (id_persona, id_deporte) VALUES ('$id_persona', '$id_deporte')");
            }
    
            return ["resultado" => 1, "mensaje" => "Registro Exitoso."];
        } catch (Exception $e) {
            return ["resultado" => 0, "mensaje" => "Error: " . $e->getMessage()];
        }
    }
    

    public function eliminar_funcionario($id_persona)
    {
        try {
            $this->conex->query("DELETE FROM personas_grupos WHERE id_persona = '$id_persona'");
            $this->conex->query("DELETE FROM personas WHERE id_persona = '$id_persona'");
            $respuesta['resultado'] = 1;
            $respuesta['mensaje'] = "Eliminacion exitosa";
            return $respuesta;
        } catch (Exception $e) {
            $respuesta['resultado'] = 0;
            $respuesta['mensaje'] = $e->getMessage();
        }
    }

    public function cargar_funcionario($id_persona)
    {
        try {
            // Consulta principal para obtener los detalles del funcionario
            $resultado = $this->conex->prepare("SELECT personas.*, divisiones.id_division as idDivision, areas.id_area as idArea
                                                FROM personas
                                                JOIN areas ON areas.id_area = personas.id_area
                                                JOIN divisiones ON divisiones.id_division = areas.id_division
                                                WHERE personas.id_persona = ?");
            $resultado->execute([$id_persona]);
            $personas = $resultado->fetchAll(); // Obtener todos los resultados (aunque solo esperamos uno)
            
            if (count($personas) > 0) {
                $persona = $personas[0]; // Tomar el primer elemento si se encuentra alguna persona
            } else {
                return ['resultado' => 0, 'mensaje' => 'Funcionario no encontrado.'];
            }
    
            // Consulta para obtener los deportes vinculados al funcionario
            $resultado_deportes = $this->conex->prepare("SELECT deportes.id_deporte, deportes.nombre_deporte
                                                        FROM personas
                                                        JOIN diciplina_persona ON personas.id_persona = diciplina_persona.id_persona
                                                        JOIN deportes ON diciplina_persona.id_deporte = deportes.id_deporte
                                                        WHERE personas.id_persona = ?");
            $resultado_deportes->execute([$id_persona]);
            $deportes = $resultado_deportes->fetchAll(); // Obtener todos los deportes vinculados
    
            $edad = date('Y') - date('Y', strtotime($persona['fecha_nacimiento'])); // Año actual - Año de nacimiento

            // Si la fecha de nacimiento aún no ha pasado este año, restar 1 de la edad
            if (date('md') < date('md', strtotime($persona['fecha_nacimiento']))) {
                $edad--;
            }
            
            $datos_funcionario = [
                'id_persona' => $persona['id_persona'],
                'cedula' => $persona['cedula'],
                'nombres' => $persona['nombres'],
                'apellidos' => $persona['apellidos'],
                'telefono' => $persona['telefono'],
                'idDivision' => $persona['idDivision'],
                'idArea' => $persona['idArea'],
                'sexo' => $persona['sexo'],
                'edad' => $edad,
                'fecha_ingreso' => $persona['fecha_ingreso'],
                'fecha_nacimiento' => $persona['fecha_nacimiento'],
                'deportes' => $deportes // Lista de deportes vinculados
            ];

        } catch (Exception $e) {
            return ['resultado' => 0, 'mensaje' => 'Error: ' . $e->getMessage()];
        }
        return $datos_funcionario;
    }


    public function eliminar_deporte_funcionario($id_deporte, $id_persona)
    {
        // Verificar si el funcionario tiene al menos un deporte vinculado
        $validar_registro = $this->validar_elim_deportes($id_persona);
        if ($validar_registro == false) {
            return [
                'resultado' => 2,
                'mensaje' => 'Debe dejar al menos un deporte.'
            ];
        }
        try {
            // Eliminar el deporte vinculado al funcionario
            $this->conex->query("DELETE FROM diciplina_persona WHERE id_deporte = '$id_deporte' AND id_persona = '$id_persona'");
    
            // Obtener los datos del funcionario
            $resultado = $this->conex->prepare("SELECT personas.*, divisiones.id_division as idDivision, areas.id_area as idArea
                                                FROM personas
                                                JOIN areas ON areas.id_area = personas.id_area
                                                JOIN divisiones ON divisiones.id_division = areas.id_division
                                                WHERE personas.id_persona = ?");
            $resultado->execute([$id_persona]);
            $personas = $resultado->fetchAll(); // Obtener los datos del funcionario
    
            if (count($personas) > 0) {
                $persona = $personas[0];
            } else {
                return [
                    'resultado' => 0,
                    'mensaje' => 'Funcionario no encontrado.'
                ];
            }
    
            // Obtener los deportes restantes vinculados al funcionario
            $resultado_deportes = $this->conex->prepare("SELECT deportes.id_deporte, deportes.nombre_deporte
                                                        FROM personas
                                                        JOIN diciplina_persona ON personas.id_persona = diciplina_persona.id_persona
                                                        JOIN deportes ON diciplina_persona.id_deporte = deportes.id_deporte
                                                        WHERE personas.id_persona = ?");
            $resultado_deportes->execute([$id_persona]);
            $deportes = $resultado_deportes->fetchAll(); // Obtener todos los deportes restantes
    
            // Calcular la edad del funcionario
            $edad = date('Y') - date('Y', strtotime($persona['fecha_nacimiento'])); // Año actual - Año de nacimiento
            if (date('md') < date('md', strtotime($persona['fecha_nacimiento']))) {
                $edad--;
            }
    
            // Preparar la respuesta con los datos actualizados del funcionario
            $datos_funcionario = [
                'id_persona' => $persona['id_persona'],
                'cedula' => $persona['cedula'],
                'nombres' => $persona['nombres'],
                'apellidos' => $persona['apellidos'],
                'telefono' => $persona['telefono'],
                'idDivision' => $persona['idDivision'],
                'idArea' => $persona['idArea'],
                'sexo' => $persona['sexo'],
                'edad' => $edad,
                'fecha_ingreso' => $persona['fecha_ingreso'],
                'fecha_nacimiento' => $persona['fecha_nacimiento'],
                'deportes' => $deportes // Lista de deportes restantes
            ];
        } catch (Exception $e) {
            return [
                'resultado' => 0,
                'mensaje' => 'Error al eliminar el deporte: ' . $e->getMessage()
            ];
        }
        return $datos_funcionario; 
    }
    
    public function validar_elim_deportes($id_persona)
    {
        try {
            $resultado = $this->conex->prepare("SELECT * FROM diciplina_persona WHERE id_persona = '$id_persona'");
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
    
    public function modificar_funcionario($id,$cedula,$nombres,$apellidos,$sexo,$telefono,$fecha_nacimiento,$fecha_ingreso,$id_area,$disciplinas)
    {
        $validar_modificar = $this->validar_modificar($id, $cedula);
        if ($validar_modificar) {
            $respuesta['resultado'] = 2;
            $respuesta['mensaje'] = "La persona ya está registrada.";
        }else {
            try {
                $this->conex->query("UPDATE personas SET id_area = '$id_area', cedula = '$cedula', nombres = '$nombres', apellidos = '$apellidos', sexo = '$sexo', telefono = '$telefono', fecha_nacimiento = '$fecha_nacimiento', fecha_ingreso = '$fecha_ingreso' WHERE id_persona = '$id'");
                $respuesta["resultado"]=1;
                $respuesta["mensaje"]="Modificación exitosa.";

                $this->conex->query("DELETE FROM diciplina_persona WHERE id_persona = '$id'");
                foreach ($disciplinas as $id_deporte) {
                    // Insertar en la tabla diciplina_persona
                    $this->conex->query("INSERT INTO diciplina_persona (id_persona, id_deporte) VALUES ('$id', '$id_deporte')");
                }

            } catch (Exception $e) {
                $respuesta['resultado'] = 0;
                $respuesta['mensaje'] = $e->getMessage();
            }
        }
        return $respuesta;
    }

    public function validar_modificar($id, $cedula)
    {
        try {
            $resultado = $this->conex->prepare("SELECT * FROM personas WHERE cedula='$cedula' AND id_persona <>'$id'");
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

    public function buscar_area($id_division)
    {
        $resultado = $this->conex->prepare("SELECT * FROM areas WHERE id_division = ?");
        $respuestaArreglo = [];
        try {
            $resultado->execute([$id_division]);
            $respuestaArreglo = $resultado->fetchAll();
        } catch (Exception $e) {
            // Manejar el error apropiadamente, por ejemplo, loguearlo
            return "Error al buscar áreas: " . $e->getMessage();
        }
    
        $optionsHTML = '';
        foreach ($respuestaArreglo as $fila) {
            $optionsHTML .= '<option value="' . $fila['id_area'] . '">' . $fila['nombre_area'] . '</option>';
        }
    
        $selectHTML = '<div class="col-12">';
        $selectHTML .= '<div class="input-group mb-1">';
        $selectHTML .= '<label class="input-group-text" for="area">Área</label>';
        $selectHTML .= '<select class="form-select" id="area">';
        $selectHTML .= '<option value="0" selected>...</option>';
        $selectHTML .= $optionsHTML;
        $selectHTML .= '</select>';
        $selectHTML .= '</div>';
        $selectHTML .= '<span id="sarea"></span>';
        $selectHTML .= '</div>';
    
        return $selectHTML;
    }
    
    public function listar_funcionarios()
    {
        $resultado = $this->conex->prepare("
        SELECT 
            personas.*,
            YEAR(CURDATE()) - YEAR(personas.fecha_nacimiento) - (DATE_FORMAT(CURDATE(), '%m%d') < DATE_FORMAT(personas.fecha_nacimiento, '%m%d')) AS edad,
            DATE_FORMAT(personas.fecha_ingreso, '%d/%m/%Y') AS fecha_formateada,
            DATE_FORMAT(personas.fecha_nacimiento, '%d/%m/%Y') AS fecha_nacimiento_formateada,
            GROUP_CONCAT(deportes.nombre_deporte ORDER BY deportes.nombre_deporte ASC SEPARATOR ', ') AS deportes_vinculados
        FROM 
            personas
        JOIN 
            diciplina_persona ON personas.id_persona = diciplina_persona.id_persona
        JOIN 
            deportes ON diciplina_persona.id_deporte = deportes.id_deporte
        GROUP BY 
            personas.id_persona;
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

    public function listar_division()
    {
        $resultado = $this->conex->prepare("SELECT * FROM divisiones");
        $respuestaArreglo = [];
        try {
            $resultado->execute();
            $respuestaArreglo = $resultado->fetchAll();
        } catch (Exception $e) {
            return $e->getMessage();
        }
        return $respuestaArreglo;
    }

    
    public function validar_registro($cedula)
    {
        try {
            $resultado = $this->conex->prepare("SELECT * FROM personas WHERE cedula='$cedula'");
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