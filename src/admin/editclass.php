<?php

  session_start();

  if(!isset($_SESSION['adminlogin'])){
    header('location:../login.php');
    }

  include('../connect.php');

  if(isset($_SESSION['edit_class_id'])){

    $class_id1 = $_SESSION['edit_class_id'];
    $total_booked1 = $_SESSION['edit_total_booked'];
    $date1 = $_SESSION['date'];
    $capacity1 = $_SESSION['capacity'];
    $start_time1 = $_SESSION['start_time'];
    $finish_time1 = $_SESSION['finish_time'];

  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Health Coach</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link href="../css/mystyle.css" rel="stylesheet">
  
  <style type="text/css">
    body {
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI",
        "Roboto", "Oxygen", "Ubuntu", "Helvetica Neue", Arial, sans-serif;
    }

    label > div {
      margin-bottom: 4px;
    }
  </style>
</head>

<?php include('../navbar.php'); ?>

<body>

  <div id="mycontainer">

    <h4 class='myheading'>Change class details</h4>

    <table class="table table-bordered table-sm">
      <tbody>
        <tr>
          <td>
            <form method='POST' action='editclass.php'>
            <label><strong>Enter class details:</strong></label>
              <div class='form-row'>
                <div class='col-sm-12 my-1'>
                  <input type='hidden' value='<?php echo"$class_id1" ?>' name='class_id'>  
                  <label>Yoga type:</label>
                    <select class='form-control' name='yoga_type'>
                      <option>Personalised 1-to-1 Yoga</option>
                      <option>Beginner Yoga</option>
                      <option>Hatha Yoga</option>
                      <option>Core Strength Yoga</option>
                      <option>Restorative Yoga</option>
                      <option>Pranayama Yoga</option>
                      <option>Meditation Yoga</option>
                      <option>Stress Reduction Yoga</option>
                    </select>
                    <label>Date:</label>
                        <input value='<?php echo"$date1" ?>'class='date form-control bg-white' name='date'/>
                    <label>Start Time:</label>
                        <input value='<?php echo"$start_time1" ?>' class='start_time form-control bg-white' name='start_time'/>
                    <label>Finish Time:</label>
                        <input value='<?php echo"$finish_time1" ?>' class='finish_time form-control bg-white' name='finish_time'/>
                    <label>Capacity:</label>
                        <input value='<?php echo"$capacity1" ?>' type='text' class='form-control'value='' name='capacity'>
                    <label>Total Booked:</label>
                        <input type='text' class='form-control'value='<?php echo"$total_booked1" ?>' name='total_booked'>
                </div>
                <div class='p-2'>
                    <button type='submit' class='btn btn-primary'>Change class</button>
                </div>
              </div>
            </form>
          </td>
        </tr>
      </tbody>
    </table>

    <?php

      if(isset($_POST['class_id'])){

        $class_id2 = $_POST['class_id'];
        $yoga_type2 = $_POST['yoga_type'];
        $start_time2 = $_POST['start_time'];
        $finish_time2 = $_POST['finish_time'];
        $capacity2 = $_POST['capacity'];
        $total_booked2 = $_POST['total_booked'];
        $date2 = $_POST['date'];

        $date2 = str_replace('/', '-', $date2);
        $date2 = date('Y-m-d', strtotime($date2));

        $start_date = $date2.' '.$start_time2;
        $end_date = $date2.' '.$finish_time2;

        $total_booked_id = $total_booked2 +100;

        $start_date = htmlentities($start_date);
        $end_date = htmlentities($end_date);
        $class_id2 = htmlentities($class_id2);
        $yoga_type2 = htmlentities($yoga_type2);
        $start_time2 = htmlentities($start_time2);
        $finish_time2 = htmlentities($finish_time2);
        $capacity2 = htmlentities($capacity2);
        $total_booked_id = htmlentities($total_booked_id);
        $date2 = htmlentities($date2);

        $stmt = $conn->prepare("UPDATE classes 
        SET text =?, date =?, start_time =?, finish_time =?, capacity =?, total_booked_id =?, start_date=?, end_date=? WHERE classes.id =? ");

        $stmt->bind_param('ssssiissi', $yoga_type2, $date2, $start_time2, $finish_time2, $capacity2, $total_booked_id, $start_date, $end_date, $class_id2);
        $stmt->execute();

        echo"<p>Class changed succesfully. Go <a href='viewclasses.php'>back</a> to view classes</p>";

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

  <!-- classList polyfill for IE9 -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/classlist/1.2.20171210/classList.min.js"></script>

  <script>

    var fp = flatpickr(".date", {

    dateFormat: "d-m-Y",

    });

    var fp1 = flatpickr(".start_time", {

    noCalendar: true,
    enableTime: true,
    dateFormat: "H:i",

    });

    var fp1 = flatpickr(".finish_time", {

    noCalendar: true,
    enableTime: true,
    dateFormat: "H:i",

    });

  </script>
</body>
</html>
