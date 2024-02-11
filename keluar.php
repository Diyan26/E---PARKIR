<?php
session_start();
include "koneksi.php";

// Pencarian data kendaraan
if (isset($_POST['cari_kendaraan'])) {
    $no_kendaraan = $_POST['no_kendaraan'];

    $result = query("SELECT * FROM terparkir WHERE NoPlat = '$no_kendaraan'");
    $totalData = mysqli_num_rows($result);
        
    if ($totalData == 1) {
        $obj = mysqli_fetch_object($result);
        $tampil = true;

        // Mengambil data yang ditemukan dari database
        $noPlat = isset($obj->NoPlat) ? $obj->NoPlat : '';
        $waktuMasuk = isset($obj->WaktuMasuk) ? $obj->WaktuMasuk : '';
        $merek = isset($obj->Merek) ? $obj->Merek : '';
        $keterangan = isset($obj->Keterangan) ? $obj->Keterangan : '';

        // Mendapatkan waktu keluar saat ini
        $waktu_keluar = date('Y-m-d H:i:s');
    } else {
        $_SESSION['notif'] = "Tidak ada data ditemukan";
        header("Location: ./keluar.php");
        exit(); // Menghentikan eksekusi skrip
    }
}

// Proses keluar parkir
if (isset($_POST['selesaikan'])) {
  // Mengambil data dari formulir
  $noPlat = $_POST['noPlat'];
  $waktuMasuk = $_POST['waktuMasuk'];
  $waktuKeluar = $_POST['waktuKeluar'];
  $merek = $_POST['merek'];
  $keterangan = $_POST['keterangan'];

  // Menyimpan data ke dalam tabel ParkirKeluar
  $query_insert = "INSERT INTO parkirkeluar (NoPlat, WaktuMasuk, WaktuKeluar, Merek, Keterangan) VALUES ('$noPlat', '$waktuMasuk', '$waktuKeluar', '$merek', '$keterangan')";
  $result_insert = query($query_insert);

  if ($result_insert) {
      // Menghapus data dari tabel terparkir
      $query_delete = "DELETE FROM terparkir WHERE NoPlat = '$noPlat'";
      $result_delete = query($query_delete);

      if ($result_delete) {
          // Redirect ke halaman tabelmasuk.php dengan notifikasi sukses
          $_SESSION['notif'] = "Data parkir berhasil disimpan dan dihapus dari tabel masuk.";
          header("Location: ./tabelmasuk.php");
          exit(); // Menghentikan eksekusi skrip
      } else {
          // Redirect ke halaman tabelmasuk.php dengan notifikasi error
          $_SESSION['notif'] = "Gagal menghapus data dari tabel masuk.";
          header("Location: ./tabelmasuk.php");
          exit(); // Menghentikan eksekusi skrip
      }
  } else {
      // Redirect ke halaman tabelmasuk.php dengan notifikasi error
      $_SESSION['notif'] = "Gagal menyimpan data parkir.";
      header("Location: ./tabelmasuk.php");
      exit(); // Menghentikan eksekusi skrip
  }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>E - PARKIR - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet" />
  </head>

  <body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
      <!-- Sidebar -->
      <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
          <div class="sidebar-brand-icon">
            <img src="img/park_898366.png" alt="Logo" style="width: 50px" />
          </div>
          <div class="sidebar-brand-text mx-3">E - PARKIR</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0" />

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
          <a class="nav-link" href="dashboard.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a
          >
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider" />

        <!-- Heading -->
        <div class="sidebar-heading">MASTER DATA</div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-folder"></i>
            <span>PARKIR</span>
          </a>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">KELUAR AND MASUK</h6>
              <a class="collapse-item" href="masuk.php"> <i class="fas fa-sign-in-alt"></i> MASUK </a>
              <a class="collapse-item" href="keluar.php"> <i class="fas fa-sign-out-alt"></i> KELUAR </a>
              <a class="collapse-item" href="tabelmasuk.php"> <i class="fas fa-clipboard-list  "></i> DATA MASUK </a>
              <a class="collapse-item" href="tabelkeluar.php"> <i class="fas fa-clipboard-list  "></i> DATA KELUAR </a>
            </div>
          </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block" />

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
          <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

        <!-- Sidebar Message -->
        <div class="sidebar-card d-none d-lg-flex">
          <p class="text-center mb-2"><strong>E - PARKIR</strong> Welcome Back</p>
        </div>
      </ul>
      <!-- End of Sidebar -->

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
          <!-- Topbar -->
          <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
              <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
              <!-- Nav Item - Search Dropdown (Visible Only XS) -->
              <li class="nav-item dropdown no-arrow d-sm-none">
                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-search fa-fw"></i>
                </a>
                <!-- Dropdown - Messages -->
                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                  <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                      <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                      <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                          <i class="fas fa-search fa-sm"></i>
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </li>

              <!-- Nav Item - User Information -->
              <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                  <img class="img-profile rounded-circle" src="img/undraw_profile.svg" />
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                  </a>
                </div>
              </li>
            </ul>
          </nav>
          <!-- End of Topbar -->

          <!-- Begin Page Content -->
          <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">KENDARAAN KELUAR</h1>
            </div> 
        
            <!-- Approach -->
            <div class="card shadow mb-5">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Masukkan Data Parkir Keluar</h6>
                </div>
                <div class="card-body">
            <!-- Tampilan cari kendaraan -->
            <?php if (!isset($tampil)) { ?>
              <div class="container">
                  <div class="row justify-content-center">
                      <div class="col-md-6">
                          <div class="card">
                              <div class="card-body">
                                  <h5 class="card-title">Cari Kendaraan</h5>
                                  <form action="" method="post">
                                      <div class="mb-3">
                                          <label for="no_kendaraan" class="form-label">No Kendaraan</label>
                                          <input type="text" class="form-control" id="no_kendaraan" name="no_kendaraan" required>
                                      </div>
                                      <div class="mb-3">
                                          <label for="waktu_keluar" class="form-label">Waktu Keluar</label>
                                          <input type="text" class="form-control" id="waktu_keluar" name="waktu_keluar" readonly>
                                      </div>
                                      <input type="hidden" name="cari_kendaraan">
                                      <button type="submit" class="btn btn-primary">Cari Kendaraan</button>
                                  </form>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
            <script>
                // Function untuk mengisi nilai waktu keluar otomatis dengan waktu saat ini
                function updateWaktuKeluar() {
                    var now = new Date();
                    var year = now.getFullYear();
                    var month = (now.getMonth() + 1).toString().padStart(2, '0');
                    var day = now.getDate().toString().padStart(2, '0');
                    var hours = now.getHours().toString().padStart(2, '0');
                    var minutes = now.getMinutes().toString().padStart(2, '0');
                    var seconds = now.getSeconds().toString().padStart(2, '0');

                    var formattedDateTime = year + '-' + month + '-' + day + ' ' + hours + ':' + minutes + ':' + seconds;

                    // Isi nilai input waktu keluar dengan waktu saat ini
                    document.getElementById('waktu_keluar').value = formattedDateTime;
                }

                // Set nilai waktu keluar otomatis ketika halaman dimuat
                updateWaktuKeluar();

                // Update waktu keluar setiap detik
                setInterval(updateWaktuKeluar, 1000);
            </script>
            <?php } ?>


                <!-- Tampilan ketika kendaraan ditemukan -->
                <?php if (isset($tampil)) { ?>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card border-secondary">
                                <div class="card-header bg-secondary text-white">
                                    <h5 class="text-center mb-0">STRUK KELUAR</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item"><strong>No Plat:</strong> <?= $noPlat ?></li>
                                                <li class="list-group-item"><strong>Waktu Masuk:</strong> <?= $waktuMasuk ?></li>
                                                <!-- Tampilkan waktu keluar yang dikirimkan dari form pencarian -->
                                                <li class="list-group-item"><strong>Waktu Keluar:</strong> <?= $_POST['waktu_keluar'] ?></li>
                                                <li class="list-group-item"><strong>Merek:</strong> <?= $merek ?></li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <img src="<?= $keterangan ?>" alt="Gambar Kendaraan" class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-secondary text-center">
                                    <form action="" method="post">
                                        <input type="hidden" name="noPlat" value="<?= $noPlat ?>">
                                        <input type="hidden" name="waktuMasuk" value="<?= $waktuMasuk ?>">
                                        <!-- Gunakan nilai waktu keluar yang dikirimkan dari form pencarian -->
                                        <input type="hidden" name="waktuKeluar" value="<?= $_POST['waktu_keluar'] ?>">
                                        <input type="hidden" name="merek" value="<?= $merek ?>">
                                        <input type="hidden" name="keterangan" value="<?= $keterangan ?>">
                                        <button type="submit" name="selesaikan" class="btn btn-danger">Keluar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
        </div>
        
        <!-- End of Main Content -->

      </div>
      <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

      <!-- Logout Modal-->
      <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Anda yakin Ingin Logout?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="login.php">Logout</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
  </body>
</html>
