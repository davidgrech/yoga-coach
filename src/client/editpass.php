<?php
  session_start();
  if(!isset($_SESSION['clientlogin'])){
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
      <?php
        $detail = $_POST['post_detail'];
        $detail = htmlentities($detail);
          echo" 
            <h4 class='myheading'>Change Your Password</h4>
            <table class='table table-bordered table-sm'>
              <tbody>
                <tr>
                  <form method='POST' action='updatepass.php'>
                    <td>
                      <label><strong>Enter new password</strong></label>
                      <div class='form-row align-items-center'>
                        <div class='col-sm-7 my-1'>
                          <input type='password' class='form-control'
                            value='$detail' name='detail_update'>
                        </div>
                        <div class='col-5 my-1'>
                          <button type='submit' class='btn btn-primary'>Save changes</button>
                        </div>
                      </div>
                      <p>Must be no more than 20 characters long</p>
                    </td>
                  </form>
                </tr>
              </tbody>
            </table>
          ";
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