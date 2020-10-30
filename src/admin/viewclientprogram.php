<?php

  session_start();

  if(!isset($_SESSION['adminlogin'])){
    header('location:../login.php');
  }

  include('../connect.php');

  if(isset($_POST['client_id'])){

    $id_validation = $_POST['client_id'];

    $id_validation = htmlentities($id_validation);

    $stmt = $conn->prepare("SELECT clientprogram.week, clientprogram.minutes_per_day, 
    clientprogram.yoga_type, clientprogram.complete, clientprogram.client_program_id
    FROM clientprogram
    INNER JOIN clientdetails ON
    clientprogram.client_id = clientdetails.id WHERE clientdetails.id = ?");

    $stmt -> bind_param("i", $id_validation);
    $stmt -> execute();
    
    $stmt -> store_result(); 
    $stmt -> bind_result( $week, $minutes_per_day, $yoga_type, $complete, $client_program_id); 

  }else{
    header('location:viewclients.php');
  }

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

      <h4 class='myheadingbig'>View Client Program</h4>

      <p>Go <a href='viewclients.php'>back</a> to view clients.</p>

      <table class='table table-bordered'>
        <thead>
          <tr>
            <th scope='col'>Week</th>
            <th scope='col'>Yoga Type</th>
            <th scope='col'>Minutes per day</th>
            <th scope='col'>Complete</th>
            <th scope='col'>Edit</th>
          </tr>
        </thead>

      <?php

        while($stmt -> fetch()){
          
          echo"
            <tbody>
              <tr>
                <th scope='row'>$week</th>
                  <td>$yoga_type</td>
                  <td>$minutes_per_day</td>
                <td>
                    <p>$complete</p>
                </td>
                <td>
                  <div class='row'>
                    <div class='col-sm-12'>    
                      <form method='POST' action='changeclientprogram.php'>
                        <input type='hidden' value='$id_validation' name='id_validation'>
                        <input type='hidden' value='$client_program_id' name='client_program_id'>
                        <button type='submit' class='mb-2 btn btn-primary'>Edit Week</button>
                      </form>
                    </div>
                  </div>
                    <div class='row'>
                      <div class='col-sm-12'>    
                        <form class='form' method='POST' action='deleteweek.php'>
                          <input type='hidden' value='$client_program_id' name='client_program_id'>
                          <button type='submit' class='btn btn-primary'>Delete week</button>
                        </form>
                      </div>
                  </div>
                </td>
              </tr>
            </tbody>
          ";

        }

      ?>

    </table>

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