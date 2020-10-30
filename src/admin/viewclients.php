<?php

  session_start();

  if(!isset($_SESSION['adminlogin'])){
    header('location:../login.php');
  }

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

    <h4 class='myheadingbig'>View Clients</h4>

    <p>Go <a href='admindash.php'>back</a> to the dashboard.</p>

    <?php

      $read = "SELECT * FROM clientdetails WHERE id > 0";

      $result1 = $conn->query($read);

      if(!$result1){
        echo $conn->error;
      } 

      echo"<table class='table table-bordered'>";

      while($row = $result1->fetch_assoc()){

        $get_id = $row['id'];
        $get_name = $row['name'];
        $get_email = $row['email'];
        $get_phone = $row['phone'];
        $get_address = $row ['address'];

        echo"
          <tbody>
            <tr>
              <td>
                <div class='form-row'>
                  <div class='col-sm-9 my-1'>
                    <form method='POST' action='viewclientprogram.php'>
                      <p><strong>Name: </strong>$get_name</p>
                      <p><strong>Email: </strong>$get_email</p>
                      <p><strong>Phone number: </strong>$get_phone</p>
                      <p><strong>Address: </strong>$get_address</p>
                      <input type='hidden' value='$get_id' name='client_id'>
                      <button type='submit' class='btn btn-primary'>View program</button>
                    </form>
                  </div>
                </div>
              </td>
            </tr>
          </tbody>
        ";

      }

      echo"</table>";

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