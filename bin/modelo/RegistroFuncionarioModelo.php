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
    
            // (Opcional) Se vuelve a obtener el id_persona mediante consulta con fetchAll()
            $resultado1 = $this->conex->query("SELECT id_persona FROM personas WHERE cedula = '$cedula'");
            $filas = $resultado1->fetchAll();
            $id_persona = $filas[0]['id_persona'];
    
            // Insertar las disciplinas asociadas
            foreach ($disciplinas as $id_deporte) {
                // Insertar en la tabla diciplina_persona
                $this->conex->query("INSERT INTO diciplina_persona (id_persona, id_deporte) VALUES ('$id_persona', '$id_deporte')");
            }
    
            return ["resultado" => 1, "mensaje" => $id_persona];
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
        $resultado = $this->conex->prepare("SELECT *,divisiones.id_division as idDivision, areas.id_area as idArea FROM personas,areas,divisiones WHERE divisiones.id_division = areas.id_division AND areas.id_area = personas.id_area AND personas.id_persona = '$id_persona';");
        $respuestaArreglo = [];
        try {
            $resultado->execute();
            $respuestaArreglo = $resultado->fetchAll();
        } catch (Exception $e) {
            return $e->getMessage();
        }
        return $respuestaArreglo;
    }
    public function modificar_funcionario($id,$cedula,$nombres,$apellidos,$sexo,$telefono,$fecha_nacimiento,$fecha_ingreso,$id_area)
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
        $resultado = $this->conex->prepare("SELECT *, YEAR(CURDATE()) - YEAR(fecha_nacimiento) - (DATE_FORMAT(CURDATE(), '%m%d') < DATE_FORMAT(fecha_nacimiento, '%m%d')) AS edad, DATE_FORMAT(fecha_ingreso, '%d/%m/%Y') AS fecha_formateada,DATE_FORMAT(fecha_nacimiento, '%d/%m/%Y') AS fecha_nacimiento_formateada FROM personas;");
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