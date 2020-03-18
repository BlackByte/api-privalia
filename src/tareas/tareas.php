<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;


// POST Crear una tarea nueva
$app->post('/api/tareas/todo', function(Request $request, Response $response){
    $id = $request->getParam('id');
    $title = $request->getParam('titulo');
    $finished = $request->getParam('completada');
    $datecreated = $request->getParam('fecha creacion');
    $datecomplete = $request->getParam('fecha completada');

    $sql = "INSERT INTO todo (id, titulo, completada, fecha creacion, fecha completada) VALUES 
          (:id, :titulo, :completada, :fecha creacion, :fecha completada)";
    try{
        $db = new db();
        $db = $db->conectDB();
        $resultado = $db->prepare($sql);

        $resultado->bindParam(':id', $id);
        $resultado->bindParam(':titulo', $title);
        $resultado->bindParam(':completada', $finished);
        $resultado->bindParam(':fecha creacion', $datecreated);
        $resultado->bindParam(':fecha completada', $datecomplete);

        $resultado->execute();
        echo json_encode("Nueva tarea creada.");

        $resultado = null;
        $db = null;
    }catch(PDOException $e){
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});


// DELETE borrar tarea
$app->delete('/api/tareas/todo', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    $sql = "DELETE FROM todo WHERE id = $id";

    try{
        $db = new db();
        $db = $db->conectDB();
        $resultado = $db->prepare($sql);
        $resultado->execute();

        if ($resultado->rowCount() > 0) {
            echo json_encode("Tarea eliminada.");
        }else {
            echo json_encode("No existe una tarea con esta ID.");
        }

        $resultado = null;
        $db = null;
    }catch(PDOException $e){
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});

// PUT Modificar una tarea
$app->put('/api/tareas/todo/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    $title = $request->getParam('titulo');
    $finished = $request->getParam('completada');
    $datecreated = $request->getParam('fecha creacion');
    $datecomplete = $request->getParam('fecha completada');
    $sql = "UPDATE todo SET
          titulo = :titulo,
          completada = :completada,
          fecha creacion = :fecha creacion,
          fecha completada = :fecha completada,
        WHERE id = $id";

    try{
        $db = new db();
        $db = $db->conectDB();
        $resultado = $db->prepare($sql);

        $resultado->bindParam(':titulo', $title);
        $resultado->bindParam(':completada', $finished);
        $resultado->bindParam(':fecha creacion', $datecreated);
        $resultado->bindParam(':fecha completada', $datecomplete);

        $resultado->execute();
        echo json_encode("Tareas modificada.");

        $resultado = null;
        $db = null;
    }catch(PDOException $e){
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});



// GET Listado de todas las tareas
$app->get('/api/tareas/todo', function(Request $request, Response $response){
    $sql = "SELECT * FROM todo";
    try{
        $db = new db();
        $db = $db->conectDB();
        $resultado = $db->query($sql);

        if ($resultado->rowCount() > 0){
            $todo = $resultado->fetchAll(PDO::FETCH_OBJ);
            echo json_encode($todo);
        }else {
            echo json_encode("No existen tareas en la BBDD.");
        }
        $resultado = null;
        $db = null;
    }catch(PDOException $e){
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});

// GET Mostrar una tarea
$app->get('/api/tareas/todo/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    $sql = "SELECT * FROM todo WHERE id = $id";
    try{
        $db = new db();
        $db = $db->conectDB();
        $resultado = $db->query($sql);

        if ($resultado->rowCount() > 0){
            $cliente = $resultado->fetchAll(PDO::FETCH_OBJ);
            echo json_encode($titulo);
        }else {
            echo json_encode("No existen tareas en la BBDD con este ID.");
        }
        $resultado = null;
        $db = null;
    }catch(PDOException $e){
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});

// GET Listado de todas las tareas
$app->get('/api/tareas/report', function(Request $request, Response $response){
    $sql = "SELECT * FROM audit.";
    try{
        $db = new db();
        $db = $db->conectDB();
        $resultado = $db->query($sql);

        if ($resultado->rowCount() > 0){
            $todo = $resultado->fetchAll(PDO::FETCH_OBJ);
            echo json_encode($todo);
        }else {
            echo json_encode("No existen tareas en la BBDD.");
        }
        $resultado = null;
        $db = null;
    }catch(PDOException $e){
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});

// GET Mostrar una tarea
$app->get('/api/tareas/report/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    $sql = "SELECT * FROM audit. WHERE id = $id";
    try{
        $db = new db();
        $db = $db->conectDB();
        $resultado = $db->query($sql);

        if ($resultado->rowCount() > 0){
            $cliente = $resultado->fetchAll(PDO::FETCH_OBJ);
            echo json_encode($titulo);
        }else {
            echo json_encode("No existen tareas en la BBDD con este ID.");
        }
        $resultado = null;
        $db = null;
    }catch(PDOException $e){
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});

