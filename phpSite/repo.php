
<?php
    function all($pdo) {
        $stmt = $pdo->query('SELECT * FROM alumnos');
        $alumnos = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $alumnos[] = [
                'legajo' => $row['legajo'],
                'nombre' => $row['nombre'],
                'apellido' => $row['apellido']
            ];
        }
        return $alumnos;
    }
