<?php
session_start();
if ($_SESSION['rol'] != 1 and $_SESSION['rol'] != 2) {
    header("location: ./");
}
include '../conexion.php';

if (!empty($_POST)) {
    $alert = '';
    if (empty($_POST['proveedor']) || empty($_POST['contacto']) || empty($_POST['telefono']) || empty($_POST['direccion'])) {
        $alert = '<p class="msg_error">Todos los campos son obligatorios.</p>';
    } else {
        $proveedor = $_POST['proveedor'];
        $contacto = $_POST['contacto'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];
        $usuario_id = $_SESSION['idUser'];

        $query_insert = mysqli_query($conection, "INSERT INTO proveedor(proveedor,contacto,telefono,direccion,usuario_id) VALUES ('$proveedor ','$contacto','$telefono','$direccion','$usuario_id')");
        if ($query_insert) {
            $alert = '<p class="msg_save">Cliente Guardado correctamente.</p>';
        } else {
            $alert = '<p class="msg_error">Error al Guardar el cliente.</p>';
        }
    }
    mysqli_close($conection);
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
<?php include 'includes/scripts.php'; ?>
        <title>Registro Proveedor</title>
    </head>
    <body>
<?php include 'includes/header.php'; ?>
        <section id="container">
            <div class="form_register">
                <h1>Registro Proveedor</h1>
                <hr>
                <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

                <form action="" method="post">
                    <label for="proveedor">Proveedor</label>
                    <input type="text" name="proveedor" id="proveedor" placeholder="Numero del Proveedor">
                    <label for="contacto">Contacto</label>
                    <input type="text" name="contacto" id="contacto" placeholder="Nombre Completo del Contacto">

                    <label for="telefono">Telefono: </label>
                    <input type="number" name="telefono" id="telefono" placeholder="Telefono">
                    <label for="direccion">Direccion </label>
                    <input type="text" name="direccion" id="direccion" placeholder="Direccion Completa">

                    <button type="submit"  class="btn_save"><i class="far fa-save fa-lg"></i> Guardar Proveedor</button>

                </form>
            </div>
        </section>
<?php include "includes/footer.php"; ?> 
    </body>
</html>
