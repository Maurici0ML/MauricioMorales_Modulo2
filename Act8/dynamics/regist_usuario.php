<?php
    require_once 'configDB.php';

    if(isset($_POST["nombre"])) //LLeva a cabo el código solo si viene del formulario.
    {
        session_start(); //INICIO DE SESION.

        //Consulta para saber si tiene mas de una sede o mas de una modalidad.
        $conex=conectdb();

        $consulta = 'SELECT clave_carrera FROM pase_regla WHERE clave_carrera = '.$_POST["carrera"].';';
        $resp = mysqli_query($conex, $consulta);
        $sedmod = mysqli_num_rows($resp);
        
        //Condicion que determina si hay mas de una localidad o sede.
        if($sedmod > 1)
        {
            echo '<h2>Su carrera solicitada tiene más de una modalidad o sede</h2>';
            echo'<h3>Elija la opcion de carrera que usted quiere</h3>';

            //Consulta que nos devueleve la carrera con sus distintass modalidades y ubicaciones.
            $consulta = 'SELECT id_pase, Nombre, Ubicacion, Modalidad FROM pase_regla 
            INNER JOIN carrera ON pase_regla.clave_carrera=carrera.clave_carrera
            INNER JOIN ubicacion ON pase_regla.id_ubicacion=ubicacion.id_ubicacion
            INNER JOIN modalidad ON pase_regla.id_modalidad=modalidad.id_modalidad
            WHERE carrera.clave_carrera = '.$_POST["carrera"].';';
            $resp = mysqli_query($conex, $consulta);

            //Forulario que nos permite elegir la carrera con la sede y modalidad que queremos.
            echo '<form action="./selec_sedmod.php" method="POST">';
            echo '<table>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Modalidad</th>
                            <th>Ubicación</th>
                            <th>Elegir</th>
                        </tr>
                    </thead>
                    <tbody>';

            //While que despliega las distintas opciones que tiene la carrera        
            while($row= mysqli_fetch_array($resp, MYSQLI_ASSOC))
            {
                echo '<tr>
                        <td align="center">'.$row["Nombre"].'</td>
                        <td align="center">'.$row["Modalidad"].'</td>
                        <td align="center">'.$row["Ubicacion"].'</td>
                        <td align="center"><input type="radio" name="id_pase" value="'.$row["id_pase"].'"></td>
                    </tr>';
            } 
            echo    '</tbody>
                </table>';
            echo '<input type="hidden" name="nombre" value="'.$_POST["nombre"].'"">
                    <input type="hidden" name="apPat" value="'.$_POST["apPat"].'"">
                    <input type="hidden" name="apMat" value="'.$_POST["apMat"].'"">
                    <input type="hidden" name="area" value="'.$_POST["area"].'"">
                <br><input type="submit" value="continuar">
            </form>';
             
        }
        //Si solo hay una modalidad o sede...
        else
        {
            //Obteniendo el id_pase de la carrera.
            $consulta = 'SELECT id_pase FROM pase_regla WHERE clave_carrera = '.$_POST["carrera"].';';
            $resp = mysqli_query($conex, $consulta);
            $id_pase = mysqli_fetch_array($resp, MYSQLI_ASSOC);

            //Haciendo el registro de los datos del usuario en la base de datos.
            $consulta1 = 'INSERT INTO alumno(Ncuenta, Nombre, ApellidoP, ApellidoM, Area, id_pase) 
            VALUES ('.$_SESSION["ncuenta"].', "'.$_POST["nombre"].'", "'.$_POST["apPat"].'", "'.$_POST["apMat"].'", '.$_POST["area"].', '.$id_pase["id_pase"].');';
            $resp1 = mysqli_query($conex, $consulta1);

            //Si no se pudo añadir, imprime esto.
            if(!$resp1)
            {  
                //CONDICION EN LA QUE ENTRARÍA SI POR ALGUNA RAZON NO SE PUDO HACER EL REGISTRO DEL NUMERO DE CUENTA
                echo"No se pudo registrar el numero de cuenta en la base de datos";
            }
            //Si se pudo hacer el registro exitosamente, se inicia la sesion con el numero de cuenta.
            else  
            {
                header("location: ./calif_4.php");
            }
        } 
        mysqli_close($conex);  
    }

?>