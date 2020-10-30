<?php
    session_start();
    include("connect.php");
?>

<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Rowan Cobelli</title>

        <link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/sign-in/">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
            integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <style>
            .bd-placeholder-img {
                font-size: 1.125rem;
                text-anchor: middle;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }

            @media (min-width: 768px) {
                .bd-placeholder-img-lg {
                    font-size: 3.5rem;
                }
            }
        </style>
        <link href="css/signin.css" rel="stylesheet">
        <link href="css/mystyle.css" rel="stylesheet">
    </head>

    <?php include('navbar.php'); ?>

    <body class="text-center">

        <form class="form-signin" method="POST" action="login.php">
            <img class="mb-4" src="img/logotwo.png">
            <h1 class="h3 mb-3 font-weight-normal">Sign-in</h1>
            <label class="sr-only">Email Address</label>
            <input type="email" class="mt-5 form-control" placeholder="Email Address" name="emailfield">
            <label class="sr-only">Password</label>
            <input type="password" class="form-control" placeholder="Password" name="passfield">
            <button class="mt-4 btn btn-lg btn-primary btn-block" type="submit" value="login">Continue</button>
        </form>
        <?php
            //client log in
            if(isset($_POST['emailfield'])){

                $client_email = $_POST['emailfield'];
                $passw = $_POST['passfield'];
                $client_email = htmlentities($client_email);
                $passw = htmlentities($passw);

                $stmt = $conn->prepare("SELECT email, pass address FROM clientdetails WHERE email=? AND pass=?");
                $stmt -> bind_param("ss", $client_email, $passw);
                $stmt -> execute();
                $stmt -> store_result(); 
                $stmt -> bind_result($client_email, $passw);
                $stmt -> fetch();
                $numrows = $stmt->num_rows;

                if($numrows> 0){
                    $_SESSION['clientlogin']=$client_email;
                    header('location:index.php');
                }
            }

            //owning data
            if(isset($_POST['emailfield'])){

                $email1 = $_POST['emailfield'];
                $passw1 = $_POST['passfield'];
                $email1 = htmlentities($email1);
                $passw1 = htmlentities($passw1);

                $stmt = $conn->prepare("SELECT id FROM clientdetails WHERE email=? AND pass=?");
                $stmt -> bind_param("ss", $email1, $passw1);
                $stmt -> execute();
                $stmt -> store_result(); 
                $stmt -> bind_result($id);
                $stmt -> fetch();
                $numcheck = $stmt->num_rows;

                if($numcheck > 0){
                    $_SESSION['client_id'] = $id;
                }
            }

            //admin log in
            if(isset($_POST['emailfield'])){

                $admin_email = $_POST['emailfield'];
                $admin_passw = $_POST['passfield'];
                $admin_email = htmlentities($admin_email);
                $admin_passw = htmlentities($admin_passw);

                $stmt = $conn->prepare("SELECT email FROM admindetails WHERE email=? AND pass=? ");
                $stmt -> bind_param("ss", $admin_email, $admin_passw);
                $stmt -> execute();
                $stmt -> store_result(); 
                $stmt -> bind_result($email);
                $admin_numcheck = $stmt->num_rows;

                if($admin_numcheck > 0){
                    $_SESSION['adminlogin']=$admin_email;
                    header('location:index.php');
                }
            }
        ?>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>