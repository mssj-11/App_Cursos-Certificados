<?php   include("../templates/cabecera.php");   ?>
<?php   include("../secciones/cursos.php");   ?>


<div class="row">
<div class="col-12">
<br>
<div class="row">



    <div class="col-md-4">
    <!--  Formulario  -->
        <form action="" method="post">
        <div class="card">
            <div class="card-header">Cursos</div>

            <div class="card-body">
                <div class="mb-3">
                <label for="id" class="form-label">ID:</label>
                <input type="text"
                    class="form-control" name="id" value="<?php echo $id; ?>" id="id" readonly="readonlys" aria-describedby="helpId" placeholder="Ingrese id">
                </div>

                <div class="mb-3">
                <label for="nombre_curso" class="form-label">Nombre:</label>
                <input type="text"
                    class="form-control" name="nombre_curso" value="<?php echo $nombre_curso; ?>" id="nombre_curso" aria-describedby="helpId" placeholder="Nombre del curso">
                </div>
                <!--  Botones  -->
                <div class="btn-group" role="group" aria-label="Button group name">
                    <!--  Agregando la accion a los botones  -->
                    <button type="submit" name="accion" value="agregar" class="btn btn-success">Agregar</button>
                    <button type="submit" name="accion" value="editar" class="btn btn-primary">Editar</button>
                    <button type="submit" name="accion" value="borrar" class="btn btn-danger">Borrar</button>
                </div>
            </div>

        </div>
        </form>
    </div>

    
    <!--  Tabla  -->
    <div class="col-md-8">


        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr class="table-dark">
                        <th>ID</th>
                        <th>Nombre del curso</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody>
                <!---   Recuperando la $listaCursos y convirtiendolo a $curso para poder MOSTRAR los DATOS   --->
                <?php  foreach($listaCursos as $curso){   ?>
                    <tr>
                        <td>  <?php echo $curso['id']; ?>  </td>
                        <td>  <?php echo $curso['nombre_curso']; ?>  </td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="id" id="id" value="<?php echo $curso['id']; ?>">
                                <input type="submit" value="Seleccionar" name="accion" class="btn btn-dark">
                            </form>
                        </td>
                    </tr>
                <?php   }   ?>
                </tbody>
            </table>
        </div>


    </div>




</div>
</div>
</div>

<?php   include("../templates/pie.php");    ?>