<?php

session_start();
if ($_SESSION['rol'] != 1 and $_SESSION['rol'] != 2) {
    header("location: ./");
}

include '../conexion.php';
if (!empty($_POST)) {
    if ($_POST['idproveedor'] == 1){
        header('Location: lista_proveedor.php');
        mysqli_close($conection);
        exit;
    }
    $idproveedor = $_POST['idproveedor'];
    //$query_delete = mysqli_query($conection, "DELETE FROM usuario WHERE idusuario = $iduser");
    $query_delete = mysqli_query($conection, "UPDATE proveedor SET estatus = 0 WHERE codproveedor = $idproveedor");
    
    if ($query_delete) {
        header('Location: lista_proveedor.php');
    } else {
        echo 'Error al Eliminar';
    }
}

if (empty($_REQUEST['id'])) {
    header('Location: lista_proveedor.php');
    mysqli_close($conection);
} else {
    $idproveedor = $_REQUEST['id'];

    $sql = mysqli_query($conection, "SELECT * FROM proveedor WHERE codproveedor = $idproveedor ");
    mysqli_close($conection);
    $result_sql = mysqli_num_rows($sql);

    if ($result_sql > 0) {
        while ($data = mysqli_fetch_array($sql)) {
            $proveedor = $data['proveedor'];
            
        }
    } else {
        header("location: lista_proveedor.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <?php include "includes/scripts.php"; ?>
        <title>Eliminar Proveedor</title>
    </head>
    <body>
        <?php include "includes/header.php"; ?>
        <section id="container">
            <div class="data_delete">
                <h2>¿Está seguro de eliminar el siguiente registr?</h2>
                <p>Nombre del Proveedor: <span><?php echo $proveedor; ?></span></p>
                

                <form method="post" action="">
                    <input type="hidden" name="idproveedor" value="<?php echo $idproveedor; ?>">
                    <a href="lista_proveedor.php" class="btn_cancel">Cancelar</a>
                    <input type="submit" value="Aceptar" class="btn_ok">
                </form>
            </div>
        </section>

        <?php include "includes/footer.php"; ?>
    </body> 
</html>