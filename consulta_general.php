<!DOCTYPE html>
<html>
<head>
 <meta charset="UTF-8">
    <title>Consulta general</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
<body>

    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Consulta General</h2>
                    </div>

                    <?php

                    // Incluir configuracion de la Base de Datos
                    require_once "config.php";
                    
                    // ATENCION: Observe que se usan alias para algunos campos
                    $sql = "SELECT * FROM producto, marca 
                            WHERE codigo_producto < 1000 and detalle_marca LIKE '%m%' ";

                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Codigo Producto</th>";
                                        echo "<th>Detalle del Producto</th>";
                                        echo "<th>Fecha de Vencimiento</th>";
                                        echo "<th>Costo</th>";
                                        echo "<th>Nombre de la marca</th>";
                                        echo "<th>Detalle de la marca</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                    while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        // Fijense que se usan los nombres de los campos y/o los alias 
                                        echo "<td>" . $row['codigo_producto'] . "</td>";
                                        echo "<td>" . $row['detalle'] . "</td>";
                                        echo "<td>" . $row['fecha_vencimiento'] . "</td>";
                                        echo "<td>" . $row['costo'] . "</td>";
                                        echo "<td>" . $row['nombre'] . "</td>";
                                        echo "<td>" . $row['detalle_marca'] . "</td>";
                                       
                                    echo "</tr>";
                                    }
                                echo "</tbody>";                            
                            echo "</table>";

                            mysqli_free_result($result);

                        } else{
                            echo '<div class="alert alert-danger"><em>Ningun registro encontrado.</em></div>';
                        }
                    } else{
                        echo "Oops! ERROR.. Intente mas tarde";
                    }
 
                    // Cerrar conexcion
                    mysqli_close($link);
                    ?>

                </div>
                <p><a href="index.php" class="btn btn-primary">Regresar</a></p>
                
            </div>       

        </div>
    </div>

</body>
</html>

