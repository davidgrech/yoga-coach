<?php

  session_start();

  if(!isset($_SESSION['adminlogin'])){
    header('location:../login.php');
  }

  if(isset($_POST['chosen_id'])){

    $chosen_id1 = $_POST['chosen_id'];

    $chosen_id1 = htmlentities($chosen_id1);

    $_SESSION['individual_chat']=$chosen_id1;

  header('location:individualchat.php');

  }

?>