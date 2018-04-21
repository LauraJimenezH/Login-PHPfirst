<?php

session_start();
if (isset($_SESSION['user_id'])) {
  header('Location: /php-login');
}
require 'database.php';

if (!empty($_POST['email']) && !empty($_POST['password'])) {
  $records = $conn->prepare('SELECT id, email, password FROM users WHERE email = :email');
  $records->bindParam(':email', $_POST['email']);
  $records->execute();
  $results = $records->fetch(PDO::FETCH_ASSOC);
  $message = '';
  if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
    $_SESSION['user_id'] = $results['id'];
    header("Location: /php-login");
  } else {
    $message = 'Lo sentimos, los datos ingresados no coinciden';
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Ingreso</title>
  <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
  <?php require 'partials/header.php' ?>
  <?php if(!empty($message)): ?>
    <p> <?= $message ?></p>
  <?php endif; ?>
  <h1>Ingrese</h1>
  <span>o <a href="registro.php">Registrese</a></span>
  <form action="ingreso.php" method="post">
    <input type="text" name="email" placeholder="Ingrese su correo">
    <input type="password" name="password" placeholder="Ingrese su contraseña">
    <input type="submit" value="Enviar">
  </form>
</body>
</html>