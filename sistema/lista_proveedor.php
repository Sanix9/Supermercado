<?php
session_start();
if ($_SESSION['rol'] != 1 and $_SESSION['rol'] != 2) {
    header("location: ./");
}
include '../conexion.php';
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <?php include 'includes/scripts.php'; ?>
        <title>Lista de Proveedor_Supermercado</title>

    </head>
    <body>
        <?php include 'includes/header.php'; ?>
        <section id="container">
            <h1>Lista de Proveedores</h1>
            <a href="registro_proveedor.php" class="btn_new">Crear Proveedor</a>

            <form action="buscar_proveedor.php" method="get" class="form_search">
                <input type="text" name="busqueda" id="busqueda" placeholder="Buscar">
                <input type="submit" value="Buscar" class="btn_search">
            </form>

            <table>
                <tr>
                    <th>ID</th>
                    <th>Proveedor</th>
                    <th>Contacto</th>
                    <th>Telefono</th>
                    <th>Direccion</th>
                    <th>Fecha</th>
                    <th>Acciones</th>

                </tr>

                <?php
                //paginador
                $sql_registe = mysqli_query($conection, "SELECT COUNT(*) as total_registro FROM proveedor WHERE estatus =  1");
                $result_registe = mysqli_fetch_array($sql_registe);
                $total_registro = $result_registe['total_registro'];

                $por_pagina = 5;

                if (empty($_GET['pagina'])) {
                    $pagina = 1;
                } else {
                    $pagina = $_GET['pagina'];
                }

                $desde = ($pagina - 1) * $por_pagina;
                $total_registro = ceil($total_registro / $por_pagina);

                $query = mysqli_query($conection, "SELECT * FROM proveedor  WHERE estatus = 1 ORDER BY codproveedor ASC LIMIT $desde, $por_pagina");
                mysqli_close($conection);
                $result = mysqli_num_rows($query);
                if ($result > 0) {
                    while ($data = mysqli_fetch_array($query)) {
                        
                       $formato= 'Y-m-d H:i:s';
                       $fecha= DateTime::createFromFormat($formato, $data["date_add"]);
                        ?>       

                        <tr>
                            <td><?php echo $data["codproveedor"]; ?></td>
                            <td><?php echo $data["proveedor"] ?></td>
                            <td><?php echo $data["contacto"]; ?></td>
                            <td><?php echo $data["telefono"]; ?></td>
                            <td><?php echo $data["direccion"]; ?></td>
                            <td><?php echo $fecha->format('d-m-Y'); ?></td>
                            
                          
                            <td>
                                <a class="link_edit" href="editar_proveedor.php?id=<?php echo $data["codproveedor"]; ?>">Editar</a>
                                |
                                <a class="link_delete" href="eliminar_confirmar_proveedor.php?id=<?php echo $data["codproveedor"]; ?>">Eliminar</a>
                                <?php } ?>
                            </td>

                        </tr>
                        <?php
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
