<?php
require_once 'header.php';
if (!$loggedin) die("</div></body></html>");

$sql = mysqli_query($connection, "SELECT * FROM members WHERE user = '".$user."'");

//Confirmación y ejecución de sentencia
$colnum = mysqli_num_rows($sql);

//Saber que columna está la sentencia sql
$columna = mysqli_fetch_array($sql);

$saldo = $columna["money"];

$data = "";

if(isset($_POST['dinero']))
{
    $sql = mysqli_query($connection, "SELECT * FROM members WHERE user = '$user'");
    $f = mysqli_fetch_array($sql);

    $saldo = $f['money'];

    $saldo += $_POST['dinero'];
    $sql2 = mysqli_query($connection, "UPDATE members SET money = '$saldo' WHERE user = '$user'") or die("Upps, parece que algo ha ido mal <br>Intente más tarde");

    $data='
        <div class="center">
            <h2>
                Saldo añadido correctamente.
                <br>
                Saldo agregado:'.$_POST['dinero'].'
                <br>
                Su saldo actual es: '.$saldo.'
            </h2>
        </div>
    ';
}

echo "
        <div class='container is-fluid'>
            <h3 class='center'>Your Profile</h3>
            <h3 class='animate__animated animate__lightSpeedInLeft animate__fast'>Saldo: <span class='money' style='display:inline-block;'><h3>$saldo</h3></span>$</h3>";

showProfile($user);

echo <<<_END
            <form method='post' action='saldo.php' enctype='multipart/form-data'>
                <div class="field is-8">
                    <h3>Ingresa la cantidad a añadir</h3>
                    <input class="input" name="dinero" value="0" type="number" required>
                </div>
                <button type='submit' class='button btn-color ml-2'>Guardar</button>
            </form>
        </div><br>
        $data
    </body>
</html>
_END;



mysqli_close( $connection );

?>