<?php
    require_once 'header.php';

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
    //consulta de productos
      $sql2 = mysqli_query($connection, "SELECT * FROM products WHERE code=" . $_GET['id']) or die(mysqli_error($connection));

    echo'
      <div class="container is-fluid">';

        if($loggedin)
        {
          echo'<h3 class="animate__animated animate__lightSpeedInLeft animate__fast">Saldo: <span class="money" style="display:inline-block;"><h3>' . $saldo . '</h3></span>$</h3>';
        }

    echo'
      <div class="columns producto mb-4">
      ';

    while ($f=mysqli_fetch_array($sql2))
    {
      echo'
          <div class="textcard column is-4">
            <br>
            <div class="card">
              <div class="card-image">
                <figure class="image is-4by3">
                  <img src="images/' . $f['img'] . '" class="card-img-top" width="286px" height="190px" alt="Upps, no se ha encontrado la imágen">
                <figure>
              </div>
              <div class="card-content">
                <div class="content">
                  <h5 class="card-title">' . $f['name'] . '</h5>
                  <p class="card-text">' . $f['detalles'] . '</p>
                  <p style="color: green; name="price">$' . $f['price'] . '</p>
                  <p class="card-text" name="stock">stock:' . $f['stock'] . '</p>';
                  if($loggedin){
                    echo'
                    <a href="compra.php?idcompra='.$f['code'].'" type="button" class="button btn-color">Compra ahora!</a>
                    ';
                }
                echo'
                </div>
              </div>
            </div>
          </div>
      ';
    }

    echo'

        </div>
      </div>

      <!-- js bootstrap and jquery -->
      <script src="../js/jquery-3.4.1.js"></script>
      <script src="../js/popper.js"></script>
      <script src="../js/bootstrap.js"></script>

    </body>
    </html>

    ';

    mysqli_close( $connection );

    ?>