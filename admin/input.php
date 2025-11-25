<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Data Wisata</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>


</head>
<body>
    <div class="container justify-content-center mt-5">
        <div class="card" style="width:100%;">
            <div class="card-body">
                <h5 class="card-title">Input Data Wisata</h5>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nama_wisata" class="form-label">Nama Wisata</label>
                        <input type="text" class="form-control" name="nama_wisata" required="masukan Nama Wisata">
                    </div>
                    <div class="mb-3">
                        <label for="lokasi" class="form-label">Lokasi</label>
                        <select name="lokasi" id="lokasi" class="form-control" required="masukan Lokasi">
                            <option>Kecematan, kelurahan/desa</option>
                            <option>Amalatu, Hualoy</option>
                            <option>Amalatu, Latu</option>
                            <option>Amalatu, Rumah Kay</option>
                            <option>Amalatu, Seriholo</option>
                            <option>Amalatu, Tala</option>
                            <option>Amalatu, Tihulale</option>
                            <option>Amalatu, Tomalehu</option>
                            <option>Elpaputih, Abio Ahiolo</option>
                            <option>Elpaputih, Elpaputih</option>
                            <option>Elpaputih, Huku Kecil</option>
                            <option>Elpaputih, Sanahu</option>
                            <option>Elpaputih, Sumeith Pasinaro</option>
                            <option>Elpaputih, Wasia</option>
                            <option>Elpaputih, Watui</option>
                            <option>Huamual, Ariate</option>
                            <option>Huamual, Iha</option>
                            <option>Huamual, Kulur</option>
                            <option>Huamual, Lokki</option>
                            <option>Huamual, Luhu</option>
                            <option>Huamual Belakang, Allang Asaude</option>
                            <option>Huamual Belakang, Buano Selatan</option>
                            <option>Huamual Belakang, Buano Utara</option>
                            <option>Huamual Belakang, Sole</option>
                            <option>Huamual Belakang, Tahalupu</option>
                            <option>Huamual Belakang, Tonu jaya</option>
                            <option>Huamual Belakang, Waesela</option>
                            <option>Inamosol, Honitetu</option>
                            <option>Inamosol, Hukuanakota</option>
                            <option>Inamosol, Manusa</option>
                            <option>Inamosol, Rambatu</option>
                            <option>Inamosol, Rumberu</option>
                            <option>Kairatu, Hatusua</option>
                            <option>Kairatu, Kairatu</option>
                            <option>Kairatu, Kamarian</option>
                            <option>Kairatu, Seruawan</option>
                            <option>Kairatu, Uraur</option>
                            <option>Kairatu, Waimital</option>
                            <option>Kairatu, Waipirit</option>
                            <option>Kairatu Barat, Kamal</option>
                            <option>Kairatu Barat, Lohiatala</option>
                            <option>Kairatu Barat, Nuruwe</option>
                            <option>Kairatu Barat, Waihatu</option>
                            <option>Kairatu Barat, Waisamu</option>
                            <option>Kairatu Barat, Waisarisa</option>
                            <option>Kepulauan Manipa, Buano Hatuputih</option>
                            <option>Kepulauan Manipa, Kelang Asaude</option>
                            <option>Kepulauan Manipa, Luhutuban</option>
                            <option>Kepulauan Manipa, Masawoy</option>
                            <option>Kepulauan Manipa, Tomalehu Barat</option>
                            <option>Kepulauan Manipa, Tomalehu Timur</option>
                            <option>Kepulauan Manipa, Tuniwara</option>
                            <option>Seram Barat, Eti</option>
                            <option>Seram Barat, Kaibobo</option>
                            <option>Seram Barat, Kawa</option>
                            <option>Seram Barat, Lumoli</option>
                            <option>Seram Barat, Morekau</option>
                            <option>Seram Barat, Neniari</option>
                            <option>Seram Barat, Piru</option>
                            <option>Taniwel, Burai</option>
                            <option>Taniwel, Hulung</option>
                            <option>Taniwel, Laturake</option>
                            <option>Taniwel, Lisabata</option>
                            <option>Taniwel, Lohiasapalewa</option>
                            <option>Taniwel, Murnaten</option>
                            <option>Taniwel, Nikulukan</option>
                            <option>Taniwel, Niniari</option>
                            <option>Taniwel, Niwelehu</option>
                            <option>Taniwel, Nukuhai</option>
                            <option>Taniwel, Nuniali</option>
                            <option>Taniwel, Pasinalo</option>
                            <option>Taniwel, Patahuwe</option>
                            <option>Taniwel, Riring</option>
                            <option>Taniwel, Rumahsoal</option>
                            <option>Taniwel, Taniwel</option>
                            <option>Taniwel, Uweth</option>
                            <option>Taniwel, Wakolo</option>
                            <option>Taniwel Timur, Hatunuru</option>
                            <option>Taniwel Timur, Lumahlatal</option>
                            <option>Taniwel Timur, Lumahpelu</option>
                            <option>Taniwel Timur, Makububui</option>
                            <option>Taniwel Timur, Maloang</option>
                            <option>Taniwel Timur, Matapa</option>
                            <option>Taniwel Timur, Musihuwey</option>
                            <option>Taniwel Timur, Seakasale</option>
                            <option>Taniwel Timur, Sohuwe</option>
                            <option>Taniwel Timur, Solea</option>
                            <option>Taniwel Timur, Sukaraja</option>
                            <option>Taniwel Timur, Tounusa</option>
                            <option>Taniwel Timur, Uwen Pantai</option>
                            <option>Taniwel Timur, Walakone</option>
                            <option>Taniwel Timur, Waraloin</option>
                        </select>
                    </div>
                    <div class="md-3">
                        <label for="status" class="form-label">Status wisata</label>
                        <select name="status" id="status" class="form-control" required="masukan Status Wisata">
                            <option>Pilih Status Wisata</option>
                            <option>Pantai</option>
                            <option>Gunung</option>
                            <option>Lembah</option>
                            <option>Air Terjun</option>
                            
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi Wisata</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control" rows="10" required="masukan Deskripsi"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="harga_tiket" class="form-label">Harga Tiket</label>
                        <input type="text" class="form-control" name="harga_tiket" required="masukan Harga tiket">
                    </div>
                    <div class="mb-3">
                        <label for="jam_operasional" class="form-label">Jam Operasional</label>
                        <input type="text" name="jam_operasional" class="form-control" required="masukan Jam Operasional">
                    </div>
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto Wisata</label>
                        <input type="file" class="form-control" name="foto" required="masukan Foto Wisata">
                    </div>
                    <div class="mb-5">
                        <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php 
    if (isset($_POST['submit'])){
        //ambil data dari form input yaitu
        $nama_wisata =$_POST['nama_wisata'];
        $lokasi =$_POST['lokasi'];
        $deskripsi =$_POST['deskripsi'];
        $hargaTiket =$_POST['harga_tiket'];
        $jamOperasional =$_POST['jam_operasional'];
        $status =$_POST['status'];

        //sekarang ambil foto atau data file foto dari form input
        $foto = $_FILES['foto']['name'];
        $source =$_FILES['foto']['tmp_name'];
        $folder = '../admin/img/' . $foto;

        // sekarang pindahkan file ke folder tujuan

        if (move_uploaded_file($source, $folder)){
            include_once('koneksi.php');
            $result =mysqli_query($koneksi, "INSERT INTO skot_wisata(nama_wisata, lokasi, deskripsi, harga_tiket, jam_operasional, foto, status) value ('$nama_wisata', '$lokasi', '$deskripsi', '$hargaTiket', '$jamOperasional', '$foto', '$status')");
            
            if ($result) {
                echo "<script>alert('Data berhasil di tambahkan!'); window.location.href='data.php';</script>";
            } else {
                echo "Data gagal menyimpan";
            }
        } else {
            echo "Data Gagal Mengupload Foto";
        }
    }
    
    ?>
</body>
</html>