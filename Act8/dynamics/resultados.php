<?php
    require_once 'configDB.php';
    session_start();

    //Estableciendo conexión con la base de datos.
    $conex = conectdb();

    //Consulta para obtener todos los datos del alumno.
    $consulta = 'SELECT  Ncuenta, Nombre, ApellidoP, ApellidoM, Promedio_cuarto, Promedio_quinto, Promedio_sexto, promedio, Area, Modalidad, Ubicacion
    FROM alumno INNER JOIN pase_regla ON alumno.id_pase=pase_regla.id_pase 
    INNER JOIN modalidad ON pase_regla.id_modalidad=modalidad.id_modalidad
    INNER JOIN ubicacion ON pase_regla.id_ubicacion=ubicacion.id_ubicacion
    WHERE Ncuenta = '.$_SESSION["ncuenta"].';';
    $resp = mysqli_query($conex, $consulta);
    $datos = mysqli_fetch_array($resp, MYSQLI_ASSOC);
    $promedioF = $datos["Promedio_cuarto"] + $datos["Promedio_quinto"] + $datos["Promedio_sexto"];
    $promedioF/=3;

    //Tabla para desplegar los datos personales del alumno.
    echo '<h1>Esta es su hoja de resultados en base a los datos proporcionados</h1>';
    echo '<strong>Datos personales del alumno</strong><br><br>';

    echo '<table border="1">
            <thead>
                <tr>
                    <th>N. de cuenta</th>
                    <th>Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Promedio cuarto</th>
                    <th>Promedio quinto</th>
                    <th>Promedio sexto</th>
                    <th>Promedio final</th>
                    <th>Area</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td align="center">'.$datos["Ncuenta"].'</td>
                    <td align="center">'.$datos["Nombre"].'</td>
                    <td align="center">'.$datos["ApellidoP"].'</td>
                    <td align="center">'.$datos["ApellidoM"].'</td>
                    <td align="center">'.$datos["Promedio_cuarto"].'</td>
                    <td align="center">'.$datos["Promedio_quinto"].'</td>
                    <td align="center">'.$datos["Promedio_sexto"].'</td>
                    <td align="center">'.$promedioF.'</td>
                    <td align="center">'.$datos["Area"].'</td>
                </tr>
            </tbody>
        </table>';
    
    //Consulta para obtener el nombre de la carrera.
    $consulta='SELECT carrera.Nombre FROM alumno INNER JOIN pase_regla ON alumno.id_pase=pase_regla.id_pase
    INNER JOIN carrera ON pase_regla.clave_carrera=carrera.clave_carrera WHERE Ncuenta = '.$_SESSION["ncuenta"].'';
    $resp = mysqli_query($conex,$consulta);
    $carrera = mysqli_fetch_array($resp);

    //Condiciones que establecen la probabilidad.
    if($promedioF > $datos["promedio"] + 0.5)
    {
        $probabilidad="Alta";
    }
    elseif($promedioF >= $datos["promedio"] && $promedioF <= $datos["promedio"] + 0.5)
    {
        $probabilidad="Media";
    }
    elseif($promedioF <= $datos["promedio"] && $promedioF >= $datos["promedio"] - 0.5)
    {
        $probabilidad="Baja";
    }
    else
    {
        $probabilidad="Casi nula";
    }

    //Tabla para desplegar los datos sobre la carrera solicitada.
    echo '<br><br><strong>Carrera solicitada</strong><br><br>';
    echo 'promedio: '.$datos["promedio"];
    echo '<table border="1">
        <thead>
            <tr>
                <th>Carrera</th>
                <th>Modalidad</th>
                <th>Ubicacion</th>
                <th>Probabilidad de entrar</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td align="center">'.$carrera[0].'</td>
                <td align="center">'.$datos["Modalidad"].'</td>
                <td align="center">'.$datos["Ubicacion"].'</td>
                <td align="center">'.$probabilidad.'</td>
            </tr>
        </tbody>
        </table>';
?>