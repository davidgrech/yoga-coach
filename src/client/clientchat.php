<?php

  session_start();

  if(!isset($_SESSION['clientlogin'])){
    header('location:../login.php');
  }

  include('../connect.php');

  $client = $_SESSION['client_id'];
  $details = "SELECT * FROM clientdetails WHERE id = '$client' ";
  $result = $conn->query($details);

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
      if(!$result){
        echo $conn->error;
      }
      while($row = $result->fetch_assoc()){
        $id = $row['id'];
        $name = $row['name'];
      }
    ?>
    <h4 class='myheading'>Chat</h4>
      <form method='POST' action='clientchat.php'>
        <label><strong>Enter message details:</strong></label>
          <div class='form-row'>
            <div class='col-sm-12 my-1'>
              <input type='hidden' value='<?php echo"$client";?>' name='post_id'>
              <input type='hidden' value='<?php echo"$name";?>' name='post_name'>
              <textarea type='text' class='form-control'
              value='' name='post_message'></textarea>
            </div>
            <div class='p-2'>
                <button type='submit' class='btn btn-primary mb-1'>Chat</button>
                <a class="btn btn-primary mb-1" href="refreshclientchat.php" role="button">Refresh for New messages</a>
            </div>
          </div>
      </form>
    <?php

      //insert new posted message
      if(isset($_POST['post_message'])){

        $message = $_POST['post_message'];
        $name = $_POST['post_name'];
        $id = $_POST['post_id'];
        $message = htmlentities($message);
        $name = htmlentities($name);
        $id = htmlentities($id);

        $insertsql = "INSERT INTO `clientmessages` (`message_id`, `client_id`, `message`, `date`, `time`, `author`) 
                      VALUES (NULL, ?, ?, CURDATE(), CURTIME(), ?); ";

        $stmt = $conn->prepare($insertsql);
        $stmt->bind_param('iss', $id, $message, $name); 
        $stmt->execute();
        header("Refresh:0");

      }

      //display chat history
      $client = htmlentities($client);

      $stmt = $conn->prepare("SELECT date, time, author, message FROM clientmessages WHERE client_id = ? ORDER BY message_id DESC");
      $stmt -> bind_param("i", $client);
      $stmt -> execute();

      $stmt -> store_result(); 
      $stmt -> bind_result($date, $time, $author, $message); 

      echo"
      <div class='card mychatcontainer'>
        <div  class= 'mychatwindow'>
      ";

          while($stmt -> fetch()){
            $newdate = date("d-m-Y", strtotime($date));
            $newtime = date('g:ia', strtotime($time));
            echo"<div class='card mychatmessage'>";
            echo" <h6> $author </h6>";
            echo" <p> $message </p>";
            echo" <p> $newtime $newdate</p>";
            echo"</div><br>";
          }

      echo"
        </div>
      </div>
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