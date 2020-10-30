<?php

  session_start();

  if(!isset($_SESSION['adminlogin'])){
    header('location:../login.php');
  }

  if(isset($_POST['class_id'])){

    $class_id = $_POST['class_id'];
    $total_booked = $_POST['total_booked'];
    $date = $_POST['date'];
    $capacity = $_POST['capacity'];
    $start_time = $_POST['start_time'];
    $finish_time = $_POST['finish_time'];

    $class_id = htmlentities($class_id);
    $total_booked = htmlentities($total_booked);
    $date = htmlentities($date);
    $capacity = htmlentities($capacity);
    $start_time = htmlentities($start_time);
    $finish_time = htmlentities($finish_time);

    $_SESSION['edit_class_id']=$class_id;
    $_SESSION['edit_total_booked']=$total_booked;
    $_SESSION['date']=$date;
    $_SESSION['capacity']=$capacity;
    $_SESSION['start_time']=$start_time;
    $_SESSION['finish_time']=$finish_time;

  header('location:editclass.php');

}