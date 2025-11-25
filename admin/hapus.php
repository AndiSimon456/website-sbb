<?php
include_once('koneksi.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Ambil data foto untuk dihapus dari folder
    $query_foto = mysqli_query($koneksi, "SELECT foto FROM skot_wisata WHERE id = '$id'");
    
    if (mysqli_num_rows($query_foto) > 0) {
        $data = mysqli_fetch_array($query_foto);
        $foto = $data['foto'];
        
        // Hapus data dari database
        $result = mysqli_query($koneksi, "DELETE FROM skot_wisata WHERE id = '$id'");
        
        if ($result) {
            // Hapus file foto dari folder jika ada
            if (!empty($foto) && file_exists('../admin/img/' . $foto)) {
                unlink('../admin/img/' . $foto);
            }
            
            echo "<script>
                alert('Data berhasil dihapus!');
                window.location.href = 'data.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                window.location.href = 'daftar_wisata.php';
            </script>";
        }
    } else {
        echo "<script>
            alert('Data tidak ditemukan!');
            window.location.href = 'daftar_wisata.php';
        </script>";
    }
} else {
    echo "<script>
        alert('ID tidak valid!');
        window.location.href = 'daftar_wisata.php';
    </script>";
}
?>