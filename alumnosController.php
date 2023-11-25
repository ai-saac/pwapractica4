<?php
header('Content-Type: text/html; charset=UTF-8');
include './data_base/conection.php';

class alumnosController{

 private $conexion;

    public function __construct() {
        $this->conexion = new Conexion();
    }

    public function index(){
        echo 'index';
    }
        function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
      public function  registrar() {

        $conn = $this->conexion->obtenerConexion();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombres = $_POST['nombre'];
            $apellidos = $_POST['apellido'];
            $email = $_POST['email'];
            $cedula = $_POST['cedula'];
            $id_al = $_POST['id_al'];
           
            if (empty($nombres)) {
                echo "Por favor, ingresa tu nombre.";
                die();
            }

            if (empty($apellidos)) {              
              echo "Por favor, ingresa tu apellido.";
              die();
            }

            if (empty($email)) {
                echo "Por favor, ingresa tu correo electrónico.";
                die();
            } else {
                $email = $this->test_input($email);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                  
                   echo "Formato de correo electronico no válido.";
                   die();
                }
            }
            if(empty($cedula)) {
                echo 'Ingrese la cedula';
                die();
            }

            if(empty($id_al)) {
                $sql = "INSERT INTO ube_alumnos (nombres ,apellidos, email, ci) VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssss",  $nombres, $apellidos, $email, $cedula);

                if ($stmt->execute()) {
                    return "ok";
                } else {
                    return "fail";
                }

            }else{

                $sql=" UPDATE ube_alumnos SET nombres = '".$nombres."', apellidos = '".$apellidos."', email = '".$email."', ci = '".$cedula."'  WHERE  id=".$id_al."  ";
                if($conn->query($sql)==true) {
                    return "ok_edit";
                }else{
                     return "fail";
                }

            }

          

            
          
                       

        }
    }

    public function delete_alumno($id){
       
        $conn = $this->conexion->obtenerConexion();

        $sql = "DELETE FROM ube_alumnos  WHERE id = ".$id." ";
        
        if ($conn->query($sql) === TRUE) {
            return "ok";
        } else {
            return "fail";
        }

    }

    public function load_alumno($id){
       $conn = $this->conexion->obtenerConexion();

       $sql = "SELECT * FROM ube_alumnos WHERE id = ".$id." ";
       
       $result = $conn->query($sql);
     
        if ($result->num_rows > 0) {
            $alumnos = [];
            
            while ($row = $result->fetch_assoc()) {
                $alumnos[] = $row;
            }  

        } else {
            echo "No se encontro el alumno.";
        }
        return $alumnos;
    }

    public function get_alumnos(){
        $conn = $this->conexion->obtenerConexion();

       $sql = "SELECT * FROM ube_alumnos ";
       $result = $conn->query($sql);
     
        if ($result->num_rows > 0) {
            $alumnos = [];
            
            while ($row = $result->fetch_assoc()) {
                $alumnos[] = $row;
            }  

        } else {
            echo "No se encontraron alumnos.";
        }
        return $alumnos;
    }
}
$obj =new alumnosController();

    if (isset($_GET['action']) && $_GET['action'] == 'delete_alumno') {
        $id=$_GET['id'];
        $response = $obj->delete_alumno($id);
        if($response =="ok") {
            echo"success";
        } else {
            echo "fail";
        }
        
    }else if(isset($_GET['action']) && $_GET['action'] == 'load_alumno'){

        $id=$_GET['id'];
        $response = $obj->load_alumno($id);
        
        if(count($response)>0) {
            echo json_encode($response);
        } else {
            echo "fail";
        }
      
    }else if(isset($_GET['action']) && $_GET['action'] == 'get_alumnos'){
       
       
        $response = $obj->get_alumnos();
        
        if(count($response)>0) {
            echo json_encode($response);
        } else {
            echo "fail";
        }

    }  else{
          $response = $obj->registrar();
        if($response =="ok") {
            echo"success";
        } else if($response == "ok_edit") {
            echo "suc_edit";
        }else{
             echo "fail";
        }
    }


   

?>