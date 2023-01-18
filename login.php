<?php
session_start();

require 'database.php';

if (!empty($_POST['email']) && !empty($_POST['password'])) {
  $records = $conn->prepare('SELECT id, email, password FROM users WHERE email = :email');
  $records->bindParam(':email', $_POST['email']);
  $records->execute();
  $results = $records->fetch(PDO::FETCH_ASSOC);

  $message = '';

  if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
    $_SESSION['user_id'] = $results['id'];
    header("Location: home.php");
  } else {
    $message = 'Sorry, those credentials do not match';
  }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN - LOGIN</title>

   

    <!--============ICON PAGE ================-->
    <link rel="shortcut icon" href="/assets/img/iconAdmin.png" type="image/png">



    <!--=============== REMIXICONS ===============-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">


    <link rel="stylesheet" href="./stylesphp.css">

</head>
<body>
    
<?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>
    

    <?php require 'partials/header.php' ?>


        <form action="login.php" method="POST">
            <input name="email" type="text" placeholder="Enter your email">
            <input name="password" type="password" placeholder="Enter your Password">
            <input type="submit" value="Submit">
        </form>


    
</body>
</html>