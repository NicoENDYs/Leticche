<?php
session_start();
require_once '../models/MySQL.php';

$mysql = new MySQL;
$mysql->conectar();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //verificamos la existencia de los campos
    if (isset($_POST['usuario_id'], $_POST['total_pedido'])) {

        //obtenemos los datos del formulario antes de validar o sanitizar
        $idUsuario = trim($_POST['usuario_id']);
        $totalPedido = trim($_POST['total_pedido']);

        if (empty($idUsuario) || empty($totalPedido)) {
            echo "Por favor, complete todos los campos.";
            header("Location: ../views/carrito.php?error=102");
            exit();
        }

        //insertar en base de datos 
        $consulta = "INSERT INTO pedidos 
            (usuario_id, fecha, total)
            VALUES 
            ('$idUsuario', NOW(), '$totalPedido')";
        $mysql->efectuarConsulta($consulta);
        
        $mysql->desconectar();
        header("Location: ../index.php");
        exit();
    } else {
        header("Location: ../views/carrito.php?error=102");
            exit();
    }
} else {
    echo "Metodo de envio invalido";
    header("Location: ../views/carrito.php?error=102");
            exit();
}
?>