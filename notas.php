<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
    <title>Notas</title>
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
        <input type="number" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

    <div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <form action="notasController.php" method="POST" id="formulario">
                <div class="form-group my-3">
                    <div class="input-group bg-info">
                        <span class="input-group-text">CI del Alumno</span>
                        <input class ="form-control" name="cedula" id="cedula" type="number">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Buscar</button>
            </form>
           <div class="card mt-5 text-center" style="width: 18rem;">
                <img src="img/user.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 id="name_alumno" class="card-title">Alumno</h5>
                    <p class="card-text">Notas del alumno</p>
                </div>
            </div>
        </div>
        <div class="col-md-8 p-5">
            <table id="tbl_notas" class="table table-striped">
                <thead class="bg-secondary text-white">
                    <tr>
                    <th scope="col">Alumno</th>
                    <th scope="col">Materia</th>
                    <th scope="col">Nota</th>
                    </tr>
                </thead>
                <tbody>
                    
                    
                </tbody>
                </table>

              <button class="btn btn-secondary">Imprimir</button>

        </div>
    </div>
</div>
</body>

<script>

     document.getElementById("formulario").addEventListener('submit', function(e) {
       
    e.preventDefault(); 
        var formData = new FormData(this);
        
        fetch(this.action, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if(data == 'no_ci'){   
               alert('Debe ingresar un numero de cedula'); 
            }else if(data == false){
                 alert('No se encontraron notas registradas a este alumno'); 
            }else{
                cargarDatos(data);
            }
            
        })
        .catch(error => {
            console.error('Error al enviar formulario:', error);
        });
    });

function cargarDatos(data){
   
            const tbody = document.getElementById('tbl_notas').getElementsByTagName('tbody')[0];
            document.getElementById('name_alumno').innerText=data[0].alumno;
            const filas = data.map(al => `
                <tr>
                    <td>${al.alumno}</td>
                    <td>${al.nombre}</td>
                     <td>${al.nota}</td>
                </tr>
            `);

            tbody.innerHTML = filas.join('');
        
}

</script>
</html>

