<?php
session_start();
require_once('config/db.php');

// ambil tanggal dari server langsung aja boi xD
$currentDate = new DateTime("now", new DateTimeZone("Asia/Jakarta"));
$curr_day = $currentDate->format('N');
if ($curr_day == 5) {
  // jum'at lompat 3 hari ke senin
  $cd = date('Y-m-d', strtotime('now +3 day'));
} else if ($curr_day == 6) {
  // sabtu lompat 2 hari ke senin
  $cd = date('Y-m-d', strtotime('now +2 day'));
} else {
  $cd = date('Y-m-d', strtotime('now +1 day'));
}

if (isset($_POST['cek_vaksin'])) {
  $tgl = filter_input(INPUT_POST, 'tgl_target');
  $vaks = filter_input(INPUT_POST, 'vaksin_ke');
  $db = dbInstance();
  $db->where("tgl_vaksin", $tgl);
  if ($db->getValue("pendaftar", "count(*)") >= 100) {
    $_SESSION['quota_habis'] = true;
  } else {
    $_SESSION['tgl_vaksin'] = $tgl;
    $_SESSION['vaksin_ke'] = $vaks;
    header('location: daftarvaksin');
    exit();
  }
}
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <!-- ============ Sweet Alert 2 =================== -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- ============ Main CSS ======================== -->
  <link href="<?= BASE_URL ?>/css/main.css" rel="stylesheet" />
</head>

<body>
  <?php
  if (isset($_SESSION['quota_habis'])) { ?>
    <script type="text/javascript">
      Swal.fire({
        icon: 'error',
        title: 'Kuota Habis!',
        text: 'Silahkan cek pada hari berikutnya.'
      })
    </script>
  <?php unset($_SESSION['quota_habis']);
  } ?>
  <main>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6">
          <div class="card main-card shadow-lg border-0 rounded-lg mt-4 mb-4">
            <div class="card-header text-center">
              <img class="logo-cust" src="<?= BASE_URL ?>/img/rumkit-nama.png" alt="">
            </div>
            <div class="card-body text-center mt-3">
              <div>
                <h5>KETERSEDIAAN VAKSIN</h5>
                <h5><strong>COVID - 19</strong></h5>
              </div>
              <form method="post" class="mt-5">
                <div class="row justify-content-center">
                  <div class="col-lg-6">
                    <label class="form-label" for="tgl_target"><strong>Pelaksanaan Vaksin</strong></label>
                    <input class="form-control" type="date" min="<?= $cd; ?>" max="<?= $cd; ?>" name="tgl_target" id="tgl_target" required>
                  </div>
                </div>
                <div class="row justify-content-center mt-4">
                  <div class="col-lg-6 ">
                    <label class="form-label" for="tgl_target"><strong>Vaksin Ke :</strong></label>
                    <br>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="vaksin_ke" value="1" required>
                      <label class="form-check-label" for="vaksin_ke">Pertama</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="vaksin_ke" value="2" required>
                      <label class="form-check-label" for="vaksin_ke">Kedua</label>
                    </div>
                  </div>
                </div>
                <div class="row justify-content-center mt-4">
                  <div class="col-md-6">
                    <button type="submit" name="cek_vaksin" class="btn btn-success"><i class="fas fa-search fa-sm"></i> Cek Ketersediaan</button>
                  </div>
                </div>
              </form>

              <h6 class="mt-5 text-danger">*Vaksinasi hanya untuk umur 12 Tahun ke atas</h6>

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
</body>

</html>