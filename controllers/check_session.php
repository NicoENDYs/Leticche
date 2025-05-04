<?php
session_start();

// Redirigir si no hay sesión activa o no es admin
if (!isset($_SESSION['usuario_id']) || $_SESSION['cargo'] !== 'ADMIN') {
    header("Location: ../views/Login.php?error=acceso_denegado");
    exit();
}