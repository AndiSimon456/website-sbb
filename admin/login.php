<?php
// File untuk setup database dan admin default
include_once('koneksi.php');

// Buat tabel admin jika belum ada
$sql = "CREATE TABLE IF NOT EXISTS admin (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if (mysqli_query($koneksi, $sql)) {
    // Cek apakah admin sudah ada
    $check_admin = mysqli_query($koneksi, "SELECT * FROM admin WHERE username = 'admin'");
    
    if (mysqli_num_rows($check_admin) == 0) {
        // Buat admin default (password: admin123)
        $hashed_password = password_hash('admin123', PASSWORD_DEFAULT);
        $insert_admin = "INSERT INTO admin (username, password, email) VALUES ('admin', '$hashed_password', 'andisimon675@gmail.com.com')";
        
        if (mysqli_query($koneksi, $insert_admin)) {
            echo "<script>alert('Admin default berhasil dibuat!\\nUsername: adminAndi\\nPassword: admin123');</script>";
        }
    }
    
} else {
    echo "Error creating table: " . mysqli_error($koneksi);
}
?>
<?php
session_start();
include_once('koneksi.php');

$error = '';

// Cek jika sudah login, redirect ke dashboard
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: data.php');
    exit;
}

// Proses login
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];
    
    // Cari admin di database
    $sql = "SELECT * FROM admin WHERE username = ?";
    $stmt = mysqli_prepare($koneksi, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if (mysqli_num_rows($result) == 1) {
        $admin = mysqli_fetch_assoc($result);
        
        // Verifikasi password
        if (password_verify($password, $admin['password'])) {
            // Login berhasil
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_username'] = $admin['username'];
            $_SESSION['admin_email'] = $admin['email'];
            
            header('Location: data.php');
            exit;
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Pariwisata SBB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .login-container {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .login-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 20px 20px 0 0;
            padding: 2rem;
            text-align: center;
            color: white;
        }
        .form-control {
            border-radius: 10px;
            padding: 12px 20px;
            border: 2px solid #e9ecef;
            transition: all 0.3s;
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .btn-login {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        .forgot-password {
            color: #667eea;
            text-decoration: none;
            transition: color 0.3s;
        }
        .forgot-password:hover {
            color: #764ba2;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="login-card">
                        <div class="login-header">
                            <i class="fas fa-lock fa-3x mb-3"></i>
                            <h2>Admin Login</h2>
                            <p class="mb-0">Sistem Manajemen Pariwisata SBB</p>
                        </div>
                        
                        <div class="card-body p-4">
                            <?php if ($error): ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    <?php echo $error; ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            <?php endif; ?>
                            
                            <form method="POST" action="">
                                <div class="mb-3">
                                    <label for="username" class="form-label">
                                        <i class="fas fa-user me-2"></i>Username
                                    </label>
                                    <input type="text" class="form-control" id="username" name="username" 
                                           placeholder="Masukkan username" required autofocus>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="password" class="form-label">
                                        <i class="fas fa-key me-2"></i>Password
                                    </label>
                                    <input type="password" class="form-control" id="password" name="password" 
                                           placeholder="Masukkan password" required>
                                </div>
                                
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="showPassword">
                                    <label class="form-check-label" for="showPassword">
                                        Tampilkan Password
                                    </label>
                                </div>
                                
                                <button type="submit" name="login" class="btn btn-login w-100 text-white mb-3">
                                    <i class="fas fa-sign-in-alt me-2"></i>Login
                                </button>
                                
                                <div class="text-center">
                                    <a href="forgetpas.php" class="forgot-password">
                                        <i class="fas fa-question-circle me-1"></i>Lupa Password?
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Informasi Login Default -->
                    <div class="text-center mt-4 text-white">
                        <div class="card bg-dark bg-opacity-50 border-0">
                            <div class="card-body">
                                <h6><i class="fas fa-info-circle me-2"></i>Informasi Login Default</h6>
                                <small>Username: <strong>admin</strong> | Password: <strong>admin123</strong></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle show/hide password
        document.getElementById('showPassword').addEventListener('change', function() {
            const passwordField = document.getElementById('password');
            if (this.checked) {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        });

        // Auto-hide alert setelah 5 detik
        const alert = document.querySelector('.alert');
        if (alert) {
            setTimeout(() => {
                alert.classList.remove('show');
            }, 5000);
        }
    </script>
</body>
</html>