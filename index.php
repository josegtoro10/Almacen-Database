<!DOCTYPE html>
<html>
<head>
 <meta charset="UTF-8">
    <title>Almacen de productos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>

    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Productos</h2>
                        <a href="create_producto.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Agregar un  producto</a>
                    </div>

                    <!-- Copiar desde aqui -->
                    <?php

                    // Incluir configuracion de la Base de Datos
                    require_once "config.php";
                    
                    $sql = "SELECT * FROM producto";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>id</th>";
                                        echo "<th>Codigo</th>";
                                        echo "<th>Detalle</th>";
                                        echo "<th>Fecha de vencimiento</th>";
                                        echo "<th>Costo</th>";
                                        echo "<th>Operaciones</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['codigo_producto'] . "</td>";
                                        echo "<td>" . $row['detalle'] . "</td>";
                                        echo "<td>" . $row['fecha_vencimiento'] . "</td>";
                                        echo "<td>" . $row['costo'] . "</td>";
                                        echo "<td>";
                                            echo '<a href="read_producto.php?id='. $row['id'] .'" class="mr-3" title="Ver registro" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                            echo '<a href="update_producto.php?id='. $row['id'] .'" class="mr-3" title="Modificar registro" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                            echo '<a href="delete_producto.php?id='. $row['id'] .'" title="Borrar registro" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                        echo "</td>";
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
 
                    // Cerrar coneccion
                    mysqli_close($link);
                    ?>
                    <!-- Hasta aqui -->

                    <div class="mt-5 mb-3 clearfix">
                        <a href="consulta_general.php" class="btn btn-success pull-left"></i> Consulta general</a>
                    </div>

                </div>
            </div>       
            
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Marcas</h2>
                        <a href="create_marca.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Agregar una marca</a>
                    </div>

                    <!-- Pegar aqui dentro -->
                     <!-- MARCA -->
                     <?php

                    // Incluir configuracion de la Base de Datos
                    require_once "config2.php";

                        $sql = "SELECT * FROM marca"; 
                            if($result = mysqli_query($link,$sql)){
                            if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                            echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>id</th>";
                                        echo "<th>Nombre de la Marca</th>";
                                        echo "<th>Detalle de la Marca</th>";
                                    echo "</tr>";
                             echo "</thead>";
                                    echo "<tbody>";
                                        while($row = mysqli_fetch_array($result)){
                                     echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['nombre'] . "</td>";
                                        echo "<td>" . $row['detalle_marca'] . "</td>";
                                        echo "<td>";
                                    echo '<a href="read_marca.php?id='. $row['id'] .'" class="mr-3" title="Ver registro" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                    echo '<a href="update_marca.php?id='. $row['id'] .'" class="mr-3" title="Modificar registro" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                    echo '<a href="delete_marca.php?id='. $row['id'] .'" title="Borrar registro" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                    echo "</td>";
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

                                    // Cerrar coneccion
                                mysqli_close($link);
                    ?>
                    <!-- Hasta aqui -->
                </div>
            </div>
        </div>
    </div>
</body>
</html>

