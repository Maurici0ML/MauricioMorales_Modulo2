<?php
    require_once 'configDB.php';
    session_start();
    $conex = conectdb();
    
    //Condicion que determina si se quiere cerrar la sesion o se quiere eliminar el registro.
    if(isset($_POST["borrar"]))
    {
        //Consulta para borrar el registro de la base de datos.
        $consulta='DELETE FROM alumno WHERE Ncuenta = '.$_SESSION["ncuenta"].'';
        $resp=mysqli_query($conex, $consulta);
        
        //Si hubo un error...
        if(!$resp)
        {
            echo "No se pudo eliminar el registro";
        }
        //Si todo salio bien, cierra la sesion y redirige a num_cuenta.
        else
        {
            session_unset();
            session_destroy();
            header("location: ../templates/num_cuenta.html");
        }
    }
    //Solo cierra la sesion sin borrar el registro.
    elseif(isset($_POST["cerrar_sesion"]))
    {
        session_unset();
        session_destroy();
        header("location: ../templates/num_cuenta.html");
    }

?>