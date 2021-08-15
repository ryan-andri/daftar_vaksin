<?php
session_start();
require_once('config/db.php');

// redirect jika tidak ada sesi id
if (!$_SESSION['id']) {
  header('location:' . BASE_URL);
  exit();
}

// oh boii
$db = dbInstance();
$db->where("id", $_SESSION['id']);
$data = $db->getOne("pendaftar");
if ($data == null) {
  header('location:' . BASE_URL);
  exit();
}

// prefix 00*
$antrian = sprintf("%04d", $data['antrian']);

if (isset($_POST['btn_batal'])) {
  $db->where("id", $_SESSION['id']);
  if ($db->delete('pendaftar')) {
    session_destroy();
    header('location:' . BASE_URL);
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
                      <h3><strong>V<?= $data['vaksin_ke']; ?>-<?= $antrian; ?></strong></h3>
                    </div>
                  </div>
                </div>
                <div class="col-md-8">
                  <h3 class="mt-2"><?= $data['nama']; ?></h3>
                  <hr>
                  <div class="row">
                    <div class="col-md-6">
                      <i class="far fa-clock me-2"></i> 08:00 - Selesai
                      <br>
                      <i class="fas fa-syringe mt-3 me-3"></i> Vaksin ke - <?= $data['vaksin_ke']; ?>
                    </div>
                    <div class="col-md-6">
                      <i class="far fa-calendar-alt"></i>
                      <?= date('d M Y', strtotime($data['tgl_vaksin'])); ?>
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
                  <form method="post">
                    <button name="btn_batal" class="btn btn-warning">Batalkan Antrian</button>
                  </form>
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