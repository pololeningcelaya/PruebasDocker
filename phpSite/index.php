<?php

require './connection.php';
require './repo.php';

try {
    $pdo = Connection::get()->connect();
} catch (\PDOException $e) {
    echo $e->getMessage();
}

if(isset($_POST['submitButton'])){
    // prepare statement for insert
    $sql = 'INSERT INTO alumnos(nombre,apellido) VALUES(:nombre,:apellido)';
    $stmt = $pdo->prepare($sql);
    
    // pass values to the statement
    $stmt->bindValue(':nombre', htmlspecialchars($_POST['nombre']));
    $stmt->bindValue(':apellido', htmlspecialchars($_POST['apellido']));
    
    // execute the insert statement
    $stmt->execute();
}
$alumnos = all($pdo);

?>

<!DOCTYPE html>
    <head>
    <title>TPDOCKER</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
    <body>
        <h2>Ingrese la información del alumno</h2>
        <ul>
            <form name="insert" action="" method="POST" >
                <ul style="list-style: none;">          
                    <li>Nombre:</li> <li><input type="text" name="nombre" /></li>
                    <li>Apellido:</li> <li><input type="text" name="apellido" /></li>
                    <li><input type="submit" name="submitButton"/></li>
                </ul>
            </form>
        </ul>
        <div class="container">
            <h1>Lista de Alumnos</h1>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Legajo</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($alumnos as $alumno) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($alumno['legajo']) ?></td>
                            <td><?php echo htmlspecialchars($alumno['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($alumno['apellido']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </body>
</html>