
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        function contador(){
            session_start();
            if (isset($_SESSION['contador'])) {
                $_SESSION['contador'] = $_SESSION['contador'] + 1;
            }
            else {
                $_SESSION['contador'] = 1;
            }


            echo "veces visitadas la página =" .$_SESSION['contador'];
        }
        contador();
        ?>
    </body>
</html>
