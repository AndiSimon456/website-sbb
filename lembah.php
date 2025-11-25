<?php 
include ('navbar.php');
?>

<?php
include_once('./admin/koneksi.php');

// Ubah query untuk hanya mengambil data dengan status 'Pantai'
$sql = "SELECT * FROM skot_wisata WHERE status = 'Lembah' ORDER BY id DESC";
$result = mysqli_query($koneksi, $sql);

if (!$result) {
    die("Query error: " . mysqli_error($koneksi));
}

$data = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<div class="div">
    <header class="masthead">
        <div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center">
            <div class="d-flex justify-content-center">
                <div class="text-center">
                    <!-- Ubah judul menjadi Pantai -->
                    <h2 class="text-white-100 mx-auto btn btn-primary">Kunjungi Lembah</h2>
                    <!-- Tambahkan deskripsi atau informasi tambahan -->
                    <p class="text-white mt-2">Temukan keindahan Lembah di SBB yang menakjubkan</p>
                </div>
            </div>
        </div>
    </header>
</div>

<div class="container mt-4">
    <!-- Tambahkan informasi jumlah data -->
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="text-center">Daftar Wisata Lembah</h4>
            <p class="text-center text-muted">Menampilkan <?php echo count($data); ?> lembah</p>
        </div>
    </div>

    <div class="row"> <!-- Baris grid dimulai -->
        <?php if (!empty($data)) {
            foreach ($data as $row) { ?>
                <div class="col-md-3 mb-4"> <!-- 4 card per baris -->
                    <div class="card h-100" style="width: 100%;">
                        <a href="#modal-<?php echo $row['id']; ?>" data-bs-toggle="modal">
                            <img src="./admin/img/<?php echo $row['foto']; ?>" class="card-img-top" alt="Foto Wisata" style="height: 200px; object-fit: cover;">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['nama_wisata']; ?></h5>
                            <p class="card-text">
                                <i class="fas fa-map-marker-alt"></i> <?php echo $row['lokasi']; ?>
                            </p>
                            <!-- Ubah tampilan status dengan badge -->
                            <span class="badge bg-info"><?php echo $row['status']; ?></span>
                        </div>
                        <div class="card-footer bg-transparent">
                            <small class="text-muted">
                                <i class="fas fa-clock"></i> <?php echo $row['jam_operasional']; ?>
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Modal unik -->
                <div class="modal fade" id="modal-<?php echo $row['id']; ?>" aria-hidden="true" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5">
                                    <i class="fas fa-umbrella-beach"></i> <?php echo $row['nama_wisata']; ?>
                                </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <img src="./admin/img/<?php echo $row['foto']; ?>" alt="<?php echo $row['nama_wisata']; ?>" style="width: 100%; height: 300px; object-fit: cover;">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <h6><i class="fas fa-map-marker-alt"></i> Lokasi</h6>
                                            <p class="text-muted"><?php echo $row['lokasi']; ?></p>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <h6><i class="fas fa-info-circle"></i> Deskripsi</h6>
                                            <p class="text-muted"><?php echo $row['deskripsi']; ?></p>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <h6><i class="fas fa-ticket-alt"></i> Harga Tiket</h6>
                                            <p class="text-muted">Rp <?php echo $row['harga_tiket']; ?></p>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <h6><i class="fas fa-clock"></i> Jam Operasional</h6>
                                            <p class="text-muted"><?php echo $row['jam_operasional']; ?></p>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <h6><i class="fas fa-tag"></i> Kategori</h6>
                                            <span class="badge bg-primary"><?php echo $row['status']; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }
        } else { ?>
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <h5><i class="fas fa-umbrella-beach"></i> Belum Ada Data Lemabah</h5>
                    <p>Silakan tambahkan data wisata lembah terlebih dahulu.</p>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<?php 
include('footer.php');
?>