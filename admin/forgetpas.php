<?php
session_start();
include_once('koneksi.php');

$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reset_password'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Validasi
    if (empty($username) || empty($new_password) || empty($confirm_password)) {
        $error = "Semua field harus diisi!";
    } elseif ($new_password !== $confirm_password) {
        $error = "Password baru dan konfirmasi password tidak cocok!";
    } elseif (strlen($new_password) < 6) {
        $error = "Password minimal 6 karakter!";
    } else {
        // Cek apakah admin exists
        $sql = "SELECT * FROM admin WHERE username = ?";
        $stmt = mysqli_prepare($koneksi, $sql);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if (mysqli_num_rows($result) == 1) {
            // Update password
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $update_sql = "UPDATE admin SET password = ? WHERE username = ?";
            $update_stmt = mysqli_prepare($koneksi, $update_sql);
            mysqli_stmt_bind_param($update_stmt, "ss", $hashed_password, $username);
            
            if (mysqli_stmt_execute($update_stmt)) {
                $message = "Password berhasil direset! Silakan login dengan password baru.";
            } else {
                $error = "Gagal mereset password. Silakan coba lagi.";
            }
        } else {
            $error = "Username tidak ditemukan!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Pariwisata SBB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .reset-container {
            min-height: 100vh;
            background: linear-gradient(135deg, #ff6b6b 0%, #feca57 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .reset-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .reset-header {
            background: linear-gradient(135deg, #ff6b6b 0%, #feca57 100%);
            border-radius: 20px 20px 0 0;
            padding: 2rem;
            text-align: center;
            color: white;
        }
        .btn-reset {
            background: linear-gradient(135deg, #ff6b6b 0%, #feca57 100%);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            color: white;
            transition: all 0.3s;
        }
        .btn-reset:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 107, 107, 0.4);
            color: white;
        }
    </style>
</head>
<body>
    <div class="reset-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="reset-card">
                        <div class="reset-header">
                            <i class="fas fa-key fa-3x mb-3"></i>
                            <h2>Reset Password</h2>
                            <p class="mb-0">Atur ulang password admin Anda</p>
                        </div>
                        
                        <div class="card-body p-4">
                            <?php if ($error): ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    <?php echo $error; ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ($message): ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fas fa-check-circle me-2"></i>
                                    <?php echo $message; ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            <?php endif; ?>
                            
                            <form method="POST" action="">
                                <div class="mb-3">
                                    <label for="username" class="form-label">
                                        <i class="fas fa-user me-2"></i>Username
                                    </label>
                                    <input type="text" class="form-control" id="username" name="username" 
                                           placeholder="Masukkan username admin" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="new_password" class="form-label">
                                        <i class="fas fa-lock me-2"></i>Password Baru
                                    </label>
                                    <input type="password" class="form-control" id="new_password" name="new_password" 
                                           placeholder="Masukkan password baru" required>
                                    <div class="form-text">Minimal 6 karakter</div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="confirm_password" class="form-label">
                                        <i class="fas fa-lock me-2"></i>Konfirmasi Password Baru
                                    </label>
                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" 
                                           placeholder="Konfirmasi password baru" required>
                                </div>
                                
                                <button type="submit" name="reset_password" class="btn btn-reset w-100 mb-3">
                                    <i class="fas fa-sync-alt me-2"></i>Reset Password
                                </button>
                                
                                <div class="text-center">
                                    <a href="login.php" class="text-decoration-none">
                                        <i class="fas fa-arrow-left me-1"></i>Kembali ke Login
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>