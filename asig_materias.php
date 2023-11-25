<?php
$sql_al = "SELECT * FROM ube_alumnos";
$result2 = $conn->query($sql_al);

if ($result2->num_rows > 0) {
    $alumnos = [];
    
    while ($row = $result2->fetch_assoc()) {
        $alumnos[] = $row;
    }
} else {
    echo "No se encontraron productos.";
}

$sql_mat = "SELECT * FROM ube_materias";
$result3 = $conn->query($sql_mat);

if ($result3->num_rows > 0) {
    $materias = [];
    
    while ($row = $result3->fetch_assoc()) {
        $materias[] = $row;
    }
} else {
    echo "No se encontraron productos.";
}

$conn->close();
?>
<div id="materias" class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Asignar Notas a Materias</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         <div class="row">
          <div class="col">
            <form action="asignacionController.php" method="POST" id="formu">
             <div class="mb-3">
              <label>Seleccione un alumno    </label>
                <select class="form-select" name="alumno" id="alumno">
                  <?php foreach ($alumnos as $val) {?>    
                      <option value="<?= $val['id']?>"><?= $val['nombres']?> <?= $val['apellidos']?></option> 
                    <?php }?>   
                </select>
          
              </div>
              
              <div class="mb-3">
                <label>Seleccione una materia </label>
                  <select class="form-select" name="materia" id="materia">   
                      <?php foreach ($materias as $val) {?>    
                      <option value="<?= $val['id']?>"><?= $val['nombre']?></option> 
                      <?php }?>   
                  </select>
               
              </div>
            
            <div class="mb-3">
              <input name="nota" id="nota" type="number" class="form-control">
            </div>  
            
            <button type="submit" class="btn btn-primary">Asignar Calificacion</button>

            </form>

          </div>
         </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>