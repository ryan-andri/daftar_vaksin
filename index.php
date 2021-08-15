<?php
session_start();
require_once('config/db.php');

if (isset($_POST['btn_cari'])) {
  $db = dbInstance();
  $nik = filter_input(INPUT_POST, 'nik');
  $db->where("nik", $nik);
  $data = $db->getOne("pendaftar");
  if ($db->count > 0) {
    $_SESSION['id'] = $data['id'];
    header('location: buktiantrian');
  } else {
    header('location: cekvaksin');
  }
  exit();
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
  if (isset($_SESSION['nik_exist'])) { ?>
    <script type="text/javascript">
      Swal.fire({
        icon: 'error',
        title: 'NIK Sudah Terdaftar',
        text: 'Silahkan cek pada halaman utama.'
      })
    </script>
  <?php unset($_SESSION['nik_exist']);
  } ?>
  <?php
  if (isset($_SESSION['error'])) { ?>
    <script type="text/javascript">
      Swal.fire({
        icon: 'error',
        title: 'Terjadi Kesalahan Internal!'
      })
    </script>
  <?php unset($_SESSION['error']);
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
                <h5>REGISTRASI PELAKSANAAN VAKSIN</h5>
                <h5><strong>COVID - 19</strong></h5>
              </div>
              <form method="post" class="mt-5">
                <div class="input-group rounded">
                  <input type="text" class="form-control rounded text-center me-2" name="nik" id="nik" oninput="numberOnly(this.id);" maxlength="16" pattern="[0-9]{16,16}" placeholder="Masukkan NIK Anda" required />
                  <button type="submit" name="btn_cari" class="btn btn-success rounded"><i class="fas fa-search fa-sm"></i></button>
                </div>
              </form>
              <h6 class="mt-5">Belum Mendaftar ? Silahkan Mendaftar</h6>
              <a href="<?= BASE_URL ?>/cekvaksin" class="btn btn-success mt-2">DAFTAR</a>
              <div class="card mt-5 bg-success border-3 border-dark">
                <div class="card-body p-3 text-start text-white">
                  <ol>
                    <li class="mt-2">untuk vaksinsasi dosis ke 1 menyesuaikan ketersediaan stock</li>
                    <li class="mt-2">Pelaksanaan Vaksin Dosis ke 2 tetap mengikut jadwal pada Kartu Vaksinasi</li>
                    <li class="mt-2">Vaksinasi dosis kedua hanya untuk pasien dosis kesatu yang di RS TK. II 02.05.01 dr. AK Gani</li>
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
    function numberOnly(id) {
      var ids = document.getElementById(id);
      ids.value = ids.value.replace(/[^0-9]/gi, "");
    }
  </script>
</body>

</html>