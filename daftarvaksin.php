<?php
session_start();
require_once('config/db.php');

if (!$_SESSION['tgl_vaksin'] || !$_SESSION['vaksin_ke']) {
  header('location:' . BASE_URL);
  exit();
}

$db = dbInstance();
$db->where("tgl_vaksin", $_SESSION['tgl_vaksin']);

// quota
$quota = $db->getValue("pendaftar", "count(*)");

if (isset($_POST['daftar'])) {
  $input = filter_input_array(INPUT_POST);

  $db->where("nik", $input['nik']);
  $db->getOne("pendaftar");
  if ($db->count > 0) {
    // bersihkan sesi
    unset($_SESSION['vaksin_ke']);
    unset($_SESSION['tgl_vaksin']);
    $_SESSION['nik_exist'] = true;
    header('location:' . BASE_URL);
    exit();
  } else {
    $db->where("tgl_vaksin", $_SESSION['tgl_vaksin']);
    if (($db->getValue("pendaftar", "count(*)") + 1) > 100) {
      $_SESSION['quota_habis'] = true;
      // bersihkan sesi
      unset($_SESSION['vaksin_ke']);
      unset($_SESSION['tgl_vaksin']);
      header('location: cekvaksin');
      exit();
    }
    $data = array(
      'nik'     =>  $input['nik'],
      'nama'      =>  $input['nama'],
      'vaksin_ke'    =>  $_SESSION['vaksin_ke'],
      'tgl_vaksin'         =>  $_SESSION['tgl_vaksin'],
      'alamat'         =>  $input['alamat'],
      'no_hp'        =>  $input['no_hp'],
      'antrian'        =>  $db->getValue("pendaftar", "count(*)") + 1
    );
    $result = $db->insert('pendaftar', $data);
    if ($result) {
      // bersihkan sesi
      unset($_SESSION['vaksin_ke']);
      unset($_SESSION['tgl_vaksin']);
      // Pass id ke sesi berikutnya
      $_SESSION['id'] = $result;
      header('location: buktiantrian');
      exit();
    } else {
      $_SESSION['error'] = true;
      header('location:' . BASE_URL);
      exit();
    }
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
                <h5>PENDAFTARAN VAKSIN</h5>
                <h5><strong>COVID - 19</strong></h5>
              </div>
              <form method="post" class="mt-5">
                <div class="row">
                  <div class="col-md-6">
                    <!-- NIK -->
                    <label for="nik" class="form-label mt-3"><strong>Nik</strong></label>
                    <input type="text" name="nik" id="nik" maxlength="16" pattern="[0-9]{16,16}" oninput="numberOnly(this.id);" class="form-control" required>
                    <!-- Nama -->
                    <label for="nama" class="form-label mt-3"><strong>Nama</strong></label>
                    <input type="text" name="nama" class="form-control" required>
                    <!-- Alamat -->
                    <label for="alamat" class="form-label mt-3"><strong>Alamat</strong></label>
                    <input type="text" name="alamat" class="form-control" required>
                  </div>
                  <div class="col-md-6">
                    <!-- No HP -->
                    <label for="no_hp" class="form-label mt-3"><strong>No HP</strong></label>
                    <input type="text" name="no_hp" id="no_hp" maxlength="13" pattern="[0-9]{12,13}" oninput="numberOnly(this.id);" class="form-control" required>
                    <!-- Jenis Kelamin -->
                    <label class="form-label mt-3" for="jenis_kelamin"><strong>Jenis Kelamin</strong></label>
                    <select class="form-select" name="jenis_kelamin" required>
                      <option value="" selected disabled hidden>...</option>
                      <option value="Laki - Laki">Laki - Laki</option>
                      <option value="Perempuan">Perempuan</option>
                    </select>
                    <button type="submit" class="btn btn-success form-control mt-5" name="daftar">DAFTAR</button>
                  </div>
                </div>
              </form>
            </div>
            <br>
            <div class="info-vaksin text-center mt-5 mb-4">
              <h5>Vaksin ke - <?= $_SESSION['vaksin_ke']; ?></h5>
              <h6>tanggal : <?= date('d M Y', strtotime($_SESSION['tgl_vaksin'])); ?></h6>
              <h6>pukul : 08:00 - Selesai</h6>
              <h6>Sisa Kuota : <?= (100 - $quota); ?></h6>
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
    function numberOnly(id) {
      var ids = document.getElementById(id);
      ids.value = ids.value.replace(/[^0-9]/gi, "");
    }
  </script>
</body>

</html>