<?php
session_start();
include_once('koneksi.php');

// Cek login
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

// Logout handler
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Tempat Wisata</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.dataTables.css" />
  
<script src="https://cdn.datatables.net/2.3.4/js/dataTables.js"></script>
</head>
<body>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Tempat Wisata</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.dataTables.css" />
    <script src="https://cdn.datatables.net/2.3.4/js/dataTables.js"></script>
</head>
<body>
    <div class="container mt-2">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container">
                <a class="navbar-brand" href="login.php">Admin Panel</a>
                <div class="navbar-nav ms-auto">
                    <span class="navbar-text me-3">
                        <i class="fas fa-user me-1"></i><?php echo $_SESSION['admin_username']; ?>
                    </span>
                    <a href="?logout=true" class="btn btn-outline-light btn-sm">
                        <i class="fas fa-sign-out-alt me-1"></i>Logout
                    </a>
                </div>
            </div>
        </nav>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Pariwisata
                            <a href="input.php" class="btn btn-primary float-end">Tambahkan Data</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table id="example" class="table table-striped table-bordered"> 
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Wisata</th>
                                    <th>Lokasi</th>
                                    <th>Status Wisata</th>
                                    <th>Deskripsi</th>
                                    <th>Harga Tiket</th>
                                    <th>Jam Operasional</th>
                                    <th>Foto Wisata</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include_once('koneksi.php');
                                $result = mysqli_query($koneksi, "SELECT * FROM skot_wisata ORDER BY id DESC");
                                $no = 1;
                                while ($row = mysqli_fetch_array($result)) {
                                    echo '
                                    <tr>
                                        <td>'.$no.'</td>
                                        <td>'.$row['nama_wisata'].'</td>
                                        <td>'.$row['lokasi'].'</td>
                                        <td>'.$row['status'].'</td>
                                        <td>'.$row['deskripsi'].'</td>
                                        <td>Rp '.$row['harga_tiket'].'</td>
                                        <td>'.$row['jam_operasional'].'</td>
                                        <td>';
                                    
                                    // Tampilkan gambar jika ada
                                    if (!empty($row['foto'])) {
                                        echo '<img src="../admin/img/'.$row['foto'].'" alt="Foto Wisata" style="width: 80px; height: 60px; object-fit: cover;">';
                                    } else {
                                        echo 'Tidak ada foto';
                                    }
                                    
                                    echo '</td>
                                        <td>
                                            <a href="edit.php?id='.$row['id'].'" class="btn btn-warning btn-sm">Edit</a>
                                            <a href="hapus.php?id='.$row['id'].'" class="btn btn-danger btn-sm" onclick="return confirmHapus(\''.$row['nama_wisata'].'\')">Hapus</a>
                                        </td>
                                    </tr>';
                                    $no++;
                                }
                                ?> 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Inisialisasi DataTables
        document.addEventListener('DOMContentLoaded', function() {
            $('#example').DataTable();
        });

        // Fungsi konfirmasi hapus yang lebih informatif
        function confirmHapus(namaWisata) {
            return confirm('Yakin ingin menghapus data "' + namaWisata + '"?\nData yang dihapus tidak dapat dikembalikan!');
        }
    </script>
</body>
</html>