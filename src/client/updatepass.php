<?php
  session_start();
  if(!isset($_SESSION['clientlogin'])){
    header('location:../login.php');
  }
  include('../connect.php');
  $client = $_SESSION['client_id'];
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
        $detail = $_POST['detail_update'];
        $detail = htmlentities($detail);
        $client = htmlentities($client);

        $update = "UPDATE clientdetails SET pass=? WHERE id=?";
        $stmt = $conn->prepare($update);
        $stmt->bind_param('si', $detail, $client);
        $stmt->execute();
        $stmt->close();
        $conn->close();

        echo"
          <h4 class='myheading'>Success</h4>
          <table class='table table-bordered table-sm'>
            <tbody>
              <tr>
                <td>
                  <p><strong>You successfully updated your password. Go <a href='../account.php'>back</a>
                  to see the change.</strong></p>
                </td>
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