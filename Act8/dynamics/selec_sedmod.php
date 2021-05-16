<?php

    require_once 'configDB.php';

    if(isset($_POST["nombre"])) //Si ya recibio los valores del formulario, lleva a cabo el codigo.
    {
        $conex=conectdb();
        session_start();

        //Haciendo el registro de los datos del usuario en la base de datos.
        $consulta = 'INSERT INTO alumno(Ncuenta, Nombre, ApellidoP, ApellidoM, Area, id_pase) 
        VALUES ('.$_SESSION["ncuenta"].', "'.$_POST["nombre"].'", "'.$_POST["apPat"].'", "'.$_POST["apMat"].'", '.$_POST["area"].', '.$_POST["id_pase"].');';
        $resp = mysqli_query($conex, $consulta);

        //Si no se pudo añadir, imprime esto.
        if(!$resp)
        {  
            //CONDICION EN LA QUE ENTRARÍA SI POR ALGUNA RAZON NO SE PUDO HACER EL REGISTRO DEL NUMERO DE CUENTA
            echo"No se pudo registrar el numero de cuenta en la base de datos";
        }
        //Si se pudo hacer el registro exitosamente, se inicia la sesion con el numero de cuenta.
        else  
        {
            header("location: ./calif_4.php");
        }
        mysqli_close($conex);
    }
?>