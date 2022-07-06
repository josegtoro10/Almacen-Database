<?php

if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    
    require_once "config.php";
    
    $sql = "SELECT * FROM producto WHERE id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){

        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        $param_id = trim($_GET["id"]);
        
        if(mysqli_stmt_execute($stmt)){

            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){

                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                $codigo_producto = $row["codigo_producto"];
                $detalle = $row["detalle"];
                $fecha_vencimiento = $row["fecha_vencimiento"];
                $costo = $row["costo"];

            } else{
                echo "ERROR..";
            }
            
        } else{
            echo "ERROR..";
        }
    }
     
    mysqli_stmt_close($stmt);
    
    mysqli_close($link);
} else{
    echo "ERROR..";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Consultar registro</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">Consultar registro</h1>
                    <p>Codigo del Producto: <b><?php echo $codigo_producto; ?></b></p>
                    <p>Detalle: <b><?php echo $detalle; ?></b></p>
                    <p>Fecha de vencimiento: <b><?php echo $fecha_vencimiento; ?></b></p>
                    <p>Costo: <b><?php echo $costo; ?></b></p>
                    <p><a href="index.php" class="btn btn-primary">Regresar</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>

