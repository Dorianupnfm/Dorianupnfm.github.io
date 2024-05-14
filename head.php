<?php
session_start();
include "config/config.php";
if (!isset($_SESSION['user_id']) && $_SESSION['user_id'] == null) {
    header("location: index.php");
}
?>
<?php
$id = $_SESSION['user_id'];
$query = mysqli_query($con, "SELECT * from user where id=$id");
while ($row = mysqli_fetch_array($query)) {
    $status = $row['status'];
    $is_deleted = $row['is_deleted'];
    $name = $row['name'];
    $email = $row['email'];
    $profile_pic = $row['profile_pic'];
    $is_admin = $row['is_admin'];
}

$website = "website";
$querycoin = mysqli_query($con, "select * from configuration where name='$website' ");
if ($r = mysqli_fetch_array($querycoin)) {
    $website_name = $r['val'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
    <title><?php echo $title . " " . $website_name; ?> </title>
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/fullcalendar.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="assets/plugins/morris/morris.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">


</head>

<!--  <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">
                        <div class="navbar nav_title" style="border: 0;">
                          <a href="#" class="site_title"><i class="fa fa-bar-chart"></i> <span><?php echo $website_name; ?></span></a>
                        </div>
                        <div class="clearfix"></div>

                            <!-- menu profile quick info -->
<!-- <div class="profile clearfix"> -->
<!-- <div class="profile_pic"> -->
<!-- <img src="images/profiles/<?php echo $profile_pic; ?>" alt="<?php echo $name; ?>" class="img-circle profile_img"> -->
<!-- </div> -->
<!-- <div class="profile_info"> -->
<!-- <span>Bienvenido,</span> -->
<!-- <h2><?php echo $name; ?></h2> -->
<!-- </div> -->
<!-- </div> -->
<!-- /menu profile quick info -->

<!-- <br /> -->