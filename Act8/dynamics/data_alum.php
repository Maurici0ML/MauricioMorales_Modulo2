<?php
    require_once 'configDB.php';
    
    
    if($_POST["ncuenta"])
    {
        session_start();
        $_SESSION['ncuenta']=$_POST["ncuenta"]; //Guardando el numero de cuenta en una variable de sesion.

        $conex=conectdb(); //Concexion a la base de datos.
        
        //Peticion que busca coincidencias del numero de cuenta en la base de datos
        $consulta='SELECT Ncuenta FROM alumno WHERE Ncuenta = '.$_SESSION["ncuenta"].';';
        $resp=mysqli_query($conex, $consulta);
        $contcoinsid = mysqli_num_rows($resp);
        
        //Si encuentra coincidencias, redirige a la tabla de resultados
        if($contcoinsid > 0)
        {
            //REDIRECCIONAR A LOS RESULTADOS O ALGO ASÍ
            echo"Ya esta registrado el numero de cuenta en la base de datos";
        }
        //Si no encuentra coincidencias muestra el formulario para agrefar la información para agregar el usuario a la base de datos.
        else
        {
            echo'<form action="./regist_usuario.php" method="POST">
                    <fieldset>
                        <legend>Ingresa los siguientes datos</legend>
                        <label><strong>Nombre(s):</strong><br>
                            <input type="text" name="nombre" required>
                        </label>
                        <br><br>
                        <label><strong>Apellido paterno:</strong><br>
                            <input type="text" name="apPat" required>
                        </label>
                        <br><br>
                        <label><strong>Apellido materno:</strong><br>
                            <input type="text" name="apMat" required>
                        </label>
                        <br><br>
                        <label><strong>Área elegida</strong><br>
                            <select name="area" required>
                                <option value="1">Área I - Fisco Matemáticas y de las Ingenierías</option>
                                <option value="2">Área II - Ciencias Biológicas y de la Salud</option>
                                <option value="3">Área III - Ciencias Sociales</option>
                                <option value="4">Área IV - Humanidades y arte</option>
                            </select>
                        </label>
                        <br><br>
                        <label><strong>Carrera</strong><br>
                            <select name="carrera" required>';
                            $consulta = 'SELECT clave_carrera, Nombre FROM carrera;';
                            $resp = mysqli_query($conex, $consulta);
                            While($row = mysqli_fetch_array( $resp, MYSQLI_ASSOC))
                            {
                                echo '<option value="'.$row["clave_carrera"].'">'.$row["Nombre"].'</option>';
                            }
                                 
                            echo '</select>
                        </label>
                        <br><br>
                        <input type="submit" value="Continuar">
                    </fieldset>
                </form>';
            //echo 'SE GUARDO EL NUMERO DE CUENTA EN LA BASE DE DATOS';
            mysqli_close($conex); 
        }
    }
    else
    {
        echo "redireccionar a numero de cuenta";
    }
?>