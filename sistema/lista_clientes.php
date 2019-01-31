<?php
session_start();
include '../conexion.php';
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <?php include 'includes/scripts.php'; ?>
        <title>Lista de Clientes_Supermercado</title>

    </head>
    <body>
        <?php include 'includes/header.php'; ?>
        <section id="container">
            <h1>Lista de clientes</h1>
            <a href="registro_cliente.php" class="btn_new">Crear Cliente</a>

            <form action="buscar_cliente.php" method="get" class="form_search">
                <input type="text" name="busqueda" id="busqueda" placeholder="Buscar">
                <input type="submit" value="Buscar" class="btn_search">
            </form>

            <table>
                <tr>
                    <th>ID</th>
                    <th>Cedula</th>
                    <th>Nombre</th>
                    <th>Telefono</th>
                    <th>Direccion</th>
                    <th>Acciones</th>

                </tr>

                <?php
                //paginador
                $sql_registe = mysqli_query($conection, "SELECT COUNT(*) as total_registro FROM cliente WHERE estatus =  1");
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

                $query = mysqli_query($conection, "SELECT * FROM cliente  WHERE estatus = 1 ORDER BY idcliente ASC LIMIT $desde, $por_pagina");
                mysqli_close($conection);
                $result = mysqli_num_rows($query);
                if ($result > 0) {
                    while ($data = mysqli_fetch_array($query)) {
                        
                        if($data["nit"] == 0){
                            $nit = 'C/F';
                        } else {
                            $nit = $data["nit"];
                        }
                        
                        ?>       

                        <tr>
                            <td><?php echo $data["idcliente"]; ?></td>
                            <td><?php echo $nit; ?></td>
                            <td><?php echo $data["nombre"]; ?></td>
                            <td><?php echo $data["telefono"]; ?></td>
                            <td><?php echo $data["direccion"]; ?></td>
                          
                            <td>
                                <a class="link_edit" href="editar_cliente.php?id=<?php echo $data["idcliente"]; ?>">Editar</a>
                                
                                    |
                                    <a class="link_delete" href="eliminar_confirmar_cliente.php?id=<?php echo $data["idcliente"]; ?>">Eliminar</a>
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
