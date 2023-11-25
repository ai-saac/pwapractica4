
<div id="alumnos" class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registro de Alumnos</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
           <div class="col-md-4">
              <form id="form" action="alumnosController.php" method="post">
                <input type="hidden" id="id_al" name="id_al">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Nombres:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre">
                    </div>
                   <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Apellidos:</label>
                        <input type="text" class="form-control" id="apellido" name="apellido">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Cedula:</label>
                        <input type="number" class="form-control" id="cedula" name="cedula">
                    </div>
                     <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Email:</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                     <div class="mb-3">
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Registrar</button>
                     </div>
                </form>
           </div>
           <div class="col-md-8">
             <table id="tbl_alumnos" class="table table-bordered " style="width:100%">
               
                    <thead class="bg-secondary">
                        <tr>
                            <td>Nombres</td>
                            <td>Apellidos</td>
                            <td>Cédula</td>
                            <td>Email</td>
                            <td>Accciones</td>
                        </td>
                    </thead>
                    <tbody>
                       
                    </tbody>
               
             </table>
           </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>