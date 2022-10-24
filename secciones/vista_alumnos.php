<?php   include("../templates/cabecera.php");   ?>
<?php   include("../secciones/alumnos.php");   ?>


<br>
<div class="row">
    <div class="col-4">
        <form action="" method="post">
            <div class="card">
                <div class="card-header">Alumnos</div>

                <div class="card-body">
                    <div class="mb-3">
                      <label for="id" class="form-label">ID</label>
                      <input type="text"
                        class="form-control" value="<?php echo $id?>" name="id" id="id" readonly="readonlys" aria-describedby="helpId" placeholder="ID">
                    </div>

                    <div class="mb-3">
                      <label for="nombre" class="form-label">Nombre del Alumno</label>
                      <input type="text"
                        class="form-control" value="<?php echo $nombre?>" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Nombre">
                    </div>

                    <div class="mb-3">
                      <label for="apellidos" class="form-label">Apellidos</label>
                      <input type="text"
                        class="form-control" value="<?php echo $apellidos?>" name="apellidos" id="apellidos" aria-describedby="helpId" placeholder="Ingrese apellidos">
                    </div>
            <!--  OPCIONES DE CURSOS  -->
                    <div class="mb-3">
                        <label for="" class="form-label">Curso del alumno</label>
                        <select multiple class="form-select form-select-lg" name="cursos[]" id="listaCursos">
                            <?php  foreach($cursos as $curso) { ?>
                            <!--  RECUPERANDO el id del curso  -->
                            <option 
                            <?php
                            // Si es diferente de empty, signif. que tienen algun curso
                                if( !empty($arregloCursos) ):
                                    // Si un array de la lista de cursos y un curso se encuentra con ese id
                                    if( in_array($curso['id'], $arregloCursos) ):
                                        // Selecciona el valor(curso)
                                        echo 'selected';
                                    endif;
                                endif;
                            ?> 
                            value="<?php echo $curso['id'];?>">
                                <?php echo $curso['id']; ?> - 
                                <?php echo $curso['nombre_curso']; ?>
                            </option>
                            <?php }  ?>
                        </select>
                    </div>
            <!--  BOTONES  -->
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
    

    <div class="col-8">
        <div class="table-responsive">
            <table class="table table-dark table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre completo</th>
                        <th>Cursos del alumno</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($alumnos as $alumno): ?>
                    <tr>
                        <td><?php echo $alumno['id'];  ?></td>
                        <td>
                            <?php echo $alumno['nombre'];  ?>
                            <?php echo $alumno['apellidos'];  ?>
                        </td>
                        <td class="font-weight-bold">
                            <?php foreach($alumno['cursos'] as $curso){  ?>
                            <!--  Añadiendo los valores del curso y del alumno, trayendo la info. con sus respectivos ID  -->
                            <a href="certificado.php?id_curso=<?php echo $curso['id'];?>&id_alumno=<?php echo $alumno['id'];?>" style="color:white; font-weight:bold; text-decoration:none;">
                                <i class="bi bi-file-earmark-pdf-fill  text-danger"></i>
                                <?php echo $curso['nombre_curso']; ?>
                            </a><br>
                            <?php   }   ?>
                        </td>
                        <!--  Obteniendo la informacion  -->
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="id" id="id" value="<?php echo $alumno['id']; ?>">
                                <input type="submit" value="Seleccionar" name="accion" class="btn btn-light">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
    </div>
</div>


<!--  añadiendo un COMPONENTE selector (Tom Select - jsdelivr) -->
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
<!-- Añadiendo el script para agregar multiples deatos de id(CURSOS)   -->
<script>
    // Añadiendo el id a seleccionr
    new TomSelect('#listaCursos');
</script>

<?php   include("../templates/pie.php");    ?>