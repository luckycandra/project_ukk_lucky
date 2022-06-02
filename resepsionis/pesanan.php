<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>LEGEND HOTEL</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
</head>
<body class="hold-transition layout-top-nav layout-navbar-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
      <div class="container">
        <a href="" class="navbar-brand">
        
        <h1 class="m-0">LEGEND HOTEL</h1>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

<div class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
          <!-- Left navbar links -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a href="index.php" class="nav-link"><b>Dashboard</b></a>
            </li>
            <li class="nav-item">
              <a href="pesanan.php" class="nav-link"><b>Pesanan</b></a>
            </li>
          </ul>
          <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
          <!-- Messages Dropdown Menu -->
            <ul class="navbar-nav">
              <li class="nav-item">
                <a href="logout.php" class="nav-link"><b>Logout</b></a>
              </li>
            </ul>
          </ul>  
        </div>
      </div>
    </nav>
    <!-- /.navbar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Pesanan</h1>
            </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <form class="form-inline ml-0 ml-md-3">
                  <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" id="myInput" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                      <button class="btn btn-navbar" type="submit">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </li>
                </ol>
             </div>
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container">
          <div class="col-md-12">
            <div class="card card-outline card-primary">
              <div class="card-body">
                <table class="table table-">
                  <thead>
                    <tr>
                      <th style="width: 10px">No</th>
                      <th>Nama Tamu</th>
                      <th>Tanggal Cek In</th>
                      <th>Tanggal Cek Out</th>
                      <th>Tipe Kamar</th>
                      <th>Setatus</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody id="myTable">
                    <?php
                    include '../koneksi.php';
                    $no = 1;
                    $data = mysqli_query($koneksi, "select * from pesanan");
                    while($d = mysqli_fetch_array($data)){
                      ?>
                      <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $d['nama_tamu']; ?></td>
                        <td><?php echo $d['cek_in']; ?></td>
                        <td><?php echo $d['cek_out']; ?></td>
                        <td>
                          <?php 
                          $kamar = mysqli_query($koneksi, "select * from kamar");
                          while ($a = mysqli_fetch_array($kamar)) {
                            if ($a['id_kamar'] == $d['id_kamar']) { ?>
                              <?php echo $a['no_kamar']; ?>
                              <?php
                            }
                          }
                          ?>
                        </td>
                        <td>
                          <?php
                          if ($d['status'] == 1) { ?>
                            <span class="badge bg-warning">Belum di Konfirmasi</span>
                          <?php } else { ?>
                            <span class="badge bg-success">Sudah di Konfirmasi</span>
                          <?php } ?> 
                        </td>
                        <td>
                          <form action="aksi_konfirmasi.php" method="POST">
                            <input type="hidden" name="id_pesanan" value="<?php echo $d['id_pesanan']; ?>">
                            <input type="hidden" name="status" value="2">
                            <button class="btn btn-sm btn-primary">Konfirmasi</button>
                          </form><br>
                           

                            <button type="submit" class="badge bg-danger border-0" onclick="return confirm('Menghapus Data Ini Akan Mempengaruhi Data Lain, Anda Yakin?')"><span>Delete</span></button>

                        </form> -->
                        </td>
                      </tr>
                      <?php
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    
    <footer class="main-footer">
      <!-- To the right -->
      
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="../assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../assets/dist/js/adminlte.min.js"></script>

  <script>
  $(document).ready(function(){
    $("#myInput").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#myTable tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
  </script>
</body>
</html>