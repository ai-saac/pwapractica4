<?php
header('Content-Type: text/html; charset=UTF-8');
include './data_base/conection.php';

class notasController{
private $conexion;

    public function __construct(){
         $this->conexion = new Conexion();
    }
    public function get_notas_alumno(){
         $conn = $this->conexion->obtenerConexion();

          if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $ci=$_POST['cedula'];
                

                if(empty($ci)){
                    echo json_encode('no_ci');
                    die();
                }

                $sql = "SELECT CONCAT(tb2.nombres,' ',tb2.apellidos)alumno, tb3.nombre, tb1.nota FROM ube_materia_alumno tb1";
                $sql.=" JOIN ube_alumnos tb2 ON tb2.id = tb1.id_alumno";
                $sql.=" JOIN ube_materias tb3 ON tb3.id = tb1.id_materia ";
                $sql.= "WHERE tb2.ci = ".$ci." ";

                $result = $conn->query($sql);
                
                $notas_alumno = [];
                
                if ($result->num_rows > 0) {

                    while ($row = $result->fetch_assoc()) {
                        $notas_alumno[] = $row;
                    }
                     return $notas_alumno;
                }else{
                    return false;
                }

               

            }
            
    }

}

$obj= new notasController();

    $response = $obj->get_notas_alumno();

        if(count($response)> 0){
            echo json_encode($response);
        } else {
             echo 'fail';
        }
            
?>