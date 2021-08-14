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
                <h5>BERIKUT NOMOR ANTRIAN ANDA</h5>
              </div>

              <div class="card">
                <div class="card-body">
                  SILAHKAN SCREENSHOT ATAU DOWNLOAD PDF YANG TELAH DISEDIAKAN
                </div>
              </div>

              <div class="row mt-5">
                <div class="col-md-4">
                  <h6><strong>Nomor Antrian Anda</strong></h6>
                  <div class="card bg-success text-white">
                    <div class="card-body">
                      <h3><strong>V20023</strong></h3>
                    </div>
                  </div>
                </div>
                <div class="col-md-8">
                  <h3>DIKA JULIANTO</h3>
                  <hr>
                  <div class="row">
                    <div class="col-md-6">
                      <i class="far fa-clock"></i>
                      PUKUL : 07:00 - 08:00 WIB
                      <br>
                      <i class="fas fa-syringe mt-3"></i>
                      Vaksin ke 2
                    </div>
                    <div class="col-md-6">
                      <i class="far fa-calendar-alt"></i>
                      Jumat, 13 Agu 2021
                    </div>
                  </div>

                </div>
              </div>

              <h6 class="text-danger mt-5">*Diharapkan datang 30 menit sebelum jadwal yang ditentukan</h6>

              <div class="row mt-5 rounded">
                <div class="col-md-6">
                  <a href="#" class="btn btn-success">Download Tiket</a>
                </div>
                <div class="col-md-6">
                  <a href="index2.php" class="btn btn-warning">Batalkan Antrian</a>
                </div>
              </div>

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