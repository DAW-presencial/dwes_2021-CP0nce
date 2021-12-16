<?php

//si el nivel de acceso no es 'Admin' redirecciona a la página login
if (isset($_SESSION['access_level'])&& $_SESSION['access_level']=="Admin"){
    header("Location: {$home_url}admin/index.php?action=logged_in_as_admin");
}

//si $require_login es true
else if (isset($require_login) && $require_login==true){
    //si no está loggeado, redirecciona a login
    if(!isset($_SESSION['access_level'])){
        header("Location: {$home_url}login.php?action=please_login");
    }
}

//si ya está loggeado en la página login / registrar
else if(isset($page_title) && ($page_title=="Login" || $page_title=="SignUp")){
    if(isset($_SESSION['access_level']) && $_SESSION['access_level']=="Costumer"){
        header("Location: {$home_url}index.php?action=already_logged_in");
        
    }
}
else{
    //sigue igual
}


?>