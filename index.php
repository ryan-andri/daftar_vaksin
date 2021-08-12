<?php
session_start();
require_once('config/db.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Registrasi Vaksin Covid - 19</title>
    <link href="<?= BASE_URL ?>/css/sb-bootstrap.css" rel="stylesheet" />
    <link href="<?= BASE_URL ?>/css/main.css" rel="stylesheet" />
    <script src="<?= BASE_URL ?>/js/bootstrap.bundle.min.js"></script>
</head>

<?php include_once(BASE_PATH . '/alert.php'); ?>

<body class="d-flex flex-column">
    <main class="flex-shrink-0">
        <div class="container">
            <div class="center">
                <img class="logo-cust" src="<?= BASE_URL ?>/img/rumkit.png" alt="Rumkit">
            </div>
            <div class="row justify-content-center mb-4">
                <div class="text-center">
                    <h3>Registrasi Pelaksanaan Vaksin</h3>
                    <h4><strong>COVID - 19</strong></h4>
                    <div class="m-4">
                        <a data-bs-toggle="modal" data-bs-target="#confirm-check" href="#" class="btn btn-outline-success btn-lg m-2">
                            <span>CEK NIK</span>
                        </a>
                        <a data-bs-toggle="modal" data-bs-target="#confirm-daftar" href="#" class="btn btn-outline-primary btn-lg m-2">
                            <span>DAFTAR</span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Check NIK -->
            <div class="modal fade mt-5" id="confirm-check" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="post_check.php" method="POST">
                        <div class="modal-content">
                            <div class="modal-body">
                                <h4 class="modal-title mb-3">Cek NIK</h4>
                                <input class="form-control" name="nik" type="text" id="nik_check" oninput="trigger(this.id, false);" maxlength="16" placeholder="Masukkan NIK anda" required>
                                <div class="mt-4">
                                    <button type="button" class="btn btn-outline-secondary btn-sm form-control mb-2" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-outline-primary btn-sm form-control" name="check_btn">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Registrasi -->
            <div class="modal fade" id="confirm-daftar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <form action="post_check.php" method="POST">
                        <div class="modal-content">
                            <div class="modal-body">
                                <h4 class="modal-title mb-4">Daftar Vaksin</h4>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label" for="nama"><strong>Nama</strong></label>
                                        <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Anda" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="nik"><Strong>NIK</Strong></label>
                                        <input type="text" name="nik" class="form-control" id="nik_req" oninput="trigger(this.id, false);" maxlength="16" placeholder="Masukkan NIK Anda" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="vaksin_ke"><strong>Vaksin yang ke</strong></label>
                                        <select class="form-select" name="vaksin_ke" id="vaksin_ke" oninput="trigger(this.id, true);" required>
                                            <option value="" selected disabled hidden>...</option>
                                            <option value="satu">1</option>
                                            <option value="dua">2</option>
                                            <option value="tiga">3</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="tgl_target"><strong>Pelaksanaan Vaksin</strong></label>
                                        <input type="date" name="tgl_target" class="form-control" placeholder="Tanggal Ingin Vaksin">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="tgl_vaksin_1"><strong>Tanggal Vaksin ke 1</strong></label>
                                        <input type="date" name="tgl_vaksin_1" id="tgl_vaksin_1" class="form-control" placeholder="Vaksin 1" disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="tgl_vaksin_2"><strong>Tanggal Vaksin ke 2</strong></label>
                                        <input type="date" name="tgl_vaksin_2" id="tgl_vaksin_2" class="form-control" placeholder="Vaksin 2" disabled>
                                    </div>
                                    <div class="col-12 mt-4">
                                        <button type="button" class="btn btn-outline-secondary btn-sm form-control mb-2" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-outline-primary btn-sm form-control" name="daftar_btn">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <footer class="mt-auto py-3 bg-light">
        <div class="container text-center">
            <span class="text-muted">Copyright &copy; SIM Rumkit TK II 02.05.01 dr. AK Gani</span>
        </div>
    </footer>
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