<?php
include './data_base/conection2.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de  Calificaciones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark  bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">CALIFICACIONES</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
         <li class="nav-item">
          <a class="nav-link" href="#">Contactos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Servicios</a>
        </li>
      
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

<div class="container pt-5">
    <div class="row">
        <div class="col-md-3 text-center">
           <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Registrar Alumnos</h5>
                    <p class="card-text">Se registra todos los alumnos de la institución.</p>
                    <button onclick="get_alumnos()" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#alumnos">Continuar</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 text-center">
           <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Asignar Notas a Materias</h5>
                    <p class="card-text">Se asignan materias a alumnos.</p>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#materias">Continuar</button>
                </div>
            </div>
        </div>

         <div class="col-md-3 text-center">
           <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Ver Notas</h5>
                    <p class="card-text">Ver las notas de cada alumno buscandolo por numero de cedula.</p>
                    <a href="notas.php" target="_blank" class="btn btn-primary">Continuar</a>
                </div>
            </div>
        </div>

        

    </div>

<?php
include("reg_alumnos.php");
include("asig_materias.php");
?>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script>


document.getElementById("form").addEventListener('submit', function(e) {
       
    e.preventDefault(); 
        var formData = new FormData(this);
        
        fetch(this.action, {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            if(data.trim()== 'success'){
                document.getElementById('nombre').value='';
                document.getElementById('apellido').value='';
                document.getElementById('email').value='';
                document.getElementById('cedula').value='';
                document.getElementById('id_al').value='';
            alert('Alumno registrado');
            }else if(data.trim() == 'suc_edit'){
                document.getElementById('nombre').value='';
                document.getElementById('apellido').value='';
                document.getElementById('email').value='';
                document.getElementById('cedula').value='';
                 document.getElementById('id_al').value='';
                alert('Alumno actualizado exitosamente');
            }else{
               alert(data); 

            }
            
        })
        .catch(error => {
            console.error('Error al enviar formulario:', error);
        });
    });

 function delete_alumno(id){

    var confirmacion = window.confirm("¿Estás seguro de que deseas eliminar al alumno?");

    if(confirmacion){
         const url="alumnosController.php?action=delete_alumno&id=" + id;

     fetch(url, {
            method: 'GET',
        })
    .then(response => response.text())
        .then(data => {
            if(data.trim()== 'success'){
           
            alert('Alumno eliminado exitosamente');
            }else{
               alert(data); 
            }
            
        })
    }
   
    
}

function load_alumno(id){
   
     const url="alumnosController.php?action=load_alumno&id=" + id;

     fetch(url, {
            method: 'GET',
            headers: {
            'Content-Type': 'application/json'
        }
        })
    .then(response => response.json())
        .then(data => {
            if(data){


           document.getElementById('nombre').value=data[0].nombres;
            document.getElementById('apellido').value=data[0].apellidos;
            document.getElementById('cedula').value=data[0].ci;
             document.getElementById('email').value=data[0].email;
             document.getElementById('id_al').value=data[0].id;

            }else{
               alert('No se han encontrado registros'); 
            }
            
        })
}

function get_alumnos(){
     const url="alumnosController.php?action=get_alumnos&id=";

     fetch(url, {
            method: 'GET',
            headers: {
            'Content-Type': 'application/json'
        }
        })
    .then(response => response.json())
        .then(data => {
            if(data){

            const tbody = document.getElementById('tbl_alumnos').getElementsByTagName('tbody')[0];
            const filas = data.map(al => `
                <tr>
                    <td>${al.nombres}</td>
                    <td>${al.apellidos}</td>
                     <td>${al.ci}</td>
                      <td>${al.email}</td>
                        <td>
                        <button onclick="load_alumno(${al.id})" class="btn btn-warning">Edit</button>
                        <button onclick="delete_alumno(${al.id})" class="btn btn-danger">Delete</button>
                        </td>
                </tr>
            `);

            tbody.innerHTML = filas.join('');

            }else{
               alert('No se han encontrado registros'); 
            }
            
        })
}

document.getElementById("formu").addEventListener('submit', function(e) {
       
    e.preventDefault(); 
        var formData = new FormData(this);
        
        fetch(this.action, {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            if(data.trim()== 'success'){   
                 alert('Nota asignada exitosamente');
                 document.getElementById('nota').value="";
            }else{
               alert(data); 

            }
            
        })
        .catch(error => {
            console.error('Error al enviar formulario:', error);
        });
    });

   
</script>


</body>
</html>