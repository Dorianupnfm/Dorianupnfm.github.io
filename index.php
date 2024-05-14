<?php

    if (!file_exists ('config/db.php')){
        header("location: install/paso1.php");
        exit;
    }
    session_start();

    include "config/config.php";

    if (isset($_SESSION['user_id']) && $_SESSION!==null) {
       header("location: profile.php");
    }


    $website = "website";
    $querycoin = mysqli_query($con,"select * from configuration where name=\"$website\" ");
    if ($r = mysqli_fetch_array($querycoin)) {
        $website_name=$r['val'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
    <title>Iniciar sesión</title>
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!--[if lt IE 9]>
        <script src="assets/js/html5shiv.min.js"></script>
        <script src="assets/js/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <div class="main-wrapper">
        <div class="account-page">
            <div class="container">
                <h3 class="account-title">Iniciar sesión</h3>
                <div class="account-box">
                    <div class="account-wrapper">
                        <div class="account-logo">
                            <a href="index.php"><img src="assets/img/logosw.png" alt="Preadmin"></a>
                        </div>
                        <form action="action/login.php" method="post">
                        <?php 
                            $error=sha1(md5("cuenta inactiva"));
                            if (isset($_GET['error']) && $_GET['error']==$error) {
                                echo "<div class='alert alert-warning alert-dismissible fade in' role='alert'>
                                    <strong>Error!</strong> Cuenta Inactiva
                                    </div>";
                            }
                            $invalid=sha1(md5("contrasena y email invalido"));
                            if (isset($_GET['invalid']) && $_GET['invalid']==$invalid) {
                                echo "<div class='alert alert-danger alert-dismissible' role='alert'>
                                    <strong>Error!</strong> Contraseña o correo Electrónico invalido
                                    </div>";
                            }
                        ?>
                            <div class="form-group form-focus">
                                <label class="focus-label">Correo electrónico</label>
                                <input class="form-control floating" type="text" name="email" required>
                            </div>
                            <div class="form-group form-focus">
                                <label class="focus-label">Contraseña</label>
                                <input class="form-control floating" type="password" name="password" required>
                            </div>
                            <div class="form-group text-center">
                                <button class="btn btn-primary btn-block account-btn" name="token" value="Login"  type="submit">Iniciar sesión</button>
                            </div>
                           <!--  <div class="text-center">
                                <a href="forgot-password.html">Forgot your password?</a>
                            </div> -->
                            <div class="clearfix"></div>
                            <div class="separator">
                                <div class="clearfix"></div>
                                <br />
                                <div>
                                    <h1 class='text-center'> <?php echo $website_name;?></h1>
                                    <p>© <?php echo date("Y"); ?> Todos los creditos a: <a style="text-decoration: underline;" target="_blank" > Comunicaciones  |  A-1</a></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="assets/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="assets/js/popper.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/app.js"></script>
</body>
</html>


