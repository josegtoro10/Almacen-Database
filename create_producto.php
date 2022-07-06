<?php

require_once "config.php";

$codigo_producto = "";
$detalle = "";
$fecha_vencimiento = "";
$costo = "";

// Se ejecuta el metodo del formulario
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $input_codigo_producto = trim($_POST["codigo_producto"]);
    $codigo_producto = $input_codigo_producto;
        
    $input_detalle = trim($_POST["detalle"]);
    $detalle = $input_detalle;
        
    $input_fecha_vencimiento = trim($_POST["fecha_vencimiento"]);
    $fecha_vencimiento = $input_fecha_vencimiento;
    
    $input_costo = trim($_POST["costo"]);
    $costo = $input_costo;
    
    $sql = "INSERT INTO producto (codigo_producto, detalle, fecha_vencimiento, costo) 
            VALUES (?, ?, ?, ?)";
            /* Notese que los valores se colocan como signos ?
                estos es porque seran sustituidos por los valores de las 
                variables leidas en el formulario */
    
    if($stmt = mysqli_prepare($link, $sql)){
        
        /*   **** ATENCION ***
        el parametro "issd" de la siguiente funcion, significan los tipos
        de datos de las variables enviadas como parametros:
        i para tipo INTEGER
        s para STRING
        d para DECIMAL
        segun el orden en que se declaran en la funcion
        */
        mysqli_stmt_bind_param($stmt, "issd", $param_codigo_producto, $param_detalle, 
                                                $param_fecha_vencimiento, $param_costo);
        
        $param_codigo_producto = $codigo_producto;
        $param_detalle = $detalle;
        $param_fecha_vencimiento = $fecha_vencimiento;
        $param_costo = $costo;

        if(mysqli_stmt_execute($stmt)){ //Se manda a ejecutar el comando SQL
            header("location: index.php");
            exit();
        } else{
            echo "ERROR..";
        }
    }
        
    mysqli_stmt_close($stmt);
    
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Crear registro</title>
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
                    <h2 class="mt-5">Crear registro</h2>
                    <p>Procure ingresar datos correctos. No se validan los datos</p>
                    
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Codigo del producto</label>
                            <input type="text" name="codigo_producto">
                        </div>

                        <div class="form-group">
                            <label>Detalle</label>
                            <input type="text" name="detalle">
                        </div>
                        
                        <div class="form-group">
                            <label>Fecha de vencimiento</label>
                            <input type="text" name="fecha_vencimiento">
                        </div>
                                                
                        <div class="form-group">
                            <label>Costo</label>
                            <input type="text" name="costo">
                        </div>

                        <input type="submit" class="btn btn-primary" value="Aceptar">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancelar</a>
                    </form>

                </div>
            </div>        
        </div>
    </div>
</body>
</html>
