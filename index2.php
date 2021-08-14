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
                <h5>REGISTRASI PELAKSANAAN VAKSIN</h5>
                <h5><strong>COVID - 19</strong></h5>
              </div>
              <form action="#" method="post" class="mt-5">
                <div class="row g-2">
                  <div class="col-sm-10 col-10">
                    <div class="form-floating mb-3">
                      <input class="form-control" id="inputEmail" type="email" placeholder="Nik" />
                      <label for="inputEmail">Masukan NIK untuk cek nomor antrian</label>
                    </div>
                  </div>
                  <div class="col-md-2 col-2 ">
                    <button type="submit" class="btn btn-lg btn-success button-cari mt-2"><i class="fas fa-search fa-sm"></i>
                      Cari</button>
                  </div>
                </div>
              </form>
              <h6 class="mt-5">Belum Mendaftar ? Silahkan Mendaftar</h6>
              <a href="cekvaksin.php" class="btn btn-success mt-2">DAFTAR</a>

              <div class="card mt-5 bg-success border-3 border-dark">
                <div class="card-body p-3 text-start text-white">
                  <ol>
                    <li class="mt-2">untuk vaksinsasi dosis ke 1 menyesuaikan ketersediaan stock</li>
                    <li class="mt-2">Pelaksanaan Vaksin Dosis ke 2 tetap mengikut jadwal pada Kartu Vaksinasi</li>
                    <li class="mt-2">Vaksinasi dosis kedua hanya untuk pasien dosis kesatu yang di RS Bhayangkara Mohamad Hasan Palembang</li>
                  </ol>
                </div>
              </div>
              <div class="row justify-content-center info-vaksin mt-5">
                <div class="col-md-6 text-center">
                  <i class="far fa-clock fa-lg"></i>
                  <h6 class="mt-4">Senin - Jumat</h6>
                  <h6 class="mt-4">08:00 - Selesai</h6>
                  <h6 class="mt-4">Tidak Termasuk Hari Libur Nasional</h6>
                </div>
                <div class="col-md-6 text-center">
                  <i class="fas fa-syringe fa-lg"></i>
                  <h6 class="mt-4">Jenis Vaksin :</h6>
                  <h6 class="mt-4">Vaksin Pertama : Sinovac</h6>
                  <h6 class="mt-4">Vaksin kedua : Sinovac</h6>
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