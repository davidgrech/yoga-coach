<?php

  session_start();

  if(!isset($_SESSION['clientlogin'])){
      header('location:login.php');
  }
  $client_id = $_SESSION['client_id'];
  $client = htmlentities($client);
  
  include('connect.php');

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

  <link href="css/mystyle.css" rel="stylesheet">

</head>

<?php include('navbar.php'); ?>

<body>

  <div id="mycontainer">

    <h4 class='myheading'>Book a Class</h4>

    <div id='mycontainer' class="mb-4 alert alert-warning" role="alert" style="text-align: center">
      <a href="calendar/calendar.php" class="alert-link">View Calendar</a>
    </div>

    <?php

      $stmt = $conn->prepare("SELECT id FROM clientbookings WHERE class_id=? AND client_id=? ");
    
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
          <div class='card form-row'>
            <div class='col-sm-12'>
              <p>
                <p><strong>Yoga Type : </strong>$yoga_type</p>
                <p><strong>Date : </strong>$date</p>
                <p><strong>Start time : </strong>$start_time</p>
                <p><strong>Finish time : </strong>$finish_time</p>
                <p><strong>Capacity : </strong>$capacity</p>
                <p><strong>Bookings : </strong>$total_booked</p>
              </p>
                <div class='col- m-1'>    
                  <form method='POST' action='client/changeclass.php'>
                    <div class='col-'>
                      <input type='hidden' value='$class_id' name='class_id'>
                      <input type='hidden' value='$client_id' name='client_id'>
                      <input type='hidden' value='$capacity' name='class_capacity'>
                      <input type='hidden' value='$total_booked' name='total_booked'>
                      <input type='hidden' value='$total_booked_id' name='total_booked_id'>
        ";
                      $client_id = htmlentities($client_id);
                      $class_id = htmlentities($class_id);

                      $stmt -> bind_param("ii", $class_id, $client_id);
                      $stmt -> execute();
                      $stmt -> store_result();
                      $stmt -> bind_result($id);
                      $stmt -> fetch();
                      $numrows = $stmt->num_rows;

                      if($numrows> 0){
                        echo" <a class='btn btn-primary mb-2' href='#' role='button'>Class allready booked</a>";
                        echo" <input type='hidden' value='' name='delete_token'>  
                        <button type='submit' class='btn btn-primary mb-2'>Cancel class</button>";
                      }else{
                        if($total_booked==$capacity){
                          echo" <a class='btn btn-primary' href='#' role='button'>Class is full</a>";
                        }else{
                          echo" <button type='submit' class='btn btn-primary'>Book</button>";
                        }
                      }
        echo"              
                    </div>
                  </form>
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