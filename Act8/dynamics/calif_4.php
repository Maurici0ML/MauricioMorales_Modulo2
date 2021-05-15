<?php
    require_once 'configDB.php';
    //Estableciendo conexión con la base de datos, y haciendo la petición del nombre de las materias de 4to.
    $conex = conectdb();
    $consulta = "SELECT Nombre FROM asignaturas WHERE Anio = 4;";
    $resp = mysqli_query($conex, $consulta);

    //Si ya recibio las calificaciones, saca el promedio.
    if(isset($_POST["prom4"]))
    {
        echo ("<h1>Suma de calificaciones:</h1>");
        
        //Varible que nos ayuda a recorrer los indices  del arreglo de "calificacion".
        $sum=0;
        while($asignatura = mysqli_fetch_array($resp, MYSQLI_ASSOC))
        {
            $nombre_junto= str_replace(" ", "", $asignatura["Nombre"]); //Varibale que guarda el nombre junto para poder acceder a su valor en la varibale POST.
            $nombre_junto= str_replace(".", "", $nombre_junto);
            $sum += $_POST[''.$nombre_junto.''];
        }

        //Consulta que nos determina el número de materias que hay en dicho año.
        $consulta = "SELECT Anio FROM asignaturas WHERE Anio = 4;";
        $resp = mysqli_query($conex, $consulta);
        $num_asig=mysqli_num_rows($resp);

        
        //Asignacion del promedio a la variable "promedio_cuarto".
        $promedio_cuarto = $sum/$num_asig;

        //Consulta para introducir el promedio de cuarto a la base de datos.
        session_start();
        $consulta = 'UPDATE alumno SET Promedio_cuarto = '.$promedio_cuarto.' WHERE Ncuenta = '.$_SESSION["ncuenta"].';';
        $resp = mysqli_query($conex, $consulta);
        
        //Si la repuesta es false...
        if(!$resp)
        {
            echo "El promedio es: ".$sum/$num_asig."<br>";
            echo 'Pero ha ocurrido un problema al ingresar los datos';
        }
        //Si las respuesta es true
        else
        {
            header("location: ./calif_5.php");
        } 
    }
    //Si no ha recibido las calificaciones, despliega el formulario para llenarlas.
    else
    {
        echo '<h1>Ingresa tus calificaciones de 4to año</h1>';
        echo '<form action="./calif_4.php" method="POST">';
        while($asignatura = mysqli_fetch_array($resp, MYSQLI_ASSOC))
        {
            $nombre_junto= str_replace(" ", "", $asignatura["Nombre"]); //Variable que guarda el nombre junto para que no halla problemas en futuros en la viable POST
            $nombre_junto= str_replace(".", "", $nombre_junto);
            echo ('<label><strong>'.$asignatura["Nombre"].'</strong><br>
                    <input type="number" name="'.$nombre_junto.'" min="6" max="10" required>
                </label>
                <br><br>');
        }

        echo '<input type="submit" name="prom4" value="continuar"></form>'; 
    }
    mysqli_close($conex);
?>
