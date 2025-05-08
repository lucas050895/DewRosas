<?php

    $to =$_POST['email'];
    $subject ='Gracias por tu compra en Dew Rosas';
    $from ='dominio@gmail.com';
    $header ='MIME-Version 1.0'."\r\n";
    $header ="Content-type: text/html; charset=iso-8859-1\r\n";

    $header.= 'From: dominio@gmail.com'."\r\n";

    $message='<html><body>';
        $message.='<main style="width: 100%; max-width: 350px; min-height: 80vh; margin: auto;">';

            $message.='<h1>¡Hola '. $_POST['nombre'] .'!</h1>';

            $message.='<p>Los detalles de tu compra estas detallados en este email.</p>';

            $message.='<table style="width: 100%; max-width: 350px; margin: 20px auto 0; padding: 30px; border-collapse: collapse;">';

                $message.='<thead style="height: 40px; font-weight: 600; background-color: black; color: white; text-align: center;">';
                    $message.='<tr>
                                    <td>Nombre</td>
                                    <td>Cant</td>
                                    <td>Precio</td>
                                </tr>';
                $message.='</thead>';

                $message.='<tbody>';

                    $total = 0;

                    $arregloCarrito = $_SESSION['carrito'];

                    for($i=0;$i<count($arregloCarrito);$i++){
                        $total = $total + ($arregloCarrito[$i]['Precio'] * $arregloCarrito[$i]['Cantidad']);

                        $message.='<tr style="height: 40px; border-bottom: 1px solid #00000054;">
                                        <td style="width: 50%;">'. $arregloCarrito[$i]['Nombre'] .'</td>';

                            $message.='<td style="width: 10%; text-align: center;">'. $arregloCarrito[$i]['Cantidad'] .'</td>';

                            $message.='<td style="width: 30%; text-align: right;"> $'. number_format($arregloCarrito[$i]['Precio'], 0, ',', '.') .'</td>
                                    </tr>';
                    }
                $message.='</tbody>';


            $message.='</table>';

            $message.= '<table class="total" style="width: 100%; max-width: 350px; margin: 0 auto 3em; border-collapse: collapse; background-color: black; color: white;">';

                $message.='<thead>';
                    $message.='<tr style="height: 60px; display: flex; align-items: center; justify-content: space-around; ">
                                    <td style="width: 50%; padding-left: 20px;  font-size: 1.8em;">
                                        Total
                                    </td>

                                    <td style="width: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.8em;"> $'.
                                        $total_formateado = number_format($total, 0, ',', '.').
                                    '</td>
                                </tr>';

                    $message.='</thead>';
            $message.='</table>';

            $message.='<a href="http://lucasconde.ddns.net/DewRosas/links/ver_pedido.php?id_venta='.$id_venta.'" style="text-align: center; margin: auto;">Ver estado del pedido</a>';
        $message.='</main>';
    $message.='</body></html>';

    if(mail($to, $subject, $message, $header)){
        // echo "Mensaje enviado correctamente";
    }else{
        echo 'Lo sentimos, no se pudo enviar el correo';
    }
?>


