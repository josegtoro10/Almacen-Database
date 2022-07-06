<?php
require_once "config.php";
 
$codigo_producto = "";
$detalle = "";
$fecha_vencimiento = "";
$costo = "";
 
if(isset($_POST["id"]) && !empty($_POST["id"])){
    
    $id = $_POST["id"];
    
    $input_codigo_producto = trim($_POST["codigo_producto"]);
    $codigo_producto = $input_codigo_producto;
        
    $input_detalle = trim($_POST["detalle"]);
    $detalle = $input_detalle;
        
    $input_fecha_vencimiento = trim($_POST["fecha_vencimiento"]);
    $fecha_vencimiento = $input_fecha_vencimiento;
    
    $input_costo = trim($_POST["costo"]);
    $costo = $input_costo;

    $sql = "UPDATE producto SET codigo_producto=?, detalle=?,
                                fecha_vencimiento=?, costo=?
            WHERE id=?";
        
    if($stmt = mysqli_prepare($link, $sql)){

        /*   **** ATENCION ***
        el parametro "issd" de la siguiente funcion, significan los tipos
        de datos de las variables enviadas como parametros:
        i para tipo INTEGER
        s para STRING
        d para DECIMAL
        segun el orden en que se declaran en la funcion
        */
        mysqli_stmt_bind_param($stmt, "issdi", $param_codigo_producto, $param_detalle, 
        $param_fecha_vencimiento, $param_costo, $param_id);

        $param_codigo_producto = $codigo_producto;
        $param_detalle = $detalle;
        $param_fecha_vencimiento = $fecha_vencimiento;
        $param_costo = $costo;
        $param_id = $id;

        if(mysqli_stmt_execute($stmt)){
            header("location: index.php");
            exit();
        } else{
            echo "ERROR..";
        }
    }
        
    mysqli_stmt_close($stmt);
    
    mysqli_close($link);

} else{

    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        
        $id =  trim($_GET["id"]);
        
        $sql = "SELECT * FROM producto WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){

            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            $param_id = $id;
            
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
    }  else{
        echo "ERROR..";
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Modificar registro</title>
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
                    <h2 class="mt-5">Modificar registro</h2>
                    <p>Procure ingresar datos correctos. No se validan los datos</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                    <div class="form-group">
                            <label>Codigo del producto</label>
                            <input type="text" name="codigo_producto" value="<?php echo $codigo_producto; ?>">
                        </div>

                        <div class="form-group">
                            <label>Detalle</label>
                            <input type="text" name="detalle" value="<?php echo $detalle; ?>">
                        </div>
                        
                        <div class="form-group">
                            <label>Fecha de vencimiento</label>
                            <input type="text" name="fecha_vencimiento" value="<?php echo $fecha_vencimiento; ?>">
                        </div>
                                                
                        <div class="form-group">
                            <label>Costo</label>
                            <input type="text" name="costo" value="<?php echo $costo; ?>">
                        </div>

                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Aceptar">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancelar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>

