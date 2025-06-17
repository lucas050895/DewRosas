<?php

    include('../config/conexion.php');

    if(!isset($_GET['id_venta'])){
        header('Location ../index.php');
    }

    $datos = $conexion->query("SELECT 
                                    ventas.* ,
                                    usuario.nombre, usuario.apellido, usuario.celular, usuario.email
                                    FROM ventas 
                                    INNER JOIN usuario ON ventas.id_usuario = usuario.id
                                    WHERE ventas.id=" .$_GET['id_venta'])or die($conexion->error);

    $datosUsuarios =mysqli_fetch_row($datos);


    $datos2 = $conexion->query("SELECT *
                                    FROM ventas 
                                    WHERE id=" .$_GET['id_venta']);

    $datosVentas =mysqli_fetch_row($datos2);


    $datos3 = $conexion->query("SELECT
                                    productos_venta.*,
                                    productos.nombre
                                    FROM productos_venta
                                    INNER JOIN productos ON productos_venta.id_producto = productos.id
                                    WHERE id_venta =".$_GET['id_venta'])or die($conexion->error);






    $access_token = "TEST-905463235862583-051909-f3fd35e194d8f6f8ecd61814e10cd8c5-525097714";

    // Build items array from productos_venta
    $items = [];
    while($f = mysqli_fetch_array($datos3)){
        $items[] = [
            "title" => $f['nombre'],
            "quantity" => (int)$f['cantidad'],
            "currency_id" => "ARS",
            "unit_price" => (float)$f['precio']
        ];
    }

    $data = [
        "items" => $items,
        "back_urls" => [
            "success" => "https://lucasconde.ddns.net/DewRosas/vistas/gracias?id_venta=".$_GET['id_venta']."&metodo=mercado_pago",
            "failure" => "https://lucasconde.ddns.net/DewRosas/vistas/error?=exito",
            "pending" => "https://lucasconde.ddns.net/DewRosas/vistas/error?=exito"
        ],
        "auto_return" => "approved"
    ];

    $ch = curl_init("https://api.mercadopago.com/checkout/preferences");
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json",
        "Authorization: Bearer $access_token"
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    $response_array = json_decode($response, true);
    $preference_id = $response_array["id"] ?? null;

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<!-- META -->
    <?php include('../layout/meta.php');?>

	<!-- CSS -->
    <link rel="stylesheet" href="../assets/css/ver_pedido.css">

    <!-- ICONOS -->
    <?php include('../layout/iconos.php'); ?>
</head>
<body>
    <!-- HEADER -->
    <?php include('../layout/header.php'); ?>

    <main>
        <h2>Pedido N° <?php echo $_GET['id_venta']; ?></h2>

        <fieldset>
            <legend>Comprador</legend>
            <div>
                <span>Nombre y apellido: </span> <span><?php echo $datosUsuarios['4'] ." ". $datosUsuarios['5']; ?></span>
            </div>

            <div>
                <span>Celular: </span><span><?php echo $datosUsuarios['6']; ?></span>
            </div>

            <div>
                <span>Email: </span> <span> <?php echo $datosUsuarios['7']; ?></span>
            </div>
        </fieldset>

                <fieldset>
            <legend>Pedido</legend>

            <table>
                <thead>
                    <tr>
                        <td>Nombre</td>
                        <td>Cant</td>
                        <td>Precio</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                       $pedido = $conexion->query("SELECT
                                                    productos_venta.*,
                                                    productos.nombre
                                                    FROM productos_venta
                                                    INNER JOIN productos ON productos_venta.id_producto = productos.id
                                                    WHERE id_venta =".$_GET['id_venta'])or die($conexion->error);


                        while($f = mysqli_fetch_array($pedido)){ ?>
                            <tr>
                                <td><?php echo $f['nombre']; ?></td>
                                <td><?php echo $f['cantidad']; ?></td>
                                <td>$ <?php echo number_format($f['precio'] , 0, ',', '.');?></td>
                            </tr>
                    <?php } ?>
                    
                </tbody>
                   <tbody>
                    <tr>
                        <?php
                            $total = $conexion->query("SELECT SUM(precio), id_venta
                                                            FROM productos_venta
                                                            WHERE id_venta =".$_GET['id_venta'])or die($conexion->error);

                            $totalVenta =mysqli_fetch_row($total);
                            ?>

                        <td colspan="2">Total</td>
                        <td colspan="1">$<?php echo number_format($totalVenta['0'], 0, ',', '.');?></td>
                    </tr>
                </tbody>

            </table>
        </fieldset>

    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <script>
      const mp = new MercadoPago("TEST-9dff02ae-7ed8-4a17-b5f6-fbb472daca1c", { locale: "es-AR" });

      mp.checkout({
        preference: {
          id: "<?php echo $preference_id; ?>",
        },
        render: {
          container: ".cho-container",
          label: "Pagar",
        },
      });
    </script>

    <div class="cho-container"></div>


</body>
</html>