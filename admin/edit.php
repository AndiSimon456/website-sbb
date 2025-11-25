<?php
// Koneksi database
include_once('koneksi.php');

// Inisialisasi variabel
$id = $nama_wisata = $lokasi = $deskripsi = $hargaTiket = $jamOperasional = $status = $foto_lama = '';

// Cek apakah ada parameter ID yang dikirim
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Ambil data dari database berdasarkan ID
    $query = mysqli_query($koneksi, "SELECT * FROM skot_wisata WHERE id = '$id'");
    
    if (mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_array($query);
        $nama_wisata = $data['nama_wisata'];
        $lokasi = $data['lokasi'];
        $deskripsi = $data['deskripsi'];
        $hargaTiket = $data['harga_tiket'];
        $jamOperasional = $data['jam_operasional'];
        $status = $data['status'];
        $foto_lama = $data['foto'];
    } else {
        echo "<script>alert('Data tidak ditemukan!'); window.location.href='data.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('ID tidak valid!'); window.location.href='data.php';</script>";
    exit();
}

// Proses update data
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama_wisata = $_POST['nama_wisata'];
    $lokasi = $_POST['lokasi'];
    $deskripsi = $_POST['deskripsi'];
    $hargaTiket = $_POST['harga_tiket'];
    $jamOperasional = $_POST['jam_operasional'];
    $status = $_POST['status'];
    
    // Cek apakah ada file foto baru yang diupload
    if (!empty($_FILES['foto']['name'])) {
        $foto = $_FILES['foto']['name'];
        $source = $_FILES['foto']['tmp_name'];
        $folder = '../admin/img/' . $foto;
        
        // Hapus foto lama jika ada
        if (!empty($foto_lama) && file_exists('../admin/img/' . $foto_lama)) {
            unlink('../admin/img/' . $foto_lama);
        }
        
        // Pindahkan file baru
        if (move_uploaded_file($source, $folder)) {
            $foto_update = $foto;
        } else {
            echo "<script>alert('Gagal mengupload foto baru!');</script>";
            $foto_update = $foto_lama;
        }
    } else {
        // Jika tidak ada foto baru, gunakan foto lama
        $foto_update = $foto_lama;
    }
    
    // Update data ke database
    $result = mysqli_query($koneksi, "UPDATE skot_wisata SET 
        nama_wisata = '$nama_wisata', 
        lokasi = '$lokasi', 
        deskripsi = '$deskripsi', 
        harga_tiket = '$hargaTiket', 
        jam_operasional = '$jamOperasional', 
        foto = '$foto_update', 
        status = '$status' 
        WHERE id = '$id'");
    
    if ($result) {
        echo "<script>alert('Data berhasil diupdate!'); window.location.href='data.php';</script>";
    } else {
        echo "<script>alert('Data gagal diupdate: ".mysqli_error($koneksi)."');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit data</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>

</head>
<body>
  <div class="container justify-content-center mt-5">
      <div class="card" style="width:100%;">
          <div class="card-body">
              <h5 class="card-title">Edit Data Wisata</h5>
              
              <!-- <?php if ($error): ?>
                  <div class="alert alert-danger"><?php echo $error; ?></div>
              <?php endif; ?> -->
              
              <form action="" method="POST" enctype="multipart/form-data">
                  <!-- Input hidden untuk menyimpan ID -->
                  <input type="hidden" name="id" value="<?php echo $id; ?>">
                  
                  <div class="mb-3">
                      <label for="nama_wisata" class="form-label">Nama Wisata</label>
                      <input type="text" class="form-control" name="nama_wisata" value="<?php echo htmlspecialchars($nama_wisata); ?>" required>
                  </div>
                  
                  <div class="mb-3">
                      <label for="lokasi" class="form-label">Lokasi</label>
                      <select name="lokasi" id="lokasi" class="form-control" required>
                          <option value="">Pilih Lokasi</option>
                          <option value="Amalatu, Hualoy" <?php echo ($lokasi == 'Amalatu, Hualoy') ? 'selected' : ''; ?>>Amalatu, Hualoy</option>
                          <option value="Amalatu, Latu" <?php echo ($lokasi == 'Amalatu, Latu') ? 'selected' : ''; ?>>Amalatu, Latu</option>
                          <option value="Amalatu, Rumah Kay" <?php echo ($lokasi == 'Amalatu, Rumah Kay') ? 'selected' : ''; ?>>Amalatu, Rumah Kay</option>
                          <option value="Amalatu, Seriholo" <?php echo ($lokasi == 'Amalatu, Seriholo') ? 'selected' : ''; ?>>Amalatu, Seriholo</option>
                          <option value="Amalatu, Tala" <?php echo ($lokasi == 'Amalatu, Tala') ? 'selected' : ''; ?>>Amalatu, Tala</option>
                          <option value="Amalatu, Tihulale" <?php echo ($lokasi == 'Amalatu, Tihulale') ? 'selected' : ''; ?>>Amalatu, Tihulale</option>
                          <option value="Amalatu, Tomalehu" <?php echo ($lokasi == 'Amalatu, Tomalehu') ? 'selected' : ''; ?>>Amalatu, Tomalehu</option>
                          <option value="Elpaputih, Abio Ahiolo" <?php echo ($lokasi == 'Elpaputih, Abio Ahiolo') ? 'selected' : ''; ?>>Elpaputih, Abio Ahiolo</option>
                          <option value="Elpaputih, Elpaputih" <?php echo ($lokasi == 'Elpaputih, Elpaputih') ? 'selected' : ''; ?>>Elpaputih, Elpaputih</option>
                          <option value="Elpaputih, Huku Kecil" <?php echo ($lokasi == 'Elpaputih, Huku Kecil') ? 'selected' : ''; ?>>Elpaputih, Huku Kecil</option>
                          <option value="Elpaputih, Sanahu" <?php echo ($lokasi == 'Elpaputih, Sanahu') ? 'selected' : ''; ?>>Elpaputih, Sanahu</option>
                          <option value="Elpaputih, Sumeith Pasinaro" <?php echo ($lokasi == 'Elpaputih, Sumeith Pasinaro') ? 'selected' : ''; ?>>Elpaputih, Sumeith Pasinaro</option>
                          <option value="Elpaputih, Wasia" <?php echo ($lokasi == 'Elpaputih, Wasia') ? 'selected' : ''; ?>>Elpaputih, Wasia</option>
                          <option value="Elpaputih, Watui" <?php echo ($lokasi == 'Elpaputih, Watui') ? 'selected' : ''; ?>>Elpaputih, Watui</option>
                          <option value="Huamual, Ariate" <?php echo ($lokasi == 'Huamual, Ariate') ? 'selected' : ''; ?>>Huamual, Ariate</option>
                          <option value="Huamual, Iha" <?php echo ($lokasi == 'Huamual, Iha') ? 'selected' : ''; ?>>Huamual, Iha</option>
                          <option value="Huamual, Kulur" <?php echo ($lokasi == 'Huamual, Kulur') ? 'selected' : ''; ?>>Huamual, Kulur</option>
                          <option value="Huamual, Lokki" <?php echo ($lokasi == 'Huamual, Lokki') ? 'selected' : ''; ?>>Huamual, Lokki</option>
                          <option value="Huamual, Luhu" <?php echo ($lokasi == 'Huamual, Luhu') ? 'selected' : ''; ?>>Huamual, Luhu</option>
                          <option value="Huamual Belakang, Allang Asaude" <?php echo ($lokasi == 'Huamual Belakang, Allang Asaude') ? 'selected' : ''; ?>>Huamual Belakang, Allang Asaude</option>
                          <option value="Huamual Belakang, Buano Selatan" <?php echo ($lokasi == 'Huamual Belakang, Buano Selatan') ? 'selected' : ''; ?>>Huamual Belakang, Buano Selatan</option>
                          <option value="Huamual Belakang, Buano Utara" <?php echo ($lokasi == 'Huamual Belakang, Buano Utara') ? 'selected' : ''; ?>>Huamual Belakang, Buano Utara</option>
                          <option value="Huamual Belakang, Sole" <?php echo ($lokasi == 'Huamual Belakang, Sole') ? 'selected' : ''; ?>>Huamual Belakang, Sole</option>
                          <option value="Huamual Belakang, Tahalupu" <?php echo ($lokasi == 'Huamual Belakang, Tahalupu') ? 'selected' : ''; ?>>Huamual Belakang, Tahalupu</option>
                          <option value="Huamual Belakang, Tonu jaya" <?php echo ($lokasi == 'Huamual Belakang, Tonu jaya') ? 'selected' : ''; ?>>Huamual Belakang, Tonu jaya</option>
                          <option value="Huamual Belakang, Waesela" <?php echo ($lokasi == 'Huamual Belakang, Waesela') ? 'selected' : ''; ?>>Huamual Belakang, Waesela</option>
                          <option value="Inamosol, Honitetu" <?php echo ($lokasi == 'Inamosol, Honitetu') ? 'selected' : ''; ?>>Inamosol, Honitetu</option>
                          <option value="Inamosol, Hukuanakota" <?php echo ($lokasi == 'Inamosol, Hukuanakota') ? 'selected' : ''; ?>>Inamosol, Hukuanakota</option>
                          <option value="Inamosol, Manusa" <?php echo ($lokasi == 'Inamosol, Manusa') ? 'selected' : ''; ?>>Inamosol, Manusa</option>
                          <option value="Inamosol, Rambatu" <?php echo ($lokasi == 'Inamosol, Rambatu') ? 'selected' : ''; ?>>Inamosol, Rambatu</option>
                          <option value="Inamosol, Rumberu" <?php echo ($lokasi == 'Inamosol, Rumberu') ? 'selected' : ''; ?>>Inamosol, Rumberu</option>
                          <option value="Kairatu, Hatusua" <?php echo ($lokasi == 'Kairatu, Hatusua') ? 'selected' : ''; ?>>Kairatu, Hatusua</option>
                          <option value="Kairatu, Kairatu" <?php echo ($lokasi == 'Kairatu, Kairatu') ? 'selected' : ''; ?>>Kairatu, Kairatu</option>
                          <option value="Kairatu, Kamarian" <?php echo ($lokasi == 'Kairatu, Kamarian') ? 'selected' : ''; ?>>Kairatu, Kamarian</option>
                          <option value="Kairatu, Seruawan" <?php echo ($lokasi == 'Kairatu, Seruawan') ? 'selected' : ''; ?>>Kairatu, Seruawan</option>
                          <option value="Kairatu, Uraur" <?php echo ($lokasi == 'Kairatu, Uraur') ? 'selected' : ''; ?>>Kairatu, Uraur</option>
                          <option value="Kairatu, Waimital" <?php echo ($lokasi == 'Kairatu, Waimital') ? 'selected' : ''; ?>>Kairatu, Waimital</option>
                          <option value="Kairatu, Waipirit" <?php echo ($lokasi == 'Kairatu, Waipirit') ? 'selected' : ''; ?>>Kairatu, Waipirit</option>
                          <option value="Kairatu Barat, Kamal" <?php echo ($lokasi == 'Kairatu Barat, Kamal') ? 'selected' : ''; ?>>Kairatu Barat, Kamal</option>
                          <option value="Kairatu Barat, Lohiatala" <?php echo ($lokasi == 'Kairatu Barat, Lohiatala') ? 'selected' : ''; ?>>Kairatu Barat, Lohiatala</option>
                          <option value="Kairatu Barat, Nuruwe" <?php echo ($lokasi == 'Kairatu Barat, Nuruwe') ? 'selected' : ''; ?>>Kairatu Barat, Nuruwe</option>
                          <option value="Kairatu Barat, Waihatu" <?php echo ($lokasi == 'Kairatu Barat, Waihatu') ? 'selected' : ''; ?>>Kairatu Barat, Waihatu</option>
                          <option value="Kairatu Barat, Waisamu" <?php echo ($lokasi == 'Kairatu Barat, Waisamu') ? 'selected' : ''; ?>>Kairatu Barat, Waisamu</option>
                          <option value="Kairatu Barat, Waisarisa" <?php echo ($lokasi == 'Kairatu Barat, Waisarisa') ? 'selected' : ''; ?>>Kairatu Barat, Waisarisa</option>
                          <option value="Kepulauan Manipa, Buano Hatuputih" <?php echo ($lokasi == 'Kepulauan Manipa, Buano Hatuputih') ? 'selected' : ''; ?>>Kepulauan Manipa, Buano Hatuputih</option>
                          <option value="Kepulauan Manipa, Kelang Asaude" <?php echo ($lokasi == 'Kepulauan Manipa, Kelang Asaude') ? 'selected' : ''; ?>>Kepulauan Manipa, Kelang Asaude</option>
                          <option value="Kepulauan Manipa, Luhutuban" <?php echo ($lokasi == 'Kepulauan Manipa, Luhutuban') ? 'selected' : ''; ?>>Kepulauan Manipa, Luhutuban</option>
                          <option value="Kepulauan Manipa, Masawoy" <?php echo ($lokasi == 'Kepulauan Manipa, Masawoy') ? 'selected' : ''; ?>>Kepulauan Manipa, Masawoy</option>
                          <option value="Kepulauan Manipa, Tomalehu Barat" <?php echo ($lokasi == 'Kepulauan Manipa, Tomalehu Barat') ? 'selected' : ''; ?>>Kepulauan Manipa, Tomalehu Barat</option>
                          <option value="Kepulauan Manipa, Tomalehu Timur" <?php echo ($lokasi == 'Kepulauan Manipa, Tomalehu Timur') ? 'selected' : ''; ?>>Kepulauan Manipa, Tomalehu Timur</option>
                          <option value="Kepulauan Manipa, Tuniwara" <?php echo ($lokasi == 'Kepulauan Manipa, Tuniwara') ? 'selected' : ''; ?>>Kepulauan Manipa, Tuniwara</option>
                          <option value="Seram Barat, Eti" <?php echo ($lokasi == 'Seram Barat, Eti') ? 'selected' : ''; ?>>Seram Barat, Eti</option>
                          <option value="Seram Barat, Kaibobo" <?php echo ($lokasi == 'Seram Barat, Kaibobo') ? 'selected' : ''; ?>>Seram Barat, Kaibobo</option>
                          <option value="Seram Barat, Kawa" <?php echo ($lokasi == 'Seram Barat, Kawa') ? 'selected' : ''; ?>>Seram Barat, Kawa</option>
                          <option value="Seram Barat, Lumoli" <?php echo ($lokasi == 'Seram Barat, Lumoli') ? 'selected' : ''; ?>>Seram Barat, Lumoli</option>
                          <option value="Seram Barat, Morekau" <?php echo ($lokasi == 'Seram Barat, Morekau') ? 'selected' : ''; ?>>Seram Barat, Morekau</option>
                          <option value="Seram Barat, Neniari" <?php echo ($lokasi == 'Seram Barat, Neniari') ? 'selected' : ''; ?>>Seram Barat, Neniari</option>
                          <option value="Seram Barat, Piru" <?php echo ($lokasi == 'Seram Barat, Piru') ? 'selected' : ''; ?>>Seram Barat, Piru</option>
                          <option value="Taniwel, Burai" <?php echo ($lokasi == 'Taniwel, Burai') ? 'selected' : ''; ?>>Taniwel, Burai</option>
                          <option value="Taniwel, Hulung" <?php echo ($lokasi == 'Taniwel, Hulung') ? 'selected' : ''; ?>>Taniwel, Hulung</option>
                          <option value="Taniwel, Laturake" <?php echo ($lokasi == 'Taniwel, Laturake') ? 'selected' : ''; ?>>Taniwel, Laturake</option>
                          <option value="Taniwel, Lisabata" <?php echo ($lokasi == 'Taniwel, Lisabata') ? 'selected' : ''; ?>>Taniwel, Lisabata</option>
                          <option value="Taniwel, Lohiasapalewa" <?php echo ($lokasi == 'Taniwel, Lohiasapalewa') ? 'selected' : ''; ?>>Taniwel, Lohiasapalewa</option>
                          <option value="Taniwel, Murnaten" <?php echo ($lokasi == 'Taniwel, Murnaten') ? 'selected' : ''; ?>>Taniwel, Murnaten</option>
                          <option value="Taniwel, Nikulukan" <?php echo ($lokasi == 'Taniwel, Nikulukan') ? 'selected' : ''; ?>>Taniwel, Nikulukan</option>
                          <option value="Taniwel, Niniari" <?php echo ($lokasi == 'Taniwel, Niniari') ? 'selected' : ''; ?>>Taniwel, Niniari</option>
                          <option value="Taniwel, Niwelehu" <?php echo ($lokasi == 'Taniwel, Niwelehu') ? 'selected' : ''; ?>>Taniwel, Niwelehu</option>
                          <option value="Taniwel, Nukuhai" <?php echo ($lokasi == 'Taniwel, Nukuhai') ? 'selected' : ''; ?>>Taniwel, Nukuhai</option>
                          <option value="Taniwel, Nuniali" <?php echo ($lokasi == 'Taniwel, Nuniali') ? 'selected' : ''; ?>>Taniwel, Nuniali</option>
                          <option value="Taniwel, Pasinalo" <?php echo ($lokasi == 'Taniwel, Pasinalo') ? 'selected' : ''; ?>>Taniwel, Pasinalo</option>
                          <option value="Taniwel, Patahuwe" <?php echo ($lokasi == 'Taniwel, Patahuwe') ? 'selected' : ''; ?>>Taniwel, Patahuwe</option>
                          <option value="Taniwel, Riring" <?php echo ($lokasi == 'Taniwel, Riring') ? 'selected' : ''; ?>>Taniwel, Riring</option>
                          <option value="Taniwel, Rumahsoal" <?php echo ($lokasi == 'Taniwel, Rumahsoal') ? 'selected' : ''; ?>>Taniwel, Rumahsoal</option>
                          <option value="Taniwel, Taniwel" <?php echo ($lokasi == 'Taniwel, Taniwel') ? 'selected' : ''; ?>>Taniwel, Taniwel</option>
                          <option value="Taniwel, Uweth" <?php echo ($lokasi == 'Taniwel, Uweth') ? 'selected' : ''; ?>>Taniwel, Uweth</option>
                          <option value="Taniwel, Wakolo" <?php echo ($lokasi == 'Taniwel, Wakolo') ? 'selected' : ''; ?>>Taniwel, Wakolo</option>
                          <option value="Taniwel Timur, Hatunuru" <?php echo ($lokasi == 'Taniwel Timur, Hatunuru') ? 'selected' : ''; ?>>Taniwel Timur, Hatunuru</option>
                          <option value="Taniwel Timur, Lumahlatal" <?php echo ($lokasi == 'Taniwel Timur, Lumahlatal') ? 'selected' : ''; ?>>Taniwel Timur, Lumahlatal</option>
                          <option value="Taniwel Timur, Lumahpelu" <?php echo ($lokasi == 'Taniwel Timur, Lumahpelu') ? 'selected' : ''; ?>>Taniwel Timur, Lumahpelu</option>
                          <option value="Taniwel Timur, Makububui" <?php echo ($lokasi == 'Taniwel Timur, Makububui') ? 'selected' : ''; ?>>Taniwel Timur, Makububui</option>
                          <option value="Taniwel Timur, Maloang" <?php echo ($lokasi == 'Taniwel Timur, Maloang') ? 'selected' : ''; ?>>Taniwel Timur, Maloang</option>
                          <option value="Taniwel Timur, Matapa" <?php echo ($lokasi == 'Taniwel Timur, Matapa') ? 'selected' : ''; ?>>Taniwel Timur, Matapa</option>
                          <option value="Taniwel Timur, Musihuwey" <?php echo ($lokasi == 'Taniwel Timur, Musihuwey') ? 'selected' : ''; ?>>Taniwel Timur, Musihuwey</option>
                          <option value="Taniwel Timur, Seakasale" <?php echo ($lokasi == 'Taniwel Timur, Seakasale') ? 'selected' : ''; ?>>Taniwel Timur, Seakasale</option>
                          <option value="Taniwel Timur, Sohuwe" <?php echo ($lokasi == 'Taniwel Timur, Sohuwe') ? 'selected' : ''; ?>>Taniwel Timur, Sohuwe</option>
                          <option value="Taniwel Timur, Solea" <?php echo ($lokasi == 'Taniwel Timur, Solea') ? 'selected' : ''; ?>>Taniwel Timur, Solea</option>
                          <option value="Taniwel Timur, Sukaraja" <?php echo ($lokasi == 'Taniwel Timur, Sukaraja') ? 'selected' : ''; ?>>Taniwel Timur, Sukaraja</option>
                          <option value="Taniwel Timur, Tounusa" <?php echo ($lokasi == 'Taniwel Timur, Tounusa') ? 'selected' : ''; ?>>Taniwel Timur, Tounusa</option>
                          <option value="Taniwel Timur, Uwen Pantai" <?php echo ($lokasi == 'Taniwel Timur, Uwen Pantai') ? 'selected' : ''; ?>>Taniwel Timur, Uwen Pantai</option>
                          <option value="Taniwel Timur, Walakone" <?php echo ($lokasi == 'Taniwel Timur, Walakone') ? 'selected' : ''; ?>>Taniwel Timur, Walakone</option>
                          <option value="Taniwel Timur, Waraloin" <?php echo ($lokasi == 'Taniwel Timur, Waraloin') ? 'selected' : ''; ?>>Taniwel Timur, Waraloin</option>
                      </select>
                  </div>
                  
                  <div class="mb-3">
                      <label for="status" class="form-label">Status wisata</label>
                      <select name="status" id="status" class="form-control" required>
                          <option value="">Pilih Status Wisata</option>
                          <option value="Pantai" <?php echo ($status == 'Pantai') ? 'selected' : ''; ?>>Pantai</option>
                          <option value="Gunung" <?php echo ($status == 'Gunung') ? 'selected' : ''; ?>>Gunung</option>
                          <option value="Lembah" <?php echo ($status == 'Lembah') ? 'selected' : ''; ?>>Lembah</option>
                          <option value="Air Terjun" <?php echo ($status == 'Air Terjun') ? 'selected' : ''; ?>>Air Terjun</option>
                          <option value="Danau" <?php echo ($status == 'Danau') ? 'selected' : ''; ?>>Danau</option>
                      </select>
                  </div>
                  
                  <div class="mb-3">
                      <label for="deskripsi" class="form-label">Deskripsi Wisata</label>
                      <textarea name="deskripsi" id="deskripsi" class="form-control" rows="10" required><?php echo htmlspecialchars($deskripsi); ?></textarea>
                  </div>
                  
                  <div class="mb-3">
                      <label for="harga_tiket" class="form-label">Harga Tiket</label>
                      <input type="text" class="form-control" name="harga_tiket" value="<?php echo htmlspecialchars($hargaTiket); ?>" required>
                  </div>
                  
                  <div class="mb-3">
                      <label for="jam_operasional" class="form-label">Jam Operasional</label>
                      <input type="text" name="jam_operasional" class="form-control" value="<?php echo htmlspecialchars($jamOperasional); ?>" required>
                  </div>
                  
                  <div class="mb-3">
                      <label for="foto" class="form-label">Foto Wisata</label>
                      <input type="file" class="form-control" name="foto">
                      <?php if ($foto_lama): ?>
                          <small class="form-text text-muted">
                              Foto saat ini: <?php echo $foto_lama; ?><br>
                              <img src="../admin/img/<?php echo $foto_lama; ?>" alt="Foto Wisata" style="max-width: 200px; margin-top: 10px;">
                          </small>
                      <?php endif; ?>
                  </div>
                  
                  <div class="mb-5">
                      <input type="submit" name="update" value="Update Data" class="btn btn-warning">
                      <a href="data.php" class="btn btn-secondary">Kembali</a>
                  </div>
              </form>
          </div>
      </div>
  </div>
</body>
</html>