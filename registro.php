<?php 

require 'database.php';

  $message = '';
  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $_POST['email']);
    // >> Encriptar contra
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    // << 
    $stmt->bindParam(':password', $password);
    if ($stmt->execute()) {
      $message = 'Acaba de registrarse exitosamente!!';
    } else {
      $message = 'Lo sentimos, ha ocurrido un problema :(';
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Registro</title>
  <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
  <?php require 'partials/header.php' ?>
  <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>
  <h1>Registrese</h1>
  <span>o <a href="ingreso.php">Ingrese</a></span>
  <form action="registro.php" method="post">
  <input name="email" type="text" placeholder="Ingrese su correo">
  <input name="password" type="password" placeholder="Ingresa tu contraseña">
  <input name="confirm_password" type="password" placeholder="Confirma tu contraseña">
  <input type="submit" value="Enviar">
  </form>
</body>
</html>