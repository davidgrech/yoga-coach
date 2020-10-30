<?php

  session_start();

  if(!isset($_SESSION['adminlogin'])){
    header('location:../login.php');
  }

  include('../connect.php');

  $read = "SELECT * FROM clientdetails ORDER BY name ASC";

  $result = $conn->query($read);

  if(!$result){
    echo $conn->error;
  } else {
    
  }

  $counter = 0;

  while($row = $result->fetch_assoc()){

    $get_name = $row['name'];
    $get_id = $row['id'];

    $name_array[$counter] = $get_name;
    $id_array[$counter] = $get_id;

    $counter++;

  }

  $start=0;
  $max=count($name_array);

  while ($start < $max) {
    $id = $id_array[$start];
    $name = $name_array[$start];
    $start++;
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

    <h4 class='myheadingbig'>Chat Dashboard</h4>
    <h4 class='myheadingdash'>Individual chat</h4>
    <table class="table table-bordered table-sm">
      <tbody>
        <form method='POST' action='individualchatsession.php'>
          <tr>
            <td>
              <div class='form-row'>
                <div class='col-sm-3'>
                  <p>Pick a client to chat with</p>
                </div>
                <div class='col-sm-5'>
                  <?php

                    $start=0;
                    $max=count($name_array);

                    echo"<select class='form-control' name='chosen_id'>";

                    while ($start < $max) {
                      $id = $id_array[$start];
                      $name = $name_array[$start];
                      echo "<option value='$id'>$name</option>";
                      $start++;
                    }
                  ?>
                  </select>
                </div>
                <div class='col-4'>      
                  <button type='submit' class='btn btn-primary m-1'>Choose Client</button>
                </div>
              </div>
            </td>
          </tr>
        </form>
      </tbody>
    </table>

    <h4 class='myheadingdash'>Send message to multiple clients</h4>
    <table class="table table-bordered table-sm">
      <tbody>
        <tr>
          <td>
            <div class='form-row'>
              <div class='col-sm-9'>
                <p>Send a message to multiple clients here</p>
              </div>
              <div class='col-3'>      
                <a class="btn btn-primary" href="chatgroup.php" role="button">Go</a>
              </div>
            </div>
          </td>
        </tr>
      </tbody>
    </table>

    <h4 class='myheadingdash'>Send message to all clients</h4>
    <table class="table table-bordered table-sm">
      <tbody>
        <tr>
          <td>
            <div class='form-row'>
              <div class='col-sm-9'>
                <p>Send a message to all clients here</p>
              </div>
              <div class='col-3'>     
                <a class="btn btn-primary" href="chateveryone.php" role="button">Go</a>
              </div>
            </div>
          </td>
        </tr>
      </tbody>
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