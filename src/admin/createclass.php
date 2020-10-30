<?php

  session_start();

  if(!isset($_SESSION['adminlogin'])){
    header('location:../login.php');
  }

  include('../connect.php');

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

    <h4 class='myheading'>Create New Class</h4>
    <table class="table table-bordered table-sm">
      <tbody>
        <tr>
          <td>
            <form method='POST' action='createclass.php'>
            <label><strong>Enter class details:</strong></label>
              <div class='form-row'>
                <div class='col-sm-12 my-1'>
                  <label><strong>Yoga type:</strong></label>
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
                  <label><strong>Date:</strong></label>
                    <input placeholder='Select Date...' class='date form-control bg-white' name='date'/>
                  <label><strong>Start Time:</strong></label>
                    <input placeholder="Select Start Time..." class='start_time form-control bg-white' name='start_time'/>
                  <label><strong>Finish Time:</strong></label>
                    <input placeholder="Select Finish Time..." class='finish_time form-control bg-white' name='finish_time'/>
                  <label><strong>Capacity:</strong></label>
                    <input type='text' class='form-control'value='' name='capacity'>
                </div>
                <div class='p-2'>
                  <button type='submit' class='btn btn-primary'>Create class</button>
                </div>
              </div>
            </form>
          </td>
        </tr>
      </tbody>
    </table>

    <?php

      if(isset($_POST['date'])){

        $string = $_POST['yoga_type'];
        $colour = '';

          //gives calendar classes their own colour
          switch ($string) {
            case 'Personalised 1-to-1 Yoga':
                $colour = '#4CAF50';
                break;
            case 'Beginner Yoga':
                $colour = '#03A9F4';
                break;
            case 'Hatha Yoga':
                $colour = '#FF4081';
                break;
            case 'Core Strength Yoga':
                $colour = '#FF5252';
                break;
            case 'Restorative Yoga':
                $colour = '#009688';
                break;
            case 'Pranayama Yoga':
                $colour = '#795548';
                break;
            case 'Meditation Yoga':
                $colour = '#3F51B5';
                break;
            case 'Stress Reduction Yoga':
                $colour = '#E040FB';
                break;
            default:
            $colour = 'default';
          }

          $yoga_type = $_POST['yoga_type'];
          $yoga_type1 = $_POST['yoga_type'];
          $start_time = $_POST['start_time'];
          $finish_time = $_POST['finish_time'];
          $capacity = $_POST['capacity'];
          $date = $_POST['date'];

          $date = str_replace('/', '-', $date);
          $date = date('Y-m-d', strtotime($date));

          $start_date = $date.' '.$start_time;
          $end_date = $date.' '.$finish_time;

          $start_date = htmlentities($start_date);
          $end_date = htmlentities($end_date);
          $yoga_type = htmlentities($yoga_type);
          $start_time = htmlentities($start_time);
          $finish_time = htmlentities($finish_time);
          $capacity = htmlentities($capacity);
          $date = htmlentities($date);

          $bookings = 100;
          $text_colour = 'white';

          $stmt = $conn->prepare("INSERT INTO classes (date, start_time, finish_time, capacity, total_booked_id, start_date, end_date, text, color, textColor) 
                                  VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ");

          $stmt->bind_param('sssiisssss', $date, $start_time, $finish_time, $capacity, $bookings, $start_date, $end_date, $yoga_type, $colour, $text_colour);
          $stmt->execute();

          echo"<p>Class created succesfully. Go <a href='admindash.php'>back</a> to the dashboard</p> ";
            
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
