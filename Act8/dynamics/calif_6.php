<?php
    require_once 'configDB.php';
    //Estableciendo conexión con la base de datos.
    $conex = conectdb();

    session_start();
    //Consulta para obtener el área introducida por al alumno.
    $consulta = 'SELECT Area FROM alumno WHERE Ncuenta = '.$_SESSION["ncuenta"].';';
    $resp = mysqli_query($conex, $consulta);
    $area = mysqli_fetch_array($resp, MYSQLI_ASSOC);

    //Haciendo la petición para obtener el nombre de las materias de 6to NO OPTATIVAS.
    $consulta = 'SELECT Nombre FROM asignaturas WHERE Anio = 6 AND Area IN('.$area["Area"].', 0) AND Optativa = "N";';
    $resp = mysqli_query($conex, $consulta);

    //Si ya recibio las calificaciones, saca el promedio.
    if(isset($_POST["prom6"]))
    {
        echo ("<h1>Suma de calificaciones:</h1>");
        
        //Varible que nos ayuda a recorrer los indices  del arreglo de "calificacion".
        $sum=0;
        while($asignatura_noOpt = mysqli_fetch_array($resp, MYSQLI_ASSOC))
        {
            $nombre_junto= str_replace(" ", "", $asignatura_noOpt["Nombre"]); //Varibale que guarda el nombre junto para poder acceder a su valor en la varibale POST.
            $nombre_junto= str_replace(".", "", $nombre_junto);
            $sum += $_POST[''.$nombre_junto.''];
        }

        //Sumando la calificacion de la materia optativa
        $sum += $_POST["optativa"];

        //Consulta que nos determina el número de materias que hay en dicho año.
        $consulta = 'SELECT Anio FROM asignaturas WHERE Anio = 6 AND Area IN('.$area["Area"].', 0) AND Optativa = "N";';
        $resp = mysqli_query($conex, $consulta);
        $num_asig = mysqli_num_rows($resp);
        $num_asig ++;
        
        //Asignacion del promedio a la variable "promedio_sexto".
        $promedio_sexto = $sum/$num_asig;

        //Consulta para introducir el promedio de sexto a la base de datos.
        $consulta = 'UPDATE alumno SET Promedio_sexto = '.$promedio_sexto.' WHERE Ncuenta = '.$_SESSION["ncuenta"].';';
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
            header("location: ./resultados.php");
        } 
    }
    //Si no ha recibido las calificaciones, despliega el formulario para llenarlas.
    else
    {
        echo '<h1>Ingresa tus calificaciones de 6to año</h1>';
        echo '<form action="./calif_6.php" method="POST">';
        while($asignatura_noOpt = mysqli_fetch_array($resp, MYSQLI_ASSOC))
        {
            $nombre_junto= str_replace(" ", "", $asignatura_noOpt["Nombre"]); //Variable que guarda el nombre junto para que no halla problemas en futuros en la viable POST
            $nombre_junto= str_replace(".", "", $nombre_junto);
            echo ('<label><strong>'.$asignatura_noOpt["Nombre"].'</strong><br>
                    <input type="number" name="'.$nombre_junto.'"  min="6" max="10" required>
                </label>
                <br><br>');
        }

        echo '<label><strong>Optativa</strong><br>
                <select name="optativa" required>';
                //consulta para saber las materias NO OPTATIVAS
                $consulta = 'SELECT Clave, Nombre FROM asignaturas WHERE Anio = 6 AND Area = '.$area["Area"].' AND Optativa = "S";';
                $resp = mysqli_query($conex, $consulta);
                While($asignatura_Opt = mysqli_fetch_array( $resp, MYSQLI_ASSOC))
                {
                    echo '<option value="'.$asignatura_Opt["Clave"].'">'.$asignatura_Opt["Nombre"].'</option>';
                }
            echo '</select><br>';
            echo '<input type="number" name="optativa"  min="6" max="10" required>
            <label><br><br>';
        echo '<input type="submit" name="prom6" value="continuar"></form>'; 
    }
    mysqli_close($conex);
?>
