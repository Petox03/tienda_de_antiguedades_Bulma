<?php
require_once 'header.php';
if (!$loggedin) die("</div></body></html>");

if($loggedin)
{
  //consulta de members
  $sql = mysqli_query($connection, "SELECT * FROM members WHERE user = '".$user."'");

  //Confirmación y ejecución de sentencia
    $colnum = mysqli_num_rows($sql);

      //Saber que columna está la sentencia sql
    $columna = mysqli_fetch_array($sql);

    $saldo = $columna["money"];
}

if(isset($_GET['idcompra']))
{
    $idc = $_GET['idcompra'];
    $sql2 = queryMysql("SELECT * FROM products WHERE code = '$idc'");
    $f = mysqli_fetch_array($sql2);

    if($f['stock']>0)
    {
        if($saldo >= $f['price'])
        {
            $precio = $f['price'];
            $compra = '<h1 class="check">GRACIAS POR SU COMPRA!</h1>
                        <meta http-equiv="Refresh" content="3;url=shop.php">';
            $saldo -= $precio;
            $stock = $f['stock'];
            $newstock = $stock - 1;
            queryMysql("UPDATE products
                SET stock = '$newstock'
                WHERE code='$idc'");
        }
        else
        {
            $compra = "<h1 class='error center'>USTED NO CUENTA CON EL SALDO SUFICIENTE</h1>
                        <meta http-equiv='Refresh' content='3;url=shop.php'>";
        }
    }
    else
    {
        $compra = "<h1 class='error center'>NO HAY PRODUCTOS DISPONIBLES</h1>
        <meta http-equiv='Refresh' content='3;url=shop.php'>";
    }

    echo'
    <div class="container is-fluid">';

    echo'<h3>Saldo: <span class="money" style="display:inline-block;"><h3>' . $saldo . '</h3></span>$</h3>
    <div class="container-fluid">
        '.$compra.'
    </div>';


    queryMysql("UPDATE members
                SET money='$saldo'");
}
else{
    die("<meta http-equiv='Refresh' content='3;url=shop.php'><h1 class='error center'>NO SELECCIONASTE UN PRODUCTO</h1>");
}


mysqli_close( $connection );

?>