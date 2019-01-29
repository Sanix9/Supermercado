<?php
    include "../conexion.php";
    
//mostrar datos
    if(empty($_get['id']))
    {
        header('Location: lista_usuario.php');
    }
    $iduser = $_get['id'];
    
    $sql= mysqli_query($conection, "SELECT u.idusuario, u.nombre, u.correo, u.usuario, (u.rol) as idrol, (r.rol) as rol FROM usuario u INNER JOIN rol r on u.rol = r.idrol where idusuario = 4");
    
    $result_sql = mysqli_num_rows($sql);
            if($result_sql == 0){
                header('Location: lista_usuario.php');
            }else{
                while ($data = mysqli_fetch_array($sql)){
                    $iduser = $data['idusuario'];
                    $nombre = $data['nombre'];
                    $correo = $data['correo'];
                    $usuario =$data['usuario'];
                    $idrol   = $data['idrol'];
                    $rol    =$data['rol'];
                }
            }
            
    ?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <?php include 'includes/scripts.php'; ?>
        <title>Actualizar Usuario</title>
    </head>
    <body>
        <?php include 'includes/header.php'; ?>
        <section id="container">
            <div class="form_register">
                <h1>Actualizar Usuario</h1>
                <hr>
                <div class="alert"></div>

                <form action="" method="post">
                    <label for="nombre">Nombre: </label>
                    <input type="text" name="nombre" id="nombre" placeholder="Nombre Completo" value="<?php echo $nombre; ?>">
                    <label for="correo">Correo Electr&oacute;nico: </label>
                    <input type="email" name="correo" id="correo" placeholder="Correo Electronico" value="<?php echo $correo; ?>">
                    <label for="usuario">Usuario: </label>
                    <input type="text" name="usuario" id="usuario" placeholder="Usuario" value="<?php echo $usuario; ?>">
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