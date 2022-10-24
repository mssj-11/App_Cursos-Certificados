<?php

// Agregando la conexion a la DB
include_once ("../configuraciones/conexion.php");

// Creacion de la variable que servira para llamar a la clase DB y al metodo crearInstancia()
$conexionDB=DB::crearInstancia();


/* Instrucciones */
// Si `id` contiene info. se mostrara, de lo contrario se agregara un valor NULO
$id = isset($_POST['id']) ? $_POST['id']:'';
// Lo mismo para `nombre_curso`
$nombre_curso = isset($_POST['nombre_curso']) ? $_POST['nombre_curso']:'';
$accion = isset($_POST['accion']) ? $_POST['accion']:'';
// Recibiendo la accion
// Si hay algo en accion, si es diferente de vacio significa que hay una accion
if($accion!=''){
    // comparando la misma variable($accion) 
    switch($accion){
// Con muchos valores diferentes, y ejecutar una parte de código distinto dependiendo de a que valor es igual la accion.
        case 'agregar':
            $sql = "INSERT INTO cursos (id, nombre_curso) VALUES (NULL, :nombre_curso)";  // Consulta
            //$conexionDB->ejecutarConsulta($sql);
            $consulta=$conexionDB->prepare($sql);   // Preparando la consulta
            $consulta->bindParam(':nombre_curso', $nombre_curso); // Se le pasa el parametro
            $consulta->execute();   // Se ejecuta la consulta
        break;

        case 'editar':
            $sql = "UPDATE cursos SET nombre_curso=:nombre_curso WHERE id=:id";   // O---->  id=$id
            $consulta=$conexionDB->prepare($sql);   // Preparando la consulta
            $consulta->bindParam(':id', $id); // Se le pasa el parametro
            $consulta->bindParam(':nombre_curso', $nombre_curso); // Se le pasa el parametro
            $consulta->execute();   // Se ejecuta la consulta
        break;

        case 'borrar':
            $sql = "DELETE FROM cursos WHERE id=:id";   // O---->  id=$id
            $consulta=$conexionDB->prepare($sql);   // Preparando la consulta
            $consulta->bindParam(':id', $id); // Se le pasa un parametro
            $consulta->execute();   // Se ejecuta la consulta
        break;

        case 'Seleccionar':
            $sql = "SELECT * FROM cursos WHERE id=:id"; // Seleccionar todo cuando id=id
            $consulta=$conexionDB->prepare($sql);   // Preparando la consulta
            $consulta->bindParam(':id', $id); // Se le pasa un parametro
            $consulta->execute();   // Se ejecuta la consulta
            // Obteniendo la informacion
            $curso=$consulta->fetch(PDO::FETCH_ASSOC);
            // Obteniendo el nombre del curso y almacenandolo en la variable $nombre_curso
            $nombre_curso = $curso['nombre_curso'];
        break;
    }
}


// Consulta TODA la informacion de la TABLA cursos
$consulta = $conexionDB->prepare("SELECT * FROM cursos");
$consulta->execute();   // Ejecutando la Consulta
$listaCursos = $consulta->fetchAll();   // Devolvera todos los datos y se almacenara en $listaCursos


?>