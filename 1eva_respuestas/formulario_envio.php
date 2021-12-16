<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
        <form action="formulario_envio.php" method="post" enctype="multipart/form-data">
            <b>nombre, apellidos y fecha de nacimiento:</b> 
            <br>
            <input type="text" name="nombre" size="20" maxlength="100">
            <input type="text" name="apellidos" size="20" maxlength="100">
            <input type="date" name="nacimiento"
            <input type="hidden" name="MAX_FILE_SIZE" value="100000">
            <br>
            <br>
            <b>Enviar archivos: </b>
            <br>
            <input name="userfile1" type="file">
            <input name="userfile2" type="file">
            <br>
            <input type="submit" value="Enviar">
        </form>
        
        <?php
        
            //tomo el valor de un elemento de tipo texto del formulario
            $nombre = $_POST["nombre"];
            $apellidos = $_POST["apellidos"];
            $nacimiento = $_POST["nacimiento"];
            echo "<br><br>El usuario se llama " . $nombre . " " . $apellidos . " y nació el " . $nacimiento . "<br><br>";

            //datos del arhivo
            $nombre_archivo1 = $_FILES['userfile1']['name'];
            $tamano_archivo1 = $_FILES['userfile1']['size'];
            
            $nombre_archivo2 = $_FILES['userfile2']['name'];
            $tamano_archivo2 = $_FILES['userfile2']['size'];
            
            echo "Los documentos que ha subido son: ".$nombre_archivo1." que pesa un total de: ".$tamano_archivo1." bytes"."<br>";
            echo "y: ".$nombre_archivo2." que pesa un total de: ".$tamano_archivo2." bytes";
            
            if (move_uploaded_file($_FILES['userfile1']['tmp_name'],  $nombre_archivo1)&& move_uploaded_file($_FILES['userfile2']['tmp_name'],  $nombre_archivo2)) {
                echo "<br><br>El archivo ha sido cargado correctamente.";
            }else{
                echo "<br><br>Ocurrió algún error al subir el fichero. No pudo guardarse.";
            }


        ?>
    </body>
</html>
