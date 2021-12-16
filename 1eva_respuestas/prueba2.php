<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        class padre {
            public $nombre = "antonio";
            var $apellido = "lopez";
            public function __set($name, $valor) {
             echo "Esta clsae __SET heredada ha sido modificada en el padre.\n";
         }   
            protected function __get($name) {
             echo $this->nombre."Esta clase __GET heredada ha sido modificada en el padre";
         }
        }
        
        class hija extends padre {}
        
        $padre = new padre();
        $hija = new hija();
        $hija -> __set( $name ,"garcia");
        $hija ->__get($nombre)
   

        ?>
    </body>
</html>