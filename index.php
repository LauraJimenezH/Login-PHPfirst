<?php

  session_start();
  require 'database.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);
    $user = null;
    
    if (count($results) > 0) {
      $user = $results;
    }
  }

?>

  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bienvenido</title>
    <link rel="stylesheet" href="assets/css/main.css">
  </head>
  <body>
    <?php require 'partials/header.php' ?>
    <?php if(!empty($user)): ?>
      <br>Bienvenido <?= $user['email']; ?>
      <br>Has ingresado exitosamente!!
      <a href="cerrar-sesion.php">
        Logout
      </a>
    <?php else: ?>
      <h2>Porfavor Ingrese o Regristrese</h2>
      <a href="ingreso.php">Ingrese</a> o
      <a href="registro.php">Registrese</a>
    <?php endif; ?>
  </body>
  </html>