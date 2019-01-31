
 <?php
session_start();
include '../conexion.php';
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <?php include 'includes/scripts.php'; ?>
        <title>Lista de Productos_Supermercado</title>

    </head>
    <body>
        <?php include 'includes/header.php'; ?>
        <section id="container">
            <h1><i class="fas fa-cube"></i>Lista de productos</h1>
            <a href="registro_producto.php" class="btn_new"><i class="fas fa-user-plus"></i> Registrar producto</a>

            <form action="buscar_producto.php" method="get" class="form_search">
                <input type="text" name="busqueda" id="busqueda" placeholder="Buscar">
                <input type="submit" value="Buscar" class="btn_search">
            </form>

            <table>
                <tr>
                    <th>Codigo</th>
                    <th>Descripcion</th>
                    <th>Precio</th>
                    <th>Existencia</th>
                    <th>Proveedor</th>
                    <th>Foto</th>
                    <th>Acciones</th>

                </tr>

                <?php
                //paginador
                $sql_registe = mysqli_query($conection, "SELECT COUNT(*) as total_registro FROM producto WHERE estatus =  1");
               
                $result_registe = mysqli_fetch_array($sql_registe);
                $total_registro = $result_registe['total_registro'];

                $por_pagina = 3;

                if (empty($_GET['pagina'])) {
                    $pagina = 1;
                } else {
                    $pagina = $_GET['pagina'];
                }

                $desde = ($pagina - 1) * $por_pagina;
                $total_registro = ceil($total_registro / $por_pagina);

                $query = mysqli_query($conection, "SELECT p.codproducto,p.descripcion, p.precio, p.existencia, pr.proveedor, p.foto FROM producto p INNER JOIN proveedor pr ON p.proveedor = pr.codproveedor  WHERE p.estatus = 1 ORDER BY p.codproducto DESC LIMIT $desde, $por_pagina");
                mysqli_close($conection);
                $result = mysqli_num_rows($query);
                if ($result > 0) {
                    
                    while ($data = mysqli_fetch_array($query)) {

                        if($data['foto'] != 'img_producto.png'){
                            $foto = 'img/uploads/'.$data['foto'];
                        } else {
                            $foto = 'img/uploads/'.$data['foto'];
                        }
                        
                        ?>       

                        <tr>
                            <td><?php echo $data["codproducto"]; ?></td>
                       
                            <td><?php echo $data["descripcion"]; ?></td>
                            <td><?php echo $data["precio"]; ?></td>
                            <td><?php echo $data["existencia"]; ?></td>
                            <td><?php echo $data["proveedor"]; ?></td>
                            <td><img src="<?php echo $foto; ?>" alt="<?php echo $data["descripcion"]; ?>" height="35px"width="35px"></td>
                            
                                <?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) { ?>
                            <td>
                                <a class="link_add add_product" product="<?php echo $data["codproducto"]; ?>" href="#"><i class="fas fa-plus"></i>Agregar</a>
                                |
                                <a class="link_edit" href="editar_producto.php?id=<?php echo $data["codproducto"]; ?>"><i class="fas fa-edit"></i>Editar</a>
                       
                                    |
                                    <a class="link_delete" href="eliminar_confirmar_producto.php?id=<?php echo $data["codproducto"]; ?>"><i class="fas fa-trash-alt"></i>Eliminar</a>
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
                    for ($i = 1; $i <= $total_registro; $i++) {
                        if ($i == $pagina) {
                            echo '<li><a class "pageSelect">' . $i . '</a></li>';
                        } else {
                            echo '<li><a href="?pagina=' . $i . '">' . $i . '</a></li>';
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
 