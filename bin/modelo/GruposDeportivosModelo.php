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
    
}