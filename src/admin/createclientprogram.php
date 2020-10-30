<?php

  session_start();

  if(!isset($_SESSION['adminlogin'])){
    header('location:../login.php');
  }

  include('../connect.php');

  $clients = "SELECT id, name FROM clientdetails WHERE id > 0";

  $result = $conn->query($clients);

  if(!$result){
      echo $conn->error;
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

  <h4 class='myheading'>Create Client Program</h4>
  <p>View clients and manage their program <a href='viewclients.php'>here</a></p> 
  <table class="table table-bordered table-sm">
    <tbody>
      <tr>
        <td>
          <form method='POST' action='createclientprogram.php'>
          <label><strong>Choose program details:</strong></label>
            <div class='form-row'>
              <div class='col-sm-12 my-1'>
              <label>Client name:</label>
                <select class='form-control' name='client_id'>

                  <?php
                    while($row = $result->fetch_assoc()){
                  ?>

                    <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>

                  <?php
                    }
                  ?>

                </select>
              <label>Week:</label>
                <select class='form-control' name='week'>
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                  <option>6</option>
                  <option>7</option>
                  <option>8</option>
                  <option>9</option>
                  <option>10</option>
                  <option>11</option>
                  <option>12</option>
                </select>
                <label>Minutes per day:</label>
                <select class='form-control' name='minutes_per_day'>
                  <option>15</option>
                  <option>30</option>
                  <option>45</option>
                  <option>60</option>
                  <option>75</option>
                  <option>90</option>
                  <option>105</option>
                  <option>120</option>
                </select>
                <label>Yoga type:</label>
                <select class='form-control' name='yoga_type'>
                  <option>Beginner Yoga</option>
                  <option>Hatha Yoga</option>
                  <option>Core Strength Yoga</option>
                  <option>Restorative Yoga</option>
                  <option>Pranayama Yoga</option>
                  <option>Meditation Yoga</option>
                  <option>Stress Reduction Yoga</option>
                  <option>Relax Yoga</option>
                </select>
              </div>
                <div class='p-2'>
                  <button type='submit' class='btn btn-primary'>Create program</button>
                </div>
            </div>
          </form>
        </td>
      </tr>
    </tbody>
  </table>

  <?php

    if(isset($_POST['client_id'])){

      $client_id = $_POST['client_id'];
      $week = $_POST['week'];
      $minutes = $_POST['minutes_per_day'];
      $yoga_type = $_POST['yoga_type'];
      $complete = 'No';

      $client_id = htmlentities($client_id);
      $week = htmlentities($week);
      $minutes = htmlentities($minutes);
      $yoga_type = htmlentities($yoga_type);

      $stmt = $conn->prepare("INSERT INTO clientprogram (client_id, week, minutes_per_day, yoga_type, complete) 
      VALUES ( ?, ?, ?, ?, ?)");

      $stmt->bind_param('iiiss', $client_id, $week, $minutes, $yoga_type, $complete);
      $stmt->execute();

          echo"<p>Client program created succesfully. If finished, Go <a href='admindash.php'>back</a> to the dashboard.</p> ";
          
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