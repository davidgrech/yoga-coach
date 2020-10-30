<?php

  session_start();

  if(!isset($_SESSION['clientlogin'])){
    header('location:login.php');
  }

  include('connect.php');
  $client = $_SESSION['client_id'];
  $client = htmlentities($client);

  $stmt = $conn->prepare("SELECT id, email, pass, name, phone, address FROM clientdetails WHERE id = ? ");
  $stmt -> bind_param("i", $client);
  $stmt -> execute();
  $stmt -> store_result(); 
  $stmt -> bind_result($id, $email, $pass, $name, $phone, $address); 
  $stmt -> fetch();

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
    <h4 class='myheading'>Account Details</h4>
    <table class="table table-bordered table-sm">
      <tbody>
        <?php
          echo"
            <tr>
              <td>
                <form method='POST' action='client/editemail.php'>
                <label><strong>E-mail:</strong></label>
                  <div class='form-row'>
                    <div class='col-sm-9 my-1'>
                      <input type='email' readonly class='form-control-plaintext'
                      value='$email' name='post_detail'>
                    </div>
                    <div class='col-3 my-1'>
                      <button type='submit' class='btn btn-primary'>Edit</button>
                    </div>
                  </div>
                </form>
              </td>
            </tr>
            <tr>
              <td>
                <form method='POST' action='client/editpass.php'>
                  <label><strong>Password:</strong></label>
                  <div class='form-row'>
                    <div class='col-sm-9 my-1'>
                      <input type='password' readonly class='form-control-plaintext'
                      value='$pass' name='post_detail'>
                    </div>
                    <div class='col-3 my-1'>
                      <button type='submit' class='btn btn-primary'>Edit</button>
                    </div>
                  </div>
                </form>
              </td>
            </tr>
            <tr>
              <td>
                <form method='POST' action='client/editname.php'>
                <label><strong>Name:</strong></label>
                  <div class='form-row'>
                    <div class='col-sm-9 my-1'>
                      <input type='text' readonly class='form-control-plaintext'
                      value='$name' name='post_detail'>
                    </div>
                    <div class='col-3 my-1'>
                      <button type='submit' class='btn btn-primary'>Edit</button>
                    </div>
                  </div>
                </form>
              </td>
            </tr>
            <tr>
              <td>
                <form method='POST' action='client/editphone.php'>
                <label><strong>Phone:</strong></label>
                  <div class='form-row'>
                    <div class='col-sm-9 my-1'>
                    <input type='text' readonly class='form-control-plaintext'
                      value='$phone' name='post_detail'>
                    </div>
                    <div class='col-3 my-1'>
                      <button type='submit' class='btn btn-primary'>Edit</button>
                    </div>
                  </div>
                </form>
              </td>
            </tr>
            <tr>
              <td>
                <form method='POST' action='client/editaddress.php'>
                <label><strong>Address:</strong></label>
                  <div class='form-row'>
                    <div class='col-sm-9 my-1'>
                      <input type='text' readonly class='form-control-plaintext'
                      value='$address' name='post_detail'>
                    </div>
                    <div class='col-3 my-1'>
                      <button type='submit' class='btn btn-primary'>Edit</button>
                    </div>
                  </div>
                </form>
              </td>
            </tr>
          ";
        ?>
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