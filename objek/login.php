<?php
  session_start();
  include "koneksi.php" ;

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>SELAMAT DATANG DI OBJEK WISATA YOGYAKARTA</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
  </head>
  <body>
    <nav class="navbar navbar-expand navbar-light bg-light">
      <a class="navbar-brand" href="#">SELAMAT DATANG DI OBJEK WISATA YOGYAKARTA</a>
      
            <a class="nav-link" href="index.php">HOME</a>
          </li>
        </ul>
      </div>
    </nav>
    <div class="container">
      <div class="card mt-4">
        <div class="card-header">Login</div>
        <div class="card-body">
          <form method="post">
            <div class="form-group">
              <label for="username">Username</label>
              <p>masukkan (admin)</p>
              <input type="text" class="form-control" id="username" name="fusername" placeholder="Enter username" />
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <p>masukkan (admin)</p>
              <input type="password" class="form-control" id="password" name="fpassword" placeholder="Enter Password" />
            </div>
            <button type="submit" class="btn btn-primary" name="flogin">Login</button>
          </form>

          <?php

            if(isset($_POST['flogin'])) {
              $username = $_POST['fusername'] ;
              $password = $_POST['fpassword'] ;
              $qry = mysqli_query($koneksi, "SELECT * FROM tlogin WHERE username = '$username' AND password = '$password'") ;
              $cek = mysqli_num_rows($qry) ;
              if($cek == 1) {
                $_SESSION['useradmin'] = $username ;
                header ("location:dashboard.php") ;
                exit;
              }
              else {
                echo "maaf username dan password salah!!!" ;
              }
            }

          ?>

        </div>
      </div>
    </div>
  </body>
</html>
