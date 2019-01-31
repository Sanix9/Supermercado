<?php
//print_r($_POST);
//exit;
include '../conexion.php';

if (!empty($_POST)) {
    if ($_POST['action'] == 'infoProducto') {
        $producto_id = $_POST['producto'];
        
       $query = mysqli_query($conection, "SELECT codproducto,descripcion FROM producto WHERE codproducto = $producto_id AND estatus=1 ");
               
       mysqli_close($conection);
       $result = mysqli_num_rows($query);
       if ($result > 0) {
                    $data = mysqli_fetch_assoc($query);
                    echo json_encode($data,JSON_UNESCAPED_UNICODE);
                        exit;                        
              }
              echo 'error';
                exit;
    }
  }
  exit;
?>

