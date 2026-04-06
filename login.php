<?php
header('Content-Type: text/html; charset=utf8mb4');
session_start();
include 'includes/conexion.php';

// Si ya est¨¢ logueado, redirige al dashboard
if(isset($_SESSION['user_id'])){
    header("Location: dashboard.php");
    exit();
}

$error = '';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $conn->prepare("SELECT * FROM RH WHERE correo=? AND rol=1 AND activo=1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        $user = $result->fetch_assoc();

        if($password == $user['password']){
            $_SESSION['user_id'] = $user['id_trabajador'];
            $_SESSION['nombre'] = $user['nombre'];
            $_SESSION['rol'] = $user['rol'];

            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Credenciales incorrectas";
        }
    } else {
        $error = "No usuario";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Sistema ecofriendlysolutions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #d8e0d6 0%, #89b5c7 100%);
            min-height: 100vh;
        }

        .login-container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .login-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
            width: 100%;
            max-width: 400px;
            padding: 40px 30px;
        }

        .logo-section {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo-section img {
            max-width: 120px;
            height: auto;
            margin-bottom: 15px;
        }

        .logo-section h3 {
            color: #268db5;
            font-weight: bold;
            margin: 0;
        }

        .logo-section p {
            color: #666;
            font-size: 0.9rem;
            margin-top: 5px;
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 10px 15px;
            font-size: 0.95rem;
        }

        .form-control:focus {
            border-color: #268db5;
            box-shadow: 0 0 0 0.2rem rgba(105, 48, 21, 0.15);
        }

        .btn-login {
            background: #268db5;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 10px;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-login:hover {
            background: #268db5;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(105, 48, 21, 0.3);
        }

        .alert {
            border-radius: 8px;
            border: none;
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="login-card">
        
        <!-- LOGO Y T??TULO -->
        <div class="logo-section">
            <img src="assets/images/logo.png" alt="Logo Panader&iacute;a RASHE">
            <h3>ecofriendlysolutions</h3>
            <p>Sistema de Gesti&oacute;n</p>
        </div>

        <!-- T??TULO -->
        <h4 class="text-center mb-4" style="color: #333;">Iniciar Sesi&oacute;n</h4>

        <!-- ERRORES -->
        <?php if(!empty($error)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-circle"></i> <?php echo htmlspecialchars($error); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- FORMULARIO -->
        <form method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electronico</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="tu@correo.com" required autofocus>
            </div>

            <div class="mb-4">
                <label for="password" class="form-label">Clave</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Tu clave" required>
            </div>

            <button type="submit" class="btn btn-login w-100 mb-3">
                <i class="bi bi-box-arrow-in-right"></i> Entrar
            </button>
        </form>

        <!-- PIE DE P??GINA -->
        <p class="text-center text-muted" style="font-size: 0.85rem; margin-top: 20px;">
            2026 ecofriendlysolutions - Creado por TechDomotic
        </p>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>