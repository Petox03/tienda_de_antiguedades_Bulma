<?php
  require_once 'header.php';

  if (!$loggedin) die("</div</body></html>");

  if (isset($_GET['view']))
  {
    $sql = mysqli_query($connection, "SELECT * FROM members WHERE user = '".$user."'");

  //Confirmación y ejecución de sentencia
    $colnum = mysqli_num_rows($sql);

      //Saber que columna está la sentencia sql
    $columna = mysqli_fetch_array($sql);

    $saldo = $columna["money"];

    $data = "";

    if($id == 1)
    {
      $data = "<a href='#' type='button' class='button btn-color'>añadir producto</a>";
    }

    $view = sanitizeString($_GET['view']);

    if ($view != $user) $name = "Your";
    else                $name = "$view's";

    echo"<div class='container is-fluid'>
      <h3 class='animate__animated animate__lightSpeedInLeft animate__fast'>Saldo: <span class='money' style='display:inline-block;'><h3>$saldo</h3></span>$</h3>
      <h3 class='center'>$name Profile</h3>";
    showProfile($view);
    echo "
      <a href='profile.php' type='button' class='button btn-color'>Editar perfil</a>
      <a href='saldo.php' type='button' class='button btn-color'>añadir saldo</a>
      ".$data."
    </div>";
    die("</div></body></html>");
  }
?>