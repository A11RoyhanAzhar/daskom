<?php
  include "koneksi.php" ;

  //Jika tombol simpan diklik (datanya sudah diisi)
  if(isset($_POST['bsimpan'])){
    //Pengujian apakah data akan diedit atau disimpan
    if($_GET['hal'] ==  "edit") {
      //Data akan diedit
      $edit = mysqli_query($koneksi, "UPDATE tlogin2 set  tempat = '$_POST[tnama]' , lokasi = '$_POST[tlokasi]' ,foto = '$_POST[tfoto]' WHERE  id = '$_GET[id]' ");
      //Jika editnya sukses
      if($edit) {
        echo "<script>
              alert ('Edit Data Sukses!') ;
              document.location='dashboard.php';
        </script>" ;

      }
      else {
        echo "<script>
              alert ('Edit Data Gagal!') ;
              document.location='dashboard.php';
        </script>" ;
      }
    }
    //Data akan disimpan
      else {
      $simpan = mysqli_query($koneksi, "INSERT INTO tlogin2 (tempat, lokasi, foto) 
          VALUES ('$_POST[tnama]' , '$_POST[tlokasi]' , '$_POST[tfoto]')") ;
      //Jika berhasil disimpan
    if($simpan) {
      echo "<script>
              alert ('Simpan Data Sukses!') ;
              document.location='dashboard.php';
        </script>" ;
      }
      else{
        echo "<script>
              alert ('Simpan Data Gagal!') ;
              document.location='dashboard.php';
        </script>" ;
      }
    }
  }

  // Pengujian tombol Edit/Delete
  if(isset($_GET['hal'])) {

      //Pengujian jika edit data
      if($_GET['hal'] == "edit"){
          //Tampilkan data yang akan diedit
          $tampil = mysqli_query($koneksi, "SELECT * FROM tlogin2 WHERE id = '$_GET[id]' ") ;
          $data = mysqli_fetch_array($tampil) ;

          //Jika data ditemukan, maka data di tampung
          if($data) {
            $vtempat = $data['tempat'] ;
            $vlokasi = $data['lokasi'] ;
            $vfoto = $data['foto'] ;
            
          }
      }
      //Persiapan hapus data
      else if ($_GET['hal'] == "hapus") {
        $hapus = mysqli_query($koneksi, "DELETE FROM tlogin2 WHERE id = '$_GET[id]' ") ;
        if($hapus){
          echo "<script>
              alert ('Hapus Data Sukses!') ;
              document.location='dashboard.php';
        </script>" ;
        }
      }
  }

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
      <a class="navbar-brand" href="#">SELAMAT DATANG DI TEMPAT WISATA YOGYAKARTA</a>

      <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
          
          <li class="nav-item">
            <a class="nav-link" href="index.php">Logout</a>
          </li>
        </ul>
      </div>
    </nav>
    <div class="container">
      <div class="card mt-4">
        <div class="card-header">Data Admin</div>
        <div class="card-body">

        <form method="post">
            
            <div class="form-group">
              <label>Nama Tempat Wisata</label>
              <select class="form-control" id="Nama Tempat Wisata" name="tnama">
              <option value="<?=@$vnama?>"><?=@$nama?></option>
                  <option value="Kaliurang"> Kaliurang </option>
                  <option value="Taman Pelangi"> Taman Pelangi </option>
                  <option value="Malioboro"> Malioboro </option>
                  <option value="Pantai Parangtritis"> Pantai Parangtritis </option>
                  <option value="Kraton Yogyakarta"> Kraton Yogyakarta </option>
                  <option value="Tugu Yogyakarta"> Tugu Yogyakarta </option>

              </select>
            </div>
            <div class="form-group">
              <label>Lokasi Wisata</label>
              <select class="form-control" id="Lokasi Wisata" name="tlokasi">
              <option value="<?=@$vlokasi?>"><?=@$lokasi?></option>
                  <option value="Yogyakarta"> Yogyakarta</option>
            </select>
            </div>
            <div class="form-group">
              <label>Foto</label>
              <input type="file" class="form-control" id="Foto" name="tfoto" value = "<?=@$vfoto?>" placeholder="Unggah Foto!" required>
            </div>

            <button type="submit" class="btn btn-primary" name="bsimpan">Simpan</button>
            <button type="reset" class="btn btn-danger" name="briset">Reset</button>
          </form>

          <table class="table mt-4">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nama Tempat Wisata</th>
                <th>Lokasi Wisata</th>
                <th>Foto</th>
                
              </tr>
            </thead>

            <?php

            $no = 1;
            $tampil = mysqli_query($koneksi, "SELECT * FROM tlogin2 ORDER BY id DESC") ;
            while($data = mysqli_fetch_array($tampil)) :

            ?>

            <tbody>
              <tr>
                <td><?=$no++;?></td>
                <td><?=$data['tempat']?></td>
                <td><?=$data['lokasi']?></td>
                <td><?=$data['foto']?></td>
                
                <td>
                  <a href="dashboard.php?hal=edit&id=<?=$data['id']?>" class="btn btn-sm btn-info">Edit</a>
                  <a href="dashboard.php?hal=hapus&id=<?=$data['id']?>"class="btn btn-sm btn-danger">Delete</a>
                </td>
              </tr>
              
            </tbody>

            <?php endwhile ; // Penutup perulangan while ?>

          </table>
        </div>
      </div>
    </div>
  </body>
</html>
