<?php
include '../conexion.php';
if (!empty($_POST)) {
    $iduser = $_POST['idusuario'];
    //$query_delete = mysqli_query($conection, "DELETE FROM usuario WHERE idusuario = $iduser");
    $query_delete = mysqli_query($conection, "UPDATE usuario SET estatus = 0 WHERE idusuario = $iduser");
    
    if ($query_delete) {
        header('Location: lista_usuarios.php');
    } else {
        echo 'Error al Eliminar';
    }
}

if (empty($_GET['id']) || $_GET['id'] == 1) {
    header('Location: lista_usuarios.php');
} else {
    $iduser = $_GET['id'];

    $sql = mysqli_query($conection, "SELECT u.nombre, u.usuario, r.rol FROM usuario u INNER JOIN rol r ON u.rol = r.idrol WHERE u.idusuario= $iduser ");
    $result_sql = mysqli_num_rows($sql);

    if ($result_sql > 0) {
        while ($data = mysqli_fetch_array($sql)) {
            $nombre = $data['nombre'];
            $usuario = $data['usuario'];
            $rol = $data['rol'];
        }
    } else {
        header("location: lista_usuarios.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <?php include "includes/scripts.php"; ?>
        <title>Eliminar Usuario</title>
    </head>
    <body>
        <?php include "includes/header.php"; ?>
        <section id="container">
            <div class="data_delete">
                <h2>¿Está seguro de eliminar el siguiente registr?</h2>
                <p>Nombre: <span><?php echo $nombre; ?></span></p>
                <p>Usuario: <span><?php echo $usuario; ?></span></p>
                <p>Tipo Usuario: <span><?php echo $rol; ?></span></p>

                <form method="post" action="">
                    <input type="hidden" name="idusuario" value="<?php echo $iduser; ?>">
                    <a href="lista_usuarios.php" class="btn_cancel">Cancelar</a>
                    <input type="submit" value="Aceptar" class="btn_ok">
                </form>
            </div>
        </section>

        <?php include "includes/footer.php"; ?>
    </body> 
</html>