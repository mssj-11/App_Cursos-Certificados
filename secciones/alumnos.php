<?php
// Agregando la conexion a la DB
include_once ("../configuraciones/conexion.php");

// Creacion de la variable que servira para llamar a la clase DB y al metodo crearInstancia()
$conexionDB=DB::crearInstancia();


// Si `id` contiene info. se mostrara, de lo contrario se agregara un valor NULO
$id = isset($_POST['id']) ? $_POST['id']:'';
// Lo mismo para `los demas campos`
$nombre = isset($_POST['nombre']) ? $_POST['nombre']:'';
$apellidos = isset($_POST['apellidos']) ? $_POST['apellidos']:'';
// Cursos relacionados
$cursos = isset($_POST['cursos']) ? $_POST['cursos']:'';
// Validando la accion
$accion = isset($_POST['accion']) ? $_POST['accion']:'';
// Si existe una accion y es diferente a vacio
if($accion!=''){
    // Casos-Situaciones
    switch($accion){
        case 'agregar':
            $sql = "INSERT INTO alumnos (id, nombre, apellidos) VALUES (NULL, :nombre, :apellidos)";
            $consulta = $conexionDB->prepare($sql);   // Preparando la consulta
            // Se pasan los parametros
            $consulta->bindParam(':nombre', $nombre);
            $consulta->bindParam(':apellidos', $apellidos);
            $consulta->execute();   // Se ejecuta la consulta
            // Haciendo relaciones de tablas - imprimir el id una vez insertado el registro
            $idAlumno = $conexionDB->lastInsertId();

            // RELACIONANDO ALUMON - CURSOS     (recuperando ->       $idAlumno)

            // Insertando los cursos
            foreach($cursos as $curso){
                $sql = "INSERT INTO alumnos_cursos (id, id_alumno, id_curso) VALUES (NULL, :id_alumno, :id_curso)";
                $consulta = $conexionDB->prepare($sql);
                $consulta->bindParam(':id_alumno', $idAlumno);
                $consulta->bindParam(':id_curso', $curso);
                $consulta->execute();
            }
        break;
        
        case 'editar':
            $sql = "UPDATE alumnos SET nombre=:nombre, apellidos=:apellidos WHERE id=:id";
            $consulta = $conexionDB->prepare($sql);
            $consulta->bindParam(':id', $id);
            $consulta->bindParam(':nombre', $nombre);
            $consulta->bindParam(':apellidos', $apellidos);
            $consulta->execute();

            // Actualizando los cursos
            // Si hay cursos
            if( isset($cursos) ){
                $sql = "DELETE FROM alumnos_cursos WHERE id_alumno=:id_alumno";
                $consulta = $conexionDB->prepare($sql);
                $consulta->bindParam(':id_alumno', $id);    // Relacion
                $consulta->execute();

                // Leyendo los datos relacionados
                foreach($cursos as $curso){
                    // Actualizando los cursos relacionados
                    $sql = "INSERT INTO alumnos_cursos (id, id_alumno, id_curso) VALUES (NULL, :id_alumno, :id_curso)";
                    $consulta = $conexionDB->prepare($sql);
                    // Relacion de las tablas
                    $consulta->bindParam(':id_alumno', $id);
                    $consulta->bindParam(':id_curso', $curso);
                    $consulta->execute();
                }
                // Igualando el arreglo de los cursos a cursos
                $arregloCursos = $cursos;
            }
        break;

        case 'borrar':
            $sql = "DELETE FROM alumnos WHERE id=:id";
            $consulta = $conexionDB->prepare($sql);
            $consulta->bindParam(':id', $id);
            $consulta->execute();
        break;

        // Recuperando los datos seleccionados (ID del ALUMNO) 
        case 'Seleccionar':
            $sql = "SELECT * FROM alumnos WHERE id=:id";
            $consulta = $conexionDB->prepare($sql);
            $consulta->bindParam(':id', $id);
            $consulta->execute();

            $alumno = $consulta->fetch(PDO::FETCH_ASSOC);
            // Recuperando nombre y apellidos del alumno , id se recupero anteriormente
            $nombre = $alumno['nombre'];
            $apellidos = $alumno['apellidos'];

            // Recuperando datos relacionados (alumnos - cursos)
            $sql = "SELECT cursos.id FROM alumnos_cursos 
            INNER JOIN cursos ON cursos.id=alumnos_cursos.id_curso 
            WHERE alumnos_cursos.id_alumno=:id_alumno";
            $consulta = $conexionDB->prepare($sql);
            $consulta->bindParam(':id_alumno', $id);
            $consulta->execute();
            // Recuperando los datos de los cursos
            $cursosAlumno = $consulta->fetchAll(PDO::FETCH_ASSOC);

            // Consultando y Mostrando la informacion
            foreach($cursosAlumno as $curso){
                // Agregando los cursos a un Arreglo
                $arregloCursos[] = $curso['id'];
            }

        break;
    }
}


// Seleccionanos todo el contenido de la tabla alumnos
$sql = "SELECT * FROM alumnos";
// Guardamos la informacion consultada en listaAlumnos
$listaAlumnos = $conexionDB->query($sql);
// Se guardara todo lo de la listaAlumnos en alumnos
$alumnos = $listaAlumnos->fetchAll();


// Leyendo todos los datos del alumno
foreach($alumnos as $clave => $alumno){
    $sql = "SELECT * FROM cursos WHERE id IN (SELECT id_curso FROM alumnos_cursos WHERE id_alumno=:id_alumno)";
    $consulta=$conexionDB->prepare($sql);
    $consulta->bindParam(':id_alumno', $alumno['id']);  // Recuperando el id
    $consulta->execute();
    $cursosAlumno=$consulta->fetchAll();
    $alumnos[$clave]['cursos']=$cursosAlumno;    // Recuperando cursos
}


// Mostrando el listado de cursos
$sql = "SELECT * FROM cursos";  // Seleccionando todos los cursos en la tabla cursos
$listaCursos = $conexionDB->query($sql);
$cursos = $listaCursos->fetchAll(); // Recuperando TODO en la lista de los cursos




?>