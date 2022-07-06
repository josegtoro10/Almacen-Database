<?php

require_once "config.php";

$nombre = "";
$detalle_marca = "";

// Se ejecuta el metodo del formulario
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $input_nombre = trim($_POST["nombre"]);
    $nombre = $input_nombre;
        
    $input_detalle_marca = trim($_POST["detalle_marca"]);
    $detalle_marca = $input_detalle_marca;

    $sql = "INSERT INTO marca (nombre, detalle_marca) 
            VALUES (?, ?)";
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
        mysqli_stmt_bind_param($stmt, "ss", $param_nombre, $param_detalle_marca);
        
        $param_nombre = $nombre;
        $param_detalle_marca = $detalle_marca;

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
                            <label>Nombre de la Marca</label>
                            <input type="text" name="nombre">
                        </div>

                        <div class="form-group">
                            <label>Detalle de la Marca</label>
                            <input type="text" name="detalle_marca">
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
