<?php

  session_start();

  if(!isset($_SESSION['clientlogin'])){
    header('location:login.php');
  }
  $client_id = $_SESSION['client_id'];
  $client = htmlentities($client);

  include('../connect.php');

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

    <?php

      if(isset($_POST['delete_token'])){  

        //delete booking from clientbookings table
        $class_id = $_POST['class_id'];
        $class_id = htmlentities($class_id);

        $delete_booking = "DELETE FROM `clientbookings` WHERE class_id = ? AND client_id = ?";
        $stmt = $conn->prepare($delete_booking);
        $stmt->bind_param('ii', $class_id, $client_id);
        $stmt->execute();
      
        //update total booked by reducing 1
        $total_booked_id = $_POST['total_booked_id'];
        $total_booked_id -= 1;
        $total_booked_id = htmlentities($total_booked_id);
        $class_id = htmlentities($class_id);
  
        $reduce_booked_total = "UPDATE `classes` SET `total_booked_id` = ? WHERE `classes`.`id` = ?";
        $stmt = $conn->prepare($reduce_booked_total);
        $stmt->bind_param('ii', $total_booked_id, $class_id);
        $stmt->execute();
        
        header('location:../classes.php');
        exit();

      }

      if(isset($_POST['class_id'])){

        $class_id = $_POST['class_id'];
        $total_booked = $_POST['total_booked'];
        $total_booked_id = $_POST['total_booked_id'];
        $class_id = htmlentities($class_id);
        $total_booked = htmlentities($total_booked);
        $client_id = htmlentities($client_id);

        // insert a new booking into clientbookings table
        $insert_client_booking = "INSERT INTO `clientbookings` (`id`, `class_id`, `client_id`) VALUES (NULL, ?, ?) ";
        $stmt = $conn->prepare($insert_client_booking);
        $stmt->bind_param('ii', $class_id, $client_id);
        $stmt->execute();

        //update classes table to show new number of clients booked for that class
        $total_booked_id += 1;

        $total_booked_id = htmlentities($total_booked_id);
        $class_id = htmlentities($class_id);
        $update_booked_total = "UPDATE `classes` SET `total_booked_id` = ? WHERE `classes`.`id` = ?";

        $stmt = $conn->prepare($update_booked_total);
        $stmt->bind_param('ii', $total_booked_id, $class_id);
        $stmt->execute();
        echo"
          <h4 class='myheading'>Class Booked!</h4>
          <table class='table table-bordered table-sm'>
            <tbody>
              <tr>
                <td>
                  <p><strong>Class booked succesfully. Go <a href='../classes.php'>back</a> to view classes</strong></p>
                </td>
              </tr>
            </tbody>
          </table>
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