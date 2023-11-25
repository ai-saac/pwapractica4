<?php
header('Content-Type: text/html; charset=UTF-8');
include './data_base/conection.php';

class asignacionController{
private $conexion;

    public function __construct(){
         $this->conexion = new Conexion();
    }
    public function asignar(){
         $conn = $this->conexion->obtenerConexion();

          if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $alumno=$_POST['alumno'];
                $materia=$_POST['materia'];
                $nota=$_POST['nota'];

                if(empty($alumno)||empty($materia) ||empty($nota)){
                    echo 'El campo materia, alumno y nota no pueden estar vacios';
                    die();
                }

                $sql="INSERT INTO ube_materia_alumno (id_alumno, id_materia, nota) VALUES (?,?,?) ";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("sss",  $alumno, $materia, $nota);

                    if ($stmt->execute()) {
                        return "ok";
                    } else {
                        return "fail";
                    }
            }
    }

}

$obj= new AsignacionController();

    $response = $obj->asignar();
        if($response =="ok") {
            echo"success";
        } else {
             echo"fail";
        }
            
?>