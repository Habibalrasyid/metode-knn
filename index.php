<?php
require_once('functions.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>K-Nearest Neighbor (KNN)</title>

  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/icons/bootstrap-icons.css">
  <link rel="shortcut icon" href="assets/img/KNN_logo.jpg">
  <script src="assets/js/bootstrap.bundle.min.js"></script>
</head>

<body>
  <div class="container">
    <section class="jumbotron text-center text-white bg-dark">
      <img src="assets/img/knn.png" alt="Jumbotron img" width="200" class="rounded-circle img-thumbnail">
      <h1 class="" font face="lucida">Habib Alrasyid</h1>
      <h4 class="" >2019503008</h4>
      <p class="lead">K-Nearest Neighbor</p>
      <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
          <b>Cara Pakai</b>
        </button>
      </svg> 
    </section>
    <div class="row justify-content-center">
      <div class="col-auto">
        <!-- Button trigger modal -->
        

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Penggunaan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                contoh data:<br>
                X Y Kategori<br>
                7,6,Tidak Bagus,<br>
                6,6,Tidak Bagus,<br>
                6,5,Tidak Bagus,<br>
                1,3,Bagus,<br>
                2,4,Bagus,<br>
                2,2,Bagus,
                <hr>
                3 5 ?
                <br><br>
                Aturan:<br>
                -Data Training harus dibuat menjadi seperti ini (gunakan "," untuk memisah per-atribut dan gunakan ";" untuk memisah per-data)<br>
                7,6,Tidak Bagus;6,6,Tidak Bagus;6,5,Tidak Bagus;1,3,Bagus;2,4,Bagus;2,2,Bagus<br><br>

                -Data Testing<br>
                Data Testing harus dibuat menjadi seperti ini (gunakan "," untuk memisah per-atribut)<br>
                3,5<br>-nilai K itu terserah, K adalah kunci untuk mencari/mengurutkan<br>
                <br>
                *Kesalahan ditanggung oleh yang menginputkan<br>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <hr>
    <hr>
    <form action="" method="post">
      <!-- <input type="text" name="n" required> -->
      <div class="input-group mb-3 w-25">
        <span class="input-group-text" id="basic-addon1">K</span>
        <input name="kdm" required type="number" class="form-control" placeholder="K" value="<?= isset($kdm) ? $kdm : ''; ?>" aria-label="K" aria-describedby="basic-addon1">
      </div>
      <div class="form-floating mb-3">
        <textarea name="dtraining" class="form-control" placeholder="Data Training" id="floatingTextarea2" style="height: 100px" required><?= isset($dtraining) ? $_POST['dtraining'] : "7,6,Tidak Bagus;6,6,Tidak Bagus;6,5,Tidak Bagus;1,3,Bagus;2,4,Bagus;2,2,Bagus"; ?></textarea>
        <label for="floatingTextarea2">Data Training</label>
      </div>
      <div class="form-floating mb-1 w-25">
        <input name="dtesting" required type="text" class="form-control" id="floatingInput" placeholder="Data Testing" value="<?= isset($dtesting) ? $dtesting[0] . "," . $dtesting[1] : '3,5'; ?>">
        <label for="floatingInput">Data Testing</label>
      </div>
      <button name="submit" class="btn btn-primary mb-1 mt-2 p-1" type="submit">Simpan</button>
      <a href="" class="btn btn-danger mb-1 mt-2 p-1">Reset</a>
    </form>

    <hr>
    <div class="row justify-content-center">
      <?php
      // dtraining
      if (isset($_POST['submit'])) {
        echo "<div class=\"col-auto\">
        <table class=\"table table-responsive table-striped w-25 table-bordered\">
          <tr>
            <th>No</th>
            <th>X</th>
            <th>Y</th>
            <th>Kategori</th>
          </tr>";
        foreach ($dtraining as $k => $v) {
          echo "<tr>
            <td>", $k + 1, "</td>
            <td>", $v[0], "</td>
            <td>", $v[1], "</td>
            <td>", $v[2], "</td>
          </tr>";
        }
        echo "
        </table>
        </div>";
      }
      // get distance
      if (isset($_POST['submit'])) {
        echo "<div class=\"col-auto\">
        <table class=\"table table-responsive table-striped  w-25 table-bordered\">
          <tr>
            <th>No</th>
            <th>Distance</th>
          </tr>";
        foreach ($dtraining as $k => $v) {
          $distance[] = getDistance($v, $dtesting);
          echo "<tr>
            <td>", $k + 1, "</td>
            <td>", $distance[$k], "</td>
          </tr>";
        }
        echo "
        </table>
        </div>";
      }
      // kdm
      if (isset($_POST['submit'])) {
        if ($kdm == 0) {
          echo "<div class=\"col-auto\">
        <table class=\"table table-responsive table-striped  w-25 table-bordered\">
          <tr>
            <th>No</th>
            <th>k1</th>
          </tr>";
          foreach ($dtraining as $k => $v) {
            if ($distance[$k] == min($distance)) {
              echo "<tr>
            <td>", $k + 1, "</td>
            <td>", $v[2], "</td>
          </tr>";
            } else {
              echo "<tr>
            <td>", $k + 1, "</td>
            <td></td>
          </tr>";
            }
          }
          echo "
        </table>
        </div>
    //     <svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 1440 320\">
    //   <path fill=\"#0dcaf0\" fill-opacity=\"1\" d=\"M0,96L48,128C96,160,192,224,288,218.7C384,213,480,139,576,128C672,117,768,171,864,170.7C960,171,1056,117,1152,112C1248,107,1344,149,1392,170.7L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z\"></path>
    // </svg>";
        } else {
          echo "
      <div class=\"col-auto\">
        <table class=\"table table-responsive table-striped  w-25 table-bordered\">
          <tr>
            <th>No</th>
            <th>k", $kdm, "</th>
          </tr>";
          $hitung = array_values($distance);
          for ($i = 0; $i < $n; $i++) {
            // test2 berisi index
            $test[$i] = min($hitung);
            $test2[$i] = array_search($test[$i], $hitung);
            unset($hitung[$test2[$i]]);
            // array_splice($hitung, $test2[$i], 1); // gagal
            if ($i == $kdm) {
              $j = $i;
              while ($j < $n) {
                $test2[$j] = null;
                $j++;
              }
              break;
            }
          }
          $urut = urutkan($test2, $n);
          foreach ($dtraining as $k => $v) {
            if (!is_null($urut[$k])) {
              echo "<tr>
            <td>", $k + 1, "</td>
            <td>", $v[2], "</td>
          </tr>";
            } else {
              echo "<tr>
            <td>", $k + 1, "</td>
            <td></td>
          </tr>";
            }
          }
          echo "
        </table>
        </div>
        ";
        }
      }
      ?>
    </div>
  </div>
</body>

</html>