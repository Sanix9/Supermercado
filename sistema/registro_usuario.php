<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <?php include 'includes/scripts.php'; ?>
        <title>Registro Usuario</title>
    </head>
    <body>
        <?php include 'includes/header.php'; ?>
        <section id="container">
            <div class="form_register">
                <h1>Registro Usuario</h1>
                <hr>
                <div class="alert"></div>

                <form action="" method="post">
                    <label for="nombre">Nombre: </label>
                    <input type="text" name="nombre" id="nombre" placeholder="Nombre Completo">
                    <label for="correo">Correo Electr&oacute;nico: </label>
                    <input type="email" name="correo" id="correo" placeholder="Correo Electronico">
                    <label for="usuario">Usuario: </label>
                    <input type="text" name="usuario" id="usuario" placeholder="Usuario">
                    <label for="clave">Clave: </label>
                    <input type="password" name="clave" id="clave" placeholder="Clave de acceso">
                    <label for="rol">Tipo Uusario: </label>
                    <select name="rol" id="rol">
                        <option value="1">Administrador</option>
                        <option value="2">Supervisor</option>
                        <option value="3">Cajero</option>
                    </select>
                    <input type="submit" value="Crear Usuario" class="btn_save">
                </form>
            </div>
        </section>
        <?php include "includes/footer.php"; ?> 
    </body>
</html>