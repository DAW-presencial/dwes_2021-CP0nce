<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
       

    <body>
        <?php
        // Los datos que se introduciran en la conexión.
        $host = 'g1.ifc33b.cifpfbmoll.eu';
        $db = 'cponce_db';
        $user = 'cponce';
        $pass = 'abc123.';
        $puerto = '5432';

        /**
         * Conexión con la base de datos.
         * 
         * En caso de que al probar introduciendo los datos para crear la conexión no funcione,
         * va a enviar un mensaje con el error que indica la Base de datos.         
         */
        try {
            $pdo = new PDO("pgsql:host=$host;port=$puerto; dbname=$db", $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            echo "Ocurrio un error en la BD:" . $e->getMessage();
        }

        /**
         * La comprobación de lo que se introduce en el formulario y que parte del CRUD realizara.
         */
        if (isset($_GET['submit'])) {

            $numero = $_GET['numero'];
            $nombre = trim($_GET['nombre']);

            if ($numero != "" && $nombre != "") {
                $stmt = $pdo->query('select * from agenda');
                $agenda = $stmt->fetchAll(PDO::FETCH_OBJ);

                foreach ($agenda as $contacto) {
                    if ($nombre == $contacto->nombre) {
                        $sentencia = $pdo->prepare("UPDATE agenda SET numero = ? WHERE nombre = ?;");
                        $resultado = $sentencia->execute([$numero, $nombre]);
                        if ($resultado === true) {
                            header("Location: templates/header.php");
                            echo "El contacto se ha actualizado de forma correcta";
                        } else {
                            echo "Algo salió mal, comprueba los datos introducidos.";
                        }
                    }
                }

                $sentencia = $pdo->prepare("INSERT INTO agenda(numero, nombre) VALUES (?, ?);");
                $resultado = $sentencia->execute([$numero, $nombre]);
                if ($resultado == true) {
                    echo "El contacto se ha creado de forma correcta";
                } else {
                    echo "Se ha producido un fallo, comprueba los datos introducidos";
                }

            } else {
                if ($nombre == "") {
                    echo "<b>Tienes que añadir algo en el nombre.</b>";
                } else {
                    $sentencia = $pdo->prepare("DELETE FROM agenda WHERE nombre = ?;");
                    $resultado = $sentencia->execute([$nombre]);
                    if ($resultado === true) {
                        echo"<p>Se ha eliminado el contacto.</p>";
                    } else {
                        echo "Se ha producido un fallo, comprueba los datos introducidos";
                    }
                }
            }
        }

        /**
         * Crea la lista con los datos que tiene la base de datos.
         * 
         * Para cada dato que se encuentra en la base de datos se introducira en la pagina a traves de una lista desorganizada.
         */
        function Crear_Lista() {
            global $pdo;
            echo "<ul>";
            $stmt = $pdo->query('select * from agenda');
            $agenda = $stmt->fetchAll(PDO::FETCH_OBJ);

            foreach ($agenda as $nom_num) {
                echo "<li>" . $nom_num->nombre . ":" . $nom_num->numero . "</li>";
            }

            echo '</ul>';
        }
        ?>

        <form>
            <label for="nombre">Introduce el nombre de la persona:</label>
            <input id="nombre" type="text" name="nombre" value="" /><br>
            <label for="numero">Introduce el telefono de la persona:</label>
            <input id="numero" type="number" name="numero" value="" /><br>
            <input type="submit" name="submit" value="Enviar"/>
        </form>
        <h1>Agenda</h1>
        <?php
        Crear_Lista();
        ?>
    </body>
</html>