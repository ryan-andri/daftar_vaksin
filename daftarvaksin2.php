<?php
session_start();
require_once('config/db.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrasi Vaksin Covid - 19</title>
  <!-- ============ CDN FontAwesome ================= -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- ============ Bootstrap 5 ===================== -->
  <link href="<?= BASE_URL ?>/css/sb-bootstrap.css" rel="stylesheet" />
  <script src="<?= BASE_URL ?>/js/bootstrap.bundle.min.js"></script>
  <!-- ============ Sweet Alert 2 =================== -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- ============ Main CSS ======================== -->
  <link href="<?= BASE_URL ?>/css/main.css" rel="stylesheet" />
</head>

<body>
  <main>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6">
          <div class="card main-card shadow-lg border-0 rounded-lg mt-4 mb-4">
            <div class="card-header text-center">
              <img class="logo-cust" src="<?= BASE_URL ?>/img/rumkit-nama.png" alt="">
            </div>
            <div class="card-body text-center mt-3">
              <div class="judul text-center">
                <h5>PENDAFTARAN VAKSIN</h5>
                <h5><strong>COVID - 19</strong></h5>
              </div>
              <form action="" method="post" class="mt-5">
                <div class="row">
                  <div class="col-md-6">
                    <label for="inputPassword5" class="form-label">NIK</label>
                    <input type="password" id="inputPassword5" class="form-control" aria-describedby="passwordHelpBlock">
                    <label for="inputPassword5" class="form-label mt-3">NAMA</label>
                    <input type="password" id="inputPassword5" class="form-control" aria-describedby="passwordHelpBlock">
                    <div class="jenis-kelamin mt-3">
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                        <label class="form-check-label" for="inlineRadio1">Laki-Laki</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                        <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                      </div>
                    </div>
                    <label for="inputPassword5" class="form-label mt-3">TEMPAT LAHIR</label>
                    <input type="password" id="inputPassword5" class="form-control" aria-describedby="passwordHelpBlock">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label" for="tgl_target">TANGGAL LAHIR</label>
                    <input type="date" name="tgl_target" class="form-control" placeholder="Tanggal Ingin Vaksin">
                    <label for="inputPassword5" class="form-label mt-3">NOMOR HP AKTIF</label>
                    <input type="password" id="inputPassword5" class="form-control" aria-describedby="passwordHelpBlock">

                    <a href="buktiantrian.php" type="submit" class="btn btn-success mt-5">DAFTAR</a>
                  </div>
                </div>
              </form>
            </div>
            <br>
            <div class="info-vaksin text-center mt-5 mb-4">
              <h6>Vaksin ke-2</h6>
              <h6>tanggal : Senin, 16 Agu 2021</h6>
              <h6>pukul : 08:00 - Selesai</h6>
              <h6>Sisa Kuota : 1000</h6>
            </div>
            <div class="card-footer text-center py-3">
              <div class="text-muted small">Copyright &copy; SIM Rumkit TK II 02.05.01 dr. AK Gani</div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </main>


  <script>
    function trigger(id, disable) {
      var ids = document.getElementById(id);
      if (!disable) {
        ids.value = ids.value.replace(/[^0-9]/gi, "");
        return;
      }
      var v1 = document.getElementById("tgl_vaksin_1");
      var v2 = document.getElementById("tgl_vaksin_2");
      switch (ids.value) {
        case "":
        case "satu":
          v1.disabled = true;
          v1.required = false;
          v2.disabled = true;
          v2.required = false;
          break;
        case "dua":
          v1.disabled = false;
          v1.required = true;
          v2.disabled = true;
          v2.required = false;
          break;
        case "tiga":
          v1.disabled = false;
          v1.required = true;
          v2.disabled = false;
          v2.required = true;
          break;
      }
      // bersihkan nilai setiap trigger
      v1.value = null;
      v2.value = null;
    }
  </script>
</body>

</html>