<?php
session_start();

// Redirigir si no hay sesión activa o no es admin
if (!isset($_SESSION['usuario_id']) || $_SESSION['cargo'] !== 'ADMIN') {
    header("Location: ../views/login.php?error=acceso_denegado");
    exit();
}

// En tu check_session.php
ini_set('session.gc_maxlifetime', 1800); // 30 minutos
session_set_cookie_params(1800);