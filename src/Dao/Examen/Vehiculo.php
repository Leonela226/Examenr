<?php
namespace Dao\Examen;
use Dao\Table;

class Vehiculo extends Table{

    public static function obtenerVehiculo(){
        $sqlstr = "SELECT * FROM VehiculosF ;";
        return self::obtenerRegistros($sqlstr, []);
    }

    public static function obtenerVehiculoPorId($id){
        $params = [
            "id" => $id
        ];
        $sqlstr = "SELECT * FROM VehiculosF WHERE id_vehiculo=:id;";
        return self::obtenerUnRegistro($sqlstr,$params);
    }

    public static function crearVehiculo($marca, $modelo, $anio,$kilometraje,$id_estado,$asignado){
        $params = [
            "marca" => $marca,
            "modelo" => $modelo,
            "anio"=>$anio,
            "kilometraje"=>$kilometraje,
            "id_estado"=>$id_estado,
            "asignado"=>$asignado
        ];
        $sqlsrt = "insert into VehiculosF (marca, modelo, anio,kilometraje,id_estado, asignado) VALUES(:marca, :modelo, :anio, :kilometraje,:id_estado, :asignado);";
        return self::executeNonQuery($sqlsrt, $params);
    }

    public static function actualizarVehiculo($id,$marca, $modelo, $anio, $kilometraje,$id_estado,$asignado){
        $params = [
            "marca" => $marca,
            "modelo" => $modelo,
            "anio"=>$anio,
            "kilometraje"=>$kilometraje,
            "id_estado"=>$id_estado,
            "asignado"=>$asignado,
            "id" => $id
        ];
        $sqlsrt = "UPDATE VehiculosF SET marca=:marca, modelo=:modelo, anio=:anio,kilometraje=:kilometraje,id_estado=:id_estado,asignado=:asignado  WHERE id_vehiculo=:id;";
        return self::executeNonQuery($sqlsrt, $params);
    }

    public static function deleteVehiculo($id){
        $params = [
            "id" => $id
        ];
        $sqlsrt = "DELETE FROM VehiculosF WHERE id_vehiculo=:id;";
        return self::executeNonQuery($sqlsrt, $params);
    }

}