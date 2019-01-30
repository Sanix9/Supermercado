<?php
include '../conexion.php';
?>



<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <?php include 'includes/scripts.php'; ?>
        <title>Lista de Usuarios_Supermercado</title>

    </head>
    <body>
        <?php include 'includes/header.php'; ?>
        <section id="container">
            
             <?php
            $busqueda = strtolower($_REQUEST['busqueda']);
            if (empty($busqueda)) {
                header("location: lista_usuarios.php");
            }

            ?>
            
            
            <h1>Lista de usuarios</h1>
            <a href="registro_usuario.php" class="btn_new">Crear Usuario</a>
            
            <form action="buscar_usuario.php" method="get" class="form_search">
                <input type="text" name="busqueda" id="busqueda" placeholder="Buscar" value="<?php echo $busqueda; ?>">
                <input type="submit" value="Buscar" class="btn_search">
            </form>
            
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Usuario</th>
                    <th>Rol</th>
                    <th>Acciones</th>

                </tr>

                  <?php 
                $rol='';
                if ($busqueda == 'administrador') {
                    $rol=" OR rol LIKE '%1%' ";
                }elseif ($busqueda == 'supervisor') {
                     $rol=" OR rol LIKE '%2%' ";
                }elseif ($busqueda == 'vendedor') {
                     $rol=" OR rol LIKE '%3%' ";
                }
                
                
             
                //paginador
                $sql_registe = mysqli_query($conection, "SELECT COUNT(*) as total_registro 
                                                FROM usuario WHERE (
                                                idusuario LIKE '%$busqueda%' OR 
                                                nombre LIKE '%$busqueda%' OR 
                                                correo LIKE '%$busqueda%' OR 
                                                usuario LIKE '%$busqueda%' 
                                                $rol) 
                                                AND estatus = 1 ");
                $result_registe = mysqli_fetch_array($sql_registe);
                $total_registro = $result_registe['total_registro'];
                
                $por_pagina =5;
                
                if(empty($_GET['pagina']))
                {
                    $pagina = 1;
                } else {
                    $pagina = $_GET['pagina'];
                }
                
                $desde = ($pagina-1) * $por_pagina;
                $total_registro = ceil($total_registro / $por_pagina);
                
                $query = mysqli_query($conection,"SELECT u.idusuario, u.nombre, u.correo, u.usuario, r.rol FROM usuario  u 
                         INNER JOIN rol r  ON u.rol=r.idrol 
                         WHERE (   u.idusuario LIKE '%$busqueda%' OR 
                                    u.nombre LIKE '%$busqueda%' OR 
                                    u.correo LIKE '%$busqueda%' OR 
                                    u.usuario LIKE '%$busqueda%' OR
                                    r.rol  LIKE '%$busqueda%')
                                    AND
                         estatus = 1 ORDER BY u.idusuario ASC LIMIT $desde, $por_pagina");
                
                $result= mysqli_num_rows($query);
                if ($result> 0) {
                    while ($data = mysqli_fetch_array($query)) {
                 ?>       

                        <tr>
                            <td><?php echo $data["idusuario"]; ?></td>
                            <td><?php echo $data["nombre"]; ?></td>
                            <td><?php echo $data["correo"]; ?></td>
                            <td><?php echo $data["usuario"]; ?></td>
                            <td><?php echo $data["rol"]; ?></td>
                            <td>
                                <a class="link_edit" href="editar_usuario.php?id=<?php echo $data["idusuario"]; ?>">Editar</a>

                                <?php if ($data["idusuario"] != 1) { ?>
                                    |
                                    <a class="link_delete" href="eliminar_confirmar_usuario.php?id=<?php echo $data["idusuario"]; ?>">Eliminar</a>
                                <?php } ?>
                            </td>

                        </tr>
                        <?php
                    }
                }
                ?>

            </table>
            <div class="paginador">
                <ul>
                    <li><a href="#">|<<</a></li>
                    <li><a href="#"> <<< </a></li>
                    <?php 
                        for($i=1; $i <= $total_registro; $i++){
                            if ($i == $pagina){
                               echo '<li><a class "pageSelect">'.$i.'</a></li>';  
                            } else {
                               echo '<li><a href="?pagina='.$i.'">'.$i.'</a></li>';
                            }
                           
                        }
                    ?>
                    
                    <li><a href="#">>>></a></li>
                    <li><a href="#">>>|</a></li>
                </ul>
            </div>

        </section>

        <?php include "includes/footer.php"; ?>
    </body> 
</html> 