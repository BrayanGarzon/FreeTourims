<?php 
    require 'database.php';
    $message = ''; /*variable de mensaje*/ 

    if (!empty($_POST['email']) && !empty($_POST['password'])){
        $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':email',$_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT); /*cifrar contraseñas*/ 
        $stmt->bindParam(':password',$password);


        if ($stmt->execute()){
            $message = 'SUCCESSFULLY CREATED NEW USER';
        } else {
            $message = "SORRY THERE MUST HAVE BEEN AN ISSUE CREATING YOUR PASSWORD";
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


    <link rel="stylesheet" href="assets/css/stylesphp.css">

</head>
<body>
    
    <?php if(!empty($message)):?>
        <p><?php $message ?></p>
    <?php endif; ?>
    <div class="card">
        <div class="card2">
            


            <form action="index.php" method="post">
                <h1>Sing-Up</h1>
                <input class="input" type="text" name="email" placeholder="Enter your Email" required autocomplete="none">
                <br>

                <input class="input" type="password" placeholder="Enter your password" name="password" required>
                
                <br>
                <div class="button">
                    <input class="input_button" type="submit" value="Enviar">
                </div>
                
            </form>
        </div>
    </div>

    
</body>
</html>