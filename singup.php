<?php //Example 26-5: signup.php
require_once 'header.php';

echo <<<_END
    <script>
        function checkUser(user) {
            if (user.value == '') {
                $('#used').html('&nbsp;')
                return
            }
            $.post ( 'checkuser.php', { user : user.value },
                function(data) {
                    $('#used').html(data)
                }
            )
        }
    </script>
_END;

    $error = $user = $pass = $Rpass = "";
        if (isset($_SESSION['user'])) destroySession();

        if (isset($_POST['user'])) {
            $user = sanitizeString($_POST['user']);
            $pass = sanitizeString($_POST['pass']);
            $Rpass = sanitizeString($_POST['Rpass']);
            $money = 0;

        if($user == "" || $pass == "" || $Rpass == "")
            $error = 'Falta algún dato<br><br>';
        else {
            if($pass == $Rpass){
                $result = queryMysql("SELECT * FROM members WHERE user='$user'");

                if ($result->num_rows)
                    $error = 'Ese usuario ya existe<br><br>';
                else {
                    queryMysql("INSERT INTO members(user, pass, idaccess, money)
                    VALUES('$user', '$pass', '2', '$money')");
                    die('<meta http-equiv="Refresh" content="3;url=login.php">
                    <div class="check animate__animated animate__bounceInDown"><h1>Cuenta creada</h1>Por favor, inicie sesión.</div></body></html>');
                }
            }
            else{
                $error = "Las contraseñas no son iguales, inténtelo de nuevo.";
            }
        }
    }

echo<<<_singup
<div class="container-fluid">

    <div class="columns accessform-container mb-2">
        <div class="column is-5 accessform animate__animated animate__zoomIn animate__faster">
            <h3 class="accessform-title">REGÍSTRATE!</h3>
            <h4 class="error animate__animated animate__shakeX animate__fast">$error</h4>
            <form action="singup.php" method="POST">
                <div class="field">
                    <div class="control is-12">
                        <label class="label ml-1" for="usuario">Usuario</label>
                        <input type="text" class="input" name="user" id="usuario" aria-describedby="usuario"
                            placeholder="Usuario" value='$user' onBlur='checkUser(this)' required>
                        <div id='used'>&nbsp;</div>
                    </div>
                    <div class="control is-12">
                        <label class="label ml-1" for="contraseña">Contraseña</label>
                        <input type="password" class="input" name="pass" id="contraseña" placeholder="Contraseña"
                            value='$pass' required>
                    </div>
                    <div class="control is-12">
                        <label class="label ml-1" for="contraseña">Repetir contraseña</label>
                        <input type="password" class="input" name="Rpass" id="Rcontraseña" placeholder="Repetir contraseña"
                            value='$Rpass' required>
                    </div>
                </div>
                <button type="submit" class="btn btn-color">Registrarse</button>
            </form>
        </div>
    </div>

</div>

</body>
_singup;
?>
