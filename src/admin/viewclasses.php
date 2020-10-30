<?php

  session_start();

  if(!isset($_SESSION['adminlogin'])){
    header('location:../login.php');
  }

  include('../connect.php');

  $read = "SELECT classes.id, classes.text, classes.date, classes.start_time, 
  classes.finish_time, classes.capacity, classes.total_booked_id, bookedclasses.total_booked
  FROM classes
  INNER JOIN bookedclasses ON
  classes.total_booked_id = bookedclasses.id ORDER BY date ASC";

  $result1 = $conn->query($read);

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Rowan Cobelli</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <link href="../css/mystyle.css" rel="stylesheet">

</head>

<?php include('../navbar.php'); ?>

<body>

  <div id="mycontainer">

    <h4 class='myheadingbig'>View classes</h4>

    <p>Go <a href='admindash.php'>back</a> to the dashboard.</p>

    <?php
    
      if(!$result1){
        echo $conn->error;
      }

      while($row = $result1->fetch_assoc()){

        $class_id = $row['id'];
        $yoga_type = $row['text'];
        $start_time = $row['start_time'];
        $finish_time = $row['finish_time'];
        $capacity = $row['capacity'];
        $total_booked = $row ['total_booked'];
        $total_booked_id = $row ['total_booked_id'];
        $date = $row['date'];
        $date = date('d-m-Y', strtotime(str_replace('-', '/', $date)));

        echo" 
          <div class='card form-row my-4'>
            <div class='col-sm-12'>
              <p>
                <p><strong>Yoga Type : </strong>$yoga_type</p>
                <p><strong>Date : </strong>$date</p>
                <p><strong>Start time : </strong>$start_time</p>
                <p><strong>Finish time : </strong>$finish_time</p>
                <p><strong>Capacity : </strong>$capacity</p>
                <p><strong>Bookings : </strong>$total_booked</p>
              </p>
        ";

        echo"
              <div class='row'>
                <div class='col-sm-4'>  
                  <form class='form' method='POST' action='classeditsession.php'>
                    <input type='hidden' value='$class_id' name='class_id'>
                    <input type='hidden' value='$total_booked' name='total_booked'>
                    <input type='hidden' value='$date' name='date'>
                    <input type='hidden' value='$capacity' name='capacity'>
                    <input type='hidden' value='$start_time' name='start_time'>
                    <input type='hidden' value='$finish_time' name='finish_time'>
                      <button type='submit' class='m-2 btn btn-primary'>Change class</button>
                  </form>
                </div>
                <div class='col-sm-4'>
                  <form class='form' method='POST' action='cancelclass.php'>
                    <input type='hidden' value='$class_id' name='class_id'>
                    <input type='hidden' value='' name='delete_token'>  
                    <button type='submit' class='m-2 btn btn-primary'>Cancel class</button>
                  </form>
                </div>
                <div class'col-sm-4'>
                </div>
              </div>

            </div>
          </div>
            
        ";

      } 
          
    ?>
  
  </div>

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>

</body>

</html>