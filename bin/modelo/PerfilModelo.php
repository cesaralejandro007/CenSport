<?php
namespace modelo;
use config\connect\connectDB as connectDB;
class PerfilModelo extends connectDB
{
    
    public function verificarcambio_password($cedula)
        {
            try {
                $sql = "SELECT password FROM user WHERE cedula_user = ?";
                $stmt = $this->conex->prepare($sql);
                $stmt->execute([$cedula]);
                $respuestaArreglo = $stmt->fetchAll();
            } catch (Exception $e) {
                return $e->getMessage();
            }
            return $respuestaArreglo;
        }

    public function cambiar_password($clave, $cedula)
        {
            try {
                $stmt = $this->conex->prepare("UPDATE user SET password = ? WHERE cedula_user = ?");
                $stmt->execute([$clave, $cedula]);
                return 1; // Éxito
            } catch (Exception $e) {
                return $e->getMessage(); // Manejo de errores
            }
        }

}